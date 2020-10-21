
<?php

/**
 * DocCommand class file.
 *
 * @author Kishore
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class AwayDigestCommand extends CConsoleCommand {

    public function run($args) {
        $this->awayDigest();
    }

    public function awayDigest() {
        try {
            //get All not logged in Users from past fourdays. 

                $notLoggedInUsers = ServiceFactory::getSkiptaUserServiceInstance()->getAllNotLoggedInUsersFromPastFourdays();
                $awayDigestSentUserListFromPastFourDays = ServiceFactory::getSkiptaUserServiceInstance()->getAwayDigestSentUserListFromPastFourDays();
                $useForAwayDigestObjects = ServiceFactory::getSkiptaUserServiceInstance()->getAwayDigestListFromLstSevenDays(1);
                $awayDigestIdList=array();
                if (sizeof($useForAwayDigestObjects) > 0) {
                    foreach ($useForAwayDigestObjects as $awayDigestObj) {
                      array_push( $awayDigestIdList,new MongoID($awayDigestObj['PostId']));
                    }
                }
                $finalUserInteractionList=$this->prepareAwayDigestListFromUserInteraction($awayDigestIdList);
                foreach ($notLoggedInUsers as $user) {
                    $preparedAwayDigest=array();
                    $postIdList=array();
                    $userId=$user['UserId'];
                    $userAwayDigestId=ServiceFactory::getSkiptaUserServiceInstance()->getUserAwayDigest($userId);
                    if(in_array($userAwayDigestId, $awayDigestSentUserListFromPastFourDays)){
                        continue; 
                    }
                     error_log(sizeof($postIdList)."=================1========postIdList============================");
                    if (sizeof($useForAwayDigestObjects) > 0) {

                            $postIdList=$this->setUserAwaydigestFromAdminConfiguration($userAwayDigestId,$useForAwayDigestObjects,$postIdList);

                    }
                  //   error_log(print_r($postIdList,true));
                     error_log(sizeof($postIdList)."=========================postIdList========2====================".sizeof($finalUserInteractionList));
                    if(sizeof($postIdList)<6){
                      $postIdList=$this->setUserAwaydigestFromUserInteractions($userAwayDigestId,$finalUserInteractionList,$postIdList);   
                    }
                    error_log(sizeof($postIdList)."=========================postIdList=======3=====================");
                    if(sizeof($postIdList)>0){

                         $condition = array(
                            'PostId' => array('in' => $postIdList),
                            'UserId' => array('==' => 0),
                            'IsDeleted'=> array('!=' => 1),
                            'IsAbused'=> array('notIn' => array(1, 2))
                        );
                        // error_log(print_r($postIdList,true));
                        $preparedAwayDigest=$this->prepareStreamDataByCondition($userId,$condition); 
                        if (sizeof($preparedAwayDigest) > 0) {
                             foreach($preparedAwayDigest as $streamObject){
                               $postType=$streamObject->CategoryType==9?$streamObject->GameName:$streamObject->PostType;
                               $PostId = $streamObject->CategoryType==9?$streamObject->CurrentGameScheduleId:$streamObject->PostId; 
                               $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$PostId&categoryType=$streamObject->CategoryType&postType=$postType&trfid=$streamObject->FirstUserId";
                               $streamObject->RedirectUrl = $url;    
                             }
                             
                            $this->prepareMailContent($userId, $preparedAwayDigest);
                            $this->saveUserAwayDigestList($userAwayDigestId,$preparedAwayDigest);
                            ServiceFactory::getSkiptaUserServiceInstance()->updateUserAwayDigest($userAwayDigestId);
                        }
                    }
                    
//                    error_log(print_r($awayDigestSentUserListFromPastFourDays,true)."====================preparedAwayDigest=================");
                   
                    
//                    break;
                }
           AwayDigest::model()->updateAwayDigestListFromSevenDaysCompletedMarkedByAdmin();
        } catch (Exception $exc) {
            echo '____________***********__________________________________' . $exc->getMessage();
            Yii::log('---' . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function saveUserAwayDigestList($userAwayDigestId,$preparedAwayDigest){
       foreach($preparedAwayDigest as $object){
          $awayDigestId=ServiceFactory::getSkiptaUserServiceInstance()->getAwayDigestId($object->PostId, $object->CategoryType,$object->PostType);
          ServiceFactory::getSkiptaUserServiceInstance()->saveSentAwayDigest($awayDigestId,$userAwayDigestId);  
       }
       
    }
    
    public function setUserAwaydigestFromUserInteractions($userAwayDigestId,$finalUserInteractionList,$postIdList){

       $noOfCurbObj=1; $noOfNewsObj=2;$noOfPostObj=2;$noOfGameObj=1;
     
       $postIdList=$this->setStreamObjects($userAwayDigestId,$postIdList, $finalUserInteractionList[2],$noOfCurbObj);
       $postIdList=$this->setStreamObjects($userAwayDigestId,$postIdList, $finalUserInteractionList[1],$noOfNewsObj);
       $postIdList=$this->setStreamObjects($userAwayDigestId,$postIdList, $finalUserInteractionList[8],$noOfPostObj);
       $postIdList=$this->setStreamObjects($userAwayDigestId,$postIdList, $finalUserInteractionList[9],$noOfGameObj);
       $postIdList=$this->setStreamObjects($userAwayDigestId,$postIdList, $finalUserInteractionList[10],1);
       $postIdList=$this->setStreamObjects($userAwayDigestId,$postIdList, $finalUserInteractionList[12],1);
       
       return $postIdList; 
    }
   public function setStreamObjects($userAwayDigestId,$postIdList, $ObjectsList,$pushNoOfObjects){
        $i=1;
       foreach($ObjectsList as $object){
           if(sizeof($postIdList)==6){
               break;
           }
           $awayDigestId=ServiceFactory::getSkiptaUserServiceInstance()->getAwayDigestId($object["_id"]["PostId"], $object["_id"]["CategoryType"],$object["_id"]["PostType"]);
           $isThisAwayDigestSent = ServiceFactory::getSkiptaUserServiceInstance()->isAwayDigestSent($awayDigestId, $userAwayDigestId);
           if ($isThisAwayDigestSent == 0 && !empty($object["_id"]["PostId"])) {
                array_push($postIdList, $object["_id"]["PostId"]);
                if ($pushNoOfObjects == $i) {
                    break;
                }
                $i++;
            }
        } 
        error_log(sizeof($postIdList)."==============postIdList======2====+++++++++++++$$$$$$$$$$$$$$$$");
      return $postIdList;  
    }
     public function setUserAwaydigestFromAdminConfiguration($userAwayDigestId,$awayDigestList,$postIdList){

       $noOfCurbObj=1; $noOfNewsObj=2;$noOfPostObj=2;$noOfGameObj=1;$i=1;
     
       $postIdList=$this->setAdminConfiguredAwayStreamObjects($userAwayDigestId,$postIdList, $awayDigestList,$noOfCurbObj,1);
       $postIdList=$this->setAdminConfiguredAwayStreamObjects($userAwayDigestId,$postIdList, $awayDigestList,$noOfNewsObj,2);
       $postIdList=$this->setAdminConfiguredAwayStreamObjects($userAwayDigestId,$postIdList, $awayDigestList,$noOfPostObj,8);
       $postIdList=$this->setAdminConfiguredAwayStreamObjects($userAwayDigestId,$postIdList, $awayDigestList,$noOfGameObj,9);

       
       return $postIdList; 
    }
    public function setAdminConfiguredAwayStreamObjects($userAwayDigestId,$postIdList, $ObjectsList,$pushNoOfObjects,$categoryType){
        $i=1;
       foreach($ObjectsList as $object){
          if($categoryType!=$object['CategroyType']){
              continue; 
          }
          $isThisAwayDigestSent = ServiceFactory::getSkiptaUserServiceInstance()->isAwayDigestSent($object['Id'], $userAwayDigestId);
            if ($isThisAwayDigestSent == 0) {
                array_push($postIdList,new MongoID($object['PostId']));
            }
             if ($pushNoOfObjects == $i || sizeof($postIdList) == 6) {
                    break;
                }
                $i++;
           
        } 
      return $postIdList;  
    }
    
    public function prepareAwayDigestListFromUserInteraction($awayDigestIdList) {
        $finalUserInteractionList=array();
        $categoryTypeList = array(1, 2, 8, 9, 10, 12);
        $cubsideObjectList=array();
        $postObjectList=array();
        $newsObjectList=array();
        $gameObjectList=array();
        $eventObjectList=array();
        $badgingObjectList=array();
        $cvObjectList=array();
        $UserInteractionObjectList = UserInteractionCollection::model()->getAggregateCommonListByCategoryTypeForAwayDigest($categoryTypeList,5,$awayDigestIdList);
        $UserInteractionPostIdList=array();
        if (isset($UserInteractionObjectList) && sizeof($UserInteractionObjectList) > 0) {
            foreach ($UserInteractionObjectList as $UserInteraction) {
               
                if ($UserInteraction["_id"]["CategoryType"] == 1) {
                    if($UserInteraction["_id"]["PostType"]==1){
                       array_push($postObjectList, $UserInteraction);  
                    }elseif($UserInteraction["_id"]["PostType"]==2){
                       array_push($eventObjectList, $UserInteraction); 
                    }
                } elseif ($UserInteraction["_id"]["CategoryType"] == 2) {
                    array_push($cubsideObjectList, $UserInteraction);
                } elseif ($UserInteraction["_id"]["CategoryType"] == 8) {
                    array_push($newsObjectList, $UserInteraction);
                } elseif ($UserInteraction["_id"]["CategoryType"] == 9) {
                    array_push($gameObjectList, $UserInteraction);
                } elseif ($UserInteraction["_id"]["CategoryType"] == 10) {
                    array_push($badgingObjectList, $UserInteraction);
                } elseif ($UserInteraction["_id"]["CategoryType"] == 12) {
                    array_push($cvObjectList, $UserInteraction);
                }
            }
        }
            $finalUserInteractionList[1]=$postObjectList;
            $finalUserInteractionList[2]=$cubsideObjectList;
            $finalUserInteractionList[8]=$newsObjectList;
            $finalUserInteractionList[9]=$gameObjectList;
            $finalUserInteractionList[10]=$badgingObjectList;
            $finalUserInteractionList[12]=$cvObjectList;
            $finalUserInteractionList[13]=$eventObjectList;
            return $finalUserInteractionList;
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
    public function prepareMailContent($userId,$streamObjectList) {
        $user= UserCollection::model()->getTinyUserObjByNetwork($userId);
        $profilePic=$user['profile70x70'];
        $userDetailsFromMysql=User::model()->getUserProfileByUserId($userId);
        $userEmail=$userDetailsFromMysql['Email'];
        $subject = 'Away Digest from ' . Yii::app()->params['NetworkName'];
        $name=$userDetailsFromMysql['FirstName'];
//        $to = "neokishoren@gmail.com";
        $to =$userEmail;
        $templateType = "DailyDigest";
        $companyLogo = "";
        $employerName = "Skipta Admin";
        //$employerEmail = "info@skipta.com"; 
        $absolutePath = Yii::app()->params['ServerURL'];
//        error_log($absolutePath."--------------------------__@@@@@@@@@@@@@@");
        $messageview = 'awayDigestEmailTemplate';
        $params = array('name' => $name, 'userId' => $userId,'streamObjectList'=>$streamObjectList,'email'=>$userEmail,'absolutePath'=>$absolutePath,"profilePic"=>$profilePic);
//        if ($isSendEmail == 1) {
            $sendMailToUser = new CommonUtility;
            error_log("---------------------before sending mail=====================".$userEmail);
            $sendMailToUser->actionSendmail($messageview, $params, $subject, $to);
//        }
    }
    
   

}
