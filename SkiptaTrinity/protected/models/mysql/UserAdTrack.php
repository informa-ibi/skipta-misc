<?php

class UserAdTrack extends CActiveRecord{
    public $id;
    public $AdTypeId;
    public $UserId;
    public $AdId;
    public $DisplayPage;
    public $CreatedOn;
    public $PostId;
      public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'UserAdTrack';
    }
     
     public function saveUserAdTrack($adObj,$userId){
         $returnValue="failure";
         try {  
             $userAdTrack=new UserAdTrack();
             $userAdTrack->AdTypeId=$adObj->AdType;
             $userAdTrack->UserId=$userId;
             $userAdTrack->AdId=$adObj->AdvertisementId;
             $userAdTrack->DisplayPage=$adObj->DisplayPage;
             $userAdTrack->CreatedOn=date('Y-m-d H:i:s', time());
             $userAdTrack->PostId=$adObj->_id;
             
             if ($userAdTrack->save()) {
                $returnValue = (int) $userAdTrack->id;
             }
            return $returnValue; 
         } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue; 

          }
         }
         
          public function isUserAdTrackExist($userId,$postId){
         $returnValue="failure";
        try {
            $query="select * from UserAdTrack where UserId=$userId and PostId='$postId'";
            $data = Yii::app()->db->createCommand($query)->queryAll(); 
            if(sizeof($data)>0){
                $returnValue=true;
            }
            else{
                $returnValue=false;
            }
            
            return $returnValue;
        } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
        }
     }

}