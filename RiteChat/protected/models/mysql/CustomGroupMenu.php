<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CustomGroupMenu extends CActiveRecord{
    
    public $Id;
    public $GroupId;
    public $IsHybridGroup;
    public $MenuName;
    public $MenuDisplayName;
    public $MenuLevel;
    public $ParentMenuId;
    public $MenuPosition;
    public $CssClass;
    public $URL;
    
      public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'CustomGroupMenu';
    }
    public function GetCustomGroupMenusByGroupId($groupId){
        try {
                $result = array();
                $menus = CustomGroupMenu::model()->findAllByAttributes(array("GroupId" => $groupId),array('order'=>'ParentMenuId ASC'));
                if (isset($menus)) {
                    $result = $menus;
                }
                return $result;
            } catch (Exception $exc) {
                error_log("---------GetCustomGroupMenus------".$exc->getMessage());
            } 
     }
}
