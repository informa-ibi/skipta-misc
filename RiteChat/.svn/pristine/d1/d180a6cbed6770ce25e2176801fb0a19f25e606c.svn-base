<?php if(is_object($result)){ ?>

<div  class="paddingtop6"  id="thankyoudiv">
        <div class="row-fluid">
            <div class="span8 congratulations" style="margin:auto;float:none">
                <div class="congratulationsTitle">Congratulations</div>
                <div class="congratulationsIcon">
                    <?php if($result->ThankYouImage!=""){
                        $thankuImage = $result->ThankYouImage;
                    }else{
                        $thankuImage = "/images/system/game_completed_icon.png"; 
                    }
                          
                   ?>
                    <img src="<?php echo $thankuImage;?>" width="250px">
                </div>
                <div class="congratulationsMessage"><?php if($result->ShowThankYou==1) echo $result->ThankYouMessage; else echo 'Successfully Completed';?></div>
                <div class="congratulationsGameinfo">
                    <div class="c_gamename"><?php echo $result->SurveyTitle;?></div>
                    
                    <div class="c_viewanswers" >
                        
                        <a style="cursor: pointer;" id="viewCorrectAnswers">View the Survey Results <i class="fa fa-chevron-right"></i></a>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
    </div>

<script type="text/javascript">
$("#viewCorrectAnswers").live("click",function(){
    window.location.href = document.URL;
});
</script>
<?php
}else{?>

<?php }
?>