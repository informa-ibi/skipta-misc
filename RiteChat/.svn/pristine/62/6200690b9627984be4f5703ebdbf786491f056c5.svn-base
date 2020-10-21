<?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'login-form',
                                'enableClientValidation' => true,
                                'enableAjaxValidation' => false,
                                'focus'=>array($this->model,'email')
                                    ));
                            ?>
<div class="row-fluid" style="display:none" id="errormaindiv">
    <div class="span12">
         <div class="control-group controlerror"><?php echo $form->error($this->model,'error'); ?> </div>
</div>
</div>

    <div class="row-fluid">
    <div class="span12">
     <?php echo $form->label($this->model, Yii::t('translation', 'username')); ?>
    <div class="control-group controlerror">
      <?php echo $form->textField($this->model,'email',array('maxlength' => 40, 'class' => 'span12 logininput')); ?>        
                        <?php echo $form->error($this->model,'email'); ?>
    </div>
    </div>
    </div>
    <div class="row-fluid">
    <div class="span12">
     <?php echo $form->label($this->model, Yii::t('translation', 'password')); ?>

      <div class="control-group controlerror">
      <?php echo $form->passwordField($this->model,'pword',array('maxlength' => 40, 'class' => 'span12 logininput','autocomplete'=>'off')); ?>  
                        <?php echo $form->error($this->model,'password'); ?>
                      
      </div>
    </div>
    </div>

 <p class="login-text-blue">
     <a onclick="divrender('myModal','<?php Yii::app()->getBaseUrl()?>/site/forgot');" href="#" data-toggle="modal" data-target="#myModal">Forgot Password?</a>
   </p>
<div class="row-fluid">
    <div class="span12">
    <div class="span7"><input type="checkbox" class="styled " checked="checked" id="rememberMe_login" name="rememberMe_login"> <span class="fontsize12 verticalmiddle">Remember me</span></div>
        <div class="span5 alignright" > <?php echo CHtml::ajaxSubmitButton('Login', '/site/login', array('type' => 'POST', 'dataType' => 'json', 'success' => 'function(data,status,xhr) { loginHandler(data,status,xhr);}'), array('type' => 'submit', 'class' => 'btn margintop0', 'id' => 'loginBtnId', 'data-loading-text' => 'logging...', 'tabIndex' => '3')); ?>
               </div>
    </div>
    </div>

<?php $this->endWidget();?>

<script type="text/javascript">
function loginHandler(data) {
    $("#model_password").val("");
     if (data.status == "success") { 
                 if(getCookie('r_u')!=""){
                var returnUrl=getCookie('r_u');
                window.location =  returnUrl.replace(/%2F/g,"/");
         }
         else{
               window.location='/stream';
         }
       
    } else {       
        var error=[];
        if(typeof(data.error)=='string'){
            var error=eval("("+data.error.toString()+")");
        }else{
            var error=eval(data.error);
        }
        $.each(error, function(key, val) {            
            if(key == "model_error"){
                $("#model_password_em_,#model_username_em_").text("");                                                    
                $("#model_password_em_,#model_username_em_").hide();                        
                $("#model_password,#model_username").parent().removeClass('error');
                $('#errormaindiv').show();
                $('#model_error_em_').removeClass('errorMessage');
                $('#model_error_em_').addClass('errorMessageNoStyle');
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
$('input[type=text]').keypress(function(){
 $('#'+this.id+'_em_').fadeOut(2000);

});
$('input[type=password]').keypress(function(){
$('#'+this.id+'_em_').fadeOut(2000);
});
 function getCookie(cname)
{
var name = cname + "=";
var ca = document.cookie.split(';');

for(var i=0; i<ca.length; i++)
  {
     
  var c = $.trim(ca[i]);
  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
}
return "";
}
  Custom.init();
</script>