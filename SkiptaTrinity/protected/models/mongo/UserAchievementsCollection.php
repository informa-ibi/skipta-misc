<?php
/**
 * @author Sagar
 * @copyright 2013 skipta.com
 * @version 3.0
 * @category Stream
 * @package Stream
 */

class UserAchievementsCollection extends EMongoDocument {
  
    public $_id;
    public $UserId;
    public $UserClassification=1;
    public $Opportunities = array();
    public $SegmentId = 0;
    public $NetworkId = 1;


    public function getCollectionName() {

        return 'UserAchievementsCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_UserClassification' => array(
                'key' => array(
                    'UserClassification' => EMongoCriteria::SORT_ASC
                ),
            )
        );
    }

    public function attributeNames() {
        return array(
            '_id'=>'_id',
            'UserClassification' => 'UserClassification',
            'Opportunities' => 'Opportunities',
            'SegmentId'=>'SegmentId',
            'NetworkId'=>'NetworkId'
        );
    }
    public function saveUserAchievements($userId, $userAchievements) {
        try {
            $userAchievementsObj = new UserAchievementsCollection();
            $userAchievementsObj->_id = new MongoId();
            $userAchievementsObj->UserId = (int)$userId;
            $userAchievementsObj->UserClassification = (int)$userAchievements->UserClassification;
            $userAchievementsObj->Opportunities = $userAchievements->Opportunities;
            $userAchievementsObj->save();
        }  catch (Exception $ex){
            Yii::log("=====UserAchievementsCollection/saveUserAchievements=====".$ex->getMessage(), 'error', 'application');
        }
    }
    public function getUserAchievements($userId, $userClassification) {
        try {
            $criteria = new EMongoCriteria;
            $criteria->UserId = (int)$userId;
            $criteria->UserClassification = (int)$userClassification;
            $achievementsObj = UserAchievementsCollection::model()->find($criteria);
            return $achievementsObj;
        }  catch (Exception $ex){
            Yii::log("=====UserAchievementsCollection/getUserAchievements=====".$ex->getMessage(), 'error', 'application');
        }
    }
    
     public function getUserAchievementsByOpportunityType($userId, $userClassification,$opportunityType) {
        try {
            $criteria = new EMongoCriteria;
            $c = UserAchievementsCollection::model()->getCollection();
             $userOpportunitiesObj = $c->aggregate(array('$match' => array('UserClassification' =>(int)$userClassification,'UserId'=>(int)$userId)),array('$unwind' =>'$Opportunities'),array('$match' => array('Opportunities.OpportunityType' =>"$opportunityType")),array('$group' => array("_id" => '$_id',"UserId" => array('$push' => '$UserId'),"Opportunities" => array('$push' => '$Opportunities'),)));   
             //  $result = $c->aggregate(array('$match' => array('UserClassification' =>(int)1)),array('$unwind' =>'$Opportunities'),array('$match' => array('Opportunities.EngagementDrivers.Type' =>"Follow_Users")),array('$group' => array("_id" => '$_id',"EngagementDrivers" => array('$push' => '$Opportunities.EngagementDrivers'))));  
            
           //  error_log("result---getUserAchievementsByOpportunityType_________--".print_r($userOpportunitiesObj,1));
            return $userOpportunitiesObj;
        }  catch (Exception $ex){
            Yii::log("=====OpportunitiesCollection/getOpportunitiesByUserClassification=====".$ex->getMessage(), 'error', 'application');
        }
    }
    
    
}


       
?>
