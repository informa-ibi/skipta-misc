<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ExtendedSurveyController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function init() {
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            parent::init();
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            $_REQUEST['UserId'] = $this->tinyObject->UserId;
        }
    }

    public function actionIndex() {
        try {
            //ExtendedSurveyCollection::model()->saveSurvey();
            if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
                if (Yii::app()->session['IsAdmin'] == 1) {
                    $ExtendedSurveyForm = new ExtendedSurveyForm();
                    $surveyGroupNames = ExSurveyResearchGroup::model()->getLinkGroups();
                    $this->render('index', array("ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyGroupNames" => $surveyGroupNames));
                } else {
                    $this->redirect('/');
                }
            } else {
                $this->redirect('/');
            }
        } catch (Exception $ex) {
            error_log("==######Exception Occurred#######==" . $ex->getMessage());
        }
    }

    public function actionRenderQuestionWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyId = isset($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('questionWidget', array("widgetCount" => $widCnt, "radioLength" => 4, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyId" => $surveyId));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderRadioWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $optionsCnt = 4;
            $_id = "";
            $surveyObj = array();
            if (isset($_REQUEST['optionsCnt']) && $_REQUEST['optionsCnt'] != 0) {
                $optionsCnt = $_REQUEST['optionsCnt'];
            }
            if (isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId'])) {
                $_id = $_REQUEST['surveyId'];
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $_id);
            }
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('radioWidget', array("widgetCount" => $widCnt, "radioLength" => $optionsCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyObj" => $surveyObj));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderCheckboxWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $optionsCnt = 4;
            $_id = "";
            $surveyObj = array();
            if (isset($_REQUEST['optionsCnt']) && $_REQUEST['optionsCnt'] != 0) {
                $optionsCnt = $_REQUEST['optionsCnt'];
            }
            if (isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId'])) {
                $_id = $_REQUEST['surveyId'];
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $_id);
            }
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('checkboxWidget', array("widgetCount" => $widCnt, "radioLength" => $optionsCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyObj" => $surveyObj));
        } catch (Exception $ex) {
            
        }
    }

    public function actionAddCheckboxOptionWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $this->renderPartial('checkboxOption', array("widgetCount" => $widCnt));
        } catch (Exception $ex) {
            
        }
    }

    public function actionAddRadioOptionWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $this->renderPartial('radioOption', array("widgetCount" => $widCnt));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderRRWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";

            $qType = isset($_REQUEST['QType']) && !empty($_REQUEST['QType']) ? $_REQUEST['QType'] : 0;
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('RRWidget', array("widgetCount" => $widCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyId" => $surveyId, "qType" => $qType));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderRankingWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];

            $surveyObj = array();
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";
            if (empty($surveyId)) {
                $optionCnt = $_REQUEST['optionsCount'];
                $radioOpCnt = $_REQUEST['radioOptions'];
            } else {
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
                foreach ($surveyObj->Questions as $question) {
                    if ($question['QuestionType'] == 3) {
                        $optionCnt = $question['NoofOptions'];
                        $radioOpCnt = $question['NoofOptions'];
                    }
                }
            }

            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('RankingWidget', array("widgetCount" => $widCnt, "thcount" => $optionCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "radioOpCnt" => $radioOpCnt, "surveyObj" => $surveyObj, "surveyId" => $surveyId));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderRatingWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyObj = array();
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";
            if (empty($surveyId)) {
                $optionCnt = $_REQUEST['optionsCount'];
                $ratingsCnt = $_REQUEST['ratingsCount'];
            } else {
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
                foreach ($surveyObj->Questions as $question) {
                    if ($question['QuestionType'] == 4) {
                        $optionCnt = $question['NoofOptions'];
                        $ratingsCnt = $question['NoofRatings'];
                    }
                }
            }
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('RatingWidget', array("widgetCount" => $widCnt, "thcount" => $optionCnt, "ratingsCnt" => $ratingsCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyObj" => $surveyObj, "surveyId" => $surveyId));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderPercentageDist() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";

            $qType = isset($_REQUEST['QType']) && !empty($_REQUEST['QType']) ? $_REQUEST['QType'] : 0;
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('PercentageWidget', array("widgetCount" => $widCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyId" => $surveyId, "qType" => $qType));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderPercentageOptions() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $optionCnt = $_REQUEST['optionsCount'];
            $surveyObj = array();
            $noofoptions = 0;
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";
            $qType = isset($_REQUEST['QType']) && !empty($_REQUEST['QType']) ? $_REQUEST['QType'] : 0;
            if (empty($surveyId)) {
                $unitType = $_REQUEST['unitType'];
            } else {
                $unitType = 1;
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
                foreach ($surveyObj->Questions as $question) {
                    if ($question['QuestionType'] == 5) {
                        $unitType = $question['MatrixType'];
                        $optionCnt = $question['NoofOptions'];
                    }
                }
            }

            $type = "%";
            if ($unitType == 2) {
                $type = '$';
            }
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('PercentageDistOptions', array("widgetCount" => $widCnt, "optionsCnt" => $optionCnt, "unitType" => $type, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyId" => $surveyId, "surveyObj" => $surveyObj, "noofoptions" => $noofoptions));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderQuestionAndAnswerWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyId = isset($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";
            $noofchars = isset($_REQUEST['noofchars']) ? $_REQUEST['noofchars'] : 0;
            $surveyObj = array();
            if (!empty($surveyId)) {
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
            }
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('QuestionAndAnswerWidget', array("widgetCount" => $widCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "noofchars" => $noofchars, "surveyId" => $surveyId, "surveyObj" => $surveyObj));
        } catch (Exception $ex) {
            
        }
    }

    public function actionRenderUserGeneratedWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";

            $surveyObj = array();
            if (!empty($surveyId)) {
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
                foreach ($surveyObj->Questions as $question) {
                    if ($question['QuestionType'] == 7) {
                        $unitType = $question['MatrixType'];
                        $optionCnt = $question['NoofOptions'];
                    }
                }
            } else {
                $optionCnt = $_REQUEST['optionsCount'];
            }
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('UserGeneratedOptions', array("widgetCount" => $widCnt, "thcount" => $optionCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyObj" => $surveyObj, "surveyId" => $surveyId));
        } catch (Exception $ex) {
            
        }
    }

    public function actionUserGeneratedRankingWidget() {
        try {
            $widCnt = $_REQUEST['questionNo'];
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";

            $qType = isset($_REQUEST['QType']) && !empty($_REQUEST['QType']) ? $_REQUEST['QType'] : 0;
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $this->renderPartial('UserGeneratedRankingWidget', array("widgetCount" => $widCnt, "ExtendedSurveyForm" => $ExtendedSurveyForm, "surveyId" => $surveyId));
        } catch (Exception $ex) {
            
        }
    }

    public function actionSaveSurveyQuestion() {
        try {
            $ExtendedSurveyForm = new ExtendedSurveyForm();
            $UserId = Yii::app()->session['PostAsNetwork'] == 1 ? Yii::app()->session['NetworkAdminUserId'] : $this->tinyObject->UserId;
            if (isset($_POST['ExtendedSurveyForm'])) {
                $ExtendedSurveyForm->attributes = $_POST['ExtendedSurveyForm'];
                $ExtendedSurveyForm->SurveyTitle = $_GET['surveyTitle'];
                $ExtendedSurveyForm->SurveyDescription = $_GET['SurveyDescription'];
                $ExtendedSurveyForm->QuestionsCount = $_GET['questionsCount'];
                $ExtendedSurveyForm->SurveyRelatedGroupName = $_GET['SurveyGroupName'];
                $ExtendedSurveyForm->SurveyOtherValue = $_GET['SurveyOtherValue'];
                $ExtendedSurveyForm->SurveyLogo = $_GET['SurveyLogo'];
                $errors = array();
                $ExtendedSurveyForm->CreatedBy = Yii::app()->session['PostAsNetwork'] == 1 ? $this->tinyObject->UserId : 0;
                $searcharray = array();
                $f = json_decode($ExtendedSurveyForm->Questions);
                //  error_log(print_r($f,true));
                $questionArray = array();
                for ($i = 0; $i < sizeof($f); $i++) {
                    $searcharray = array();
                    parse_str($f[$i], $searcharray);
                    $ExSurveyBean = new ExSurveyBean();
                    foreach ($searcharray["ExtendedSurveyForm"] as $key => $value) {
                        if (is_array($value) && sizeof($value)) {

                            if ($ExtendedSurveyForm->SurveyId != "") {
                                if ($key == "QuestionId") {
                                    foreach ($value as $m) {
                                        $ExSurveyBean->QuestionId = new MongoId($m);
                                    }
                                }
                            }
                            if ($key == "Question") {
                                foreach ($value as $m) {
                                    if ($ExtendedSurveyForm->SurveyId == "") {
                                        $ExSurveyBean->QuestionId = new MongoId();
                                    }
                                    $ExSurveyBean->Question = $m;
                                }
                            }
                            if ($key == "RadioOption") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->Options[$k++] = $m;
                                    $ExSurveyBean->QuestionType = (int) 1; //radio...
                                }
                            }
                            if ($key == "CheckboxOption") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->Options[$k++] = $m;
                                    $ExSurveyBean->QuestionType = (int) 2; //checkbox...
                                }
                            }

                            if ($key == "MatrixType") {
                                $k = 0;
                                foreach ($value as $m) {
                                    if ($m == 1)
                                        $ExSurveyBean->QuestionType = (int) 3; //Ranking...
                                    else
                                        $ExSurveyBean->QuestionType = (int) 4; //Rating...
                                    $ExSurveyBean->MatrixType = (int) $m;
                                }
                            }
                            if ($key == "NoofOptions") {
                                foreach ($value as $m) {
                                    $ExSurveyBean->NoofOptions = (int) $m;
                                }
                            }
                            if ($key == "NoofRatings") {
                                foreach ($value as $m) {
                                    $ExSurveyBean->NoofRatings = (int) $m;
                                }
                            }

                            if ($key == "LabelName") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->LabelName[$k++] = $m;
                                }
                            }
                            if ($key == "OptionName") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->OptionName[$k++] = $m;
                                }
                            }
                            if ($key == "Other") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->Other = (int) $m;
                                }
                            }
                            if ($key == "OtherValue") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->OtherValue = $m;
                                }
                            }
                            if ($key == "TotalValue") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->TotalValue = $m;
                                    $ExSurveyBean->QuestionType = (int) 5; //Percentage Dist...
                                }
                            }
                            if ($key == "NoofChars") {
                                $k = 0;
                                foreach ($value as $m) {
                                    $ExSurveyBean->NoofChars = (int) $m;
                                    $ExSurveyBean->QuestionType = (int) 6; //Percentage Dist...
                                }
                            }
                            if ($ExSurveyBean->TotalValue == 0 && $ExSurveyBean->NoofOptions != 0 && $ExSurveyBean->QuestionType == 0) {
                                $ExSurveyBean->QuestionType = (int) 7; //User generated ratings...
                            }

                            $ExSurveyBean->QuestionPosition = (int) ($i + 1);
                        }
                    }
                    array_push($questionArray, $ExSurveyBean);
                }
                $ExtendedSurveyForm->Questions = $questionArray;
//                error_log("=======Questions======".print_r($questionArray,1));
                $surveyR = ServiceFactory::getSkiptaExSurveyServiceInstance()->saveSurvey($ExtendedSurveyForm, $NetworkId, $UserId);
                $obj = array("status" => "success");
                //}

                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            error_log("#####Exception Occurred in ########" . $ex->getMessage());
        }
    }

    public function actionValidateSurveyQuestion() {
        $ExtendedSurveyForm = new ExtendedSurveyForm();
        $UserId = Yii::app()->session['PostAsNetwork'] == 1 ? Yii::app()->session['NetworkAdminUserId'] : $this->tinyObject->UserId;
        if (isset($_POST['ExtendedSurveyForm'])) {
            $ExtendedSurveyForm->attributes = $_POST['ExtendedSurveyForm'];
            $ExtendedSurveyForm->SurveyTitle = $_GET['surveyTitle'];
            $ExtendedSurveyForm->SurveyDescription = $_GET['SurveyDescription'];
            $ExtendedSurveyForm->QuestionsCount = questionsCount;
            $ExtendedSurveyForm->SurveyRelatedGroupName = $_GET['SurveyGroupName'];
            $ExtendedSurveyForm->SurveyOtherValue = $_GET['SurveyOtherValue'];
            $ExtendedSurveyForm->SurveyLogo = $_GET['SurveyLogo'];
//                $ExtendedSurveyForm->NoofRatings = $_GET['noofratings'];
            if ($ExtendedSurveyForm->SurveyLogo == "") {
                $common['ExtendedSurveyForm_SurveyLogo'] = "Please upload a survey logo";
            } else if ($ExtendedSurveyForm->SurveyRelatedGroupName == "other" && $ExtendedSurveyForm->SurveyOtherValue == "") {
                $common['ExtendedSurveyForm_SurveyOtherValue'] = "Survey Other value cannot be blank";
            }

//                else if($ExtendedSurveyForm->SurveyRelatedGroupName == ""){                    
//                    $common['ExtendedSurveyForm_SurveyRelatedGroupName'] = "Please choose Survey related group";
//                }
            else {
                $common['ExtendedSurveyForm_SurveyOtherValue'] = "";
//                    $common['ExtendedSurveyForm_SurveyRelatedGroupName'] =  "";
                $common['ExtendedSurveyForm_SurveyLogo'] = "";
            }

            $errors = CActiveForm::validate($ExtendedSurveyForm);
//                error_log("===errors====".print_r($errors,1));
            if ($errors != '[]' || !empty($common['ExtendedSurveyForm_SurveyOtherValue']) || !empty($common['ExtendedSurveyForm_SurveyLogo'])) {
                $obj = array('status' => 'error', 'data' => '', 'error' => $errors, 'oerror' => $common);
            } else {
                $obj = array('status' => 'success', 'data' => '', 'error' => "");
            }
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        }
    }

    public function actionUploadImage() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            //  $folder=Yii::getPathOfAlias('webroot').'/temp/';// folder for uploaded files
            $folder = Yii::app()->params['ArtifactSavePath'];
            $webroot = Yii::app()->params['WebrootPath'] . '/upload/ExSurvey/';
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "png", "tiff"); //array("jpg","jpeg","gif","exe","mov" and etc...
            //  $sizeLimit = 30 * 1024 * 1024; // maximum file size in bytes
            $sizeLimit = Yii::app()->params['UploadMaxFilSize'];

            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);

            if (isset($result['filename'])) {
                $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
                $fileName = $result['filename']; //GETTING FILE NAME
                $result["filepath"] = Yii::app()->getBaseUrl(true) . '/temp/' . $fileName;
                $result["fileremovedpath"] = $folder . $fileName;
            } else {
                $result['success'] = false;
            }

            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }

    public function actionGetSurveyGroups() {
        $data = ExSurveyResearchGroup::model()->getLinkGroups();
        $result1 = array("data" => $data, "status" => 'success');
        echo $this->rendering($result1);
    }

    public function actionManageSurvey() {

        $urlArray = explode("/", Yii::app()->request->url);
        $surveyId = "";
        if (isset($urlArray[3]) && !empty($urlArray[3])) {
            $surveyId = $urlArray[3];
            $columnName = "Id";
        }
        $ExtendedSurveyForm = new ExtendedSurveyForm();
        $UserId = $this->tinyObject['UserId'];
        $Surveydata = array();
        if (isset($surveyId) && !empty($surveyId)) {
            $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById($columnName, $surveyId);
            $ExtendedSurveyForm->SurveyId = $surveyObj->_id;
            $ExtendedSurveyForm->SurveyTitle = $surveyObj->SurveyTitle;
            $ExtendedSurveyForm->SurveyDescription = $surveyObj->SurveyDescription;
            $ExtendedSurveyForm->Status = $surveyObj->Status;
            $ExtendedSurveyForm->SurveyLogo = $surveyObj->SurveyLogo;
            $ExtendedSurveyForm->SurveyRelatedGroupName = $surveyObj->SurveyRelatedGroupName;
            $ExtendedSurveyForm->QuestionsCount = $surveyObj->QuestionsCount;
        } else {
            $surveyId = "";
            $surveyObj = array();
        }
        $surveyGroupNames = ExSurveyResearchGroup::model()->getLinkGroups();
        $this->render('index', array('ExtendedSurveyForm' => $ExtendedSurveyForm, 'surveyId' => $surveyId, 'surveyObj' => $surveyObj, "surveyGroupNames" => $surveyGroupNames));
    }

    public function actionRenderEditForm() {
        try {
            $surveyId = isset($_REQUEST['surveyId']) && !empty($_REQUEST['surveyId']) ? $_REQUEST['surveyId'] : "";
            if (isset($surveyId) && !empty($surveyId)) {
                $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
            }
            $this->renderPartial('surveyEditPage', array('surveyObj' => $surveyObj));
        } catch (Exception $ex) {
            
        }
    }

    public function actionSurveyDashboard() {
        try {
            $this->render('dashboard');
        } catch (Exception $ex) {
            error_log("############Exception Occurred while hitting the actionSurveyDashboard##########" . $ex->getMessage());
        }
    }

    public function actionLoadSurveyWall() {

        try {
            if (isset($_GET['ExtendedSurveyBean_page']) && isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
                $streamIdArray = array();
                $userId = $this->tinyObject['UserId'];
                $pageSize = 6;                
                $isNotifiable = 1;
                if (Yii::app()->session['IsAdmin'] != 1) {
                    $isNotifiable = 0;
                }
                $flag = "Survey";
                if (isset($_REQUEST['filterString'])) {
                    $cDate = date('m/d/y');                    
                    if ($_REQUEST['filterString'] == 'FutureSchedule') {
                        $condition = array(
                            'StartDate' => array('>' => new MongoDate(strtotime(date('Y-m-d H:i:s', time())))),
                        );
                        $_GET['ScheduleSurveyCollection_page'] = $_GET['ExtendedSurveyBean_page'];
                        $provider = new EMongoDocumentDataProvider('ScheduleSurveyCollection', array(
                            'pagination' => array('pageSize' => $pageSize),
                            'criteria' => array(
                                'conditions' => $condition,
                                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                            )
                        ));
                        $flag = "Schedule";
                    } else if ($_REQUEST['filterString'] == 'SuspendedSurveys') {
                        $condition = array(
                            'IsDeleted' => array('==' => 1),
                        );
                        $_GET['ExtendedSurveyCollection_page'] = $_GET['ExtendedSurveyBean_page'];
                        $provider = new EMongoDocumentDataProvider('ExtendedSurveyCollection', array(
                            'pagination' => array('pageSize' => $pageSize),
                            'criteria' => array(
                                'conditions' => $condition,
                                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                            )
                        ));
                    } else {
                        $condition = array(
                            'IsDeleted' => array('!=' => 1),
                        );
                        $_GET['ExtendedSurveyCollection_page'] = $_GET['ExtendedSurveyBean_page'];
                        $provider = new EMongoDocumentDataProvider('ExtendedSurveyCollection', array(
                            'pagination' => array('pageSize' => $pageSize),
                            'criteria' => array(
                                'conditions' => $condition,
                                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                            )
                        ));
                    }
                } else {

                    $condition = array(
                        'IsDeleted' => array('!=' => 1),
                    );
                    $_GET['ExtendedSurveyCollection_page'] = $_GET['ExtendedSurveyBean_page'];
                    $provider = new EMongoDocumentDataProvider('ExtendedSurveyCollection', array(
                        'pagination' => array('pageSize' => $pageSize),
                        'criteria' => array(
                            'conditions' => $condition,
                            'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                        )
                    ));
                }
                $preparedObject = array();
                $providerArray = array();
                if ($provider->getTotalItemCount() == 0) {
                    $preparedObject = 0; //No posts
                } else if ($_GET['ExtendedSurveyBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                    if($flag == "Survey")
                        $preparedObject = (CommonUtility::prepareSurveyDashboradData($UserId, $provider->getData()));
                    else{
                        $datao = $provider->getData();
                        foreach($datao as $data){                            
                            $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id',$data->SurveyId);             
                            array_push($providerArray,$surveyObj);
                        }
                        $preparedObject = (CommonUtility::prepareSurveyDashboradData($UserId, $providerArray));
                    }
                } else {

                    $preparedObject = -1; //No more posts
                }

                $this->renderPartial('dashboardWall', array('surveyObject' => $preparedObject));
            }else{
                $this->redirect("/");
            }
        } catch (Exception $exc) {
            error_log("****************" . $exc->getMessage());
            Yii::log('In Excpetion gameprofilebox' . $exc->getMessage(), 'error', 'application');
        }
    }

    public function actionLoadSurveySchedule() {
        try {
            $surveyId = $_REQUEST['surveyId'];
            $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id', $surveyId);
            $scheduleForm = new ScheduleSurveyForm();
            $scheduleForm->SurveyId = $surveyId;
            $scheduleForm->SurveyRelatedGroupName = $surveyObj->SurveyRelatedGroupName;
            $scheduleForm->SurveyDescription = $surveyObj->SurveyDescription;
            $this->renderPartial('scheduleSurvey', array('scheduleForm' => $scheduleForm, "surveyId" => $surveyId, "surveyObj" => $surveyObj));
        } catch (Exception $exc) {
            error_log("#####Exception occurred####" . $exc->getMessage());
        }
    }

    public function actionScheduleASurvey() {
        try {
            if (isset($_POST['ScheduleSurveyForm'])) {
                $scheduleSurveyForm = new ScheduleSurveyForm;
                $scheduleSurveyForm->attributes = $_POST['ScheduleSurveyForm'];
                $userId = $this->tinyObject['UserId'];
                $errors = CActiveForm::validate($scheduleSurveyForm);
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                    $surveyId = $scheduleSurveyForm->SurveyId;
                    $startDate = $scheduleSurveyForm->StartDate;
                    $endDate = $scheduleSurveyForm->EndDate . " 23:59:59";
                    $groupName = $scheduleSurveyForm->SurveyRelatedGroupName;
                    $startDate = CommonUtility::convert_time_zone(strtotime($startDate), date_default_timezone_get(), Yii::app()->session['timezone']);
                    $endDate = CommonUtility::convert_time_zone(strtotime($endDate), date_default_timezone_get(), Yii::app()->session['timezone']);
                    $isExists = ServiceFactory::getSkiptaExSurveyServiceInstance()->checkForScheduleSurvey($startDate, $endDate, $surveyId, $groupName);
                    //return;

                    $scheduleSurveyForm->StartDate = $startDate;
                    $scheduleSurveyForm->EndDate = $endDate;
                    if (is_object($isExists) || is_array($isExists)) {
                        $surveyTitle = $isExists->SurveyTitle;
                        $errorMessage = '<b>' . $surveyTitle . '</b> is already scheduled between   ' . date(Yii::app()->params['PHPDateFormat'], CommonUtility::convert_date_zone($isExists->StartDate->sec, Yii::app()->session['timezone'], date_default_timezone_get())) . " to " . date(Yii::app()->params['PHPDateFormat'], CommonUtility::convert_date_zone($isExists->EndDate->sec, Yii::app()->session['timezone'], date_default_timezone_get()));
                        $obj = array('status' => 'Exists', 'data' => $errorMessage, 'error' => $errors);
                    } else {
                        $result = ServiceFactory::getSkiptaExSurveyServiceInstance()->saveScheduleSurvey($scheduleSurveyForm, $userId);
                        if ($result == "success") {
                            $obj = array('status' => 'success', 'data' => 'Survey Scheduled Successfully', 'error' => '', 'surveyId' => $surveyId);
                        } else {
                            $obj = array('status' => 'error', 'data' => '', 'error' => '');
                        }
                    }

//                    $obj = array("status"=>"success");
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            error_log("#########Exception Occurred in actionScheduleASurvey#######" . $exc->getMessage());
        }
    }

    public function actionSaveScheduleGame() {
        try {
            $newScheduleGame = new ScheduleGameForm();
            if (isset($_POST['ScheduleGameForm'])) {
                $newScheduleGame->attributes = $_POST['ScheduleGameForm'];
                $userId = $this->tinyObject['UserId'];
                $errors = CActiveForm::validate($newScheduleGame);
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                    $gameId = $newScheduleGame->GameName;

                    $streamId = $newScheduleGame->StreamId;
                    $startDate = $newScheduleGame->StartDate;
                    $endDate = $newScheduleGame->EndDate . " 23:59:59";
                    ;
                    $startDate = CommonUtility::convert_time_zone(strtotime($startDate), date_default_timezone_get(), Yii::app()->session['timezone']);
                    $endDate = CommonUtility::convert_time_zone(strtotime($endDate), date_default_timezone_get(), Yii::app()->session['timezone']);

                    $isExists = ServiceFactory::getSkiptaGameServiceInstance()->checkForScheduleGame($startDate, $endDate);
                    //return;
                    $newScheduleGame->StartDate = $startDate;
                    $newScheduleGame->EndDate = $endDate;
                    if (is_object($isExists) || is_array($isExists)) {
                        $gameName = $isExists->GameName;
                        //$errorMessage='<b>'.$gameName .'</b> is already scheduled between   ' .date(Yii::app()->params['PHPDateFormat'],$isExists->StartDate->sec) ." to ". date(Yii::app()->params['PHPDateFormat'],$isExists->EndDate->sec);
                        $errorMessage = '<b>' . $gameName . '</b> is already scheduled between   ' . date(Yii::app()->params['PHPDateFormat'], CommonUtility::convert_date_zone($isExists->StartDate->sec, Yii::app()->session['timezone'], date_default_timezone_get())) . " to " . date(Yii::app()->params['PHPDateFormat'], CommonUtility::convert_date_zone($isExists->EndDate->sec, Yii::app()->session['timezone'], date_default_timezone_get()));

                        $obj = array('status' => 'Exists', 'data' => $errorMessage, 'error' => $errors);
                    } else {

                        $result = ServiceFactory::getSkiptaGameServiceInstance()->saveScheduleGame($newScheduleGame, $userId);
                        $result = 'success';
                        if ($result == 'success') {
                            $obj = array('status' => 'success', 'data' => 'Game Scheduled Successfully', 'error' => '', 'gameId' => $gameId, 'streamId' => $streamId);
                        } else {
                            $obj = array('status' => 'error', 'data' => '', 'error' => '');
                        }
                    }
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $exc) {
            Yii::log('In Excpetion saveScheduleGame' . $exc->getMessage(), 'error', 'application');
        }
    }

    public function actionUploadThankYouImage() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder = Yii::getPathOfAlias('webroot') . '/upload/'; // folder for uploaded files
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "png", "tiff"); //array("jpg","jpeg","gif","exe","mov" and etc...
            // $sizeLimit = 30 * 1024 * 1024;// maximum file size in bytes
            $sizeLimit = Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
            $fileName = $result['filename']; //GETTING FILE NAME
            $extension = $result['extension'];

            $ext = "ExSurvey/Thankyou";
            $destnationfolder = $folder . $ext;
            if (!file_exists($destnationfolder)) {
                mkdir($destnationfolder, 0755, true);
            }

            $imgArr = explode(".", $result['filename']);
            $date = strtotime("now");
            $finalImg_name = $imgArr[0] . '.' . $imgArr[1];
            $finalImage = $imgArr[0] . '_' . $result['imagetime'] . '.' . $imgArr[1];
            $fileNameTosave = $folder . $imgArr[0] . '_' . $result['imagetime'] . '.' . $imgArr[1];
            $path = $folder . $result['filename'];
            rename($path, $fileNameTosave);

            //  $filename=$result['filename'];
            $sourcepath = $fileNameTosave;
            $destination = $folder . $ext . "/" . $finalImage;
            if ($ext != "") {
                if (file_exists($sourcepath)) {
                    if (copy($sourcepath, $destination)) {
                        unlink($sourcepath);
                    }
                }
            }
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }

    public function actionSuspendSurvey() {
        try {
            $surveyId = $_REQUEST['surveyId'];
            $actionType = $_REQUEST['actionType'];
            $networkId = $_REQUEST['networkId'];
            $return = ServiceFactory::getSkiptaExSurveyServiceInstance()->suspendSurvey($surveyId, $actionType);

            if ($return != "failure") {
                $obj = array("status" => 'success');
            } else {
                $obj = array("status" => 'failure');
            }
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $exc) {
//            Yii::log('In Excpetion gameprofilebox'.$exc->getMessage(),'error','application');
            error_log("#######Exception Occurred in the actionSuspendSurvey#########" . $exc->getMessage());
            $obj = array("status" => 'failure');
            echo CJSON::encode($obj);
        }
    }

    public function actionCancelSurveySchedule() {
        try {
            $surveyId = $_REQUEST['surveyId'];
            $scheduleId = $_REQUEST['scheduleId'];
            $return = ServiceFactory::getSkiptaExSurveyServiceInstance()->cancelScheduleSurvey($surveyId, $scheduleId);

            if ($return != "failure") {
                $obj = array("status" => 'success');
            } else {
                $obj = array("status" => 'failure');
            }
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $exc) {
            Yii::log('In Excpetion actionCancelSchedule' . $exc->getMessage(), 'error', 'application');
            $obj = array("status" => 'failure');
            echo CJSON::encode($obj);
        }
    }

    public function actionSurveyAnalytics() {
        try {
            $scheduleId = isset($_REQUEST['ScheduleId']) ? $_REQUEST['ScheduleId'] : "";
           // $userId = "";
            $userId = $_REQUEST['UserId'];
            $object = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyAnalytics($userId, $scheduleId);
            echo json_encode($object);
        } catch (Exception $ex) {
            error_log("actionSurveyAnalytics exception==--" . $ex->getMessage());
        }
    }
    
    public function actionGetSurveyAnalyticsData(){
        try{
            $result = array();
            $filterValue = $_REQUEST['filterValue'];
            $searchText = $_REQUEST['searchText'];
            $startLimit = $_REQUEST['startLimit'];
            $pageLength = $_REQUEST['pageLength'];
            error_log("===filterValue====$filterValue==searchtext===$searchText===startLimit=-==$startLimit===pageLength===$pageLength");
            $data = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyAnalyticsData($pageLength,$startLimit,$searchText,$filterValue,Yii::app()->session['timezone']);
            $totalUsers["totalCount"] = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyAnalyticsDataCount($filterValue,$searchText);
            $result = array("data" => $data, "total" => $totalUsers, "status" => 'success');    
            echo json_encode($result);
        } catch (Exception $ex) {
            error_log("###########actionGetSurveyAnalyticsData exception##########" . $ex->getMessage());
        }
    }
    
    public function actionViewAdminSurveyAnalytics(){
        try{
            $surveyId = $_REQUEST['surveyId'];
            $scheduleId = $_REQUEST['ScheduleId'];
            $QuestionsSurveyForm = new QuestionsSurveyForm;
            $surveyObj = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyDetailsById('Id',$surveyId);
            $userId = "";
            $scheduleObject = ScheduleSurveyCollection::model()->getScheduleSurveyDetailsObject("Id", $scheduleId);
            $surveyedCount = sizeof($scheduleObject->SurveyTakenUsers);
            $dateFormat = CommonUtility::getDateFormat();
            $timezone = Yii::app()->session['timezone'];
            $startDate = date($dateFormat,CommonUtility::convert_date_zone($scheduleObject['StartDate']->sec,$timezone,  date_default_timezone_get())) ;
            $endDate = date($dateFormat,CommonUtility::convert_date_zone($scheduleObject['EndDate']->sec,$timezone,  date_default_timezone_get())) ;                 
            $date = $startDate." to ".$endDate;
            $text = $this->renderPartial('adminAnalytics',array("surveyObj"=>$surveyObj,"QuestionsSurveyForm"=>$QuestionsSurveyForm,"scheduleId"=>$scheduleId,"userId"=>$userId,"surveyedCount"=>$surveyedCount,"sdate"=>$date),true);
            echo $text;
        } catch (Exception $ex) {
            error_log("#######Exception occurred in the actionViewAdminSurveyAnalytics########".$ex->getMessage());
        }
    }
    
    public function actionPdf(){
    
//        $date = $_REQUEST['date'];
//        $analyticType = $_REQUEST['analyticType'];
        try
        {
            $question = $_REQUEST['question'];
            $date = date("Y-M-D");
            $name = "OM";
            error_log("==in aciton pdf=question====$question");
        $this->renderPartial('html2pdf',array('date'=>$date,"name"=>$name,'configParams'=>Yii::app()->params,"question"=>$question));
        }catch(Exception $e) {
        error_log("=HTML2PDF_exception==Exception occurre==".$e->getMessage());
        
    }

    }
    
    public function actionAnalyticsSaveImageFromBase64(){
        try{        
            $data = $_REQUEST['imgData'];
            $img = str_replace('data:image/png;base64,', '', $data);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $userId = $this->tinyObject->UserId;
            $path = $this->findUploadedPath();
             $fileName = $path."/images/".$userId."_analyticsPDF.png";
            //save image from base64_string ...
            $success = file_put_contents($fileName, $data);
            $obj = array("data"=>"","status"=>$success);
        } catch (Exception $e) {
            error_log("############Exception rised in actionSaveImageFromBase64 ###############" . $e->getMessage());
        }           
        echo CJSON::encode($obj);
    }
    
    function findUploadedPath() {
     
        try {
          $originalPath="";
            $path = dirname(__FILE__);
            $pathArray = explode('/', $path);
            $appendPath = "";
            for ($i = count($pathArray) - 3; $i > 0; $i--) {
                $appendPath = "/" . $pathArray[$i] . $appendPath;
            }
            
            $originalPath = $appendPath;
        } catch (Exception $ex) {
            error_log("#########Exception Occurred########$ex->getMessage()");
        }
        return $originalPath;
 } 

 public function actionSurveyAnalyticsByGroupName() {
        try {
            $groupName = isset($_REQUEST['groupName']) ? $_REQUEST['groupName'] : "";            
//            $userId = 1;            
            $surveyId = $_REQUEST['surveyId'];
            $timezone = Yii::app()->session['timezone'];                           
            $object = ServiceFactory::getSkiptaExSurveyServiceInstance()->getSurveyAnalyticsByGroupName($userId, $groupName,$surveyId,$timezone);
            
            $totObj = array("data"=>$object[0],"sdates"=>$object[1]);
            echo json_encode($totObj);
        } catch (Exception $ex) {
            error_log("actionSurveyAnalytics exception==--" . $ex->getMessage());
        }
    }
    
    public function actionGenerateSurveyAnalyticsXLS(){
        try{   
          //Some data
            $surveyId = $_REQUEST['surveyId'];
            $scheduleId = $_REQUEST['scheduleId'];
            $qType = $_REQUEST['qType'];
            $qId = $_REQUEST['qId'];
            $groupName = $_REQUEST['groupName'];
             $dateFormat = CommonUtility::getDateFormat();
               $ActivityColumnsArray=array();

           $data=array();
            $i=0;
            $graphType = "Radio widget";
               $userId = "";
               if($groupName == ""){
                    $dataobj = CommonUtility::prepateSurveyAnalyticsData($userId,$scheduleId,"");
               }else{
                   $timezone = Yii::app()->session['timezone'];
                   $dataobj1 = CommonUtility::prepateSurveyAnalyticsDataByGroup($userId, $groupName,$surveyId,$timezone);
                   $dataobj = $dataobj1[0];
               }
               
               foreach($dataobj->Questions as $key=>$value){
                   
                   if( ($value['QuestionType'] == 1 || $value['QuestionType'] == 2 || $value['QuestionType'] == 5) && $qId == $value['QuestionId']){
                        $data[0][0] = $value['Question'];
                        $data[1][0] = "";
                        $data[2][0] = "Option Name";
                        $data[2][1] = "Answered Count";
                        $data[2][2] = "Percentage";                        
                        $i = 3;
                        $j = 0;
                        foreach($value['OptionsPercentageArray'] as $key1=>$value1){
                            $data[$i][0] = $key1;
                            $data[$i][1] = $value['OptionsNewArray'][$key1];
                            $data[$i][2] = $value1."%";
                            $i++;
                        }
                   } else if( ($value['QuestionType'] == 3 || $value['QuestionType'] == 4) && $qId == $value['QuestionId']){
                        $data[0][0] = $value['Question'];                      
                        $i = 0;
                        $j = 1;
                        foreach($value['LabelName'] as $key1=>$value1){
                            $data[0][$j] = $value1;                            
                            $j++;
                        }
                        $data[0][$j] = "Total";
                        $data[0][$j+1] = "Average";
                        $i = 1;
                        $j = 1;                        
                        foreach($value['OptionsPercentageArray'] as $key1=>$value1){
                            $data[$i][0] = $key1;   
                            $j = 1;
                            $totalValue = 0;
                            foreach($value1 as $k=>$v){
                                $totalValue += $value['OptionsNewArray'][$key1][$k];
                                $data[$i][$j] = $value['OptionsNewArray'][$key1][$k];                                
                                $j++;
                            }
                            $avg = ($totalValue/($j-1));
                            $data[$i][$j] = $totalValue;
                            $data[$i][$j+1] = $avg;
                            $i++;
                        }
                   } else if( ($value['QuestionType'] == 6 || $value['QuestionType'] == 7) && $qId == $value['QuestionId']){                        
                        $data[0][0] = $value['Question'];
                        $data[1][0] = "";
                        $data[2][0] = "Option Name";
                        $data[2][1] = "Answered Count";
//                        $data[2][2] = "Percentage";                        
                        $i = 3;
                        $j = 0;
                        foreach($value['OptionsNewArray'] as $key1=>$value1){
                            $data[$i][0] = $key1;
                            $data[$i][1] = $value1;
//                            $data[$i][2] = $value1."%";
                            $i++;
                        }
                   }
                   
               }


        $r = new YiiReport(array('template'=> 'surveyAnalytics_new.xls'));
        $f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'Activity Report',                        
                        'footer' => str_replace('&copy;',"",$f),
                    )
                ),
            )
        );
        CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$ActivityColumnsArray, $data);
        $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'SurveyAnalytics');
        
        Yii::app()->end();
            
      } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        } 
    }
}
