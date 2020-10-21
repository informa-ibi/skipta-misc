<?php

/*
 * Developer Suresh Reddy
 * on 8 th Jan 2014
 * all users actions need to add here
 */

class SiteController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
    public function init() {
         if(!isset($_REQUEST['mobile'])){
            $this->initializeforms();
       if(isset($_REQUEST['UK'])&& isset(Yii::app()->session['TinyUserCollectionObj'])){
           $this->redirect("/common/CheckUserLoginStatus?Id=".$_REQUEST['UK']);
          
       }
       
        if (isset(Yii::app()->session['TinyUserCollectionObj'])&&!isset($_REQUEST['UK'])){
  
            $this->redirect('/stream');
        } 
         }
      

         if (!isset($_REQUEST['mobile'])) {
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $urlPath = $_SERVER['REQUEST_URI'];

            if (preg_match("/Android/i", $useragent) && preg_match("/^(?:(?!" . Tablet . ").)*$/i", $useragent) && Yii::app()->params['IsMobileAppexist'] == 'ON') {

                if (strpos($urlPath, 'linkcode') !== false) {
                    
                } else {
                    if (strpos($urlPath, 'reset') !== false) {
                        
                    } else {
                        $this->redirect("/common/mobileRedirect?Type=android");
                    }
                }
            }
            //$this->redirect("common/mobileRedirect",array("type"=>"android"));
            else if (preg_match("/iPhone/i", $useragent) && Yii::app()->params['IsMobileAppexist'] == 'ON') {



                if (strpos($urlPath, 'linkcode') !== false) {
                    
                } else {
                    if (strpos($urlPath, 'reset') !== false) {
                        
                    } else {
                        $this->redirect("/common/mobileRedirect?Type=ios");
                    }
                }
            }
        }
      
            
   
     
    }
    /**
     * @author Vamsi Krishna
     * This methods loads the login page
     *
     */
    public function actionIndex() {
       try{
  $contactForm=new ContactUsForm();
       
        if(isset($_REQUEST['linkcode'])){
               $resetForm = new ResetForm();
            $resetForm->md5UserId = $_REQUEST['linkcode'];
            $email = isset($_REQUEST['em']) ? $_REQUEST['em'] : "";
            $resetForm->email = $email;
            $linkcode = isset($_REQUEST['linkcode']) ? $_REQUEST['linkcode'] : "";
            $codeToArrayNew = explode("_", $linkcode);
            $base64_decNew = base64_decode($codeToArrayNew[1]);
            $userObj = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($email);

            $passwordResetToken = $userObj['PasswordResetToken'];
            if ($passwordResetToken == $linkcode) {
                $codeToArrayOld = explode("_", $passwordResetToken);
                $base64_decOld = base64_decode($codeToArrayOld[1]);

                $daylen = 60 * 60 * 24;
                $date1 = date($base64_decOld);
                $date2 = date($base64_decNew);
                $expireTime = (strtotime($date2) - strtotime($date1)) / $daylen;
                $resetForm->email=$email;
                if ($expireTime == 0) {
                   $this->render("index",array('contactForm' => $contactForm,"resetForm" => $resetForm,"ispaswordreset"=>'true'));
                } else {
                    $error = Yii::t('translation', 'ResetPassword_Link_Expire');
                    $this->render('index', array('contactForm' => $contactForm,'resetpasswordexpirederror' => $error));
                }
            } elseif ($passwordResetToken == "reset") {
                $error = Yii::t('translation', 'AlreadyPasswordResetted');
                $this->render('index', array('contactForm' => $contactForm,'resetpasswordexpirederror' => $error,"resetForm" => $resetForm));
            }
             else {
                $error = Yii::t('translation', 'ResetPassword_Link_Expire');
                 $this->render('index', array('contactForm' => $contactForm,'resetpasswordexpirederror' => $error));
            }
        
        }else{
            if(Yii::app()->params['Project'] != "Trinity"){
                $this->render('/themesview/'.Yii::app()->params['Project'].'/index', array('contactForm' => $contactForm));
            }else{
                $this->render('index', array('contactForm' => $contactForm));
            }
        }
        } catch (Exception $ex) {
         Yii::log("SiteController:actionIndex::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
     }
       
    }

    /*
     * method for requesting the password based on the email id provided
     * if emailId exists, will send a password request to the email
     * If does not exists,will acknowledge user does not exist
     */

   public function actionForgot() {
        try {
           $forgotModel = new ForgotForm;
           $request=yii::app()->getRequest();
           $formName=$request->getParam('ForgotForm');
             if ($formName!='') {
                $forgotModel->attributes = $request->getParam('ForgotForm');  
                $errors = CActiveForm::validate($forgotModel);
              if ($errors != '[]') 
                {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else 
                    {
                    $userObj = ServiceFactory::getSkiptaUserServiceInstance()->userForgotService($forgotModel);
                    if (is_object($userObj)) 
                    {
                        $message = Yii::t('translation', 'ResetPasswordMailSuccess');
                        $obj = array('status' => 'success', 'data' => $message, 'error' => '');
                }
                    else if($userObj=='Exception')
                    {
                        $message = Yii::t('translation', 'Exception');
                        $obj = array("status" => 'exception', 'data' => $message, "error" => ''); 
            }
                    else 
                    {
                        $message = Yii::t('translation', 'UserNotExist');
                        $errorMessage = array('ForgotForm_email' => $message);
                        $obj = array("status" => 'error', 'data' => '', "error" => $errorMessage);
                    }
            }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
        }
            else{
                  $this->renderPartial('forgotpassword',array('forgotform'=>$forgotModel),false,true);
    }
        } catch (Exception $exc) {            
            Yii::log("inside actionForgot()....." . $exc->getTraceAsString(), "error", "application");
        }
    }

    /*
     * This  method is used for  New user registration if the user is already exist this method
     * will return user already exist otherwise
     *  create the new user.
     */

    public function actionRegister() {

        $error = "";
        $message = "";

        $UserRegistrationForm = new UserRegistrationForm;
        try {
            if (isset($_POST['UserRegistrationForm']) || (isset($_POST["mobile"]) && $_POST["mobile"]==1)) {
                $RegistrationForm_errors ="[]";
                $UserRegistrationPostData;
                if(isset($_POST["mobile"]) && $_POST["mobile"]==1){
                    parse_str($_POST["formdata"], $values);
                    $UserRegistrationPostData = $values;
                    $UserRegistrationPostData['email'] = $UserRegistrationPostData['email1'];
                }else{
                    $UserRegistrationPostData = $_POST['UserRegistrationForm'];
                    $RegistrationForm_errors = CActiveForm::validate($UserRegistrationForm);
                }
                if ($RegistrationForm_errors != "[]") {
                    $obj = array('status' => 'fail', 'data' => '', 'error' => $RegistrationForm_errors);
                } else {
                    $email = $UserRegistrationPostData['email'];
                    $userexist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($UserRegistrationPostData['email']);

                    if (count($userexist) > 0) {
                        if(isset($userexist->FromNetwork) && isset($userexist->AccessToken) && !empty($userexist->FromNetwork) && !empty($userexist->AccessToken) && Yii::app()->params['IsDSN']=='ON' )
                            {   error_log("if user already exists");
                                $providersData= ServiceFactory::getSkiptaUserServiceInstance()->getOauthProviderDetailsByType("NetworkName",$userexist->FromNetwork);
                                if($providersData!="failure" && sizeof($providersData)>0)
                                {
                                    //$oauthLink="<a onclick='loginWithProvider("."'".$providersData->ProviderUrl."/oauth/access_token?client_id="+$providersData->ClientId."&response_type=token&redirect_uri=". Yii::app()->params['ServerURL']."/site/restLogin','".$providersData->NetworkName."','".$providersData->ProviderLink."')'>Login with oauth</a>";
                                     $oauthLink="<a onclick='loginWithProvider(".'"'.$providersData->ProviderUrl."/oauth/access_token?client_id=".$providersData->ClientId."&response_type=token&redirect_uri=".Yii::app()->params['ServerURL']."/site/restLogin".'",'.'"'.$providersData->NetworkName.'",'.'"'.$providersData->ProviderUrl.'"'.")'> Oauth Login</a>";
                                }
                               ;
                               $message = Yii::t('translation', 'User_Already_Exist_Network');
                               $message= str_replace("network",$userexist->FromNetwork." Network",$message);
                               $message=$message." <br/> or login with this link &nbsp; ".$oauthLink;

                            }
                         else 
                             $message = Yii::t('translation', 'User_Already_Exist');
                        // $message ="User already exist with this Email Please  try with another  Email Address";
                        $obj = array('status' => 'fail', 'data' => $message, 'error' => $RegistrationForm_errors);
                    } else {

                        $CustomForm = new CustomForm();
                        $customfields = array();
                        $CustomForm->attributes = $UserRegistrationPostData;
                        foreach ($CustomForm->attributes as $key => $value) {
                            $customfields[$key] = $UserRegistrationPostData[$key];
                        }
                        $UserRegistrationPostData['status'] = 0;
                        $Save_userInUserCollection = ServiceFactory::getSkiptaUserServiceInstance()->SaveUserCollection($UserRegistrationPostData, $customfields);
                        // $Saveuser = ServiceFactory::getSkiptaUserServiceInstance()->saveUserProfile($_POST['UserRegistrationForm'], $customfields);
                        if ($Save_userInUserCollection != 'error') {
                            $message = Yii::t('translation', 'User_Register_Success');
                            //$message ="User Registered Successfully";
                            $obj = array('status' => 'success', 'data' => $message, 'error' => '');
                        } else {
                            $errormsg = Yii::t('translation', 'User_Register_Fail');
                            // $errormsg="User registration failed";
                            $obj = array('status' => 'fail', 'data' => $errormsg, 'error' => '');
                        }
                    }
                }
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage());
        }
        $renderScript = $this->rendering($obj);
        echo $renderScript;
    }

    /*     * @author Vamsi Krishna
     * THis is ajax method and used for User Authentication for lofin
     *  This is the method used for login of the user it returns string if it is error and if success
      we redirect to the dashboard page
     */

    public function actionLogin() {
        try {
            $model = new LoginForm;
            error_log("_____________login________________________");
             if(isset($_POST["mobile"]) && $_POST["mobile"]==1){
                    parse_str($_POST["formdata"], $values);
                    $model->email=$values['email'];
                    $model->pword=$values['password'];
                    $sessionId = $_POST['sessionId'];
                    $pushToken = $_POST['pushToken'];
                   // error_log("push token-----------".$pushToken);
                     $deviceInfo = $_POST['deviceInfo'];
                    // error_log("device info----".print_r($deviceInfo,true));
                    // error_log("device paltfomr----".$deviceInfo['platform']);
                }
            else{  
               $request = yii::app()->getRequest();
                $formname = $request->getParam('LoginForm');
                if ($formname != '') {
                $model->attributes = $formname;
                $errors = CActiveForm::validate($model);
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => Yii::t('translation', $errors));
                         echo $this->rendering($obj);
                         return;
                }
                }
            }
            
                    $resultArray = ServiceFactory::getSkiptaUserServiceInstance()->userAuthentication($model);
                    error_log("_____________login______result __________________".print_r($resultArray,true));
                    if ($resultArray == 'success') {
                        $status = "success";
                        $user=UserCollection::model()->getTinyUserCollection(19);
                       
                        CommonUtility::setUserSession($model->email);
                        $userObj="";
                        ServiceFactory::getSkiptaUserServiceInstance()->saveUserLoginActivity(Yii::app()->session['TinyUserCollectionObj']->UserId);
                        $userAchievementsInputBean = new UserAchievementsInputBean();
                        $userAchievementsInputBean->UserId = Yii::app()->session['TinyUserCollectionObj']->UserId;
                        $userAchievementsInputBean->UserClassification = Yii::app()->session['TinyUserCollectionObj']->UserClassification;
                        $userAchievementsInputBean->NetworkId = (int)Yii::app()->session['TinyUserCollectionObj']->NetworkId;
                        $userAchievementsInputBean->SegmentId = (int)Yii::app()->session['TinyUserCollectionObj']->SegmentId;
                    //    Yii::app()->amqp->achievements(json_encode($userAchievementsInputBean));
                        
                        Yii::app()->session['PostAsNetwork'] = 0;
                        Yii::app()->session['LoginUserEmail'] = $model->email;
                        Yii::app()->session['LoginUserFirstName'] = Yii::app()->session['UserStaticData']['FirstName'];
                        if(isset( YII::app()->params['NetworkAdminEmail'])){
                                $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType( YII::app()->params['NetworkAdminEmail'], 'Email');
                                Yii::app()->session['NetworkAdminUserId'] = $netwokAdminObj->UserId;
                                Yii::app()->session['NetworkAdminUserName'] = $netwokAdminObj->FirstName." ".$netwokAdminObj->LastName;
                         }
                         
                         if(Yii::app()->session['IsAdmin']==1){
                            $networkId = (int)Yii::app()->session['TinyUserCollectionObj']['NetworkId'];
                            $segments = ServiceFactory::getSkiptaUserServiceInstance()->getAllSegmentsByNetwork($networkId);
                            Yii::app()->session['Segments'] = $segments;
                            $attributeArray = array("SegmentId" => Yii::app()->session['TinyUserCollectionObj']['SegmentId']);
                            Yii::app()->session['CurrentSegment'] = ServiceFactory::getSkiptaUserServiceInstance()->getSegmentByAttributes($attributeArray);
                         }
                        $language = isset(Yii::app()->session['TinyUserCollectionObj']['Language'])?Yii::app()->session['TinyUserCollectionObj']['Language']:"en";
                        //get the language and source language
                        $attributeArray = array("Language" => $language);
                        $languageObj = ServiceFactory::getSkiptaUserServiceInstance()->getLanguageByAttributes($attributeArray);
                        //update the language and source language in session
                       //Get the joyride data of the login user based on the user level here.
//                        if(Yii::app()->session['UserStaticData']->disableJoyRide==0 && Yii::app()->session['UserStaticData']->userSessionsCount<=10)
//                        {
//                            if(Yii::app()->session['UserStaticData']['UserClassification']==1)
//                            {
//                              $joyRidereturnValue=  ServiceFactory::getSkiptaPostServiceInstance()->getUserJoyrideDetailsStatus(Yii::app()->session['UserStaticData']['UserId']);
//                            }
//                             else
//                            $joyRidereturnValue="failure";
//                        }
//                         else
                            $joyRidereturnValue="failure";
                       
                        // error_log(Yii::app()->session['UserStaticData']['UserClassification']."__________________".$joyRidereturnValue."Site controller");
                       
                        if(is_array($languageObj) || is_object($languageObj)){
                            CommonUtility::changeLanguage($language,$languageObj["SourceLanguage"]); 
                        }
                         if(isset($_POST["mobile"]) && $_POST["mobile"]==1){
                             //insert a record in MobileSessions table
                             CommonUtility::badgingInterceptor("MobileFirstLogin",$userObj->UserId);
                            $sessionId = ServiceFactory::getSkiptaUserServiceInstance()->saveMobileSession($userObj->UserId,$sessionId,$deviceInfo,$pushToken); 
                         }else{
                          /* Cookie based login */
                        $identity = new UserIdentity($model->email, $model->pword);
                        $duration = $model->rememberMe ? 3600 * 24 * 60 : 0; // 30 days

                        $identity->authenticate(); //must
                        Yii::app()->user->login($identity, $duration);
                        $randomKey = Yii::app()->user->getState('s_k');
                        /* Cookie based login */
                      ServiceFactory::getSkiptaUserServiceInstance()->saveCookieRandomKeyForUser(Yii::app()->session['TinyUserCollectionObj']['UserId'], $randomKey);
                      ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction(Yii::app()->session['TinyUserCollectionObj']['UserId'], "Login", "Login", "", "", "", Yii::app()->session['TinyUserCollectionObj']['NetworkId'], "", Yii::app()->session['TinyUserCollectionObj']['SegmentId']);
                         }
                        $obj = array('status' => $status, 'sessionId' =>$sessionId,'userObj'=>$userObj,'tinyUser'=>Yii::app()->session['TinyUserCollectionObj'],'error' => '','uploadMaxFileSize'=>Yii::app()->params['UploadMaxFilSize'],"joyrideToLoad"=>$joyRidereturnValue);
                    } else {
                        $model->addError('error', Yii::t('translation', $resultArray));
                        $errors = $model->getError('error');
                        $status = $errors;
                        $obj = array('status' => 'error', 'data' => '', 'error' => array("LoginForm_email" => Yii::t('translation', $errors)));
                        ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction(0, "Login", "LoginFail", $model->email, "", "", 1, "", 0);
                    }
               // }
              // echo "success";
                echo $this->rendering($obj);
                   Yii::app()->end();
           // }
        } catch (Exception $exc) {
            error_log("_EXCEPTION____" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'userController');
        }
    }
public function actionLogin_V6() {
        try {
            $model = new LoginForm;
             if(isset($_POST["mobile"]) && $_POST["mobile"]==1){
                    parse_str($_POST["formdata"], $values);
                    $model->email=$values['email'];
                    $model->pword=$values['password'];
                    $sessionId = $_POST['sessionId'];
                }
          
                    $resultArray = ServiceFactory::getSkiptaUserServiceInstance()->userAuthentication($model);
                    if ($resultArray == 'success') {
                        $status = "success";
                       
           
                        $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($model->email, 'Email');
                        ServiceFactory::getSkiptaUserServiceInstance()->saveUserLoginActivity($userObj->UserId);

                        $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userObj->UserId);
                         if(isset($_POST["mobile"]) && $_POST["mobile"]==1){
                             //insert a record in MobileSessions table
                             CommonUtility::badgingInterceptor("MobileFirstLogin",$userObj->UserId);
                           // $sessionId = ServiceFactory::getSkiptaUserServiceInstance()->saveMobileSession($userObj->UserId,$sessionId,$deviceInfo,$pushToken); 
                         }
                        $obj = array('status' => $status,'userObj'=>$userObj,'tinyUser'=>$tinyUserCollectionObj,'error' => '','uploadMaxFileSize'=>Yii::app()->params['UploadMaxFilSize']);
                    } else {
                        $model->addError('error', Yii::t('translation', $resultArray));
                        $errors = $model->getError('error');
                        $status = $errors;
                        $obj = array('status' => 'error', 'data' => '', 'error' => array("LoginForm_email" => Yii::t('translation', $errors)));
                    }
               // }
              // echo "success";
                echo $this->rendering($obj);
                   Yii::app()->end();
           // }
        } catch (Exception $exc) {
            error_log("_EXCEPTION____" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'userController');
        }
    }
    /*
     * method for reseting the password when user clicks on the resetbutton
     * Takes password as argument
     * If result 0:ResetPasswordSuccess,result 1:ResetPasswordUnSuccess; result 2: OldPasswordMatchesNewPassword
     * other than 0,1,2 will display the message based on the password policies.
     */

    public function actionReset() {

        try {
            $model = new ResetForm;
            if (isset($_POST['ResetForm'])) {
                $model->attributes = $_POST['ResetForm'];
                $errors = CActiveForm::validate($model);
                $obj = array();
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {

                    $result = ServiceFactory::getSkiptaUserServiceInstance()->userResetPasswodService($model);
                    if ($result == '0') {
                        $message = Yii::t('translation', 'ResetPasswordSuccess');
                        $obj = array('status' => 'success', 'data' => $message, 'success' => '');
                    } elseif ($result == '1') {
                        $message = Yii::t('translation', 'ResetPasswordUnSuccess');
                        $obj = array('status' => 'error', 'data' => $message, 'error' => '');
                    } else if ($result == '2') {
                        $message = Yii::t('translation', 'OldPasswordMatchesNewPassword');
                        $obj = array('status' => 'error', 'data' => $message, 'error' => '');
                    } else {
                        $obj = array('status' => 'error', 'data' => $result, 'error' => '');
                }
            }
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        $renderScript = $this->rendering($obj);
        echo $renderScript;
    }

    /*
     * This method calls when user clicks on the link sent to his email
     * Will check the expiration of the link for 24 hrs from the date and time of resquest for password
     * if not expired, will show the password reset page
     * else will acknowledge that link has been expired
     */

    public function actionResetpassword() {
        try {
            $resetForm = new ResetForm();
            $resetForm->md5UserId = $_REQUEST['linkcode'];
            $email = isset($_REQUEST['em']) ? $_REQUEST['em'] : "";
            $resetForm->email = $email;
            $linkcode = isset($_REQUEST['linkcode']) ? $_REQUEST['linkcode'] : "";
            $codeToArrayNew = explode("_", $linkcode);
            $base64_decNew = base64_decode($codeToArrayNew[1]);
            $userObj = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($email);

            $passwordResetToken = $userObj['PasswordResetToken'];
            if ($passwordResetToken == $linkcode) {
                $codeToArrayOld = explode("_", $passwordResetToken);
                $base64_decOld = base64_decode($codeToArrayOld[1]);

                $daylen = 60 * 60 * 24;
                $date1 = date($base64_decOld);
                $date2 = date($base64_decNew);
                $expireTime = (strtotime($date2) - strtotime($date1)) / $daylen;
                if ($expireTime == 0) {
                    $this->render("resetpassword", array("resetForm" => $resetForm));
                } else {
                    $error = Yii::t('translation', 'ResetPassword_Link_Expire');
                    $this->render('passwordexpiry', array('error' => $error));
                }
            } elseif ($passwordResetToken = "reset") {
                $error = Yii::t('translation', 'AlreadyPasswordResetted');
                $this->render('passwordexpiry', array('error' => $error));
            }
     
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /*
     * This  method is used for  check the password policies  when the user enter password.
     */

    function actionCheckpw() {

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $password = "";
        }
        if (isset($_POST['firstname'])) {
            $firstname = strtolower($_POST['firstname']);
        } else {
            $firstname = "";
        }
        if (isset($_POST['lastname'])) {
            $lastname = strtolower($_POST['lastname']);
        } else {
            $lastname = "";
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            $id = "";
        }
        $satus = '';
        /* check the password having user first name */
        if ($firstname != "" && $lastname != "") {
            if ((strpos($password, $firstname) !== false) || (strpos($password, $lastname) !== false)) {
                $satus = 'fail';
                $message = Yii::t('translation', 'Password_Check_With_UserName');
                //$message="password can not be user name";
            }
        }

        /* check the password is an email */

        if (preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $password, $matches)) {
            $satus = 'fail';
            $message = Yii::t('translation', 'Password_Check_With_Email');
            //$message="password can not be email";
        }


        /* check the password having domain name */

        if (strpos(strtolower($password), 'skipta') !== false) {
            $satus = 'fail';
            $message = Yii::t('translation', 'Password_Check_With_Domain');
            // $message="password can not be domain name";
        }
        /* check the password having one special charater and one small letter and one numeric and one capital letter */
        if (!preg_match("/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=]).*$/", $password, $matches)) {
            $satus = 'fail';
            $message = Yii::t('translation', 'Password_Check_With_Password_Rules');
            //$message="Your password is too weak please enter strong password!";
        }


        if ($satus == 'fail') {

            ///$error = array($id => $message);
            $obj = array('status' => 'failed', 'data' => '', 'error' => '', 'message' => $message);
        } else {

            $obj = array('status' => 'success', 'data' => '', 'error' => '');
        }


        $renderScript = $this->rendering($obj);
        echo $renderScript;
        Yii::app()->end();
    }

    public function actionDynamicstates() {

        $data = State::model()->findAll('CountryID=:id', array(':id' => (int) $_POST['country']));
        if(isset($_POST['mobile']) && !empty($_POST['mobile'])){
             $obj = array('status' => 'success', 'states' => $data, 'count' => count($data));
             $renderScript = $this->rendering($obj);
             echo $renderScript;
        }else{
            if (count($data) > 0) {
                $data = CHtml::listData($data, 'id', 'State');
                echo CHtml::tag('option', array('value' => ''), CHtml::encode('Please Select state'), true);
                foreach ($data as $value => $name) {
                    echo CHtml::tag('option', array('value' => $name), CHtml::encode($name), true);
                }
            } else {

                echo CHtml::textField('UserRegistrationForm[state]', '', array('id' => 'UserRegistrationForm_state',
                    'class' => 'span12 textfield',
                    'placeholder' => Yii::t('translation', 'User_Register_State'),
                    'maxlength' => 30));
            }
        }
    }
    
     public function actionDynamiccountry() {
        $data = CHtml::listData(Countries::model()->findAll(),'Id','Name');
            if (count($data) > 0) {
                $pp='';
                foreach ($data as $Id => $Name) {
                    $pp.=CHtml::tag('option', array('value' => $Id), $Name, true);
                }
                 $obj = array('status' => 'success', 'data' => $pp, 'success' => '');
                $renderScript = $this->rendering($obj);
                 echo $renderScript;
            } 
    }

    public function actionPostDetail() {
        $forgotModel = new ForgotForm();
        try {
            $model = new LoginForm;
            $UserRegistrationForm = new UserRegistrationForm;
            $countries = ServiceFactory::getSkiptaUserServiceInstance()->GetCountries();
            $postId = $_REQUEST['postId'];
            $categoryType = $_REQUEST['categoryType'];
            $postType = $_REQUEST['postType'];
        } catch (Exception $exc) {
            Yii::log("++++++++++++++++++++++++++++++++" . $exc->getMessage(), 'error', 'userController');
        }

        $this->render('postdetail', array('model' => $model,'UserRegistrationModel' => $UserRegistrationForm,'countries' => $countries,"forgotModel"=>$forgotModel,'postId'=>$postId,'categoryType'=>$categoryType,'postType'=>$postType));
    }

    public function actionError() {
        $cs = Yii::app()->getClientScript();
        $baseUrl = Yii::app()->baseUrl;
        $cs->registerCssFile($baseUrl . '/css/error.css');
        if ($error = Yii::app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }
  public function actionsendContactUs(){
      try {
           $contactUs = new ContactUsForm();
          
            if (isset($_POST['ContactUsForm'])) {
                 $contactUs->attributes = $_POST['ContactUsForm'];
                 $errors = CActiveForm::validate($contactUs);
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                }else{
                      
                        $firstName=$contactUs->FirstName;
                        $lastName=$contactUs->LastName;
                        $occupation=$contactUs->Occupation;
                        $Address=$contactUs->Address;
                        $Message=$contactUs->UserComment;
                        $UserEmail=$contactUs->ContactUserEmail;
                       
                        if(isset(YII::app()->params['SendGridFromEmail'])){
                         $to = YII::app()->params['SendGridFromEmail'];                          
                        }else{
                            $to = 'info@skipta.com';                      
                        }
                       
                        $userEmail ='';
                        $subject = 'Thank you for contacting '.Yii::app()->params['NetworkName'];                       
                        $companyLogo = "";
                        $employerName = "Skipta Admin";
                        //$employerEmail = "info@skipta.com";
                        $messageview='ContactUsMailTemplate';                      
                        $params = array('firstName' => $firstName,'lastName'=>$lastName,'occupation'=>$occupation,'address'=>$Address,'message'=>$Message);                       
                        $sendMailToUser=new CommonUtility;
                        $sendMailToUser->actionSendmail($messageview,$params, $subject, $to); 
                        $messageview='ContactUsUserTemplate';
                        $to=$UserEmail;
                        $sendMailToUser=new CommonUtility;
                        $sendMailToUser->actionSendmail($messageview,$params, $subject, $UserEmail);
                         $obj = array('status' => 'success', 'data' => 'Thank you for contacting ,we will get back to you ', 'error' => '');
                }
               
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
      } catch (Exception $exc) {
          error_log("_______________________".$exc->getMessage());
      }
    }
    
    function checkAppValidity($appVersion,$codeVersion,$deviceInfo){
       $appStatus = "info";
       $appHTML="";
       if( Yii::app()->params['NotifyAppNewVesion'] == 'ON'){
          $configMaxVersion = Yii::app()->params['maxVersion'];
          $configMinVersion = Yii::app()->params['minVersion'];
       if($codeVersion != $configMaxVersion){
           if($codeVersion >= $configMinVersion && $codeVersion < $configMaxVersion) {
           error_log("warning message here");
           $appStatus = "deprecated";
            $appHTML =  $this->renderPartial('appstatus_view',array("appStatus" => $appStatus,"appVersion" => $appVersion,"codeVersion" => $codeVersion,"configMaxVersion"=>$configMaxVersion,"deviceInfo"=>$deviceInfo),true);

        
       }else {
            error_log("error message here");
            $appStatus = "expired";
            $appHTML =  $this->renderPartial('appstatus_view',array("appStatus" => $appStatus,"appVersion" => $appVersion,"codeVersion" => $codeVersion,"configMaxVersion"=>$configMaxVersion,"deviceInfo"=>$deviceInfo),true);
        }
       }
       return array("appStatus"=>$appStatus,"appHTML"=>$appHTML);
       }
    }

        public function actionCheckAppStatus(){
         // error_log("actionCheckAppStatus-----------");
          $appVersion = $_POST["appVersion"];
          $codeVersion = $_POST["codeVersion"];
           $deviceInfo = $_POST["deviceInfo"];
          if(isset(Yii::app()->params['popupType']) && Yii::app()->params['popupType'] == "info"){
                 //error_log("actionCheckAppStatus-----------inof");
              $appStatus = "info";
              $appHTML =  $this->renderPartial('appstatus_view',array("appStatus" => $appStatus,"appVersion" => $appVersion,"codeVersion" => $codeVersion,"deviceInfo"=>$deviceInfo),true); 
              $appStatusArray = array("appStatus"=>$appStatus,"appHTML"=>$appHTML);
              
          }else{
             $appStatusArray =  $this->checkAppValidity($appVersion,$codeVersion,$deviceInfo);
  
          }
           $obj = array('status'=>$appStatusArray['appStatus'],"appStatusHtml"=>$appStatusArray['appHTML']);
          echo $this->rendering($obj);
         
        }


    /*
     * Moin Hussain
     * This method is used for checking user session is available for app.
     */
    public function actionCheckAutoLogin(){
        try{
            $sessionId = $_POST["sessionId"];
            $userId = $_POST["userId"];
            $appVersion = $_POST["appVersion"];
            $codeVersion = $_POST["codeVersion"];
            $deviceInfo = $_POST["deviceInfo"];
          //   error_log(print_r($device,true));
          //error_log("deviceName--------".$deviceInfo['platform']);
            $response = ServiceFactory::getSkiptaUserServiceInstance()->checkAutoLogin($sessionId,$userId);
            if($response){
               
                $this->doAutoLogin($userId,$sessionId,$appVersion,$codeVersion,$deviceInfo);
              
            }else{
                 $appStatusArray =  $this->checkAppValidity($appVersion,$codeVersion,$deviceInfo);
                $obj = array('status' => 'fail', 'data' => '', 'error' => '','appStatus'=>$appStatusArray['appStatus'],"appStatusHtml"=>$appStatusArray['appHTML']);
                 echo $this->rendering($obj);
            }
         
        } catch (Exception $ex) {
     Yii::log("actionCheckAutoLogin==" . $exc->getMessage(), 'error', 'userController');
        }
    }
    /*
     * Moin Hussain
     * This method is used for doing auto login of mobile app.
     */
     function doAutoLogin($userId,$sessionId,$appVersion,$codeVersion,$deviceInfo){
            $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($userId, 'UserId');
           $sessionId = ServiceFactory::getSkiptaUserServiceInstance()->saveMobileSession($userObj->UserId,$sessionId,'',''); 

            ServiceFactory::getSkiptaUserServiceInstance()->saveUserLoginActivity($userObj->UserId);
            $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userObj->UserId);
            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userObj->UserId, $userObj->UserTypeId);
            $segmentId = isset($tinyUserCollectionObj->SegmentId)?$tinyUserCollectionObj->SegmentId:0;
            $userFollowingGroups = ServiceFactory::getSkiptaUserServiceInstance()->groupsUserFollowing($userObj->UserId,$segmentId);
            $userHierarchy = ServiceFactory::getSkiptaUserServiceInstance()->getUserHierarchy($userObj->UserId);
            Yii::app()->session['UserFollowingGroups'] = $userFollowingGroups;
            Yii::app()->session['TinyUserCollectionObj'] = $tinyUserCollectionObj;
            Yii::app()->session['UserPrivileges'] = $userPrivileges;
            Yii::app()->session['UserPrivilegeObject'] = CommonUtility::getUserPrivilege();
            Yii::app()->session['UserStaticData'] = $userObj;
            Yii::app()->session['IsAdmin'] = Yii::app()->session['UserStaticData']->UserTypeId;
            Yii::app()->session['UserHierarchy'] = $userHierarchy;
            Yii::app()->session['PostAsNetwork'] = 0;
            if(Yii::app()->session['IsAdmin']==1){
                if(isset( YII::app()->params['NetworkAdminEmail'])){
                    $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType( YII::app()->params['NetworkAdminEmail'], 'Email');
                    Yii::app()->session['NetworkAdminUserId'] = $netwokAdminObj->UserId;
                    Yii::app()->session['NetworkAdminUserName'] = $netwokAdminObj->FirstName." ".$netwokAdminObj->LastName;
                }
            }
              $appStatusArray =  $this->checkAppValidity($appVersion,$codeVersion,$deviceInfo);
              
               $obj = array('status' => 'success', 'sessionId' =>$sessionId,'userObj'=>$userObj,'tinyUser'=>$tinyUserCollectionObj,'error' => '','appStatus'=>$appStatusArray['appStatus'],"appStatusHtml"=>$appStatusArray['appHTML'],'uploadMaxFileSize'=>Yii::app()->params['UploadMaxFilSize']);
               echo $this->rendering($obj);
        }
//      function actionLogout(){
//            $sessionId = $_POST["sessionId"];
//            $userId = $_POST["userId"];
//            $response = ServiceFactory::getSkiptaUserServiceInstance()->logout($sessionId,$userId);

//      }  
        function actionGetCountries(){
            try {
                $countries = ServiceFactory::getSkiptaUserServiceInstance()->GetCountries();
                $obj = array('status' => 'success','countries'=>$countries);
                echo $this->rendering($obj);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }

}

 /*
     * Haribabu
     * This method is used check the invited user status.
     */
function actionInvitation(){
      try {
        if (isset($_REQUEST['q'])) {
            $referrerUserId = 0;
            $referralLinkId = 0;
            $referenceUserEmail = 0;
            $decryptedData = $_REQUEST['q'];
            $message = "";
            $encrypteddata = CommonUtility::decrypt($decryptedData);
            $userdetails = explode('_', $encrypteddata);
            $userId = $userdetails[0];
            $linkId = $userdetails[1];
            $email = $userdetails[2];
            $UpdateReferrerDetails = ServiceFactory::getSkiptaUserServiceInstance()->getReferralDetails($email, $linkId);

            $ReferredUserDetails = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetailsForReferral($userId);
            $ReferralUserProfilePic = $ReferredUserDetails->profile250x250;
            $ReferralUsername = $ReferredUserDetails->DisplayName;

            if ($UpdateReferrerDetails->Status == 0) {
                $ReferralMessage = ServiceFactory::getSkiptaUserServiceInstance()->GetReferralMessagedetails($linkId);
          
                    $referrerUserId = trim($userId);
                    $referenceUserEmail = trim($email);
                    $referralLinkId = trim($linkId);
                
                $ReferralMessage = ServiceFactory::getSkiptaUserServiceInstance()->GetReferralMessagedetails($linkId);
                $message = $ReferralMessage->Message;
            } else {
                $message = "You are already registered login with your login details";
            }
            $networkName = Yii::app()->params['NetworkName'];
            $this->render('postdetail', array('networkName' => $networkName, 'profilepic' => $ReferralUserProfilePic, 'message' => $message, 'username' => $ReferralUsername, 'referenceUserId' => $referrerUserId, 'referenceUserEmail' => $referenceUserEmail, 'referralLinkId' => $referralLinkId, 'message' => $message));
            //$this->render('invitation',array('referenceUserId'=>$referrerUserId));
        }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage());
        }
    }
    
      public function actionRestLogin() {
        try {
            if (isset($_GET['access_token'])) {
                echo 'cookei value'.Yii::app()->request->cookies['fromNetwork']->value."----".Yii::app()->request->cookies['providerLink']->value;
                // $url = Yii::app()->params['ServerURL'] . "https://doctorunite.com/Oauth/getUserProfileDetails?access_token=" . $_GET['access_token'];
                $providerLink=Yii::app()->request->cookies['providerLink']->value;
                $url = $providerLink."/Oauth/getUserProfileDetails?access_token=" . $_GET['access_token'];
                $user = file_get_contents($url);
                $jsonarray = json_decode($user);
                $userResponse = $jsonarray->data;
                $tinyObj = $userResponse->Response;
              
                $url = $providerLink."/Oauth/getUserData?UserApiAccessKey=" . $tinyObj->APIAccessKey."&fromNetwork=".Yii::app()->request->cookies['fromNetwork']->value;
                $userProfile = file_get_contents($url);
                $jsonarray = json_decode($userProfile);
                $userObjResponse = $jsonarray->data;
                $userRegisterBean = $userObjResponse->Response;
                
               // $userRegisterBean->APIAccessKey = "";
                $email = $userRegisterBean->email;
                print_r($userRegisterBean);
                $userexist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($userRegisterBean->email);
                if (count($userexist) > 0) {
                  
                    //Update the user with accesstoken and the from parameter in the user table.
                      $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($userRegisterBean->email, 'Email');
                      $userObj->AccessToken=$_GET['access_token'];
//                       $userObj->FromNetwork="DoctorUnite";
                       User::model()->updateUserByFieldByUserId($userObj->UserId, $userObj->AccessToken,"AccessToken");
                        User::model()->updateUserByFieldByUserId($userObj->UserId, $userRegisterBean->fromNetwork,"FromNetwork");
                      // print_r($userRegisterBean);
                      
                       $this->prepareSession($userRegisterBean->email);
                   
                  
                } else {
                    //save the user means registring the user.
                    //prepare user bean
                    $customfields = array();
                    $userRegisterBean->accessToken = $_GET['access_token'];
                    $UserRegistrationForm = new UserRegistrationForm();
                    foreach ($UserRegistrationForm->attributes as $key => $value) {
                         if (isset($userRegisterBean->$key)) {
                            $uerRegistrationArray[$key] = $userRegisterBean->$key;
                        }
                    }
                    $customfieldsArray = array();
                    $Save_userInUserCollection = ServiceFactory::getSkiptaUserServiceInstance()->SaveUserCollection($uerRegistrationArray, $customfields);
                    if ($Save_userInUserCollection != 'error') {
                         $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($userRegisterBean->email, 'Email');
                        $message = "User Registered Successfully";
                           $profileImage=split("/",$userRegisterBean->profilePicture);
                           
             
                    
                       if($profileImage[sizeof($profileImage)-1]=="user_noimage.png")
                           $urlPath=$providerLink."/images/system/".$profileImage[sizeof($profileImage)-1];
                       else
                           $urlPath=$userRegisterBean->profilePicture;
                      
                       CommonUtility::getImageFromURL($urlPath,Yii::app()->params['ArtifactSavePath'].$profileImage[sizeof($profileImage)-1]);
                         $returnValue = ServiceFactory::getSkiptaUserServiceInstance()->saveProfileDetailsUserCollection($userObj->UserId, "ProfilePicture","/temp/".$profileImage[sizeof($profileImage)-1], $profileImage[sizeof($profileImage)-1], Yii::app()->params['ServerURL'] );
                        $this->prepareSession($userRegisterBean->email);
                       
                    } else {
                        $message = "User registration failed";
                    }
                  
                }
            }
        } catch (Exception $ex) {
            Yii::log("actionRestLogin*******************" . $ex->getMessage());
        }
    }

    public function prepareSession($email) {
        try{
            
         CommonUtility::setUserSession($email);
            Yii::app()->session['PostAsNetwork'] = 0;
            Yii::app()->session['LoginUserEmail'] = $model->email;
            Yii::app()->session['LoginUserFirstName'] = Yii::app()->session['UserStaticData']['FirstName'];
            if (isset(YII::app()->params['NetworkAdminEmail'])) {
                $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(YII::app()->params['NetworkAdminEmail'], 'Email');
                Yii::app()->session['NetworkAdminUserId'] = $netwokAdminObj->UserId;
                Yii::app()->session['NetworkAdminUserName'] = $netwokAdminObj->FirstName . " " . $netwokAdminObj->LastName;
            }
            if ($_POST["mobile"] == 1) {
            //insert a record in MobileSessions table
            CommonUtility::badgingInterceptor("MobileFirstLogin", $userObj->UserId);
            $sessionId = ServiceFactory::getSkiptaUserServiceInstance()->saveMobileSession($userObj->UserId, $sessionId);
        } else {
            /* Cookie based login */
            $identity = new UserIdentity($model->email, $model->password);
            $duration = $model->rememberMe ? 3600 * 24 * 60 : 0; // 30 days

            $identity->authenticate(); //must
            Yii::app()->user->login($identity, $duration);
            $randomKey = Yii::app()->user->getState('s_k');
            /* Cookie based login */
            ServiceFactory::getSkiptaUserServiceInstance()->saveCookieRandomKeyForUser($userObj->UserId, $randomKey);
            
        }
         $this->redirect('/stream');
        }
        catch (Exception $ex)
        {

        }
    }
    /*
     * Moin Hussain
     * This method is used for checking user session is available for app.
     */
   
    
    
     public function actionMobileRestLogin() {
        try {
            error_log("--actionMobileRestLogin---------------------------");
             $access_token = $_POST["authToken"];
            $providerLink = $_POST["providerLink"];
            $fromNetwork = $_POST["fromNetwork"];
              $appVersion = $_POST["appVersion"];
            $codeVersion = $_POST["codeVersion"];
            $deviceInfo = $_POST["deviceInfo"];
            
            error_log("authtoken------".$access_token."---providerLink---".$providerLink."---fromNetwork---".$fromNetwork);
            
            if (isset($access_token)) {
               // echo 'cookei value'.Yii::app()->request->cookies['fromNetwork']->value."----".Yii::app()->request->cookies['providerLink']->value;
                // $url = Yii::app()->params['ServerURL'] . "https://doctorunite.com/Oauth/getUserProfileDetails?access_token=" . $_GET['access_token'];
               // $providerLink=Yii::app()->request->cookies['providerLink']->value;
               // $providerLink=$_GET['providerLink'];
                
               
                $url = $providerLink."/Oauth/getUserProfileDetails?access_token=" . $access_token;
                error_log("url1----------------".$url);
                $user = file_get_contents($url);
                $jsonarray = json_decode($user);
                $userResponse = $jsonarray->data;
                $tinyObj = $userResponse->Response;
              
                $url = $providerLink."/Oauth/getUserData?UserApiAccessKey=" . $tinyObj->APIAccessKey."&fromNetwork=".$fromNetwork;
                   error_log("url2----------------".$url);
                $userProfile = file_get_contents($url);
                $jsonarray = json_decode($userProfile);
                $userObjResponse = $jsonarray->data;
                $userRegisterBean = $userObjResponse->Response;
                
               // $userRegisterBean->APIAccessKey = "";
                $email = $userRegisterBean->email;
                //print_r($userRegisterBean);
                error_log("email---".$userRegisterBean->email);
                $userexist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($userRegisterBean->email);
                if (count($userexist) > 0) {
                  
                    //Update the user with accesstoken and the from parameter in the user table.
                      $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($userRegisterBean->email, 'Email');
                      $userObj->AccessToken=$access_token;
//                       $userObj->FromNetwork="DoctorUnite";
                       User::model()->updateUserByFieldByUserId($userObj->UserId, $userObj->AccessToken,"AccessToken");
                        User::model()->updateUserByFieldByUserId($userObj->UserId, $userRegisterBean->fromNetwork,"FromNetwork");
                      // print_r($userRegisterBean);
                      
                      // $this->prepareSession($userRegisterBean->email);
                  // $this->redirect(Yii::app()->params['ServerURL'].'/oauthMobileReturn.php#oauth='.$access_token."&userId=".$userObj->UserId);
                      $this->doNetworkLogin($access_token,$userObj->UserId,$appVersion,$codeVersion,$deviceInfo); 
                  
                } else {
                    //save the user means registring the user.
                    //prepare user bean
                    $customfields = array();
                    $userRegisterBean->accessToken = $access_token;
                    $UserRegistrationForm = new UserRegistrationForm();
                    foreach ($UserRegistrationForm->attributes as $key => $value) {
                         if (isset($userRegisterBean->$key)) {
                            $uerRegistrationArray[$key] = $userRegisterBean->$key;
}
                    }
                    $customfieldsArray = array();
                    $Save_userInUserCollection = ServiceFactory::getSkiptaUserServiceInstance()->SaveUserCollection($uerRegistrationArray, $customfields);
                    if ($Save_userInUserCollection != 'error') {
                         $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($userRegisterBean->email, 'Email');
                        $message = "User Registered Successfully";
                           $profileImage=split("/",$userRegisterBean->profilePicture);
                           
             
                    
                       if($profileImage[sizeof($profileImage)-1]=="user_noimage.png")
                           $urlPath=$providerLink."/images/system/".$profileImage[sizeof($profileImage)-1];
                       else
                           $urlPath=$userRegisterBean->profilePicture;
                      
                       CommonUtility::getImageFromURL($urlPath,Yii::app()->params['ArtifactSavePath'].$profileImage[sizeof($profileImage)-1]);
                         $returnValue = ServiceFactory::getSkiptaUserServiceInstance()->saveProfileDetailsUserCollection($userObj->UserId, "ProfilePicture","/temp/".$profileImage[sizeof($profileImage)-1], $profileImage[sizeof($profileImage)-1], Yii::app()->params['ServerURL'] );
                      // $this->redirect(Yii::app()->params['ServerURL'].'/oauthMobileReturn.php#oauth='.$access_token."&userId=".$userObj->UserId);
                       $this->doNetworkLogin($access_token,$userObj->UserId,$appVersion,$codeVersion,$deviceInfo);
                    } else {
                        $message = "User registration failed";
                    }
                  
                }
            }
        } catch (Exception $ex) {
            Yii::log("actionRestLogin*******************" . $ex->getMessage());
        }
    }
    
     public function doNetworkLogin($authToken,$userId,$appVersion,$codeVersion,$deviceInfo){
        try{
               
                $sessionId = CommonUtility::generateSecurityToken();
                $this->doAutoLogin($userId,$sessionId,$appVersion,$codeVersion,$deviceInfo);
         
        } catch (Exception $ex) {
     Yii::log("actionCheckAutoLogin==" . $exc->getMessage(), 'error', 'userController');
        }
    }

 /*
 * Haribabu
 * This method is used to set the password for HDS Members.
 */
 public function actionPasswordSetUp(){
     try{
         $PasswordSetUpModel = new PasswordSetUpForm();
         $UserKey = Yii::app()->request->getParam('UK');
         $UserStatus="";
         $userEmail="";
         $PwdSetUpMessage="";
         $UsernotExistMessage="";
         $NetworkId=Yii::app()->params['NetWorkId'];
         if ($UserKey != "") {
                $UserDetails = ServiceFactory::getSkiptaUserServiceInstance()->geHDSUserDetailsByUserId($UserKey);
                if (is_object($UserDetails)) {
                    $UserStatus = $UserDetails->Registration_State;
                    $userEmail = $UserDetails->Email;
                     $UserExist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($UserDetails->Email);
                     if (count($UserExist) > 0 && is_object($UserExist)) {
                          $PwdSetUpMessage = Yii::t('translation', 'HDS_Already_Registered_member_Message'); 
                     }else{
              
                    if ($UserDetails->Registration_State == 'Registered') {
                        $ExistedUserDetails = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($UserDetails->Email);
                        $UserStatus = 'Duplicate';
                        $UserKey = $ExistedUserDetails->UserId;
                        $PwdSetUpMessage = Yii::t('translation', 'HDS_Already_Registered_member_Message');
                    } else {
                        $UserExist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($UserDetails->Email);
                        if (count($UserExist) > 0 && is_object($UserExist)) {
                            $UserStatus = 'Duplicate';
                            $UserKey = $UserExist->UserId;
                            $UpdateUserDetails = ServiceFactory::getSkiptaUserServiceInstance()->updateHDStUserDetailsByAccessId($UserKey, 'Registration_State', 'Registered');
                             $PwdSetUpMessage = Yii::t('translation', 'HDS_Already_Registered_member_Message');
                            
                        } else {
                            $UpdateUserDetails = ServiceFactory::getSkiptaUserServiceInstance()->updateHDStUserDetailsByAccessId($UserKey, 'Registration_State', 'Setup');
                        }
                    }

                    $HdsUsertracking = ServiceFactory::getSkiptaPostServiceInstance()->trackPasswordSetUpPageLoad($UserKey, 'SetUpPassword', $UserStatus, $NetworkId);
                }
            } else {

               $UsernotExistMessage = Yii::t('translation', 'HDS_User_not_exist_Message');
           }
            }else{
                 $UsernotExistMessage = Yii::t('translation', 'HDS_User_not_exist_Message');
            }
            $this->render('passwordSetup', array('UserStatus' => $UserStatus,'PasswordSetUp'=>$PasswordSetUpModel,'PasswordSetUpMessage'=>$PwdSetUpMessage,'UsernotExistMessage'=>$UsernotExistMessage,'AccessKey'=>$UserKey,'UserEmail'=>$userEmail));
     } catch (Exception $ex) {
         Yii::log("actionPasswordSetup==" . $ex->getMessage(), 'error', 'SiteController');
     }
 }
 /*
 *@Author Haribabu
 * This method is used to set the password for HDS Members.
  * 
 */
 public function actionHDSUserRegistration(){
     try{
         $userData = array();
            $NetworkId = Yii::app()->params['NetWorkId'];
            $PasswordSetUpModel = new PasswordSetUpForm();
            $HdsUserRegistrationPostData = $_POST['PasswordSetUpForm'];
            $HdsRegistrationForm_errors = CActiveForm::validate($PasswordSetUpModel);
            $PasswordSetUpModel->attributes = $_POST['PasswordSetUpForm'];
            if ($HdsRegistrationForm_errors != "[]") {
                $obj = array('status' => 'fail', 'data' => '', 'error' => $HdsRegistrationForm_errors, 'message' => "");
            } else {
                $AccessId = $PasswordSetUpModel->AccessKey;
                if ($AccessId != "") {
                    $UserDetails = ServiceFactory::getSkiptaUserServiceInstance()->geHDSUserDetailsByUserId($AccessId);
                    if (is_object($UserDetails)) {
                        $HdsUserRegistration = ServiceFactory::getSkiptaUserServiceInstance()->SaveHdsUserCollection($HdsUserRegistrationPostData, $UserDetails);
                        if ($HdsUserRegistration != 'error') {
                            $UpdateUserDetails = ServiceFactory::getSkiptaUserServiceInstance()->updateHDStUserDetailsByAccessId($AccessId, 'Registration_State', 'Registered');
                            $userData['Pwd'] = $HdsUserRegistrationPostData['password'];
                            $userData['Email'] = $UserDetails->Email;
                            $obj = array('status' => 'success', 'data' => $userData, 'message' => Yii::t('translation', 'HDS_User_Register_Success_Message'), 'error' => "");
                        }
                    }
                    $HdsUsertracking = ServiceFactory::getSkiptaPostServiceInstance()->trackPasswordSetUpPageLoad($HdsUserRegistration, 'SetUpPassword', 'Registered', $NetworkId);
                    $HdsUserUpdateUserId = ServiceFactory::getSkiptaPostServiceInstance()->UpdateHDSUserAcceskeyWithUserid($AccessId, $HdsUserRegistration);
                }
            }

            echo $this->rendering($obj);
        } catch (Exception $ex) {
         Yii::log("actionHDSUserRegistration==" . $ex->getMessage(), 'error', 'SiteController');
     }
 }
 /*
  * @Author Haribabu
  * This method is used to login the Hds User with Email and passord
  * 
  */
 public function actionHDSUserLogin(){
     try{
         $Userdetails = array();
        $model = new LoginForm;
        $model->email = Yii::app()->request->getParam('email');
        $model->pword = Yii::app()->request->getParam('pword');
        $resultArray = ServiceFactory::getSkiptaUserServiceInstance()->userAuthentication($model);
        if ($resultArray == 'success') {
            $status = "success";
            CommonUtility::setUserSession($model->email);
            Yii::app()->session['PostAsNetwork'] = 0;
            Yii::app()->session['LoginUserEmail'] = $model->email;
            Yii::app()->session['LoginUserFirstName'] = Yii::app()->session['UserStaticData']['FirstName'];
            $userObj= ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($model->email, "Email");
            if (isset(YII::app()->params['NetworkAdminEmail'])) {
                $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(YII::app()->params['NetworkAdminEmail'], 'Email');
                Yii::app()->session['NetworkAdminUserId'] = $netwokAdminObj->UserId;
                Yii::app()->session['NetworkAdminUserName'] = $netwokAdminObj->FirstName . " " . $netwokAdminObj->LastName;
            }
            /* Cookie based login */
            $identity = new UserIdentity($model->email, $model->pword);
            $duration = $model->rememberMe ? 3600 * 24 * 60 : 0; // 30 days

            $identity->authenticate(); //must
            Yii::app()->user->login($identity, $duration);
            $randomKey = Yii::app()->user->getState('s_k');
            /* Cookie based login */
            ServiceFactory::getSkiptaUserServiceInstance()->saveCookieRandomKeyForUser($userObj->UserId, $randomKey);
            $obj = array('status' => $status, 'sessionId' => $sessionId, 'userObj' => $userObj, 'tinyUser' => Yii::app()->session['TinyUserCollectionObj'], 'error' => '', 'uploadMaxFileSize' => Yii::app()->params['UploadMaxFilSize']);
        } else {
            $model->addError('error', Yii::t('translation', $resultArray));
            $errors = $model->getError('error');
            $status = $errors;
            $obj = array('status' => 'error', 'data' => '', 'error' => array("LoginForm_email" => Yii::t('translation', $errors)));
        }
        // }
        // echo "success";
        echo $this->rendering($obj);
        Yii::app()->end();
     } catch (Exception $ex) {
         Yii::log("actionHDSUserLoginnnn==" . $ex->getMessage(), 'error', 'SiteController');
     }
     
    }

}
?>
