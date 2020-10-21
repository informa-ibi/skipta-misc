<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NPIStatesAndNumber extends CActiveRecord {
    public $Id;
    public $UserTaxAndRegulatoryInfoId;
    public $NPIState;
    public $NPINumber;
    public $CreatedDate;
    
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'NPIStatesAndNumber';
    }
    
    public function saveData($utId,$model){
        try{
            $return = "failed";
            $statesArr = array();
            $statesArr = $model->NPIState;  
            $i = 0;
            foreach($model->NPIState as $rw){ 
                $npiObj = new NPIStatesAndNumber;
                $npiObj->UserTaxAndRegulatoryInfoId = $utId;
                $npiObj->NPIState = $rw;
                $npiObj->NPINumber = $model->NPINumber;
                $i++;
                if($npiObj->save()){
                    $j++;
                }
            }
            if(isset($model->NPINumber))
                User::model()->updateCustomFieldsByUserId("",$model);
            if($i == $j){
               $return = "success";
            }
            return $return;
        } catch (Exception $ex) {
            error_log("====exception====".$ex->getMessage());
        }
    }
}