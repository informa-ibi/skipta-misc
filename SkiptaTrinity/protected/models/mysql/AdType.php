<?php

class AdType extends CActiveRecord{
    public $id;
    public $Type;
    public $Status;
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Advertisements';
    } 
    public function getAdTypes(){
        $returnValue='failure';
        try {
            $query="select * from AdType where Status=1";
             $adTypes = Yii::app()->db->createCommand($query)->queryAll(); 
         if(is_array($adTypes))    {
             $returnValue=$adTypes;
                     
         }
         return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString());
            return $returnValue;
        }
        }
      
}
