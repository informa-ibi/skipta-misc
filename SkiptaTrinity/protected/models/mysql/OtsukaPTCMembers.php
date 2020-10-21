<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OtsukaPTCMembers extends CActiveRecord {

    public $id;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Company;
    public $PrimaryAffiliation;
    public $Verified;
    public $Verifiedon;
    public $PandT;    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'OtsukaPTCMembers';
    }
    
    public function checkPTCMember($email){
        try{
           return OtsukaPTCMembers::model()->findByAttributes(array("Email"=>$email));
        } catch (Exception $ex) {

        }
    }
    
}
