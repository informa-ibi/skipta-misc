<?php

/**
 * @author reddy
 * @class Utility( for temp use)
 */
class UtilityCommand extends CConsoleCommand {
 
    
     public function run($args) {
        $this->makeGroupAdmin();
}
    
public function makeGroupAdmin() {
        try {

            //  $criteria->GroupName = new MongoRegex('/' . $searchKey . '.*/i');
            $data = GroupCollection::model()->findAll();

            foreach ($data as $obj) {

                echo $obj->GroupName . '______';


                $mongoCriteria = new EMongoCriteria;
                $mongoModifier = new EMongoModifier;
                if (isset(YII::app()->params['NetworkAdminEmail'])) {
                    $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(YII::app()->params['NetworkAdminEmail'], 'Email');
                    $mongoModifier->addModifier('GroupAdminUsers', 'push', (int) $netwokAdminObj->UserId);
                    $mongoCriteria->addCond('GroupAdminUsers', '!=', (int) $netwokAdminObj->UserId);
                    $mongoModifier->addModifier('CreatedUserId', 'set', (int) $netwokAdminObj->UserId);
                }
                $mongoCriteria->addCond('_id', '==', $obj->_id);

                $return = GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage() . $exc->getLine();
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }

}

?>
