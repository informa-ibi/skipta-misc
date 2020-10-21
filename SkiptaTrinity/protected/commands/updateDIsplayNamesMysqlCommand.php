<?php
/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class updateDIsplayNamesMysqlCommand extends CConsoleCommand {

    public function run($args) {
        $this->updateImagePaths();
    }

    public function updateDiplayNameMysql(){
        try {
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;
        //  $mongoCriteria->addCond('uniqueHandle', '==', null);  
        $users = UserCollection::model()->findAll($mongoCriteria);        

        foreach ($users as $user) {
          
           $query="update User set DisplayName='".$user['DisplayName']."' where UserId=".$user['UserId'];
           YII::app()->db->createCommand($query)->execute();
            
        }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }
        
          public function updateImagePaths(){
        try {
       $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;
        
        $users = UserCollection::model()->findAll();
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;

        foreach ($users as $user) {

                 $mongoCriteria->addCond('UserId', '==', (int) $user->UserId);
                $mongoModifier->addModifier("profile250x250", 'set', "https://sandbox.urologynation.com/profile". $user->ProfilePicture);
                echo 'UserId is '.$user->UserId;
                $mongoModifier->addModifier("profile70x70", 'set', "https://sandbox.urologynation.com/profile". $user->ProfilePicture);
                $mongoModifier->addModifier("profile45x45", 'set', "https://sandbox.urologynation.com/profile". $user->ProfilePicture);
                UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }

}
