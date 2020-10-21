<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommonController extends Controller{
    
    public function init() {
        $this->initializeforms();
        if(isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])){
            parent::init();
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            $urlPath = $_SERVER['REQUEST_URI'];
            $urlArr = explode("/", $urlPath);
            //error_log("ur larrya------------".print_r($urlArr,1));
            if (isset($urlArr[2])) {
                $queryStringURl = explode("?", $urlArr[2]);
            }
            
            
            if(isset($queryStringURl[0]) && strtolower($queryStringURl[0]) == "postdetail"){
                
              $querySubStringArray = explode("=", $queryStringURl[1]);
              if($querySubStringArray[0] == "bundle"){
                    $this->redirect("/marketresearchview/1/".$querySubStringArray[1]);  
               }
               if($_REQUEST['categoryType'] == 9){
                   $this->redirect("/".$_REQUEST['postType']."/".$_REQUEST['postId']."/detail/game");   
               }
               else{
                    $referenceUserId = $_REQUEST['trfid'];
             if($_REQUEST['postType']==11){
                 $this->redirect(array('/news/postdetail', 'postId'=>$_REQUEST['postId'], 'categoryType'=>$_REQUEST['categoryType'],'postType'=>$_REQUEST['postType'],'outer'=>'true')); 
                
             }else if($_REQUEST['postType']==12){
                 $this->redirect(array('/game/gamedetail', 'postId'=>$_REQUEST['postId'], 'categoryType'=>$_REQUEST['categoryType'],'postType'=>$_REQUEST['postType'],'outer'=>'true'));
             }else{
                  $this->redirect(array('/post/postdetail', 'postId'=>$_REQUEST['postId'], 'categoryType'=>$_REQUEST['categoryType'],'postType'=>$_REQUEST['postType'],'outer'=>'true'));
               // $this->redirect(array('/news/postdetail', 'postId'=>$_REQUEST['postId'], 'categoryType'=>$_REQUEST['categoryType'],'postType'=>$_REQUEST['postType'],'outer'=>'true')); 
             } 
                }
                
               
                
            }
          
        }else{
            
            $this->sidelayout = 'no';
        }
  
    }
    
    
    
    
    
        public function actionUserCustomView()
{       
            
            
            
            
            try{
            $surveyGroupName = $_REQUEST['bundle'];
            $QuestionsSurveyForm = new QuestionsSurveyForm;
            $surveyObj = array();
            $scheduleId = "";
            $UserId = 0; // user not done the survey...
            $errmsg = "";
            if(!empty($surveyGroupName) != ""){
//                if($surveyGroupName == "public"){
//                        $surveyGroupName = "0";
//                    }
                    $schedulePattern = ServiceFactory::getSkiptaExSurveyServiceInstance()->isAlreadyDoneByUser($UserId,$surveyGroupName);            
                    $schedulePatternArr = explode("_",$schedulePattern);    
                    $scheduleId = $schedulePatternArr[1];                    
                    $surveyId = $schedulePatternArr[2];
                    $page=1;
                    if($scheduleId != "notscheduled"){
                        $surveyObjArray = ServiceFactory::getSkiptaExSurveyServiceInstance()->getCustomSurveyDetailsById('Id',$surveyId,$scheduleId,$page);            
                        $surveyObj = $surveyObjArray["extObj"];
                    }else{
                        $errmsg = Yii::t("translation","Ex_Msg_Noschedules");
                    }
                
            }else{
                $errmsg = Yii::t("translation","Ex_Msg_NOTVALID");
            }   
            $this->renderPartial('userView',array("surveyObj"=>$surveyObj,"QuestionsSurveyForm"=>$QuestionsSurveyForm,"scheduleId"=>$scheduleId,"errMessage"=>$errmsg,"userId"=>$UserId,"sessionTime"=>"","spotMessage"=>"","flag"=>"","iValue"=>1,"page"=>1,"bufferAnswers"=>array()));
            
            
        } catch (Exception $ex) {
            error_log("############Exception Occurred while rendering a view###########".$ex->getMessage());
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
    public function actionPrivacyPolicy(){
         if(!isset($_REQUEST['mobile'])){
            $this->renderPartial('mobilePrivacyPolicy'); 
        }
         else if(!Yii::app()->request->isAjaxRequest){
              $this->render('privacyPolicy');
         }else{
              $this->renderPartial('privacyPolicy');
         }
    }
    public function actionTermsOfServices(){
         if(!isset($_REQUEST['mobile'])){
            $this->renderPartial('mobileTermsOfServices'); 
        }
         else if(!Yii::app()->request->isAjaxRequest){
              $this->render('termsOfServices');
         }else{
              $this->renderPartial('termsOfServices');
         }
        
    }
    public function actionAboutUs(){
         if(!Yii::app()->request->isAjaxRequest){
              $this->render('aboutus');
         }else{
              $this->renderPartial('aboutus');
         }
    }
     public function actionMobile(){
        if(!Yii::app()->request->isAjaxRequest){
              $this->render('mobile');
         }else{
              $this->renderPartial('mobile');
         }
    }
    public function actionContactUs(){
        if(!Yii::app()->request->isAjaxRequest){
              $this->render('contactus');
         }else{
              $this->renderPartial('contactus');
         }
    }
    
    /**
     * @author Karteek.V
     */
     public function actionPostDetail() {
        $forgotModel = new ForgotForm();  
        try{    error_log("____________dddddddd_____________________________");
             $model = new LoginForm;
             $UserRegistrationForm = new UserRegistrationForm;
             $countries = ServiceFactory::getSkiptaUserServiceInstance()->GetCountries(); 
             if(isset($_REQUEST['trfid']) && !empty($_REQUEST['trfid'])){
                $postId = $_REQUEST['postId'];
                $categoryType = $_REQUEST['categoryType'];
                $postType = $_REQUEST['postType'];
                $referenceUserId = $_REQUEST['trfid'];
                $returnValue = CommonUtility::getURLString($categoryType);
                $this->redirect($returnValue."/".$postId."/".$referenceUserId);
             }elseif(isset($_REQUEST['post']) && !empty($_REQUEST['post'])){
                 $categoryType=1;
                 $b = (int)$_REQUEST['b'];
                 $p = (int)$_REQUEST['p'];
                 if($b==0 && $p==0){
                     $categoryType=3;
                 }
                 $categoryType = (int)$_REQUEST['categoryType'];
                 $postObj = ServiceFactory::getSkiptaPostServiceInstance()->getPostIdByMigratedPostId($categoryType, $_REQUEST['post']);
                 $postId = (string)($postObj->_id);
                 $postType = $postObj->Type;
                 $referenceUserId = '1';
             }else{
                 $categoryType=1;
                 $b = (int)$_REQUEST['b'];
                 $a = (int)$_REQUEST['a'];
                 if($a==0 && $b==0){
                     $categoryType=2;
                 }
                 $categoryType = (int)$_REQUEST['categoryType'];
                 $postObj = ServiceFactory::getSkiptaPostServiceInstance()->getPostIdByMigratedPostId($categoryType, $_REQUEST['postid']);
                 $postId = (string)($postObj->_id);
                 $postType = $postObj->Type;
                 $referenceUserId = '1';
             }
             
        if(!isset(Yii::app()->session['TinyUserCollectionObj'])){   
            
                $this->render('/site/postdetail', array('model' => $model,'UserRegistrationModel' => $UserRegistrationForm,'countries' => $countries,"forgotModel"=>$forgotModel,'postId'=>$postId,'categoryType'=>$categoryType,'postType'=>$postType,'referenceUserId'=>$referenceUserId));
            
        }else{
            $this->render('/post/postdetail', array('postId'=>$postId,'categoryType'=>$categoryType,'postType'=>$postType));
        }
        } catch (Exception $exc) {
            Yii::log("++++++++++++++++++++++++++++++++".$exc->getMessage(), 'error', 'userController');
        }
        
            

    }
    
    public function actionRenderPostDetailed() {
        try {  
            if (isset($_REQUEST['load'])) {
                $data = explode('_', $_REQUEST['load']);
                $categoryType = $data[0];
                $postId = $data[1];
                $postType = $data[2];
            } else {                
                $postId = $_REQUEST['postId'];
                $categoryType = $_REQUEST['categoryType'];
                $postType = $_REQUEST['postType'];
            }  
            $curbsideCategory = array();
            $object = array();
            $tinyUserProfileObject = array();
            $MoreCommentsArray = array();
            if ($categoryType == 1 && $postType != 5) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getPostObjectById($postId,1);
            } else if ($postType == 5) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getCurbsidePostObjectById($postId,1);
                $curbsideCategory = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($object->CategoryId);
                
            } else if ($postType == 2 || $categoryType == 3 || $categoryType == 7) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getGroupPostObjectById($postId,1);
                $groupStatus=ServiceFactory::getSkiptaGroupServiceInstance()->getGroupStatus($object->GroupId);
            if(!is_string($groupStatus)){
                $object['Status']=$groupStatus->Status;
            }
            }
            if(isset($object) && !empty($object)){
            $UserId = $object->UserId;
            $tinyUserProfileObject = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($UserId);
            if(isset($object->WebUrls)){
             if(isset($object->IsWebSnippetExist)&& $object->IsWebSnippetExist=='1'){            
                     $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($object->WebUrls[0]);
                     $object->WebUrls=$snippetdata;
                }else{
                     $object->WebUrls="";
                }
            }
         //This code is for get post all comment and prepare comments data with web snippets  
            
             $MinpageSize = 2;
       // $page = $_REQUEST['Page'];
        $page=0;
        $pageSize = ($MinpageSize * $page);
        $categoryType = (int) $categoryType;
        
        $numberOfComments=5;
        $MoreCommentsArray = CommonUtility::prepareComments($pageSize, $MinpageSize, $postId, $categoryType, "",$numberOfComments);
         
        $status = 1;
            
            }else{
                $object = 0;
                $status = 0;
            }
            
          // END ----------------------------------------------------------  
            if (isset($_REQUEST['load'])) {
                $this->render("/post/postDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType, "curbsideCategory" => $curbsideCategory,'commentsdata'=>$MoreCommentsArray));
            } else {
                $this->renderPartial("postDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType, "curbsideCategory" => $curbsideCategory,'commentsdata'=>$MoreCommentsArray,"status"=>$status,'timezone'=>$_REQUEST['timezone']));
            }
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
    }
 
    public function actionGetFooterTabsData() {
        try{            
            if(isset($_REQUEST['type'])){
                
                $pageType=$_REQUEST['type'];
            }
             //   $this->renderPartial('termsOfServices');
                 $this->renderPartial($pageType);
     
    }  catch (Exception $ex) {
        error_log("^^^&Exception&&&&".$ex->getMessage());
            Yii::log($ex->getMessage(), "error", "application");
        }
    }
    
      
    /**
     * @Author swathi
     * This method is used to get the joyrideInfo by module name
     * @param: 'searchkey' is the string.
     */
    public function actionGetJoyrideDetails() {
        try {
              if (isset($_POST['moduleName'])) {

                $moduleName = $_REQUEST['moduleName'];
                $result = array(); 
                $result = ServiceFactory::getSkiptaPostServiceInstance()->getJoyrideDetailsByModule($moduleName);
                $this->renderPartial('joyride', array('joyrideInfo' => $result));
              }
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetJoyrideDetails==" . $ex->getMessage(), "error", "application");
        }
    }
    
    public function actionEnableOrDisableJoyRide()
    {
        try {
               if (isset($_POST['action'])) {
                  
                      $response = ServiceFactory::getSkiptaPostServiceInstance()->enableOrDisableJoyRide($_POST['action'],Yii::app()->session['UserStaticData']->UserId);
                       if($_POST['action']==0)
                            {
                                //enable joyride //update the tourguide status
                              $updateUserStatusOfOpportunity= ServiceFactory::getSkiptaPostServiceInstance()->updateTourGuideStatusByUserId(Yii::app()->session['UserStaticData']->UserId);
                            }
                                       if($response){
                         
                           Yii::app()->session['UserStaticData']->disableJoyRide=$_POST['action'];
                                                    
                        $obj = array("status"=>"success","data"=>"","error"=>"");    
                      }else{
                            $obj = array("status"=>"failure","data"=>"","error"=>"");
                      }
                       echo $this->rendering($obj);

                          }
            
            
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in actionEnableOrDisableJoyRide==" . $exc->getMessage(), "error", "application");
        }
        }

        public function actionRenderPostDetailForCareer() {
        try {
            $jobId = $_REQUEST['id']; 
                $jobDetails = ServiceFactory::getSkiptaCareerServiceInstance()->getJobdetails($jobId);             
            if (!is_string($jobDetails)) {
                 $appendData = ' <span class="careerpostdetail tooltiplink" data-id=' .  $job['id']. 'data-postid="' . $job['JobId'] . '" data-categoryType="12" data-postType="12"> <i class="fa  moreicon moreiconcolor">'.Yii::t('translation','Readmore').'</i></span>';
             if(isset($jobDetails[0]['JobDescription'])){
                 $description = CommonUtility::truncateHtml(htmlspecialchars_decode($jobDetails[0]['JobDescription']), 240, 'Read more', true, true, $appendData);
             $jobDetails[0]['JobDescription']=$description;}
                $this->renderPartial('careerdetailedpage', array('jobDetails' => $jobDetails));
            }
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
      public function actionRenderNewsDetailedPage(){
        try {  
            if (isset($_REQUEST['load'])) {
                $data = explode('_', $_REQUEST['load']);
                $categoryType = $data[0];
                $postId = $data[1];
                $postType = $data[2];
            } else {                
                $postId = $_REQUEST['postId'];
                $categoryType = $_REQUEST['categoryType'];
                $postType = $_REQUEST['postType'];
            }
//            $postId = $_REQUEST['postId'];
//            $categoryType = $_REQUEST['categoryType'];
//            $postType = $_REQUEST['postType'];    
           // $id = $_REQUEST['id'];
            $mainGroupCollection="";
            $MoreCommentsArray = array();
            $tinyUserProfileObject = array();
            $object = array();
            $object = ServiceFactory::getSkiptaPostServiceInstance()->getNewsObjectById($postId);
            $streamMessage = "";
            $streamMessage = CommonUtility::getStreamNote($categoryType, $postType, "Post", 0, 0, "", "");
           
            
            $streamMessage = $streamMessage." ".CommonUtility::styleDateTime($object["CreatedOn"]->sec); 
            if(isset($object) && !empty($object)){
            $UserId = $object->UserId;
            $tinyUserProfileObject = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($UserId);
            if(isset($object->WebUrls)){
             if(isset($object->IsWebSnippetExist)&& $object->IsWebSnippetExist=='1'){            
                     $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($object->WebUrls[0]);
                     $object->WebUrls=$snippetdata;
                }else{
                     $object->WebUrls="";
                }
            }
         //This code is for get post all comment and prepare comments data with web snippets  
            
             $MinpageSize = 2;
        $page=0;
        $pageSize = ($MinpageSize * $page);
        $categoryType = (int) $categoryType;
        $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforNews($postId);
         $commentDisplayCount = 0;
         if(isset($result) && sizeof($result)>0){
              $rs=array_reverse($result);
        foreach ($rs as $key => $value) {
            if(!(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist']==1)){
                $commentUserBean = new CommentUserBean();
                $userDetails = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($value['UserId']);
                $createdOn = $value['CreatedOn'];
                $commentUserBean->UserId = $userDetails['UserId'];

                $postId = (isset($value["PostId"])) ? $value["PostId"] : '';
                $CategoryType = (isset($value["CategoryType"])) ? $value["CategoryType"] : '';
                $PostType = (isset($value["PostType"])) ? $value["PostType"] : '';
                    $value["CommentText"] = $value["CommentText"];
                $commentUserBean->CommentText = $value['CommentText'];
                if(is_int($createdOn))
                {
                    $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn);
                }
                else if(is_numeric($createdOn))
                {
                    $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn);
                }
                else
                {
                    
                    $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn->sec);
                }

                $commentUserBean->DisplayName = $userDetails['DisplayName'];
                $commentUserBean->ProfilePic = $userDetails['profile70x70'];
                $commentUserBean->CategoryType = $CategoryType;
                $commentUserBean->PostId = $postId;
                $commentUserBean->Type = $PostType;
                $commentUserBean->Resource=$value['Artifacts'];
                $commentUserBean->ResourceLength = count($value['Artifacts']);
                //$commenturls=$value['WebUrls'];
                if (array_key_exists('WebUrls', $value)) {
                 if(isset($value['WebUrls']) && is_array($value['WebUrls']) && count($value['WebUrls'])>0){
                     
                      $commenturls=$value['WebUrls'];
                         $WeburlObj = ServiceFactory::getSkiptaPostServiceInstance()->CheckWebUrlExist($commenturls[0]);
                     
                         if($WeburlObj!='failure'){
                               $snippetData=$WeburlObj;
                          }else{
                              
                              $snippetData="";
                          }
                        }else{
                            
                            $snippetData="";
                        }
                    $commentUserBean->snippetdata = $snippetData;
                     if(isset($value['IsWebSnippetExist'])){
                         $commentUserBean->IsWebSnippetExist = $value['IsWebSnippetExist'];
                    }else{
                         $commentUserBean->IsWebSnippetExist = "";
                    }
                  }

                array_push($MoreCommentsArray, $commentUserBean);
                 $commentDisplayCount++;
                  if($commentDisplayCount==5){
                                break;
                     }
                
            }

        }
         }
        }else{
            $object = 0;            
        }
        $commentedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getCommentedUsersForPost($postId, (int)($this->tinyObject['UserId']));
        $IsUserCommented = in_array((int)($this->tinyObject['UserId']), $commentedUsers);
        
         if (isset($_REQUEST['load'])) {
              $this->renderPartial("/news/newsDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented,'StreamMessage'=>$streamMessage));
            } else {
               $this->renderPartial("newsDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented,'StreamMessage'=>$streamMessage));
            }
        
       // $this->renderPartial("newsDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented));
       // $userId = $this->tinyObject['UserId'];  
        //ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId,"Post","PostDetailOpen",$postId,$categoryType,$postType);

        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
    }
     public function actionRenderGameDetails(){
        try {

            if (isset($_REQUEST['load'])) {
                $urlArray = explode('_', $_REQUEST['load']);
                $gameName = $urlArray[1];
                $gameScheduleId = $urlArray[2];
                $mode = $urlArray[3];
            } else {
                $gameName = $_REQUEST['postType'];
                $gameScheduleId = $_REQUEST['postId'];
                $mode = 'detail';
            }

            $MoreCommentsArray = array();
            $tinyUserProfileObject = array();
            $object = array();
            $gameDetailsArray = ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByName($this->tinyObject->UserId, $gameName, $gameScheduleId);

            $postId = $gameDetailsArray[0]->_id;
            
            $MinpageSize = 2;
            // $page = $_REQUEST['Page'];
            $page = 0;
            $pageSize = ($MinpageSize * $page);
            $categoryType = 9;
            $numberOfComments=5;
            $MoreCommentsArray = CommonUtility::prepareComments($pageSize, $MinpageSize, $postId, $categoryType, "",$numberOfComments);

            $commentedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getCommentedUsersForPost($postId, (int) ($this->tinyObject['UserId']));
            $IsUserCommented = in_array((int) ($this->tinyObject['UserId']), $commentedUsers);
            $this->renderPartial('gameDetail', array("gameDetails" => $gameDetailsArray[0], "gameBean" => $gameDetailsArray[1], "mode" => $mode, 'commentsdata' => $MoreCommentsArray, 'IsCommented' => $IsUserCommented));
        } catch (Exception $exc) {
            Yii::log('In Excpetion Game Wall'.$exc->getMessage(),'error','application');
        }

        
    }
 
      public function actionGetOauthNetworks()
  {
      try
      {
           $providersData= ServiceFactory::getSkiptaUserServiceInstance()->getAllOauthProviderDetails();
           if($providersData!="failure" && count($providersData)>0)
                $this->renderPartial('oauthNetworks', array('oAuthNetworksInfo' => $providersData));
           else
               echo 0;
      } catch (Exception $ex) {
          Yii::log("Exception Occurred in actionGetOauthNetworks==" . $ex->getMessage(), "error", "application");
      }
  }
 public function actionProfileDetails(){
    try {
         
    $urlArray =  explode("/", Yii::app()->request->url);
   error_log( "in commonnnnnnnnnnnnnnnnnnn 1111");
        $isUser=0;
        $userProfileId='';
        $loggedInUserId=null;
        $profileModel = new ProfileDetailsForm();
        $UserProfileModel=new UserProfileDetailsForm();
        $userInterests=array();
        error_log( "in commonnnnnnnnnnnnnnnnnnn 222");
        $CustomFields= ServiceFactory::getSkiptaUserServiceInstance()->getCustomSubSpeciality(); 
        $States= ServiceFactory::getSkiptaUserServiceInstance()->getCustomSubSpeciality(); 
       error_log( "in commonnnnnnnnnnnnnnnnnnn 333");
        $this->layout='userLayout';
        $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];  
        if(isset($this->tinyObject)){
              $loggedInUserId=$this->tinyObject->UserId;
              $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
              
        }
       $userProfileId =  ServiceFactory::getSkiptaUserServiceInstance()->getUserIdbyName($urlArray[2]);
 
       
       if($loggedInUserId==$userProfileId){
          $isUser = 1;    
        }
             error_log( "in commonnnnnnnnnnnnnnnnnnn 444444444444444444");       
        $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetails($userProfileId,$loggedInUserId); 
        $displayName=$this->tinyObject->DisplayName;
        error_log( "in commonnnnnnnnnnnnnnnnnnn 555555555555555555");
        $userProfileDetails=ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userProfileId); 
      //  echo $userProfileId;
        
         $UserData = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileByUserId($userProfileId);
         $States=State::model()->GetStateByUsingCountryId($UserData['Country']);
        $displayName=$userProfileDetails->DisplayName;
        $userBadges=ServiceFactory::getSkiptaUserServiceInstance()->getUserBadgesData($userProfileId);
        $userFollowingHashtags=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingHashtagsDataForProfile($userProfileId);
        $userFollowingGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingGroupsDataForProfile($userProfileId,$loggedInUserId);
       // $userFollowingSubGroups=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingSubGroupsData($userProfileId,$loggedInUserId);        
        $userFollowingCategories=ServiceFactory::getSkiptaUserServiceInstance()->getUserFollowingCurbsideCategoriesDataForProfile($userProfileId);
        $userFollowing=  ServiceFactory::getSkiptaUserServiceInstance()->getFollowersAndFollowing($userProfileId,'userFollowing');
        $userFollowers=  ServiceFactory::getSkiptaUserServiceInstance()->getFollowersAndFollowing($userProfileId,'userFollowers');        
        
      error_log( "in commonnnnnnnnnnnnnnnnnnn 5555555555");
        $userCVDetails=ServiceFactory::getSkiptaUserServiceInstance()->getUserCVDetails($userProfileId);
       
        $ExperiencePriority = "";
            $EducationPriority = "";
            $InterestPriority = "";
            $AchievementPriority = "";
            $PublicationPriority = "";
          
            if (isset($userCVDetails['education']) && is_array($userCVDetails['education'])) {
                foreach ($userCVDetails['education'] as $key => $value) {
                    $EducationPriority = $value['Education_Priority'];
                }
            }
            if (isset($userCVDetails['achievements']) && is_array($userCVDetails['achievements'])) {
                foreach ($userCVDetails['achievements'] as $key => $value) {

                    $AchievementPriority = $value['Achievement_Priority'];
                }
            }
            $experienceIds = array();
            if (isset($userCVDetails['experience']) && is_array($userCVDetails['experience'])) {
                foreach ($userCVDetails['experience'] as $key => $value) {

                    $ExperiencePriority = $value['Experience_Priority'];
                }
            }
            $interestIds = array();
            if (isset($userCVDetails['interests']) && is_array($userCVDetails['interests'])) {
                foreach ($userCVDetails['interests'] as $key => $value) {

                    $InterestPriority = $value['Interest_Priority'];
                }
            }
            $publicatioIds = array();
            if (isset($userCVDetails['publications']) && is_array($userCVDetails['publications'])) {
                foreach ($userCVDetails['publications'] as $key => $value) {

                    $PublicationPriority = $value['Publication_Priority'];
                }
            }error_log( "in commonnnnnnnnnnnnnnnnnnn 6666666666666");
            $priorityArray = array();
            $EducationPriority = ($EducationPriority == null) ? '0' : $EducationPriority;
            $InterestPriority = ($InterestPriority == null) ? '2' : $InterestPriority;
            $ExperiencePriority = ($ExperiencePriority == null) ? '1' : $ExperiencePriority;
            $AchievementPriority = ($AchievementPriority == null) ? '4' : $AchievementPriority;
            $PublicationPriority = ($PublicationPriority == null) ? '3' : $PublicationPriority;
            $priorityArray[$AchievementPriority] = 'achievements';
            $priorityArray[$InterestPriority] = 'interests';
            $priorityArray[$EducationPriority] = 'education';
            $priorityArray[$ExperiencePriority] = 'experience';
            $priorityArray[$PublicationPriority] = 'publications';
          error_log( "in commonnnnnnnnnnnnnnnnnnn 77777777777777");
            ksort($priorityArray);
        
        
        $userInteractionsCount=  ServiceFactory::getSkiptaUserServiceInstance()->getUserInteractionsCount($userProfileId);
        $userDisplayCVDetails=array();
        $pDis=1;
        
       // print_r($priorityArray);
         for ($r = 0; $r < sizeof($priorityArray); $r++) {
              if(isset($userCVDetails[$priorityArray[$r]]) && is_array($userCVDetails[$priorityArray[$r]]) && $pDis<=2){
                $pDis=$pDis+1;
                if($priorityArray[$r]=='interests' || $priorityArray[$r]=='achievements'){
                    $userDisplayCVDetails[$priorityArray[$r]]=$userCVDetails[$priorityArray[$r]];
                }else{
                    $userDisplayCVDetails[$priorityArray[$r]]=$userCVDetails[$priorityArray[$r]][0];
                }
                
                
                if($priorityArray[$r]=='publications'){
                    $urlArr = explode("/",$userCVDetails['publications']['Files']);
                    $userDisplayCVDetails['publications']['Files'] = $urlArr[3];
                }
                
             }
             
        
         }
        
        error_log( "in commonnnnnnnnnnnnnnnnnnn 88888888");
//        if(isset($userCVDetails['publications']) && is_array($userCVDetails['publications']) && $pDis<=2){
//            $pDis=$pDis+1;
//            $userDisplayCVDetails['publications']=$userCVDetails['publications'][0];
//            if($userCVDetails['publications']['Files'] != ""){
//                $urlArr = explode("/",$userCVDetails['publications']['Files']);
//                $userDisplayCVDetails['publications']['Files'] = $urlArr[3];
//            }
//        }
//        if(isset($userCVDetails['experience']) && is_array($userCVDetails['experience']) && $pDis<=2){
//            $pDis=$pDis+1;
//            $userDisplayCVDetails['experience']=$userCVDetails['experience'][0];
//        }
//        
//        if(isset($userCVDetails['interests']) &&is_array($userCVDetails['interests']) && $pDis<=2){
//            $pDis=$pDis+1;
//            $userDisplayCVDetails['interests']=$userCVDetails['interests'];
//        }
//        
//        if(isset($userCVDetails['education']) && is_array($userCVDetails['education']) && $pDis<=2 ){
//            $pDis=$pDis+1;
//            $userDisplayCVDetails['education']=$userCVDetails['education'][0];
//        }
//
//        if(isset($userCVDetails['achievements']) && is_array($userCVDetails['achievements']) && $pDis<=2 ){
//            $pDis=$pDis+1;
//            $userDisplayCVDetails['achievements']=$userCVDetails['achievements'];
//        }
       $redirectview=isset(Yii::app()->session['TinyUserCollectionObj']['UserId'])?"/user/userProfileDetails" :"userProfileDetails";
        $this->render($redirectview,array('profileDetails'=>  $data,'profileModel'=>$profileModel,'IsUser'=>$isUser,'loginUserId'=>  $this->tinyObject->UserId,'userFollowingHashtags'=>$userFollowingHashtags , 'userFollowingGroups'=>$userFollowingGroups, 'userFollowingCategories'=>$userFollowingCategories, 'userFollowingSubGroups'=>$userFollowingSubGroups, 'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId'],'userFollowers'=>$userFollowers,'userFollowing'=>$userFollowing,'displayName'=>$displayName,"userBadges"=>$userBadges,"userCVDetails"=>$userDisplayCVDetails,"userInteractionsCount"=>$userInteractionsCount,'OrderArray'=>$priorityArray,'UserProfileModel'=>$UserProfileModel,'CustomFields'=>$CustomFields,'States'=>$States,'UserData'=>$UserData));
    } catch (Exception $exc) {  
        error_log("+++++++++++++++++++++++++++++++++".$exc->getMessage());
        Yii::log($exc->getMessage(),'error','application');
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
              $userId = isset(Yii::app()->session['TinyUserCollectionObj']['UserId'])?Yii::app()->session['TinyUserCollectionObj']['UserId']:0;
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
            $redirectview=isset(Yii::app()->session['TinyUserCollectionObj']['UserId'])?"/user/profile_intractions_view" :"profile_intractions_view";
           $this->renderPartial($redirectview,array('stream'=>$stream,'totalCount'=>$provider->getTotalItemCount()-8,'page'=>'profile'));
        }
        }catch(Exception $ex){
         Yii::log("************EXCEPTION at actionGetProfileIntractions*****************".$ex->getMessage(),'error','application');   
        }
        
    }
    
      public function actionMobileRedirect(){
          
          error_log($_REQUEST['Type']."");
        $this->layout = 'mobilelayout';  
        $this->render('mobileRedirect', array('type' => $_REQUEST['Type']));
    }
    
    /**
       * 
       * @param type $hecArray
       */
      
       public function actionProcessHecJob() {
        try {
error_log( "INSERTING==== NEWJOBID=====HEC JOB=================");
            $val = urldecode($_REQUEST['hecArray']);
            $data = json_decode($val);
            $return = Careers::model()->saveHecJobs($data);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    

    
  /**
   * @usage change lang based on user lang
   * 
   */
  
      public function actionChangeLang() {
        try {
            if (isset($_REQUEST['lang'])) {
                $lang = $_REQUEST['lang'];
                $sourceLang = $_REQUEST['sourceLang'];
                Yii::app()->language = $lang;
               // Yii::app()->sourceLanguage = $sourceLang;
                Yii::app()->session['language'] = Yii::app()->language;
               // Yii::app()->session['sourceLanguage'] = Yii::app()->sourceLanguage;

                $this->redirect('/');
            }
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetOauthNetworks==" . $ex->getMessage(), "error", "application");
        }
    }
    
    public function actionTranslateData() {
        try {
            $postId = $_REQUEST["postId"];
            $postType = (int)$_REQUEST["postType"];
            $categoryType = (int)$_REQUEST["categoryType"];
            $text = $_REQUEST['text'];
            $fromLanguage = $_REQUEST['fromLanguage'];
            $toLanguage = $_REQUEST['toLanguage'];
            $page = $_REQUEST['page'];
            $userId = $this->tinyObject->UserId;
            $networkId = $this->tinyObject->NetworkId;
            $segmentId = $this->tinyObject->SegmentId;
            $obj = array();
            if(isset($postId) && !empty($postId) && isset($text) && !empty($text)){
                $translatedBean = new TranslatedDataBean();
                $translatedBean->PostId = $postId;
                $translatedBean->PostType = $postType;
                $translatedBean->CategoryType = $categoryType;
                $translatedBean->Language = $toLanguage;
                $translatedObj = ServiceFactory::getSkiptaTranslatedDataService()->isTranslated($translatedBean);
                $updateRecord=false;
                if($postType==3){
                    $updateRecord = $translatedObj["OptionOne"]==null?true:false;
                }else if($postType==2){
                    $updateRecord = $translatedObj["Location"]==null?true:false;
                }else if($postType==11){
                    $updateRecord = ($translatedObj["Title"]==null || $translatedObj["Title"]=="")?true:false;
                }
                if(!(isset($translatedObj["PostText"])) || $updateRecord){
                    $translatedText = CommonUtility::translateData($text, $fromLanguage, $toLanguage);
                    $translatedBean->PostText = $translatedText;
                    $translatedBean->Title="";
                    if($postType==3){
                        $translatedBean->Title = CommonUtility::translateData($_REQUEST["title"], $fromLanguage, $toLanguage);
                        $translatedBean->OptionOne = CommonUtility::translateData($_REQUEST["optionOne"], $fromLanguage, $toLanguage);
                        $translatedBean->OptionTwo = CommonUtility::translateData($_REQUEST["optionTwo"], $fromLanguage, $toLanguage);
                        $translatedBean->OptionThree = CommonUtility::translateData($_REQUEST["optionThree"], $fromLanguage, $toLanguage);
                        if(isset($_REQUEST["optionFour"]) && !empty($_REQUEST["optionFour"])){
                            $translatedBean->OptionFour = CommonUtility::translateData($_REQUEST["optionFour"], $fromLanguage, $toLanguage);
                        }else{
                            $translatedBean->OptionFour = "";
                        }
                    }else if($postType==2){
                        $translatedBean->Title = CommonUtility::translateData($_REQUEST["title"], $fromLanguage, $toLanguage);
                        $translatedBean->Location = CommonUtility::translateData($_REQUEST["location"], $fromLanguage, $toLanguage);;
                    }else if($postType==11){//news
                        $translatedBean->Title = CommonUtility::translateData($_REQUEST["title"], $fromLanguage, $toLanguage);
                    }
                    ServiceFactory::getSkiptaTranslatedDataService()->saveTranslatedData($translatedBean);
                }else{
                    $translatedBean->PostText = $translatedObj["PostText"];
                    if($postType==3){
                        $translatedBean->Title = $translatedObj["Title"];
                        $translatedBean->OptionOne = $translatedObj["OptionOne"];
                        $translatedBean->OptionTwo = $translatedObj["OptionTwo"];
                        $translatedBean->OptionThree = $translatedObj["OptionThree"];
                        $translatedBean->OptionFour = $translatedObj["OptionFour"];
                    }else if($postType==2){
                        $translatedBean->Title = $translatedObj["Title"];
                        $translatedBean->Location = $translatedObj["Location"];
                    }else if($postType==11){//news
                        $translatedBean->Title = $translatedObj["Title"];
                    }
                }
                //PostId, PostType, CategoryType, FromLang, ToLang
                ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId, $page, "Translation", $postId, $categoryType, $postType, $networkId, "", $segmentId, $fromLanguage, $toLanguage);
                $obj = array("status"=>"success","bean"=>$translatedBean);
            }else{
                $obj = array("status"=>"fail");
            }
            
            echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetOauthNetworks==" . $ex->getMessage(), "error", "application");
        }
    }
    public function actionTranslateCommentData() {
        try {
            $postId = $_REQUEST["postId"];
            $postType = $_REQUEST["postType"];
            $commentId = $_REQUEST["commentId"];
            $categoryType = $_REQUEST["categoryType"];
            $text = $_REQUEST['text'];
            $fromLanguage = $_REQUEST['fromLanguage'];
            $toLanguage = $_REQUEST['toLanguage'];
            $page = $_REQUEST['page'];
            $userId = $this->tinyObject->UserId;
            $networkId = $this->tinyObject->NetworkId;
            $segmentId = $this->tinyObject->SegmentId;
            $translatedText="";
            if(isset($postId) && !empty($postId) && isset($text) && !empty($text)){
                $translatedBean = new TranslatedDataBean();
                $translatedBean->PostId = $postId;
                $translatedBean->PostType = $postType;
                $translatedBean->CategoryType = $categoryType;
                $translatedBean->Language = $toLanguage;
                $translatedBean->CommentId = $commentId;
                $translatedText = ServiceFactory::getSkiptaTranslatedDataService()->isCommentTranslated($translatedBean);
                if($translatedText=="false"){
                    $translatedText = CommonUtility::translateData($text, $fromLanguage, $toLanguage);
                    $translatedBean->CommentText = $translatedText;
                    ServiceFactory::getSkiptaTranslatedDataService()->saveTranslatedCommentData($translatedBean);
                }
                ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId, $page, "CommentTranslation", $postId, $categoryType, $postType, $networkId, $commentId, $segmentId, $fromLanguage, $toLanguage);
            }
            $obj = array("html"=>$translatedText);
            echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetOauthNetworks==" . $ex->getMessage(), "error", "application");
        }
    }
    public function actionTranslateGameData() {
        try {
            $gameId = $_REQUEST["gameId"];
            $postType = (int)$_REQUEST["postType"];
            $categoryType = (int)$_REQUEST["categoryType"];
            $gameName = $_REQUEST['gameName'];
            $gameDescription = $_REQUEST["gameDescription"];
            $fromLanguage = $_REQUEST['fromLanguage'];  
            $toLanguage = $_REQUEST['toLanguage'];
            $page = $_REQUEST['page'];
            $userId = $this->tinyObject->UserId;
            $networkId = $this->tinyObject->NetworkId;
            $segmentId = $this->tinyObject->SegmentId;
            $obj = array();
            if(isset($gameId) && !empty($gameId) && isset($gameName) && !empty($gameName)){
                $translatedBean = new TranslatedDataBean();
                $translatedBean->GameId = $gameId;
                $translatedBean->PostType = $postType;
                $translatedBean->CategoryType = $categoryType;
                $translatedBean->Language = $toLanguage;
                $translatedObj = ServiceFactory::getSkiptaTranslatedDataService()->isGameTranslated($translatedBean);
                $updateRecord = false;
                $updateRecord = $translatedObj["GameName"]==null?true:false;
                
                if(!(isset($translatedObj["GameName"])) || $updateRecord){
                    $translatedBean->GameName = CommonUtility::translateData($gameName, $fromLanguage, $toLanguage);
                    $translatedBean->GameDescription = CommonUtility::translateData($gameDescription, $fromLanguage, $toLanguage);
                    ServiceFactory::getSkiptaTranslatedDataService()->saveTranslatedData($translatedBean);
                }else{
                    $translatedBean->GameName = $translatedObj["GameName"];
                    $translatedBean->GameDescription = $translatedObj["GameDescription"];
                }
                ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId, $page, "Translation", $gameId, $categoryType, $postType, $networkId, $gameId, $segmentId, $fromLanguage, $toLanguage);
                $obj = array("status"=>"success","bean"=>$translatedBean);
            }else{
                $obj = array("status"=>"fail");
            }
            
            echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionGetOauthNetworks==" . $ex->getMessage(), "error", "application");
        }
    }
      public function actionCheckUserLoginStatus(){
       
        $this->layout="hdsUserlayout";
        $message=Yii::t('translation', 'Password_Setup_invalid_link');
        $UserDetails = ServiceFactory::getSkiptaUserServiceInstance()->geHDSUserDetailsByUserId($_REQUEST['Id']);
          if (is_object($UserDetails)) {
              if(Yii::app()->session['LoginUserEmail']==$UserDetails->Email){
                   $this->redirect('/stream');
              }else{
                 
                  $this->render('passwordSetup_message', array('message' => $message));
              }
              
          }
           
    }

/**
* Author Haribabu
* @param type $hecArray
 * This method is used to update the Hec jobs Status.
*/
      
 public function actionUpdateHecJobStatus() {
        try {
            $return = Careers::model()->updateHecJobsStatus();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
      /**
      * Moin Hussain
      */
     public function actionLatestPostDetailPage(){
     try{
         error_log("---actionLatestPostDetailPage------------------------");
          $urlPath = $_SERVER['REQUEST_URI'];
          $urlArr = explode("/", $urlPath); 
          error_log(print_r($urlArr,1));
          $categoryType = $urlArr[1];
          $categoryId = 0;
          switch ($categoryType) {
            case "posts":
               $categoryId = 1;
              
                break;
            case "curbsideconsult":
               $categoryId = 2;
                break;
            case "groups":
               $categoryId = 3;
                break;
             case "subgroups":
               $categoryId = 7;
                break;
             case "careers":
               $categoryId = 15;
                break;
             case "newsdetail":
               $categoryId = 8;
                break;
             case "games":
               $categoryId = 9;
                break;
           
        }
          $postId = $urlArr[2];
         
          if($categoryId != 0){
               $postType = CommonUtility::getPostType($postId,$categoryId);
              $this->loadDetailPage($postId,$postType,$categoryId);
          }
   } catch (Exception $ex) {    
      Yii::log("CommonController:actionLatestPostDetailPage::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
     }
          
     }
     /**
      * Moin Hussain
      * @param type $postId
      * @param type $postType
      * @param type $categoryType
      * @return type
      */
      public function loadDetailPage($postId, $postType, $categoryType) {
        try {


            error_log("loadDetailPage---" . $postId . "---" . $postType . "---" . $categoryType);

            if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
                $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
                if ($categoryType == 15) {
                    $jobDetails = ServiceFactory::getSkiptaCareerServiceInstance()->getJobdetails($postId,$this->tinyObject['UserId']);
                    if (!is_string($jobDetails)) {
                        $this->render('/career/renderCareerDetailPage', array('jobDetails' => $jobDetails));
                    }
                    return;
                }
                if ($categoryType == 8) {
                    $obj = ServiceFactory::getSkiptaPostServiceInstance()->latestNewsDetailPage($postId, $postType, $categoryType);
                    $this->render("/news/newsDetailedPage", $obj);
                    return;
                }
                if ($categoryType == 9) {
                    $this->latestGameDetailPage($postId, $postType, $categoryType);
                    return;
                }
                $loggedInUserId = $this->tinyObject['UserId'];
                $IsLoadRequest = 0;
                $translate = 0;

                $isPostManagement = 0;
                if (isset($_REQUEST['isPostManagement'])) {
                    $isPostManagement = 1;
                }

                $UserPrivileges = $this->userPrivileges;
                $timezone = Yii::app()->session['timezone'];
                $recentActivity = '';
                $object = CommonUtility::preparePostDetailData($postId, $postType, $categoryType, $loggedInUserId, $IsLoadRequest, $UserPrivileges, $recentActivity, $timezone, $translate, $isPostManagement);

                $userId = $this->tinyObject['UserId'];
                $networkId = $this->tinyObject['NetworkId'];
                $segmentId = (int) $this->tinyObject['SegmentId'];
                ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId, "Post", "PostDetailOpen", $postId, $categoryType, $postType, $networkId, "", $segmentId);

                $canMarkAsAbuse = 0;
                if (is_array($UserPrivileges)) {
                    foreach ($UserPrivileges as $value) {
                        if ($value['Status'] == 1) {
                            if ($value['Action'] == 'Mark_As_Abuse') {
                                $canMarkAsAbuse = 1;
                            }
                        }
                    }
                }
                error_log("detai page-------------");
                if (isset($_REQUEST['load'])) {
                    $this->render("postDetailedPage", array("data" => $object, "canMarkAsAbuse" => $canMarkAsAbuse, "isPostManagement" => $isPostManagement,));
                } else {
                      error_log("detai pagesfsfs------------");
                    $this->render("/post/postDetailedPage", array("data" => $object, "isPostManagement" => $isPostManagement, "canMarkAsAbuse" => $canMarkAsAbuse, "userLanguage" => Yii::app()->session['language']));
                }
            } else {
                $this->outsideDetailPage($postId, $postType, $categoryType);
            }
        } catch (Exception $ex) {
            error_log("CommonController:loadDetailPage::". $ex->getMessage());
            Yii::log("CommonController:loadDetailPage::" . $ex->getMessage() . "--" . $ex->getTraceAsString(), 'error', 'application');
        }
    }

/**
 * Moin Hussain
 * @param type $postId
 * @param type $postType
 * @param type $categoryType
 */
public function latestGameDetailPage($postId,$postType,$categoryType){
     try {
            $urlArray = explode("/", Yii::app()->request->url);
            $urlPath = $_SERVER['REQUEST_URI'];
            $urlArr = explode("/", $urlPath);
            $gameName = $postType;
            $gameScheduleId = $postId;
            $mode = $urlArr[3];
            $MoreCommentsArray = array();
            $tinyUserProfileObject = array();
            $object = array();
            $gameDetailsArray = ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByName($this->tinyObject->UserId, $gameName, $gameScheduleId);
            //This code is for get post all comment and prepare comments data with web snippets  
//            if($gameDetailsArray=="failure"){
//                 $this->render('/user/error');
//            }
            //$categoryType = 9;
            $postId = $gameDetailsArray[0]->_id;
            $MinpageSize = 2;
            $page = 0;
            $pageSize = ($MinpageSize * $page);
            $numberOfComments = 5;
            $MoreCommentsArray = CommonUtility::prepareComments($pageSize, $MinpageSize, $gameDetailsArray[0]->_id, $categoryType, "", $numberOfComments);
            $commentedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getCommentedUsersForPost($postId, (int) ($this->tinyObject['UserId']));
            $IsUserCommented = in_array((int) ($this->tinyObject['UserId']), $commentedUsers);
            $lovefollowArray = CommonUtility::getLoveAndFollowUsers($this->tinyObject['UserId'], $gameDetailsArray[0]->Love, $gameDetailsArray[0]->Followers);
            $canMarkAsAbuse = 0;
            $UserPrivileges = $this->userPrivileges;
            if (is_array($UserPrivileges)) {
                foreach ($UserPrivileges as $value) {
                    if ($value['Status'] == 1) {
                        if ($value['Action'] == 'Mark_As_Abuse') {
                            $canMarkAsAbuse = 1;
                        }
                    }
                }
            }

            $this->render('/game/gameDetail', array("gameDetails" => $gameDetailsArray[0], "gameBean" => $gameDetailsArray[1], "mode" => $mode, 'commentsdata' => $MoreCommentsArray, 'IsCommented' => $IsUserCommented, "lovefollowArray" => $lovefollowArray, "canMarkAsAbuse" => $canMarkAsAbuse, 'userLanguage' => Yii::app()->session['language']));
        } catch (Exception $ex) {
            Yii::log("CommonController:latestGameDetailPage::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
}
/**
 * Moin Hussain
 * @param type $postId
 * @param type $postType
 * @param type $categoryType
 */
public function outsideDetailPage($postId,$postType,$categoryType){
        $urlPath = $_SERVER['REQUEST_URI'];
        $urlArr = explode("/", $urlPath);
        $referenceUserId = $urlArr[3];
        $forgotModel = new ForgotForm();
        $contactForm = new ContactUsForm();
        try {
            $model = new LoginForm;
            $UserRegistrationForm = new UserRegistrationForm;
            $countries = ServiceFactory::getSkiptaUserServiceInstance()->GetCountries();
            $this->render('/site/postdetail', array('model' => $model, 'UserRegistrationModel' => $UserRegistrationForm, 'countries' => $countries, "forgotModel" => $forgotModel, 'postId' => $postId, 'categoryType' => $categoryType, 'postType' => $postType, 'referenceUserId' => $referenceUserId, 'contactForm' => $contactForm));
        } catch (Exception $ex) {
            error_log("excepit------------" . $ex->getMessage());
            Yii::log("CommonController:outsideDetailPage::" . $ex->getMessage() . "--" . $ex->getTraceAsString(), 'error', 'application');
        }
    }
}
