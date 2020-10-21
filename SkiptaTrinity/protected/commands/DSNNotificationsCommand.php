<?php


 /**
   * @author Swathi
   * This class is used to save dsn notifications for all the network users
   */
class DSNNotificationsCommand extends CConsoleCommand {

    public function run($args) {
       $returnProvidersData=ServiceFactory::getSkiptaUserServiceInstance()->getAllOauthProviderDetails();
       if($returnProvidersData!="failure" && sizeof($returnProvidersData)>0)
       {
//           echo "size of network data".sizeof($returnProvidersData);
           foreach($returnProvidersData as $providerData)
           {
               //$this->getUsersOfThisNetwork($providerData->NetworkName);
               $this->getUsersOfThisNetwork("Pharmacist Society");
               break;
           }
       }
      //  $this->getNotificationsForUsers();
    }
    
    /**
     * @author Swathi
     * This is used to getUsersOfThisNetwork
     */
    public function getUsersOfThisNetwork($networkName) {
        try {
            
             $this->getCommonNotificationsForTheUser($networkName);
            echo "NetworkName".$networkName;
            $networkUsers=  ServiceFactory::getSkiptaUserServiceInstance()->getUserDetailsByNetworkName($networkName);
            //echo "+++++++++++++++++++++++++".sizeof($networkUsers);
            if(sizeof($networkUsers)>0)
            { 
                foreach ($networkUsers as $user) {
                echo '---UserId is  ' . $user['UserId'];
                 $returnValue=$this->getNewPostCreated($networkName,$user['UserId']) ; 
                if($returnValue!="failure" && sizeof($returnValue)>0)
                {
                     
                   DSNNotificationCollection::model()->saveDSNNotificationCollection($returnValue);
                }
               
            }
            }
            
          
        } catch (Exception $exc) {
            echo '_________Exception___1___________________' . $exc->getMessage();
        }
    }

   /**
     * @author Swathi
     * This is used to assign badge for each user
     */
    public function getCommonNotificationsForTheUser($networkName) {
        try {
            $returnValue=$this->getTrendingTopic($networkName) ; 
            if($returnValue!="failure")
            {
               DSNNotificationCollection::model()->saveDSNNotificationCollection($returnValue);
            }
            $returnValue=$this->getNewTopic($networkName) ; 
            if($returnValue!="failure" && sizeof($returnValue)>0)
            {
               
               DSNNotificationCollection::model()->saveDSNNotificationCollection($returnValue);
            }
            
             $returnValue=$this->getNewGameInfo($networkName) ; 
            if($returnValue!="failure" && sizeof($returnValue)>0)
            {
                
               DSNNotificationCollection::model()->saveDSNNotificationCollection($returnValue);
            }
            
          
        } catch (Exception $exc) {
            echo '_________Exception_____2_________________' . $exc->getMessage();
        }
    }
    
    public function getNewTopic($networkName) {
        try
        {
          
            $returnValue="failure";
            $data = gmdate('m/d/Y', strtotime("-1 day"));
            $startDate = date('Y-m-d', strtotime($data));
            $endDate = date('Y-m-d');
            $endDate = trim($endDate) . " 23:59:59";
            $startDate = trim($startDate) . " 00:00:00";
            
            $categoryList=CurbSideCategoryCollection::model()->getNewlyCreatedCategories(1,0,$startDate,$endDate);
           //echo "categhopr list".sizeof($categoryList);
            if(sizeof($categoryList)>0)
            {
                foreach($categoryList as $data)
                {
                 $dsnNotificationBean = new DSNNotificationBean();
                $dsnNotificationBean->NetworkName = $networkName;
                $dsnNotificationBean->UserId=(int)0;
                $dsnNotificationBean->NotificationType = CommonUtility::getIndexByDSNNotficationType("New Topic");
                $dsnNotificationBean->NotificationStreamNote = "New topic is";
               
              
                  
              //  $dsnNotificationBean->LoveCount = $data->LoveCount;
                $dsnNotificationBean->FollowCount = sizeof($data->Followers);
                $dsnNotificationBean->CommentCount = $data->NumberOfPosts;
                $dsnNotificationBean->TopicDetails = array();
                $topicDetails = array();
                $topicDetails['TopicName'] = $data->CategoryName;
                ;
                
                $topicProfileImage = split("/", $data->ProfileImage);
              
                $providerLink = Yii::app()->params["ServerURL"];
                if ($topicProfileImage[sizeof($topicProfileImage) - 1] == "user_noimage.png")
                    $urlPath = $providerLink . "/images/system/" . $topicProfileImage[sizeof($topicProfileImage) - 1];
                else
                    $urlPath = $data->ProfileImage;
                $topicDetails['ProfileImage']  = $urlPath;
                array_push($dsnNotificationBean->TopicDetails, $topicDetails);
               
               // array_push($dsnNotificationBean->UserDetails, $userDetails);
                // $dsnNotificationBean->artifacts=array();
                $returnValue=$dsnNotificationBean; 
                }
                
            }
            
        } catch (Exception $ex) {
            echo  "exception".$ex->getMessage();
        }
        return $returnValue;
    }
    
    
    public function getTrendingTopic($networkName) {
        $returnValue="failure";
        $data = gmdate('m/d/Y', strtotime("-1 day"));
        $startDate = date('Y-m-d', strtotime($data));
        $endDate = date('Y-m-d');
        $endDate = trim($endDate) . " 23:59:59";
        $startDate = trim($startDate) . " 00:00:00";
        
      
        //$networkId = $this->tinyObject['NetworkId'];
        $streamIdArray = array();
        $previousStreamIdArray = array();
        $ordered = array();
        $previousStreamIdString = "";
        if (!empty($previousStreamIdString)) {
            $previousStreamIdArray = explode(",", $previousStreamIdString);
        }
        $page = 1;
        $limit = 1;
        $offset = 0;
        $result = ServiceFactory::getSkiptaTopicServiceInstance()->Trending($startDate, $endDate, 1, $limit, $offset);
        //echo "RESULT SIZE+++++++++++++++++++++".sizeof($result);
        $posts = array();
        if (sizeof($result) > 0) {
            foreach ($result as $key => $value) {
                $postId = new MongoID($value['_id']['PostId']['PostId']);
                array_push($posts, $postId);
            }
            $conditionalArray = array(
                'PostId' => array('in' => $posts),
                'UserId' => array('==' => 0)
            );
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'criteria' => array(
                    'conditions' => $conditionalArray,
                //'conditions'=>array('UserId'=>array('in' => array($this->tinyObject['UserId'],0))),
                //'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                )
            ));

            foreach ($provider->getData() as $key => $data) {

                $dsnNotificationBean = new DSNNotificationBean();
                $dsnNotificationBean->NetworkName = $networkName;
                $dsnNotificationBean->UserId=(int)0;
                $dsnNotificationBean->NotificationType = CommonUtility::getIndexByDSNNotficationType("Trending Topic");
                $dsnNotificationBean->NotificationStreamNote = "trending topic is";
                 $dsnNotificationBean->Description = $data->PostText;
                if ($data->PostTextLength > 60) {
                    $description = CommonUtility::truncateHtml($data->PostText, 60, '...', true, true, "...");

                    $dsnNotificationBean->Description = $description;
                }
                $curbsideCategoryId = $data->CurbsideCategoryId;
                $categoryObj = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($curbsideCategoryId);
               
                 
                $dsnNotificationBean->LoveCount = $data->LoveCount;
                $dsnNotificationBean->FollowCount = $data->FollowCount;
                $dsnNotificationBean->CommentCount = $data->CommentCount;
                $dsnNotificationBean->TopicDetails = array();
                $topicDetails = array();
                $topicDetails['TopicName'] = $categoryObj->CategoryName;
                ;
                
                $topicProfileImage = split("/", $categoryObj->ProfileImage);
              
                $providerLink = Yii::app()->params["ServerURL"];
                if ($topicProfileImage[sizeof($topicProfileImage) - 1] == "user_noimage.png")
                    $urlPath = $providerLink . "/images/system/" . $topicProfileImage[sizeof($topicProfileImage) - 1];
                else
                    $urlPath = $categoryObj->ProfileImage;
                $topicDetails['ProfileImage']  = $urlPath;
                array_push($dsnNotificationBean->TopicDetails, $topicDetails);
                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->OriginalUserId);
                $dsnNotificationBean->UserDetails = array();
                $userDetails = array();
                $userDetails['UserId'] = $tinyOriginalUser['UserId'];
                $userDetails['DisplayName'] = $tinyOriginalUser['DisplayName'];
              
                $ProfileImage = split("/", $tinyOriginalUser['profile70x70']);

                if ($ProfileImage[sizeof($ProfileImage) - 1] == "user_noimage.png")
                    $urlPath = $providerLink . "/images/system/" . $ProfileImage[sizeof($ProfileImage) - 1];
                else
                    $urlPath = $tinyOriginalUser['profile70x70'];
                  $userDetails['profile70x70']=$urlPath;
                  $userDetails['OriginalPostTime']=$data->OriginalPostTime;
                array_push($dsnNotificationBean->UserDetails, $userDetails);
              
              
                if(($data->Resource)>0)
                {
                    
                    $Resource=$data->Resource;
                    
                    //$dsnNotificationBean->Artifacts=array();
                    
                   if(isset($Resource['ThumbNailImage']))
                   { 
                       $Resource['ThumbNailImage']=$providerLink . $Resource['ThumbNailImage'];
                       $Resource['Uri']=$providerLink . $Resource['Uri'];
                        $dsnNotificationBean->Artifacts=$Resource;
                   }
                   else if(isset($Resource[0]['ThumbNailImage']))
                   {
                       $Resource[0]['ThumbNailImage']=$providerLink . $Resource[0]['ThumbNailImage'];
                      $Resource[0]['Uri']=$providerLink . $Resource['Uri'];
                      
                        $dsnNotificationBean->Artifacts=$Resource[0]; 
                       
                   }
                }
                
                $returnValue=$dsnNotificationBean;
                
            }
        }
        
        return $returnValue;
    }
    
    public function getNewPostCreated($networkName,$UserId)
    {
        
        $returnValue="failure";
        $data = gmdate('Y-m-d', strtotime("-1 day"));
        $startDate = date('Y-m-d', strtotime($data));
        $endDate = date('Y-m-d');
        $endDate = trim($endDate) . " 23:59:59";
        $startDate = trim($startDate) . " 00:00:00";
        
      
        //$networkId = $this->tinyObject['NetworkId'];
        $streamIdArray = array();
        $previousStreamIdArray = array();
        $ordered = array();
        $previousStreamIdString = "";
        if (!empty($previousStreamIdString)) {
            $previousStreamIdArray = explode(",", $previousStreamIdString);
        }
        $page = 1;
        $limit = 1;
        $offset = 0;
      
        //echo "RESULT SIZE+++++++++++++++++++++".sizeof($result);
        $userFollowers=  UserProfileCollection::model()->getUserFollowersById($UserId);
      
           if($userFollowers!="failure" && sizeof($userFollowers)>0)
           {
            $conditionalArray = array(
                'CategoryType' => array('==' => 2),
                'UserId' => array('in' => array_values($userFollowers)),
                "OriginalUserId" => array('!=' =>(int)$UserId),
                //"CreatedOn" => array('>=' => new MongoDate(strtotime($startDate))),"CreatedOn" => array( '<=' => new MongoDate(strtotime(date('Y-m-d H:i:s', time()))))
                 "CreatedOn" => array('>=' => new MongoDate(strtotime($startDate)), '<=' => new MongoDate(strtotime($endDate)))
               
            );
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'criteria' => array(
                    'conditions' => $conditionalArray,
                'limit'=>1,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                )
            ));
            echo "Provider data".sizeof($provider->getData());
            foreach ($provider->getData() as $key => $data) {

                $dsnNotificationBean = new DSNNotificationBean();
                $dsnNotificationBean->NetworkName = $networkName;
                $dsnNotificationBean->UserId=(int)$UserId;
                $dsnNotificationBean->NotificationType = CommonUtility::getIndexByDSNNotficationType("New Post");
                $dsnNotificationBean->NotificationStreamNote = "new post";
                 $dsnNotificationBean->Description = $data->PostText;
                if ($data->PostTextLength > 60) {
                    $description = CommonUtility::truncateHtml($data->PostText, 60, '...', true, true, '...');

                    $dsnNotificationBean->Description = $description;
                }
                $curbsideCategoryId = $data->CurbsideCategoryId;
                $categoryObj = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($curbsideCategoryId);
               
                 
                $dsnNotificationBean->LoveCount = $data->LoveCount;
                $dsnNotificationBean->FollowCount = $data->FollowCount;
                $dsnNotificationBean->CommentCount = $data->CommentCount;
                $dsnNotificationBean->TopicDetails = array();
                $topicDetails = array();
                $topicDetails['TopicName'] = $categoryObj->CategoryName;
                ;
                
                $topicProfileImage = split("/", $categoryObj->ProfileImage);
              
                $providerLink = Yii::app()->params["ServerURL"];
                if ($topicProfileImage[sizeof($topicProfileImage) - 1] == "user_noimage.png")
                    $urlPath = $providerLink . "/images/system/" . $topicProfileImage[sizeof($topicProfileImage) - 1];
                else
                    $urlPath = $categoryObj->ProfileImage;
                $topicDetails['ProfileImage']  = $urlPath;
                array_push($dsnNotificationBean->TopicDetails, $topicDetails);
                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->OriginalUserId);
                $dsnNotificationBean->UserDetails = array();
                $userDetails = array();
                $userDetails['UserId'] = $tinyOriginalUser['UserId'];
                $userDetails['DisplayName'] = $tinyOriginalUser['DisplayName'];
              
                $ProfileImage = split("/", $tinyOriginalUser['profile70x70']);

                if ($ProfileImage[sizeof($ProfileImage) - 1] == "user_noimage.png")
                    $urlPath = $providerLink . "/images/system/" . $ProfileImage[sizeof($ProfileImage) - 1];
                else
                    $urlPath = $tinyOriginalUser['profile70x70'];
                  $userDetails['profile70x70']=$urlPath;
                    $userDetails['OriginalPostTime']=$data->OriginalPostTime;
                array_push($dsnNotificationBean->UserDetails, $userDetails);
              
              
                if(($data->Resource)>0)
                {
                    
                    $Resource=$data->Resource;
                    
                    //$dsnNotificationBean->Artifacts=array();
                    
                   if(isset($Resource['ThumbNailImage']))
                   { 
                       $Resource['ThumbNailImage']=$providerLink . $Resource['ThumbNailImage'];
                       $Resource['Uri']=$providerLink . $Resource['Uri'];
                        $dsnNotificationBean->Artifacts=$Resource;
                   }
                   else if(isset($Resource[0]['ThumbNailImage']))
                   {
                       $Resource[0]['ThumbNailImage']=$providerLink . $Resource[0]['ThumbNailImage'];
                      $Resource[0]['Uri']=$providerLink . $Resource['Uri'];
                      
                        $dsnNotificationBean->Artifacts=$Resource[0]; 
                       
                   }
                }
                
                $returnValue=$dsnNotificationBean;
               break; 
            }
           }
       
        
        return $returnValue;
        
    }
    
      public function getNewGameInfo($networkName)
      {
          try
        {
          
            $returnValue="failure";
            $data = gmdate('m/d/Y', strtotime("-1 day"));
            $startDate = date('Y-m-d', strtotime($data));
            $endDate = date('Y-m-d');
            $endDate = trim($endDate) . " 23:59:59";
            $startDate = trim($startDate) . " 00:00:00";
            
            $gameObj=  ServiceFactory::getSkiptaGameServiceInstance()->getCurrentScheduleGameForDSN();
        
            if($gameObj!="failure" && sizeof($gameObj)>0)
            {
                 $dsnNotificationBean = new DSNNotificationBean();
                $dsnNotificationBean->NetworkName = $networkName;
                $dsnNotificationBean->UserId=(int)0;
                $dsnNotificationBean->NotificationType = CommonUtility::getIndexByDSNNotficationType("New Game");
                $dsnNotificationBean->NotificationStreamNote = "New game";
                 $dsnNotificationBean->Description = $gameObj->GameDescription;
                if ($gameObj->GameDescription > 60) {
                    $description = CommonUtility::truncateHtml($gameObj->GameDescription, 60, '...', true, true, '..');

                    $dsnNotificationBean->Description = $description;
                } 
                
                $dsnNotificationBean->GameName = $gameObj->GameName;
                $dsnNotificationBean->QuestionsCount = $gameObj->QuestionsCount;
                $dsnNotificationBean->PlayersCount = $gameObj->PlayersCount;
                $returnValue=$dsnNotificationBean;
            }
            
        } catch (Exception $ex) {
            echo  "exception".$ex->getMessage();
        }
        return $returnValue;
          
          
      }
    
    
}
