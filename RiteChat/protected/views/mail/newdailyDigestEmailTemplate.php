<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>email</title>


    </head>
    <body ritechat="fix">
        <!-- Start Body Wrapper -->
        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="100%"  valign="top">

                    
                    <!-- Start Logo & Sharing -->
                    <table class="device-width" width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td height="5" bgcolor="#005594" style="font-size: 5px; line-height: 5px;"> </td>
                        </tr>
                        <tr>
                            <td class="content-wrapper" width="100%" style="padding-top: 0px; padding-right: 30px; padding-bottom: 0px; padding-left: 30px;padding:10px " bgcolor="#017bc4">

                                <!-- Start Logo -->
                                <table class="device-width" align="left" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="left"><img src="<?php echo $absolutePath ?>/images/system/logo.png" /></td>
                                    </tr>
                                </table>
                                <!-- End Logo -->

                                <!-- Start Sharing -->
                                <!-- End Sharing -->
                            </td>
                        </tr>
                    </table>
                    
                    <!-- End Logo & Sharing -->
                     <!-- hello area-->
                     <table class="device-width" bgcolor="#e5e5e5" width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                                           <tr>
                            <td height="4" bgcolor="#e5e5e5" style="font-size:4px;line-height:4px">&nbsp;</td>
                        </tr>
                         <tr>
                             <td style="font-size:13px;font-weight:bold;padding-top:10px;padding-left:10px;padding-right:10px;font-family:arial;color:#5A5E65"> Hello <?php echo $name ?>, <br>
                                     We have compiled a digest of recent activity from your <?php echo YII::app()->params['NetworkName']; ?>  account. This digest is specific to you and your activities on the network.
                             </td>
                         </tr>
                          <tr>
                            <td height="10" bgcolor="#e5e5e5" style="font-size:4px;line-height:10px">&nbsp;</td>
                        </tr>
                     </table>
         <!-- hello area end -->

                    <!-- ========== Start Content Blocks ========== -->

                    <!-- Start Text Color Block -->
                    <!-- End Text Color Block -->
                    <!-- Start Divider -->
                    <!-- End Divider -->
                    <!-- Start Text with Left Image -->
                    <table class="device-width" width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="content-wrapper" bgcolor="#f9f9f9" style="padding-right: 20px;padding-top: 20px; padding-left: 20px;" valign="top">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <?php foreach ($streamObjectList as $streamObject) { ?>
  
    <tr>
        <td  style="background:url(<?php echo $absolutePath ?>/images/system/dailydigest/profilebg.png) repeat-y left top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="background:url(<?php echo $absolutePath ?>/images/system/dailydigest/profilebottombg.png) no-repeat left bottom;padding-bottom:10px">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="left" valign="top" style="width:106px;">
                                    <table align="right" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="width:85px;">
                                                <div style="width:85px;border:3px solid #ccc;text-align:center;background:#fff">
                                                        <?php
                                                        if (!isset($streamObject->RecentActivity)) {
                                                            $profilUrl = Yii::app()->params['ServerURL'] . "/profile/" . $name;
                                                        }else{
                                                          $profilUrl = Yii::app()->params['ServerURL'] . "/profile/" . $streamObject->FirstUserDisplayName;  
                                                        }
                                                        
                                                            ?>
                                                    <a style="display:inline-block;cursor:pointer;text-decoration:none;" href="<?php echo $profilUrl ?>" target="_blank">
                                                    <img style="width:85px;vertical-align: central" src="<?php if (isset($streamObject->RecentActivity)){if($streamObject->GameAdminUser==1){
                            echo $streamObject->FirstUserProfilePic;
                        }                       
                        else if($streamObject->CategoryType==11)
                            echo $streamObject->NetworkLogo;
                        
                        elseif($streamObject->isGroupAdminPost == 'true' && $streamObject->ActionType=='Post') {
                           echo $streamObject->GroupImage; 
                        }else{
                                    echo $streamObject->FirstUserProfilePic; }}else{echo $profilePic;}?>"  /></a></div>
                                            </td>
                                            <td style="width:18px;text-align:right;vertical-align:top"><img src="<?php echo $absolutePath ?>/images/system/dailydigest/profilearrow.png" /></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    
                                    
                                     <!--follow user  divider starts -->
                                        <?php if (!isset($streamObject->RecentActivity)) { 
                                            $redirectUrl=Yii::app()->params['ServerURL']."/profile/".$name;
                                            ?>
                                            <tr>
                                                <td style="padding-bottom: 4px;">
                                                  <?php include 'DDFollowersEmailTemplate.php'; ?>    
                                                </td>
                                            </tr>
                                            <tr> <td style="padding-top: 10px;"> </td></tr>
                                        <?php } else {
                                            $commonButtonString = "Contribute to the conversation!";
                                            $isMultiImage = $streamObject->IsMultiPleResources > 1 ? "ccc" : "fff";
                                            $redirectUrl=$streamObject->WebUrls;
                                            ?>
                                                                                                                                      
                                            <tr>
                                                
                                                <td style="padding-bottom: 4px;">
                                                    
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D9D9">
                                                        <tr>
                                                            <td ><table width="100%"  cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td >
                                                                            
                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                <tr>
                                                                                    <td style="font-family:arial; font-size: 15px; font-weight: bold; color: #5F6468; padding-bottom: 5px;border-bottom:1px solid #D9D9D9;padding-left:10px;padding-right:10px;padding-top:5px">
                                                                                     <a style="display:inline-block;cursor:pointer;text-decoration:none;;color:#000" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                        <?php echo $streamObject->FirstUserDisplayName ?> <span style="color:#87898a;font-weight:bold;font-size:13px	"><?php echo $streamObject->StreamNote ?></span><span style="color:#333;font-weight:normal;font-size:13px"> <?php echo $streamObject->PostTypeString ?></span>
                                                                                    </a>
                                                                                    </td>
                                                                                </tr>

                                                                            </table></td>
                                                                    </tr>
                                                                    <!--Invite divider starts -->
                                                                    <?php
                                                                    if ($streamObject->RecentActivity == "Invite") {
                                                                        $commonButtonString = "Review what your followers are sharing with you!";
                                                                        ?>        
                                                                        <tr>
                                                                            <td style="font-family:arial; font-size: 12px; color: #5a5e65; line-height: 16px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;">
                                                                                
                                                                                <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                                                                                    <tr><?php if (isset($streamObject->Resource) && $streamObject->Resource['ThumbNailImage'] != "") { ?>
                                                                                            <td style="width:200px;padding:5px 10px 5px 0;vertical-align:top;display:none">
                                                                                                <table width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #ccc;padding:3px;vertical-align:top;">
                                                                                                            <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                                            <div style="border:4px solid #<?php echo $isMultiImage; ?>;min-height:70px">
                                                                                                                <img style="width:185px;" src="<?php echo $absolutePath . $streamObject->Resource['ThumbNailImage'] ?>" />
                                                                                                            </div></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td><?php } ?>
                                                                                        <td style="vertical-align:top;color:#000">
                                                                                            <a style="cursor: pointer;text-decoration: none;color:#000" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                            <?php echo $streamObject->PostText ?><img alt="see more" title="see more" src="<?php echo $absolutePath ?>/images/system/dailydigest/seemore.png" style="border:0" /></a> </td>
                                                                                    </tr>
                                                                                </table> 
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <!--Invite divider ends -->
                                                                    <!-- Mention divider starts -->
        <?php if ($streamObject->RecentActivity == "UserMention") {
            $commonButtonString = "Respond to this @mention!"; ?>                                                              

                                                                        <tr>
                                                                            <td style="font-family:arial; font-size: 12px; color: #5a5e65; line-height: 16px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px">
                                                                                
                                                                                <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                                                                                    <tr>
            <?php if (isset($streamObject->Resource) && isset($streamObject->Resource['ThumbNailImage']) && $streamObject->Resource['ThumbNailImage'] != "") { ?>
                                                                                            <td style="width:200px;padding:5px 10px 5px 0;vertical-align:top">
                                                                                                <table width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #<?php echo $isMultiImage; ?>;padding:3px;vertical-align:top;">
                                                                                                            <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                                            <div style="border:4px solid #ccc;min-height:70px">
                                                                                                                <img style="width:185px;" src="<?php echo $absolutePath . $streamObject->Resource['ThumbNailImage'] ?>" />
                                                                                                            </div></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
            <?php } ?>
                                                                                        <td style="vertical-align:top;color:#000">
                                                                                            <a style="cursor: pointer;text-decoration: none;color:#000" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                            <?php echo $streamObject->PostText ?><img alt="see more" title="see more" src="<?php echo $absolutePath ?>/images/system/dailydigest/seemore.png" style="border:0" /></a> 
                                                                                            <!--                                                                                <div style="font-family:arial; font-size: 12px; color: #336699;font-weight:bold;text-align:right;padding-top:5px;">Diabeties Pharmacy</div>-->

                                                                                        </td>
                                                                                    </tr>

                                                                                </table>  </td>
                                                                        </tr>


        <?php } ?>
                                                                    <!-- Mention divider ends -->
                                                                    <!--comments divider starts -->
                                                                                    <?php if ($streamObject->RecentActivity == "Comment") { ?>
                                                                        <tr>
                                                                            <td style="font-family:arial; font-size: 12px; color: #5a5e65; line-height: 16px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;">
                                                                                
                                                                                <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                                                                                    <tr>
            <?php if (isset($streamObject->Resource) && isset($streamObject->Resource['ThumbNailImage']) && $streamObject->Resource['ThumbNailImage'] != "") { ?>
                                                                                            <td style="width:200px;padding:5px 10px 5px 0;vertical-align:top;display:none">
                                                                                                <table width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #<?php echo $isMultiImage; ?>;padding:3px;vertical-align:top;">
                                                                                                            <div style="border:4px solid #fff;min-height:70px">
                                                                                                                <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                                                <img style="width:185px;" src="<?php echo $absolutePath . $streamObject->Resource['ThumbNailImage'] ?>" /></a>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
            <?php } ?>
                                                                                        <td style="vertical-align:top;color:#000">
                                                                                             <a style="cursor: pointer;text-decoration: none;color:#000" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                            <?php echo $streamObject->PostText ?> <img alt="see more" title="see more" src="<?php echo $absolutePath ?>/images/system/dailydigest/seemore.png" style="border:0" /></a> </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>

                                                                    <?php } ?>
                                                                    <!--comments divider ends -->
                                                                    <!--Post divider starts -->
                                                                    <?php if ($streamObject->RecentActivity == "Post") { ?>

            <?php include 'DDPostEmailTemplate.php'; ?>    

        <?php } ?>
                                                                    <!-- Post divider ends --> 

                                                                    <tr><td style="font-family:arial; font-size: 15px; font-weight: bold; color: #5F6468; padding-bottom: 5px;border-top:1px solid #D9D9D9;padding-left:10px;padding-right:10px;padding-top:5px">
                                                                            <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                                                                                <tr>
                                                                                    <td style=";font-size:14px;font-size:arial;font-weight:bold;width:40%">
                                                                                        
                                                                                        <table  cellpadding="0" cellspacing="0" border="0">
                                                                                            <tr>
                                                                                                <td style="width:26px">
                                                                                                    <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                                    <img src="<?php echo $absolutePath ?>/images/system/dailydigest/follow.png" alt="Follow" /></a></td>
                                                                                                <td style="vertical-align:middle;padding-right:8px"><?php echo $streamObject->FollowCount ?></td>
                                                                                                <td style="width:26px">
                                                                                                    <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                                    <img src="<?php echo $absolutePath ?>/images/system/dailydigest/invite.png" alt="Invite" style="vertical-align:middle"/></a></td>
                                                                                                <td style="vertical-align:middle;padding-right:8px"><?php echo $streamObject->InviteCount ?></td>
                                                                                                <td style="width:26px">
                                                                                                    <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank"><img src="<?php echo $absolutePath ?>/images/system/dailydigest/love.png" alt="Love" style="vertical-align:middle"/></a></td>
                                                                                                <td style="vertical-align:middle;padding-right:8px"><?php echo $streamObject->LoveCount ?></td>
                                                                                                <td style="width:26px">
                                                                                                    <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                                                    <img src="<?php echo $absolutePath ?>/images/system/dailydigest/share.png" alt="Share" style="vertical-align:middle"/></a></td>
                                                                                                <td style="vertical-align:middle;padding-right:8px"><?php echo $streamObject->ShareCount ?></td>
                                                                                                <td style="width:26px">
                                                                                                    <a style="cursor: pointer;text-decoration: none" href="<?php echo $redirectUrl ?>" target="_blank"><img src="<?php echo $absolutePath ?>/images/system/dailydigest/comment.png" alt="Comments" style="vertical-align:middle"/></a></td>
                                                                                                <td style="vertical-align:middle;padding-left:2px"><?php echo $streamObject->CommentCount ?></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        </a>
                                                                                    </td>
                                                                                    <?php if($streamObject->RecentActivity != "UserMention"){?>
                                                                                    <td style='width:60%;text-align: right;'>
                                                                                        <a style="display:inline-block;text-align:left;background:#6abf40;border:1px solid #57a52b;padding:0px;color:#fff;font-size:13px;font-family:arial;font-weight:normal;cursor:pointer;text-decoration:none;padding-right:3px" href="<?php echo $redirectUrl ?>" target="_blank">
                                                                            <img src="<?php echo $absolutePath ?>/images/system/dailydigest/button_arrow.png" style="vertical-align:middle;border:0" /><?php echo $commonButtonString; ?></a>
                                                                                    </td><?php }?>
                                                                                </tr>

                                                                            </table>


                                                                        </td></tr>
                                                                    <?php if($streamObject->RecentActivity == "UserMention"){?>
                                                                    <tr>
                                                                        <td style="text-align:right;padding:5px;border-top:1px solid #D9D9D9">
                                                                        <a style="display:inline-block;text-align:left;background:#6abf40;border:1px solid #57a52b;padding:0px;color:#fff;font-size:13px;font-family:arial;font-weight:normal;cursor:pointer;text-decoration:none;padding-right:3px" href="<?php echo $redirectUrl ?>" target="_blank">    
                                                                        <img src="<?php echo $absolutePath ?>/images/system/dailydigest/button_arrow.png" style="vertical-align:middle;border:0" /><?php echo $commonButtonString; ?>   </a>    
                                                                        </td>
                                                                    </tr><?php }?>
                                                                    

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                        
                                                </td>
                                                   
                                            </tr> 
                                      
               
                                            
                                            
                                            <tr>
                                            <td style="padding-top: 10px;"> </td></tr>
    <?php } ?>
                                    </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
<?php } ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- End Text with Left Image -->



                    <!-- Start Divider -->
                    <table class="device-width" width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td height="4" bgcolor="#e5e5e5" style="font-size: 4px; line-height: 4px;">&nbsp;</td>
                        </tr>
                    </table>
                    <!-- End Divider -->
                    <!-- ========== End Content Blocks ========== -->


                    <!-- Start Footer Bottom Cap -->
                    <table class="device-width" bgcolor="#f5f6f6"  width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td height="22" bgcolor="#f5f6f6" style="font-size: 11px; line-height: 22px;font-family:arial;color:#5A5E65;padding:5px 10px"><div style="font-size: 11px; line-height: 12px;font-family:arial;color:#5A5E65;padding:0 5px ;font-weight:bold">There is lot more happening in skiptaneo, stay connected!</div>
                                <div style="font-size: 11px; line-height: 12px;font-family:arial;color:#5A5E65;padding:0 5px ;font-weight:bold">Your Skipta Neo Team.</div></td>
                        </tr>
                    </table>
                    <table class="device-width" width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td height="4" bgcolor="#e5e5e5" style="font-size: 4px; line-height: 4px;">&nbsp;</td>
                        </tr>
                    </table>
                    <!-- End Divider -->
                    <!-- ========== End Content Blocks ========== -->


                    <!-- Start Footer Bottom Cap -->
                    <table class="device-width" bgcolor="#f5f6f6"  width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td height="22" bgcolor="#f5f6f6" style="font-size: 11px; line-height: 22px;font-family:arial;color:#5A5E65;padding:5px 10px">© 2014 skiptaneo.com. All rights reserved.</td>
                        </tr>
                    </table>

                    <!-- End Footer Bottom Cap -->

                    <!-- Start Footer Meta -->
                    <table class="device-width" width="630" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-bottom: 10px; font-family:arial; font-size: 14px; color: #ffffff; line-height: 21px; text-align: center;">&nbsp;</td>
                        </tr>
                    </table>
                    <!-- End Footer Meta -->
                    <!-- ========== End Footer Blocks ========== -->

                </td>
            </tr>
        </table>
        <!-- End Body Wrapper -->
    </body>
</html>