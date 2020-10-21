<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TourGuide extends CActiveRecord {
    
    public $Id;
    public $OpportunityId;
    public $Text;
    public $Title;
    public $Status;
    public $Context;
    public $DivId;
    public $FromPage;
    public $NextPage;
    public $FocusDivId;
    public $BlurDivId;
    public $GoalCalculationType=1;
    public $EngagementDriverName;
    public $OpportunityType;
    public $Position;
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'TourGuide';
    }
    
      /*
     * this method is use to get the opportunities by level
     * @return type array
     */
    public function getTourGuideByOpportunity($oppId) {
        $tourGuideData=array();
        try {
            $query="select * from TourGuide where OpportunityId=".$oppId ." order by Id asc";
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
      public function getJoyrideDetailsByModule($module) {
        $returnValue = 'failure';
        try {
           
              $query="select * ,1 Status from TourGuide where FromPage='".$module ."' order by Id asc";
            error_log($module."______getJoyrideDetailsByModule____________".$query);
              $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
         
            if(isset($tourGuideData) && !empty($tourGuideData)){
                $returnValue=$tourGuideData;
            }
       
            return $returnValue;
        } catch (Exception $exc) {
           
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
    public function getJoyRideDetailsByTourGuideId($id,$opportunityId)
    {
        $returnValue = 'failure';
        try {
             $query="select * from TourGuide where OpportunityId=$opportunityId and  Id>=".$id ." order by Id asc";
              
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
       
           
        } catch (Exception $exc) {
            
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     public function getTourGuideOfNextOpportunity($oppId) {
        $tourGuideData=array();
        try {
            $query="select * from TourGuide where OpportunityId=".$oppId ." order by Id asc";
          
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
            
          
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getJoyrideDetailsByTourGuideDivId($joyrideDivId,$opportunityId)
    {
        try {
            
             $query="select * from TourGuide where OpportunityId=$opportunityId and  DivId='".$joyrideDivId ."' order by Id asc";
           
            $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
            
        } catch (Exception $ex) {
             error_log("getJoyrideDetailsByTourGuideDivId block".$exc->getMessage()); 
        }
    }
    
    public function getTourGuideUserData($UserId,$opportunityId,$field,$value)
    {
        try
        {
           
            $query="select t1.*,t2.Status from TourGuide t1 join TourGuide_User t2  on t1.Id=t2.TourGuideId 
where t2.UserId=$UserId and t1.$field=$value  ";
            if($field=="OpportunityId")
               $query=$query." and t2.Status=1"; 
            
            $query=$query."  order by t1.Id asc;";
           
         error_log($query."____________getTourGuideUserData___________");
             $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
            error_log("Exception block".$exc->getMessage());
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getTourGuideUserDataOfUser($userId,$opportunityId)
    {
        try
        {
           
            $query="select t1.*,t2.Status from TourGuide t1 join TourGuide_User t2  on t1.Id=t2.TourGuideId 
where t2.UserId=$userId and t1.OpportunityId=$opportunityId   order by t1.Id asc";
            
             error_log($query."getTourGuideUserDataOfUser");
             $tourGuideData=Yii::app()->db->createCommand($query)->queryAll();
            return $tourGuideData;
        } catch (Exception $exc) {
          
             Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
            
    
}
