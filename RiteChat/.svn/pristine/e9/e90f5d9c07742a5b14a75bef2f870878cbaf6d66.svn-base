<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RestGameController extends Controller {
    
      public function init() {
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            CommonUtility::reloadUserPrivilegeAndData($this->tinyObject->UserId);
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
        } else {
            
        }
    }
     public function actionGetGameWall(){
         error_log("--------------actionGetGameWall-----------".$_POST['Page']);
          try {  
           if (isset($_POST['Page'])) {
            $_GET['StreamPostDisplayBean_page'] = (int) $_POST['Page'];
            $streamIdArray = array();
            $previousStreamIdArray = array();
             $timezone = $_REQUEST['timezone'];
            $previousStreamIdString = isset($_POST['previousStreamIds'])?$_POST['previousStreamIds']:"";
            if(!empty($previousStreamIdString)){
                $previousStreamIdArray = explode(",", $previousStreamIdString);
            }
             $userId= (int)$_POST['loggedUserId'];
             $pageSize = Yii::app()->params['MobilePageLength'];
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

                     $condition = array(
                        'UserId' => array('in' => array(0)),
                        'IsDeleted' => array('!=' => 1),
                        'IsBlockedWordExist' => array('notIn' => array(1, 2)),
                        'IsAbused' => array('notIn' => array(1, 2)),
                        'CategoryType' => array('==' => 9),
                        'IsNotifiable'=> array('==' => 1),  
                    );
             
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
                   $streamRes = (object) (CommonUtility::prepareStreamDataForMobile_V3($userId, $provider->getData(), "", 0,"",$timezone, $previousStreamIdArray));
                   $streamIdArray=$streamRes->streamIdArray;
                   $totalStreamIdArray=$streamRes->totalStreamIdArray;
                   $totalStreamIdArray = array_values(array_unique($totalStreamIdArray));
                   $streamIdArray = array_values(array_unique($streamIdArray));
                   $stream=(object)($streamRes->streamPostData);
                } else {
                    
                    $stream = -1; //No more posts
                }
              if($stream == 0 || $stream == -1){
                    echo json_encode(array('stream'=>$stream));
              }else{
                   $obj = array('stream' => array_values((array)$stream));
              echo json_encode($obj); 
              }
             
        }  
        
       
      } catch (Exception $exc) {
          error_log($exc->getLine()."****************".$exc->getMessage());
          Yii::log('In Excpetion gameprofilebox'.$exc->getMessage(),'error','application');
      }
    }
    public function actionGetCurrentScheduleGame(){
        try{
           $userId=$_POST["userId"];
           $currentScheduleGame=ServiceFactory::getSkiptaGameServiceInstance()->getCurrentGameSchedule($this->userPrivileges,$userId);
           if(is_object($currentScheduleGame)){
               $currentScheduleGame->Followers = [];
                $descriptionLength = strlen($currentScheduleGame->GameDescription);
                  if ($descriptionLength > 100) {
                      $description = CommonUtility::truncateHtml($currentScheduleGame->GameDescription, 100);
                       $currentScheduleGame->GameDescription = trim($description) . "  ...";
                      
                   } 
                   if($currentScheduleGame->HighestUserProfilePicture==""){
                        $currentScheduleGame->HighestUserProfilePicture = Yii::app()->params['ServerURL']."/images/system/user_noimage.png";  
  
                   }else{
                         $currentScheduleGame->HighestUserProfilePicture = Yii::app()->params['ServerURL'].$currentScheduleGame->HighestUserProfilePicture;  
  
                   }
             $currentScheduleGame->GameBannerImage =Yii::app()->params['ServerURL'].$currentScheduleGame->GameBannerImage ; 
             echo json_encode(array('currentScheduleGame'=>$currentScheduleGame)); 
             
           }else{
               echo json_encode(array()); 
           }
          

            
        } catch (Exception $ex) {
            error_log("actionGetCurrentScheduleGame---".$ex->getLine()."----".$ex->getMessage());
        }
        
    }
    public function actionGetGameById(){
          $userId=$_POST["userId"];
         $currentScheduleGame=ServiceFactory::getSkiptaGameServiceInstance()->getCurrentGameSchedule($this->userPrivileges,$userId);
             if(is_object($currentScheduleGame)){
               $currentScheduleGame->Followers = [];
                $descriptionLength = strlen($currentScheduleGame->GameDescription);
                  if ($descriptionLength > 100) {
                      $description = CommonUtility::truncateHtml($currentScheduleGame->GameDescription, 100);
                       $currentScheduleGame->GameDescription = trim($description) . "  ...";
                      
                   } 
                  $currentScheduleGame->HighestUserProfilePicture = Yii::app()->params['ServerURL'].$currentScheduleGame->HighestUserProfilePicture;  
             $currentScheduleGame->GameBannerImage =Yii::app()->params['ServerURL'].$currentScheduleGame->GameBannerImage ; 
             echo json_encode(array('currentScheduleGame'=>$currentScheduleGame)); 
             
           }else{
               echo json_encode(array()); 
           }
         
          
    }
   public function actionRenderGameDetailed() {
        $postId = $_REQUEST['postId'];
        $categoryType = (int)$_REQUEST['categoryType'];
        $postType = (int)$_REQUEST['postType'];
        $gameName = $_REQUEST['gameName'];
        $gameScheduleId = $_REQUEST['scheduleId'];
        $userId = (int)$_REQUEST['userId'];
        error_log("ganem anme-----".$gameName."---".$gameScheduleId."---userId---".$userId);
      //  $object =  GameCollection::model()->getGameDetailsObject('Id',$postId);
       // $object->GameBannerImage = Yii::app()->params['ServerURL'].$object->GameBannerImage;
   $gameDetailsArray=ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailsByName($userId,$gameName,$gameScheduleId);      
   $gameDetailsArray[0]->GameBannerImage = Yii::app()->params['ServerURL'].$gameDetailsArray[0]->GameBannerImage;
  
  // $gameDetailsArray[0]->QuestionImage = Yii::app()->params['ServerURL'].$gameDetailsArray[0]->QuestionImage;
    
             
                $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforPost('', '', $postId, (int) $categoryType);
       
                $rs=array_reverse($result);
                $commentDisplayCount = 5;
                $MoreCommentsArray = CommonUtility::prepareCommentObject($rs, $commentDisplayCount);
   
   $data=array("data" => array("gameDetails"=>$gameDetailsArray[0],"gameBean"=>$gameDetailsArray[1],'commentsdata'=>$MoreCommentsArray,'serverURL'=>Yii::app()->params['ServerURL']));
        
         echo  json_encode((array)$data);
   }
    public function actionShowGame(){
        try {
            error_log("actionshwogame-----------------------");
        $type = $_POST['type'];
        $gameId = $_POST['gameId'];
        $gameScheduleId = $_POST['gameScheduleId'];
        $userId = $_POST['userId'];
        error_log("type---".$type."---gameId--".$gameId."----gamescheudleId=----".$gameScheduleId);
        ServiceFactory::getSkiptaGameServiceInstance()->showGame($userId,$type,$gameId,$gameScheduleId);
        $questionsArray=ServiceFactory::getSkiptaGameServiceInstance()->getQuestionsForGame($userId,$type,$gameId,$gameScheduleId);
        if($type == "view" || $type == "viewAdmin"){
         $data  = array("questions"=>$questionsArray[0],"disclaimer"=>$questionsArray[1],'serverURL'=>Yii::app()->params['ServerURL']);
         echo  json_encode((array)$data);
        }else{
        $data = array("questions"=>$questionsArray[0],"disclaimer"=>$questionsArray[1],"type"=>$type,'serverURL'=>Yii::app()->params['ServerURL']);
        echo  json_encode((array)$data);
        }

    }
    catch (Exception $exc) {
        error_log("Exception-----------".$exc->getMessage());
          Yii::log('In Excpetion saveScheduleGame'.$exc->getMessage(),'error','application');
      }
    } 
    
       public function actionSubmitGame(){
        try {
        $gameId = $_POST['gameId'];
        $gameScheduleId = $_POST['scheduleId'];
        $userId = $_POST['userId'];
        $result = ServiceFactory::getSkiptaGameServiceInstance()->submitGame($userId,$gameId,$gameScheduleId);
         echo  json_encode(array("result"=>$result,'serverURL'=>Yii::app()->params['ServerURL']));
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
        $userId = $_POST['userId'];
        $questionsArray=ServiceFactory::getSkiptaGameServiceInstance()->saveAnswer($userId,$gameId,$gameScheduleId,$questionId,$answer);
       echo  json_encode("success");
    }
    catch (Exception $exc) {
          Yii::log('In Excpetion saveScheduleGame'.$exc->getMessage(),'error','application');
      }
    } 
    
}