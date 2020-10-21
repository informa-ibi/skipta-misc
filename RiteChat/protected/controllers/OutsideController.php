<?php

class OutsideController extends Controller {
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
    public function init() {        
        
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');   
        
        if(isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj']) && $_REQUEST['isOuter'] == false){
            parent::init();
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            $_REQUEST['UserId'] = $this->tinyObject->UserId;
        }else{            
            $this->layout = 'externalLayout';  
        }      
    }

    public function actionIndex() {
        try {
//            $this->layout = 'externalLayout';
//            $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('GroupName',"Amgen");            
            $QuestionsSurveyForm = new QuestionsSurveyForm;
            $this->render('index',array('QuestionsSurveyForm'=>$QuestionsSurveyForm));
        } catch (Exception $exc) {
            Yii::log("_____" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function actionRenderQuestionView(){
        try{
            $surveyGroupName = $_REQUEST['GroupName'];
            $UserId = isset($_REQUEST['UserId'])?$_REQUEST['UserId']:1; // userId... 
            $surveyObj = "";
            $errMessage = "";
            $scheduleId = "";
            
            $QuestionsSurveyForm = new QuestionsSurveyForm;
            if(!empty($UserId) && !empty($surveyGroupName)){
                if($surveyGroupName == "public"){
                    $surveyGroupName = "0";
                }
                $schedulePattern = ServiceFactory::getSkiptaExSurveyServiceInstance()->isAlreadyDoneByUser($UserId,$surveyGroupName);            
                $schedulePatternArr = explode("_",$schedulePattern);
                $scheduleId = $schedulePatternArr[1];
                
                if($schedulePatternArr[0] == "notdone" && !empty($scheduleId) && $scheduleId != "notscheduled"){
                    
                    //first check if a user already surveyed or not
//                    $scheduleId = "5462f372b96c3de22a8b4567";
                    $surveyId = $schedulePatternArr[2];
                    $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id',$surveyId);            
                    
                }else{
                    if($schedulePatternArr[0] != "notscheduled"){
                        $surveyId = $schedulePatternArr[2];
                        $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id',$surveyId);                                
                    }
                }
                
            }else{
                if(empty($UserId)){
//                    $errMessage = "Sorry, User not exist with this UserId.";
                    $errMessage = 1;
                }else if(empty($surveyGroupName)){
//                    $errMessage = "Sorry, Group Name not exist.";
                    $errMessage = 2;
                }
            }            
            if(empty($errMessage)){
                    if($schedulePatternArr[0] == "notdone" && !empty($scheduleId) && $scheduleId != "notscheduled"){
                        error_log("====outside controller====scheduleid==21111111111111111111111=$scheduleId");
                            $this->renderPartial('userView',array("surveyObj"=>$surveyObj,"QuestionsSurveyForm"=>$QuestionsSurveyForm,"scheduleId"=>$scheduleId,"errMessage"=>$errMessage,"userId"=>$UserId));
                    }else if($schedulePatternArr[0] == "done" && $scheduleId != "notscheduled"){
                        error_log("=======else schedule done---7777777777777777");
                        $this->renderPartial('surveyView',array("surveyObj"=>$surveyObj,"QuestionsSurveyForm"=>$QuestionsSurveyForm,"scheduleId"=>$scheduleId,"errMessage"=>$errMessage,"userId"=>$UserId));
                    }else{
                        echo "NotScheduled_";
                    }
            }
            else {
                echo $errMessage;
            }
        } catch (Exception $ex) {

        }
    }
    public function actionValidateSurveyAnswersQuestion(){
        try{
            error_log("====actionValidate==in outside=========");
            $QuestionsSurveyForm = new QuestionsSurveyForm();
//            $UserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
            if(isset($_POST['QuestionsSurveyForm'])){
                   $QuestionsSurveyForm->attributes = $_POST['QuestionsSurveyForm'];    
                   $UserId = $QuestionsSurveyForm->UserId;
//                   error_log("======inside======if post========".print_r($QuestionsSurveyForm->Questions,1));
                   error_log("=ScheduleId=====$QuestionsSurveyForm->ScheduleId");
                   $f=  json_decode($QuestionsSurveyForm->Questions);
                
                   $questionArray = array();
                
                for($i=0;$i<sizeof($f);$i++){                        
                    $searcharray=array();
                    parse_str($f[$i],$searcharray);
                    $ExUserAnswerBean = new ExUserAnswersBeans();
                    $widget12 = new ExUserWidget12Bean();
                    $widget34 = new ExUserWidget34Bean();
                    $widget5 = new ExUserWidget5();
                    $widget6 = new ExUserWidget6();
                    $widget7 = new ExUserWidget7();
                    $optionsArray = array();
                    $questionType = 0;
                    
                    foreach($searcharray["QuestionsSurveyForm"] as $key=>$value){
                        error_log("==========key=====$key======value===".print_r($value,1));
                        if(is_array($value) && sizeof($value)){                                                        
                            if($key == "WidgetType"){
                                    foreach($value as $m){
                                        $questionType =  $m;
                                        if($m == 1 || $m == 2){
                                            $widget12->QuestionType = (int) $m;
                                        }else if($m == 3 || $m == 4){
                                            $widget34->QuestionType = (int) $m;
                                        }else if($m == 5){
                                            $widget5->QuestionType = (int) $m;
                                        }else if($m == 6){
                                            $widget6->QuestionType = (int) $m;
                                        }else if($m == 7){
                                            $widget7->QuestionType = (int) $m;
                                        }
                                    }
                                }
                            
                                if($key == "QuestionId"){
                                    foreach($value as $m){                                        
                                        if($questionType == 1 || $questionType == 2){
                                            $widget12->QuestionId = new MongoId($m);
                                        }else if($questionType == 3 || $questionType == 4){
                                            $widget34->QuestionId = new MongoId($m);
                                        }else if($questionType == 5){
                                            $widget5->QuestionId = new MongoId($m);
                                        }else if($questionType == 6){
                                            $widget6->QuestionId = new MongoId($m);
                                        }else if($questionType == 7){
                                            $widget7->QuestionId = new MongoId($m);
                                        }
                                        
                                    }
                                }
                           
                            
                            if($key == "OptionsSelected"){
                                $k=0;
                                foreach($value as $m){       
                                    if($questionType == 1 || $questionType == 2){                                                                              
                                            $widget12->SelectedOption = explode(",",$m); 
                                    }
                                    else if($questionType == 3 || $questionType == 4){
                                        $optionsArray = explode(",",$m);
                                        $widget34->Options = $optionsArray;
                                    }
//                                        $widget34->SelectedOption = $m; 
                                }
                            }                            

                            if($key == "Other"){
                                $k=0;
                                foreach($value as $m){
                                    if($questionType == 1 || $questionType == 2)                                          
                                        $widget12->Other = (int) $m;
                                    else if($questionType == 3 || $questionType == 4)                                          
                                        $widget34->Other = (int) $m;
                                }

                            }
                            if($key == "OtherValue"){
                                $k=0;
                                foreach($value as $m){
                                    if($questionType == 1 || $questionType == 2) 
                                        $widget12->OtherValue = $m;                                       
                                }

                            }
                            if($key == "DistValue"){
                                $k=0;
                                foreach($value as $m){
                                    if($questionType == 5){
                                        if(empty($m)){
                                            $m = "0";
                                        }
                                        $widget5->DistributionValues[$k++] = $m;                                        
                                    }
                                }
                            }
                            if($key == "UsergeneratedRanking"){
                                $k=0;                                
                                foreach($value as $m){
                                    if($questionType == 7){                                        
                                      $widget7->UsergeneratedRankingOptions[$k++] = $m;                                        
                                    }
                                }
                            }
                            if($key == "UserAnswer"){
                                $k=0;
                                foreach($value as $m){
                                    if($questionType == 6)
                                        $widget6->UserAnswer = $m;                                        
                                }
                            }
//                            if($questionType == 3 || $questionType == 4){
//                                $optionsArray = explode(",",$widget34->SelectedOption);
//                                $widget34->Options = $optionsArray;
//                                
//                            }
                            if($questionType == 1 || $questionType == 2)
                                $widget12->UserId = (int) $UserId;
                            else if($questionType == 3 || $questionType == 4)
                                $widget34->UserId = (int) $UserId;
                            else if($questionType == 5)
                                $widget5->UserId = (int) $UserId;
                            else if($questionType == 6)
                                $widget6->UserId = (int) $UserId;
                            else if($questionType == 7)
                                $widget7->UserId = (int) $UserId;                            
                        }    

                    }
                    if($questionType == 1 || $questionType == 2)
                        array_push($questionArray,$widget12);
                    else if($questionType == 3 || $questionType == 4)
                        array_push($questionArray,$widget34);
                    else if($questionType == 5)
                        array_push($questionArray,$widget5);
                    else if($questionType == 6)
                        array_push($questionArray,$widget6);
                    else if($questionType == 7)
                        array_push($questionArray,$widget7);

                }
                $QuestionsSurveyForm->UserAnswers = $questionArray;
                $surveyObject = ServiceFactory::getSkiptaExSurveyServiceInstance()->saveSurveyAnswer($QuestionsSurveyForm,$NetworkId,$UserId);
                $this->renderPartial('thankyou',array('result'=>$surveyObject,"ScheduleId"=>$QuestionsSurveyForm->ScheduleId));
            }
        } catch (Exception $ex) {
            error_log("#######Exception Occurred while saving###########".$ex->getTraceAsString());
        }
    }
    
    public function actionValidateQuestions(){
        try{
            $QuestionsSurveyForm = new QuestionsSurveyForm();
            error_log("==========validateQuestions============");
            $UserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
            if(isset($_POST['QuestionsSurveyForm'])){
                error_log("==========validateQuestions form submit============");
                   $QuestionsSurveyForm->attributes = $_POST['QuestionsSurveyForm'];
                   $QuestionsSurveyForm->SurveyTitle = $_GET['surveyTitle'];
                   $QuestionsSurveyForm->SurveyDescription = $_GET['SurveyDescription'];
                   $QuestionsSurveyForm->QuestionsCount = questionsCount;
                   $QuestionsSurveyForm->SurveyRelatedGroupName = $_GET['SurveyGroupName'];
                   $QuestionsSurveyForm->SurveyLogo = $_GET['SurveyLogo'];
                   error_log("======222222222222222222222222====validateQuestions form submit============");
//                   if($ExtendedSurveyForm->SurveyLogo == ""){
//                       $common['ExtendedSurveyForm_SurveyLogo'] = "Please upload a survey logo";
//                   }else if($ExtendedSurveyForm->SurveyRelatedGroupName == "other" && $ExtendedSurveyForm->SurveyOtherValue == ""){
//                       $common['ExtendedSurveyForm_SurveyOtherValue'] = "Survey Other value cannot be blank";
//
//                   }else if($ExtendedSurveyForm->SurveyRelatedGroupName == ""){                    
//                       $common['ExtendedSurveyForm_SurveyRelatedGroupName'] = "Please choose Survey related group";
//                   }else{
//                       $common['ExtendedSurveyForm_SurveyOtherValue'] = "";
//                       $common['ExtendedSurveyForm_SurveyRelatedGroupName'] =  "";
//                       $common['ExtendedSurveyForm_SurveyLogo'] = "";
//                   }                

//                   
//                   error_log("======inside======if post========".print_r($QuestionsSurveyForm->Questions,1));
                   $errors = CActiveForm::validate($QuestionsSurveyForm);
                   error_log("=======Errors=======".print_r($errors,1));

                if($errors != '[]'){
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors,'oerror'=>$common);
                }else{
                    $obj = array('status' => 'success', 'data' => '', 'error' => "");
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
                   
            }
        } catch (Exception $ex) {
            error_log("############Exception Occurred ############".$ex->getMessage());
        }
    }
    
    public function actionRenderSurveyView(){
        try{
            
            $this->renderPartial('surveyView',array("surveyObj"=>$surveyObj,"QuestionsSurveyForm"=>$QuestionsSurveyForm,"scheduleId"=>$scheduleId,"errMessage"=>$errMessage,"userId"=>$UserId));
        } catch (Exception $ex) {

        }
    }
    
    
}
