<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GroupAdminUploadedFiles extends CActiveRecord{
    
    public $Id;
    public $UserId;
    public $FileName;
    public $GroupName;
    public $GroupId;
    public $CreatedOn;
    public $Status = 1;
    public $ModifiedFileName;
    
    
    public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'GroupAdminUploadedFiles';
    }
    
    public function saveUploadedFiles($userId,$filename, $groupId, $groupName,$newFileName){
        try{
            $returnValue = "failed";
            $filesObject = new GroupAdminUploadedFiles;
            $filesObject->FileName = $filename;
            $filesObject->UserId = $userId;
            $filesObject->GroupName = $groupName;
            $filesObject->GroupId = $groupId;
            $filesObject->ModifiedFileName = $newFileName;
            if($filesObject->save()){
                $returnValue = "success";
            }
            return $returnValue;
        } catch (Exception $ex) {
            error_log("##########Exception Occurred in saveUploadedFiles###########".$ex->getMessage());
        }
    }
    
    public function deleteAFileById($userId,$fileId){
        try{
            $returnValue = "failed";
            $filesObj = GroupAdminUploadedFiles::model()->findByAttributes(array("Id"=>$fileId,"UserId"=>$userId));
            if(!empty($filesObj)){
                if($filesObj->delete()){
                    $returnValue = "success";
                }
            }
            return $returnValue;
        } catch (Exception $ex) {
            error_log("##########Exception Occurred in deleteAFileById###########".$ex->getMessage());
        }
    }
    public function getFilesList($userId,$groupId){
        try{
            $filesObj = GroupAdminUploadedFiles::model()->findAllByAttributes(array("UserId"=>$userId,"GroupId"=>$groupId));
            return $filesObj;
        } catch (Exception $ex) {
            error_log("##########Exception Occurred in getFilesList###########".$ex->getMessage());
        }
    }
    
}
