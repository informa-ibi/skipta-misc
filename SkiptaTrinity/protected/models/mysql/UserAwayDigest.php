<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author 
 * This is model class for UserAwayDigest
 * 
 */
class UserAwayDigest extends CActiveRecord {
    public $Id;
    public $UserId;
    public $LastSentOn;

     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'UserAwayDigest';
    }
    
     public function getUserAwayDigest($userId) {

         try {
            $return = "failure";

            $UserAwayDigest = UserAwayDigest::model()->findByAttributes(array("UserId" => $userId));
            if (isset($UserAwayDigest)) {

                $return = $UserAwayDigest->Id;
            }
            else{
              $UserAwayDigest = new UserAwayDigest();
              $UserAwayDigest->UserId = $userId;
              if ($UserAwayDigest->save()) {
                $return = $UserAwayDigest->Id;
              }
            }
           
        } catch (Exception $ex) {
            Yii::log("Exception occurred in UserAwayDigest in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
       return   $return;
    }
    

   public function getAwayDigestSentUserListFromPastFourDays() {
        try {
            $return = array();

             $query="select Id  from UserAwayDigest where LastSentOn >= (NOW() - INTERVAL 5 DAY)";            
             $UserAwayDigest = Yii::app()->db->createCommand($query)->queryAll();
            if (isset($UserAwayDigest)) {
                $userList=array();
                foreach($UserAwayDigest as $user){
                   array_push($userList, $user["Id"]);
                }
               $return = $userList;
            }

           
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getUserAwayDigest in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
       return   $return;
    }
  public function updateUserAwayDigest($userAwayDigestId) {

         try {
            $return = "failure";

            $UserAwayDigest = UserAwayDigest::model()->findByAttributes(array("Id" => $userAwayDigestId));
            if (isset($UserAwayDigest)) {

                $UserAwayDigest->LastSentOn = date('Y-m-d H:i:s', time());
                if ($UserAwayDigest->update()) {
                    $return = $UserAwayDigest->Id;
                }
            }
           
        } catch (Exception $ex) {
            Yii::log("Exception occurred in UserAwayDigest in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
       return   $return;
    }
}