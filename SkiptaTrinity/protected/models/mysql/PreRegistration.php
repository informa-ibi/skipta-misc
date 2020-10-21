<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PreRegistration extends CActiveRecord {

    public $UserId;
    public $Full_Name;
    public $First_Name;
    public $Last_Name;
    public $Title_Code;
    public $NPI_NUM;
    public $Email;
    public $Phone;
    public $Practice_Name;
    public $Address;
    public $Country;
    public $State;
    public $City;
    public $Zip;
    public $Zip4;
    public $Registration_State;
    public $UpdatedOn;
    public $Invitation_Link;
    public $AccessKey;
   
    //   public $Designation ;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Pre_Registration';
    }
    /*@Author Haribabu
     *This mehtod is used to update the  Hds user any filed  by using user accesskey
     * 
     */

    public function updateUserStatus($AccessId,$field,$value) {
        try {
            $return = "failed";

            $user = PreRegistration::model()->findByAttributes(array("AccessKey" => $AccessId));
            if (isset($user)) {

                $user->$field = $value;
                if ($user->update()) {
                    $return = "success";
                }
            }
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $return;
    }

    /*@Author Haribabu
     * This method is used to get the Hds user details by using Accesskey
     */

    public function getHdsuserDetails($AccessKey) {
        try {
            $result = 'failure';
            $user = PreRegistration::model()->findByAttributes(array("AccessKey" => $AccessKey));
            if (isset($user)) {
                $result = $user;
            } 
            return $result;
        } catch (Exception $ex) {
          
            Yii::log("=====Exception in PreRegistration ---getHdsuserDetails========" . $ex->getMessage(), "error", "application");
        }
    }
     public function getHdsUsersByUsingStatus($Status) {
        try {
            
             $returnValue='failure';
             $query="select  @a := @a + 1 AS SNo,First_Name,Last_Name,Email from Pre_Registration, (SELECT @a:= 0) AS a  where  Registration_State='".$Status."'";            
             $users = Yii::app()->db->createCommand($query)->queryAll();
             if(count($users)>0){
                 $returnValue= $users;
             }
             return $returnValue;

        } catch (Exception $ex) {
          
            Yii::log("=====Exception in PreRegistration ---getHdsuserDetails========" . $ex->getMessage(), "error", "application");
        }
    }

}

