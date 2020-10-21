<?php

class updateUserCommand extends CConsoleCommand {

    public function run($args) {
        $this->updateUser();
    }
    


    public function updateUser() {
        try {
            $criteria = new EMongoCriteria();
            $searchKey = "University";
            $criteria->GroupName = new MongoRegex('/' . $searchKey . '.*/i');
            $data = GroupCollection::model()->findAll($criteria);

            foreach ($data as $obj) {
                $displayNameArray = explode(" ", $obj->GroupName);
                echo $obj->GroupName . '______';

                for ($i = 0; $i < sizeof($obj->GroupMembers); $i++) {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier;
                    $userId = $obj->GroupMembers[$i];
                    $mongoCriteria->addCond('UserId', '==', (int) $userId);
                    
                    echo $obj->_id."group id".$userId;
                    
                  //  $mongoModifier->addModifier('groupsFollowing', 'pop', $obj->_id);
                }

                $criteria->addCond('_id', '==', $obj->_id);

               // $return = GroupCollection::model()->deleteAll($criteria);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }

 
public function updateUsdfer() {
        

  try {
            $criteria = new EMongoCriteria();
            $searchKey = "University";
            $criteria->GroupName = new MongoRegex('/' . $searchKey . '.*/i');
            $data = GroupCollection::model()->findAll($criteria);

            foreach ($data as $obj) {
                $displayNameArray = explode(" ", $obj->GroupName);
                echo $obj->GroupName . '______';

                for ($i = 0; $i < sizeof($obj->GroupMembers); $i++) {
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier;
                    $userId = $obj->GroupMembers[$i];
                    $mongoCriteria->addCond('UserId', '==', (int) $userId);
                    $mongoModifier->addModifier('groupsFollowing', 'pop', $obj->_id);
                }

                $criteria->addCond('_id', '==', $obj->_id);

                $return = GroupCollection::model()->deleteAll($criteria);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    
   catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }
    }