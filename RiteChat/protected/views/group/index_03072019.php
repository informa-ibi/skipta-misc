<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script>
<div id="usergroupsfollowingdiv">
            <?php include 'userGroupsFollowing.php'; ?>
<?php include 'snippetDetails.php'?>
<div class="row-fluid" >
    <div class="span3" id="numero1"><h2 class="pagetitle">Groups </h2></div><!-- This id numero1 is used for Joyride help -->
   
    <div class="span9 ">
        <!--replace class "fa fa-question" with  "fa fa-video-camera videohelpicon" if we have description and video remaining will be same-->
            
        
            <div class="searchgroups" >
                <?php if(isset($canCreateGroup) && $canCreateGroup==1) {?> 
            <input class="btn " id='addGroup' name="commit" type="submit" data-toggle="dropdown" value="Add New Group" /> 
             
<div id="addNewGroup" class="dropdown dropdown-menu actionmorediv actionmoredivtop newgrouppopup newgrouppopupdivtop" >
            
			<div class="headerpoptitle_white"><?php echo Yii::t('translation', 'Group_Creation');?></div>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'groupcreation-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    //'action'=>Yii::app()->createUrl('//user/forgot'),
                    'htmlOptions' => array(
                        'style' => 'margin: 0px; accept-charset=UTF-8',
                    ),
                ));
                ?>
                        <?php echo $form->hiddenField($newGroupModel, 'IFrameMode'); ?>  
                        <?php echo $form->hiddenField($newGroupModel, 'GroupMenu'); ?>  
                        
                        <div id="groupCreationSpinner"></div>
                <div class="alert alert-error" id="errmsgForGroupCreation" style='display: none'></div>
                <div class="alert alert-success" id="sucmsgForGroupCreation" style='display: none'></div> 
                
                <div class="row-fluid  ">
                    <div class="span12">

                       <?php echo $form->labelEx($newGroupModel, Yii::t('translation', 'GroupName')); ?>
                        <div class="chat_profileareasearch" ><?php echo $form->textField($newGroupModel, 'GroupName', array('maxlength' => 50, 'class' => 'span12 textfield')); ?> 
                            </div>
                        <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'GroupName'); ?>
                        </div>
                    </div>
                </div>
                <div class="row-fluid  ">
                    <div class="span12">

                    <?php echo $form->labelEx($newGroupModel, Yii::t('translation', 'GroupDescription')); ?>
                    <?php echo $form->textArea($newGroupModel, 'Description', array( 'class' => 'span12  inputor')); ?> 
                   
                    <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'Description'); ?>
                        </div>
                    </div>
                </div>
                <div class="row-fluid padding8top">
                    <div class="span12">
                        <div class="span6">
                            <?php echo $form->labelEx($newGroupModel, Yii::t('translation', 'GroupMode')); ?>
                            <?php if(Yii::app()->params['IFrameGroup']=='ON' && Yii::app()->params['CustomGroup']=='ON'){?>
                            <div class="positionrelative"  id="">                                
                            <?php echo CHtml::dropDownList('mode', '', 
              array('0' => ' Native Mode', '1' => ' IFrame Mode ', '2' => 'Custom Mode'),array('empty' => "Select mode type",'class'=>"styled span12 textfield")); ?>
                                </div>
                            <?php }else if(Yii::app()->params['IFrameGroup']=='ON' && Yii::app()->params['CustomGroup']=='OFF'){?>
                            <div class="positionrelative"  id="">                                
                            <?php echo CHtml::dropDownList('mode', '', 
              array('0' => ' Native Mode', '1' => ' IFrame Mode '),array('empty' => "Select mode type",'class'=>"styled span12 textfield")); ?>
                                </div>
                           <?php }else if(Yii::app()->params['IFrameGroup']=='OFF' && Yii::app()->params['CustomGroup']=='OFF'){?>
                            <div class="positionrelative"  id="">                                
                            <?php echo CHtml::dropDownList('mode', '', 
              array('0' => ' Native Mode'),array('empty' => "Select mode type",'class'=>"styled span12 textfield")); ?>
                                </div>
                            <?php }?>
                        <?php 
                            //echo $form->radioButton($newGroupModel,'IFrameMode',array('value'=>0,"id"=>"GroupCreationForm_IFrameMode",'uncheckValue'=>null,'class'=>'styled', 'onclick'=>'changeGroupMode("Native")','closeSnippetDiv()'));     
                        ?>
                            <!--Native Mode-->
                            <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'IFrameMode'); ?>
                        </div>
                        </div>
                        
                        <div class="span6" style="display: none;" id="custommenu">
                            <?php echo $form->labelEx($newGroupModel, Yii::t('translation', 'GroupMenu')); ?>
                            <div class="positionrelative" >
                            <?php echo CHtml::dropDownList('menutype', '', 
              array('1' => ' Horizontal Menu', '2' => ' Vertical Menu ', '3' => 'No Menu'),array('empty' => "Select menu type",'class'=>"styled span12 textfield")); ?>
                                </div>
                        <?php 
                            //echo $form->radioButton($newGroupModel,'IFrameMode',array('value'=>1,"id"=>"GroupCreationForm_IFrameMode",'uncheckValue'=>null,'class'=>'styled', 'onclick'=>'changeGroupMode("IFrame")'));     
                        ?>
                            <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'GroupMenu'); ?>
                        </div>
                        </div>
                      </div>
                  </div>
                <div class="row-fluid  " id="IFrameURLDiv" style="display: none">
                    <div class="span12">

                       <?php echo $form->labelEx($newGroupModel, Yii::t('translation', 'IFrameURL')); ?>
                        <?php echo $form->textField($newGroupModel, 'IFrameURL', array( 'maxlength' => 100, 'class' => 'span12 textfield', 'onkeyup'=>'getsnipetIframe(this.id)','value'=>'')); ?> 
                        <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'IFrameURL'); ?>
                        </div>
                    </div>
                </div>
             <div  id="snippet_main" style="display:none; padding-top: 10px;padding-bottom:0px;" ></div>
             <div class="row-fluid lineheight25"  id="GroupCreationAutoPrivateMode" style=" padding-top: 10px;padding-bottom:0px;">
                 <div class="span12">
                    <div class="span6">

                    
                   <?php echo $form->checkBox($newGroupModel,'IsPrivate',array('class' => 'styled'))?>
                         Mark as Private
                    <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'IsPrivate'); ?>
                        </div>
                    </div>
                 <div class="span6">

                    
                   <?php echo $form->checkBox($newGroupModel,'AutoFollow',array('class' => 'styled'))?>
                         Auto follow this group
                    <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'AutoFollow'); ?>
                        </div>
                    </div>
                 
                 </div>
                </div>
                   <div class="row-fluid lineheight25" >
                  <div class="span6">
                   <?php echo $form->checkBox($newGroupModel,'AddSocialActions',array('class' => 'styled'))?>
                       <?php  echo  Yii::t('translation','Show_SocialAction_Label');?>
                    <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'AddSocialActions'); ?>
                        </div>
                    </div>
                 <div class="span6" > 
                   <?php echo $form->checkBox($newGroupModel,'DisableWebPreview',array('class' => 'styled'))?>
                         Disable Web Preview for URLs?
                    <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'DisableWebPreview'); ?>
                        </div>
                 
                 </div>
                </div>
                <div class="row-fluid lineheight25" >

                 <div class="span6" id="groupVisibility"> 
                   <?php echo $form->checkBox($newGroupModel,'ConversationVisibility',array('class' => 'styled',"checked"=>"checked"))?>
                         Show Conversations outside Group
                    <div class="control-group controlerror">
                            <?php echo $form->error($newGroupModel, 'ConversationVisibility'); ?>
                        </div>
                 
                 </div>
                </div>             
                <div class="groupcreationbuttonstyle alignright">
                    
                        <?php
                        echo CHtml::ajaxSubmitButton('Create', array('/group/createnewgroup'), array(
                            'type' => 'POST',
                            'dataType' => 'json',
                            'error' => 'function(error){
                                        }',
                            'beforeSend' => 'function(){    
                                scrollPleaseWait("groupCreationSpinner","groupcreation-form");                }',
                            'complete' => 'function(){
                                                    }',
                            'success' => 'function(data,status,xhr) { groupCreationHandler(data,status,xhr);}'), array('type' => 'submit', 'id' => 'newGroupId', 'class' => 'btn')
                        );
                        ?>
                        <?php echo CHtml::resetButton('Cancel', array("id" => 'NewGroupReset', 'class' => 'btn btn_gray','onclick'=>'closeSnippetDiv()')); ?>

                </div>
            <?php $this->endWidget(); ?>
            </div>
             <?php }?>
            <i data-id="Groups_DivId" class="fa fa-question helpicon helpmanagement helprelative pull-right pull-bottom tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="Groups" ></i> 
        </div>
           

    </div>
    
    
</div>
<div id="groupslogoarea" class="groupslogoarea">
    <div id="groupsSpinLoader"></div>
    <div id="groupsFollowingId">
        
        <div id="noRecordsForFollowedGroups" style="display: none">
    <table>
        <tr>
            <td colspan="8">
                <span class="text-error"> <b>No records found</b></span>
            </td>
        </tr>
     </table>
   </div>
    </div>
</div>

    <div id="numero2"><h2 class="pagetitle">Join more Groups </h2></div><!-- This id numero2 is used for Joyride help -->



<div id="main" role="main">

      <ul id="MoreGroupsDiv" class="profilebox">
       
        <!-- End of grid blocks -->
      </ul>

    </div>
</div>
<div id="groupPostDetailedDiv" style="display: none;"></div>

<script type="text/javascript" >
     gPage = "Group";
Custom.init();
     $(document).ready(function(){   checkPrivateAndAutoFollow();   
        $("b[class=group]").live( "click", function(){ 
            var groupName=$(this).attr('data-name');
            window.location="/"+groupName;            
          // loadGroupDetailPage($(this).attr('data-id'));
        } );
        $("#streamMainDiv div[name=groupimage]").live( "click", function(){
           // var groupId=$(this).attr('data-id');
            //window.location='/group/groupdetail?data-id='+groupId
              var groupName=$(this).attr('data-name');
            window.location="/"+groupName;
          // loadGroupDetailPage($(this).attr('data-id'));          
         } );
        $("li[name=GroupDetail]").live( "click", function(){ 
            var groupName=$(this).attr('data-name');
            var customGroup = $(this).data("customgroup");   
            
                window.location="/"+groupName;            
            
          // loadGroupDetailPage($(this).attr('data-id'));
        } );
        getCollectionData('/group/getJoinMoreGroups', 'GroupCollection', 'MoreGroupsDiv', 'No groups found','No more groups');
   
        trackEngagementAction("Loaded");  
    });
$("#grouppost").addClass('active');
    var startLimit=0;
    var pageLength=8;
    var userFollowingGroupsCount=0;
      bindGroupsForStreamFromIndex();
  //  groupsFollowingHandler(<?php echo $userGroupsFollowing; ?>,<?php echo $userGroupsFollowingCount; ?>);
       groupsFollowing();
    
   function groupsFollowing(){
   
        var query="test";
        ajaxRequest('/group/getUserFollowingGroups', query, groupsFollowingHandler);
    }
    function groupsFollowingHandler(data){            
       userFollowingGroupsCount= Number(data.count);
       
        var item = {
            'data':data.data
        };
    
      
         if (data != "") 
         {
             $("#groupsFollowingId").html(
             $("#groupFollowingTmpl_render").render(item)      
                );
         }
         startLimit = Number((data.data).length);
        
        if ((data.data).length == 0) {
            $("#noRecordsTRgroupFollowing").show();
        }
        
        if((data.data).length< userFollowingGroupsCount)
        {
            var moreCount = Number(userFollowingGroupsCount)- Number((data.data).length);
           // alert("count-------"+moreCount);
            $("#moreFollowingGroupsId").show();
            
             $("#totalcount").html(moreCount)      
             
        }
        if(!detectDevices())
            $("[rel=tooltip]").tooltip();
    }
    
     $("#NewGroupReset").bind( "click touchend", 
        function(e){
           $('#addNewGroup').hide();           
           e.stopPropogation();
        }
    );
    $("#addGroup").bind( "click touchstart", 
        function(){
           $('#addNewGroup').show();
           $('#IFrameURLDiv').hide();
           $("#selectmode").html("Select mode type");
           $("#selectmenutype").html("Select menu type");
           $("#mode").val("");
           $("#custommenu").hide();
           $("#menutype").val("");
           $("#GroupCreationForm_GroupName,#GroupCreationForm_Description,GroupCreationForm_IFrameMode,GroupCreationForm_GroupMenu").val("")
           Custom.init();
        }
    );
    
    function showmoreGroups(){
       
	 scrollPleaseWait('groupsSpinLoader','groupslogoarea');         
        var query="startLimit=" +startLimit+ "&pageLength=" +pageLength;
        ajaxRequest('/group/getMoreFollowingGroups', query, moreGroupsFollowingHandler);
	}
        
        
        
      function moreGroupsFollowingHandler(data){
         scrollPleaseWaitClose('groupsSpinLoader');
        
        var item = {
            'data':data.data
        };
         if (data.data != "") 
         {
         
             $("#groupsFollowingId").append(
             $("#groupFollowingTmpl_render").render(item)      
                );
              
         }
         startLimit = Number(data.data.length) + Number(startLimit);
        if (data.length == 0) {
        $("#noRecordsTR").show();
        }
        if(data.data.length < userFollowingGroupsCount)
        {
            $("#moreFollowingGroupsId").show();
            var moreCount = Number(userFollowingGroupsCount)- Number(startLimit);
             $("#totalcount").html(moreCount)      
             
        }
        if(!detectDevices())
            $("[rel=tooltip]").tooltip();
    }
    /*
     * Handler for requesting new category
     */
    function groupCreationHandler(data,txtstatus,xhr){
     scrollPleaseWaitClose("groupCreationSpinner");
          var data=eval(data); 
        if(data.status =='success'){
            var msg=data.data;
            $("#sucmsgForGroupCreation").html(msg);
            $("#sucmsgForGroupCreation").css("display", "block");
            $("#errmsgForGroupCreation").css("display", "none");
            $("#groupcreation-form")[0].reset();
            $('#snippet_main').hide();
            $("#snippet_main").html("");
            globalspace['IsWebSnippetExistForPost']=0;
            globalspace['weburls']="";
            $("#sucmsgForGroupCreation").fadeOut(3000,function(){
            $("#addNewGroup").hide();
        }); 
        groupsFollowing();
        }else{
            var lengthvalue=data.error.length;            
            var msg=data.data;
            var error=[];
            if(msg!=""){                
                    $("#errmsgForGroupCreation").html(msg);
                    $("#errmsgForGroupCreation").css("display", "block");
                    $("#sucmsgForGroupCreation").css("display", "none");
                    $("#errmsgForGroupCreation").fadeOut(5000);
       
            }else{
                
                if(typeof(data.error)=='string'){
                
                var error=eval("("+data.error.toString()+")");
                
            }else{
                
                var error=eval(data.error);
            }
            
            
            $.each(error, function(key, val) {
                if($("#"+key+"_em_")){  
                    $("#"+key+"_em_").text(val);                                                    
                    $("#"+key+"_em_").show();   
                    $("#"+key+"_em_").fadeOut(5000);
                   // $("#"+key).parent().addClass('error');
                }
                
            }); 
          }
        }
     }
   function bindGroupsForStreamFromIndex(){  
    
        $(".stream_content img.follow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"UnFollow");
            
             $("#groupId_"+groupId).remove();
           applyLayout();
             groupsFollowing();
          
           $(this).attr({
               "class":"unfollow" 
            });
        }
    );
    $(".stream_content img.unfollow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"Follow");
             groupsFollowing();            
            $("#groupId_"+groupId).remove();
           applyLayout();
            
            $(this).attr({
               "class":"follow" 
            });
        }
    );   
     $(".streamMainDiv img.follow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"UnFollow");
           $(this).attr({
               "class":"unfollow" 
            });
        }
    );
    $("#streamMainDiv img.unfollow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"Follow");
            $(this).attr({
               "class":"follow" 
            });
        }
    );
    $('span.radio').live("click",
        function(){
            if($(this).next().val()==0){
                $('#IFrameURLDiv').hide();
                closeSnippetDiv();
            }else{
                $('#IFrameURLDiv').show();
                getsnipetIframe(event,id);
                 $('#snippet_main').show();
                  $('#Snippet_div').show();
            }
        }
    );
   }
</script>
  

<script type="text/javascript">
  var handler = null;
    // Prepare layout options.
        var options = {
          itemWidth: '48%', // Optional min width of a grid item
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#MoreGroupsDiv'), // Optional, used for some extra CSS styling
          offset: 8, // Optional, the distance between grid items
          outerOffset: 10, // Optional the distance from grid to parent
          flexibleWidth: '50%', // Optional, the maximum width of a grid item
          align: 'left'
        };


      /**
       * Refreshes the layout.
       */
       var $window = $(window);
      function applyLayout() {
         
            
        options.container.imagesLoaded(function() {
            // Create a new layout handler when images have loaded.
            handler = $('#MoreGroupsDiv li');
            
        if ($window.width() < 753) {
         
            options.itemWidth = '100%';
            options.flexibleWidth='100%';

        }
           else if ($window.width() > 753 && $window.width() < 1000) {
            
            options.itemWidth = '48%';
           //   options = { flexibleWidth: '100%' };
             
            
        }else{
           
            options.itemWidth = '32.5%'; 
        }
       
            handler.wookmark(options);
            
        });
    };


    $("#mode").on('change',function(){
        var val = $(this).val();
        $("#GroupCreationForm_IFrameMode").val(val);  
        if(val == 2){
            $("#custommenu").show(); 
            $('#IFrameURLDiv,#groupVisibility').hide();
        }else{
            if(val == 1){
                $('#IFrameURLDiv').show();
                $("#groupVisibility").hide();
            }else{
                $('#IFrameURLDiv').hide();
                $("#groupVisibility").show();
            }
            $("#custommenu").hide();
        }
    });   
    
    $("#menutype").on('change',function(){
        var val = $(this).val();
        $("#GroupCreationForm_GroupMenu").val(val);
        
        
    });
        
 $window.resize(function() {
     
  applyLayout();
   
        });
//    $("[rel=tooltip]").tooltip();

  
  </script>
  <script type="text/javascript">
$(document).ready(function(){
                if(!detectDevices()){                   
                    $("[rel=tooltip]").tooltip();
                }
              });
        </script>