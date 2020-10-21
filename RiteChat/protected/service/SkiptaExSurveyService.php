
<?php 
class SkiptaExSurveyService {
    
    public function saveSurvey($FormModel,$NetworkId,$UserId){
        try{
            $return = "failed";
            $FormModel->SurveyLogo = $this->savePublicationArtifacts($FormModel->SurveyLogo);
            if(!empty($FormModel->SurveyId)){
                $return = $this->updateSurveyObject($FormModel);
            }else{
                $return = ExtendedSurveyCollection::model()->saveSurvey($FormModel,$NetworkId,$UserId);
            }
        } catch (Exception $ex) {
            error_log("#########Exception occurred#######".$ex->getMessage());
        }
    }
    
    function savePublicationArtifacts($Artifacts) {

     try {
          
         $returnValue = 'failure';
            $Resource = array();
            $folder = Yii::app()->params['WebrootPath'];
            $returnarry = array();
            if ($Artifacts != "") {
                $ExistArtifact = $folder . $Artifacts;

                if (!file_exists($ExistArtifact)) {
                    $imgArr = explode(".", $Artifacts);
                    $date = strtotime("now");
                    $finalImg_name = $imgArr[0] . '.' . end($imgArr);
                    $finalImage = trim($imgArr[0]) . '.' . end($imgArr);

                    $fileNameTosave = $folder . '/temp/' . $imgArr[0] . '.' . end($imgArr);
                    $sourceArtifact = $folder . '/temp/' . $Artifacts;
                    rename($sourceArtifact, $fileNameTosave);
                    //  $filename=$result['filename'];
                    $extension = substr(strrchr($Artifacts, '.'), 1);
                    $extension = strtolower($extension);

                   // $path = 'Profile';

                    $path = '/upload/ExSurvey/' . $path;
                    error_log("==0000000000000000=$path=====");
                    if (!file_exists($folder . '/' . $path)) {

                        mkdir($folder . '/' . $path, 0755, true);
                    }
                    $sourcepath = $fileNameTosave;
                    $destination = $folder . $path . '/' . $finalImage;
                    if (file_exists($sourcepath)) {
                       error_log("==111111111111111111=uploadImage=====");
                                list($width, $height) = getimagesize($sourcepath);
                              
                                if ($width >= 250) {
                                    $img = Yii::app()->simpleImage->load($sourcepath);
                                    $img->resizeToWidth(250);
                                    $img->save($destination);
                                   
                                } else {
                                   $destination = $folder . $path . '/' . $finalImage;
                                    copy($sourcepath, $destination);
                                }
                       
                       
                       // if (copy($sourcepath, $destination)) {
                            $newfile = trim($imgArr[0]) . '_' . $date . '.' . end($imgArr);
                            //  $newfile=trim($imgArr[0]) .'.' . $imgArr[1];
                            $finalSaveImage = $folder . $path . '/' . $newfile;
                            rename($destination, $finalSaveImage);
                            $UploadedImage = $path . $newfile;
                            $Resource['ResourceName'] = $artifact;
                            $Resource['Uri'] = $UploadedImage;
                            $Resource['Extension'] = $extension;
                            $Resource['ThumbNailImage'] = $UploadedImage;

                            // unlink($sourcepath);
                            $returnValue = "success";
                        //}
                    } else {
                        $UploadedImage = $path .$Artifacts;
                    }
                } else {
                    $UploadedImage = $Artifacts;
                    $Resource['ResourceName'] = "";
                    $Resource['Uri'] = "";
                    $Resource['Extension'] = "";
                    $Resource['ThumbNailImage'] = $UploadedImage;
                }
            }
            error_log("===uploadImage=====$UploadedImage");
            return $UploadedImage;
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        } 

   }
   
   public function getSurveyDetailsById($columnName,$_id){
       try{
           return ExtendedSurveyCollection::model()->getSurveyDetailsById($columnName,$_id);
       } catch (Exception $ex) {
           error_log("===Exception======".$ex->getMessage());
       }
   }
   
   public function updateSurveyObject($model){
       try{
           $questions = $model->Questions;
//           foreach ($questions as $key => $value) {
               
            $QuestinExist = ExtendedSurveyCollection::model()->CheckQuestionExist($model->SurveyId, $value->QuestionId);
            ExSurveyResearchGroup::model()->findAndUpdate($model->SurveyRelatedGroupName,$model->SurveyLogo);
            
            if ($QuestinExist == true) {           
                
                $QuestinExist = ExtendedSurveyCollection::model()->UpdateSurvey($model->SurveyId, $model);
            } 
       } catch (Exception $ex) {

       }
   }
   
   public function checkForScheduleSurvey($startDate,$endDate,$surveyId,$groupName) {
        try {
            return ScheduleSurveyCollection::model()->checkSurveyScheduleForDates($startDate,$endDate,$surveyId,$groupName);
        } catch (Exception $exc) {
            Yii::log('Exception checkForScheduleSurvey' . $exc->getMessage(), 'error', 'application');            
        }
    }
    
    public function saveScheduleSurvey($scheduleSurveyForm,$userId) {
        try {
            $returnValue='failure';
            $previousSchedule = 0;
            $previousScheduleDetails = ScheduleSurveyCollection::model()->getScheduleSurveyDetailsObject('SurveyId', $scheduleSurveyForm->SurveyId);
            if (!is_string($previousScheduleDetails)) {
                $previousSchedule = $previousScheduleDetails;
            }
            $currentScheduleSurvey = 0;
            $sDate = strtotime($scheduleSurveyForm->StartDate);
            $cDate = strtotime(date('m/d/y H:i:s'));
            $IsNotifiable=0;

            if ($sDate < $cDate) {
                ExtendedSurveyCollection::model()->updateSurveyForIsCurrentSchedule("IsCurrentSchedule", (int) 1, $scheduleSurveyForm->SurveyId);
                $currentScheduleSurvey = (int) 1;
                $IsNotifiable=1;
            }
            $scheduleDetails = ScheduleSurveyCollection::model()->getScheduleSurveyDetailsObject('IsCurrentSchedule', (int) 1);
            $createdDate = "";
            
            /*
             * This code is creating a InStream Ad...
             * 
             */
            if($scheduleSurveyForm->ConvertInStreamAdd == 1){
            
                $obj=  $this->createStreamAdObjectForSurvery($scheduleSurveyForm,$userId)  ;  
            }
            
            $result = ScheduleSurveyCollection::model()->saveScheduleSurvey($scheduleSurveyForm, $currentScheduleSurvey,$userId,$createdDate);
            $returnValue = ExtendedSurveyCollection::model()->updateSurveyForIsCurrentSchedule("CurrentScheduleId", $result, $scheduleSurveyForm->SurveyId);           
            return $returnValue;
        } catch (Exception $exc) {            
            error_log("######Exception Occurred in the saveScheduleSurvey#######" . $exc->getMessage());
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    public function suspendSurvey($surveyId, $actionType = "Suspend") {
        try {
            $return = "failure";            
            if ($actionType == "Suspend") {
                $return = ScheduleSurveyCollection::model()->removeFutureSurveySchedule($surveyId, date("Y-m-d H:i:s", CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), '', "future");
                $currentScheduleSurvey = ExtendedSurveyCollection::model()->isCurrentScheduleSurvey($surveyId);
                ExtendedSurveyCollection::model()->suspendORReleaseSurvey($surveyId, 1);
                if (isset($currentScheduleSurvey) && is_object($currentScheduleSurvey)) {
                    $currentScheduleSurvey = ScheduleSurveyCollection::model()->updateCurrentScheduleSurveyByToday($surveyId, date("Y-m-d H:i:s", CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())));
                }
                $pastSchedule = ScheduleSurveyCollection::model()->getPreviousOrFutureSurveySchedule($surveyId, date("Y-m-d H:i:s", CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), "", "past");
                if (isset($pastSchedule) && is_object($pastSchedule)) {
                    $pastScheduleId =  $pastSchedule->_id;
                } else {
                    ExtendedSurveyCollection::model()->suspendORReleaseSurvey($surveyId, 1);
                    $pastScheduleId = "";
                }
                ExtendedSurveyCollection::model()->updateSurveyForIsCurrentSchedule("CurrentScheduleId", $pastScheduleId, $surveyId);
            } else {
                
                ExtendedSurveyCollection::model()->suspendORReleaseSurvey($surveyId, 0);               
            }
            
            return "success";
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    public function cancelScheduleSurvey($surveyId, $scheduleId) {
        try {
            $return = "failure";
         

                $iscurrentSchedule = ScheduleSurveyCollection::model()->isCurrentScheduleByScheduleId($surveyId, $scheduleId);
                if ($iscurrentSchedule == true) {
                    /**
                     * if schedule is current schedule , then we need to update that schedule today date
                     */
                    $currentScheduleSurvey = ScheduleSurveyCollection::model()->updateCurrentScheduleSurveyByToday($surveyId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())));
                } else {
                    $currentScheduleSurvey = ScheduleSurveyCollection::model()->removeScheduleByScheduleId($scheduleId);
                }
               //  return;
                $obj = ScheduleSurveyCollection::model()->getPreviousOrFutureGameSchedule($surveyId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), "", "past");
                $iscontainSchedule = false;
                if (isset($obj) && is_object($obj)) {
                    $iscontainSchedule = true;
                } else {
                    $obj = ScheduleSurveyCollection::model()->getPreviousOrFutureGameSchedule($surveyId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), "", "future");

                    $iscontainSchedule = true;
                }
                 
                if ($iscontainSchedule == true) {
                    $currentScheduleId =  $obj->_id;
                } else {
                    $currentScheduleId =  "";
                }
                ExtendedSurveyCollection::model()->updateSurveyForIsCurrentSchedule("CurrentScheduleId",$currentScheduleId,$surveyId);
                
            return "success";
        } catch (Exception $exc) {
            error_log("**********22Exception2222222222222222222222*****".$exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    public function saveSurveyAnswer($model,$NetworkId,$UserId){
        try{
            return ScheduleSurveyCollection::model()->updateSurveyAnswer($model,$NetworkId,$UserId);
        } catch (Exception $ex) {
            error_log("########Exception Occurred ###########".$ex->getMessage());
        }
    }
     public function getSurveyAnalytics($userId,$scheduleId){
        try{
            return CommonUtility::prepateSurveyAnalyticsData($userId,$scheduleId);
        } catch (Exception $ex) {
            error_log("########Exception Occurred ###########".$ex->getMessage());
        }
    }
        
    public function isAlreadyDoneByUser($UserId,$GroupName){
        try{
            $result = ExtendedSurveyCollection::model()->getSurveyDetailsByGroupName('GroupName',$GroupName);
            return ScheduleSurveyCollection::model()->isAlreadyDoneByUser($UserId,$GroupName,$result);
        } catch (Exception $ex) {

        }
    }
    
    public function getSurveyAnalyticsData($pageLength,$startLimit,$searchText,$filterValue,$timezone){
        try{
            return ScheduleSurveyCollection::model()->getSurveyAnalyticsData($pageLength,$startLimit,$searchText,$filterValue,$timezone);
        } catch (Exception $ex) {
            error_log("#########Exception Occurred getSurveyAnalyticsData#########".$ex->getMessage());
        }
    }
    
    public function getSurveyAnalyticsDataCount($filterValue,$searchText){
        try{
            return ScheduleSurveyCollection::model()->getSurveyAnalyticsDataCount($filterValue,$searchText);
        } catch (Exception $ex) {
            error_log("#########Exception Occurred getSurveyAnalyticsDataCount#########".$ex->getMessage());
        }
    }
    
     public function createStreamAdObjectForSurvery($scheduleObj,$userId){
        try{
            $advertisementForm=new AdvertisementForm();
            $advertisementForm->AdTypeId = 2;
            $advertisementForm->DisplayPage = "Home";
            $advertisementForm->Status = 1;
            $advertisementForm->SourceType = "Upload";
            $advertisementForm->RedirectUrl = Yii::app()->params['ServerURL']."/userview?userId=1&groupName=$scheduleObj->SurveyRelatedGroupName";
            $advertisementForm->StartDate = $scheduleObj->StartDate;
            $advertisementForm->ExpiryDate = $scheduleObj->EndDate;
            $advertisementForm->Name = "Survey Ad";
            
            $advertisementForm->BannerTitle = ' <div id="AdBannerTitle"  class="addbannaertitle  addbannerhighlight aligncenter"  style="color: rgb(30, 29, 27);">'.$scheduleObj->SurveyTitle.'</div> ';
            $advertisementForm->BannerContent = '<div id="AdBannerContent" class="addbannerdescription addbannerhighlight aligncenter"  style="color: rgb(30, 29, 27);">'.$scheduleObj->SurveyDescription.'</div> ';
            $advertisementForm->BannerOptions = "ImageWithText";
            $advertisementForm->BannerTemplate = 2;
            $fgroupName = "";
            if($scheduleObj->SurveyRelatedGroupName == "Public" || $scheduleObj->SurveyRelatedGroupName == "0"){
                $fgroupName = Yii::app()->params['NetworkName'];
            }else{
                $fgroupName = $scheduleObj->SurveyRelatedGroupName;
            }
             
            $advertisementForm->Title = $fgroupName." introduced Market Research as ".$scheduleObj->SurveyTitle;
            $advertisementForm->Url = $scheduleObj->InstreamAdArtifact;
            if(!empty($scheduleObj->InstreamAdArtifact)){
                $filepath = Yii::getPathOfAlias('webroot').$scheduleObj->InstreamAdArtifact;
                CommonUtility::resizeImage($filepath,"width",600);                
                
            }
            $result = ServiceFactory::getSkiptaAdServiceInstance()->saveNewAdService($advertisementForm, $userId,"new");
            error_log("=====333333333333333333333==============");
        } catch (Exception $ex) {
            error_log("#########Exception Occurred getSurveyAnalyticsDataCount#########".$ex->getMessage());
        }
    }
    
     public function getSurveyAnalyticsByGroupName($userId,$groupName,$surveyId,$timezone){
        try{            
            return CommonUtility::prepateSurveyAnalyticsDataByGroup($userId,$groupName,$surveyId,$timezone);
        } catch (Exception $ex) {
            error_log("########Exception Occurred getSurveyAnalyticsByGroupName###########".$ex->getMessage());
        }
    }
    
    

}