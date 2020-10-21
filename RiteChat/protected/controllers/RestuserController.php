<?php

/*
 * Developer Suresh Reddy
 * on 8 th Jan 2014
 * all users actions need to add here
 */

class RestuserController extends Controller {

      public function init() {
      
      }
 
/**
 * author: suresh Reddy .G
 * actionGetMiniPorfile is used to get user mini profile
 * request an userId
 * returns an user object
 */
public function actionGetMiniProfile(){
    try{
        
        
        if(isset($_REQUEST['userid'])){
            $userid = $_REQUEST['userid'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getUserMiniProfile($userid,$_REQUEST['loggedUserId']);
        }
        
        $obj = array('status' => 'success', 'data' => $result, 'error' => '');        
        echo json_encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    
}


/**
 * @author Suresh Reddy.v
 * actionUserFollowUnfollowActions is used for either follow or unfollow actions
 * @param $userid,$type
 * @return type json object
 */
public function actionUserFollowUnfollowActions(){
    try{
        if(isset($_REQUEST['type']) && isset($_REQUEST['userid'])){
            $type = $_REQUEST['type'];
            $followId = $_REQUEST['userid'];
            $userId = $_REQUEST['loggedUserId'];
            if(strtolower(trim($type)) == "follow"){
                $result = ServiceFactory::getSkiptaUserServiceInstance()->followAUser($userId,$followId);
            }else if(strtolower(trim($type)) == "unfollow"){
                $result = ServiceFactory::getSkiptaUserServiceInstance()->unFollowAUser($userId,$followId);
            }
        }else{
            Yii::log("==actionUserFollowUnfollowActions=else not set=","error","application");
        }
        $obj = array("status"=>$result,"data"=>"","error"=>"");
    } catch (Exception $ex) {
        Yii::log($ex->getMessage(),"error","application");
    }
    echo CJSON::encode($obj);
}



 public function actionMobileUnreadNotifications(){   
     
      $userId = $_POST['userId'];
        $provider = new EMongoDocumentDataProvider('Notifications',                   
           array(
                'pagination' => FALSE,
                'criteria' => array( 
                   'conditions'=>array(                       
                       'UserId'=>array('==' => (int) $userId),                       
                       'isRead' => array('==' => (int) 0)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));    
            $data = $provider->getData();             
            if($provider->getItemCount() > 0){
               // error_log("----------actionMobileUnreadNotifications---------------".$provider->getItemCount()); 
                $result = CommonUtility::prepareStringToNotification($data,"mobile");
                $obj = array("data"=>$result,"notificationCount"=>  sizeof( $provider->getData()));                              
            }else{
                $obj = array('status' => 'success', 'data' => 0, 'error' => "");
                }
            echo $this->rendering($obj);
    } 
    
    public function actionGetAllNotificationByUserId() {
         try {
            $userId = (int)$_REQUEST['userId'];
            $startLimit = (int)$_REQUEST['startLimit'];
            $pageSize = (int)$_REQUEST['pageSize'];
            $offset = ($startLimit*$pageSize);
            $provider = new EMongoDocumentDataProvider('Notifications', array(
                'pagination' => FALSE,
                'criteria' => array(
                    'conditions' => array(
                        'UserId' => array('==' => (int) $userId),                        
                    ),
                    'offset'=> $offset,
                    'limit' => $pageSize,
                    'sort' => array('isRead'=>EMongoCriteria::SORT_ASC, 'CreatedOn' => EMongoCriteria::SORT_DESC)
                )
            ));
            $data = $provider->getData();
            $obj="";
            $totalCount = $provider->getTotalItemCount();
            if($provider->getTotalItemCount()==0 && $startLimit == 0){
               $stream=0;//No posts
               $obj = array("status"=>"success","data"=>$result,"notificationCount"=>  sizeof($data), "totalCount"=>$totalCount); 
           }else if(sizeof($data) > 0){
                $result = CommonUtility::prepareStringToNotification($data,"mobile");
                $obj = array("status"=>"success","data"=>$result,"notificationCount"=> sizeof($data), "totalCount"=>$totalCount); 
            }else
            {
                $stream=-1;//No more posts
                $obj = array("status"=>"success","data"=>$result,"notificationCount"=> sizeof($data), "totalCount"=>$totalCount); 
            }
            echo $this->rendering($obj);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    public function actionGetUnreadNotifications(){
        try{
            $userId = (int)$_REQUEST['userId'];
            $provider = new EMongoDocumentDataProvider('Notifications',                   
           array(
                'pagination' => FALSE,
                'criteria' => array( 
                   'conditions'=>array(                       
                       'UserId'=>array('==' => (int) $userId),                       
                       'isRead' => array('==' => (int) 0)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));   
            $data = $provider->getData();
            $unreadCount = $provider->getItemCount();
            $readDataProvider = new EMongoDocumentDataProvider('Notifications',                   
           array(
                'pagination' => FALSE,
                'criteria' => array( 
                   'conditions'=>array(                       
                       'UserId'=>array('==' => (int) $userId),                       
                       'isRead' => array('==' => (int) 0)
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));  
            $moreCount = $readDataProvider->getTotalItemCount()-$unreadCount;
            $obj = "";
            if( $unreadCount> 0){
                $result = CommonUtility::prepareStringToNotification($data,"mobile");
                $obj = array("status"=>"success","data"=>$result,"unreadNotificationCount"=>  $unreadCount,"moreCount"=>$moreCount); 
            }else{
                $obj = array("status"=>"success","data"=>$result,"unreadNotificationCount"=>  $unreadCount,"moreCount"=>$moreCount); 
            }
            echo $this->rendering($obj);
               
        } catch (Exception $ex) {
             error_log($ex->getMessage());
        }
    }
    public function prepareStringToNotification($Ndata){
        try{
            $totalArray = array();
            $totalNotificationTobeShownCount=0;
            foreach($Ndata as $data){
                if($totalNotificationTobeShownCount<10){                    
                $notifications = new NotificationBean();
                $userName = "";
                $postText=CommonUtility::postStringTypebyIndex((int)$data->PostType,(int)$data->CategoryType);
                $custompostText=$postText;                
                //love...
                if(isset($data->Love) && $data->RecentActivity == "love"){
                    if(sizeof($data->Love) >=2){
                        $firstUserId = end($data->Love); 
                        $nextUserId = prev($data->Love);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);                            
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                        }
                        
                        if($firstUserId != $nextUserId && sizeof($data->Love) > 2){
                            $userName = "$userName and others love your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->Love) == 2){
                            $userName = "$userName  love your $postText";
                        }else {
                            $userName = "$userName loves your $postText";
                        }
                                        
                    }else if(sizeof($data->Love)>0){
                        $firstUserId = end($data->Love);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  loved your $postText";                           
                        }                       
                    }       
                    $createdOn = $data->CreatedOn;
                    $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,"mobile");
                    $notifications->NotificationString = $userName;
                    $notifications->IsRead = $data->isRead;
                    $notifications->_id = $data->_id;
                    $notifications->PostId = $data->PostId;
                    $notifications->PostType = $data->PostType;
                    $notifications->CategoryType = $data->CategoryType;
                    array_push($totalArray,$notifications);
                }
                //comment...
                if($data->RecentActivity == "comment" && isset($data->CommentUserId)){
                    if(sizeof($data->CommentUserId) >=2){
                        $firstUserId = end($data->CommentUserId); 
                        $nextUserId = prev($data->CommentUserId);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);                            
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->CommentUserId) > 2){
                            $userName = "$userName and others commented on your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->CommentUserId) == 2){
                            $userName = "$userName  commented on your $postText";
                        }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName commented on your $postText";
                        }
                        
                        
                    }else if(sizeof($data->CommentUserId)>0){
                        $firstUserId = end($data->CommentUserId);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  commented on your $postText";                           
                        }                       
                    }
                    if(!empty($userName)){
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,"mobile");
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                //follow...
                if($data->RecentActivity == "follow" && isset($data->PostFollowers)){
                    if(sizeof($data->PostFollowers) >=2){
                        $firstUserId = end($data->PostFollowers); 
                        $nextUserId = prev($data->PostFollowers);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->PostFollowers) > 2){
                            $userName = "$userName and others are following your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->PostFollowers) == 2){
                            $userName = "$userName are following your $postText";
                        }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName is following your $postText";
                        }
                        
                        
                    }else if(sizeof($data->PostFollowers)>0){
                        $firstUserId = end($data->PostFollowers);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  is following your $postText";                           
                        }                       
                    }
                    if(!empty($userName)){
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,"mobile");
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                //mentioned...
                if($data->RecentActivity == "mention" && isset($data->MentionedUserId)){
                    if(!empty($data->MentionedUserId)){
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->MentionedUserId);
                        if($data->PostType!=4){
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> to mentioned you on  $custompostText"; 
                        }else{
                            $userName = "<b class='notification_displayname'>Some one</b> to mentioned you on  $custompostText"; 
                        }
                       
                       
                        $notifications->DisplayName = $tinyUserObject->DisplayName;
                        $notifications->ProfilePic = $tinyUserObject->profile70x70;  
                    }
                    if(!empty($userName)){
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,"mobile");
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                }
                // invite ...
                if($data->RecentActivity == "invite" && isset($data->InviteUserId)){
                    if(!empty($data->InviteUserId)){
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->InviteUserId);
                        $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> is inviting you to $custompostText";
                        $notifications->DisplayName = $tinyUserObject->DisplayName;
                        $notifications->ProfilePic = $tinyUserObject->profile70x70;  
                    }
                    if(!empty($userName)){
                         $createdOn = $data->CreatedOn;
                        if(is_int($createdOn))
                        {
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn,"mobile");
                        }
                        else if(is_numeric($createdOn))
                        {
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn,"mobile");
                        }
                        else
                        {
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,"mobile");
                        }
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }
                    
                }
                
                   // UserFollow ...
                if($data->RecentActivity == "UserFollow" && isset($data->NewFollowers)){
                    if(sizeof($data->NewFollowers) >=2){
                        $firstUserId = end($data->NewFollowers); 
                        $nextUserId = prev($data->NewFollowers);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                            $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->NewFollowers) > 2){
                            $userName = "$userName and others are following you";
                        }else if($firstUserId != $nextUserId && sizeof($data->NewFollowers) == 2){
                            $userName = "$userName are following you";
                        }else {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70; 
                            $userName = "$userName is following you";
                        }
                        
                        
                    }else if(sizeof($data->NewFollowers)>0){
                        $firstUserId = end($data->NewFollowers);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;                            
                            
                                $userName =  "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> is following you";                           
                        }                       
                    }
                    if(!empty($userName)){
                         
//                        if($notifications->ProfilePic!=""){
//                            $notifications->ProfilePic = YII::app()->params['ServerURL']."/".$notifications->ProfilePic;
//                        }
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,"mobile");
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray,$notifications);
                    }else{
                         
                    }
                }
                
                // invite
                
                    $totalNotificationTobeShownCount++;
                }
               
            }
            
            return $totalArray;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
        
    }
     public function preparedAllNotificaions($Ndata){
        try{
            $totalArray = array();
            $totalNotificationTobeShownCount = 0;
            foreach($Ndata as $data){
                $notifications->_id = (string)$data->_id;
                $notifications->PostId = (string)$data->PostId;
                $notifications = new NotificationBean();
                $userName = "";
                $userFollowName = "";
              $postText=CommonUtility::postStringTypebyIndex((int)$data->PostType);
                $custompostText=$postText; 
                //love...
//                if($data->RecentActivity == "love" || $data->RecentActivity == "comment" || $data->RecentActivity == "follow" || $data->RecentActivity == "love"){
//                    
//                }
                //comment...
                if($data->RecentActivity == "comment" || isset($data->CommentUserId)){
                    if(sizeof($data->CommentUserId) >=2){
                        $firstUserId = end($data->CommentUserId); 
                        $nextUserId = prev($data->CommentUserId);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);                            
                            $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->CommentUserId) > 2){
                            $userName = "$userName and others commented on your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->CommentUserId) == 2){
                            $userName = "$userName  commented on your $postText";
                        }else {
                            $userName = "$userName commented on your $postText";
                        }
                        
                        
                    }else if(sizeof($data->CommentUserId)>0){
                        $firstUserId = end($data->CommentUserId);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  commented on your $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName =  "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>  commented on your $postText";                           
                            }
                        }                       
                    }
                    
                }
                // love
                if(isset($data->Love)){
                    if(sizeof($data->Love) >=2){
                        $firstUserId = end($data->Love); 
                        $nextUserId = prev($data->Love);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId); 
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                        }
                        
                        if($firstUserId != $nextUserId && sizeof($data->Love) > 2){
                            $userName = "$userName and others love your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->Love) == 2){
                            $userName = "$userName love your $postText";
                        }else {
                            $userName = "$userName loves your $postText";
                        }
                                        
                    }else if(sizeof($data->Love)>0){
                        $firstUserId = end($data->Love);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  loves your $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName =  "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> love your $postText";                           
                            }
                            
                        }                       
                    }       

                }
                
                //follow...
                if(isset($data->PostFollowers)){
                    if(sizeof($data->PostFollowers) >=2){
                        $firstUserId = end($data->PostFollowers); 
                        $nextUserId = prev($data->PostFollowers);
                        if((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                        }
                        if(isset($nextUserId) && !empty($nextUserId) &&($firstUserId != $nextUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);  
                             if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                            
                        }
                        if($firstUserId != $nextUserId && sizeof($data->PostFollowers) > 2){
                            $userName = "$userName and others are following your $postText";
                        }else if($firstUserId != $nextUserId && sizeof($data->PostFollowers) == 2){
                            $userName = "$userName are following your $postText";
                        }else {
                            $userName = "$userName following your $postText";
                        }
                        
                        
                    }else if(sizeof($data->PostFollowers)>0){
                        $firstUserId = end($data->PostFollowers);
                        if(isset($firstUserId) && !empty($firstUserId)){
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                                      
                            if(empty($userName)){
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName =  "<span class='m_title'>$tinyUserObject->DisplayName</span>  is following your $postText";                           
                            }else{
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName =  "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>  are following your $postText";                           
                            }
                        }                       
                    }
                    
                }
                //mentioned...
                if(isset($data->MentionedUserId)){
                    if(!empty($data->MentionedUserId)){
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->MentionedUserId);
                        if(empty($userName)){   
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            if ($data->PostType != 4) {
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span> to mentioned you on $custompostText";
                            } else {
                                $userName = "<span class='m_title'>Some one</span> to mentioned you on $custompostText";
                            }
                        }else{
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            if ($data->PostType != 4) {
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> to mentioned you on  $custompostText";
                            } else {
                                $userName = "<b class='notification_displayname'>Some one</b> to mentioned you on  $custompostText";
                            }

                            // $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> to mentioned you on $custompostText";
                        }
                        
                          
                    }
                    
                }
                
                // invite ...
                if(isset($data->InviteUserId)){
                    if(!empty($data->InviteUserId)){
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->InviteUserId);
                        if(empty($userName)){
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>  is inviting  you to $custompostText";
                        }else{
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> are inviting  you to $custompostText";
                        }
                        
                         
                    }
                    
                }
                
                   // UserFollow ...
                if(isset($data->NewFollowers)){
                    if(sizeof($data->NewFollowers) >0){
                        $data->NewFollowers=  array_values(array_unique($data->NewFollowers));
                       
                        $firstUserId = end($data->NewFollowers); 
                        $nextUserId = prev($data->NewFollowers);
                         $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                        if(isset($tinyUserObject)){
                            
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $notifications->NotificationType = "userfollow";
                        
                         $userFollowName = "<span class='userprofilename_notification m_title' data-notid='$data->_id' data-id='$tinyUserObject->UserId'>$tinyUserObject->DisplayName</span>";
                        
                            
                        }
                             $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                        if(isset($tinyUserObject)){
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = "";
                         $userFollowName = "$userFollowName, <span class='userprofilename_notification m_title' data-notid='$data->_id' data-id='$tinyUserObject->UserId'>$tinyUserObject->DisplayName</span>";
                        }
                        if(sizeof($data->NewFollowers) > 2){
                            $userFollowName = "$userFollowName and others are following you";
                        }else if(sizeof($data->NewFollowers) == 2){
                            $userFollowName = "$userFollowName are following you";
                        }else {
                            $userFollowName = "$userFollowName is following you";
                        }
                        
                        
                    }
                    
                    
                }
//                if($notifications->ProfilePic!=""){
//                    $notifications->ProfilePic = YII::app()->params['ServerURL']."/".$notifications->ProfilePic;
//                }
                    $totalNotificationTobeShownCount++;
                    $createdOn = $data->CreatedOn;
                    $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                    if(!empty($userFollowName)){
                    $notifications->NotificationString = $userFollowName;}else{
                     $notifications->NotificationString = $userName;   
                    }
                    $notifications->IsRead = $data->isRead;
                    $notifications->_id = (string)$data->_id;
                    $notifications->PostId = (string)$data->PostId;
                    $notifications->PostType = $data->PostType;
                    $notifications->CategoryType = $data->CategoryType;
                    array_push($totalArray,$notifications);
               
            }
            return $totalArray;
            
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }
    public function actionUpdateNotificationAsRead() {
        try {
            $result = "failed";
            if (isset($_REQUEST['notificationId']) && strtolower($_REQUEST['notificationId']) != "undefined") {
                $notificationId = $_REQUEST['notificationId'];
                //$userId = (int)$_REQUEST['userId'];
                $result = ServiceFactory::getSkiptaPostServiceInstance()->updateNotificationAsRead($notificationId);
            }
            $obj = array("status" => $result, "data" => "", "error" => "");
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $ex) {
            $obj = array("status" => "exception", "data" => $ex->getMessage(), "error" => "");
            echo $this->rendering($obj);
        }
         
    }
    /* This method is used for Custom groups */
    /*
     * Custom methods start...
     */
    public function actionContactUsMailSend(){
        try{
            $name = $_REQUEST['Name'];
            $phone = $_REQUEST['Phone'];
            $email = $_REQUEST['Email'];
            $contactMethod = $_REQUEST['ContactMethod'];
            $from = $_REQUEST['From'];
            $message = "";
//            $subject = $displayname . " has invited you to join " . Yii::app()->params['NetworkName'];
//            $employerName = "Skipta Admin";
//            //$employerEmail = "info@skipta.com"; 
            $subject = $from.' '.Yii::app()->session['TinyUserCollectionObj']->DisplayName;
            $to = $_REQUEST['To'];
            $messageview = "CustomContactUsMailTemplate";
            $params = array('name' => $name,'phone' => $phone , 'email' => $email ,'contactMethod' => $contactMethod , 'message' => $message);
            $sendMailToUser = new CommonUtility;
            $mailSentStatus = $sendMailToUser->actionSendmail($messageview, $params, $subject, $to);
            $obj = array();
            if($mailSentStatus){
                $obj = array("status"=>"success");
            }else{
                $obj = array("status"=>"failed");
            }
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionContactUsMailSend ##########".$ex->getMessage());
        }
    }
    
    public function actionGetOpinionSurveyDetails(){
        try{
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $opinionDetails = ServiceFactory::getSkiptaUserServiceInstance()->getOpinionDetails($userId);
            $obj = array();
            $obj = array("data"=>$opinionDetails,"status"=>"success","LoggedUserId"=>$userId);
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetOpinionDetails ##########".$ex->getMessage());
        }
    }
    
    public function actionSaveUserOpinion(){
        try{
            $opinionId = $_REQUEST['opinionId'];
            $optionValue = $_REQUEST['optionValue'];
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $surveryResults = ServiceFactory::getSkiptaUserServiceInstance()->saveOpinionDetails($userId,$opinionId,$optionValue);
            $obj = array("data"=>$surveryResults,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionSaveUserOpinion ##########".$ex->getMessage());
        }
    }
    
    public function actionGetSurveyResults(){
        try{
            $opinionId = $_REQUEST['opinionId'];
            $surveryResults = ServiceFactory::getSkiptaUserServiceInstance()->getSurveyResults($opinionId);
            $obj = array("data"=>$surveryResults,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetSurveyResults ##########".$ex->getMessage());
        }
    }
    
    public function actionCheckPTCMember(){
        try{
            $results = ServiceFactory::getSkiptaUserServiceInstance()->checkPTCMember(Yii::app()->session['Email']);
            $obj = array("size"=>sizeof($results));
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionCheckPTCMember ##########".$ex->getMessage());
        }
    }
    

    public function actionGetSurveyMonkeyQuestions(){
        try{            
            $results = ServiceFactory::getSkiptaUserServiceInstance()->getSurveyQuestions();            
            $obj = array("data"=>$results,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetSurveyMonkeyQuestions ##########".$ex->getMessage());
        }
    }
 
    public function actionSaveSurveyOpinions(){
        try{   
            
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $optionId = $_REQUEST['optionValue'];
            $questionId = $_REQUEST['qId'];
            $others = $_REQUEST['otherValue'];
            $rating = $_REQUEST['rating'];
            ServiceFactory::getSkiptaUserServiceInstance()->saveSurveyOpinions($userId,$optionId,$questionId,$others,$rating);            
            $obj = array("data"=>"","status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionSaveSurveyOpinions ##########".$ex->getMessage());
        }
    }
    
    public function actionGetMonkeySurveyResults(){
        try{
            $userId = Yii::app()->session['TinyUserCollectionObj']->UserId;
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getSurveyOpinionsRes($userId);            
            $obj = array("count"=>$result,"status"=>"success");
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("############Exception in actionGetSurveyResults ##########".$ex->getMessage());
        }
    }
    


   public function actionGetBadgesNotShownToUser() {
        try {          
            $userId = $_REQUEST['userId'];
             error_log("######################".$userId);
            $badgeCollection = CommonUtility::getBadgesNotShownToUser($userId, 1);
            error_log("###########123456###########".  json_encode($badgeCollection));
            $obj = "";
            if (count($badgeCollection) > 0) {
                $badgeInfo = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($badgeCollection->BadgeId);
                $obj = array("status" => "success", 'badgingInfo' => $badgeInfo, 'badgeCollectionInfo' => $badgeCollection);
                 error_log("###########test###########".  json_encode($obj));
                  error_log("###########test1###########".  json_encode($badgeInfo));
            } else {
                $obj = array("status" => "failure", "data" => "", "error" => "");
            }
            echo CJSON::encode($obj);
             
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in actionEnableOrDisableJoyRide==" . $ex->getMessage(), "error", "application");
        }
    }

    public function actionUpdateBadgeShownToUser() {
        try {
            if (isset($_POST['badgeCollectionId'])) {
                $result = array();
                $result = ServiceFactory::getSkiptaUserServiceInstance()->updateBadgeShownToUser($_POST['badgeCollectionId']);
            }
        } catch (Exception $ex) {
           
        }
    }
    public function actionSaveStreamSettings() {
        try {
            $userId = $_REQUEST['UserId'];
            $settingIds = $_REQUEST['settingIds'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->updateUserSettings($userId, $settingIds,1);
//            $result = ServiceFactory::getSkiptaUserServiceInstance()->updateUserSettings($userId, $settingIds);
            $obj = array("status" => $result, "data" => "", "error" => "");
        } catch (Exception $ex) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        echo CJSON::encode($obj);
    } 
    public function actionGetUserStreamSettings() {
        try {
            $userId = $_REQUEST['UserId'];
            $result = ServiceFactory::getSkiptaUserServiceInstance()->getUserSettings($userId);
            $obj = array("data"=>$result,"status"=>"success");
            $obj = $this->rendering($obj);
            echo $obj;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
            error_log($ex->getMessage());
        }
    }
  public function actionUpdatePushNotifications(){
    //  error_log("--------actionUpdatePushNotification-----------");
       $userId = $_REQUEST['userId'];
       $result = ServiceFactory::getSkiptaUserServiceInstance()->updatePushNotification($userId);
       if($result == "success"){
          $obj = array("status"=>"success");  
       }else{
            $obj = array("status"=>"failure");
       }
       echo $this->rendering($obj);
  }
  public function actionUpdatePushNotificationToken(){
      //error_log("--------actionUpdatePushNotification-----------");
        $userId = $_REQUEST['userId'];
        $pushToken = $_REQUEST['pushToken'];

     //   error_log("push token-----------" . $pushToken);
        $deviceInfo = $_POST['deviceInfo'];
        // error_log("device info----".print_r($deviceInfo,true));
        // error_log("device paltfomr----".$deviceInfo['platform']);
        $sessionId = ServiceFactory::getSkiptaUserServiceInstance()->saveMobileSession_V6($userId, $deviceInfo, $pushToken);
        $obj = array("status" => "success", "sessionId" => $sessionId);

        echo $this->rendering($obj);
    }
}

?>