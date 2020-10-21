<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Oauth2Clients extends CActiveRecord {

    public $client_id;
    public $client_secret;
    public $redirect_uri;
    public $app_owner_user_id;
    public $app_title;
    public $app_desc;
    public $status;
    public $created_at;
    public $domain_name;
    public $pic;
   
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'oauth2_clients';
    }

      public function getAllOauth2Clients() {
        $returnValue = 'failure';
        try {
            
            $Oauth2Clients = Oauth2Clients::model()->findAll();
            if(isset($Oauth2Clients) && !empty($Oauth2Clients)){
                $returnValue=$Oauth2Clients;
            }
            return $Oauth2Clients;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     public function getOauth2ClientDetailsByCriteria($type,$value) {
        $returnValue = 'failure';
        try {
               $cond=   array($type => $value);
              $Oauth2Clients =  Oauth2Clients::model()->findByAttributes($cond);
          
            if(isset($Oauth2Clients) && !empty($Oauth2Clients) ){
                $returnValue=$Oauth2Clients;
            }
           
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     
}
