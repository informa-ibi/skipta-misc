<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Network extends CActiveRecord {

    public $NetworkId;
    public $NetworkURL;
    public $NetworkName;
    public $Status;
    public $CreatedOn;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'NetWork';
    }

    public function getNeworkId($network){
        
         try {
             $query = "Select * from NetWork N,Countries C where C.Id='".$network."'";
             $network =  Yii::app()->db->createCommand($query)->queryRow();
            if(isset($network)){
                $result=$network['NetworkId'];
            }else{
                $network = NetWork::model()->findByAttributes(array("NetworkName"=>'US'));
                $result=$network->NetworkId;
                //$result="error";
            }          
        } catch (Exception $ex) {
            Yii::log("Exception occurred in get network id by network name=" . $ex->getMessage(), "error", "application");
        }
        return $result;
        
        
    }   
    public function getNeworkDetails($urlORname='US'){
        
         try {
             
            
       if (filter_var($urlORname, FILTER_VALIDATE_URL)) 
           {
              $query = "Select * from NetWork where NetworkUrl ='".$urlORname."'";
             $result =  Yii::app()->db->createCommand($query)->queryRow();
            }
            else
            {
               $query = "Select * from NetWork where NetworkId =1";
                $result = Yii::app()->db->createCommand($query)->queryRow();
            }
            
        } catch (Exception $ex) {
            Yii::log("Exception occurred in get network id by network name=" . $ex->getMessage(), "error", "application");
        }
        return $result;
        
        
    }
     public function getCuratedTopics($userId,$networkId)
    {  
       $query = "Select * from CuratedTopic where UserId =".$userId." and NetworkId=".$networkId;
       $result =  Yii::app()->db->createCommand($query)->queryAll();
       return $result;
    }
    
}
