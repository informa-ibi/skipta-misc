<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class saveNotificationSettingsCommand extends CConsoleCommand {

    public function run($args) {
        $this->SaveSettings();
}

         public function SaveSettings() {
        try {
           $object = UserCollection::model()->findAll();
            foreach($object as $rw){
              echo "User Id is ".$rw->UserId;
                $userSettings = new UserNotificationSettingsCollection();
                $userSettings->UserId = $rw->UserId;
                $userSettings->Commented = 1;
                $userSettings->Loved = 0;
                $userSettings->ActivityFollowed = 0;
                $userSettings->Mentioned = 1;
                $userSettings->Invited = 1;
                $userSettings->UserFollowers = 0;
                $userSettings->NetworkId = $rw->NetworkId;
                UserNotificationSettingsCollection::model()->saveUserSettings($rw->UserId,(int)$rw->NetworkId);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
        }
    }
    }
