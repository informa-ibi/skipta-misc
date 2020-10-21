<?php

class AwayDigestSentList extends CActiveRecord {
    public $Id;
    public $AwayDigestId;
    public $UserAwayDigestId;
    public $SentOn;

     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'AwayDigestSentList';
    }
    
     public function saveSentAwayDigest($awayDigestId,$userAwayDigestId) {
        $return = "failure";
        $sentAwayDigest = new AwayDigestSentList();
        $sentAwayDigest->AwayDigestId = $awayDigestId;
        $sentAwayDigest->UserAwayDigestId = $userAwayDigestId;
        $sentAwayDigest->SentOn =date('Y-m-d H:i:s', time());;

        if ($sentAwayDigest->save()) {
           $return= "success";
        }
        
        return $return;
    }
    public function isAwayDigestSent($awayDigestId,$userAwayDigestId)
        {   $return = 0;
            try {
            $query="select count(Id) as count from AwayDigestSentList where AwayDigestId =$awayDigestId and UserAwayDigestId=$userAwayDigestId";            
            $return = Yii::app()->db->createCommand($query)->queryRow();
            $return=$return['count'];
        } catch (Exception $exc) {
           error_log("+++++++++++++++++++++++".$exc->getMessage());
        }
           return $return; 
        }
}