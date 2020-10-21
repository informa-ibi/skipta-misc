
<?php
/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class DailyDigestCommand extends CConsoleCommand {

    public function run($args) {
        $this->PrepareDailyDigest();
    }
    public function PrepareDailyDigest() {
        try {
            
            $featuredItem= ServiceFactory::getSkiptaPostServiceInstance()->getFeaturedItemForDailyDigest();            
            $isSendEmail=0;
            $absolutePath = Yii::app()->params['ServerURL'];
           // $absolutePath = "https://115.248.17.86";
           $featuredDisplayBean = new StreamPostDisplayBean();                      
            if (!is_string($featuredItem)) {                
                $isSendEmail=1;
                $userId = $featuredItem->FeaturedUserId;
                $userDetails = UserCollection::model()->getTinyUserCollection($userId);
                $featuredDisplayBean->PostBy = $userDetails->DisplayName;
                $featuredDisplayBean->PostId = $featuredItem->PostId;
                $featuredDisplayBean->PostText = $featuredItem->Description;
                $featuredDisplayBean->PostType = $featuredItem->Type;
                $featuredDisplayBean->CategoryType = $featuredItem->CategoryType;
                if ($featuredDisplayBean->PostType == '12' || $featuredDisplayBean->PostType == 12) {
                    // $url="$siteurl"."/".$gamename."/". $gamesheduledId."/detail/game";
                    $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$featuredDisplayBean->PostId&categoryType=9&postType=$featuredDisplayBean->CategoryType&trfid=$userDetails->UserId";
                } else {
                    $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$featuredDisplayBean->PostId&categoryType=$featuredDisplayBean->CategoryType&postType=$featuredDisplayBean->PostType&trfid=$userDetails->UserId";
                }
                $featuredDisplayBean->WebUrls = $url;
                
                if ($featuredItem->Resource != '' || !empty($featuredItem->Resource)) {
                    if (isset($featuredItem->Resource["Extension"])) {
                        $filetype = strtolower($featuredItem->Resource["Extension"]);
                        if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png') {
                            $featuredDisplayBean->ArtifactIcon = $absolutePath.$featuredItem->Resource["Uri"];
                        } else if ($filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv') {
                            $featuredDisplayBean->ArtifactIcon = $absolutePath."/images/system/video_img.png";
                        } else if ($filetype == 'mp3') {
                            $featuredDisplayBean->ArtifactIcon = $absolutePath."/images/system/audio_img.png";
                        } else {
                            $tinyUserObj = UserCollection::model()->getTinyUserCollection($featuredItem->UserId);
                            if (0 === strpos($tinyUserObj['ProfilePicture'], 'http')) {                              
                              $featuredDisplayBean->ArtifactIcon = $tinyUserObj['ProfilePicture'];
                                }else{                        
                                $featuredDisplayBean->ArtifactIcon =$absolutePath. $tinyUserObj['ProfilePicture'];
                                }
                            $featuredDisplayBean->ArtifactIcon = $tinyUserObj['ProfilePicture'];
                        }
                    }
                } else {
                    
                    $tinyUserObj = UserCollection::model()->getTinyUserCollection($userId);
                    if (0 === strpos($tinyUserObj['ProfilePicture'], 'http')) {                              
                              $featuredDisplayBean->ArtifactIcon = $tinyUserObj['ProfilePicture'];
                    }else{                        
                        $featuredDisplayBean->ArtifactIcon =$absolutePath. $tinyUserObj['ProfilePicture'];
                    }
                    
                }
            } else {
                $featuredItem = ServiceFactory::getSkiptaPostServiceInstance()->getCurbsidePostForDailyDigest();
                
                if (!is_string($featuredItem)) {
                    $isSendEmail=1;
                    $userId = $featuredItem->UserId;
                    $userDetails = UserCollection::model()->getTinyUserCollection($userId);
                    $featuredDisplayBean->PostBy = $userDetails->DisplayName;
                    $featuredDisplayBean->PostId = $featuredItem->PostId;
                    $featuredDisplayBean->PostText = $featuredItem->Description;
                    $featuredDisplayBean->StreamNote=$featuredItem->Subject;
                    $CursideCategory = $featuredItem->CategoryId;
                    $curbsideCategoryDetails = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($CursideCategory);
                  if ($featuredDisplayBean->PostType == '12' || $featuredDisplayBean->PostType == 12) {
                    // $url="$siteurl"."/".$gamename."/". $gamesheduledId."/detail/game";
                    $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$featuredDisplayBean->PostId&categoryType=9&postType=$featuredDisplayBean->CategoryType&trfid=$userDetails->UserId";
                } else {
                    $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$featuredDisplayBean->PostId&categoryType=3&postType=$featuredDisplayBean->PostType&trfid=$userDetails->UserId";
                }
                $featuredDisplayBean->WebUrls = $url;

                    $featuredDisplayBean->CategoryType = $curbsideCategoryDetails->CategoryName;
                    $featuredDisplayBean->Type = $featuredItem->Type;
                    if ($featuredItem->Resource != '' || !empty($featuredItem->Resource)) {
                        if (isset($featuredItem->Resource["Extension"])) {
                            $filetype = strtolower($featuredItem->Resource["Extension"]);
                            if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png') {
                                $featuredDisplayBean->ArtifactIcon = $featuredItem->Resource["Uri"];
                            } else if ($filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv') {
                                $featuredDisplayBean->ArtifactIcon = "/images/system/video_img.png";
                            } else if ($filetype == 'mp3') {
                                $featuredDisplayBean->ArtifactIcon = "/images/system/audio_img.png";
                            } else {

                                $featuredDisplayBean->ArtifactIcon = 'No';
                            }
                        }
                    }
                }
            }
           // End of getting Featured Items and Curbside Category 
            
            //$userCollection=UserCollection::model()->getTinyUserObjByNetwork(4);
            $userCollection=UserCollection::model()->getAllUsers();
            if($userCollection!='failure'){
                foreach ($userCollection as $user){
                    
                    try {
                        
                         $userId=$user['UserId'];
                         $userDetailsFromMysql=User::model()->getUserProfileByUserId($userId);
                          $userEmail=$userDetailsFromMysql['Email'];
                          $name=$user['DisplayName'];
                        
                    $userSettings=UserNotificationSettingsCollection::model()->getUserSettings($userId);
                    if($userSettings!="failure"){
                        
                        /** This is to get the comment notifications*/
                        if($userSettings->DailyDigest==1){                            
                            $data=gmdate('m/d/Y', strtotime("-1 days"));
                            $startDate=date('Y-m-d',strtotime($data));
                            $endDate=date('Y-m-d',strtotime($data));
                            $endDate =trim($endDate)." 23:59:59";
                            $startDate =trim($startDate)." 00:00:00";
                             $commentArray=array();
                             $commentBean=new CommentBean(); 
                             $commentBeanForFollowed=new CommentBean(); 
                             $commentBeanForLove=new CommentBean(); 
                             $commentBeanForMention=new CommentBean(); 
                             $commentBeanForInvite=new CommentBean(); 
                           //  $commentBeanForLove=new CommentBean(); 
                          if($userSettings->Commented==(int)1){                              
                            $notifications=Notifications::model()->getUserNotificationsByRecentActivity($userId,'comment',$startDate,$endDate);
                           // print_r($notifications);
                            if(!is_string($notifications)){                                
                                if(count($notifications)>0){
                                    $isSendEmail=1;
                                    $i=0;
                                    $text='';
                                    $FooterCommentText='';
                                   // print_r($notifications);
                                    foreach($notifications as $notification){
                                        
                                  //      if($i==0){  
                                        if($notification['CategoryType']==1){
                                         $postData=PostCollection::model()->getPostById($notification['PostId']);     
                                        }   
                                        if($notification['CategoryType']==2){
                                         $postData=  CurbsidePostCollection::model()->getPostById($notification['PostId']);     
                                        }if($notification['CategoryType']==3){
                                         $postData=GroupPostCollection::model()->getPostById($notification['PostId']);     
                                        }
                                        if(isset($postData->_id)){
                                            $arrayElement=count($notification['CommentUserId'])-1;
                                        $latestUserId=$notification['CommentUserId'][$arrayElement];
                                        $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);
                                        
                                        $commentBean->CommentText= $userDetails->DisplayName ;                                                                                                                         
                                        $commentBean->Comments=$postData->Description;
                                         $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$postData->_id&categoryType=$postData->Type&postType=$postData->Type&trfid=$userDetails->UserId";
                
                                         $commentBean->WebUrls = $url;
                                        if(count($postData->Resource)>0){
                                            foreach($postData->Resource as $resource){                                                                                            
                                             $commentBean->Artifacts=$resource['Uri'];
                                              $filetype = strtolower($resource["Extension"]);
                                             
                                             if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png' || $filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv' || $filetype == 'docx' || $filetype == 'doc') {
                                         $commentBean->Artifacts = $resource["ThumbNailImage"];
                                             }                                              
                                             break;
                                            }
                                            
                                        }
                                             
                               //      }else{
                                        // if($i<=2){
                                          
                                             if(count($notifications)>1){
                                            $arrayElement=count($notification['CommentUserId'])-1;                                            
                                            $latestUserId=$notification['CommentUserId'][$arrayElement];
                                            $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);        
                                            
                                            $commentBean->CommentMoreText=$userDetails->DisplayName;
                                            if(count($notifications)-2 > 0){                                                 
                                             $commentBean->CommentMoreUsersCount=count($notifications)-2;    
                                            }else{
                                                
                                                $commentBean->CommentMoreUsersCount=0;    
                                            }
                                            
                                            //array_push($commentArray['morecomments'],$FooterCommentText);
                                             }else{
                                               
                                                $commentBean->CommentMoreText='No'; 
                                                $commentBean->CommentMoreUsersCount=0;
                                             }
                                            break;
                                       //  }                                      
                                        
                                      //  } 
                                      //  array_push($commentArray,$commentBean);
                                     
                                       $i++; 
                                        }else{
                                            $commentBean->Comments='NoComments';
                                        }
                                        
                                    }
                                    
                                }else{
                                $commentBean->Comments='NoComments';
                            }
                                
                            }else{
                                $commentBean->Comments='NoComments';
                            }
                   
                        }
                       /** This logic is to get the notification for activity followed*/  
                      if($userSettings->ActivityFollowed==(int)1){
                            
                            $notifications=Notifications::model()->getUserNotificationsByRecentActivity($userId,'follow',$startDate,$endDate);
                            if(!is_string($notifications)){  
                                if(count($notifications)>0){
                                    $isSendEmail=1;
                                    $i=0;
                                    $text='';
                                    $FooterCommentText='';
                                    foreach($notifications as $notification){
                                   //     if($i==0){  
                                      
                                         if($notification['CategoryType']==1){
                                         $postData=PostCollection::model()->getPostById($notification['PostId']);     
                                        }   
                                        if($notification['CategoryType']==2){
                                         $postData=  CurbsidePostCollection::model()->getPostById($notification['PostId']);     
                                        }if($notification['CategoryType']==3){
                                         $postData=GroupPostCollection::model()->getPostById($notification['PostId']);     
                                        }
                                        if(isset($postData->_id)){
                                           $arrayElement=count($notification['PostFollowers'])-1;
                                        $latestUserId=$notification['PostFollowers'][$arrayElement];
                                        $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);
                                        
                                        print_r($postData);
                                        $text= $userDetails->DisplayName; 
                                        $commentBeanForFollowed->CommentText=$text;                                                                                
                                        $commentBeanForFollowed->Comments=$postData->Description;
                                        $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$postData->_id&categoryType=$postData->Type&postType=$postData->Type&trfid=$userDetails->UserId";
                
                                         $commentBeanForFollowed->WebUrls = $url;
                                        if(count($postData->Resource)>0){
                                            foreach($postData->Resource as $resource){                                             
                                             $commentBeanForFollowed->Artifacts=$resource['Uri'];  
                                           $filetype = strtolower($resource["Extension"]);                                           
                                             if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png' || $filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv' || $filetype == 'docx' || $filetype == 'doc') {
                                         $commentBeanForFollowed->Artifacts = $resource["ThumbNailImage"];
                                             }                                              

                                             break;
                                            }
                                            
                                        }
                                             
                                 //   }else{
                                     //    if($i<=2){
                                          
                                             if(count($notifications)>1){
                                               $arrayElement=count($notification['PostFollowers'])-1;
                                            $latestUserId=$notification['PostFollowers'][$arrayElement];
                                            $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);  
                                             $commentBeanForFollowed->CommentMoreText=$userDetails->DisplayName;
                                            if(count($notifications)-2 > 0){                                                
                                             $commentBeanForFollowed->CommentMoreUsersCount=count($notifications)-2;    
                                            }else{
                                               $commentBeanForFollowed->CommentMoreUsersCount=0; 
                                            }
                                         }  else{
                                                $commentBeanForFollowed->CommentMoreText='No'; 
                                                $commentBeanForFollowed->CommentMoreUsersCount=0;
                                             }
                                         //    }
                                                                                  
                                        break;
                                       // } 
                                        //array_push($commentArray,$commentBean);
                                     
                                       $i++;  
                                        }else{
                                            $commentBeanForFollowed->Comments='NoActivityFollowed';           
                                         }
                                        
                                    }
                                }else{
                                $commentBeanForFollowed->Comments='NoActivityFollowed';
                            }
                            }else{
                                $commentBeanForFollowed->Comments='NoActivityFollowed';
                            }
                        }
                        
                      /** This logic is to get the notification for mention */  
                      if($userSettings->Mentioned==(int)1){
                            
                            $notifications=Notifications::model()->getUserNotificationsByRecentActivity($userId,'mention',$startDate,$endDate);
                            echo '_____count of notifications ______________'.count($notifications);
                             if(!is_string($notifications)){  
                                if(count($notifications)>0){
                                    $isSendEmail=1;
                                   $i=0;
                                    $text='';
                                    $FooterCommentText='';
                                    foreach($notifications as $notification){
                                    //    if($i==0){
                                        if($notification['CategoryType']==1){
                                         $postData=PostCollection::model()->getPostById($notification['PostId']);     
                                        }   
                                        if($notification['CategoryType']==2){
                                         $postData=  CurbsidePostCollection::model()->getPostById($notification['PostId']);     
                                        }if($notification['CategoryType']==3){
                                         $postData=GroupPostCollection::model()->getPostById($notification['PostId']);     
                                        }
                                        
                                        if(isset($postData->_id)){
                                            $userDetails=UserCollection::model()->getTinyUserCollection($notification['MentionedUserId']);
                                        $commentBeanForMention->CommentText= $userDetails->DisplayName;
                                        $commentBeanForMention->Comments=$postData->Description;
                                        $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$postData->_id&categoryType=$postData->Type&postType=$postData->Type&trfid=$userDetails->UserId";                
                                        $commentBeanForMention->WebUrls = $url;
                                        if(count($postData->Resource)>0){
                                            foreach($postData->Resource as $resource){
                                             $commentBeanForMention->Artifacts=$resource['Uri'];
                                           $filetype = strtolower($resource["Extension"]);                                           
                                             if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png' || $filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv' || $filetype == 'docx' || $filetype == 'doc') {
                                         $commentBeanForMention->Artifacts = $resource["ThumbNailImage"];
                                             }                                              

                                            }                                            
                                        }
                                             
                                 //    }else{
                                   //      if($i<2){
                                              if(count($notifications)>1){
                                            $arrayElement=count($notification['MentionedUserId'])-1;
                                            $latestUserId=$notification['MentionedUserId'][$arrayElement];                                                  
                                            $userDetails=UserCollection::model()->getTinyUserCollection($notification['MentionedUserId']);        
                                              
                                            $commentBeanForMention->CommentMoreText=$userDetails->DisplayName;
                                            if(count($notifications)-2 > 0){                                                
                                             $commentBeanForMention->CommentMoreUsersCount=count($notifications)-2;    
                                            }  
                                              }else{
                                                $commentBeanForMention->CommentMoreText='No'; 
                                                $commentBeanForMention->CommentMoreUsersCount=0;
                                             }
                                           break;
                                      //   }                                      
                                        
                                       // } 
                                        
                                       $i++; 
                                        }else{
                                            $commentBeanForMention->Comments='NoMentions';
                                        }
                                        
                                    }  
                                }else{
                                $commentBeanForMention->Comments='NoMentions';
                            }
                            }else{
                                $commentBeanForMention->Comments='NoMentions';
                            }
                        } 
//                        
//                        
//                     /** This logic is to get the notification for Invite*/  
                      if($userSettings->Invited==(int)1){
                            
                            $notifications=Notifications::model()->getUserNotificationsByRecentActivity($userId,'invite',$startDate,$endDate);
                             if(!is_string($notifications)){  
                                if(count($notifications)>0){
                                    $isSendEmail=1;
                                    $i=0;
                                    $text='';
                                    $FooterCommentText='';
                                    foreach($notifications as $notification){
                                   //     if($i==0){
                                        if($notification['CategoryType']==1){
                                         $postData=PostCollection::model()->getPostById($notification['PostId']);     
                                        }   
                                        if($notification['CategoryType']==2){
                                         $postData=  CurbsidePostCollection::model()->getPostById($notification['PostId']);     
                                        }if($notification['CategoryType']==3){
                                         $postData=GroupPostCollection::model()->getPostById($notification['PostId']);     
                                        }
                                        if(isset($postData->_id)){
                                           $userDetails=UserCollection::model()->getTinyUserCollection($notification['InviteUserId']);
                                            $commentBeanForInvite->CommentText= $userDetails->DisplayName ."invited you on his post";
                                        $commentBeanForInvite->Comments=$postData->Description;
                                         $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$postData->_id&categoryType=$postData->Type&postType=$postData->Type&trfid=$userDetails->UserId";                
                                        $commentBeanForInvite->WebUrls = $url;
                                        if(count($postData->Resource)>0){
                                            foreach($postData->Resource as $resource){
                                             $commentBeanForInvite->Artifacts=$resource['Uri'];
                                             $filetype = strtolower($resource["Extension"]);                                           
                                             if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png' || $filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv' || $filetype == 'docx' || $filetype == 'doc') {
                                         $commentBeanForInvite->Artifacts = $resource["ThumbNailImage"];
                                             } 
                                            }                                            
                                        }
                                             
                                   //  }else{
                                   //      if($i<=2){    
                                              
                                               if(count($notifications)>1){
                                            $arrayElement=count($notification['InviteUserId'])-1;                                            
                                            $latestUserId=$notification['InviteUserId'];                                            
                                            $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);        
                                            
                                            $commentBeanForInvite->CommentMoreText=$userDetails->DisplayName;
                                            if(count($notifications)-2 > 0){                                                
                                             $commentBeanForInvite->CommentMoreUsersCount=count($notifications)-2;    
                                            }else{
                                                $commentBeanForInvite->CommentMoreUsersCount=0;
                                            }                                            
                                           
                                             }
                                             else{
                                                $commentBeanForInvite->CommentMoreText='No'; 
                                                $commentBeanForInvite->CommentMoreUsersCount=0;
                                             }
                                            break;
                                            
                                 //       }                                      
                                        
                                      //  } 
                                        
                                       $i++;  
                                        }else{
                                            $commentBeanForInvite->Comments='NoInvite';
                                        }
                                        
                                    }
                                }else{
                                $commentBeanForInvite->Comments='NoInvite';
                            }
                            }else{
                                $commentBeanForInvite->Comments='NoInvite';
                            }
                        }  
//                        /** This logic is to get the notification for Love*/  
                      if($userSettings->Loved==(int)1){
                           
                            $notifications=Notifications::model()->getUserNotificationsByRecentActivity($userId,'love',$startDate,$endDate);
                            echo 'Love Count is '.count($notifications);
                             if(!is_string($notifications)){  
                                if(count($notifications)>0){
                                    $isSendEmail=1;
                                    $i=0;
                                    $text='';
                                    $FooterCommentText='';
                                    foreach($notifications as $notification){
                                    //    if($i==0){
                                        if($notification['CategoryType']==1){
                                         $postData=PostCollection::model()->getPostById($notification['PostId']);     
                                        }   
                                        if($notification['CategoryType']==2){
                                         $postData=  CurbsidePostCollection::model()->getPostById($notification['PostId']);     
                                        }if($notification['CategoryType']==3){
                                         $postData=GroupPostCollection::model()->getPostById($notification['PostId']);     
                                        }
                                        if(isset($postData->_id)){
                                         $arrayElement=count($notification['Love'])-1;
                                        $latestUserId=$notification['Love'][$arrayElement];
                                        $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);
                                        $commentBeanForLove->CommentText= $userDetails->DisplayName ;
                                        $commentBeanForLove->Comments=$postData->Description;
                                        $url = Yii::app()->params['ServerURL'] . "/common/postdetail?postId=$postData->_id&categoryType=$postData->Type&postType=$postData->Type&trfid=$userDetails->UserId";                
                                        $commentBeanForLove->WebUrls = $url;
                                        if(count($postData->Resource)>0){
                                            foreach($postData->Resource as $resource){
                                             $commentBeanForLove->Artifacts=$resource['Uri'];
                                             $filetype = strtolower($resource["Extension"]);                                           
                                             if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png' || $filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv' || $filetype == 'docx' || $filetype == 'doc') {
                                         $commentBeanForLove->Artifacts = $resource["ThumbNailImage"];
                                             } 
                                            }                                            
                                        }
                                             
                              //       }else{
                                //         if($i<=2){
                                            if(count($notifications)>1){
                                            $arrayElement=count($notification['Love'])-1;
                                            $latestUserId=$notification['Love'][$arrayElement];
                                            $userDetails=UserCollection::model()->getTinyUserCollection($latestUserId);        
                                            
                                            $commentBeanForLove->CommentMoreText=$userDetails->DisplayName;
                                            if(count($notifications)-2 > 0){                                                
                                             $commentBeanForLove->CommentMoreUsersCount=count($notifications)-2;    
                                            }else{
                                                $commentBeanForLove->CommentMoreUsersCount=0; 
                                            }                                            
                                           
                                             }
                                             else{
                                                $commentBeanForLove->CommentMoreText='No'; 
                                                $commentBeanForLove->CommentMoreUsersCount=0;
                                             }
                                            break;
                                 //        }                                      
                                        
                                     //   } 
                                        
                                       $i++;    
                                        }else{
                                           $commentBeanForLove->Comments="NoLove";            
                                        }
                                        
                                    }  
                                }else{ 
                                $commentBeanForLove->Comments="NoLove";
                            }
                            }else{
                                $commentBeanForLove->Comments="NoLove";
                            }
                        }
                   
//                        /** This logic is to get the notification for USER followed*/  
//                      if($userSettings->UserFollowers==(int)1){
//                            $notifications=Notifications::model()->getUserNotificationsByRecentActivity($userId,'UserFollow');
//                            if($notifications!='failure'){
//                                $follow=0;
//                                foreach($notifications->NewFollowers as $followers){
//                                    if($follow<=2){
//                                     $userDetails=UserCollection::model()->getTinyUserCollection($followers);   
//                                    }else{
//                                        break;
//                                    }
//                                     
//                                     
//                                }
//                            }
//                        }
                        //$emailCredentials='';
                        //$emailCredentials = ServiceFactory::getSkiptaUserServiceInstance()-> getEmailCredentialsByTitle('DailyDigest');
                               
                        $to = "vamsikrishna9025@gmail.com";            
                        $userEmail =$userEmail;
                        $subject = 'Daily Digest from '.Yii::app()->params['NetworkName'];
                        $templateType = "DailyDigest";
                        $companyLogo = "";
                        $employerName = "Skipta Admin";
                        //$employerEmail = "info@skipta.com"; 
                        $messageview='dailyDigestEmailTemplate';
                       
                        $params = array('name' => $name, 'userId' => $userId, 'commentArray' => $commentBean,'commentBeanForFollowed'=>$commentBeanForFollowed,'commentBeanForLove'=>$commentBeanForLove ,'commentBeanForMention'=>$commentBeanForMention ,'commentBeanForInvite'=>$commentBeanForInvite,'featuredDisplayBean'=>$featuredDisplayBean,'email'=>$userEmail,'absolutePath'=>$absolutePath);
                        if($isSendEmail==1){
                        $sendMailToUser=new CommonUtility;
                        $sendMailToUser->actionSendmail($messageview,$params, $subject, $to);  
                        }
                        
                        
                    }  
                        }
                        
                    } catch (Exception $exc) {
                        echo '__________above_______________________'.$exc->getMessage();
                        error_log("In Exception between for loop".$exc->getMessage());
                    }

                 
                    
                }
            }
        } catch (Exception $exc) {
            echo '____________***********__________________________________'.$exc->getMessage();
            Yii::log('---'.$exc->getMessage(),'error','application');
        }
    }


}
