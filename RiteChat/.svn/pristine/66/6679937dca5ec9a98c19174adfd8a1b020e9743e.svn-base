<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Opinion extends CActiveRecord {

    public $id;
    public $Question;
    public $Option1;
    public $Option2;
    public $Option3;
    public $Option4;
    public $Option1Count=0;
    public $Option2Count=0;
    public $Option3Count=0;
    public $Option4Count=0;
    public $Active;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Opinion';
    }
    
    public function getOpinionDetails($userId){
        try{
            $result = array();
            $result = Opinion::model()->find();
            $query = "Select *,O.id OID from Opinion O LEFT JOIN UserOpinion UO ON UO.OpinionId = O.id";
            $result = Yii::app()->db->createCommand($query)->queryRow();
            return $result;
        } catch (Exception $ex) {
            error_log("######Exception Occurred #########".$ex->getMessage());
        }
        
    }
    
    public function updateOption($id,$optionValue){
        try{
           $returnvalue = false;
           $opinion = Opinion::model()->findByAttributes(array('id'=>$id));
           if($optionValue == "Option1"){
               $opinion->Option1Count = ((int)$opinion->Option1Count)+1;
           }else if($optionValue == "Option2"){               
               $opinion->Option2Count = ((int)$opinion->Option2Count)+1;
           }else if($optionValue == "Option3"){
               $opinion->Option3Count = ((int)$opinion->Option3Count)+1;
           }else if($optionValue == "Option4"){
               $opinion->Option4Count = ((int)$opinion->Option4Count)+1;
           }
           if($opinion->update()){               
           }
           
           $resultarray = array();
           $resultarray['Option1Percentage'] =  ($opinion->Option1Count/4)*100;
           $resultarray['Option1'] = $opinion->Option1;
           $resultarray['Option2Percentage'] =  ($opinion->Option2Count/4)*100;
           $resultarray['Option2'] = $opinion->Option2;
           $resultarray['Option3Percentage'] =  ($opinion->Option3Count/4)*100;
           $resultarray['Option3'] = $opinion->Option3;
           $resultarray['Option4Percentage'] =  ($opinion->Option4Count/4)*100;
           $resultarray['Option4'] = $opinion->Option4;
           return $resultarray;
            
        } catch (Exception $ex) {
            error_log("######Exception Occurred #########".$ex->getMessage());
        }
    }
    
    public function getSurveyResults($id){
        try{
            $opinion = Opinion::model()->findByAttributes(array('id'=>$id));
            $resultarray = array();
            $resultarray['Option1Percentage'] =  ($opinion->Option1Count/4)*100;
            $resultarray['Option1'] = $opinion->Option1;
            $resultarray['Option2Percentage'] =  ($opinion->Option2Count/4)*100;
            $resultarray['Option2'] = $opinion->Option2;
            $resultarray['Option3Percentage'] =  ($opinion->Option3Count/4)*100;
            $resultarray['Option3'] = $opinion->Option3;
            $resultarray['Option4Percentage'] =  ($opinion->Option4Count/4)*100;
            $resultarray['Option4'] = $opinion->Option4;
           return $resultarray;
        } catch (Exception $ex) {

        }
    }

}
