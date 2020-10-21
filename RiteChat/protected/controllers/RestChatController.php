<?php


class RestChatController extends Controller {

    /**
     * @author Sagar
     * This method is to get the stream details
     */
    public function init() {
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            CommonUtility::reloadUserPrivilegeAndData($this->tinyObject->UserId);
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
        } else {
            
        }
    }
    public function actionGetChatConversations(){
    try{
        error_log("----actionGetChatConversations-----------------------------");
        if(isset($_REQUEST['userId']) && isset($_REQUEST['recipientId'])){
            $userId = $_REQUEST['userId'];
            $recipientId = $_REQUEST['recipientId'];
             if((int)$userId<(int)$recipientId){ 
                     $roomName ="Room-".$userId."-".$recipientId;
              }else{ 
                     $roomName = "Room-".$recipientId."-".$userId;
             }
           $result =ServiceFactory::getSkiptaChatServiceInstance()->getChatConversations($roomName);
           $offlineUserId = ServiceFactory::getSkiptaChatServiceInstance()->popoutOfflineStatus($userId,$recipientId);
        }
        
        $obj = array('status' => 'success', 'data' =>$result[0],'userId'=>$userId,'recipientId'=>$recipientId,'recentChatTime' =>$result[1],'offlineUserId' =>$offlineUserId, 'error' => '');        
        echo CJSON::encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    
}
public function actionSaveChatConversations(){
    $loginUserId = $_REQUEST['loginUserId'];
    $roomName = $_REQUEST['roomName'];
    $chatMessage = $_REQUEST['chatMessage'];
    //$profilePicture = Yii::app()->session['TinyUserCollectionObj']->profile70x70;
     $profilePicture = "";
    $result = ServiceFactory::getSkiptaChatServiceInstance()->saveChatConversations($loginUserId,$roomName,$chatMessage,$profilePicture);
    $obj = array('status' => 'success', 'data' => $result, 'error' => ''); 
     echo $this->rendering($obj);
  
    
}
public function actionSaveOfflineChatStatus(){
    error_log("===actionSaveOfflineChatStatus");
     $loginUserId = $_REQUEST['loginUserId'];
  //  $roomName = $_REQUEST['roomName'];
    $offlineUserId = $_REQUEST['offlineUserId'];
    $result = ServiceFactory::getSkiptaChatServiceInstance()->saveOfflineChatStatus($loginUserId,$offlineUserId);
   $obj = array('status' => 'success', 'data' => $result, 'error' => '');        
     echo $this->rendering($obj);
    
}
}