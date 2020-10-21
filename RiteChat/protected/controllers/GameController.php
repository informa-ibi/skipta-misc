<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GameController extends Controller {
  

public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
    
    public function init() {
    parent::init();
       if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj']) && (Yii::app()->session['IsAdmin'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
            $this->whichmenuactive=4;
             $this->sidelayout = 'no';
          } else {
                  $this->redirect('/');
             }
 }
  public function actionIndex(){
      try {
          
           $gamesToSchedule=  ServiceFactory::getSkiptaGameServiceInstance()->getGamesToSchedule();    
           $userId=$this->tinyObject['UserId'];
           $currentScheduleGame=ServiceFactory::getSkiptaGameServiceInstance()->getCurrentGameSchedule($this->userPrivileges,$userId);
           
           $gameName;
           $gameDescription;
           if(!is_string($gamesToSchedule)){
               $gameId=$gamesToSchedule[0]['_id'];               
               $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByIdObject($gameId);
               $gameName=$gameDetails->GameName;
               $gameDescription=$gameDetails->GameDescription;
           }
           $this->render('index' ,array('gamesToSchedule'=>$gamesToSchedule,'GameName'=>$gameName,'GameDescription'=>$gameDescription,'currentScheduleGame'=>$currentScheduleGame));
     
      } catch (Exception $exc) {
          Yii::log('In Excpetion'.$exc->getMessage(),'error','application');
      }      
 }

   public function actionGameWall(){
       try {
           $scheduleForm=new ScheduleGameForm();
           $gamesToSchedule=  ServiceFactory::getSkiptaGameServiceInstance()->getGamesToSchedule();
           $scheduleForm->GameName=$gamesToSchedule;
           $this->render('gameWall' ,array('scheduleForm'=>$scheduleForm,'gamesToSchedule'=>$gamesToSchedule));
       } catch (Exception $exc) {           
          Yii::log('In Excpetion Game Wall'.$exc->getMessage(),'error','application');
       }
      }
      
       public function actionUploadThankYouImage(){
      try {         
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $folder=Yii::getPathOfAlias('webroot').'/upload/';// folder for uploaded files
            if ( !file_exists($folder) ) {
                mkdir ($folder, 0755,true);
               }
            $allowedExtensions = array("jpg","jpeg","gif","png","tiff");//array("jpg","jpeg","gif","exe","mov" and etc...
           // $sizeLimit = 30 * 1024 * 1024;// maximum file size in bytes
             $sizeLimit= Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                    $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
                    $fileName=$result['filename'];//GETTING FILE NAME
            $extension=$result['extension'];
             
            $ext="game/thankyou";
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
            echo $return;// it's array
    } catch (Exception $exc) {
        Yii::log($exc->getTraceAsString(), "error", "application");
    }
    } 
    
    public function actionGetGameDetailsById(){
        try {
            if(isset($_REQUEST['selectedGameId'])){
               $gameId=$_REQUEST['selectedGameId'];              
               $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByIdObject($gameId);                
             $obj = array('status' => 'success', 'data' => $gameDetails->CurrentScheduleId, 'error' => '', 'GameDescription'=>$gameDetails->GameDescription,'GameName'=>$gameDetails->GameName);
             $renderScript = $this->rendering($obj);
            echo $renderScript;
            }
           
        } catch (Exception $exc) {
            Yii::log('In Excpetion Game Wall'.$exc->getMessage(),'error','application');
        }
    }

     public function actionGameDetails(){
        try {
            $urlArray =  explode("/", Yii::app()->request->url);
            $gameName=$urlArray[1];
            $gameScheduleId=$urlArray[2];
                  $mode=$urlArray[3];
           $MoreCommentsArray = array();
           $tinyUserProfileObject = array();
            $object = array();
            $gameDetailsArray=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByName($this->tinyObject->UserId,$gameName,$gameScheduleId);
            //This code is for get post all comment and prepare comments data with web snippets  
//            if($gameDetailsArray=="failure"){
//                 $this->render('/user/error');
//            }
            $postId = $gameDetailsArray[0]->_id;
            $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforPost($pageSize, $MinpageSize, $gameDetailsArray[0]->_id, (int) 9);
             $MinpageSize = 2;
       // $page = $_REQUEST['Page'];
        $page=0;
        $pageSize = ($MinpageSize * $page);
        $categoryType = (int) $categoryType;
        $commentDisplayCount = 0;
        if($result!="failure" && count($result)>0){
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
        }
             $commentedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getCommentedUsersForPost($postId, (int)($this->tinyObject['UserId']));
        $IsUserCommented = in_array((int)($this->tinyObject['UserId']), $commentedUsers);
            $this->render('gameDetail',array("gameDetails"=>$gameDetailsArray[0],"gameBean"=>$gameDetailsArray[1],"mode"=>$mode,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented));

            
        } catch (Exception $exc) {
            Yii::log('In Excpetion Game Wall'.$exc->getMessage(),'error','application');
        }

        
    }


  public function actionNewgame(){
     
       $urlArray =  explode("/", Yii::app()->request->url);
            $GameId="";
            $type=$urlArray[2];
            if($type=="edit"){
                $GameId=$urlArray[3];
            }
            
            
       $newGameModel = new GameCreationForm();
        $UserId = $this->tinyObject['UserId'];
        $Gamedata=array();
        
         if (isset($GameId) && $GameId!="") {
           // $gameId=$GameId;
            //$gameId='5398364bb96c3d320e8b457c';
            $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsById($GameId);
            foreach ($gameDetails as $key => $value) {
              
                    $Gamedata = $value;
                }
         }else{
             $gameId="";
//                 $gameId='53a10942b96c3def248b4570';
//                 $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsById($gameId);
//                  foreach ($gameDetails as $key => $value) {
//              
//                    $Gamedata = $value;
//                }
                //print_r($Gamedata);exit;
              $Gamedata=array();
         }
        
        $this->render('creategame', array('newGameModel' => $newGameModel,'gameId' => $GameId,'gameDetails'=>$Gamedata));
        
    }
    
 public    function actionsortArrayOfArray($array, $on, $order=SORT_ASC)
{
   
 $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;

    
}
    
    
    
    
     public function actionNewgameCreation(){
      
       $newGameModel = new GameCreationForm();
        //$UserId = $this->tinyObject['UserId'];
        $UserId = Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject->UserId;
         $NetworkId=$this->tinyObject['NetworkId'];
        if (isset($_POST['GameCreationForm'])) {
            
            $newGameModel->attributes = $_POST['GameCreationForm'];
            $newGameModel->CreatedBy = Yii::app()->session['PostAsNetwork']==1?$this->tinyObject->UserId:0;
            $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->saveNewGame($newGameModel,$NetworkId,$UserId);
             
            if($gameDetails!="failure" && $gameDetails!='Duplicate' && $gameDetails!='update'){
                
                 $obj = array("status"=>'success',"message"=>'');
            }else if($gameDetails=="Duplicate" ){
                
                $message=$newGameModel->GameName."Already exist";
                 $obj = array("status"=>'failure',"error"=>$message);
            }else if($gameDetails=="update" ){
                
                
                 $obj = array("status"=>'success',"message"=>'update');
            }else{
                $obj = array("status"=>'failure',"error"=>$gameDetails);
            }
           
            
             echo CJSON::encode($obj);
            
        }

       
    }
    
    
    public function actionEditgame(){
       $newGameModel = new GameCreationForm();
        $UserId = $this->tinyObject['UserId'];
        
        $gameId='5398364bb96c3d320e8b457c';
        
        if (isset($_REQUEST['GameId'])) {
            
            $gameId=$_REQUEST['GameId'];
           // $gameId='5398364bb96c3d320e8b457c';
            $newGameModel->attributes = $_POST['GameCreationForm'];
            $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsById($gameId);
            
        }
        $Gamedata=array();
        foreach ($gameDetails as $key => $value) {
            //echo $key;
            $Gamedata=$value;
            
        }
        
        $Questions=$this->actionsortArrayOfArray($Gamedata['Questions'],'Position',SORT_ASC);
        
        if($gameDetails!="failure"){
                 //$obj = array("status"=>'success','gameDetails'=>$Gamedata);
                 
                  $Id = $_REQUEST['QuestionId'];
                  $Id=0;
                  $this->renderPartial("editgame", array('QuestionId' => $Id,'gameDetails'=>$Questions));
                 
            }else{
                 $obj = array("status"=>'failure');
            }
            
    }
    
    
     public function actionUploadGameBannerImage() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            //  $folder=Yii::getPathOfAlias('webroot').'/temp/';// folder for uploaded files
            $folder = Yii::app()->params['ArtifactSavePath'];
            $webroot = Yii::app()->params['WebrootPath'].'/upload/Group/Profile/';
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

            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }  
    
  public function actionAddNewQuestion(){
      $Id = $_REQUEST['Id'];
       $this->renderPartial("newQuestion", array('QuestionId' => $Id));
      
  }  

    
  public function actionsaveScheduleGame(){
      try {
          $newScheduleGame=new ScheduleGameForm();
          if(isset($_POST['ScheduleGameForm'])){
                $newScheduleGame->attributes = $_POST['ScheduleGameForm'];
                $userId=$this->tinyObject['UserId'];
                $errors = CActiveForm::validate($newScheduleGame);
                if ($errors != '[]') {
                    $obj = array('status' => 'error', 'data' => '', 'error' => $errors);
                }else{
                  $gameId=$newScheduleGame->GameName;
                  
                  $streamId=$newScheduleGame->StreamId;
                       $startDate=$newScheduleGame->StartDate;
                    $endDate=$newScheduleGame->EndDate." 23:59:59";
                    $startDate =  CommonUtility::convert_time_zone(strtotime($startDate), date_default_timezone_get(),Yii::app()->session['timezone']);
                    $endDate =  CommonUtility::convert_time_zone(strtotime($endDate),date_default_timezone_get(),Yii::app()->session['timezone']);
             
                    $isExists=ServiceFactory::getSkiptaGameServiceInstance()->checkForScheduleGame($startDate,$endDate);
                     //return;
                     $newScheduleGame->StartDate = $startDate;
                    $newScheduleGame->EndDate = $endDate;
                    if(is_object($isExists) || is_array($isExists)){
                       $gameName=$isExists->GameName;
                    //$errorMessage='<b>'.$gameName .'</b> is already scheduled between   ' .date(Yii::app()->params['PHPDateFormat'],$isExists->StartDate->sec) ." to ". date(Yii::app()->params['PHPDateFormat'],$isExists->EndDate->sec);
                    $errorMessage='<b>'.$gameName .'</b> is already scheduled between   ' .date(Yii::app()->params['PHPDateFormat'],CommonUtility::convert_date_zone($isExists->StartDate->sec,Yii::app()->session['timezone'],  date_default_timezone_get())) ." to ". date(Yii::app()->params['PHPDateFormat'],CommonUtility::convert_date_zone($isExists->EndDate->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));

                    $obj = array('status' => 'Exists', 'data' => $errorMessage, 'error' => $errors);   
                    }else{
                          
                      $result=ServiceFactory::getSkiptaGameServiceInstance()->saveScheduleGame($newScheduleGame,$userId);
                        $result='success';
                        if($result=='success'){
                         $obj = array('status' => 'success', 'data' => 'Game Scheduled Successfully', 'error' => '','gameId'=>$gameId,'streamId'=>$streamId);      
                        }else{
                         $obj = array('status' => 'error', 'data' => '', 'error' => '');         
                        }
                        
                    } 
                  
                    
                }
                 $renderScript = $this->rendering($obj);
                echo $renderScript;
          }
          
      } catch (Exception $exc) {
          Yii::log('In Excpetion saveScheduleGame'.$exc->getMessage(),'error','application');
      }
    }
    public function actionShowGame(){
        try {
        $type = $_POST['type'];
        $gameId = $_POST['gameId'];
        $gameScheduleId = $_POST['gameScheduleId'];
        ServiceFactory::getSkiptaGameServiceInstance()->showGame($this->tinyObject->UserId,$type,$gameId,$gameScheduleId);
        $questionsArray=ServiceFactory::getSkiptaGameServiceInstance()->getQuestionsForGame($this->tinyObject->UserId,$type,$gameId,$gameScheduleId);
        if($type == "view" || $type == "viewAdmin"){
         $this->renderPartial('questionsView',array("questions"=>$questionsArray[0],"disclaimer"=>$questionsArray[1]));
    
        }else{
       $this->renderPartial('questionsPlay',array("questions"=>$questionsArray[0],"disclaimer"=>$questionsArray[1],"type"=>$type));
    
        }

    }
    catch (Exception $exc) {
          Yii::log('In Excpetion saveScheduleGame'.$exc->getMessage(),'error','application');
      }
    } 
    public function actionSaveAnswer(){
        try {
        $gameId = $_POST['gameId'];
        $gameScheduleId = $_POST['scheduleId'];
        $questionId = $_POST['questionId'];
        $answer = $_POST['answer'];
        $questionsArray=ServiceFactory::getSkiptaGameServiceInstance()->saveAnswer($this->tinyObject->UserId,$gameId,$gameScheduleId,$questionId,$answer);

    }
    catch (Exception $exc) {
          Yii::log('In Excpetion saveScheduleGame'.$exc->getMessage(),'error','application');
      }
    } 
    public function actionSubmitGame(){
        try {
        $gameId = $_POST['gameId'];
        $gameScheduleId = $_POST['scheduleId'];
        $result = ServiceFactory::getSkiptaGameServiceInstance()->submitGame($this->tinyObject->UserId,$gameId,$gameScheduleId);
        $this->renderPartial('thankyou',array("result"=>$result));
    }
    catch (Exception $exc) {
          Yii::log('In Excpetion saveScheduleGame'.$exc->getMessage(),'error','application');
      }
    } 
  public function actionloadGameWall(){
      
          try
        {   
              if(isset($_GET['StreamPostDisplayBean_page']))
        {
            $streamIdArray = array();
            $previousStreamIdArray = array();
            $previousStreamIdString = isset($_POST['previousStreamIds'])?$_POST['previousStreamIds']:"";
            if(!empty($previousStreamIdString)){
                $previousStreamIdArray = explode(",", $previousStreamIdString);
            }
            $userId=$this->tinyObject['UserId'];
            $pageSize = 6;
           // $scheduleGames = ServiceFactory::getSkiptaGameServiceInstance()->getScheduleGamesForGameWall();
          $isNotifiable=1;  
          if(Yii::app()->session['IsAdmin']!=1){
           $isNotifiable=0; 
          }
            
             if (isset($_GET['filterString'])) {
                   
                 $cDate=date('m/d/y');
                 if($_GET['filterString']=='FutureSchedule'){
                      $condition = array(
                        'UserId' => array('in' => array(0,$this->tinyObject['UserId'])),                    
                        'CategoryType' => array('==' => 9),

                        'StartDate'=>array('>'=> date('Y-m-d')),
                       'IsDeleted' => array('!=' => 1),
                       'IsAbused' => array('notIn' => array(1, 2)),
                          

                    );   
                }
                 else if($_GET['filterString']=='SuspendedGames'){
                  
                         $condition = array(
                       'UserId' => array('in' => array(0,$this->tinyObject['UserId'])),
                        'IsDeleted' => array('==' => 1),
                        'CategoryType' => array('==' => 9),
                       
                    );
                     
                }
                
                else {
                    $condition = array(
                       'UserId' => array('in' => array(0,$this->tinyObject['UserId'])),
                        'IsDeleted' => array('!=' => 1),
                        'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                        'IsAbused' => array('notIn' => array(1, 2)),
                        'CategoryType' => array('==' => 9),
                    );
                }
        
             }else{
                if(Yii::app()->session['IsAdmin']==1){
                  $condition = array(
                        'UserId' => array('in' => array(0)),
                        'IsDeleted' => array('!=' => 1),
                        'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                        'IsAbused' => array('notIn' => array(1, 2)),
                        'CategoryType' => array('==' => 9),
                    );
                }else{
                     $condition = array(
                        'UserId' => array('in' => array(0)),
                        'IsDeleted' => array('!=' => 1),
                        'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                        'IsAbused' => array('notIn' => array(1, 2)),
                        'CategoryType' => array('==' => 9),
                        'IsNotifiable'=> array('==' => 1),  
                    );
                }
             }
     
            $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',
            array(
                 'pagination' => array('pageSize' => $pageSize),
                 'criteria' => array( 
                    'conditions'=> $condition,
                    'sort'=>array('OriginalPostTime'=>EMongoCriteria::SORT_DESC)
                  )
                ));
           
            if ($provider->getTotalItemCount() == 0) {
                    $stream = 0; //No posts
                } else if ($_GET['StreamPostDisplayBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                    $UserId =  Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject['UserId'];
                   $streamRes = (object) (CommonUtility::prepareStreamData($UserId, $provider->getData(), $this->userPrivileges, 0,Yii::app()->session['PostAsNetwork'],'', $previousStreamIdArray));
                   $streamIdArray=$streamRes->streamIdArray;
                   $totalStreamIdArray=$streamRes->totalStreamIdArray;
                   $totalStreamIdArray = array_values(array_unique($totalStreamIdArray));
                   $streamIdArray = array_values(array_unique($streamIdArray));
                   $stream=(object)($streamRes->streamPostData);
                } else {
                    
                    $stream = -1; //No more posts
                }

                $streamData = $this->renderPartial('gameWall', array('stream' => $stream), true);
                $streamIdString = implode(',', $streamIdArray);
                echo $streamData."[[{{BREAK}}]]".$streamIdString;
        }  
        
       
      } catch (Exception $exc) {
          error_log("****************".$exc->getMessage());
          Yii::log('In Excpetion gameprofilebox'.$exc->getMessage(),'error','application');
      }
    }
    
  public function actionUpdateGameFields(){
      
      $gameId=$_REQUEST['gameId'];
      $gameField=$_REQUEST['gameFiled'];
      $Fieldvalue=$_REQUEST['Filedvalue'];
      $gameUpdatedFieldvalue=ServiceFactory::getSkiptaGameServiceInstance()->UpdateGameFields($gameId,$gameField,$Fieldvalue);
      
      if($gameUpdatedFieldvalue!="failure"){
          
                 $obj = array("status"=>'success','FieldDescription'=>$gameUpdatedFieldvalue);
            }else{
                 $obj = array("status"=>'failure');
            }
           
            
             echo CJSON::encode($obj);
      
      
      
  }
  public function actionGameAnalytics(){
     $type = $_REQUEST['type'];
     if($type == "getGames"){
      $games = ServiceFactory::getSkiptaGameServiceInstance()->getGamesForAnalytics();
       $this->renderPartial('gameAnalytics',array("type"=>$type,"games"=>$games));
     }else  if($type == "getCumilative" && isset($_REQUEST['selectedGameId'])){
         $selectedGameId = $_REQUEST['selectedGameId'];
          $gameAnalytics = ServiceFactory::getSkiptaGameServiceInstance()->getGameAnalytics($selectedGameId);
          $this->renderPartial('gameAnalytics',array("type"=>$type,"gameCumulativeAnalytics" => $gameAnalytics)); 
     }else if($type == "getDetail"){
          $selectedGameId = $_REQUEST['selectedGameId'];
          $startLimit = $_REQUEST['startLimit'];
          $pageLength = $_REQUEST['pageLength'];
          $gameDetailAnalytics = ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailAnalytics($selectedGameId,$startLimit,$pageLength);
          $this->renderPartial('gameAnalytics',array("type"=>$type,"gameDetailAnalytics" => $gameDetailAnalytics[0],"totalCount" => $gameDetailAnalytics[1],"gameId"=>$selectedGameId,"gameName"=>$gameDetailAnalytics[2])); 

     }
     
 }
  
  

public function actionloadGameSchedule(){
    try {
        if(isset($_REQUEST['gameId'])){          
          $scheduleForm=new ScheduleGameForm();  
          $scheduleForm->GameName=$_REQUEST['gameId'];  
          $scheduleForm->StreamId=$_REQUEST['streamId'];  
          Yii::app()->clientScript->scriptMap=array('jquery.yiiactiveform.js'=>false,'jquery.js'=>false,);
          $data =  $this->renderPartial('scheduleGame', array('scheduleForm'=>$scheduleForm),true,true);
          echo $data;
        }
         
    } catch (Exception $exc) {
        error_log("======".$exc->getMessage());
    }
}  

      public function actionCancelSchedule() {
      try{
          $gameId = $_REQUEST['postId'];
          $scheduleId = $_REQUEST['scheduleId'];
        $return =  ServiceFactory::getSkiptaGameServiceInstance()->cancelSchedule($gameId,$scheduleId);
     
         if ($return != "failure") {
            $obj = array("status" => 'success');
        } else {
            $obj = array("status" => 'failure');
        }
         $obj = $this->rendering($obj);
            echo $obj;
      }catch(Exception $exc){
            Yii::log('In Excpetion actionCancelSchedule'.$exc->getMessage(),'error','application');
             $obj = array("status" => 'failure');
              echo CJSON::encode($obj);
      }
    }
   public function actionSuspendGame() {
      try{$gameId = $_REQUEST['postId'];
   Yii::log($gameId.'In Excpetion gameprofilebox','error','application');
        $return =  ServiceFactory::getSkiptaGameServiceInstance()->suspendGame($gameId,$_REQUEST['actionType']);
     
         if ($return != "failure") {
            $obj = array("status" => 'success');
        } else {
            $obj = array("status" => 'failure');
        }
         $obj = $this->rendering($obj);
            echo $obj;
      }catch(Exception $exc){
            Yii::log('In Excpetion gameprofilebox'.$exc->getMessage(),'error','application');
             $obj = array("status" => 'failure');
              echo CJSON::encode($obj);
      }
    }
    public function actionloadSchduleGameWidget(){
        try {
            if(isset($_REQUEST['streamId'])){
                $streamId=$_REQUEST['streamId'];
                $gameId=$_REQUEST['gameId'];
                $condition = array(
                        'PostId' =>  array('==' => new MongoId($gameId)),
                        '_id' =>  array('==' => new MongoId($streamId)),                        
                        'CategoryType' => array('==' => 9),
                    );
                
             $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean',
            array(
                 
                 'criteria' => array( 
                    'conditions'=> $condition,
                    'sort'=>array('StartDate'=>EMongoCriteria::SORT_ASC)
                  )
                )); 
             if ($provider->getTotalItemCount() == 0) {
                    $stream = 0; //No posts
                } else  {
                    $UserId =  Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject['UserId'];
                   $streamRes = (object) (CommonUtility::prepareStreamData($UserId, $provider->getData(), $this->userPrivileges, 0, Yii::app()->session['PostAsNetwork']));
                   $stream=(object)($streamRes->streamPostData);
                } 
            
                $this->renderPartial('gameWall', array('stream' =>  $stream)); 
            }
            
        } catch (Exception $exc) {
            error_log("_________________________________________________".$exc->getMessage());
        }
        }
        
        
        public function actionrendergGameDetailed(){
            $returnValue='failure';
            try {
               $gameId=$_REQUEST['postId'];               
               $gameDetails=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByIdObject($gameId);                             
               if(is_object($gameDetails)){
                   $obj = array("status" => 'success',"gameName"=>$gameDetails->GameName,"currentScheduleId"=>(String)$gameDetails->CurrentScheduleId);
               }else{
                   $obj = array("status" => 'failure');
               }
               
               $obj = $this->rendering($obj);
            echo $obj;
               
            } catch (Exception $exc) {
               $obj = array("status" => 'failure');
               $obj = $this->rendering($obj);
            echo $obj;
            }
                }
    public function actiongamedetail(){
     try{
         $postId = $_REQUEST['postId'];
        $categoryType = $_REQUEST['categoryType'];
        $postType = $_REQUEST['postType'];
        $out = $_REQUEST['outer'];
         $this->render('/post/postdetail',array('postId'=>$postId,'categoryType'=>$categoryType,'postType'=>$postType,'outer'=>$out));
     } catch (Exception $ex) {
          Yii::log('In Excpetion Game Detail'.$exc->getMessage(),'error','application');
     }
 }
 
 public function actionGamedetailed(){
      try {

            $gameName = $_REQUEST['postType'];
            $gameScheduleId = $_REQUEST['postId'];
            $mode = 'detail';

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
 
 
 
}