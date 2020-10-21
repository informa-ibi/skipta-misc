<?php

class ReferralLinks extends CActiveRecord {

    public $id;
    public $Message;
    public $Link;
    public $UserId;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'ReferralLinks';
    }

    public function saveUserReferrerDetails($userId,$message) {
        try {
            $returnValue='failure';
            $ReferrerObj = new ReferralLinks();

            $ReferrerObj->Message = trim($message);
            $ReferrerObj->Link = "";
            $ReferrerObj->UserId = $userId;
            $ReferrerObj->CreatedOn = date('Y-m-d H:i:s', time());

            if ($ReferrerObj->save()) {
                $returnValue = $ReferrerObj->id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
    }

     public function getUserReferralDetails($linkId) {
       try {
            $return = "failed";
           
            $ReferralDetails = ReferralLinks::model()->findByAttributes(array("id"=>trim($linkId)));
            if (isset($ReferralDetails)) {
              $return= $ReferralDetails;
            }
            return $return;
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserType in User Model=" . $ex->getMessage(), "error", "application");
            return "failure";
        }
    }
    

}
