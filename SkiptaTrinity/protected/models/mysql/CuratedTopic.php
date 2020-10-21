<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CuratedTopic extends CActiveRecord {

    public $NetworkId;
    public $UserId;
    public $TopicName;
    public $TopicId;
    public $Status;
    public $CreatedOn;
    public $ShortName;
    public $ImageUrl;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'CuratedTopic';
    }

    public function getCuratedTopics($userId,$networkId)
    {  
       $query = "Select * from CuratedTopic where NetworkId=".$networkId;
       $result =  Yii::app()->db->createCommand($query)->queryAll();
       return $result;
    }
     public function getAllCuratedTopics($userId=0,$networkId=0)
    {  
       $query = "Select * from CuratedTopic where NetworkId=".$networkId;
       $append=" and UserId=".$userId;
       if($userId!=0)
       $query=$query.$append;

              error_log("_____________________________________________".$query);

       $result =  Yii::app()->db->createCommand($query)->queryRow();
       return $result;
    }
    public function getCuratedTopicDetailsByTopicId($TopicId)
    {  
       $query = "Select * from CuratedTopic where TopicId =".$TopicId;
       $result =  Yii::app()->db->createCommand($query)->queryRow();
       return $result;
    }
     public function updateCuratedTopic($TopicId,$status)
    {  
       $query = "update CuratedTopic set status = ".$status." where TopicId =".$TopicId;
       $result =  Yii::app()->db->createCommand($query)->execute();
       return $result;
    }
    
}
