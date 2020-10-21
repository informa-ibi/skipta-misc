 <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'userregistration-form',
                            'method'=>'post',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                                'validateOnChange' => true,
                            ),
                            'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'marginzero'),
                                ));
                        ?>
                   

      
<h2 class="pagetitle positionrelative searchfiltericon"><?php echo Yii::t('translation','User_Settings'); ?> </h2>  
                 
        

                <div class="accordion " style="padding-top:20px" id="accordion2">
<div class="accordion-group customaccordion-group">
<div class="accordion-heading customaccordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
Profile Details
</a>
</div>
<div id="collapseOne" class="accordion-body collapse in">
<div class="accordion-inner customaccordion-inner">
     <div class="custaccrodianouterdiv">
     <div id="registrationSpinLoader"></div>
                      <div class="alert-error" id="errmsg" style='padding-top: 5px;text-align:center;display:none;'> 
                        
                      </div>
                       <div class="alert-success" id="sucmsg" style='padding-top: 5px;text-align:center;display:none;'>                          
                       </div>
   <div class="regdiv">

                <div class="row-fluid padding-bottom10">
                <div class="span6">
                
                    <label><?php echo Yii::t('translation','User_Register_Firstname'); ?></label>
                      <div class="control-group controlerror marginbottom10">
                      <?php echo $form->textField($UserRegistrationForm, 'firstName', array("id" => "UserRegistrationForm_firstName", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>
                  
                     <?php echo $form->error($UserRegistrationForm,'firstName'); ?>
                     
                    </div>
                </div>
                <div class="span6">
                      
                        <label><?php echo Yii::t('translation','User_Register_Lastname'); ?></label>
                         <div class="control-group controlerror marginbottom10">
                        <?php echo $form->textField($UserRegistrationForm, 'lastName', array("id" => "UserRegistrationForm_lastName", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>
                        
                            <?php echo $form->error($UserRegistrationForm,'lastName'); ?>
                     </div>
                </div>
                
                  </div>
                    
                    <div class="row-fluid padding-bottom10">
                    <div class="span6">
                    
                    <label><?php echo Yii::t('translation','User_Register_Company'); ?></label>
                    <div class="control-group controlerror marginbottom10">
                    <?php echo $form->textField($UserRegistrationForm, 'companyName', array("id" => "UserRegistrationForm_companyName", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>
                        <?php echo $form->error($UserRegistrationForm,'companyName'); ?>
                    </div>
                </div>
                 <div class="span6">
                    
                        <label><?php echo Yii::t('translation','User_Register_Email'); ?></label>

                         <div class="control-group controlerror marginbottom10">

                         <?php echo $form->textField($UserRegistrationForm, 'email', array("id" => "UserRegistrationForm_email",'autocomplete'=>'off', 'maxlength' => '30','data-original-title'=>'This will be your Username to access the network','rel'=>'tooltip', 'data-placement'=>'bottom', 'lass'=>'tooltiplink', 'class' => 'tooltiplink span12 textfield')); ?>

                       
                             <?php echo $form->error($UserRegistrationForm,'email'); ?>
                     </div>
                </div>
               </div>
              <div class="row-fluid padding-bottom10">

                <div class="span6 divrelative" id="registartion_country">
                 
                    <label><?php echo Yii::t('translation','User_Register_Country'); ?></label>
                      <?php   echo $form->dropDownList($UserRegistrationForm, 'country',CHtml::listData(Countries::model()->findAll(),'Id','Name'), array(
                        'class'=>"styled span12 textfield",
                        'empty'=>"Please Select country",  
                        'ajax' => array(
                                        'type' => 'POST',
                                        'url'=>$this->createUrl('user/dynamicstates'),   
                                        'update' => '#UserSettingsForm_state',                        
                                        'data'=>array('country'=>'js:this.value',), 
                                        'success'=> 'function(data) {
                                            if (data.indexOf("<option") !=-1){
                                             $("#dynamicstates").show();
                                             $("#dynamicstatetextbox").hide();
                                              $("#dynamicstatetextbox").html("");
                                                 $("#UserSettingsForm_state").empty();
                                                  $("#registartion_state").find("span").text("Please Select state");
                                                        $("#UserSettingsForm_state").append(data);
                                                        $("#UserSettingsForm_state").trigger("liszt:updated");

                                        }else{
                                             $("#dynamicstates").hide();
                                            $("#dynamicstatetextbox").show();
                                            $("#dynamicstatetextbox").html();
                                            $("#dynamicstatetextbox").html(data);
                                        }


                                                                } ',

                        )));
                      ?>
                   
                    
                        <div class="control-group controlerror marginbottom10">
                                   <?php echo $form->error($UserRegistrationForm,'country'); ?>
                     </div>
                   </div>
                     <div class="span6 divrelative" id="registartion_state" >
                     <label><?php echo Yii::t('translation','User_Register_State'); ?></label>
                     <div id="dynamicstates">
                     <?php echo $form->dropDownlist($UserRegistrationForm, 'state',CHtml::listData(State::model()->findAll("CountryId=1"),'id','State'),array(),array(
                        'class'=>"styled span12 textfield",
                        'empty'=>"Please Select state",
                            ));
                        ?>
  
                     </div>
                     <div id="dynamicstatetextbox" style="display:none">
                       
                     </div>
                        <div class="control-group controlerror marginbottom10">
                            <?php echo $form->error($UserRegistrationForm,'state'); ?>
                     </div>

                </div>
                </div>
                <div class="row-fluid padding-bottom10">
               <div class="span6 divrelative">
                   
                    <label><?php echo Yii::t('translation','User_Register_City'); ?></label>
                      <div class="control-group controlerror marginbottom10"  >
                         <?php echo $form->textField($UserRegistrationForm, 'city', array("id" => "UserRegistrationForm_city", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>
                             <?php echo $form->error($UserRegistrationForm,'city'); ?>
                          </div>
                </div>
                
                    <div class="span6">
                     
                    <label><?php echo Yii::t('translation','User_Register_Zip'); ?></label>
                     <div class="control-group controlerror marginbottom10"> 
                        <?php echo $form->textField($UserRegistrationForm, 'zip', array("id" => "UserRegistrationForm_zip", 'maxlength' => '10', 'class' => 'span12 textfield')); ?>
                      
                            <?php echo $form->error($UserRegistrationForm,'zip'); ?>
                    </div>
                </div>

                </div>

                    <div class="headerbuttonpopup" style="padding-top: 10px">
                       <?php
                                            echo CHtml::ajaxSubmitButton('Update', array('user/updateusersettings'),array(
                                                    'type'=>'POST',
                                                'dataType' => 'json',
                                                'error'=>'function(error){
                                                   
                                                   }',
                                                'beforeSend' => 'function(){
                                                     scrollPleaseWait("registrationSpinLoader","userregistration-form");
                                                     $("#UserRegistrationForm_referenceUserId").val(referenceUserId);
                                                     
                                                }',
                                                'complete' => 'function(){
                                                     
                                                    }',
                                                'success' => 'function(data,status,xhr) {  registercallback(data);}'),
                                                    array('type' => 'submit','id' => 'userregistration','class'=>'btn btn-2 btn-2a pull-right')
                                                    );
                                        ?>
                                   </div>

                                
      </div>
    <?php $this->endWidget(); ?>
</div>
</div>
</div>
</div>
<div class="accordion-group customaccordion-group">
<div class="accordion-heading customaccordion-heading">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
<?php echo Yii::t('translation','User_ChangePassword'); ?>
</a>
</div>
<div id="collapseTwo" class="accordion-body collapse">
<div class="accordion-inner customaccordion-inner">
    <div class="custaccrodianouterdiv">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'changepassword-form',
    'method' => 'post',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'marginzero'),
        ));
?>
                  
         <div id="changepassSpinLoader"></div>
                      <div class="alert-error" id="passerrmsg" style='padding-top: 5px;text-align:center;display:none;'> 
                        
                      </div>
                       <div class="alert-success" id="passsucmsg" style='padding-top: 5px;text-align:center;display:none;'></div>
<div class="regdiv"> 
        <div class="row-fluid">
         <div class="span6">

            <label><?php echo Yii::t('translation', 'User_Current_Password'); ?></label>

            <div class="control-group controlerror marginbottom10" >


                <?php echo $form->passwordField($ChangePasswordForm, 'password', array("id" => "UserRegistrationForm_password", 'maxlength' => '30', 'class' => 'span12 pwd', 'autocomplete' => 'off')); ?>
<!--                         <img src="images/icons/helpicon.png" onclick="openpopup()" >-->


                <div id="pwderror" class="errorMessage" style="display:none" ></div>
                <?php echo $form->error($ChangePasswordForm, 'password'); ?>
            </div>
        </div>
            </div>
            <div class="row-fluid">
        <div class="span6">

            <label><?php echo Yii::t('translation', 'User_New_Password'); ?>
            <div class="tooltip-options pull-right"  style="margin-bottom:3px">
    <i data-toggle="tooltip" title="<div class=repwddiv> Your password must adhere to the following rules: <ol ><li type=numbers> It cannot contain your first name.</li><li> It cannot contain your email address.</li><li>  It cannot contain the domain name of this network.</li><li>  It has to contain at least one special character, one lowercase letter, one numeric and one capital letter.</li><li>  It has to be at least 8 characters long.</li></ol></div>"   data-placement="left" class="fa fa-question  helpicon helprelative tooltiplink" data-id=""></i>

</div>
            </label>

            <div class="control-group controlerror marginbottom10" >


                <?php echo $form->passwordField($ChangePasswordForm, 'newPassword', array("id" => "UserRegistrationForm_New_password", 'maxlength' => '30', 'class' => 'span12 pwd', 'autocomplete' => 'off')); ?>
<!--                         <img src="images/icons/helpicon.png" onclick="openpopup()" >-->


                <div id="pwderror" class="errorMessage" style="display:none" ></div>
                <?php echo $form->error($ChangePasswordForm, 'newPassword'); ?>
            </div>
        </div>
       
        <div class="span6">

            <label><?php echo Yii::t('translation', 'User_New_Confirm_Password'); ?></label>

            <div class="control-group controlerror marginbottom10">

                <?php echo $form->passwordField($ChangePasswordForm, 'confirmNewPassword', array("id" => "UserRegistrationForm_confirmpassword", 'maxlength' => '30', 'class' => 'span12 pwd', 'autocomplete' => 'off')); ?>


                <?php echo $form->error($ChangePasswordForm, 'confirmNewPassword'); ?>
            </div>
        </div>
         
            <div class="headerbuttonpopup" style="padding-top: 10px">
                       <?php
                                            echo CHtml::ajaxSubmitButton('Change Password', array('user/changepassword'),array(
                                                    'type'=>'POST',
                                                'dataType' => 'json',
                                                'error'=>'function(error){
                                                   
                                                   }',
                                                'beforeSend' => 'function(){
                                                   scrollPleaseWait("changepassSpinLoader","changepassword-form");
                                                 
                                                }',
                                                'complete' => 'function(){
                                                     
                                                    }',
                                                'success' => 'function(data,status,xhr) {  changepasswordcallback(data);}'),
                                                    array('type' => 'submit','id' => 'qqq','class'=>'btn btn-2 btn-2a pull-right')
                                                    );
                                        ?>
                                   </div>
            
 
            
        </div>

        </div>         
 <?php $this->endWidget(); ?>
</div>
</div>
</div>
</div>
</div> 
  





<script type="text/javascript">
Custom.init();
$('input[type=text]').focus(function(){
   clearerrormessage(this);
});
$('input[type=password]').focus(function(){
   clearerrormessage(this);
});

 $(function () { $(".tooltip-options i").tooltip({html : true });});



function checkpassword(obj){
    var pwd=obj.value;
    var firstname= $('#UserRegistrationForm_firstName').val();
     var lastname= $('#UserRegistrationForm_lastName').val();
     var queryString = "password="+pwd+"&firstname="+firstname+"&lastname="+lastname+"&id="+obj.id;
     ajaxRequest("/site/checkpassword", queryString, passwordcheckHandler); 
}


function passwordcheckHandler(data){

    if(data.status=='success'){
       
      $("#pwderror").hide();  
    }else{

      // var lengthvalue=data.error.length;
        $("#pwderror").text(data.message); 
            $("#pwderror").show();  
 
           }
} 

function updatePassword(){
    alert("=====1===");
     var oldPass= $('#UserRegistrationForm_password').val();
     var newPass= $('#UserRegistrationForm_New_password').val();
     var newConPass= $('#UserRegistrationForm_confirmpassword').val();
     var queryString = "password="+oldPass+"&newPassword="+newPass+"&newConfirmPassword="+newConPass;
     alert("=====2===");
     ajaxRequest("/user/changepassword", queryString, updatePasswordHandler); 
}


function updatePasswordHandler(data){

    if(data.status=='success'){
       
      $("#pwderror").hide();  
    }else{

      // var lengthvalue=data.error.length;
        $("#pwderror").text(data.message); 
            $("#pwderror").show();  
 
           }
}

 function registercallback(data) {
     scrollPleaseWaitClose('registrationSpinLoader');
        var data = eval(data);
        if (data.status == 'success') {
            var msg = data.data;
            $("#sucmsg").html(msg);
            $("#sucmsg").css("display", "block");
            $("#errmsg").css("display", "none");

            $("#sucmsg").fadeOut(5000,function(){
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
    
    function changepasswordcallback(data) {
        scrollPleaseWaitClose('changepassSpinLoader');
        var data = eval(data);
        if (data.status == 'success') {
            var msg = data.data;
            $("#passsucmsg").html(msg);
            $("#passsucmsg").css("display", "block");
            $("#passerrmsg").css("display", "none");
            $("#changepassword-form")[0].reset();
            $("#passsucmsg").fadeOut(5000,function(){

            }); 

        } else {
            var lengthvalue = data.error.length;
            var msg = data.data;
            var error = [];
            if (msg != "") {

                $("#passerrmsg").html(msg);
                $("#passerrmsg").css("display", "block");
                $("#passsucmsg").css("display", "none");
                $("#passerrmsg").fadeOut(5000);

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
</script>
