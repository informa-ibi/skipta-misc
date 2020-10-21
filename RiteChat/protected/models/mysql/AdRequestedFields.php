<?php

class AdRequestedFields extends CActiveRecord{
    public $id;
    public $FieldName;
    public $Status;
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Advertisements';
    } 
    public function getAdRequestedFields(){
        $returnValue='failure';
        try {
            $query="select * from AdRequestedFields where Status=1";
             $adRequestedFields = Yii::app()->db->createCommand($query)->queryAll(); 

         if(is_array($adRequestedFields)) {   
             $returnValue=$adRequestedFields;
                     
         }
         return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString());
            return $returnValue;
        }
        }
      
}
