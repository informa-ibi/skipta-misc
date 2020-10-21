<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SubSpecialty extends CActiveRecord {
    public $id;
    public $Key;
    public $Value;


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Subspecialty';
    }
    
    public function getSubSpecialityDetails(){
        $returnValue='failure';
        try {
            $subspecialityDetails=SubSpecialty::model()->findAll();
            if(is_array($subspecialityDetails)){
                $returnValue=$subspecialityDetails;
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("--------------------------".$exc->getMessage());
        }
        }
        
   public function getSubSpecialityValuesById($speIds){
       $returnValue='failure';
       try {
           $query="select Value from Subspecialty where id in  (".implode(',',$speIds).") ";
           $subSpeDetails = Yii::app()->db->createCommand($query)->queryAll();
           if(is_array($subSpeDetails)){
               $returnValue=$subSpeDetails;
           }
           
           return $returnValue;
           
       } catch (Exception $exc) {
           error_log("--------------------------".$exc->getMessage());
       }
      }
  public function getSubSpecialityByType($type,$value){
       $returnValue='failure';
       try {
           $subSpeDetails=SubSpecialty::model()->findByAttributes(array($type=>$value));
           
           if(is_object($subSpeDetails)){
               $returnValue=$subSpeDetails;
           }
           
           return $returnValue;
           
       } catch (Exception $exc) {
           error_log("--------------------------".$exc->getMessage());
       }
  }    
      
}