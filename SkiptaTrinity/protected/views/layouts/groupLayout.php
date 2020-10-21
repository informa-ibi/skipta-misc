<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Skipta</title>
    <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
    <meta name="description" content="">
    <meta name="author" content="">
   <link rel="shortcut icon" href="/images/system/favicon.png">

     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fonts.css" />
       
           <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/simplePagination/simplePagination.css"/>
           <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/timepicker.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.atwho.css" />
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fileuploader.css" />
     <style type="text/css">.dropdown-backdrop {position: fixed;left:0;z-index:997;display:none;}</style>
          <script src="http://jwpsrv.com/library/lTLXvre_EeKQUxIxOQulpA.js"></script> 
        <!-- scripts -->
         <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.atwho.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/simplePagination/jquery.simplePagination.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsrender.js"></script>
                <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fileuploader.js"></script>

        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/adminOperations.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/groupPost.js"></script>
                <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/post.js"></script>

        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>

 <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.min.js"></script>
      <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slicknav.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

      <!--[if lt IE 9]>
           <script src="<?php echo YII::app()->getBaseUrl() ?>/js/html5.js"></script>
           <link href="<?php echo YII::app()->getBaseUrl() ?>/css/ie.css" rel="stylesheet"/>
         <![endif]-->
    <!-- Fav and touch icons -->
  <script type="text/javascript" src="<?php echo YII::app()->getBaseUrl() ?>/js/jquery.mousewheel.js"></script>
     <script type="text/javascript" src="<?php echo YII::app()->getBaseUrl() ?>/js/jquery.jscrollpane.min.js"></script>
      <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->params['ChatNodeURL'];?>/socket.io/socket.io.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->params['NotificationNodeURL'];?>/socket.io/socket.io.js"></script>
   <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->params['NodeURL'];?>/socket.io/socket.io.js"></script>
 
<script>
        google.load("visualization", "1", {packages:["corechart"]});
    // tooltip demo
    $('.tooltiplink').tooltip({
     
    })
    $(document).ready(function(){
	$('#menu').slicknav({
	prependTo:'#sidebar'
	
	});
});
 var loginUserId = '<?php echo $this->tinyObject->UserId; ?>';
    var displayName = '<?php echo $this->tinyObject->DisplayName; ?>';
    </script>
   <?php
  include 'chatMessage.php';
  include 'mjmChatSocket.php'
  
  ?> 
  </head>

<body>
    <div id="notificationsdiv" class="storiestop" >  
        <div style="display:table;margin:auto;cursor:pointer;opacity: 1;background: #fff;margin:auto;box-shadow: 2px 2px 2px 2px  #ccc;border-radius:10px;padding:10px;color:#818285">You have <br/><i style="vertical-align: sub;color: #017BC4;font-size:18px;font-family:'exo_2.0bold';font-style: normal;padding:0px;" id='notificationsCount'></i> more<br/> <span id="notificationsTitle"></span></div>
                   
    </div>
     <!-- Modal -->
            <div class="modal fade" id="sessionTimeoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-session">
                    <div class="modal-content ">
                        <div class="modal-header" id="sessionTimeout_header">
<!--                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                            <h4 class="modal-title" id="sessionTimeoutLabel">Modal title</h4>
                        </div>
                        <div class="modal-body" id="sessionTimeout_body">
    
                        </div>
                        <div class="modal-footer" id="sessionTimeout_footer">
                            <button type="button" class="btn btn-small" id="login_btn" ><?php echo Yii::t('translation','Login'); ?></button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="myModal_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            <div id="myModal_message"></div>
                        </div>
                        <div class="modal-body" id="myModal_body">

                        </div>
                        <div class="modal-footer" id="myModal_footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="myModal_closeButton"><?php echo Yii::t('translation','Close'); ?></button>
                            <button type="button" class="btn" id="myModal_saveButton"><?php echo Yii::t('translation','Save_changes'); ?></button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
                 <!-- Modal -->
            <div class="modal fade" id="myModal_old" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                
                    <div class="" style="position:absolute;top:0;left:0;bottom:0;right:0;z-index: 99999; ">
                        <div style="position: fixed;right:0px;top:10px;text-align: right;">
                             <a href="#"  class="detailed_image_close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></a>
                        </div>
                       
                <table cellpadding="0" cellspacing="0" style="width:100%;height:100%;">
                    <tr>
                        <td style="text-align: center;vertical-align: middle;">
                            
                             <div class="player">
                            <div id="player" ></div>
                            </div>
                             <img id="showoriginalpicture" src="" style="max-width:100%;"/>    
                           
                            </td>
                    </tr>
                    
                </table>
            </div>
               <!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <?php include 'header.php'; ?>

            <section id="streamsection" class="streamsection" >
                <div class="container">
                    <?php include 'leftmenu.php'; ?>
                     <div id="sidebar"></div>  
                     <div class="streamsectionarea" id="notificationHomediv" style="display:none;">
    <div class="padding10ltb">
         <h2 class="pagetitle"><?php echo Yii::t('translation','History'); ?> 
             <a id="history_close" href="#" class="notification_history_close pull-right" data-toggle="tooltip" data-placement="left" title="Close"> <i class="fa fa-times"></i></a>         
         </h2> 
        <div style="text-align: right" id="markallasreaddiv">
            <div class="markread" style="padding-bottom:4px;">
                   <a class="markallasread_notification markasreadlink" href="#" data-type="history"><i class="fa fa-check"></i> <?php echo Yii::t('translation','Mark_all_as_Read'); ?> </a>
                    </div>
        </div>
            <div id="notificationHistory" style="display: none" ></div>
               
    </div>
    </div>
            <div id="nomorenotifications" style="display:none;">                
                                    
                    <div class="notificationresults" style="text-align: center;font-size: 16px;" id="notificationText"></div>
                
                
               
            </div>
                      <div id="admin_PostDetails" class="streamsectionarea padding10 displayn"></div>
                      <div id="contentDiv"  >
                    <div class="streamsectionarea">
                       
                       
                             <div class="padding10ltb"> 
                            <?php echo $content; ?>
                        </div>
                       </div>       
                    </div>
                     <div id="chartDiv" style="display: none" >
                <?php include 'chatLayout.php'; ?>  
            </div>
                </div>
            </section>

    
    
            <?php include 'footer.php'; ?>
<div style="position:fixed;bottom:0;right:0;display: none;z-index: 9000;" id="minCharWidgetDiv" >
    <div class="closedchat">
    <a href="#" class="chat_plus"><?php echo Yii::t('translation','Chat_conversation_Started'); ?>... <i class="fa fa-plus"></i></a>
	</div>
    </div>
</body>
</html>
<script type="text/javascript">
var g_streamPostIds = 0;
$("#minCharWidgetDiv").bind("click",function(){
    showChatWidget();
//      $("#chartDiv").show();
//          $("#contentDiv,#minCharWidgetDiv").hide();
//          sessionStorage.removeItem("minChatWidget");
});
$(document).ready(function(){
   getOfflineMessages(loginUserId); 
   if(sessionStorage.minChatWidget=="true"){
      // $("#minCharWidgetDiv").show();
   }
});
ClearNodeIntervals();
    </script>
<?php include 'notifications.php'; ?>