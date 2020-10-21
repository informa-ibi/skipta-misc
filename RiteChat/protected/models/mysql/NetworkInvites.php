<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NetworkInvites extends CActiveRecord {

    public $id;
    public $ClientId;
    public $NetworkName;
    public $NetworkLogo;
    public $Description;
   
  
//    public $CreatedOn;
//    public $Type=13;
   
  

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'NetworkInvites';
    }

      public function getNetworkInvites() {
        $returnValue = 'failure';
        try {
            
            $networkInvitesData = NetworkInvites::model()->findAll();
            if(isset($networkInvitesData) && !empty($networkInvitesData)){
                $returnValue=$networkInvitesData;
            }
            return $networkInvitesData;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     public function getNetworkInfoId($id) {
        $returnValue = 'failure';
        try {
            
            $networkInvitesData =  NetworkInvites::model()->findByAttributes(array("id" => $id));
       
            if(isset($networkInvitesData) ){
                $returnValue=$networkInvitesData;
            }
           
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
   
}
