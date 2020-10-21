<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserPublications extends CActiveRecord {

    public $Id;
    public $UserId;
    public $Name;
    public $Title;
    public $PublicationDate;
    public $Location;
    public $Link;
    public $Files;
    public $CreatedOn;
    public $Authors;
    public $Priority;
    public $Status=1;
    public $Publication_Priority;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'User_Publications';
    }

    public function saveUserPublicationDetails($educationModel,$UserId) {
        try {
            $returnValue = false;
          
            $finalArray = array();
              $PublicationPriority=$educationModel['PublicationsPriority'];
              if(trim($educationModel['Publications'])!=""){
            $educationId = explode(',', $educationModel['Publications']);
            foreach ($educationId as $key => $value) {
                
                $finalArray[$value]['Name'] = $educationModel['PublicationName'][$value];
                $finalArray[$value]['Title'] = $educationModel['PublicationTitle'][$value];
                $finalArray[$value]['Authors'] = $educationModel['PublicationAuthors'][$value];
                $finalArray[$value]['PublicationDate'] = $educationModel['PublicationDate'][$value];
                $finalArray[$value]['Location'] = $educationModel['PublicationLocation'][$value];
                $finalArray[$value]['Link'] = $educationModel['PublicationLink'][$value];
                $finalArray[$value]['Files'] = $educationModel['PublicationPdf'][$value];
            }
            
            $i=1;
           // error_log("publications final array".print_r($finalArray,true));
            foreach ($finalArray as $key => $value) {
                  $userObj = new UserPublications();
                $userObj->UserId = $UserId;
                $userObj->Name = $value['Name'];
                $userObj->Title = $value['Title'];
                $userObj->Authors = $value['Authors'];
                $userObj->PublicationDate = $value['PublicationDate'];
                $userObj->Location = $value['Location'];
                $userObj->Link = $value['Link'];
                $userObj->Priority = $i;
                $userObj->Status = 1;
                $userObj->Publication_Priority = $PublicationPriority;
                if($value['Files']!=""){
                    $file=$this->savePublicationArtifacts($value['Files']);
                    $userObj->Files= $file;
                }

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

    
    public function getUserPublicationDetails($userId){
        try{
            $userObj = UserPublications::model()->findByAttributes(array("UserId"=>$userId,"Status"=>1));
            return $userObj;
        } catch (Exception $ex) {
            error_log("###################Exception Occurred#########".$ex->getMessage());
        }
    }

     public function getUserCVpublicationDetails($userId){
      
      try {
            $returnvalue = 'failure';
            $finalArray = array();

//            $criteria = new CDbCriteria();
//            $criteria->addSearchCondition('UserId', $userId);
//            $criteria->order = 'Priority ASC';
//            $result = UserPublications::model()->findAll($criteria);
            $query = "select * from User_Publications where UserId='".$userId."' and Status=1 order by Priority ASC";
            $result = Yii::app()->db->createCommand($query)->queryAll();

            if (sizeof($result) > 0) {
              
                $returnvalue = $result;
            }
          
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCollection==" . $exc->getMessage(), "error", "application");
        }
        return $returnvalue;
    }
    
   public function getUserCVPublicationDetailsByPublicationId($UserId,$educationId){
       
        $returnValue = 'failure';
            $query = "select * from User_Publications where AchievementId=".$educationId."and UserId=".$UserId;
            $EducationTypes = Yii::app()->db->createCommand($query)->queryRow();
            if (count($EducationTypes) > 0) {
                $returnValue = $EducationTypes;
            }
            return $returnValue;
       
   }  
    
    
    public function updateUserPublicationDetails($educationModel,$UserId){
         try {
            $finalArray = array();
            if(trim($educationModel['Publications'])!=""){
            $educationId = explode(',', $educationModel['Publications']);
            $PublicationPriority=$educationModel['PublicationsPriority'];
            foreach ($educationId as $key => $value) {
                $finalArray[$key]['Id'] = $value;
                $finalArray[$key]['Name'] = $educationModel['PublicationName'][$value];
                $finalArray[$key]['Title'] = $educationModel['PublicationTitle'][$value];
                $finalArray[$key]['Authors'] = $educationModel['PublicationAuthors'][$value];
                $finalArray[$key]['PublicationDate'] = $educationModel['PublicationDate'][$value];
                $finalArray[$key]['Location'] = $educationModel['PublicationLocation'][$value];
                $finalArray[$key]['Link'] = $educationModel['PublicationLink'][$value];
                $finalArray[$key]['Files'] = $educationModel['PublicationPdf'][$value];
            }
            $i=1;
             //error_log("pppppppp".print_r($finalArray,true));
            foreach ($finalArray as $key => $value) {
                
                $userObj = new UserPublications();
                $educationObj = UserPublications::model()->findByAttributes(array("Id" => $value['Id'], 'UserId' => $UserId));
            if (isset($educationObj)) {
                
                $educationObj->Name = $value['Name'];
                $educationObj->Title = $value['Title'];
                $educationObj->Authors = $value['Authors'];
                $educationObj->PublicationDate = $value['PublicationDate'];
                $educationObj->Location = $value['Location'];
                $educationObj->Link = $value['Link'];
                $educationObj->Files= $value['Files'];
                $educationObj->Status = 1;
                $educationObj->Publication_Priority = $PublicationPriority;
                if($value['Files']!=""){
                    $file=$this->savePublicationArtifacts($value['Files']);
                    $educationObj->Files= $file;
                }
                $educationObj->Priority = $i;
                
                if ($educationObj->update()) {
                    
                    $returnValue = "success";
                }
            }else{
                
                $userObj->UserId = $UserId;
                $userObj->Name = $value['Name'];
                $userObj->Title = $value['Title'];
                $userObj->Authors = $value['Authors'];
                $userObj->PublicationDate = $value['PublicationDate'];
                $userObj->Location = $value['Location'];
                $userObj->Link = $value['Link'];
                $userObj->Status = 1;
                $userObj->Publication_Priority = $PublicationPriority;
                if($value['Files']!=""){
                    $file=$this->savePublicationArtifacts($value['Files']);
                    $userObj->Files= $file;
                }
                
                
                $userObj->Priority = $i;
                
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
    function savePublicationArtifacts($Artifacts) {

     try {
           
         $returnValue = 'failure';
            $Resource = array();
            $folder = Yii::app()->params['WebrootPath'];
            $returnarry = array();
            if ($Artifacts != "") {
                $ExistArtifact = $folder . $Artifacts;

                if (!file_exists($ExistArtifact)) {
                    $imgArr = explode(".", $Artifacts);
                    $date = strtotime("now");
                    $finalImg_name = $imgArr[0] . '.' . end($imgArr);
                    $finalImage = trim($imgArr[0]) . '.' . end($imgArr);

                    $fileNameTosave = $folder . '/temp/' . $imgArr[0] . '.' . end($imgArr);
                    $sourceArtifact = $folder . '/temp/' . $Artifacts;
                    rename($sourceArtifact, $fileNameTosave);
                    //  $filename=$result['filename'];
                    $extension = substr(strrchr($Artifacts, '.'), 1);
                    $extension = strtolower($extension);

                   // $path = 'Profile';

                    $path = '/upload/Cv/Profile/' . $path;
                    if (!file_exists($folder . '/' . $path)) {

                        mkdir($folder . '/' . $path, 0755, true);
                    }
                    $sourcepath = $fileNameTosave;
                    $destination = $folder . $path . '/' . $finalImage;
                    if (file_exists($sourcepath)) {
                        if (copy($sourcepath, $destination)) {
                            $newfile = trim($imgArr[0]) . '_' . $date . '.' . end($imgArr);
                            //  $newfile=trim($imgArr[0]) .'.' . $imgArr[1];
                            $finalSaveImage = $folder . $path . '/' . $newfile;
                            rename($destination, $finalSaveImage);
                            $UploadedImage = $path . $newfile;
                            $Resource['ResourceName'] = $artifact;
                            $Resource['Uri'] = $UploadedImage;
                            $Resource['Extension'] = $extension;
                            $Resource['ThumbNailImage'] = $UploadedImage;

                            // unlink($sourcepath);
                            $returnValue = "success";
                        }
                    } else {
                        $UploadedImage = $path .$Artifacts;
                    }
                } else {
                    $UploadedImage = $Artifacts;
                    $Resource['ResourceName'] = "";
                    $Resource['Uri'] = "";
                    $Resource['Extension'] = "";
                    $Resource['ThumbNailImage'] = $UploadedImage;
                }
            }
            return $UploadedImage;
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
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

            $sectionObj = UserPublications::model()->findByAttributes(array("UserId" => $userId,"Id"=>$secionType));
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
