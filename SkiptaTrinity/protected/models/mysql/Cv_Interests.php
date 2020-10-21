<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cv_Interests extends CActiveRecord {

    public $Id;
    public $Interest;
    public $CreatedOn;
    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Cv_Interests';
    }

    public function getAllInterests() {
        try {
            $returnValue = 'failure';
            $query = "select * from Cv_Interests";
            $InterestsTypes = Yii::app()->db->createCommand($query)->queryAll();
            if (count($InterestsTypes) > 0) {
                $returnValue = $InterestsTypes;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error" . $exc->getTraceAsString(), 'error', 'application');
        }
    }
   
      public function getInterestsForSuggestion($searchText,$ExistingInterests="") {
        try {
             $returnValue = 'failure';
            $criteria = new CDbCriteria();
             
            if ($ExistingInterests!="") {
                $query = "SELECT * FROM Cv_Interests where Interest not in ($ExistingInterests) and Interest like '%$searchText%'";
            } else {
                $query = "SELECT * FROM Cv_Interests where  Interest like '%$searchText%'";
            }

            $data = Yii::app()->db->createCommand($query)->queryAll();
            if (sizeof($data) > 0) {
                $returnValue = $data;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("==Exception Occurred in getUserProfileCount==" . $exc->getMessage(), "error", "application");
        }
    }
    
    
     public function saveCVInterestsDetails($educationModel) {
        try {
            $returnValue = false;
          
            $finalArray = array();
            if(trim($educationModel['Interests'])!=""){
               
            $educationId = explode(',', $educationModel['Interests']);
            
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['Tags'] = $educationModel['UserInterests'][$value];
            }
            foreach ($finalArray as $key => $value) {
               
                 $Interests= explode(',',$value['Tags']);
                 for($i=0;$i< sizeof($Interests);$i++) {

                     $checkInterestExist=$this->CheckInterestExistOrNot($Interests[$i]);
                     if($checkInterestExist=="failure"){
                        $userObj = new Cv_Interests();
                        $userObj->Interest = $Interests[$i];
                        $userObj->CreatedOn = date('Y-m-d H:i:s', time());;
                        if ($userObj->save()) {
                            $returnValue = $userObj->Id;
                        } 
                     }
                       
                    }
                }
            }  
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
    }
     public function CheckInterestExistOrNot($Interest) {
        try {
             $returnValue = 'failure';
            $criteria = new CDbCriteria();
            $searchText=  trim($Interest);
            if (!empty($searchText) && $searchText != "undefined" && $searchText != "null") {
                 $criteria->addSearchCondition('Interest', trim($searchText));
            }            
            $result = Cv_Interests::model()->findAll($criteria);
             if (sizeof($result) > 0) {
                $returnValue = $result;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("==Exception Occurred in getUserProfileCount==" . $exc->getMessage(), "error", "application");
        }
    }
        public function SaveUserInterestsFromProfile($interestsdata){
        try{
            $returnvalue="failure";
             $Interests= explode(',',$interestsdata);
             if(sizeof($Interests)>0){
                 for($i=0;$i< sizeof($Interests);$i++) {

                     $checkInterestExist=$this->CheckInterestExistOrNot($Interests[$i]);
                     if($checkInterestExist=="failure"){
                        $interestObj = new Cv_Interests();
                        $interestObj->Interest = $Interests[$i];
                        $interestObj->CreatedOn = date('Y-m-d H:i:s', time());;
                        if ($interestObj->save()) {
                            $returnValue = $interestObj->Id;
                            $returnvalue="success";
                        } 
                     }
                       
                    }
             }
             return $returnvalue;
        } catch (Exception $ex) {
             Yii::log("==Exception Occurred in save user interests from profile==" . $exc->getMessage(), "error", "application");
        }
    }

}
