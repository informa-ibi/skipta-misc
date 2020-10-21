<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class LinkGroup extends CActiveRecord{
    
    public $Status;
    public $LinkGroupName;
    public $id;
    
    
    public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'LinkGroup';
    }
    public function getLinkGroups(){
        try{
            $lg = LinkGroup::model()->findAll();
            return $lg;
//            $lg[sizeof($lg)+1]['id'] = "Other";
//            $lg[sizeof($lg)+1]['LinkGroupName'] = "Other";
//            error_log("===getList=====".sizeof($lg)."===group name===".$lg[sizeof($lg)+1]['LinkGroupName']);
        } catch (Exception $ex) {
            error_log("====Exception Occurred in the GetLinkGroups=====".$ex->getMessage());
        }
    }
    public function saveNewGroupName($linkGroupName){
        try{
            error_log("=======saveNewGroupName=====11=====$linkGroupName");
            $returnvalue = 0;
            $linkObj = new LinkGroup();
            $linkObj->LinkGroupName = $linkGroupName;
            $present = $this->getLinkGroup($linkGroupName);
            if(is_array($present))
            {
            $returnvalue=$present['id'];     
            }else
            {
             if($linkObj->save()){
              error_log("=======saveNewGroupName===saved======");
              $returnvalue = $linkObj->id;
             }  
            }
        } catch (Exception $ex) {
            error_log("====Exception Occurred in the saveNewGroupName=====".$ex->getMessage());
        }
        return $returnvalue;
    }
    
   public function getLinkGroup($groupName)
   {
    $query="select * from LinkGroup where LinkGroupName ='".$groupName."'";
    $present=Yii::app()->db->createCommand($query)->queryRow();  
    return $present;
   }
}
