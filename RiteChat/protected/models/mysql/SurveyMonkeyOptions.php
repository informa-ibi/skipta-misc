<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SurveyMonkeyOptions extends CActiveRecord {

    public $id;
    public $Question;
    public $Active;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'SurveyMonkeyOptions';
    }
    
    public function getSurveyQuestions(){
        try{
            return SurveyMonkeyOptions::model()->findAll();
        } catch (Exception $ex) {
            error_log("######Exception Occurred##########".$ex->getMessage());
        }
    }


}
