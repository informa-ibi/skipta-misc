<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends Controller{
    
    public function init() {
        parent::init();
        
            if(isset(Yii::app()->session['TinyUserCollectionObj'])){
                 $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];
                  $this->userPrivileges=Yii::app()->session['UserPrivileges'];
                $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
                $this->whichmenuactive=8;
                if(Yii::app()->session['IsAdmin']=='1')
                {   
                    //$this->redirect('/');
                }else{
                    if($this->userPrivilegeObject->canManageFlaggedPost==1 || $this->userPrivilegeObject->canManageAbuseScan==1 ){
                        
                    }else{
                       $this->redirect('/'); 
                    }
                }
             }else{
                  $this->redirect('/');
        }
        CommonUtility::registerClientScript('simplePagination/','jquery.simplePagination.js');
        CommonUtility::registerClientScript('adminOperations.js');
        CommonUtility::registerClientCss();
    }

    public function actionIndex(){
        
    }
    /**
     * ActionUserManagement: 
     * called for the time and get with Users Object and then render to a view.
     */
    // first time it will called...
    public function actionUsermanagement(){
        try{      
            // Initializing variables with default values...
            if(Yii::app()->session['IsAdmin']=='1'){
               $result = array();
            $filterValue = "all";
            $searchText = "";
            $startLimit = 0;
            $pageLength = 10;
            // calling a service method using a service object...
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfile($filterValue,$searchText,$startLimit, $pageLength);
            $totalUsers["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileCount($filterValue,$searchText);
            $userTypes=ServiceFactory::getSkiptaUserServiceInstance()->getRoles();
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $data, "total" => $totalUsers, "status" => 'success', 'userTypes'=>$userTypes);              
            }else{
                 $this->redirect('/');
            }
           
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionUsermanagement==".$ex->getMessage(),"error","application");
        }
        $this->render('usermanagement',array("data"=>json_encode($result)));
    }
    /*
     * actionGetUserManagementDetails is similar as actionUsermanagement but here this is for ajax calls. 
     */
    // used for ajaxcalls...
    public function actionGetUserManagementDetails() {
        try {               
            // Initializing variables with default values...
            $result = array();
            $filterValue = $_REQUEST['filterValue'];
            $searchText = $_REQUEST['searchText'];
            $startLimit = $_REQUEST['startLimit'];
            $pageLength = $_REQUEST['pageLength'];
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfile($filterValue,$searchText,$startLimit, $pageLength);
            $totalUsers["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileCount($filterValue,$searchText);
            $userTypes=ServiceFactory::getSkiptaUserServiceInstance()->getRoles();
            // preparing the resultant array for rendering purpose...
            
            $result = array("data" => $data, "total" => $totalUsers, "status" => 'success',"searchText"=>$searchText, 'userTypes'=>$userTypes);
            echo json_encode($result);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserManagementDetails==".$ex->getMessage(),"error","application");
        }
    }
    
    /**
     * actionViewAUserDetailsById: 
     * requesting for the user details.
     */
    public function actionViewAUserDetailsById(){
        try{
            $userid = $_REQUEST['userId'];
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userid);
            $tinyUserCollectionData = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userid);
            $result = array("data" => $data, "tinyUserCollectionData" => $tinyUserCollectionData, "status" => 'success');             
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionViewAUserDetailsById==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($result);
    }
    
    /**
     * actionUpdateUserManagementStatus:
     * used to update status of an user.
     */
    public function actionUpdateUserManagementStatus(){
        try{            
            $userid = $_REQUEST['userid'];
            $value = $_REQUEST['value'];
            
            $res = ServiceFactory::getSkiptaUserServiceInstance()->updateUserStatus($userid,$value);
            if($res == "success" && $value == 1){
                $adminUserId = (int) (Yii::app()->session['NetworkAdminUserId']);
                ServiceFactory::getSkiptaUserServiceInstance()->followAUser($userid, $adminUserId);
                $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userid);
                //$emailCredentials = ServiceFactory::getSkiptaUserServiceInstance()->getEmailCredentialsByTitle('UserActivation');
                // message variables...
                $to = $userObj['Email'];
                $name = $userObj['FirstName'] . ' ' . $userObj['LastName'];
                $userId = $userObj['UserId'];     
                $subject = "Congratulations! You are now a verified ".Yii::app()->params['NetworkName']." user";
                //$fromAddress = "info@skipta.com"; 
                $messageview="UserAccountInfoMail";                 
                $params = array('name' => $name, 'email'=>$to);
                $sendMailToUser = new CommonUtility;
                $mailSentStatus = $sendMailToUser->actionSendmail($messageview,$params, $subject, $to);            
                $res ="success";
            }            
            $result = array("data" => "", "status" => $res);   
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionViewAUserDetailsById==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($result);
    }
    
    /*
     * NewCurbsideCategory: 
     * called for the time and get with Users Object and then render to a view.
     */
    // first time it will called...
    public function actionNewCurbsideCategory(){
        try{    
             if(Yii::app()->session['IsAdmin']=='1'){
            $categoryCreation = new CurbsidecategorycreationForm();
            // Initializing variables with default values...
            $result = array();
            $filterValue = "all";
            $searchText = "";
            $startLimit = 0;
            $pageLength = 10;
            $newArray=array();
            // calling a service method using a service object...
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getCurbsideCategoriesList($filterValue,$searchText,$startLimit, $pageLength);
         
            foreach ($data as $key => $value)
            {
                $objCount = ServiceFactory::getSkiptaUserServiceInstance()->getPostCountForCategory($value['Id']);
                if(is_object($objCount) && count($objCount)>0){
                        $categoryPostCountArray = array();
                        $newArray[$key]['NumberOfPosts']= $objCount->NumberOfPosts;
                    }else{
                        $newArray[$key]['NumberOfPosts']= 0;
                    }
                $newArray[$key]['Id']= $value['Id']; 
                
                $newArray[$key]['CurbsideCategory']= $value['CurbsideCategory'];
                $newArray[$key]['Status']= $value['Status'];
                $newArray[$key]['CreatedDate']= $value['CreatedDate'];
                $newArray[$key]['ProfileImage']= $value['ProfileImage'];
            }            
            $totalCategories["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getCurbsideCategoriesCount($filterValue,$searchText);
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $newArray, "total" => $totalCategories, "status" => 'success');            
            } else{
              $this->redirect('/');
        }
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionNewCurbsideCategory==".$ex->getMessage(),"error","application");
        }
        $this->render('newCurbsideCategory',array("data"=>CJSON::encode($result), 'categoryCreation'=>$categoryCreation));
        }
   
    
    /*
     * getCurbsideCategorymanagementDetails is similar as actionNewCurbsideCategory but here this is for ajax calls. 
     */
    // used for ajaxcalls...
    public function actionGetCurbsideCategorymanagementDetails() {
        try {   
            // Initializing variables with default values...
            $result = array();
             $newArray=array();
            $filterValue = $_REQUEST['filterValue'];
            $searchText = $_REQUEST['searchText'];
            $startLimit = $_REQUEST['startLimit'];
            $pageLength = $_REQUEST['pageLength'];
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getCurbsideCategoriesList($filterValue,$searchText,$startLimit, $pageLength);
            $totalCategories["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getCurbsideCategoriesCount($filterValue,$searchText);
            foreach ($data as $key => $value)
            {
                $objCount = ServiceFactory::getSkiptaUserServiceInstance()->getPostCountForCategory($value['Id']);
                if(is_object($objCount) && count($objCount)>0){
                        $categoryPostCountArray = array();
                        $newArray[$key]['NumberOfPosts']= $objCount->NumberOfPosts;
                    }else{
                        $newArray[$key]['NumberOfPosts']= 0;
                    }
                $newArray[$key]['Id']= $value['Id']; 
                
                $newArray[$key]['CurbsideCategory']= $value['CurbsideCategory'];
                $newArray[$key]['Status']= $value['Status'];
                $newArray[$key]['CreatedDate']= $value['CreatedDate'];
                $newArray[$key]['ProfileImage']= $value['ProfileImage'];
            }  
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $newArray, "total" => $totalCategories, "status" => 'success',"searchText"=>$searchText);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in getCurbsideCategorymanagementDetails==".$ex->getMessage(),"error","application");
        }
    }
    
    
    /**
     * actionCreateCurbsideCategory: Usee to create and update the category when ajax button is clicked
     * returns success when created, return updatesuccess when category is updated,failure when unable to add and edit
     */
    public function actionCreateCurbsideCategory()
    {
        try{
            $obj = array();
            $status="";
            $categoryCreation = new CurbsidecategorycreationForm();
            if (isset($_POST['CurbsidecategorycreationForm'])) {
                $categoryCreation->attributes = $_POST['CurbsidecategorycreationForm'];
                $errors = CActiveForm::validate($categoryCreation);
                
                
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                     $userObj = ServiceFactory::getSkiptaUserServiceInstance()->adminCategoryCreationService($categoryCreation);
                    if ($userObj != 'failure')
                    {
                        $message = Yii::t('translation', 'CurbsideCategoryCreationSuccess');
                        $status='success';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'updatesuccess')
                    {
                        $message = Yii::t('translation', 'CurbsideCategoryUpdateSuccess');
                        $status='updatesuccess';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'failure') {
                        $messageerror = Yii::t('translation', 'CurbsideCategoryExists');
                        $message = array('CurbsidecategorycreationForm_category' => $messageerror);
                        $status='error';
                        $obj = array("status" => $status, 'data' => '', "error" => $message);
                        
                    }
                }
               // $obj = array('status' => $status, 'data' => $message, 'error' => '');
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            Yii::log("------Exception Occurred in actionCreateCurbsideCategory==".$ex->getMessage(),"error","application");
        }
    }
    
    /*
     * actionUpdateCurbsidecategoryStatus:
     * used to update status of a category.
     */
    public function actionUpdateCurbsidecategoryStatus(){
       
        try{            
            $categoryid = $_REQUEST['id'];
            $categoryvalue = $_REQUEST['value'];
            
            $res = ServiceFactory::getSkiptaUserServiceInstance()->updateCurbsideCategoryStatus($categoryid,$categoryvalue);
            if($res == "success"){
            }            
            $result = array("data" => "", "status" => $res);            
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionViewAUserDetailsById==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($result);
    }
    
    
    /**
     * This action item is used for editing the categories.
     * return JSON object for rendering.
     */
     public function actionEditCurbsideCategory() {
         
         try{
            $categoryId = $_REQUEST['Id'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->editCurbsideCategoryById($categoryId);
            $obj = array("data" => $result, 'error' => "");
            echo CJSON::encode($obj);
         } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionEditCurbsideCategory==".$ex->getMessage(),"error","application");
         }
        
    }

    /**
     * This action item returns the user privileges for admin section.
     * return JSON object for rendering.
     */
    public function actionGetUserPrivileges(){
        try{
            if(isset($_REQUEST['userid'])&& $userid = $_REQUEST['userid']){
                $userArray = ServiceFactory::getSkiptaUserServiceInstance()->getUserPrivileges($userid);
            }
            $obj = array("status"=>"success","data"=>$userArray,"error"=>"");
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in ActionGetUserPrivilege==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($obj);
    }
    
    /**
     * this action item is used to update a user settings...
     * returns either success or failed
     */
    public function actionSaveUserSettings(){
        try{
            $result = "";
            if(isset($_REQUEST['actionIds'])){
                 $actionIds = $_REQUEST['actionIds'];
                $userId = $_REQUEST['userid'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->updateUserPrivileges($userId,$actionIds);
            }
            $obj = array("status"=>$result,"data"=>"","error"=>"");
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionSaveUserSettings==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($obj);
    }
    /**
     * @author Sagar
     * Updated Vamsi Krishna mar 19
     * This method is to get abused posts
     */
    public function actionGetAbusedPosts() {
        try {
            $result = array();
            if(isset($_REQUEST['searchKey'])){
                $searchKey = $_REQUEST['searchKey'];
                $networkId = $this->tinyObject['NetworkId'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollectionForNetworkBySearchKey($networkId, $searchKey);
            }
            $obj = array("status"=>$result,"data"=>"","error"=>"");
            echo CJSON::encode($obj);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in Admin Controller actionGetAbused posts==".$ex->getMessage(),"error","application");
        }
    }/**
     * @author Sagar
     */
    public function actionpostmanagement(){
        $this->render('postmanagement',array());
    }
    public function actionGetnormalabusedposts(){
        try {
          
             if(isset($_GET['AbusedPostDisplayBean_page']))
            {
             if(Yii::app()->session['IsAdmin']=='1'  )
                {
                $condition = array(
                     'IsAbused'=>array('==' => 1)
                );
                }else if(Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost=='1'){
                    
                  $userHierarchy=Yii::app()->session['UserHierarchy'];
               
             if($userHierarchy['Division']!=0 ){                 
             $division=$userHierarchy['Division'];             
             $condition = array(
                     'Division' => array('==' => (int)($division)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
         if($userHierarchy['Region']!=0 ){
             $region=$userHierarchy['Region'];
             $condition = array(
                     'Region' => array('==' => (int)($region)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
          if($userHierarchy['District']!=0 ){
             $district=$userHierarchy['District'];
             $condition = array(
                     'District' => array('==' => (int)($district)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }   
         
          if($userHierarchy['Store']!=0 ){
             $store=$userHierarchy['Store'];
              $condition = array(
                     'Store' => array('==' => (int)($store)),
                     'IsAbused'=>array('==' => 1)
                ); 
         } 
          if($userHierarchy['Division']==0 ){             
              $condition = array(
                     'Store' => array('==' => (int)0),
                     'Division' => array('==' =>(int)0),
                     'District' => array('==' =>(int)0),
                     'Region' => array('==' =>(int)0),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
         
         }
                
               $pageSize=10;
               $provider = new EMongoDocumentDataProvider('AbusedPostDisplayBean',
 
               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>$condition,
                       'sort'=>array('AbusedOn'=>EMongoCriteria::SORT_DESC)
                     )
                   ));
               
               if($provider->getTotalItemCount()==0){
                   $abusedposts=0;//No posts
               }else if($_GET['AbusedPostDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $categoryType = CommonUtility::getIndexBySystemCategoryType("Normal");
                   $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                   $abusedposts = (object)(CommonUtility::prepareAbusedPostData($userId, $provider->getData(), $categoryType,'Abuse')); 
                }else
                {
                    $abusedposts=-1;//No more posts
                }
                $this->renderPartial('abused_posts_view',array('abusedposts'=>$abusedposts));
            }
        } catch (Exception $exc) {                      
            Yii::log("".$exc->getMessage(),"error","application");
        }

       
    }
    public function actionGetcurbsideabusedposts(){
         if(isset($_GET['AbusedCurbsidePostDisplayBean_page']))
            { 
             if(Yii::app()->session['IsAdmin']=='1')
                {
                $condition = array(
                     'IsAbused'=>array('==' => 1)
                );
                }else if(Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost=='1'){
                    
                $userHierarchy=Yii::app()->session['UserHierarchy'];
               
             if($userHierarchy['Division']!=0 ){                 
             $division=$userHierarchy['Division'];             
             $condition = array(
                     'Division' => array('==' => (int)($division)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
         if($userHierarchy['Region']!=0 ){
             $region=$userHierarchy['Region'];
             $condition = array(
                     'Region' => array('==' => (int)($region)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
          if($userHierarchy['District']!=0 ){
             $district=$userHierarchy['District'];
             $condition = array(
                     'District' => array('==' => (int)($district)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }   
         
          if($userHierarchy['Store']!=0 ){
             $store=$userHierarchy['Store'];
              $condition = array(
                     'Store' => array('==' => (int)($store)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }      
          if($userHierarchy['Division']==0 ){             
              $condition = array(
                     'Store' => array('==' => (int)0),
                     'Division' => array('==' =>(int)0),
                     'District' => array('==' =>(int)0),
                     'Region' => array('==' =>(int)0),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
                
                }
           
               $pageSize=10;
               $provider = new EMongoDocumentDataProvider('AbusedCurbsidePostDisplayBean',

               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>$condition,
                       'sort'=>array('AbusedOn'=>EMongoCriteria::SORT_DESC)
                     )
                   ));
               if($provider->getTotalItemCount()==0){
                   $abusedposts=0;//No posts
               }else if($_GET['AbusedCurbsidePostDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $categoryType = CommonUtility::getIndexBySystemCategoryType("Curbside");
                   $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                   $abusedposts = (object)(CommonUtility::prepareAbusedPostData($userId, $provider->getData(), $categoryType,'Abuse')); 
                }else
                {
                    $abusedposts=-1;//No more posts
                }
                $this->renderPartial('abused_posts_view',array('abusedposts'=>$abusedposts));
            }
    }

    /*
     * @method: getHelpIconList
     * called for the time and get with Users Object and then render to a view.
     */
    // first time it will called...
    public function actionHelpManagement(){
        try{
            if(Yii::app()->session['IsAdmin']=='1'){
             $helpIconCreation = new HelpIconcreationForm();
            // Initializing variables with default values...
            $result = array();
            $filterValue = "all";
            $searchText = "";
            $startLimit = 0;
            $pageLength = 10;
            // calling a service method using a service object...
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getHelpIconsDescriptionList($filterValue,$searchText,$startLimit, $pageLength);
            $totalHelpIconListCount["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getHelpIconsDescriptionListCount($filterValue,$searchText);
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $data, "total" => $totalHelpIconListCount, "status" => 'success');            
            $this->render('helpManagement',array("data"=>CJSON::encode($result),'helpIconCreation'=>$helpIconCreation));
            }else{
                 $this->redirect('/');
            }
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionHelpIconList==".$ex->getMessage(),"error","application");
        }
        
    }
    
    
     
    /*
     * GetHelpIconManagementDetails is similar as actionHelpIconList but here this is for ajax calls. 
     */
    // used for ajaxcalls...
    public function actionGetHelpIconManagementDetails() {
        try {  
            
            // Initializing variables with default values...
            $result = array();
            $filterValue = $_REQUEST['filterValue'];
            $searchText = $_REQUEST['searchText'];
            $startLimit = $_REQUEST['startLimit'];
            $pageLength = $_REQUEST['pageLength'];
             // calling a service method using a service object...
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getHelpIconsDescriptionList($filterValue,$searchText,$startLimit, $pageLength);
            $totalHelpIconList["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getHelpIconsDescriptionListCount($filterValue,$searchText);
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $data, "total" => $totalHelpIconList, "status" => 'success');            
            echo CJSON::encode($result);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetHelpIconManagementDetails==".$ex->getMessage(),"error","application");
        }
    }
    
     /**
     * actionCreateNewHelpIcon: Usee to create and update the category when ajax button is clicked
     * returns success when created, return updatesuccess when category is updated,failure when unable to add and edit
     */
    public function actionCreateNewHelpIcon()
    { 
        try{
            $obj = array();
            $status="";
            $message="";
             $helpIconCreation = new HelpIconcreationForm();
            if (isset($_POST['HelpIconcreationForm'])) {
                $helpIconCreation->attributes = $_POST['HelpIconcreationForm'];
                $errors = CActiveForm::validate($helpIconCreation);
                
                if ($errors != '[]') {   
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                     $userObj = ServiceFactory::getSkiptaUserServiceInstance()->adminCreateHelpIconService($helpIconCreation);
                     if ($userObj != 'failure')
                    {
                        $message = Yii::t('translation', 'Help_Description_Success');
                        $status='success';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'updatesuccess')
                    {
                        $message = Yii::t('translation', 'Help_Description_Update');
                        $status='updatesuccess';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'helpexists')
                    {
                        $message = Yii::t('translation', 'Help_Description_Exists');
                        $status='updatefail';
                        $obj = array('status' => $status, 'data' => $message, 'error' => $message);
                    }
                    if($userObj == 'failure') {
                        $message = Yii::t('translation', 'Help_Description_Exists');
                        $message='error';
                        $status='error';
                        $obj = array("status" => $status, 'data' => '', "error" => $message);
                        
                    }
                }
                
                //$obj = array('status' => $status, 'data' => $message, 'error' => '');
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            Yii::log("------Exception Occurred in actionCreateCurbsideCategory==".$ex->getMessage(),"error","application");
        }
    }
    
    /**
     * This action item is used for editing the icon.
     * return JSON object for rendering.
     */
     public function actionEditHelpIconDetails() {
         
         try{
            $iconNameId = $_REQUEST['Id'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->editHelpIconDetails($iconNameId);
            $videoPath = $result->VideoPath;
             $filepath=Yii::getPathOfAlias('webroot').$videoPath;
             
            $obj = array("data" => $result,"basePath"=>$filepath, 'error' => "");
            echo CJSON::encode($obj);
         } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionEditHelpIconDetails==".$ex->getMessage(),"error","application");
         }
        
    }
    
    public function actionUploadHelpVideo(){
      try {         
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder=Yii::getPathOfAlias('webroot').'/upload/';// folder for uploaded files
            if ( !file_exists($folder) ) {
                mkdir ($folder, 0755,true);
               }
            $allowedExtensions = array("mp4", "mov");//array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 100 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
            $extension=$result['extension'];
             
            $ext="help";
            $destnationfolder=$folder.$ext;
            if ( !file_exists($destnationfolder) ) {
                mkdir ($destnationfolder, 0755,true);
            }
           
            $videoArr = explode(".", $result['filename']);
            $date=strtotime("now");
                    $finalVideo_name = $videoArr[0] . '.' . $videoArr[1];
                    $finalVideo=$videoArr[0]  . '_' . $result['imagetime']. '.' . $videoArr[1];
                    $fileNameTosave = $folder.$videoArr[0]  . '_' . $result['imagetime']. '.' . $videoArr[1];
             $path=$folder.$result['filename'];
            rename($path,$fileNameTosave);
            
          //  $filename=$result['filename'];
           $sourcepath=$fileNameTosave;
            $destination=$folder.$ext."/".$finalVideo;
            if($ext!=""){
              if(file_exists($sourcepath)){
                   if(copy($sourcepath, $destination)){
                       unlink($sourcepath);
                   }
               }
            }
            echo $return;// it's array
    } catch (Exception $exc) {
        Yii::log($exc->getTraceAsString(), "error", "application");
    }
    } 
    
  
    public function actionUploadVideo(){
      try {  
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder=Yii::getPathOfAlias('webroot').'/upload/';// folder for uploaded files
            if ( !file_exists($folder) ) {
                mkdir ($folder, 0755,true);
               }
            $allowedExtensions = array("mov","mp4");//array("jpg","jpeg","gif","exe","mov" and etc...
          //  $sizeLimit = 30*1024*1024;// maximum file size in bytes
             $sizeLimit= Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
            $extension=$result['extension'];
             
            $ext="help";
            $destnationfolder=$folder.$ext;
            if ( !file_exists($destnationfolder) ) {
                mkdir ($destnationfolder, 0755,true);
            }
           
            $imgArr = explode(".", $result['filename']);
            $date=strtotime("now");
                    $finalImg_name = $imgArr[0] . '.' . $imgArr[1];
                    $finalImage=$imgArr[0]  . '_' . $result['imagetime']. '.' . $imgArr[1];
                    $fileNameTosave = $folder.$imgArr[0]  . '_' . $result['imagetime']. '.' . $imgArr[1];
             $path=$folder.$result['filename'];
            rename($path,$fileNameTosave);
            
          //  $filename=$result['filename'];
           $sourcepath=$fileNameTosave;
            $destination=$folder.$ext."/".$finalImage;
            if($ext!=""){
              if(file_exists($sourcepath)){
                   if(copy($sourcepath, $destination)){
                       unlink($sourcepath);
                   }
               }
            }
            $result["filepath"]= Yii::app()->getBaseUrl(true).'/upload/'.$ext.'/'.$imgArr[0]  . '_' . $result['imagetime']. '.' . $imgArr[1];
            $result["filesavedpath"]= '/upload/'.$ext."/".$finalImage;
            $result["fileremovedpath"]= Yii::getPathOfAlias('webroot').'/upload/'.$ext."/".$finalImage;
              $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
    } catch (Exception $exc) {
        Yii::log($exc->getTraceAsString(), "error", "application");
    }
    } 
    
     /**
  * This  method is used for  remove the upload the artifacts .
  */
 public function actionRemoveVideoArtifacts(){
        
         try {
             if(isset($_POST['filepath'])){
                $filepath=$_POST['filepath'];
            }else{
                $filepath="";
            }
            $f="'".$filepath."'";
            if (file_exists($filepath)) {
                if(unlink($filepath)){
                    $obj = array('status' => 'success', 'data' => '', 'error' => '','filename'=>$_POST['file'],'image'=>$_POST['image']);
                }else{
                     $obj = array('status' => 'failed', 'data' => '', 'error' => '','filename'=>$_POST['file'],'image'=>$_POST['image']);
                }
            }else{
            }
            $renderScript = $this->rendering($obj);
             echo $renderScript;  
             Yii::app()->end();
     } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
      } 
  }
  
   /*
     * actionUpdateHelpIconStatus:
     * used to update status of a help icon.
     */
    public function actionUpdateHelpIconStatus(){
       
        try{            
            $helpIconid = $_REQUEST['id'];
            $helpIconStatus = $_REQUEST['value'];
            $res = ServiceFactory::getSkiptaUserServiceInstance()->updateHelpIconStatus($helpIconid,$helpIconStatus);
            if($res == "success"){
            }            
            $result = array("data" => "", "status" => $res);            
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionViewAUserDetailsById==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($result);
    }

    /**
     * 
     */
    public function actionGetgroupabusedposts(){
        try{            
            if(isset($_GET['AbusedGroupPostDisplayBean_page']))
            {
                  if(Yii::app()->session['IsAdmin']=='1')
                {
                $condition = array(
                     'IsAbused'=>array('==' => 1)
                );
                }else if(Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost=='1'){
                    
                $userHierarchy=Yii::app()->session['UserHierarchy'];
               
             if($userHierarchy['Division']!=0 ){                 
             $division=$userHierarchy['Division'];             
             $condition = array(
                     'Division' => array('==' => (int)($division)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
         if($userHierarchy['Region']!=0 ){
             $region=$userHierarchy['Region'];
             $condition = array(
                     'Region' => array('==' => (int)($region)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
          if($userHierarchy['District']!=0 ){
             $district=$userHierarchy['District'];
             $condition = array(
                     'District' => array('==' => (int)($district)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }   
         
          if($userHierarchy['Store']!=0 ){
             $store=$userHierarchy['Store'];
              $condition = array(
                     'Store' => array('==' => (int)($store)),
                     'IsAbused'=>array('==' => 1)
                ); 
         }       
          if($userHierarchy['Division']==0 ){             
              $condition = array(
                     'Store' => array('==' => (int)0),
                     'Division' => array('==' =>(int)0),
                     'District' => array('==' =>(int)0),
                     'Region' => array('==' =>(int)0),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
                
                }
     
               $pageSize=10;
               $provider = new EMongoDocumentDataProvider('AbusedGroupPostDisplayBean',

               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>$condition,
                       'sort'=>array('AbusedOn'=>EMongoCriteria::SORT_DESC)
                     )
                   ));
               if($provider->getTotalItemCount()==0){
                   $abusedposts=0;//No posts
               }else if($_GET['AbusedGroupPostDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $categoryType = CommonUtility::getIndexBySystemCategoryType("Group");
                   $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                   $abusedposts = (object)(CommonUtility::prepareAbusedPostData($userId, $provider->getData(), $categoryType,'Abuse')); 
                }else
                {
                    $abusedposts=-1;//No more posts
                }
                $this->renderPartial('abused_posts_view',array('abusedposts'=>$abusedposts));
            }          
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetgroupabusedposts==".$ex->getMessage(),"error","application");
        }
    }
    public function actionCreatenewabuseword(){
        try{
            $obj = array();
            $status="";
             $abuseWordCreation = new AbuseWordCreationForm();
            if (isset($_POST['AbuseWordCreationForm'])) {
                $abuseWordCreation->attributes = $_POST['AbuseWordCreationForm'];
                $errors = CActiveForm::validate($abuseWordCreation);
                if ($errors != '[]') {
                    $message = "Abuse word can not be empty";
                    $obj = array('status' => 'error', 'data' => $message, 'error' => $errors);
                } else {
                    $abuseWordRes = ServiceFactory::getSkiptaUserServiceInstance()->saveAbuseWordService($abuseWordCreation);
                    if(is_array($abuseWordRes)){
                        $savedMessage="";
                        if(sizeof($abuseWordRes['savedWords'])>0){
//                            $savedWords = implode(',', $abuseWordRes['savedWords']);
//                            $savePrep = sizeof($abuseWordRes['savedWords'])>1?' are ':' is ';
                            //$savedMessage = $savedWords.$savePrep."saved successfully" ;
                            if(sizeof($abuseWordRes['savedWords'])>1){
                                $savedMessage = "Block words saved successfully" ;
                            }else{
                                $savedMessage = "Block word saved successfully" ;
                            }
                            $message=$savedMessage;
                            $status='created';
                        }else{
                            $existMessage="";
                            if(sizeof($abuseWordRes['existingWords'])>0){
                                if(sizeof($abuseWordRes['existingWords'])>1){
                                    $existMessage = "Block words already exist" ;
                                }else{
                                    $existMessage = "Block word already exist" ;
                                }
                            }
                            $message=$existMessage;
                            $status='exist';
                        }
                        
                    }elseif($abuseWordRes=="updated"){
                        $message = Yii::t('translation', 'AbuseWordCreation_Updated');
                        $status='updated';
                    }else{
                        if(isset($abuseWordCreation['id']) && !empty($abuseWordCreation['id'])){
                            $message = Yii::t('translation', 'AbuseWordCreation_CreationFail');
                        }else{
                            $message = Yii::t('translation', 'AbuseWordCreation_UpdationFail');
                        }
                    }
                    $obj = array('status' => $status, 'data' => $message, 'error' => '');
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            Yii::log("------Exception Occurred in actionCreateCurbsideCategory==".$ex->getMessage(),"error","application");
        }
    }

    public function actionAbuseScan(){
        $abuseWordCreation = new AbuseWordCreationForm();
         $this->render('abusedscan',array('abuseWordCreation'=>$abuseWordCreation));    
        }
        
    
    public function actionGetAbusedWords(){
        try{            
            if(isset($_GET['AbuseKeywords_page']))
            {
               $pageSize=10;
               $searchKey='';
               if(isset($_GET['pageSize'])){
                   $pageSize = (int)$_GET['pageSize'];
               }
               if(isset($_GET['searchKey'])){
                   $searchKey = $_GET['searchKey'];
               }
               $provider = new EMongoDocumentDataProvider('AbuseKeywords',
               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>array(
                           'AbuseWord'=>array('==' => new MongoRegex('/'.$searchKey.'.*/i'))
                           ),
                       'sort'=>array('AbuseWord'=>EMongoCriteria::SORT_ASC)
                     )
                   ));
               $abusedwords=-1;
               if($provider->getTotalItemCount()==0){
                   $abusedwords=0;//No posts
               }else if($_GET['AbuseKeywords_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $abusedwords = (object)($provider->getData()); 
                }
                $renderHtml = $this->renderPartial('abused_scan_view',array('abuseWords'=>$abusedwords, 'totalCount'=>$provider->getTotalItemCount()), true);
                $obj = array('status' => 'success', 'html' => $renderHtml, 'totalCount' => $provider->getTotalItemCount());
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }          
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetgroupabusedposts==".$ex->getMessage(),"error","application");
        }
    }
    public function actionGetNormalBlockedPosts(){
         if(isset($_GET['AbusedPostDisplayBean_page']))
            {
               $pageSize=10;
                  if(Yii::app()->session['IsAdmin']=='1')
                {
                $condition = array(
                                'IsBlockedWordExist'=>array('or' => 1),
                                'IsBlockedWordExistInComment'=>array('or' => 1)
                           );
                }else if(Yii::app()->session['UserPrivilegeObject']->canManageAbuseScan=='1'){
                    
                $userHierarchy=Yii::app()->session['UserHierarchy'];
               
             if($userHierarchy['Division']!=0 ){                 
             $division=$userHierarchy['Division'];             
             $condition = array(
                     'Division' => array('==' => (int)($division)),
                     'IsBlockedWordExist'=>array('or' => 1),
                     'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }
         if($userHierarchy['Region']!=0 ){
             $region=$userHierarchy['Region'];
             $condition = array(
                     'Region' => array('==' => (int)($region)),
                     'IsBlockedWordExist'=>array('or' => 1),
                     'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }
          if($userHierarchy['District']!=0 ){
             $district=$userHierarchy['District'];
             $condition = array(
                     'District' => array('==' => (int)($district)),
                    'IsBlockedWordExist'=>array('or' => 1),
                    'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }   
         
          if($userHierarchy['Store']!=0 ){
             $store=$userHierarchy['Store'];
              $condition = array(
                     'Store' => array('==' => (int)($store)),
                    'IsBlockedWordExist'=>array('or' => 1),
                    'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }   
             if($userHierarchy['Division']==0 ){             
              $condition = array(
                     'Store' => array('==' => (int)0),
                     'Division' => array('==' =>(int)0),
                     'District' => array('==' =>(int)0),
                     'Region' => array('==' =>(int)0),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
                
                }
  
               
               
               
               $provider = new EMongoDocumentDataProvider('AbusedPostDisplayBean',

               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>$condition,
                       'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                     )
                   ));               
               
               if($provider->getTotalItemCount()==0){
                   $abusedposts=0;//No posts
               }else if($_GET['AbusedPostDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $categoryType = CommonUtility::getIndexBySystemCategoryType("Normal");
                   $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                   $abusedposts = (object)(CommonUtility::prepareAbusedPostData($userId, $provider->getData(), $categoryType,'Block')); 
                }else
                {
                    $abusedposts=-1;//No more posts
                }
                $this->renderPartial('abused_posts_view',array('abusedposts'=>$abusedposts));
            }
    }
    public function actionGetCurbsideBlockedPosts(){
         if(isset($_GET['AbusedCurbsidePostDisplayBean_page']))
            {
               $pageSize=10;
                if(Yii::app()->session['IsAdmin']=='1')
                {
                $condition = array(
                                'IsBlockedWordExist'=>array('or' => 1),
                                'IsBlockedWordExistInComment'=>array('or' => 1)
                           );
                }else if(Yii::app()->session['UserPrivilegeObject']->canManageAbuseScan=='1'){
                    
                $userHierarchy=Yii::app()->session['UserHierarchy'];
               
             if($userHierarchy['Division']!=0 ){                 
             $division=$userHierarchy['Division'];             
             $condition = array(
                     'Division' => array('==' => (int)($division)),
                     'IsBlockedWordExist'=>array('or' => 1),
                     'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }
         if($userHierarchy['Region']!=0 ){
             $region=$userHierarchy['Region'];
             $condition = array(
                     'Region' => array('==' => (int)($region)),
                     'IsBlockedWordExist'=>array('or' => 1),
                     'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }
          if($userHierarchy['District']!=0 ){
             $district=$userHierarchy['District'];
             $condition = array(
                     'District' => array('==' => (int)($district)),
                    'IsBlockedWordExist'=>array('or' => 1),
                    'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }   
         
          if($userHierarchy['Store']!=0 ){
             $store=$userHierarchy['Store'];
              $condition = array(
                     'Store' => array('==' => (int)($store)),
                    'IsBlockedWordExist'=>array('or' => 1),
                    'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }    
            if($userHierarchy['Division']==0 ){             
              $condition = array(
                     'Store' => array('==' => (int)0),
                     'Division' => array('==' =>(int)0),
                     'District' => array('==' =>(int)0),
                     'Region' => array('==' =>(int)0),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
                
                }
  
            
               
               $provider = new EMongoDocumentDataProvider('AbusedCurbsidePostDisplayBean',

               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>$condition,
                       'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                     )
                   ));
               if($provider->getTotalItemCount()==0){
                   $abusedposts=0;//No posts
               }else if($_GET['AbusedCurbsidePostDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $categoryType = CommonUtility::getIndexBySystemCategoryType("Curbside");
                   $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                   $abusedposts = (object)(CommonUtility::prepareAbusedPostData($userId, $provider->getData(), $categoryType,'Block')); 
                }else
                {
                    $abusedposts=-1;//No more posts
                }
                $this->renderPartial('abused_posts_view',array('abusedposts'=>$abusedposts));
            }
    }
    public function actionGetGroupBlockedPosts(){
        try{            
            if(isset($_GET['AbusedGroupPostDisplayBean_page']))
            {
               $pageSize=10;
                if(Yii::app()->session['IsAdmin']=='1')
                {
                $condition = array(
                                'IsBlockedWordExist'=>array('or' => 1),
                                'IsBlockedWordExistInComment'=>array('or' => 1)
                           );
                }else if(Yii::app()->session['UserPrivilegeObject']->canManageAbuseScan=='1'){
                    
                $userHierarchy=Yii::app()->session['UserHierarchy'];
               
             if($userHierarchy['Division']!=0 ){                 
             $division=$userHierarchy['Division'];             
             $condition = array(
                     'Division' => array('==' => (int)($division)),
                     'IsBlockedWordExist'=>array('or' => 1),
                     'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }
         if($userHierarchy['Region']!=0 ){
             $region=$userHierarchy['Region'];
             $condition = array(
                     'Region' => array('==' => (int)($region)),
                     'IsBlockedWordExist'=>array('or' => 1),
                     'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }
          if($userHierarchy['District']!=0 ){
             $district=$userHierarchy['District'];
             $condition = array(
                     'District' => array('==' => (int)($district)),
                    'IsBlockedWordExist'=>array('or' => 1),
                    'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         }   
         
          if($userHierarchy['Store']!=0 ){
             $store=$userHierarchy['Store'];
              $condition = array(
                     'Store' => array('==' => (int)($store)),
                    'IsBlockedWordExist'=>array('or' => 1),
                    'IsBlockedWordExistInComment'=>array('or' => 1)
                ); 
         } 
            if($userHierarchy['Division']==0 ){             
              $condition = array(
                     'Store' => array('==' => (int)0),
                     'Division' => array('==' =>(int)0),
                     'District' => array('==' =>(int)0),
                     'Region' => array('==' =>(int)0),
                     'IsAbused'=>array('==' => 1)
                ); 
         }
         
                
                }
  
              
               
               $provider = new EMongoDocumentDataProvider('AbusedGroupPostDisplayBean',

               array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array( 
                       'conditions'=>$condition,
                       'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                     )
                   ));
               if($provider->getTotalItemCount()==0){
                   $abusedposts=0;//No posts
               }else if($_GET['AbusedGroupPostDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){
                   $categoryType = CommonUtility::getIndexBySystemCategoryType("Group");
                   $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                   $abusedposts = (object)(CommonUtility::prepareAbusedPostData($userId, $provider->getData(), $categoryType,'Block')); 
                }else
                {
                    $abusedposts=-1;//No more posts
                }
                $this->renderPartial('abused_posts_view',array('abusedposts'=>$abusedposts));
            }          
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetgroupabusedposts==".$ex->getMessage(),"error","application");
        }
    }
    
    
   public function actionGetRoleBasedMgmt() {
       try {
           if(Yii::app()->session['IsAdmin']=='1'){
               $userTypes=ServiceFactory::getSkiptaUserServiceInstance()->getRoles();           
           $this->render('roles',array('userTypes'=>$userTypes));
           }else{
                 $this->redirect('/');
           }           
           
       } catch (Exception $exc) {
           Yii::log("----".$exc->getMessage(),"error","application");
}
      }
      
   public function actionGetRoleBasedActions(){
       try {           
           $selectedRole=$_REQUEST['selectedRole'];           
           $roleBasedActions=ServiceFactory::getSkiptaUserServiceInstance()->getRolesBySelectedUserType($selectedRole);           
           $this->renderPartial('roleBasedActions',array('roleBasedActions'=>$roleBasedActions));
           
       } catch (Exception $exc) {           
           Yii::log("----".$exc->getMessage(),"error","application");
       }
      }
      
  public function actionUpdateRoleBasedActions(){
      try {
          $selectedRole=$_REQUEST['selectedRoleId'];
          $actionIds=$_REQUEST['actionIds'];
         
          $result=ServiceFactory::getSkiptaUserServiceInstance()->updateRoleBasedActions($selectedRole,$actionIds);
           $obj = array("status" => $result);
         $renderScript = $this->rendering($obj);
                echo $renderScript;
      } catch (Exception $exc) {
         Yii::log("----".$exc->getMessage(),"error","application");
      }
    }
    /**
     * @author Sagar Pathapelli
     * This is used to get User Actions By UserType / RoleId (for Rite Aid)
     * @param type $userId
     * @param type $userTypeId
     * @return string
     */
    public function actionGetUserActionsByUserType(){
      try {
          $userId = $_REQUEST["UserId"];
          $userTypeId = $_REQUEST["UserTypeId"];
          $result=ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, $userTypeId);
          $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userId);
          $name = $userObj['LastName'] . ' ' . $userObj['FirstName'];
          $obj = array("data" => $result, "userId"=>$userId);
          $this->renderPartial('user_preveliges_view',array("userActions" => $obj,"UserName"=>$name));
      } catch (Exception $exc) {
         Yii::log("----".$exc->getMessage(),"error","application");
      }
    }
    /**
     * @author Sagar Pathapelli
     * This method is used to update the UserPrivileges and it is for RiteAid
     * @param type $userId
     * @param type $actionIds
     * @return string
     */
    public function actionUpdateRoleBasedUserPrivileges(){
        try{
            $result = "";
            if(isset($_REQUEST['allActionIds'])){
                $checkedActionIds = $_REQUEST['checkedActionIds'];
                $allActionIds = $_REQUEST['allActionIds'];
                $userId = $_REQUEST['userId'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->updateRoleBasedUserPrivileges($userId,$checkedActionIds, $allActionIds);
            }
            $obj = array("status"=>$result,"data"=>"","error"=>"");
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionUpdateRoleBasedUserPrivileges==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($obj);
    }

public function actionCreatenewrole(){
        try{
            $obj = array();
            $status="";
             $abuseWordCreation = new AbuseWordCreationForm();
            if (isset($_POST['AbuseWordCreationForm'])) {
                $abuseWordCreation->attributes = $_POST['AbuseWordCreationForm'];
                $errors = CActiveForm::validate($abuseWordCreation);
                if ($errors != '[]') {
                    $message = Yii::t('translation', 'AbuseWordCreationForm_AbuseWord');
                    $obj = array('status' => 'error', 'data' => $message, 'error' => $errors);
                } else {
                    $abuseWordRes = ServiceFactory::getSkiptaUserServiceInstance()->saveAbuseWordService($abuseWordCreation);
                    $message = Yii::t('translation', 'AbuseWordCreation_Success');
                    if($abuseWordRes=="created"){
                        $message = Yii::t('translation', 'AbuseWordCreation_Created');
                        $status='created';
                    }elseif($abuseWordRes=="updated"){
                        $message = Yii::t('translation', 'AbuseWordCreation_Updated');
                        $status='updated';
                    }elseif($abuseWordRes=="alreadyExist"){
                        $message = Yii::t('translation', 'AbuseWordCreation_AlreadyExist');
                        $status='alreadyExist';
                    }else{
                        if(isset($abuseWordCreation->id) && !empty($abuseWordCreation->id)){
                            $message = Yii::t('translation', 'AbuseWordCreation_CreationFail');
                        }else{
                            $message = Yii::t('translation', 'AbuseWordCreation_UpdationFail');
                        }
                    }
                    $obj = array('status' => $status, 'data' => $message, 'error' => '');
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            Yii::log("------Exception Occurred in actionCreateCurbsideCategory==".$ex->getMessage(),"error","application");
        }
    }
    public function actionAddRolePage(){
      try {
          $this->renderPartial('addRole',array());
      } catch (Exception $exc) {
         Yii::log("----".$exc->getMessage(),"error","application");
      }
    }
    public function actionSaveRole(){
      try{
            $result = "failure";
            if(isset($_REQUEST['role'])){
                $role = $_REQUEST['role'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->saveRole($role);
            }
            $obj = array("status"=>$result,"data"=>"","error"=>"");
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionSaveUserSettings==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($obj);
    }
    public function actionChangeUserRole(){
      try{
            $result = "failure";
            if(isset($_REQUEST['roleId'])){
                $roleId = $_REQUEST['roleId'];
                $userId = $_REQUEST['userId'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->changeUserRole($userId,$roleId);
            }
            $obj = array("status"=>$result,"data"=>"","error"=>"");
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionSaveUserSettings==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($obj);
    }
   
    
  /**
   * @author Vamsi Krishna
   * Description :TO get all the featured items for admin 
   * 
   */
    public function actionGetAllFeaturedItemsForAdmin() {
        $returnValue='failure';
        try {
            $page=$_REQUEST['FeaturedItemsBean_page'];            
            $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
            $featuredItems=ServiceFactory::getSkiptaPostServiceInstance()->getAllFeaturedItems($page,$userId);            
             $this->renderPartial('featuredItemsForAdmin',array('featuredItems'=>$featuredItems));
        } catch (Exception $exc) {
            Yii::log("__" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    /**
     * @author Sagar
     * @usage Used to block or release comment
     * @param postId
     * @param actionType
     * @param networkId
     * @param categoryType
     * @param commentId
     */
    public function actionBlockOrReleaseComment() {
        try {
            $result = "failure";
            if (isset($_REQUEST['commentId']) && isset($_REQUEST['actionType'])) {
                $postId = $_REQUEST['postId'];
                $actionType = $_REQUEST['actionType'];
                $networkId = $_REQUEST['networkId'];
                $categoryType = $_REQUEST['categoryType'];
                $commentId = $_REQUEST['commentId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->blockOrReleaseComment($postId, $commentId, $categoryType, $actionType, $networkId);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
        echo CJSON::encode($obj);
    }
    /**
     * @autor Sagar
     * @usage GetAllAbuseWords
     * @return Array of block words
     */
    public function actionGetAllAbuseWords(){
        try{
        $AbuseWords = array();
        $AbuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
        if (!is_array($AbuseWords)) {
            $AbuseWords = array();
        }
        $obj = array("status" => 'success', "data" => $AbuseWords, "error" => "");
        echo CJSON::encode($obj);
        }  catch (Exception $ex){
            Yii::log($ex->getMessage(), "error", "application");
        }
    }
    /**
     * @autor Sagar
     * @usage Save Block Words
     * @return 
     */
    public function actionSaveBlockWords(){
       try{
            $result = "failure";
            if(isset($_REQUEST['blockwords'])){
                $blockwords = $_REQUEST['blockwords'];
                $blockwordsArray=array();
                $blockwords = strlen($blockwords)>0?$blockwords:"";
                if(strlen($blockwords)>0){
                    $blockwordsArray = array_unique(explode(",", $blockwords));
                }
                $result = ServiceFactory::getSkiptaPostServiceInstance()->manageBlockWords($blockwordsArray);
            }
            $obj = array("status"=>$result,"data"=>'',"error"=>"");
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionSaveUserSettings==".$ex->getMessage(),"error","application");
        }
        echo CJSON::encode($obj);
    }
    
    public function actionGetAbusedTagCloud(){
        try{
            $AbuseWords = array();
            $AbuseWords = ServiceFactory::getSkiptaPostServiceInstance()->getAbuseWordsWithWeightage();
            if (!is_array($AbuseWords)) {
                $AbuseWords = array();
            }
            $this->renderPartial('abuse_tag_cloud',array('abuseWords'=>$AbuseWords));
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetAbusedTagCloud==".$ex->getMessage(),"error","application");
        }
    }
    public function actionManageExistingBlockedPosts(){
        try{
            $returnVal='failure';
            $returnVal = ServiceFactory::getSkiptaPostServiceInstance()->manageExistingBlockedPosts();
            echo $returnVal;
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetAbusedTagCloud==".$ex->getMessage(),"error","application");
        }
    }
    public function actionNetworkConfig(){
        $networkConfigModel = new NetworkConfigForm();
        $configObj = ServiceFactory::getSkiptaUserServiceInstance()->getConfigurationObject();
        $total["totalCount"] = sizeof($configObj);
        $userTypes=ServiceFactory::getSkiptaUserServiceInstance()->getRoles();
        $result = array("data" => $configObj, "total" => $total, "status" => 'success');
        $this->render('networkConfig',array("data"=>  CJSON::encode($result),"model"=>$networkConfigModel));
    }
    public function actionGetNetworkConfig(){
        try{
            $configObj = ServiceFactory::getSkiptaUserServiceInstance()->getConfigurationObject();
            $this->renderPartial('configurationRendering',array("config"=>$configObj));
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetNetworkConfig=======".$ex->getMessage(),"error","application");
        }
    }
    
    public function actionCreateNewParameter(){
        try{
            $obj = array();
            $status="";
            $model = new NetworkConfigForm();
            if (isset($_POST['NetworkConfigForm'])) {
                $model->attributes = $_POST['NetworkConfigForm'];
                $errors = CActiveForm::validate($model);
                
                
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                     $response = ServiceFactory::getSkiptaUserServiceInstance()->addNewConfigParamter($model);
                    if ($response == 'success')
                    {
                        $message = Yii::t('translation', 'CurbsideCategoryCreationSuccess');
                        $status='success';
                        $obj = array('status' => $status, 'data' => "Parameter Created Successfully", 'error' => '');
                    }
                    if($response == 'Updated')
                    {
                        $message = Yii::t('translation', 'CurbsideCategoryUpdateSuccess');
                        $status='Updated';
                        $obj = array('status' => $status, 'data' => "Parameter Updated Successfully", 'error' => '');
                    }
//                    if($response == 'failure') {
//                        $messageerror = Yii::t('translation', 'CurbsideCategoryExists');
//                        $message = array('NetworkConfigForm_category' => "");
//                        $status='error';
//                        $obj = array("status" => $status, 'data' => '', "error" => $message);
//                        
//                    }
                }
               // $obj = array('status' => $status, 'data' => $message, 'error' => '');
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
            
        } catch (Exception $ex) {
            error_log("#########Exception Occurred=actionCreateNewParameter#########".$ex->getMessage());
        }
    }
    
    public function actionEditNetworkParamter(){
        try{
            $id = $_REQUEST['id'];
            $status = "failure";
            $object = ServiceFactory::getSkiptaUserServiceInstance()->editNetworkParamter($id);
            if(isset($object) && !empty($object)){
                $status = "success";
            }
            $obj = array("data"=>$object,"status"=>$status);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $ex) {
            error_log("#########Exception Occurred=actionCreateNewParameter#########".$ex->getMessage());
        }
    }
    
    public function actionSetUpConfig(){
        try{
            $configObj = ServiceFactory::getSkiptaUserServiceInstance()->getConfigurationObject();
            $i = 0;
            foreach($configObj as $rw){
                Yii::app()->config->setValue('"'.$rw->Key.'"', "'".($rw->Value)."',",TRUE); // writing the database data into file.
                $i++;
            }
            if(sizeof($configObj) == $i){
                $status = "success";
            }
            $obj = array("status"=>$status);
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("#################==Exception occurred= actionSetUpConfig=###########".$ex->getMessage());
        }
    }
    
    public function actionGetNetworkConfiguration(){
       try{
           $configObj = ServiceFactory::getSkiptaUserServiceInstance()->getConfigurationObject();
           $obj = array("data"=>$configObj);
            echo CJSON::encode($obj);
       } catch (Exception $ex) {
            error_log("#################==Exception occurred= actionGetNetworkConfiguration=###########".$ex->getMessage());

       } 
    }
   
    /*
     * @method: TemplateManagement
     * called for the time and get with Users Object and then render to a view.
     */
    // first time it will called...
    public function actionTemplateManagement(){
        try{
           
             $emailConfigurationCreation = new EmailConfigurationCreationForm();
             $templateConfigurationCreationForm = new TemplateConfigurationCreationForm();
            // Initializing variables with default values...
            $data="";
            $result = array();
            //For Email configuration details
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getAllEmailConfigurationDetails();
            $totalEmailConfigurationCount["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getEmailConfigurationDetailsCount();
            
            //for temaplate configuration details
            $templateData = ServiceFactory::getSkiptaUserServiceInstance()->getAllTemplateConfigurationDetails();
            $totalTemplateConfigurationCount["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getTemplateConfigurationDetailsCount();
//            
            
            $result = array("data" => $data, "total" => $totalEmailConfigurationCount, "status" => 'success');
            $resultTeplate = array("data" => $templateData, "total" => $totalTemplateConfigurationCount, "status" => 'success');
            $this->render('templateManagement',array("data"=>CJSON::encode($result),"templateData"=>CJSON::encode($resultTeplate), 'emailConfigurationCreation'=>$emailConfigurationCreation,'templateConfigurationCreationForm'=>$templateConfigurationCreationForm));
            
            
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionTemplateManagement==".$ex->getMessage(),"error","application");
        }
        
    }
    
    /*
     * actionGetEmailConfigurationDetails is similar as actionEmailConfiguration but here this is for ajax calls. 
     */
    // used for ajaxcalls...
    public function actionGetEmailConfigurationDetails() {
        try {  
            
            // Initializing variables with default values...
            $result = array();
             // calling a service method using a service object...
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getAllEmailConfigurationDetails();
            $totalEmailConfigurationCount["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getEmailConfigurationDetailsCount();
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $data, "total" => $totalEmailConfigurationCount, "status" => 'success');            
            echo CJSON::encode($result);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actiongetEmailConfigurationDetails==".$ex->getMessage(),"error","application");
        }
    }
    
    /**
     * actionCreateNewEmailConfiguration: Usee to create and update the email configuration details when ajax button is clicked
     * returns success when created, return updatesuccess when config details are updated,failure when unable to add and edit
     */
    public function actionCreateNewEmailConfiguration()
    { 
        try{
            $obj = array();
            $status="";
            $message="";
             $emailConfigurationCreation = new EmailConfigurationCreationForm();
            if (isset($_POST['EmailConfigurationCreationForm'])) {
                $emailConfigurationCreation->attributes = $_POST['EmailConfigurationCreationForm'];
                $errors = CActiveForm::validate($emailConfigurationCreation);
                
                if ($errors != '[]') {   
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                     $userObj = ServiceFactory::getSkiptaUserServiceInstance()->adminCreateEmailConfigurationService($emailConfigurationCreation);
                     if ($userObj != 'failure')
                    {
                        $message = Yii::t('translation', 'EmailConfigCreation_Success');
                        $status='success';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'updatesuccess')
                    {
                        $message = Yii::t('translation', 'EmailConfig_Update');
                        $status='updatesuccess';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'emailexists')
                    {
                        $message = Yii::t('translation', 'EmailConfig_Exists');
                        $status='updatefail';
                        $obj = array('status' => $status, 'data' => $message, 'error' => $message);
                    }
                    if($userObj == 'failure') {
                        $message = Yii::t('translation', 'EmailConfig_Exists');
                        $message='error';
                        $status='error';
                        $obj = array("status" => $status, 'data' => '', "error" => $message);
                        
                    }
                }
                
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            Yii::log("------Exception Occurred in actionCreateNewEmailConfiguration==".$ex->getMessage(),"error","application");
        }
    }
    
     /**
     * This action item is used for editing the email config details.
     * return JSON object for rendering.
     */
     public function actionEditEmailConfigurationDetails() {
         
         try{
            $configEmailId = $_REQUEST['Id'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->editEmailConfigurationDetails($configEmailId);
             
            $obj = array("data" => $result,'error' => "");
            echo CJSON::encode($obj);
         } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionEditHelpIconDetails==".$ex->getMessage(),"error","application");
         }
        
    }
    
    
        // used for ajaxcalls...
    public function actionGetTemplateConfigurationDetails() {
        try {  
            
            // Initializing variables with default values...
            $result = array();
           
             // calling a service method using a service object...
            $templateData = ServiceFactory::getSkiptaUserServiceInstance()->getAllTemplateConfigurationDetails();
            $totalTemplateConfigurationCount["totalCount"] = ServiceFactory::getSkiptaUserServiceInstance()->getTemplateConfigurationDetailsCount();
           
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $templateData, "total" => $totalTemplateConfigurationCount, "status" => 'success');            
            echo CJSON::encode($result);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetTemplateConfigurationDetails==".$ex->getMessage(),"error","application");
        }
    }
    
    /**
     * actionCreateNewTemplateConfiguration: Usee to create and update the email configuration details when ajax button is clicked
     * returns success when created, return updatesuccess when config details are updated,failure when unable to add and edit
     */
    public function actionCreateNewTemplateConfiguration()
    { 
        try{
            
            $obj = array();
            $status="";
            $message="";
             $templateConfigurationCreation = new TemplateConfigurationCreationForm();
            if (isset($_POST['TemplateConfigurationCreationForm'])) {
                $templateConfigurationCreation->attributes = $_POST['TemplateConfigurationCreationForm'];
                $errors = CActiveForm::validate($templateConfigurationCreation);
                
                if ($errors != '[]') {  
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                     $userObj = ServiceFactory::getSkiptaUserServiceInstance()->adminCreateTemplateConfigurationService($templateConfigurationCreation);
                     if ($userObj != 'failure')
                    {
                        $message = Yii::t('translation', 'TemplateConfigCreation_Success');
                        $status='success';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'updatesuccess')
                    {
                        $message = Yii::t('translation', 'TemplateConfig_Update');
                        $status='updatesuccess';
                        $obj = array('status' => $status, 'data' => $message, 'error' => '');
                    }
                    if($userObj == 'emailexists')
                    {
                        $message = Yii::t('translation', 'TemplateConfig_Exists');
                        $status='updatefail';
                        $obj = array('status' => $status, 'data' => $message, 'error' => $message);
                    }
                    if($userObj == 'failure') {
                        $message = Yii::t('translation', 'TemplateConfig_Exists');
                        $message='error';
                        $status='error';
                        $obj = array("status" => $status, 'data' => '', "error" => $message);
                        
                    }
                }
                
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $ex) {
            Yii::log("------Exception Occurred in actionCreateNewTemplateConfiguration==".$ex->getMessage(),"error","application");
        }
    }
    
    /**
     * This action item is used for editing the template config details.
     * return JSON object for rendering.
     */
     public function actionEditTemplateConfigurationDetails() {
         
         try{
            $configTemplateId = $_REQUEST['Id'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->editTemplateConfigurationDetails($configTemplateId);
             
            $obj = array("data" => $result,'error' => "");
            echo CJSON::encode($obj);
         } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionEditHelpIconDetails==".$ex->getMessage(),"error","application");
         }
        
    }
public function actionGetPreviewTemplate() {
         
         try{
             $templateType = $_REQUEST['templateType'];
             if ($templateType=='ForgotPassword')
             {
                 $this->renderPartial('/mail/ForgotPasswordMail',array());
             }
             if ($templateType=='Registration')
             {
                 $this->renderPartial('/mail/UserRegistrationMail',array());
             }
             if ($templateType=='UserActivation')
             {
                 $this->renderPartial('/mail/UserAccountInfoMail',array());
             }
             if ($templateType=='termsOfServices')
             {
                 $this->renderPartial('termsOfServicesTemplatePreview',array());
             }
             if ($templateType=='privacyPolicy')
             {
                 $this->renderPartial('privacyPolicyTemplatePreview',array());
             }
             
             if ($templateType=='DailyDigest')
             {
                 $this->renderPartial('/mail/dailyDigestEmailTemplate',array());
             }
         } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetPreviewTemplate==".$ex->getMessage(),"error","application");
         }
        
    }
    
   public function actionContent() {
   
  if(Yii::app()->session['IsAdmin']==1)
    {
       $this->whichmenuactive = 8;
        $oauth_data = '';
        $network_data = ServiceFactory::getSkiptaUserServiceInstance()->getCuratorAccessTokenService(Yii::app()->params['ServerURL']);
        $CuratedDataFromDB = ServiceFactory::getSkiptaPostServiceInstance()->getCuratedTopicsService(Yii::app()->session['UserStaticData']->UserId, $network_data['NetworkId']);
         $this->render('content', array('topics' => $CuratedDataFromDB));
       
      }
        else{
            $this->redirect('/news/index');
        }
    }

    public function actionStream() {
        try {
            if (isset($_GET['CuratedNewsCollection_page'])) {
                $page='curated';
                if (isset($_GET['Topic'])&&isset($_GET['Status'])) {
                    $topic=$_GET['Topic'];
                    $status=$_GET['Status'];
                    if($topic=='All' && $status=='All')
                    {
                    $page='curated';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(0, 1)),
                    );
                    }
                    else if($topic=='All' && $status=='R')
                    {
                    $page='news_released';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(1)),
                        'IsAbused' => array('notIn' => array(1)),
                    );
                    }
                    else if($topic=='All' && $status=='WFR')
                    {
                    $page='curated';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(0)),
                    );
                    }
                    else if($topic=='All' && $status=='D')
                    {
                    $page='news_deleted';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(2)),
                    );
                    }
                    else if($topic=='All' && $status=='PB')
                    {
                    $page='news_pulledback';
                    $condition = array(
                        'IsAbused' => array('in' => array(1)),
                    );
                    }
                    
                    else if($topic!='All' && $status=='All')
                    {
                    $page='curated';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(0, 1)),
                        'TopicId' => array('==' => (int)($topic))
                    );
                    }
                    else if($topic!='All' && $status=='R')
                    {
                    $page='news_released';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(1)),
                        'IsAbused' => array('notIn' => array(1)),
                        'TopicId' => array('==' => (int)($topic))
                    );
                    }
                    else if($topic!='All' && $status=='WFR')
                    {
                    $page='curated';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(0)),
                        'TopicId' => array('==' => (int)($topic))
                    );
                    }
                    else if($topic!='All' && $status=='D')
                    {
                    $page='news_deleted';
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(2)),
                        'TopicId' => array('==' => (int)($topic))
                    );
                    }
                    else if($topic!='All' && $status=='PB')
                    {
                    $page='news_pulledback';
                    $condition = array(
                        'IsAbused' => array('in' => array(1)),
                        'TopicId' => array('==' => (int)($topic))
                    );
                    }
                    
                } else {
                    $condition = array(
                        'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                        'Released' => array('in' => array(0, 1)),
                    );
                }
                $pageSize = 10;
                $provider = new EMongoDocumentDataProvider('CuratedNewsCollection', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => $condition,
                        'sort' => array('CreatedDate' => EMongoCriteria::SORT_DESC),
                    )
                ));
                if ($provider->getTotalItemCount() == 0) {
                    $stream = 0; //No posts
                } else if ($_GET['CuratedNewsCollection_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                    $stream = (object) $provider->getData();
                } else {
                    $stream = -1; //No more posts
                }
                $this->renderPartial($page, array('stream' => $stream));
            }
        } catch (Exception $ex) {
            error_log("************EXCEPTION at STREAMHOME*****************" . $ex->getMessage());
            Yii::log("************EXCEPTION at STREAMHOME*****************" . $ex->getMessage(), 'error', 'application');
        }
    }

    public function actionSaveEditorial() {
        $data = ServiceFactory::getSkiptaPostServiceInstance()->saveEditorialService($_POST['postId'], $_POST['EditorialCoverage']);
        $result = array("code" => $data, "status" => "");
        echo $this->rendering($result);
    }

    public function actionManagecuratedpost() {
        if ($_POST['operation'] == 'D') {
            $data = ServiceFactory::getSkiptaPostServiceInstance()->manageCuratedPostService($_POST['postId'], 2,Yii::app()->session['UserStaticData']->UserId);
        }
        if ($_POST['operation'] == 'R') {
            $ReleasedBy = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:Yii::app()->session['UserStaticData']->UserId;
            $data = ServiceFactory::getSkiptaPostServiceInstance()->manageCuratedPostService($_POST['postId'], 1,$ReleasedBy);
            ServiceFactory::getSkiptaPostServiceInstance()->releaseNewsObjectToStream($_POST['postId'], $ReleasedBy);
            if(Yii::app()->session['PostAsNetwork']==1){
                $postType=11;$categoryId=8;
                ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($postType, $_POST['postId'], Yii::app()->session['UserStaticData']->UserId, 'Follow', $categoryId);
            }
        }
         if ($_POST['operation'] == 'MASFI') {
          $PostDetails=ServiceFactory::getSkiptaPostServiceInstance()->getPostByIdService($_POST['postId']);
          ServiceFactory::getSkiptaPostServiceInstance()->updatePostAsFeatured(Yii::app()->session['UserStaticData']->UserId, $_POST['postId'], $PostDetails->CategoryType, $PostDetails->NetworkId,$_POST['Title']);
          $data=200;
        }
         if ($_POST['operation'] == 'N2S') {
          $PostDetails=ServiceFactory::getSkiptaPostServiceInstance()->getPostByIdService($_POST['postId']);
          $whathappend =ServiceFactory::getSkiptaPostServiceInstance()->NotifyStreamOfPostedNewsService($PostDetails,1,$_POST['postId']);
          if($whathappend==0)
          $data=440;
          else
          $data=200;
        }
         if ($_POST['operation'] == 'PB') {
          $PostDetails=ServiceFactory::getSkiptaPostServiceInstance()->getPostByIdService($_POST['postId']);
          $whathappend =ServiceFactory::getSkiptaPostServiceInstance()->PullBackNewsService($PostDetails,1,$_POST['postId']);
          if($whathappend==0)
          $data=440;
          else
          $data=200;
        }
        $result = array("code" => $data, "status" => "");
        echo $this->rendering($result);
    }
 
    /**
     * This action item is used for create the categories. and used for DSN network
     * return JSON object for rendering.
     */
     public function actionNewTopic() {
         
         try {

            $categoryCreation = new CurbsidecategorycreationForm();
            $topicDetails = "";
            $this->renderPartial('newtopic', array('categoryCreation' => $categoryCreation, 'topicdetails' => $topicDetails));
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionEditCurbsideCategory==" . $ex->getMessage(), "error", "application");
        }
    }
     /**
     * This action item is used for editing the Topic.and used for DSN network
     * return JSON object for rendering.
     */
     public function actionEditTopic() {
         
         try{
            $categoryId = $_REQUEST['Id'];
            $topicDetails = ServiceFactory::getSkiptaUserServiceInstance()->editCurbsideCategoryById($categoryId);
            $categoryCreation = new CurbsidecategorycreationForm();
            $this->renderPartial('newtopic',array('categoryCreation'=>$categoryCreation,'topicdetails'=>$topicDetails));

         } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionEditTopicy==".$ex->getMessage(),"error","application");
         }
        
    }
      /**
    * This methodsis used to assign custom badges
    */ 
    
   public function actioncustomBadges(){
       try {
           $badgeDetails=ServiceFactory::getSkiptaUserServiceInstance()->getAllCustomBadges();
           $this->render('customBadges',array('customBadgeDetails'=>$badgeDetails));
           
       } catch (Exception $exc) {
           Yii::log("Exception in custom badges ","error","application");
       }
      }
      
   public function actionEditBadgeDetails(){
       try {
           $badgeId=$_REQUEST['badgeId'];
           $badgdeDetails=ServiceFactory::getSkiptaUserServiceInstance()->editCustomBadge($badgeId);
           if(!is_string($badgdeDetails)){
               $customBadgeForm=new CustomBadgeForm();
               $customBadgeForm->id=$badgdeDetails->id;
               $customBadgeForm->BadgeDescription=$badgdeDetails->description;
               $customBadgeForm->BadgeName=$badgdeDetails->badgeName;
               $customBadgeForm->BadgeIcon=$badgdeDetails->image_path;
               $htmlData = $this->renderPartial('editCustomBagde', array("badgeDetails" => $badgdeDetails,"customBadgeForm"=>$customBadgeForm), "html");  
               $obj = array("htmlData" => $htmlData);
               $renderScript = $this->rendering($obj);
               echo $renderScript;
           }
           
       } catch (Exception $exc) {
           Yii::log("Exception in custom badges ".$exc->getMessage(),"error","application");
       }
      }
      
  public function actioneditAndSaveCustomBadge(){
      try {
               $customBadgeForm=new CustomBadgeForm();
           if (isset($_POST['CustomBadgeForm'])) {
               
               $customBadgeForm->attributes = $_POST['CustomBadgeForm'];
               $errors = CActiveForm::validate($customBadgeForm);                
                if ($errors != '[]') {                       
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                    $badgeId=$customBadgeForm->id;
                    $badgeIcon=$customBadgeForm->BadgeIcon;
                    $badgeName=$customBadgeForm->BadgeName;
                    $result=ServiceFactory::getSkiptaUserServiceInstance()->saveCustomBadgeDetails($customBadgeForm);
                    if($result=="success"){
                      $obj = array('status' => 'success', 'data' => 'badge updated successfully', 'error' => '','badgeId'=>$badgeId,'badgeIcon'=>$badgeIcon,'badgeName'=>$badgeName);    
                    }else{
                       $obj = array('status' => 'failure', 'data' => 'something went wrong please try again later', 'error' => $errors); 
                    }
                }
           }
           $renderScript = $this->rendering($obj);
               echo $renderScript;
          
      } catch (Exception $exc) {
          error_log("___________".$exc->getMessage(),'error','application');
      }
    }    
    
   function actionUploadCustomBadge(){
       try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder = Yii::getPathOfAlias('webroot') . '/images/'; // folder for uploaded files
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "png"); //array("jpg","jpeg","gif","exe","mov" and etc...
            // $sizeLimit = 30 * 1024 * 1024;// maximum file size in bytes
            $sizeLimit = Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $result['tooLarge']="false"; 
            list($width, $height) = getimagesize($folder.$result['filename']);
            if($width>=168){ 
                $result['tooLarge']="true";
               $result['message']="image should be 168x200 or less than that";
            }
            
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
            $fileName = $result['filename']; //GETTING FILE NAME
            $extension = $result['extension'];
            
            $ext = "badges/";
            $destnationfolder = $folder . $ext;
            if (!file_exists($destnationfolder)) {
                mkdir($destnationfolder, 0755, true);
            }

            $imgArr = explode(".", $result['filename']);
            $date = strtotime("now");
            $finalImg_name = $imgArr[0] . '.' . $imgArr[1];            
            $finalImage = $imgArr[0] . '_' . $result['imagetime'] . '.' . $imgArr[1];
            $finalImage125 = $imgArr[0] . '_' . $result['imagetime'] . '_128x152.' . $imgArr[1];
            $finalImage35 = $imgArr[0] . '_' . $result['imagetime'] . '_38x44.' . $imgArr[1];
            
            $fileNameTosave = $folder . $imgArr[0] . '_' . $result['imagetime'] . '.' . $imgArr[1];            
            //$fileNameTosave125 = $folder . $imgArr[0] . '_' . $result['imagetime'] . '_125.' . $imgArr[1];   
            //$fileNameTosave35 = $folder . $imgArr[0] . '_' . $result['imagetime'] . '_35.' . $imgArr[1];   
            
            $path = $folder . $result['filename'];               
            
            rename($path, $fileNameTosave);
           
            $sourcepath = $fileNameTosave;
           
            $destination = $folder . $ext . "/" . $finalImage;   
            $destination125 = $folder . $ext . "/" . $finalImage125;   
            $destination35 = $folder . $ext . "/" . $finalImage35;   
            
            if ($ext != "") {
                if (file_exists($sourcepath)) {                     
                   
                    if (copy($sourcepath, $destination)) {
                     copy($sourcepath, $destination125);
                     copy($sourcepath, $destination35);
                      unlink($sourcepath);
                    }                   
             
             $img = Yii::app()->simpleImage->load($destination125);
             $width = $img->getWidth();
             if($width>=128){
                $img-> resizeToWidth(128);
             }
             if($height>=152){
                $img-> resizeToHeight(152);
             }
             $img->save($destination125); 
             
             $img = Yii::app()->simpleImage->load($destination35);
             $width = $img->getWidth();
             if($width>=38){
                $img-> resizeToWidth(38);               
             }
              if($height>=44){
                $img-> resizeToHeight(44);
             }
             $img->save($destination35); 
                
                }
                
            }
           error_log("_______________________33333___________________".print_r($return,true));
            echo $return; // it's array
       } catch (Exception $exc) {
           
           error_log($exc->getMessage()."==*********************==".$exc->getLine());
       }
      } 
  /* end of custom badge */ 
    
}