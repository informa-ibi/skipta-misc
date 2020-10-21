<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="utf-8" http-equiv="x-ua-compatible" content="IE=Edge"/>
        <title> <?php echo Yii::t('translation', 'ProjectTitle'); ?></title>
        <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/images/favicon.ico" type="image/x-icon">
        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.minicolors.css" rel="stylesheet" type="text/css" />        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaNeo_layout.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaNeo_page.css" rel="stylesheet" type="text/css" media="screen" />        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptatheme.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-trinity_commonpage.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <?php if(Yii::app()->params['Project'] != "Trinity"){ ?>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-skiptaTrinitytheme.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/css/<?php echo Yii::app()->params['ThemeName']; ?>" rel="stylesheet" >
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/css/themeinnerstyles.css" rel="stylesheet" >
        <?php }else{?>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/<?php echo Yii::app()->params['ThemeName']; ?>" rel="stylesheet" type="text/css" media="screen" />  
       <?php } ?>
      
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fonts.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/editor.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.atwho.css" rel="stylesheet"  type="text/css"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/timepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fileuploader.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/galleria.classic.css" rel="stylesheet" type="text/css" />
        
        
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/foundation.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/joyride-2.1.css">
           <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/timezone.js"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/simplePagination/simplePagination.css"/>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/simplePagination/jquery.simplePagination.js"></script> 
        <style type="text/css">.dropdown-backdrop {position: fixed;left:0;z-index:997;display:none}</style>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsrender.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/freshereditor.min.js" type="text/javascript"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.atwho.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/prettyCheckable.js"></script>
    
     
<!--        <script src="https://platform.twitter.com/widgets.js" type="text/javascript"></script>-->
         <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/twitterwidgets.js"></script>
        <?php include 'translationVariables.php'; ?>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fileuploader.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/shortcut.js" type="text/javascript"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/farbtastic.js" type="text/javascript"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/post.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/translations.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/galleria-1.3.5.min.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-switch.min.js"></script>
        <?php if (Yii::app()->params['Project'] != 'RiteChat') { ?>
            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slicknav.js"></script>
        <?php } ?>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jwplayer/jwplayer.js"></script>
        <script type="text/javascript">jwplayer.key = "N5rHDC1elorgiqDb/VdbUadp/aRvTnNwLEQFlQ=="</script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsapi.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/googlevis.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/googleRgbcolor.js"></script> 
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/googleCanvg.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation.joyride.js"></script>
         <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.minicolors.js"></script>  
        <style>
            .clear1:after{content:"";clear:both;display:block}
        </style>
        <!--[if lt IE 8]>
        <style>
        /* For IE < 8 (trigger hasLayout) */
        .clearfix {
            zoom:1;
        }
        </style>
        <![endif]-->

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/css3-mediaqueries.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/respond.js" type="text/javascript"></script>
           <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" rel="stylesheet">
        <![endif]-->
        <!--[if lt IE 10]>
         <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie_placeholder.css" rel="stylesheet">
        <![endif]-->
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.zclip.js"></script>
        <script src="/nodeserver/"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/publications.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/htmltoCanvas.js"></script>
                                        
       <?php 
        if(Yii::app()->session['language']=="de"){ ?>
            <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css_translate/de.css"/>
       <?php } ?>
     

  
        <script type="text/javascript">
            
          
            var loginUserId='';
 loginUserId = '<?php echo $this->tinyObject->UserId; ?>';

 <!--
var name = "Ali";
var money;
money = 2000.50;
//-->
 
var displayName = "<?php echo $this->tinyObject->DisplayName; ?>";
var postAsNetwork = 0;
var joyRideSwitch = '<?php echo Yii::app()->session['UserStaticData']->disableJoyRide ?>';
var userFirstName = "<?php echo substr(Yii::app()->session['LoginUserFirstName'], 0, 12) ?>";
var networkAdminUserId = 0;
socialActionIntervalTime = '<?php echo Yii::app()->params['NodeRequestTimeToSocial']; ?>';
nodeSurveyTime = '<?php echo Yii::app()->params['NodeSurveyTime']; ?>';
postIntervalTime = '<?php echo Yii::app()->params['NodeRequestTimeToNewPost']; ?>';
notificationTime = '<?php echo Yii::app()->params['NotificationTime']; ?>';
if (sessionStorage.old_key == undefined || sessionStorage.old_key == "") {
    sessionStorage.old_key = '<?php echo trim(rand(0, 99) . microtime()); ?>';
}
Project='<?php echo Yii::app()->params['Project']; ?>';
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                sessionStorage.beforelogin = false;
                if (detectDevices())
                    $("[rel=tooltip]").tooltip();

<?php if (Yii::app()->params['Project'] != 'RiteChat') { ?>
                    $('#menu').slicknav({
                        prependTo: '#sidebar'
                    });
<?php } ?>
                $('#joyRideSwitch').bootstrapSwitch();
                joyRideSwitch = Number('<?php echo Yii::app()->session['UserStaticData']->disableJoyRide ?>');

                if (joyRideSwitch == 1) {
                    $('#joyRideSwitch').bootstrapSwitch('setState', true);
                    $('label[for=joyRideSwitch]').text("ON  ");

                } else {
                    $('label[for=joyRideSwitch]').text("OFF ");

                }
                $('#joyRideSwitch').on('switch-change', function(e, data) {
                    var switchedValue = data.value ? 1 : 0;
                    if (switchedValue == 1) {
                        $('label[for=joyRideSwitch]').text("ON ");
                    } else {
                        $('label[for=joyRideSwitch]').text('OFF ');
                    }

                    enableOrDisableJoyRide(switchedValue);

                });
                $('#PostAsNetwork').bootstrapSwitch();
                postAsNetwork = Number('<?php echo Yii::app()->session['PostAsNetwork'] ?>');
                if (postAsNetwork == 1) {
                    $('#PostAsNetwork').bootstrapSwitch('setState', true);
                    $('label[for=PostAsNetwork]').text(userFirstName);
                } else {
                    $('label[for=PostAsNetwork]').text("<?php echo Yii::t('translation', 'Admin'); ?>");
                }
                $('#networkmode').show();
                $('#PostAsNetwork').on('switch-change', function(e, data) {
                    var PostAsNetwork = data.value ? 1 : 0;
                    if (PostAsNetwork == 1) {
                        $('label[for=PostAsNetwork]').text(userFirstName);
                    } else {
                        $('label[for=PostAsNetwork]').text("<?php echo Yii::t('translation', 'Admin'); ?>");
                    }
                    manageNetworkAdmin(PostAsNetwork);
                });
                document.onreadystatechange = function() {
                    if (document.readyState === "complete") {
                        loginUserId = '<?php echo $this->tinyObject->UserId; ?>';
                        postAsNetwork = Number('<?php echo Yii::app()->session['PostAsNetwork'] ?>');
                        setFooterPosition();
                          twttr.events.bind('tweet', function( event ) {
                            var queryString = {postId:globalspace.postId,
                                categoryType:globalspace.categoryType,
                                shareType : 'TwitterShare'
                            };
                            ajaxRequest("/post/savesharedlist", queryString,twitterSharedListCallback);
                        });
                    }
                }
            });
<?php $name = Yii::t('translation', 'CurbsideConsult'); ?>
            var consultname = "<?php echo $name; ?>";
            var fb_api_key = "<?php echo Yii::app()->params['fb_api_key']; ?>";
            var bitLyUsername = "<?php echo Yii::app()->params['bitLyUsername'] ?>"; // bit.ly username
            var bitLyAPIKey = "<?php echo Yii::app()->params['bitLyAPIKey'] ?>";
            var projectName = "<?php echo Yii::app()->params['NetworkName '] ?>";
            var sharePostUrl = location.protocol + "//" + window.location.host + '/common/postdetail';
        </script>
    </head>

    <body>
        <div id="content_hide" style="display: none"></div>
        <div id="fb-root"></div>
              <!-- Modal -->
        <div class="modal fade" id="tagCloudModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header" id="tagCloud_header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tagCloudLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" >
                        <div id="tagCloud_body">
                            
                        </div>
                    </div>
<!--                    <div class="modal-footer" id="tagCloud_footer">
                        <button type="button" class="btn btn-small" id="login_btn" ><?php echo Yii::t('translation','Login'); ?></button>
                    </div>-->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        
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
        <div class="modal fade" id="myModal_old" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="carouselModel">
                <div class="carousel_Close">
                    <a href="#"  class="detailed_image_close" data-dismiss="modal"  aria-hidden="true"><i class="fa fa-times"></i></a>
                </div>
              
                <table cellpadding="0" cellspacing="0" style="width:100%;height:100%;">
                    <tr>
                        <td style="text-align: center;vertical-align: middle; " class="c_carousel">
                            <div class="player">
                                <div id="player" ></div>
                            </div>
                            <img id="showoriginalpicture" src="" style="max-width:100%;border: 12px solid #FFFFFF;"/>  
                            <a onclick="PreviousArtifact()" id="previousbutton" class="c_carousel_arrow a_left" style="display:none;"> ‹ </a>
                            <a onclick="NextArtifact()" id="nextbutton"  class="c_carousel_arrow a_right" style="display:none;"> › </a>
                        </td>
                    </tr>

                </table>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div id="notificationsdiv" style="display:none;position:absolute;width:100%;text-align: center;z-index: 9999;top:200px">  
            <div  style="display:table;margin:auto;cursor:pointer;opacity: 1;background: #fff;margin:auto;box-shadow: 2px 2px 2px 2px  #ccc;border-radius:10px;padding:10px;color:#818285">You have <br/><i style="vertical-align: sub;color: #017BC4;font-size:18px;font-family:'exo_2.0bold';font-style: normal;padding:0px;" id='notificationsCount'></i> more<br/> <span id="notificationsTitle"></span></div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header" id="newModal_header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="newModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" id="newModal_body">

                    </div>
                    <div class="modal-footer" id="newModal_footer">
                        <button type="button" class="btn btn-small" id="newModal_btn_primary"><?php echo Yii::t('translation','Save_changes'); ?></button>
                        <button type="button" class="btn btn-small" data-dismiss="modal" id="newModal_btn_close"><?php echo Yii::t('translation','Close'); ?></button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
          <div class="modal fade" id="badging" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="badging-model-content">
                    <div class="modal-header" id="badging_header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="badgingLabel"><?php echo Yii::t('translation','Congratulations'); ?></h4>
                        <div id='badging_message'></div>
                    </div>
                    <div class="modal-body" id="badging_body">

                    </div>
                    <div class="modal-footer" id="badging_footer">
                        <button type="button" class="btn" id="badging_okButton"><?php echo Yii::t('translation','Ok'); ?></button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

<div class='atmention_popup' style='display:none'></div>    
<div class="modal fade" id="myModalAd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" styl="z-index:1048">
            <div class="modal-dialog" id='myModelDialogAd' styl="z-index:1049">
                <div class="modal-content">
                    <div class="modal-header" id="myModal_headerAd">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelAd">Modal title</h4>
                        <div id='myModal_messageAd'></div>
                    </div>
                    <div class="modal-body" id="myModal_bodyAd">

                    </div>
                    <div class="modal-footer" id="myModal_footerAd">
                        <button type="button" class="btn" id="myModal_saveButtonAd">Update</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" id='myModelDialog'>
                <div class="modal-content">
                    <div class="modal-header" id="myModal_header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        <div id='myModal_message'></div>
                    </div>
                    <div class="modal-body" id="myModal_body">

                    </div>
                    <div class="modal-footer" id="myModal_footer">
                        <button type="button" class="btn" id="myModal_saveButton"><?php echo Yii::t('translation','Update'); ?></button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
       
        <!-- Modal -->
        <div class="modal fade" id="userFollowersFollowings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header" id="userFollowersFollowings_header">
                        <button type="button" class="close" id='ProfilePopupFollowersAndFollowing' data-dismiss="modal" aria-hidden="true" >&times;</button>
                        <h4 class="modal-title" id="userFollowersFollowingsLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" >
                        <div id="userFollowersFollowings_body" ></div>
                    </div>
                    <div class="modal-footer" id="userFollowersFollowings_footer">
                        <button type="button" class="btn btn-small" id="userFollowersFollowings_btn_primary"><?php echo Yii::t('translation','Save_changes'); ?></button>
                        <button type="button" class="btn btn-small" data-dismiss="modal" id="userFollowersFollowings_btn_close"><?php echo Yii::t('translation','Close'); ?></button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo YII::app()->getBaseUrl() ?>/js/jquery.jscrollpane.custom.min.js"></script>


        <?php
        $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
        $displayName = Yii::app()->session['TinyUserCollectionObj']['DisplayName'];
        $uniqueHandle = Yii::app()->session['TinyUserCollectionObj']['uniqueHandle'];
        ?>
        <?php
        Yii::app()->params['Chat'] == 'ON' ? include 'mjmChatSocket.php' : '';
        include 'projectSearchSocket.php';
        include 'projectSearch.php';
        include 'notifications.php';
        ?>
        <script type="text/javascript">
            var gType = "Group";
            var groupId = 0;
            var g_notificationId = 0;
            if (typeof io !== "undefined") {
                var socketForUpdate = io.connect('<?php echo Yii::app()->params['NodeURL']; ?>');

                $('.dropdown-backdrop').css("postition", "fixed");
                var notificationsInterval = 0;
                var fromHeaderNotifications = 0;
                $(".notifications_detailed").live("click touchstart", function() {
                    globalspace.notification = "detailedpage";
                    var postId = $(this).data('postid');
                    var notificationId = $(this).data('id');
                    var postType = $(this).data('posttype');
                    var categoryType = $(this).data('categorytype');
                    var notificationFlag = $(this).data("notificationflag");
                    var recentActivity=$(this).data("recentactivity"); 
                    var redirectUrl=$(this).data("redirecturl"); 
                    var notificationType=$(this).data("notificationtype");
                    if (notificationHistory != 0)
                        clearInterval(notificationHistory);
                    updateNotificationAsRead(notificationId, notificationFlag);
                    fromHeaderNotifications = notificationFlag;
                    $("#rightpanel").hide();
                    if (categoryType == 3 || categoryType == 7) {
                        IsUserFollowAGroup('<?php echo $userId; ?>', postId, categoryType, postType);
                    } else if (categoryType == 8) {
                        renderNewsDetailedPage('admin_PostDetails', 'contentDiv', postId, postId, categoryType, postType,recentActivity);
                    } else if (categoryType != 0 && categoryType != 9 && categoryType != 20) {
                        renderPostDetailPage('admin_PostDetails', 'contentDiv', postId, categoryType, postType,recentActivity);
                    } else if (categoryType == 9) {
                        getGameCollectionObject(postId);
                    }else if (categoryType == 20 && notificationType == 1 && redirectUrl!='' ) {
                         var currentHost = window.location.hostname;
                         var matches = redirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
                         var domain = matches && matches[1];
                         var parts = domain.split("www.");
                         if (parts == currentHost) {
                             window.location =redirectUrl ; 
                         }else{
                            window.open(redirectUrl); 
                         }
 
                    }
                    trackEngagementAction("NotificationClick",notificationId,categoryType,postType);
                });
                $(".notification_marked").live("click", function() {
                    var postId = $(this).data('postid');
                    var notificationId = $(this).data('id');
                    var postType = $(this).data('posttype');
                    var categoryType = $(this).data('categorytype');
                    var notificationFlag = $(this).data("notificationflag");
                    if (notificationHistory != 0)
                        clearInterval(notificationHistory);
                    //1:popup notifications 2: history..                    
                    updateNotificationAsRead(notificationId, notificationFlag);
                    trackEngagementAction("NotificationMarkAsRead",notificationId,categoryType,postType);
                });
                $(".markallasread_notification").live("click", function() {
                    var type = $(this).data("type");
                    markallasread(type);
                });

                function updateNotificationAsRead(notificationId, flag) {
                    if (flag == 1) {
                        checkNotificationStatus = false;

                    }
                    else
                        checkNotificationStatus = true;
                    
                          var obj = getJsonObjectForNode(); 
                    socketNotifications.emit('getUnreadNotifications', loginUserId,obj);
                    g_notificationId = notificationId;

                    scrollPleaseWait("notificationSpinLoader_" + notificationId);
                    var queryString = "notificationId=" + notificationId;
                    ajaxRequest("/post/updateNotificationAsRead", queryString, function(data, notificationId, notificationFlag) {
                        updateNotificationAsReadHandler(data, notificationId, flag);
                    });
                }
                function updateNotificationAsReadHandler(data, id, flag) {
                    if (data.status == "success") {
                       
                          if ($("#read_" + g_notificationId).html()==undefined)
                                 $("#notificationsLi").addClass('open');
                        $("#read_" + g_notificationId).removeClass().addClass("read");

                        if (flag == "1") {

                        } else {
                            scrollPleaseWaitClose("notificationSpinLoader_" + g_notificationId);
                        }
                    }
                }
                function markallasread(type) {
                    var queryString = "";
                    ajaxRequest("/post/markallAsRead", queryString, function(data) {
                        markallasread_notificationHandler(data, type)
                    });
                }
                function markallasread_notificationHandler(data, type) {
                    if (data.status == "success") {
                        $("#totalNotifications").text("");
                        $("#renderNotification").html("");
                        if (type == "history") {
                            $(".read").each(function(key, value) {
                                if ($(this).attr('class') == "read unread") {
                                    $(this).removeClass('unread');
                                }
                            });

                        }
                        $("#notificationCount").hide();
                        getAllNotificationByUserId(type);
                    }
                }
                $(function() {

                    $("#notification_settings").on("click", function() {
                        var text = $("#notification_settings").text();
                        if (text == "Settings") {
                            $("#notification_settings").text("Notifications");
                            var obj = getJsonObjectForNode(); 
                            socketNotifications.emit('getUnreadNotifications', loginUserId,obj,"clearInterval");
                            $("#notificationsLi").removeClass().addClass("not_header open");
                            $("#notificationsHeader,#scrollDiv").hide();
                            getUserSettings();
                            var queryString = {"from": "Settings"};
                            trackActivities("/post/trackPageLoad", queryString);

                        } else {
                            $("#notification_settings").text("<?php echo Yii::t('translation','Settings'); ?>");
                            pF4 = 1;
                            var obj = getJsonObjectForNode(); 
                            socketNotifications.emit('getUnreadNotifications', loginUserId,obj,"sSetInterval");
                            $("#notificationsLi").removeClass().addClass("not_header open");
                            $("#renderNotification,#notificationsHeader,#scrollDiv").show();
                            $("#settings").hide();
                            $("#notificationsLi").removeClass().addClass("not_header open");
                        }
                    });

                    $("#notificationsLi").bind("click touchstart", function() {
                        $("#scrollDiv").css("height", "270px");
                        var obj = getJsonObjectForNode(); 
                        socketNotifications.emit('getUnreadNotifications', loginUserId,obj,""); // by default..
                        var queryString = {"from": "Notification"};
                        trackActivities("/post/trackPageLoad", queryString);
                    });

                    $("#notification_history").bind('click', function() {
                        $("#notificationsLi").removeClass().addClass("not_header");
                        $("#chatDiv").hide();
                        notificationAjax = false;
                        startLimit = 0;
                        $("#admin_PostDetails,#contentDiv").hide();
                        scrollPleaseWait("history_spinner");
                        $("#notificationHomediv,#notificationHistory").show();
                        getAllNotificationByUserId('history');
                        var queryString = {"from": "History"};
                        trackActivities("/post/trackPageLoad", queryString);
                    });

                    $("#scrollDiv").click(function(event) {
                        //        event.stopPropagation();
                    });
                    $(".headerpopfooter").bind("click", function(event) {
                        event.stopPropagation();
                        // Do something
                    });
                    $("#settings").bind("click", function(event) {
                        event.stopPropagation();
                        // Do something
                    });
                    $("#notification_settings,.headerpopfooter").on('click touchstart',function(e){                        
                        e.stopPropagation();
                    });
                    //here find the device versions..
                });



                socketForUpdate.on("getUpdatedStreamPostResponse", function(content) {
                    if (content != 0) {
                        var data = content.split("_((***&&***))_");
                        var streamId = data[1];
                        data_content = data[0];

                        setTimeout(function() { // waiting for 1 sec ... because it is very fast, so that's why we have to forcely wait for a sec.
                            if (g_streamId != 0) {
                                scrollPleaseWaitClose("stream_view_spinner_" + g_streamId);
                                $("#postitem_" + streamId).replaceWith(data_content).show();

                                g_streamId = 0;
                            }

                        }, 1000);

                    } else if (content == 0 && $.trim(content) != "") {

                        scrollPleaseWaitClose("stream_view_spinner_" + g_streamId);
                    }

                });

                socketForUpdate.on("getUpdatedStreamNewsResponse", function(content) {
                    if (content != 0) {
                        var data = content.split("_((***&&***))_");
                        var streamId = data[1];
                        data_content = data[0];
                        setTimeout(function() { // waiting for 1 sec ... because it is very fast, so that's why we have to forcely wait for a sec.
                            if (g_streamId != 0 && streamId != undefined) {
                                scrollPleaseWaitClose("stream_view_spinner_" + g_streamId);
                                isDuringAjax = false;
                                applyLayoutContent();
                                $("#" + streamId).replaceWith(data_content).show();
                                g_streamId = 0;
                            }

                        }, 800);

                    } else if (content == 0 && $.trim(content) != "") {

                        scrollPleaseWaitClose("stream_view_spinner_" + g_streamId);
                    }

                });


                function updateSocketConnect() {                    
                    var userTypeId = '<?php echo Yii::app()->session['UserStaticData']->UserTypeId ?>';
                    if (g_streamId != 0 && g_streamId != undefined && g_streamId != null && g_streamId != "") {
                        scrollPleaseWait("stream_view_spinner_" + g_streamId);
                        setTimeout(function() {
                            socketForUpdate.emit("getUpdatedStreamPostRequest", loginUserId, g_streamId, userTypeId, g_pageType,Project);
                        }, 2000);
                    }
                }

                socketNotifications.on('getPostIdsFromClient', function(jsonObject, socketId) {
                      jsonObject = JSON.parse(jsonObject);
                      jsonObject.utcTime = utcTime;
                      jsonObject.sessionId = sessionStorage.userSessionId;
                      jsonObject = JSON.stringify(jsonObject);
                    socketNotifications.emit('getPostIdsFromClientResponse', g_postIds, jsonObject, socketId, gPage);
                });

                socketNotifications.on('getPostDtsFromClient', function(userId, userTypeId, postAsNetwork, jsonObject, socketId, type, groupId) {
                    //   alert(g_postDT);
                    socketNotifications.emit('getPostDtsFromClientResponse', g_postDT, userId, userTypeId, postAsNetwork, jsonObject, socketId, gPage, type, groupId);
                });
                //    $("#logoutId").bind("click",function(){
                //               
                //    });
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
                     socket.emit('logout', loginUserId);
                    socketNotifications.emit("clearInterval", sessionStorage.old_key);
                    window.location="/";
                }

            }
            $(document).ready(function() {

                $('#aboutUs,#contactUs,#orId').hide();
                // IE7 or IE8 Placeholder don't remove
                if ($.browser.msie) {
                    $('input[placeholder]').each(function() {
                        var input = $(this);
                        $(input).val(input.attr('placeholder'));
                        $(input).focus(function() {
                            if (input.val() == input.attr('placeholder')) {
                                input.val('');
                            }
                        });
                        $(input).blur(function() {
                            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                                input.val(input.attr('placeholder'));
                            }
                        });
                    });
                }
                ;

            });
        </script>

<?php include_once 'inner_header.php'; ?>
<?php include_once 'track.php'; ?>
        <script type="text/javascript">
            
         
        $("#myModal .close").live( "click", 
            function(){
            $("#myModal_body").html("");
            $("#myModalLabel").html("");
            $("#myModal_saveButton").html("");

            }
        );
           
            if (detectDevices()) {
                $(".postmg_actions_mobile,.actionmorediv,.profilewidth,#GroupDiv,.dropdown").live('touchstart', function(event) {
                    event.stopPropagation();
                });
                $(".dropdown-menu").die();

            }
            $('.modal').on('show', function() {
                $('body').css('overflow', 'hidden');
            });
            $('.modal').on('hidden', function() {
                $('body').css('overflow', 'auto');
            });
            if (sessionStorage.ISTracked == undefined || sessionStorage.ISTracked == null || sessionStorage.ISTracked == "" || sessionStorage.ISTracked == "undefined") {
                sessionStorage.ISTracked = 0;
            }
            if (sessionStorage.ISTracked == 0) {
                sessionStorage.ISTracked = 1;
                trackBrowseDetails("http://localhost/", "0");
            }
            function getGameCollectionObject(gameId) {
                var URL = "/game/getGameDetailsById?selectedGameId=" + gameId;
                ajaxRequest(URL, "", function(data) {
                    getGameCollectionObjectHandler(data)
                }, "json");

            }
            function getGameCollectionObjectHandler(data) {
                var scheduleId = data.data;
                var gameName = data.GameName;
                if (scheduleId == 0) {

                } else {
                    scheduleId = scheduleId.$id;
                }
                if (data.GameName != null && data.GameName != undefined && data.GameName != "")
                    window.location = '/' + gameName + '/' + scheduleId + '/detail/game';
                else {
                    window.location = "/game/index"; // if postId not found
                }
            }
            
//            $(document).ready(function(){
//	      $(window).load(function(){
//                  setTimeout(function(){
//                   // alert(sessionStorage.globalSurveyFlag+"--"+$("#surveyQuestionArea").length);
//                 if(sessionStorage.globalSurveyFlag == 1 && $("#surveyQuestionArea").length == 0){
//                    //  alert("Are u sure event occurs when you close the browser window!!!"); 
//                   
//                      sessionStorage.globalSurveyFlag = 0;
//                      unsetSpot(loginUserId,sessionStorage.scheduleId);
//                 }   
//                  },1000)
//                 
//	      
//	      });
//	   });
function unsetSpot(userId,scheduleId){
   
sessionStorage.removeItem("globalSurveyFlag");
var queryString = {"userId":userId,"scheduleId":scheduleId};
ajaxRequest("/outside/unsetSpotForUser", queryString, "");
}
var phpSessionTimeOut;
if(phpSessionTimeOut != null && phpSessionTimeOut != "undefined"){
   clearTimeout(phpSessionTimeOut); 
}
 phpSessionTimeOut =  setInterval(function(){ 
  var data = {"sessionId":sessionStorage.userSessionId,"utcTime":utcTime};
  checkSession(data);
    
 },<?php echo (60)*1000?>)





var  userInactive = false;
var delayCall = false;

function trackUserStartSession(){ 
    delayCall = true;
    trackUserSession("start");
}
searchSocket.on('trackUserSessionResponse', function(data) {
      if ($.trim(data) != "") {
            data = eval("(" + data + ")");
            pF4 =1;
           sessionStorage.userSessionId = data.sessionId.$id;
            localStorage.userSessionId = data.sessionId.$id;
            var obj = getJsonObjectForNode(); 
            socketNotifications.emit('getUnreadNotifications', loginUserId,obj,"clearAndSetInterval");  
        }

});
        
        
  
   function trackIdleTime() {
    var t;
//    window.onbeforeunload = function(e) {
//          sessionStorage.refreshTime = new Date().getTime();
//     }
//       window.onload = function(e) {
//       var refreshTime= sessionStorage.refreshTime;
//       if(refreshTime!="" && refreshTime!="undefined" && refreshTime!=undefined){
//            var currentTime = new Date();
//            var difference = (currentTime - refreshTime) / 1000;
//            alert(difference);
//            if(difference>60){
//                sessionStorage.removeItem("userSessionId");
//            }
//       } 
//     
//     }
     

    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer; // catches touchscreen presses
   // window.onclick = resetTimer;     // catches touchpad clicks
    window.onscroll = resetTimer;    // catches scrolling with arrow keys
    window.onkeypress = resetTimer;

    function trackIdleTimeHandler() {
        console.log("trackIdleTimeHandler-----------");
        userInactive = true;
    }

    function resetTimer() {
        if(autoActionPerfomed == false){
           utcTime  = new Date(); 
            if(sessionStorage.userSessionId  == undefined || sessionStorage.userSessionId == null || sessionStorage.userSessionId  == "undefined"){
            if(delayCall == false){
              //node call here to create a session;
              trackUserStartSession(); 
             }
            }
        clearTimeout(t);
        userInactive = false;
        t = setTimeout(trackIdleTimeHandler, <?php echo Yii::app()->params['UserInactiveTime']; ?>);  // time is in milliseconds
      }
       
       
    }
}
//alert(sessionStorage.userSessionId);
trackIdleTime();
searchSocket.on('refreshPage', function(data) {
   location.reload();

});
 </script>





