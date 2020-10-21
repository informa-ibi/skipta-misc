<?php


class UserLinks extends CActiveRecord {

    public $LinkId;
    public $ReferrerUserId;
    public $RecipientEmail;
    public $Status;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'link_user';
    }

    public function saveUserLinkDetails($linkId, $userId, $email) {
        try {
            $returnValue = false;
            $linkObj = new UserLinks();
            $linkObj->LinkId = $linkId;
            $linkObj->ReferrerUserId = $userId;
            $linkObj->RecipientEmail = $email;
            $linkObj->Status = 0;
            if ($linkObj->save()) {
                $returnValue = true;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
    }

    public function getUserReferralDetails($email,$linkId) {
       try {
            $return = "failed";
           
            $user = UserLinks::model()->findByAttributes(array("RecipientEmail" => trim($email),"LinkId"=>trim($linkId)));
            if (isset($user)) {
              $return= $user;
            }
            return $return;
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserType in User Model=" . $ex->getMessage(), "error", "application");
            return "failure";
        }
    }
    
    public function checkRecipientEmailExist($email,$linkId) {
        try {
            $return = "failed";
           
            $user = UserLinks::model()->findByAttributes(array("RecipientEmail" => trim($email),"LinkId"=>trim($linkId)));
            if (isset($user)) {
                $user->Status = 1;
                if ($user->update()) {
                    $return = "success";
                }
            }
            return $return;
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserType in User Model=" . $ex->getMessage(), "error", "application");
            return "failure";
        }
    }
       public function CheckRecipienthasReferrer($email) {
       try {
            $return = "failed";
            $query = "SELECT * FROM link_user where RecipientEmail='$email' and status=0 order by id asc limit 0,1";
          
            $user= YII::app()->db->createCommand($query)->queryRow();
           
            if (isset($user)) {
              $return= $user;
            }
            return $return;
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserType in User Model=" . $ex->getMessage(), "error", "application");
            return "failure";
        }
    }

}
