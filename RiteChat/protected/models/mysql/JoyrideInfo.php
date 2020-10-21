<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class JoyrideInfo extends CActiveRecord {
    public $Id;
    public $Name;
    
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'Application_Tour';
    }
    
    public function getJoyrideDetails() {
        $returnValue = 'failure';
        try {
             $criteria = new CDbCriteria();
              $criteria->addCondition("fromPage!=toPage");
            $joyrideData = JoyrideInfo::model()->findAll();
            if(isset($joyrideData) && !empty($joyrideData)){
                $returnValue=$joyrideData;
            }
            return $joyrideData;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
    public function getJoyrideDetailsByModule($module) {
        $returnValue = 'failure';
        try {
             $criteria = new CDbCriteria();
             $criteria->addSearchCondition('fromPage', $module);
          
            $joyrideData = JoyrideInfo::model()->findAll($criteria);
            if(isset($joyrideData) && !empty($joyrideData)){
                $returnValue=$joyrideData;
            }
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
  
}