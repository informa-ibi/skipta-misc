<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SurveyMonkeyResults extends CActiveRecord {

    public $id;
    public $OptionId;
    public $QuestionId;
    public $UserId;
    public $Rating;
    public $OtherValue;
    public $Date;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'SurveyMonkeyResults';
    }
    
    public function saveSurveyOpinions($userId,$optionId,$questionId,$others,$rating){
        try{
            error_log("=in model==saveSurveyOpinions====$userId,$optionId,$questionId,$others,$rating");
            $soption = new SurveyMonkeyResults();
            $soption->OptionId = $optionId;
            $soption->QuestionId = $questionId;
            $soption->UserId = $userId;
            $soption->OtherValue = $others;
            $soption->Rating = $rating;
            $soption->Date = date('mm-dd-yyyy');
            if($soption->save()){
                //error_log("====saved records====");
            }else{
                //error_log("====not saved ====");
            }
            error_log("===saveSurveyOpinions==222222222==$userId,$optionId,$questionId,$others,$rating");
        } catch (Exception $ex) {
            error_log("######Exception Occurred##########".$ex->getMessage());
        }
    }
    public function getSurveyOpinionsRes($userId){
        try{
            return SurveyMonkeyResults::model()->countByAttributes(array("UserId"=>$userId));
        } catch (Exception $ex) {

        }
    }


}
