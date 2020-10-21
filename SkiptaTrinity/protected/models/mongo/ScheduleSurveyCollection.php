<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ScheduleSurveyCollection extends EMongoDocument {
    
    public $_id;
    public $SurveyId;
    public $Status;
    public $SurveyDescription;
    public $SurveyTitle;
    public $PreviousSchedule=array();
    public $StartDate;
    public $EndDate;
    public $CreatedOn;
    public $ThankYouMessage;
    public $ThankYouImage;
    public $ShowThankYou;
    public $IsCurrentSchedule=0;
    public $IsCancelSchedule=0;
    public $CreatedUserId;
    public $SurveyTakenUsers = array();
    public $UserAnswers = array();
    public $ShowDisclaimer = 1;
    public $RenewSchedules;
    public $ConvertInStreamAdd;
    public $SurveyRelatedGroupName; 
    public $MaxSpots=0;
    //public $SessionTime;
    public $QuestionView;
    public $ResumeUsers  = array();
    public function getCollectionName() {
        return 'ScheduleSurveyCollection';
    }
 public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_survey' => array(
                'key' => array(                    
                    'SurveyId' => EMongoCriteria::SORT_DESC,
                   
                ),
            )
        );
    }
     public function attributeNames() {
     return array(
         '_id'=>'_id',
         'SurveyId'=>'SurveyId',
         'Status'=>'Status',
         'SurveyDescription'=>'SurveyDescription',
         'SurveyTitle'=>'SurveyTitle',         
         'StartDate'=>'StartDate',
         'EndDate'=>'EndDate',
         'CreatedOn'=>'CreatedOn',
         'UserAnswers'=>'UserAnswers',
         'ThankYouMessage'=>'ThankYouMessage',
         'ThankYouImage'=>'ThankYouImage',
         'ShowThankYou'=>'ShowThankYou',         
         'IsCurrentSchedule'=>'IsCurrentSchedule',         
         'IsCancelSchedule'=>'IsCancelSchedule',
         'CreatedUserId'=>'CreatedUserId',
         'SurveyTakenUsers' => 'SurveyTakenUsers',
         'ShowDisclaimer' => 'ShowDisclaimer',
         'RenewSchedules' => 'RenewSchedules',
         'ConvertInStreamAdd'=>'ConvertInStreamAdd',
         'SurveyRelatedGroupName'=> 'SurveyRelatedGroupName',
         'MaxSpots'=> 'MaxSpots',
       //  "SessionTime"=>"SessionTime",
         "QuestionView"=>"QuestionView",
         "ResumeUsers" => "ResumeUsers"
         
     );
     
     
     }
     
     public function saveScheduleSurvey($scheduleSurveyForm, $currentScheduleSurvey, $userId,$createdDate=null) {
        try {
            error_log("question view----------------------".$scheduleSurveyForm->QuestionView);
            $returnValue = 'failure';
            $scheduleSurveyObj = new ScheduleSurveyCollection();
            $surveyDetails = ExtendedSurveyCollection::model()->getSurveyDetailsObject('Id', $scheduleSurveyForm->SurveyId);
            if (!is_string($surveyDetails)) {
                $scheduleSurveyObj->SurveyDescription = $surveyDetails->SurveyDescription;
                $scheduleSurveyObj->SurveyTitle = $surveyDetails->SurveyTitle;
                $scheduleSurveyObj->SurveyId = $surveyDetails->_id;
                $scheduleSurveyObj->SurveyRelatedGroupName = $surveyDetails->SurveyRelatedGroupName;
            }
            $scheduleSurveyObj->StartDate = new MongoDate(strtotime($scheduleSurveyForm->StartDate));
            $scheduleSurveyObj->EndDate = new MongoDate(strtotime($scheduleSurveyForm->EndDate));
//            $scheduleSurveyObj->Players = array();
//           $scheduleSurveyObj->ShowDisclaimer=(int)$scheduleSurveyForm->ShowDisclaimer;
            $scheduleSurveyObj->ShowThankYou = (int) $scheduleSurveyForm->ShowThankYou;
            $scheduleSurveyObj->ThankYouMessage = $scheduleSurveyForm->ThankYouMessage;
            $scheduleSurveyObj->ThankYouImage = $scheduleSurveyForm->ThankYouArtifact;
            $scheduleSurveyObj->UserAnswers = array();
            $scheduleSurveyObj->Status = (int) 1;
            $scheduleSurveyObj->MaxSpots = (int) $scheduleSurveyForm->MaxSpots;
           // $scheduleSurveyObj->SessionTime = (int) $scheduleSurveyForm->SessionTime;
            $scheduleSurveyObj->QuestionView = (int) $scheduleSurveyForm->QuestionView;
            $scheduleSurveyObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
//            $scheduleSurveyObj->RenewSchedules = $scheduleSurveyForm->RenewSchedules;
            $scheduleSurveyObj->ConvertInStreamAdd = (int) $scheduleSurveyForm->ConvertInStreamAdd;
            if (isset($createdDate) && !empty($createdDate)) {
                $scheduleSurveyObj->CreatedOn = new MongoDate(strtotime(date($createdDate, time())));
            }
            $scheduleSurveyObj->IsCurrentSchedule = (int) 1;
            $scheduleSurveyObj->CreatedUserId = (int) $userId;
            if ($scheduleSurveyObj->save()) {
                $returnValue = $scheduleSurveyObj->_id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("***********exception*******************" . $exc->getMessage());
            Yii::log("in exception" . $exc->getMessage(), 'error', 'application');
        }
    }

    public function checkSurveyScheduleForDates($startDate, $endDate,$surveyId,$groupName) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('StartDate', '<=', new MongoDate(strtotime($startDate)));
            $criteria->addCond('EndDate', '>=', new MongoDate(strtotime($startDate)));
            $criteria->addCond('IsCurrentSchedule', '==', (int) 1);
            $criteria->addCond('SurveyRelatedGroupName', '==', (string) $groupName);
            $isSurveyExists = ScheduleSurveyCollection::model()->find($criteria);            
            if (is_object($isSurveyExists) || is_array($isSurveyExists)) {
                $returnValue = $isSurveyExists;
            } else {
                $criteria = new EMongoCriteria;
                $criteria->addCond('StartDate', '<=', new MongoDate(strtotime($endDate)));
                $criteria->addCond('EndDate', '>=', new MongoDate(strtotime($endDate)));
                $criteria->addCond('IsCurrentSchedule', '==', (int) 1);
                $criteria->addCond('SurveyRelatedGroupName', '==', $groupName);
                $isSurveyExists = ScheduleSurveyCollection::model()->find($criteria);
                if (is_object($isSurveyExists) || is_array($isSurveyExists)) {
                    $returnValue = $isSurveyExists;
                } else {
                    $returnValue = 'false';
                }
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("in exception" . $exc->getMessage(), 'error', 'application');
            error_log("##########Exception Occurred in checkSurveyScheduleForDates#######" . $exc->getMessage());
        }
    }

    public function getAllScheduleGames(){
          try {
              $returnValue='failure';
              $criteria = new EMongoCriteria;
              $scheduleGames=ScheduleGameCollection::model()->findAll($criteria);
              if(is_array($scheduleGames)){
                  $returnValue=$scheduleGames;
              }
             return $returnValue;
          } catch (Exception $exc) {
              Yii::log("in exception".$exc->getMessage(),'error','application');
                return $returnValue;
          }
            }

        public function getScheduleSurveyDetailsObject($columnName, $value) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            if ($columnName == 'Id') {
                $criteria->addCond('_id', '==', new MongoId($value));
            }if ($columnName == 'SurveyTitle') {
                $criteria->addCond('SurveyTitle', '==', $value);
            }
            if ($columnName == 'IsCurrentSchedule') {
                $criteria->addCond('IsCurrentSchedule', '==', $value);
            }
            if ($columnName == 'SurveyId') {
                $criteria->addCond('SurveyId', '==', new MongoId($value));
            }
            $scheduleSurveyObj = ScheduleSurveyCollection::model()->find($criteria);
            if (is_array($scheduleSurveyObj) || is_object($scheduleSurveyObj)) {
                $returnValue = $scheduleSurveyObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("while saving survey schedule..." . $exc->getMessage(), 'error', 'application');
            error_log("########Exception Occurred in the getScheduleSurveyDetailsObject###########".$exc->getMessage());
            return $returnValue;
        }
    }
      
      public function getPreviousOrFutureSurveySchedule($surveyId,$startDate,$endDate,$type){
          try {
              $returnValue="failure";
              $criteria = new EMongoCriteria();
            $criteria->addCond('SurveyId', '==', new MongoID($surveyId));      
            
            if($type=='past'){
             $criteria->addCond('StartDate', '<=', new MongoDate(strtotime($startDate)));    
             $criteria->sort('StartDate', 'desc');
            }else{
              $criteria->addCond('StartDate', '>=', new MongoDate(strtotime($startDate)));       
              $criteria->sort('StartDate', 'asc');
            }
            
            $criteria->limit(1);
            
            
            $obj=  ScheduleSurveyCollection::model()->find($criteria); 
            if(is_object($obj)){
                $returnValue=$obj;
            }
            return $returnValue;
          } catch (Exception $exc) {
              Yii::log("in ____".$exc->getMessage(),'error','application');
          }
            }
      public function getAllScheduleGamesForAnalytics($gameId,$startLimit, $pageLength,$type){
          try {
              $returnValue='failure';
              $criteria = new EMongoCriteria;
              if($type!="xls"){
                 $criteria->limit($pageLength);
                $criteria->offset($startLimit);  
              }
              $criteria->sort("StartDate",EMongoCriteria::SORT_ASC);  
            if($gameId != "AllGames"){
              $criteria->GameId = new MongoId($gameId);
            }
//              $array = array(
//                'conditions'=>array(
//                  
//                    'GameId'=>array('==' => new MongoId()), // Or 'FieldName1'=>array('>=' => 10)
//            //        'FieldName2'=>array('in' => array(1, 2, 3)),
//            //        'FieldName3'=>array('exists'),
//                ),
//                'limit'=>$pageLength,
//                'offset'=>$startLimit,
//                //'sort'=>array('fieldName1' => EMongoCriteria::SORT_ASC, 'fieldName4' => EMongoCriteria::SORT_DESC),
//             );
              $scheduleGames=ScheduleGameCollection::model()->findAll($criteria);
              if(is_array($scheduleGames)){
                  $returnValue=$scheduleGames;
              }
             return $returnValue;
          } catch (Exception $exc) {
              Yii::log("in exception".$exc->getMessage(),'error','application');
                return $returnValue;
          }
            }
     public function getAllScheduleGamesCount($gameId){
          try {
              $returnValue='failure';
              $criteria = new EMongoCriteria;
               if($gameId != "AllGames"){
                $criteria->GameId = new MongoId($gameId);
              }
               $count=ScheduleGameCollection::model()->count($criteria);
              return $count;
          } catch (Exception $exc) {
              Yii::log("in exception".$exc->getMessage(),'error','application');
                return $returnValue;
          }
            }
            
     public function getSchedulesForSurvey($surveyId){
             $returnValue = 'failure';
         try {
            
          $criteria = new EMongoCriteria;       
          $criteria->setSelect(array('MaxSpots'=>true,'StartDate'=>true,'EndDate'=>true,'_id'=>true,'SurveyId'=>true,'IsCurrentSchedule'=>true,'IsCancelSchedule'=>true,'SurveyTakenUsers'=>true));
          $criteria->addCond('SurveyId', '==', new MongoId($surveyId));
          $criteria->sort('StartDate', 'asc');
          
          $surveySchedules =  ScheduleSurveyCollection::model()->findAll($criteria);
          
          if(count($surveySchedules)>0 ){
              $returnValue = $surveySchedules;
          }
         return $returnValue;
         } catch (Exception $exc) {
             Yii::log("____".$exc->getMessage(),'error','application');
             return $returnValue;
         }
          }


            
        public function removeFutureSurveySchedule($surveyId, $startDate) {
        try {
            $criteria = new EMongoCriteria();
            $criteria->addCond('SurveyId', '==', new MongoID($surveyId));
            $criteria->addCond('StartDate', '>', new MongoDate(strtotime($startDate)));
            $return = ScheduleSurveyCollection::model()->deleteAll($criteria);
            return $return;
        } catch (Exception $exc) {
            Yii::log("in ____" . $exc->getMessage(), 'error', 'application');
        }
    }
     public function updateCurrentScheduleSurveyByToday($scheduleId,$surveyId, $date) {
        try {
            $returnValue = "failure";
            $criteria = new EMongoCriteria();
            $criteria->addCond('SurveyId', '==', new MongoID($surveyId));
            $criteria->addCond('_id', '==', new MongoID($scheduleId));
             $criteria->addCond('IsCurrentSchedule', '==', (int) 1);
            $modifier = new EMongoModifier();
            $modifier->addModifier('IsCurrentSchedule', 'set', (int) 0);
            $modifier->addModifier('EndDate', 'set', new MongoDate(strtotime($date)));
            $modifier->addModifier('IsCancelSchedule', 'set', (int) 1);            
            ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);

            $criteria = new EMongoCriteria();
            $criteria->addCond('_id', '==', new MongoID($surveyId));
            $modifier = new EMongoModifier();
            $modifier->addModifier('IsCurrentSchedule', 'set', (int) 0);
            ExtendedSurveyCollection::model()->updateAll($modifier, $criteria);

            return "success";
        } catch (Exception $exc) {
            Yii::log("in Schedule survey" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    
       public function isCurrentScheduleByScheduleId($surveyId, $scheduleId) {
        try {
            $returnValue = false;
            $criteria = new EMongoCriteria();
            $criteria->addCond('_id', '==', new MongoId($scheduleId));
            $criteria->addCond('IsCurrentSchedule', '==',(int) 1);
            $obj = ScheduleSurveyCollection::model()->find($criteria);
            if (is_object($obj)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            Yii::log("in isCurrentScheduleByScheduleId" . $exc->getMessage(), 'error', 'application');
            return false;
        }
    }

    
     public function updateSurveyAnswer($model,$NetworkId,$UserId,$flag){
        try{        
            error_log("update survey answer------------------------".$UserId);
            $returnValue = "failed";
            $scheduleObj = new ScheduleSurveyCollection();
            $scheduleObj->UserAnswers = $model->UserAnswers;            
                    
            $criteria = new EMongoCriteria();
            $modifier = new EMongoModifier();
            $criteria->addCond('_id', '==', new MongoId($model->ScheduleId));
            $scheduleSurveyObj = ScheduleSurveyCollection::model()->find($criteria);
//            foreach($scheduleObj->UserAnswers as $userAnswer){                
////                 $modifier->addModifier('UserAnswers', 'pushAll', $userAnswer);   
//            }
            if($flag == "Done"){
//                $resumeUsers = $scheduleSurveyObj->ResumeUsers;
//                $SurveyTakenUsers = "";
//                foreach ($resumeUsers as $key=>$resumeUser) {
//                    if($resumeUser["UserId"] == $UserId){
//                        $SurveyTakenUsers = $resumeUser;
//                        unset($resumeUsers[$key]);
//                        break;
//                    }
//                }
                 $modifier->addModifier('SurveyTakenUsers', 'push', (int)$UserId);
                 $modifier->addModifier('ResumeUsers', 'pull', (int)$UserId);
                 
            }
           
            $modifier->addModifier('UserAnswers', 'pushAll', $scheduleObj->UserAnswers);
            if(ScheduleSurveyCollection::model()->updateAll($modifier, $criteria)){
                if($flag == "Done"){
                ScheduleSurveyCollection::model()->updateSurveyAnswerFromBuffer($model,$NetworkId,$UserId);
 
                }
                 $returnValue = "success"; 
            }
            if(is_object($scheduleSurveyObj)){
                return "success";
            }else{
                return $returnValue;
            }
        } catch (Exception $ex) {
            error_log("######Exception Occurred#########".$ex->getMessage());
        }
    }
  public function updateSurveyAnswerFromBuffer($model,$NetworkId,$UserId){
      error_log("updateSurveyAnswerFromBuffer----");
      $userAnswers = SurveyUsersSessionCollection::model()->getAnswersForSurvey($UserId,$model->ScheduleId);
      if(is_array($userAnswers) && sizeof($userAnswers)>0){
            $criteria = new EMongoCriteria();
            $modifier = new EMongoModifier();
            $criteria->addCond('_id', '==', new MongoId($model->ScheduleId));
           // $scheduleSurveyObj = ScheduleSurveyCollection::model()->find($criteria);
//            foreach($scheduleObj->UserAnswers as $userAnswer){                
////                 $modifier->addModifier('UserAnswers', 'pushAll', $userAnswer);   
//            }
            $modifier->addModifier('UserAnswers', 'pushAll', $userAnswers);
           //  $modifier->addModifier('UserAnswers', 'pushAll', $userAnswers);
           ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);
           
      }
       SurveyUsersSessionCollection::model()->unsetSpotForUser($UserId,$model->ScheduleId,"Done");
        return "success"; 
      
  }
   public function getOptionCountValue($questionId,$option){
      
          $criteria = new EMongoCriteria;
     $criteria->setSelect(array("UserAnswers"=>true));


            $criteria->addCond('UserAnswers.QuestionId', '==',new MongoId($questionId));
          $criteria->addCond('UserAnswers.SelectedOption', '==',(int)$option);
          $object =ScheduleSurveyCollection::model()->find($criteria);          
         
         //  error_log($questionId."--option-----".$option."---count-----".$object);
         
   }
    public function isAlreadyDoneByUser($UserId,$GroupName,$surveyObj){
        try{
            $returnValue = "";
            $obj = array();
            $isExist = 0;
            $scheduleId = "";
            $i = 0;
            $surveyId = "";
            $StartDate = date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get()));
            foreach($surveyObj as $rw){
                $criteria = new EMongoCriteria();
                $criteria->addCond('StartDate', '<=', new MongoDate(strtotime($StartDate)));
                $criteria->addCond('IsCurrentSchedule', '==', (int) 1);
                //$criteria->addCond('IsDeleted', '==', (int) 0);
                $criteria->addCond('SurveyRelatedGroupName', "==", (string) $GroupName);
                $criteria->addCond("SurveyId",'==', new MongoId($rw->_id));
                $obj = ScheduleSurveyCollection::model()->find($criteria);
                if(!empty($obj)){
                    if(in_array($UserId,$obj->SurveyTakenUsers)){                        
                        $scheduleId = $obj->_id;
                        $surveyId = $rw->_id;
                        $isExist = 1;
                        break;
                    }else{
                        $surveyId = $rw->_id;
                        $scheduleId = $obj->_id;
                    }                    
                    
                }else{
                    $obj = array();
                }
                $i++;
            }
            if($isExist == 1 && !empty($scheduleId)){                
                $returnValue = "done_".$scheduleId."_".$surveyId;
            }else if(!empty($scheduleId)){
                $returnValue = "notdone_".$scheduleId."_".$surveyId;
            }else{
                $returnValue = "notscheduled_notscheduled";
            }
            return $returnValue;
             
        } catch (Exception $ex) {

        }
    }
    function checkUserDoneSurvey($userId,$surveyTakenUsers){
        foreach ($surveyTakenUsers as $value) {
            if($userId == $value["UserId"]){
                return TRUE;
            }
        }
        return FALSE;
    }
    public function getSurveyAnalyticsData($pageLength,$offset,$searchText,$filterValue,$timezone){
        try{
            $searchText = trim($searchText);
            $result = array();
            $searcha = array();
            $totalArray = array();
            $filtAr = array();
            if(!empty($searchText)){
                $searcha =  array('eq' => new MongoRegex('/' . $searchText . '.*/i'));
            }
//            if(!empty($filterValue)){
//                if($filterValue != "all")
//                    $filtAr = array('==',(int) 1);
//            }            
            $array = array(
                'conditions' => array(
                   'SurveyTitle' => $searcha,
//                   'IsDeleted' => $filtAr,               
                ),

                'limit' => $pageLength,
                'offset' => $offset,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
             $result = ScheduleSurveyCollection::model()->findAll($array);
             foreach($result as $data){
                 $surveyBean = new SurveyAnalyticsDataBean;
                 $surveyTitle= strip_tags(($data->SurveyTitle));                 
                 $textLength =  strlen($surveyTitle);
                 if($textLength>240){
                    $data->SurveyTitle =  CommonUtility::truncateHtml($data->SurveyTitle, 240,'Read more',true,true,' <i class="fa  moreicon">'.Yii::t('translation','Readmore').'</i>'); 
                    $data->SurveyTitle = $data->SurveyTitle;
                    
                 }
                 $surveyBean->SurveyTitle = $data->SurveyTitle;                
                 $surveyBean->SurveyRelatedGroupName = $data->SurveyRelatedGroupName;
                 $criteria = new EMongoCriteria;
                 $criteria->addCond("_id","==",new MongoId($data->SurveyId));
                 $surveyObj = ExtendedSurveyCollection::model()->find($criteria);
                 $surveyBean->QuestionsCount = $surveyObj->QuestionsCount;
                 $dateFormat =  CommonUtility::getDateFormat();
                 
                 $surveyBean->StartDate = date($dateFormat,CommonUtility::convert_date_zone($data['StartDate']->sec,$timezone,  date_default_timezone_get())) ;
                 $surveyBean->EndDate = date($dateFormat,CommonUtility::convert_date_zone($data['EndDate']->sec,$timezone,  date_default_timezone_get())) ;                 
                 $surveyBean->SurveyId = $surveyObj->_id;
                 $surveyBean->ScheduleId = $data->_id;
                 $surveyBean->IsCurrentSchedule = $data->IsCurrentSchedule;
                 $surveyBean->TotalUsersCount = sizeof($data->SurveyTakenUsers)+sizeof($data->ResumeUsers);
                 $surveyBean->AbondonedUsersCount = sizeof($data->ResumeUsers);
                 $surveyBean->CompletedUsersCount = sizeof($data->SurveyTakenUsers);
                 $surveyBean->MaxSpots = $data->MaxSpots;
                 array_push($totalArray,$surveyBean);
            }
        } catch (Exception $ex) {
            error_log("########Exception Occurred#######".$ex->getMessage());
        }
        return $totalArray;
    }
    
    public function getSurveyAnalyticsDataCount($filterValue,$searchText){
        try{
            $searchText = trim($searchText);
            $result = array();
            $searcha = array();
            $filtAr = array();
            if(!empty($searchText)){
                $searcha =  array('eq' => new MongoRegex('/' . $searchText . '.*/i'));
            }
            if(!empty($filterValue)){
                if($filterValue != "all")
                    $filtAr = array('==',(int) 1);
            }            
            $array = array(
                'conditions' => array(
                   'SurveyTitle' => $searcha,
                   'IsDeleted' => $filtAr,               
                ),

                'limit' => $pageLength,
                'offset' => $offset,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
             $result = ScheduleSurveyCollection::model()->count($array);
        } catch (Exception $ex) {
            error_log("########Exception Occurred#######".$ex->getMessage());
        }
        return $result;
    }
    
    public function getScheduleSurveyDetailsObjectByGroupName($groupName,$surveyId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;     
            $criteria->addCond('SurveyId', '==', new MongoId($surveyId));
            $criteria->addCond('SurveyRelatedGroupName', '==', (string)$groupName);
            $scheduleSurveyObj = ScheduleSurveyCollection::model()->findAll($criteria);
            if (is_array($scheduleSurveyObj) || is_object($scheduleSurveyObj)) {
                $returnValue = $scheduleSurveyObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("while saving survey schedule..." . $exc->getMessage(), 'error', 'application');
            error_log("########Exception Occurred in the getScheduleSurveyDetailsObjectByGroupName###########".$exc->getMessage());
            return $returnValue;
        }
    }
    
    public function getUserOtherValues($surveyId, $questionId,$offset,$pageLength){
        try{
            
            
//            $c = ScheduleSurveyCollection::model()->getCollection();
//            $results = $c->aggregate(
//                array(
//                    "SurveyId"=> new MongoId($surveyId),
//                    "IsCurrentSchedule"=>1,
//                    "UserAnswers.QuestionId"=>new MongoId($questionId)
//                ),
//                array(
//                    "UserAnswers.$"=>1
//                )
//        );
//         $res = $results->getNext();
//           
//        error_log("=========res=================".sizeof($res["UserAnswers"]));
//        
//        return $res["UserAnswers"];
            
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;     
            $criteria->addCond('SurveyId', '==', new MongoId($surveyId));
            $criteria->addCond('IsCurrentSchedule', '==', (int) 1);            
            //$criteria->UserAnswers->QuestionId('$elemmatch' ,new MongoId($questionId));
            $criteria->setOffset($offset);
            $criteria->setLimit($pageLength);
            $scheduleSurveyObj = ScheduleSurveyCollection::model()->findAll($criteria);
            if (is_array($scheduleSurveyObj) || is_object($scheduleSurveyObj)) {
                $returnValue = $scheduleSurveyObj;
            }
            $returnValue = $scheduleSurveyObj;
            $res = $returnValue[0]['UserAnswers'];
//            error_log("============returnValue==========".print_r($returnValue[0]['UserAnswers'], true));
            return $res;
        } catch (Exception $ex) {
            Yii::log("getUserOtherValues..." . $ex->getMessage(), 'error', 'application');
            error_log("########Exception Occurred in the getUserOtherValues###########".$ex->getMessage());
        }
    }

    public function getSurveyTakenUsers($scheduleId){
        try{
           // error_log("getSurveyTakenUsers--scid---".$scheduleId);
            $criteria = new EMongoCriteria;     
            $criteria->setSelect(array('SurveyTakenUsers'=>true));
            $criteria->addCond('_id', '==', new MongoId($scheduleId));
            $obj =  ScheduleSurveyCollection::model()->find($criteria);
           // error_log("getSurveyTakenUsers---".  print_r($obj,true));
            return sizeof($obj->SurveyTakenUsers);
            
        } catch (Exception $ex) {
 error_log("########getSurveyTakenUsers###########".$ex->getMessage());
        }
    }
    public function validateSpotsConfirmed($model){
        try{
            error_log("---".$model->ScheduleId);
          $criteria = new EMongoCriteria;     
            $criteria->setSelect(array('SurveyTakenUsers'=>true,'MaxSpots'=>true));
            $criteria->addCond('_id', '==', new MongoId($model->ScheduleId));
            $obj =  ScheduleSurveyCollection::model()->find($criteria); 
            error_log("oooo-------------".count($obj->SurveyTakenUsers));
            if($obj->MaxSpots == 0 || count($obj->SurveyTakenUsers)<$obj->MaxSpots){
                error_log("u can do survey---------------");
                return true;
            }else{
                 error_log("u cannot do survey---------------");
                 return false;
            }
        } catch (Exception $ex) {
 error_log("########validateSpotsConfirmed###########".$ex->getMessage());
        }
    }

    public function IsSurveyAlreadySchedule($surveyObj){
        try{
            $returnValue = false;
            $criteria = new EMongoCriteria();
            $criteria->addCond('SurveyId', '==', new MongoId($surveyObj->_id));
            $obj = ScheduleSurveyCollection::model()->find($criteria);
            if (is_object($obj)) {
                return true;
            } else {
                return 0;
            }
            
        } catch (Exception $ex) {
            error_log("########Exception Occurred in IsSurveyAlreadySchedule##############".$ex->getMessage());
        }
    }
    public function getActiveSchedule($surveyId){
        try{
            $returnValue = false;
            $criteria = new EMongoCriteria();
            $criteria->addCond('SurveyId', '==', new MongoId($surveyId));
            $criteria->addCond('IsCurrentSchedule', '==', (int) 1);   
            $obj = ScheduleSurveyCollection::model()->find($criteria);
            if (is_object($obj)) {
                return $obj;
            } else {
                return 0;
            }
            
        } catch (Exception $ex) {
            error_log("########Exception Occurred in IsSurveyAlreadySchedule##############".$ex->getMessage());
        }
    }
    
    public function updateThanksFlagId($sId){
        try{
            $criteria = new EMongoCriteria();
            $modifier = new EMongoModifier();
            $criteria->addCond('_id', '==', new MongoId($sId));
            $modifier->addModifier('ShowThankYou', 'set', (int) 0);
           ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);
        } catch (Exception $ex) {

        }
    }
     public function addtoResumeUsers($surveyId,$scheduleId,$userId) {
         error_log("---addtoResumeUsers----".$surveyId."---".$scheduleId."--".$userId);
        // ScheduleSurveyCollection::model()->allocateSpot($surveyId,$scheduleId,$userId);
      //   return;
    try{
           $returnValue = 'false';
            $criteria = new EMongoCriteria;
           // $criteria->addCond('UserId', '==',(int)$userId);
            $criteria->addCond('_id', '==',new MongoId($scheduleId));
            $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
            $criteria->addCond('ResumeUsers', 'in',array((int) $userId));
            $surveySessionObj = ScheduleSurveyCollection::model()->find($criteria);
             if (is_object($surveySessionObj)) {
                 error_log("manageSurveyUserSessionNew exists--------------");
//
//             $criteria = new EMongoCriteria;
//              $modifier = new EMongoModifier();
//               $criteria->addCond('_id', '==',new MongoId($scheduleId));
//             $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
//               $criteria->addCond('ResumeUsers.UserId', '==',(int) $userId);
//             $modifier->addModifier('ResumeUsers.$.startTime', 'set',new MongoDate());
//             
//            
//            $surveySessionObj = ScheduleSurveyCollection::model()->updateAll($modifier,$criteria);
             }else{
                  $criteria = new EMongoCriteria;
           // $criteria->addCond('UserId', '==',(int)$userId);
              $criteria->addCond('_id', '==',new MongoId($scheduleId));
              $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
               $modifier = new EMongoModifier();
              // $resumeRecord = array("UserId" => (int)$userId,"startTime" => new MongoDate(),"endTime"=>"","totalSpentTime"=>"0");
               
               $modifier->addModifier('ResumeUsers', 'push', (int)$userId);
               ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);
              $returnValue = "success";
}


             
              
             return $returnValue;
    }catch(Exception $ex){
        error_log("erro message==========".$ex->getMessage());
    }
         return $returnValue;
    }
    function allocateSpot($surveyId,$scheduleId,$userId){
           $criteria = new EMongoCriteria;
         $criteria->addCond('_id', '==',new MongoId($scheduleId));
            $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
            $criteria->addCond('AllocatedSpots', 'in',array((int)$userId));
             $surveySessionObj = ScheduleSurveyCollection::model()->find($criteria);
             if (is_object($surveySessionObj)) {
                 error_log("allocateSpot---spot  exists--------------");

             }else{
                  $criteria = new EMongoCriteria;
           // $criteria->addCond('UserId', '==',(int)$userId);
              $criteria->addCond('_id', '==',new MongoId($scheduleId));
              $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
               $modifier = new EMongoModifier();
               $modifier->addModifier('AllocatedSpots', 'addToSet', (int) $userId);
               ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);
              $returnValue = "success";
             }
    }
    
    public function updatePreviousSchedulesToZero($StartDate,$SurveyId){
        try{
            $returnValue = "failure";
            $criteria = new EMongoCriteria;
            $criteria->addCond('StartDate', '<=', new MongoDate(strtotime($StartDate)));
            $criteria->addCond('SurveyId', '==',new MongoId($SurveyId));
            $criteria->addCond('IsCurrentSchedule', '==', (int) 1);
            $modifier = new EMongoModifier();
            $modifier->addModifier('IsCurrentSchedule', 'set', (int) 0);
            $modifier->addModifier('IsCancelSchedule', 'set', (int) 1);
            
            ScheduleSurveyCollection::model()->updateAll($modifier,$criteria);    
             return 'success';
        }catch(Exception $ex){
            error_log("#########Exception Occurred while update Previous#######".$ex->getTraceAsString());
        }
    }
     public function getOtherDataForQuestion($scheduleId,$questionId,$questionType){
         try {
             $otherValues = array();
             $c = ScheduleSurveyCollection::model()->getCollection();
             if($questionType == 3 || $questionType == 4 ){
             $result = $c->aggregate(array('$match' => array('_id' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$group' => array("_id" => '$_id',"OtherValues" => array('$push' => '$UserAnswers.OptionOtherTextValue'))));   
     
             }else{
             $result = $c->aggregate(array('$match' => array('_id' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$group' => array("_id" => '$_id',"OtherValues" => array('$push' => '$UserAnswers.OtherValue'))));   
      
             }
            if(is_array($result['result'])&& sizeof($result['result'])>0 ){
               $otherValues =  $result['result'][0]["OtherValues"];
               // $otherValues = array_count_values($otherValues);
            }
            
              $c = SurveyUsersSessionCollection::model()->getCollection();
             if($questionType == 3 || $questionType == 4 ){
             $result = $c->aggregate(array('$match' => array('ScheduleId' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$group' => array("_id" => '$_id',"OtherValues" => array('$push' => '$UserAnswers.OptionOtherTextValue'))));   
     
             }else{
             $result = $c->aggregate(array('$match' => array('ScheduleId' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$group' => array("_id" => '$ScheduleId',"OtherValues" => array('$push' => '$UserAnswers.OtherValue'))));   
      
             }
              if(is_array($result['result'])&& sizeof($result['result'])>0 ){
               $otherValues = array_merge($otherValues,$result['result'][0]["OtherValues"]);
                 error_log("optnos cimm------".print_r($result['result'][0]["OtherValues"],true));
                
            }
            if(count($otherValues)>0){
                $otherValues = array_filter($otherValues);
                  $otherValues = array_count_values($otherValues);
            }
          
          return $otherValues;
//             $c.aggregate(
//    { $match: {_id: ObjectId("512e28984815cbfcb21646a7")}},
//    { $unwind: '$list'},
//    { $match: {'list.a': {$gt: 3}}},
//    { $group: {_id: '$_id', list: {$push: '$list.a'}}})
         } catch (Exception $ex) {
             
         }
    }
         public function getJustificationDataForQuestion($scheduleId,$questionId,$questionType,$offset,$pageLimit){
         try {
             $usersArray = array();
             $optionCommentsArray = array();
             $selectedOptionsArray = array();
             $c = ScheduleSurveyCollection::model()->getCollection();
             if($questionType == 3 || $questionType == 4 ){
             $result = $c->aggregate(array('$match' => array('_id' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$_id',"OptionCommnets" => array('$push' => '$UserAnswers.OptionCommnets'),"UserId" => array('$push' => '$UserAnswers.UserId'),"SelectedOptions" => array('$push' => '$UserAnswers.Options'))));   
             }else if($questionType == 8){
                $result = $c->aggregate(array('$match' => array('_id' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$_id',"OptionCommnets" => array('$push' => '$UserAnswers.OtherValue'),"UserId" => array('$push' => '$UserAnswers.UserId'),"SelectedOptions" => array('$push' => '$UserAnswers.SelectedOption'))));     
             }
          
            if(is_array($result['result'])&& sizeof($result['result'])>0 ){
               //$optionCommnets =  $result['result'][0]["OptionCommnets"];
               $optionCommentsArray = $result['result'][0]["OptionCommnets"];
               $usersArray = $result['result'][0]["UserId"];
               $selectedOptionsArray = $result['result'][0]["SelectedOptions"];
            }
            
             $c = SurveyUsersSessionCollection::model()->getCollection();
             if($questionType == 3 || $questionType == 4 ){
             $result = $c->aggregate(array('$match' => array('ScheduleId' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$ScheduleId',"OptionCommnets" => array('$push' => '$UserAnswers.OptionCommnets'),"UserId" => array('$push' => '$UserAnswers.UserId'),"SelectedOptions" => array('$push' => '$UserAnswers.Options'))));   
             }else if($questionType == 8){
                $result = $c->aggregate(array('$match' => array('ScheduleId' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$ScheduleId',"OptionCommnets" => array('$push' => '$UserAnswers.OtherValue'),"UserId" => array('$push' => '$UserAnswers.UserId'),"SelectedOptions" => array('$push' => '$UserAnswers.SelectedOption'))));     
             }
          
            if(is_array($result['result'])&& sizeof($result['result'])>0 ){
              // $optionCommnets =  $result['result'][0]["OptionCommnets"];
               $optionCommentsArray = array_merge($optionCommentsArray,$result['result'][0]["OptionCommnets"]);
               $usersArray = array_merge($usersArray,$result['result'][0]["UserId"]);
               $selectedOptionsArray = array_merge($selectedOptionsArray,$result['result'][0]["SelectedOptions"]);
            }
            
            
           // error_log("optnos cimm------".print_r($optionCommentsArray,true));
            
          return array("UsersArray"=>$usersArray,"OptionCommentsArray"=>$optionCommentsArray,"SelectedOptionsArray"=>$selectedOptionsArray);
//             $c.aggregate(
//    { $match: {_id: ObjectId("512e28984815cbfcb21646a7")}},
//    { $unwind: '$list'},
//    { $match: {'list.a': {$gt: 3}}},
//    { $group: {_id: '$_id', list: {$push: '$list.a'}}})
         } catch (Exception $ex) {
             
         }
    }

    
    public function getAllSchedulesBySurveyId($surveyId){
        try{
            $criteria = new EMongoCriteria;            
            $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
            $criteria->addCond('IsCurrentSchedule', '==', (int) 0);
            $obj = ScheduleSurveyCollection::model()->findAll($criteria);
            return $obj;
        } catch (Exception $ex) {
            error_log("#########Exception Occurred while getAllSchedulesBySurveyId#######".$ex->getMessage());
        }
    }


 public function getCurrentScheduleForNewUser($bundle){
        try{
            $criteria = new EMongoCriteria;
            $criteria->addCond("SurveyRelatedGroupName","==",$bundle);
            $criteria->addCond("IsCurrentSchedule","==",(int) 1);
            $returnObj = ScheduleSurveyCollection::model()->find($criteria);
            return $returnObj;
        } catch (Exception $ex) {
            return $returnValue;
        }
    }
    
    
    
    public function getAnswersDataForQuestion($scheduleId, $questionId, $questionType, $offset, $pageLimit){
        try {
            $usersArray = array();
            $userAnswerArray = array();
            $usergeneratedRankingOptions = array();
            $c = ScheduleSurveyCollection::model()->getCollection();
            if($questionType == 6){                
                $result = $c->aggregate(array('$match' => array('_id' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$_id',"UserAnswer" => array('$push' => '$UserAnswers.UserAnswer'),"UserId" => array('$push' => '$UserAnswers.UserId'))));
            }else if($questionType == 7){
                $result = $c->aggregate(array('$match' => array('_id' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$_id',"UserId" => array('$push' => '$UserAnswers.UserId'),"UsergeneratedRankingOptions" => array('$push' => '$UserAnswers.UsergeneratedRankingOptions'))));
            }
          
            if(is_array($result['result']) && sizeof($result['result']) > 0 ){
               $userAnswerArray = $result['result'][0]["UserAnswer"];
               $usersArray = $result['result'][0]["UserId"];
               $usergeneratedRankingOptions = $result['result'][0]["UsergeneratedRankingOptions"];
            }
            
            $c = SurveyUsersSessionCollection::model()->getCollection();
            if($questionType == 6){
               $result = $c->aggregate(array('$match' => array('ScheduleId' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$ScheduleId',"UserAnswer" => array('$push' => '$UserAnswers.UserAnswer'),"UserId" => array('$push' => '$UserAnswers.UserId')))); 
            }else if($questionType == 7){
               $result = $c->aggregate(array('$match' => array('ScheduleId' =>new MongoID($scheduleId))),array('$unwind' =>'$UserAnswers'),array('$match' => array('UserAnswers.QuestionId' =>new MongoID($questionId))),array('$skip' => $offset),array('$limit' => $pageLimit),array('$group' => array("_id" => '$ScheduleId',"UserId" => array('$push' => '$UserAnswers.UserId'),"UsergeneratedRankingOptions" => array('$push' => '$UserAnswers.UsergeneratedRankingOptions')))); 
            }            
          
            if(is_array($result['result'])&& sizeof($result['result'])>0 ){
                if(is_array($result['result'][0]["UserAnswer"])){
                    $userAnswerArray = array_merge($userAnswerArray,$result['result'][0]["UserAnswer"]);
                }
                if(is_array($result['result'][0]["UsergeneratedRankingOptions"])){
                    $usergeneratedRankingOptions = array_merge($usergeneratedRankingOptions,$result['result'][0]["UsergeneratedRankingOptions"]);
                }
               $usersArray = array_merge($usersArray,$result['result'][0]["UserId"]);    
               
            }
            
            //error_log("optnos cimm------".print_r($usergeneratedRankingOptions,true));
            
          return array("UsersArray"=>$usersArray,"UserAnswerArray"=>$userAnswerArray, "UsergeneratedRankingOptions"=>$usergeneratedRankingOptions);
         } catch (Exception $ex) {
             Yii::log("getAnswersDataForQuestion...in ScheduleSurveyCollection." . $exc->getMessage(), 'error', 'application');
         }
    }

}

          
