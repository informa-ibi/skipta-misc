<?php

class DailyDigestBatchs extends CActiveRecord{
    public $id;
    public $Batch;
    public $IsRunning;
    public $Status;
    
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'DailyDigestBatchs';
    } 
    public function getDailyDigestBatchs(){
        $returnValue='failure';
        try {
            $query="select * from DailyDigestBatchs where Status=1";
             $dailyDigestBatchs = Yii::app()->db->createCommand($query)->queryAll(); 
         if(is_array($dailyDigestBatchs))    {
             $returnValue=$dailyDigestBatchs;
                     
         }
         return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString());
            return $returnValue;
        }
        }
    public function updateDailyDigestBatchs($value,$batchId) {
        try {
            $return = "failed";

           $query = "Update DailyDigestBatchs set Value='$value', IsRunning=0 where id=$batchId";

            return YII::app()->db->createCommand($query)->execute();
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $return;
    }
    
    public function updateDailyDigestBatchsRunningStatus($batchId) {
        try {
            $return = "failed";

           $query = "Update DailyDigestBatchs set IsRunning=1 where id=$batchId";

            return YII::app()->db->createCommand($query)->execute();
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $return;
    }
      
}
