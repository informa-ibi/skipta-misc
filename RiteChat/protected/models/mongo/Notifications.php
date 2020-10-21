<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author Vamsi Krishna
 * This class is defined for Notifications Collection .All the user notification's will be present in this collection.
 */
class Notifications extends EMongoDocument {
    public $_id;
    public $UserId;
    public $CreatedOn;    
    public $NotificationNote;
    public $RecentActivity;    
    public $NetworkId;
    public $CommentUserId=array();
    public $NewFollowers=array();
    public $PostId;
    public $PostFollowers=array();
    public $Love=array();
    public $PlayedUsers=array();
    public $MentionedUserId;
    public $InviteUserId;
    public $CategoryType;
    public $isRead;
    public $PostType;



    public function getCollectionName() {
        return 'Notifications';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                ),
            )
        );
    }
    public function attributeNames() {
        return array(
            '_id'=>'_id',
            'UserId'=>'UserId',
            'CreatedOn'=>'CreatedOn',            
            'NotificationNote'=>'NotificationNote',
            'RecentActivity'=>'RecentActivity',            
            'NetworkId'=>'NetworkId',
            'CommentUserId'=>'CommentUserId',
            'NewFollowers'=>'NewFollowers',
            'PostId'=>'PostId',
            'PostFollowers'=>'PostFollowers',
            'Love'=>'Love',
            'MentionedUserId'=>'MentionedUserId',
            'InviteUserId'=>'InviteUserId',
            'CategoryType'=>'CategoryType',
            'isRead'=>'isRead',
            'PostType'=>'PostType',
            'PlayedUsers'=>'PlayedUsers'
        );
    }
    /**
     * @author Vamsi Krishna 
     * Description This Method is used to save notifications for the user 
     * @param type $notificationsObj
     * @return string
     */
    
  public function saveNotifications($notificationsObj){
      $returnValue='failure';
      try {       
         echo 'In Save Notification_--------------------';
          $notifications=new Notifications();
          $notifications->UserId=$notificationsObj->UserId;
          $notifications->CreatedOn=$notificationsObj->CreatedOn;           
          $notifications->NotificationNote=$notificationsObj->NotificationNote;
          $notifications->RecentActivity=$notificationsObj->RecentActivity;
          if(isset($notificationsObj->CommentUserId) && !empty($notificationsObj->CommentUserId)){
              array_push($notifications->CommentUserId,$notificationsObj->CommentUserId);
          }else{
              $notifications->CommentUserId=array();
          }
          if(isset($notificationsObj->NewFollowers) && !empty($notificationsObj->NewFollowers)){
              array_push($notifications->NewFollowers,$notificationsObj->NewFollowers);
          }else{
              $notifications->NewFollowers=array();
          }
         
          $notifications->PostId=new MongoId($notificationsObj->PostId);
         
           if(isset($notificationsObj->PostFollowers) && !empty($notificationsObj->PostFollowers)){
              array_push($notifications->PostFollowers,$notificationsObj->PostFollowers);
          }else{
              $notifications->PostFollowers=array();
          }
           if(isset($notificationsObj->Love) && !empty($notificationsObj->Love)){
                array_push($notifications->Love,$notificationsObj->Love);
          }else{
              $notifications->Love=array();
          }
       
            if ($notificationsObj->MentionedUserId != "" && $notificationsObj->MentionedUserId != null) {
                $notifications->MentionedUserId=array();
                 array_push($notifications->MentionedUserId,$notificationsObj->MentionedUserId);
                   //$notifications->MentionedUserId=$notificationsObj->MentionedUserId;
            }
      
             
                $notifications->InviteUserId = $notificationsObj->InviteUserId;
           
    
          $notifications->CategoryType=(int)$notificationsObj->CategoryType;
          $notifications->NetworkId=(int)$notificationsObj->NetworkId;
          $notifications->isRead=(int)$notificationsObj->isRead;
          $notifications->PostType = (int)$notificationsObj->PostType;
          if($notifications->save()){
          $returnValue='success';    
          }
          
        return $returnValue;   
      } catch (Exception $exc) {       
         echo "#############saveNotifications##################".$exc->getTraceAsString();
          return $returnValue;
      }
    }
    
  public function getNotificationsForUserWithPost($userId,$postId,$networkId,$categoryType,$recentActivity){
      try {
          
          $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
            $mongoCriteria->addCond('PostId', '==', new MongoId($postId));
//            $mongoCriteria->addCond('NetworkId', '==', (int)$networkId);
            $mongoCriteria->addCond('CategoryType', '==', (int)$categoryType); 
            $mongoCriteria->addCond('RecentActivity', '==', $recentActivity);
            $userNotifications=Notifications::model()->find($mongoCriteria);
            
            if(isset($userNotifications)){
                $returnValue=$userNotifications;
            }
          
            return $returnValue;
      } catch (Exception $exc) {
          echo "#############getNotificationsForUserWithPost##################".$exc->getTraceAsString();
      }
    }
    
     public function updateNotificationsForUser($notificationId,$actionType,$notificationObj){
      try {          
          $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;            
            $mongoCriteria->addCond('_id', '==', new MongoId($notificationId));
            if($actionType=='Comment'){
             $mongoModifier->addModifier('CommentUserId', 'push', $notificationObj->CommentUserId);    
             $mongoModifier->addModifier('NotificationNote', 'set', $notificationObj->NotificationNote);    
             $mongoModifier->addModifier('RecentActivity', 'set', $notificationObj->RecentActivity);    
            }
            if($actionType=='Love'){
             $mongoModifier->addModifier('Love', 'push', $notificationObj->Love);    
             $mongoModifier->addModifier('NotificationNote', 'set', $notificationObj->NotificationNote);    
             $mongoModifier->addModifier('RecentActivity', 'set', $notificationObj->RecentActivity);    
            }
            if($actionType=='Follow'){
             $mongoModifier->addModifier('PostFollowers', 'push', $notificationObj->PostFollowers);    
             $mongoModifier->addModifier('NotificationNote', 'set', $notificationObj->NotificationNote);    
             $mongoModifier->addModifier('RecentActivity', 'set', $notificationObj->RecentActivity);    
            }
            if($actionType=='UserFollow'){
             $mongoModifier->addModifier('NewFollowers', 'push',(int) $notificationObj->NewFollowers);    
             $mongoModifier->addModifier('NotificationNote', 'set', $notificationObj->NotificationNote);    
             $mongoModifier->addModifier('RecentActivity', 'set', $notificationObj->RecentActivity);    
            }
             if($actionType=='mention'){                
            $mongoModifier->addModifier('MentionedUserId','push',(int)$notificationObj->MentionedUserId);
             $mongoModifier->addModifier('NotificationNote', 'set', $notificationObj->NotificationNote);    
             $mongoModifier->addModifier('RecentActivity', 'set', $notificationObj->RecentActivity);    
            }
            $mongoModifier->addModifier('CreatedOn', 'set', $notificationObj->CreatedOn);  
              $mongoModifier->addModifier('isRead', 'set', $notificationObj->isRead); 
            $userNotifications=Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
            if(isset($userNotifications)){
                $returnValue=$userNotifications;
            }
            return $returnValue;
      } catch (Exception $exc) {
         echo "###########updateNotificationsForUser####################".$exc->getTraceAsString();
      }
    }
    
    public function getUserNotificationForFollower($userId,$recentActivity){
        try {
             $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('UserId', '==', (int)$userId);            
            $mongoCriteria->addCond('RecentActivity', '==', $recentActivity);
            $userNotifications=  Notifications::model()->find($mongoCriteria);
            if(isset($userNotifications)){
                $returnValue=$userNotifications;
            }
            return $returnValue;
        } catch (Exception $exc) {
           echo "################################EXCEPTION at notifaction  followers".$exc->getTraceAsString();
        }
    
    }
    /**
     * @author Karteek V
     * @param type $notificationId
     * @return string
     */
    public function updateNotificationAsRead($notificationId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('_id', '==', new MongoId($notificationId));
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('isRead', 'set', (int) 1);
             if (Notifications::model()->updateAll($mongoModifier, $mongoCriteria)) {
                    $returnValue = "success";
                }
            return $returnValue;
        } catch (Exception $exc) {
            // echo "#####UPDATWupdateNotificationAsRead##########################".$exc->getMessage();
        }
    }
    
    public function updateAllNotificationsByUserId($userId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('isRead', 'set', (int) 1);
            if(Notifications::model()->updateAll($mongoModifier, $mongoCriteria)){
                $returnValue = "success";
            }
            return $returnValue;
        } catch (Exception $exc) {
             //echo "###############################".$exc->getMessage();
        }
    } 
    
    public function updateNotificationsDelete($obj) {
        try {
             $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==',new MongoId($obj->PostId));
            $mongoCriteria->addCond('CategoryType', '==',(int)$obj->CategoryType);            
            $mongoModifier->addModifier('IsDeleted', 'set', (int)0);
            if(Notifications::model()->updateAll($mongoModifier, $mongoCriteria)){
                $returnValue = "success";
            }
            return $returnValue;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
      
     public function getUserNotificationsByRecentActivity($userId,$recentActivity,$startDate,$endDate){
          $returnValue = 'failure';
        try {
           
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('UserId', '==', (int)$userId);            
            $mongoCriteria->addCond('RecentActivity', '==', $recentActivity);
            $mongoCriteria->addCond('CreatedOn', '>', new MongoDate(strtotime($startDate)));
            $mongoCriteria->addCond('CreatedOn', '<', new MongoDate(strtotime($endDate)));
        //    $mongoCriteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
            $userNotifications=  Notifications::model()->findAll($mongoCriteria);            
            if(isset($userNotifications)){
                $returnValue=$userNotifications;
            }
            return $returnValue;
        } catch (Exception $exc) {          
             $returnValue = 'failure';
        }
    
    }  
    
     public function getNotificationForPostByActionType($postId,$actionType){
          $returnValue = 'failure';
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('PostId', '==', new MongoId($postId));            
            $mongoCriteria->addCond('RecentActivity', '==', $actionType);
            $object =  Notifications::model()->find($mongoCriteria);            
            if(isset($object)){
               return $object;
            }else{
               return "";  
            }
        } catch (Exception $exc) {          
             $returnValue = 'failure';
        }
    
    }  

}
