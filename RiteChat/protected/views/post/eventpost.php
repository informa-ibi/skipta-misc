 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
    
</style>
</head>

<body>
<!-- stream -->
<div id="CopyUrl_sucmsg" class="alert alert-success margintop5 " style="display: none"></div>
<div id="postwidgetContent">
<table border="0" cellpadding="0" cellspacing="0" style="width:100%;margin:auto">
<tr>
<td>
<!-- Normal Posts -->
<?php 
 if(is_object($stream))
      { 

     $style="display:block";

    foreach($stream as $data){

?>
<table cellpadding="0" cellspacing="0" style="width:100%">
<tr>
<td style="background-image:url(<?php echo $siteurl; ?>/snipetshtmls/rightdotline.png);background-repeat:repeat-y;background-position:left top">
<table cellpadding="0" cellspacing="0" style="width:100%">
<tr>
 <td style="vertical-align: top">
        <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
        <td style="vertical-align: top">
        	 <table cellpadding="0" cellspacing="0" style="width:100%">
             <tr>
             <td style="width:87px;vertical-align:top;line-height:0">
            <table cellpadding="0" cellspacing="0" style="width:100%">
             <tr>
             <td style="width:87px;height:87px;vertical-align:top;text-align:center;border-top:10px solid #fff">
              <div style="width:87px;height:87px;vertical-align:top;text-align:center;position:relative;">
               <a href="<?php echo $url;?>" target="_blank" > <img src="<?php echo  $data->FirstUserProfilePic; ?>" style="max-width:100%;width:90%;border:3px solid #d9d9d9" /></a>
             </div>
             </td>
             </tr>
             </table>
             </td>
            
             <td style="vertical-align:top">
            		 <table cellpadding="0" cellspacing="0" style="width:100%">
                    <tr>
                     <td style="background-image:url(<?php echo $siteurl; ?>/snipetshtmls/boxleftbg.png);background-repeat:repeat-y;background-position:right top;width:20px;vertical-align:top;padding-top:30px">
           
             </td>
                    <td style="border-top:1px solid #d9d9d9;border-right:1px solid #d9d9d9;padding:3px 10px;height:24px">
                        
            
                    
               
                
               <?php if(($data->CategoryType!=3 || $data->IsIFrameMode==1) && $data->CategoryType!=5  && $data->CategoryType!=6 && $data->CategoryType!=8){ ?>
               
                      <a href="<?php echo $url;?>"  target="_blank" style="text-decoration:none;color:#333;font-family:arial;font-size:12px;display:block">
                          <b style="font-weight:bold;font-family:arial;font-size:15px;color:#5f6468;">
                             <?php if($data->isGroupAdminPost == 'true' && $data->ActionType=='Post') {
                           echo $data->GroupName; 
                        }else{
                            echo $data->FirstUserDisplayName;
                        } ?>
                          
                          </b>
                          <?php  echo $data->SecondUserData?> <?php  echo $data->StreamNote." ".$data->PostTypeString ?>
                          <?php if($data->PostType==2 || $data->PostType==3){ if(isset($data->Title) && $data->Title!=""){ echo $data->Title; };} ?>
                           <?php if ($data->PostType==11){ echo '"'.$data->Title.'"' ?> <?php } else if ($data->PostType==5){echo $data->CurbsideConsultTitle ?><?php } }?>
                           <i style="font-weight:bold;font-family:arial;font-size:12px;color:#5f6468;">
                           
                          </i>
                      
                      </a>  
                    
                    </td>
                    </tr>
                    </table>
 <!--------------------------------------------------------Content Start------------------------------------------------------------------------------------------------------------->                
 <table cellpadding="0" cellspacing="0" style="width:100%">
             <tr>
                 <td style="background-image:url(<?php echo $siteurl; ?>/snipetshtmls/boxleftbg.png);background-repeat:repeat-y;background-position:right top;width:20px;vertical-align:top;padding-top:1px">
                     <img src="<?php echo $siteurl; ?>/snipetshtmls/leftarrow.png" style="border:0" />
                 </td>
                 <td style="border-top:1px solid #d9d9d9;border-right:1px solid #d9d9d9;padding:3px 10px;vertical-align:top">
                    <div style="min-height:60px">
                     <table cellspacing="0" cellpadding="0" style="width:100%">
                    <tr>
                        <?php if ($data->ArtifactIcon != "") {
                                        ?>
                                        <td style="width:200px;padding-top:7px;padding-bottom:7px;vertical-align:top">

                                           
                                                <?php if ($data->IsMultiPleResources > 1) { ?> <div style="border:2px solid #d0d0d0;padding:2px;"> <?php } ?>
                                                    <div style="border:2px solid #d0d0d0;padding:2px;">
                                                        <a href="<?php echo $url;?>" target="_blank" ><img src="<?php echo $siteurl; ?>/<?php echo $data->ArtifactIcon ?>" style="width:100%;border:0"/></a>
                                                    </div> 
                                                    <?php if ($data->IsMultiPleResources > 1) { ?> </div> <?php } ?>
                                            

                                        </td>
                       <?php } ?>
                        <td style="padding-left:10px;vertical-align:top;padding-top:7px;padding-bottom:7px"> 
                     <table cellpadding="0" cellspacing="0" >
                        <tr>
                        <td style="width:10px;height:10px;vertical-align: top;line-height:0"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox1.png" style="border:0;vertical-align: top" /></td>
                        <td style="line-height:0;height:10px;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/eventouterbox2.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox2.png" style="border:0;vertical-align: top" /></td>
                        <td style="width:10px;height:10px;line-height:0"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox3.png" style="border:0;vertical-align: top" /></td>
                        </tr>
                        <tr>
                        <td style="line-height:0;width:10px;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/eventouterbox8.png);background-repeat:repeat-y;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox8.png" style="border:0;vertical-align: top" /></td><td style="vertical-align:top">
                        <table cellpadding="0" cellspacing="0" style="width:100%">
                        <tr>
                        <td style="vertical-align:top">
                        <div style="padding-right:2px">
                        	<table cellpadding="0" cellspacing="0" style="width:100%">
                        <tr>
                        <td style="width:3px;height:3px;vertical-align:top;line-height:0"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender1.png" /></td>
                        <td style="height:3px;vertical-align:top;line-height:0;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender2.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender2.png" /></td>
                        <td style="width:4px;height:3px;vertical-align:top;line-height:0"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender3.png" /></td>
                        </tr>
                        <tr>
                        <td style="width:3px;line-height:0;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender4.png);background-repeat:repeat-y;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender4.png" /></td>
                        <td style="vertical-align:top;text-align:center;background:#fd9f1b;color:#fff;font-family:arial;font-size:12px;font-weight:bold;padding-top:5px;padding-bottom:5px"><?php echo $data->EventStartMonth; ?><?php echo $data->StartDate != $data->EndDate ? "<br/>" : "-"; ?><?php echo $data->EventStartYear; ?></td>
                        <td style="line-height:0;width:4px;height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender5.png);background-repeat:repeat-y;background-position:right top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender5.png" /></td>
                        </tr>
                        <tr>
                        <td style="line-height:0;width:3px;height:4px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender6.png" /></td>
                        <td style="line-height:0;height:4px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender7.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender2.png" /></td>
                        <td style="line-height:0;width:4px;height:4px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender8.png" /></td>
                        </tr>
                        
                         <tr>
                        <td style="line-height:0;width:3px;height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender9.png);background-repeat:repeat-y;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender9.png" /></td>
                        <td style="vertical-align:top;background:#fff">
                        <div style="text-align:center;font-family:arial;font-size:18px;font-weight:bold;padding-top:5px;padding-bottom:0px"><?php echo $data->EventStartDay; ?></div>
                        <div style="text-align:center;font-family:arial;font-size:14px;font-weight:bold;padding-top:0px;padding-bottom:5px;color:#fd9f1b"><?php echo $data->EventStartDayString; //day name ?></div>
                        </td>
                        <td style="line-height:0;width:4px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender10.png);background-repeat:repeat-y;background-position:right top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender10.png" /></td>
                        </tr>
                        <tr>
                        <td style="line-height:0;width:3px;height:3px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender11.png" /></td>
                        <td style="line-height:0;height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender12.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender12.png" /></td>
                        <td style="line-height:0;width:4px;height:3px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender13.png" /></td>
                        </tr>
                        </table>
                        </div>
                        </td>
                            
                             <?php if ($data->StartDate != $data->EndDate) { ?>
                         <td style="vertical-align:top;width:50%">
                        <div style="padding-left:2px">
                        	<table cellpadding="0" cellspacing="0" style="width:100%">
                        <tr>
                        <td style="width:3px;height:3px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender1.png" /></td>
                        <td style="height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender2.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender2.png" /></td>
                        <td style="width:4px;height:3px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender3.png" /></td>
                        </tr>
                        <tr>
                        <td style="width:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender4.png);background-repeat:repeat-y;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender4.png" /></td>
                        <td style="vertical-align:top;text-align:center;background:#fd9f1b;color:#fff;font-family:arial;font-size:12px;font-weight:bold;padding-top:5px;padding-bottom:5px"><?php echo $data->EventEndMonth; ?><br/><?php echo $data->EventEndYear; ?></td>
                        <td style="width:4px;height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender5.png);background-repeat:repeat-y;background-position:right top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender5.png" /></td>
                        </tr>
                        <tr>
                        <td style="width:3px;height:4px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender6.png" /></td>
                        <td style="height:4px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender7.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender2.png" /></td>
                        <td style="width:4px;height:4px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender8.png" /></td>
                        </tr>
                         <tr>
                        <td style="width:3px;height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender9.png);background-repeat:repeat-y;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender9.png" /></td>
                        <td style="vertical-align:top;background:#fff">
                        <div style="text-align:center;font-family:arial;font-size:18px;font-weight:bold;padding-top:5px;padding-bottom:0px"><?php echo $data->EventEndDay; ?></div>
                        <div style="text-align:center;font-family:arial;font-size:14px;font-weight:bold;padding-top:0px;padding-bottom:5px;color:#fd9f1b"><?php echo $data->EventEndDayString; ?></div>
                        </td>
                        <td style="width:4px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender10.png);background-repeat:repeat-y;background-position:right top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender10.png" /></td>
                        </tr>
                        <tr>
                        <td style="width:3px;height:3px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender11.png" /></td>
                        <td style="height:3px;vertical-align:top;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/calender12.png);background-repeat:repeat-x;background-position:left top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender12.png" /></td>
                        <td style="width:4px;height:3px;vertical-align:top"><img src="<?php echo $siteurl; ?>/snipetshtmls/calender13.png" /></td>
                        </tr>
                        </table>
                        </div>
                        </td>
                            <?php } ?>
                        </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" style="width:100%;margin-top:10px">
                        <tr>
                        <td style="vertical-align:middle;width:20px;text-align:left"><img src="<?php echo $siteurl; ?>/snipetshtmls/placeicon.png" style="border:0"/></td>
                        <td style="vertical-align:top">
                        <table cellpadding="0" cellspacing="0" style="width:100%">
                        <tr>
                        <td style="vertical-align:middle;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/placebg.png);background-repeat:repeat-y;background-position:right top;width:8px"><img src="<?php echo $siteurl; ?>/snipetshtmls/placearrow.png" /></td>
                        <td style="vertical-align:top;padding:5px;border-top:1px solid #1a95d6;border-right:1px solid #1a95d6;border-bottom:1px solid #1a95d6;color:#1a95d6;font-family:arial;font-size:11px;font-weight:normal;">
                       <?php echo $data->Location ?>
                        </td>
                        </tr>
                        </table>
                        </td>
                        </tr>
                        </table>
                        
                        
                        
                        </td><td style="line-height:0;width:10px;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/eventouterbox4.png);background-repeat:repeat-y;background-position:right top;"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox4.png" style="border:0;vertical-align: top" /></td>
                        </tr>
                        <tr>
                        <td style="width:10px;height:10px;line-height:0"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox7.png" style="border:0;vertical-align: top" /></td>
                        <td style="height:10px;;line-height:0;background-image:url(<?php echo $siteurl; ?>/snipetshtmls/eventouterbox6.png);background-repeat:repeat-x;background-position:left top;">
                            <img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox6.png" style="border:0;vertical-align: top" /></td>
                        <td style="width:10px;height:10px;line-height:0"><img src="<?php echo $siteurl; ?>/snipetshtmls/eventouterbox5.png" style="border:0;vertical-align: top" /></td>
                        </tr>
                        </table>
                     
                    
                    </td>
                    </tr>
                     </table>
                      <?php  if(!$data->IsEventAttend){ ?>
                         <div style="text-align:right;padding:3px;">
                      <a href="<?php echo $url;?>" target="_blank"><img src="<?php echo $siteurl; ?>/snipetshtmls/attendbutton.png" style="border:0" /></a>
                    </div>
                      <?php } ?>
                     <table cellpadding="0" cellspacing="0" style="width:100%">
                         <tr>

                             <td style="vertical-align:top;padding-top:7px;padding-bottom:7px;<?php if ($data->ArtifactIcon != "") { ?> padding-left: 10px; <?php } ?>">
                                 <a href="<?php echo $url;?>"  target="_blank" style="text-decoration:none;color:#333;font-family:arial;font-size:12px;display:block">
                                     <?php
                                     echo $data->PostText;
                                     ?>
                                 </a>
                             </td>
                         </tr>
                     </table>
                     </div>
                     <?php if (isset($data->WebUrls->Weburl)) { ?>
            <?php if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') { ?>  
                             <table cellpadding="0" cellspacing="0" style="width:100%;border-top:1px dashed #ccc">
                                 <tr>
                <?php if ($data->WebUrls->WebImage != "") { ?>
                                         <td style="width:100px;padding-top:7px;padding-bottom:7px;vertical-align:top">
                                             <div style="border:2px solid #d0d0d0;padding:2px;">
                                                 <a href="<?php echo $url;?>" target="_blank" ><img src="<?php echo $data->WebUrls->WebImage; ?>" style="width:100%;border:0;"/></a>
                                             </div>
                                         </td>
                <?php } ?>
                                     <td style="padding-left:10px;vertical-align:top;padding-top:7px;padding-bottom:7px"> <a href="<?php echo $url;?>" target="_blank" style="text-decoration:none;color:#333;font-family:arial;font-size:12px;display:block">
                                             <table cellpadding="0" cellspacing="0" style="width:100%;">
                                                 <tr>
                                                     <td style="vertical-align:top"> <h2 style="color:#a3a3a3;margin:0;padding:0;font-size:18px;font-family:arial"><?php echo $data->WebUrls->WebTitle ?></h2></td>
                                                 </tr>
                                                 <tr>
                                                     <td style="vertical-align:top;color:#333;margin:0;padding:0;font-size:16px;font-family:arial;font-weight:bold"><?php echo $data->WebUrls->WebLink ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td style="vertical-align:top;font-size:12px;font-family:arial;"> <?php echo $data->WebUrls->Webdescription ?></td>
                                                 </tr>
                                             </table>



                                         </a></td>
                                 </tr>
                             </table>

            <?php }
        } ?>

                 </td>
             </tr>
         </table>
 
  </td>
             </tr>
             </table>
          <table cellpadding="0" cellspacing="0" style="width:100%">
                <tr>
                    <td style="vertical-align: bottom;width:87px;line-height: 0">
                        <img src="<?php echo $siteurl; ?>/snipetshtmls/rightdot.png" style="border:0" />
                        
                    </td>
                    <td style="vertical-align: top">
                      <!----------------------------------------------------Content End---------------------------------------------------------------------------->
<!--------------------------------------------------Social-Bar Start------------------------------------------------------------------------------------------------------>                 
                 <table cellpadding="0" cellspacing="0" style="width:100%">
                     <tr>
                         <td style="background-image:url(<?php echo $siteurl; ?>/snipetshtmls/boxleftbg.png);background-repeat:repeat-y;background-position:right top;width:20px;vertical-align:top;padding-top:30px">

                         </td>
                         <td style="border-top:1px solid #d9d9d9;border-bottom:1px solid #d9d9d9;border-right:1px solid #d9d9d9;padding:3px 10px">
                             <a href="<?php echo $url;?>" target="_blank" style="text-decoration:none;color:#333;font-family:arial;font-size:12px;display:block">
                                 <table cellpadding="0" cellspacing="0" >
                                     <tr>
                                         <td>

                                             <?php if ($data->IsFollowingPost == '1') { ?>
                                                 <img src="<?php echo $siteurl; ?>/snipetshtmls/folllowactive.png" style="border:0"/>
                                             <?php } else { ?>
                                                 <img src="<?php echo $siteurl; ?>/snipetshtmls/folllowinactive.png" style="border:0"/>
                                             <?php } ?> 

                                         </td>
                                         <td style="padding:3px 15px 3px 5px;font-weight:bold;font-family:arial;font-size:12px;color:#5f6468;"><?php echo $data->FollowCount ?></td>
                                         <?php if ($data->PostType != 5) { ?>
                                             <td style="padding:3px 15px 3px 0px;font-weight:bold;font-family:arial;font-size:12px;color:#5f6468;"><img src="<?php echo $siteurl; ?>/snipetshtmls/inviteactive.png" style="border:0"/></td>

                                             <td>
                                                 <?php if ($data->IsLoved == '1') { ?>
                                                     <img src="<?php echo $siteurl; ?>/snipetshtmls/likeactive.png" style="border:0"/>
                                                 <?php } else { ?>
                                                     <img src="<?php echo $siteurl; ?>/snipetshtmls/likeainctive.png" style="border:0"/>
                                                 <?php } ?> 
                                             </td>
                                             <td style="padding:3px 15px 3px 5px;font-weight:bold;font-family:arial;font-size:12px;color:#5f6468;"><?php echo $data->LoveCount ?></td>
                                         <?php } ?>

                                         <?php if ($data->CategoryType == 1) { ?>



                                             <td> <?php if (!$data->TwitterShare || !$data->FbShare) { ?> <img src="<?php echo $siteurl; ?>/snipetshtmls/shareinactive.png" style="border:0"/>


                                                 <?php } else { ?>
                                                     <img src="<?php echo $siteurl; ?>/shareactive.png" style="border:0"/>   
                                                 <?php } ?>

                                             </td>
                                             <td style="padding:3px 15px 3px 5px;font-weight:bold;font-family:arial;font-size:12px;color:#5f6468;"><?php  echo (isset($data->ShareCount) && is_int($data->ShareCount))?$data->ShareCount:0?></td>
                                         <?php } ?>
                                         <?php if (!$data->DisableComments) { ?>
                                             <td>
                                                 <?php 
                                                     if($data->IsCommented!=1){ ?>
                                                   
                                                 
                                                 <img src="<?php echo $siteurl; ?>/snipetshtmls/commentsinactive.png" style="border:0"/>
                                                     <?php }else{ ?>
                                                         
                                                 <img src="<?php echo $siteurl; ?>/snipetshtmls/commentsactive.png" style="border:0"/>
                                                  <?php    } ?>

                                                     
                                                  
                                             </td>
                                             <td style="padding:3px 15px 3px 5px;font-weight:bold;font-family:arial;font-size:12px;color:#5f6468;"><?php  echo $data->CommentCount?></td>
                                         <?php } ?>
                                     </tr>
                                 </table>
                             </a>
                         </td>
                     </tr>
                 </table>
<!----------------------------------------------------Social-Bar END------------------------------------------------------------------------------------------>
              
                        
                      </td>
        </tr>
        </table>
        
        </td>
        </tr>
        </table>
</td>
</tr>
</table>
</td>
</tr>
</table>

      <?php }
          }
          ?>
</td>
</tr>
</table>
</div>

<div style="text-align:right;vertical-align:top;padding-top: 10px;">
         <button data-mode="play"   class="btn btnplay btnplaymini gameStatusView " type="button"  onclick="copypostwidget('<?php echo $siteurl; ?>');"  id="copyurl">Copy Content <i class="fa fa-chevron-circle-right"></i></button>
        </div>
</body>
</html>

