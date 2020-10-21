	<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Skipta</title>
    <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
    <meta name="description" content="">
    <meta name="author" content="">
   <link rel="shortcut icon" href="images/favicon.png">
 <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/bootstrap-skiptaNeo_layout.css" rel="stylesheet"> 
    <link href="/css/bootstrap-skiptaNeo_page.css" rel="stylesheet">     
    <link href="/css/bootstrap-skiptatheme.css" rel="stylesheet">      
     <link href="/css/fonts.css" rel="stylesheet">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    	<script src="js/html5.js" type="text/javascript"></script>
       <link href="css/ie.css" rel="stylesheet">
    <![endif]-->
    <!-- Fav and touch icons -->
  <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/simplePagination/jquery.simplePagination.js"></script> 
        <style type="text/css">.dropdown-backdrop {position: fixed;left:0;z-index:997;display:none}</style>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsrender.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/freshereditor.min.js" type="text/javascript"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.atwho.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/prettyCheckable.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/timezone.js"></script>

   
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsapi.js"></script>
            <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/googlevis.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/googleRgbcolor.js"></script> 
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/googleCanvg.js"></script>
            
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
     <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
    <script>
    // tooltip demo
    $('.tooltiplink').tooltip({
     
    })
	function showmore(id){
	document.getElementById(id).style.overflow="visible";
	document.getElementById(id).style.height=" ";
	
	}
	$(document).ready(function() {
    // Tab initialization
	$("#answerstabs ul li").click(function(){
 $('#answerstabs ul li').removeClass("active");
 $(this).addClass("active");
}); 
	
	
	
});
    </script>


    
   <script type="text/javascript" src="js/custom-form-elements.js"> </script>
  </head>

<body>
    <div class="padding10">
    <?php echo $content; ?>
    </div>
</body>
</html>
