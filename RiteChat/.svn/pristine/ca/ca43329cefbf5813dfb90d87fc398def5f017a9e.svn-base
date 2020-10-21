<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdvertisementsController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function init() {
        parent::init();
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
            $this->whichmenuactive = 6;
            $this->sidelayout = 'no';
        } else {
            $this->redirect('/');
        }
    }

    public function actionIndex() {
        $advertisementForm = new AdvertisementForm();
        $adTypes = array();
        $adTypesResult = ServiceFactory::getSkiptaAdServiceInstance()->getAdTypes();
        if (is_array($adTypesResult)) {
            $adTypes = $adTypesResult;
        }
        $adRequestedFields = array();
        $adRequestedFieldsResult = ServiceFactory::getSkiptaAdServiceInstance()->getAdRequestedFields();
        if (is_array($adRequestedFieldsResult)) {
            $adRequestedFields = $adRequestedFieldsResult;
        }
        $groupDetals = ServiceFactory::getSkiptaGroupServiceInstance()->loadOnlyGroupNames();
        $this->render('index', array('advertisementForm' => $advertisementForm, 'groupNames' => $groupDetals, 'adTypes' => $adTypes, 'adRequestedFields' => $adRequestedFields));
    }

    public function actionnewAdvertisement() {
        try {

            $advertisementForm = new AdvertisementForm();
            if (isset($_POST['AdvertisementForm'])) {
                $advertisementForm->attributes = $_POST['AdvertisementForm'];
                $userId = $this->tinyObject['UserId'];

                $errors = CActiveForm::validate($advertisementForm);


                if ($errors == '[]') {
                    if ($advertisementForm->AdTypeId == 1 && $advertisementForm->DoesthisAdrotateHidden != "ok") {
                        $result = ServiceFactory::getSkiptaAdServiceInstance()->isAnyAdsConfiguredWithThisDisplayPosition($advertisementForm->DisplayPosition, $advertisementForm->AdTypeId, $advertisementForm->DisplayPage, $advertisementForm->StartDate, $advertisementForm->ExpiryDate, $advertisementForm->IsThisAdRotate, $advertisementForm->id, $advertisementForm->Status);
                        if ($result) {
                            $errors = array();
                            $errors["popupMessage"][] = "In This Display Page with this Dislay Position, between this Start Date And Expiry Date  other Ad are configured. Plese set Time Interval for this Ad else this Ad will be create with inactive status";
                        }
                    }
                }
                if ($errors != '[]') {
//                     error_log("-------------------------------".print_r($errors,true));
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                    $adname = $advertisementForm->DisplayPosition;
                    if ($advertisementForm->AdTypeId != 1) {
                        $filepath = Yii::getPathOfAlias('webroot') . $advertisementForm->Url;
                        $img = Yii::app()->simpleImage->load($filepath);
                        list($width, $height) = getimagesize($filepath);
                        if ($width > '600') {
                            $img->resizeToWidth(600);
                            $img->save($filepath);
                        }

                        if ($advertisementForm->IsThisExternalParty == 1) {
                            $logofilepath = Yii::getPathOfAlias('webroot') . $advertisementForm->ExternalPartyUrl;
                            $img = Yii::app()->simpleImage->load($logofilepath);
                            list($width, $height) = getimagesize($logofilepath);
                            if ($width > '250') {
                                $img->resizeToWidth(250);
                                $img->save($logofilepath);
                            }
                        }
                    }



                    if (isset($advertisementForm->id)) {

                        if ($advertisementForm->AdTypeId == 1 && $advertisementForm->DoesthisAdrotateHidden == "ok") {

                            $advertisementForm->Status = 0;
                        }

                        $result = ServiceFactory::getSkiptaAdServiceInstance()->saveNewAdService($advertisementForm, $userId, "edit");

                        $obj = array('status' => 'success', 'data' => 'Advertisement updated scuccessfully', 'error' => '', 'page' => 'edit');
                    } else {

                        $advertisementForm->Status = 1;

                        if ($advertisementForm->AdTypeId == 1 && $advertisementForm->DoesthisAdrotateHidden == "ok") {


                            $advertisementForm->Status = 0;
                        }
                        $result = ServiceFactory::getSkiptaAdServiceInstance()->saveNewAdService($advertisementForm, $userId, "new");
                        if ($result == 'success') {
                            $obj = array('status' => 'success', 'data' => 'Advertisement Created Successfully', 'error' => '', 'page' => 'new');
                        } else {
                            $obj = array('status' => 'failure', 'data' => 'Some thing went wrong please try again later', 'error' => '');
                        }
                    }
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $exc) {
            error_log("===========in ad controller ===========" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function actionUploadAdvertisementImage() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder = Yii::getPathOfAlias('webroot') . '/upload/'; // folder for uploaded files
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "png", "tiff", "swf", "mov", "mp4"); //array("jpg","jpeg","gif","exe","mov" and etc...
            // $sizeLimit = 30 * 1024 * 1024;// maximum file size in bytes
            $sizeLimit = Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
            $fileName = $result['filename']; //GETTING FILE NAME
            $extension = $result['extension'];

            $ext = "advertisements/";
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

    public function actionloadAds() {
        try {
            $position = $_REQUEST['position'];
            $page = $_REQUEST['page'];
            $groupId = '';
            $groupName = '';
            if ($page == "group") {
                $urlArray = explode("/", $_SERVER['HTTP_REFERER']);
                $groupName = $urlArray[3];
                $groupName = trim(urldecode($groupName));
                $groupIdFromName = ServiceFactory::getSkiptaPostServiceInstance()->getGroupIdByName($groupName);
                if (isset($groupIdFromName)) {
                    $groupId = $groupIdFromName;
                }
            } else {
                $groupId = '';
            }

            $loadAds = ServiceFactory::getSkiptaAdServiceInstance()->loadAds($position, $page, $groupId);

            $htmlData = $this->renderPartial('loadAds', array("loadAds" => $loadAds, "position" => $position, "ad" => 0), true);
            $obj = array("htmlData" => $htmlData, "loadAds" => $loadAds, "position" => $position, "page" => $page);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            error_log("-------------------------------" . $exc->getMessage());
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
    }

    public function actionGetAllAdvertisementsForAdmin() {
        try {

            $recordCount = 0;
            $searchText = trim($_REQUEST['searchText']);
            $startLimit = $_REQUEST['startLimit'];
            $pageLength = $_REQUEST['pageLength'];
            $filterValue = $_REQUEST['filterValue'];
            if (!isset($startLimit) || empty($startLimit)) {
                $startLimit = 0;
            }
            if (!isset($pageLength) || empty($pageLength)) {
                $pageLength = 10;
            }
            if (!isset($searchText) || empty($searchText) || $searchText == "undefined") {
                $searchText = '';
            }
            if (!isset($filterValue) || empty($filterValue) || $searchText == "undefined") {
                $filterValue = "all";
            }
            $advertisements = ServiceFactory::getSkiptaAdServiceInstance()->getAllAdvertisementsForAdmin($searchText, $startLimit, $pageLength, $filterValue);
            $adTypes = ServiceFactory::getSkiptaAdServiceInstance()->getAdTypes();
            $totalCount = ServiceFactory::getSkiptaAdServiceInstance()->getTotalCountForAdvertisements();
            $htmlData = $this->renderPartial('advertisementsWall', array("advertisements" => $advertisements, "adTypes" => $adTypes), "html");
            if (is_array($advertisements)) {
                $recordCount = count($advertisements);
            }
            $obj = array("htmlData" => $htmlData, "totalCount" => $totalCount, "searchText" => $searchText, "recordCount" => $recordCount);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function actionEditAdvertisement() {
        try {
            $id = $_REQUEST['id'];
            $SourceType = 'Upload';
            if (isset($id) || !empty($id)) {
                $advertisementForm = new AdvertisementForm();
                $advertisements = ServiceFactory::getSkiptaAdServiceInstance()->getAdvertisementByType("id", $id);
                $groupDetals = ServiceFactory::getSkiptaGroupServiceInstance()->loadOnlyGroupNames();
                $advertisementForm->AdTypeId = $advertisements['AdTypeId'];
                $advertisementForm->Name = $advertisements['Name'];
                $advertisementForm->RedirectUrl = $advertisements['RedirectUrl'];
                $advertisementForm->DisplayPage = $advertisements['DisplayPage'];

                $exdate = new DateTime($advertisements['ExpiryDate']);
                $advertisementForm->ExpiryDate = $exdate->format('m/d/Y');
                $advertisementForm->Type = $advertisements['Type'];
                $advertisementForm->Status = $advertisements['Status'];

                $advertisementForm->id = $advertisements['id'];
                $advertisementForm->OutsideUrl = $advertisements['OutsideUrl'];
                $advertisementForm->SourceType = $advertisements['SourceType'];

                if ($advertisements['SourceType'] != 'StreamBundleAds') {
                    $advertisementForm->Url = $advertisements['Url'];
                }
                if ($advertisements['DisplayPage'] == "Group") {
                    $advertisementForm->GroupId = explode(', ', $advertisements['GroupId']);
                }
                if ($advertisements['RequestedParams'] != "" && $advertisements['RequestedParams'] != null) {
                    $reqParms = explode(',', $advertisements['RequestedParams']);
                    foreach ($reqParms as $param) {
                        $paramList = explode(':', $param);
                        if ($paramList[0] == "UserId") {
                            $advertisementForm->Requestedparam1 = $paramList[1];
                            $advertisements['Requestedparam1'] = $paramList[1];
                        }
                        if (trim($paramList[0]) == "Display Name") {
                            $advertisementForm->Requestedparam2 = $paramList[1];
                            $advertisements['Requestedparam2'] = $paramList[1];
                        }
                    }
                }

                if ($advertisements['AdTypeId'] == "1") {
                    $advertisementForm->DisplayPosition = $advertisements['DisplayPosition'];
                    $advertisementForm->TimeInterval = $advertisements['TimeInterval'];
                    if ($advertisements['SourceType'] == "StreamBundleAds") {
                        $advertisementForm->StreamBundleAds = $advertisements['StreamBundle'];
                    }

                    $advertisementForm->IsThisAdRotate = $advertisements['IsAdRotate'];
                }
                if ($advertisements['SourceType'] == "AddServerAds") {
                    $advertisementForm->ImpressionTags = $advertisements['ImpressionTag'];
                    $advertisementForm->ClickTag = $advertisements['ClickTag'];
                }
                $sdate = new DateTime($advertisements['StartDate']);
                $advertisementForm->StartDate = $sdate->format('m/d/Y');
                if ($advertisements['AdTypeId'] != "1") {
                    $advertisementForm->Title = $advertisements['Title'];
                    $advertisementForm->BannerTemplate = $advertisements['BannerTemplate'];
                    $advertisementForm->BannerContent = $advertisements['BannerContent'];
                    $advertisementForm->BannerTitle = $advertisements['BannerTitle'];
                    $advertisementForm->BannerOptions = $advertisements['BannerOptions'];
                    if ($advertisements['BannerOptions'] == "OnlyText") {
                        $advertisementForm->BannerContentForTextOnly = $advertisements['BannerContent'];
                        $advertisementForm->BannerTitleForTextOnly = $advertisements['BannerTitle'];
                    }
                    $advertisementForm->IsThisExternalParty = $advertisements['IsThisExternalParty'];
                    $advertisementForm->ExternalPartyName = $advertisements['ExternalPartyName'];
                    $advertisementForm->ExternalPartyUrl = $advertisements['ExternalPartyUrl'];
                }
                if ($advertisements['AdTypeId'] == "3") {
                    $advertisementForm->RequestedFields = explode(', ', $advertisements['RequestedFields']);
                }


                $SourceType = $advertisements['SourceType'];
                $adTypes = array();
                $adTypesResult = ServiceFactory::getSkiptaAdServiceInstance()->getAdTypes();
                if (is_array($adTypesResult)) {
                    $adTypes = $adTypesResult;
                }
                $adRequestedFields = array();
                $adRequestedFieldsResult = ServiceFactory::getSkiptaAdServiceInstance()->getAdRequestedFields();
                if (is_array($adRequestedFieldsResult)) {
                    $adRequestedFields = $adRequestedFieldsResult;
                }
                $htmlData = $this->renderPartial('editAdvertisement', array("advertisements" => $advertisements, 'advertisementForm' => $advertisementForm, 'groupNames' => $groupDetals, 'sourceType' => $SourceType, 'adTypes' => $adTypes, 'adRequestedFields' => $adRequestedFields), "html");
                $obj = array("htmlData" => $htmlData);
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function actionshowPreview() {
        try {
            $id = $id = $_REQUEST['id'];
            $url = $_REQUEST['url'];
            $type = $_REQUEST['type'];
            $position = $_REQUEST['position'];
            $displayPage = $_REQUEST['displayPage'];
            if ($displayPage == "Group") {
                $src = "/images/system/adsgroupspreview.jpg";
            } else if ($displayPage == "Home") {
                $src = "/images/system/adsstreampeview.jpg";
            } else if ($displayPage == "Curbside") {
                $src = "/images/system/addscurbsidepreview.jpg";
            }
            $htmlData = $this->renderPartial('adPreview', array("url" => $url, 'type' => $type, 'src' => $src, 'position' => $position, 'displayPage' => $displayPage), "html");
            $obj = array("htmlData" => $htmlData, 'type' => $type, 'position' => $position, 'url' => $url);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function actionTrackAdvertisement() {
        try {
            $adId = $id = $_REQUEST['adId'];
            $userId = $this->tinyObject['UserId'];
            if (isset($adId)) {
                ServiceFactory::getSkiptaAdServiceInstance()->trackAdClick($adId, $userId);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function actiontreackAdUser() {
        try {
            $postId = $_REQUEST['PostId'];
            $userId = $this->tinyObject['UserId'];
            if (isset($postId)) {
                ServiceFactory::getSkiptaAdServiceInstance()->saveUserAdTrack($userId, $postId);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function actionGetAddView() {
//incontroller
        try {
            $adId = $_REQUEST['id'];
            $adCollectioObject = ServiceFactory::getSkiptaAdServiceInstance()->getAdCollectionByAdvertisementId($adId);

            $htmlData = $this->renderPartial('advertisement_preview', array("data" => $adCollectioObject), true);

            $obj = array("htmlData" => $htmlData);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }

}
