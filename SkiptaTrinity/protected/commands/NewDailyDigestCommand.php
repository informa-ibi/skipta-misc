
<?php

/**
 * DocCommand class file.
 *
 * @author Kishore
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class NewDailyDigestCommand extends CConsoleCommand {

    public function run($args) {
        $this->prepareDailyDigest();
    }

    public function prepareDailyDigest() {
        try {
            //get All Users from UserCollection

            $limitValue = $this->getDailyDigestBatchLimit();
            if (!empty($limitValue)) {
                error_log("==========DailyDigestDate==Limit====================".$limitValue);
                $userCollection = UserCollection::model()->getAllUsersByLimit($limitValue);
                $categoryTypeList = array(1, 2, 3, 8, 9, 10);
                foreach ($userCollection as $user) {

                    $personalizedObjectList = $this->preparePersonalizedObjectList($categoryTypeList, $user);
                    error_log("=============DailyDigestDate==StreamObj List Size=============" . sizeof($personalizedObjectList));
                    if (sizeof($personalizedObjectList) > 0) {
                        $this->prepareMailContent($user, $personalizedObjectList);
                }
            }
            }
        } catch (Exception $exc) {
            echo '____________***********__________________________________' . $exc->getMessage();
            Yii::log('---' . $exc->getMessage(), 'error', 'application');
        }
    }
    public function preparePersonalizedObjectList($categoryTypeList,$user) {
        $PersonalizedStreamObjectList=array();
        $PzPopObjectList=array();
        $PzObjectList=array();
        $inviteList=array();
        $mentionList=array();
        $commentList=array();
        $postList=array();
        
        try {
            $userId = $user['UserId'];
//             $userId = 64;
             
            //get UserSettings by UserId
            $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($userId);
             error_log($userId."===Id=======DailyDigestDate==UserDetails============IsDailyDiest========".$userSettings->DailyDigest);
            if ($userSettings != "failure" && $userSettings->DailyDigest == 1) {
//            if ($userSettings != "failure") {
               $condition=array(
                            'CategoryType' => array('in' => $categoryTypeList),
                            'UserId' => array('==' => (int) $userId),
                            'CreatedOn' => array('>' => new MongoDate(strtotime('-1 day')))
                        );
               
               $language = isset($user['Language'])?$user['Language']:'en';
            CommonUtility::changeLanguagefromCommand($language);
                $PersonalizedStreamObjectList=$this->prepareStreamDataByCondition($userId,$condition);
                foreach ($PersonalizedStreamObjectList as $streamObject){
                   if(!empty($streamObject->FirstUserDisplayName)){ 
                    if(isset($streamObject->_id)){
                        $postType=$streamObject->CategoryType==9?$streamObject->GameName:$streamObject->PostType;
                        $PostId = $streamObject->CategoryType==9?$streamObject->CurrentGameScheduleId:$streamObject->PostId; 
                        $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$PostId&categoryType=$streamObject->CategoryType&postType=$postType&trfid=$streamObject->FirstUserId";
                     $streamObject->RedirectUrl = $url;   
                    }

                    if(isset($streamObject->FirstUserId) && $streamObject->FirstUserId==$userId){
                       array_push($PzPopObjectList,$streamObject); 
                    }
                    else if(isset($streamObject->FirstUserId)){
                        if($streamObject->RecentActivity=="Invite"){
                            array_push($inviteList,$streamObject); 
                             
                        }
                        else if($streamObject->RecentActivity=="UserMention"){
                           array_push($mentionList,$streamObject);  
                        }
                         else if($streamObject->RecentActivity=="Comment"){
//                            error_log(print_r($streamObject,true));
                           array_push($commentList,$streamObject);  
                        }
                         else if($streamObject->RecentActivity=="Post"){
                         //  if($streamObject->PostType==5)
                           array_push($postList,$streamObject);  
                        }
                    }
                }
                }   
                if(sizeof($inviteList)>0){
                    array_push($PzObjectList,$inviteList[0]);
                }
                if(sizeof($mentionList)>0){
                    $noOfObjects=sizeof($PzObjectList)<1?2:1;
                    $PzObjectList=$this->setStreamObjects($PzObjectList, $mentionList,$noOfObjects); 
//                   array_push($PzObjectList,$mentionList[0]);
                }
                $userFollowersObjectList=$this->prepareUserFollowersObjectList($user);
                if(sizeof($userFollowersObjectList)>0){
                   array_push($PzObjectList,$userFollowersObjectList);
                }
                if(sizeof($commentList)>0){
                   $noOfObjects=sizeof($PzObjectList)<3?2:1;
                    $PzObjectList=$this->setStreamObjects($PzObjectList, $commentList,$noOfObjects);
//                   array_push($PzObjectList,$commentList[0]);
                }
                if(sizeof($postList)>0){
                    $noOfObjects=sizeof($PzObjectList)<4?3:1;
                    $PzObjectList=$this->setStreamObjects($PzObjectList, $postList,$noOfObjects);
//                   array_push($PzObjectList,$postList[0]);
                }
                $pzPostIdList=array();
                foreach($PzObjectList as $obj){
                  //  error_log(print_r($obj,true));
                  if (isset($obj->RecentActivity)){
                        array_push( $pzPostIdList,$obj->PostId); 
                     }
                    
                }
                error_log(sizeof($PzObjectList)."=DailyDigestDate==Personal List Size=======================");
                $commonObjectList=$this->prepareCommonObjectList($categoryTypeList,$user,$pzPostIdList);
                if(sizeof($commonObjectList)>0){
                foreach($commonObjectList as $commonObj){
                   if(sizeof($PzObjectList) < 8){
                     $postType=$commonObj->CategoryType==9?$commonObj->GameName:$commonObj->PostType;
                     $PostId = $commonObj->CategoryType==9?$commonObj->CurrentGameScheduleId:$commonObj->PostId; 
                     $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$PostId&categoryType=$commonObj->CategoryType&postType=$postType&trfid=$commonObj->FirstUserId";
                     $commonObj->RedirectUrl = $url;
                      if(!empty($commonObj->FirstUserDisplayName)){
                         array_push($PzObjectList,$commonObj); 
                      }
                   } 
                }
                } 
            }
            
            return $PzObjectList;
        } catch (Exception $exc) {
            echo '__________preparing PersonalizedObjectList_______________________' . $exc->getMessage();
            error_log("In Exception between for loop" . $exc->getMessage());
        }
    }
    
    public function setStreamObjects($streamList, $ObjectsList,$pushNoOfObjects){
        $i=1;
       foreach($ObjectsList as $object){
           array_push($streamList,$object);
           if($pushNoOfObjects==$i){
               break;
           }
           $i++;
       } 
      return $streamList;  
    }
    
    public function prepareCommonObjectList($categoryTypeList,$user,$pzPostIdList) {
        try {

            $result=array();
            $userId = $user['UserId'];
            $segmentId = (int)(isset($user['SegmentId'])?$user['SegmentId']:0);
            //get Aggregate Common Objects List
            $commonDayObjectList=UserInteractionCollection::model()->getAggregateCommonListByCategoryType($categoryTypeList, $segmentId);
             if(isset($commonDayObjectList) && sizeof($commonDayObjectList)>0){
                 
                 $postIdList=array();
                foreach($commonDayObjectList as $commonObj){
                    if (!in_array($commonObj["_id"]["PostId"], $pzPostIdList)) {
                        array_push($postIdList, $commonObj["_id"]["PostId"]);
                    }
                }
                 

                     $condition = array(
                        'PostId' => array('in' => $postIdList),
                        'UserId' => array('==' => 0)     
                    );

                    $commonStreamObjList=$this->prepareStreamDataByCondition($userId,$condition); 
                    if (sizeof($commonStreamObjList) > 0) {
                    foreach ($commonStreamObjList as $key=>$streamObject) {

                        if (isset($streamObject->FirstUserId) && $streamObject->FirstUserId == $userId) {
                             unset($commonStreamObjList[$key]);
                        }
                    }
                    $result=$commonStreamObjList;
                }
            }
            
            return $result;
        } catch (Exception $exc) {
            echo '__________preparing CommonObjectList_______________________' . $exc->getMessage();
            error_log("In Exception between for loop" . $exc->getMessage());
        }
    }
    
     public function prepareUserFollowersObjectList($user) {
        try {
            $userId = $user['UserId'];
          //  $userId = 64;
            $tinyUserObjList=array();
            $userFollowersList=UserInteractionCollection::model()->getDistinctUserFollowersListByCategoryType($userId);
            if(sizeof($userFollowersList)>0){
                $tinyUserObjList=UserCollection::model()->getTinyUserCollectionWithUserIdList($userFollowersList); 
            }
           return sizeof($tinyUserObjList)>0?$tinyUserObjList:array(); 
        } catch (Exception $exc) {
            echo '__________preparing CommonObjectList_______________________' . $exc->getMessage();
            error_log("In Exception between for loop" . $exc->getMessage());
        }
    }
    
    public function prepareStreamDataByCondition($userId,$conditions, $sort=array()) {
        $result=array();
        try {

            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'criteria' => array(
                 'conditions' => $conditions
                )
            ));

            if (isset($provider) && $provider->getData() !== null && sizeof($provider->getData()) > 0) {
                $streamData = (object) (CommonUtility::prepareStreamData($userId, $provider->getData(), array(),"","","UTC",array(),0));
            }
//            error_log(print_r($streamData->streamPostData,true));
            if(isset($streamData) && isset($streamData->streamPostData)){
                $result=$streamData->streamPostData;
            }
            return $result;
        } catch (Exception $exc) {
            echo '__________preparing CommonObjectList_______________________' . $exc->getMessage();
            error_log("In Exception between for loop" . $exc->getMessage());
        }
    }
    public function prepareMailContent($user,$streamObjectList) {
        $userId=$user['UserId'];
        $profilePic=$user['profile70x70'];
        $userDetailsFromMysql=User::model()->getUserProfileByUserId($userId);
        $userEmail=$userDetailsFromMysql['Email'];
        $subject = 'Daily Digest from ' . Yii::app()->params['NetworkName'];
        $name=$userDetailsFromMysql['FirstName'];
       // $to = "neokishoren@gmail.com";
        $to =$userEmail;
        $templateType = "DailyDigest";
        $companyLogo = "";
        $employerName = "Skipta Admin";
        //$employerEmail = "info@skipta.com"; 
        $absolutePath = Yii::app()->params['ServerURL'];
//        error_log($absolutePath."--------------------------__@@@@@@@@@@@@@@");
        $messageview = 'newdailyDigestEmailTemplate';
        $params = array('name' => $name, 'userId' => $userId,'streamObjectList'=>$streamObjectList,'email'=>$userEmail,'absolutePath'=>$absolutePath,"profilePic"=>$profilePic);
//        if ($isSendEmail == 1) {
            $sendMailToUser = new CommonUtility;
            error_log("---------------------before sending mail=====================".$userEmail);
            $sendMailToUser->actionSendmail($messageview, $params, $subject, $to);
//        }
    }
    
    public function getDailyDigestBatchLimit() {
        
        error_log("==========DailyDigestDate======================".date('Y-m-d H:i:s', time()));
        if (date("H",CommonUtility::convert_time_zone(time(), 'EST',date_default_timezone_get(),'sec')) < 2) {
            $userCollectionCount = UserCollection::model()->getyUserCollectionCount();
            $batchCount = floor(($userCollectionCount / 4));
            $batch1 = "1," . $batchCount;
            $batch2 = ($batchCount + 1) . "," . ($batchCount * 2);
            $batch3 = (($batchCount * 2) + 1) . "," . ($batchCount * 3);
            ;
            $batch4 = (($batchCount * 3) + 1);

            $dailyDigestBatchs = DailyDigestBatchs::model()->getDailyDigestBatchs();
            $i = 1;
            foreach ($dailyDigestBatchs as $batch) {

                $bachval = $i == 1 ? $batch1 : ($i == 2 ? $batch2 : ($i == 3 ? $batch3 : $batch4));
                DailyDigestBatchs::model()->updateDailyDigestBatchs($bachval, $batch["id"]);
                $i++;
            }
        }
        $dailyDigestBatchs = DailyDigestBatchs::model()->getDailyDigestBatchs();
        $limitValue = "";
        if(isset($dailyDigestBatchs)){
        foreach ($dailyDigestBatchs as $batch) {
            if ($batch['IsRunning']==0) {
                $limitValue = $batch['Value'];
                DailyDigestBatchs::model()->updateDailyDigestBatchsRunningStatus($batch['id']);
                break;
            }
        }
        }
        return $limitValue;
    }

}