<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SurveyInteractionCollection extends EMongoDocument {
    
    public $_id;
    public $UserId;
    public $CreatedOn;
    public $CreatedDate;
    public $ActionType;
    public $SurveyScheduleId;
    public $SurveyId;
    public $SurveyPage;
    public $SurveyTimeSpent;

    /*Analytics End*/
    public function getCollectionName() {

        return 'SurveyInteractionCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC
                ),
            ),
           
            'index_SurveyPage' => array(
                'key' => array(
                    'SurveyPage' => EMongoCriteria::SORT_ASC
                ),
            ),
           
        );
    }
    public function attributeNames() {
        return array(
            '_id' => '_id',
            'UserId' => 'UserId',
            'CreatedOn' => 'CreatedOn',
            'CreatedDate' => 'CreatedDate',
            'ActionType' => 'ActionType',
            "SurveyScheduleId" => "SurveyScheduleId",
            "SurveyId" => "SurveyId",
            "SurveyPage" => "SurveyPage",
            "SurveyTimeSpent" => "SurveyTimeSpent"
   
            );
    }
     public function getTrackRecord($userId,$scheduleId,$surveyId,$page,$flag=""){
        try{
           // error_log("getLatestTrackRecord---".$userId."---".$scheduleId."--".$surveyId."---page---".$page."---falg---".$flag);
             $criteria = new EMongoCriteria;  
            $criteria->addCond('UserId', '==', (int)$userId);
            $criteria->addCond('SurveyScheduleId', '==',new MongoId($scheduleId));
            $criteria->addCond('SurveyId', '==',new MongoId($surveyId));
              $criteria->addCond('SurveyPage', '==',(int)$page);
            $criteria->sort('_id', EMongoCriteria::SORT_DESC);
            
             $array = array(
                'conditions' => array(
                    'UserId' => array('==' => (int)$userId),
                     'SurveyScheduleId' => array('==' =>new MongoId($scheduleId)),
                     'SurveyId' => array('==' => new MongoId($surveyId)),
                     'SurveyPage' => array('==' => (int)$page),
                    
                  
                ),
               
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
            
            
            
           if($flag == "LatestOne"){
              $objFollowers =  SurveyInteractionCollection::model()->findAll($array);   
               if(count($objFollowers)==0){
                return "norecord";
            }else{
                return $objFollowers[0];  
            }
           }else{
               $objFollowers =  SurveyInteractionCollection::model()->findAll($criteria); 
              if(count($objFollowers)==0){
                return "norecord";
            }else{
                  
                return $objFollowers;  
            }
           }
           
           
           
        } catch (Exception $ex) {
 Yii::log("-----in exception--------SurveyInteractionCollection---------getTrackRecord-----------".$ex->getMessage(), 'error', 'application');
        }
    }
    public function saveSurveyLogin($userId,$scheduleId,$surveyId,$page,$currentDate=""){
        try{
           $collection = new SurveyInteractionCollection();
           $collection->UserId = (int)$userId;
           $collection->SurveyPage = (int)$page;
           $collection->ActionType = "SurveyLogin";
           $collection->SurveyId = new MongoId($surveyId);
            $collection->SurveyScheduleId = new MongoId($scheduleId);
            if($currentDate == ""){
                 $collection->CreatedOn = new MongoDate();
                  $collection->CreatedDate = date("Y-m-d",$collection->CreatedOn->sec);
            }else{
                 $collection->CreatedOn = $currentDate;
                  $collection->CreatedDate = date("Y-m-d",$currentDate->sec);
            }
        
            $collection->save();  
        } catch (Exception $ex) {
    Yii::log("-----in exception--------SurveyInteractionCollection---------saveSurveyLogin-----------".$ex->getMessage(), 'error', 'application');
        }
       
        
    }
    public function trackSurveyLogout($latestRecord,$userId,$scheduleId,$surveyId,$page,$type){
          //  error_log("trackSurveyLogout--------$userId---$surveyId----$scheduleId------".$page."---".$type);
       try{
         if ($type == "refresh") {
            //logout and login
            $currentDate = new MongoDate();
            $timeSpent = time() - $latestRecord->CreatedOn->sec;
            SurveyInteractionCollection::model()->saveSurveyLogout($timeSpent, $userId, $scheduleId, $surveyId, $page, $type, $currentDate);
            SurveyInteractionCollection::model()->saveSurveyLogin($userId, $scheduleId, $surveyId, $page, $currentDate);
        } else {
            $currentDate = new MongoDate();
            //loop here to find spent time
            $allRecordOfPage = SurveyInteractionCollection::model()->getTrackRecord($userId, $scheduleId, $surveyId, $page, "All");
            if ($allRecordOfPage != "norecord") {
                // error_log("iffffffffff");
                $latestRecord = $allRecordOfPage[0];
                if ($latestRecord->ActionType == "SurveyLogin") {
                    $timeSpent = time() - $latestRecord->CreatedOn->sec;
                } else {
//                    $totalTimeSpent = 0;
//                    // error_log("trackSurveyLogout------loop now");
//                    foreach ($allRecordOfPage as $value) {
//
//                        if ($value->ActionType == "SurveyLogin") {
//                            $timeSpent = time() - $value->CreatedOn->sec;
//                            break;
//                        } else {
//                            $totalTimeSpent = $totalTimeSpent + $value->SurveyTimeSpent;
//                        }
//                        //cal time spent th loop
//                    }
//                    // error_log("timespene-----".$timeSpent."----".$totalTimeSpent);
//                    $timeSpent = $timeSpent - $totalTimeSpent;
                        }

                SurveyInteractionCollection::model()->saveSurveyLogout($timeSpent, $userId, $scheduleId, $surveyId, $page, $type, $currentDate);
            }
        }  
       } catch (Exception $ex) {
Yii::log("-----in exception--------SurveyInteractionCollection---------trackSurveyLogout-----------".$ex->getMessage(), 'error', 'application');
       }
        
    }
     public function saveSurveyLogout($timeSpent,$userId,$scheduleId,$surveyId,$page,$type,$currentDate){
         try{
           $collection = new SurveyInteractionCollection();
        $collection->UserId = (int) $userId;
        $collection->SurveyPage = (int) $page;
        $collection->ActionType = "SurveyLogout";
        $collection->SurveyId = new MongoId($surveyId);
        $collection->SurveyScheduleId = new MongoId($scheduleId);
        $collection->CreatedOn = $currentDate;
        $collection->CreatedDate = date("Y-m-d",$currentDate->sec);
        $collection->SurveyTimeSpent = new MongoInt64($timeSpent);
        $collection->save();   
         } catch (Exception $ex) {
Yii::log("-----in exception--------SurveyInteractionCollection---------saveSurveyLogout-----------".$ex->getMessage(), 'error', 'application');
         }
       
    }
    public function calculateTimeSpentOnSurvey($scheduleId,$surveyId){
        try{
           error_log("calculateTimeSpentOnSurvey--".$scheduleId."-----".$surveyId);
             $c = SurveyInteractionCollection::model()->getDb();
        //  $result = $c->aggregate(array('$match' => array("SurveyScheduleId" =>new MongoID($scheduleId),"ActionType" =>"SurveyLogout")),array('$group' => array("_id" => array('SurveyScheduleId'=>'$SurveyScheduleId'),"SurveyTimeSpent" => array('$sum' => '$SurveyTimeSpent'), "count"=> array( '$sum'=> 1 ))));
        
             $result = $c->command(array(

    'aggregate' => 'SurveyInteractionCollection',

    'pipeline'  => array(
        // Match:
        // We can skip this in case that we don't need to filter 
        // documents in order to perform the aggregation
        array('$match' => array(
            // Criteria to match against
            "SurveyScheduleId" =>new MongoID($scheduleId)
        )),

        // Group:
        array('$group'  => array(
            // Groupby fields:
            '_id'       => array('SurveyScheduleId'=>'$SurveyScheduleId'),
            // Count:
            'count'     => array('$sum' => 1),
            // Sum:
            'SurveyTimeSpent_Sum'  => array('$sum' => '$SurveyTimeSpent'),
        ))

        // Other aggregations may go here as it's really a PIPE :p

    ),
));
        if(is_array($result['result'])&& sizeof($result['result']>0) ){
           return  $result['result'][0]["SurveyTimeSpent_Sum"];
        }else{
            return 0;
}
            
          
        } catch (Exception $ex) {
Yii::log("-----in exception--------SurveyInteractionCollection---------calculateTimeSpentOnSurvey-----------".$ex->getMessage(), 'error', 'application');
        }
    }
     public function getSurveyPageAnalytics($scheduleId,$surveyId){
        try{
           //error_log("getSurveyPageAnalytics--".$scheduleId."-----".$surveyId);
             $c = SurveyInteractionCollection::model()->getDb();
        //  $result = $c->aggregate(array('$match' => array("SurveyScheduleId" =>new MongoID($scheduleId),"ActionType" =>"SurveyLogout")),array('$group' => array("_id" => array('SurveyScheduleId'=>'$SurveyScheduleId'),"SurveyTimeSpent" => array('$sum' => '$SurveyTimeSpent'), "count"=> array( '$sum'=> 1 ))));
 
             $result = $c->command(array(

    'aggregate' => 'SurveyInteractionCollection',

    'pipeline'  => array(
        // Match:
        // We can skip this in case that we don't need to filter 
        // documents in order to perform the aggregation
        array('$match' => array(
            // Criteria to match against
            "SurveyScheduleId" =>new MongoID($scheduleId)
        )),

        // Group:
        array('$group'  => array(
            // Groupby fields:
            '_id'       => array('SurveyPage'=>'$SurveyPage'),
            // Count:
            'count'     => array('$sum' => 1),
          
            // Sum:
            'SurveyTimeSpent_Sum'  => array('$sum' => '$SurveyTimeSpent'),
        )),
        array('$sort' => array('_id.SurveyPage' => 1))
        
        // Other aggregations may go here as it's really a PIPE :p

    ),
));
             
             //error_log(print_r($result, 1));  
        if(is_array($result['result'])&& sizeof($result['result']>0) ){
            
            return $result['result'];
//            foreach ($result['result'] as $value) {
//                error_log($value['_id']['SurveyPage']."---time spent---------".$value['SurveyTimeSpent_Sum']);
//            };
        }else{
            return 0;
}
   
          
        } catch (Exception $ex) {
Yii::log("-----in exception--------SurveyInteractionCollection---------calculateTimeSpentOnSurvey-----------".$ex->getMessage(), 'error', 'application');
        }
    }
    
    
    public function updateSurveyTimeSpent(){
       try{
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('ActionType', '==', 'SurveyLogout');
            $criteria->sort("_id",EMongoCriteria::SORT_DESC);
            //$criteria->limit(10);            
            $surveyObjs = SurveyInteractionCollection::model()->findAll($criteria);
            
            if(is_array($surveyObjs)){
                foreach($surveyObjs as $surveyObj){                    
                    $surveyObj->SurveyTimeSpent = new MongoInt64($surveyObj->SurveyTimeSpent);
                    $surveyObj->update(array('SurveyTimeSpent'), true);
                }
            }            

        } catch (Exception $ex) {
            Yii::log("Exception-in-SurveyInteractionCollection---updateSurveyTimeSpent---".$ex->getMessage(), 'error', 'application');
        }
    }
    
    /**
     * @usage get total spend time for each user.
     * @developer Reddy
     * @param type $scheduleId
     * @param type $surveyId
     * @param type $UserId
     * @return int
     */
    public function getSurveyPageAnalyticsbyUserId($scheduleId, $surveyId, $UserId = 0) {

        try {
            //error_log("getSurveyPageAnalytics--".$scheduleId."-----".$surveyId);
            $c = SurveyInteractionCollection::model()->getDb();
            //  $result = $c->aggregate(array('$match' => array("SurveyScheduleId" =>new MongoID($scheduleId),"ActionType" =>"SurveyLogout")),array('$group' => array("_id" => array('SurveyScheduleId'=>'$SurveyScheduleId'),"SurveyTimeSpent" => array('$sum' => '$SurveyTimeSpent'), "count"=> array( '$sum'=> 1 ))));

            $result = $c->command(array(
                'aggregate' => 'SurveyInteractionCollection',
                'pipeline' => array(
                    // Match:
                    // We can skip this in case that we don't need to filter 
                    // documents in order to perform the aggregation
                    array('$match' => array(
                            // Criteria to match against
                            "SurveyScheduleId" => new MongoID($scheduleId),
                            "UserId" => (int) $UserId
                        )),
                    // Group:
                    array('$group' => array(
                            // Groupby fields:
                            '_id' => array('UserId' => '$UserId'),
                            // Count:
                            'count' => array('$sum' => 1),
                            // Sum:
                            'SurveyTimeSpent_Sum' => array('$sum' => '$SurveyTimeSpent'),
                        )),
                    array('$sort' => array('_id.UserId' => 1))


                // Other aggregations may go here as it's really a PIPE :p
                ),
            ));
            //error_log(print_r($result, 1));  
            if (is_array($result['result']) && sizeof($result['result'] > 0)) {
                return $result['result'];
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            Yii::log("-----in exception--------SurveyInteractionCollection---------calculateTimeSpentOnSurvey-----------" . $ex->getMessage(), 'error', 'application');
        }
    }

}
