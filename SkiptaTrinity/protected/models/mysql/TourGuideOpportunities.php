<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TourGuideOpportunities extends CActiveRecord {
    
    public $Id;
    public $OpportunityName;
    public $Level;
    public $Status;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'TourGuideOpportunities';
    }
    /*
     * this method is use to get the opportunities by level
     * @return type array
     */
    public function getTourOpportunitiesByLevel($level) {
        $opportunities=array();
        try {
            $query="select * from TourGuideOpportunities where Level=".$level;
            $opportunities=Yii::app()->db->createCommand($query)->queryAll();
            return $opportunities;
        } catch (Exception $exc) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    /*
     * this method is use to get the opportunities by level
     * @return type array
     */
    public function getNextOpportunities($opportunityId,$level) {
        $opportunities=array();
        try {
            $query="select * from TourGuideOpportunities where Status=1 and Level=".$level." and Id >= ".$opportunityId." order by Id asc";
           
            $opportunities=Yii::app()->db->createCommand($query)->queryAll();
            return $opportunities;
        } catch (Exception $exc) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    /*
     * this method is use to get the opportunities by level
     * @return type array
     */
    public function getOpportunityByType($opportunityName,$level) {
        $opportunities=array();
        try {
            $query="select * from TourGuideOpportunities where Status=1 and Level=".$level." and OpportunityName = '".$opportunityName."' order by Id asc";
          
            $opportunities=Yii::app()->db->createCommand($query)->queryRow();
            return $opportunities;
        } catch (Exception $exc) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    
    /*
     * this method is use to get the opportunities by level
     * @return type array
     */
    public function getTourOpportunityById($opportunityId) {
        $opportunities=array();
        try {
            $query="select * from TourGuideOpportunities  where  Status=1 and Id=".($opportunityId);
            $opportunities=Yii::app()->db->createCommand($query)->queryAll();
            return $opportunities;
        } catch (Exception $exc) {
            Yii::log("--" . $exc->getMessage(), 'error', 'application');
        }
    }
    
    
    
    
    

}
