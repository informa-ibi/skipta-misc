<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserType extends CActiveRecord {
    public $Id;
    public $Name;
    
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'UserType';
    }
    
    public function getUserTypes() {
        $returnValue = 'failure';
        try {
            $userTypes = UserType::model()->findAll();
            if(isset($usertypes) && !empty($usertypes)){
                $returnValue=$userTypes;
            }
            return $userTypes;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    public function saveRole($role) {
        try {
            $returnValue = 'failure';
            $userType = new UserType();
            $userType->Name = $role;
            $userType->save();
            if ($userType->save()) {
                $returnValue = $userType->Id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("saveRole in UserType.php", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    public function isRoleExist($role) {
        try {
            $result = 'false';
            
            $isUserTypeExists = UserType::model()->findByAttributes(array("Name" => $role));
           
            if (isset($isUserTypeExists)) {
                 $result = 'true';
            }
            return $result;
        } catch (Exception $ex) {
            Yii::log("=====checkIfHelpIconExist========" . $ex->getMessage(), "error", "application");
            return false;
        }
        
    }
    public function getUserTypeObjectById($typeId) {
        try {
            $result = 'false';
            
            $getUserTypeObject = UserType::model()->findByAttributes(array("Id" => $typeId));
            $result=$getUserTypeObject;
            return $result;
        } catch (Exception $ex) {
            Yii::log("=====checkIfHelpIconExist========" . $ex->getMessage(), "error", "application");
            return false;
        }
        
    }
    public function getRoleByName($role) {
        try {
            $result = 'false';
            $isUserTypeExists = UserType::model()->findByAttributes(array("Name" => $role));
           
            if (isset($isUserTypeExists)) {
                 $result=$isUserTypeExists->Id;
            }
            
            return $result;
        } catch (Exception $ex) {
            Yii::log("=====checkIfHelpIconExist========" . $ex->getMessage(), "error", "application");
            return false;
        }
        
    }
}