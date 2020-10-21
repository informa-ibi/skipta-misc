<?php

/**
 * @author Karteek.V
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NetworkConfiguration extends CActiveRecord {

    public $Id;
    public $Key;
    public $Value;
    public $Enable;
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'NetworkConfiguration';
    }

    public function getNetworkConfiguration(){
        
         try {
            
            $nwConfig = NetworkConfiguration::model()->findAll();
            
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getNetworkConfiguration in Model===" . $ex->getMessage(), "error", "application");
        }
        return $nwConfig;
        
        
    }   
    
    public function saveModel($model){
        try{
            $return = "failure";
            if(!empty($model->Id)){
                $obj = NetworkConfiguration::model()->findByAttributes(array("Id"=>$model->Id));
                $obj->Key = $model->Key;
                $obj->Value = $model->Value;
                $obj->Enable = $model->Enable;
                if($obj->update()){
                    $return = "Updated";
                }
            }else{
                $network = new NetworkConfiguration();
                $network->Key = $model->Key;
                $network->Value = $model->Value;
                $network->Enable = $model->Enable;
                if($network->save()){
                    $return = "success";
                }
            }
            return $return;
        } catch (Exception $ex) {
            error_log("#####Exception occurred in Save Model########".$ex->getMessage());
        }
    }
    
    public function getModelById($id){
        try{
            $obj = NetworkConfiguration::model()->findByAttributes(array("Id"=>$id));
            return $obj;
            
        } catch (Exception $ex) {
            error_log("#####Exception occurred in getModelById########".$ex->getMessage());
        }
    }
    
  

}
