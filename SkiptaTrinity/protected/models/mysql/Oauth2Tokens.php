<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    class Oauth2Tokens extends CActiveRecord {

    public $oauth_token;
    public $client_id;
    public $token_type;
    public $user_id;
    public $expires;
    public $redirect_uri;
    public $scope;
    public $created_at;
   
   
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'oauth2_tokens';
    }

     
    
     public function getOauth2TokenDetailsByCriteria($clientId,$userId) {
        $returnValue = 'failure';
        try {
              $cond=   array("client_id" => $clientId,"user_id"=>$userId);
              $Oauth2TokenInfo =  Oauth2Tokens::model()->findByAttributes($cond);
          
            if(isset($Oauth2TokenInfo) && !empty($Oauth2TokenInfo) ){
                $returnValue=$Oauth2TokenInfo;
            }
          
            return $returnValue;
        } catch (Exception $exc) {
          
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    
     
}
