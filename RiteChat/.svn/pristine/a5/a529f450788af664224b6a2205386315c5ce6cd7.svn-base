<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Education extends CActiveRecord {

    public $Id;
    public $Categoryname;
    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Education';
    }

    public function getAllEducations() {
        try {
            $returnValue = 'failure';
           $query = "select * from Education where Id not in (0)";
            $EducationTypes = Yii::app()->db->createCommand($query)->queryAll();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error" . $exc->getTraceAsString(), 'error', 'application');
        }
    }
     public function getEducationsForCVEdit($id) {
        try {
            if($id == ""){ //if id is empty value not 0 then we will got an issue in this.
                $id = 0;
            }
            $returnValue = 'failure';
            $id=$id.',0';
            $id=  str_replace('1,',"", $id);
            $id=  str_replace('4,',"", $id);
             $id=  str_replace('3,',"", $id);
            $id=  str_replace('1',"", $id);
            $id=  str_replace('4',"", $id);
             $id=  str_replace('3',"", $id);
            $query = "select * from Education where Id not in ($id)";
            $EducationTypes = Yii::app()->db->createCommand($query)->queryAll();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error" . $exc->getTraceAsString(), 'error', 'application');
        }
    }
     public function getEducationDetailsByUsingId($id) {
        try {
            $returnValue = 'failure';
            $query = "select * from Education where Id=".$id;
            $EducationTypes = Yii::app()->db->createCommand($query)->queryRow();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error" . $exc->getTraceAsString(), 'error', 'application');
        }
    }
    

}
