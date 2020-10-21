<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserInterests extends CActiveRecord {

    public $Id;
    public $UserId;
    public $InterestId;
    public $Tags;
    public $Description;
    public $Priority;
    public $Status=1;
    public $Interest_Priority;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'User_Interests';
    }

    public function saveUserCVInterestsDetails($educationModel,$UserId) {
        try {
            $returnValue = false;
          
            $finalArray = array();
            $InterestPriority=$educationModel['InterestsPriority'];
            if(trim($educationModel['Interests'])!=""){
               
            $educationId = explode(',', $educationModel['Interests']);
            
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['InterestId'] = $value;
                $finalArray[$key]['Tags'] = $educationModel['UserInterests'][$value];
            }
           
            $i=1;
            
            foreach ($finalArray as $key => $value) {
                 $userObj = new UserInterests();
                $userObj->UserId = $UserId;
                $userObj->InterestId = $value['InterestId'];
                $userObj->Tags = $value['Tags'];
                $userObj->Priority = $i;
                $userObj->Status = 1;
                $userObj->Interest_Priority = $InterestPriority;
                
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
     public function getUserCVInterestsDetails($userId){
      
      try {
            $returnvalue = 'failure';
            $finalArray = array();
//            $criteria = new CDbCriteria();
//            $criteria->addSearchCondition('UserId', $userId);
//            $criteria->order = 'Priority ASC';
//            $result = UserInterests::model()->findAll($criteria);
             $query = "select * from User_Interests where Status =1 and UserId='".$userId."' order by Priority ASC";
            $result = Yii::app()->db->createCommand($query)->queryAll();
            if (sizeof($result) > 0) {
                foreach ($result as $key => $value) {
                    $finalArray[$key]['InterestId'] = $value['InterestId'];
                    $finalArray[$key]['Tags'] = $value['Tags'];
                    $finalArray[$key]['Id'] = $value['Id'];
                    $educationDetails = Interests::model()->getInterestsDetailsByUsingId($value['InterestId']);
                    $finalArray[$key]['Interests'] = $educationDetails['Interests'];
                    $finalArray[$key]['Interest_Priority'] = $value['Interest_Priority'];
                }
                $returnvalue = $finalArray;
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCollection==" . $exc->getMessage(), "error", "application");
        }
        return $returnvalue;
    }
    
    public function getUserCVInterestsDetailsByEducationId($UserId,$educationId){
       
        $returnValue = 'failure';
            $query = "select * from User_Interests where InterestId=".$educationId."and UserId=".$UserId;
            $EducationTypes = Yii::app()->db->createCommand($query)->queryRow();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
       
   }
    
    public function updateUserCVInterestsDetails($educationModel,$UserId){
        
        try {
            $returnValue = false;

            $finalArray = array();
            $InterestPriority=$educationModel['InterestsPriority'];
             if(trim($educationModel['Interests'])!=""){
            $educationId = explode(',', $educationModel['Interests']);
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['InterestId'] = $value;
                $finalArray[$key]['Tags'] = $educationModel['UserInterests'][$value];
            }
            $i = 1;
            
            foreach ($finalArray as $key => $value) {
                $userObj = new UserInterests();
                $educationObj = UserInterests::model()->findByAttributes(array("InterestId" => $value['InterestId'], 'UserId' => $UserId));

                if (isset($educationObj)) {
                    $educationObj->InterestId = $value['InterestId'];
                    $educationObj->UserId = $UserId;
                    $educationObj->Tags = $value['Tags'];
                    $educationObj->Priority = $i;
                    $educationObj->Status = 1;
                    $educationObj->Interest_Priority = $InterestPriority;

                    if ($educationObj->update()) {
                        $returnValue = "success";
                    }
                } else {
                    $userObj->UserId = $UserId;
                $userObj->InterestId = $value['InterestId'];
                $userObj->Tags = $value['Tags'];
                $userObj->Priority = $i;
                $userObj->Status = 1;
                $userObj->Interest_Priority = $InterestPriority;
                if ($userObj->save()) {
                    $returnValue = $userObj->InterestId;
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

    public function getUserInterestsDetails($userId){
        try{
            $userObj = UserInterests::model()->findByAttributes(array("UserId"=>$userId));
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

            $sectionObj = UserInterests::model()->findByAttributes(array("UserId" => $userId,"InterestId"=>$secionType));
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
/*
* @developer: Haribabu 
* UpdateUserCVStatus: 
* This is used to update the user interests details from profile page
*/

    public function updateUserInterests($userProfileModel) {
        try {
            $returnValue = "failure";
            if(trim($userProfileModel['UserInterests'])!=""){
            $userObj = new UserInterests();
            $educationObj = UserInterests::model()->findByAttributes(array("InterestId" => (int) 1, 'UserId' => $userProfileModel['UserId']));

            if (isset($educationObj)) {
                $educationObj->InterestId = (int) 1;
                $educationObj->UserId = $userProfileModel['UserId'];
                $educationObj->Tags = $userProfileModel['UserInterests'];
                $educationObj->Priority = 1;
                $educationObj->Status = 1;
                $educationObj->Interest_Priority = 2;

                if ($educationObj->update()) {
                    $returnValue = "success";
                }
            } else {
                $userObj->UserId = $userProfileModel['UserId'];
                $userObj->InterestId = 1;
                $userObj->Tags = $userProfileModel['UserInterests'];
                $userObj->Priority = 1;
                $userObj->Status = 1;
                $userObj->Interest_Priority = 2;
                if ($userObj->save()) {
                    $returnValue = $userObj->InterestId;
                }
            }
            if($userProfileModel['UserInterests']!=""){
               $UserInterests= Cv_Interests::model()->SaveUserInterestsFromProfile($userProfileModel['UserInterests']);
            }
            }else{
                $returnValue = "success";
           }
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
    }
/*
* @developer: Haribabu 
* UpdateUserCVStatus: 
* This is used to get the user interests details for profile page
*/
    public function getUserCVInterestsDetailsForProfile($userId) {

        try {
            $returnvalue = 'failure';
            $finalArray = array();

            $query = "select * from User_Interests where Status =1 and InterestId=1 and UserId='" . $userId . "' order by Priority ASC";
            $result = Yii::app()->db->createCommand($query)->queryAll();
            if (sizeof($result) > 0) {
                foreach ($result as $key => $value) {
                    $finalArray['InterestId'] = $value['InterestId'];
                    $finalArray['Tags'] = $value['Tags'];
                    $finalArray['Id'] = $value['Id'];
                    $educationDetails = Interests::model()->getInterestsDetailsByUsingId($value['InterestId']);
                    $finalArray['Interests'] = $educationDetails['Interests'];
                    $finalArray['Interest_Priority'] = $value['Interest_Priority'];
                }
                $returnvalue = $finalArray;
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCollection==" . $exc->getMessage(), "error", "application");
        }
        return $returnvalue;
    }

}
