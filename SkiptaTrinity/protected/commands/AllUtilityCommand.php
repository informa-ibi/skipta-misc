<?php

/**
 * @author Reddy
 * @class 
 */
class AllUtilityCommand extends CConsoleCommand {

    public function actionRemoveGroups($postId = '', $searchKey = '',$id='') {


        try {
            echo $postId . "***********" . $searchKey;
            $criteria = new EMongoCriteria;
            $criteria1 = new EMongoCriteria;
            $criteria2 = new EMongoCriteria;
            $GroupId = '';
 
            if($id!='')
            {
                $criteria->addCond('_id', '==', new MongoId($id));
            }
            if ($searchKey != '') {
                
                $criteria->GroupName = new MongoRegex('/' . $searchKey . '.*/i');
            }

            if ($postId != '') {
                $postId = $postId;
                $criteria->addCond('_id', '==', new MongoId($postId));
            }

            $data = GroupCollection::model()->findAll($criteria);



            foreach ($data as $obj) {

                $GroupId = $obj->_id;
                $displayNameArray = explode(" ", $obj->GroupName);

                echo $obj->GroupName . '______' . $GroupId;

                for ($i = 0; $i < sizeof($obj->GroupMembers); $i++) {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier;
                    $userId = $obj->GroupMembers[$i];
                    $mongoCriteria->addCond('UserId', '==', (int) $userId);
                    $mongoModifier->addModifier('groupsFollowing', 'pop', $obj->_id);
                    UserProfileCollection::model()->updateAll($mongoModifier, $mongoCriteria);
                }
            }
            /* Criteria for Deleting Group from Group collections */
            $criteria1->addCond('GroupId', '==', $GroupId);

            /* Criteria for Deleting Group related stuff from all the collections */
            $criteria2->addCond('_id', '==', $GroupId);
            UserInteractionCollection::model()->deleteAll($criteria1);
            UserActivityCollection::model()->deleteAll($criteria1);
            UserStreamCollection::model()->deleteAll($criteria1);
            FollowObjectStream::model()->deleteAll($criteria1);
            GroupPostCollection::model()->deleteAll($criteria1);
            GroupCollection::model()->deleteAll($criteria2);
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }

    public function actionUpdateStreamGroupPost($postId) {
        $criteria = new EMongoCriteria;
        $criteria->addCond('_id', '==', new MongoId($postId));
        $data = GroupPostCollection::model()->find($criteria);
        echo $data->GroupId;
        CommonUtility::prepareStreamObject((int) $data->UserId, 'Post', $postId, (int) 3, '', '', '');
    }
    
    public function actionUpdateStreamCurbsidePost($postId) {
        $criteria = new EMongoCriteria;
        $criteria->addCond('_id', '==', new MongoId($postId));
        $data = CurbsidePostCollection::model()->find($criteria);
        echo $data->_id;
        CommonUtility::prepareStreamObject((int) $data->UserId, 'Post', $postId, (int) 2, '', '', '');
    }

    public function actionUpdateStreamGames() {
        
    }

    public function actionUpdateUniqueHandles() {
        
    }

    public function actionMakeGroupAdmin() {
        try {

            //  $criteria->GroupName = new MongoRegex('/' . $searchKey . '.*/i');
            $data = GroupCollection::model()->findAll();

            foreach ($data as $obj) {

                echo $obj->GroupName . '______';


                $mongoCriteria = new EMongoCriteria;
                $mongoModifier = new EMongoModifier;
                if (isset(YII::app()->params['NetworkAdminEmail'])) {
                    $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(YII::app()->params['NetworkAdminEmail'], 'Email');
                    $mongoModifier->addModifier('GroupAdminUsers', 'push', (int) $netwokAdminObj->UserId);
                    $mongoCriteria->addCond('GroupAdminUsers', '!=', (int) $netwokAdminObj->UserId);
                    $mongoModifier->addModifier('CreatedUserId', 'set', (int) $netwokAdminObj->UserId);
                }
                $mongoCriteria->addCond('_id', '==', $obj->_id);

                $return = GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage() . $exc->getLine();
        }
    }

    /* This method will Mark the User as the Admin for the Given Group and Auto Follow the Group */

    public function actionMakeGroupAdminGivenUser($userId = '', $groupName = '') {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->GroupName = new MongoRegex('/' . $groupName . '/i');
            $data = GroupCollection::model()->findAll($mongoCriteria);
            $mongoCriteriaG = new EMongoCriteria;
            $mongoModifierG = new EMongoModifier;

            $mongoCriteriaGM = new EMongoCriteria;
            $mongoModifierGM = new EMongoModifier;

            $mongoCriteriaU = new EMongoCriteria;
            $mongoModifierU = new EMongoModifier;

            $mongoCriteriaUG = new EMongoCriteria;


            if ($userId != '' && $groupName != '') {
                foreach ($data as $obj) {

                    echo $obj->GroupName . '______';

                    $netwokAdminObj = User::model()->getUserDetailsByUserId($userId);
                    $mongoCriteriaUG->addCond('GroupMembers', '==', (int) $netwokAdminObj->UserId);
                    $mongoCriteriaUG->addCond('_id', '==', $obj->_id);
                    $userIsAMemberOfGroup = GroupCollection::model()->find($mongoCriteriaUG);
                    if (is_object($userIsAMemberOfGroup)) {
                        echo "I am following this group, so just make me the admin";

                        $mongoModifierG->addModifier('GroupAdminUsers', 'push', (int) $netwokAdminObj->UserId);
                        $mongoCriteriaG->addCond('GroupAdminUsers', '!=', (int) $netwokAdminObj->UserId);
                        $mongoCriteriaG->addCond('_id', '==', $obj->_id);
                        $return = GroupCollection::model()->updateAll($mongoModifierG, $mongoCriteriaG);
                    } else {
                        echo "I am ! following this group, make me the admin and auto-follow";

                        $mongoModifierG->addModifier('GroupAdminUsers', 'push', (int) $netwokAdminObj->UserId);
                        $mongoCriteriaG->addCond('GroupAdminUsers', '!=', (int) $netwokAdminObj->UserId);
                        $mongoCriteriaG->addCond('_id', '==', $obj->_id);
                        $returnG = GroupCollection::model()->updateAll($mongoModifierG, $mongoCriteriaG);

                        $mongoModifierGM->addModifier('GroupMembers', 'push', (int) $netwokAdminObj->UserId);
                        $mongoCriteriaGM->addCond('GroupMembers', '!=', (int) $netwokAdminObj->UserId);
                        $mongoCriteriaGM->addCond('_id', '==', $obj->_id);
                        $returnGM = GroupCollection::model()->updateAll($mongoModifierGM, $mongoCriteriaGM);

                        $mongoModifierU->addModifier('groupsFollowing', 'push', new MongoId($obj->_id));
                        $mongoCriteriaU->addCond('groupsFollowing', '!=', new MongoId($obj->_id));
                        $mongoCriteriaU->addCond('userId', '==', (int) $netwokAdminObj->UserId);
                        $returnU = UserProfileCollection::model()->updateAll($mongoModifierU, $mongoCriteriaU);
                    }
                }
            } else {
                echo "No supply to run.";
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage() . $exc->getLine();
        }
    }

    /* This method will Clean up the inconsistencies between the following groups of a users */

    public function actionCleanUpUnMatchedGroupsFromUserProfile($userId = '') {
        try {
            $mongoCriteriaG = new EMongoCriteria;
            $mongoModifierU = new EMongoModifier;
            $mongoCriteriaU = new EMongoCriteria;
            $mongoCriteriaInitialU = new EMongoCriteria;
            if ($userId != '') {
                $mongoCriteriaInitialU->userId = (int) $userId;
                $userData = UserProfileCollection::model()->findAll($mongoCriteriaInitialU);
            } else {
                $userData = UserProfileCollection::model()->findAll();
            }

            foreach ($userData as $userIndividualData) {

                foreach ($userIndividualData->groupsFollowing as $groupFData) {
                    $mongoCriteriaG->addCond('_id', '==', new MongoId($groupFData));
                    $data = GroupCollection::model()->find($mongoCriteriaG);

                    if (is_object($data)) {
                        echo "\n" . $userIndividualData->userId . "\n";
                        echo "\n" . $data->GroupName . "\n";
                        continue;
                    } else {
                        echo "\n" . "I am removed" . $groupFData . "\n";
                        $mongoModifierU->addModifier('groupsFollowing', 'pull', new MongoId($groupFData));
                        $mongoCriteriaU->addCond('userId', '==', (int) $userIndividualData->userId);
                        $data = UserProfileCollection::model()->updateAll($mongoModifierU, $mongoCriteriaU);
                    }
                }
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage() . $exc->getLine();
        }
    }

    public function actionFixAllPostResource($typeOfPost = '') {
        $mongoCriteriaRC = new EMongoCriteria;
        $mongoModifierRC = new EMongoModifier;
        $mongoCriteriaPC = new EMongoCriteria;
        $mongoModifierPC = new EMongoModifier;
        $model = '';
        $postData = '';
        $ResourceArray = array();

        if ($typeOfPost == 'post') {
            $postData = PostCollection::model()->findAll($mongoCriteriaPC);
        } else if ($typeOfPost == 'curbside') {
            $postData = CurbsidePostCollection::model()->findAll($mongoCriteriaPC);
        } else if ($typeOfPost == 'group') {
            $postData = GroupPostCollection::model()->findAll($mongoCriteriaPC);
        }

        if (is_array($postData) && !empty($postData)) {


            foreach ($postData as $postIndData) {
                echo $postIndData->_id . "\n";

                $mongoCriteriaRC->addCond('PostId', '==', new MongoId($postIndData->_id));
                $ResourseData = ResourceCollection::model()->findAll($mongoCriteriaRC);
                if (is_array($ResourseData)) {
                    foreach ($ResourseData as $ResourseIndData) {
                        array_push($ResourceArray, $ResourseIndData->attributes);
                    }
                    $mongoModifierPC->addModifier('Resource', 'set', $ResourceArray);
                    $mongoCriteriaPC->addCond('_id', '==', new MongoId($postIndData->_id));

                    if ($typeOfPost == 'post') {
                        $postData = PostCollection::model()->updateAll($mongoModifierPC,$mongoCriteriaPC);
                    } else if ($typeOfPost == 'curbside') {
                        $postData = CurbsidePostCollection::model()->updateAll($mongoModifierPC,$mongoCriteriaPC);
                    } else if ($typeOfPost == 'group') {
                        $postData = GroupPostCollection::model()->updateAll($mongoModifierPC,$mongoCriteriaPC);
                    }
                    $ResourceArray = array();
                }
                
            }
        } else {
            echo "Sorry We can't process $typeOfPost this action!";
        }
    }
    
    function actionRestartNodeServices() {
            
        $networkName = Yii::app()->params['WebrootPath'];
        $networkName = explode("/", $networkName);
        $networkName = $networkName[5];
        echo $networkName."\n";
        $ququeName = substr($networkName, 1);
        $firstChar = substr($networkName, 0, 1);
        $ququeName = "[" . $firstChar . "]" . $ququeName;    
            
        echo shell_exec("kill  $(ps -ef | grep '/opt/softwares/node/".$networkName."' | grep -v grep | awk '{print $2}')");
        echo "Proxy Node Not Running";
        $date = date("Y-m-d-H-i");
        $f1 = "/data/logs/node/" . $networkName ;
        if (!file_exists($f1)) {
            mkdir($f1, 0755, true);
        }
       
        $f1 = "/data/logs/node/" . $networkName . "/ProxyNode";
        if (!file_exists($f1)) {
            mkdir($f1, 0755, true);
        }
        $f1 = "/data/logs/node/" . $networkName . "/Chat";
        if (!file_exists($f1)) {
            mkdir($f1, 0755, true);
        }
        $f1 = "/data/logs/node/" . $networkName . "/Post";
        if (!file_exists($f1)) {
            mkdir($f1, 0755, true);
        }
        $f1 = "/data/logs/node/" . $networkName . "/Search";
        if (!file_exists($f1)) {
            mkdir($f1, 0755, true);
        }
        $f1 = "/data/logs/node/" . $networkName . "/Notification";
        if (!file_exists($f1)) {
            mkdir($f1, 0755, true);
        }
        shell_exec("touch /data/logs/node/" . $networkName . "/ProxyNode/" . $date . ".log");
        shell_exec("touch /data/logs/node/" . $networkName . "/Chat/" . $date . ".log");
        shell_exec("touch /data/logs/node/" . $networkName . "/Post/" . $date . ".log");
        shell_exec("touch /data/logs/node/" . $networkName . "/Search/" . $date . ".log");
        shell_exec("touch /data/logs/node/" . $networkName . "/Notification/" . $date . ".log");
        shell_exec("touch /data/logs/amqp/" . $networkName . "/" . $date . ".log");
        chdir("/opt/softwares/node/$networkName");
        shell_exec("nohup /usr/local/bin/node /opt/softwares/node/".$networkName."/proxyNode.js > /data/logs/node/" . $networkName . "/ProxyNode/" . $date . ".log & ");
        shell_exec("nohup /usr/local/bin/node /opt/softwares/node/".$networkName."/chat.js > /data/logs/node/" . $networkName . "/Chat/" . $date . ".log & ");
        shell_exec("nohup /usr/local/bin/node /opt/softwares/node/".$networkName."/search.js > /data/logs/node/" . $networkName . "/Search/" . $date . ".log & ");
        shell_exec("nohup /usr/local/bin/node /opt/softwares/node/".$networkName."/posts.js > /data/logs/node/" . $networkName . "/Post/" . $date . ".log & ");
        shell_exec("nohup /usr/local/bin/node /opt/softwares/node/".$networkName."/notification.js > /data/logs/node/" . $networkName . "/Notification/" . $date . ".log &");
        shell_exec(exit());
        }
  public function actionupdateNotificationMentions(){
       try {
            $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;
             $mongoCriteria->addCond('RecentActivity', '==', 'mention');
           $notifications=Notifications::model()->findAll($mongoCriteria);
           if(count($notifications)>0){
              foreach ($notifications as $notification){
                $mongoCriteriaIL = new EMongoCriteria;
                $mongoModifierIL = new EMongoModifier;
                if($notification['MentionedUserId']!=null){
                    $notiArray=array();
                    echo '__inside not null_'.$notification['MentionedUserId'];
                    array_push($notiArray,(int)$notification['MentionedUserId']);
                    $mongoModifierIL->addModifier('MentionedUserId','set',$notiArray);                    
                    $mongoCriteriaIL->addCond('_id', '==', $notification['_id']);
                    Notifications::model()->updateAll($mongoModifierIL,$mongoCriteriaIL);
                }else{
                    echo '__inside  null***_';
                    $notiArray=array();                    
                    $mongoModifierIL->addModifier('MentionedUserId','set',$notiArray);
                    $mongoCriteriaIL->addCond('_id', '==', $notification['_id']);
                    Notifications::model()->updateAll($mongoModifierIL,$mongoCriteriaIL);
                }
                
             }     
           }
          
       } catch (Exception $exc) {
           echo $exc->getMessage();
       }
      }
      /**
       * 
       * @param type $hecArray
       */
      
       public function actionProcessHecJob($hecArray) {
        try {
          
            $val=  urldecode($hecArray);
            $data=  json_decode($val);
//            echo "eeeeeeeeeeeeee2eeeeee".print_r($data,true);
            $return = Careers::model()->saveHecJobs($data);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function actionSampleTest($va){
        error_log("===value of v====$v");
    }
    
    public function actionGroupURLFormation(){
        try{
            error_log("Please wait...");
            $groups = GroupCollection::model()->getAllGroupIds();
            error_log("\nTotal Group(s): ".sizeof($groups));
            foreach($groups as $group){                
                if(!empty($group->GroupName)){                    
//                    $urlformation = str_replace(" ",".",$group->GroupName);
                    $urlformation = preg_replace('/[^\p{L}\p{N}]/u', '', str_replace(" ","",$group->GroupName));
                    $groups_new = GroupCollection::model()->getAllGroupIds();
                    $urlmatch = 0;
                    foreach($groups_new as $rw){
                        if($urlformation == $rw->GroupUniqueName){ 
                            $urlmatch = 1;                            
                        }
                        if($urlmatch == 1){
                            $urlformation = $urlformation.rand(1, 4);
                        }
                    }
                    error_log("\nGroupName ================== $group->GroupName \nGroupUniqueName ============ $urlformation");
                    $updatestatus = GroupCollection::model()->updateGroupUniqueName($group->_id,$urlformation);
                    if($updatestatus == "success")
                        error_log("GroupUniqueName has been updated.\n");
                    else
                        error_log("Error: GroupUniqueName failed to updated.\n");
                    
                }
            }
            error_log("##########################################END Groups Process###################################################");
            $groups = SubGroupCollection::model()->getAllSubGroupIds();
            error_log("\nTotal SubGroup(s): ".sizeof($groups));
            foreach($groups as $group){                
                if(!empty($group->SubGroupName)){                    
//                    $urlformation = str_replace(" ",".",$group->GroupName);
                    $urlformation = preg_replace('/[^\p{L}\p{N}]/u', '', str_replace(" ","",$group->SubGroupName));
                    $groups_new = SubGroupCollection::model()->getAllSubGroupIds();
                    $urlmatch = 0;
                    foreach($groups_new as $rw){
                        if($urlformation == $rw->SubGroupUniqueName){ 
                            $urlmatch = 1;                            
                        }
                        if($urlmatch == 1){
                            $urlformation = $urlformation.rand(1, 4);
                        }
                    }
                    error_log("\nSubGroupName ================== $group->SubGroupName \nSubGroupUniqueName ============ $urlformation");
                    $updatestatus = SubGroupCollection::model()->updateSubGroupUniqueName($group->_id,$urlformation);
                    if($updatestatus == "success")
                        error_log("SubGroupUniqueName has been updated.\n");
                    else
                        error_log("Error: SubGroupUniqueName failed to updated.\n");
                    
                }
            }
            error_log("##########################################END SubGroups Process###################################################");
        } catch (Exception $ex) {
            error_log("#######Exception Occurred while running the actionGroupURLFormation ##########".$ex->getMessage());
        }
    }

    public function actionUpdateFeaturedItemsSocialCount() {
        try{
            
           $featuredItemsCount = NewsCollection::model()->getTotalFeaturedItems();
            if ($featuredItemsCount >= 10) {
                $featuredItems = NewsCollection::model()->getTotalFeaturedItemsList();

                for ($i = sizeof($featuredItems); $i > 10; $i--) {
                    ServiceFactory::getSkiptaPostServiceInstance()->updatePostAsUnFeatured('', $featuredItems[($i - 1)]['PostId'], $featuredItems[($i - 1)]['CategoryType'], $featuredItems[($i - 1)]['NetworkId']);
                }
            }



            $featuredItems=NewsCollection::model()->getTotalFeaturedItemsList();
            foreach($featuredItems as $featuredItem){
                 $postId=$featuredItem->PostId;
                 $categoryId=$featuredItem->CategoryType;
                 if ((int) $categoryId == 2) {
                    $postObj = CurbsidePostCollection::model()->getPostById($postId);
                } else if ((int) $categoryId == 8) {
                    $postObj = CuratedNewsCollection::model()->getPostById($postId);
                } else if ((int) $categoryId == 9) {
                    $postObj = GameCollection::model()->getPostById($postId);
                } else {
                    $postObj = PostCollection::model()->getPostById($postId);
                }
                if (isset($postObj)) {
                   // error_log(print_r($postObj, true));
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier;
                    $mongoCriteria->addCond('PostId', '==', new MongoID($postId));
                    $mongoCriteria->addCond('CategoryType', '==', (int) $categoryId);
                    $mongoModifier->addModifier('LoveCount', 'set', (int) count($postObj->Love));
                    $mongoModifier->addModifier('InviteCount', 'set', (int) count($postObj->Invite));
                    $sharecount=isset($postObj->Share)?count(isset($postObj->Share)):0;
                    $mongoModifier->addModifier('ShareCount', 'set', (int) $sharecount);
                    $mongoModifier->addModifier('FollowCount', 'set', (int) count($postObj->Followers));
                    $mongoModifier->addModifier('CommentCount', 'set', (int) count($postObj->Comments));
                    NewsCollection::model()->updateAll($mongoModifier, $mongoCriteria);
                }
            }
            
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    public function actionUpdateExistingNotificationsOfTypesPost() {
        try{ 
           $posts = Notifications::model()->getAllNotificationsByRecentActivity("post");
           if(!is_string($posts) && count($posts)>0){
               foreach ($posts as $post) {
                   $notificationNote = $post["NotificationNote"];
                   $categoryType = (int)$post["CategoryType"];
                   $notificationId = (string)$post["_id"];
                   if($categoryType==2){
                        $pieces = explode(" posted a curbside consult using a ", $notificationNote);
                        if(count($pieces)>1){
                            $curbsideCategory = explode(" that you are following.", $pieces[1]);
                            $curbsideCategory = $curbsideCategory[0];
                            echo "curbsideCategory=======$curbsideCategory==========$notificationId\n";
                            Notifications::model()->updateNotificationWithHashTagOrCurbsideCategory($notificationId, "", $curbsideCategory);
                        }
                   }else{
                       $pieces = explode(" made a post using a ", $notificationNote);
                       if(count($pieces)>1){
                            $hashtag = explode(" ", $pieces[1]);
                            $hashtag = substr($hashtag[0], 1);//removing #
                            echo "hashtag=======$hashtag==========$notificationId\n";
                            Notifications::model()->updateNotificationWithHashTagOrCurbsideCategory($notificationId, $hashtag);
                       }
                   }
               }
           }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    public function actionRemoveOldNewsObjectsFromSystem(){
        try{
            $daysOrMonths = '-2 months';
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->CategoryType('==', 8);
            $mongoCriteria->Released('==', 1);
            $mongoCriteria->OriginalPostTime('lessEq', new MongoDate(strtotime($daysOrMonths)));
            $mongoCriteria->LoveCount('==', 0);
            $mongoCriteria->CommentCount('==', 0);
            $mongoCriteria->FollowCount('==', 1);
            $mongoCriteria->InviteCount('==', 0);
            $mongoCriteria->IsPromoted('==', 0);
            $mongoCriteria->IsDeleted('==', 0);
               
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'criteria' => $mongoCriteria
            ));
            if ($provider->getTotalItemCount() >= 0) {
                $postIds = array();
                foreach ($provider->getData() as $data) {
                    $postId = (string)$data->PostId;
                    array_push($postIds, new MongoId($postId));
                }
                if(count($postIds)>0){
                    UserStreamCollection::model()->activeOrInactiveOldNewsObjects(array_values($postIds), 2);
                }
            }
        }catch(Exception $ex){
            echo "==AllUtility===RemoveOldNewsObjectsFromSystem===".$exc->getMessage();
        }
    }
    
    public function actionUpdateSubspecialityStringWithId(){
      CustomField::model()->updatePrimaryAffiliationWithId();
    }
    
    
    public  function actionUpdateCompletedPromotedPostsFlag()
    {
        try
        {
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;
             $mongoCriteria->addCond('IsPromoted', '==', (int)1);
             $startDate = date('Y-m-d');
           
              $startDate = trim($startDate) . " 00:00:00";
              $mongoCriteria->addCond("CreatedOn", "<", new MongoDate(strtotime($startDate)));
             $mongoModifier->addModifier('IsPromoted', 'set', (int) 0);
              UserStreamCollection::model()->updateAll($mongoModifier,$mongoCriteria);
          
            
        } catch (Exception $exc) {
                echo $exc->getMessage();
        }
    }
    
    public function actionrunCommandforUpdateAndRelease() {
        try {
            $db = UserStreamCollection::model()->getDb();
            $collection = $db->selectCollection('system.js');

            $proccode = 'function releaseSubDocumentForSuspendedUsers(userId,
  collectionName) {
    var collectionObj=db.getCollection(collectionName);
    collectionObj.find({
      "Comments" : { $elemMatch:{"UserId":NumberInt(userId),
"IsAbused":NumberInt(3)
        }}
    }).forEach( function(article) {
      for(var i in article.Comments){
        if(article.Comments[i        
        ].UserId==NumberInt(userId)){
    article.Comments[i         
          ].IsAbused=NumberInt(0)}
       collectionObj.save(article);} 
    
    }); return "success"
  }';

            $collection->save(
                    array(
                        '_id' => 'releaseSubDocumentForSuspendedUsers',
                        'value' => new MongoCode($proccode),
            ));
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
    
    public function actionPushNotificationsToSurveyAbandonedUsers(){
        try{
            $this->GetAllSystemNotificaitonsForClosedSchedulesAndUpdateAsRead();
            $mongoCriteria = new EMongoCriteria;                           
            $mongoCriteria->addCond('IsCurrentSchedule', '==', (int) 1);
//            $mongoCriteria->addCond("MaxSpots", "!=", (int)0);
            $mongoCriteria->select(array("_id","SurveyTitle","ResumeUsers","MaxSpots","SurveyId","SurveyRelatedGroupName"));
            $scheduleArray = ScheduleSurveyCollection::model()->findAll($mongoCriteria);
            error_log("Sending abandoned notification process started, please be patient ....");
            if(is_array($scheduleArray) && sizeof($scheduleArray) > 0){
                $pendingUsers = array();
                $i = 0;
                foreach($scheduleArray as $schedule){
                    $isSpotsAvailable = 0; // 0 = spots are not available...                    
                    if($schedule->MaxSpots > 0){
                        $surveyObject = ExtendedSurveyCollection::model()->getSurveyDetailsById('Id',$schedule->SurveyId);
                        $isSpotsAvailable = SurveyUsersSessionCollection::model()->checkSpotExist($schedule->SurveyId,"",$schedule);  
                        if($surveyObject->IsEnableNotification == 1 &&  sizeof($schedule->ResumeUsers) > 0 && $isSpotsAvailable > 0){   
                        //error_log("===$isSpotsAvailable===surveyRelatedGro===$schedule->SurveyRelatedGroupName====".print_r($schedule->ResumeUsers,1));
                            foreach($schedule->ResumeUsers as $userId){    
                                if($userId != 0){
                                    $pendingUsers[$i]['UserId'] = $userId;     
                                    $http = Yii::app()->params['ServerURL'];
                                    $url = "<a href='$http/marketresearchview/1/$schedule->SurveyRelatedGroupName'><b>$schedule->SurveyTitle</b></a>";
                                    //$pendingUsers[$i]['Url'] = "<a href='$url'>$surveyObject->SurveyTitle</a>";
                                    $name = "System";
                                    /*
                                    * 1: Admin generated 
                                    * 2: System generated
                                    * 3: Application generated
                                    */
                                    $nTypeIndex = CommonUtility::getNotificationTypeByName($name);
                                    $pendingUsers[$i]['NType'] = $nTypeIndex;
                                    $pendingUsers[$i]['CategoryType'] = CommonUtility::getIndexBySystemCategoryType("SystemNotification");
                                    $pendingUsers[$i]['PostType'] = CommonUtility::sendPostType("SystemNotification");
                                    $pendingUsers[$i]['PostId'] = $schedule->SurveyId;
                                    $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userId);  
    //                                error_log("=user $userId==tinyUserCollection====".print_r($tinyUserCollectionObj,1));
                                    $segmentId = isset($tinyUserCollectionObj['SegmentId'])?$tinyUserCollectionObj['SegmentId']:0;
                                    $pendingUsers[$i]['SegmentId'] = $segmentId;
                                    $pendingUsers[$i]['Language'] = $tinyUserCollectionObj['Language'];
                                    $pendingUsers[$i]['NetworkId'] = $tinyUserCollectionObj['NetworkId'];
                                    $pendingUsers[$i]['NotificationNote'] = $url;
                                    $pendingUsers[$i]['RecentActivity'] = "Survey";
                                }
                                $i++;
                            }                           
                        }else{
                            error_log("############# Notifications settings is not enabled to this bundle '$schedule->SurveyRelatedGroupName' or Spots are not available ($isSpotsAvailable) or no Resume users #################");
                        }
                    }else{
                        error_log("############# Spots are not available to this bundle '$schedule->SurveyRelatedGroupName' #################");
                    }  
                                        
                }
                if(!empty($pendingUsers)){                    
                    
                    CommonUtility::sendNotificationsToUsers($pendingUsers);
                }
                //error_log("Is Spot available ==$isSpotsAvailable===resume user===".print_r($pendingUsers,1));
            }else{
                error_log("############# No survey is available #################");
            }
            
            
        } catch (Exception $ex) {
            error_log("===Exception Occurred while running actionPushNotificationsToSurveyAbandonedUsers===".$ex->getMessage());
        }
    }
    
    /*
     * 
     */
    public function GetAllSystemNotificaitonsForClosedSchedulesAndUpdateAsRead(){
        try{
            $column1 = "NotificationType";
            $column2 = "isRead";
            $value1 = "2";
            $value2 = "0";
            error_log("\nSearching is going on... \nPlease wait...");
            $object = Notifications::model()->getAllSystemNotifications($column1,$column2,$value1,$value2);
            if($object != "failure" && sizeof($object) > 0){
                error_log("\nFound System ".sizeof($object)." Notifications \n");
                foreach($object as $row){
                    error_log("SurveyId = $row->PostId");
                    $obj = ScheduleSurveyCollection::model()->getAllSchedulesBySurveyId($row->PostId);
                    if(sizeof($obj)>0){
                        error_log("\nFound ".sizeof($obj)." Survey(s) in ScheduleCollection... \n");
                        $status = Notifications::model()->deleteSystemNotificaitonById($row->_id);
                        error_log("\nNotification deleted $status for surveyId = $row->PostId... \n");
                    }else{
                       error_log("Survey is currently running and surveyId = $row->PostId"); 
                    }                    
                }
            }else{
              error_log("\nNo Data found");  
            }
        } catch (Exception $ex) {
            error_log("===Exception Occurred while running actionGetAllSystemNotificaitonsForClosedSchedulesAndUpdateAsRead===".$ex->getMessage());
        }
    }


    
     public function actionActivateSurveyToNewlyRegisteredUsers() {
        try {

            $newUsersList = ServiceFactory::getSkiptaUserServiceInstance()->getAllNewUsersEligableForNewUserSurvey(YII::app()->params['NewRegisteredUserSurveyDays']);
            error_log(sizeof($newUsersList) . "===userslistzize======ActivateSurveyToNewlyRegisteredUsers=======1==========" . YII::app()->params['NewRegisteredUserSurveyBundle'] . "=====NewRegisteredUserSurveyDays==" . YII::app()->params['NewRegisteredUserSurveyDays']);
            if (sizeof($newUsersList) > 0) {
                $this->insertNewUserSurvey($newUsersList);
            }
        } catch (Exception $ex) {
            echo "==AllUtility===ActivateSurveyToNewlyRegisteredUsers===" . $exc->getMessage();
        }
    }

    public function insertNewUserSurvey($newUsersList){
        try {
               $scheduleObj = ScheduleSurveyCollection::model()->getCurrentScheduleForNewUser(YII::app()->params['NewRegisteredUserSurveyBundle']);

                if (isset($scheduleObj)) {

                    $asvertisementObj = ServiceFactory::getSkiptaADServiceInstance()->getSurveyAdvertisementByScheduleId($scheduleObj->_id);

                    $advertisementStreamObject = UserStreamCollection::model()->getStreamForAdvertisementByAdvertisementId($asvertisementObj->id);
                    $advertisementStreamObject->IsDeleted = (int) 0;
                    $advertisementStreamObject->IsPromoted = (int) 1;
                    $advertisementStreamObject->CreatedOn = $scheduleObj->EndDate;

                    foreach ($newUsersList as $newUser) {
                        error_log($asvertisementObj->id . "===AdvertisementId===========UserId=====" . $newUser['UserId']);
                        $isStreamExist = UserStreamCollection::model()->getStreamForAdvertisementByAdvertisementId($asvertisementObj->id, (int) $newUser['UserId']);
                        if (!isset($isStreamExist)) {
                            $advertisementStreamObject->_id = new MongoId();
                            $advertisementStreamObject->UserId = (int) $newUser['UserId'];
                            $advertisementStreamObject->save();
                            error_log("===========survey saved =============");
                        }
                    }


                }  
        } catch (Exception $ex) {
             echo "==AllUtility===insertNewUserSurvey===" . $exc->getMessage();
        }
    }
    
    public function actionActivateSurveyToExistingUsers() {
        try {
             
            $usersList = ServiceFactory::getSkiptaUserServiceInstance()->getAllSurveyEligableActiveUsers(YII::app()->params['NewRegisteredUserSurveyDays']);
           error_log(sizeof($usersList) . "===userslistzize======ActivateSurveyToExistingUsers=======1==========" . YII::app()->params['NewRegisteredUserSurveyBundle'] . "=====SurveyDays==" . YII::app()->params['NewRegisteredUserSurveyDays']);
            if (sizeof($usersList) > 0) {
                $this->insertNewUserSurvey($usersList);
            }
        } catch (Exception $ex) {
            echo "==AllUtility===insert survy===" . $ex->getMessage();
        }
    }

    
    public function actionUpdateUserClassfication() {
        try {
            
                  $usersList = ServiceFactory::getSkiptaUserServiceInstance()-> getAllActiveUsers();
    
                if (sizeof($usersList) > 0) {
                    foreach ($usersList as $newUser) {
                      
                    
                        $date1 = date('Y-m-d', strtotime($newUser['RegistredDate']));
                    $currentdate = date('Y-m-d');


                    $d1 = new DateTime($date1);
                    $d2 = new DateTime($currentdate);
                  $classficationType=1;
                    if($d1->diff($d2)->days>60){
                        $classficationType=0;
                      
                    }
                    echo $classficationType;
                      $usersList = ServiceFactory::getSkiptaUserServiceInstance()-> updateClassfication((int)$newUser['UserId'],$classficationType);  
                    
                }
                    }
        } catch (Exception $exc) {
            echo "==AllUtility===insert survy===" . $exc->getMessage();
        }
    }


         public function actionAcheivements() {
        $db = UserStreamCollection::model()->getDb();
        $collection = $db->selectCollection('system.js');
        $proccode = 'function updateUserAchievements(userId,collectionName) {var collectionObj=db.getCollection(collectionName);
    collectionObj.find({"Comments" :{$elemMatch:{"UserId":userId,"IsAbused":NumberInt(0)}}}).forEach( function(article) {for(var i in article.Comments){
    article.Comments[i].IsAbused=NumberInt(3)}
       collectionObj.save(article);}); return "success"}';

        $collection->save(
                array(
                    '_id' => 'updateUserAchievements',
                    'value' => new MongoCode($proccode),
        ));
    }
    
    /**
 * @author Lakshman
 * This method is used to update SurveyTimeSpent with NumberLong   
 */
    public function actionUpdateSurveyTimeSpent() {
        try {
            
            $scheduleObj = SurveyInteractionCollection::model()->updateSurveyTimeSpent();            
        } catch (Exception $ex) {
            echo "==AllUtility===actionUpdateSurveyTimeSpent===" . $exc->getMessage();
        }
    }

}
