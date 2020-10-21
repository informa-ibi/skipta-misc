<?php
/*
 * Moin Hussain
 * To update handle of Users
 */
  $db_location='10.10.73.103';
  $db_name='RiteAid';
  $db_mongo_url='10.10.73.103:27018';
  $m = new Mongo($db_mongo_url);
  $db = $m->selectDB($db_name);
  
      $collection = $db->selectCollection("TinyUserCollection");
     // $users = $collection->find(array("uniqueHandle"=>null));
       $users = $collection->find();
        
   foreach ($users as $user) {
      // error_log("display bame--------------------".$user['DisplayName']);
         $displayNameArray =  explode(" ", $user['DisplayName']) ;
          $handler = generateUniqueHandleForUser($db,$displayNameArray[0],$displayNameArray[1]);
        $newdata= array('$set'=>array("uniqueHandle"=>$handler));
         $collection->update(array("UserId" =>(int)$user['UserId']), $newdata);  
  
    }

 function generateUniqueHandleForUser($db,$firstName,$lastName){
        $handle = $firstName.".".$lastName;
        while(checkHandleExist($db,$handle)){
            $randomNumber = mt_rand(1,99999);
            $handle = $firstName.".".$lastName.$randomNumber;
        }
        return $handle;
    }
  function checkHandleExist($db,$handle){
      $collection = $db->selectCollection("TinyUserCollection");
      $cursor = $collection->find(array("uniqueHandle"=>$handle));
     if($cursor->count()>0){
         return true;
     }  else {
          return false;
     }
     
    }
    
?>