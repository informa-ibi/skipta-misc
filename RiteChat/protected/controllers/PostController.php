<?php

/**
 * Developer Name: Suresh Reddy
 * Post Controller  class,  all post module realted actions here 
 * 
 */
class PostController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function init() {    
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
             parent::init();
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            CommonUtility::reloadUserPrivilegeAndData($this->tinyObject->UserId);
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
            $this->whichmenuactive = 1;
        } else { 
                $urlPath = $_SERVER['REQUEST_URI'];
               $urlArr = explode("/", $urlPath); 
               $foundText = strstr($urlArr[2], 'postdetail');
               if (isset($urlArr[2]) && !empty($foundText)) {
                   $queryStringURl = explode("?", $urlArr[2]);

                if(isset($queryStringURl[0]) && $queryStringURl[0] == "postdetail"){   
                 $this->redirect('/common/postdetail?postId='.$_REQUEST['postId'].'&categoryType='.$_REQUEST['categoryType'].'&postType='.$_REQUEST['postType'].'&trfid=1');
                 }
               }
               else{
                    parent::init();
               $this->redirect('/');
               }
        }
        $this->sidelayout = 'yes';
    }
/**
 * suresh reddy here
 */
     public function actionError()
{
 $cs = Yii::app()->getClientScript();
$baseUrl=Yii::app()->baseUrl; 
$cs->registerCssFile($baseUrl.'/css/error.css');
    if($error=Yii::app()->errorHandler->error)
    {        
        $this->render('error', $error);
    }
}
    public function actionIndex() {    
        try{       
//        ServiceFactory::getSkiptaPostServiceInstance()->saveUserCVPublicationCollection($this->tinyObject['UserId'],"Publications,Education");//save or update
        $normalPostModel = new NormalPostForm();
        $userPrivilege = $this->userPrivilegeObject;       
        $showPostOption = ($this->userPrivilegeObject->canSurvey == 1 || $this->userPrivilegeObject->canEvent == 1) ? 1 : 0;        
        $this->render('index', array('normalPostModel' => $normalPostModel, 'canManageFlaggedPost' => $userPrivilege->canManageFlaggedPost, 'canFeatured' => $userPrivilege->canFeature, 'showPostOption' => $showPostOption, 'userHierarchy'=>Yii::app()->session['UserHierarchy']));
        
        }catch(Exception $e){
           error_log("*******************2******************************".$e->getMessage()); 
        }
    }

    /**
     * @author Haribabu
     *  This  method is used for  upload the artifacts and save different folders based on type of file uploaded.
     */
    public function actionUpload() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            //  $folder=Yii::getPathOfAlias('webroot').'/temp/';// folder for uploaded files
            $folder = Yii::app()->params['ArtifactSavePath'];
            $webroot = Yii::app()->params['WebrootPath'];
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("jpg", "jpeg", "gif", "exe", "mov", "mp4", "mp3", "txt", "doc", "docx", "pptx", "xlsx", "pdf", "ppt", "xls", "3gp", "php", "ini", "avi", "rar", "zip", "png", "tiff"); //array("jpg","jpeg","gif","exe","mov" and etc...
            //$sizeLimit = 30 * 1024 * 1024; // maximum file size in bytes
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

            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }

    /**
     * This  method is used for  remove the upload the artifacts .
     */
    public function actionRemoveArtifacts() {

        try {
            if (isset($_POST['filepath'])) {
                $filepath = $_POST['filepath'];
            } else {
                $filepath = "";
            }
            $f = "'" . $filepath . "'";
            if (file_exists($filepath)) {
                if (unlink($filepath)) {
                    $obj = array('status' => 'success', 'data' => '', 'error' => '', 'filename' => $_POST['file'], 'image' => $_POST['image']);
                } else {
                    $obj = array('status' => 'failed', 'data' => '', 'error' => '', 'filename' => $_POST['file'], 'image' => $_POST['image']);
                }
            } else {
                
            }
            $renderScript = $this->rendering($obj);
            echo $renderScript;
            Yii::app()->end();
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }

    /**
     * @Author Haribabu
     * This  method is used for  save the new post with artifacts in array format and save the artifacts in resouces object.
     */
    public function actionCreatePost() {

        $normalPostModel = new NormalPostForm();
        $errormessage = "";
        try {
            $obj = array();
            $hashTagArray = array();
            $atMentionArray = array();
            $SurveyQuestionOptions = array();
            if (isset($_POST['NormalPostForm'])) {
                $normalPostModel->attributes = $_POST['NormalPostForm'];
                $errors = CActiveForm::validate($normalPostModel);
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                } else {
                    Yii::log($normalPostModel->Type, "error", 'application');
                    if ($normalPostModel->Type == "") {
                        $normalPostModel->Type = "Normal Post";
                    } else {
                        $normalPostModel->Type = $normalPostModel->Type;
                    }
                    if (trim($normalPostModel->Type) == "Event") {
                        if ($normalPostModel->StartDate == "" || $normalPostModel->EndDate == "") {
                            $errormessage = Yii::t('translation', 'EventPost_Error_Message');
                        } else {
                            $normalPostModel->StartDate = $normalPostModel->StartDate;
                            $normalPostModel->EndDate = $normalPostModel->EndDate;
                            $normalPostModel->StartTime = $normalPostModel->StartTime;
                            $normalPostModel->EndTime = $normalPostModel->EndTime;
                            $normalPostModel->Location = $normalPostModel->Location;

                            $eventstarttime = explode(" ", $normalPostModel->StartTime);
                            $eventendtime = explode(" ", $normalPostModel->EndTime);
                            $starttime = trim(strtotime($normalPostModel->StartTime));
                            $endtime = trim(strtotime($normalPostModel->EndTime));
                            $startdate = trim(strtotime($normalPostModel->StartDate));
                            $enddate = trim(strtotime($normalPostModel->EndDate));
                            $startDateTime =  $normalPostModel->StartDate." ".$normalPostModel->StartTime;
                            $endDateTime =  $normalPostModel->EndDate." ".$normalPostModel->EndTime;
                            $startEndTime =  $normalPostModel->StartDate." ".$normalPostModel->EndTime;
                            $startDateTime = CommonUtility::convert_time_zone(strtotime($startDateTime),date_default_timezone_get(),Yii::app()->session['timezone']);
                            $endDateTime =  CommonUtility::convert_time_zone(strtotime($endDateTime),date_default_timezone_get(),Yii::app()->session['timezone']);             
                            $startEndTime =  CommonUtility::convert_time_zone(strtotime($startEndTime),date_default_timezone_get(),Yii::app()->session['timezone']);             
                            $currentTime=  CommonUtility::currentSpecifictime_timezone(date_default_timezone_get());
                            if ($starttime == "" && $endtime != "") {
                                $errormessage = Yii::t('translation', 'EventPost_Starttime_Error_Message');
                            } else if ($starttime != "" && $endtime == "") {
                                $errormessage = Yii::t('translation', 'EventPost_Endtime_Error_Message');
                            } else if ($starttime!="" && $endtime!="" && strtotime ($startDateTime) >= strtotime ($startEndTime)) {
                                $errormessage = Yii::t('translation', 'EventPost_time_Error_Message');

//                            }else if (($startdate == $enddate) && ($starttime != "" && $endtime != "") && ($starttime < $currentTime)) {
//                                $errormessage = Yii::t('translation', 'EventPost_Start_time_Error_Message');
//                            }
                            }else if ($starttime!="" && $endtime!="" && strtotime ($startDateTime) < $currentTime) {

                                $errormessage = Yii::t('translation', 'EventPost_Start_time_Error_Message');
                            }
                        }
                    }
                    if ($normalPostModel->Type == "Survey") {
                        $normalPostModel->OptionOne = $normalPostModel->OptionOne;
                        $normalPostModel->OptionTwo = $normalPostModel->OptionTwo;
                        $normalPostModel->OptionThree = $normalPostModel->OptionThree;
                        $normalPostModel->OptionFour = $normalPostModel->OptionFour;
                        $normalPostModel->ExpiryDate = $normalPostModel->ExpiryDate;
                        $normalPostModel->Status = 1;

                        $Optionsarray = array(trim($normalPostModel->OptionOne), trim($normalPostModel->OptionTwo), trim($normalPostModel->OptionThree), trim($normalPostModel->OptionFour));

                        $counts = array_count_values($Optionsarray);
                        foreach ($counts as $name => $count) {
                            if ($count > 1) {
                                $errormessage = Yii::t('translation', 'SurveyPost_Options_Error_Message');
                            }
                        }
                    }
                    $normalPostModel->Type = $normalPostModel->Type;
                    $normalPostModel->PostedBy = Yii::app()->session['PostAsNetwork']==1?$this->tinyObject['UserId']:'';
                    $normalPostModel->UserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject['UserId'];
                    $normalPostModel->NetworkId = $this->tinyObject['NetworkId'];
                    $hashTagArray = CommonUtility::prepareHashTagsArray($normalPostModel->HashTags);
                    $atMentionArray = CommonUtility::prepareAtMentionsArray($normalPostModel->Mentions);
                    $normalPostModel->Mentions = $atMentionArray;
                    $normalPostModel->Location = $normalPostModel->Location;
                    $artifacts = $normalPostModel->Artifacts;
                    $Artifactslengh = strlen($normalPostModel->Artifacts);
                    if ($Artifactslengh > 0) {

                        $normalPostModel->Artifacts = explode(",", $normalPostModel->Artifacts);
                    } else {
                        $normalPostModel->Artifacts = array();
                    }

                    if ($errormessage != "") {
                        $Message = array('NormalPostForm_Description' => $errormessage);
                        if ($normalPostModel->Type == "Event") {
                            if ($endtime == "") {
                                $Message = array('NormalPostForm_EndTime' => $errormessage);
                            } else {
                                $Message = array('NormalPostForm_StartTime' => $errormessage);
                            }
                        }
                        if ($normalPostModel->Type == "Survey") {
                            $Message = array('NormalPostForm_Survey_Options' => $errormessage);
                        }
                        $obj = array("status" => 'error', 'data' => '', "error" => $Message);
                    } else {
                        $postObj = ServiceFactory::getSkiptaPostServiceInstance()->savePost($normalPostModel, $hashTagArray);

                        if ($postObj != 'failure') {
                            $message = Yii::t('translation', 'NormalPost_Saving_Success');
                            $obj = array('status' => 'success', 'data' => $message, 'success' => '');
                        } else {
                            $message = Yii::t('translation', 'NormalPost_Saving_Fail');
                            $errorMessage = array('NormalPostForm_Description' => $message);
                            $obj = array("status" => 'error', 'data' => $message, "error" => $errorMessage);
                        }
                    }
                }
                $renderScript = $this->rendering($obj);
                echo $renderScript;
            } else {
                $this->render('index', array('normalPostModel' => $normalPostModel));
            }
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
            $id = "NormalPostForm_Description";
            $translation = "NormalPost_Saving_Fail";
            $this->throwErrorMessage($id,$translation);

        }
    }

    /**
     * This  method is used for  get the web snippet preview.
     */
    public function actionSnippetpriviewPage() {
        try {
            $text = trim($_POST['data']);
            $type=$_POST['Type'];
            if(isset($_POST['CommentId']) && $_POST['CommentId']!=""){
                $commentId=$_POST['CommentId'];
            }else{
                $commentId="";
            }
            
             $parsed = parse_url($text);
                if (empty($parsed['scheme'])) {
                    $text = 'http://' . ltrim($text, '/');
                }
                
            $WeburlObj = ServiceFactory::getSkiptaPostServiceInstance()->CheckWebUrlExist($text);

            if($WeburlObj!='failure'){
                 $obj = array('status' => 'success', 'snippetdata' => $WeburlObj,'type'=>$type,'CommentId'=>$commentId);
            }else{

              $decode=array();
                 $options = array( 
                    CURLOPT_RETURNTRANSFER => true,     // return web page 
                    CURLOPT_HEADER         => false,    // do not return headers 
                    CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
                    CURLOPT_USERAGENT      => "spider", // who am i 
                    CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
                    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
                    CURLOPT_TIMEOUT        => 120,      // timeout on response 
                    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
                ); 
                $ch      = curl_init( $text ); 
                curl_setopt_array( $ch, $options ); 
                $content = curl_exec( $ch ); 
                $err     = curl_errno( $ch ); 
                $errmsg  = curl_error( $ch ); 
                $header  = curl_getinfo( $ch ); 
                curl_close( $ch ); 

                //var_dump($data);
               if(strlen($content)==0){
                  
                    $decode['provider_url']=$parsed['host'];
                    $decode['description']="";
                    $decode['title']="";
               }else{
                   // $text=preg_replace('/^(\<p\><a\><\a>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $text);
                 // $text = str_replace('</a>', '', $text);
                  $weburl=urlencode ($header['url']);
                $url = "https://api.embed.ly/1/oembed?key=a8d760462b7c4e4cbfc9d6cb2b5c3418&url=" . $weburl;
                $details = @file_get_contents($url);
                $decode = CJSON::decode($details);
                
                if(!is_array($decode) && !count($decode)>0){
                    
                    $doc = new DOMDocument();
                    @$doc->loadHTML($content);
                    $nodes = $doc->getElementsByTagName('title');


                    $base_url = substr($text,0, strpos($text, "/",8));
                    $relative_url = substr($text,0, strrpos($text, "/")+1);


                    //get and display what you need:
                    $title = $nodes->item(0)->nodeValue;
                    $metas = $doc->getElementsByTagName('meta');

                    for ($i = 0; $i < $metas->length; $i++)
                    {
                        $meta = $metas->item($i);
                        if($meta->getAttribute('name') == 'description')
                        $description = $meta->getAttribute('content');
                    }



                    //fetch images
                    $image_regex = '/<img[^>]*'.'src=[\"|\'](.*)[\"|\']/Ui';
                     $a=preg_match_all($image_regex, $html, $img, PREG_PATTERN_ORDER);

                    $images_array = $img[0];
                    
                    if(strstr($images_array[0],'http')) {
                            $image=$images_array[0];

                    }else{
                        $image=$relative_url.$images_array[0];

                    }
                    
                   $decode['provider_url']=$text; 
                   $decode['description']=$description; 
                   $decode['title']=$title; 
                   $decode['thumbnail_url']=$image; 
                   
                   
                   
                   
                   
                }
               
                 
               }
                
               
                $SnippetObj = ServiceFactory::getSkiptaPostServiceInstance()->SaveWebSnippet($text, $decode);
                $SnippetObj->Weburl=trim($text);
                $pattern = '~(?><(p|span|div)\b[^>]*+>(?>\s++|&nbsp;)*</\1>|<br/?+>|&nbsp;|\s++)+$~i';
                $SnippetObj->WebTitle = preg_replace($pattern, '', $SnippetObj->WebTitle); 
                $SnippetObj->WebLink = preg_replace($pattern, '', $SnippetObj->WebLink);
                $obj = array('status' => 'success', 'snippetdata' => $SnippetObj,'type'=>$type,'CommentId'=>$commentId);
            }
            
            $renderScript = $this->rendering($obj);
            echo $renderScript;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used to get the hashtags, It will search by 'HashTagName'.
     * @param: 'searchkey' is the string.
     */
    public function actionGetHashTagsBySearchKey() {
        try {
            $result = array();
            if (isset($_REQUEST['searchkey'])) {
                $searchKey = $_REQUEST['searchkey'];
                $hashtagArray = isset($_REQUEST['existingHashtags']) ? json_decode($_REQUEST['existingHashtags']) : array();
                $result = ServiceFactory::getSkiptaPostServiceInstance()->getHashTagsBySearchKey($searchKey, $hashtagArray);
            }
             $obj = $this->rendering($result);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetHashTagsBySearchKey==" . $ex->getMessage(), "error", "application");
        }
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used to get the user followers and following users list, It will search by 'Email'.
     * @param: 'searchkey' is the string.
     */
    public function actionGetUserFollowingAndFollowers() {
        try {
            $result = array();
            if (isset($_REQUEST['searchkey'])) {

                $searchKey = $_REQUEST['searchkey'];
                $mentionArray = isset($_REQUEST['existingUsers']) ? json_decode($_REQUEST['existingUsers']) : array();

                $userId = $this->tinyObject['UserId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->getFollowingFollowerUsers($searchKey, $userId, $mentionArray);
            }
            $obj = $this->rendering($result);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserFollowingAndFollowers==" . $ex->getMessage(), "error", "application");
        }
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used get the tiny user collection for network
     * @return type
     */
    public function actionGetNetworkUsers() {
       try {
           $result = array();
           if (isset($_REQUEST['searchKey'])) {
               $searchKey = $_REQUEST['searchKey'];
               $networkId = $this->tinyObject['NetworkId'];
               $userId = $this->tinyObject['UserId'];
               $mentionArray = isset($_REQUEST['existingUsers']) ? json_decode($_REQUEST['existingUsers']) : array();
               array_push($mentionArray, $userId);
               $result = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollectionForNetworkBySearchKey($networkId, $searchKey, $mentionArray);
           }
            $obj = $this->rendering($result);
           echo $obj;
       } catch (Exception $e) {
           Yii::log("Exception Occurred in PostController actionGetNetworkUsers==" . $ex->getMessage(), "error", "application");
       }
   }

    /**
     * @author karteek.v
     * ActionUserFollowPost is used either follow or unfollow a post by a user
     * return type json object
     */
    public function actionUserFollowPost() {
        try {
            $result = "failure";
            if (isset($_REQUEST['postType']) && isset($_REQUEST['postId']) && isset($_REQUEST['actionType'])) {
                $UserId =  Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                $result = ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($_REQUEST['postType'], $_REQUEST['postId'], $UserId, $_REQUEST['actionType'], $_REQUEST['categoryType']);
            }
            if($result == "failure"){
                throw new Exception('Unable to follow or unfollow');
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
             echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log("actionUserFollowPost==" . $ex->getMessage(), "error", "application");
              $id = "socialactionsError_".$_REQUEST['postId'];
             $actionType =  $_REQUEST['actionType'];
           if($actionType == "Follow"){
               $translation = "Follow_Action_Fail"; 
           }else{
                $translation = "UnFollow_Action_Fail";
        }
           
            $this->throwErrorMessage($id,$translation);
    }

    }

    /**
     * @author Karteek.v
     * actionUserLoveToPost is used to like a post by user
     * return type json object
     */
    public function actionUserLoveToPost() {
        try {
            //throw new Exception('Unable to save love');
            $result = FALSE;            
            if (isset($_REQUEST['postType']) && isset($_REQUEST['postId'])) {
                $UserId =  Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                $result = ServiceFactory::getSkiptaPostServiceInstance()->saveLoveToPost($_REQUEST['postType'], $_REQUEST['postId'], $UserId, $_REQUEST['categoryType']);
            }
            if($result==TRUE){
            $obj = array("status" => $result, "data" => "", "error" => "");
            }else{
                throw new Exception('Unable to save love');
            }
            echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
             $id = "socialactionsError_".$_REQUEST['postId'];
           error_log("Exception ===actionUserLoveToPost--------------".$ex->getMessage());
            $translation = "Love_Action_Fail";
            $this->throwErrorMessage($id,$translation);
            return;
        }
       
    }

    /**
     * @Author Karteek
     * This method is to save comment
     * @return type Json object
     */
    public function actionSavePostComment() {
        $obj=array();
        try {//throw new Exception('Division by zero.');
            if (isset($_REQUEST['postid'])) {
                $streamId = $_REQUEST['streamid'];
                $commentBean = new CommentBean();
                $commentBean->PostId = $_REQUEST['postid'];
                $commentBean->CommentText = $_REQUEST['comment'];
                $CategoryType = $_REQUEST['CateogryType'];
                if (trim($_REQUEST['commentArtifacts']) == "") {

                    $commentBean->Artifacts = array();
                } else {
                    $commentBean->Artifacts = explode(",", $_REQUEST['commentArtifacts']);
                }
                $commentBean->PostType = $_REQUEST['type'];
                $commentBean->UserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$commentBean->UserId = $this->tinyObject->UserId;
                $commenturls = array();
                $commenturls[0] = $_REQUEST['WebUrls'];
                $commentBean->WebUrls=$commenturls;
               // $commentBean->WebUrls = $_REQUEST['type'];
               if(isset($_REQUEST['IsWebSnippetExist'])){
                    $commentBean->IsWebSnippetExist = $_REQUEST['IsWebSnippetExist'];
               }
               
                $commentBean->HashTags = CommonUtility::prepareHashTagsArray($_REQUEST['hashTags']);
                $commentBean->Mentions = CommonUtility::prepareAtMentionsArray($_REQUEST['atMentions']);
                $result = ServiceFactory::getSkiptaPostServiceInstance()->saveComment($commentBean, (int) $_REQUEST['NetworkId'], (int) $_REQUEST['CateogryType']);
                
//                $comments = ServiceFactory::getSkiptaPostServiceInstance()->getCommentObject($commentBean->PostId,$CategoryType);                
               if($result=='Exception'){
                   throw new Exception('Unable to save commment');
               }
              else if(is_array($result)){
                    $commentUserBean = new CommentUserBean();
                    if (isset($result[0])) {
                        $commentUserBean->Resource = $result[0];
                    } else {
                        $commentUserBean->Resource = "";
                    }
                $userCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($commentBean->UserId);
                $commentUserBean->UserId = $userCollectionObj->UserId;
                $tagsFreeDescription= strip_tags(($commentBean->CommentText));
             $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
            $descriptionLength =  strlen($tagsFreeDescription);
                    if ($descriptionLength > 240) {

                        $postId = (isset($_REQUEST["postid"])) ? $_REQUEST["postid"] : '';
                        $CategoryType = (isset($_REQUEST["CateogryType"])) ? $_REQUEST["CateogryType"] : '';
                        $PostType = (isset($_REQUEST["type"])) ? $_REQUEST["type"] : '';

                    $appendCommentData = ' <span class="postdetail"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-id="'.$streamId.'" data-postid="' . $postId . '" data-categoryType="' . $CategoryType . '" data-postType="' . $PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                     $stringArray = CommonUtility::truncateHtml($commentBean->CommentText, 240,'...',true,true,$appendCommentData);
                   // $stringArray = str_split($commentBean->CommentText, 240);
                        $text = $stringArray;
                        $commentBean->CommentText = $text;
                    } else {

                        $commentBean->CommentText = $commentBean->CommentText;
                    }
                    $commentUserBean->CommentText = $commentBean->CommentText;
                    // $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn->sec);
                     if(count($commenturls)>0){
                        $parsed = parse_url($commenturls[0]);
                        if (empty($parsed['scheme'])) {
                            $commenturls[0] = 'http://' . ltrim($commenturls[0], '/');
                        }
                        $weburls=explode('&nbsp',$commenturls[0]);
                        $commenturls[0]=$weburls[0];
                        
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
                    if(isset( $_REQUEST['IsWebSnippetExist'])){
                       $commentUserBean->IsWebSnippetExist = $_REQUEST['IsWebSnippetExist'];  
                        $commentUserBean->CommentText = CommonUtility::findUrlInStringAndMakeLink($commentUserBean->CommentText);
                        
                    }else{
                         $commentUserBean->IsWebSnippetExist ="";
                    }
                   
                    $commentUserBean->DisplayName = $userCollectionObj->DisplayName;
                    $commentUserBean->ProfilePic = $userCollectionObj->profile70x70;
                    $commentUserBean->CateogryType = $_REQUEST["CateogryType"];
                    $commentUserBean->PostId = $_REQUEST["postid"];
                    $commentUserBean->Type = $_REQUEST["type"];
                    $commentUserBean->ResourceLength = count($result);
                    $commentUserBean->streamId = $streamId;
                    $profile = "/profile/".$userCollectionObj->uniqueHandle;
                    $commentUserBean->Profilename = $profile;
                    $obj = array("status" => "succes", "data" => $commentUserBean, "error" => "");
                } else if($result=='blocked'){
                    $obj = array("status" => "succes", "data" => "blocked", "error" => "");
                }
                
            }
        } catch (Exception $ex) {
            error_log("________Exception____commen save____________________________________________".$ex->getMessage());
            Yii::log($ex->getMessage(), 'error', 'application');
           $id = "commenterror_".$_REQUEST['postid'];
          
            $translation = "Comment_Saving_Fail";
            $this->throwErrorMessage($id,$translation);
            return;
        }
          $obj = $this->rendering($obj);
            echo $obj;
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used GetHashTagProfile summary
     * @return type HashTagProfileBean 
     */
    public function actionGetHashTagProfile() {
        try {
            $result = array();
            if (isset($_REQUEST['hashTagName'])) {
                $hashTagName = $_REQUEST['hashTagName'];
                $userId = $this->tinyObject['UserId'];
                $hashtagSummery = ServiceFactory::getSkiptaPostServiceInstance()->getHashTagProfile($hashTagName, $userId);
                $result = $hashtagSummery;
            }
            $obj = array('status' => 'success', 'data' => $result, 'error' => '');
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in PostController actionGetNetworkUsers==" . $ex->getMessage(), "error", "application");
        }
    }
    /**
     * @Author Moin Hussain
     * This method is used actionTrackMinHashTagWindowOpen summary
     * @return type  
     */
    public function actionTrackMinHashTagWindowOpen() {
        try {
            $result = array();
            if (isset($_REQUEST['hashTagName'])) {
                $hashTagName = $_REQUEST['hashTagName'];
                $userId = $this->tinyObject['UserId'];
                $networkId = $this->tinyObject['NetworkId'];
                 ServiceFactory::getSkiptaPostServiceInstance()->trackMinHashTagWindowOpen($hashTagName, $userId,$networkId);
                
            }
            $obj = array('status' => 'success', 'data' => "", 'error' => '');
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in PostController actionGetNetworkUsers==" . $ex->getMessage(), "error", "application");
        }
    }

    /**
     * This method is used to update the user follow/unfollow on hashtag
     * @param type $actionType (Follow/Unfollow)
     * @author Sagar Pathapelli
     */
    public function actionFollowOrUnfollowHashTag() {
        try {
            $result = "failure";
            if (isset($_REQUEST['actionType'])) {
                $actionType = $_REQUEST['actionType'];
                $hashTagId = $_REQUEST['hashTagId'];
                $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$userId = $this->tinyObject['UserId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->followOrUnfollowHashTag($hashTagId, $userId, $actionType);
            }
            if($result == "failure"){
                throw new Exception('Unable to follow or unfollow');
               }
            $obj = array('status' => 'success', 'data' => $result, 'error' => '');
            echo $this->rendering($obj);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in PostController actionGetNetworkUsers==" . $e->getMessage(), "error", "application");
             $id = "socialactionsError_".$_REQUEST['hashTagId'];
             $actionType =  $_REQUEST['actionType'];
           error_log("Exception====actionUserFollowPost--------$actionType------".$e->getMessage());
           if($actionType == "Follow"){
               $translation = "Follow_Action_Fail"; 
           }else{
                $translation = "UnFollow_Action_Fail";
        }
           
            $this->throwErrorMessage($id,$translation);
    }
    }

    /**
     * @author: sagar
     * actionAttendEvent is used to store the event attendees details
     * request an PostId
     * returns 
     */
    public function actionAttendEvent() {
        try {
            $result = "failure";
            if (isset($_REQUEST['postId'])) {
                $postId = $_REQUEST['postId'];
                $actionType = $_REQUEST['actionType'];
                $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$userId = $this->tinyObject['UserId'];
                $categoryType = $_REQUEST['categoryType'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->saveOrRemoveEventAttende($postId, $userId, $actionType, $categoryType);
            }

            $obj = array('status' => 'success', 'data' => $result, 'error' => '');
              $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $ex) {
            Yii::log("Exception===" . $ex->getMessage(), "error", "application");
        }
    }

    /**
     * @author Sagar
     * This method is to save invites
     * @return type Json object
     */
    public function actionSaveInvites() {
        try {
            if (isset($_REQUEST['postId'])) {
                $result = "failure";
                $PostId = $_REQUEST['postId'];
                $InviteText = $_REQUEST['inviteText'];
                $networkId = $_REQUEST['networkId'];
                $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$userId = $this->tinyObject['UserId'];
                $categoryType = $_REQUEST['categoryType'];
                $Mentions = CommonUtility::prepareAtMentionsArray($_REQUEST['atMentions']);
                $result = ServiceFactory::getSkiptaPostServiceInstance()->saveInvites($userId, $PostId, $InviteText, $Mentions, $networkId, $categoryType);
                if($result == "success"){
                $obj = array("status" => "success", "data" => $result, "error" => "");
 
               }else{
                
                    throw new Exception('Unable to Invite');
            }
            }
        echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
               $id = "inviteTextAreaError_".$_REQUEST['postId'];
               error_log("Exception####actionUserFollowPost----------$id----".$ex->getMessage());
               $translation = "Invite_Action_Fail"; 
               $this->throwErrorMessage($id,$translation);
        }
      
    }

    /**
     * @author Sagar
     * This method is to submit survey
     * @param postId
     * @param networkId
     * @param categoryType
     */
    public function actionSubmitSurvey() {
        try {
            if (isset($_REQUEST['postId'])) {
                $result = "failure";
                $PostId = $_REQUEST['postId'];
                $Option = $_REQUEST['option'];
                $NetworkId = $_REQUEST['networkId'];
                $UserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$UserId = $this->tinyObject['UserId'];
                $CategoryType = $_REQUEST['categoryType'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->submitSurvey($UserId, $PostId, $Option, $NetworkId, $CategoryType);
                if($result == "failure"){
                   throw new Exception('Unable to submit survey');
                }
                $obj = array("status" => "success", "data" => $result, "error" => "");
            }
             echo $this->rendering($obj);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
             $id = "surveyError_".$_REQUEST['postId'];
               error_log("Exception###########actionUserFollowPost----------$id----".$ex->getMessage());
               $translation = "Survey_Submit_Fail"; 
               $this->throwErrorMessage($id,$translation);
        }
       
    }

    /**
     * @author Sagar
     * This method is to get the stream details
     */
    public function actionStream() {
        try {
             $groupsfollowing = ServiceFactory::getSkiptaPostServiceInstance()->getUserFollowingGroupsIDs((int)$this->tinyObject['UserId']);
              array_push($groupsfollowing,'');
            if (isset($_GET['StreamPostDisplayBean_page'])) {
                $networkId = (int) $this->tinyObject['NetworkId'];
                $networkIds = array($networkId);
                //$networkIds = array_map('intval', $networkIds);
                $streamIdArray = array();
                $previousStreamIdArray = array();
                $previousStreamIdString = isset($_POST['previousStreamIds'])?$_POST['previousStreamIds']:"";
                if(!empty($previousStreamIdString)){
                    $previousStreamIdArray = explode(",", $previousStreamIdString);
                }
                $timezone = $_REQUEST['timezone'];
                if (isset($_GET['filterString'])) {
                    if($_GET['filterString']=='Division'){
                        $condition = array(
                            'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                            'GroupId'=>array('in'=>$groupsfollowing),
                            'IsDeleted' => array('!=' => 1),
                            'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                            'IsAbused' => array('notIn' => array(1, 2)),
                            'Division' =>  array('==' => (int)(Yii::app()->session['UserHierarchy']['Division'])),
                            'IsNotifiable' => array('==' => (int)1),
                            'CategoryType' => array('notIn' => array(7)),
                        );
                    }if($_GET['filterString']=='District'){
                        $condition = array(
                            'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                            'GroupId'=>array('in'=>$groupsfollowing),
                            'IsDeleted' => array('!=' => 1),
                            'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                            'IsAbused' => array('notIn' => array(1, 2)),
                            'District' => array('==' => (int)(Yii::app()->session['UserHierarchy']['District'])),
                            'IsNotifiable' => array('==' => (int)1),
                            'CategoryType' => array('notIn' => array(7)),
                        );
                    }if($_GET['filterString']=='Region'){
                        $condition = array(
                            'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                            'GroupId'=>array('in'=>$groupsfollowing),
                            'IsDeleted' => array('!=' => 1),
                            'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                            'IsAbused' => array('notIn' => array(1, 2)),
                            'Region' => array('==' => (int)(Yii::app()->session['UserHierarchy']['Region'])),
                            'IsNotifiable' => array('==' => (int)1),
                            'CategoryType' => array('notIn' => array(7)),
                        );
                    }if($_GET['filterString']=='Store'){
                        $condition = array(
                            'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                            'GroupId'=>array('in'=>$groupsfollowing),
                            'IsDeleted' => array('!=' => 1),
                            'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                            'IsAbused' => array('notIn' => array(1, 2)),
                            'Store' => array('==' => (int)(Yii::app()->session['UserHierarchy']['Store'])),
                            'IsNotifiable' => array('==' => (int)1),
                            'CategoryType' => array('notIn' => array(7)),
                        );
                    }if($_GET['filterString']=='Corporate'){
                        $condition = array(
                            'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                            'GroupId'=>array('in'=>$groupsfollowing),
                            'IsDeleted' => array('!=' => 1),
                            'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                            'IsAbused' => array('notIn' => array(1, 2)),
                            'Division' => array('==' => 0),
                            'District' => array('==' => 0),
                            'Region' => array('==' => 0),
                            'Store' => array('==' => 0),
                            'IsNotifiable' => array('==' => (int)1),
                            'CategoryType' => array('notIn' => array(7)),
                        );
                    }
                } else {
                  
                    $condition = array(
                        'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                        'GroupId'=>array('in'=>$groupsfollowing),
                        'IsDeleted' => array('!=' => 1),
                        'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                        'IsAbused' => array('notIn' => array(1, 2)),
                        'CategoryType' => array('notIn' => array(7)),
                        'IsNotifiable' => array('==' => (int)1)
                    );
                }
                $pageSize = 9;
                $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => $condition,
                        'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                    )
                ));
                if ($provider->getTotalItemCount() == 0) {
                    $stream = 0; //No posts
                } else if ($_GET['StreamPostDisplayBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {

                    $UserId = isset(Yii::app()->session['PostAsNetwork'])&&Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject['UserId'];
#                    $dataArray = array_merge($provider->getData(), $this->getDerivateObjectsStream($UserId));
		$dataArray = array_merge($provider->getData(),[]);
#	$dataArray = array_merge([],$this->getDerivateObjectsStream($UserId));
                    $streamRes = (object) (CommonUtility::prepareStreamData($UserId, $dataArray, $this->userPrivileges, 1, Yii::app()->session['PostAsNetwork'],$timezone, $previousStreamIdArray));
                    $streamIdArray=$streamRes->streamIdArray;
                    $totalStreamIdArray=$streamRes->totalStreamIdArray;
                    $totalStreamIdArray = array_values(array_unique($totalStreamIdArray));
                    $streamIdArray = array_values(array_unique($streamIdArray));
                    $stream=(object)($streamRes->streamPostData);
                } else {
                    $stream = -1; //No more posts
                }
                $streamData = $this->renderPartial('stream_view', array('stream' => $stream, 'streamIdArray'=>$streamIdArray,'totalStreamIdArray'=>$totalStreamIdArray), true);
                $streamIdString = implode(',', $streamIdArray);
                echo $streamData."[[{{BREAK}}]]".$streamIdString;
            }
        } catch (Exception $ex) {
            error_log("************EXCEPTION at STREAMHOME*****************" . $ex->getMessage());
            Yii::log("************EXCEPTION at STREAMHOME*****************" . $ex->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar
     * This method is to abuse/block/release a post based on action type
     */
    public function actionAbusePost() {
        try {
            $result = "failure";
            if (isset($_REQUEST['postId']) && isset($_REQUEST['actionType'])) {
                $postId = $_REQUEST['postId'];
                $actionType = $_REQUEST['actionType'];
                $networkId = $_REQUEST['networkId'];
                $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$userId = $this->tinyObject['UserId'];
                $categoryType = $_REQUEST['categoryType'];
                $isBlockedPost = isset($_REQUEST['isBlockedPost']) ? (int) $_REQUEST['isBlockedPost'] : 0;
                $result = ServiceFactory::getSkiptaPostServiceInstance()->abusePost($postId, $actionType, $categoryType, $networkId, $userId, $isBlockedPost);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
          $obj = $this->rendering($obj);
            echo $obj;
    }

    /**
     * @author Sagar
     * This method is to promote a post
     */
    public function actionPromotePost() {
        try {
            $result = "failure";
            if (isset($_REQUEST['postId'])) {
                $postId = $_REQUEST['postId'];
                $promoteDate = $_REQUEST['promoteDate'];
                $networkId = $_REQUEST['networkId'];
                $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$userId = $this->tinyObject['UserId'];
                $categoryType = $_REQUEST['categoryType'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->promotePost($postId, $userId, $promoteDate, $categoryType, $networkId);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
         $obj = $this->rendering($obj);
            echo $obj;
    }

    /**
     * @author Sagar
     * This method is to delete a post
     */
    public function actionDeletePost() {
        try {
            $result = "failure";
            if (isset($_REQUEST['postId'])) {
                $postId = $_REQUEST['postId'];
                $networkId = $_REQUEST['networkId'];
                $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
                //$userId = $this->tinyObject['UserId'];
                $categoryType = $_REQUEST['categoryType'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->deletePost($postId, $categoryType, $networkId);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
        $obj = $this->rendering($obj);
            echo $obj;
    }

    /**
     * @author Karteek V
     * This is the common render partial function for all detailed pages
     * @param $postId, $categoryType, $postType
     * @return type html
     */
    public function actionRenderPostDetailed() {
        try {  
             $recentActivity='';
            $inviteMessage='';
            if (isset($_REQUEST['load'])) {
                $data = explode('_', $_REQUEST['load']);
                $categoryType = $data[0];
                $postId = $data[1];
                $postType = $data[2];                
            } else {
                $pageType='stream';
                $postId = $_REQUEST['postId'];
                $categoryType = $_REQUEST['categoryType'];
                $postType = $_REQUEST['postType'];
                if(isset($_REQUEST['layout']))
                    $outer = $_REQUEST['layout'];
                
                if(isset($_REQUEST['page']))
                    $pageType = $_REQUEST['page'];
                
            }              
            if(isset($_REQUEST['recentActivity']) &&  $_REQUEST['recentActivity']!="undefined" ){
                   $recentActivity =$_REQUEST['recentActivity'];
                }
                error_log($recentActivity."Recent Activity");
            $mainGroupCollection="";
            $isGroupAdmin="false";
            $curbsideCategory = array();
            $MoreCommentsArray = array();
            $tinyUserProfileObject = array();
             
            $object = array();
            $IsCustomBadge=0;
            if ($categoryType == 1 && $postType != 5) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getPostObjectById($postId);
            } else if ($postType == 5) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getCurbsidePostObjectById($postId);
                $curbsideCategory = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($object->CategoryId);
                
            } else if ($postType == 2 || $categoryType == 3 || $categoryType == 7) {
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getGroupPostObjectById($postId);
                $isGroupPostAdmin = ServiceFactory::getSkiptaPostServiceInstance()->checkIsGroupAdminById($object);
                if($isGroupPostAdmin == 'true')
                {
                   $groupNameObject =  ServiceFactory::getSkiptaPostServiceInstance()->getGroupNameById($object->GroupId);
                   if($groupNameObject != 'failure')
                   {
                       $mainGroupCollection = $groupNameObject;
            }
                }
                
            } else if($categoryType == 8){                
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getNewsPostObjectById($postId);
            }
             else if ($categoryType == 10) 
            {
                $object = ServiceFactory::getSkiptaUserServiceInstance()->getUserBadgeObjectById($postId);
                $badgeInfo=ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($object->BadgeId);                  
                $IsCustomBadge=$badgeInfo->isCustom;
                
            }
            else if($categoryType == 12){
                $object = ServiceFactory::getSkiptaPostServiceInstance()->getCareerPostObjectById($postId);
            }
            if(isset($object) && !empty($object)){
            $UserId = $object->UserId;
            
            $object->CreatedOn = date(Yii::app()->params['PHPDateFormat'], $object->CreatedOn->sec);
            
            $tinyUserProfileObject = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($UserId);
            if(isset($object->WebUrls)){
             if(isset($object->IsWebSnippetExist)&& $object->IsWebSnippetExist=='1'){            
                     $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($object->WebUrls[0]);
                     $object->WebUrls=$snippetdata;
                }else{
                     $object->WebUrls="";
                }
            }
                    if ($_REQUEST['recentActivity'] == "invite") {
                    $inviteArray = $object->Invite;
                    $userId = $this->tinyObject['UserId'];
          
                    foreach ($inviteArray as $n) {
                        $isPresent = in_array($userId, $n[1]);
                        if ($isPresent) {
                            $inviteMessage = $n[2];
                            break;
                        }
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
         $rs=array_reverse($result);
        foreach ($rs as $key => $value) {
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
           // }
        }
            
        }else{
            $object = 0;            
        }
        $commentedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getCommentedUsersForPost($postId, (int)($this->tinyObject['UserId']));
        $IsUserCommented = in_array((int)($this->tinyObject['UserId']), $commentedUsers);
        $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
        if (isset($_REQUEST['load'])) {
                $this->render("postDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType, "curbsideCategory" => $curbsideCategory,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented, "UserId"=>(int)$userId));
            } else {
              $this->renderPartial("postDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType, "curbsideCategory" => $curbsideCategory,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented,'isGroupPostAdmin' =>$isGroupPostAdmin,'mainGroupCollection'=>$mainGroupCollection,"badgeInfo"=>$badgeInfo, "UserId"=>(int)$userId,"inviteMessage"=>$inviteMessage,'recentActivity'=>$recentActivity,'pageType'=>$pageType,'IsCustomBadge'=>$IsCustomBadge));
            }
          // END ----------------------------------------------------------  
            
             $userId = $this->tinyObject['UserId']; 
               $networkId = $this->tinyObject['NetworkId'];
               ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId,"Post","PostDetailOpen",$postId,$categoryType,$postType,$networkId);

        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
    }

    /**
     * @author suresh reddy 
     * get derivate objects get
     * 
     */
   /**  public function getDerivateObjectsStream($userId) {
        try {

            $pageSize = 1;
            $provider = new EMongoDocumentDataProvider('DerivativeObjectDisplayBean', array(
                'pagination' => array('pageSize' => 2),
                'criteria' => array(
                    'conditions' => array(
                        'UserId' => array('==' => $userId),
                        'IsDeleted' => array('!=' => 1),
                        'IsAbused' => array('notIn' => array(1, 2)),
                        'IsEngage' => array('==' => 0),
                        'Priority' => array('>' => 1)
                    ),
                    'sort' => array('Priority' => EMongoCriteria::SORT_DESC)
                )
            ));

            $dataArray = $provider->getData();
            foreach ($dataArray as $key => $data) {
                $postId = "$data->PostId";
                $userId = $data->UserId;
                $id = $data->_id;
                ServiceFactory::getSkiptaPostServiceInstance()->updateDerivateObjectPriority($id, $postId, $userId);
            }
            return $dataArray;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
    }*/

public function getDerivateObjectsStream($userId) {
try {
/* Updated by anjireddy jetti
* Description:Changed the entire query logic from using EMongoDocumentDataProvider 
constructor flow to mongo query for getting dataArray.
*/
$criteria = new EMongoCriteria;
$criteria->addCond('UserId', '==', (int) $userId);
$criteria->addCond('Priority', '>', 1);
$criteria->addCond('IsEngage', '==', 0);
$criteria->addCond('IsDeleted', '!=', (int) 1);
$criteria->addCond('IsAbused', 'notin', array(1, 2));
$criteria->setSort(array('Priority' => EMongoCriteria::SORT_DESC));
$criteria->setLimit(2);
$DerivativeObjectDisplayBean = new DerivativeObjectDisplayBean;
$dataArray = $DerivativeObjectDisplayBean->findAll($criteria);
foreach ($dataArray as $key => $data) {
$postId = "$data->PostId";
$userId = $data->UserId;
$id = $data->_id;
ServiceFactory::getSkiptaPostServiceInstance()->updateDerivateObjectPriority($id, $postId, $userId);
}
#print_r($dataArray);
return $dataArray;
} catch (Exception $ex) {
Yii::log("PostController:getDerivateObjectsStream::" . $ex->getMessage() . "--" . $ex->getTraceAsString(), 'error', 'application');
}
}

    /**
     * @author Haribabu
     * This method is to get a post comments
     */
    public function actionPostComments() {
        try {
        if (isset($_REQUEST['postId'])) {
            $postId = $_REQUEST['postId'];
        }
        $MinpageSize = 5;
        $streamId=$_REQUEST['streamId'];
        $page = $_REQUEST['Page'];
        $PageType = $_REQUEST['PageType'];
        //$page=0;
        $pageSize = ($MinpageSize * $page);
        $categoryType = (int) $_REQUEST['CategoryType'];
        $result = ServiceFactory::getSkiptaPostServiceInstance()->getCommentsforPost($pageSize, $MinpageSize, $postId, (int) $categoryType);
        //  $Comments = ServiceFactory::getSkiptaPostServiceInstance()->getCommentObject($postId,(int)$categoryType); 
        // $TotalComments=count($Comments->Comments);
        $MoreCommentsArray = array();
        $blockedWords = array();
        if(isset($_REQUEST['isBlockedPost']) && (int)$_REQUEST['isBlockedPost']==1){
            $blockedWords = AbuseKeywords::model()->getAllAbuseWords();
        }
        foreach ($result as $key => $value) {
            if(!(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist']==1) || (isset($_REQUEST['isBlockedPost']) && (int)$_REQUEST['isBlockedPost']==1)){
                $commentUserBean = new CommentUserBean();
                $createdOn = $value['CreatedOn'];
                $userDetails = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($value['UserId']);
                $commentUserBean->UserId = $userDetails['UserId'];
                $commentUserBean->DisplayName = $userDetails['DisplayName'];
                $commentUserBean->ProfilePic = $userDetails['profile70x70'];

                $postId = (isset($value["PostId"])) ? $value["PostId"] : '';
                $CategoryType = (isset($value["CategoryType"])) ? $value["CategoryType"] : '';
                $PostType = (isset($value["PostType"])) ? $value["PostType"] : '';
                if (isset($value["CommentTextLength"]) && $value["CommentTextLength"] > 240) {
                    if(isset($_REQUEST['isBlockedPost']) && (int)$_REQUEST['isBlockedPost']==1){
                        if(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist']==1){
                            if (is_array($blockedWords) && sizeof($blockedWords) > 0) {
                                $value['CommentText'] = CommonUtility::FindElementAndReplace($value['CommentText'], $blockedWords);
                            }
                        }else{
                            $value["CommentText"] = $value["CommentText"];
                        }
                    }else{
                        $appendCommentData = ' <span class="postdetail"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-id="'.$streamId.'" data-postid="' . $postId . '" data-categoryType="' . $CategoryType . '" data-postType="' . $PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                       // $stringArray = str_split($value["CommentText"], 240);
                       //  $stringArray = CommonUtility::truncateHtml($value["CommentText"], 240);
                        $stringArray = CommonUtility::truncateHtml($value["CommentText"], 240,'...',true,true,$appendCommentData);
                        $text = $stringArray;
                        if($PageType!="postdetail"){
                            $value["CommentText"] = $text;
                        }else{
                            $value["CommentText"] =  $value["CommentText"];
                        }
                        
                    }
                } else {
                    if(isset($_REQUEST['isBlockedPost']) && (int)$_REQUEST['isBlockedPost']==1){
                        if(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist']==1){
                            if (is_array($blockedWords) && sizeof($blockedWords) > 0) {
                                $value['CommentText'] = CommonUtility::FindElementAndReplace($value['CommentText'], $blockedWords);
                            }
                        }else{
                            $value["CommentText"] = $value["CommentText"];
                        }
                    }else{
                        $value["CommentText"] = $value["CommentText"];
                    }
                }
                
                $commentUserBean->CommentText = $value['CommentText'];
                $commentUserBean->CommentId = $value['CommentId'];
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

                $commentUserBean->CateogryType = $CategoryType;
                $commentUserBean->PostId = $postId;
                $commentUserBean->Type = $PostType;
                if (array_key_exists('WebUrls', $value)) {
                 if(is_array($value['WebUrls']) && count($value['WebUrls'])>0 && isset($value['WebUrls'])){
                     $commenturls=$value['WebUrls'];
                     $commentUserBean->CommentText = CommonUtility::findUrlInStringAndMakeLink($commentUserBean->CommentText);
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
                    if(isset($commentUserBean->IsWebSnippetExist)){
                        $commentUserBean->IsWebSnippetExist = $value['IsWebSnippetExist'];
                    }else{
                        $commentUserBean->IsWebSnippetExist ="";
                    }
                }
                $commentUserBean->IsBlockedWordExist=isset($value['IsBlockedWordExist'])?$value['IsBlockedWordExist']:0;
                $commentUserBean->IsBlockedPost = isset($_REQUEST['isBlockedPost'])?$_REQUEST['isBlockedPost']:0;
                if (count($value['Artifacts']) > 0) {
                    if(isset($_REQUEST['PageType'])&& $_REQUEST['PageType']=='stream'){
                        $commentUserBean->Resource = $value['Artifacts'][0];
                        $commentUserBean->PageType = "stream";
                    }else if(isset($_REQUEST['PageType'])&& $_REQUEST['PageType']=='postdetail'){
                         $commentUserBean->Resource = $value['Artifacts'];
                         $commentUserBean->PageType = "postdetail";
                    }
                    
                    $commentUserBean->ResourceLength = count($value['Artifacts']);
                }
       array_push($MoreCommentsArray, $commentUserBean);
       }
            }

        $totalrecords = count($MoreCommentsArray);
        if ($result) {
             $profile = "/profile/".$userDetails['uniqueHandle'];
              $this->renderPartial('viewMoreComments', array("data" => $MoreCommentsArray, "postId" => $postId, "totalRecords" => $totalrecords,'NetworkId'=>$userDetails['NetworkId'],'streamId'=>$streamId,"profile"=>$profile));
        } else {

            $obj = array("status" => "fail", "data" => "", "postId" => $postId, "error" => "");
        }
        } catch (Exception $exc) {
             Yii::log("Exceptio" . $exc->getMessage(), "error", "application");
    }

       
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used to get the user followers and following users list, It will search by 'Email'.
     * @param: 'searchkey' is the string.
     */
    public function actionGetUserFollowingAndFollowersForInvite() {
        try {
            $result = array();
            if (isset($_REQUEST['searchkey'])) {

                $searchKey = $_REQUEST['searchkey'];
                $categoryType = $_REQUEST['categoryType'];
                $postId = $_REQUEST['postId'];
                $mentionArray = isset($_REQUEST['existingUsers']) ? json_decode($_REQUEST['existingUsers']) : array();
                $userId = $this->tinyObject['UserId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->getFollowingFollowerUsersForInvite($searchKey, $userId, $postId, $categoryType, $mentionArray);
            }
              $obj = $this->rendering($result);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserFollowingAndFollowers==" . $ex->getMessage(), "error", "application");
        }
    }

    /**
     * @author Sagar
     * This method is to get the stream details
     */
    public function actionGetAbusedPosts() {
        if (isset($_GET['StreamPostDisplayBean_page'])) {
            $pageSize = 10;
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                'pagination' => array('pageSize' => $pageSize),
                'criteria' => array(
                    'conditions' => array(
                        'UserId' => array('==' => 0),
                        'IsAbused' => array('==' => 1)
                    ),
                    'sort' => array('AbusedOn' => EMongoCriteria::SORT_DESC)
                )
            ));
            if ($provider->getTotalItemCount() == 0) {
                $stream = 0; //No posts
            } else if ($_GET['StreamPostDisplayBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                $streamRes = (object) (CommonUtility::prepareStreamData($this->tinyObject['UserId'], $provider->getData(), $this->userPrivileges));
                $stream=(object)($streamRes->streamPostData);
            } else {
                $stream = -1; //No more posts
            }
            $this->renderPartial('stream_view', array('stream' => $stream));
        }
    }

    public function actionUpdateNotificationAsRead() {
        try {
            $result = "failed";
            if (isset($_REQUEST['notificationId']) && strtolower($_REQUEST['notificationId']) != "undefined") {
                $notificationId = $_REQUEST['notificationId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->updateNotificationAsRead($notificationId);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
         $obj = $this->rendering($obj);
            echo $obj;
    }

    public function actionMarkallAsRead() {
        try {
            $result = "failed";
            $result = ServiceFactory::getSkiptaPostServiceInstance()->updateAllNotificationsByUserId($this->tinyObject->UserId);
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
         $obj = $this->rendering($obj);
            echo $obj;
    }

    public function actionFileopen() {
        /*
          This function takes a path to a file to output ($file),  the filename that the browser will see ($name) and  the MIME type of the file ($mime_type, optional).
         */
        $file = $_REQUEST['file'];
        $file = Yii::getPathOfAlias('webroot') . $file;
        $pathFragments = explode('/', $file);
        $name = end($pathFragments);
        //$name='91_10_1_TestingFundamentals.pptx';
        $mime_type = "";
        //Check the file premission
        if (!is_readable($file))
            die('File not found or inaccessible!');

        $size = filesize($file);
        $name = rawurldecode($name);
        /* Figure out the MIME type | Check in array */
        $known_mime_types = array(
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html" => "text/html",
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "pptx" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "png" => "image/png",
            "jpeg" => "image/jpg",
            "jpg" => "image/jpg",
            "php" => "text/plain"
        );

        if ($mime_type == '') {
            $file_extension = strtolower(substr(strrchr($file, "."), 1));
            if (array_key_exists($file_extension, $known_mime_types)) {
                $mime_type = $known_mime_types[$file_extension];
            } else {
                $mime_type = "application/force-download";
            };
        };
        //turn off output buffering to decrease cpu usage
        @ob_end_clean();

        // required for IE, otherwise Content-Disposition may be ignored
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');

        /* The three lines below basically make the 
          download non-cacheable */
        header("Cache-control: private");
        header('Pragma: private');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        // multipart-download and download resuming support
        if (isset($_SERVER['HTTP_RANGE'])) {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
            list($range) = explode(",", $range, 2);
            list($range, $range_end) = explode("-", $range);
            $range = intval($range);
            if (!$range_end) {
                $range_end = $size - 1;
            } else {
                $range_end = intval($range_end);
            }
            /*
              ------------------------------------------------------------------------------------------------------
              //This application is developed by www.webinfopedia.com
              //visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!
              ------------------------------------------------------------------------------------------------------
             */
            $new_length = $range_end - $range + 1;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
            header("Content-Range: bytes $range-$range_end/$size");
        } else {
            $new_length = $size;
            header("Content-Length: " . $size);
        }

        /* Will output the file itself */
        $chunksize = 1 * (1024 * 1024); //you may want to change this
        $bytes_send = 0;

        if ($file = fopen($file, 'r')) {

            if (isset($_SERVER['HTTP_RANGE']))
                fseek($file, $range);

            while (!feof($file) &&
            (!connection_aborted()) &&
            ($bytes_send < $new_length)
            ) {
                $buffer = fread($file, $chunksize);
                print($buffer); //echo($buffer); // can also possible
                flush();
                $bytes_send += strlen($buffer);
            }
            fclose($file);
        } else
        //If no permissiion
            die('Error - can not open file.');
        //die
        die();
    }

    /**
     * @author Moin Hussain
     * This method is used to search posts
     */
    public function actionGetPostsForSearch() {
        $searchText = $_POST['search'];
        $offset = $_POST['offset'];
        $pageLength = $_POST['pageLength'];
        $postSearchResult = ServiceFactory::getSkiptaPostServiceInstance()->getPostsForSearch($searchText, $offset, $pageLength);
        $this->renderPartial('post_search', array('postSearchResult' => $postSearchResult));
        //echo CJSON::encode($result);
    }

    /**
     * @author Moin Hussain
     * This method is used to search curbside posts
     */
    public function actionGetCurbPostsForSearch() {
        $searchText = $_POST['search'];
        $offset = $_POST['offset'];
        $pageLength = $_POST['pageLength'];
        $curbPostSearchResult = ServiceFactory::getSkiptaPostServiceInstance()->getCurbPostsForSearch($searchText, $offset, $pageLength);
        $this->renderPartial('post_search', array('postSearchResult' => $curbPostSearchResult));
        //echo CJSON::encode($result);
    }

    /**
     * @author Moin Hussain
     * This method is used to search curbside posts
     */
    public function actionGetPostsForHashtag() {
        $hashtagId = $_POST['hashtagId'];
        $offset = $_POST['offset'];
        $pageLength = $_POST['pageLength'];
        $curbPostSearchResult = ServiceFactory::getSkiptaPostServiceInstance()->getPostsForHashtag($hashtagId, $offset, $pageLength,$this->tinyObject->UserId);
        $this->renderPartial('post_search', array('postSearchResult' => $curbPostSearchResult));
        //echo CJSON::encode($result);
    }

    /**
     * @author vamsikrishna 
     * This method is used to mark the post as featured  
     */
    public function actionMarkOrUnMarkPostAsFeatured() {
        try {
            $returnValue = 'failure';
            if (isset($_REQUEST['postId'])) {

                $postId = $_REQUEST['postId'];
                $networkId = $_REQUEST['networkId'];
                if(isset($_REQUEST['Title']))
                $title = $_REQUEST['Title'];
                else
                $title='';

                $userId = $this->tinyObject['UserId'];

                $categoryType = $_REQUEST['categoryType'];
                $type=$_REQUEST['type'];
                    if($type=='Featured'){
                  $returnValue = ServiceFactory::getSkiptaPostServiceInstance()->updatePostAsFeatured($userId, $postId, $categoryType, $networkId,$title);     
                 }else{
                  $returnValue = ServiceFactory::getSkiptaPostServiceInstance()->updatePostAsUnFeatured($userId, $postId, $categoryType, $networkId);        
                 }
                
                if ($returnValue != 'failure') {
                    $returnValue = 'success';
                }
            }
            $obj = array("status" => $returnValue, "data" => "", "error" => "");
              $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
            return $returnValue;
        }
    }

    public function actionGetFeaturedItemsToDisplay() {
        $returnValue = 'failure';
        try {            
            $featuredItems = ServiceFactory::getSkiptaPostServiceInstance()->getFeaturedPosts();

            if ($featuredItems != "failure") {
                $this->renderPartial('featuredItems', array("status" => 'success', 'featuredItems' => $featuredItems));
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
            return $returnValue;
        }
    }

    /**
     * @author Sagar Pathapelli
     * This method is used to get the invited user list for a post
     */
    public function actionGetInvitedUsers() {
        try {
            $postId = $_REQUEST['PostId'];
            $categoryType = $_REQUEST['CategoryType'];
            $invitedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getInvitedUsersObjectForPost($postId, $categoryType);
            if (is_array($invitedUsers)) {
                $obj = array("status" => 'success', "data" => $invitedUsers, "count" => sizeof($invitedUsers));
            } else {
                $obj = array("status" => "failure", "data" => "", "error" => "");
            }
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
            $obj = array("status" => "error", "data" => "", "error" => "");
          $obj = $this->rendering($obj);
            echo $obj;
        }
         $obj = $this->rendering($obj);
            echo $obj;
    }
    
   public function actionGetpostRecentComments(){
  
  
       if (isset($_REQUEST['postId'])) {
            $postId = $_REQUEST['postId'];
        }
        if (isset($_REQUEST['StreamId'])) {
             $streamId = $_REQUEST['StreamId'];
        }else{
           $streamId="" ;
        }
        
        $MinpageSize = 2;
       // $page = $_REQUEST['Page'];
        $page=0;
        $pageSize = ($MinpageSize * $page);
        $categoryType = (int) $_REQUEST['CategoryType'];
        $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforPost($pageSize, $MinpageSize, $postId, (int) $categoryType);
        
        //  $Comments = ServiceFactory::getSkiptaPostServiceInstance()->getCommentObject($postId,(int)$categoryType); 
        // $TotalComments=count($Comments->Comments);
        $MoreCommentsArray = array();

        foreach ($result as $key => $value) {
            if(!(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist']==1)){
                $commentUserBean = new CommentUserBean();
                $userDetails = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($value['UserId']);
                $createdOn = $value['CreatedOn'];
                $commentUserBean->UserId = $userDetails['UserId'];

                $postId = (isset($value["PostId"])) ? $value["PostId"] : '';
                $CategoryType = (isset($value["CategoryType"])) ? $value["CategoryType"] : '';
                $PostType = (isset($value["PostType"])) ? $value["PostType"] : '';
                if (isset($value["CommentTextLength"]) && $value["CommentTextLength"] > 240) {

                    $appendCommentData = ' <span class="postdetail" data-placement="bottom" rel="tooltip"  data-original-title="See More" data-id="'.$streamId.'" data-postid="' . $postId . '" data-categoryType="' . $CategoryType . '" data-postType="' . $PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                   // $stringArray = str_split($value["CommentText"], 240);
                   // $stringArray = CommonUtility::truncateHtml($value["CommentText"], 240);
                    $stringArray = CommonUtility::truncateHtml($value["CommentText"], 240,'...',true,true,$appendCommentData);
                    $text = $stringArray;
                    $value["CommentText"] = $text;
                } else {

                    $value["CommentText"] = $value["CommentText"];
                }
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
                //$commenturls=$value['WebUrls'];
                 if (array_key_exists('WebUrls', $value)) {
                 if(is_array($value['WebUrls']) && count($value['WebUrls'])>0 && isset($value['WebUrls'])){
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
                         $commentUserBean->CommentText = CommonUtility::findUrlInStringAndMakeLink($commentUserBean->CommentText); 
                    }else{
                         $commentUserBean->IsWebSnippetExist = "";
                    }
                 }
                if (count($value['Artifacts']) > 0) {
                    if(isset($_REQUEST['PageType'])&& $_REQUEST['PageType']=='stream'){
                        $commentUserBean->Resource = $value['Artifacts'][0];
                        $commentUserBean->PageType = "stream";
                    }else if(isset($_REQUEST['PageType'])&& $_REQUEST['PageType']=='postdetail'){
                         $commentUserBean->Resource = $value['Artifacts'];
                         $commentUserBean->PageType = "postdetail";
                    }
                     $commentUserBean->ResourceLength = count($value['Artifacts']);
                }
               
                array_push($MoreCommentsArray, $commentUserBean);
            }
        }

        $totalResultArrayCount=count($MoreCommentsArray);
        $numberofRecordsTofetch=$totalResultArrayCount-$MinpageSize;
        $output = array_slice($MoreCommentsArray, $numberofRecordsTofetch); 
        $totalrecords = count($MoreCommentsArray);
        if ($result) {
             $profile = "/profile/".$userDetails['uniqueHandle'];
            $this->renderPartial('viewMoreComments', array("data" => $output, "postId" => $postId, "totalRecords" => $totalrecords,'streamId'=>$streamId,"profile"=>$profile));
        } else {

            $obj = array("status" => "fail", "data" => "", "postId" => $postId, "error" => "");
        }
       
   } 
    public function actionSaveSharedList() {
        $obj = array();
        try {
            $returnVal = "failure";
            $userId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
            //$userId = $this->tinyObject['UserId'];
            $postId = $_REQUEST['postId'];
            $categoryType = $_REQUEST['categoryType'];
            $shareType = $_REQUEST['shareType'];
            $returnVal = ServiceFactory::getSkiptaPostServiceInstance()->saveSharedList($postId, $userId, $categoryType, $shareType);
            if ($returnVal=='success') {
                $obj = array("status" => 'success', "data" => $returnVal);
            } else {
                $obj = array("status" => "failure", "data" => "", "error" => "");
            }
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
            $obj = array("status" => "error", "data" => "", "error" => "");
            $obj = $this->rendering($obj);
            echo $obj;
        }
         $obj = $this->rendering($obj);
          echo $obj;
    }
 public function actionTrackPostDetailAction(){
       $userId = $this->tinyObject['UserId'];
        $from = $_REQUEST['from'];
       $postId = $_REQUEST['postId'];
       $categoryType = $_REQUEST['categoryType'];
       $postType = $_REQUEST['postType'];
       $networkId = $this->tinyObject['NetworkId'];
       ServiceFactory::getSkiptaPostServiceInstance()->trackPostDetailAction($from,$userId,$postId,$categoryType,$postType,$networkId);
 }    
 public function actionTrackPageLoad(){
      $from = $_REQUEST['from'];
      $userId = $this->tinyObject['UserId'];
       $dataId = "";
       $networkId = $this->tinyObject['NetworkId'];
       if(isset($_REQUEST['dataId'])){
           $dataId = $_REQUEST['dataId'];
       }
      ServiceFactory::getSkiptaPostServiceInstance()->trackPageLoad($userId,$from,$dataId,$networkId);
      $result = array("code"=>200,"status"=>"");
      echo $this->rendering($result);

 }
  public function actionTrackSearchCriteria(){
        $loginUserId = $_REQUEST['userId'];
        $searchText = $_REQUEST['searchText'];
        $networkId = $this->tinyObject['NetworkId'];
        $activityIndex = CommonUtility::getUserActivityIndexByActionType("ProjectSearch");
        $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("ProjectSearch");
        UserInteractionCollection::model()->saveSearchActivity($searchText,$loginUserId,$activityIndex,$activityContextIndex,$networkId);  
    }
    
public function actionTrackEngagementAction(){
      $page = $_REQUEST['page'];
      $action = $_REQUEST['action'];
      $userId = $this->tinyObject['UserId'];
      $dataId = "";
       $id = "";
       if(isset($_REQUEST['dataId'])){
          $dataId= $_REQUEST['dataId'];
       }
       if(isset($_REQUEST['id'])){
          $id= $_REQUEST['id'];
       }
    
        $networkId = $this->tinyObject['NetworkId'];
       $categoryType = $_REQUEST['categoryType'];
       $postType = $_REQUEST['postType'];
      ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId,$page,$action,$dataId,$categoryType,$postType,$networkId, $id);
     $result = array("code"=>200,"status"=>"");
      echo $this->rendering($result);
  
 }  
 public function actionTrackSearchEngagementAction(){
      $page = $_REQUEST['page'];
      $action = $_REQUEST['action'];
       $searchType = $_REQUEST['searchType'];
        $searchText = $_REQUEST['searchText'];
      $userId = $this->tinyObject['UserId'];
      $dataId = "";
       if(isset($_REQUEST['dataId'])){
          $dataId= $_REQUEST['dataId'];
       }
       $networkId = $this->tinyObject['NetworkId'];
      ServiceFactory::getSkiptaPostServiceInstance()->trackSearchEngagementAction($userId,$page,$action,$dataId,$searchText,$searchType,$networkId);
     $result = array("code"=>200,"status"=>"");
      echo $this->rendering($result);
  
 } 
    
 public function actionPostdetail(){
     try{
         $postId = $_REQUEST['postId'];
        $categoryType = $_REQUEST['categoryType'];
        $postType = $_REQUEST['postType'];
        $out = $_REQUEST['outer'];
         $this->render('postdetail',array('postId'=>$postId,'categoryType'=>$categoryType,'postType'=>$postType,'outer'=>$out));
     } catch (Exception $ex) {

     }
 }
 
  /**
     * @Author Vamsi Krishna
     * This method is used to get the user for mentions onky for PrivateGroup.
     * @param: 'searchkey' is the string.
     */
    public function actiongetGroupMembersForPrivateGroups() {
        try {
            $result = array();
            if (isset($_REQUEST['searchkey'])) {

                $searchKey = $_REQUEST['searchkey'];
                $mentionArray = isset($_REQUEST['existingUsers']) ? json_decode($_REQUEST['existingUsers']) : array();
                $groupId=$_REQUEST['groupId'];
                $userId = $this->tinyObject['UserId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->getGroupMembersForMentionsForPrivateGroup($searchKey, $groupId, $mentionArray);
            }
            $obj = $this->rendering($result);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserFollowingAndFollowers==" . $ex->getMessage(), "error", "application");
        }
    }

/**
     * @Author Vamsi Krishna
     * This method is used to get the user followers and following users list, It will search by 'Email'.
     * @param: 'searchkey' is the string.
     */
    public function actionGetroupMembersForPrivateGroupsForInvite() {
        try {
            $result = array();
            if (isset($_REQUEST['searchkey'])) {

                $searchKey = $_REQUEST['searchkey'];
                $categoryType = $_REQUEST['categoryType'];
                $groupId = $_REQUEST['groupId'];
                $postId = $_REQUEST['postId'];
                $mentionArray = isset($_REQUEST['existingUsers']) ? json_decode($_REQUEST['existingUsers']) : array();
                $userId = $this->tinyObject['UserId'];
                $result = ServiceFactory::getSkiptaGroupServiceInstance()->getFollowingFollowerUsersForInviteInPrivateGroup($searchKey, $userId, $postId, $categoryType, $mentionArray,$groupId);
            }
              $obj = $this->rendering($result);
            echo $obj;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserFollowingAndFollowers==" . $ex->getMessage(), "error", "application");
        }
    }
    public function actionFollowAllHashtags(){
        try {
            $userId = (int) (Yii::app()->session['NetworkAdminUserId']);
            echo $userId;
            $hashtagsObj = ServiceFactory::getSkiptaPostServiceInstance()->getHashtagsForCurbsidePost();
            $i=0;
            
            foreach ($hashtagsObj as $key => $hashtag) {echo $i.", ";
                $i++;
                $hashtagId = (string) $hashtag->_id;
                $result = ServiceFactory::getSkiptaPostServiceInstance()->followOrUnfollowHashTag($hashtagId, $userId, 'Follow');
            }
            echo $i." Hashtags followed";
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function actionMobileStream(){
        $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
        echo $this->rendering("success");
    }
     public function actionMobileUnreadNotifications(){
      
//        $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
//        $provider = new EMongoDocumentDataProvider('Notifications',                   
//           array(
//                'pagination' => FALSE,
//                'criteria' => array( 
//                   'conditions'=>array(                       
//                       'UserId'=>array('==' => (int) $userId),                       
//                       'isRead' => array('==' => (int) 0)
//                       ),
//                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
//                 )
//               ));    
//            $data = $provider->getData();
//           
//            if($provider->getItemCount() > 0){
//                $result = CommonUtility::prepareStringToNotification($data);
//                $obj = array("data"=>$result,"notificationCount"=>  sizeof( $provider->getData()));
//                
//            }else{
//                $obj = array('status' => 'success', 'data' => 0, 'error' => "");                
//            }
//            echo $this->rendering($obj);
    } 

    public function actiongetPostWidget(){
    try {
       $siteurl = YII::app()->getBaseUrl('true');
            if (isset($_REQUEST['postId'])) {

                $postId = $_REQUEST['postId'];
                $timezone = $_REQUEST['Timezone'];

                // $timezone='Asia/Kolkata';
                $groupsfollowing = ServiceFactory::getSkiptaPostServiceInstance()->getUserFollowingGroupsIDs((int) $this->tinyObject['UserId']);
                array_push($groupsfollowing, '');

                $condition = array(
                    '_id' => array('in' => array(new MongoID($postId))),
                    'UserId' => array('in' => array($this->tinyObject['UserId'], 0)),
                    'GroupId' => array('in' => $groupsfollowing),
                    'IsDeleted' => array('!=' => 1),
                    'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                    'IsAbused' => array('notIn' => array(1, 2)),
                    'CategoryType' => array('notIn' => array(7)),
                    'IsNotifiable' => array('==' => (int) 1)
                );
                // }

                $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                    'criteria' => array(
                        'conditions' => $condition,
                        'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                    )
                ));
                ;


                $UserId = Yii::app()->session['PostAsNetwork'] == 1 ? Yii::app()->session['NetworkAdminUserId'] : $this->tinyObject['UserId'];

                $dataArray = array_merge($provider->getData(), $this->getDerivateObjectsStream($UserId));
                $streamRes = (object) (CommonUtility::prepareStreamData($UserId, $dataArray, $this->userPrivileges, 0, Yii::app()->session['PostAsNetwork'], $timezone));
                $stream=(object)($streamRes->streamPostData);
                foreach ($stream as $data) {
                    $postType = $data->PostType;
                    $postId = $data->PostId;
                    $category = $data->CategoryType;
                    $gamename = $data->GameName;
                    $gamesheduledId = $data->CurrentGameScheduleId;
                }
                $loadedPage = "";
                if ($postType == '11' || $postType == '12') {
                    $loadedPage = 'game';
                } elseif ($postType == '2') {
                    $loadedPage = 'eventpost';
                } elseif ($postType == '3') {
                    $loadedPage = 'surveypost';
                } else {
                    $loadedPage = 'normalpost';
                }
                $loginUserId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
                if ($postType == '12') {
                    // $url="$siteurl"."/".$gamename."/". $gamesheduledId."/detail/game";
                    $url = "$siteurl" . "/common/postdetail?postId=$gamesheduledId&categoryType=9&postType=$gamename&trfid=$loginUserId";
                } else {
                    $url = "$siteurl" . "/common/postdetail?postId=$postId&categoryType=$category&postType=$postType&trfid=$loginUserId";
                }


                $this->renderPartial($loadedPage, array('stream' => $stream, 'siteurl' => $siteurl, 'url' => $url));
            }

    } catch (Exception $exc) {
         Yii::log($exc->getMessage(), 'error', 'application');
    }
  }

  public function actionGetCurbsidePostsByCategory() {
        $categoryId = $_REQUEST['categoryId'];
        $offset = $_REQUEST['offset'];
        $pageLength = $_REQUEST['pageLength'];
        $curbPostSearchResult = ServiceFactory::getSkiptaPostServiceInstance()->getCurbsidePostsByCategory($categoryId, $offset, $pageLength,$this->tinyObject->UserId);
        $this->renderPartial('post_search', array('postSearchResult' => $curbPostSearchResult));
    }
    public function actionGetPostsForHashtagSearch() {
        $hashtagId = $_POST['hashtagId'];
        $offset = $_POST['offset'];
        $pageLength = $_POST['pageLength'];
        $curbPostSearchResult = ServiceFactory::getSkiptaPostServiceInstance()->getPostsForHashtagSearch($hashtagId, $offset, $pageLength,$this->tinyObject->UserId);
       
        $this->renderPartial('post_search', array('postSearchResult' => $curbPostSearchResult));
        
    }
}
 
