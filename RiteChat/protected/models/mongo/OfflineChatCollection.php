<?php

/** This is the collection for saving Chat Conversations

 */

class OfflineChatCollection extends EMongoDocument {
    public $offlineUserId;
    public $senderId; //array of senders
  
    
   
   

    public function getCollectionName() {
        return 'OfflineChatCollection';
    }
    public function indexes() {
        return array(
            'index_offlineUserId' => array(
                'key' => array(
                    'offlineUserId' => EMongoCriteria::SORT_ASC,
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
             'offlineUserId' => 'offlineUserId',
             'senderId' => 'senderId',
          
           
           
            
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function saveOfflineChatStatus($senderId,$offlineUserId) {
        Yii::log("**********************############saveOfflineChatDetails-----------------","error","application");
            $returnValue = 'false';
            $criteria = new EMongoCriteria;
            $criteria->addCond('offlineUserId', '==',(int)$offlineUserId);
            $offlineObj = OfflineChatCollection::model()->find($criteria);
             if (is_object($offlineObj)) {
                 // Yii::log("if *************condition is object------------".$roomName, 'error', 'application');
                 $mongoModifier = new EMongoModifier;           
                 $mongoModifier->addModifier('senderId', 'addToSet', (int)$senderId);
                 $offlineObj->updateAll($mongoModifier);
                 $returnValue = 'true';
                 
             }else{
            Yii::log("else condition not object", 'error', 'application');
            $offlineChatCollection = new OfflineChatCollection();
          //  $offlineChatCollection->roomName=$roomName;
            $offlineChatCollection->offlineUserId = (int)$offlineUserId;
             $offlineChatCollection->senderId = array((int)$senderId);
         
            $offlineChatCollection->insert();
              if (isset($offlineChatCollection->_id)) {
                $returnValue = 'true';
            }
             }
         return $returnValue;
    }
    public function getOfflineMessages($loginUserId) {
           error_log("#############getOfflineMessages---------------------".$loginUserId);
           $criteria = new EMongoCriteria;
            $criteria->addCond('offlineUserId', '==',(int)$loginUserId);
            $offlineObj = OfflineChatCollection::model()->find($criteria);
             if (is_object($offlineObj)) {
                 return $offlineObj;
             }else{
                  return "NoData";
             }
            
    }
    public function popoutOfflineStatus($loginUserId,$offlineSenderUserId){
          $mongoModifier = new EMongoModifier;  
           $criteria = new EMongoCriteria;
            $criteria->addCond('offlineUserId', '==',(int)$loginUserId);
           $mongoModifier->addModifier('senderId', 'pull', (int)$offlineSenderUserId);
           if(OfflineChatCollection::model()->updateAll($mongoModifier,$criteria)){
               return $offlineSenderUserId;
           }
    }
   
  
    
}
