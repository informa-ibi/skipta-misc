<?php

class SkiptaChatService {

    
    public function saveChatConversations($loginUserId,$roomName,$chatMessage,$profilePicture){
        return ChatRoomCollection::model()->saveChatConversation($loginUserId,$roomName,$chatMessage,$profilePicture); 
    }
    public function getChatConversations($roomName){
        return ChatRoomCollection::model()->getChatConversations($roomName); 
    }
     public function saveOfflineChatStatus($loginUserId,$offlineUserId){
        return OfflineChatCollection::model()->saveOfflineChatStatus($loginUserId,$offlineUserId); 
    }
    public function popoutOfflineStatus($loginUserId,$offlineSenderUserId){
         return OfflineChatCollection::model()->popoutOfflineStatus($loginUserId,$offlineSenderUserId);
    }
    
 
}

?>
