<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Experience extends CActiveRecord {

    public $Id;
    public $Experience;
    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Experience';
    }

    public function getAllExperiences() {
        try {
            $returnValue = 'failure';
            $query = "select * from Experience";
            $ExperienceTypes = Yii::app()->db->createCommand($query)->queryAll();
            if (count($ExperienceTypes) > 0) {
                $returnValue = $ExperienceTypes;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error" . $exc->getTraceAsString(), 'error', 'application');
        }
    }
      public function getExperienceForCVEdit($id) {
        try {
            $returnValue = 'failure';
            if($id == ""){ //if id is empty value not 0 then we will got an issue in this.
                $id = 0;
            }
            $query = "select * from Experience where Id not in ($id)";            
            $EducationTypes = Yii::app()->db->createCommand($query)->queryAll();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error" . $exc->getTraceAsString(), 'error', 'application');
        }
    }
     public function getExperienceDetailsByUsingId($id) {
        try {
            $returnValue = 'failure';
            $query = "select * from Experience where Id=".$id;
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
