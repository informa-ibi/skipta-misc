    <div class="streamsectionarea" id="streamsectionarea">
    <div class="padding10ltb">
    <div class="row-fluid ">
     <div class="span6 "><h2 class="pagetitle"><?php echo Yii::t('translation','Chat'); ?> </h2></div>
<!--          <div class="span6 ">
          <div class="grouphomemenuhelp alignright"> <a href="#" class="chat_minus" id="minChatWidget"> <i class="fa fa-minus"></i></a> </div>
          </div>-->
     </div>
    
    <div class="g_mediapopup ">
    <div class="row-fluid chatcustomdiv">
    <div class="span12">
    <div class="span9">
    <div class="chatmessagearea" id="chatmessagearea" name="chatmessagearea" style="display: none">
    <div class="row-fluid">
    <div class="span12">
    <div class="span6">
     <div class="chat_subheader paddingtop4" id="recipientName"></div>
      <div id="typestatus"></div>
    </div>
        <div class="span6" style="display: none">
     <div class="pull-right"><input type="text" placeholder="<?php echo Yii::t('translation','Invite'); ?>..." size="40" name="q" id="inviteInput"></div>
    </div>
    </div>
    </div>
   
    <div class="chat_messagebox">
     <div class="scroll-pane" id="chatBoxScrollPane" style="min-height: 250px">
         <div id="chatData">
             
         </div>
          <div id="chatStatus" style="color: gray;display: none;">
<!--             Sreeni jakka is typing...-->
         </div>
    </div>
    </div>
    <div class="padding8top">
        <textarea name="" cols="" rows="" class="span12" id="mjmChatMessage" placeholder="Enter message here..."></textarea>
    <div id="preview" class="preview" style="display:none">
    
   
   
    </div>
        <div class="postattachmentarea" style="display: none">
        <div class="pull-left whitespace">
        	<div class="advance_enhancement">
            <ul><li class="dropdown pull-left ">
                     
                   <div class="postupload">
                   <div id="uploadFile">
                   <div class="qq-uploader">
                   <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Upload a file<input type="file" multiple="multiple" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;"></div>
                   </div>
                   </div>
                   </div>   
          
                    </li>
                   
                    </ul>
            
           </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="span3 customdiv3">
    <div class="paddingleft10">
    
    <div class="aligncenter chat_profileareasearch padding8top">
 <form class="search marginzero" action="/search" method="get"><input type="text" class="marginzero span12" placeholder="Search..." size="40" name="q" id="chatFriendsSearch"></form>
    </div>
     <div class="chat_profilearea">
    <div class="scroll-pane" id="usersListScrollPane" style="min-height: 550px">
        <div id="chatUsersList">
            
        </div>     
            </div>   
          </div>
       </div>   
     </div>    
    </div>
    </div>
    </div>
    
    </div>
    
    </div>

<!----mini-chat start-->

<!----mini-chat end-->
<script>
<?php

$userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
$profilePicture = Yii::app()->session['TinyUserCollectionObj']['profile70x70'];
?>
function removeFromArray(array,search_term){      
        
    for (var i=array.length-1; i>=0; i--) {   
       // alert(array[i]+"--"+search_term);
   if (array[i] == search_term) {  //alert('if');       
       array.splice(i, 1);
    return array;
       // break;       //<-- Uncomment  if only the first term has to be removed
   }
//return array;
  // return receipents;
 
}  
  return array; 
    }
//    var maxChatArray = new Array(); //storing current active user window with User Id and name
//   // maxChatArray.push("6");
//   // maxChatArray.push("Justin");
//    var minChatArray = new Array();
  
function showChatArea(recipientId,name){ 
//      popFromMinChatArray(recipientId);
//      pushToMinChatArray();
//      pushToMaxChatArray(recipientId,name);
    // maxChatArray.push(recipientId);
    // maxChatArray.push(name);
    //  alert( maxChatArray);
     $("[name='chatmessagearea']").attr("id","chatmessagearea_"+<?php echo $userId ?>+"_"+recipientId);
     $("#chatData,#chatStatus").html("");
     $("#chatStatus").hide();
     $("#mjmChatMessage").val("");
     sessionStorage.removeItem("roomName");
     $("#offlineIcon_"+recipientId).hide(); //alert(recipientId);
     //alert( $("#offlineIcon_"+recipientId));
  
     if(onlineUserIds!=undefined){ //alert('if');
          $.unique(onlineUserIds);
                   if(onlineUserIds.length>0){
               onlineUserIds = removeFromArray(onlineUserIds,recipientId);
          }
         
     // alert(onlineUserIds);
     }
   
    $("#recipientName").html(name);
      $("[name='li_showChatArea']").each(function(){
        
          $(this).attr("class","");
      });
     $("#li_showChatArea_"+recipientId).attr("class","active");
      $("#offlineIcon_"+recipientId).hide();
    
    var queryString = "userId=<?php echo $userId ?>&recipientId="+recipientId;
   // alert(queryString);
    ajaxRequest("/chat/getChatConversations", queryString, showChatAreaHandler); 
    enterChatRoom('<?php echo $userId ?>',recipientId,'<?php echo $profilePicture ?>');
}
function showChatAreaHandler(data){
  //alert(data.toSource());
    var data = data.data;
   // alert(data.toSource());
    if(data!=null){
          var item = {
                        "data": data.conversations
                    };
      $("#chatData").html($("#chatMessageTmpl").render(item));
    }
      $("[name='chatmessagearea']").show();
     // $('#chatBoxScrollPane').jScrollPane({stickToBottom:true});
      $('#chatBoxScrollPane').jScrollPane({ autoReinitialise: true,stickToBottom:true }); 
      var api = $('#chatBoxScrollPane').data('jsp');
    // api.scrollToY(parseInt(250));
     api.scrollToBottom(false);
}

//$("#minChatWidget").bind("click",function(){
//       isDuringAjax=false;
//          $("#chartDiv").hide();
//          $("#contentDiv,#minCharWidgetDiv").show();
//          sessionStorage.minChatWidget = true;
//});
$('#inviteInput').keypress(function(e) { 
                if(e.which == 13) { 
                        //$('#mjmChatSend').focus().click();
                       inviteUser('1','Suresh Reddy');
                        e.preventDefault();
                }
 });
 function inviteUser(inviteUserId,inviteUserDisplayName){
  
 }
 function displayMyChat(message){ 
     buidMessage('<?php echo $profilePicture ?>', message);
 }
// $('#chatBoxScrollPane').jScrollPane({}).bind('scroll', function(e)
//        { 
//          var api = $('#chatBoxScrollPane').data('jsp');    
//                  //alert(api.getPercentScrolledY());
//       if(api.getPercentScrolledY()==0){
//           alert('top');
//       } 
//              
//        }
//);
//function  popFromMinChatArray(userId){
//     if(minChatArray.length>0){
////         if(minChatArray.length==4){
////             //pop first element
////             var poppedUserId = minChatArray.shift();
////             minChatArray.push(userId);
////             removeMinChatDiv(poppedUserId);
////         }else{
//             //delete given one
//             if(minChatArray.indexOf(userId)!=-1){
//              minChatArray = removeFromArray(minChatArray,userId);
//              removeMinChatDiv(userId);
//             
//         } 
//        // }
//        
//         // alert(minChatArray);
//        
//     }
//      
//}
//function pushToMinChatArray(){
//   // alert(maxChatArray[0]);
//   if(maxChatArray.length>0){
//        var minChatuserId = maxChatArray[0];
//    var minChatuserName = maxChatArray[1];
//    if(minChatArray.length==4){
//         var poppedUserId = minChatArray.shift();
//          removeMinChatDiv(poppedUserId);
//    }
//    minChatArray.push(minChatuserId);
//    maxChatArray=[];//clear max chat array
//   // alert(maxChatArray);
//     createMinChatDiv(minChatuserId,minChatuserName);
//   }
//   
//   }
//   function pushToMaxChatArray(recipientId,name){
//      maxChatArray.push(recipientId);
//      maxChatArray.push(name);
//   
//   }
//   function createMinChatDiv(minChatuserId,minChatuserName){
//       alert(minChatuserId+"---"+minChatuserName);
//   }
//function  removeMinChatDiv(userId){
//    alert('remvoeMinchatDov---'+userId);
//}
</script>
    
       


