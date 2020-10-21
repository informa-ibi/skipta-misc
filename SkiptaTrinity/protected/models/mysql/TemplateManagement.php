<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TemplateManagement extends CActiveRecord {

    public $id;
    public $Title;
    public $FileName;
    public $EmailConfigured;


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'TemplateManagement';
    }
    
     /*
     * getTemplateConfigurationDetails: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns Users Object.
     */
    public function getTemplateConfigurationDetails() {
        $result = array();
        try {
            $criteria = new CDbCriteria();
            $criteria->order= 'Title';
            $result = TemplateManagement::model()->findAll($criteria);

        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getTemplateConfigurationDetails-------" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    /*
     * getEmailConfigurationDetailsCount:  
     * returns the total no. of email configured.
     */
     public function getTemplateConfigurationDetailsCount() {
         $result=0;
        try {
            $criteria = new CDbCriteria();
            $criteria->addSearchCondition('Title', '', true, "OR", "LIKE");
            $result = TemplateManagement::model()->count($criteria);
        } catch (Exception $exc) {
            Yii::log("==Exception Occurred in getTemplateConfigurationDetailsCount===" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    
    /**
     * checkIfConfigurationEmailExist:for editing the already existing category
     * @param type $configurationId
     * @return categoryCollectionObject
     */
       /*
     * This method checks whether the help icon exist or not
     */
    public function checkIfTemplateTitleExist($model) {
        try {
            $result = 'success';
            $configTemaplateIsExists = TemplateManagement::model()->findByAttributes(array("Title" => $model->title));
            if (isset($configTemaplateIsExists)) {
                 $result = 'failure';
            } else {
                
            }
        } catch (Exception $ex) {
            Yii::log("=====checkIfHelpIconExist========" . $ex->getMessage(), "error", "application");
        }
        return $configTemaplateIsExists;
    }
    
    /**
     * saveNewEmailConfiguration: to save new email configuration 
     * @param type $model
     * @return success
     */
    public function saveNewTemplateConfigurationDetails($model)
    {
        try{
            $returnValue = 'false';

            if(isset($model) && empty($model->id)){
                $templateConfigObj = new TemplateManagement();
                $templateConfigObj->Title = $model['title'];
                $templateConfigObj->FileName = $model['filename'];
                $templateConfigObj->EmailConfigured = $model['email'];
             
                if ($templateConfigObj->save()) {
                    $returnValue = $templateConfigObj->id;
               }
            }  
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("=====exception result======saveNewEmailConfiguration======" . $ex->getMessage(), "error", "application");
        }
    }
    
     public function updateTemplateConfigurationDetails($model)
    {
        try{
            $returnValue = 'false';
           
             if(isset($model) && !empty($model->id)){
                $templateConfigObj = TemplateManagement::model()->findByAttributes(array("id" => $model->id));
                if (isset($templateConfigObj)) {
                    
                $templateConfigObj->Title = $model['title'];
                $templateConfigObj->FileName = $model['filename'];
                $templateConfigObj->EmailConfigured = $model['email'];
                    if ($templateConfigObj->update()) {
                        $returnValue = "updatetrue";
                    }
                }
                } else
                {
                   $returnValue = "updatefalse"; 
                }
                
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("=====exception result======updateEmailConfigurationDetails======" . $ex->getMessage(), "error", "application");
        }
    }
    
    /**
     * editEmailConfigurationDetails:for editing the already existing category
     * @param type $categoryId
     * @return categoryCollectionObject
     */
    public function editTemplateConfigurationDetails($configTemplateId)
    {
        try
        {
             $configTemplateDetailsCollectionObject = TemplateManagement::model()->findByAttributes(array("id" => $configTemplateId));
        } catch (Exception $ex) {
                Yii::log("Exception occurred in editTemplateConfigurationDetails in TemplateManagement layer" . $ex->getMessage(), "error", "application");
        }
        
        return $configTemplateDetailsCollectionObject;
    }
    
    public function getEmailBasesOnTitle($titleType)
    {
        try
        {
            $templateDetailsCollectionObject = TemplateManagement::model()->findByAttributes(array("Title" => $titleType));
        } catch (Exception $ex) {
                Yii::log("Exception occurred in getEmailBasesOnTitle in TemplateManagement layer" . $ex->getMessage(), "error", "application");
        }
        return $templateDetailsCollectionObject;
    }
}