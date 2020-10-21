<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $layout='userLayout';
        public $sidelayout='no';
        public $tinyObject;
        public $userPrivileges;
        public $userPrivilegeObject;
        public $whichmenuactive;
        public $guest;
        public $returnUrl;
        public $model;
        public $UserRegistrationForm;
        public $forgotModel;
        public $countries;
        public $resetForm;
        public $oAuthNetworksInfo;
        
        public function initializeforms()
        {
              if(!isset(Yii::app()->session['TinyUserCollectionObj']))
        {
      $this->model = new LoginForm;
      $this->forgotModel = new ForgotForm;  
      $this->UserRegistrationForm = new UserRegistrationForm;
      $this->resetForm = new ResetForm();
      $this->countries = ServiceFactory::getSkiptaUserServiceInstance()->GetCountries(); 
      $this->oAuthNetworksInfo=array();

       if(Yii::app()->params['IsDSN']=='ON')
       {
           $returnProvidersData= ServiceFactory::getSkiptaUserServiceInstance()->getAllOauthProviderDetails();

           if($returnProvidersData!="failure" && count($returnProvidersData)>0)
		$this->oAuthNetworksInfo= $returnProvidersData;
       }
        }
        }
        public function init() {
        //parent::init();
        if(!isset($_REQUEST['mobile'])){
                  $cs = Yii::app()->getClientScript();
                  $cs->registerCoreScript('jquery');
                  $this->cookieBasedLogin();
             }
       
       
         if(isset($_REQUEST['timezone'])){
             $timezone = $_REQUEST['timezone'];
              Yii::app()->session['timezone']=$timezone;
         }
        
        }
       public function cookieBasedLogin(){
            
        if(!Yii::app()->request->isAjaxRequest){
                  Yii::app()->session['returnUrl'] = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
          }
           if(Yii::app()->user->isGuest ){
               $this->guest = "true";
                if(Yii::app()->request->isAjaxRequest) {
                    $result = array("code"=>440,"status"=>"sessionTimeout");
                     echo $this->rendering($result);
                      Yii::app()->end();
                }else{
                    Yii::app()->request->cookies['r_u'] = new CHttpCookie('r_u',  Yii::app()->session['returnUrl']);
                    $this->redirect('/');
                }
               
               
              
        }else{
            $this->guest = "false";//
            $randomString = Yii::app()->user->getState('s_k');
            if (!isset(Yii::app()->session['TinyUserCollectionObj']) || empty(Yii::app()->session['TinyUserCollectionObj'])) {
                $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(Yii::app()->user->getName(), 'Email');
                $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userObj->UserId);
                $validityOfCookie = ServiceFactory::getSkiptaUserServiceInstance()->checkCookieValidityForUser($userObj->UserId,$randomString);
                if ($validityOfCookie=="true") {
                         CommonUtility::reloadUserPrivilegeAndDataByCookie($userObj);
                } else {

                    $this->guest = "true";
                    $this->redirect('/');
                }
            } else {
             
                }
        }
       }
        public function rendering($result) 
        {
        header('Content-type: application/json');  
        return(CJSON::encode($result));
        } 
        
        public function applyLayout($name){
         
            $this->layout=$name;
        }
         public function throwErrorMessage($id,$translation){
            $obj = array("status" => 'error', "error" => array($id => Yii::t('translation', $translation)));
            echo $this->rendering($obj);
        }
        public function throwSuccessMessage($data,$translation){
            $obj = array("status" => 'success',"data"=>$data,"message" => array(Yii::t('translation', $translation)));
            echo $this->rendering($obj);
        }
}