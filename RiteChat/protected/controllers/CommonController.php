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
            if (isset($urlArr[2])) {
                $queryStringURl = explode("?", $urlArr[2]);
            }
            if(isset($queryStringURl[0]) && $queryStringURl[0] == "postdetail"){    
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
          
        }else{
            
            $this->sidelayout = 'no';
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
        try{    
             $model = new LoginForm;
             $UserRegistrationForm = new UserRegistrationForm;
             $countries = ServiceFactory::getSkiptaUserServiceInstance()->GetCountries(); 
             if(isset($_REQUEST['trfid']) && !empty($_REQUEST['trfid'])){
                $postId = $_REQUEST['postId'];
                $categoryType = $_REQUEST['categoryType'];
                $postType = $_REQUEST['postType'];
                $referenceUserId = $_REQUEST['trfid'];
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
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getPostObjectById($postId);
            } else if ($postType == 5) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getCurbsidePostObjectById($postId);
                $curbsideCategory = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($object->CategoryId);
                
            } else if ($postType == 2 || $categoryType == 3 || $categoryType == 7) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getGroupPostObjectById($postId);
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
        $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforPost($pageSize, $MinpageSize, $postId, (int) $categoryType);
        //  $Comments = ServiceFactory::getSkiptaPostServiceInstance()->getCommentObject($postId,(int)$categoryType); 
        // $TotalComments=count($Comments->Comments);
        
         $commentDisplayCount = 0;
        foreach ($result as $key => $value) {
          //  for($j=count($result);$j>0;$j--){ 
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
                $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn->sec);

                $commentUserBean->DisplayName = $userDetails['DisplayName'];
                $commentUserBean->ProfilePic = $userDetails['profile70x70'];
                $commentUserBean->CateogryType = $CategoryType;
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
           // }
        }
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
                       if($response){
                         
                           Yii::app()->session['UserStaticData']->disableJoyRide=$_POST['action'];
                                                    
                        $obj = array("status"=>"success","data"=>"","error"=>"");    
                      }else{
                            $obj = array("status"=>"failure","data"=>"","error"=>"");
                      }
                       echo $this->rendering($obj);

                          }
            
            
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in actionEnableOrDisableJoyRide==" . $ex->getMessage(), "error", "application");
        }
        }

        public function actionRenderPostDetailForCareer() {
        try {
            $jobId = $_REQUEST['id']; 
                $jobDetails = ServiceFactory::getSkiptaCareerServiceInstance()->getJobdetails($jobId);             
            if (!is_string($jobDetails)) {
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
                $commentUserBean->CateogryType = $CategoryType;
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
              $this->renderPartial("/news/newsDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented));
            } else {
               $this->renderPartial("newsDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented));
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
            $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforPost($pageSize, $MinpageSize, $gameDetailsArray[0]->_id, (int) 9);
            $MinpageSize = 2;
            // $page = $_REQUEST['Page'];
            $page = 0;
            $pageSize = ($MinpageSize * $page);
            $categoryType = (int) $categoryType;
            $commentDisplayCount = 0;
            if ($result != "failure" && count($result) > 0) {
                $rs = array_reverse($result);
                foreach ($rs as $key => $value) {
                    //  for($j=count($result);$j>0;$j--){ 
                    if (!(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist'] == 1)) {
                        $commentUserBean = new CommentUserBean();
                        $userDetails = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($value['UserId']);
                        $createdOn = $value['CreatedOn'];
                        $commentUserBean->UserId = $userDetails['UserId'];

                        $postId = (isset($value["PostId"])) ? $value["PostId"] : '';
                        $CategoryType = (isset($value["CategoryType"])) ? $value["CategoryType"] : '';
                        $PostType = (isset($value["PostType"])) ? $value["PostType"] : '';
                        $value["CommentText"] = $value["CommentText"];
                        $commentUserBean->CommentText = $value['CommentText'];
                        if (is_int($createdOn)) {
                            $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn);
                        } else if (is_numeric($createdOn)) {
                            $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn);
                        } else {
                            $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn->sec);
                        }

                        $commentUserBean->DisplayName = $userDetails['DisplayName'];
                        $commentUserBean->ProfilePic = $userDetails['profile70x70'];
                        $commentUserBean->CateogryType = $CategoryType;
                        $commentUserBean->PostId = $postId;
                        $commentUserBean->Type = $PostType;
                        $commentUserBean->Resource = $value['Artifacts'];
                        $commentUserBean->ResourceLength = count($value['Artifacts']);
                        //$commenturls=$value['WebUrls'];
                        if (array_key_exists('WebUrls', $value)) {
                            if (isset($value['WebUrls']) && is_array($value['WebUrls']) && count($value['WebUrls']) > 0) {

                                $commenturls = $value['WebUrls'];
                                $WeburlObj = ServiceFactory::getSkiptaPostServiceInstance()->CheckWebUrlExist($commenturls[0]);

                                if ($WeburlObj != 'failure') {
                                    $snippetData = $WeburlObj;
                                } else {

                                    $snippetData = "";
                                }
                            } else {

                                $snippetData = "";
                            }
                            $commentUserBean->snippetdata = $snippetData;
                            if (isset($value['IsWebSnippetExist'])) {
                                $commentUserBean->IsWebSnippetExist = $value['IsWebSnippetExist'];
                            } else {
                                $commentUserBean->IsWebSnippetExist = "";
                            }
                        }

                        array_push($MoreCommentsArray, $commentUserBean);
                        $commentDisplayCount++;
                        if ($commentDisplayCount == 5) {
                            break;
                        }
                    }
                    // }
                }
            }

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

        $isUser=0;
        $userProfileId='';
        $loggedInUserId=null;
        $profileModel = new ProfileDetailsForm();
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
        
        $data = ServiceFactory::getSkiptaUserServiceInstance()->getUserProfileDetails($userProfileId,$loggedInUserId); 

        
//        $displayName=$this->tinyObject->DisplayName;
        $userProfileDetails=ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userProfileId);       
//        $displayName=$userProfileDetails->DisplayName;
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
        if(isset($userCVDetails['publications']) && is_array($userCVDetails['publications']) && $pDis<=2){
            $pDis=$pDis+1;
            $userDisplayCVDetails['publications']=$userCVDetails['publications'][0];
            if($userCVDetails['publications']['Files'] != ""){
                $urlArr = explode("/",$userCVDetails['publications']['Files']);
                $userDisplayCVDetails['publications']['Files'] = $urlArr[3];
            }
        }
        if(isset($userCVDetails['experience']) && is_array($userCVDetails['experience']) && $pDis<=2){
            $pDis=$pDis+1;
            $userDisplayCVDetails['experience']=$userCVDetails['experience'][0];
        }
        
        if(isset($userCVDetails['interests']) &&is_array($userCVDetails['interests']) && $pDis<=2){
            $pDis=$pDis+1;
            $userDisplayCVDetails['interests']=$userCVDetails['interests'];
        }
        
        if(isset($userCVDetails['education']) && is_array($userCVDetails['education']) && $pDis<=2 ){
            $pDis=$pDis+1;
            $userDisplayCVDetails['education']=$userCVDetails['education'][0];
        }

        if(isset($userCVDetails['achievements']) && is_array($userCVDetails['achievements']) && $pDis<=2 ){
            $pDis=$pDis+1;
            $userDisplayCVDetails['achievements']=$userCVDetails['achievements'];
        }
       $redirectview=isset(Yii::app()->session['TinyUserCollectionObj']['UserId'])?"/user/userProfileDetails" :"userProfileDetails";
        $this->render($redirectview,array('profileDetails'=>  $data,'profileModel'=>$profileModel,'IsUser'=>$isUser,'loginUserId'=>  $this->tinyObject->UserId,'userFollowingHashtags'=>$userFollowingHashtags , 'userFollowingGroups'=>$userFollowingGroups, 'userFollowingCategories'=>$userFollowingCategories, 'userFollowingSubGroups'=>$userFollowingSubGroups, 'networkAdmin'=>(int)Yii::app()->session['NetworkAdminUserId'],'userFollowers'=>$userFollowers,'userFollowing'=>$userFollowing,'displayName'=>$displayName,"userBadges"=>$userBadges,"userCVDetails"=>$userDisplayCVDetails,"userInteractionsCount"=>$userInteractionsCount));
    } catch (Exception $exc) {  

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
 
}
