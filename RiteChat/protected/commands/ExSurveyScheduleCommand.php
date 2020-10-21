<?php
/**
 * DocCommand class file.
 *
 * @author Karteek V 
 *  @version 1.0
 */
class ExSurveyScheduleCommand extends CConsoleCommand {

    public function run($args) {
        $this->removeCurrentScheduleByEndDate();
        $this->updateCurrentSchedule();
    }
    
    function removeCurrentScheduleByEndDate() {
        try {
            
        $mongoModifier = new EMongoModifier;
        $mongoCriteria = new EMongoCriteria;      
        $mongoCriteria->addCond('EndDate', '<=',  new MongoDate(strtotime(Date("Y-m-d", time()))-1));
        $mongoCriteria->addCond('IsCurrentSchedule','==',(int)1);
        $objects = ScheduleSurveyCollection::model()->findAll($mongoCriteria);         
        if(is_array($objects)){ 
            foreach($objects as $object){
                // this is for Main collection ...                    
                $mongoCriteria = new EMongoCriteria;
                $mongoCriteria->addCond('_id','==',new MongoId($object->SurveyId));
                $mongoModifier->addModifier('IsCurrentSchedule', 'set', (int) 0);
                ExtendedSurveyCollection::model()->updateAll($mongoModifier, $mongoCriteria);

                // this is for schedule collection...
                $mongoCriteria = new EMongoCriteria;            
                $mongoCriteria->addCond('_id','==',new MongoId($object->_id));
                $mongoModifier->addModifier('IsCurrentSchedule', 'set', (int)0);
                ScheduleSurveyCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            }

        }
        } catch (Exception $exc) {
            error_log("###########Error Occurred While running the removeCurrentScheduleByEndDate########" . $exc->getMessage());
        }
    }

    function updateCurrentSchedule() {
        try {
        $mongoCriteria = new EMongoCriteria;
        $modifier = new EMongoModifier;
        $criteria = new EMongoCriteria;        
         $mongoCriteria->addCond('StartDate', '>=',  new MongoDate(strtotime(Date("Y-m-d", time()) . " -1 day")));
         $mongoCriteria->addCond('StartDate', '<',  new MongoDate(strtotime(date("Y-m-d", time()))));
         $modifier->addModifier('IsCurrentSchedule', 'set', (int)0);

        $objects = ScheduleSurveyCollection::model()->findAll($mongoCriteria);
        $groupArray = array();
        if (is_object($objects) || is_array($objects)) {
            foreach($objects as $object){                
                    $modifier = new EMongoModifier;
                    $criteria = new EMongoCriteria;
                    $criteria->addCond('_id', '==', new MongoId($object->_id));
                    $modifier->addModifier('IsCurrentSchedule', 'set', (int)0);
                    ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);
                    
                    $modifier1 = new EMongoModifier;
                    $criteria1 = new EMongoCriteria;
                    
                    $criteria1->addCond('_id', '==', new MongoId($object->SurveyId));
                    $modifier1->addModifier('IsCurrentSchedule', 'set',(int)0);
                    ExtendedSurveyCollection::model()->updateAll($modifier1, $criteria1);
                if(!in_array($object->SurveyRelatedGroupName,$groupArray)){                    
                    error_log("===in array===$object->SurveyRelatedGroupName");
                    $modifier = new EMongoModifier;
                    $criteria = new EMongoCriteria;
                    $criteria->addCond('_id', '==', new MongoId($object->_id));
                    $modifier->addModifier('IsCurrentSchedule', 'set', (int)1);
                    ScheduleSurveyCollection::model()->updateAll($modifier, $criteria);

                    $modifier1 = new EMongoModifier;
                    $criteria1 = new EMongoCriteria;
                    $criteria1->addCond('_id', '==', new MongoId($object->SurveyId));
                    $modifier1->addModifier('IsCurrentSchedule', 'set', (int)1);
                    ExtendedSurveyCollection::model()->updateAll($modifier1, $criteria1);
                    array_push($groupArray, $object->SurveyRelatedGroupName);
                }
               
            }
            error_log("=====final group array====".print_r($groupArray,1));
        } else {
            echo "not exist";            
        }
        
        } catch (Exception $exc) {
            echo $exc->getMessage();    
        }

       
    }

}