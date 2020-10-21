    <?php

/**
 * @author karteek.v
 * @class Ncom(NodeCommuncation)
 */
class NComCommand extends CConsoleCommand {
    
    /**
     * @author Karteek.V
     * @param type $stream post-ids
     * @param type $limit
     * @return type JSON 
     */
    public function actionIndex($stream,$date){
        try{
            $result = array();
            $result = $this->sendToCollectionByCategoryId($stream);
            if(!empty($result))
            echo CJSON::encode($result);
            else {
                echo 0;
            }
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    /**
     * @author Karteek.Vemula
     * @method actionGetNewPosts are used to get latest posts based on the date
     * @param  $date,$userId 
     * @return html if success else 0
     */


    public function actionGetNewPosts($date,$userId,$userTypeId,$postAsNetwork,$timezoneName){

        try{
              $groupsfollowing = ServiceFactory::getSkiptaPostServiceInstance()->getUserFollowingGroupsIDs((int)$userId);
                    array_push($groupsfollowing,'');
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array((int)$userId,0)),
                          'GroupId'=>array('in'=>$groupsfollowing),
                            'IsDeleted'=>array('==' => (int)0),
                            'IsPromoted'=>array('==' => (int)0),
                            'CategoryType'=>array('!=' => (int)7),
                            'IsAbused'=>array('notIn' => array(1,2)),
                            'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                            'RecentActivity' => array('==' =>'Post'),
                            'IsNotifiable' => array('==' => (int)1)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);

            $preparedObject = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,1,$postAsNetwork,$timezoneName);
            
            $preparedObject=(object)($preparedObject->streamPostData);
            
            if(isset($preparedObject) && !empty($preparedObject) && sizeof($provider->getData())>0){
                $controller = new CController('post');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/post/stream_view.php',array("stream"=>$preparedObject),1);
//                foreach($preparedObject as $data){
//                    error_log("=11111111111111111111111==string position===".strpos($resultantPreparedHtml,'id="postitem_'.$data->_id));
//                }
                $obj = array("object"=> $resultantPreparedHtml,"count"=>count((array)$preparedObject));                
                echo CJSON::encode($obj);
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    /**
     * @author Karteek.Vemula
     * @method actionGetLatestPosts  used to get the latest post(which are in top)
     * @param  $userId 
     * @return html if success else 0
     */


    public function actionGetLatestPosts($userId,$userTypeId,$postAsNetwork,$timezoneName){

        try{
           $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>1),
                'criteria' => array( 
                   'conditions'=>array(              
                       'UserId'=>array('in' => array((int)$userId,0)),
                            'IsDeleted'=>array('!=' => 1),
                            'IsPromoted'=>array('==' => 0),
                            'CategoryType'=>array('!=' => (int)7),
                            'IsAbused'=>array('notIn' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post'),
                       'IsNotifiable' => array('==' => 1)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               )); 
//            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserPrivileges($userId);
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);

            error_log("===Timezone from ncom========$timezoneName");
            $preparedObject = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,1,$postAsNetwork,$timezoneName);
            $streamId = 0;
            $preparedObject=(object)($preparedObject->streamPostData);
                if(isset($preparedObject) && !empty($preparedObject)){
                    foreach($preparedObject as $rw){
                        $streamId = $rw->_id;
                    }
                }
            if($provider->getItemCount()>0 && isset($preparedObject) && !empty($preparedObject)){
                $controller = new CController('post');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/post/stream_view.php',array("stream"=>$preparedObject),1);
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData())."_((***&&***))_".$streamId;
            }else{
                echo 0;
            }
          
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    /**
     * @author Karteek.V
     * @param type $stream postids
     * @return type JSON
     */
    public function actionCurbsidePosts($stream){
        try{
            $streamArr = explode(",",$stream);
            $result = CurbsidePostCollection::model()->getPostByIds($streamArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    
    /**
     * @author Karteek.Vemula
     * @method actionGetNewCurbsidePosts are used to get latest posts based on the date
     * @param  $date,$userId 
     * @return html if success else 0
     */

    public function actionGetNewCurbsidePosts($date,$userId,$userTypeId,$timezoneName){
        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }            
           $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',
            array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array($userId,0)),
                       'CategoryType'=>array('=='=>(int) 2),
                       'IsDeleted'=>array('!=' => 1),
                       'IsPromoted'=>array("!="=>1),
                        'IsAbused'=>array('notIn' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post')
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
            ));            
//           $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserPrivileges($userId);
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
            $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,0,$timezoneName);
            $preparedObject=(object)($streamRes->streamPostData);
            if(isset($preparedObject) && !empty($preparedObject) && sizeof($provider->getData())>0){
                $controller = new CController('curbsidePost');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/curbsidePost/curbside_view.php',array("stream"=>$preparedObject),1);
                $obj = array("object"=> $resultantPreparedHtml,"count"=>count((array)$preparedObject));                
                echo CJSON::encode($obj);
                
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    /**
     * @author Karteek.Vemula
     * @method actionGetLatestCurbsidePost are used to get the latest post(which are in top)
     * @param  $userId 
     * @return html if success else 0
     */

    public function actionGetLatestCurbsidePost($userId,$userTypeId,$postAsNetwork,$timezoneName){
        try{
           $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>1),
                'criteria' => array( 
                   'conditions'=>array(                       
                       'UserId'=>array('in' => array($userId,0)),
                       'CategoryType'=>array('=='=>(int) 2),
                       'IsDeleted'=>array('!=' => 1),
                       'IsPromoted'=>array("!="=>1),
                        'IsAbused'=>array('notIn' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post')
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));            
//            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserPrivileges($userId);
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);  
            $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,$postAsNetwork,$timezoneName);
            $preparedObject=(object)($streamRes->streamPostData);
            foreach($preparedObject as $rw){
                $streamId = $rw->_id;
            }
            if(sizeof($provider->getData())>0){
                $controller = new CController('curbsidePost');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/curbsidePost/curbside_view.php',array("stream"=>$preparedObject),1);
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData())."_((***&&***))_".$streamId;
            }else{
                echo 0;
            }
          
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
      /**
     * @author Moin Hussain
     * @method actionProjectSearch
     * @param  ($searchText,$offset,$pageLength,$userSearch,$groupsSearch,$hastagsSearch,$postSearch 
     * @return json
     */
    public function actionProjectSearch($searchText,$offset,$pageLength,$userSearch,$groupsSearch,$subGroupsSearch,$hastagsSearch,$postSearch,$loginUserId,$curbsideCategory){
       try {
           error_log("actionPorjectsearch-----------".$searchText);   
     /* user search start*/
            if($userSearch == true){
            $criteria = new EMongoCriteria();
            $criteria->DisplayName = new MongoRegex('/' . $searchText . '.*/i');
            $criteria->sort("UserId", EMongoCriteria::SORT_DESC);
             $criteria->select(array("DisplayName","UserId","profile70x70","uniqueHandle"));
            $criteria->limit($pageLength);//keep constant
            $criteria->offset($offset);
            $users = UserCollection::model()->findAll($criteria);
            $usersArray = array();
            foreach ($users as $user) {
                
                if(User::model()->checkUserIsActive((int)$user->UserId)){
                  $criteria = new EMongoCriteria();
                 $criteria->userId = (int)$user->UserId;
                $criteria->select(array("userFollowers"));
               $userProfile =  UserProfileCollection::model()->find($criteria);
                $userPost = PostCollection::model()->findAllByAttributes(array("UserId"=>(int)$user->UserId));
                $userPostCount = count($userPost);
                $userCurbPost = CurbsidePostCollection::model()->findAllByAttributes(array("UserId"=>(int)$user->UserId));
                $userCurbPostCount = count($userCurbPost);
                $userPostCount = $userPostCount+$userCurbPostCount;
                array_push($usersArray,array("userId"=>$user->UserId,"displayName"=> $user->DisplayName,"uniqueHandle"=> $user->uniqueHandle,"profilePicture"=> $user->profile70x70,"followersCount"=>count($userProfile->userFollowers),"postCount"=>$userPostCount));
                }
                 }
            }
            /* user search end*/
    
            /* group search start*/
             if($groupsSearch == true){
             $criteria = new EMongoCriteria();
            
//            $criteria->GroupName = new MongoRegex('/' . $searchText . '.*/i');
//             $criteria->IsPrivate= (int)0;
//            $criteria->sort("_id", EMongoCriteria::SORT_DESC);
//              $criteria->select(array("GroupName","GroupProfileImage","PostIds","GroupMembers"));
//            $criteria->limit($pageLength);//keep constant
//            $criteria->offset($offset);
            
             $array = array(
            'conditions' => array(
                'GroupName' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsPrivate'=>array('in' => array(null,(int)0)),
               
              ),
            'select'=>array("GroupName","GroupProfileImage","PostIds","GroupMembers"),
            'sort'=>array('_id'=>EMongoCriteria::SORT_DESC),
            'limit'=>$pageLength,
             'offset'=>$offset
        );
            
            
            $groups1 = GroupCollection::model()->findAll($array);
              $array = array(
            'conditions' => array(
                'GroupName' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsPrivate'=>array('==' => (int)1),
            
                 'GroupMembers'=>array('in' => array((int)$loginUserId)),
              ),
            'select'=>array("GroupName","GroupProfileImage","PostIds","GroupMembers"),
            'sort'=>array('_id'=>EMongoCriteria::SORT_DESC),
            'limit'=>$pageLength,
             'offset'=>$offset
        );
               $groups2 = GroupCollection::model()->findAll($array);
               $groups = array_merge($groups1,$groups2);
             }
             $groupsFinalArray = array();
             
             foreach($groups as $group){
                 $groupObj = new GroupBean();
                 $groupObj->GroupId = $group->_id;
                 $groupObj->GroupName = $group->GroupName;
                 $groupObj->GroupImagesAndVideos = $group->GroupProfileImage;
                 $groupObj->GroupMembersCount = sizeof($group->GroupMembers);
                 $groupObj->GroupPostsCount = sizeof($group->PostIds);
                 array_push($groupsFinalArray, $groupObj);
             }
               /* group search end*/
              /* sub group search start*/
             if($subGroupsSearch == true){
//                $criteria = new EMongoCriteria();
//             $criteria->SubGroupName = new MongoRegex('/' . $searchText . '.*/i');
//            $criteria->sort("_id", EMongoCriteria::SORT_DESC);
//            $criteria->select(array("SubGroupName","SubGroupProfileImage","PostIds","SubGroupMembers"));
//            $criteria->limit($pageLength);//keep constant
//            $criteria->offset($offset);
            
              $array = array(
            'conditions' => array(
                'SubGroupName' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
              
              ),
            'select'=>array("GroupId","SubGroupName","SubGroupProfileImage","PostIds","SubGroupMembers"),
            'sort'=>array('_id'=>EMongoCriteria::SORT_DESC),
            'limit'=>$pageLength,
             'offset'=>$offset
        );
            
            $subGroups = SubGroupCollection::model()->findAll($array);
            $subGroupsFinal = array();
            foreach ($subGroups as $subGroup) {
                $groupObj = GroupCollection::model()->getGroupDetailsById($subGroup->GroupId);
                if($groupObj->IsPrivate == 0 || in_array($loginUserId, $groupObj->GroupMembers) ){
                $subGroup->GroupId = $groupObj->GroupName;//here groupd Id is assigned by group name
               array_push($subGroupsFinal, $subGroup);
                }
            }
             }
               /*sub group search end*/
          
             
             
             
            
              /* Post search start*/
               if($postSearch == true){
          
             $array = array(
            'conditions' => array(
                'Description' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsDeleted'=>array('!=' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
            ),
        );
            
            
            
            $posts = PostCollection::model()->findAll($array);
            if(count($posts)>0){
               
                $postExist = "yes";
            }else{
               
                $postExist = "no";
            }
            // Below criteria is only for the Diabetes Network only. 
            // Please comment or remove the below condition for other networks.
            if(Yii::app()->params['IsDSN'] == 'ON'){
                $postExist = "no"; 
            }
             /* Post search end*/
             
             /* Curbside Post search start*/

             $array = array(
            'conditions' => array(
                'Description' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsDeleted'=>array('!=' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
            ),
        );
            $curbPosts = CurbsidePostCollection::model()->findAll($array);
            if(count($curbPosts)>0){
               
                $curbPostExist = "yes";
            }else{
               
                $curbPostExist = "no";
            }
             /*Curbside  Post search end*/
               /* News search start*/
                $array = array(
            'conditions' => array(
                'Title' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsDeleted'=>array('!=' => (int)1),
                 'Released'=>array('==' =>(int)1),
               // 'IsBlockedWordExist'=>array('notIn' => array(1,2)),
               // 'IsAbused'=>array('notIn' => array(1,2)),
            ),
        );
            $news= CuratedNewsCollection::model()->findAll($array);
            if(count($news)>0){
               
                $newsExist = "yes";
            }else{
               
                $newsExist = "no";
            }
              /*News search end*/
             }
            
             
           
             
             
             /*Hashtag start*/
            if($hastagsSearch == true){
               $criteria = new EMongoCriteria();
            $criteria->HashTagName = new MongoRegex('/' . $searchText . '.*/i');
            $criteria->sort("_id", EMongoCriteria::SORT_DESC);
           $criteria->select(array("_id","HashTagName","HashTagFollowers","Post","CurbsidePostId","GroupPostId"));
            $criteria->limit($pageLength);//keep constant
            $criteria->offset($offset);
            $hastags= HashTagCollection::model()->findAll($criteria);
            foreach ($hastags as $hashtag) {
               // $postsCount = PostCollection::model()->getPostsCountForHashtag($hashtag->_id);
               //  $curbPostsCount = CurbsidePostCollection::model()->getCurbPostsCountForHashtag($hashtag->_id);
               //  $GroupPostsCount = GroupPostCollection::model()->getGroupPostsCountForHashtag($hashtag->_id);
                $hashtag->Post = sizeof($hashtag->Post);
                $hashtag->CurbsidePostId = sizeof($hashtag->CurbsidePostId);
                $hashtag->GroupPostId = sizeof($hashtag->GroupPostId);
                
            }
            }
            if($curbsideCategory == true){
               $criteria = new EMongoCriteria();
            $criteria->CategoryName = new MongoRegex('/' . $searchText . '.*/i');
            $criteria->sort("_id", EMongoCriteria::SORT_DESC);
            $criteria->select(array("_id","CategoryName","Followers","Post","CategoryId"));
            $criteria->limit($pageLength);//keep constant
            $criteria->offset($offset);
            $ccategories = CurbSideCategoryCollection::model()->findAll($criteria);
            foreach ($ccategories as $category) {
               // $postsCount = PostCollection::model()->getPostsCountForHashtag($hashtag->_id);
               //  $curbPostsCount = CurbsidePostCollection::model()->getCurbPostsCountForHashtag($hashtag->_id);
               //  $GroupPostsCount = GroupPostCollection::model()->getGroupPostsCountForHashtag($hashtag->_id);
                $category->Post = sizeof($category->Post);
                //$category->Followers = sizeof($category->Followers);
//                $hashtag->CurbsidePostId = sizeof($hashtag->CurbsidePostId);
//                $hashtag->GroupPostId = sizeof($hashtag->GroupPostId);
                
            }
            }
             /*Hashtag end*/
            echo CJSON::encode(array("users" => $usersArray,"groups" => $groupsFinalArray,"subGroups"=>$subGroupsFinal,"postString" => array(array("searchText"=>$searchText,"postExist"=>$postExist,"curbPostExist"=>$curbPostExist,"newsExist"=>$newsExist)),"hastagArray"=>$hastags,"categoryArray"=>$ccategories, "status" => "success"));
            
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
   
    public function actionGetUnreadNotifications($userId){
        try{
            $provider = new EMongoDocumentDataProvider('Notifications',                   
           array(
                'pagination' => FALSE,
                'criteria' => array( 
                   'conditions'=>array(                       
                       'UserId'=>array('==' => (int) $userId),                       
                       'isRead' => array('==' => (int) 0)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));    
            $data = $provider->getData();
           
            if($provider->getItemCount() > 0){
                $result = $this->prepareStringToNotification($data);
                $controller = new CController('user');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/layouts/renderingNotifications.php',array("data"=>$result),1);
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData());
            }else{
                echo 0;
            }
            
               
        } catch (Exception $ex) {
             error_log($ex->getMessage());
        }
    }
    
    /**
     * @author Swathi
     * @param type $Ndata
     * @return array
     */
    public function actionGetBadgesUnlocked($userId, $isMobile=0) {
        try {
            error_log("============actionGetBadgesUnlocked=============".$isMobile);
            $data = UserBadgeCollection::model()->getBadgesNotShownToUser($userId, 1);

            if (count($data) > 0) {
                $result = $data;
                $controller = new CController('user');
                $badgeInfo = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($result->BadgeId);

                if($isMobile==0){
                    $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath . '/views/common/badging.php', array('badgingInfo' => $badgeInfo, 'badgeCollectionInfo' => $result), 1);
                    echo $resultantPreparedHtml . "_((***&&***))_" . sizeof($result);
                }else{
                    $obj = array("status" => "success", 'badgingInfo' => $badgeInfo, 'badgeCollectionInfo' => $result);
                    echo CJSON::encode($obj);
                }
            } else {
                echo 0;
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    
    /**
     * @author Swathi
     * @param type $Ndata
     * @return array
     */
    public function actionGetTopics($topicIds,$loginUserId) {
        try {
           
            if($topicIds!="" &&$topicIds!=null )
            {
            $categories= CurbSideCategoryCollection::model()->getCategoriesByIds($topicIds);
           $hashtags = ServiceFactory::getSkiptaPostServiceInstance()->getHashtagsForCurbsidePost();
          //echo count($categories)."****************";
            if (count($categories) > 0) {
               
                $controller = new CController('user');
                if($hashtags!="noHashTag"){
                    $hashtagcount=count($hashtags);
                }else{
                    $hashtagcount=0;
                }
            $categoriescount=count($categories);

                //$resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath . '/views/curbsidePost/diseaseLeftMenuTopics.php',  array("result" => "success","loginUserId"=>$loginUserId ,"categories" => $categories, "hashtags" => $hashtags, "categoriescount" => $categoriescount, "hashtagscount" => $hashtagcount), 1);
                echo CJSON::encode($categories) ;
            } else {
                echo 0;
            }
            }
            
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * @author Karteek.V
     * @param type $Ndata
     * @return array
     */
    public function prepareStringToNotification($Ndata){
        try{
            $totalArray = array();
            $totalNotificationTobeShownCount=0;
            foreach($Ndata as $data){
//               error_log(print_r($data,true));
                if($totalNotificationTobeShownCount<10){                    
                $notifications = new NotificationBean();
                $userName = "";
                $postText=CommonUtility::postStringTypebyIndex((int)$data->PostType,(int)$data->CategoryType);
                $custompostText=$postText;                
                //love...
                $notifications->RecentActivity=$data->RecentActivity;
                if(isset($data->Love) && $data->RecentActivity == "love"){
                    if(sizeof($data->Love) >=2){
                        $firstUserId = end($data->Love); 
                        $nextUserId = prev($data->Love);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);                            
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                        }
                        
                        if($firstUserId != $nextUserId && sizeof($data->Love) > 2){
                            $userName = "$userName and others love your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->Love) == 2){
                            $userName = "$userName  love your $postText";
                        }else {
                            $userName = "$userName loves your $postText";
                        }
                                        
                    }else if(sizeof($data->Love)>0){
                        $firstUserId = end($data->Love);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  loved your $postText";                           
                        }                       
                    }       
                    $createdOn = $data->CreatedOn;
                    $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                    $notifications->NotificationString = $userName;
                    $notifications->IsRead = $data->isRead;
                    $notifications->_id = $data->_id;
                    $notifications->PostId = $data->PostId;
                    $notifications->PostType = $data->PostType;
                    $notifications->CategoryType = $data->CategoryType;
                    array_push($totalArray,$notifications);
                }
                //comment...
                if($data->RecentActivity == "comment" && isset($data->CommentUserId)){
                    if(sizeof($data->CommentUserId) >=2){
                        $firstUserId = end($data->CommentUserId); 
                        $nextUserId = prev($data->CommentUserId);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);                            
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->CommentUserId) > 2){
                            $userName = "$userName and others commented on your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->CommentUserId) == 2){
                            $userName = "$userName  commented on your $postText";
                        }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName commented on your $postText";
                        }
                        
                        
                    }else if(sizeof($data->CommentUserId)>0){
                        $firstUserId = end($data->CommentUserId);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  commented on your $postText";                           
                        }                       
                    }
                    if(!empty($userName)){
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                //follow...
                if($data->RecentActivity == "follow" && isset($data->PostFollowers)){
                    if(sizeof($data->PostFollowers) >=2){
                        $firstUserId = end($data->PostFollowers); 
                        $nextUserId = prev($data->PostFollowers);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->PostFollowers) > 2){
                            $userName = "$userName and others are following your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->PostFollowers) == 2){
                            $userName = "$userName are following your $postText";
                        }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName is following your $postText";
                        }
                        
                        
                    }else if(sizeof($data->PostFollowers)>0){
                        $firstUserId = end($data->PostFollowers);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  is following your $postText";                           
                        }                       
                    }
                    if(!empty($userName)){
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                //mentioned...
                if ($data->RecentActivity == "mention" && isset($data->MentionedUserId)) {
                        if (sizeof($data->MentionedUserId) >= 2) {
                            $firstUserId = end($data->MentionedUserId);
                            $nextUserId = prev($data->MentionedUserId);
                            if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                                $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if ($firstUserId != $nextUserId && sizeof($data->MentionedUserId) > 2) {
                                $userName = "$userName and others  mentioned you on a $postText";
                            } else if ($firstUserId != $nextUserId && sizeof($data->MentionedUserId) == 2) {
                                $userName = "$userName have mentioned you on a $postText";
                            }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName mentioned you on a $postText";
                        }
                        } else if (sizeof($data->MentionedUserId) > 0) {
                            $firstUserId = end($data->MentionedUserId);
                            if (isset($firstUserId) && !empty($firstUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  mentioned you on a $postText";
                            }
                        }
                    }
                    if(!empty($data->MentionedUserId)){
                    if(!empty($userName)){
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                // invite ...
                if($data->RecentActivity == "invite" && isset($data->InviteUserId)){
                    error_log("==invite=======$data->InviteUserId=");
                    if(!empty($data->InviteUserId)){
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->InviteUserId);
                        $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> is inviting you to $custompostText";
                        $notifications->DisplayName = $tinyUserObject->DisplayName;
                        $notifications->ProfilePic = $tinyUserObject->profile70x70;  
                    }
                    if(!empty($userName)){
                       
                        $createdOn = $data->CreatedOn;
                        if(is_int($createdOn))
                        {
                          
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn);
                        }
                        else if(is_numeric($createdOn))
                        {
                            error_log("inside numeric is int".$createdOn);
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn);
                        }
                        else
                        {
                            error_log("inside else is int".$createdOn);
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                        }
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                
                   // UserFollow ...
                if($data->RecentActivity == "UserFollow" && isset($data->NewFollowers)){
                    if(sizeof($data->NewFollowers) >=2){
                        $firstUserId = end($data->NewFollowers); 
                        $nextUserId = prev($data->NewFollowers);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->NewFollowers) > 2){
                            $userName = "$userName and others are following you";
                        }else if($firstUserId != $nextUserId && sizeof($data->NewFollowers) == 2){
                            $userName = "$userName are following you";
                        }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName is following you";
                        }
                        
                        
                    }else if(sizeof($data->NewFollowers)>0){
                        $firstUserId = end($data->NewFollowers);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> is following you";                           
                        }                       
                    }
                    if(!empty($userName)){
                       
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }else{
                       
                    }
                }
                
                // invite
                
                    $totalNotificationTobeShownCount++;
                }
               
            }
           
            return $totalArray;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
        
    }
    
    public function actionGetAllNotificationByUserId($userId,$startLimit) {
        try {
            $pageSize = 8;
            $provider = new EMongoDocumentDataProvider('Notifications', array(
                'pagination' => FALSE,
                'criteria' => array(
                    'conditions' => array(
                        'UserId' => array('==' => (int) $userId),                        
                    ),
                    'offset'=> $startLimit,
                    'limit' => $pageSize,
                    'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                )
            ));
            $data = $provider->getData();
            if($provider->getTotalItemCount()==0 && $startLimit == 0){
               $stream=0;//No posts
               echo $stream;
           }else if(sizeof($data) > 0){
               
//               $stream = (object)($provider->getData()); 
                $result = $this->preparedAllNotificaions($data);
                $controller = new CController('user');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/notifications/notificationHistory.php',array("data"=>$result),1);
                echo $resultantPreparedHtml;
            }else
            {                
                $stream=-1;//No more posts
                echo $stream;
            }

        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    
    public function preparedAllNotificaions($Ndata){
        try{
            $totalArray = array();
            $totalNotificationTobeShownCount = 0;
            foreach($Ndata as $data){
                $notifications = new NotificationBean();
                $userName = "";
                $userFollowName = "";
              $postText=CommonUtility::postStringTypebyIndex((int)$data->PostType);
                $custompostText=$postText; 
                //love...
//                if($data->RecentActivity == "love" || $data->RecentActivity == "comment" || $data->RecentActivity == "follow" || $data->RecentActivity == "love"){
//                    
//                }
                //comment...
                $notifications->RecentActivity=$data->RecentActivity;
                if($data->RecentActivity == "comment" || isset($data->CommentUserId)){
                    if(sizeof($data->CommentUserId) >=2){
                        $firstUserId = end($data->CommentUserId); 
                        $nextUserId = prev($data->CommentUserId);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);                            
                            $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->CommentUserId) > 2){
                            $userName = "$userName and others commented on your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->CommentUserId) == 2){
                            $userName = "$userName  commented on your $postText";
                        }else {
                            $userName = "$userName commented on your $postText";
                        }
                        
                        
                    }else if(sizeof($data->CommentUserId)>0){
                        $firstUserId = end($data->CommentUserId);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  commented on your $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName =  "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>  commented on your $postText";                           
                            }
                        }                       
                    }
                    
                }
                // love
                if(isset($data->Love)){
                    if(sizeof($data->Love) >=2){
                        $firstUserId = end($data->Love); 
                        $nextUserId = prev($data->Love);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId); 
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                        }
                        
                        if($firstUserId != $nextUserId && sizeof($data->Love) > 2){
                            $userName = "$userName and others love your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->Love) == 2){
                            $userName = "$userName love your $postText";
                        }else {
                            $userName = "$userName loves your $postText";
                        }
                                        
                    }else if(sizeof($data->Love)>0){
                        $firstUserId = end($data->Love);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  loves your $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName =  "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> love your $postText";                           
                            }
                            
                        }                       
                    }       

                }
                
                //follow...
                if(isset($data->PostFollowers)){
                    if(sizeof($data->PostFollowers) >=2){
                        $firstUserId = end($data->PostFollowers); 
                        $nextUserId = prev($data->PostFollowers);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                             if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->PostFollowers) > 2){
                            $userName = "$userName and others are following your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->PostFollowers) == 2){
                            $userName = "$userName are following your $postText";
                        }else {
                            $userName = "$userName following your $postText";
                        }
                        
                        
                    }else if(sizeof($data->PostFollowers)>0){
                        $firstUserId = end($data->PostFollowers);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                                      
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  is following your $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName =  "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>  are following your $postText";                           
                            }
                        }                       
                    }
                    
                }
                //mentioned...
                if(isset($data->MentionedUserId)){
                    if(sizeof($data->MentionedUserId) >=2){
                        $firstUserId = end($data->MentionedUserId); 
                        $nextUserId = prev($data->MentionedUserId);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                             if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->MentionedUserId) > 2){
                            $userName = "$userName and others mentioned you on a  $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->MentionedUserId) == 2){
                            $userName = "$userName have mentioned you on a $postText";
                        }else {
                            $userName = "$userName mentioned you on a $postText";
                        }
                        
                        
                    }else if(sizeof($data->MentionedUserId)>0){
                        $firstUserId = end($data->MentionedUserId);                      
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                                      
                            if(empty($userName)){                              
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  mentioned you on a $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  " <span class='m_title'>$tinyUserObject->DisplayName</span>  mentioned you on a  $postText";                           
                            }
                        }                       
                    }
                    
                }
                
                // invite ...
                if(isset($data->InviteUserId)){
                    if(!empty($data->InviteUserId)){
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->InviteUserId);
                        if(empty($userName)){
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>  is inviting  you to $custompostText";
                        }else{
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> are inviting  you to $custompostText";
                        }
                        
                         
                    }
                    
                }
                
                   // UserFollow ...
                if(isset($data->NewFollowers)){
                    if(sizeof($data->NewFollowers) >0){
                        $data->NewFollowers=  array_values(array_unique($data->NewFollowers));
                       
                        $firstUserId = end($data->NewFollowers); 
                        $nextUserId = prev($data->NewFollowers);
                         $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                        if(isset($tinyUserObject)){
                            
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $notifications->NotificationType = "userfollow";
                        
                         $userFollowName = "<span class='userprofilename_notification m_title' data-notid='$data->_id' data-id='$tinyUserObject->UserId'>$tinyUserObject->DisplayName</span>";
                        
                            
                        }
                             $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                        if(isset($tinyUserObject)){
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = "";
                         $userFollowName = "$userFollowName, <span class='userprofilename_notification m_title' data-notid='$data->_id' data-id='$tinyUserObject->UserId'>$tinyUserObject->DisplayName</span>";
                        }
                        if(sizeof($data->NewFollowers) > 2){
                            $userFollowName = "$userFollowName and others are following you";
                        }else if(sizeof($data->NewFollowers) == 2){
                            $userFollowName = "$userFollowName are following you";
                        }else {
                            $userFollowName = "$userFollowName is following you";
                        }
                        
                        
                    }
                    
                    
                }

                
                    $totalNotificationTobeShownCount++;
                    $createdOn = $data->CreatedOn;
                    $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                    if(!empty($userFollowName)){
                    $notifications->NotificationString = $userFollowName;}else{
                     $notifications->NotificationString = $userName;   
                    }
                    $notifications->IsRead = $data->isRead;
                    $notifications->_id = $data->_id;
                    $notifications->PostId = $data->PostId;
                    $notifications->PostType = $data->PostType;
                    $notifications->CategoryType = $data->CategoryType;
                    array_push($totalArray,$notifications);
               
            }
            return $totalArray;
            
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    
    
     public function actionGroupPost($stream){
        try{
            $streamArr = explode(",",$stream);
//            print_r($streamArr);
            $result = GroupPostCollection::model()->getPostByIds($streamArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    
    public function actionGetNewGroupPosts($date,$userId,$userTypeId,$type,$id,$timezoneName){
        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
         
            if($type == "SubGroup"){
                $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array((int)$userId,0)),
                       'CategoryType'=>array('=='=>(int) 7),
                            'SubGroupId'=>array('=='=>new MongoId($id)),
                            'IsDeleted'=>array('!=' => 1),
                            'IsPromoted'=>array('!=' => 1),
                            'IsAbused'=>array('notin' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post')
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
            }else if($type == "Group") {
                $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array((int)$userId,0)),
                       'CategoryType'=>array('in' => array(3,7)),  
                            'GroupId'=>array('=='=>new MongoId($id)),
                            'ShowPostInMainStream'=>array('==' => (int)1),    
                            'IsDeleted'=>array('!=' => 1),
                            'IsPromoted'=>array('!=' => 1),
                            'IsAbused'=>array('notin' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post')
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
            }
            
//            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserPrivileges($userId);
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);            
            $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,0,$timezoneName);
            $preparedObject=(object)($streamRes->streamPostData);
            if(isset($preparedObject) && !empty($preparedObject) && sizeof($provider->getData())>0){
                $controller = new CController('group');
                if($type == "Group"){
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/group_posts_view.php',array("stream"=>$preparedObject),1);
                 }else  if($type == "SubGroup"){
                  $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/subgroup_posts_view.php',array("stream"=>$preparedObject),1);    
                 }
//                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/group_posts_view.php',array("stream"=>$preparedObject),1);
//                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData());                
                $obj = array("object"=> $resultantPreparedHtml,"count"=>count((array)$preparedObject));                
                echo CJSON::encode($obj);
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    /**
     * @author Karteek.Vemula
     * @method actionGetGroupLatestPosts  used to get the latest post(which are in top)
     * @param  $userId 
     * @return html if success else 0
     */


    public function actionGetGroupLatestPosts($userId,$groupId,$userTypeId,$type,$postAsNetwork,$timezoneName){

        try{            
            
            if($type == "Group"){
           $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>1),
                'criteria' => array( 
                   'conditions'=>array(              
                       'UserId'=>array('in' => array((int)$userId,0)),
                       'CategoryType'=>array('=='=>(int) 3),
                       'GroupId'=>array('=='=>new MongoId($groupId)),
                            'IsDeleted'=>array('!=' => 1),
                            'IsPromoted'=>array('==' => 0),
                            'IsAbused'=>array('notIn' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post')
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));    
            }else if($type == "SubGroup"){
              
                $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>1),
                'criteria' => array( 
                   'conditions'=>array(              
                       'UserId'=>array('in' => array((int)$userId,0)),
                       'CategoryType'=>array('=='=>(int) 7),
                       'SubGroupId'=>array('=='=>new MongoId($groupId)),
                            'IsDeleted'=>array('!=' => 1),
                            'IsPromoted'=>array('==' => 0),
                            'IsAbused'=>array('notIn' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('==' =>'Post')
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));  
            }
//            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserPrivileges($userId);
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);            

            $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,$postAsNetwork,$timezoneName);
            $preparedObject=(object)($streamRes->streamPostData);
           
            foreach($preparedObject as $rw){
                $streamId = $rw->_id;
            }
            if($provider->getItemCount()>0){
                $controller = new CController('group');
                 if($type == "Group"){
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/group_posts_view.php',array("stream"=>$preparedObject),1);
                 }else  if($type == "SubGroup"){
                  $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/subgroup_posts_view.php',array("stream"=>$preparedObject),1);    
                 }
                 
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData())."_((***&&***))_".$streamId;
            }else{
                echo 0;
            }
          
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    
    /**
     * @author Karteek.Vemula
     * @method actionGetUpdatedStreamPost are used to update the stream post object
     * @param  $date,$userId 
     * @return html if success else 0
     */

    public function actionGetUpdatedStreamPost($userId,$streamId,$userTypeId,$pageType,$categoryType='',$timezoneName=''){
        try{
            
            if($streamId != "undefined" && !empty($streamId)){
                    $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
                array(
                     'pagination' => FALSE,
                     'criteria' => array( 
                        'conditions'=>array(                            
                                 '_id'=>array('==' => new MongoId($streamId)),
//                                 'UserId'=>array('==' => (int)($userId)),
                            ),
                      )
                    ));
                 $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
                 $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,0,$timezoneName);
                 $preparedObject=(object)($streamRes->streamPostData);
                 if(isset($preparedObject) && !empty($preparedObject) && sizeof($provider->getData())>0){
                     $controller = new CController('post');
                     if(trim($pageType) == "streamMainDiv"){
                         $viewPagePath = "/views/post/stream_view.php";
                     } else if(trim($pageType) == "curbsidePostsDiv" || trim($pageType) == "CategoryPostsDiv"){
                         $viewPagePath = "/views/curbsidePost/curbside_view.php";
                     } else if(trim($pageType) == "Group"){
                         $viewPagePath = "/views/group/group_posts_view.php";
                     } else if(trim($pageType) == "SubGroup"){
                         $viewPagePath = "/views/group/subgroup_posts_view.php";
                     } else if(trim($pageType) == "profilePage"){
                         $viewPagePath = "/views/user/profile_intractions_view.php";
                     } else if(trim($pageType) == "ProfileInteractionDivContent"){
                         $viewPagePath = "/views/news/stream_view.php";
                     }  
//                     error_log("===========view Page=======++$viewPagePath");
                     $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.$viewPagePath,array("stream"=>$preparedObject),1);
                     echo $resultantPreparedHtml."_((***&&***))_".$streamId;                
                 }else{
                     echo 0;
                 }
            }else {
                echo 0;
            }
            
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    /**
     * This is used to fetch social bar stats
     * @param type $postIds
     */
    public function actionNewsRequest($postIds){
        try{
//            error_log("=========news request==========$postIds");
            $postIdArr = explode(",",$postIds);
            $result = CuratedNewsCollection::model()->getPreparedDataByNewsId($postIdArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    public function actionGameRequest($postIds){
        try{
        
            $postIdArr = explode(",",$postIds);
            
            $result = GameCollection::model()->getPreparedDataByGameId($postIdArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    public function sendToCollectionByCategoryId($sArr){
        try{          
            $streamArr = explode(",",$sArr);
            $returnValue = $result = array();
            foreach($streamArr as $row){
                $e_array = explode("_",$row);
                if($e_array[1] == 1){
                    $result = PostCollection::model()->getPostByIds($e_array[0]);
                    
                }elseif($e_array[1] == 2){
                    $result = CurbsidePostCollection::model()->getCurbsidePostByIds($e_array[0]);
                }elseif($e_array[1] == 3){
                    $result = GroupCollection::model()->getGroupByIds($e_array[0]);
                }elseif($e_array[1] == 7){
                    
                }
                array_push($returnValue,$result);
                
            }
            $arrSize = sizeof($returnValue);
//            $limit = 20;
//            if($arrSize > $limit){
//                $diffLimit = round($arrSize - $limit);                
//                for($i=0; $i<$diffLimit;$i++){
//                    unset($returnValue[$i]);
//                }
//            }
//            error_log(print_r($returnValue,true));
//            error_log("sizeofPostCollection===".sizeof($returnValue));
            
            return $returnValue;
            
        }catch(Exception $ex){
            return $returnValue;
        }
    }
    
    public function actionGetNewPostsForMobile($date,$userId,$userTypeId,$postAsNetwork,$timezoneName){
$stream="";

        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
          
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array((int)$userId,0)),
                            'IsDeleted'=>array('==' => (int)0),
                            'IsPromoted'=>array('==' => (int)0),
                             'CategoryType' => array('notIn' => array(9, 7,10)),
                            'IsAbused'=>array('notIn' => array(1,2)),
                            'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                            'RecentActivity' => array('in' =>array('Post','Comment')),
                            'IsNotifiable' => array('==' => (int)1)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
            //$userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);

//$timezoneName = "Asia/Kolkata";
            $streamRes = (object)(CommonUtility::prepareStreamDataForMobile_V3($userId,$provider->getData(),'', 1, '',$timezoneName));
         $stream=(object)($streamRes->streamPostData);
                   if(count(array_values((array) $stream))>0){
                    $x = json_encode(array_values((array) $stream));
             }else{
                 $x=0;
             }
//            if ($stream == "" || $stream == 0) {
//                    error_log("ifffffffffffffffffffffff");
//                        $x = json_encode($stream);
//                    }else{
//                        error_log("elseeeeeeeeeeeeeeeeeeeeeeeee");
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
     public function actionGetNewCurbPostsForMobile($date,$userId,$userTypeId,$postAsNetwork,$timezoneName){
$stream="";

        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
          
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
                              array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array($userId,0)),
                       'CategoryType'=>array('=='=>(int) 2),
                       'IsDeleted'=>array('!=' => 1),
                       'IsPromoted'=>array("!="=>1),
                        'IsAbused'=>array('notIn' => array(1,2)),
                        'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                       'RecentActivity' => array('in' =>array('Post','Comment')),
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
            )); 
            //$userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);

//$timezoneName = "Asia/Kolkata";
            $streamRes = (object)(CommonUtility::prepareStreamDataForMobile_V3($userId,$provider->getData(),'', 0, '',$timezoneName));
            $stream=(object)($streamRes->streamPostData);
             if(count(array_values((array) $stream))>0){
                    $x = json_encode(array_values((array) $stream));
             }else{
                 $x=0;
             }
                     
//            if ($stream == "" || $stream == 0) {
//                    error_log("ifffffffffffffffffffffff");
//                        $x = json_encode($stream);
//                    }else{
//                        error_log("elseeeeeeeeeeeeeeeeeeeeeeeee");
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    
    
    
     public function actionGetNewGroupPostsForMobile($date,$userId,$groupId,$userTypeId,$postAsNetwork,$timezoneName){
$stream="";
error_log("actionGetNewGroupPostsForMobile---------------".$groupId);
        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
          
           $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                        'pagination' => array('pageSize' => 10),
                        'criteria' => array(
                            'conditions' => array(
                                 'CreatedOn'=>array('>' => $date_C),
                                'UserId' => array('in' => array($userId, 0)),
                                'IsDeleted' => array('!=' => 1),
                                'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                                'IsAbused' => array('notIn' => array(1, 2)),
                                'CategoryType' => array('in' => array(3, 7)),
                                'ShowPostInMainStream' => array('==' => (int) 1),
                                'GroupId' => array('==' => new MongoId($groupId)),
                            ),
                            'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                        )
                    ));
            //$userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);

//$timezoneName = "Asia/Kolkata";
            $streamRes = (object)(CommonUtility::prepareStreamDataForMobile_V3($userId,$provider->getData(),'', 0, '',$timezoneName));
            $stream=(object)($streamRes->streamPostData);
             if(count(array_values((array) $stream))>0){
                    $x = json_encode(array_values((array) $stream));
             }else{
                 $x=0;
             }
                     
//            if ($stream == "" || $stream == 0) {
//                    error_log("ifffffffffffffffffffffff");
//                        $x = json_encode($stream);
//                    }else{
//                        error_log("elseeeeeeeeeeeeeeeeeeeeeeeee");
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
  
     public function actionGetMobileLatestNews($date,$userId,$userTypeId,$postAsNetwork,$timezoneName){
$stream="";
        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',                   
           array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array((int)$userId,0)),
                            'RecentActivity' => array('in' =>array('Post')),
                       'Released' => array('==' => (Int) 1),
                       'IsDeleted' => array('==' => (Int) 0),
                       'IsAbused' => array('==' => (Int) 0),
                       'CategoryType' => array('==' => (Int) 8),
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
            //$userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);

//error_log(count($provider->getData()));
//$timezoneName = "Asia/Kolkata";
            $streamRes = (object)(CommonUtility::prepareStreamDataForMobile_V3($userId,$provider->getData(),'', 0, '',$timezoneName));
              $stream=(object)($streamRes->streamPostData);      
            if(count(array_values((array) $stream))>0){
                    $x = json_encode(array_values((array) $stream));
             }else{
                 $x=0;
             }
//            if ($stream == "" || $stream == 0) {
//                    error_log("ifffffffffffffffffffffff");
//                        $x = json_encode($stream);
//                    }else{
//                        error_log("elseeeeeeeeeeeeeeeeeeeeeeeee");
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
        public function actionGetMobileNewStories($date,$pageName,$userId,$groupId,$userTypeId,$postAsNetwork,$timezoneName){
            error_log($pageName."--actionGetMobileNewStories-----------".$date."-------".$groupId);
        try{
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
             if($pageName == "stream"){
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',  
                   
           array(
                'pagination' => array('pageSize'=>10),
                'criteria' => array( 
                   'conditions'=>array(
                       'CreatedOn'=>array('>' => $date_C), 
                       'UserId'=>array('in' => array((int)$userId,0)),
                            'IsDeleted'=>array('==' => (int)0),
                            'IsPromoted'=>array('==' => (int)0),
                            'CategoryType'=>array('!=' => (int)7),
                            'IsAbused'=>array('notIn' => array(1,2)),
                            'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                            'RecentActivity' => array('==' =>'Post'),
                            'IsNotifiable' => array('==' => (int)1)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
             }
                
              else if($pageName == "curbside"){
                   $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', 
                  array(
                    'pagination' => array('pageSize'=>10),
                    'criteria' => array( 
                       'conditions'=>array(
                           'CreatedOn'=>array('>' => $date_C), 
                           'UserId'=>array('in' => array($userId,0)),
                           'CategoryType'=>array('=='=>(int) 2),
                           'IsDeleted'=>array('!=' => 1),
                           'IsPromoted'=>array("!="=>1),
                            'IsAbused'=>array('notIn' => array(1,2)),
                            'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                           'RecentActivity' => array('==' =>'Post')
                           ),
                       'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                     )
                ));    
              }  
            else if($pageName == "groups"){
                  error_log("grpu[s-------------------------------");
           $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                        'pagination' => array('pageSize' => 10),
                        'criteria' => array(
                            'conditions' => array(
                                 'CreatedOn'=>array('>' => $date_C),
                                'UserId' => array('in' => array($userId, 0)),
                                'IsDeleted' => array('!=' => 1),
                                'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                                'IsAbused' => array('notIn' => array(1, 2)),
                                'CategoryType' => array('in' => array(3, 7)),
                                'ShowPostInMainStream' => array('==' => (int) 1),
                                'GroupId' => array('==' => new MongoId($groupId)),
                            ),
                            'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                        )
                    ));
             }
        $streamRes = (object)(CommonUtility::prepareStreamDataForMobile_V3($userId,$provider->getData(),'', 1, '',$timezoneName));
         $preparedObject=(object)($streamRes->streamPostData);        
        if(isset($preparedObject) && !empty($preparedObject) && sizeof($provider->getData())>0 && count((array)$preparedObject)>0){
            error_log("paggeName-----------------------".$pageName);
            foreach ($preparedObject as $data) {
                error_log("post rext----".$data->PostText."---".$data->CategoryType);
            }   
           
                echo json_encode(array("object"=>array_values((array) $preparedObject),"count"=>count((array)$preparedObject)));
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }


}
