<?php

/**
 * @author Moin Hussain
 * @class Chart(NodeCommuncation)
 */
class ChatCommand extends CConsoleCommand {

    /**
     * @author Moin Hussain
     * @param type $userId
     * @return type JSON 
     */

    public function actionGetFriends($userId, $logginedUsers, $searchText,$startLimit,$pageLength) {
        $logginedUsers = explode(",", $logginedUsers);
        try {
            $friendsArray = array();
            $loggedinArray = array();
            $offlineArray = array();
          //  error_log("actionGetFriends-----------searchtext-------".$searchText);
            $totalChatUsers = 0;
            if($startLimit == 0 && trim($searchText)==""){
                 $totalChatUsers = ChatRoomCollection::model()->getAllChatUsersCount($userId);
            }
           
            $friendsArray = $this->getUsersList($userId,$logginedUsers,$searchText,$startLimit,$pageLength);

            echo CJSON::encode(array("data" => $friendsArray, "status" => "success","searchText" => $searchText,"totalChatUsers" => $totalChatUsers));
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
     public function actionSearchUsers($userId, $logginedUsers, $searchText,$startLimit,$pageLength) {
        $logginedUsers = explode(",", $logginedUsers);
        try {
            $friendsArray = array();
            $loggedinArray = array();
            $offlineArray = array();
            error_log("actionSearchUsers-----------searchtext-------".$searchText."----".$startLimit."----".$pageLength);
            $criteria = new EMongoCriteria();
            $criteria->DisplayName = new MongoRegex('/' . $searchText . '.*/i');
             $criteria->Status = (int)1;
             $criteria->addCond('UserId', '!=', (int)$userId);
             $criteria->sort("UserId", EMongoCriteria::SORT_DESC);
             $criteria->select(array("DisplayName","UserId","profile70x70","uniqueHandle","Status"));
             $criteria->limit($pageLength);//keep constant
             $criteria->offset($startLimit);
            $users = UserCollection::model()->findAll($criteria);
            $usersArray = array();
          //  error_log("count00000000000000000---------------".count($users));
            foreach ($users as $user) {
                $displayName = $user->DisplayName;
                if(strlen($displayName)>15){
                    
                            $shortName = substr($displayName, 0, 15)."...";
                        }else{
                            $shortName = $displayName;
                        }
                if(ChatRoomCollection::model()->checkUserInInbox($userId,$user->UserId)){
                    $userInInbox = "yes";
                 }else{
                    $userInInbox = "no"; 
                    //error_log($user->Status."--statues----".$user->UserId."-----is not inbox");
                }
                   // array_push($usersArray, $user);
                    // error_log($user->Status."--statues----".$user->DisplayName."----".$user->UserId."-----is inbox");
                       if (in_array($user->UserId, $logginedUsers)) {
                            array_push($usersArray, array("userObj" => $user, "userStatus" => "loggedIn","userInInbox"=>$userInInbox,"shortName"=>$shortName));
                        } else {
                            array_push($usersArray, array("userObj" => $user, "userStatus" => "offline","userInInbox"=>$userInInbox,"shortName"=>$shortName));
                        }
                    
               
                 }
 //error_log("neddddddddddddddddddddd");
            echo CJSON::encode(array("data" => $usersArray, "status" => "success","searchText" => $searchText));
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    function sortArrayByArray($array, $orderArray) {
        $ordered = array();
        foreach ($orderArray as $key) {
            if (array_key_exists($key, $array)) {
                $ordered[$key] = $array[$key];
                unset($array[$key]);
            }
        }
        return $ordered + $array;
    }

    public function actionGetOfflineMessages($loginUserId) {
        try {
           // error_log("actionGetOfflineMessages----------------".$loginUserId);
            $offlineObject = OfflineChatCollection::model()->getOfflineMessages($loginUserId);
            if (is_object($offlineObject)) {
                echo CJSON::encode(array("data" => $offlineObject, "status" => "success"));
            } else {
                echo CJSON::encode(array("data" => "", "status" => "NoData"));
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    
    public function actionLoadMoreChatUsers($startLimit=0,$userId, $logginedUsers, $searchText = null){
        try{
            $modArray = $friendsArray = array();
            $logginedUsers = explode(",", $logginedUsers);
            $friendsArray = $this->getUsersList($userId,$logginedUsers,$searchText,$startLimit,$this->pageLength);
            $tArraySize = count($friendsArray);
            $obj = array();
            $obj = array("data" => $friendsArray, "status" => "success");   
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    
    public function getUsersList_v3($userId,$logginedUsers,$searchText,$offset,$limit){
        $result = $friendsArray = array();
            $result = UserProfileCollection::model()->getUserFollowersFollowingsById($userId,$offset,$limit);
                if(isset($result) && sizeof($result)){
                $recentChatUsers = ChatRoomCollection::model()->getRecentChatUsers($userId);
                $newArray = array(); // result array
                foreach ($recentChatUsers as $val) { // loop
                    $newArray[array_search($val, $result)] = $val; // adding values
                }
                $newArray = array_merge($newArray, $result);
                $i=0;
                $result = array_unique($newArray);
                foreach ($result as $value) {
                    //$i++;
                   // if($i==300)
                   // break;
                    $userObj = UserCollection::model()->getTinyUserCollectionWithStatusActive($value);
                    if(isset($userObj)){
                    $displayName = $userObj->DisplayName;
                    if ($searchText == "" || stripos($displayName, $searchText) !== false) {

                        $userObj->AboutMe = "";
                        if (in_array($value, $logginedUsers)) {
                            array_push($friendsArray, array("userObj" => $userObj, "userStatus" => "loggedIn"));
                        } else {
                            array_push($friendsArray, array("userObj" => $userObj, "userStatus" => "offline"));
                        }
                    }
                }
                }
            }
            return $friendsArray;
    }
    public function getUsersList($userId,$logginedUsers,$searchText,$offset,$limit){
        $result = $friendsArray = array();
        //error_log("logged in users----------------".print_r($logginedUsers,true));
       // error_log("search text-------------".$searchText);
           // $result = UserProfileCollection::model()->getUserFollowersFollowingsById($userId,$offset,$limit);
               // if(isset($result) && sizeof($result)){
                $recentChatUsers = ChatRoomCollection::model()->getRecentChatUsers($userId,$offset,$limit);
                $newArray = array(); // result array
//                foreach ($recentChatUsers as $val) { // loop
//                    $newArray[array_search($val, $result)] = $val; // adding values
//                }
                //$newArray = array_merge($newArray, $result);
               // $i=0;
              //  $result = array_unique($newArray);
                foreach ($recentChatUsers as $value) {
                    //$i++;
                   // if($i==300)
                   // break;
                    $userObj = UserCollection::model()->getTinyUserCollectionWithStatusActive($value);
                    if(isset($userObj)){
                    $displayName = $userObj->DisplayName;
                   // error_log(strlen($displayName)."display Name-------------------".$userObj->DisplayName);
                    if ($searchText == "" || stripos($displayName, $searchText) !== false) {
                       // error_log("if----------");
                        $userObj->AboutMe = "";
                        if(strlen($displayName)>15){
                            $shortName = substr($displayName, 0, 15)." ...";
                        }else{
                            $shortName = $displayName;
                        }
                       // error_log("value-------------------".$value);
                        if (in_array($value, $logginedUsers)) {
                           // error_log("user  loggined in---------------------");
                            array_push($friendsArray, array("userObj" => $userObj, "userStatus" => "loggedIn","shortName"=>$shortName));
                        } else {
                           //  error_log("user not loggined in---------------------");
                            array_push($friendsArray, array("userObj" => $userObj, "userStatus" => "offline","shortName"=>$shortName));
}
                    }
                }
                }
            //}
            return $friendsArray;
    }

}

?>
