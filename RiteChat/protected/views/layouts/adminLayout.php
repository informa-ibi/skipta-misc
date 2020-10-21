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

      <!-- scripts -->
      <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/simplePagination/jquery.simplePagination.js"></script>
      <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
      <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsrender.js"></script>
      <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/adminOperations.js"></script>
      <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fileuploader.js"></script>
       <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fileuploader.css"/>
       <script type="text/javascript" src="<?php echo YII::app()->getBaseUrl() ?>/js/jquery.mousewheel.js"></script>
     <script type="text/javascript" src="<?php echo YII::app()->getBaseUrl() ?>/js/jquery.jscrollpane.min.js"></script>
   <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/post.js"></script>

       <script src="http://jwpsrv.com/library/lTLXvre_EeKQUxIxOQulpA.js"></script> 
      <!--[if lt IE 9]>
           <script src="<?php echo YII::app()->getBaseUrl() ?>/js/html5.js"></script>
           <link href="<?php echo YII::app()->getBaseUrl() ?>/css/ie.css" rel="stylesheet"/>
         <![endif]-->
 <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->params['NodeURL'];?>/socket.io/socket.io.js"></script>

      <script>
          // tooltip demo
          $('.tooltiplink').tooltip({
          })
          $(document).ready(function(){
                // IE7 or IE8 Placeholder don't remove
               if($.browser.msie){
                    $('input[placeholder]').each(function(){
                    var input = $(this);
                    $(input).val(input.attr('placeholder'));
                    $(input).focus(function(){
                    if (input.val() == input.attr('placeholder')) {
                    input.val('');
                    }
                    });
                    $(input).blur(function(){
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.val(input.attr('placeholder'));
                    }
                    });
                    });
              }; 
            });
      </script>
  
  </head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content form">
                        
                        <div class="modal-header" id="myModal_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            <div id="myModal_message"></div>
                        </div>
                        <div class="modal-body" id="myModal_body">
                           
                        </div>
                        <div class="modal-footer" id="myModal_footer">
                            <button type="button" class="btn" id="myModal_saveButton">Update</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <?php include 'header.php'; ?>

<section id="streamsection" class="streamsection" >
	<div class="container">
   <?php include 'leftmenu.php'; ?>
             <div id="admin_PostDetails" class="streamsectionarea padding10 displayn"></div>
            <div id="contentDiv">
                <?php echo $content;?>
            </div>
            
              
	</div>
</section>

    
    
            <?php include 'footer.php'; ?>

</body>
</html>