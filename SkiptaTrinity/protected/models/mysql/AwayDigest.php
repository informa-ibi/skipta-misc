<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author Vamsi Krishna
 * This is model class for User Settings
 * 
 */
class AwayDigest extends CActiveRecord {
    public $Id;
    public $PostId;
    public $CategroyType;
    public $PostType;
    public $IsUseforDigest;
    public $IsMarkedByAdmin;
    public $CreatedOn;
    public $UpdatedOn;
    public $Status;
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'AwayDigest';
    }
    
     public function saveOrUpdateAwayDigest($postId,$postType,$categroyType,$isUseforDigest,$isMarkedByAdmin) {
         $return = 'failure';
        try {
               $awayDigest = AwayDigest::model()->findByAttributes(array("PostId" => $postId,"CategroyType"=>$categroyType));
            if (isset($awayDigest)) {
               $awayDigest->IsUseforDigest = $isUseforDigest; 
               $awayDigest->IsMarkedByAdmin = $isMarkedByAdmin;
               $awayDigest->UpdatedOn = date('Y-m-d H:i:s', time());
               if ($awayDigest->update()) {
                    $return = $awayDigest->Id;
                }
            }
            else{
               $return=$this->saveAwayDigest($postId, $postType, $categroyType, $isUseforDigest, $isMarkedByAdmin);
            } 
        } catch (Exception $ex) {
               Yii::log("saveOrUpdateAwayDigest" . $exc->getMessage(), 'error', 'application');
        }
       return $return;

    }
   public function saveAwayDigest($postId, $postType, $categroyType, $isUseforDigest, $isMarkedByAdmin) {
        $return = 'failure';
        try {
            $awayDigest = new AwayDigest();
            $awayDigest->PostId = $postId;
            $awayDigest->CategroyType = $categroyType;
            $awayDigest->PostType = $postType;
            $awayDigest->IsUseforDigest = $isUseforDigest;
            $awayDigest->IsMarkedByAdmin = $isMarkedByAdmin;
            $awayDigest->CreatedOn = date('Y-m-d H:i:s', time());
            $awayDigest->UpdatedOn = date('Y-m-d H:i:s', time());
            $awayDigest->Status = 1;
            if ($awayDigest->save()) {
                $return = $awayDigest->Id;
            }
        } catch (Exception $ex) {
             Yii::log("saveOrUpdateAwayDigest" . $exc->getMessage(), 'error', 'application');
        }
        return $return;
    }

    public function getAwayDigestListFromLstSevenDays($isMarkedByAdmin) {
        try {
            $return = array();

             $query="select Id, PostId, CategroyType,PostType  from AwayDigest where IsUseforDigest=1 and IsMarkedByAdmin=$isMarkedByAdmin and UpdatedOn >= (NOW() - INTERVAL 8 DAY) order by UpdatedOn desc";            
             $AwayDigest = Yii::app()->db->createCommand($query)->queryAll();
            if (isset($AwayDigest)) {
               $return = $AwayDigest;
            }

           
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getAwayDigest in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
       return   $return;
    }
    
    public function getAwayDigestId($postId,$categroyType,$postType){
        try {
            $return = "failed";
             $awayDigest = AwayDigest::model()->findByAttributes(array("PostId" => $postId,"CategroyType"=>$categroyType));
             if (isset($awayDigest)) {
               $return = $awayDigest->Id;
            }else{
               $return = $this->saveOrUpdateAwayDigest($postId,$postType,$categroyType,1,0);   
            }
            
          
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getAwayDigest in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
       return   $return; 
        
    }
    
    
 public function updateAwayDigestListFromSevenDaysCompletedMarkedByAdmin() {

         try {
             
             $query="update AwayDigest set IsUseforDigest=0, UpdatedOn=CURRENT_TIMESTAMP  where IsUseforDigest=1 and IsMarkedByAdmin=1 and UpdatedOn <= (NOW() - INTERVAL 8 DAY) order by UpdatedOn desc";
             Yii::app()->db->createCommand($query)->execute();
           
        } catch (Exception $ex) {
            Yii::log("Exception occurred in UserAwayDigest in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }

    }
}