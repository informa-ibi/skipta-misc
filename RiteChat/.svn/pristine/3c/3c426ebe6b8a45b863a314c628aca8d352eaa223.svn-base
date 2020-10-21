<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserAchievements extends CActiveRecord {

    
 public $Id;
 public $UserId;
 public $AchievementId;
 public $Description;
 public $Priority;
 public $Status=1;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'User_Achievements';
    }

    public function saveUserCVAchievementDetails($educationModel,$UserId) {
        try {
            $returnValue = false;
           
            $finalArray = array();
               if(trim($educationModel['Achievements'])!=""){
            $educationId = explode(',', $educationModel['Achievements']);
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['AchievementId'] = $value;
                $finalArray[$key]['Description'] = $educationModel['UserAchievements'][$value];
            }
            $i=1;
            foreach ($finalArray as $key => $value) {
                 $userObj = new UserAchievements();
                $userObj->UserId = $UserId;
                $userObj->AchievementId = $value['AchievementId'];
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
     public function getUserCVAchievementsDetails($userId){
      
      try {
            $returnvalue = 'failure';
            $finalArray = array();

//            $criteria = new CDbCriteria();
//            $criteria->addSearchCondition('UserId', $userId);
//            $criteria->order = 'Priority ASC';
//            $result = UserAchievements::model()->findAll($criteria);
             $query = "select * from User_Achievements where status=1 and UserId='".$userId."' order by Priority ASC";
            $result = Yii::app()->db->createCommand($query)->queryAll();
           

            if (sizeof($result) > 0) {
                foreach ($result as $key => $value) {
                    $finalArray[$key]['AchievementId'] = $value['AchievementId'];
                    $finalArray[$key]['Id'] = $value['Id'];
                    $finalArray[$key]['Description'] = $value['Description'];
                    $educationDetails = Achievements::model()->getAchievementDetailsByUsingId($value['AchievementId']);
                    $finalArray[$key]['Achievement'] = $educationDetails['Achievement'];
                }
                $returnvalue = $finalArray;
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCollection==" . $exc->getMessage(), "error", "application");
        }
        return $returnvalue;
    }
    
    
     public function getUserCVAchievementDetailsByEducationId($UserId,$educationId){
       
        $returnValue = 'failure';
            $query = "select * from User_Achievements where AchievementId=".$educationId."and UserId=".$UserId;
            $EducationTypes = Yii::app()->db->createCommand($query)->queryRow();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
       
   }   
    
    
    public function updateUserCVAchievementDetails($educationModel,$UserId){
        
         try {
            
            $returnValue = false;
            $finalArray = array();
            if(trim($educationModel['Achievements'])!=""){
            $educationId = explode(',', $educationModel['Achievements']);
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['AchievementId'] = $value;
                $finalArray[$key]['Description'] = $educationModel['UserAchievements'][$value];
            }
            $i=1;
            foreach ($finalArray as $key => $value) {
                $userObj = new UserAchievements();
             $educationObj = UserAchievements::model()->findByAttributes(array("AchievementId" => $value['AchievementId'], 'UserId' => $UserId));
            if (isset($educationObj)) {
                $educationObj->AchievementId = $value['AchievementId'];
                $educationObj->Description = $value['Description'];
                $educationObj->Priority = $i;
                $educationObj->Status = 1;
                if ($educationObj->update()) {
                    $returnValue = "success";
                }
            }else{
                $userObj->UserId = $UserId;
                $userObj->AchievementId = $value['AchievementId'];
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
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
        
        
        
    }

    public function getUserAchievementDetails($userId){
        try{
            $userObj = UserAchievements::model()->findByAttributes(array("UserId"=>$userId));
            return $userObj;
        } catch (Exception $ex) {
            error_log("###################Exception Occurred#########".$ex->getMessage());
        }
    }
    
        /*
     * @developer: suresh reddy 
     * UpdateUserCVStatus: 
     * This is used to update the status of an section status of cv.
     */

    public function updateSectionStatus($secionType,$userId) {
        try {
            $return = "failed";

            $sectionObj = UserAchievements::model()->findByAttributes(array("UserId" => $userId,"AchievementId"=>$secionType));
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
