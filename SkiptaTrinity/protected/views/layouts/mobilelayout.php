
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Skipta</title>
        <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="images/favicon.png">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fonts.css" rel="stylesheet">

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-fromMobile.css" rel="stylesheet">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="js/html5.js" type="text/javascript"></script>
          
        <![endif]-->
        <!-- Fav and touch icons -->

        <style type="text/css">


            body{background:<?php echo Yii::app()->params['ColorCode']; ?>;}
            .powered:before{border-left-color:<?php echo Yii::app()->params['ColorCode']; ?>;}
        </style>

    </head>

    <body class="body" >

        <?php echo $content; ?>


        <div class="powered">
            <div class="poweredbylogo">
                <img src="/images/powered.png"></div></div>
    </body>
</html>