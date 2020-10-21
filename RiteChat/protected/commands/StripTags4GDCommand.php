<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StripTags4GDCommand extends CConsoleCommand{
    
    public function actionStartProcess(){
        try{
            error_log("Starting Process...");           
            $objects = GroupCollection::model()->findAll();
             error_log("====Groups count===".sizeof($objects));
            foreach($objects as $obj){
                $mongoCriteria = new EMongoCriteria;
                $mongoCriteria->addCond('_id', '==',new MongoId($obj->_id));
                $obj->GroupDescription = strip_tags($obj->GroupDescription);
                $mongoModifier = new EMongoModifier;
                $mongoModifier->addModifier('GroupDescription', "set", $obj->GroupDescription);
                if(GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
                    error_log("===Updated==GroupId==$obj->_id==Name==$obj->GroupName");
                }else{
                    error_log("===Updation=failed==$obj->_id");
                }
//                error_log("\n\n\n\n\n\n\n\n1111111==finded==GroupDescription===".  strip_tags($o->GroupDescription)."===".$o->_id);
                
            }
            
            error_log("Ended process");
        } catch (Exception $ex) {
            error_log("====Exception Occurred while running this=====");
        }
    }
}