
    <footer id="footer" >
	<div class="container">
              <div style="position:fixed;bottom:0;left:0;right:0;display: none;z-index: 999999" id="minChatWidgetDiv" >
            <div class="container">
            <div class="closedchat pull-right">
                <div class="closedchattext"> Chat Widget..
    <span class="chat_plus"><i class="fa fa-times minchatClose" id="closeChatWidget" ></i><i class="fa fa-plus"></i></span></div>
	</div></div>
</div>
   
       
    
    <div class="footercopyrightarea">
    <?php echo Yii::app()->params['COPYRIGHTS']; ?>
        
    </div>
    </div>
  
    
</footer>
<div id="joyRideTipContent"></div>

<script type="text/javascript">
      
    if('<?php echo Yii::app()->session['UserStaticData']->disableJoyRide ?>'!=1 &&  '<?php echo Yii::app()->session['UserStaticData']->userSessionsCount ?>'<=10)
    {
           getJoyrideDetails();
           
     } 
   else if('<?php echo Yii::app()->session['UserStaticData']->disableJoyRide ?>'==0)
     {
           getJoyrideDetails();
     }
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', '<?php  echo Yii::app()->params['ga_transaction_id'];?>', '<?php  echo Yii::app()->params['ga_Analytics_ip'];?>');
  ga('send', 'pageview');

</script>
<script type="text/javascript">
        if(sessionStorage.minChatWidget=="true"){
        $("#minChatWidgetDiv").show();
        $("#minChatWidgetDiv").unbind().bind("click",function(){ 
     $(".closedchat").removeClass("m_c_header_active");
     divrenderget('chatDiv','/chat/index')
    });
   }
var g_streamPostIds = 0;
$("#closeChatWidget").bind("click",function(){
    $("#minChatWidgetDiv").unbind();
     $("#minChatWidgetDiv").hide();
     sessionStorage.removeItem("minChatWidget");
});

$(document).ready(function(){
/**
 * this is used for mobiles/Ipads to handle the dropdown user experience issue...
 */
$('body').on('click touchstart',function(e){       
      $(".postmg_actions").each(function(key,value){
            if($(this).attr('class') == "postmg_actions postmg_actions_mobile open"){
               $(this).removeClass("open");
               $(this).find('dropdown-menu').addClass("open");
            }
        });
        
        $(".postmg_actions").each(function(key,value){
            if($(this).attr('class') == "postmg_actions postmg_actions_mobile open"){
               $(this).removeClass("open");
               $(this).find('dropdown-menu').addClass("open");
            }
        });
        $(".submenu").each(function(key,value){
           if($(this).parent('li').attr('class') != undefined && $(this).parent('li').attr('class') != null && $(this).parent('li').attr('class') == "open"){
             $(this).parent('li').removeClass('open');
           }
        });
      
});
$('.dropdown-menu').live("click touchstart",function(){
   $(this).parent('div').addClass("open"); 
   $(this).parent('li').addClass("open"); 
});    
});
</script>

</body>
</html>
