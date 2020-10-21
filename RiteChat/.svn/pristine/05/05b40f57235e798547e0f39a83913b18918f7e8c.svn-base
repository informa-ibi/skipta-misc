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
    
    public function getCollectionName() {
        return 'ScheduleSurveyCollection';
    }
 public static function model($className = __CLASS__) {
        return parent::model($className);
    }
//    public function indexes() {
//        return array(
//            'index_survey' => array(
//                'key' => array(                    
//                    'CreatedOn' => EMongoCriteria::SORT_DESC,
//                    'SurveyTitle' => EMongoCriteria::SORT_ASC,
//                ),
//            )
//        );
//    }
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
         'SurveyRelatedGroupName'=> 'SurveyRelatedGroupName'
         
     );
     
     
     }
     
     public function saveScheduleSurvey($scheduleSurveyForm, $currentScheduleSurvey, $userId,$createdDate=null) {
        try {
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
          $criteria->setSelect(array('StartDate'=>true,'EndDate'=>true,'_id'=>true,'SurveyId'=>true,'IsCurrentSchedule'=>true,'IsCancelSchedule'=>true,'SurveyTakenUsers'=>true));
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
     public function updateCurrentScheduleSurveyByToday($surveyId, $date) {
        try {
            $returnValue = "failure";
            $criteria = new EMongoCriteria();
            $criteria->addCond('SurveyId', '==', new MongoID($surveyId));
             $criteria->addCond('IsCurrentSchedule', '==', 1);
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

    
    public function updateSurveyAnswer($model,$NetworkId,$UserId){
        try{            
            $returnValue = "failed";
            $scheduleObj = new ScheduleSurveyCollection();
            $scheduleObj->UserAnswers = $model->UserAnswers;            
                    
            $criteria = new EMongoCriteria();
            $modifier = new EMongoModifier();
            $criteria->addCond('_id', '==', new MongoId($model->ScheduleId));
            $scheduleSurveyObj = ScheduleSurveyCollection::model()->find($criteria);
            foreach($scheduleObj->UserAnswers as $userAnswer){
                error_log("updateSurveyAnswer=========1111111====".print_r($userAnswer,1));
//                 $modifier->addModifier('UserAnswers', 'pushAll', $userAnswer);   
            }
            $modifier->addModifier('SurveyTakenUsers', 'push', (int) $UserId);
            $modifier->addModifier('UserAnswers', 'pushAll', $scheduleObj->UserAnswers);
            if(ScheduleSurveyCollection::model()->updateAll($modifier, $criteria))
               $returnValue = "success";   
            if(is_object($scheduleSurveyObj)){
                return $scheduleSurveyObj;
            }else{
                return $returnValue;
            }
        } catch (Exception $ex) {
            error_log("######Exception Occurred#########".$ex->getMessage());
        }
    }

   public function getOptionCountValue($questionId,$option){
      
          $criteria = new EMongoCriteria;
     $criteria->setSelect(array("UserAnswers"=>true));


            $criteria->addCond('UserAnswers.QuestionId', '==',new MongoId($questionId));
          $criteria->addCond('UserAnswers.SelectedOption', '==',(int)$option);
          $object =ScheduleSurveyCollection::model()->find($criteria);
          error_log(print_r($object,true));
         
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
            foreach($surveyObj as $rw){
                $criteria = new EMongoCriteria();
                $criteria->addCond('IsCurrentSchedule', '==', (int) 1);
                $criteria->addCond('SurveyRelatedGroupName', "==", (string) $GroupName);
                $criteria->addCond("SurveyId",'==', new MongoId($rw->_id));
                $obj = ScheduleSurveyCollection::model()->find($criteria);
                error_log("====SurveyId==$rw->_id====$i");
                if(!empty($obj)){
                    if(in_array($UserId,$obj->SurveyTakenUsers)){
                        $scheduleId = $obj->_id;
                        $surveyId = $rw->_id;
                        $isExist = 1;
                        error_log("=$scheduleId====break======");
                        break;
                    }else{
                        $surveyId = $rw->_id;
                        $scheduleId = $obj->_id;
                    }
                    error_log("=====is object==isExist=222222222==$isExist==$scheduleId");
                    
                    error_log("=====is object==scheduleId=====33333333333===$scheduleId==");
                    
                }else{
                    $obj = array();
                }
                $i++;
            }
            error_log("=======isExist=44444444444444==$isExist==");
            if($isExist == 1 && !empty($scheduleId)){                
                $returnValue = "done_".$scheduleId."_".$surveyId;
            }else if(!empty($scheduleId)){
                $returnValue = "notdone_".$scheduleId."_".$surveyId;
            }else{
                $returnValue = "notscheduled_notscheduled";
            }
            error_log("=======isExist=5555555555==$returnValue==");
            return $returnValue;
             
        } catch (Exception $ex) {

        }
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
                    $data->SurveyTitle =  CommonUtility::truncateHtml($data->SurveyTitle, 240,'...',true,true,' <i class="fa fa-ellipsis-h moreicon"></i>'); 
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
                 $surveyBean->SurveyedUsersCount = sizeof($data->SurveyTakenUsers);
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
}

          
