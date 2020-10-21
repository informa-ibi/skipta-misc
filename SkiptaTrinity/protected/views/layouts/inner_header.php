<header id="headerzindex">
    <div class="topheaderarea" >
        <div class="container ">
            <div class="row-fluid">
                 <div class="span2 iphonelogo">
             <?php if(Yii::app()->params['Project'] != "Trinity"){ ?>    
                    <a href="/stream"><img src="<?php echo "/themes/".Yii::app()->params['Project'];  ?><?php echo Yii::app()->params['Logo']; ?>" alt="logo" class="logo"></a>                
                     <?php   } ?>
        </div>
                  <div class="span10">
                <div class=" row-fluid">
                    <div class="span5 positionrelative">
            <?php if(Yii::app()->session['IsAdmin']==1  && Yii::app()->session['UserStaticData']['Email']!= Yii::app()->params['NetworkAdminEmail']){ 
                        //$networkName = isset(Yii::app()->session['NetworkAdminUserName'])?Yii::app()->session['NetworkAdminUserName']:"Network";
                        ?>
      <div class="noHeight">
        <div class="row-fluid">
       <div class="span12 min-height0">
           <div class="network_positionabsolutediv"  id="firstStop">
           <div class="aligncenter " id="networkmode" style='display:none' >
               <div class="networkmode"> <!-- This id firstStop is used for Joyride help -->
                   <span>You’re conversing currently as &nbsp; </span><input type="checkbox" id="PostAsNetwork" data-on-label="<?php echo 'Admin' ?>" data-off-label="<?php echo substr(Yii::app()->session['UserStaticData']['FirstName'], 0, 12) ?>" />
                </div>
               </div>
           </div>
       </div></div>
                </div>
                    <?php } ?>
        </div>
                     <div class="span3" id="numero4">
      
    <div id="searchbox"> <div id="searchtextbox" ><input type="text" autocomplete="off" id="SearchTextboxBt"  name="SearchTextbox" placeholder="Search" class="ui-autocomplete-input span12" role="textbox" aria-autocomplete="list" aria-haspopup="true"> </div> <div id="searchtextboxbutton"> </div> 
            <div class="dropdown-menu searchwidth dropdown" id="search" >
                <div id="search_spinner"></div>
            
                 <div class="r_headerpoptitle">Search<span id="searchContextId" class="searchcontext displayn"></span><span id="searchBackId"  onclick="searchBack()" class="pull-right displayn circleback"><i class="fa fa-arrow-left"></i></span></div>
                 <div class="padding4">
                     <div class="padding4">
                     <div id="projectSearchDiv" style="min-height: 300px;overflow: auto">

              </div>
                 </div>
               
             </div>
             </div>
        </div> 
          
   
   
    </div>
                    
                        <?php 
    if(Yii::app()->params['Project']!='Trinity'){ ?>
        <div class="span4 horizontalmodewidget">
       <?php  include 'profilerightwidget.php';?>
         </div>
   <?php }   ?> 
                   
                    
                    
                     </div>
                   
            </div>    
            </div>
        </div>
    </div>
     <?php if (Yii::app()->params['Project']=='ValueDrug') { ?>
    <!--topmenustyleiconswithsquarelabel-->
    <div class="topheaderarea topheaderareamenu topmenustyleicons  topmenustyleiconswithlabel  " >
   	<div class="container ">
            <div class="triheaderarea">
    <div class=" row-fluid customtrinityrow-fluid">
        <div class="span12">
                       
            
       
            
               

            <div class="topmenustyle" >
                <?php include 'leftsideWidgets.php'; ?>
            </div>
       
       
           
            
          
            
            
        
      
   
        </div>
    </div>
    </div>
    </div>
   </div>
  <?php } ?>

</header>
<div id="norecordsFound" style="display: none" ></div>
<script type="text/javascript">
      function logout() {
                    ajaxRequest("/user/logout",{},logoutHandler);
                   
                }
                   
                function logoutHandler(data){
                    
                     pF1 = pF2 = 1;
                    
                    delayCall = true;
                    
                    var scheduleId = sessionStorage.scheduleId;
                    
                    trackUserSession("Logout");
                    // alert(loginUserId+"--"+sessionStorage.scheduleId);
                     //unsetSpot(loginUserId,scheduleId);
                   //  socket.emit('logout', loginUserId);
                   // socketNotifications.emit("clearInterval", sessionStorage.old_key);
                    window.location="/";
                }
    </script>