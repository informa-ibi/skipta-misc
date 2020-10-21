<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('translation', 'Password_Recovery');?></h4>
      </div>
      <div class="modal-body">
            <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'forgot-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'style' => 'margin: 0px; accept-charset=UTF-8',
        ),
    ));
    ?>
       <div class="signdiv">
 
    <div class="headerdisclaimer"><?php echo Yii::t('translation', 'Password_Recovery_Text');?></div>
    <div class="row-fluid">
        <div class="span12 forgotpassword">
    <div class="alert alert-success" style="display:none">
        <?php echo $form->error($forgotform, 'success'); ?>
    </div>
    <div class="alert alert-error" style="display:none">
        <?php echo $form->error($forgotform, 'error'); ?>
    </div>
    <?php echo $form->labelEx($forgotform, Yii::t('translation', 'email')); ?>
    <div class="control-group controlerror">
        <?php echo $form->textField($forgotform, 'email', array('maxlength' => 40, 'class' => 'span12 email', 'id' => 'ForgotForm_email')); ?>
        <?php echo $form->error($forgotform, 'email'); ?>
    </div>
            
             <div class="headerbuttonpopup h_center padding8top">
        <?php
        echo CHtml::ajaxSubmitButton('Recover Password', array('site/forgot'), array(
            'type' => 'POST',
            'dataType' => 'json',
            'beforeSend'=>'function(){disable("forgotBtnId");}',
            'success' => 'function(data,status,xhr) { forgotPasswordHandler(data,status,xhr);}'), array('data-loading-text'=>"Loading...",'type' => 'submit', 'id' => 'forgotBtnId', 'class' => 'btn btn-2 btn-2a pull-right')
        );
        ?>
    </div>
    
 </div>
        </div>
</div> 
           
          <?php $this->endWidget(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  <script type="text/javascript">
function forgotPasswordHandler(data){
    if (data.status == "success") 
    {
        var msg = data.data;
        $('.alert-success').show();
        $("#ForgotForm_success_em_").text(msg);
        $("#ForgotForm_success_em_").removeClass();
        $("#ForgotForm_success_em_").attr("style","padding:0");
        $("#ForgotForm_success_em_").show();
        $('.alert-success').fadeOut(5000,function(){
        });      
    } 
    else if(data.status=='exception')
    {
        $('.alert-error').show();
        var msg = data.data;
        $("#ForgotForm_error_em_").text(msg);
        $("#ForgotForm_error_em_").removeClass();
        $("#ForgotForm_error_em_").attr("style","padding:0");
        $("#ForgotForm_error_em_").show();
        $('.alert-error').fadeOut(5000,function(){
        });  
    }
    else 
    {  
        var error=[];
        if(typeof(data.error)=='string'){
            var error=eval("("+data.error.toString()+")");
        }else{
            var error=eval(data.error);
        }
        $.each(error, function(key, val) {
            if($("#"+key+"_em_")){   
                $("#"+key+"_em_").text(val);                                                    
                $("#"+key+"_em_").show();     
                $("#"+key+"_em_").fadeOut(5000,function(){
        });  
                $("#"+key).parent().addClass('error');
            }
        });         
    }
    $('#forgotBtnId').val('Recover Password');
    $('#forgotBtnId').removeAttr('disabled');
} 
function disable(button_id)
{
    $('#'+button_id).val('Processing...');
    $('#'+button_id).attr('disabled',true);
    
}
  </script>