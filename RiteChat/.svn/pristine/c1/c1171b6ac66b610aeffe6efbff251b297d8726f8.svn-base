<?php

/** This is the collection for tiny user where we get the user data to use user data 

 */

class UserCookie extends EMongoDocument {

    public $userId;
   public  $cookieRandomKey;
   

    public function getCollectionName() {
        return 'UserCookie';
    }
    public function indexes() {
        return array(
            'index_userId' => array(
                'key' => array(
                    'userId' => EMongoCriteria::SORT_ASC
                ),
            )
        );
    }
    public function attributeNames() {
        return array(
            'userId' => 'userId',
            'cookieRandomKey' => 'cookieRandomKey',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
   
    /** 
     
     * this method is used to save the user colletion (tiny user) it accepts the user collection object 
      * if saves to the userCollection it returns the userID 
          */
    public function saveCookieRandomKeyForUser($userId,$randomKey) {
        try {
              Yii::log($userId."------saveCookieRandomKeyForUser-------".$randomKey, 'error', 'application');
             $criteria = new EMongoCriteria;
            $criteria->addCond('userId', '==',(int)$userId);
            $userCookie = UserCookie::model()->find($criteria);
             if (is_object($userCookie)) {
                 $mongoModifier = new EMongoModifier;           
                 $mongoModifier->addModifier('cookieRandomKey', 'push', $randomKey);
                 $criteria = new EMongoCriteria;
                 $criteria->addCond('userId', '==',(int)$userId);
                 $userCookie->updateAll($mongoModifier, $criteria);
                 $returnValue = 'true';
             }
            else{
            $userCookie = new UserCookie();
            $userCookie->userId=(int)$userId;
            $userCookie->cookieRandomKey = array($randomKey);
            $userCookie->insert();
              if (isset($userCookie->_id)) {
                $returnValue = 'true';
              }  
            }
           
           
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
  public function checkCookieValidityForUser($userId,$randomKey){
           $criteria = new EMongoCriteria;
            $criteria->addCond('userId', '==',(int)$userId);
            $criteria->addCond('cookieRandomKey', 'in',array($randomKey));
            $userCookie = UserCookie::model()->find($criteria);
             if (is_object($userCookie)) {
                  $returnValue = 'true';
             }else{
                  $returnValue = 'false';
             }
              return $returnValue;
  }
   public function deleteCookieRandomKeyForUser($userId,$randomKey){
           $criteria = new EMongoCriteria;
            $criteria->addCond('userId', '==',(int)$userId);
            $mongoModifier = new EMongoModifier;           
            $mongoModifier->addModifier('cookieRandomKey', 'pop', $randomKey);
            UserCookie::model()->updateAll($mongoModifier, $criteria);
   }

}
