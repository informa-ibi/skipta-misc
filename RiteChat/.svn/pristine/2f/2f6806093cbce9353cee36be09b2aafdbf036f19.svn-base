<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserExperience extends CActiveRecord {

    
    public $Id;
    public $UserId;
    public $ExperienceId;
    public $Description;
    public $Priority;
    public $Status=1;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'User_Experience';
    }

    public function saveUserCVExperienceDetails($educationModel,$UserId) {
        try {
            $returnValue = false;
         
            $finalArray = array();
         //  error_log("arrayyyyyyyyyyyyyyy".print_r($educationModel,true));
              if(trim($educationModel['Experience'])!=""){
            $educationId = explode(',', $educationModel['Experience']);
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['ExperienceId'] = $value;
                $finalArray[$key]['Description'] = $educationModel['UserExperience'][$value];
            }
            $i=1;
            //error_log("user experienceee".print_r($finalArray,true));
            foreach ($finalArray as $key => $value) {
                  $userObj = new UserExperience();
                $userObj->UserId = $UserId;
                $userObj->ExperienceId = $value['ExperienceId'];
                $userObj->Description = $value['Description'];
                $userObj->Priority = $i;
                $userObj->Status = 1;
            if ($userObj->save()) {
                $returnValue = $userObj->UserId;
            }
            $i++;
            }
            
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
    }

    public function getUserExperienceDetails($userId){
        try{
            $userObj = UserExperience::model()->findByAttributes(array("UserId"=>$userId));
            return $userObj;
        } catch (Exception $ex) {
            error_log("###################Exception Occurred#########".$ex->getMessage());
        }
    }

    public function getUserCVExperienceDetails($userId){
      
      try {
            $returnvalue = 'failure';
            $finalArray = array();
//            $criteria = new CDbCriteria();
//            $criteria->addSearchCondition('UserId', $userId);
//            $criteria->order = 'Priority ASC';
//            $result = UserExperience::model()->findAll($criteria);
            $query = "select * from User_Experience where Status=1 and UserId='".$userId."' order by Priority ASC";
            $result = Yii::app()->db->createCommand($query)->queryAll();
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $finalArray[$key]['ExperienceId'] = $value['ExperienceId'];
                    $finalArray[$key]['Id'] = $value['Id'];
                    $finalArray[$key]['Description'] = $value['Description'];
                    $educationDetails = Experience::model()->getExperienceDetailsByUsingId($value['ExperienceId']);
                    $finalArray[$key]['Experience'] = $educationDetails['Experience'];
                }
                $returnvalue = $finalArray;
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCollection==" . $exc->getMessage(), "error", "application");
        }
        return $returnvalue;
    }
  
    
   public function getUserCVExpericeDetailsByEducationId($UserId,$educationId){
       
        $returnValue = 'failure';
            $query = "select * from User_Experience where ExperienceId=".$educationId."and UserId=".$UserId;
            $EducationTypes = Yii::app()->db->createCommand($query)->queryRow();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
       
   }
    
    public function updateUserCVExperienceDetails($educationModel,$UserId){
        
          $returnValue = false;
            $finalArray = array();
          if(trim($educationModel['Experience'])!=""){
            $educationId = explode(',', $educationModel['Experience']);
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['ExperienceId'] = $value;
                $finalArray[$key]['Description'] = $educationModel['UserExperience'][$value];
            }
            $i=1;
            foreach ($finalArray as $key => $value) {
                $userObj = new UserExperience();
             $educationObj = UserExperience::model()->findByAttributes(array("ExperienceId" => $value['ExperienceId'], 'UserId' => $UserId));
            if (isset($educationObj)) {
                $educationObj->ExperienceId = $value['ExperienceId'];
                $educationObj->Description = $value['Description'];
                $educationObj->Priority = $i;
                $educationObj->Status = 1;
                if ($educationObj->update()) {
                    $returnValue = "success";
                }
            }else{
                $userObj->UserId = $UserId;
                $userObj->ExperienceId = $value['ExperienceId'];
                $userObj->Description = $value['Description'];
                $userObj->Priority = $i;
                $userObj->Status = 1;
                if ($userObj->save()) {
                    $returnValue = $userObj->UserId;
                }
            }
          
              $i++;
            }
    }
            
            return $returnValue; 
            
            
        
        
        
    }
     /*
     * @developer: suresh reddy 
     * UpdateUserCVStatus: 
     * This is used to update the status of an section status of cv.
     */

    public function updateSectionStatus($secionType,$userId) {
        try {
            $return = "failed";
            
            $sectionObj = UserExperience::model()->findByAttributes(array("UserId" => $userId,"ExperienceId"=>$secionType));
            if (isset($sectionObj)) {

                $sectionObj->Status = 0;
                if ($sectionObj->update()) {
                    $return = "success";
                }
            }
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $return;
    }


    


}