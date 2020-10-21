<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BadgesLevel extends CActiveRecord {
    public $id;
    public $badgeId;
    public $levelValue;//Level no
    public $unitValue;//unit no
   
  
//    public $CreatedOn;
//    public $Type=13;
   
  

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'BadgesLevel';
    }

     
    
     public function getBadgeDetailsByBadgeId($badgeId,$levelValue,$offset=0,$limit=1) {
        $returnValue = 'failure';
       
        try {
            if($levelValue=='')
                $cond=   array("badgeId" => $badgeId);
            else
               $cond=   array("badgeId" => $badgeId,"levelValue"=>$levelValue);
              $returnValue =  BadgesLevel::model()->findAllByAttributes($cond,array('order'=>'levelValue ASC', 'limit' => $limit,'offset' => $offset));
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     public function getBadgeDetailsCountByBadgeId($badgeId) {
        $returnValue = 'failure';
       
        try {
            
                $cond=   array("badgeId" => $badgeId);
              $returnValue =  BadgesLevel::model()->findAllByAttributes($cond);
            return count($returnValue);
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
    
      
}
