<script id="inviteTemplate_render" type="text/x-jsrender">
    <div id="inviteDiv_{{>id}}">
        <div class="alert alert-success" id="inviteTextAreaSuccess_{{>id}}" style='padding-top: 5px;display: none'></div> 
               <div class="alert alert-error" id="inviteTextAreaError_{{>PostId}}" style='padding-top: 5px;display: none'></div> 

        <div id="invitedUsersDiv" class="padding-bottom10 marginbottom10 borderbottom1" style="display:none"></div>
        <div id="inviteTextBox_{{>id}}_currentMentions"></div>
        <div id="inviteBox_{{>id}}" >
            <div id="invite_{{>id}}" class="paddinglrtp5" >
                <div class="row-fluid  ">
                    <div class="span12 success">
                        <label >Mentions</label>                        
                        <input type="text" id="inviteTextBox_{{>id}}" class="span12 textfield " maxlength="50" placeholder=""> 
                        <div class="control-group controlerror">
                            <div style="display: none;" id="InviteTextBox_{{>id}}_em_" class="error errorMessage">Mention atleast one user.</div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid  ">
                    <div class="span12 success">
                        <label >Message</label>  
                        <div id="inviteTextArea_{{>id}}" class="invite_inputor" contentEditable="true"></div>
                        <div class="control-group controlerror">
                            <div style="display: none;" id="InviteTextArea_{{>id}}_em_" class="error errorMessage">Message cannot be blank.</div>
                        </div>
                    </div>
                </div>
                <div class="headerbuttonpopup h_center padding8top">
                    <div class="alignright">
                        <button id="saveInviteButton_{{>id}}" onclick="saveInvites('{{>PostId}}',{{>NetworkId}},{{>CategoryType}},'{{>id}}');" class="btn btn-2 btn-2a" >Invite</button>
                        <button class="btn btn_gray " onclick="cancelInvite('{{>id}}')" id="cancelInviteButton_{{>id}}"> Cancel</button>            
                    </div>
            </div>
            </div>
        </div>
    </div>
</script>


