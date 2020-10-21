<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ExSurveyResearchGroup extends CActiveRecord{
    
    public $Status = 1;
    public $GroupName;
    public $Id;
    public $CreatedUserId;
    public $LogoPath;
    
    
    public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'ExSurveyResearchGroup';
    }
    public function getLinkGroups(){
        try{
            $lg = ExSurveyResearchGroup::model()->findAll();
            return $lg;
        } catch (Exception $ex) {
            error_log("====Exception Occurred in the GetLinkGroups=====".$ex->getMessage());
        }
    }
    public function saveNewGroupName($linkGroupName,$userId,$logo){
        try{
            $returnvalue = 0;
            $linkObj = new ExSurveyResearchGroup();
            $linkObj->GroupName = $linkGroupName;
            $linkObj->CreatedUserId = $userId;
            $present = $this->getLinkGroup($linkGroupName);
            
            if($present<=0)
            {
                $linkObj->LogoPath = $logo;
                
                if($linkObj->save()){
                
                    $returnvalue = $linkObj->Id;
                }
            }else
            {
                $linkObj->LogoPath = $logo;
                $query="Update ExSurveyResearchGroup set LogoPath = '$logo' where Id = ".$present['Id'];
                Yii::app()->db->createCommand($query)->execute();  
                $returnvalue=$present['Id'];
            }
        } catch (Exception $ex) {
            error_log("====Exception Occurred in the saveNewGroupName=====".$ex->getMessage());
        }
        return $returnvalue;
    }
    
   public function getLinkGroup($groupName)
   {
        $query="select count(*) CNT from ExSurveyResearchGroup where GroupName ='$groupName'";        
        $present=Yii::app()->db->createCommand($query)->queryRow();  
        return $present['CNT'];
   }
   public function findAndUpdate($groupName,$logo){
       try{
           $obj = ExSurveyResearchGroup::model()->findAllByAttributes(array("GroupName"=>$groupName));
           foreach($obj as $rw){
               $query = "Update ExSurveyResearchGroup set LogoPath = '$logo' where Id = $rw->Id";
               Yii::app()->db->createCommand($query)->execute(); 
           }
       } catch (Exception $ex) {
           error_log("=########Exception occurred######".$ex->getMessage());
       }
   }
}
