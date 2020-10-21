<?php


/*
 * Developer Suresh Reddy
 * on 8 th Jan 2014
 * all users actions need to add here
 */

class UserController extends Controller {
  

public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
public function init() {
    parent::init();
     if(!isset($_REQUEST['mobile'])){
       if(isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])){
                 $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];
                $this->userPrivileges=Yii::app()->session['UserPrivileges'];
             
             }else{
                  $this->redirect('/');
                 }  
     }
       
 }
 public function actionError()
{
 $cs = Yii::app()->getClientScript();
$baseUrl=Yii::app()->baseUrl; 
$cs->registerCssFile($baseUrl.'/css/error.css');
    if($error=Yii::app()->errorHandler->error)
        $this->render('error', $error);
}

/**
 * author: karteek.v
 * actionGetMiniPorfile is used to get user mini profile
 * request an userId
 * returns an user object
 */
public function actionGetMiniProfile(){
    try{
        if(isset($_REQUEST['userid'])){
            $userid = $_REQUEST['userid'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getUserMiniProfile($userid,Yii::app()->session['TinyUserCollectionObj']->UserId);
        }
        
        $obj = array('status' => 'success', 'data' => $result, 'error' => '', 'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId'],'networkmode'=>(int)Yii::app()->session['PostAsNetwork']);        
        echo CJSON::encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    
}
  /**
     * @Author Moin Hussain
     * This method is used actionTrackMinHashTagWindowOpen summary
     * @return type  
     */
    public function actionTrackMinMentionWindowOpen() {
         try{
        if(isset($_REQUEST['userid'])){
            $userId = $_REQUEST['userid'];
             $networkId = $this->tinyObject['NetworkId'];
            ServiceFactory::getSkiptaUserServiceInstance()->trackMinMentionWindowOpen(Yii::app()->session['TinyUserCollectionObj']->UserId,$userId,$networkId);
        }
        
        $obj = array('status' => 'success', 'data' => "", 'error' => '');        
        echo CJSON::encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    }
/**
 * @author karteek.v
 * actionUserFollowUnfollowActions is used for either follow or unfollow actions
 * @param $userid,$type
 * @return type json object
 */
public function actionUserFollowUnfollowActions(){
    try{
        Yii::log("==actionUserFollowUnfollowActions==","error","application");
        if(isset($_REQUEST['type']) && isset($_REQUEST['userid'])){
            $type = $_REQUEST['type'];
            $followId = $_REQUEST['userid'];
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
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

public function actionLogout(){
    try {
        Yii::app()->user->logout();
        Yii::app()->session->destroy();
         if(!isset($_REQUEST['mobile'])){
             $randomString = Yii::app()->user->getState('s_k');
          $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
     ServiceFactory::getSkiptaUserServiceInstance()->deleteCookieRandomKeyForUser($userId,$randomString);
      Yii::app()->request->cookies->clear();
       
         $this->redirect('/'); 
         }else{
              $sessionId = $_POST["sessionId"];
            $userId = $_POST["userId"];
            $response = ServiceFactory::getSkiptaUserServiceInstance()->logout($sessionId,$userId);  
           if($response){
             $obj = array("status"=>"success","data"=>"","error"=>"");    
           }else{
                 $obj = array("status"=>"failure","data"=>"","error"=>"");
           }
            echo $this->rendering($obj);
            
         }
        
         
    } catch (Exception $exc) {
        Yii::log($exc->getMessage(),'error','application');
    }
}


/**
 * @author Praneeth
 * actionGetNewFollowersList is used to get users who have followed the logged in user since the last login
 * @return type json object
 * /
 */
public function actionGetNewFollowersList() {
        try {
            $newFollowersList = "";
            $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userid);
            $PreviousLastLoginDate = strtotime(date($data['PreviousLastLoginDate']));
            $newFollowersList = ServiceFactory::getSkiptaUserServiceInstance()->getNewFollowersListByDate($userid, $PreviousLastLoginDate);
            $followersCount = count($newFollowersList);
            if ($newFollowersList != 'failure') {
                $this->renderPartial('newFollowers_view', array('newFollowersList' => $newFollowersList, 'followersCount' => $followersCount,'loggedUserId'=>$userid));
            }
        } catch (Exception $ex) {
            Yii::log("-------in exception actionGetNewFollowersList user controller-----------" . $ex->getMessage(), 'error', 'application');
        }
    }
   
public function actionProfileDetails(){
    try {
         
    $urlArray =  explode("/", Yii::app()->request->url);
     
//     return;
        
        
        $isUser=0;
        $userProfileId='';
        $profileModel = new ProfileDetailsForm();
        $this->layout='userLayout';
        $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];        
        $loggedInUserId=$this->tinyObject->UserId;
        $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];

//        if(isset($_REQUEST['data-id'])){
//            $userProfileId=$_REQUEST['data-id'];     
//        }else{
//            $userProfileId=$loggedInUserId;
//        }
       $userProfileId =  ServiceFactory::getSkiptaUserServiceInstance()->getUserIdbyName($urlArray[2]);

       
       if($loggedInUserId==$userProfileId){
          $isUser = 1;    
        }
        
        $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetails($userProfileId,$loggedInUserId); 

        
        $displayName=$this->tinyObject->DisplayName;
        $userProfileDetails=ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userProfileId);       
        $displayName=$userProfileDetails->DisplayName;
        $userBadges=ServiceFactory::getSkiptaUserServiceInstance()->getUserBadgesData($userProfileId);
        $userFollowingHashtags=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingHashtagsDataForProfile($userProfileId);
        $userFollowingGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingGroupsDataForProfile($userProfileId,$loggedInUserId);
       // $userFollowingSubGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingSubGroupsData($userProfileId,$loggedInUserId);        
        $userFollowingCategories=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingCurbsideCategoriesDataForProfile($userProfileId);
        $userFollowing=  ServiceFactory::getSkiptaUserServiceInstance()->getFollowersAndFollowing($userProfileId,'userFollowing');
        $userFollowers=  ServiceFactory::getSkiptaUserServiceInstance()->getFollowersAndFollowing($userProfileId,'userFollowers');        
        
      
        $userCVDetails=ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails($userProfileId);
       
        $userInteractionsCount=  ServiceFactory::getSkiptaUserServiceInstance()->getUserInteractionsCount($userProfileId);
        $userDisplayCVDetails=array();
        $pDis=1;
        if(is_array($userCVDetails['publications']) && $pDis<=2){
            $pDis=$pDis+1;
            $userDisplayCVDetails['publications']=$userCVDetails['publications'][0];
            if($userCVDetails['publications']['Files'] != ""){
                $urlArr = explode("/",$userCVDetails['publications']['Files']);
                $userDisplayCVDetails['publications']['Files'] = $urlArr[3];
            }
        }
        if(is_array($userCVDetails['experience']) && $pDis<=2){
            $pDis=$pDis+1;
            $userDisplayCVDetails['experience']=$userCVDetails['experience'][0];
        }
        
        if(is_array($userCVDetails['interests']) && $pDis<=2){
            $pDis=$pDis+1;
            $userDisplayCVDetails['interests']=$userCVDetails['interests'];
        }
        
        if(is_array($userCVDetails['education']) && $pDis<=2 ){
            $pDis=$pDis+1;
            $userDisplayCVDetails['education']=$userCVDetails['education'][0];
        }

        if(is_array($userCVDetails['achievements']) && $pDis<=2 ){
            $pDis=$pDis+1;
            $userDisplayCVDetails['achievements']=$userCVDetails['achievements'];
        }

        $this->render('userProfileDetails',array('profileDetails'=>  $data,'profileModel'=>$profileModel,'IsUser'=>$isUser,'loginUserId'=>  $this->tinyObject->UserId,'userFollowingHashtags'=>$userFollowingHashtags , 'userFollowingGroups'=>$userFollowingGroups, 'userFollowingCategories'=>$userFollowingCategories, 'userFollowingSubGroups'=>$userFollowingSubGroups, 'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId'],'userFollowers'=>$userFollowers,'userFollowing'=>$userFollowing,'displayName'=>$displayName,"userBadges"=>$userBadges,"userCVDetails"=>$userDisplayCVDetails,"userInteractionsCount"=>$userInteractionsCount));
    } catch (Exception $exc) {  

        Yii::log($exc->getMessage(),'error','application');
    }
}


public function actionSaveProfileInfo() {
        try {
            $this->layout='userLayout';
            $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];
           $userId=$this->tinyObject->UserId;
            $obj = array();
            $profileModel = new ProfileDetailsForm();
            if (isset($_POST['ProfileDetailsForm'])) {
                $profileModel->attributes = $_POST['ProfileDetailsForm'];
                $errors = CActiveForm::validate($profileModel);

                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {                    
                     if(isset($profileModel['DisplayName'])){
                       $displayNameObj =  ServiceFactory::getSkiptaUserServiceInstance()->updateUserProfileDetails($userId,'DisplayName',$profileModel['DisplayName']);
                     }
                     if(isset($profileModel['Company'])){
                        $displayCompanyObj = ServiceFactory::getSkiptaUserServiceInstance()-> updateUserProfileDetails($userId,'Company',$profileModel['Company']);
                     }
                    $userObj = ServiceFactory::getSkiptaUserServiceInstance()->saveOrUpdateUserProfessionalInformation($userId,$profileModel);
                    if ($userObj != 'failure') {

                        $message = Yii::t('translation', 'ProfileUpdateSuccess');
                        //$successMessage=array('ForgotForm_email'=>$message);
                        $obj = array('status' => 'success', 'data' => $message, 'success' => '');
                    } else {
                        $message = Yii::t('translation', 'ProfileUpdateFail');
                        $errorMessage = array('ForgotForm_email' => $message);

                        $obj = array("status" => 'error', 'data' => '', "error" => $errorMessage);
                    }
                }

                $renderScript = $this->rendering($obj);
                echo $renderScript;
            }
        } catch (Exception $exc) {
            Yii::log("====**************************" . $exc->getTraceAsString(), "error", "application");
        }
    }


 public function actionEditProfileNameDetails() {
        try {
            $returnValue = 'failure';
            $type = '';
            $value = '';
            $UserId = '';
            if ($_REQUEST['type'] == 'FirstName') {
                $value = $_REQUEST['profileFirstName'];
                $UserId = $_REQUEST['UserId'];
                $type = 'FirstName';
            }
             if ($_REQUEST['type'] == 'LastName') {
                $value = $_REQUEST['profileLastName'];
                $UserId = $_REQUEST['UserId'];
                $type = 'LastName';
            }
            $returnValue = ServiceFactory::getSkiptaUserServiceInstance()->saveProfileNameDetails($UserId, $value, $type);

            $obj = array('status' => $returnValue,'type'=>$type);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

     public function actionEditProfileAboutmeDetails() {
        try {
            $absolutePath='';
            $returnValue = 'failure';
            $type = '';
            $value = '';
            $UserId = '';
            $imageName='';
            if ($_REQUEST['type'] == 'AboutMe') {
                $value = $_REQUEST['profileAboutMe'];
                $UserId = $_REQUEST['UserId'];
                $type = 'AboutMe';
            }

            $returnValue = ServiceFactory::getSkiptaUserServiceInstance()->saveProfileDetailsUserCollection($UserId, $type, $value,$imageName, $absolutePath );

            $obj = array('status' => $returnValue,'type'=>$type);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    
    
    public function actionUploadProfileImage() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder = Yii::getPathOfAlias('webroot') . '/upload/'; // folder for uploaded files
            if (!file_exists($folder)) {
                mkdir ($folder, 0755,true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "png", "tiff"); //array("jpg","jpeg","gif","exe","mov" and etc...
            //$sizeLimit = 30 * 1024 * 1024; // maximum file size in bytes
            $sizeLimit= Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
            $fileName = $result['filename']; //GETTING FILE NAME
            $extension = $result['extension'];

            $ext = "profile";
            $extTemp = "profile/temp";
            $destnationfolder = $folder . $extTemp;
            
            if (!file_exists($destnationfolder)) {
               mkdir ($destnationfolder, 0755,true);
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
            $destinationTemp = $folder . $extTemp . "/" . $finalImage;            
            if ($extTemp != "") {
                if (file_exists($sourcepath)) {
                    if (copy($sourcepath, $destinationTemp)) {
                        unlink($sourcepath);
                    }
                }
            }
             $img = Yii::app()->simpleImage->load($destinationTemp);
             $width = $img->getWidth();
             if($width>=250){
                $img-> resizeToWidth(250);
             }
             $img->save($destination); 
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }
    
    
    
      
   public function actionsaveProfileImage() {
        try {
            $absolutePath = Yii::app()->params['ServerURL'];
            $returnValue = 'failure';
            $type = '';
            $value = '';
            $UserId = '';
            $imageName='';
            if ($_REQUEST['type'] == 'ProfilePicture') {
                $value = $_REQUEST['profileImage'];
                $UserId = $_REQUEST['UserId'];
                $type = 'ProfilePicture';
                $imageName = $_REQUEST['profileImageName'];
            }
            $returnValue = ServiceFactory::getSkiptaUserServiceInstance()->saveProfileDetailsUserCollection($UserId, $type,$value, $imageName, $absolutePath );
            Yii::app()->session['TinyUserCollectionObj']['profile250x250'] = $absolutePath.Yii::app()->params['IMAGEPATH250'].$returnValue;
            Yii::app()->session['TinyUserCollectionObj']['profile70x70'] = $absolutePath.Yii::app()->params['IMAGEPATH70'].$returnValue;
            Yii::app()->session['TinyUserCollectionObj']['profile45x45'] = $absolutePath.Yii::app()->params['IMAGEPATH45'].$returnValue;
            
            $obj = array('imageName' => $returnValue,'type'=>$type,'imagePath70'=>$absolutePath.Yii::app()->params['IMAGEPATH70'],'imagePath250'=>$absolutePath.Yii::app()->params['IMAGEPATH250']);
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    /**
 * @author Praneeth
 * actionGetRecentGroupActivities is used to get group activity for which the user has visted the group since the last login
 * @return type json object
 * /
 */
  public function actionGetRecentGroupActivities()
{
    try
    {
        $groupActivityList="";
            $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;
                        
            $groupActivityList = ServiceFactory::getSkiptaUserServiceInstance()->getUserGroupActivityForRightWidget($userid);
            $groupActivityListCount = count($groupActivityList);
            if($groupActivityList !='failure')
            {
                $this->renderPartial('recentGroupActivity_view',array('groupActivityList'=>$groupActivityList,'groupActivityListCount'=>$groupActivityListCount));   
            }

    } catch (Exception $ex) {
            Yii::log("-------in exception actionGetNewFollowersList user controller-----------".$ex->getMessage(),'error','application');
    }
}

    /**
     * @author Karteek V
     * this method is used to get user settings...
     * @return type html
     */
    public function actionGetUserStreamSettings() {
        try {
            $userId = $_REQUEST['UserId'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getUserSettings($userId);
            $this->renderPartial("userStreamSettings", array("data" => $result));
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
            error_log($ex->getMessage());
        }
    }

    /**
     * @author Karteek.V
     * This method is used to save the user settings
     * @return type JSON
     */
    public function actionSaveStreamSettings() {
        try {
            $userId = $_REQUEST['UserId'];
            $settingIds = $_REQUEST['settingIds'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->updateUserSettings($userId, $settingIds);
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        echo CJSON::encode($obj);
    }
    
      
    /**
 * @author Praneeth
 * actionGetUserSignedUpEvents is used to get events for which the user is attending
 * @return type json object
 * /
 */
  public function actionGetUserSignedUpEvents()
{
    try
    {
            $userEventsActivityList="";
            $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $CurrentLoginDate = strtotime(date('Y-m-d', time()));            
            
            $userEventsActivityList = ServiceFactory::getSkiptaUserServiceInstance()->getUserEventsAttendingForRightWidget($userid,$CurrentLoginDate);
            $userEventsActivityListCount = count($userEventsActivityList);
            if($userEventsActivityList !='failure'){
               if($userEventsActivityListCount >0)
                {
                    $this->renderPartial('userEventsAttending_view',array('userEventsActivityList'=>$userEventsActivityList,'userEventsActivityListCount'=>$userEventsActivityListCount));   
                } 
            }
            

    } catch (Exception $ex) {
            Yii::log("-------in exception actionGetNewFollowersList user controller-----------".$ex->getMessage(),'error','application');
    }
}
/**
     * @author Sagar
     * This method is to get the Profile Intractions
     */
    public function actionGetprofileintractions(){
        try{
        if(isset($_GET['ProfileIntractionDisplayBean_page']))
        {            
           $pageSize=10;
           $userId = isset($_GET['UserId'])?$_GET['UserId']:Yii::app()->session['TinyUserCollectionObj']['UserId'];
            $provider = new EMongoDocumentDataProvider('ProfileIntractionDisplayBean',
                   
           array(

                'pagination' => array('pageSize' => $pageSize),
                'criteria' => array( 
                   'conditions'=>array(
                            'UserId'=>array('==' => (int)$userId),
                            'IsDeleted'=>array('!=' => 1),
                            'IsAbused'=>array('notIn' => array(1,2)),
                            'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                            'IsNotifiable'=>array('==' => 1),
                             'CategoryType'=>array('!=' => 7),
//                            'PostType'=>array('>' => 0),
                            // 'PostType'=>array('!=' => null),
                  
                            'PostType'=>array('notIn' => array(6,7,8,9,10,0,null,'null')),
                            
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
           if($provider->getTotalItemCount()==0){
               
               $stream=0;//No data
           }else if($_GET['ProfileIntractionDisplayBean_page'] <= ceil($provider->getTotalItemCount()/$pageSize)){               
              $dataArray= $provider->getData();
              $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
               $stream = (CommonUtility::prepareProfileIntractionData($userId, $provider->getData()));
               if(sizeof($stream)>0){
                   $stream=(object)$stream;
               }else{
                 $stream=sizeof($stream);
               }
               
              // Yii::log("***************************".$stream, 'error','application');
            }else
            {
                $stream=-1;//No more data
            }            
            
           $this->renderPartial('profile_intractions_view',array('stream'=>$stream,'totalCount'=>$provider->getTotalItemCount()-8,'page'=>'profile'));
        }
        }catch(Exception $ex){
         Yii::log("************EXCEPTION at actionGetProfileIntractions*****************".$ex->getMessage(),'error','application');   
        }
        
    }
    
      /**
 * @author Praneeth
 * actionGetHelpDescription is to view the help description 
 * @return type json object
 * /
 */
      public function actionGetHelpDescription()
    {
        try {
            if (isset($_REQUEST['helpIconId'])) {
                $helpIconId = $_REQUEST['helpIconId'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->getHelpDescription($helpIconId);
                $obj = array('status' => 'success', 'data' => $result, 'error' => '');
                echo CJSON::encode($obj);
            }
        } catch (Exception $ex) {
            Yii::log("-----actionGetHelpDescription----------" . $ex->getMessage(), "error", "application");
        }
    }
    
    public function actionCheckSession(){
        try{
            
          //  if(Yii::app()->user->isGuest ){
           //    $this->guest = "true";
            //    if(Yii::app()->request->isAjaxRequest) {
          //          $result = array("code"=>440,"status"=>"sessionTimeout");
         
         //       } 
     //   }else{
            $result = array("code"=>200,"status"=>"");
       // }
        echo $this->rendering($result);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
    }
   public function actionGetUserFollowers(){
       try {  
           $loginUserId =  Yii::app()->session['TinyUserCollectionObj']['UserId'];
       $userProfileId='';       
       if(isset($_REQUEST['userId'])){
        $userProfileId=$_REQUEST['userId'];    
       }
       
       $pageLength = 15;
        $page = $_REQUEST['page'];
        
        $pageSize = ($pageLength * $page);        
       $userFollowers=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowersForProfile($userProfileId,$loginUserId,$pageSize,$pageLength);
           if ($userFollowers != 'failure') {
                $this->renderPartial('userFollowersAndFollowing', array('userFollowers' => $userFollowers,'loginUserId'=>$loginUserId,'page'=>$page));
            }
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), "error", "application");
       }
      } 
    public function actionGetUserFollowing() {
        try {
             $loginUserId =  Yii::app()->session['TinyUserCollectionObj']['UserId'];
            $userProfileId='';
           if(isset($_REQUEST['userId'])){
             $userProfileId=$_REQUEST['userId'];    
           }
        $pageLength = 15;
        
          $page = $_REQUEST['page'];
            $pageSize = ($pageLength * $page);
            $userFollowers = ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingForProfile($userProfileId,$loginUserId,$pageSize,$pageLength);
            if ($userFollowers != 'failure') {
                $this->renderPartial('userFollowersAndFollowing', array('userFollowers' => $userFollowers,'loginUserId'=>$loginUserId,'page'=>$page,'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId']));
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
        }
    }

        public function actionSaveSettings() {
        try {
           $object = User::model()->findAll();
            foreach($object as $rw){
              
                $userSettings = new UserNotificationSettingsCollection();
                $userSettings->UserId = $rw->UserId;
                $userSettings->Commented = 1;
                $userSettings->Loved = 0;
                $userSettings->ActivityFollowed = 0;
                $userSettings->Mentioned = 1;
                $userSettings->Invited = 1;
                $userSettings->UserFollowers = 0;
                $userSettings->NetworkId = $rw->NetworkId;
                UserNotificationSettingsCollection::model()->saveUserSettings($rw->UserId,(int)$rw->NetworkId);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
        }
    }
    public function actionSaveDisplayName() {
        try {
           $object = User::model()->findAll();
            foreach($object as $rw){
              
          
                 $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('UserId', '==', (int) $rw->UserId);            
            $mongoModifier->addModifier('DisplayName', 'set',  $rw->FirstName." ".$rw->LastName);
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
      
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
        }
    }
    
    public function actionTest(){
        $this->render('test');
    }
    
    
    /**
 * @author Praneeth
 * actionGetNewFollowersList is used to get users who have followed the logged in user since the last login
 * @return type json object
 * /
 */
public function actionGetCurrentScheduleGameForRightsideWidget() {
        try {
            $currentScheduleGame = "";
            $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;

            $currentScheduleGame = ServiceFactory::getSkiptaGameServiceInstance()->getCurrentScheduleGameForRightsideWidget($userid);            
            if ($currentScheduleGame != 'failure') {
                $currentScheduleGameCount = count($currentScheduleGame);
                $this->renderPartial('userCurrentScheduleGame_view', array('currentScheduleGame' => $currentScheduleGame,'currentScheduleGameCount'=>$currentScheduleGameCount,'loggedUserId'=>$userid));
            }
        } catch (Exception $ex) {
            Yii::log("-------in exception actionGetCurrentScheduleGameForRightsideWidget user controller-----------" . $ex->getMessage(), 'error', 'application');
        }
    }
    public function actionManageNetworkAdmin() {
            try {
                 Yii::app()->session['PostAsNetwork'] = (int)$_REQUEST['isAdmin'];
                 $loginUserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                 $postAsNetwork = Yii::app()->session['PostAsNetwork'];
                 if(Yii::app()->session['PostAsNetwork']==1){
                    $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType( YII::app()->params['NetworkAdminEmail'], 'Email');
                    Yii::app()->session['NetworkAdminUserId'] = (int)$netwokAdminObj->UserId;
                    Yii::app()->session['NetworkAdminUserName'] = $netwokAdminObj->FirstName." ".$netwokAdminObj->LastName;
                    Yii::app()->session['Network_IsAdmin'] = Yii::app()->session['IsAdmin'];
                    Yii::app()->session['Network_CanViewAnalytics'] = $this->userPrivilegeObject->canViewAnalytics;
                    Yii::app()->session['IsAdmin'] = 1;
                    $this->userPrivilegeObject["canViewAnalytics"] = 1;
                 }else{
//                    unset(Yii::app()->session['NetworkAdminUserId']);
//                    unset(Yii::app()->session['NetworkAdminUserName']);
                    Yii::app()->session['IsAdmin'] = isset(Yii::app()->session['Network_IsAdmin'])?Yii::app()->session['Network_IsAdmin']:Yii::app()->session['IsAdmin'];
                    $this->userPrivilegeObject["canViewAnalytics"] = isset(Yii::app()->session['Network_CanViewAnalytics'])?Yii::app()->session['Network_CanViewAnalytics']:$this->userPrivilegeObject->canViewAnalytics;
                 }
                 $result = array("code"=>200,"status"=>"success","loginUserId"=>$loginUserId,"postAsNetwork"=>$postAsNetwork);
                 echo $this->rendering($result);
            } catch (Exception $ex) {
                Yii::log("-------in exception actionGetCurrentScheduleGameForRightsideWidget user controller-----------" . $ex->getMessage(), 'error', 'application');
            }
    }
    
  public function actionUserDetail() {
        try {
            $migratedUserId = $_REQUEST["userGID"];
            $userDetails=ServiceFactory::getSkiptaUserServiceInstance()->getUserByType( $migratedUserId, 'MigratedUserId');
            if($userDetails!='failure'){
                $userId = $userDetails->UserId;
                $result = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userId);
                $this->redirect("/profile/".$result->uniqueHandle);
            }
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString()."====actionRedirectToGroupDetail====".$exc->getMessage());
        }
    }

    
    
      
      public function actionGetBadgesNotShownToUser() {
        try {
            $badgeCollection = CommonUtility::getBadgesNotShownToUser(Yii::app()->session['UserStaticData']->UserId, 1);

            if (count($badgeCollection) > 0) {
                $badgeInfo = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($badgeCollection->BadgeId);
                $this->renderPartial('badging', array('badgingInfo' => $badgeInfo, 'badgeCollectionInfo' => $badgeCollection));
            } else {
                $obj = array("status" => "failure", "data" => "", "error" => "");
                echo $this->rendering(0);
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in actionEnableOrDisableJoyRide==" . $ex->getMessage(), "error", "application");
        }
    }

    public function actionUpdateBadgeShownToUser() {
        try {
              error_log("###########test234234###########");
            if (isset($_POST['badgeCollectionId'])) {
                $result = array();
                $result = ServiceFactory::getSkiptaUserServiceInstance()->updateBadgeShownToUser($_POST['badgeCollectionId']);
            }
        } catch (Exception $ex) {
            
        }
    }


    
    
 /**
 * @author Haribabu
 * This  method is used to render the referral form
 */   
  function actionReferral(){
    
     try {

          $this->renderPartial('referral');
      } catch (Exception $exc) {
         Yii::log("----".$exc->getMessage(),"error","application");
      }
}
 /**
 * @author Haribabu
 * This  method is used to send invitation to refered users
 */
public function actionSendreferralEmail(){
    
     try {
         
         $emailsArray = array();
            $message = "";
            $sucmsg = "";
            $errmsg = "";
            $siteurl = YII::app()->getBaseUrl('true');
            $result = "fail";
            $em="";
            $failmailsCount=0;
            $sucmailsCount=0;
            if (isset($_REQUEST["Emails"])) {
                $emailsArray = explode(',', $_REQUEST["Emails"]);
            }
            if (isset($_REQUEST["Message"])) {
                $message = $_REQUEST["Message"];
            }

            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
           
            //save data in Referral link table

            $linkId = ServiceFactory::getSkiptaUserServiceInstance()->SaveReferralLink($userId, $message);

            //save data in link_user table
            foreach ($emailsArray as $key => $email) {

                //Form link
                $eData = $userId . "_" . $linkId . "_" . $email;
                $encrypteddata = CommonUtility::encrypt($eData);
                $link = $siteurl . '/site/invitation?q=' . $encrypteddata;
                //send email
                $to = trim($email);
                if(Yii::app()->session['PostAsNetwork']==1){
                    $displayname= Yii::app()->params['NetworkName'];
                }else{
                     $displayname=Yii::app()->session['TinyUserCollectionObj']->DisplayName;
                }
//                $validemail=$this->validate($to);
//                if($validemail){
                  
                $subject = $displayname . " has referred you to join " . Yii::app()->params['NetworkName'];
                $employerName = "Skipta Admin";
                //$employerEmail = "info@skipta.com"; 
                $messageview = "UserReferralMail";
                $params = array('myMail' => Yii::app()->session['TinyUserCollectionObj']->DisplayName, 'message' => $message, 'link' => $link,"userName"=>$displayname);
                $sendMailToUser = new CommonUtility;
                $mailSentStatus = $sendMailToUser->actionSendmail($messageview, $params, $subject, $to);
               
                if ($mailSentStatus) {
                    $sucmailsCount=$sucmailsCount+1;
                    $ReferralLinkId = ServiceFactory::getSkiptaUserServiceInstance()->SaveReferralLinkDetails($linkId, $userId, $email);

                    if ($ReferralLinkId == 'success') {
                        $result = "success";
                        if ($sucmailsCount > 1) {
                            $usersmessage = " colleagues! ";
                        } else {
                            $usersmessage = " colleague! ";
                        }
                        // $sucmsg = "Invitation has been send to " . count($emailsArray) . $usersmessage . "  successfully";
                        $sucmsg = "Your referral invite has been successfully sent to your  " . $usersmessage;
                    } else {
                        $errmsg = "Invitation send fail";
                        $result = "fail";
                    }
                }else{
                     $errmsg = "Invitation send fail";
                     $result = "fail";
                     $failmailsCount=$failmailsCount+1;
                }
            
//            }else{
//                 $failmailsCount=$failmailsCount+1;
//                error_log("inelseeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee");
//            }
            
            if($failmailsCount>0){ 
             if($failmailsCount>1){
                    $msg=" are invalid emails";
                    if($emailsArray=($key+1)){
                         $em=$em.$email;
                    }else{
                        $em=$em.$email.',';
                    }
                }else{
                      $msg=" is invalid email";
                      $em=$email;
                }
                $errmsg = $em.$msg;
                $result = "fail";
            }
            
            }
            
            $results = array("status" => $result, "sucmsg" => $sucmsg, 'errmsg' => $errmsg);
            echo $this->rendering($results);
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString()."====action Invite users====".$exc->getMessage());
        }
  }

 
 /**
 * @author Haribabu
 * This  method is used to render the referral form
 */   
  function actionPublications(){
    
     try {
error_log("in controllerrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr");
$urlArray =  explode("/", Yii::app()->request->url);   
//     return;
        
        $isUser=0;
        $userProfileId='';
        $userProfileId =  ServiceFactory::getSkiptaUserServiceInstance()->getUserIdbyName($urlArray[2]);
        $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];        
          $loggedInUserId=$this->tinyObject->UserId;
       if($loggedInUserId==$userProfileId){
          $isUser = 1;    
        }
        
  $profileModel = new UserCVForm();
  $data=array();
        $UserRegistrationForm = new UserRegistrationForm;
            $UserPublicationsForm = new UserPublicationsForm;
            $ExperienceId=1;
             $EducationId=0;
              $InterestId=1;
              $AchievementId=1;
  $education= ServiceFactory::getSkiptaUserServiceInstance()->getEducations();
  $interests= ServiceFactory::getSkiptaUserServiceInstance()->getInterests();
  $experience= ServiceFactory::getSkiptaUserServiceInstance()->getExperience();
  $achievements=ServiceFactory::getSkiptaUserServiceInstance()->getAchievements();
  $data['education']=$education;
  $data['interests']=$interests;
  $data['experience']=$experience;
  $data['achievements']=$achievements;
  $result=  ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails( $loggedInUserId);
        $userDisplayCVDetails=  $this->checkForUserCV($result);
   $UserId = Yii::app()->session['TinyUserCollectionObj']->UserId;
  $UserCVEducationDetails = ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails($UserId);
// echo sizeof($UserCVEducationDetails['education']);exit;
 
  $profile = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetails($userProfileId,$loggedInUserId); 
  if(sizeof($UserCVEducationDetails['education'])>0 && $UserCVEducationDetails['education']!="failure" ){
      $educationIds = array();
      if(isset($UserCVEducationDetails['education']) && is_array($UserCVEducationDetails['education'])){
        foreach ($UserCVEducationDetails['education'] as $key => $value) {
            $educationIds[$key]=$value['EducationId'];
        }
      }
      $achievementIds = array();
      if(isset($UserCVEducationDetails['achievements']) && is_array($UserCVEducationDetails['achievements'])){
        foreach ($UserCVEducationDetails['achievements'] as $key => $value) {
            $achievementIds[$key]=$value['AchievementId'];
        }
      }
      $experienceIds = array();
      if(isset($UserCVEducationDetails['experience']) && is_array($UserCVEducationDetails['experience'])){
        foreach ($UserCVEducationDetails['experience'] as $key => $value) {
            $experienceIds[$key]=$value['ExperienceId'];
        }
      }
      $interestIds = array();
      if(isset($UserCVEducationDetails['interests']) && is_array($UserCVEducationDetails['interests'])){
        foreach ($UserCVEducationDetails['interests'] as $key => $value) {
            $interestIds[$key]=$value['InterestId'];
        }
      }
      $publicatioIds = array();
      if(isset($UserCVEducationDetails['publications']) && is_array($UserCVEducationDetails['publications'])){
        foreach ($UserCVEducationDetails['publications'] as $key => $value) {
            $publicationIds[$key]=$value['Id'];
        }
      }
      $dropdownDetails= ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDropdownDetails($educationIds,$interestIds,$experienceIds,$achievementIds);
      
      $ExperienceId = 0;
                $EducationId = 0;
                $InterestId = 0;
                $AchievementId = 0;
                $data['education'] = is_array($dropdownDetails['education'])?$dropdownDetails['education']:array();
                $data['interests'] = is_array($dropdownDetails['interests'])?$dropdownDetails['interests']:array();
                $data['experience'] = is_array($dropdownDetails['experience'])?$dropdownDetails['experience']:array();
                $data['achievements'] = is_array($dropdownDetails['achievements'])?$dropdownDetails['achievements']:array();
                $CvIdDetails['education'] = $educationIds;
                $CvIdDetails['interests'] = $interestIds;
                $CvIdDetails['experience'] = $experienceIds;
                $CvIdDetails['achievements'] = $achievementIds;
                $CvIdDetails['publications'] = $publicationIds;

                // print_r($CvIdDetails['publications']);exit;
      $this->render('editPublications',array('UserCVForm'=>$profileModel,'UserPublicationsform'=>$UserPublicationsForm,'ExperienceId'=>$ExperienceId,'EducationId'=>$EducationId,'InterestId'=>$InterestId,'AchievementId'=>$AchievementId,'data'=>$data,'UsercvDetails'=>$UserCVEducationDetails,'CvIdDetails'=>$CvIdDetails,"profileDetails"=>$profile,"IsUser"=>$isUser,"userCVDetails"=>$userDisplayCVDetails,));
  }else{

      $this->render('publications',array('UserCVForm'=>$profileModel,'UserPublicationsform'=>$UserPublicationsForm,'ExperienceId'=>$ExperienceId,'EducationId'=>$EducationId,'InterestId'=>$InterestId,'AchievementId'=>$AchievementId,'data'=>$data,"profileDetails"=>$profile,"IsUser"=>$isUser,"userCVDetails"=>$userDisplayCVDetails,));
  }
          

      } catch (Exception $exc) {
         Yii::log("----".$exc->getMessage(),"error","application");
      }

  }
 /**
 * @author Haribabu
 * This  method is used to send invitation to refered users
 */
public function actionPublicationsSave(){
    
    try {
          
            $CVForm = new UserCVForm;
            if (isset($_POST['UserCVForm'])) {
                $CVForm_errors = "[]";
                $CVForm->attributes = $_POST['UserCVForm'];
//                 foreach ($CVForm->attributes as $key => $value) {
//                           error_log("**********Key+++++".$key."************".$value);
//                           if($key=="UserAchievements")
//                           {
//                             error_log( print_r($value,true));
//                           }
//                        }
                $CVForm_errors = CActiveForm::validate($CVForm);
                if ($CVForm_errors != "[]") {
                   
                    $obj = array('status' => 'fail', 'data' => '', 'error' => $CVForm_errors);
                } else {
                    
                    
                    $CVPostData = $_POST['UserCVForm'];
                    
                    $UserId = Yii::app()->session['TinyUserCollectionObj']->UserId;
                    $UserCVEducationDetails = ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails($UserId);
                    if(sizeof($UserCVEducationDetails['education'])>0 && $UserCVEducationDetails['education']!='failure'){
                        $CV = ServiceFactory::getSkiptaUserServiceInstance()->updateUserCV($CVForm->attributes, $UserId,$CVForm->RecentupdateSection);
                        
                        if($CV){
                           
                            $message= Yii::t('translation', 'User_Cv_Updatemessage');
                            
                        }
                        
                    }else{
                        $CV = ServiceFactory::getSkiptaUserServiceInstance()->saveUserCV($CVForm->attributes, $UserId,$CVForm->RecentupdateSection);
                        if($CV){
                           
                            $message=  Yii::t('translation', 'User_Cv_Savemessage');
                        }
                        
                    }
                   
                    $obj = array('status' => 'success','message' => $message, 'data' => '', 'error' => $CVForm_errors);
                }
            } 

            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString() . "====action Invite users====" . $exc->getMessage());
        }
    } 
  
public function actionAddNewPublication(){
    $Id = $_REQUEST['Id'];
     $profileModel = new UserCVForm();
    
      // $this->renderPartial("newPublication", array('PublicationId' => $Id,'UserCVForm'=>$profileModel,'form'=>$form));
       $this->renderPartial("newPublication", array('PublicationId' => $Id,'UserCVForm'=>$profileModel));
}

public function actionAddNewEducation(){
    
        $Id = $_REQUEST['Id'];
        $Name = $_REQUEST['name'];
        $EducationId = $_REQUEST['educationId'];
        $this->renderPartial("education", array('EducationId' => $Id, 'EducationName' => $Name,'Id' => $EducationId));
}
public function actionUpdateDropdown() {
  
        $Id = $_REQUEST['Id'];
        $Category = $_REQUEST['category'];
      //  ServiceFactory::getSkiptaUserServiceInstance()->updateUserCVStatusBySection($Category,$Id,$this->tinyObject->UserId);
        
        
        $dropdownList = ServiceFactory::getSkiptaUserServiceInstance()->getDropdownsListForCVEdit($Id,$Category);
        if($Category=="Education"){
                $this->renderPartial("dropdown", array('DropdownList' => $dropdownList));
            }else if($Category=="Experience"){
                  $this->renderPartial("experience_dropdown", array('DropdownList' => $dropdownList));
            }else if($Category=="Interests"){
                  $this->renderPartial("interests_dropdown", array('DropdownList' => $dropdownList));
            }else if($Category=="Achievements"){
                  $this->renderPartial("achievements_dropdown", array('DropdownList' => $dropdownList));
            }
       
        //
}

public function actionAddNewExperience(){
    
        $Id = $_REQUEST['Id'];
        $Name = $_REQUEST['name'];
        $this->renderPartial("experience", array('ExperienceId' => $Id, 'Experience' => $Name));
}
public function actionAddNewInterest(){
    
        $Id = $_REQUEST['Id'];
        $Name = $_REQUEST['name'];
        
        $this->renderPartial("interests", array('InterestId' => $Id, 'Intersts' => $Name));
}
public function actionAddNewAchievement(){
    
        $Id = $_REQUEST['Id'];
        $Name = $_REQUEST['name'];
        
        $this->renderPartial("achievements", array('AchievementId' => $Id, 'Achievement' => $Name));
}

    public function actionUploadPublicationImage() {
        try {
            
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            //  $folder=Yii::getPathOfAlias('webroot').'/temp/';// folder for uploaded files
            $folder = Yii::app()->params['ArtifactSavePath'];
            $webroot = Yii::app()->params['WebrootPath'].'/upload/Cv/Profile/';
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "exe", "mov", "mp4", "mp3", "txt", "doc", "docx", "pptx", "xlsx", "pdf", "ppt", "xls", "3gp", "php", "ini", "avi", "rar", "zip", "png", "tiff"); //array("jpg","jpeg","gif","exe","mov" and etc...
          //  $sizeLimit = 30 * 1024 * 1024; // maximum file size in bytes
             $sizeLimit= Yii::app()->params['UploadMaxFilSize'];          

            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            
            if(isset($result['filename'])){
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
             $result["filepath"]= Yii::app()->getBaseUrl(true).'/temp/'.$fileName;
             $result["fileremovedpath"]= $folder.$fileName; 
            }else{
              $result['success']=false;  
            }
            $result['extension']=  strtolower($result['extension']);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }


 public function actionProfileInteractions(){
      try{
          $urlArray =  explode("/", Yii::app()->request->url);
          $profileModel = new ProfileDetailsForm();
          $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];        
          $loggedInUserId=$this->tinyObject->UserId;
          $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
          $userProfileId =  ServiceFactory::getSkiptaUserServiceInstance()->getUserIdbyName($urlArray[2]);
//
       if($loggedInUserId==$userProfileId){
          $isUser = 1;    
        }
         $result=  ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails( $userProfileId);
        $userDisplayCVDetails=  $this->checkForUserCV($result);
        $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetails($userProfileId,$loggedInUserId); 
        $userFollowingHashtags=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingHashtagsData($userProfileId);
        $userFollowingGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingGroupsData($userProfileId,$loggedInUserId);
        $userFollowingSubGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingSubGroupsData($userProfileId,$loggedInUserId);        
        $userFollowingCategories=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingCurbsideCategoriesData($userProfileId);
        $this->render('profileInteractions',array('profileDetails'=>  $data,'profileModel'=>$profileModel,'IsUser'=>$isUser,'loginUserId'=>  $this->tinyObject->UserId,'userFollowingHashtags'=>$userFollowingHashtags , 'userFollowingGroups'=>$userFollowingGroups, 'userFollowingCategories'=>$userFollowingCategories, 'userFollowingSubGroups'=>$userFollowingSubGroups,"userCVDetails"=>$userDisplayCVDetails, 'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId'])); 
      } catch (Exception $ex) {
          error_log("#########Exception Occurred in the ProfileInteractions page======".$ex->getMessage());
      }
  }
  
  public function actionuserCV()
  {
      try
      {
          
           $urlArray =  explode("/", Yii::app()->request->url);
          $profileModel = new ProfileDetailsForm();
          $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];        
          $loggedInUserId=$this->tinyObject->UserId;
          $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
     
          $userProfileId =  ServiceFactory::getSkiptaUserServiceInstance()->getUserIdbyName($urlArray[2]);
        error_log($userProfileId);
       if($loggedInUserId==$userProfileId){
          $isUser = 1;    
        }
        
        $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetails($userProfileId,$loggedInUserId); 
        $userFollowingHashtags=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingHashtagsData($userProfileId);
        $userFollowingGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingGroupsData($userProfileId,$loggedInUserId);
        $userFollowingSubGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingSubGroupsData($userProfileId,$loggedInUserId);        
        $userFollowingCategories=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingCurbsideCategoriesData($userProfileId);
        $displayName="CV";
        
          $result=  ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails( $userProfileId);
        $userDisplayCVDetails=  $this->checkForUserCV($result);
          $this->render('userCV',array("result"=>$result,'profileDetails'=>  $data,'profileModel'=>$profileModel,'IsUser'=>$isUser,'loginUserId'=>  $this->tinyObject->UserId,'userFollowingHashtags'=>$userFollowingHashtags , 'userFollowingGroups'=>$userFollowingGroups, 'userFollowingCategories'=>$userFollowingCategories, 'userFollowingSubGroups'=>$userFollowingSubGroups, 'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId'],'displayName'=>$displayName,"userCVDetails"=>$userDisplayCVDetails));
      }
      catch(Exception $ex)
      {error_log("#########Exception Occurred in the actionuserCV page======".$ex->getMessage());
          
      }
  }
  
  public  function checkForUserCV($userCVDetails)
  {
       $userDisplayCVDetails=array();
        $pDis=1;
        if(is_array($userCVDetails['publications']) && $pDis<=2){
            $pDis=$pDis++;
            $userDisplayCVDetails['publications']=$userCVDetails['publications'][0];
            if($userCVDetails['publications']['Files'] != ""){
                $urlArr = explode("/",$userCVDetails['publications']['Files']);
                $userDisplayCVDetails['publications']['Files'] = $urlArr[3];
            }
        }
        if(is_array($userCVDetails['experience']) && $pDis<=2){
            $pDis=$pDis++;
            $userDisplayCVDetails['experience']=$userCVDetails['experience'][0];
        }
        if(is_array($userCVDetails['interests']) && $pDis<=2){
            $pDis=$pDis++;
            $userDisplayCVDetails['interests']=$userCVDetails['interests'][0];
        }
        if(is_array($userCVDetails['education'])){
            $pDis=$pDis++;
            $userDisplayCVDetails['education']=$userCVDetails['education'][0];
        }
        
        return $userDisplayCVDetails;
  }

  
 public function actionupdatePersonalInformationByType(){
     try {
         if(isset($_REQUEST['value'])){
             $value=$_REQUEST['value'];
             $type=$_REQUEST['field'];             
             $userId = $this->tinyObject['UserId'];
             if($type=='Company' || $type=='DisplayName'){                 
                 $result=ServiceFactory::getSkiptaUserServiceInstance()->updateUserProfileDetails($userId, $type, $value);
                 if($type=='DisplayName'){                     
                                $this->tinyObject['DisplayName']=$value;
                }
             }else{
               $result=ServiceFactory::getSkiptaUserServiceInstance()->updatePersonalInformationByType($value,$type,$userId);     
             }             
//            if($result=='success'){
//                if($type=='DisplayName'){
//                unset($this->tinyObject->DisplayName);
//                $this->tinyObject->DisplayName=$value;
//                }
//                error_log("--------------DN-------------------".$this->tinyObject->DisplayName);
//            }
         
             $results = array("status" => $result,'type'=>$type,'value'=>$value);
            echo $this->rendering($results);
             
         }
     } catch (Exception $exc) {
         error_log("#########Excep==**====".$exc->getMessage());
     }
  } 
  
  public function actionRemoveSectionFromCV() {
  try{
       $Id = $_REQUEST['Id'];
        $Category = $_REQUEST['category'];
          $orgId = $_REQUEST['orgId'];

       ServiceFactory::getSkiptaUserServiceInstance()->updateUserCVStatusBySection($Category,$Id,$this->tinyObject->UserId,$orgId);
      
  } catch (Exception $ex) {
Yii::log("************Exception ".$ex->getMessage());
  }
       
         
  }
  
  
  public function actionSettings(){
        $error = "";
        $message = "";

        $UserSettingsForm = new UserSettingsForm;
        $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;
        $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userid);
        $UserSettingsForm->firstName=$data["FirstName"];
        $UserSettingsForm->lastName=$data["LastName"];
        $UserSettingsForm->country=$data["Country"];
        $UserSettingsForm->state=$data["State"];
        $UserSettingsForm->city=$data["City"];
        $UserSettingsForm->zip=$data["Zip"];
        $UserSettingsForm->email=$data["Email"];
        $UserSettingsForm->companyName=$data["Company"];
        $countryId=$data["country"];
        try {

        } catch (Exception $exc) {
            Yii::log($exc->getMessage());
        }
     $changePasswordForm = new ChangePasswordForm;
     $this->render('settings',array('UserRegistrationForm'=> $UserSettingsForm,'ChangePasswordForm'=> $changePasswordForm,$countryId=>$countryId));
        
  }
  
  public function actionUpdateUserSettings(){
       $error = "";
        $message = "";
        try {
            if (isset($_POST['UserSettingsForm'])) {
                $UserSettingsForm ="[]";
                $UserSettingsForm= new UserSettingsForm;
                $errorUserSettingsForm = CActiveForm::validate($UserSettingsForm); 
                if ($errorUserSettingsForm != "[]") {
                    $obj = array('status' => 'fail', 'data' => '', 'error' => $errorUserSettingsForm);
                } else {
                    $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;
                    $oldUserObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userid);
                   $UserSettingsForm['email']=trim($UserSettingsForm['email']);
                    $email = $UserSettingsForm['email'];
                    $userexist =array();
                    if(trim($oldUserObj['Email'])!=trim($UserSettingsForm['email'])){

                        $userexist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($UserSettingsForm['email']);  
                    }

                    if (count($userexist) > 0) {
                        if(isset($userexist->FromNetwork) && isset($userexist->AccessToken) && !empty($userexist->FromNetwork) && !empty($userexist->AccessToken) && Yii::app()->params['IsDSN']=='ON' )
                            {
                               $message = Yii::t('translation', 'User_Already_Exist_Network');
                               $message= str_replace("network",$userexist->FromNetwork." Network",$message);
                            }
                         else 
                             $message = Yii::t('translation', 'User_Already_Exist');
                        // $message ="User already exist with this Email Please  try with another  Email Address";
                        $obj = array('status' => 'fail', 'data' => $message, 'error' => $UserSettingsForm);
                    } else {
                        $Save_userInUserCollection = ServiceFactory::getSkiptaUserServiceInstance()->UpdateUserCollection($UserSettingsForm,$oldUserObj);       
                        if ($Save_userInUserCollection != 'error') {                   
                        $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userid);
                            $oldUserObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userid);
                            Yii::app()->session['TinyUserCollectionObj'] = $tinyUserCollectionObj;
                            $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($UserSettingsForm['email'], 'Email');
                            Yii::app()->session['UserStaticData'] = $userObj;
                            Yii::app()->session['Email'] = $UserSettingsForm['email'];
                            $message = Yii::t('translation', 'User_Updation_Success');

                            $obj = array('status' => 'success', 'data' => $message, 'error' => '');
                        } else {
                            $errormsg = Yii::t('translation', 'User_Updation_Fail');
                            // $errormsg="User registration failed";
                            $obj = array('status' => 'fail', 'data' => $errormsg, 'error' => '');
                        }
                    }
                }
                 echo $this->rendering($obj);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage());
        }

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
    
    public function actionChangePassword(){
         try {
            $model = new ChangePasswordForm;
            if (isset($_POST['ChangePasswordForm'])) {
                $model->attributes = $_POST['ChangePasswordForm'];
                $errors = CActiveForm::validate($model);
                $obj = array();
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                    $userid = Yii::app()->session['TinyUserCollectionObj']->UserId;
                    $result = ServiceFactory::getSkiptaUserServiceInstance()->userUpdatePasswodService($userid,$model);
                    if ($result == '0') {
                        $message = Yii::t('translation', 'ResetPasswordSuccess');
                        $obj = array('status' => 'success', 'data' => $message, 'success' => '');
                    } elseif ($result == '1') {
                        $message = Yii::t('translation', 'ResetPasswordUnSuccess');
                        $obj = array('status' => 'error', 'data' => $message, 'error' => '');
                    } else if ($result == '2') {
                        $message = Yii::t('translation', 'OldPasswordMatchesNewPassword');
                        $obj = array('status' => 'error', 'data' => $message, 'error' => '');
                    } else if ($result == '3') {
                        $message = Yii::t('translation', 'passwordIncorrect');
                        $obj = array('status' => 'error', 'data' => $message, 'error' => '');
                    }else {
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

      /**
        * @vamsi krishna
        * Below two methods are used for custom badges 
        */
  public function actiongetusersForCustomBadge(){
      try {
        $result = array();
            if (isset($_REQUEST['searchkey'])) {
                 
                $searchKey = $_REQUEST['searchkey'];                
                $badgeId = $_REQUEST['badgeId'];
                $mentionArray = isset($_REQUEST['existingUsers']) ? json_decode($_REQUEST['existingUsers']) : array();                
                $userId = $this->tinyObject['UserId'];
                $result = ServiceFactory::getSkiptaUserServiceInstance()->getAllUsersForCustomBadge($searchKey,  $badgeId,  $mentionArray);
            }
              $obj = $this->rendering($result);
            echo $obj;
      } catch (Exception $exc) {
          Yii::log($exc->getMessage(), 'error', 'application');
      }
    }

    public function actionsaveCustomBadgesToUser() {
        try {
            $badgeId=$_REQUEST['badgeId'];
            $atMentions=$_REQUEST['atMentions'];
            $atMentions = CommonUtility::prepareAtMentionsArray($atMentions);
            ServiceFactory::getSkiptaUserServiceInstance()->saveCustomBadgeToUser($badgeId,$atMentions);
             $obj = array('status' => 'success', 'badgeId' => $badgeId, 'error' => '');
              $renderScript = $this->rendering($obj);
        echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
/** custom badge end**/
 public function actiongetStoreUsers(){
     try {
         $storeId = $_REQUEST['storeId'];            
            $limit = 4;           
           $offset = ($_REQUEST['s_page'])*$limit;            
           
           $totalStoreUsers=  ServiceFactory::getSkiptaUserServiceInstance()->getUsersBYStoreId($storeId);
           if (count($totalStoreUsers) == 0) {
                $usersList = 0; //No Data
            } else if ($_REQUEST['s_page'] <= ceil(count($totalStoreUsers) / $limit)) {
               $usersList= (object)(ServiceFactory::getSkiptaUserServiceInstance()->getSoreUsersByPagination($storeId,$limit,$offset));
            } else {
                $usersList = -1; //No more data
            }
           
           
           $this->renderPartial('storeMembers', array('groupFollowers' => $usersList, 'offset' => $offset,'page'=>'postdetail','totalStoreUsers'=>count($totalStoreUsers)));
         
     } catch (Exception $exc) {
         Yii::log($exc->getMessage(), 'error', 'application');
     }
  } 
}

?>

