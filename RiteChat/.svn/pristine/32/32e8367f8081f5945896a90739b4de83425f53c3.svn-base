<?php

/** This is the collection for saving Chat Conversations

 */

class PushNotificationCollection extends EMongoDocument {
    public $UserId;
    public $Message;
    public $IsRead;
    public $CreatedOn;
  
    
   
   

    public function getCollectionName() {
        return 'PushNotificationCollection';
    }
    public function indexes() {
        return array(
            'index_offlineUserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC,
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
             'UserId' => 'UserId',
             'Message' => 'Message',
             'IsRead' => 'IsRead',
             'CreatedOn' => 'CreatedOn',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function savePushNotification($userId,$pushMessage) {
        error_log("savePushNotification-----".$userId."----push mesage----".$pushMessage);
            $returnValue = 'false';
            $collection = new PushNotificationCollection();
            $collection->UserId = (int)$userId;
            $collection->Message = $pushMessage;
            $collection->IsRead = 0;
            $collection->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $collection->insert();
            if (isset($collection->_id)) {
                $returnValue = 'true';
            }
          return $returnValue;
    }
    public function getUnreadMessagesCount($userId) {
        try{
           error_log("#############getUnreadMessagesCount---------------------".$userId);
           $criteria = new EMongoCriteria;
            $criteria->addCond('UserId', '==',(int)$userId);
            $criteria->addCond('IsRead', '==',0);
            $count = PushNotificationCollection::model()->count($criteria);
            error_log("getUnreadMessagesCount---------".$count);
            return $count;
        } catch (Exception $ex) {

        }
          
            
    }
      public function updatePushNotificationAsRead($userId) {
          try{
            error_log("updatePushNotificationAsRead------------------".$userId);
            $criteria = new EMongoCriteria;
            $modifier = new EMongoModifier;
            $criteria->addCond('UserId', '==',(int)$userId);
            $modifier->addModifier('IsRead', 'set',1);
            $result = PushNotificationCollection::model()->updateAll($modifier, $criteria);
           if($result){
                error_log("success---------------");
           }else{
               error_log("fail---------------");
           }
          } catch (Exception $ex) {
              error_log("exceptino-------------".$ex->getMessage());
              return "failure";
          }
       

         
          
            
    }
    
}
