<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserOpinion extends CActiveRecord {

    public $id;
    public $OpinionId;
    public $UserId;
    public $UserOption;
    public $CreatedDate;
    public $Active;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'UserOpinion';
    }
    
    public function saveOpinionDetails($userId,$opinionId,$optionValue){
        try{
           $userOp = new UserOpinion();
           $userOp->UserOption = $optionValue;
           $userOp->UserId = $userId;
           $userOp->OpinionId = $opinionId;
           if($userOp->save()){
               $returnvalue = Opinion::model()->updateOption($opinionId,$optionValue);
           }
           return $returnvalue;
        } catch (Exception $ex) {
            error_log("######Exception Occurred saveOpinionDetails#########".$ex->getMessage());
        }
    }
    
    public function isUserAlreadyDoneSurvey($userId){
        try{
            return UserOpinion::model()->findByAttributes(array("UserId"=>$userId));
        } catch (Exception $ex) {
            error_log("#########Exception occurred#########".$ex->getMessage());
        }
    }
    
    

}
