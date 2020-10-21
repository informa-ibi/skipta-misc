<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserHelpManagement extends CActiveRecord {

    public $Id;
    public $Name;
    public $DivIdTitle;
    public $Status;
    public $CreatedDate;
    public $VideoPath;
    public $Cue;


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'HelpManagement';
    }
    
    /*
     * GetHelpIconsDescriptionlistList: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns Users Object.
     */
    public function getHelpIconsDescriptionList($filterValue, $searchText, $startLimit=0, $pageLength=10) {
        try {
            $criteria = new CDbCriteria();
            if (trim($filterValue) == "all") {
                $criteria = $criteria;
            } else if (trim($filterValue) == "active") {
                $criteria->addSearchCondition('Status', '1');
            } else if (trim($filterValue) == "deleted") {
                $criteria->addSearchCondition('Status', '0');
            }
            if (!empty($searchText) && $searchText != "undefined" && $searchText != "null") {
                $criteria->addSearchCondition('Name', $searchText, true, "OR", "LIKE");
            }
            $criteria->offset = $startLimit;
            $criteria->limit = $pageLength;
            $criteria->order= 'Name';
            $result = UserHelpManagement::model()->findAll($criteria);
            for($i=0; $i<sizeof($result);$i++){
                $result[$i]->CreatedDate = date("m/d/Y",strtotime($result[$i]->CreatedDate));
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getHelpIconsDescriptionList--1111111-----==" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
     
    /*
     * GetCurbsideCategoryCount: which takes 2 arguments and 
     * returns the total no. of categories.
     */
     public function getHelpIconsDescriptionListCount($filterValue, $searchText) {
        try {
            $criteria = new CDbCriteria();
            if (trim($filterValue) == "all") {
                $criteria = $criteria;
            } else if (trim($filterValue) == "active") {
                $criteria->addSearchCondition('Status', '1');
            } else if (trim($filterValue) == "deleted") {
                $criteria->addSearchCondition('Status', '0');
            }
            if (!empty($searchText) && $searchText != "undefined" && $searchText != "null") {
                $criteria->addSearchCondition('Name', $searchText, true, "OR", "LIKE");
            }            
            $result = UserHelpManagement::model()->count($criteria);
        } catch (Exception $exc) {
            Yii::log("==Exception Occurred in getUserProfileCount==" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    /**
     * saveNewHelpIcon: to save new curbside category
     * @param type $model
     * @return success
     */
    public function saveNewHelpIcon($model)
    {
        try{
            $returnValue = 'false';
            $imagepath="";
            $nameTrimmed = str_replace(' ', '', $model['name']);
            $imagepath = $model['artifacts'];
            if(isset($model) && empty($model->id)){
                $helpIconObj = new UserHelpManagement();
                $helpIconObj->Name = $model['name'];
                $helpIconObj->DivIdTitle = $nameTrimmed.'_DivId';
                //$helpIconObj->DivIdTitle= 'postHelpId';
                if($imagepath !='')
                {
                   $helpIconObj->VideoPath = $imagepath;
                }
                $helpIconObj->Cue = $model['cue'];
                $helpIconObj->Description = $model['description'];
                $helpIconObj->Status = '1';
                $helpIconObj->CreatedDate = date('Y-m-d H:i:s', time());
                if ($helpIconObj->save()) {
                  // $returnValue = 'true';
                    $returnValue = $helpIconObj->Id;
               }
            }  
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("=====exception result======saveNewHelpIcon======" . $ex->getMessage(), "error", "application");
        }
    }
    
    public function updateHelpIcon($model)
    {
        try{
            $returnValue = 'false';
            $imagepath="";
            $nameTrimmed = str_replace(' ', '', $model['name']);
            $imagepath = $model['artifacts'];
             if(isset($model) && !empty($model->id)){
                $helpIconObj = UserHelpManagement::model()->findByAttributes(array("Id" => $model->id));
                if (isset($helpIconObj)) {
                    $helpIconObj->Name = $model['name'];
                    $helpIconObj->Description = $model['description'];
                    $helpIconObj->DivIdTitle = $nameTrimmed . '_DivId';
                    if ($imagepath != '') {
                        $helpIconObj->VideoPath = $imagepath;
                    }
                    else {
                        $helpIconObj->VideoPath=" ";
                    }
                    $helpIconObj->Cue = $model['cue'];
                    $helpIconObj->Status = '1';
                    $helpIconObj->CreatedDate = date('Y-m-d H:i:s', time());
                    if ($helpIconObj->update()) {
                        $returnValue = "updatetrue";
                    }
                }
                } else
                {
                   $returnValue = "updatefalse"; 
                }
                
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("=====exception result======saveNewHelpIcon======" . $ex->getMessage(), "error", "application");
        }
    }
    //
    /**
     * editHelpIconDetails:for editing the already existing category
     * @param type $categoryId
     * @return categoryCollectionObject
     */
    public function editHelpIconDetails($iconNameId)
    {
        try
        {
             $iconDetailsCollectionObject = UserHelpManagement::model()->findByAttributes(array("Id" => $iconNameId));
        } catch (Exception $ex) {
                Yii::log("Exception occurred in editHelpIconDetails in UserHelpManagement layer" . $ex->getMessage(), "error", "application");
        }
        
        return $iconDetailsCollectionObject;
    }
    
    public function getHelpDescriptionById($helpIconId)
    {
        try
        { 
            $helpDescriptionObject = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('HelpManagement u')
                    ->where('u.DivIdTitle="'.$helpIconId.'" '.'and u.Status=1')
                    ->queryRow();
            
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getHelpDescriptionById in UserHelpManagement layer" . $ex->getMessage(), "error", "application");
        }
        return $helpDescriptionObject;
    }
    
    
       /*
     * This method checks whether the help icon exist or not
     */
    public function checkIfHelpIconExist($model) {
        try {
           //  Yii::log("*********NAME********".$model->name, "error", "application");
            $result = 'success';
            $helpIconIsExists = UserHelpManagement::model()->findByAttributes(array("Name" => $model->name));
            if (isset($helpIconIsExists)) {
                 $result = 'failure';
            } else {
                
            }
        } catch (Exception $ex) {
            Yii::log("=====checkIfHelpIconExist========" . $ex->getMessage(), "error", "application");
        }
        return $helpIconIsExists;
    }
    
    /*
     * updateHelpIconStatus: which takes 2 arguments 1: userId and 2: value.
     * This is used to update the status of a help icon.
     */
    public function updateHelpIconStatus($helpIconid,$helpIconStatus) {
        try {
             $return = "failed";
            $helpStatus = UserHelpManagement::model()->findByAttributes(array("Id" => $helpIconid));
            if (isset($helpStatus)) {

                $helpStatus->Status = $helpIconStatus;
                if ($helpStatus->update()) {
                    $return = "success";
                }
            }
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateHelpIconStatus in UserHelpManagement layer=" . $ex->getMessage(), "error", "application");
        }
        return $return;
    }
            
}