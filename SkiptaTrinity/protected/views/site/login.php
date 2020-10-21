<span id="loginSpinner"></span>
    <div class="row-fluid">
                <div class="span12">
                    
<?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'login-form',
                                'enableClientValidation' => true,
                                'enableAjaxValidation' => false,
                                'focus'=>array($this->model,'email')
                                    ));
                            ?>

<div class="row-fluid loginError" style="display:none" id="errormaindiv">
    <div class="span12">
         <div class="control-group controlerror"><?php echo $form->error($this->model,'error'); ?> </div>
</div>
</div>
<div class="row-fluid verticalview horizontalview">
    <div class="span10 ">
    <div class="row-fluid">
    <div class="span6 verticalview1">
     <?php echo $form->label($this->model,Yii::t('translation', 'username'),array('class' => 'horizontalviewlbl') ); ?>
    <div class="control-group controlerror">
        
      <?php echo $form->textField($this->model,'email',array('maxlength' => 40, 'class' => 'span12 logininput')); ?>        
                        <?php echo $form->error($this->model,'email'); ?>
    </div>
    </div>
    
    <div class="span6 verticalview2">
     <?php echo $form->label($this->model, Yii::t('translation', 'password'),array('class' => 'horizontalviewlbl')); ?>
      <div class="control-group controlerror">
      <?php echo $form->passwordField($this->model,'pword',array('maxlength' => 40, 'class' => 'span12 logininput','autocomplete'=>'off')); ?>  
       <?php echo $form->error($this->model,'password'); ?>
                      
      </div>
    </div>
       
    </div>
    <div class="row-fluid">
    <div class="span6 verticalview3">
        <p class="login-text-blue">
     <a onclick="divrender('myModal','/site/forgot');" href="" data-toggle="modal" data-target="#myModal">forgot password?</a>
   </p>
    </div>
    <div class="span6 verticalview4">
  <span class="pre_fontsize14 verticalmiddle "><?php echo Yii::t('translation','KeepMeLoggedIn')?></span>
      <?php echo $form->checkBox($this->model,'rememberMe',array('class' => 'styled')); ?>        
    </div>
    </div>
    </div>
     <div class="span2 verticalview5">
            <?php echo CHtml::ajaxSubmitButton('Login', '/site/login', array('type' => 'POST', 'dataType' => 'json','success' => 'function(data,status,xhr) { loginHandler(data,status,xhr);}'), array('type' => 'submit', 'class' => 'btn btn_prelogin  margintop0', 'id' => 'loginBtnId', 'data-loading-text' => 'logging...', 'tabIndex' => '3')); ?>
        </div>
    
    
</div>
 

  

<?php $this->endWidget();?>
                </div>
                </div>
 

<script type="text/javascript">
    function loginHandler(data) {       
    $("#LoginForm_password").val("");    
    
     if (data.status == "success") {
        window.location = "/stream";
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
    if(navigator.appName=="Microsoft Internet Explorer"){
    $("#LoginForm_email").css( "width","160px" );
     $("#LoginForm_password").css( "width","160px" );
    }
 $('input[type=text]').focus(function(){      
     if(navigator.appName=="Microsoft Internet Explorer"){
        $(this).css( "background","#fff");
        $(this).css( "padding-left","5px" );
        $(this).css( "width","160px" )
     }
  clearerrormessage(this);
});
$('input[type=password]').focus(function(){
    if(navigator.appName=="Microsoft Internet Explorer"){
        $(this).css( "background","#fff" );
        $(this).css( "padding-left","5px" );
        $(this).css( "width","160px" )
     }
   clearerrormessage(this);
});

if(navigator.appName=="Microsoft Internet Explorer"){
$('input[type=text]').focusout(function(){ 
 if($("#LoginForm_email").val()==''){
     $(this).css( "background","");
        $(this).css( "padding-left","" );
 }
 
});
$('input[type=password]').focusout(function(){ 
 if($("#LoginForm_password").val()==''){
     $(this).css( "background","");
       $(this).css( "padding-left","" );
 }
 
});
}
  $(document).ready(function(){
        var error=$('#login-form').find('.errorMessage');        
        $.each(error, function(key, val) {         
       
                $("#"+val.id).fadeOut(5000);
            
        });         
        })
         function logincallback(data, txtstatus, xhr) {
            
        var data = eval(data);
        alert(data.status);
        if (data.status == 'success') {
            
          //  var joyrideToLoad=data.joyrideToLoad;
           // alert(joyrideToLoad);
           
            
            var returnValue= 1;//trackBrowseDetails("http://localhost/");
            if(returnValue==1){
             if (getCookie('r_u') != "" && getCookie('r_u') !='<?php echo Yii::app()->params["ServerURL"]."/site";?>') {
                var returnUrl = getCookie('r_u');
               
                   window.location = returnUrl.replace(/%2F/g, "/");
           
            }
          
           
            else {
                    window.location = '/stream';
                         }   
            }
        
            


        } else {
            var lengthvalue = data.error.length;
            var msg = data.data;
            var error = [];
            if (msg != "") {

                if (msg == "You have entered wrong password") { 
                    $("#LoginForm_pword_em_").text(msg);
                    $("#LoginForm_pword_em_").show();
                    $("#LoginForm_pword_em_").fadeOut(5000);
                    $("#LoginForm_pword_em_").parent().addClass('error');
                } else {
                    $("#LoginForm_email_em_").text(msg);
                    $("#LoginForm_email_em_").show();
                    $("#LoginForm_email_em_").fadeOut(5000);
                    $("#LoginForm_email_em_").parent().addClass('error');
                }

           } else {

                if (typeof (data.error) == 'string') {

                    var error = eval("(" + data.error.toString() + ")");

                } else {
                    var error = eval(data.error);
                }


                $.each(error, function(key, val) {

                    if ($("#" + key + "_em_")) {
                        $("#" + key + "_em_").text(val);
                        $("#" + key + "_em_").show();
                        $("#" + key + "_em_").fadeOut(5000);
                        $("#" + key).parent().addClass('error');
                    }

                });
            }
        }
    }
    
function registernow(){
    $('body, html').animate({scrollTop : 0}, 400,function(){
        $("#registrationdropdown").addClass("open");
    });
            
        }
    $(document).ready(function() {
        $('input[id=UserRegistrationForm_email]').tooltip({'trigger': 'hover'});
    });
    function registercallback(data, txtstatus, xhr) {
        scrollPleaseWaitClose('registrationSpinLoader');
        var data = eval(data);
        if (data.status == 'success') {
            var msg = data.data;
            $("#sucmsg").html(msg);
            $("#sucmsg").css("display", "block");
            $("#errmsg").css("display", "none");
            $("#userregistration-form")[0].reset();
            $('#registartion_country').find('span').text("Please Select country");
            $('#registration_primary').find('span').text("Choose One");
            $('#registartion_state').find('span').text("Please Select state");
            $('.checkbox').css('background-position', '0px 0px');
            $('.radio').css('background-position', '0px 0px');
            $("#sucmsg").fadeOut(5000,function(){
            $("#registrationdropdown").removeClass("open");
            }); 
           
            //$("form").serialize()
        } else {
            var lengthvalue = data.error.length;
            var msg = data.data;
            var error = [];
            if (msg != "") {

                $("#errmsg").html(msg);
                $("#errmsg").css("display", "block");
                $("#sucmsg").css("display", "none");
                $("#errmsg").fadeOut(5000);

            } else {

                if (typeof (data.error) == 'string') {

                    var error = eval("(" + data.error.toString() + ")");

                } else {
                    var error = eval(data.error);
                }


                $.each(error, function(key, val) {

                    if ($("#" + key + "_em_")) {

                        // alert(key);
                        $("#" + key + "_em_").text(val);
                        $("#" + key + "_em_").show();
                        $("#" + key + "_em_").fadeOut(5000);
                        $("#" + key).parent().addClass('error');
                    }

                });
            }
        }

    }
    /*
     * Handler for requesting new password
     */
    function forgotPasswordHandler(data, txtstatus, xhr) {
        scrollPleaseWaitClose("forgotpasswordSpinLoader");
        var data = eval(data);
        if (data.status == 'success') {
            var msg = data.data;
            $("#sucmsgForForgot").html(msg);
            $("#errmsgForForgot").css("display", "none");
            $("#sucmsgForForgot").css("display", "block");
            $("#forgot-form")[0].reset();
             $("#sucmsgForForgot").fadeOut(5000,function(){
            $("#forgotPasasworddropdown").removeClass("open");
            }); 
            //$("form").serialize()
        } else {
            var lengthvalue = data.error.length;
            var msg = data.data;
            var error = [];
            if (msg != "") {
                $("#errmsgForForgot").html(msg);
                $("#errmsgForForgot").css("display", "block");
                $("#sucmsgForForgot").css("display", "none");
                $("#errmsgForForgot").fadeOut(5000);

            } else {

                if (typeof (data.error) == 'string') {

                    var error = eval("(" + data.error.toString() + ")");

                } else {

                    var error = eval(data.error);
                }


                $.each(error, function(key, val) {

                    if ($("#" + key + "_em_")) {
                        $("#" + key + "_em_").text(val);
                        $("#" + key + "_em_").show();
                        $("#" + key + "_em_").fadeOut(5000);
                        //  $("#"+key).parent().addClass('error');
                    }

                });
            }
        }
    }
    
    function getCookie(cname)
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');

        for (var i = 0; i < ca.length; i++)
        {

            var c = $.trim(ca[i]);
            if (c.indexOf(name) == 0)
                return c.substring(name.length, c.length);
        }
        return "";
    }
 sessionStorage.clear();
    </script>