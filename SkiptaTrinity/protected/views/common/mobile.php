
<div id="containerId" class="container">
    <div id="padding10Id" class="padding10">
<div class="row-fluid">
    <div class="span12"><div class="padding10ltb mobile">

            <div class="row-fluid">
                <div class="span12">
                    
                    <h2 class="pagetitle">Mobile</h2>
                    <p class="p_static_subheader paddingtop18"><?php echo Yii::app()->params['NetworkName']; ?> Mobile Anywhere. Everywhere. Always.</p>
                    <p class="mobile_subtitle">Stay connected to <?php echo Yii::app()->params['SecondaryUser']; ?> through the new <?php echo Yii::app()->params['NetworkName']; ?> Mobile App.</br>
                        Currently live and available for iPhone, Android phones, iPad and Android Tablet  </p>
                </div>
            </div>
            <div class="row-fluid" >
                <div class="span12 paddingtop18"> 
                    <div class="span4">
                        <img src="/images/system/mobile_img.png" /></div>
                    <div class="span4 iphone">
                        <h3 class="page_sub_heading">iPhone</h3>
                        <p>Engage with colleagues, read the latest news, and respond to the latest clinical cases via Curbside Consult, and more.</p>
                        <div><a href="<?php echo Yii::app()->params['appStoreURL']; ?>" target="_blank"><img title="iPhone" alt="iPhone" src="/images/system/iphone.png" style="border:0"></a></div>
                    </div>
                    <div class="span4 android">
                        <h3 class="page_sub_heading">Android</h3>
                        <p>Get the same features from our iPhone App on the Android Platform </p>
                    <div ><a href="<?php echo Yii::app()->params['googlePlayURL']; ?>" target="_blank"><img title="Android" alt="Android" src="/images/system/android.png" style="border:0"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<script type="text/javascript">
   <?php if(isset($this->tinyObject->UserId)) { ?>
   loginUserId = '<?php echo $this->tinyObject->UserId; ?>';
    <?php } ?>
    $(document).ready(function(){
        if(loginUserId!=undefined && loginUserId!=null && loginUserId != ""){
        $('#containerId').removeClass();
        $('#padding10Id').removeClass('padding10'); 
    }
});

</script>