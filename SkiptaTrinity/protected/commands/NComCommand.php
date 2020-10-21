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
     * @methods actionGetNewPosts are used to get latest posts based on the date
     * @param  $date,$userId 
     * @return html if success else 0
     */


    public function actionGetNewPosts($date, $userId, $userTypeId, $postAsNetwork, $timezoneName, $jObject = "") {

        $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
        CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);
        try {
            $groupsfollowing = ServiceFactory::getSkiptaPostServiceInstance()->getUserFollowingGroupsIDs((int) $userId);
            array_push($groupsfollowing, '');
            if ($date == "undefined" || empty($date)) {
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            } else {
                $date_C = new MongoDate($date);
            }
                           

            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->setConditions(array('$or' =>
                [array(
                'UserId' => 0,
                'SegmentId' => array('$in' => array((int) $tinyOriginalUser->SegmentId, 0)),
                       ),
],
               ));
            $mongoCriteria->CreatedOn('>', $date_C);
            $mongoCriteria->GroupId('in', $groupsfollowing);
            $mongoCriteria->IsDeleted('!=', 1);
            $mongoCriteria->IsBlockedWordExist('notIn', array(1, 2));
            $mongoCriteria->IsPromoted('==', 0);
            $mongoCriteria->IsAbused('notIn', array(1, 2));
            $mongoCriteria->CategoryType('notIn', array(7));
            $mongoCriteria->IsNotifiable('==', 1);

            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'pagination' => array('pageSize' => 1),
                'criteria' => $mongoCriteria
            ));
            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
            $preparedObject = (object) CommonUtility::prepareStreamData($userId, $provider->getData(), $userPrivileges, 1, $postAsNetwork, $timezoneName);
            $streamId = 0;
            $preparedObject = (object) ($preparedObject->streamPostData);
            if (isset($preparedObject) && !empty($preparedObject)) {
                foreach ($preparedObject as $rw) {
                    $streamId = $rw->_id;
                }
            }
            if ($provider->getItemCount() > 0 && isset($preparedObject) && !empty($preparedObject)) {
                $controller = new CController('post');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath . '/views/post/stream_view.php', array("stream" => $preparedObject, 'userLanguage' => $tinyOriginalUser->Language), 1);
            
                $obj = array("object" => $resultantPreparedHtml, "count" => count((array) $preparedObject));
                echo CJSON::encode($obj);
            } else {
                echo 0;
            }
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetNewPosts::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetNewPosts==".$ex->getMessage());
        }
    }

    /**
     * @author Karteek.Vemula
     * @methods actionGetLatestPosts  used to get the latest post(which are in top)
     * @param  $userId 
     * @return html if success else 0
     */


    public function actionGetLatestPosts($userId,$userTypeId,$postAsNetwork,$timezoneName){

        try {
 
 $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
            CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);

            $groupsfollowing = ServiceFactory::getSkiptaPostServiceInstance()->getUserFollowingGroupsIDs((int) $tinyOriginalUser->UserId);
            array_push($groupsfollowing, '');

            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->setConditions(array('$or' =>
                [array(
                'UserId' => 0,
                'SegmentId' => $tinyOriginalUser->SegmentId
                    ),
           ],
               )); 
            $mongoCriteria->GroupId('in', $groupsfollowing);
            $mongoCriteria->IsDeleted('!=', 1);
            $mongoCriteria->IsBlockedWordExist('notIn', array(1, 2));
            $mongoCriteria->IsAbused('notIn', array(1, 2));
            $mongoCriteria->IsPromoted('==', 0);
            $mongoCriteria->CategoryType('notIn', array(7,13));
            $mongoCriteria->IsNotifiable('==', 1);
            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'pagination' => array('pageSize' => 1),
                'criteria' => $mongoCriteria
            ));

         
            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
            $preparedObject = (object) CommonUtility::prepareStreamData($userId, $provider->getData(), $userPrivileges, 1, $postAsNetwork, $timezoneName);
            $streamId = 0;
            $preparedObject = (object) ($preparedObject->streamPostData);
            if (isset($preparedObject) && !empty($preparedObject)) {
                foreach ($preparedObject as $rw) {
                        $streamId = $rw->_id;
                    }
                }
            if ($provider->getItemCount() > 0 && isset($preparedObject) && !empty($preparedObject)) {
                $controller = new CController('post');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath . '/views/post/stream_view.php',  array("stream" => $preparedObject,'userLanguage'=>$tinyOriginalUser->Language), 1);

                echo $resultantPreparedHtml . "_((***&&***))_" . sizeof($provider->getData()) . "_((***&&***))_" . $streamId;
            } else {
                echo 0;
            }
          
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetLatestPosts::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetLatestPosts==".$ex->getMessage());
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
            Yii::log("NComCommand:actionCurbsidePosts::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionCurbsidePosts==".$ex->getMessage());
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
            
          $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
        CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);
      
            if($date == "undefined" || empty($date)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($date);
            }
            
            
            

            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->setConditions(array('$or' =>
                [array(
                'UserId' => 0,
                'SegmentId' =>  array('$in'=>array((int)$tinyOriginalUser->SegmentId,0)),
                    ),
                    array(
                        'UserId' => $tinyOriginalUser->UserId
                    )],
            ));
            $mongoCriteria->CreatedOn('>', $date_C);
            $mongoCriteria->IsDeleted('!=', 1);
            $mongoCriteria->IsBlockedWordExist('notIn', array(1, 2));
            $mongoCriteria->IsPromoted('==', 0);
            $mongoCriteria->IsAbused('notIn', array(1, 2));
            $mongoCriteria->CategoryType('==', 2);
            $mongoCriteria->IsNotifiable('==', 1);

            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'pagination' => array('pageSize' => 1),
                'criteria' => $mongoCriteria
            ));


            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
            $preparedObject = (object) CommonUtility::prepareStreamData($userId, $provider->getData(), $userPrivileges, 1, '', $timezoneName);
            $streamId = 0;
            $preparedObject = (object) ($preparedObject->streamPostData);
            if (isset($preparedObject) && !empty($preparedObject)) {
                foreach ($preparedObject as $rw) {
                    $streamId = $rw->_id;
                }
            }
            if ($provider->getItemCount() > 0 && isset($preparedObject) && !empty($preparedObject)) {
                $controller = new CController('curbsidePost');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/curbsidePost/curbside_view.php',array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);
                $obj = array("object"=> $resultantPreparedHtml,"count"=>count((array)$preparedObject));                
                echo CJSON::encode($obj);
                
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetNewCurbsidePosts::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetNewCurbsidePosts==".$ex->getMessage());
        }
    }
    /**
     * @author Karteek.Vemula
     * @methods actionGetLatestCurbsidePost are used to get the latest post(which are in top)
     * @param  $userId 
     * @return html if success else 0
     */

    public function actionGetLatestCurbsidePost($userId,$userTypeId,$postAsNetwork,$timezoneName){
         try {

            $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
            CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);

        

            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->setConditions(array('$or' =>
                [array(
                'UserId' => 0,
                'SegmentId' => $tinyOriginalUser->SegmentId
                    ),
                    array(
                        'UserId' => $tinyOriginalUser->UserId
                    )],
            ));
           
            $mongoCriteria->IsDeleted('!=', 1);
            $mongoCriteria->IsBlockedWordExist('notIn', array(1, 2));
            $mongoCriteria->IsAbused('notIn', array(1, 2));
            $mongoCriteria->CategoryType('==', 2);
            $mongoCriteria->IsPromoted('==', 0);
            $mongoCriteria->IsNotifiable('==', 1);
            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'pagination' => array('pageSize' => 1),
                'criteria' => $mongoCriteria
            ));


            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
            $preparedObject = (object) CommonUtility::prepareStreamData($userId, $provider->getData(), $userPrivileges, 1, $postAsNetwork, $timezoneName);
            $streamId = 0;
            $preparedObject = (object) ($preparedObject->streamPostData);
            if (isset($preparedObject) && !empty($preparedObject)) {
                foreach ($preparedObject as $rw) {
                    $streamId = $rw->_id;
                }
            }
            if ($provider->getItemCount() > 0 && isset($preparedObject) && !empty($preparedObject)) {
                $controller = new CController('curbsidePost');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/curbsidePost/curbside_view.php',array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData())."_((***&&***))_".$streamId;
            }else{
                echo 0;
            }
          
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetLatestCurbsidePost::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetLatestCurbsidePost==".$ex->getMessage());
        }
    }
      /**
     * @author Moin Hussain
     * @method actionProjectSearch
     * @param  ($searchText,$offset,$pageLength,$userSearch,$groupsSearch,$hastagsSearch,$postSearch 
     * @return json
     */
    public function actionProjectSearch($searchText,$offset,$pageLength,$userSearch,$groupsSearch,$subGroupsSearch,$hastagsSearch,$postSearch,$loginUserId,$curbsideCategory,$gameSearch=""){
       try {
            $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection((int)$loginUserId);
            $segmentId = $tinyUserCollectionObj->SegmentId;
             CommonUtility::changeLanguagefromCommand($tinyUserCollectionObj->Language);
            $segmentIdArray = array(0);
            if($segmentId!=0){
                $segmentIdArray = array($segmentId,0);
            }
            $objectsCount = 0;
            $objectsDiscovered = 0;
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
                $isUserFollowed = in_array($loginUserId,$userProfile->userFollowers);
                array_push($usersArray,array("userId"=>$user->UserId,"displayName"=> $user->DisplayName,"uniqueHandle"=> $user->uniqueHandle,"profilePicture"=> $user->profile70x70,"followersCount"=>count($userProfile->userFollowers),"postCount"=>$userPostCount,"isUserFollowed"=>$isUserFollowed));
                }
                 }
                 if(count($usersArray)>0){
                     $objectsCount++;
                     $objectsDiscovered = $objectsDiscovered+count($usersArray);
                 }
            }
            /* user search end*/
    
            /* group search start*/
             if($groupsSearch == true){
             $criteria = new EMongoCriteria();
            
            
             $array = array(
            'conditions' => array(
                'SegmentId' => array('in' => $segmentIdArray),
                'GroupName' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsPrivate'=>array('in' => array(null,(int)0)),
                'Status'=>array('eq' => (int)1),
               
              ),
            'select'=>array("GroupName","GroupProfileImage","PostIds","GroupMembers","GroupUniqueName"),
            'sort'=>array('_id'=>EMongoCriteria::SORT_DESC),
            'limit'=>$pageLength,
             'offset'=>$offset
        );
            
            
            $groups1 = GroupCollection::model()->findAll($array);
              $array = array(
            'conditions' => array(
                'SegmentId' => array('in' => $segmentIdArray),
                'GroupName' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsPrivate'=>array('==' => (int)1),
            
                 'GroupMembers'=>array('in' => array((int)$loginUserId)),
              ),
            'select'=>array("GroupName","GroupProfileImage","PostIds","GroupMembers","GroupUniqueName"),
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
                 $groupObj->GroupUniqueName = $group->GroupUniqueName;
                 $groupObj->GroupImagesAndVideos = $group->GroupProfileImage;
                 $groupObj->GroupMembersCount = sizeof($group->GroupMembers);
                 $groupObj->GroupPostsCount = sizeof($group->PostIds);
                 array_push($groupsFinalArray, $groupObj);
             }
             if(count($groupsFinalArray)>0){
                $objectsCount++;
                $objectsDiscovered = $objectsDiscovered+count($groupsFinalArray);
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
                'SegmentId' => array('in' => $segmentIdArray),
                'SubGroupName' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                 'Status'=>array('eq' => (int)1),
              
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
                $subGroup->GroupId = $groupObj->GroupUniqueName;//here groupd Id is assigned by group name
               array_push($subGroupsFinal, $subGroup);
                }
            }
             }
             if(count($subGroupsFinal)>0){
                $objectsCount++;
                $objectsDiscovered = $objectsDiscovered+count($subGroupsFinal);
            }
               /*sub group search end*/
          
             
             
             
            
              /* Post search start*/
               if($postSearch == true){                   
                    $array = array(
                   'conditions' => array(
                               'Description' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                               'Comments.CommentText' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                               'IsDeleted'=>array('notIn' => array(1,2)),
                              // 'IsDeleted'=>array('!=' => 1),
                               'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                               'IsAbused'=>array('notIn' => array(1,2)),
                   ));
            
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
//                'Description' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'Description' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                'Comments.CommentText' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
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
                'Title' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                'Description' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                'Comments.CommentText' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
//                'Title' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsDeleted'=>array('notIn' => array(1,2)),
                 'Released'=>array('==' =>(int)1),
               // 'IsBlockedWordExist'=>array('notIn' => array(1,2)),
               // 'IsAbused'=>array('notIn' => array(1,2)),
            ),
        );
            $news= CuratedNewsCollection::model()->findAll($array);
            if(count($news)>0){
               
                $newsExist = "yes";
                $objectsCount++;
                $objectsDiscovered = $objectsDiscovered+count($news);
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
                $hastags = HashTagCollection::model()->findAll($criteria);
                foreach ($hastags as $hashtag) {
                   // $postsCount = PostCollection::model()->getPostsCountForHashtag($hashtag->_id);
                   //  $curbPostsCount = CurbsidePostCollection::model()->getCurbPostsCountForHashtag($hashtag->_id);
                   //  $GroupPostsCount = GroupPostCollection::model()->getGroupPostsCountForHashtag($hashtag->_id);
                    $hashtag->Post = sizeof($hashtag->Post);
                    $hashtag->CurbsidePostId = sizeof($hashtag->CurbsidePostId);
                    $hashtag->GroupPostId = sizeof($hashtag->GroupPostId);
                    /*
                     *  $hashtag->Status used, whether user followed a hashtag or not....
                     */
                    $hashtag->Status = in_array($loginUserId,$hashtag->HashTagFollowers);

                }
                if(count($hastags)>0){
                    $objectsCount++;
                    $objectsDiscovered = $objectsDiscovered+count($hastags);
                }
            }
             /*Hashtag end*/
            
            /*curbside category search */
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
                    $category->Status = in_array($loginUserId, $category->Followers);
                    //$category->Followers = sizeof($category->Followers);
    //                $hashtag->CurbsidePostId = sizeof($hashtag->CurbsidePostId);
    //                $hashtag->GroupPostId = sizeof($hashtag->GroupPostId);

                }
                if(count($ccategories)>0){
                    $objectsCount++;
                    $objectsDiscovered = $objectsDiscovered+count($ccategories);
                }
            }
            /* end category*/
            
            /* game search */
            $gamesExist="no";
            if($gameSearch == true){
                
                $array = array(
                'conditions' => array(
                    'GameName' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                    'Comments.CommentText' => array('or' => new MongoRegex('/' . $searchText . '.*/i')),
                    'IsDeleted'=>array('!=' => (int)1),

                    ),
                );
                 $games = GameCollection::model()->findAll($array);
                if(count($games)>0){

                    $gamesExist = "yes";
                    $objectsCount++;
                    $objectsDiscovered = $objectsDiscovered+count($games);
                }else{

                    $gamesExist = "no";
                }                
            }

            
            echo CJSON::encode(array("users" => $usersArray,"groups" => $groupsFinalArray,"subGroups"=>$subGroupsFinal,"postString" => array(array("searchText"=>$searchText,"postExist"=>$postExist,"curbPostExist"=>$curbPostExist,"newsExist"=>$newsExist,"gamesExist"=>$gamesExist)),"hastagArray"=>$hastags,"categoryArray"=>$ccategories, "status" => "success"));
            
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionProjectSearch::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionProjectSearch==".$ex->getMessage());
        }
    }
   
    public function actionGetUnreadNotifications($userId){
        try{
          
           $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection((int) $userId);
            CommonUtility::changeLanguagefromCommand($tinyUserCollectionObj->Language);
            $date_C = new MongoDate(strtotime(date('Y-m-d')));
      
               
                           $orCondition = array(
                '$or' => [
                      array('UserId' =>(int) $tinyUserCollectionObj->UserId, 'SegmentId' => $tinyUserCollectionObj->SegmentId, 'CategoryType' => 3,'isRead' => 0),
                    array('UserId' => (int) $tinyUserCollectionObj->UserId, 'CategoryType' => array('$nin' => array(12)), 'isRead' => 0),
                    array(
                        '$and' => [
                            array('UserId' => (int) 0, 'CategoryType' => array('$in' => array(20)), 'ReadUsers' => array('$nin' => array((int) $tinyUserCollectionObj->UserId))),
                            array('$or' => [
                                    array('ExpiryDate' => null),
                                    array('ExpiryDate' => array('$gte' => $date_C))])
                        ]
                    )
                ]
            );



           
           

            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->setConditions($orCondition);
             $mongoCriteria->isRead('==', 0);
            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $provider = new EMongoDocumentDataProvider('Notifications', array(
                'pagination' => FALSE,
                'criteria' => $mongoCriteria,
            ));
            $data = $provider->getData();

            if($provider->getItemCount() > 0){
                $result = CommonUtility::prepareStringToNotification($data,$userId,0);
                $controller = new CController('user');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/layouts/renderingNotifications.php',array("data"=>$result),1);
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData());
            }else{
                echo 0;
            }
            
               
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetUnreadNotifications::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetUnreadNotifications==".$ex->getMessage());
             echo 0;
        }
    }
    
    /**
     * @author Swathi
     * @param type $Ndata
     * @return array
     */
    public function actionGetBadgesUnlocked($userId, $isMobile=0) {
        try {
            $data = UserBadgeCollection::model()->getBadgesNotShownToUser($userId, 1);
            $badgeLanguage = 'en';
            if (count($data) > 0) {
                $result = $data;
                $controller = new CController('user');
                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
                $toLanguage = $tinyOriginalUser->Language;
                $badgeInfo = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($result->BadgeId);
                if($isMobile==0){
                    if($toLanguage!=$badgeLanguage){
                        $badgeTransInfo = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeTranslation($result->BadgeId, $toLanguage);
                        if(isset($badgeTransInfo->description)){
                            $badgeInfo->description = $badgeTransInfo->description;
                        }else{
                            $badgeInfo->description = CommonUtility::translateData($badgeInfo->description, $badgeLanguage, $toLanguage);
                            ServiceFactory::getSkiptaUserServiceInstance()->saveBadgeTranslation($result->BadgeId, $toLanguage, $badgeInfo->description);
                        }
                    }
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
            Yii::log("NComCommand:actionGetBadgesUnlocked::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
             echo 0;
            error_log("Exception Occurred in NComCommand->actionGetBadgesUnlocked==".$ex->getMessage());
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
            Yii::log("NComCommand:actionGetTopics::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetTopics==".$ex->getMessage());
        }
    }

    
    public function actionGetAllNotificationByUserId($userId,$startLimit) {
        try {
            $pageSize = 8;
            
               
           $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection((int) $userId);
           CommonUtility::changeLanguagefromCommand($tinyUserCollectionObj->Language);
           $date_C = new MongoDate(strtotime(date('Y-m-d')));

            $orCondition = array('$or' => [
                array('UserId' => $tinyUserCollectionObj->UserId, 'SegmentId' => $tinyUserCollectionObj->SegmentId, 'CategoryType' => 3),
                array('UserId' => (int) $tinyUserCollectionObj->UserId, 'CategoryType' => array('$in' => array(1, 2, 4, 5, 6, 8, 9, 10,20))), 
                array(
                        '$and'=>[
                            array('UserId' => (int) 0, 'CategoryType' => array('$in' => array(20))),
                            array('$or' => [
                                array('ExpiryDate' => null),
                                array('ExpiryDate' => array('$gte' => $date_C))])
                         ]
                    )

                ]
            );

            $mongoCriteria = new EMongoCriteria;                      
            $mongoCriteria->isRead('==', 0);
            $mongoCriteria->CategoryType('in', array(1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12, 20));
            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $mongoCriteria->offset($startLimit);
            $mongoCriteria->limit($pageSize);
            $mongoCriteria->setConditions($orCondition);

            $provider = new EMongoDocumentDataProvider('Notifications', array(
                'pagination' => FALSE,
                'criteria' => $mongoCriteria,
            ));
            $data = $provider->getData();
           
            if($provider->getTotalItemCount()==0 && $startLimit == 0){
               $stream=0;//No posts
               echo $stream;
           }else if(sizeof($data) > 0){
               
//               $stream = (object)($provider->getData()); 
               
                $result = CommonUtility::prepareStringToNotification($data,$userId,1);               
                $controller = new CController('user');
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/notifications/notificationHistory.php',array("data"=>$result),1);
                echo $resultantPreparedHtml;
            }else
            {                
                $stream=-1;//No more posts
                echo $stream;
            }

        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetAllNotificationByUserId::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionGetAllNotificationByUserId==".$ex->getMessage());
        }
    }

 
     public function actionGroupPost($stream){
        try{
            $streamArr = explode(",",$stream);
//            print_r($streamArr);
            $result = GroupPostCollection::model()->getPostByIds($streamArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
           Yii::log("NComCommand:actionGroupPost::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGroupPost==".$ex->getMessage());
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
               $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
             CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);
            $userPrivileges=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);            
            $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,0,$timezoneName);
            $preparedObject=(object)($streamRes->streamPostData);
         
            if(isset($preparedObject) && !empty($preparedObject) && sizeof($provider->getData())>0){
                $controller = new CController('group');
                if($type == "Group"){
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/group_posts_view.php',array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);
                 }else  if($type == "SubGroup"){
                  $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/subgroup_posts_view.php',array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);    
                 }
//                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/group_posts_view.php',array("stream"=>$preparedObject),1);
                $obj = array("object"=> $resultantPreparedHtml,"count"=>count((array)$preparedObject));                
                echo CJSON::encode($obj);
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
           Yii::log("NComCommand:actionGetNewGroupPosts::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetNewGroupPosts==".$ex->getMessage());
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
            $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
            CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);
            $streamRes = (object)CommonUtility::prepareStreamData($userId,$provider->getData(),$userPrivileges,0,$postAsNetwork,$timezoneName);
            $preparedObject=(object)($streamRes->streamPostData);
       
            foreach($preparedObject as $rw){
                $streamId = $rw->_id;
            }
            if($provider->getItemCount()>0){
                $controller = new CController('group');
                 if($type == "Group"){
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/group_posts_view.php',array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);
                 }else  if($type == "SubGroup"){
                  $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.'/views/group/subgroup_posts_view.php',array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);    
                 }
                 
                echo $resultantPreparedHtml."_((***&&***))_".sizeof($provider->getData())."_((***&&***))_".$streamId;
            }else{
                echo 0;
            }
          
        } catch (Exception $ex) {
           Yii::log("NComCommand:actionGetGroupLatestPosts::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetGroupLatestPosts==".$ex->getMessage());
        }
    }
    
    /**
     * @author Karteek.Vemula
     * @methods actionGetUpdatedStreamPost are used to update the stream post object
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
                    $tinyOriginalUser = UserCollection::model()->getTinyUserCollection((int) $userId);
                  CommonUtility::changeLanguagefromCommand($tinyOriginalUser->Language);
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
                     $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath.$viewPagePath,array("stream"=>$preparedObject,'userLanguage'=>$tinyOriginalUser->Language),1);
                     echo $resultantPreparedHtml."_((***&&***))_".$streamId;                
                 }else{
                     echo 0;
                 }
            }else {
                echo 0;
            }
            
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetUpdatedStreamPost::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetUpdatedStreamPost==".$ex->getMessage());
        }
    }
    /**
     * This is used to fetch social bar stats
     * @param type $postIds
     */
    public function actionNewsRequest($postIds){
        try{
            $postIdArr = explode(",",$postIds);
            $result = CuratedNewsCollection::model()->getPreparedDataByNewsId($postIdArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionNewsRequest::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionNewsRequest==".$ex->getMessage());
        }
    }
    public function actionGameRequest($postIds){
        try{
        
            $postIdArr = explode(",",$postIds);
            
            $result = GameCollection::model()->getPreparedDataByGameId($postIdArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGameRequest::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGameRequest==".$ex->getMessage());
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
                }elseif($e_array[1] == 13){
                   $result = SurveyUsersSessionCollection::model()->nodeCallForSpots($e_array[0]);
                   
                }
//                elseif($e_array[1] == 7){
//                    
//                }
                 
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
            
            return $returnValue;
            
        }catch(Exception $ex){
            Yii::log("NComCommand:sendToCollectionByCategoryId::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->sendToCollectionByCategoryId==".$ex->getMessage());
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
//                        $x = json_encode($stream);
//                    }else{
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetNewPostsForMobile::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetNewPostsForMobile==".$ex->getMessage());
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
//                        $x = json_encode($stream);
//                    }else{
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetNewCurbPostsForMobile::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetNewCurbPostsForMobile==".$ex->getMessage());
        }
    }
    
    
    
     public function actionGetNewGroupPostsForMobile($date,$userId,$groupId,$userTypeId,$postAsNetwork,$timezoneName){
$stream="";
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
//                        $x = json_encode($stream);
//                    }else{
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetNewGroupPostsForMobile::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetNewGroupPostsForMobile==".$ex->getMessage());
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

//$timezoneName = "Asia/Kolkata";
            $streamRes = (object)(CommonUtility::prepareStreamDataForMobile_V3($userId,$provider->getData(),'', 0, '',$timezoneName));
              $stream=(object)($streamRes->streamPostData);      
            if(count(array_values((array) $stream))>0){
                    $x = json_encode(array_values((array) $stream));
             }else{
                 $x=0;
             }
//            if ($stream == "" || $stream == 0) {
//                        $x = json_encode($stream);
//                    }else{
//                        $x = json_encode(array_values((array) $stream));  
//                    }
          echo $x;
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetMobileLatestNews::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetMobileLatestNews==".$ex->getMessage());
        }
    }
        public function actionGetMobileNewStories($date,$pageName,$userId,$groupId,$userTypeId,$postAsNetwork,$timezoneName){
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
            foreach ($preparedObject as $data) {
            }   
           
                echo json_encode(array("object"=>array_values((array) $preparedObject),"count"=>count((array)$preparedObject)));
            }else{
                echo 0;
            }
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionGetMobileNewStories::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
           error_log("Exception Occurred in NComCommand->actionGetMobileNewStories==".$ex->getMessage());
        }
    }
    public function searchUserData($searchText, $pageLength, $offset) {
        try {
            $userExist = "no";
            $criteria = new EMongoCriteria();
            $criteria->DisplayName = new MongoRegex('/' . $searchText . '.*/i');
            $criteria->sort("UserId", EMongoCriteria::SORT_DESC);
            $criteria->select(array("DisplayName", "UserId", "profile70x70", "uniqueHandle"));
            $criteria->limit($pageLength); //keep constant
            $criteria->offset($offset);
            $users = UserCollection::model()->findAll($criteria);
            if (count($users) > 0) {
                $userExist = "yes";
            }
            return $userExist;
        } catch (Exception $ex) {
            Yii::log("NComCommand:searchUserData::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }

    public function searchGroupsData($searchText, $pageLength, $offset, $loginUserId) {

        try {

            $groups = array();
            $criteria = new EMongoCriteria();
            if ($offset == 1) {
                $offset = 0;
            } else {
                $offset = $offset - 1;
                $offset = $offset * $pageLength;
}

            $collection = GroupCollection::model()->getCollection();
            $cursor = $collection->find(array('$or' => array(array('GroupName' => new MongoRegex('/' . $searchText . '.*/i'), 'IsPrivate' => array('$in' => array(null, (int) 0))), array('GroupName' => new MongoRegex('/' . $searchText . '.*/i'), 'IsPrivate' => (int) 1, 'GroupMembers' => array('$in' => array((int) $loginUserId))))))->skip($offset)->limit($pageLength);
            $groups = iterator_to_array($cursor);
            $finalGroupArrays = array();
            foreach ($cursor as $group) {
                $finalGroupArray = array();
                if (in_array($loginUserId, $group["GroupMembers"])) {
                    $finalGroupArray['isFollowing'] = 1;
                } else {
                    $finalGroupArray['isFollowing'] = 0;
                }
                $group["GroupShortDescription"] = "";
                $group["GroupBannerImage"] = "";
                $group["PostIds"] = count($group["PostIds"]);
                $group["GroupMembers"] = count($group["GroupMembers"]);
                $group["GroupProfileImage"] = Yii::app()->params['ServerURL'] . $group["GroupProfileImage"];
                $finalGroupArray['group'] = $group;
                array_push($finalGroupArrays, $finalGroupArray);
            }
            return $finalGroupArrays;
        } catch (Exception $ex) {
            Yii::log("NComCommand:searchGroupsData::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }


    public function searchPostData($searchText, $pageSize, $offset, $loginUserId,$timezoneName){

        try {
            $postsFinal = array();
            $_GET['StreamPostDisplayBean_page'] = (int) $offset;
            $condition = array(

 		 'PostText' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'UserId' => array('==' => 0),
                'IsDeleted' => array('!=' => 1),
                'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                'IsAbused' => array('notIn' => array(1, 2)),
                'CategoryType' => array('in' => array(1, 2)),
                'IsNotifiable' => array('==' => (int) 1)
            );
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'pagination' => array('pageSize' => $pageSize),
                'criteria' => array(
                    'conditions' => $condition,
                    'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                )
            ));
            $stream = array();
            
            if ($provider->getTotalItemCount() == 0) {
                $stream = array(); //No posts

            } 

 else if ($_GET['StreamPostDisplayBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                $UserId =$loginUserId;// Yii::app()->session['PostAsNetwork'] == 1 ? Yii::app()->session['NetworkAdminUserId'] : $this->tinyObject['UserId'];
               // $dataArray = array_merge($provider->getData(), $this->getDerivateObjectsStream($UserId));
$previousStreamIdArray=array();
                $streamRes = (object) (CommonUtility::prepareStreamDataForMobile_V3($UserId, $provider->getData(), '', 1, '', $timezoneName,$previousStreamIdArray)); 
  if(isset($streamRes->streamPostData)){
     $stream=(object)($streamRes->streamPostData);

            }
                if ($provider->getTotalItemCount() > 0) {
                    $postsFinal = array_values((array) $stream);
                } else {
                    $postsFinal = $stream;
                }
            }
            return $postsFinal;
        } catch (Exception $ex) {
            Yii::log("NComCommand:searchPostData::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }

public function searchCategoryData($searchText, $pageSize, $offset, $loginUserId,$timezoneName){
        try {
            $CategoryFinal = array();
            $_GET['StreamPostDisplayBean_page'] = (int)$offset;
            $condition = array(
 		//'PostText' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
	        'CurbsideConsultCategory'=>array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'UserId' => array('==' => 0),
                'IsDeleted' => array('!=' => 1),
                'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                'IsAbused' => array('notIn' => array(1, 2)),
                'CategoryType' => array('in' => array(1,2)),
                'IsNotifiable' => array('==' => (int) 1)
            );
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => $condition,
                        'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                    )
                ));
            $stream = array();
            if ($provider->getTotalItemCount() == 0) {
                $stream = array(); //No posts
            } 

 else if ($_GET['StreamPostDisplayBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                $UserId =$loginUserId;// Yii::app()->session['PostAsNetwork'] == 1 ? Yii::app()->session['NetworkAdminUserId'] : $this->tinyObject['UserId'];
               // $dataArray = array_merge($provider->getData(), $this->getDerivateObjectsStream($UserId));
$previousStreamIdArray=array();
                $streamRes = (object) (CommonUtility::prepareStreamDataForMobile_V3($UserId, $provider->getData(), '', 1, '', $timezoneName,$previousStreamIdArray)); 
  if(isset($streamRes->streamPostData)){
     $stream=(object)($streamRes->streamPostData);
            }
            if ($provider->getTotalItemCount()>0){
                $CategoryFinal = array_values((array) $stream);
            }else{
                $CategoryFinal = $stream;
            }
          
}
      return $CategoryFinal;
        } catch (Exception $ex) {
            Yii::log("NComCommand:searchCategoryData::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }

public function searchNewsData($searchText, $pageSize, $offset,$loginUserId){

        try {
            $newssFinal = array();
            $_GET['CuratedNewsCollection_page'] = (int) $offset;
            $condition = array(
                'Title' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsDeleted' => array('!=' => (int) 1),
                'Released' => array('==' => (int) 1),
            );
            $provider = new EMongoDocumentDataProvider('CuratedNewsCollection', array(
                'pagination' => array('pageSize' => $pageSize),
                'criteria' => array(
                    'conditions' => $condition,
                    'sort' => array('_id' => EMongoCriteria::SORT_DESC)
                )
            ));

            $newssFinal = array();
            if ($provider->getTotalItemCount() == 0) {
                $newssFinal = array(); //No posts
            } else if ($_GET['CuratedNewsCollection_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                $newssFinal = $provider->getData();
                foreach ($newssFinal as $news) {
                    $originalPostTime = $news->CreatedOn;
                    $news->CreatedOn = CommonUtility::styleDateTime($originalPostTime->sec, 'mobile');
                    $news->Followers = count($news->Followers);
                    $news->Love = count($news->Love);
                    $news->Comments = count($news->Comments);
                    $pattern = '/object/';
                    if (preg_match($pattern, $news->HtmlFragment)) {

                        $news->IsVideo = 1;
                    } else {

                        $news->IsVideo = 0;
                    }
                }
            }
            return $newssFinal;
        } catch (Exception $ex) {
            Yii::log("NComCommand:searchNewsData::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
 public function actionMobileSearch($searchText,$offset,$pageLength,$userSearch,$loginUserId,$isPostExist,$isGroupsExist,$isNewsExist,	
  $timezoneName,$isCurbsideCategoryExist){
       try {

            $userExist = "no";
            if($userSearch == "true"){
                $userExist = $this->searchUserData($searchText, (int)$pageLength, (int)$offset);
            }
            $groups = array();
            if($isGroupsExist == "true"){
                 $groups = $this->searchGroupsData($searchText, (int)$pageLength, (int)$offset, $loginUserId);
            }
           
	    $postsFinal = array();
            if($isPostExist == "true"){
          	$postsFinal = $this->searchPostData($searchText, (int)$pageLength, (int)$offset,$loginUserId, $timezoneName);
            }
 	    $CategoryFinal = array();
            if($isCurbsideCategoryExist == "true"){
          	$CategoryFinal = $this->searchCategoryData($searchText, (int)$pageLength, (int)$offset,$loginUserId, $timezoneName);
            }
	    $newssFinal = array();
            if($isNewsExist == "true"){
          	$newssFinal = $this->searchNewsData($searchText, (int)$pageLength, (int)$offset, $loginUserId);    
	    }
	   $usersArr = array("userExist"=>$userExist,"searchText"=>$searchText);
	    $isPostExist = count($postsFinal);
		$isGroupsExist = count($groups);
		$isNewsExist = count($newssFinal);
		$isCurbsideCategoryExist = count($CategoryFinal);
            echo json_encode(array(
		"Users" => $usersArr,
                "groups" => array_values((array) $groups),
		"posts" =>  $postsFinal,
		"news" => array_values((array) $newssFinal),
            "Categories"=>$CategoryFinal,
		"status" => "success",
		"isPostExist"=>$isPostExist,
		"isCurbsideCategoryExist"=>$isCurbsideCategoryExist,
		"isGroupsExist"=>$isGroupsExist,
		"isNewsExist"=>$isNewsExist
		)
	    );		 
        } catch (Exception $ex) {
            Yii::log("NComCommand:actionMobileSearch::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actionMobileSearch==".$ex->getMessage());
        }
    }

    public function actiongetUsersForSearch($searchText, $offset, $pageLength) {
        $usersArray = array();
        try {
            $criteria = new EMongoCriteria();
            $criteria->DisplayName = new MongoRegex('/' . $searchText . '.*/i');
            $criteria->sort("UserId", EMongoCriteria::SORT_DESC);
            $criteria->select(array("DisplayName", "UserId", "profile70x70", "uniqueHandle"));
            $criteria->limit($pageLength); //keep constant
            $criteria->offset($offset);
            $users = UserCollection::model()->findAll($criteria);
            foreach ($users as $user) {
                if (User::model()->checkUserIsActive((int) $user->UserId)) {
                    $criteria = new EMongoCriteria();
                    $criteria->userId = (int) $user->UserId;
                    $criteria->select(array("userFollowers"));
                    $userProfile = UserProfileCollection::model()->find($criteria);
                    $userPost = PostCollection::model()->findAllByAttributes(array("UserId" => (int) $user->UserId));
                    $userPostCount = count($userPost);
                    $userCurbPost = CurbsidePostCollection::model()->findAllByAttributes(array("UserId" => (int) $user->UserId));
                    $userCurbPostCount = count($userCurbPost);
                    $userPostCount = $userPostCount + $userCurbPostCount;
                    // foreach($usersArray as $userProfile){
                    //	$userProfile->userProfile=Yii::app()->params['ServerURL'].$userProfile->userProfile;
                    //			}
                    array_push($usersArray, array("userId" => $user->UserId, "displayName" => $user->DisplayName, "uniqueHandle" => $user->uniqueHandle, "profilePicture" => $user->profile70x70, "followersCount" => count($userProfile->userFollowers), "postCount" => $userPostCount));
                }
            }
        } catch (Exception $ex) {
            Yii::log("NComCommand:actiongetUsersForSearch::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in NComCommand->actiongetUsersForSearch==".$ex->getMessage());
            //  return $usersArray;
        }
        if (count($usersArray) > 0) {
            $data = $usersArray;
        } else if ($offset == 0) {
            $data = 0;
        } else {
            $data = -1;
        }
        echo CJSON::encode($data);

    }
     public function actionConnectToSurvey($loginUserId,$scheduleId){
       try {
           $obj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getScheduleSurveyById("Id",$scheduleId);
           if($obj->MaxSpots == 0){
               $spotMessage = "";
                echo 0;
           }
           else{
           $spotsCount = SurveyUsersSessionCollection::model()->getSpotsAvailabeForScheduledSurvey($obj,$obj->SurveyId);
            $spotMessage =  CommonUtility::getSpotMessage($spotsCount,$obj->MaxSpots);
            echo CJSON::encode(array("spotMessage"=>$spotMessage,"status" => "success","scheduleId"=>$scheduleId,"loginUserId"=>$loginUserId));
           }
          
       } catch (Exception $ex) {
           Yii::log("NComCommand:actionConnectToSurvey::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
       }
     }
         public function actionUnsetSpot($loginUserId,$scheduleId){
       try {
           SurveyUsersSessionCollection::model()->unsetSpotForUser($loginUserId,$scheduleId);
           
       } catch (Exception $ex) {
           Yii::log("NComCommand:actionUnsetSpot::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
       }
     }

}
