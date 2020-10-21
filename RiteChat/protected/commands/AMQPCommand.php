<?php

/**
 * DocCommand class file.
 *
 * @author Suresh Reddy
 * @usage amqp server version
 *  @version 1.0
 */
require_once(getcwd() . '/extensions/amqp/lib/php-amqplib/amqp.inc');

class AMQPCommand extends CConsoleCommand {

    public function run($args) {

        
        $connection = new AMQPConnection(Yii::app()->params['AMQPSTREAMIP'], 5672, Yii::app()->params['AMQPSTREAMUNAME'], Yii::app()->params['AMQPSTREAMPASSWORD']);
        $channel = $connection->channel();

        $channel->queue_declare(Yii::app()->params['AMQPSTREAM'], false, false, false, false);


        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
  

        $callback = function($msg) {
            $obj = json_decode($msg->body, TRUE);
            $obj = (object) $obj;
            $obj->FollowOn = '';
            if (isset($obj->CreatedOn) && !empty($obj->CreatedOn)) {
                $obj->CreatedOn = new MongoDate($obj->CreatedOn);
                $obj->FollowOn = $obj->CreatedOn;
            } else {
                $obj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
                $obj->FollowOn = $obj->CreatedOn;
            }$craddd = $obj->CreatedOn;
           //CommonUtility::initiatePushNotification($obj,true);
           $this->saveOrUpdateNotifications($obj);
          
            if ($obj->ActionType == 'Follow' || $obj->ActionType == "UnFollow" || $obj->ActionType == 'UserFollow' || $obj->ActionType == 'UserUnFollow' || $obj->ActionType == 'GroupFollow' || $obj->ActionType == 'GroupUnFollow' || $obj->ActionType == 'SubGroupFollow' || $obj->ActionType == 'SubGroupUnFollow' || $obj->ActionType == 'HashTagFollow' || $obj->ActionType == "HashTagUnFollow" || $obj->ActionType == "CurbsideCategoryFollow" || $obj->ActionType == "CurbsideCategoryUnFollow") {

               $this->saveUserActivity($obj);
            }

            if ($obj->ActionType == "Comment") {
                $obj->Comments['CreatedOn'] = new MongoDate($obj->Comments['CreatedOn']);
               $this->saveUserActivity($obj);
               $this->distributeStreamForComment($obj);
            } else if ($obj->ActionType == "Post") {
                if($obj->CategoryType!=11)
                {
               $this->saveUserActivity($obj);
                }
               $this->distributeStreamObj($obj);
            } else if ($obj->ActionType == "Follow" || $obj->ActionType == "UnFollow" || $obj->ActionType == 'GroupFollow' || $obj->ActionType == 'GroupUnFollow' || $obj->ActionType == 'SubGroupFollow' || $obj->ActionType == 'SubGroupUnFollow' || $obj->ActionType == 'HashTagFollow' || $obj->ActionType == "HashTagUnFollow" || $obj->ActionType == "CurbsideCategoryFollow" || $obj->ActionType == "CurbsideCategoryUnFollow") {
               $this->distributeStreamForFollowObject($obj);
            } else if ($obj->ActionType == "FbShare") {
               $this->saveUserActivity($obj);
               $this->derivativeStreamForLoveAction($obj);
            } else if ($obj->ActionType == "TwitterShare") {
               $this->saveUserActivity($obj);
               $this->derivativeStreamForLoveAction($obj);
            } else if ($obj->ActionType == "Love") {
               $this->saveUserActivity($obj);
               $this->derivativeStreamForLoveAction($obj);
            } else if ($obj->ActionType == "EventAttend") {
               $this->saveUserActivity($obj);
               $this->distributeStreamForEventAttend($obj);
            } else if ($obj->ActionType == "Survey") {
               $this->saveUserActivity($obj);
               $this->distributeStreamForSurvey($obj);
            } else if ($obj->ActionType == "Invite") {
               $this->saveUserActivity($obj);
               $this->distributeStreamForInviteUsers($obj);
            } else if ($obj->ActionType == "Abuse") {
               $this->updatePostManagementActions($obj);
            } else if ($obj->ActionType == "Block") {
               $this->updatePostManagementActions($obj);
            } else if ($obj->ActionType == "Release") {
               $this->updatePostManagementActions($obj);
            } else if ($obj->ActionType == "Delete") {
               $this->updatePostManagementActions($obj);
            } else if ($obj->ActionType == "Promote") {
               $this->updatePostManagementActions($obj);
            } else if ($obj->ActionType == "Featured") {
               $this->updatePostManagementActions($obj);
            } else if ($obj->ActionType == "CommentBlock") {
               $this->updateCommentManagementActions($obj);
            } else if ($obj->ActionType == "CommentRelease") {
               $this->updateCommentManagementActions($obj);
            } else if ($obj->ActionType == "NewsNotify") {
               $this->upateNewsToNotifyInStream($obj);
            } else if ($obj->ActionType == "PullbackNews") {
                $obj->ActionType = 'Abuse';
               $this->upateNewsToNotifyInStream($obj);
            } else if ($obj->ActionType == "Play") {
                $obj->ActionType = 'Play';
                $obj->StreamNote = CommonUtility::actionTextbyActionType("Play");
               $this->saveUserActivity($obj);
               $this->distributeStreamForPlay($obj);
            } else if ($obj->ActionType == "Newgame") {

            }
            if ($obj->ActionType == 'GroupAutoFollow') {
               $this->groupAutoFollow($obj);
            } else if ($obj->ActionType == "Playing") {
               $obj->ActionType = 'Playing';
               $obj->StreamNote = CommonUtility::actionTextbyActionType("Resume");                 
               $this->saveUserActivity($obj);
               $this->updateStreamSocialActionsCount($obj);
            } else if ($obj->ActionType == "GroupAutoFollow") {
                $obj->ActionType = 'Abuse';
               $this->upateNewsToNotifyInStream($obj);
            } else if ($obj->ActionType == "SuspendGame" || $obj->ActionType == "ReleaseGame" || $obj->ActionType == "CancelScheduleGame") {
               $this->suspendOrReleaseGame($obj);
            } else if ($obj->ActionType == "GameSchedule") {
               $this->ScheduleGame($obj);
            }
            if ( isset($obj->CategoryType) && (int) $obj->CategoryType != 10 && $obj->CategoryType != 11) {
              CommonUtility::startBadging($obj,$obj->UserId);
            }
        };

        $channel->basic_consume(Yii::app()->params['AMQPSTREAM'], '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {

            $channel->wait();
        }


        $channel->close();
        $connection->close();



        echo 'Hello, world';
    }

    /**
     * author : suresh reddy 
     * Updated by Vamsi Krishna #260 Mar/2/14
     * save all user activity
     * @Param $obj  
     * return void
     */
     function saveUserActivity($obj) {
        try {
            $obj = (object) $obj;
            $obj->ActionType = $obj->ActionType;
            $obj->RecentActivity = $obj->ActionType;
            $obj->Title = $obj->Title;

            if ($obj->ActionType == 'Follow' || $obj->ActionType == "UnFollow" || $obj->ActionType == "UserFollow" || $obj->ActionType == "UserUnFollow" || $obj->ActionType == "CurbsideCategoryFollow" || $obj->ActionType == "CurbsideCategoryUnFollow" || $obj->ActionType == "HashTagFollow" || $obj->ActionType == "HashTagUnFollow" || $obj->ActionType == "GroupFollow" || $obj->ActionType == "GroupUnFollow") {

                if ($obj->ActionType == "UserFollow" || $obj->ActionType == "UserUnFollow") {
                    $isUserActivityPresent = UserActivityCollection::model()->getUserActivityByType($obj->UserId, $obj->UserFollowers, '', '', '', $obj->ActionType);
                    if ($isUserActivityPresent != 'failure') {
                        UserActivityCollection::model()->updateUserActivityForUserFollow($isUserActivityPresent->_id, $obj->ActionType, $obj->FollowOn);
                    } else {
                        UserActivityCollection::model()->userFollowUnFollowActivity($obj);
                    }
                }
                if ($obj->ActionType == "CurbsideCategoryFollow" || $obj->ActionType == "CurbsideCategoryUnFollow") {
                    $isUserActivityPresent = UserActivityCollection::model()->getUserActivityByType($obj->UserId, '', $obj->CurbsideCategoryId, '', '', $obj->ActionType, '', '');
                    if ($isUserActivityPresent != 'failure') {
                        UserActivityCollection::model()->updateUserActivityForUserFollow($isUserActivityPresent->_id, $obj->ActionType, $obj->FollowOn);
                    } else {
                        UserActivityCollection::model()->userFollowUnFollowActivity($obj);
                    }
                }
                if ($obj->ActionType == "HashTagFollow" || $obj->ActionType == "HashTagUnFollow") {
                    $isUserActivityPresent = UserActivityCollection::model()->getUserActivityByType($obj->UserId, '', '', $obj->HashTagId, '', $obj->ActionType);
                    if ($isUserActivityPresent != 'failure') {
                        UserActivityCollection::model()->updateUserActivityForUserFollow($isUserActivityPresent->_id, $obj->ActionType, $obj->FollowOn);
                    } else {
                        UserActivityCollection::model()->userFollowUnFollowActivity($obj);
                    }
                }
                if ($obj->ActionType == "GroupFollow" || $obj->ActionType == "GroupUnFollow") {
                    $isUserActivityPresent = UserActivityCollection::model()->getUserActivityByType($obj->UserId, '', '', '', $obj->GroupId, $obj->ActionType, '', '');
                    if ($isUserActivityPresent != 'failure') {
                        UserActivityCollection::model()->updateUserActivityForUserFollow($isUserActivityPresent->_id, $obj->ActionType, $obj->FollowOn);
                    } else {
                        UserActivityCollection::model()->userFollowUnFollowActivity($obj);
                    }
                  
                }
                // THis is for post follow and Unfollow

                if (trim($obj->ActionType) == "Follow" || $obj->ActionType == "UnFollow") {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType("Follow");
                    $activityObj = UserActivityCollection::model()->getActvityObjbyPostId($obj->PostId, (int) $obj->UserId, $obj->CategoryType);
                    /* @var $activityObj type */
                    if (isset($activityObj->UserId)) {
                        UserActivityCollection::model()->updatePostActvityObject($obj, $activityObj->_id, (int) $obj->UserId, $obj->ActionType);
                    } else {
                        UserActivityCollection::model()->saveUserActivityForPost($obj);
                    }
                }
                  UserInteractionCollection::model()->saveUserActivityForPost($obj);
            } else {
                if ($obj->ActionType == 'Post') {
                    $obj->PostFollowers = (int) $obj->UserId;
                    $obj->StreamNote = CommonUtility::actionTextbyActionType((int) $obj->PostType);
                }

                if ($obj->ActionType == 'Comment') {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType('Comment');
                }
                if ($obj->ActionType == 'Survey') {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType('Survey');
                }
                if ($obj->ActionType == 'EventAttend') {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType('EventAttend');
                }
                if ($obj->ActionType == 'Love') {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType('Love');
                }
                if ($obj->ActionType == 'FbShare') {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType('FbShare');
                }
                if ($obj->ActionType == 'TwitterShare') {
                    $obj->StreamNote = CommonUtility::actionTextbyActionType('TwitterShare');
                }
                if ($obj->ActionType == 'Invite') {
                    $obj->StreamNote = ' has invited to ';
                }
                if ($obj->ActionType == 'Invite') {
                    $obj->StreamNote = ' has invited to ';
                }
                
                $activityObj = UserActivityCollection::model()->getActvityObjbyPostId($obj->PostId, (int) $obj->UserId, $obj->CategoryType);
                /* @var $activityObj type */
                if (isset($activityObj->UserId)) {
                    UserActivityCollection::model()->updatePostActvityObject($obj, $activityObj->_id, (int) $obj->UserId, $obj->ActionType);
                } else {

                    UserActivityCollection::model()->saveUserActivityForPost($obj);
                }

                UserInteractionCollection::model()->saveUserActivityForPost($obj);
            }
        } catch (Exception $ex) {
            echo "Excepiton occured at save activity in amqp command" . $ex->getMessage();
        }
    }

    /**
     * autho: suresh reddy
     * @method is used for distibute active objects stream
     * @param type $obj
     */
     function distributeStreamObj($obj) {
        try {
            $obj = (object) $obj;
            $UserId = $obj->UserId;
            $obj->CategoryType = $obj->CategoryType;
            $skiptapostService = new SkiptaPostService;
            $obj->PostFollowers = (int) $obj->UserId;
            if ($obj->ActionType == 'Post') {
                $obj->RecentActivity = 'Post';
                $obj->StreamNote = CommonUtility::actionTextbyActionType($obj->PostType);


                if ($obj->PostType == 12 && $obj->CategoryType == 9 && $obj->PreviousGameScheduleId != 0 && $obj->ActionType == "Post") {

                    UserStreamCollection::model()->updateStreamForGameSchedule($obj);
                } else {
                     
                    
                         $this->saveStreamforNetworkUsers($obj);
                          
                    $hashTagIdArray = $obj->HashTags;
                    for ($j = 0; $j < count($hashTagIdArray); $j++) {
                        //Here added logic for saving the Hashtag usage actiontype in the userInteractionCollection.
                        $actionTypeValue=$obj->ActionType;
                        $saveHashTagUsageObj=$obj;
                        $saveHashTagUsageObj->ActionType="HashTagUsage";
                        UserInteractionCollection::model()->saveUserActivityForPost($saveHashTagUsageObj);
                        $saveHashTagUsageObj->ActionType=$actionTypeValue;
                      
                        $hashObj = $hashTagIdArray[$j];
                        $hashTagObject = $skiptapostService->getHashTagFollowers($hashObj['$id']);
                        if (is_object($hashTagObject)) {
                            $obj->Priority = (int) 1;
                            $obj->RecentActivity = 'Post';
                            $obj->StreamNote1 = "on a #" . $hashTagObject->HashTagName;
                            foreach ($hashTagObject->HashTagFollowers as $hashTagFollower) {
                                $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), $hashTagFollower);
                                $obj->StreamUserId = $hashTagFollower;
                                $obj->HashTagPostUserId = (int) $obj->UserId;

                                if (isset($streamObj->UserId)) {
                                    UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $hashTagFollower, $obj->RecentActivity);
                                } else {
                                    UserStreamCollection::model()->saveUserStream($obj);
                                }
                            }
                        }
                    }
                    /**
                     * User followers stream generate
                     */
                    if($obj->CategoryType!=11)
                    {
                    $obj->HashTagPostUserId = "";
                    if($obj->NetworkAdminUserId!=(string)$UserId){
                          if($obj->CategoryType==10 && $obj->CustomBadgeProcessType!="Console"){
                        $followerUsers = $skiptapostService->getFollowersOfUser($UserId);
                        for ($i = 0; $i < sizeof($followerUsers); $i++) {
                            $obj->Priority = (int) 1;
                            $obj->StreamUserId = (int) $followerUsers[$i];
                            $obj->RecentActivity = 'Post';
                            $obj->UserFollowers = (int) $obj->UserId;
                                 $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i]);        
                            if (isset($streamObj->UserId)) {                                
                                UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                            } else {
                                    UserStreamCollection::model()->saveUserStream($obj);    
                                }
                            }  
                          }
                      
                        }
                    }
                    $obj->HashTagPostUserId = "";
                    $obj->MentionUserId = "";
                    
                     if($obj->CategoryType==10 && $obj->CustomBadgeProcessType=="Console" ){                        
                        $streamObj=UserStreamCollection::model()->getStreamObjbyStoreId($obj->Store,0);
                     }else{
                        $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), $obj->UserId);                
                          }
                          
                    
                    $obj->StreamUserId = (int) $obj->UserId;
                    $obj->Priority = (int) 2;
                    if (isset($streamObj->UserId)) {
                        UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $obj->UserId, $obj->RecentActivity);
                    } else {
                        UserStreamCollection::model()->saveUserStream($obj);
                    }
                  
                }
                $obj->StreamNote = CommonUtility::actionTextbyActionType('UserMention');
                $mentionArray = $obj->MentionArray;
                for ($i = 0; $i < sizeof($mentionArray); $i++) {
                    $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), $mentionArray[$i]);
                    $obj->StreamUserId = (int) $mentionArray[$i];
                    $obj->Priority = (int) 2;
                    $obj->RecentActivity = 'UserMention';
                    $obj->MentionUserId = (int) $obj->UserId;
                    if (isset($streamObj->UserId)) {
                        UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $mentionArray[$i], $obj->RecentActivity);
                    } else {
                        echo "save user stream&&&&&&&&&&&&&&&&&&&&";
                        UserStreamCollection::model()->saveUserStream($obj);
                    }

                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($mentionArray[$i]);
                    if ($userSettings != "failure") {
                        if ($userSettings->Mentioned == 1) {
                            try {
                                $notificationObj = new Notifications();
                                $notificationObj->UserId = (int) $mentionArray[$i];
                                $notificationObj->NotificationNote = 'mentioned you';
                                $notificationObj->RecentActivity = 'mention';
                                $notificationObj->MentionedUserId = $obj->UserId;
                                $notificationObj->PostId = $obj->PostId;
                                $notificationObj->CategoryType = $obj->CategoryType;
                                $notificationObj->NetworkId = $userSettings->NetworkId;
                                $notificationObj->isRead = 0;
                                $notificationObj->PostType = $obj->PostType;
                                $notificationObj->CreatedOn = $obj->CreatedOn;
                              $userNotifications = Notifications::model()->getNotificationsForUserWithPost($mentionArray[$i], $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'mention');
                                if ($userNotifications != 'failure') {
                                    Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                } else {
                                    error_log("%%%%%%%%%%distributeStreamObj%%%%%%%%%%%%%%%%%%%");
                                     $obj->ActionType = "Mention";
                                     $obj->OriginalUserId = (int) $mentionArray[$i];
                                     //CommonUtility::initiatePushNotification($obj,false);
                                    Notifications::model()->saveNotifications($notificationObj);
                                }
                            } catch (Exception $exc) {
                                
                            }
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo "Excepiton occured at save user stream in amqp command" . $ex->getMessage();
        }
    }

     function distributeStreamForInviteUsers($obj) {
        try {
            $obj = (object) $obj;
            $UserId = $obj->UserId;

            $postType = CommonUtility::postTypebyIndex($obj->PostType);

            $skiptapostService = new SkiptaPostService;


            if ($obj->ActionType == 'Invite') {
                $obj->RecentActivity = 'Invite';

                /**
                 * put stram for Comment userid
                 */
                $obj->StreamNote = CommonUtility::actionTextbyActionType('Invite');
                $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), $obj->UserId);
                $obj->StreamUserId = (int) $obj->UserId;
                $obj->CommentUserId = (int) $obj->UserId;

                $obj->Priority = (int) 2;


                $invitedUserId = $obj->UserId;
                foreach ($obj->InviteUsers as $user) {
                    $obj->StreamUserId = $user;
                    $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), $user);
                    $obj->InviteUsers = (int) $invitedUserId;
                    if (isset($streamObj->UserId)) {
                        UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $user, $obj->RecentActivity);
                    } else {
                        UserStreamCollection::model()->saveUserStream($obj);
                    }

                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings((int) $user);
                    if ($userSettings != "failure") {
                        if ($userSettings->Invited == 1) {
                            try {
                                $notificationObj = new Notifications();
                                $notificationObj->UserId = (int) $user;
                                $notificationObj->NotificationNote = 'invited you';
                                $notificationObj->RecentActivity = 'invite';
                                $notificationObj->InviteUserId = (int) $invitedUserId;
                                $notificationObj->PostId = $obj->PostId;
                                $notificationObj->CategoryType = $obj->CategoryType;
                                $notificationObj->NetworkId = (int) $userSettings->NetworkId;
                                $notificationObj->isRead = 0;
                                $notificationObj->PostType = $obj->PostType;
                                $notificationObj->CreatedOn = $obj->CreatedOn;
                                $userNotifications = Notifications::model()->getNotificationsForUserWithPost($user, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'Invite');

                                if ($userNotifications != 'failure') {
                                    Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                } else {
                                    Notifications::model()->saveNotifications($notificationObj);
                                }
                                  $obj->ActionType = "Invite";
                                   $obj->UserId = (int) $invitedUserId;
                                  $obj->OriginalUserId = (int) $user;
                                  error_log("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$#before *************");
                                   //CommonUtility::initiatePushNotification($obj,false);
                            } catch (Exception $exc) {
                                echo " EXCEPTION rised at save invite notifcation " . $exc->getMessage();
                            }
                        }
                    }
                    $obj->UserId = $obj->StreamUserId;
                    $activityObj = UserActivityCollection::model()->getActvityObjbyPostId($obj->PostId, $obj->ActionType, $obj->CategoryType);
                    if (isset($activityObj->UserId)) {
                        UserActivityCollection::model()->updatePostActvityObject($obj, $activityObj->_id, (int) $obj->StreamUserId, $obj->ActionType);
                    } else {
                        UserActivityCollection::model()->saveUserActivityForPost($obj);
                    }
                }
            }
        } catch (Exception $exc) {
            Yii::log("distributeStreamForinvite" . $exc->getMessage(), 'error', 'application');
        }
    }

     function distributeStreamForComment($obj) {
        try {
            $obj = (object) $obj;
            $UserId = $obj->UserId;



            if ($obj->ActionType == 'Comment') {
                $obj->RecentActivity = 'Comment';
                $obj->CommentUserId = (int) $obj->UserId;
                $obj->StreamNote = CommonUtility::actionTextbyActionType('Comment');



                $OriginalUserId = array($obj->UserId);
                $PostOriginalUserId = array($obj->OriginalUserId);
                /* this is to get the hash tags details if any  */
                $hashTagIdArray = $obj->HashTags;

                /**
                 * prepare user list to distribute comment 
                 */
                $PostObjFollowers = ServiceFactory::getSkiptaPostServiceInstance()->getObjectFollowers($obj->PostId, $obj->PostType, $obj->CategoryType);
                $followerUsers = array();
                if($obj->NetworkAdminUserId!=(string)($obj->UserId)){
                    $followerUsers = ServiceFactory::getSkiptaPostServiceInstance()->getFollowersOfUser($obj->UserId);
                }
                $originalPostUserFollowers = array();
                if($obj->NetworkAdminUserId!=(string)($obj->OriginalUserId)){
                    $originalPostUserFollowers = ServiceFactory::getSkiptaPostServiceInstance()->getFollowersOfUser($obj->OriginalUserId);
                }
                $mentionArray = $obj->MentionArray;
                if (count($mentionArray) > 0) {
                    for ($i = 0; $i < sizeof($mentionArray); $i++) {
                        $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($mentionArray[$i]);
                        if ($userSettings != "failure") {
                            if ($userSettings->Mentioned == 1) {
                                try {
                                    $notificationObj = new Notifications();
                                    $notificationObj->UserId = (int) $mentionArray[$i];
                                    $notificationObj->NotificationNote = 'mentioned you';
                                    $notificationObj->RecentActivity = 'mention';
                                    $notificationObj->MentionedUserId = $obj->UserId;
                                    $notificationObj->PostId = $obj->PostId;
                                    $notificationObj->CategoryType = $obj->CategoryType;
                                    $notificationObj->NetworkId = $userSettings->NetworkId;
                                    $notificationObj->isRead = 0;
                                    $notificationObj->PostType = $obj->PostType;
                                    $notificationObj->CommentUserId = (int) $mentionArray[$i];
                                    $notificationObj->CreatedOn = $obj->CreatedOn;
                                    $userNotifications = Notifications::model()->getNotificationsForUserWithPost($mentionArray[$i], $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'mention');
                                    if ($userNotifications != 'failure') {
                                        Notifications::model()->updateNotificationsForUser($userNotifications->_id,  'mention', $notificationObj);
                                    } else {
                                        Notifications::model()->saveNotifications($notificationObj);
                                    }
                                     $obj->ActionType = "Mention";
                                     $obj->OriginalUserId = (int) $mentionArray[$i];
                                     //CommonUtility::initiatePushNotification($obj,false);
                                } catch (Exception $exc) {
                                    
                                }
                            }
                        }
                    }
                }

                if (!is_array($PostObjFollowers)) {
                    $PostObjFollowers = array();
                }
                if (!is_array($followerUsers)) {
                    $followerUsers = array();
                }
                if (!is_array($originalPostUserFollowers)) {
                    $originalPostUserFollowers = array();
                }

                $usersList = array_values(array_unique(array_merge(array(0), $OriginalUserId, $PostOriginalUserId, $PostObjFollowers, $followerUsers, $originalPostUserFollowers)));
                for ($i = 0; $i < sizeof($usersList); $i++) {

                    $obj->StreamUserId = (int) $usersList[$i];
                    $obj->RecentActivity = 'Comment';
                    $obj->CommentUserId = (int) $obj->UserId;
                     $obj->StreamNote = CommonUtility::actionTextbyActionType('Comment');

                    $isEngageObj = UserActivityCollection::model()->getEngageObjbyPostId(new MongoId($obj->PostId), (int) $usersList[$i], (int) $obj->CategoryType);



                    $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $usersList[$i]);
                    if (!isset($isEngageObj->UserId)) {
                        if (isset($streamObj->UserId)) {
                            if ($streamObj->RecentActivity == "Invite") {
                                $obj->ActionType = 'Invite';
                                $obj->StreamNote = CommonUtility::actionTextbyActionType('Invite');
                                $obj->RecentActivity = 'Invite';
                                $obj->InviteUsers = 0;
                            }
                        }
                    }
                    if (isset($streamObj->UserId)) {
                        UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                    } else {
                        UserStreamCollection::model()->saveUserStream($obj);
                    }
                }
               $this->updateIsEngage($obj->PostId, $UserId);
            }
               
                     $obj->RecentActivity = 'Comment';
                     $obj->ActionType = 'Comment';
                     $obj->CommentUserId = (int) $obj->UserId;
                     $obj->StreamNote = CommonUtility::actionTextbyActionType('Comment');



            /**
             * update social count  for user id =0
             */
            UserStreamCollection::model()->updateStreamSocialActions($obj);
            UserActivityCollection::model()->updateActvitySocialActions($obj);
            FollowObjectStream::model()->updateStreamSocialActions($obj);
        } catch (Exception $exc) {
            Yii::log("distributeStreamForComment" . $exc->getMessage(), 'error', 'application');
        }
    }

     function distributeStreamForPlay($obj) {
        try {
            $obj = (object) $obj;
            $UserId = $obj->UserId;



            if ($obj->ActionType == 'Play') {
                $obj->RecentActivity = 'Play';

                $obj->StreamNote = CommonUtility::actionTextbyActionType('Play');



                $OriginalUserId = array($obj->UserId);
                $PostOriginalUserId = array($obj->OriginalUserId);
                /* this is to get the hash tags details if any  */


                /**
                 * prepare user list to distribute comment 
                 */
                $PostObjFollowers = ServiceFactory::getSkiptaPostServiceInstance()->getObjectFollowers($obj->PostId, $obj->PostType, $obj->CategoryType);
                $followerUsers = array();
                if ($obj->NetworkAdminUserId != (string) ($obj->UserId)) {
                    $followerUsers = ServiceFactory::getSkiptaPostServiceInstance()->getFollowersOfUser($obj->UserId);
                }
                $originalPostUserFollowers = array();
                if ($obj->NetworkAdminUserId != (string) ($obj->OriginalUserId)) {
                    $originalPostUserFollowers = ServiceFactory::getSkiptaPostServiceInstance()->getFollowersOfUser($obj->OriginalUserId);
                }


                if (!is_array($PostObjFollowers)) {
                    $PostObjFollowers = array();
                }
                if (!is_array($followerUsers)) {
                    $followerUsers = array();
                }
                if (!is_array($originalPostUserFollowers)) {
                    $originalPostUserFollowers = array();
                }

                $usersList = array_values(array_unique(array_merge($OriginalUserId, $PostOriginalUserId, $PostObjFollowers, $followerUsers, $originalPostUserFollowers)));

                for ($i = 0; $i < sizeof($usersList); $i++) {

                    $obj->StreamUserId = (int) $usersList[$i];
                    $obj->RecentActivity = 'Play';
                    $obj->CommentUserId = (int) $obj->UserId;

                    $isEngageObj = UserActivityCollection::model()->getEngageObjbyPostId(new MongoId($obj->PostId), (int) $usersList[$i], (int) $obj->CategoryType);



                    $streamObj = UserStreamCollection::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $usersList[$i]);

                    if (isset($streamObj->UserId)) {
                        UserStreamCollection::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                    } else {
                        UserStreamCollection::model()->saveUserStream($obj);
                    }
                }
               $this->updateIsEngage($obj->PostId, $UserId);
            }



            /**
             * update social count  for user id =0
             */
            UserStreamCollection::model()->updateStreamSocialActions($obj);
            UserActivityCollection::model()->updateActvitySocialActions($obj);
            FollowObjectStream::model()->updateStreamSocialActions($obj);
        } catch (Exception $exc) {
            Yii::log("distributeStreamForComment" . $exc->getMessage(), 'error', 'application');
        }
    }

     function distributeStreamForSurvey($obj) {
        try {
            $obj = (object) $obj;
            $UserId = (int) $obj->UserId;
            $skiptapostService = new SkiptaPostService;
            if ($obj->ActionType == 'Survey') {
                $obj->RecentActivity = 'Survey';
                $obj->StreamNote = CommonUtility::actionTextbyActionType('Survey');
                $obj->UserFollowers = "";
                $obj->SurveyTaken = "";
                $obj->Priority = (int) 1;
                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
                if ($obj->NetworkAdminUserId != (string) ($obj->UserId)) {
                    $followerUsers = $skiptapostService->getFollowersOfUser($obj->UserId);
                    for ($i = 0; $i < sizeof($followerUsers); $i++) {
                        $obj->StreamUserId = (int) $followerUsers[$i];
                        $obj->SurveyTaken = (int) $obj->UserId;
                        if ((int) $obj->UserId != $followerUsers[$i]) {
                            $isEngageObj = UserActivityCollection::model()->getActvityObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->CategoryType);
                            if (!is_object($isEngageObj)) {

                                $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->FollowEntity);
                                if (isset($streamObj->UserId)) {
                                    FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                                } else {

                                    FollowObjectStream::model()->saveFollowObjectStream($obj);
                                }
                            }
                        }
                    }
                }
                UserStreamCollection::model()->saveSurvey($obj);
               $this->updateIsEngage($obj->PostId, $UserId);
            }
        } catch (Exception $exc) {
            echo "exception at survery taken " . $exc->getMessage();
        }
    }

     function distributeStreamForEventAttend($obj) {
        try {
            $obj = (object) $obj;
            $UserId = (int) $obj->UserId;
            $skiptapostService = new SkiptaPostService;
            if ($obj->ActionType == 'EventAttend') {
                $obj->RecentActivity = 'EventAttend';
                $obj->StreamNote = CommonUtility::actionTextbyActionType('EventAttend');
                
                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
                $obj->Priority = (int) 1;


            if ($obj->NetworkAdminUserId != (string) $UserId) {
                $followerUsers = $skiptapostService->getFollowersOfUser($UserId);
                for ($i = 0; $i < sizeof($followerUsers); $i++) {
                    $obj->StreamUserId = (int) $followerUsers[$i];
                    $obj->RecentActivity = 'EventAttend';
                    $obj->EventAttendes = (int) $obj->UserId;
                    if ((int) $obj->UserId != $followerUsers[$i]) {
                        $isEngageObj = UserActivityCollection::model()->getActvityObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->CategoryType);
                        if (!is_object($isEngageObj)) {
                            $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->FollowEntity);
                            if (isset($streamObj->UserId)) {
                                FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                            } else {
                                FollowObjectStream::model()->saveFollowObjectStream($obj);
                            }
                        }
                    }
                }
            }
                UserStreamCollection::model()->attendEvent($obj);
               $this->updateIsEngage($obj->PostId, $UserId);
            }
        } catch (Exception $exc) {
            echo "excepiton occured at event attend" . $exc->getMessage();
        }
    }

     function saveStreamforNetworkUsers($obj) {

         
        if (isset($obj->CategoryType) && $obj->CategoryType != 10 && $obj->CategoryType!=11 &&  $obj->CategoryType != 12 ) {
            $obj->StreamUserId = 0;
            //$obj->StreamNote = CommonUtility::actionTextbyActionType('Post') . " ";
            UserStreamCollection::model()->saveUserStream($obj);
        }
    }

    function updateStreamSocialActionsCount($obj) {
        try {
            UserStreamCollection::model()->updateStreamSocialActions($obj);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * derivative stream for actions  love, event attend, submit survery, game play
     * @param type $obj  stream obj
     */
     function derivativeStreamForLoveAction($obj) {
        try {

            $obj = (object) $obj;
            $UserId = (int) $obj->UserId;
            $skiptapostService = new SkiptaPostService;


            if ($obj->ActionType == 'Love') {
                $obj->RecentActivity = 'Love';
                $obj->StreamNote = CommonUtility::actionTextbyActionType('Love');
                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
                $obj->Priority = (int) 1;
                if ($obj->NetworkAdminUserId != (string) $UserId) {
                    $followerUsers = $skiptapostService->getFollowersOfUser($UserId);
                    for ($i = 0; $i < sizeof($followerUsers); $i++) {
                        $obj->StreamUserId = (int) $followerUsers[$i];
                        $obj->LoveUserId = (int) $obj->UserId;
                        if ((int) $obj->UserId != $followerUsers[$i]) {
                            $isEngageObj = UserActivityCollection::model()->getActvityObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->CategoryType);
                            if (!is_object($isEngageObj)) {
                                $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->FollowEntity);
                                if (isset($streamObj->UserId)) {
                                    FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                                } else {
                                    FollowObjectStream::model()->saveFollowObjectStream($obj);
                                }
                            }
                        }
                    }
                }
            }
            if ($obj->ActionType == 'TwitterShare' || $obj->ActionType == 'FbShare') {
                $obj->RecentActivity = 'Share';
                $obj->StreamNote = CommonUtility::actionTextbyActionType($obj->ActionType);
                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
                $obj->Priority = (int) 1;
                if ($obj->NetworkAdminUserId != (string) $UserId) {
                    $followerUsers = $skiptapostService->getFollowersOfUser($UserId);
                    for ($i = 0; $i < sizeof($followerUsers); $i++) {
                        $obj->StreamUserId = (int) $followerUsers[$i];
                        if ($obj->ActionType == 'FbShare') {
                            $obj->TwitterShare = (int) $obj->UserId;
                        }
                        if ($obj->ActionType == 'TwitterShare') {
                            $obj->FbShare = (int) $obj->UserId;
                        }
                        if ((int) $obj->UserId != $followerUsers[$i]) {
                            $isEngageObj = UserActivityCollection::model()->getActvityObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->CategoryType);
                            if (!is_object($isEngageObj)) {

                                $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $followerUsers[$i], (int) $obj->FollowEntity);
                                if (isset($streamObj->UserId)) {
                                    FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity);
                                } else {
                                    FollowObjectStream::model()->saveFollowObjectStream($obj);
                                }
                            }
                        }
                    }
                }
            }

            UserStreamCollection::model()->updateStreamSocialActions($obj);
            UserActivityCollection::model()->updateActvitySocialActions($obj);
           $this->updateIsEngage($obj->PostId, $UserId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

     function distributeStreamForFollowObject($obj) {
        try {
            $obj = (object) $obj;
            $obj->FollowOn = $obj->CreatedOn;
            $UserId = (int) $obj->UserId;
            $obj->PostType = (int) $obj->PostType;
            if ($obj->ActionType == "HashTagFollow") {
                $obj->HashTagFollowers = (int) $UserId;
                $obj->StreamNote = CommonUtility::actionTextbyActionType($obj->ActionType);
                $obj->HashTagId = (int) $obj->HashTagId;
                $obj->HashTagName = $obj->HashTagName;
                $obj->HashTagPostCount = (int) $obj->HashTagPostCount;
                $obj->RecentActivity = $obj->ActionType;
            } else if ($obj->ActionType == "CurbsideCategoryFollow") {
                $obj->CurbsideCategoryFollowers = (int) $UserId;
                $obj->CurbsideConsultCategory = $obj->CurbsideConsultCategory;
                $obj->CurbsideCategoryId = $obj->CurbsideCategoryId;
                $obj->StreamNote = CommonUtility::actionTextbyActionType($obj->ActionType);
                $obj->CurbsidePostCount = $obj->CurbsidePostCount;
                $obj->RecentActivity = $obj->ActionType;
            } else if ($obj->ActionType == "GroupFollow") {

                $obj->StreamNote = CommonUtility::actionTextbyActionType($obj->ActionType);
                $obj->GroupFollowers = (int) $UserId;
                $obj->GroupId = (String) $obj->GroupId;
                $obj->RecentActivity = 'GroupFollow';
            } else if ($obj->ActionType == "SubGroupFollow") {

                $obj->StreamNote = CommonUtility::actionTextbyActionType($obj->ActionType);
                $obj->SubGroupFollowers = (int) $UserId;
                $obj->SubGroupId = (String) $obj->SubGroupId;
                $obj->RecentActivity = 'SubGroupFollow';
            } else if ($obj->ActionType == "Follow") {
                $obj->PostFollowers = (int) $UserId;
                $obj->RecentActivity = 'PostFollow';
                $obj->StreamNote = CommonUtility::actionTextbyActionType('Follow');
                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
            }
            if ($obj->ActionType == "GroupFollow" || $obj->ActionType == "SubGroupFollow" || $obj->ActionType == "Follow" || $obj->ActionType == "CurbsideCategoryFollow" || $obj->ActionType == "HashTagFollow") {
                $followerUsers = array();
                echo '_____user id ______________'.$UserId;
                echo '^^^^^^^^^^^^^^^^^^^^^'.$obj->NetworkAdminUserId;
                if($obj->NetworkAdminUserId!=(string)$UserId){
                    $followerUsers = ServiceFactory::getSkiptaPostServiceInstance()->getFollowersOfUser($UserId);
                    $obj->Priority = (int) 1;
                    for ($i = 0; $i < sizeof($followerUsers); $i++) {
                        $obj->StreamUserId = (int) $followerUsers[$i];

                        if ($obj->CategoryType == 3 && $obj->IsPrivate == 0 || $obj->CategoryType == 7) {
                            $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId((String) $obj->PostId), (int) $followerUsers[$i], (int) $obj->FollowEntity);

                            if (isset($streamObj->UserId)) {
                                FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity, $obj->FollowOn);
                            } else {
                                FollowObjectStream::model()->saveFollowObjectStream($obj);
                            }
                        } else {
                            $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId((String) $obj->PostId), (int) $followerUsers[$i], (int) $obj->FollowEntity);

                            if (isset($streamObj->UserId)) {
                                FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $streamObj->UserId, $obj->RecentActivity, $obj->FollowOn);
                            } else {
                                FollowObjectStream::model()->saveFollowObjectStream($obj);
                            }
                        }
                    }
                }
               $this->updateIsEngage((String) $obj->PostId, $UserId);
            }

            if ($obj->ActionType == "UnFollow") {
                UserStreamCollection::model()->unFollowObject($obj);
            }


            if (isset($obj->RecentActivity) && $obj->RecentActivity == 'PostFollow') {

                UserStreamCollection::model()->followObject($obj);
               $this->updateIsEngage((String) $obj->PostId, $UserId);
                UserActivityCollection::model()->followObject($obj);
            }
        } catch (Exception $exc) {
            echo "**************************************************" . $exc->getMessage();
        }
    }

    /**
     * @author Sagar Pathapelli updated by suresh reddy 8/3/14  , need to same functionality in derivative stream.
     * @Description Updating Post management actions
     * @param type $obj
     */
    public  function updatePostManagementActions($obj) {
        try {
            UserStreamCollection::model()->updatePostManagementActions($obj);
            /**
             * block and release delete in derivative stream.
             */
            $postObj = '';
            FollowObjectStream::model()->updatePostManagementActions($obj);
            UserActivityCollection::model()->updatePostManagementActions($obj);
            UserInteractionCollection::model()->updatePostManagementActions($obj);

            /** Updated by Vamsi 
             * This block is to update 
             * 1)GroupCollection
             * 2)CurbsideCategory 
             * 3)HashTagCollection
             */
            if ($obj->ActionType == 'Block' || $obj->ActionType == 'Abuse' || $obj->ActionType == 'Delete') {
                if ($obj->CatagoryId == 3 || $obj->CatagoryId == 7) {
                    $postObj = GroupPostCollection::model()->getGroupPostById($obj->PostId);
                    if ($obj->CatagoryId == 7) {
                        SubGroupCollection::model()->updateGroupCollectionForDelete($obj, $postObj->SubGroupId);
                    } else {
                        GroupCollection::model()->updateGroupCollectionForDelete($obj, $postObj->GroupId);
                    }
                }
                if ($obj->CatagoryId == 2) {
                    $postObj = CurbsidePostCollection::model()->getPostById($obj->PostId);
                    if (isset($postObj->CategoryId)) {
                        CurbSideCategoryCollection::model()->updateCurbSideCategoryCollectionForDelete($obj, $postObj->CategoryId);
                    }
                    if ($postObj->IsFeatured == 1) {
                        NewsCollection::model()->updateNewsCollection($obj->PostId, $obj->CatagoryId, $obj->ActionType);
                    }
                }if ($obj->CatagoryId == 1) {
                    $postObj = PostCollection::model()->getPostById($obj->PostId);
                    if ($postObj->IsFeatured == 1) {
                        NewsCollection::model()->updateNewsCollection($obj->PostId, $obj->CatagoryId, $obj->ActionType);
                    }
                }

                ResourceCollection::model()->updateResourceCollectionForDelete($obj);
                if (isset($postObj) && count($postObj->HashTags) > 0) {
                    foreach ($postObj->HashTags as $hashtag) {
                        HashTagCollection::model()->updateHashTagCollectionForDelete($obj, $hashtag);
                    }
                }
                // Notifications::model()->updateNotificationsDelete($obj);
            } else if ($obj->ActionType == 'Release') {
                if ($obj->CatagoryId == 3 || $obj->CatagoryId == 7) {
                    $postObj = GroupPostCollection::model()->getGroupPostById($obj->PostId);
                    if ($obj->CatagoryId == 7) {
                        SubGroupCollection::model()->updateGroupCollectionForDelete($obj, $postObj->SubGroupId);
                    } else {
                        GroupCollection::model()->updateGroupCollectionForDelete($obj, $postObj->GroupId);
                    }
                }
                if ($obj->CatagoryId == 2) {
                    $postObj = CurbsidePostCollection::model()->getPostById($obj->PostId);
                    if (isset($postObj->CategoryId)) {
                        CurbSideCategoryCollection::model()->updateCurbSideCategoryCollectionForDelete($obj, $postObj->CategoryId);
                    }

                    if ($postObj->IsFeatured == 1) {
                        NewsCollection::model()->updateNewsCollection($obj->PostId, $obj->CatagoryId, $obj->ActionType);
                    }
                }if ($obj->CatagoryId == 1) {
                    $postObj = PostCollection::model()->getPostById($obj->PostId);
                    if ($postObj->IsFeatured == 1) {
                        NewsCollection::model()->updateNewsCollection($obj->PostId, $obj->CatagoryId, $obj->ActionType);
                    }
                }
                if ($obj->CatagoryId == 9) {
                    $postObj = GameCollection::model()->getPostById($obj->PostId);
                    if ($postObj->IsFeatured == 1) {
                        NewsCollection::model()->updateNewsCollection($obj->PostId, $obj->CatagoryId, $obj->ActionType);
                    }
                }

                ResourceCollection::model()->updateResourceCollectionForDelete($obj);
                if (count($postObj->HashTags) > 0) {
                    foreach ($postObj->HashTags as $hashtag) {
                        HashTagCollection::model()->updateHashTagCollectionForDelete($obj, $hashtag);
                    }
                }
            }
            /** Block End */
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public  function saveOrUpdateNotifications($obj) {
        try {
            error_log("saveOrUpdateNotifications----------------");
            if ($obj->ActionType == 'Comment') {
                if ($obj->IsBlockedWordExist != 1) {
                    if ($obj->OriginalUserId != $obj->UserId) {
                        $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($obj->OriginalUserId);
                        if ($userSettings != "failure") {
                            if ($userSettings->Commented == 1) {
                                try {
                                    $notificationObj = new Notifications();
                                    $notificationObj->UserId = $obj->OriginalUserId;
                                    $notificationObj->NotificationNote = 'commented on your post';
                                    $notificationObj->RecentActivity = 'comment';
                                    $notificationObj->CommentUserId = $obj->UserId;
                                    $notificationObj->PostId = $obj->PostId;
                                    $notificationObj->CategoryType =$obj->CategoryType;
                                    $notificationObj->NetworkId = $userSettings->NetworkId;
                                    $notificationObj->isRead = 0;
                                    $notificationObj->PostType = $obj->PostType;
                                    $notificationObj->CreatedOn = $obj->CreatedOn;
                                    $isFollowing = 0;
                                    if ($obj->CategoryType == 3) {
                                        $groupDetails = GroupCollection::model()->getGroupDetailsById($obj->GroupId);
                                        if (!is_string($groupDetails)) {
                                            if (in_array($obj->OriginalUserId, $groupDetails->GroupMembers)) {
                                                $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'comment');
                                                if (isset($userNotifications->UserId)) {
                                                    Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                                } else {
                                                    Notifications::model()->saveNotifications($notificationObj);
                                                }
                                            } else {
                                                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
                                               $this->saveFollowObjectForNotificationsFromGroupAndSubGroup($obj);
                                            }
                                        }
                                    } else if ($obj->CategoryType == 7) {
                                        $groupDetails = SubGroupCollection::model()->getSubGroupDetailsById($obj->GroupId);
                                        if (!is_string($groupDetails)) {
                                            if (in_array($obj->OriginalUserId, $groupDetails->SubGroupMembers)) {
                                                $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'comment');
                                                if (isset($userNotifications->UserId)) {
                                                    Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                                } else {
                                                    Notifications::model()->saveNotifications($notificationObj);
                                                }
                                            } else {
                                                $obj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Post');
                                               $this->saveFollowObjectForNotificationsFromGroupAndSubGroup($obj);
                                            }
                                        }
                                    } else {
                                        $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'comment');
                                        if (isset($userNotifications->UserId)) {
                                            Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                        } else {
                                            Notifications::model()->saveNotifications($notificationObj);
                                        }
                                    }
                                } catch (Exception $exc) {
                                    echo '_________1 exception__________' . $exc->getMessage();
                                }
                            }
                        }
                    }
                }
            }
            if (isset($obj->ActionType) && $obj->ActionType == 'Love') {
                error_log("!!!!!!!!!!!!!!!!!!!!!!!!!!!!".$obj->OriginalUserId."--------". $obj->LoveUserId);
                if ($obj->OriginalUserId != $obj->LoveUserId) {
                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($obj->OriginalUserId);
                    if ($userSettings != "failure") {
                        if ($userSettings->Loved == 1) {
                            try {
                                $notificationObj = new Notifications();
                                $notificationObj->UserId = $obj->OriginalUserId;
                                $notificationObj->NotificationNote = 'loved your post';
                                $notificationObj->RecentActivity = 'love';
                                $notificationObj->Love = $obj->LoveUserId;
                                $notificationObj->PostId = $obj->PostId;
                                $notificationObj->CategoryType = $obj->CategoryType;
                                $notificationObj->NetworkId = $userSettings->NetworkId;
                                $notificationObj->isRead = 0;
                                $notificationObj->PostType = $obj->PostType;
                                $notificationObj->CreatedOn = $obj->CreatedOn;
                                if ($obj->CategoryType == 3) {
                                    $groupDetails = GroupCollection::model()->getGroupDetailsById($obj->GroupId);
                                    if (!is_string($groupDetails)) {
                                        if (in_array($obj->OriginalUserId, $groupDetails->GroupMembers)) {
                                            $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'love');
                                            if (isset($userNotifications->UserId)) {
                                                Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                            } else {
                                                Notifications::model()->saveNotifications($notificationObj);
                                            }
                                        } else {
                                           $this->saveFollowObjectForNotificationsFromGroupAndSubGroup($obj);
                                        }
                                    }
                                } else if ($obj->CategoryType == 7) {
                                    $groupDetails = SubGroupCollection::model()->getSubGroupDetailsById($obj->GroupId);
                                    if (!is_string($groupDetails)) {
                                        if (in_array($obj->OriginalUserId, $groupDetails->SubGroupMembers)) {
                                            $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'love');
                                            if (isset($userNotifications->UserId)) {
                                                Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                            } else {
                                                Notifications::model()->saveNotifications($notificationObj);
                                            }
                                        } else {
                                           $this->saveFollowObjectForNotificationsFromGroupAndSubGroup($obj);
                                        }
                                    }
                                } else {
                                    $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'love');
                                    if (isset($userNotifications->UserId)) {
                                        Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                    } else {
                                        Notifications::model()->saveNotifications($notificationObj);
                                    }
                                }
                            } catch (Exception $exc) {
                                echo '_________1 exception__________' . $exc->getMessage();
                            }
                        }
                    }
                }
            }
            if ($obj->ActionType == 'Follow') {
                if ($obj->OriginalUserId != $obj->UserId) {
                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($obj->OriginalUserId);

                    if ($userSettings != "failure") {
                        if ($userSettings->ActivityFollowed == 1) {

                            try {
                                $notificationObj = new Notifications();
                                $notificationObj->UserId = $obj->OriginalUserId;
                                $notificationObj->NotificationNote = 'followed your post';
                                $notificationObj->RecentActivity = 'follow';
                                $notificationObj->PostFollowers = $obj->UserId;
                                $notificationObj->PostId = $obj->PostId;
                                $notificationObj->CategoryType = $obj->CategoryType;
                                $notificationObj->NetworkId = $userSettings->NetworkId;
                                $notificationObj->isRead = 0;
                                $notificationObj->PostType = $obj->PostType;
                                $notificationObj->CreatedOn = $obj->CreatedOn;

                                if ($obj->CategoryType == 3) {
                                    $groupDetails = GroupCollection::model()->getGroupDetailsById($obj->GroupId);
                                    if (!is_string($groupDetails)) {
                                        if (in_array($obj->OriginalUserId, $groupDetails->GroupMembers)) {
                                            $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'follow');
                                            if (isset($userNotifications->UserId)) {
                                                Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                            } else {
                                                Notifications::model()->saveNotifications($notificationObj);
                                            }
                                        } else {
                                           $this->saveFollowObjectForNotificationsFromGroupAndSubGroup($obj);
                                        }
                                    }
                                } else if ($obj->CategoryType == 7) {
                                    $groupDetails = SubGroupCollection::model()->getSubGroupDetailsById($obj->GroupId);
                                    if (!is_string($groupDetails)) {
                                        if (in_array($obj->OriginalUserId, $groupDetails->SubGroupMembers)) {
                                            $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'follow');
                                            if (isset($userNotifications->UserId)) {
                                                Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                            } else {
                                                Notifications::model()->saveNotifications($notificationObj);
                                            }
                                        } else {

                                           $this->saveFollowObjectForNotificationsFromGroupAndSubGroup($obj);
                                        }
                                    }
                                } else {
                                    $userNotifications = Notifications::model()->getNotificationsForUserWithPost($obj->OriginalUserId, $obj->PostId, $userSettings->NetworkId, $obj->CategoryType, 'follow');
                                    if (isset($userNotifications->UserId)) {
                                        Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                                    } else {
                                        Notifications::model()->saveNotifications($notificationObj);
                                    }
                                }
                            } catch (Exception $exc) {
                                echo '_________1 exception__________' . $exc->getMessage();
                            }
                        }
                    }
                }
            }
            if ($obj->ActionType == 'UserFollow') {

                $userSettings = UserNotificationSettingsCollection::model()->getUserSettings((int) $obj->UserFollowers);
                if ($userSettings != "failure") {
                    if ($userSettings->UserFollowers == 1) {
                        try {
                            $notificationObj = new Notifications();
                            $notificationObj->UserId = $obj->UserFollowers;
                            $notificationObj->NotificationNote = 'followed you';
                            $notificationObj->RecentActivity = 'UserFollow';
                            $notificationObj->NewFollowers = $obj->UserId;
                            $notificationObj->NetworkId = $userSettings->NetworkId;
                            $notificationObj->isRead = 0;
                            $notificationObj->PostType = $obj->PostType;
                            $notificationObj->CreatedOn = $obj->CreatedOn;
                            $userNotifications = Notifications::model()->getUserNotificationForFollower((int) $obj->UserFollowers, 'UserFollow');
                            if (isset($userNotifications->UserId)) {
                                Notifications::model()->updateNotificationsForUser($userNotifications->_id, $obj->ActionType, $notificationObj);
                            } else {
                                Notifications::model()->saveNotifications($notificationObj);
                            }
                        } catch (Exception $exc) {
                            echo '_________1 exception__________' . $exc->getMessage();
                        }
                    }
                }
            }
        } catch (Exception $exc) {
            echo '_________1 exception NOTification__________' . $exc->getMessage();
        }
    }

    /**
     * @author suresh reddy
     * @Description Updating Post management actions
     * @param type $obj
     */
     function updateIsEngage($userId, $postId) {
        try {
            FollowObjectStream::model()->updateIsEngage($userId, $postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar Pathapelli
     * @Description Updating Comment management actions
     * @param type $obj
     */
    public  function updateCommentManagementActions($obj) {
        try {
            UserStreamCollection::model()->updateCommentManagementActions($obj);
            UserActivityCollection::model()->updateCommentManagementActions($obj);
            UserInteractionCollection::model()->updateCommentManagementActions($obj);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public  function modifyDate() {
        //  $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
//         $criteria = new EMongoCriteria;  
//          $modifier = new EMongoModifier;
//          $criteria->UserId = (int)1;
//        $criteria->addCond('pageIndex','in',array((int)9));
//         $allposts = UserInteractionCollection::model()->findAll($criteria);  
//         error_log("- modifyDate ------------------".count($allposts));
//        // $criteria = new EMongoCriteria;  
//         foreach ($allposts as $value) {
//           // error_log("value------".date('Y-m-d', $value['CreatedOn']->sec) );
//             $modifier->addModifier('CreatedOn', 'set', new MongoDate(time()));
//         $modifier->addModifier('CreatedDate', 'set', date('Y-m-d', time()));
//        $criteria->addCond('_id', '==', $value['_id']);
//         $value->updateAll($modifier,$criteria);  
//         }
    }

    public  function modifyGroupCollectionDate() {
        //  $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
        $criteria = new EMongoCriteria;
        $modifier = new EMongoModifier;
        //$criteria->UserId = (int)1;
        // $criteria->addCond('pageIndex','in',array((int)9));
        $allposts = GroupPostCollection::model()->findAll($criteria);
        error_log("- modifyDate ------------------" . count($allposts));
        // $criteria = new EMongoCriteria;  
        foreach ($allposts as $value) {
            // error_log("value------".date('Y-m-d', $value['CreatedOn']->sec) );
            // $modifier->addModifier('CreatedOn', 'set', new MongoDate(time()));
            $modifier->addModifier('CreatedDate', 'set', date('Y-m-d', $value['CreatedOn']->sec));
            $criteria->addCond('_id', '==', $value['_id']);
            $value->updateAll($modifier, $criteria);
        }
    }

    /**
     * @author Vamsi Krishna
     * Description : this method is used to save the Follow object Stream 
     * if the user posted or performaed any activity and unfollowed the Group or SubGroup
     * Then we do not send them the notifications but we will show them a derivative object 
     * 
     * @param type $obj
     */
    public  function saveFollowObjectForNotificationsFromGroupAndSubGroup($obj) {
        try {

            $streamObj = FollowObjectStream::model()->getStreamObjbyPostId(new MongoId($obj->PostId), (int) $obj->OriginalUserId, (int) $obj->FollowEntity);

            if (isset($streamObj->UserId)) {
                $obj->Priority = $streamObj->Priority;
                FollowObjectStream::model()->updateStreamObject($obj, $streamObj->_id, $obj->OriginalUserId, $obj->ActionType);
            } else {
                $obj->StreamUserId = $obj->OriginalUserId;
                $obj->Priority = (int) 1;
                FollowObjectStream::model()->saveFollowObjectStream($obj);
            }
        } catch (Exception $exc) {
            
        }
    }

    public  function upateNewsToNotifyInStream($obj) {
        try {
            UserStreamCollection::model()->updatePostManagementActions($obj);
            FollowObjectStream::model()->updatePostManagementActions($obj);
            UserActivityCollection::model()->updatePostManagementActions($obj);
            UserInteractionCollection::model()->updatePostManagementActions($obj);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public  function groupAutoFollow($obj) {
        try {
            $users = UserCollection::model()->getAllUsersIds();
            if (!is_string($users)) {
                foreach ($users as $user) {
                    $returnValue = GroupCollection::model()->followOrUnfollowGroup($obj->GroupId, $user->UserId, "Follow");
                    $returnValue = UserProfileCollection::model()->followOrUnfollowGroup($obj->GroupId, $user->UserId, "Follow");
                }
            }
        } catch (Exception $exc) {
            
        }
    }

    /**
     * @author Suresh 
     * @usage  game suspend, and previous game scheduleid, previous  players count need to update
     * 
     */
    public  function suspendOrReleaseGame($obj) {
        try {
            $returnValue = UserStreamCollection::model()->suspendorReleaseGame($obj);
            $returnValue = FollowObjectStream::model()->suspendorReleaseGame($obj);
            $returnValue = UserActivityCollection::model()->suspendorReleaseGame($obj);

            NewsCollection::model()->updateNewsCollection($obj->PostId, $obj->CategoryType, $obj->ActionType);
        } catch (Exception $exc) {
            echo "exception " . $exc->getMessage();
        }
    }

    /**
     * @author M Vamsi KRishna
     * @usage  This game is used whemn the game is scheduled
     * 
     */
    public  function ScheduleGame($obj) {
        try {
            if ($obj->RecentActivity == 'streamTotalUpdate') {
                $returnValue = UserStreamCollection::model()->updateStreamForGameSchedule($obj);
                $returnValue = FollowObjectStream::model()->updateStreamForGameSchedule($obj);
                $returnValue = UserActivityCollection::model()->updateStreamForGameSchedule($obj);
            } else if ($obj->RecentActivity == 'streamPartialUpdate') {
                $returnValue = UserStreamCollection::model()->updatePartialUserStreamForGame($obj);
                $returnValue = FollowObjectStream::model()->updatePartialUserStreamForGame($obj);
                $returnValue = UserActivityCollection::model()->updatePartialUserStreamForGame($obj);
            }
        } catch (Exception $exc) {
            echo "exception " . $exc->getMessage();
        }
    }

}
