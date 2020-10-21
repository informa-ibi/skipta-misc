<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TrackUserActiveSessions extends EMongoDocument {
    
    public $UserId;
    public $ClientSessionStartTime;
    public $ClientSessionEndTime;
    public $Duration;
    public $CreatedOn;
    public $UpdatedOn;
    public $Reason;
   
    
    public function getCollectionName() {
        return 'TrackUserActiveSessions';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    public function rules()
    {
        return array(
        );
    }
   
     public function attributeNames() {
        return array(
          
            'ClientSessionStartTime' => 'ClientSessionStartTime',
            'ClientSessionEndTime' => 'ClientSessionEndTime',
            'CreatedOn' => 'CreatedOn',
            'UpdatedOn' => 'UpdatedOn',
            'Reason'=>'Reason',
            'Duration' => 'Duration'
        );
    }
    
     public function trackStartSession($sessionId,$activityType,$userId,$date=null)
    {
        try{
              error_log("**************************");
            error_log("trackStartSession------------$sessionId--------".$userId."---".$activityType."----".$date);
            $date = preg_replace('/[\[{\(].*[\]}\)]/U' , '', $date);
            //$date = "Thursday, 25 June 2015 01:40:11 GMT-0400";
             //error_log("date after replace---".$date);
            $returnValue = "failure";
            $trackUserActiveSessions = new TrackUserActiveSessions();
            $trackUserActiveSessions->UserId = (int)$userId;
            if($activityType == "start"){
            
            $trackUserActiveSessions->ClientSessionStartTime = new MongoDate(strtotime($date)); 
            $trackUserActiveSessions->CreatedOn = new MongoDate(); 
            $trackUserActiveSessions->UpdatedOn = new MongoDate(); 
              $trackUserActiveSessions->save();
              if (isset($trackUserActiveSessions->_id)) {
                $returnValue = $trackUserActiveSessions->_id;
            }
            return $returnValue;
           
            }else{
            $mongoCriteria = new EMongoCriteria;            
            $mongoCriteria->addCond('_id', '==', new MongoId($sessionId));
            $userSessionObject = TrackUserActiveSessions::model()->find($mongoCriteria);
            if(isset($userSessionObject) && $userSessionObject->Reason != "Logout"){
                error_log("date00000000000---------------".strtotime($date));
             $duration =  strtotime($date) - $userSessionObject->ClientSessionStartTime->sec;
             error_log("duration--------------".$duration);
             if($userSessionObject->Duration == null || $duration > $userSessionObject->Duration){
             
              $mongoCriteria = new EMongoCriteria;            
              $mongoCriteria->addCond('_id', '==', new MongoId($sessionId));
              $mongoModifier = new EMongoModifier;  
              $mongoModifier->addModifier('ClientSessionEndTime', 'set', new MongoDate(strtotime($date)));
              $mongoModifier->addModifier('Reason', 'set', $activityType);
              $mongoModifier->addModifier('Duration', 'set', new MongoInt64($duration));
              $mongoModifier->addModifier('UpdatedOn', 'set',  new MongoDate());
              TrackUserActiveSessions::model()->updateAll($mongoModifier, $mongoCriteria); 
                }
             
            }
          
            }
            
           
        } catch (Exception $ex) {
            error_log("excepiotn---".$ex->getMessage());
            Yii::log("TrackUserActiveSessions:trackStartSession::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
    public function activateUserSession($sessionId){
        try{
            $mongoCriteria = new EMongoCriteria;            
            $mongoCriteria->addCond('_id', '==', new MongoId($sessionId));
            $userSessionObject = TrackUserActiveSessions::model()->find($mongoCriteria);
            if(isset($userSessionObject)){
              $duration =  null;
              $mongoCriteria = new EMongoCriteria;            
              $mongoCriteria->addCond('_id', '==', new MongoId($sessionId));
              $mongoModifier = new EMongoModifier;  
              $mongoModifier->addModifier('ClientSessionEndTime', 'set', null);
              $mongoModifier->addModifier('Reason', 'set',null);
              $mongoModifier->addModifier('Duration', 'set', null);
              $mongoModifier->addModifier('UpdatedOn', 'set',  new MongoDate());
              TrackUserActiveSessions::model()->updateAll($mongoModifier, $mongoCriteria);
            }  
        } catch (Exception $ex) {
 Yii::log("TrackUserActiveSessions:activateUserSession::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
    
     public function checkUserSession($sessionId){
        try{
            $mongoCriteria = new EMongoCriteria;            
            $mongoCriteria->addCond('_id', '==', new MongoId($sessionId));
            $userSessionObject = TrackUserActiveSessions::model()->find($mongoCriteria);
            if(isset($userSessionObject)){
                error_log(time()."---session end time--".$userSessionObject->UpdatedOn->sec);
                $diff = time()-$userSessionObject->UpdatedOn->sec;
                error_log("fidd------------".$diff);
              //  if($diff<60){
                    error_log("activating session-------------------");
                    TrackUserActiveSessions::model()->activateUserSession($sessionId);
              // }
                
//              $duration =  null;
//              $mongoCriteria = new EMongoCriteria;            
//              $mongoCriteria->addCond('_id', '==', new MongoId($sessionId));
//              $mongoModifier = new EMongoModifier;  
//              $mongoModifier->addModifier('SessionEndTime', 'set', null);
//              $mongoModifier->addModifier('ActivityType', 'set',null);
//              $mongoModifier->addModifier('Duration', 'set', null);
//              $mongoModifier->addModifier('UpdatedOn', 'set',  new MongoDate());
//              TrackUserActiveSessions::model()->updateAll($mongoModifier, $mongoCriteria);
            }  
        } catch (Exception $ex) {
 Yii::log("TrackUserActiveSessions:activateUserSession::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
        }
    }
}