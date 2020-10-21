<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/profile.js"></script> 

<?php if(Yii::app()->params['Project'] != "Trinity"){ ?>
       <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/<?php echo Yii::app()->params['Project']; ?>/css/publicprofile.css" rel="stylesheet" >
        <?php }else{?>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/publicprofile.css" rel="stylesheet" type="text/css" media="screen" />
       <?php } ?>
    
   
<script type="text/javascript">
    sessionStorage.pageName = "userProfile";
</script>
<section id="streamsection" class="streamsection network_specific" >
    <div class="publicheadermenu">
       <?php include 'StaticSidebar.php'; ?> 
    </div>
    
    <div class="container">
      
        <div class="streamsectionarea">
           
   
           
<?php if (Yii::app()->params['Project'] == 'RiteAid') { ?>
                <div class="streamsectionarea  streamsectionarearightpanelno">
                    <div class="padding10 ">
            <?php } ?>
                        <?php if (Yii::app()->params['Project'] != 'RiteAid') { ?>
                     <div class="padding10 ">
            <?php } ?>
                    <div id="profileDetailsDiv">

                        <div id="numero1">  <h2 class="pagetitle"><?php echo $profileDetails->DisplayName ?> </h2> </div><!-- This id numero1 is used for Joyride help -->
                         <div class="row-fluid">
        <div class="span12">
            <div class="span5 ">
                 <div class="paddingleft0 ">
               
                  <div class="unlogedProfile" >

                                    <div class="p_summary">
                                        <div class="padding10">
                                            <div class="p_card">

                                                <div class="p_icon">

                                                    <div class="alert alert-error" id="ProfileImageError" style="display: none"></div>
                                                    <div class="marginzero smallprofileicon noBackGrUp">

                                                        <div class="positionrelative editicondiv editicondivProfileImage no_border ">

                                                            <div class="edit_iconbg top75" style="display: none;">
                                                                <div id="UserProfileImage"></div>



                                                            </div>
                            <!--                                <img id="profileImagePreviewId" src="<?php //echo $profileDetails->ProfilePicture  ?>" alt="" />-->
                                                            <img id="profileImagePreviewId" src="<?php if (isset($profileDetails->profile250x250) && $profileDetails->profile250x250 != 'null') {
                        echo $profileDetails->profile250x250;
                    } else {
                        echo '/upload/profile/user_noimage.png';
                    } ?>"  alt="" />
                                                        </div>

                                                        <div ><ul class="qq-upload-list" id="uploadlist_logo"></ul></div>
                                                    </div>
                                                </div>
                                                <div id="previewDiv" class="profilepreviewDiv" style="display: none">
                                                    <img id="profileImagePreviewDisplay" src="<?php if (isset($profileDetails->profile250x250) && $profileDetails->profile250x250 != 'null') {
                        echo $profileDetails->profile250x250;
                    } else {
                        echo '/upload/profile/user_noimage.png';
                    } ?>"  alt="" />
                                                    <div class="profilepreviewDivbuttons">                           
                                                        <i id="updateGroupIcon" class="fa fa-floppy-o editable_icons editable_icons_big" onclick="saveUserProfileImage('<?php echo $profileDetails->UserId ?>', 'ProfilePicture')"></i>
                                                        <i class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick="cancelProfileImageUpload('<?php echo $profileDetails->ProfilePicture ?>', 'ProfilePicture')"></i>
                                                    </div>
                                                </div>








                                                <div class="paddingleft10 paddingtop4">
                                                    <div class="pagetitle profiletitle paddingzero lineheight20 positionrelative  editProfileDisplayName" id="profileFirstName"><?php echo $displayName ?> </div>
                                                    <!--                        <div class="edit_iconbg edit_padding-top-3">-->

                                                    <div id="editProfileDisplayName" style="display:none" class="positionrelative minheight21">
                                                        <div class="editable editProfileFirstName_edit">
                                                            <input id="editProfileDisplayNameText" class="profiletitleedit"   value="<?php echo $displayName ?>" contentEditable="true" onblur="checkKeyPress(event, 'DisplayName')"  onkeypress="checkKeyPress(event, 'DisplayName')"/>

                                                        </div>
                                                        <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">

                                                        </div>
                                                        <!--</div>-->
                                                    </div>



                                                    <div class="p_summarytitle " ><div> 
<?php $displayPosition = (strlen($profileDetails->Speciality) != 0) ? "show" : "hide"; ?>
                                                            <span style="display:block" class="editProfileSpeciality <?php echo ($profileDetails->Speciality == "" && $IsUser == 1) ? 'Specialityplaceholder' : '' ?>" placeholder="Specialty" id="p_position"><?php echo $profileDetails->Speciality ?></span> 
                                                            <div id="editProfileSpeciality" style="display:none" class="positionrelative minheight21">
                                                                <div class="editable editProfileSpeciality_edit">
                                                                    <input id="editProfileSpecialityText" class="profiletitleedit" value="<?php echo $profileDetails->Speciality ?>" onblur="checkKeyPress(event, 'Speciality')" onkeypress="checkKeyPress(event, 'Speciality')"  contentEditable="true"/>

                                                                </div>
                                                                <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
                                    <!--                                <i onClick="saveEditPersonalInformation('Speciality');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                                                    <i onClick="closeEditPersonalInformation('Speciality');" id="closeEditPersonalInformation"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>-->
                                                                </div>
                                                                <!--</div>-->
                                                            </div>

                                                        </div> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bordertop">
                                            <div class="padding10">

                                                <div class="p_summarytitle " style="text-align: center" ><div> 
<?php $displayPosition = (strlen($profileDetails->Position) != 0) ? "show" : "hide"; ?>
                                                        <span style="display:<?php echo $displayPosition; ?>" class="editProfilePosition <?php echo ($profileDetails->Position == "" && $IsUser == 1) ? 'Positionplaceholder' : '' ?>" id="p_position"><?php echo $profileDetails->Position ?></span> 
                                                        <div id="editProfilePosition" style="display:none" class="positionrelative minheight21">
                                                            <div class="editable editProfilePosition_edit">
                                                                <input id="editProfilePositionText" class="profiletitleedit"  value="<?php echo $profileDetails->Position ?>" onblur="checkKeyPress(event, 'Position')" onkeypress="checkKeyPress(event, 'Position')"   contentEditable="true" />

                                                            </div>
                                                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
                                <!--                                <i onClick="saveEditPersonalInformation('Position');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                                                <i onClick="closeEditPersonalInformation('Position');" id="closeEditPersonalInformation"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>-->
                                                            </div>
                                                            <!--</div>-->
                                                        </div>

                                                    </div> </div>

                                                <div class="p_summarytitle " style="text-align: center" ><div> 
<?php $displayPosition = (strlen($profileDetails->Company) != 0) ? "show" : "hide"; ?>
                                                        <span style="display:<?php echo $displayPosition; ?>" class="editProfileCompany <?php echo ($profileDetails->Company == "" && $IsUser == 1) ? 'Companyplaceholder' : '' ?>" id="p_position"><?php echo $profileDetails->Company ?></span> 
                                                        <div id="editProfileCompany" style="display:none" class="positionrelative minheight21">
                                                            <div class="editable editProfileCompany_edit">
                                                                <input id="editProfileCompanyText" class="profiletitleedit"  value="<?php echo $profileDetails->Company ?>" onblur="checkKeyPress(event, 'Company')" onkeypress="checkKeyPress(event, 'Company')"  contentEditable="true"/> 

                                                            </div>
                                                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
                                <!--                                <i onClick="saveEditPersonalInformation('Company');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                                                <i onClick="closeEditPersonalInformation('Company');" id="closeEditPersonalInformation"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>-->
                                                            </div>
                                                            <!--</div>-->
                                                        </div>

                                                    </div> </div>
                                            </div>
                                        </div>
                                        <div class="bordertop">
                                            <div class="padding10 p_description positionrelative">
                                                <div class="p_content positionrelative  editAboutMe clearboth">
                                                    <div id="profile_AboutMe" style="display:block" class="editicondiv minheightDiv <?php echo (strlen($profileDetails->AboutMe) == 0 && $IsUser == 1) ? 'Descriptionplaceholder' : '' ?>"><?php echo substr($profileDetails->AboutMe, 0, 200); ?>
<?php if (strlen($profileDetails->AboutMe) > 200) { ?>
                                                            <a id='displayTotalAboutMe' style="font-size:20px;cursor: pointer;text-decoration: none;">... </a>
<?php } ?>
                                                    </div>     <div id="editProfileAboutMe" style="display:none">
                                                        <div class="editable groupAboutEdit" id="">
                                                            <textarea id="editProfileAboutMeDescriptionText" rows="8" style="width: 292px" class="e_descriptiontext"  onblur="checkKeyPress(event, 'AboutMe')"  onkeypress="checkKeyPress(event, 'AboutMe')"   contentEditable="true" ><?php echo $profileDetails->AboutMe ?></textarea>

                                                        </div>

                                                    </div>


                                                </div>
                                                <div id="displayTotalAboutMeDiv" style="display:none" class="displayTotalAboutMeDiv">
                                                    <div class="editable " id="">
                                                        <div id="" class="e_descriptiontext"  ><?php echo $profileDetails->AboutMe ?></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bordertop">
                                            <div class="padding5 grouphomemenu followssection ">
                                                <ul>
                                                    <li class="half">
                                                        <div class="p_custleft22">
                                                            <div class="pro_box p_followers">
                                                                <div class="pro_boxicon">
                                                                    <img data-original-title="Followers" rel="tooltip" data-placement="bottom" class="tooltiplink p_followers" src="/images/system/p_followersicon.png">
                                                                </div>
                                                                <div class="menubox">
                                                                    <div class="groupmenucount "><i id='p_followersCount'><?php echo $profileDetails->UserFollowersCount ?></i ></div>
                                                                    <ul>
<?php if ($profileDetails->UserFollowersCount > 0) { ?>
                                                                            <?php $i = 0; ?>
                                                                            <?php foreach ($userFollowers as $followersPic) { ?>     
                                                                                <?php if ($i <= 9) { ?>
                                                                                    <li>
                                                                                        <div class="menusubbox"><img src="<?php echo $followersPic ?>"/></div>      
                                                                                    </li>
        <?php } else {
            break;
        }
        ?>
                                                                                <?php $i++ ?>
    <?php }
} ?>
<?php for ($j = 1; $j <= 9 - $i; $j++) { ?>
                                                                            <li>
                                                                                <div class="menusubbox"></div>

                                                                            </li>
<?php } ?>

                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="half">
                                                        <div class="p_custleft22">
                                                            <div class="pro_box p_following" >
                                                                <div class="pro_boxicon">
                                                                    <img data-original-title="<?php echo Yii::t('translation','Following'); ?>" rel="tooltip" data-placement="bottom" class="tooltiplink "src="/images/system/p_followingicon.png">
                                                                </div>
                                                                <div class="menubox">
                                                                    <div class="groupmenucount"><i id='p_followingCount'><?php echo $profileDetails->UserFollowingCount ?></i ></div>
                                                                    <ul>
                                                                        <?php if ($profileDetails->UserFollowingCount > 0) { ?>
                                                                            <?php $i = 0; ?>
                                                                            <?php foreach ($userFollowing as $followingPic) { ?>     
                                                                                <?php if ($i <= 9) { ?>
                                                                                    <li>
                                                                                        <div class="menusubbox"><img src="<?php echo $followingPic ?>"/></div>      
                                                                                    </li>
                                                                                <?php } else {
                                                                                    break;
                                                                                }
                                                                                ?>
        <?php $i++ ?>
    <?php }
} ?>
<?php for ($j = 1; $j <= 9 - $i; $j++) { ?>
                                                                            <li>
                                                                                <div class="menusubbox"></div>

                                                                            </li>
<?php } ?>

                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
               
            </div>
                </div>
            <div class="span7 sp_landingpage_r">
                <div class=" mobilepaddingzero">
                    
                <p>If you’re an existing member of <?php echo Yii::app()->params['NetworkName']; ?>, please login above.  </p>
                <p><?php echo Yii::app()->params['NetworkName']; ?> is the hub for verified <?php echo Yii::app()->params['SecondaryUser']; ?> to communicate and collaborate. 
                </p><p>Are you a <?php echo Yii::app()->params['PrimaryUser']; ?>? <b class="reg_now" style="cursor: pointer;" onclick="registernow();"><?php echo Yii::t('translation','Register_NOW'); ?></b> and get started exploring your specialty network. </p>
                            
                <a href="javascript:registernow();" ><img src="/images/system/spL_go_img.png" width="72" height="72" /></a>
            </div>
            </div>
        </div>
        </div>
                        <div class="row-fluid unlogedProfile marginT10"  >
                            <div class="span12" id='fixedWidgets'> 
<?php
if ($loginUserId == $profileDetails->UserId) {
    $userDisplayName = "You ";
    $pre = " are ";
} else {
    $userDisplayName = $profileDetails->DisplayName;
    $pre = " is ";
}
?>
<?php if (count($userBadges) > 0) { ?>
                                    <div class="span3" >
                                        <ul  class="profileboxsection">
                                            <li id="badgesInt" class="" style="min-height: 10px">
                                                <div class="groupmenucount"><i><?php echo count($userBadges) ?></i></div>
                                                <div class="post item" style="">
                                                    <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php echo $profileDetails->UserId; ?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b> <?php echo Yii::t('translation','unlocked_badges'); ?></div>
                                                    <div class="padding4 clearfix badgeimages">
                                    <?php if (count($userBadges) > 0) { ?>
        <?php foreach ($userBadges as $value) { ?>
                                                                <span><a data-original-title="<?php echo $value['hovertxt']; ?>" rel="tooltip" data-placement="bottom" class="badgesId" data-showIntroPopUp="<?php echo $value['hovertxt'] ?>" data-value="<?php echo $value['id'] ?>" ><img src="<?php echo "/images/badges/" . $value['badgeName'] . "_38x44.png" ?>" alt="<?php echo $value['hovertxt'] ?>" /></a></span>
        <?php }
    } else { ?>
        <?php echo $userDisplayName . ' '.Yii::t('translation','havenot_unlocked_badges');
    } ?>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul> 

                                    </div>
                                                    <?php } ?>
                                                    <?php if ($userFollowingGroups['totalGroupsCount'] > 0) { ?>
                                    <div class="span3">
                                        <ul  class="profileboxsection">

                                            <li id="groupsInt" class="">
                                                <div class="groupmenucount"><i><?php echo $userFollowingGroups['totalGroupsCount'] ?></i></div>


                                                <div class="post item" style="">
                                                    <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php echo $profileDetails->UserId; ?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?><?php echo Yii::t('translation','following_groups'); ?></div>
                                                    <div class="padding4 clearfix groupimages">
                                    <?php if ($userFollowingGroups['totalGroupsCount'] > 0) { ?>
        <?php foreach ($userFollowingGroups['groupsList'] as $value) { ?>
                                                                <span><a class="groupId" data-showIntroPopUp="<?php echo $value['showIntroPopup'] ?>" data-value="<?php echo $value['id'] ?>" ><img src="<?php echo $value['groupProfileImage'] ?>" alt="<?php echo $value['name'] ?>" /></a></span>
        <?php }
    } else { ?>
        <?php echo $userDisplayName . ' ' . $pre . ' '.Yii::t('translation','not_following_groups');
    } ?>

                                                    </div>
                                                </div>


                                            </li>
                                        </ul> 

                                    </div> 
<?php } ?>
<?php if ($userFollowingHashtags['totalHashTagCount'] > 0) { ?>   
                                    <div class="span3">
                                        <ul class="profileboxsection">
                                            <li  id="hashtagInt" class="">
                                                <div class="groupmenucount"><i><?php echo $userFollowingHashtags['totalHashTagCount'] ?></i></div>
                                                <div class="post item" style="">
                                                    <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php echo $profileDetails->UserId; ?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?><?php echo Yii::t('translation','following_hashtags'); ?></div>
                                                    <div class="padding4">
    <?php if ($userFollowingHashtags['totalHashTagCount'] > 0) { ?>
        <?php foreach ($userFollowingHashtags['hashtags'] as $value) { ?>
                                                                <span id="stream_view_spinner_<?php echo $value['id']; ?>" class="grouppostspinner"></span>
                                                                <span class="atwho-view-flag atwho-view-flag-#">
                                                                    <span class="dd-tags hashtag" data-id="<?php echo $value['id']; ?>"><b>#<?php echo $value['name'] ?></b></span>
                                                                </span>
        <?php }
    } else { ?>
                                                            <?php echo $userDisplayName . ' ' . $pre . ' '.Yii::t('translation','not_following_hashtags');
                                                        } ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> 

                                    </div> 
<?php } ?>
<?php if ($userFollowingCategories['totalCategoriesCount'] > 0) { ?>

                                    <div class="span3" >
                                        <ul  class="profileboxsection" >
                                            <li class="" id="curbsideInt">
                                                <div class="groupmenucount"><i><?php echo $userFollowingCategories['totalCategoriesCount'] ?></i></div>
                                                <div class="post item" style="">
    <?php $name = Yii::t('translation', 'CurbsideConsult'); ?>
                                                    <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php echo $profileDetails->UserId; ?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?><?php echo Yii::t('translation','following_these'); ?>  <?php echo strtolower($name); ?> <?php echo Yii::t('translation','categories'); ?></div>
                                                    <div class="padding4">
    <?php if ($userFollowingCategories['totalCategoriesCount'] > 0) { ?>
        <?php foreach ($userFollowingCategories['categories'] as $value) { ?>
                                                                <span class="fontbold comma"><a class="curbsideCategory" data-id="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></a></span>
        <?php }
    } else { ?>
        <?php echo $userDisplayName . ' ' . $pre . ' '.Yii::t('translation','not_following_any').' '. $name . ' '.Yii::t('translation','categories');
    } ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> 

                                    </div> 
                                        <?php } ?>


                            </div>
                        </div>

                        <div class="unlogedProfile" > 



                            <div class="row-fluid">

                                <div class="span12 padding8top">

                                    <h2 id="ProfileInteractionsDisplayName" class="pagetitle"><?php echo $profileDetails->DisplayName . "'s " ?><?php echo Yii::t('translation','Recent_Interactions'); ?></h2>
                                    <div id="main" role="main">
            <?php
            if ($loginUserId == $profileDetails->UserId) {
                $userDisplayName = Yii::t('translation','You');//"You";
                $pre = Yii::t('translation','are');//" are ";
            } else {
                $userDisplayName = $profileDetails->DisplayName;
                $pre = Yii::t('translation','is');//" is ";
            }
            ?>
                                        <ul id="ProfileInteractionDiv" class="profilebox"></ul>
                                    </div>
<?php $moreToDisplay = $userInteractionsCount - 10 ?>
<?php if ($moreToDisplay > 0 && isset(Yii::app()->session['TinyUserCollectionObj'])) { ?>
                                        <div class="alignright" id='goToInteractions'><input type="button" value="<?php echo $moreToDisplay .' '.Yii::t('translation','more').'...'; ?>" name="yt0"  class="btn"></div>
<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="postDetailsDivInProfile"></div>
<?php if (Yii::app()->params['Project'] == 'RiteAid') { ?>
                    </div>
                </div>
<?php } ?>
            <?php if (Yii::app()->params['Project'] != 'RiteAid') { ?>
                   
                </div>
<?php } ?>
                 <!-- Modal -->
            <div class="modal fade" id="sessionTimeoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-session">
                    <div class="modal-content ">
                        <div class="modal-header" id="sessionTimeout_header">
<!--                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                            <h4 class="modal-title" id="sessionTimeoutLabel"><?php echo Yii::t('translation','Modal_title'); ?></h4>
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
        </div></div>
</section>

<?php include 'header_menu_script.php'; ?>

<script type="text/javascript">
    $("#profileCVBtn,#profileIntBtn").removeClass("active");
    $("#profileBtn").addClass("active");
</script>
<script type="text/javascript">

     
    $(document).ready(function($) {
 
        $("#editProfileSave").hide();

//        bingGroupsIntroPopUp();
//        bingSubGroupsIntroPopUp();
        if (!detectDevices()) {
            $("[rel=tooltip]").tooltip();
            $(".editicondivProfileImage").mouseover(function() {
                $(".edit_iconbg").show();
            }).mouseout(function() {
                $(".edit_iconbg").hide();
            });
            $("#profileViewDiv").mouseover(function() {
                $("#editButtonId").show();
            }).mouseout(function() {
                $("#editButtonId").hide();
            });
            $("#displayTotalAboutMe").mouseover(function() {
                //   $('#displayTotalAboutMe').hide();  
                $('#displayTotalAboutMeDiv').show();
            }).mouseout(function() {
                //$('#displayTotalAboutMe').show();  
                $('#displayTotalAboutMeDiv').hide();
            });
        } else {
            $(".edit_iconbg,#editButtonId").show();
        }
<?php if ($IsUser != 1) { ?>
            $('#profileViewDiv').removeClass("editicondiv");
            $('#profile_AboutMe').removeClass("editicondiv");
<?php } ?>
        var minHeight = $("#fixedWidgets").height();
        $("#curbsideInt").css('min-height', minHeight);
        $("#groupsInt").css('min-height', minHeight);
        $("#badgesInt").css('min-height', minHeight);
        $("#hashtagInt").css('min-height', minHeight);

    $(".unlogedProfile").on("click",function(){
        showLoginPopup();
        $("#login_btn").live("click",function(){
        window.location="/";
     });
    });

    });

<?php if ($IsUser == 1) { ?>
       // bindEditForProfile();
        var extensions = '"jpg","jpeg","gif","png","tiff"';
        initializeFileUploader('UserProfileImage', '/user/UploadProfileImage', '10*1024*1024', extensions, 1, 'UserProfileImage', '', ProfilePreviewImage, displayErrorForBannerAndLogo12, "uploadlist_logo");
<?php } ?>
    var handler = null;
    var options = {
        itemWidth: '103%', // Optional min width of a grid item
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#ProfileInteractionDiv1'), // Optional, used for some extra CSS styling
        offset: 8, // Optional, the distance between grid items
        outerOffset: 10, // Optional the distance from grid to parent
        flexibleWidth: '10%', // Optional, the maximum width of a grid item
        align: 'left'
    };
    var handler = null;
    var options = {
        itemWidth: '23%', // Optional min width of a grid item
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#ProfileInteractionDiv'), // Optional, used for some extra CSS styling
        offset: 8, // Optional, the distance between grid items
        outerOffset: 10, // Optional the distance from grid to parent
        flexibleWidth: '23%', // Optional, the maximum width of a grid item
        align: 'left'
    };
    var $window = $(window);
    //profileInitializationEvents();
    getCollectionData('/common/getprofileintractions', 'UserId=' +<?php echo $profileDetails->UserId; ?> + '&ProfileIntractionDisplayBean', 'ProfileInteractionDiv', 'No data found', 'That\'s all folks!');
    isDuringAjax = true;
    //initializeScrolling(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id);
    gPage = "ProfileStream";
    trackEngagementAction("Loaded", '<?php echo $profileDetails->UserId ?>');
    if (!detectDevices())
        $("[rel=tooltip]").tooltip();
    function CancelAboutMe() {
        $("#profile_AboutMe").show();
        $("#profile_AboutMe").html($("#editProfileAboutMeDescriptionText").html());
        $("#editProfileAboutMe").hide();
        $("#closeEditGroupDescription").hide();
        $("#editProfileAboutMeDescriptionText").hide();
        $("#updateAndCancelAboutMeUploadButtons1").hide();
    }
    
    function bindMouseEvents() {
        $(".editicondivProfileImage").mouseover(function() {
            $(".edit_iconbg").show();
        }).mouseout(function() {
            $(".edit_iconbg").hide();
        });
    }
    $("#UserProfileImage").on('click', function() {
        $(".editicondivProfileImage").unbind('mouseover').unbind("mouseout");
    });
    $("#cvCreateAnchor").bind("click", function() {
        var url = window.location.pathname.substr(1);
        var urlArr = url.split("/");
        sessionStorage.userProfile = urlArr[0];
        window.location.href = "/" + urlArr[0] + "/profileCV";
    })
    $(".profilei").live("click", function() {
        var url = window.location.pathname.substr(1);
        var urlArr = url.split("/");
        sessionStorage.userProfile = urlArr[0];
        var tabName = $.trim($(this).html());
        if (tabName == "Profile") {
            window.location.href = "/profile/"+urlArr[0];
        } else if (tabName == "Interactions") {
            window.location.href = "/" + urlArr[0] + "/interaction";
        } else if (tabName == "CV") {

            var displayCV = '<?php echo $displayCV; ?>';
            window.location.href = "/" + urlArr[0] + "/userCVView";
        }
        trackEngagementAction(tabName+"Click", '<?php  echo $profileDetails->UserId ?>');
    });
    $('#displayTotalAboutMe').on('click', function() {
        // $('#profile_AboutMe').hide();
        //  $('#displayTotalAboutMe').hide();  
        //$('#displayTotalAboutMeDiv').show();    
    });
    if (typeof socketNotifications !== "undefined")
//        socketNotifications.emit('clearInterval',sessionStorage.old_key); 
        $('#goToInteractions').live('click', function() {
            var url = window.location.pathname.substr(1);
            var urlArr = url.split("/");
            window.location.href = "/" + urlArr[0] + "/interaction";
        });

    $("#showpdffile").live('click', function() {
        var uri = $(this).data('uri');
        var id = 'player';
        loadDocumentViewer(id, uri, "", "", 400, 500);
        $("#showoriginalpicture").hide()
        $("#myModal_old").modal('show');
    });

    $("#showpdffile1").live('click', function() {
        var uri = $(this).data('uri');
        var id = 'player';
        loadExternalDocumentViewer(id, uri, "", "", 400, 500);
        $("#showoriginalpicture").hide()
        $("#myModal_old").modal('show');
    });
    $("#viewfullprofile").bind("click", function() {
        var url = window.location.pathname.substr(1);
        var urlArr = url.split("/");
        window.location.href = "/" + urlArr[0] + "/userCVView";
    });
    $("#addeditprofile").click(function() {
        var url = window.location.pathname.substr(1);
        var urlArr = url.split("/");
        window.location.href = "/" + urlArr[0] + "/profileCV";
    });


    function checkKeyPress(e, type) {
        if (e.keyCode == 13 || e.type == 'blur') {
            if (type == 'AboutMe') {
                saveEditProfileAboutMe('<?php echo $profileDetails->UserId ?>', 'AboutMe');
            } else {
                if (type == 'DisplayName') {

                    if ($.trim($("#editProfile" + type + "Text").val()) != '') {
                        saveEditPersonalInformation(type);
                    } else {
                        //   $('#ProfileImageError').html('display name cannot be empty');
                        //  $('#ProfileImageError').show();
                    }
                } else {
                    saveEditPersonalInformation(type);
                }

            }

        }
    }

    function registernow() {
        $('body, html').animate({scrollTop: 0}, 400, function() {
            $("#registrationdropdown").addClass("open");
        });

    }
   


</script>