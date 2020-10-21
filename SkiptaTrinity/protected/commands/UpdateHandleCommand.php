<?php
/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class UpdateHandleCommand extends CConsoleCommand {

    function actionUpdateTinyUserHandle() {
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;
        $users = UserCollection::model()->findAll($mongoCriteria);
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;

        foreach ($users as $user) {
            $displayNameArray = explode(" ", $user->DisplayName);
            echo $user->DisplayName.'______';
            $fn = isset($displayNameArray[0])?$displayNameArray[0]:'';
            $ln = isset($displayNameArray[1])?$displayNameArray[1]:'';
            $handler = $this->generateUniqueHandleForUser($fn,$ln);
            $mongoCriteria->addCond('UserId', '==', (int) $user->UserId);
            $mongoModifier->addModifier("uniqueHandle", 'set', $handler);
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        }
    }

    function generateUniqueHandleForUser($firstName, $lastName) {
        $handle = $firstName . "." . $lastName;
        $handle = str_replace(" ", "", $handle);
        while ($this->checkHandleExist($handle)) {
            $randomNumber = mt_rand(1, 99999);
            $handle = $handle.$randomNumber;
        }
        return $handle;
    }

    function checkHandleExist($handle) {
        $criteria = new EMongoCriteria();
        $criteria->addCond('uniqueHandle', '==', $handle);
        $result = UserCollection::model()->find($criteria);
        if (is_object($result)) {
            return true;
        } else {
            return false;
        }
    }
    
    
      function actionUpdateAPIAccessKeyForExistingUsers() {
        $object = UserCollection::model()->findAll();
        foreach ($object as $rw) {

            User::model()->updateAPIAccessKeyForExistingUsers($rw->UserId);
        }
    }

       function actionUpdateprofilePics() {
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;
        $mongoCriteria->addCond('UserId', '<=', 150000);  
     
        $users = UserCollection::model()->findAll();
      

        foreach ($users as $user) {
          $mongoCriteria = new EMongoCriteria;
          $mongoModifier = new EMongoModifier;
          $mongoCriteria->addCond('UserId', '==', (int) $user->UserId);
             $profilepic = str_replace("sandbox.", "", $user->ProfilePicture);
            $profile250x250 = str_replace("sandbox.", "", $user->profile250x250);
            $profile70x70 = str_replace("sandbox.", "", $user->profile70x70);
            $profile45x45 = str_replace("sandbox.", "", $user->profile45x45);


            $mongoModifier->addModifier("ProfilePicture", 'set', $profilepic);
            $mongoModifier->addModifier("profile250x250", 'set', $profile250x250);
            echo  'UserId is ' . $user->UserId;
            $mongoModifier->addModifier("profile70x70", 'set', $profile70x70);
            $mongoModifier->addModifier("profile45x45", 'set', $profile45x45);
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        }
    }
    
}
