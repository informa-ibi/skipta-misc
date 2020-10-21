<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Save top 10 leaders (hashtags,users,search items) that in DB
 *  @version 1.0
 */
class UpgradeNotificationsCommand extends CConsoleCommand {
   public function run($args) {
        $this->actionUpgradeNotification();
    }
   

    public function actionUpgradeNotification() {
        try {

            $notificationsCollection=Notifications::model()->findAll();
            error_log(sizeof($notificationsCollection)."--------------------------------_####");
            foreach($notificationsCollection as $notification){
                if(!isset($notification->NotificationNoteTwo)){
                    if ($notification->RecentActivity == "comment") {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier();
                    $mongoCriteria->addCond('_id', '==', $notification->_id);
                    $mongoModifier->addModifier('NotificationNote', 'set', "commented on");
                    $mongoModifier->addModifier('NotificationNoteTwo', 'set', "post");
                    Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
                }
                if ($notification->RecentActivity == "love") {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier();
                    $mongoCriteria->addCond('_id', '==', $notification->_id);
                    $mongoModifier->addModifier('NotificationNote', 'set', "loved");
                    $mongoModifier->addModifier('NotificationNoteTwo', 'set', "post");
                    Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
                }
                if ($notification->RecentActivity == "follow") {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier();
                    $mongoCriteria->addCond('_id', '==', $notification->_id);
                    $mongoModifier->addModifier('NotificationNote', 'set', "following");
                    $mongoModifier->addModifier('NotificationNoteTwo', 'set', "post");
                    Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
                }
                if ($notification->RecentActivity == "UserFollow") {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier();
                    $mongoCriteria->addCond('_id', '==', $notification->_id);
                    $mongoModifier->addModifier('NotificationNote', 'set', "followed");
                    $mongoModifier->addModifier('NotificationNoteTwo', 'set', "you");
                    Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
                }
                if ($notification->RecentActivity == "invite") {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier();
                    $mongoCriteria->addCond('_id', '==', $notification->_id);
                    $mongoModifier->addModifier('NotificationNote', 'set', "invited");
                    $mongoModifier->addModifier('NotificationNoteTwo', 'set', "you");
                    Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
                }
                if ($notification->RecentActivity == "mention") {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier();
                    $mongoCriteria->addCond('_id', '==', $notification->_id);
                    $mongoModifier->addModifier('NotificationNote', 'set', "mentioned");
                    $mongoModifier->addModifier('NotificationNoteTwo', 'set', "on a Post");
                    Notifications::model()->updateAll($mongoModifier, $mongoCriteria);
                } 
                }
               
            }

        } catch (Exception $exc) {
            error_log('--' . $exc->getMessage());
        }
    }
        
  
}
