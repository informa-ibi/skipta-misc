<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserHierarchy extends CActiveRecord{
    public $Division;
    public $District;
    public $Region;
    public $Store;
    
    public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'UserHierarchy';
    }
    public function getUserHierarchyByUserId($userId) {
        try {
            
            $result = 'failure';
            $userHierarchy = UserHierarchy::model()->findByAttributes(array("UserId" => $userId));
            if (isset($userHierarchy)) {
                $result = $userHierarchy;
            } 
            return $result;
        } catch (Exception $exc) {
            Yii::log("________________" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    
    public function SaveUserHierarchy($userId)
    {
        $updateQuery=" INSERT INTO UserHierarchy (UserId,Division,Region,District,Store,Type) VALUES "."($userId,0,0,0,0,'User')";
        YII::app()->db->createCommand($updateQuery)->execute();
       
    }
    /**
     * @author Vamsi
     * This method is used to get the users based on the store Id
     * @param type $storeId
     * @return array
     */
  public function getUsersBYStoreId($storeId,$limit=''){
       $result = 'failure';
       try {
           if(!empty($limit) || $limit!=0){
               $query="select * from UserHierarchy where Store=".$storeId." limit " .$limit; 
           }          
           else{
            $query="select * from UserHierarchy where Store=".$storeId;    
           }
           error_log("----".$query);
           $users = Yii::app()->db->createCommand($query)->queryAll();           
            if (count($users)>0) {
                $result = $users;
            }
            return $result;
       } catch (Exception $exc) {
           error_log($exc->getMessage());
           return $result;
       }
      }
      
     /**
     * @author Vamsi
     * This method is used to get the users based on the store Id
     * @param type $storeId
     * @return array
     */
  public function getUsersBYRegionId($regionId){
       $result = 'failure';
       try {
           $query="select * from UserHierarchy where Region=".$regionId;
           $users = Yii::app()->db->createCommand($query)->queryAll();           
            if (count($users)>0) {
                $result = $users;
            }
            return $result;
       } catch (Exception $exc) {
           error_log($exc->getMessage());
           return $result;
       }
      } 
      public function getUsersBYStoreIds($storeIds){
       $result = 'failure';
       try {
           
           $query="select * from UserHierarchy where Store in (".implode(',',$storeIds).") ";      
           $users = Yii::app()->db->createCommand($query)->queryAll();           
            if (count($users)>0) {
                $result = $users;
            }
            return $result;
       } catch (Exception $exc) {
           error_log($exc->getMessage());
           return $result;
       }
      }
    public function getUsersByStoreIdWithPagination($storeId,$limit,$offset){
        $usersArray=array();
        try {
            $query="select * from UserHierarchy where Store=".$storeId." limit ".$limit ." offset ".$offset;
            
            $users = Yii::app()->db->createCommand($query)->queryAll();           
            if (count($users)>0) {
                $usersArray = $users;
            }
            return $usersArray;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
        }  
}