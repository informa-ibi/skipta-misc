<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> <?php  echo Yii::t('translation', 'ProjectTitle');?></title>
    <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
    <meta name="description" content="">
    <meta http-equiv="X-Frame-Options" content="deny">
    <meta name="author" content="">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/images/favicon.ico" type="image/x-icon">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaNeo_layout.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaNeo_page.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-trinity_commonpage.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptatheme.css" rel="stylesheet" type="text/css" media="screen" />
        <?php if(Yii::app()->params['Project'] != "Trinity"){ ?>
   <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/css/style.css" rel="stylesheet">
   <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/css/<?php echo Yii::app()->params['ThemeName']; ?>" rel="stylesheet">
        <?php } ?>
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fonts.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">.dropdown-backdrop {position:absolute;}</style>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"> </script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.mousewheel.js"></script>  
    <script type="text/javascript" src="<?php echo YII::app()->getBaseUrl() ?>/js/jquery.jscrollpane.custom.min.js"></script>
   <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/timezone.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
    <?php if(Yii::app()->params['Project'] != "Trinity"){ ?>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>themes/<?php echo Yii::app()->params['Project']; ?>/js/init.js"></script>
  <?php } ?>
   <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/css3-mediaqueries.js"></script>
       <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" rel="stylesheet">
    <![endif]-->
        <!--[if lt IE 10]>
     <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie_placeholder.css" rel="stylesheet">
    <![endif]-->   
   <script type="text/javascript">
      
            $(document).ready(function(){
                if(!detectDevices()){                   
                    $("[rel=tooltip]").tooltip();
                }
                if(location.search!="" && getParameterByName('fromNetwork')!="")
            {
                document.cookie="providerLink="+getParameterByName('providerLink');
                document.cookie="fromNetwork="+getParameterByName('fromNetwork');
              // alert(getParameterByName('fromNetwork')); 
               $("#"+getParameterByName('fromNetwork')).click();
               // window.location.href=decodeURIComponent(getParameterByName('url'));
            }
        
           });

        //Example how to use it: 
      
       
              function detectDevices() {
                var isMobile = {
                    Android: function() {
                        return navigator.userAgent.match(/Android/i);
                    },
                    BlackBerry: function() {
                        return navigator.userAgent.match(/BlackBerry/i);
                    },
                    iOS: function() {
                        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                    },
                    Opera: function() {
                        return navigator.userAgent.match(/Opera Mini/i);
                    },
                    Windows: function() {
                        return navigator.userAgent.match(/IEMobile/i);
                    },
                    any: function() {
                        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                    }
                };
                if (isMobile.any()) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </head>
<body data-spy="scroll" data-target=".navbar-wrapper" data-offset="70">  
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
     <?php if(Yii::app()->params['Project']!='Trinity'){ ?>
        <?php include_once(getcwd()."/themes/".Yii::app()->params['Project']."/prelogin_header.php");?>
 <?php } ?>
