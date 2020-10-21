<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TourGuide_User extends CActiveRecord {
    
    public $Id;
    public $TourGuideId;
    public $OpportunityId;
    public $UserId;    
    public $Status;    
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'TourGuide_User';
    }
    
       /*
     * this method is use to get the opportunities by level
     * @return type array
     */
    public function getTourGuideByOpportunity($oppId) {
        $tourGuideData=array();
        try {
            $query="select * from TourGuide_User where OpportunityId=".$oppId;
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getUserStatusOfOpportunity($userId,$oppId)
    {
         $tourGuideData=array();
        try {
            $query="select TourGuideId,Status,OpportunityId from TourGuide_User where Status=1 and    UserId=$userId and OpportunityId=".$oppId ." order by TourGuideId asc limit 1";
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
         
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getActiveCheckpointsOfUserByOpportunityId($userId ,$oppId)
    {
        $tourGuideData=array();
        try {
            $query="select TourGuideId,Status,OpportunityId from TourGuide_User where Status=1 and UserId=$userId and OpportunityId=".$oppId ." order by OpportunityId asc limit 1";
          
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
           
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }

    
    public function saveTourGuideStateForUser($userId,$opportunityId,$tgId)
    {
        try {
            $return = "failure";
             $tourguideUser = new TourGuide_User;
                        $tourguideUser->UserId = $userId;
                        $tourguideUser->OpportunityId = $opportunityId;
                        $tourguideUser->TourGuideId = $tgId;
                         $tourguideUser->Status = 1;
                        if ($tourguideUser->save()) {
                           $return="success"; 
                        }
            
            return $return;
            
        } catch (Exception $ex) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application'); 
        }
    }
    
    public function saveOrUpdateUserTourGuideState($userId,$opportunityId,$tgId,$status)
    {
         try {
             $return = "failure";
            $tourGuideUserObj= TourGuide_User::model()->findByAttributes(array("UserId" => $userId, "OpportunityId" => $opportunityId,"TourGuideId"=> $tgId ));
            if (isset($tourGuideUserObj) && is_object($tourGuideUserObj)) {
                $tourGuideUserObj->Status = $status;
                if ($tourGuideUserObj->update()) {
                    $return = "success";
                }
            }
            
            
        } catch (Exception $ex) {
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getNextOpportunityToLoad($userId,$opportunityId)
    {
         try
        {
           
            $query="select t1.*,t2.Status from  TourGuide t1  join TourGuide_User t2  on t1.Id=t2.TourGuideId 
            where t2.UserId=$userId and t1.OpportunityId > $opportunityId  and t2.Status=1 order by t2.OpportunityId asc , t2.TourGuideId asc";
            
           
             $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
        
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
     public function getOpportunityToLoad($userId,$opportunityId)
    {
         try
        {
           
            $query="select t1.*,t2.Status from  TourGuide t1  join TourGuide_User t2  on t1.Id=t2.TourGuideId 
            where t2.UserId=$userId and t1.OpportunityId = $opportunityId  and t2.Status=1 order by t2.OpportunityId asc , t2.TourGuideId asc";
            
           
             $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
        
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
     public function getUserStatusOfOpportunityToLoad($userId)
    {
         try
        {
           
            $query="select t1.OpportunityId from  TourGuide t1  join TourGuide_User t2  on t1.Id=t2.TourGuideId 
            where t2.UserId=$userId  and t2.Status=1 order by t2.OpportunityId asc , t2.TourGuideId asc";
             $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
        
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
      public function getTourguideUser($userId)
    {
         try
        {
           
            $query="select t1.OpportunityId from  TourGuide t1  join TourGuide_User t2  on t1.Id=t2.TourGuideId 
            where t2.UserId=$userId   order by t2.OpportunityId asc , t2.TourGuideId asc";
             $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
        
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    
    public function updateUserTourGuideStatusByOpportunityId($userId,$opportunityId="")
    {
         try {
             $result = "failure";
             if($opportunityId!="")
             $query = "update TourGuide_User set Status = 1 where UserId =".$userId ." and Status=0 and OpportunityId=".$opportunityId;
         else {
              $query = "update TourGuide_User set Status = 1 where UserId =".$userId ."";
         }
             error_log("________________________".$query);
                $result =  Yii::app()->db->createCommand($query)->execute();
                return $result;
            
            
        } catch (Exception $ex) {
             Yii::log("--" . $ex->getMessage(), 'error', 'application');
        }
    }
}
