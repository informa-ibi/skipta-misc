
<?php if(is_array($loadAds)){?> 
<div id="rightSideSectionSeperation3_<?php echo $position?>" class="rightwidget  padding-bottom10" style="display:none">
    
   
    <a id="vd_id_<?php echo $position?>" target="_blank" data-adid="" onclick="trackAd(this)" href="" data-type="video" style="display: none"><div id="videoPlay_<?php echo $position?>"> </div></a>
    <a id="aId_<?php echo $position?>" target="_blank" data-adid="" onclick="trackAd(this)" data-type="img" href=""><img id="imgDiv_<?php echo $position?>"  src="" style="display: none" /></a>
    <a id="MaId_<?php echo $position?>" target="_blank" data-adid="" onclick="trackAd(this)"  data-type="img" href=""><img id="MimgDiv_<?php echo $position?>"  src="" style="display: none;margin-top: 5px"  /></a>
    <a id="BaId_<?php echo $position?>" target="_blank" data-adid="" onclick="trackAd(this)" data-type="img" href=""><img id="BimgDiv_<?php echo $position?>"  src="" style="display: none;margin-top: 5px" /></a>
 <a id="aIdSwf_<?php echo $position?>" data-adid=""  onmousedown="trackAd(this)" target="_blank" data-type="swf" href="">
    <div id="swfTopDiv_<?php echo $position?>"  data-adid=""  style="margin: auto; height: auto;display: none;" >
 
    <div  style="min-height: 250px;">
   <object id="swfId_<?php echo $position?>" type="application/x-shockwave-flash" data=""
           width="300" height="250">
           <param name="movie" value="/upload/advertisements/Option2_300x250.swf" />
           <param name="quality" value="high" />
           <param name="bgcolor" value="#ffffff" />
           <param name="play" value="true" />
           <param name="loop" value="true" />
           <param name="wmode" value="transparent" />
           <param name="scale" value="showall" />
           <param name="menu" value="true" />
           <param name="devicefont" value="false" />
           <param name="salign" value="" />
           <param name="allowScriptAccess" value="sameDomain" />
           <embed  wmode=transparent allowfullscreen="true" allowscriptaccess="always" src="/upload/advertisements/Option2_300x250.swf"></embed>
           <!--<![endif]-->
          
           <!--[if !IE]>-->
       </object>
  
</div>
     
</div>
      </a> 
  
    
   
   </div> 
   <div id="StreamBundleAds_<?php echo $position?>" onclick="trackAd(this)" style="display:none">
<iframe src="http://ad.doubleclick.net/adi/N6645.1786854.PSYCHIATRISTCONNEC/B7984385.5;sz=300x250;ord"
width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0"
frameborder="0" scrolling="no" bordercolor='#000000'>
<script language='JavaScript1.1' src="http://ad.doubleclick.net/adj/N6645.1786854.PSYCHIATRISTCONNEC/B7984385.5;abr=!ie;sz=300x250;ord">
</script>
<noscript>
<a href="http://ad.doubleclick.net/jump/N6645.1786854.PSYCHIATRISTCONNEC/B7984385.5;abr=!ie4;abr=!ie5;sz=300x250;ord">
<img src="http://ad.doubleclick.net/ad/N6645.1786854.PSYCHIATRISTCONNEC/B7984385.5;abr=!ie4;abr=!ie5;sz=300x250;ord"
border="0" width="300" height="250" alt="Advertisement"></a>
</noscript>
</iframe>
    </div>
   <div id="AddServerAds_<?php echo $position?>" onclick="trackAd(this)" style="display:none">
          <img id="InpressionImage_<?php echo $position?>" border="0" height="1" width="1" alt="Advertisement" />
          <a  target="_blank" id="clickTagA_<?php echo $position?>">
            <img id="clickTagImage_<?php echo $position?>" width="300px;" height="250px;" src="/images/04-13642_Banner_Aubagio_300x250_Unbranded-L02.gif" alt="Advertisement" border="0" />
           </a>
    </div>
     <?php }else{
         echo '0';
     }?>
