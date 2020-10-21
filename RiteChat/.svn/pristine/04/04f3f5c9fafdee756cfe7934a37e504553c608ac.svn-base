<?php

/**
 *  @author Vamsi Krishna 
 *  This is the service Method for all the Games 
 */
class SkiptaGameService {


    public function saveNewGame($newGameModel,$NetworkId,$userId) {

        try {
            $returnvalue="failure";
            $gamesList=GameCollection::model()->getGameDetailsByType('GameName',$newGameModel->GameName);
            $Gamestatus="";
            $gameMode= $newGameModel->Iscreated;
            if(is_array($gamesList) && count($gamesList)>0 && $gameMode!=1){
                $returnvalue='Duplicate';
            }else{
             
            $gameCollectionObj = new GameCollection();
              $gameCollectionObj->NetworkId = (int)$NetworkId;
            $gameCollectionObj->GameName = $newGameModel->GameName;
            $gameCollectionObj->GameId = $newGameModel->GameId;
            // $gameId= $newGameModel->GameId;
           // = $newGameModel->GameBannerImage;
                    //'/upload/Game/Profle/featureditem.png';
            
            $gameCollectionObj->GameDescription = $newGameModel->GameDescription;
            if(isset($newGameModel->CreatedOn) && !empty($newGameModel->CreatedOn)){
                $gameCollectionObj->CreatedOn = new MongoDate(strtotime($newGameModel->CreatedOn));
            }else{
                $gameCollectionObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d', time())));
            }
            $gameCollectionObj->UserId = (int) $userId;
            $gameCollectionObj->GameAdminUser = (int) $userId;
            $gameCollectionObj->CreatedBy = (int)(isset($newGameModel->CreatedBy)?$newGameModel->CreatedBy:0);
            $gameCollectionObj->Status = (int) 1;
            array_push($gameCollectionObj->Followers, (int)$userId);
            
            $Questions=array();
            if(isset($newGameModel->MigratedGameId) && !empty($newGameModel->MigratedGameId)){
                $gameCollectionObj->MigratedGameId = $newGameModel->MigratedGameId;
                $gameCollectionObj->GameBannerImage = $newGameModel->GameBannerImage;
                $arr = $newGameModel->Questions;
            }else{
               $gameCollectionObj->GameBannerImage=$this->saveGameArtifacts($newGameModel->GameBannerImage,$newGameModel->GameId);
               $questionsA = $newGameModel->Questions;
              $arr = CJSON::decode($questionsA);
            }
                
           $gameCollectionObj->Resources =$this->saveResourceForGame($gameCollectionObj->GameBannerImage,$newGameModel->CreatedOn);
           $gameCollectionObj->QuestionsCount = count($arr);
           $questionIdArray = array();//key-migratedQuestionId, value-NewQuestionId
            for ($i = 0; $i < count($arr); $i++) {
               
                $question = $arr[$i];
               
                 $QuestionBean=new QuestionsBean(); 
                if(isset($newGameModel->MigratedGameId) && !empty($newGameModel->MigratedGameId)){
                    $QuestionBean->QuestionId=new MongoId();
                    $quesId = $question['questionId'];
                    $questionIdArray["$quesId"] = (string)$QuestionBean->QuestionId;
                }else{
                    $QuestionId=stripslashes($question['questionId']);
                    if($QuestionId==""){
                        $QuestionBean->QuestionId=new MongoId();
                    }else{
                        $QuestionBean->QuestionId=$QuestionId;
                    }
                }
                $QuestionBean->Question = stripslashes($question['question']);
                $QuestionBean->QuestionDisclaimer = stripslashes($question['question_disclaimer']);
                $QuestionBean->OptionA = stripslashes($question['optionA']);
                $QuestionBean->OptionADisclaimer = stripslashes($question['optionA_disclaimer']);
                $QuestionBean->OptionB = stripslashes($question['optionB']);
                $QuestionBean->OptionBDisclaimer = stripslashes($question['optionB_disclaimer']);
                $QuestionBean->OptionC = stripslashes($question['optionC']);
                $QuestionBean->OptionCDisclaimer = stripslashes($question['optionC_disclaimer']);
                $QuestionBean->OptionD = stripslashes($question['optionD']);
                $QuestionBean->OptionDDisclaimer = stripslashes($question['optionD_disclaimer']);
                $QuestionBean->Points = (int)stripslashes($question['points']);
                $QuestionBean->Position = (int)stripslashes($question['position']);
               // error_log("before game question imageeeeeeeeeeeeeeeeeeeeeee".stripslashes($question['image']));
                if($question['image']!=""){
                    if(isset($newGameModel->MigratedGameId) && !empty($newGameModel->MigratedGameId)){
                        $QuestionBean->QuestionImage = $question['image'];
                        $QuestionBean->Resources =$this->saveResourceForGame($QuestionBean->QuestionImage,$newGameModel->CreatedOn);
                    }else{
                         $QuestionBean->QuestionImage = $this->saveGameArtifacts(stripslashes($question['image']),stripslashes($question['questionId']));
                         $QuestionBean->Resources =$this->saveResourceForGame($QuestionBean->QuestionImage);
                    }
                }else{
                    
                }
               
                
                $QuestionBean->CorrectAnswer = stripslashes($question['answer']);
                array_push($Questions,$QuestionBean);
                
            } 
               $gameCollectionObj->Questions = $Questions;
               //error_log(print_r($Questions,true));
               
                $gameId= $newGameModel->GameId;
               if($gameId==""){
                  
                    $gameId=GameCollection::model()->SaveGame($gameCollectionObj);
                     $Gamestatus="create";
               }else{
                  
                   $gameId=$this->UpdateGame($gameCollectionObj);
                   $Gamestatus="update";
                   
               }
               
            
            if($gameId!="failure"){
               
                $returnvalue=$gameId;
               
                 $categoryId = CommonUtility::getIndexBySystemCategoryType('Game');
               
                $gameDetails = GameCollection::model()->getGameDetailsObject('Id',$gameId);
               // error_log("useridddddddddddddddddddddddddddddddddddddddddddd".$gameDetails->UserId);
                    $createdDate=time();
                    if(isset($newGameModel->CreatedOn) && !empty($newGameModel->CreatedOn)){
                        $createdDate = strtotime($newGameModel->CreatedOn);
                    }
                  CommonUtility::prepareStreamObject((int)$gameDetails->UserId,"Post",$gameDetails->_id,$categoryId,"","", $createdDate);     
                  
                  if($Gamestatus=="update"){
                      $returnvalue="update";
                  }
                
            }
            if(isset($newGameModel->MigratedGameId) && !empty($newGameModel->MigratedGameId)){
                $returnvalue = array("GameId"=>(string)$gameId,"QuestionIdArray"=>$questionIdArray);
            }
            } 
            return $returnvalue;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }

    public function scheduleGame($scheduleGameFormObj) {
        try {
            $scheduleObject = new ScheduleGameCollection();
            $gameDetails = GameCollection::model()->getGameDetailsByType($type, $gameId);
            if (!is_string($gameDetails)) {
                $scheduleObject->GameName = $gameDetails->GameName;
                $scheduleObject->GameDescription = $gameDetails->GameDescription;
                $scheduleObject->GameId = $gameDetails->GameDescription;
            }
            $scheduleObject->ShowDisclaimer=$scheduleGameFormObj->ShowDisclaimer;
            $scheduleObject->ShowThankYou=$scheduleGameFormObj->ShowThankYou;
            $scheduleObject->ThankYouMessage=$scheduleGameFormObj->ThankYouMessage;
            $scheduleObject->ThankYouArtifact=$scheduleGameFormObj->ThankYouArtifact;
            $scheduleObject->StartDate=$scheduleGameFormObj->StartDate;
            $scheduleObject->EndDate=$scheduleGameFormObj->EndDate;
            $scheduleObject->IsPromoted=$scheduleGameFormObj->IsPromoted;
            
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }
    public function getGamesToSchedule() {
        try {
            $gamesList=GameCollection::model()->getAllGames();
            return $gamesList;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }
     
    public function getGameDetailsById($gameId){
        try {
             $gamesList=GameCollection::model()->getGameDetailsByType('Id',$gameId);
            return $gamesList;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
        }
     public function getGameDetailsByIdObject($gameId){
        try {
             $gamesList=GameCollection::model()->getGameDetailsObject('Id',$gameId);
            return $gamesList;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
        }
    
    
    public function loadGameWall() {
        try {
            
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }

    public function checkForScheduleGame($startDate,$endDate) {
        try {
            
            $isExists=ScheduleGameCollection::model()->checkGameScheduleForDates($startDate,$endDate);
            
            return $isExists;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }
    
   public function saveScheduleGame($newScheduleGame,$userId, $createdDate="") {
        try {
            $returnValue='failure';
            $previousSchedule = 0;
            $previousScheduleDetails = ScheduleGameCollection::model()->getScheduleGameDetailsObject('GameId', $newScheduleGame->GameName);

            if (!is_string($previousScheduleDetails)) {
                $previousSchedule = $previousScheduleDetails;
            }
            $currentScheduleGame = 0;
            $sDate = strtotime($newScheduleGame->StartDate);
            $cDate = strtotime(date('m/d/y H:i:s'));

            $IsNotifiable=0;

            if ($sDate < $cDate) {
                GameCollection::model()->updateGameForIsCurrentSchedule("IsCurrentSchedule", (int) 1, $newScheduleGame->GameName);
                $currentScheduleGame = (int) 1;
                $IsNotifiable=1;
            }
            $scheduleDetails = ScheduleGameCollection::model()->getScheduleGameDetailsObject('IsCurrentSchedule', (int) 1);
            $stream = $this->checkStreamExistsForGame($newScheduleGame->GameName, $newScheduleGame->StartDate, $newScheduleGame->EndDate);
            $result = ScheduleGameCollection::model()->saveScheduleGame($newScheduleGame, $currentScheduleGame,$userId, $createdDate);
            GameCollection::model()->updateGameForIsCurrentSchedule("CurrentScheduleId", $result, $newScheduleGame->GameName);           

            if ($stream == 'insert') {
                $returnValue='success';
                $categoryId = CommonUtility::getIndexBySystemCategoryType('Game');
                $gameDetails = GameCollection::model()->getGameDetailsObject('Id', $newScheduleGame->GameName);

                if ($scheduleDetails->GameId == $newScheduleGame->GameName) {
                    // CommonUtility::prepareStreamObject((int)$gameDetails->UserId,"Post",$gameDetails->_id,$categoryId,$result,$previousSchedule, time());       
                } else {
                  //  CommonUtility::prepareStreamObject((int) $gameDetails->UserId, "Post", $gameDetails->_id, $categoryId, $result, $previousSchedule, time());
                }
                // CommonUtility::prepareStreamObject((int)$gameDetails->UserId,"Post",$gameDetails->_id,$categoryId,$result,$previousSchedule, time());       
            } else if ($stream == 'streamPartialUpdate') {
                if ($scheduleDetails->GameId != $newScheduleGame->GameName) {
                $userStreamBean = new UserStreamBean();
                $userStreamBean->ActionType='GameSchedule';
                $userStreamBean->StartDate=$newScheduleGame->StartDate;
                $userStreamBean->EndDate=$newScheduleGame->EndDate;
                $userStreamBean->PostId=$newScheduleGame->GameName;
                $userStreamBean->RecentActivity=$stream;                
                $userStreamBean->CurrentGameScheduleId=(string)$result;
                $userStreamBean->CreatedOn = time();
                $userStreamBean->IsNotifiable = $IsNotifiable;
                error_log('__________notifiable_2________________'.$IsNotifiable);
                if($createdDate!=""){
                    $userStreamBean->CreatedOn=strtotime($createdDate);

                }                
                Yii::app()->amqp->stream(json_encode($userStreamBean));
                 //   $returnValue=UserStreamCollection::model()->updatePartialUserStreamForGame($newScheduleGame->GameName, $newScheduleGame->StartDate, $newScheduleGame->EndDate, $result);
                }
            } else if ($stream == 'streamTotalUpdate') {
                $pastSchedule = ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($newScheduleGame->GameName, $newScheduleGame->StartDate, $newScheduleGame->EndDate, "past");
                $userStreamBean = new UserStreamBean();
                $userStreamBean->PreviousGameScheduleId = (string)$pastSchedule->_id;
                $userStreamBean->PreviousSchedulePlayers = $pastSchedule->Players;
                $userStreamBean->PreviousScheduleResumePlayers = $pastSchedule->ResumePlayers;
                $userStreamBean->CurrentGameScheduleId = (string)$result;
                $userStreamBean->CurrentScheduledPlayers = array();
                $userStreamBean->CurrentScheduleResumePlayers = array();              
                $userStreamBean->IsNotifiable = $IsNotifiable;
                $userStreamBean->ActionType='GameSchedule';
                $userStreamBean->PostId=$newScheduleGame->GameName;                
                $userStreamBean->RecentActivity=$stream;
                $userStreamBean->CreatedOn = time();
                if($createdDate!=""){
                    $userStreamBean->CreatedOn=strtotime($createdDate);
                }                
                Yii::app()->amqp->stream(json_encode($userStreamBean));
                $returnValue='success';
                //$returnValue=UserStreamCollection::model()->updateStreamForGameSchedule($userStreamBean);
            }

//            if (!is_string($result)) {
//                //  $categoryId = CommonUtility::getIndexBySystemCategoryType('Game');
//                //  $gameDetails = GameCollection::model()->getGameDetailsObject('Id', $newScheduleGame->GameName);
////                if($scheduleDetails->IsCurrentSchedule!=1){
////                  CommonUtility::prepareStreamObject((int)$gameDetails->UserId,"Post",$gameDetails->_id,$categoryId,$result,$previousSchedule, time());       
////                }else if($scheduleDetails->IsCurrentSchedule==1 && $result==$scheduleDetails->_id){
////                    CommonUtility::prepareStreamObject((int)$gameDetails->UserId,"Post",$gameDetails->_id,$categoryId,$result,$previousSchedule, time());       
////                }
//
//
//
//                
//            }$result = 'success';
            if(isset($newScheduleGame->MigratedScheduleId) && !empty($newScheduleGame->MigratedScheduleId)){
                $returnValue = $result;//ScheduleId
            }
            return $returnValue;
        } catch (Exception $exc) {            
            error_log("--exception---------" . $exc->getMessage());
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function getGameDetailsByName($userId,$gameName,$gameScheduleId){
        try {
            $gameBean = new GameDetailBean();
             $gameObj=GameCollection::model()->getGameDetailsObject('GameName',$gameName);
             if(GameCollection::model()->isUserCommented($userId,$gameObj->_id)=="exist"){
                $gameBean->isCommented = true;
            }else{
                $gameBean->isCommented = false;

            }
             
            // error_log(print_r($gameObj));
            if($gameScheduleId!=0){
             $scheduleGameObj=ScheduleGameCollection::model()->getScheduleGameDetailsObject('Id',$gameScheduleId);
             if($scheduleGameObj=="failure"){
                 return "failure";
             }
             $ResumePlayers = $scheduleGameObj->ResumePlayers;
             $Players = $scheduleGameObj->Players;
            $userGameStatus = ScheduleGameCollection::model()->findUserGameStatus($userId,$scheduleGameObj->_id,$scheduleGameObj->StartDate);
            $gameBean->gameStatus = $userGameStatus;
             $gameBean->gameScheduleId = $scheduleGameObj->_id;
           
             $userObj = UserCollection::model()->getTinyUserCollection($gameObj->HighestScoreUserId);
               $gameBean->highestScoreUserName = $userObj->DisplayName;
                 $gameBean->uniqueHandle = $userObj->uniqueHandle;
                 $gameBean->highestGameUserId = $userObj->UserId;
                 
                 if($userObj->profile70x70==""){
                         
                 $gameBean->highestScoreUserPicture = Yii::app()->params['ServerURL']."/images/system/user_noimage.png";  
                   }else{
                         $gameBean->highestScoreUserPicture = $userObj->profile70x70;
                   }
                 
                 
              
               $gameBean->CategoryType = 9;
                if($userId == $gameObj->GameAdminUser){
                    $gameBean->isGameAdmin =1;
                }else{
                      $gameBean->isGameAdmin =0;
                }
                 }
                 $gameBean->loveCount = count($gameObj->Love);
                  $gameBean->followCount = count($gameObj->Followers);
                    $gameBean->commentCount = count($gameObj->Comments);
                     error_log("###################idd".$gameObj->HighestScoreUserId);
                    error_log("###################333000". $gameObj->Love);
                     $gameBean->isLoved = in_array($userId, $gameObj->Love);
                      $gameBean->isFollowed = in_array($userId, $gameObj->Followers);
                      //  $gameBean->isCommented = in_array($userId, $gameDetails->Followers);
                $shortDescription = CommonUtility::truncateHtml($gameObj->GameDescription, 240);
                 $gameBean->shortDescription =$shortDescription;
           
             return array($gameObj,$gameBean);
        } catch (Exception $exc) {
            error_log("exception------------------".$exc->getMessage());
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
        }
          public function showGame($userId,$type,$gameId,$gameScheduleId){
           try {
               if($type == "play"){
                $gameObj=  ScheduleGameCollection::model()->startGame($userId,$gameId,$gameScheduleId);   
               }
           } catch (Exception $ex) {
            Yii::log('Exception' . $ex->getMessage(), 'error', 'application');

           }  
        }
        public function getQuestionsForGame($userId,$type,$gameId,$gameScheduleId){
           try {
                 $scheduleGameObj = ScheduleGameCollection::model()->getScheduleGameDetailsObject("Id",$gameScheduleId);
                $gameObj = GameCollection::model()->getGameDetailsObject("Id",$gameId);
                $questions = $gameObj->Questions;
               $questions=$this->actionsortArrayOfArray($questions,'Position',SORT_ASC);
               if($type == "play"){
              
                return array($questions,$scheduleGameObj->ShowDisclaimer); 
               }
               else  if($type == "resume"){

               $finalQuestionArray = array();
                foreach ($questions as $question) {
               $answer = ScheduleGameCollection::model()->checkUserAnswered($userId,$gameId,$gameScheduleId,$question['QuestionId']);
                $questionAnswer = array();    
               if($answer!="notexist"){
                        $questionAnswer["question"] = $question;
                        $questionAnswer["answer"] = $answer;
                    }else{
                        $questionAnswer["question"] = $question;
                        $questionAnswer["answer"] = ""; 
                    }
                    array_push($finalQuestionArray, $questionAnswer);
                }
                return array($finalQuestionArray,$scheduleGameObj->ShowDisclaimer); 
               }
                else  if($type == "view"){

               $finalQuestionArray = array();
                foreach ($questions as $question) {
               $answer = ScheduleGameCollection::model()->checkUserAnswered($userId,$gameId,$gameScheduleId,$question['QuestionId']);
                $questionAnswer = array();    
               if($answer!="notexist"){
                        $questionAnswer["question"] = $question;
                        $questionAnswer["answer"] = $answer;
                         $questionAnswer["correctAnswer"] = $question["CorrectAnswer"];
                    }else{
                        $questionAnswer["question"] = $question;
                        $questionAnswer["answer"] = ""; 
                        $questionAnswer["correctAnswer"] = $question["CorrectAnswer"];
                    }
                    array_push($finalQuestionArray, $questionAnswer);
                }
                return array($finalQuestionArray,$scheduleGameObj->ShowDisclaimer); 
               }
                   else  if($type == "viewAdmin"){

               $finalQuestionArray = array();
                foreach ($questions as $question) {
               $answer = ScheduleGameCollection::model()->checkUserAnswered($userId,$gameId,$gameScheduleId,$question['QuestionId']);
                $questionAnswer = array();    
               if($answer!="notexist"){
                        $questionAnswer["question"] = $question;
                        $questionAnswer["answer"] = "";
                         $questionAnswer["correctAnswer"] = $question["CorrectAnswer"];
                    }else{
                        $questionAnswer["question"] = $question;
                        $questionAnswer["answer"] = ""; 
                        $questionAnswer["correctAnswer"] = $question["CorrectAnswer"];
                    }
                    array_push($finalQuestionArray, $questionAnswer);
                }
                return array($finalQuestionArray,$scheduleGameObj->ShowDisclaimer); 
               }
           } catch (Exception $ex) {
            Yii::log('Exception' . $ex->getMessage(), 'error', 'application');

           }  
        }


        public function saveAnswer($userId,$gameId,$gameScheduleId,$questionId,$answer){
            try{
           ScheduleGameCollection::model()->saveAnswer($userId,$gameId,$gameScheduleId,$questionId,$answer);
            } catch (Exception $exc) {
             Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
            }
        }
         public function submitGame($userId,$gameId,$gameScheduleId, $totalTimeSpent=0, $createdDate=""){
           try{
               $createdDate=$createdDate==""?time():strtotime(date($createdDate, time()));
               error_log("servic submmit game-----------------".$gameScheduleId);
         $response =  ScheduleGameCollection::model()->submitGame($userId,$gameId,$gameScheduleId,$totalTimeSpent);
         $dataObj = array("UserId"=>(int)$userId,"TotalPoints"=>(int)$response['totalPoints']); 
         if(is_array($response)){
          CommonUtility::prepareStreamObject((int)$userId,"Play",$gameId,9,'',$dataObj,$createdDate);
  
         }
      return $response;
          
         } catch (Exception $ex) {
            Yii::log('Exception' . $ex->getMessage(), 'error', 'application');
           }
        }


   public function getCurrentGameSchedule($userPrivileges,$userId){

       try {
           $returnValue='failure';
           
           $currentScheduleGame=GameCollection::model()->getGameDetailsObject('IsCurrentSchedule',(int)1);
          
           
          if(is_object($currentScheduleGame)){
              $gameObj=new GameBean();
              $gameObj->GameId=$currentScheduleGame->_id;
              $gameObj->GameName=$currentScheduleGame->GameName;
              $gameObj->GameDescription=$currentScheduleGame->GameDescription;
              $gameObj->GameBannerImage=$currentScheduleGame->GameBannerImage;             
              $gameObj->QuestionsCount=$currentScheduleGame->QuestionsCount;
              $gameObj->PlayersCount=$currentScheduleGame->PlayersCount;
              if($userId==$currentScheduleGame->GameAdminUser){
                $gameObj->GameAdminUser=1;
              }else{
                $gameObj->GameAdminUser=0;
              }
               $shortDescription = CommonUtility::truncateHtml($currentScheduleGame->GameDescription, 240);
                 $gameObj->ShortDescription =$shortDescription;
              $gameObj->Followers=$currentScheduleGame->Followers;
              $gameObj->FollowersCount=count($currentScheduleGame->Followers);
              $gameObj->CategoryType=9;
              $gameObj->CommentCount=count($currentScheduleGame->Comments);
              $gameObj->PostType=$currentScheduleGame->Type;
              $gameObj->NetworkId=1;
              $gameObj->Love=Count($currentScheduleGame->Love);
              $gameObj->IsLoved=in_array($userId, $currentScheduleGame->Love);              
                $gameObj->IsCommented=in_array($userId, $currentScheduleGame->Comments);
                foreach ($currentScheduleGame->Comments as $comment) {
                    if($comment["UserId"] == $userId){
                         $gameObj->IsCommented=true;
                         break;
                    }
                }
                   $gameObj->IsFollowed=in_array($userId, $currentScheduleGame->Followers);
              $schedule=ScheduleGameCollection::model()->getScheduleGameDetailsObject('IsCurrentSchedule',1);
              $gameObj->ScheduleId=$schedule->_id;
              $scheduleDetails=ScheduleGameCollection::model()->findUserGameStatus($userId,$schedule->_id);
              if(isset($scheduleDetails)){
                  $gameObj->GameStatus=$scheduleDetails;
                  $scheduleDetailsById=ScheduleGameCollection::model()->getGameScheduleById('Id',$schedule->_id);
                  if(isset($scheduleDetailsById)){                      
                  $gameObj->StartDate=$scheduleDetailsById->StartDate->sec;                  
                  $gameObj->EndDate=$scheduleDetailsById->EndDate->sec;
                  }
                  
                  
              }
              if($currentScheduleGame->GameHighestScore>0){
                  $HuserId=$currentScheduleGame->HighestScoreUserId;
                  $gameObj->HighestScore=$currentScheduleGame->GameHighestScore;
                  $userDetails=ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($HuserId);
                  if(isset($userDetails)){
                     $gameObj->HighestUserProfilePicture=$userDetails->ProfilePicture;
                     $gameObj->HUserName=$userDetails->DisplayName;
                     $gameObj->HighestUserId=$userDetails->UserId;
                     
                     
                  }
              }
              $returnValue =$gameObj;
          }
         return  $returnValue;
       } catch (Exception $exc) {
           error_log("=============EXCEPTION=========================================".$exc->getMessage());
          Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
       }
          
   }
   
  public function getScheduleGamesForGameWall(){
      try {
         $gameIds=array();
          $scheduleGames=ScheduleGameCollection::model()->getAllScheduleGames();
          if(!is_string($scheduleGames)){
              
              foreach($scheduleGames as $sGames){
                 array_push($gameIds,$sGames['GameId']); 
              }
          }
          return array_unique($gameIds);
      } catch (Exception $exc) {
          Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
      }
        
  }
  
  
 public function saveGameArtifacts($Artifacts,$QuestionId) {
        try {
           
            $returnValue = 'failure';
            // $folder=Yii::getPathOfAlias('webroot'); 
            
             $folder=Yii::app()->params['WebrootPath'];
             $returnarry=array();
            if ($Artifacts!="") {
                
                   $ExistArtifact=$folder.'/'.$Artifacts;
                    /// $ExistMediaArtifact=$folder.'/upload/Game/Media/'.$Artifacts;
                     if(!file_exists($ExistArtifact) ){
                         $QuestionId="";
                         
                       
                         
                     }else{
                       
                     }
                
                
                if($QuestionId==""){
                    
                     
                      if (!file_exists($ExistArtifact) && !file_exists($ExistMediaArtifact) ) {
                //}
               
               // foreach ($Artifacts as $key => $artifact) {                    
                 
                    $imgArr = explode(".", $Artifacts);
                    $date = strtotime("now");
                    $finalImg_name = $imgArr[0] . '.' . end($imgArr);
                     $finalImage = trim($imgArr[0]) .'.'. end($imgArr);
                  
                     $fileNameTosave = $folder.'/temp/'. $imgArr[0] .'.'. end($imgArr);
                    $sourceArtifact=$folder.'/temp/'.$Artifacts;
                   rename($sourceArtifact, $fileNameTosave);
                    //  $filename=$result['filename'];
                    $extension = substr(strrchr($Artifacts, '.'), 1);
                    $extension=  strtolower($extension);
                   // error_log("_________________________extension_________________________________".$extension);
                    if($extension=='mp4' || $extension=='mp3'|| $extension=='avi'){
                        $ext="video";
                        $path = 'Media';
                        
                   }else{
                       $path = 'Profile';
                   }                   
                          
                    $path = '/upload/Game/' . $path;
                   
                        if (!file_exists($folder . '/' . $path)) {
                          
                        mkdir($folder . '/' . $path, 0755, true);
                    }
                   
                    $sourcepath = $fileNameTosave;
                    $destination = $folder . $path . '/' . $finalImage;
                    if (file_exists($sourcepath)) {
                       
                        if (copy($sourcepath, $destination)) {
                            
                            $newfile = trim($imgArr[0]) . '_' . $date . '.' . end($imgArr);
                            //  $newfile=trim($imgArr[0]) .'.' . $imgArr[1];
                            $finalSaveImage = $folder . $path . '/' . $newfile;
                            rename($destination, $finalSaveImage);
                            $UploadedImage =$path . '/' . $newfile;
                            // unlink($sourcepath);


                            
                            $returnValue = "success";
                        }
                        
                        } else {
                            $UploadedImage =$path . '/' . $Artifacts;
                        }
                    }
                //}

            }else{
               $UploadedImage =$Artifacts; 
            }
            
            }
           return $UploadedImage;   
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function UpdateGame($Gameobj) {

        $questions = $Gameobj->Questions;

        $Gameupdate = GameCollection::model()->UpdateGameDetails($Gameobj);
         UserStreamCollection::model()->UpdateGameDetails($Gameobj);
         
         ScheduleGameCollection::model()->UpdateScheduleGameById($Gameobj);
         UserActivityCollection::model()->updateStreamForGameDetails($Gameobj);
          UserInteractionCollection::model()->updateUserInteractionForGameDetails($Gameobj);
         FollowObjectStream::model()->updateFollowObjectForGameDetails($Gameobj);
         
         
        foreach ($Gameobj->Questions as $key => $value) {

          


            $QuestinExist = GameCollection::model()->CheckQuestionExist($Gameobj->GameId, $value->QuestionId);
            if ($QuestinExist == 'success') {
           

                $QuestinExist = GameCollection::model()->UpdateGame($Gameobj->GameId, $questions[$key]);
            } else {
               
                $QuestinExist = GameCollection::model()->UpdateGameQuestions($Gameobj->GameId, $questions[$key]);
            }
        }
    }

    public function getCurrentScheduleGameForRightsideWidget($userid) {
        try {
            $returnValue = 'failure';
            $currentScheduleGameDetails = ScheduleGameCollection::model()->getScheduleGameDetailsObject('IsCurrentSchedule', (int) 1);
            if (is_object($currentScheduleGameDetails)) {

                $currentScheduleGameStatus = ScheduleGameCollection::model()->findUserGameStatus($userid, $currentScheduleGameDetails->_id);
                $currentScheduleGame = GameCollection::model()->getGameDetailsObject('Id', $currentScheduleGameDetails->GameId);

                $gameObj = new GameBean();
                $gameObj->ScheduleId = $currentScheduleGameDetails->_id;
                $gameObj->GameId = $currentScheduleGameDetails->GameId;
                $gameObj->GameName = $currentScheduleGameDetails->GameName;
                $gameObj->GameDescription = $currentScheduleGameDetails->GameDescription;
                $gameObj->QuestionsCount = $currentScheduleGame->QuestionsCount;
                $gameObj->GameBannerImage = $currentScheduleGame->GameBannerImage;
                $gameObj->PlayersCount = $currentScheduleGame->PlayersCount;
                $gameObj->GameStatus = $currentScheduleGameStatus;

                $returnValue = $gameObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
        
    }
 public function checkStreamExistsForGame($gameId,$startDate,$endDate){
     try {
         $stream='false';
         $isPresent=ScheduleGameCollection::model()->getScheduleGameBetweenDatesByGameId($gameId,$startDate,$endDate);
         
         if(is_object($isPresent)){
          
            $stream='false';    
         }else{
            
            $pastSchedule= ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($gameId,$startDate,$endDate,"past");
            $futureSchedule=ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($gameId,$startDate,$endDate,"future");
            if(is_object($pastSchedule)){                
                
                 $stream='streamTotalUpdate';
             }else if(!is_object($pastSchedule) && is_object($futureSchedule)){
                    $stream='streamPartialUpdate';
             }else{
                  $stream='streamPartialUpdate';
             }
         }
       
         return $stream;
     } catch (Exception $exc) {
         error_log("*****excpetion************".$exc->getMessage());
         Yii::log('Exception___________' . $exc->getMessage(), 'error', 'application');
     }
  }
 public function actionsortArrayOfArray($array, $on, $order=SORT_ASC)
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

    public function UpdateGameFields($gameId,$Gameobj,$Fieldvalue){
        
        try{
            
            $returnValue = 'failure';
            if($Gameobj=='GameBannerImage'){
               
               $Fieldvalue= $this->saveGameArtifacts($Fieldvalue,$gameId);
            }
            $gameUpdatedFieldValue=GameCollection::model()->UpdateGameFields($gameId,$Gameobj,$Fieldvalue);
            if($gameUpdatedFieldValue!='failure'){
                 $returnValue=$gameUpdatedFieldValue;
            }
            
            return $returnValue;
            
        } catch (Exception $ex) {
            
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
        
       
    }


  public function updatePartialStreamForGame($gameId,$startDate,$EndDate){
      $returnValue = 'failure';
      try {
          UserStreamCollection::model()->updatePartialUserStreamForGame($gameId,$startDate,$EndDate);
      } catch (Exception $exc) {
          Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
      }
    }  
    



    
    
    public function saveResourceForGame($artifact,$createdDate='') {
        try {
            $returnValue = 'failure';
            $Resource = array();
            $res = new ResourceBean;
            // if ($Artifacts > 0) {
                //foreach ($Artifacts as $key => $artifact) {
                 $Artifacts=explode("/", $artifact);
            $Artifact=end($Artifacts);
            
                    $extension = substr(strrchr($Artifact, '.'), 1);
                     $extension=  strtolower($extension);
                    if($extension=='mp4' || $extension=='mp3'|| $extension=='avi'){
                        $ext="video";
                        $path = 'Media/' . $Artifact;
                   }else if($extension=='jpg' || $extension=='jpeg' || $extension=='gif' || $extension=='tiff'|| $extension=='png'){
                       $path = 'Profile/' . $Artifact;
                   }
                    $Resource['ResourceName'] = $Artifact;
                        $path = '/upload/Game/' . $path;
                    $thumbNailpath='/upload/Game/';
                    $ArtifactClassName=$this->getArtifactClassName($Artifact,$path,$thumbNailpath, $createdDate);
                     if($extension=='mp3'){
                        $ThumbnailImage="/images/system/audio_img.png";
                    }else if($extension=='mp4' || $extension=='flv'|| $extension=='mov'){
                        
                        $info = pathinfo($Artifact);
                        $image_name =  basename($Artifact,'.'.$info['extension']);
                        $image_name=$image_name.'.'.'jpg';
                        $folder=Yii::getPathOfAlias('webroot').'/upload/Game/thumbnails/'.$image_name;
                        $uploadfile=Yii::getPathOfAlias('webroot').$path;
                       //  exec("ffmpeg -itsoffset -0 -i $uploadfile -vcodec mjpeg -vframes 1 -an -f rawvideo scale=320:-1 $folder");
                        exec("ffmpeg -i $uploadfile -vf scale=320:-1 $folder");
                        $ThumbnailImage='/upload/Game/thumbnails/'.$image_name;
                    }else {
                        $ThumbnailImage=str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    }

                    
                    $Resource['StyleClas']=trim($ArtifactClassName['fileclass']);
                    $Resource['Uri'] = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    $Resource['Extension'] = $extension;
                    $Resource['ThumbNailImage'] = $ThumbnailImage;
                   
                    
//                    $returnValue = ResourceCollection::model()->SaveResourceCollection($ResourceCollectionModel, $postId, $createdDate);
//                    if ($postType == 1 || $postType == 2 || $postType == 3|| $postType == 4) {
//                        PostCollection::model()->updatePostWithArtifacts($postId, $ResourceCollectionModel->attributes);
//                    }else if($postType == 5){
//                         CurbsidePostCollection::model()->updateCurbsidePostWithArtifacts($postId, $res->attributes);
//                    }
               // }

           //}
           return $Resource;   
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getArtifactClassName($artifact,$path,$thumbNailpath, $createdDate='') {
        try {
            $className="";
             $className="img_small_250";
              $new_filepath=$path;
            $result=array();
            // $extension = end(explode(".", strtolower($artifact)));
             $imageExtension=explode(".", strtolower($artifact));
             $extension = end($imageExtension);
             if($createdDate==''){
                if($extension=='jpg' || $extension=='jpeg' || $extension=='gif' || $extension=='tiff'|| $extension=='png'){
                   $filepath=Yii::getPathOfAlias('webroot').$path;
                    if (file_exists($filepath) ) {
                      
                        list($width, $height) = getimagesize($filepath);
                           $newfolder=Yii::getPathOfAlias('webroot').$thumbNailpath.'thumbnails/';// folder for uploaded files
                           if (!file_exists($newfolder) ) {
                                 mkdir ($newfolder, 0755,true);
                                }
                           if($width >='250'){
                           $img = Yii::app()->simpleImage->load($filepath);
                           $img->resizeToWidth(250);
                           $img->save($newfolder.$artifact); 
                           $className="img_big_250";
                         $new_filepath=$thumbNailpath.'thumbnails/' . $artifact;
                       }else{
                           $destination=$newfolder.$artifact;
                           copy($filepath, $destination);
                           $className="img_small_250";
                           $new_filepath=$thumbNailpath.'thumbnails/' . $artifact;
                       }
                    }else{
                       $result['filepath']=$new_filepath;
                       $result['fileclass']=$className; 
                    }


               }
             }
            $result['filepath']=$new_filepath;
            $result['fileclass']=$className;
             return $result;
             
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
 public function getGamesForAnalytics() {
        try {
            $gamesList=GameCollection::model()->getAllGamesForAnalytics();
            return $gamesList;
        } catch (Exception $exc) {
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }
 public function getGameAnalytics($gameId) {
        try {
            if($gameId == "AllGames"){
                $gamesList=GameCollection::model()->getAllGamesForAnalytics(); 
            }
            else{
                 $gamesList=GameCollection::model()->getGameDetailsByType("Id",$gameId); 
            }
                $playersCount = 0;
                $totalTimeSpent = 0;
                $totalPoints = 0;
                 $gameTotalPoints = 0;
                $gameHighestScore = 0;
                foreach ($gamesList as $game) {
                   $playersCount = $playersCount + count($game->Players);
                   if($game->GameHighestScore > $gameHighestScore){
                      $gameHighestScore = $game->GameHighestScore;
                   }
                   $players = $game->Players;
                    $gameTotalPoints = GameCollection::model()->getGameTotalPoints($gameId); 
                   
                   foreach ($players as $player) {
                       $totalTimeSpent = $totalTimeSpent + $player['TotalTimeSpent'];
                       $totalPoints = $totalPoints + $player['TotalPoints'];
                   }
                }
                if($totalPoints>0){
                          $averagePoints = $totalPoints/$playersCount;
                       }else{
                           $averagePoints = 0;
                       }
                  if($totalTimeSpent>0){
                     $averageTime = $totalTimeSpent/$playersCount;// in secs
                /*convert sec to hours*/
                  $averageTime =  gmdate("H:i:s", $averageTime);  
                  }else{
                      $averageTime =0;
                  }
                $cumilativeData = array("playersCount" => $playersCount,"averageTime"=>$averageTime,"gameTotalPoints"=>$gameTotalPoints,"avgPoints" => $averagePoints);
            
            return $cumilativeData;
        } catch (Exception $exc) {
            error_log("exception------------------".$exc->getMessage());
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }
 public function getGameDetailAnalytics($gameId,$startLimit,$pageLength,$type="") {
        try {
            if($gameId!="AllGames"){
                 $gameName =  GameCollection::model()->getGameName($gameId);
            }else{
                $gameName = "All Games";
            }
             
               $totalScheduleCount =  ScheduleGameCollection::model()->getAllScheduleGamesCount($gameId);  
                $scheduleGamesList=  ScheduleGameCollection::model()->getAllScheduleGamesForAnalytics($gameId,$startLimit,$pageLength,$type);
                $scheduleGamesArray = array();
                $questions = $gameObj->Questions;
               
                foreach ($scheduleGamesList as $scheduleGame) {
                    $gameDetailBean = new GameDetailBean();
                    $playersCount = $playersCount + count($scheduleGame->Players);
                    //$gameDetailBean->startDate = $scheduleGame->StartDate;
                   // $gameDetailBean->endDate = $scheduleGame->EndDate;
                     $totalTimeSpent = 0;
                     $totalPoints = 0;
                      $players = $scheduleGame->Players;
                        $gameTotalPoints = GameCollection::model()->getGameTotalPoints($scheduleGame->GameId); 
                      foreach ($players as $player) {
                       $totalTimeSpent = $totalTimeSpent + $player['TotalTimeSpent'];
                       $totalPoints = $totalPoints + $player['TotalPoints'];
                   }
                       if($totalPoints>0){
                          $averagePoints = $totalPoints/$playersCount;
                       }else{
                           $averagePoints = 0;
                       }
                  if($totalTimeSpent>0){
                     $averageTime = $totalTimeSpent/$playersCount;// in secs
                /*convert sec to hours*/
                  $averageTime =  gmdate("H:i:s", $averageTime);  
                  }else{
                      $averageTime =0;
                  }
               
                $gameDetailBean->avgPoints =$averagePoints;
                 $gameDetailBean->gameTotalPoints =$gameTotalPoints;
                $gameDetailBean->averageTime =$averageTime;
                array_push($scheduleGamesArray, array($scheduleGame,$gameDetailBean));
                }
                return array($scheduleGamesArray,$totalScheduleCount,$gameName);
 
        } catch (Exception $exc) {
            error_log("exception------------------".$exc->getMessage());
            Yii::log('Exception' . $exc->getMessage(), 'error', 'application');
        }
    }

        public function suspendGame($gameId,$actionType="Suspend") {
        try {
           $return="failure";
           if($actionType=="Suspend"){
          $return=ScheduleGameCollection::model()->removeFutureGameSchedule($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())),'',"future");
           $currentScheduleGame= GameCollection::model()->isCurrentScheduleGame($gameId);
           GameCollection::model()->suspendORReleaseGame($gameId,1);
           if(isset($currentScheduleGame) && is_object($currentScheduleGame)){
             $currentScheduleGame=  ScheduleGameCollection::model()->updateCurrentScheduleGameByToday($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())));
           }
           
  
           $pastSchedule= ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())),"","past"); 
            if(isset($pastSchedule) && is_object($pastSchedule)){
        
                $userStreamBean = new UserStreamBean();
                        $userStreamBean->PreviousGameScheduleId = '';
                        $userStreamBean->PreviousSchedulePlayers = array();
                        $userStreamBean->PreviousScheduleResumePlayers = array();
                        $userStreamBean->CurrentGameScheduleId = (string)$pastSchedule->_id;
                        $userStreamBean->CurrentScheduledPlayers = $pastSchedule->Players;
                        $userStreamBean->CurrentScheduleResumePlayers = $pastSchedule->ResumePlayers;
                        $userStreamBean->IsNotifiable = 0;
                        $userStreamBean->ActionType = "SuspendGame";
                        $userStreamBean->PostId = $gameId;
                        $userStreamBean->StartDate = $pastSchedule->StartDate->sec;
                        $userStreamBean->EndDate = $pastSchedule->EndDate->sec;
                        $userStreamBean->CategoryType = 9;
                         $userStreamBean->RecentActivity = "PullUpdate";

          
           }else{
                GameCollection::model()->suspendORReleaseGame($gameId,0);
               
                $userStreamBean = new UserStreamBean();
                        $userStreamBean->PreviousGameScheduleId = '';
                        $userStreamBean->PreviousSchedulePlayers = array();
                        $userStreamBean->PreviousScheduleResumePlayers = array();
                        $userStreamBean->CurrentGameScheduleId = "";
                        $userStreamBean->CurrentScheduledPlayers = array();
                        $userStreamBean->CurrentScheduleResumePlayers =array();
                        $userStreamBean->IsNotifiable = 0;
                        $userStreamBean->ActionType = "SuspendGame";
                        $userStreamBean->PostId = $gameId;
                        $userStreamBean->StartDate ="";
                        $userStreamBean->EndDate = "";
                        $userStreamBean->CategoryType = 9;
                         $userStreamBean->RecentActivity = "PartialUpdate";

                       
           }
             GameCollection::model()->updateGameForIsCurrentSchedule("CurrentScheduleId",$userStreamBean->CurrentGameScheduleId,$userStreamBean->PostId);
            }  else {
                $userStreamBean = new UserStreamBean();
                GameCollection::model()->suspendORReleaseGame($gameId,0);
                $pastSchedule = ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), "", "past");
                if (isset($pastSchedule) && is_object($pastSchedule)) {
                    $userStreamBean->IsNotifiable = 1;
                } else {
                    $userStreamBean->IsNotifiable = 0;
                }
                $userStreamBean->CategoryType = 9;

                $userStreamBean->ActionType = "ReleaseGame";
                $userStreamBean->PostId = $gameId;
            }
          
            Yii::app()->amqp->stream(json_encode($userStreamBean));
             return "success";
             
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function cancelSchedule($gameId, $scheduleId) {
        try {
            $return = "failure";
         

                $iscurrentSchedule = ScheduleGameCollection::model()->isCurrentScheduleByScheduleId($gameId, $scheduleId);
                if ($iscurrentSchedule == true) {
                    /**
                     * if schedule is current schedule , then we need to update that schedule today date
                     */
                    $currentScheduleGame = ScheduleGameCollection::model()->updateCurrentScheduleGameByToday($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())));
                } else {
                    $currentScheduleGame = ScheduleGameCollection::model()->removeScheduleByScheduleId($scheduleId);
                }
               //  return;
                $obj = ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), "", "past");
                $iscontainSchedule = false;
                if (isset($obj) && is_object($obj)) {
                    $iscontainSchedule = true;
                } else {
                    $obj = ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($gameId, date("Y-m-d H:i:s",CommonUtility::currentSpecifictime_timezone(date_default_timezone_get())), "", "future");

                    $iscontainSchedule = true;
                }
                if ($iscontainSchedule == true) {
                    $userStreamBean = new UserStreamBean();
                    $userStreamBean->PreviousGameScheduleId = '';
                    $userStreamBean->PreviousSchedulePlayers = array();
                    $userStreamBean->PreviousScheduleResumePlayers = array();
                    $userStreamBean->CurrentGameScheduleId = (string) $obj->_id;
                    $userStreamBean->CurrentScheduledPlayers = $obj->Players;
                    $userStreamBean->CurrentScheduleResumePlayers = $obj->ResumePlayers;
                    $userStreamBean->IsNotifiable = 1;
                    $userStreamBean->ActionType = "CancelScheduleGame";
                    $userStreamBean->PostId = $gameId;
                    $userStreamBean->StartDate = $obj->StartDate->sec;
                    $userStreamBean->EndDate = $obj->EndDate->sec;
                    $userStreamBean->CategoryType = 9;
                    $userStreamBean->RecentActivity = "PullUpdate";
                } else {
                    $userStreamBean = new UserStreamBean();
                    $userStreamBean->PreviousGameScheduleId = '';
                    $userStreamBean->PreviousSchedulePlayers = array();
                    $userStreamBean->PreviousScheduleResumePlayers = array();
                    $userStreamBean->CurrentGameScheduleId = "";
                    $userStreamBean->CurrentScheduledPlayers = array();
                    $userStreamBean->CurrentScheduleResumePlayers = array();
                    $userStreamBean->IsNotifiable = 0;
                    $userStreamBean->ActionType = "CancelScheduleGame";
                    $userStreamBean->PostId = $gameId;
                    $userStreamBean->StartDate = "";
                    $userStreamBean->EndDate = "";
                    $userStreamBean->CategoryType = 9;
                     $userStreamBean->RecentActivity = "PartialUpdate";
                }
               GameCollection::model()->updateGameForIsCurrentSchedule("CurrentScheduleId",$userStreamBean->CurrentGameScheduleId,$userStreamBean->PostId);
                $userStreamBean->CategoryType = 9;
               Yii::app()->amqp->stream(json_encode($userStreamBean));

            return "success";
        } catch (Exception $exc) {
            error_log("**********22Exception2222222222222222222222*****".$exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function getGameByMigratedId($migratedGameId){
        try {
            $gameDetails=GameCollection::model()->getGameDetailsByType('MigratedGameId',$migratedGameId);
            return $gameDetails;
        } catch (Exception $exc) {
            error_log("**********getGameByMigratedId*****".$exc->getMessage());
        }
    }
    
 //This method is used to convert the game banner image to resource in game collection
    
     public function UpdateGamaResourceswithThumbnailImage(){
        try {
          
            $gameDetails=GameCollection::model()->getAllGamesForAnalytics();
           // $date = new MongoDate(strtotime(date('Y-m-d', time())));
            $date = "";
            
            foreach ($gameDetails as $key => $value) {
       
                $Resources = $this->saveResourceForGame($value['GameBannerImage'],$date);
                $gameDetails=GameCollection::model()->UpdateGameResources($value['_id'],$Resources);
              
                
            }
            
            return $gameDetails;
        } catch (Exception $exc) {
            error_log("**********getGameByMigratedId*****".$exc->getMessage());
        }
    }
    
//This method is used to update game resource in userstream collection 
    
     public function UpdateGameResourceswithThumbnailImageInStream(){
        try {
          
            
            $gamepostscount=UserStreamCollection::model()->getAllGamePostsCount();
//            $gameposts=UserStreamCollection::model()->getAllGamePosts();
//           
//            foreach ($gameposts as $key => $value) {
//
//               $Resources = $this->getPostById($value['PostId']);
//               $gameDetails=UserStreamCollection::model()->UpdateGameResource($value['PostId'],$Resources);
//            }
//            
//            return $gameDetails;
        } catch (Exception $exc) {
            error_log("**********getGameByMigratedId*****".$exc->getMessage());
        }
    }
     public function getGameById($gameId){
         error_log("servic gamei di---".$gameId);
           $gameObject =  GameCollection::model()->getGameDetailsObject('Id', $gameId);
           error_log("#################");
           return $gameObject;
    }
    
}
