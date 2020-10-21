<div id="numero1"><h2 class="pagetitle">Custom Bagdes</h2></div>
<ul  class="custom_badgesul ">
<?php
if(count($customBadgeDetails)>0){
    
    foreach($customBadgeDetails as $customBadge){?>
        
                       
                            
    <li id="badgesInt_<?php echo $customBadge['id']; ?>" >
        
            <div class="badgelist" >
                <div class="badgesbox"  >
                <div class="badgeimages" id="badge" data-badgeId="<?php echo $customBadge['id']; ?>">
                    
                <a id="title_<?php echo $customBadge['id']; ?>" data-original-title="<?php echo $customBadge['badgeName']; ?>" rel="tooltip" data-placement="bottom" class="badgesId"  data-value="<?php echo $customBadge['id'] ?>" >
                    <img id="src_<?php echo $customBadge['id']; ?>" src="<?php echo $customBadge['image_path'] ?>" alt="" />
                </a>
            </div>
                <div class="actionfielddiv" >
                    <div class="editBadge" >    
           
           <span id="EBadge"  data-id="<?php echo $customBadge['id']; ?>" class="fa fa-pencil-square" style="min-width:0;font-size:25px;color:#868686;cursor:pointer"></span>
                            </div>
                </div>
                </div></div> 
    </li>
                              
                        
                   
                       <?php  }?>     
    
     </ul> 
    <div id="inviteDiv_" style="display:none" class="custombagesresults">
        <div class="alert alert-success" id="inviteTextAreaSuccess_" style='padding-top: 5px;display: none'></div> 
               <div class="alert alert-error" id="inviteTextAreaError_" style='padding-top: 5px;display: none'></div> 

        <div id="invitedUsersDiv" class="padding-bottom10 marginbottom10 borderbottom1" style="display:none"></div>
        
        <div id="inviteBox_" >
            
            <div id="invite_" class="paddinglrtp5" >
                <div class="row-fluid  ">
                    <div class="span12 success">
                       
                        <div id="inviteTextBox__currentMentions"></div>
                        <label class="assigncustbadgeheader">Please add users</label>                        
                        <input disabled="true" type="text" id="inviteTextBox_" class="span12 textfield " maxlength="50" placeholder=""> 
                        <div class="control-group controlerror">
                            <div style="display: none;" id="InviteTextBox__sc" class="alert alert-success">Assigned batch to the user successfully.</div>
                            <div style="display: none;" id="InviteTextBox__em" class="error errorMessage">Assign atleast one user.</div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        <div class="headerbuttonpopup assigncustbadgebuttonsection">
                    <div class="alignright">
                        <button id="saveInviteButton" onclick="assignBadges(badgeId);" class="btn btn-2 btn-2a" >Assign</button>
                        <button class="btn btn_gray " onclick="cancelAssignBadges()" id="cancelInviteButton"> Cancel</button>            
                    </div>
            </div>
    </div>
<?php }?>
<script type="text/javascript">    
    $("[rel=tooltip]").tooltip();
    var badgeId='';
   
    $("#badge").live("click",
    function() { 
    $(".custom_badgesul li").removeClass("active");    
   // $(this).parent('div>li').addClass("active");
        $("#inviteDiv_").show();
     badgeId=$(this).attr("data-badgeId");
     $('#badgesInt_'+badgeId).addClass("active");
     $('#inviteTextBox_').removeAttr("disabled");
     initializeAtMentionsForBadge("#inviteTextBox_",badgeId);
    
    
    });
    
    
    $("#EBadge").live("click",
    function() { 
        var badgeIdForEdit=$(this).attr("data-id");
        var data = {badgeId:badgeIdForEdit}
         ajaxRequest("/admin/editBadgeDetails",data,function(data){
           // scrollPleaseWaitClose('stream_view_spinner_'+PostId);
            openEditPopUpForCustomBadge(data,badgeIdForEdit);
             
        }); 
        
    });
    function openEditPopUpForCustomBadge(data,badgeId){
        //scrollPleaseWaitClose('spinner_weblink_'+id);
        
        $("#myModal_body").html("");
        $("#myModal_body").html(data.htmlData);        
        $("#myModalLabel").html("Edit Badge");
     //   $("#editlinkgroupname").val($("#WebLinkForm_LinkGroup").val());
        $('#myModelDialog').css("width","603px");        
        $("#myModal").modal('show');
        $("#myModal_footer").hide();
    }
    
    </script>