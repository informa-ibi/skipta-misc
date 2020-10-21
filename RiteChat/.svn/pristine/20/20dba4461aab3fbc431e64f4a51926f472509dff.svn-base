<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserEducation extends CActiveRecord {

    public $Id;
    public $UserId;
    public $EducationId;
    public $YearOfPassing;
    public $CollegeName;
    public $Specialization;
    public $Priority;
    public $Status=1;
    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'User_Education';
    }

    public function saveUserCVEducationDetails($educationModel,$UserId) {
        try {
            $returnValue = false;
            
            $finalArray = array();
          if(trim($educationModel['Education'])!=""){
            $educationId = explode(',', $educationModel['Education']);
              $EducationIds = explode(',', $educationModel['Education_Ids']);
            foreach ($EducationIds as $key => $value) {
                $finalArray[$key]['EducationId'] = $educationId[$key];
                $finalArray[$key]['CollegeName'] = $educationModel['CollegeName'][$value];
                $finalArray[$key]['YearOfPassing'] = $educationModel['YearOfPassing'][$value];
                $finalArray[$key]['Specialization'] = $educationModel['Specialization'][$value];
            }
            $i=1;
            foreach ($finalArray as $key => $value) {
                $userObj = new UserEducation();
                $userObj->UserId = $UserId;
                $userObj->EducationId = $value['EducationId'];
                $userObj->YearOfPassing = $value['YearOfPassing'];
                $userObj->CollegeName = $value['CollegeName'];
                $userObj->Specialization = $value['Specialization'];
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
    
    public function getUserEducationDetails($userId){
        try{
            $userObj = UserEducation::model()->findByAttributes(array("UserId"=>$userId));
            return $userObj;
        } catch (Exception $ex) {
            error_log("###################Exception Occurred#########".$ex->getMessage());
        }
    }

    
  public function getUserCVEducationDetails($userId){
      
      try {
            $returnvalue = 'failure';
            $finalArray = array();

            $query = "select * from User_Education where Status=1 and UserId='".$userId."' order by Priority ASC";
            $result = Yii::app()->db->createCommand($query)->queryAll();
            
            if (sizeof($result) > 0) {
                foreach ($result as $key => $value) {
                   
                    $finalArray[$key]['EducationId'] = $value['EducationId'];
                    $finalArray[$key]['Id'] = $value['Id'];
                    $finalArray[$key]['CollegeName'] = $value['CollegeName'];
                    $finalArray[$key]['YearOfPassing'] = $value['YearOfPassing'];
                    $finalArray[$key]['Specialization'] = $value['Specialization'];
                    $educationDetails = Education::model()->getEducationDetailsByUsingId($value['EducationId']);
                   
                    $finalArray[$key]['Education'] = $educationDetails['Categoryname'];
                }
                $returnvalue = $finalArray;
            }
           
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCollection==" . $exc->getMessage(), "error", "application");
        }
        return $returnvalue;
    }
    
   public function getUserCVEducationDetailsByEducationId($UserId,$educationId){
       
        $returnValue = 'failure';
        $query = "select * from User_Education where EducationId='" . $educationId . "'and UserId=22611";
        $EducationTypes = Yii::app()->db->createCommand($query)->queryRow();


        if (count($EducationTypes) > 0) {

            $returnValue = $EducationTypes;
        }

        return $returnValue;
    }
    
    
   public function updateUserCVEducationDetails($educationModel,$UserId){
       
          $returnValue = false;
            
            $finalArray = array();
            if(trim($educationModel['Education'])!=""){
            $educationId = explode(',', $educationModel['Education']);
            $EducationIds = explode(',', $educationModel['Education_Ids']);
           
          
            foreach ($EducationIds as $key => $value) {
                $finalArray[$key]['EducationId'] = $educationId[$key];
                $finalArray[$key]['Id'] =$EducationIds[$key];
                $finalArray[$key]['CollegeName'] = $educationModel['CollegeName'][$value];
                $finalArray[$key]['YearOfPassing'] = $educationModel['YearOfPassing'][$value];
                $finalArray[$key]['Specialization'] = $educationModel['Specialization'][$value];
            }
            $i=1;
           
            foreach ($finalArray as $key => $value) {
                $userObj = new UserEducation();
                
                   $educationObj = UserEducation::model()->findByAttributes(array("Id" => $value['Id'],"EducationId" => $value['EducationId'], 'UserId' => $UserId));
            if (isset($educationObj)) {
                $educationObj->EducationId = $value['EducationId'];
                $educationObj->YearOfPassing = $value['YearOfPassing'];
                $educationObj->CollegeName = $value['CollegeName'];
                $educationObj->Specialization = $value['Specialization'];
                $educationObj->Priority = $i;
                $educationObj->Status = 1;
                if ($educationObj->update()) {
                    $returnValue = "success";
                }
            }else{
                $userObj->UserId = $UserId;
                $userObj->EducationId = $value['EducationId'];
                $userObj->YearOfPassing = $value['YearOfPassing'];
                $userObj->CollegeName = $value['CollegeName'];
                $userObj->Specialization = $value['Specialization'];
                $userObj->Priority = $i;
                $userObj->Status = 1;
                if ($userObj->save()) {
                    $returnValue = $userObj->EducationId;
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

            $sectionObj = UserEducation::model()->findByAttributes(array("UserId" => $userId,"Id"=>$secionType));
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
