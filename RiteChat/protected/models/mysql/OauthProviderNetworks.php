<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OauthProviderNetworks extends CActiveRecord {

    public $id;
    public $NetworkName;
    public $ClientId;
    public $ProviderUrl;
  
  
//    public $CreatedOn;
//    public $Type=13;
   
  

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'OauthProviderNetworks';
    }

      public function getAllOauthProviderDetails() {
        $returnValue = 'failure';
        try {
              $criteria = new CDbCriteria();
              $criteria->addSearchCondition("status",'1');
            $providersData = OauthProviderNetworks::model()->findAll($criteria);
          // error_log("********getAllOauthProviderDetails***********".count($providersData));
            if(isset($providersData) && !empty($providersData)){
                $returnValue=$providersData;
            }
            return $providersData;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
    
    
       public function getOauthProviderDetailsByType($type,$value) {
        $returnValue = 'failure';
        try {
            
             $providersData = OauthProviderNetworks::model()->findByAttributes(array($type=>$value)); 
            if(isset($providersData) && !empty($providersData)){
                $returnValue=$providersData;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
}
