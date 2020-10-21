<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class State extends CActiveRecord{
    
    public $State;
    public $CountryId;
    public $Status;
    public $StateCode;
    
    
      public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'State';
    }
    public function GetState(){
        try {
                $resources=Yii::app()->db->createCommand("SELECT * FROM  State;")->queryAll();

            } catch (Exception $exc) {
                error_log("---------get countries------".$exc->getMessage());
            }

              return $resources;
     }
}
