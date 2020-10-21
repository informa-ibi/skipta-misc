



 <?php $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
$displayName = Yii::app()->session['TinyUserCollectionObj']['DisplayName'];
?>
         <div id="wah-menu" class="wah-menu" >
    <div class="wah-ul">
    <div class="tr_left_pannel " >
    	<div class=" row-fluid">
                <div class="span12">
                <div class="trinity_logo "><img src="/images/system/spacer.png" /></div>
              </div>      
        </div> 
        </div>
        <div class="preloginbg" >
<div class="pre_loginheader">Login</div>
                            <div class=" logindivarea " role="menu" aria-labelledby="dLabel" id="loginarea"  >
<?php include_once(getcwd()."/protected/views/site/login.php");?>
                            </div>
</div>
        </div>
                      

        </div>
        </div>
         </div>
<script type="text/javascript">
    $(document).ready(function(){
        Custom.init();

    });
    
    function loginHandler(data) {
    $("#LoginForm_password").val("");
     if (data.status == "success") {
        window.location.href = "/stream";
    } else {       
        var error=[];
        if(typeof(data.error)=='string'){
            var error=eval("("+data.error.toString()+")");
        }else{
            var error=eval(data.error);
        }
        $.each(error, function(key, val) {            
            if(key == "LoginForm_error"){
                $("#LoginForm_password_em_,#LoginForm_username_em_").text("");                                                    
                $("#LoginForm_password_em_,#LoginForm_username_em_").hide();                        
                $("#LoginForm_password,#LoginForm_username").parent().removeClass('error');
                $('#errormaindiv').show();
                $('#LoginForm_error_em_').removeClass('errorMessage');
                $('#LoginForm_error_em_').addClass('errorMessageNoStyle');
                $('#errormaindiv').fadeOut(5000);
            }
            if($("#"+key+"_em_")){   
                $("#"+key+"_em_").text(val);                                                    
                $("#"+key+"_em_").show();   
                      $("#"+key+"_em_").fadeOut(5000);
                $("#"+key).parent().addClass('error');
            }
        });         
    }
}
</script>