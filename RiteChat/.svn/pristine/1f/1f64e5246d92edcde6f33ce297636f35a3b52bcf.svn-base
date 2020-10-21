<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Badges extends CActiveRecord {

    public $id;
    public $context;//context name Ex: Heart badge context could be “Love”.
    public $badgeName;//Badge name
    public $hover_text;//Text to be displayed up on hover
    public $description;//Text to be displayed in description
    public $instant;//is immediate process or background process
    public $has_level;//whether badge has levels or not
    public $stream_effect;//whether the badge info to be displayed as stream obj to followers or not
    public $honor_level;//priority of the badge
    public $image_path;//path of the badge icon
    public $units;//the number of actions to be performed by which the badge will be given
    public $isCustom;//this is boolean variable and it is used by Admin to assgin maually
  
//    public $CreatedOn;
//    public $Type=13;
   
  

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Badges';
    }

      public function getBadgeDetails() {
        $returnValue = 'failure';
        try {
            
            $badgesData = Badges::model()->findAll();
            if(isset($badgesData) && !empty($badgesData)){
                $returnValue=$badgesData;
            }
            return $badgesData;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     public function getBadgeDetailsByCriteria($context) {
        $returnValue = 'failure';
        try {
               $cond=   array("context" => $context);
              $badgesData =  Badges::model()->findByAttributes($cond);
          
            if(isset($badgesData) ){
                $returnValue=$badgesData;
            }
           
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
       public function getBadgeById($id) {
        $returnValue = 'failure';
        try {
            
            $badgesData =  Badges::model()->findByAttributes(array("id" => $id));
       
            if(isset($badgesData) ){
                $returnValue=$badgesData;
            }
           
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
        public function getCustomBadges(){
      $returnValue="failure";
      try {          
          //$criteria = new CDbCriteria();          
          //$criteria->addSearchCondition('Status', '1');
          //$customBadgeDetails=CustomBadges::model()->find($criteria);
          $query="select * from Badges where  isCustom=1";
          $customBadgeDetails = Yii::app()->db->createCommand($query)->queryAll();          
          if(count($customBadgeDetails)>0){
              $returnValue=$customBadgeDetails;
          }
          return  $returnValue;          
      } catch (Exception $exc) {
          Yii::log("Exception in custom badges ".$exc->getMessage(),"error","application");
      }
    }
    
   public function updateCustomBadgeDetails($customBadgeForm){
       $returnValue="failure";
       try {
           
           $query="update Badges set badgeName='".$customBadgeForm->BadgeName."', description='".$customBadgeForm->BadgeDescription."', image_path='".$customBadgeForm->BadgeIcon."' where id=".$customBadgeForm->id;            
           Yii::app()->db->createCommand($query)->execute();
               $returnValue="success";
           
           return $returnValue;
         
           
       } catch (Exception $exc) {
           error_log($exc->getLine()."==(===============".$exc->getMessage());
       }
      }
      
   public function getBadgeDetailsByName($badgeName){
       $returnValue='failure';
       try {          
           $badgesData =  Badges::model()->findByAttributes(array("badgeName" => $badgeName));
            if(isset($badgesData) ){
                $returnValue=$badgesData;
            }
            
            return $returnValue;  
       } catch (Exception $exc) {
            error_log($exc->getLine()."==(===============".$exc->getMessage());
       }
      } 
    
}
