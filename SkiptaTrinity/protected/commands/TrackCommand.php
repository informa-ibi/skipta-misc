<?php

/**
 * @author Suresh Reddy
 * @class TrackCommand(NodeCommuncation for track the browse details)
 */
class TrackCommand extends CConsoleCommand {

    /**
     * @author Suresh Reddy
     * @method save browse details
     * @param  $obj json format 
     * @return flag 0 or 1
     */
    public function actionIndex($stream, $date) {
        try {
            $streamArr = explode(",", $stream);
            $result = PostCollection::model()->getPostByIds($streamArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
            Yii::log("TrackCommand:actionIndex::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in TrackCommand->actionIndex==".$ex->getMessage());
        }
    }

    /**
     * @author suresh reddy
     * @param type $sessionObj
     */
    public function actionSaveBrowseDetails($sessionObj,$clientIP="") {
        try {

           $sessionObj = json_decode($sessionObj);
           $val = SessionCollection::model()->saveNewSession($sessionObj, $clientIP);


//           if($val==0){
            $latlang = explode(",", $sessionObj->Location);
//
            if (isset($latlang[0]) && isset($latlang[1])) {
                $sessionObj->Address = $this->initcurl(trim($latlang[0]), trim($latlang[1]));
                //   }
                //--------Modified by praneeth for tracking group usability----------
                if ($sessionObj->GroupId != 0) {
                    $isGroupComeback = TrackBrowseDetailsCollection::model()->isGroupComebackUser($sessionObj->GroupId, $sessionObj->SecurityToken);
                    if ($isGroupComeback == 'success') {
                        TrackBrowseDetailsCollection::model()->saveBrowseDetails($sessionObj, $clientIP);
                    }
                } else {
                    TrackBrowseDetailsCollection::model()->saveBrowseDetails($sessionObj, $clientIP);
                }
            }

            //  echo 0;
        } catch (Exception $ex) {
            Yii::log("TrackCommand:actionSaveBrowseDetails::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            error_log("Exception Occurred in TrackCommand->actionSaveBrowseDetails==".$ex->getMessage());
        }
    }

    public function initcurl($lat, $lang) {

        try {
            $curl = curl_init();
// Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://www.datasciencetoolkit.org/coordinates2politics/' . $lat . '%2c' . $lang,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
// Send the request & save response to $resp
            $result1 = curl_exec($curl);
            $result1 = json_decode($result1, true);
// Close request to clear up some resources
            curl_close($curl);


            $result1 = $result1[0];

            if ($result1['politics'] == null) {
                $x = "undefined,undefined";
                return $x;
            } else {
                $x = '';
                $data = $result1['politics'];
                foreach ($data as $key => $value) {
                    $politic = $data[$key];
                    $name = $politic['name'];
                    $code = $politic['code'];
                    $type = $politic['friendly_type'];
                    $x = $x . "" . $politic['name'] . " ,";
                    //  alert(name+ code+" **$$$***"+type)
                }
                return $x;
            }
        } catch (Exception $ex) {
            Yii::log("TrackCommand:initcurl::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            $x = "undefined,undefined";
        }
    }
    public function actionSaveUserImpressions($userId,$views, $type) {
        try {            
            $userId = (int)$userId;
            $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($userId);
            $impressions = array();
            $views = json_decode($views, TRUE);
            foreach($views as $obj){
                $activityObj = $this->prepareImpressionObj($type, $tinyOriginalUser, $obj);
                array_push($impressions, $activityObj);
            }                       
            UserInteractionCollection::model()->saveUserImpressions($impressions);
            
            if($type=="Career"){
                $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userId);
                $userClassification = $tinyUserCollectionObj->UserClassification;
                $userAchievementsInputBean = new UserAchievementsInputBean();
                $userAchievementsInputBean->UserId = $userId;
                $userAchievementsInputBean->UserClassification = $userClassification;
                $userAchievementsInputBean->OpportunityType = "Career";
                $userAchievementsInputBean->SegmentId = $tinyUserCollectionObj->SegmentId;
                $userAchievementsInputBean->NetworkId = $tinyUserCollectionObj->NetworkId;
                $userAchievementsInputBean->EngagementDriverType = "Career_ViewJobs";
                $userAchievementsInputBean->IsUpdate = 1;
                
                $careerViews = UserInteractionCollection::model()->getCareerViewCount($userId,$type."Impression");
                $userAchievementsInputBean->Value = $careerViews;
                Yii::app()->amqp->achievements(json_encode($userAchievementsInputBean));
            }else if($type=="News"){
                $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userId);
                $userClassification = $tinyUserCollectionObj->UserClassification;
                $userAchievementsInputBean = new UserAchievementsInputBean();
                $userAchievementsInputBean->UserId = $userId;
                $userAchievementsInputBean->UserClassification = $userClassification;
                $userAchievementsInputBean->OpportunityType = "News";
                $userAchievementsInputBean->SegmentId = $tinyUserCollectionObj->SegmentId;
                $userAchievementsInputBean->NetworkId = $tinyUserCollectionObj->NetworkId;
                $userAchievementsInputBean->EngagementDriverType = "News_Views";
                $userAchievementsInputBean->IsUpdate = 1;
                
                $careerViews = UserInteractionCollection::model()->getViewCount($userId,$type."Impression");
                $userAchievementsInputBean->Value = $careerViews;
                Yii::app()->amqp->achievements(json_encode($userAchievementsInputBean));
            }
            return "success";
        } catch (Exception $ex) {
            Yii::log("TrackCommand:actionSaveUserImpressions::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
    
    
    public function prepareImpressionObj($type, $tinyOriginalUser, $obj) {        
        try{            
            $activityObj = new UserInteractionCollection();
            $activityObj->UserId = (int) $tinyOriginalUser->UserId;            
            $activityObj->ActionType = "Impression";
            $activityObj->RecentActivity = $type."Impression";
            $activityObj->NetworkId = (int)$tinyOriginalUser->NetworkId;
            $activityObj->SegmentId = (int)$tinyOriginalUser->SegmentId;
            $activityObj->Language = $tinyOriginalUser->Language;
            if(isset($obj["postType"])){
                $activityObj->PostId = $obj["postId"];
                $activityObj->PostType = (int)$obj["postType"];
                $activityObj->CategoryType = (int)$obj["categoryType"];
            }else if(isset($obj["webLinkId"])){                
                $activityObj->WebLinkId = (int)$obj["webLinkId"];
                $activityObj->LinkGroupId = (int)$obj["linkGroupId"];
                $activityObj->WebUrl = $obj["webUrl"];
                $activityObj->CategoryType = (int)$obj["categoryType"];
            }else if(isset($obj["jobId"])){                
                $activityObj->JobId = (int)$obj["jobId"];
                $activityObj->CategoryType = (int)$obj["categoryType"];
            }else if(isset($obj['groupId'])){
                $activityObj->GroupId = $obj["groupId"];              
                $activityObj->CategoryType = (int)$obj["categoryType"];
                if(isset($obj["groupPostId"])){
                    $activityObj->PostId = $obj["groupPostId"];
                }
                else if(isset($obj["postId"])){
                    $activityObj->PostId = $obj["postId"];
                }
                
                if(isset($obj["subgroupId"])){
                    $activityObj->SubGroupId = $obj["subgroupId"];
                }                
                
            }else if(isset($obj["adId"])){
                $activityObj->AdId = (int)$obj["adId"];
                $activityObj->Position = $obj["position"];
                $activityObj->Page = $obj["page"];
                $activityObj->CategoryType = (int)CommonUtility::getIndexBySystemCategoryType('Ads');
            }           
            
            return $activityObj;
        } catch (Exception $ex) {
            Yii::log("TrackCommand:prepareImpressionObj::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
        
    }
    public function actionUpdateEngagementDriversAvailability() {
        try {
            
            $users = User::model()->getAllActiveUsersWithReturns("UserId, UserClassification, NetworkId, SegmentId");
            if($users!="failure"){
                foreach ($users as $user) {
                    $userId = (int)$user['UserId'];
                    $userClassification = (int)$user['UserClassification'];
                    if($userClassification==1){
                        $userAchievementsInputBean = new UserAchievementsInputBean();
                        $userAchievementsInputBean->UserId = $userId;
                        $userAchievementsInputBean->UserClassification = $userClassification;
                        $userAchievementsInputBean->NetworkId = (int)$user['NetworkId'];
                        $userAchievementsInputBean->SegmentId = (int)$user['SegmentId'];
                        Yii::app()->amqp->achievements(json_encode($userAchievementsInputBean));
                    }

                }
            }
        } catch (Exception $ex) {
            echo "=================AMQP/saveUserAchievements=========".$ex->getMessage();
            Yii::log("TrackCommand:actionUpdateEngagementDriversAvailability::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
    public function actionTrackSearchAchievements($obj) {
        try {            
           
            $obj = (object)(json_decode($obj, TRUE));
           
            $userId = (int) $obj->userId;
           
            $tinyUserCollectionObj = UserCollection::model()->getTinyUserCollection($userId);
           
            $userClassification = (int)$tinyUserCollectionObj->UserClassification;
           
            $userAchievementsInputBean = new UserAchievementsInputBean();
            $userAchievementsInputBean->UserId = $userId;
            $userAchievementsInputBean->UserClassification = $userClassification;
            $userAchievementsInputBean->OpportunityType = $obj->opportunityType;
            $userAchievementsInputBean->SegmentId = $tinyUserCollectionObj->SegmentId;
            $userAchievementsInputBean->NetworkId = $tinyUserCollectionObj->NetworkId;
            
            $userAchievementsInputBean->EngagementDriverType = $obj->engagementDriverType;
            $userAchievementsInputBean->IsUpdate = (int)$obj->isUpdate;
            $userAchievementsInputBean->Value = (int)$obj->value;
          
            Yii::app()->amqp->achievements(json_encode($userAchievementsInputBean));
        } catch (Exception $ex) {
            Yii::log("TrackCommand:actionTrackSearchAchievements::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
      public function actionTrackUserSession($obj) {
        try { 
            error_log(print_r($obj,1)); 
            $obj = json_decode($obj);
            $sessionId = CommonUtility::trackUserSession($obj->sessionId,$obj->activityType,$obj->UserId,$obj->date);
             echo CJSON::encode(array("sessionId" => $sessionId, "status" => "success","activityType"=>$obj->activityType,"userId"=>$obj->UserId));
        } catch (Exception $ex) {
            Yii::log("TrackCommand:actionTrackSearchAchievements::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
}
    }
     public function actionCheckUserSession($sessionId) {
        try { 
            error_log("-------------actionCheckUserSession--".$sessionId); 
           
             CommonUtility::checkUserSession($sessionId);
            
        } catch (Exception $ex) {
            Yii::log("TrackCommand:actionTrackSearchAchievements::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
}
