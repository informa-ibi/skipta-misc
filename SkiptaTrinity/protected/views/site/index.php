<div id="tosAndPrivacyPolicy"></div>
<div class="row-fluid">
        <div class="span12">
            <div class="banner">
            <img src="/images/system/banner_img.png"  /></div>
      </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
        <div class="home_welcome_text">
           
            Welcome to<br/><br/>
                <b>TRINITY TEAM</b>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam </p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam </p>
              
       
        </div>
        </div>
     </div>

             <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog ">
                    <div class="modal-content ">
                        <div class="modal-header" id="resetPassword_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="resetPasswordLabel">Reset your password</h4>
                        </div>
                        <div class="modal-body" id="resetPassword_body">
     <?php include_once(getcwd()."/protected/views/site/resetpassword.php");?>
                        </div>
                        <div class="modal-footer" id="resetPassword_footer">
                           
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>  
   <!-- /.modal -->
<script type="text/javascript">
    
    
    <?php if(isset($referenceUserId) && $referenceUserId!=""){?>
        referenceUserId = '<?php echo $referenceUserId;?>';
        reCeipientEmailId='<?php echo $referenceUserEmail;?>';
        
    <?php } ?>
<?php if(isset($ispaswordreset) && $ispaswordreset=="true"){?>
    
 $('#resetPasswordModal').modal("show");
 $('#ResetForm_email').val("<?php echo $resetForm->email;?>");
  $('#ResetForm_md5UserId').val("<?php echo $resetForm->md5UserId;?>");
<?php }

if(isset($resetpasswordexpirederror)){?>
   $('#resetPasswordModal').modal("show");
 $('#resetPassword_body').html('<?php echo $resetpasswordexpirederror;?>');
<?php }

?>

 Custom.init();  
</script>

