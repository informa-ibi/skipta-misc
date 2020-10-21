
<div style="width:600px; padding: 0; margin:0 auto;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td>
            <?php include 'HdsUsermailContentHeaderTheme.php';  ?>
        </td>
    </tr>
    <tr>
        <td style="padding-left:10px; padding-right:10px">

            <p  style="font-family:arial; font-size: 14px; line-height: 18px; font-weight:normal; color: #333;"><b style="font-family:arial; font-size: 14px; line-height: 18px; font-weight: bold; color: #717171;">Hello</b> <b style="font-family:arial; font-size: 14px; font-weight: bold; color: #333;"><?php echo $FirstName; ?> <?php echo $LastName; ?></b>,</p>
            <p style="font-family:arial; font-size: 14px; line-height: 18px; font-weight:normal; color: #333;"><b style="font-family:arial; font-size: 14px; font-weight: bold; color: #333;">Congratulations!</b>  We are pleased to inform you that your credentials have been verified and your <a href="#" style=" text-decoration:none; font-weight:bold; color:#333" ><?php echo YII::app()->params['NetworkName']; ?></a> membership is now active.</p> 

            <p style="font-family:arial; font-size: 14px; line-height: 18px; font-weight:normal; color: #333;">You may now access your  <a href="#"style=" text-decoration:none; font-weight:bold; color:#333"><?php echo YII::app()->params['NetworkName']; ?> </a> and will be greeted by a Welcome Tour that will assist you in setting up your profile and explain the variety of tools that will enable you to communicate, collaborate and exchange information with other <a href="#"style=" text-decoration:none; font-weight:bold; color:#333"><?php echo YII::app()->params['PrimaryUser']; ?></a>.</p>

        </td>
    </tr>
    <tr>
        <td style="padding-left:10px; padding-right:10px">
            <p style="font-family:arial; margin:0; padding-top:10px; font-size: 14px; font-weight: bold; color: #333; line-height: 18px;">These tools, core features and functionality include:</p>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" background="#fff" style="padding:10px; margin:auto">
                <!-- profile start -->
                <tr style="padding-bottom:3px">
                    <td style="width:30px; background:#f5f5f5; margin-bottom:3px; border-bottom:3px solid #fff; text-align:right; vertical-align:top; line-height: 18px; padding:10px"><img src="<?php echo YII::app()->params['ServerURL']; ?>/images/system/profile_icon.png" width="52" height="52" alt="Profile" title="Profile">
                    </td>
                    <td style=" background:#f5f5f5; margin-bottom:3px; line-height: 18px; border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px; font-weight:normal;vertical-align:top; color: #333;">An area to provide information about yourself to other members, including your photo, practice information and other personal, professional and academic interests and accolades. 
                    </td>
                </tr>
                <!-- profile end -->
                <!-- Careers start -->
                <tr style="padding-bottom:3px">
                    <td style="width:30px; background:#f5f5f5; line-height: 18px; margin-bottom:3px; border-bottom:3px solid #fff; text-align:right; vertical-align:top;padding:10px"><img src="<?php echo YII::app()->params['ServerURL']; ?>/images/system/careers_icon.png" width="52" height="52" alt="Careers" title="Careers">
                    </td>
                    <td style=" background:#f5f5f5; line-height: 18px; margin-bottom:3px; border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px; font-weight:normal;vertical-align:top; color: #333;">We’ve partnered with leading organizations to bring you the latest career opportunities that are relevant to your profession and where you reside.  You are able to easily view and apply for opportunities instantly.
                    </td>
                </tr>
                <!-- Careers end -->
                <!-- News start -->
                <tr style="padding-bottom:3px">
                    <td style="width:30px; background:#f5f5f5; margin-bottom:3px; border-bottom:3px solid #fff; text-align:right; vertical-align:top;padding:10px"><img src="<?php echo YII::app()->params['ServerURL']; ?>/images/system/news_icon.png" width="52" height="52" alt="News" title="News">
                    </td>
                    <td style=" background:#f5f5f5; margin-bottom:3px; line-height: 18px; border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px; font-weight:normal;vertical-align:top; color: #333;">The latest news and information is brought to you from the reputable sources you are already viewing on a daily basis.  The News section has specifically curated content that provides the most up-to-date information and current issues relevant to your profession.
                    </td>
                </tr>
                <!-- News end -->

                <!-- Follow start -->
                <tr style="padding-bottom:3px">
                    <td style="width:30px; background:#f5f5f5; margin-bottom:3px; border-bottom:3px solid #fff; text-align:right; vertical-align:top;padding:10px"><img src="<?php echo YII::app()->params['ServerURL']; ?>/images/system/follow_icon.png" width="52" height="52" alt="Follow" title="Follow">
                    </td>
                    <td style=" background:#f5f5f5; margin-bottom:3px; border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px; line-height: 18px; font-weight:normal;vertical-align:top; color: #333;">You can follow members, posts and groups to tailor your community experience. This will keep you informed of all interactions and conversations within your stream. 
                    </td>
                </tr>
                <!-- Followend -->

                <!-- Search start -->
                <tr style="padding-bottom:3px">
                    <td style="width:30px; background:#f5f5f5; margin-bottom:3px; border-bottom:3px solid #fff; text-align:right; vertical-align:top;padding:10px"><img src="<?php echo YII::app()->params['ServerURL']; ?>/images/system/search_icon.png" width="52" height="52" alt="Search" title="Search">
                    </td>
                    <td style=" background:#f5f5f5; margin-bottom:3px; border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px;  line-height: 18px;font-weight:normal; vertical-align:top;color: #333;">Through a quick, easy and comprehensive search tool, you can search based on topics of interest, specific medications or individual members.  Search results are organized by community feature and category.
                    </td>
                </tr>
                <!-- Search end -->



            </table>

        </td>
    </tr>
    <tr>
        <td style="padding-left:10px; padding-right:10px">
            <p style=" border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px; font-weight:normal;vertical-align:top; color: #333; line-height: 18px;margin-top: 0;">We thank you for your membership.  If you have any questions, please contact us at <a href="mailto:<?php echo YII::app()->params['NetworkAdminEmail']; ?>" style=" color:#39C;font-size:14px; font-weight:bold;"><?php echo YII::app()->params['NetworkAdminEmail']; ?></a>
            </p>
            <p style="margin:0; border-bottom:3px solid #fff;padding:10px;font-family:arial; font-size: 14px; font-weight:normal;vertical-align:top; color: #333;">Sincerely,</p>
            <p style=" margin:0; border-bottom:3px solid #fff;padding:0 10px;font-family:arial; font-size: 14px; font-weight:bold;vertical-align:top; color: #333;font-size:14px;"><?php echo YII::app()->params['NetworkName']; ?></p>

        </td>
    </tr>
    <tr>
        <td height="4" style="font-size: 4px; line-height: 4px; border-bottom:4px solid #e5e5e5; padding-top:10px">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <!-- footer start -->
            <?php include 'HdsUsermailContentFooterTheme.php';  ?>
            <!-- footer end -->
        </td>
    </tr>

    </table>
    </div>
