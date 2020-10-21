
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
                
                $userCollection = UserCollection::model()->getAllUsersByLimit($limitValue);
                $categoryTypeList = array(1, 2, 3, 8, 9, 10);
                foreach ($userCollection as $user) {

                    $personalizedObjectList = $this->preparePersonalizedObjectList($categoryTypeList, $user);
                    error_log("============Stream Object size=============" . sizeof($personalizedObjectList));
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
            error_log($user['UserId']." inside user Daily Digest PreparePersonalizedObjectList-----".$userSettings->DailyDigest);
            if ($userSettings != "failure" && $userSettings->DailyDigest == 1) {
//            if ($userSettings != "failure") {
               $condition=array(
                            'CategoryType' => array('in' => $categoryTypeList),
                            'UserId' => array('==' => (int) $userId),
                            'CreatedOn' => array('>' => new MongoDate(strtotime('-1 day')))
                        );
                $PersonalizedStreamObjectList=$this->prepareStreamDataByCondition($userId,$condition);
                error_log(sizeof($PersonalizedStreamObjectList)."_________======================");
                foreach ($PersonalizedStreamObjectList as $streamObject){
                    
                    if(isset($streamObject->_id)){
//                        error_log(print_r($streamObject,true));
                        $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$streamObject->PostId&categoryType=$streamObject->CategoryType&postType=$streamObject->PostType&trfid=$streamObject->FirstUserId";
                     $streamObject->WebUrls = $url;   
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
                error_log(sizeof($PzPopObjectList)."___1______======================");
                if(sizeof($inviteList)>0){
                    array_push($PzObjectList,$inviteList[0]);
                }
                if(sizeof($mentionList)>0){
                    $noOfObjects=$PzObjectList<1?2:1;
                    $this->setStreamObjects($PzObjectList, $mentionList,$noOfObjects); 
//                   array_push($PzObjectList,$mentionList[0]);
                }
                $userFollowersObjectList=$this->prepareUserFollowersObjectList($user);
                if(sizeof($userFollowersObjectList)>0){
                   array_push($PzObjectList,$userFollowersObjectList);
                }
                if(sizeof($commentList)>0){
                   $noOfObjects=$PzObjectList<3?2:1;
                    $this->setStreamObjects($PzObjectList, $commentList,$noOfObjects);
//                   array_push($PzObjectList,$commentList[0]);
                }
                if(sizeof($postList)>0){
                    $noOfObjects=$PzObjectList<3?3:1;
                    $this->setStreamObjects($PzObjectList, $postList,$noOfObjects);
//                   array_push($PzObjectList,$postList[0]);
                }
//                if(sizeof($PzObjectList)<4 && sizeof($PzPopObjectList)>0){
//                    $i=0;
//                    foreach ($PzPopObjectList as $streamObject){
//                        array_push($PzObjectList,$streamObject);
//                        if($i==3)
//                            break;
//                        $i++;
//                    }
//                }
                
                $commonObjectList=$this->prepareCommonObjectList($categoryTypeList,$user);
                if(sizeof($commonObjectList)>0){
                foreach($commonObjectList as $commonObj){
                   if(sizeof($PzObjectList) < 8){
                     $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$commonObj->PostId&categoryType=$commonObj->CategoryType&postType=$commonObj->PostType&trfid=$commonObj->FirstUserId";
                     $commonObj->WebUrls = $url;
                      array_push($PzObjectList,$commonObj); 
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
    
    public function prepareCommonObjectList($categoryTypeList,$user) {
        try {
            $result=array();
            $userId = $user['UserId'];
//            $userId=2;
            //get Aggregate Common Objects List
            $commonDayObjectList=UserInteractionCollection::model()->getAggregateCommonListByCategoryType($categoryTypeList);
             if(isset($commonDayObjectList) && sizeof($commonDayObjectList)>0){
                 $postIdList=array();
                foreach($commonDayObjectList as $commonObj){
                    array_push($postIdList,$commonObj["_id"]["PostId"]);
                    
                     }
                    
                     $condition = array(
                        'PostId' => array('in' => $postIdList)
                    );
                    $commonStreamObjList=$this->prepareStreamDataByCondition($userId,$condition); 
                    if (sizeof($commonStreamObjList > 0)) {
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
                 'conditions' => $conditions,
                 'sort' => $sort
                )
            ));
            if (isset($provider) && $provider->getData() !== null && sizeof($provider->getData()) > 0) {
                $streamData = (object) (CommonUtility::prepareStreamData($userId, $provider->getData(), array(),"","","UTC"));
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
        $name=$user['DisplayName'];
        $to = "neokishoren@gmail.com";
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
        if (date("H") < 2) {
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
