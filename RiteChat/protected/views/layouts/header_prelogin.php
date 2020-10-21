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
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/favicon.ico" type="image/x-icon">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaNeo_layout.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaNeo_page.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptatheme.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/<?php echo Yii::app()->params['ThemeName']; ?>" rel="stylesheet" type="text/css" media="screen" />
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fonts.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">.dropdown-backdrop {position:absolute;}</style>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"> </script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/timezone.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
    <script language="javascript" type="text/javascript" src="/nodeserver/"></script>  
    
   <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/css3-mediaqueries.js"></script>
       <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" rel="stylesheet">
    <![endif]-->
        <!--[if lt IE 10]>
     <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie_placeholder.css" rel="stylesheet">
    <![endif]-->   
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php  echo Yii::app()->params['ga_transaction_id'];?>', '<?php  echo Yii::app()->params['ga_Analytics_ip'];?>');

  ga('send', 'pageview');

</script>

   <script type="text/javascript">
      
            $(document).ready(function(){
                if(!detectDevices()){                   
                    $("[rel=tooltip]").tooltip();
                }
                sessionStorage.clear();
              });
              
              
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
    <style type="text/css">
        .streamsection_prelogin{position:relative;margin-top:0px}
    </style>
    </head>
<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
<header>
<div class="topheaderarea"> 
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="span6">
                    <ul class="topmenulink">

                                                

                        <?php if( Yii::app()->params['SSO']=='OFF'){?>
                         <li class="top-nav-login"><a class="cursorp" data-toggle="dropdown"><span>Login</span></a>
                            <div class="dropdown logindivarea dropdown-menu" role="menu" aria-labelledby="dLabel" id="loginarea">                                
                              <?php include_once(getcwd()."/protected/views/site/login.php");?>
                            </div>
                            </li>
                             <?php } else{?>
                            <li style="margin-top:7px">
                                <a class="cursorp btn-primary" style="border-radius:5px" href="/site/SSO"><span>Login</span></a>
                            </li>
                             <?php }?>
                        
                    </ul>
                </div>



            </div>
        </div>

    </div>
</div>
<div class="bottomheaderarea" id="headerBeforeLogin" >
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="span5" >
                    &nbsp;

                </div>
                <div class="span1">
                    <div class="logo">
                        <a href="#"><img src="/images/system/ritechat-logo.png"></a>
                    </div>

                </div>
                <div class="span6" >  &nbsp;</div>
            </div>
        </div>

    </div>
</div>
</header>
