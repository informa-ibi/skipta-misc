<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LicensedStatesAndNumbers extends CActiveRecord {
    public $Id;
    public $UserTaxAndRegulatoryInfoId;
    public $LicensedState;
    public $LicensedNumber;
    public $CreatedDate;
    
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'LicensedStatesAndNumbers';
    }
    
    public function saveData($utId,$model){
        try{
            $return = "failed";
            
            $statesArr = explode(",",$model->LicensedStates);
            $numbersArr = explode(",",$model->LicensedNumbers);
            for($i=0;$i<sizeof($numbersArr);$i++){
                $licObj = new LicensedStatesAndNumbers;
                $licObj->UserTaxAndRegulatoryInfoId = $utId;
                $licObj->LicensedState = $statesArr[$i];
                $licObj->LicensedNumber = $numbersArr[$i];
                if($licObj->save()){
                    $j++;
                }
            }
            if(isset($numbersArr[0]))
                User::model()->updateCustomFieldsByUserId($numbersArr[0],$model);
            if($i == $j){
               $return = "success";
            }
            return $return;
        } catch (Exception $ex) {
            error_log("====exception====".$ex->getMessage());
        }
    }
}