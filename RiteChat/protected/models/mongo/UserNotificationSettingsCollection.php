<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author Vamsi Krishna
 * This is model class for User Settings
 * 
 */
class UserNotificationSettingsCollection extends EMongoDocument {
   
    public $UserId;
    public $Commented=1;
    public $Loved=0;
    public $ActivityFollowed=0;
    public $UserFollowers=0;
    public $Mentioned=1;
    public $Invited=1;
    public $NetworkId;
    public $DailyDigest=0;
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

   public function getCollectionName() {
        return 'UserNotificationSettings';
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
             'UserId' => 'UserId',
             'Commented' => 'Commented',
             'Loved' => 'Loved',
             'Commented' => 'Commented',
             'ActivityFollowed'=>'ActivityFollowed',
             'NetworkId'=>'NetworkId',
             'Invited'=>'Invited',
             'Mentioned'=>'Mentioned',
            'UserFollowers'=>'UserFollowers',
             'DailyDigest'=>'DailyDigest'
        );
    }
     public function saveUserSettings($userId,$networkId) {
    
        $userSettings = new UserNotificationSettingsCollection();
        $userSettings->UserId = (int)$userId;
        $userSettings->Commented = 1;
        $userSettings->Loved =0;
        $userSettings->ActivityFollowed =0;
        $userSettings->Mentioned = 1;
        $userSettings->Invited = 1;
        $userSettings->UserFollowers = 0;
        $userSettings->NetworkId =(int)$networkId ;
        $userSettings->DailyDigest=0;


        if ($userSettings->save()) {
           return "saved";
        }
    }
    
 /**
 * @author Vamsi Krishna
 * This method is used to get user settings 
 * @param $userId
 * @return $obj
 */
   public function getUserSettings($userId) {
        $returnValue = 'failure';
        try {
            
             $criteria = new EMongoCriteria;
            $criteria->addCond('UserId', '==',(int)$userId);
          
            $userSettings = UserNotificationSettingsCollection::model()->find($criteria);
           
             
            if(isset($userSettings)){
                $returnValue=$userSettings;
            }
            return $returnValue;
        } catch (Exception $exc) {
            echo " error ".$exc->getMessage();
          //  Yii::log("get user settings" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    /**
     * @author Karteek V
     * @param type $userId
     * @param type $settingIds
     * @return string
     */
    public function updateUserSettings($userId,$settingIds,$isDevice=0){
        try {
              if($isDevice == 0){
            $returnValue = "failed";            
             $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('UserId', '==',(int)$userId);
          
            
              $mongoModifier = new EMongoModifier;

            $mongoCriteria->addCond('UserId', '==', (int) $userId);


            $mongoModifier->addModifier('Loved', 'set', 0);

            $mongoModifier->addModifier('Commented', 'set', 0);

            $mongoModifier->addModifier('ActivityFollowed', 'set', 0);

            $mongoModifier->addModifier('UserFollowers', 'set', 0);

            $mongoModifier->addModifier('Mentioned', 'set', 0);

            $mongoModifier->addModifier('Invited', 'set', 0);
            $mongoModifier->addModifier('DailyDigest', 'set', 0);
            UserNotificationSettingsCollection::model()->updateAll($mongoModifier, $mongoCriteria);
                $columnNameArray = explode(",",$settingIds);
                if(isset($columnNameArray)){
                    
                      $mongoModifier = new EMongoModifier;
                      $mongoCriteria = new EMongoCriteria;
                      $mongoCriteria->addCond('UserId', '==', (int)$userId);
                    for($i=0;$i<sizeof($columnNameArray);$i++){
                        if($columnNameArray[$i] == "Loved"){
                        $mongoModifier->addModifier('Loved', 'set', 1);
                        }else if($columnNameArray[$i] == "Commented"){
                             $mongoModifier->addModifier('Commented', 'set', 1);
                        }else if($columnNameArray[$i] == "ActivityFollowed"){
                              $mongoModifier->addModifier('ActivityFollowed', 'set', 1);
                        }else if($columnNameArray[$i] == "UserFollowers"){
                            $mongoModifier->addModifier('UserFollowers', 'set', 1);
                        }else if($columnNameArray[$i] == "Mentioned"){
                               $mongoModifier->addModifier('Mentioned', 'set', 1);
                        }else if($columnNameArray[$i] == "Invited"){
                              $mongoModifier->addModifier('Invited', 'set', 1);
                        }
                        else if($columnNameArray[$i] == "DailyDigest"){
                        $mongoModifier->addModifier('DailyDigest', 'set', 1);
                        }
                }
                     if(UserNotificationSettingsCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
                        $returnValue = "success";           
                     }else{
                          $returnValue = "failed";      
                     }
              }
           } 
           else { //mobile
                error_log("======In mobile notifications===" );
                $columnNameArray = explode(",", $settingIds);
                $mongoModifier = new EMongoModifier;
                $mongoCriteria = new EMongoCriteria;
                $mongoCriteria->addCond('UserId', '==', (int) $userId);
                $mongoModifier->addModifier($columnNameArray[0], 'set', $columnNameArray[1]);
                error_log("======Settings ID===" . $columnNameArray[0] . "===value===" . $columnNameArray[1]);              
                if(UserNotificationSettingsCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
                     error_log("======In success===" );
                        $returnValue = "success";           
                     }else{
                          error_log("======In error===" );
                          $returnValue = "failed";      
                     }
            }
        } catch (Exception $exc) {
             error_log("#####################################".$exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');            
        }
        return $returnValue;
    }

}