<?php

/*
 * Developer Suresh Reddy
 * on 8 th Jan 2014
 * all users actions need to add here
 */

class RestuserController extends Controller {

      public function init() {
      
      }
 
/**
 * author: suresh Reddy .G
 * actionGetMiniPorfile is used to get user mini profile
 * request an userId
 * returns an user object
 */
public function actionGetMiniProfile(){
    try{
        
        
        if(isset($_REQUEST['userid'])){
            $userid = $_REQUEST['userid'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getUserMiniProfile($userid,$_REQUEST['loggedUserId']);
        }
        
        $obj = array('status' => 'success', 'data' => $result, 'error' => '');        
        echo json_encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    
}


/**
 * @author Suresh Reddy.v
 * actionUserFollowUnfollowActions is used for either follow or unfollow actions
 * @param $userid,$type
 * @return type json object
 */
public function actionUserFollowUnfollowActions(){
    try{
        if(isset($_REQUEST['type']) && isset($_REQUEST['userid'])){
            $type = $_REQUEST['type'];
            $followId = $_REQUEST['userid'];
            $userId = $_REQUEST['loggedUserId'];
            if(strtolower(trim($type)) == "follow"){
                $result = ServiceFactory::getSkiptaUserServiceInstance()->followAUser($userId,$followId);
            }else if(strtolower(trim($type)) == "unfollow"){
                $result = ServiceFactory::getSkiptaUserServiceInstance()->unFollowAUser($userId,$followId);
            }
        }else{
            Yii::log("==actionUserFollowUnfollowActions=else not set=","error","application");
        }
        $obj = array("status"=>$result,"data"=>"","error"=>"");
    } catch (Exception $ex) {
        Yii::log($ex->getMessage(),"error","application");
    }
    echo CJSON::encode($obj);
}



 public function actionMobileUnreadNotifications(){   
     
      $userId = $_POST['userId'];
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
               // error_log("----------actionMobileUnreadNotifications---------------".$provider->getItemCount()); 
                $result = CommonUtility::prepareStringToNotification($data,$userId,1,"mobile");
                $obj = array("data"=>$result,"notificationCount"=>  sizeof( $provider->getData()));                              
            }else{
                $obj = array('status' => 'success', 'data' => 0, 'error' => "");
                }
            echo $this->rendering($obj);
    } 
    
    public function actionGetAllNotificationByUserId() {
         try {
            $userId = (int)$_REQUEST['userId'];
            $startLimit = (int)$_REQUEST['startLimit'];
            $pageSize = (int)$_REQUEST['pageSize'];
            $offset = ($startLimit*$pageSize);
//            $provider = new EMongoDocumentDataProvider('Notifications', array(
//                'pagination' => FALSE,
//                'criteria' => array(
//                    'conditions' => array(
//                        'UserId' => array('==' => (int) $userId),   
//                       
//                    ),
//                    'offset'=> $offset,
//                    'limit' => $pageSize,
//                    'sort' => array('isRead'=>EMongoCriteria::SORT_ASC, 'CreatedOn' => EMongoCriteria::SORT_DESC)
//                )
//            ));
            
            
                    
           $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection((int) $userId);
           $date_C = new MongoDate(strtotime(date('Y-m-d')));

            $orCondition = array('$or' => [
                array('UserId' => $tinyUserCollectionObj->UserId, 'SegmentId' => $tinyUserCollectionObj->SegmentId, 'CategoryType' => 3),
                array('UserId' => (int) $tinyUserCollectionObj->UserId, 'CategoryType' => array('$in' => array(1, 2, 4, 5, 6, 8, 9, 10))), 
//                array(
//                        '$and'=>[
//                            array('UserId' => (int) 0, 'CategoryType' => array('$in' => array(20))),
//                            array('$or' => [
//                                array('ExpiryDate' => null),
//                                array('ExpiryDate' => array('$gte' => $date_C))])
//                         ]
//                    )

                ]
            );

            $mongoCriteria = new EMongoCriteria;                      
            $mongoCriteria->isRead('==', 0);
            $mongoCriteria->CategoryType('in', array(1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12));
            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $mongoCriteria->offset($offset);
            $mongoCriteria->limit($pageSize);
            $mongoCriteria->setConditions($orCondition);

            $provider = new EMongoDocumentDataProvider('Notifications', array(
                'pagination' => FALSE,
                'criteria' => $mongoCriteria,
            ));
            $data = $provider->getData();
            
            
            
          
            $obj="";
            $totalCount = $provider->getTotalItemCount();
            if($provider->getTotalItemCount()==0 && $startLimit == 0){
               $stream=0;//No posts
               $obj = array("status"=>"success","data"=>$result,"notificationCount"=>  sizeof($data), "totalCount"=>$totalCount); 
           }else if(sizeof($data) > 0){
                $result = CommonUtility::prepareStringToNotification($data,$userId,1,"mobile");
                $obj = array("status"=>"success","data"=>$result,"notificationCount"=> sizeof($data), "totalCount"=>$totalCount); 
            }else
            {
                $stream=-1;//No more posts
                $obj = array("status"=>"success","data"=>$result,"notificationCount"=> sizeof($data), "totalCount"=>$totalCount); 
            }
            echo $this->rendering($obj);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    public function actionGetUnreadNotifications(){
        try{
            $userId = (int)$_REQUEST['userId'];
//            $provider = new EMongoDocumentDataProvider('Notifications',                   
//           array(
//                'pagination' => FALSE,
//                'criteria' => array( 
//                   'conditions'=>array(                       
//                       'UserId'=>array('==' => (int) $userId),                       
//                       'isRead' => array('==' => (int) 0),
//                      // 'CategoryType' => array('notin' => array(16,20))
//                       ),
//                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
//                 )
//               ));   
           $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection((int) $userId);
            error_log("userId-------------".$tinyUserCollectionObj->UserId);
                $date_C = new MongoDate(strtotime(date('Y-m-d')));
      
               
               $orCondition = array(
                '$or' => [
                    array('UserId' => $tinyUserCollectionObj->UserId, 'SegmentId' => array('$in' => array($tinyUserCollectionObj->SegmentId, 0), 'isRead' => 0), 'CategoryType' => array('$in' => array(3, 7))),
                    array('UserId' => (int) $tinyUserCollectionObj->UserId, 'CategoryType' => array('$nin' => array(3, 7, 12,16,20)), 'isRead' => 0),
//                    array(
//                        '$and' => [
//                            array('UserId' => (int) 0, 'CategoryType' => array('$in' => array(20)), 'ReadUsers' => array('$nin' => array((int) $tinyUserCollectionObj->UserId))),
//                            array('$or' => [
//                                    array('ExpiryDate' => null),
//                                    array('ExpiryDate' => array('$gte' => $date_C))])
//                        ]
//                    )
                ],
            );






            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->setConditions($orCondition);
            $mongoCriteria->sort('CreatedOn', EMongoCriteria::SORT_DESC);
            $provider = new EMongoDocumentDataProvider('Notifications', array(
                'pagination' => FALSE,
                'criteria' => $mongoCriteria,
            ));
            $data = $provider->getData();
            
            $unreadCount = $provider->getItemCount();
            $readDataProvider = new EMongoDocumentDataProvider('Notifications',                   
           array(
                'pagination' => FALSE,
                'criteria' => array( 
                   'conditions'=>array(                       
                       'UserId'=>array('==' => (int) $userId),                       
                       'isRead' => array('==' => (int) 0),
                      // 'CategoryType' => array('notin' => array(3,7,16,20))
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));  
            $moreCount = $readDataProvider->getTotalItemCount()-$unreadCount;
            $obj = "";
            error_log("actionGetUnreadNotifications------coynt----".$unreadCount);
            if( $unreadCount> 0){
                $result = CommonUtility::prepareStringToNotification($data,$userId,1,"mobile");
                $obj = array("status"=>"success","data"=>$result,"unreadNotificationCount"=>  $unreadCount,"moreCount"=>$moreCount); 
            }else{
                $obj = array("status"=>"success","data"=>$result,"unreadNotificationCount"=>  $unreadCount,"moreCount"=>$moreCount); 
            }
            echo $this->rendering($obj);
               
        } catch (Exception $ex) {
             error_log($ex->getMessage());
        }
    }

    public function actionUpdateNotificationAsRead() {
        try {
            $result = "failed";
            if (isset($_REQUEST['notificationId']) && strtolower($_REQUEST['notificationId']) != "undefined") {
                $notificationId = $_REQUEST['notificationId'];
                $userId = (int)$_REQUEST['userId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->updateNotificationAsRead($notificationId,$userId);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $ex) {
            $obj = array("status" => "exception", "data" => $ex->getMessage(), "error" => "");
            echo $this->rendering($obj);
        }
         
    }
    /* This method is used for Custom groups */
    /*
     * Custom methods start...
     */
    public function actionContactUsMailSend(){
        try{
            $name = $_REQUEST['Name'];
            $phone = $_REQUEST['Phone'];
            $email = $_REQUEST['Email'];
            $contactMethod = $_REQUEST['ContactMethod'];
            $from = $_REQUEST['From'];
            $message = "";
//            $subject = $displayname . " has invited you to join " . Yii::app()->params['NetworkName'];
//            $employerName = "Skipta Admin";
//            //$employerEmail = "info@skipta.com"; 
            $subject = $from.' '.Yii::app()->session['TinyUserCollectionObj']->DisplayName;
            $to = $_REQUEST['To'];
            $messageview = "CustomContactUsMailTemplate";
            $params = array('name' => $name,'phone' => $phone , 'email' => $email ,'contactMethod' => $contactMethod , 'message' => $message);
            $sendMailToUser = new CommonUtility;
            $mailSentStatus = $sendMailToUser->actionSendmail($messageview, $params, $subject, $to);
            $obj = array();
            if($mailSentStatus){
                $obj = array("status"=>"success");
            }else{
                $obj = array("status"=>"failed");
            }
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionContactUsMailSend ##########".$ex->getMessage());
        }
    }
    
    public function actionGetOpinionSurveyDetails(){
        try{
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $opinionDetails = ServiceFactory::getSkiptaUserServiceInstance()->getOpinionDetails($userId);
            $obj = array();
            $obj = array("data"=>$opinionDetails,"status"=>"success","LoggedUserId"=>$userId);
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetOpinionDetails ##########".$ex->getMessage());
        }
    }
    
    public function actionSaveUserOpinion(){
        try{
            $opinionId = $_REQUEST['opinionId'];
            $optionValue = $_REQUEST['optionValue'];
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $surveryResults = ServiceFactory::getSkiptaUserServiceInstance()->saveOpinionDetails($userId,$opinionId,$optionValue);
            $obj = array("data"=>$surveryResults,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionSaveUserOpinion ##########".$ex->getMessage());
        }
    }
    
    public function actionGetSurveyResults(){
        try{
            $opinionId = $_REQUEST['opinionId'];
            $surveryResults = ServiceFactory::getSkiptaUserServiceInstance()->getSurveyResults($opinionId);
            $obj = array("data"=>$surveryResults,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetSurveyResults ##########".$ex->getMessage());
        }
    }
    
    public function actionCheckPTCMember(){
        try{
            $results = ServiceFactory::getSkiptaUserServiceInstance()->checkPTCMember(Yii::app()->session['Email']);
            $obj = array("size"=>sizeof($results));
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionCheckPTCMember ##########".$ex->getMessage());
        }
    }
    

    public function actionGetSurveyMonkeyQuestions(){
        try{            
            $results = ServiceFactory::getSkiptaUserServiceInstance()->getSurveyQuestions();            
            $obj = array("data"=>$results,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetSurveyMonkeyQuestions ##########".$ex->getMessage());
        }
    }
 
    public function actionSaveSurveyOpinions(){
        try{   
            
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $optionId = $_REQUEST['optionValue'];
            $questionId = $_REQUEST['qId'];
            $others = $_REQUEST['otherValue'];
            $rating = $_REQUEST['rating'];
            ServiceFactory::getSkiptaUserServiceInstance()->saveSurveyOpinions($userId,$optionId,$questionId,$others,$rating);            
            $obj = array("data"=>"","status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionSaveSurveyOpinions ##########".$ex->getMessage());
        }
    }
    
    public function actionGetMonkeySurveyResults(){
        try{
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getSurveyOpinionsRes($userId);            
            $obj = array("count"=>$result,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetSurveyResults ##########".$ex->getMessage());
        }
    }
    


   public function actionGetBadgesNotShownToUser() {
        try {          
            $userId = $_REQUEST['userId'];
             error_log("######################".$userId);
            $badgeCollection = CommonUtility::getBadgesNotShownToUser($userId, 1);
            error_log("###########123456###########".  json_encode($badgeCollection));
            $obj = "";
            if (count($badgeCollection) > 0) {
                $badgeInfo = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($badgeCollection->BadgeId);
                $obj = array("status" => "success", 'badgingInfo' => $badgeInfo, 'badgeCollectionInfo' => $badgeCollection);
                 error_log("###########test###########".  json_encode($obj));
                  error_log("###########test1###########".  json_encode($badgeInfo));
            } else {
                $obj = array("status" => "failure", "data" => "", "error" => "");
            }
            echo CJSON::encode($obj);
             
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in actionEnableOrDisableJoyRide==" . $ex->getMessage(), "error", "application");
        }
    }

    public function actionUpdateBadgeShownToUser() {
        try {
            if (isset($_POST['badgeCollectionId'])) {
                $result = array();
                $result = ServiceFactory::getSkiptaUserServiceInstance()->updateBadgeShownToUser($_POST['badgeCollectionId']);
            }
        } catch (Exception $ex) {
           
        }
    }
    public function actionSaveStreamSettings() {
        try {
            $userId = $_REQUEST['UserId'];
            $settingIds = $_REQUEST['settingIds'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->updateUserSettings($userId, $settingIds,1);
//            $result = ServiceFactory::getSkiptaUserServiceInstance()->updateUserSettings($userId, $settingIds);
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        echo CJSON::encode($obj);
    } 
    public function actionGetUserStreamSettings() {
        try {
            $userId = $_REQUEST['UserId'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getUserSettings($userId);
            $obj = array("data"=>$result,"status"=>"success");
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
            error_log($ex->getMessage());
        }
    }
  public function actionUpdatePushNotifications(){
    //  error_log("--------actionUpdatePushNotification-----------");
       $userId = $_REQUEST['userId'];
       $result = ServiceFactory::getSkiptaUserServiceInstance()->updatePushNotification($userId);
       if($result == "success"){
          $obj = array("status"=>"success");  
       }else{
            $obj = array("status"=>"failure");
       }
       echo $this->rendering($obj);
  }
  public function actionUpdatePushNotificationToken(){
      //error_log("--------actionUpdatePushNotification-----------");
        $userId = $_REQUEST['userId'];
        $pushToken = $_REQUEST['pushToken'];

     //   error_log("push token-----------" . $pushToken);
        $deviceInfo = $_POST['deviceInfo'];
        // error_log("device info----".print_r($deviceInfo,true));
        // error_log("device paltfomr----".$deviceInfo['platform']);
        $sessionId = ServiceFactory::getSkiptaUserServiceInstance()->saveMobileSession_V6($userId, $deviceInfo, $pushToken);
        $obj = array("status" => "success", "sessionId" => $sessionId);

        echo $this->rendering($obj);
    }
}

?>