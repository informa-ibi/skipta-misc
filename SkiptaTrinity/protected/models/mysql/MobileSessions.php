<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MobileSessions extends CActiveRecord{
    
    public $SessionId;
    public $UserId;
    public $PushTokenId;
    public $PushTokenType;
    public $CreatedOn;
    public $UpdatedOn;
    
    
      public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'MobileSessions';
    }
    public function GetCountries(){
        try {
                $resources=Yii::app()->db->createCommand("SELECT * FROM  MobileSessions;")->queryAll();

            } catch (Exception $exc) {
                error_log("---------get countries------".$exc->getMessage());
            }

              return $resources;
     }
       public function saveMobileSession($userId,$sessionId,$deviceInfo,$pushToken){
         try {
             $returnValue = false;
             if(isset($pushToken) && !empty($pushToken)){
                  $mobileSession = MobileSessions::model()->findByAttributes(array("PushTokenId"=>$pushToken));
            if (isset($mobileSession)) {
                error_log("sessin exists");
                 $mobileSession->Active = 1;
                 $mobileSession->UserId = $userId;
                 $mobileSession->UpdatedOn = date('Y-m-d H:i:s', time());
                 $mobileSession->update();
                 return $mobileSession->SessionId;
            }else{
               $mobileSession = new MobileSessions();
            $mobileSession->UserId = $userId;
            $mobileSession->SessionId = CommonUtility::generateSecurityToken();
            $mobileSession->PushTokenId = $pushToken;
            if($deviceInfo['platform'] == "iOS"){
               $mobileSession->PushTokenType = 1; 
            }else{
                $mobileSession->PushTokenType = 2;
            }
            
            $mobileSession->Active = 1;
            $mobileSession->CreatedOn = date('Y-m-d H:i:s', time());
            $mobileSession->UpdatedOn = date('Y-m-d H:i:s', time());
            if ($mobileSession->save()) {
                $returnValue = $mobileSession->SessionId;
            }   
            } 
             }
          
           
           
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
     }
     
      public function saveMobileSession_V6($userId,$deviceInfo,$pushToken){
         try {
             $returnValue = false;
             if(isset($pushToken) && !empty($pushToken)){
                  $mobileSession = MobileSessions::model()->findByAttributes(array("PushTokenId"=>$pushToken));
            if (isset($mobileSession)) {
                error_log("sessin exists");
                 $mobileSession->Active = 1;
                 $mobileSession->UserId = $userId;
                 $mobileSession->UpdatedOn = date('Y-m-d H:i:s', time());
                 $mobileSession->update();
                 return $mobileSession->SessionId;
            }else{
               $mobileSession = new MobileSessions();
            $mobileSession->UserId = $userId;
            $mobileSession->SessionId = CommonUtility::generateSecurityToken();
            $mobileSession->PushTokenId = $pushToken;
            if($deviceInfo['platform'] == "iOS"){
               $mobileSession->PushTokenType = 1; 
            }else{
                $mobileSession->PushTokenType = 2;
            }
            
            $mobileSession->Active = 1;
            $mobileSession->CreatedOn = date('Y-m-d H:i:s', time());
            $mobileSession->UpdatedOn = date('Y-m-d H:i:s', time());
            if ($mobileSession->save()) {
                $returnValue = $mobileSession->SessionId;
            }   
            } 
             }
          
           
           
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
     }
     
     public function checkAutoLogin($sessionId,$userId){
          try {
              
             $mobileSession = MobileSessions::model()->findByAttributes(array("UserId" => $userId,"SessionId"=>$sessionId,"Active"=>1));
            if (isset($mobileSession)) {
//                error_log("sessin exists");
//                 $mobileSession->UpdatedOn = date('Y-m-d H:i:s', time());
//                 $mobileSession->update();
                 return true;
            }else{
                 return false;
            }  
          } catch (Exception $ex) {
     Yii::log($ex->getTraceAsString(), 'error', 'application');
          } 
     }
      public function logout($sessionId,$userId){
          try {
              
             $mobileSession = MobileSessions::model()->findByAttributes(array("UserId" => $userId,"SessionId"=>$sessionId));
            if (isset($mobileSession)) {
                
                 $mobileSession->Active = 0;
                 $mobileSession->update();
                 return true;
            }else{
                 
                return false;
            }  
          } catch (Exception $ex) {
     Yii::log($exc->getTraceAsString(), 'error', 'application');
          } 
     }
      public function resetPassword($userId){
          try {
              if($userId!="" && $userId!=null){
                 $criteria = new CDbCriteria;
                 $criteria->addCondition('UserId='.$userId);
                 MobileSessions::model()->updateAll(array('Active'=>0), $criteria);  
              }
             
        
          } catch (Exception $ex) {
     Yii::log($exc->getTraceAsString(), 'error', 'application');
          } 
     }
     
      public function checkMobileLogin($userId){
          try {
             $mobileSession = MobileSessions::model()->findByAttributes(array("UserId" => $userId,"Active"=>1));
            if (isset($mobileSession) && (!empty($mobileSession))) {
                 return true;
            }else{
                 
                return false;
            }  
          } catch (Exception $ex) {
               Yii::log($ex->getTraceAsString(), 'error', 'application');
          } 
     }
     
      public function getDeviceTokensForUser($userId){
          try {
              $finalArray = array();
              error_log("select PushTokenType,group_concat(PushTokenId) PushTokens from MobileSessions where UserId=".$userId." and Active=1 group by PushTokenType");
              $resources=Yii::app()->db->createCommand("select PushTokenType,group_concat(PushTokenId) PushTokens from MobileSessions where UserId=".$userId." and Active=1 group by PushTokenType")->queryAll();
              foreach ($resources as $value) {
                  error_log("----".$value["PushTokenType"]."---".$value["PushTokens"]);
                  $finalArray[$value["PushTokenType"]] = explode(",", $value["PushTokens"]);
              }
              return $finalArray;
          } catch (Exception $ex) {
               Yii::log($ex->getTraceAsString(), 'error', 'application');
          } 
     }
}
