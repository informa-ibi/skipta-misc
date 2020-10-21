<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailCredentials extends CActiveRecord {

    public $id;
    public $Email;
    public $Password;
    public $SMTPAddress;
    public $Port;
    public $Host;
    public $Encryption;


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'EmailCredentials';
    }
    
    /*
     * @author Praneeth
     * getEmailConfigurationDetails: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns Users Object.
     */
    public function getEmailConfigurationDetails() {
        try {
            $criteria = new CDbCriteria();
            $criteria->order= 'Email';
            $result = EmailCredentials::model()->findAll($criteria);

        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getEmailConfigurationDetails-------" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    /*
     * @author Praneeth
     * getEmailConfigurationDetailsCount:  
     * returns the total no. of email configured.
     */
     public function getEmailConfigurationDetailsCount() {
        try {
            $criteria = new CDbCriteria();
            $criteria->addSearchCondition('Email', '', true, "OR", "LIKE");
            $result = EmailCredentials::model()->count($criteria);
        } catch (Exception $exc) {
            Yii::log("==Exception Occurred in getEmailConfigurationDetailsCount===" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    /**
     * @author Praneeth
     * saveNewEmailConfiguration: to save new email configuration 
     * @param type $model
     * @return success
     */
    public function saveNewEmailConfigurationDetails($model)
    {
        try{
            $returnValue = 'false';

            if(isset($model) && empty($model->id)){
                $emailConfigObj = new EmailCredentials();
                $emailConfigObj->Email = $model['email'];
                $emailConfigObj->Password = $model['password'];
                $emailConfigObj->SMTPAddress = $model['smtpaddress'];
                $emailConfigObj->Port = $model['port'];
                $emailConfigObj->Host = $model['host'];
                $emailConfigObj->Encryption = $model['encryption'];
             
                if ($emailConfigObj->save()) {
                    $returnValue = $emailConfigObj->id;
               }
            }  
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("=====exception result======saveNewEmailConfiguration======" . $ex->getMessage(), "error", "application");
        }
    }
    
    
    public function updateEmailConfigurationDetails($model)
    {
        try{
            $returnValue = 'false';
           
             if(isset($model) && !empty($model->id)){
                $emailConfigObj = EmailCredentials::model()->findByAttributes(array("id" => $model->id));
                if (isset($emailConfigObj)) {
                    $emailConfigObj->Email = $model['email'];
                    $emailConfigObj->Password = $model['password'];
                    $emailConfigObj->SMTPAddress = $model['smtpaddress'];
                    $emailConfigObj->Port = $model['port'];
                    $emailConfigObj->Host = $model['host'];
                    $emailConfigObj->Encryption = $model['encryption'];
                    if ($emailConfigObj->update()) {
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
     * @author Praneeth
     * checkIfConfigurationEmailExist:for editing the already existing category
     * @param type $configurationId
     * @return categoryCollectionObject
     */
       /*
     * This method checks whether the help icon exist or not
     */
    public function checkIfConfigurationEmailExist($model) {
        try {
            $result = 'success';
            $configEmailIsExists = EmailCredentials::model()->findByAttributes(array("Email" => $model->email));
            if (isset($configEmailIsExists)) {
                 $result = 'failure';
            } else {
                
            }
        } catch (Exception $ex) {
            Yii::log("=====checkIfHelpIconExist========" . $ex->getMessage(), "error", "application");
        }
        return $configEmailIsExists;
    }
    
    
    /**
     * @author Praneeth
     * editEmailConfigurationDetails:for editing the already existing category
     * @param type $categoryId
     * @return categoryCollectionObject
     */
    public function editEmailConfigurationDetails($configEmailId)
    {
        try
        {
             $configEmailDetailsCollectionObject = EmailCredentials::model()->findByAttributes(array("id" => $configEmailId));
        } catch (Exception $ex) {
                Yii::log("Exception occurred in editEmailConfigurationDetails in EmailCredentials layer" . $ex->getMessage(), "error", "application");
        }
        
        return $configEmailDetailsCollectionObject;
    }
    
     /**
      * @author Praneeth
     * checkIfConfigurationEmailExist:for editing the already existing category
     * @param type $configurationId
     * @return categoryCollectionObject
     */
       /*
     * This method checks whether the help icon exist or not
     */
    public function getEmailCredentialsBasedOnEmail($email) {
        try {
            $result = 'success';
            $emailConfigurationDetails = EmailCredentials::model()->findByAttributes(array("Email" => $email));
            if (isset($emailConfigurationDetails)) {
                return $emailConfigurationDetails;
            } else {
                
            }
        } catch (Exception $ex) {
            Yii::log("=====getEmailCredentialsBasedOnEmail========" . $ex->getMessage(), "error", "application");
        }
    }
}