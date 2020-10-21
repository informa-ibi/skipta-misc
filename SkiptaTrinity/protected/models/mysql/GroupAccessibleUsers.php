<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GroupAccessibleUsers extends CActiveRecord{
    
    public $Id;
    public $UserId;
    public $Email;
    public $IsUserExist;
    public $GroupId;
    public $CreatedOn;
    public $Status=1; 
    
    
    public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'GroupAccessibleUsers';
    }
    public function saveGroupAccessibleUsersEmailsList($userId, $groupId, $groupName,$emailArrays){
        try{
            $returnValue = "failed";
            
            if(sizeof($emailArrays) > 0){
                foreach($emailArrays as $rw){
                    $accessibleUsersObj = new GroupAccessibleUsers;
                    $userObj = User::model()->checkUserExist($rw);
                    $accessibleUsersObj->UserId = $userId;
                    $accessibleUsersObj->GroupId = $groupId;
                    $accessibleUsersObj->Email = $rw;
                    if(!empty($userObj))
                        $accessibleUsersObj->IsUserExist = 1;
                    else
                        $accessibleUsersObj->IsUserExist = 0;
                    if($accessibleUsersObj->save()){
                        $returnValue = "success";
                    }
                }                
            }
            return $returnValue;
        } catch (Exception $ex) {
            error_log("############Exception occurred while saving using saveGroupAccessibleUsersEmailsList##########".$ex->getMessage());
        }
    }
    public function getGroupAccessibleUsers($userId,$groupId){
        try{
            $returnArray = array();
            $objsArray = GroupAccessibleUsers::model()->findAllByAttributes(array("UserId"=>$userId,"GroupId"=>$groupId));
            if(!empty($objsArray)){
                foreach($objsArray as $row){
                    array_push($returnArray, $row->Email);
                }
            }
            return $returnArray;
        } catch (Exception $ex) {
            error_log("############Exception occurred while fetching from getGroupAccessibleUsers##########".$ex->getMessage());
        }
    }
    public function getAllGroupAccessibleUsers(){
        try{
            $returnArray = array();
            $objsArray = GroupAccessibleUsers::model()->findAll();
            if(!empty($objsArray)){
                foreach($objsArray as $row){
                    array_push($returnArray, $row->Email);
                }
            }
            return $returnArray;
            
        } catch (Exception $ex) {

        }
    }
    public function getGroupAccessibleUserStatusByGroupId($groupId,$lemail){
        try{
            $returnValue = 0;
            $objsArray = GroupAccessibleUsers::model()->findAllByAttributes(array("GroupId"=>$groupId,"Email"=>$lemail));
            if(isset($objsArray) && sizeof($objsArray)>0){
                $returnValue = 1;
            }
            return $returnValue;
        } catch (Exception $ex) {
            error_log("############Exception occurred while fetching from getGroupAccessibleUserStatusByGroupId##########".$ex->getMessage());
            Yii::log("----------#Exception occurred while fetching from getGroupAccessibleUserStatusByGroupId -------------" . $ex->getMessage(), 'error', 'application');
        }
    }
    public function saveGroupAccessibleUserEmail($userId, $groupId, $lEmail){
        try{
            $returnValue = "failed";
            $accessibleUsersObj = new GroupAccessibleUsers;
                $userObj = User::model()->checkUserExist($lEmail);
                $accessibleUsersObj->UserId = $userId;
                $accessibleUsersObj->GroupId = $groupId;
                $accessibleUsersObj->Email = $lEmail;
                if(!empty($userObj))
                    $accessibleUsersObj->IsUserExist = 1;
                else
                    $accessibleUsersObj->IsUserExist = 0;
                if($accessibleUsersObj->save()){
                    $returnValue = "success";
                }            
            return $returnValue;
        } catch (Exception $ex) {
            error_log("############Exception occurred while saving using saveGroupAccessibleUsersEmailsList##########".$ex->getMessage());
        }
    }
}
