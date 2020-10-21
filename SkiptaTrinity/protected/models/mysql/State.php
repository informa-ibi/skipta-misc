<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class State extends CActiveRecord{
    
    public $State;
    public $CountryId;
    public $Status;
    public $StateCode;
    
    
      public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'State';
    }
    public function GetState(){
        try {
                $resources=Yii::app()->db->createCommand("SELECT * FROM  State;")->queryAll();

            } catch (Exception $exc) {
                error_log("---------get countries------".$exc->getMessage());
            }

              return $resources;
     }
      public function GetStateById($id){
        try {
                $state=Yii::app()->db->createCommand("SELECT * FROM  State where id=$id")->queryRow();

            } catch (Exception $exc) {
                error_log("---------get countries------".$exc->getMessage());
            }

            return $state;
     }
     /*@Author Haribabu
      * This method is used to get the states by using country id
      */
      public function GetStateByUsingCountryId($CountryId){
        try {
            $returnvalue="failure";
                $states=Yii::app()->db->createCommand("SELECT * FROM  State where CountryId=$CountryId")->queryAll();
                if(is_array($states) && sizeof($states)>0){
                  $returnvalue=$states;  
                }
            } catch (Exception $exc) {
                 Yii::log("%%%%%%%%%%%%%%%%%get states by using country iddddddddddddddddddd".$exc->getMessage(),'error','application');
            }

              return $returnvalue;
     }
     
     
    public function GetStateByUsingStateName($State){
        try {
            $returnvalue="failure";
                $stateType = (strlen(trim($State)>=2))?'StateCode':'State';
                $states=Yii::app()->db->createCommand("SELECT * FROM  State where $stateType='$State'")->queryRow();
                if(is_array($states) && sizeof($states)>0){
                  $returnvalue=$states;  
                }
            } catch (Exception $exc) {
                error_log("+++++++++++++++++++++++++++++++++++++".$exc->getMessage());
                 Yii::log("%%%%%%%%%%%%%%%%%get states by using country iddddddddddddddddddd".$exc->getMessage(),'error','application');
            }

              return $returnvalue;
     } 
    
      public function GetStateCode($StateName,$CountryId){
        try {
            $returnvalue="failure";
              $query = "select id,StateCode from State where State='".trim($StateName)."' and CountryId=".$CountryId;
                $states=Yii::app()->db->createCommand($query)->queryRow();
                if(is_array($states) && sizeof($states)>0){
                  $returnvalue=$states;  
                }
            } catch (Exception $ex) {
                 Yii::log("State:GetStateCode::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            }

              return $returnvalue;
     } 
         public function GetStateName($StateCode,$CountryId){
        try {
            $returnvalue="failure";
              $query = "select State from State where StateCode='".trim($StateCode)."' and CountryId=".$CountryId;
              error_log($query); 
              $states=Yii::app()->db->createCommand($query)->queryRow();
                if(is_array($states) && sizeof($states)>0){
                  $returnvalue=$states;  
                }
            } catch (Exception $ex) {
                 Yii::log("State:GetStateCode::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
            }

              return $returnvalue;
     } 
     /**
      * Moin Hussain
      * @param type $state
      * @param type $country
      * @return boolean
      */
     public function checkForValidityOfState($state,$country){
    try{
      $query = "select count(*) count from State S join Countries C on S.CountryId=C.Id where C.Code='".trim($country)."' and S.StateCode='".trim($state)."'";  
     // $query = "select State from State where State='".trim($state)."' and CountryId=".$CountryId;
     //error_log($query);
      $result =Yii::app()->db->createCommand($query)->queryRow();  
     // error_log(print_r($result,1));
      if($result["count"]>0){
          return true;
      }else{
         return false;  
      }
     
    } catch (Exception $ex) {
 Yii::log("User:checkForValidityOfState::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
    }
}
     
/**
 * Moin Hussain
 * @param type $state
 * @param type $countryId
 * @return boolean
 */
     public function checkForValidityOfStateWithCountryId($state,$countryId){
    try{
     
      $query = "select count(*) count from State S join Countries C on S.CountryId=C.Id where C.Id='".trim($countryId)."' and S.StateCode='".trim($state)."'";  
     // $query = "select State from State where State='".trim($state)."' and CountryId=".$CountryId;
    // error_log($query);
      $result =Yii::app()->db->createCommand($query)->queryRow();  
     // error_log(print_r($result,1));
      if($result["count"]>0){
          return true;
      }else{
         return false;  
}
      
    } catch (Exception $ex) {
 Yii::log("User:checkForValidityOfStateWithCountryId::".$ex->getMessage()."--".$ex->getTraceAsString(), 'error', 'application');
    }
}
     
     
}
