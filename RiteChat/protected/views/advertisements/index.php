 <h2 class="pagetitle">Advertisements</h2> 
<div class="searchgroups" >  
<input class="btn " id='addGroup' name="commit" type="submit" data-toggle="dropdown" value="New Advertisement" /> 
<div id="addNewAd" class="dropdown dropdown-menu actionmorediv actionmoredivtop newgrouppopup newgrouppopupdivtop"  >
    <div class="row-fluid">
        <div class="span12">
            <div class="headerpoptitle_white"><?php echo Yii::t('translation', 'New_Advertisement'); ?></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'advertisement-form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                //'action'=>Yii::app()->createUrl('//user/forgot'),
                'htmlOptions' => array(
                    'style' => 'margin: 0px; accept-charset=UTF-8',
                ),
            ));
            ?>
            <div id="advertisementSpinner"></div>
                <div class="alert alert-error" id="errmsgForAd" style='display: none'></div>
                <div class="alert alert-success" id="sucmsgForAd" style='display: none'></div> 
            
                
            <div class="row-fluid  " id="" >
                <div class="span4">

                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Advertisement Type')); ?>
                    <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'AdTypeId',$adTypes , array(
                            'class' => "",
                            'empty' => "Please select adtype",
                             'onchange'=>'loadAdType()',
                            'id'=>'AdTypeId'
                        ));
                        ?>   
                    </div>
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'AdTypeId'); ?>
                    </div>
                </div>
                
                <div class="span4">

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'AdName')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($advertisementForm, 'Name', array('maxlength' => 50, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'Name'); ?>
                    </div>
                </div>
                <div class="span4" id="adTitle" style="display: none">

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Title'),array('id'=>'inlineTitle')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($advertisementForm, 'Title', array('maxlength' => 50, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'Title'); ?>
                    </div>
                </div>
                 </div>
             
                
                <div class="row-fluid  " id='AdunitGroup' style="display: none">
                    <div class="span4" >

                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Display_Position')); ?>
                    <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'DisplayPosition', array('Top' => 'Top', 'Middle' => 'Middle', 'Bottom' => 'Bottom'), array(
                            'class' => "",
                            'empty' => "Please select position",
                        ));
                        ?>   
                    </div>
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'DisplayPosition'); ?>
                    </div>
                </div>
                    
                    
                    <div class="span4" id='AutoModeDiv' style="display: none">
                        <label   >Does this Ad rotate?</label>
                        <?php echo $form->checkBox($advertisementForm,'IsThisAdRotate',array('class' => 'styled','id'=>'isThisAdRotateCB'))?>
                        
                    </div> 

                      <div class="span4" id="timeInterval" style="display: none" >
                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Time_Interval')); ?>
                    <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'TimeInterval', array(10 => '10 sec', 30 => '30 sec', 60 => '60 sec'), array(
                            'class' => "",
                            'empty' => "Please select time interval",
                        ));
                        ?>   
                    </div>
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'TimeInterval'); ?>
                    </div>
                    </div>
                       
                     
              
                    
               
            </div>
            <div class="row-fluid  " id='isThisExternalParty' style="display: none">
                <div class="span4" id='ExternalPartyDiv'>
                    Is this on behalf of an external party?
                    <?php echo $form->checkBox($advertisementForm, 'IsThisExternalParty', array('class' => 'styled', 'id' => 'isThisExternalPartyCB')) ?>

                </div>
                 <div class="span4" id="externalPartyName" style="display: none">

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'externalPartyName')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($advertisementForm, 'ExternalPartyName', array('maxlength' => 50, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'ExternalPartyName'); ?>
                    </div>
                </div>
                <div class="span4 positionrelative" id="externalPartyLogo" style="display: none">
                    <i id="StreamAdDimension"  class="fa fa-question helpmanagement helpicon top10  tooltiplink" style="font-weight: normal;z-index: 5;top: 13px;" data-id="ExternalLogoDimension_DivId" data-placement="bottom" rel="tooltip"  data-original-title="Logo Dimentions" ></i>
                           <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'externalPartyLogo')); ?>
                          <div class="row-fluid">
                               <div class="span4">
                               <div id="ExternalPartyLogo" class="uploadicon"><img src="/images/system/spacer.png">
                            </div>
                          </div>
                               <div class="span5">
                              <img id="ExternalPartyLogoPreview" name="AdvertisementForm[ExternalPartyUrl]"  src="" alt="" style="border:0;height:30px" />
                          </div>
                          </div>
                     <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'ExternalPartyUrl'); ?>
                </div>
                    
                
                    
                 </div>

            </div>
            <div class="row-fluid  ">
               <div class="span4">

                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Display_Page')); ?>
                    <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'DisplayPage', array('Home' => 'Home', 'Curbside' => 'Curbside', 'Group' => 'Group'), array(
                            'class' => "",
                            'empty' => "Please select page",
                            'onchange'=>'checkToLoadGroups()',
                            'id'=>'DisplayPage'
                        ));
                        ?>   
                    </div>
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'DisplayPage'); ?>
                    </div>
                </div> 
             
               <div class="span4">
                    <div id="dpd2" class="input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">

                        <label><?php echo Yii::t('translation', 'Start_Date'); ?></label>
<?php echo $form->textField($advertisementForm, 'StartDate', array('maxlength' => '20', 'class' => 'textfield span8 ', 'readonly' => "true")); ?>    
                        <span class="add-on">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <div class="control-group controlerror"> 
<?php echo $form->error($advertisementForm, 'StartDate'); ?>
                        </div>

                    </div>

                </div>  

                <div class="span4">
                    <div id="dpd1" class="input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">

                        <label><?php echo Yii::t('translation', 'Expiry_Date'); ?></label>
<?php echo $form->textField($advertisementForm, 'ExpiryDate', array('maxlength' => '20', 'class' => 'textfield span8 ', 'readonly' => "true")); ?>    
                        <span class="add-on">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <div class="control-group controlerror"> 
<?php echo $form->error($advertisementForm, 'ExpiryDate'); ?>
                        </div>

                    </div>

                </div>
            </div>
            
                            
                
            <div class="row-fluid customrowfluidad  "  >
                  <div class="span12" style="display: none" id="GroupsList">

                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Groups')); ?>
                    <div class="chat_profileareasearch"  style="margin:0px">
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'GroupId',$groupNames , array(
                            'class' => "span12",
                            'multiple' => 'multiple'
                        ));
                        ?>   
                    </div>
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'GroupId'); ?>
                    </div>
                </div>
            </div>
                <div class="row-fluid customrowfluidad  "  >
                <div class="span6 positionrelative" id="requestedFields" style="display: none">

                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Requested Fields')); ?>
                    <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'RequestedFields',$adRequestedFields , array(
                            'class' => "",
                            'id'=>'RequestedFields',
                            'multiple' => 'multiple',
                            'onclick'=>'displayRequestedFields()',
                        ));
                        ?>  
                    </div>
                    <span class="authortext"><i data-original-title="Enter custom requested query param names." rel="tooltip" data-placement="bottom" data-id="id" style="font-weight: normal;" class="fa fa-question helpmanagement helpicon top10 tooltiplink"></i> </span>
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'RequestedFields'); ?>
                    </div>
                </div>
              <div class="span6" id="requestedParams" style="display:none" >
                         <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Alias Names For Requested Fields')); ?>
                        <div class="chat_profileareasearch padding-bottom5" style="display:none;" id='requestedp1'>
                        <div class="row-fluid"  >
                            <div class="span4">
                                <label style="display: inline-block;padding-right:5px;" class="pull-right">UserId</label>
                            </div>
                            <div class="span8"><?php echo $form->textField($advertisementForm, 'Requestedparam1', array('maxlength' => 20, 'class' => 'span12 textfield')); ?> </div>
                        </div>
                       
                        
                        </div>
                        <div class="chat_profileareasearch padding-bottom5" style="display:none" id='requestedp2'>
                            <div class="row-fluid"  >
                            <div class="span4">
                                <label style="display: inline-block;text-align: right;">Display Name</label>
                            </div>
                            <div class="span8"><?php echo $form->textField($advertisementForm, 'Requestedparam2', array('maxlength' => 20, 'class' => 'span12 textfield')); ?> </div>
                        </div>
                            
                            
                            
                            
                        </div>
                         
                     </div>
                 </div>
                
                <div class="row-fluid padding-bottom10"  >
                    <div class="span6" id="redirectUrl" >

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Redirect_Url')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($advertisementForm, 'RedirectUrl', array('maxlength' => 150, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'RedirectUrl'); ?>
                    </div>
                </div>
             <div class="span6" id="sourceFowWidgetAd" >

                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'SourceType')); ?>
                    <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'SourceType', array('Upload' => 'Upload','AddServerAds' => 'Ad Server'), array(
                            'class' => "",
                            'onchange'=>'loadOutSideUrlBox()',
                            'id'=>'SourceType'
                        ));
                        ?> 
                    </div>
                     
                    <div class="control-group controlerror">
<?php echo $form->error($advertisementForm, 'SourceType'); ?>
                    </div>
                </div>
                </div>
                      <div class="row-fluid"  >
                    
                    <div class="span15 positionrelative" id="streamBundleAds" style="display: none">

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'StreamBundleAds')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textArea($advertisementForm, 'StreamBundleAds', array( 'class' => 'span15, stream_bundle_textarea')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'StreamBundleAds'); ?>
                    </div>
                        <i id="StreamAdDimension1" style="display: block" class="fa fa-question helpmanagement helpicon top10  tooltiplink" style="font-weight: normal;z-index: 5" data-id="HintsforRandamNumbergenration_DivId" data-placement="bottom" rel="tooltip"  data-original-title="Hints for RandomNumber Generation" ></i>
                </div>
                    
                    </div>
                <div class="row-fluid customrowfluidad  padding-bottom10" id="addServerAds1"  style="display: none" >
                    <div class="span12 positionrelative" >

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Impression Tags')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textArea($advertisementForm, 'ImpressionTags', array( 'class' => 'span15, textarea')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'ImpressionTags'); ?>
                    </div>
                        <i id="StreamAdDimension1" style="display: block" class="fa fa-question helpmanagement helpicon top10  tooltiplink" style="font-weight: normal;z-index: 5" data-id="HintsforRandamNumbergenration_DivId" data-placement="bottom" rel="tooltip"  data-original-title="Hints for RandomNumber Generation" ></i>
                    </div>
                    
              
                 </div>
                <div class="row-fluid customrowfluidad  padding-bottom10" id="addServerAds2"  style="display: none" >
                    
                    <div class="span12">

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Click Tag')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($advertisementForm, 'ClickTag', array('maxlength' => 1000, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'ClickTag'); ?>
                    </div>
                    </div>
               
              
                 </div>
                                <div class="row-fluid" id="bannerTemplateDiv1" style="display: none" >
                    <div class="span6 positionrelative">
                     
                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Banner Options')); ?>
                        <div class="chat_profileareasearch" >
                        <?php
                        echo $form->dropDownlist($advertisementForm, 'BannerOptions', array('OnlyImage' => 'Only Image','OnlyText' => 'Only Text','ImageWithText' => 'Image with Text'), array(
                            'class' => "",
                            'onchange'=>'loadbannerTemplates()',
                            'id'=>'bannerOptions'
                        ));
                        ?> 
                    </div>
                     <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'BannerOptions'); ?>
                    </div>
                  

                    </div>
                </div>
                <div class="row-fluid" id="bannerTemplateDiv2" style="display: none" >
                    <div class="span12 positionrelative">
                     
                        <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Banner Template')); ?>
                        <div id="uploadBanner" class="control-group controlerror marginbottom20 " >
                         <?php echo $form->radioButtonList($advertisementForm,'BannerTemplate',array('1'=>'<img src="/images/system/ad_banner_theme3.png" data-original-title="Banner template text align bottom." rel="tooltip" data-placement="bottom" >', '2'=>'<img src="/images/system/ad_banner_theme5.png" data-original-title="Banner template text align top." rel="tooltip" data-placement="bottom">','3'=>'<img src="/images/system/ad_banner_theme1.png" data-original-title="Banner template text align left." rel="tooltip" data-placement="bottom">', '4'=>'<img src="/images/system/ad_banner_theme2.png" data-original-title="Banner template text align right." rel="tooltip" data-placement="bottom">', '5'=>'<img src="/images/system/ad_banner_theme4.png" data-original-title="Banner template text align center." rel="tooltip" data-placement="bottom">'),
                              array('uncheckValue'=>null,'id'=>'bannerTemplate',
                              'separator'=>'&nbsp; &nbsp; &nbsp;','class'=>'styled'), array('uncheckValue'=>null), array("id"=>"AdvertisementForm_BannerTemplate")); ?>

                           
                          <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'BannerTemplate'); ?>
                    </div>
                 </div>  

                    </div>
                </div>
                <div class="row-fluid" id="onlyTextTitle" style="display: none" >
                    
                    <div class="span15 positionrelative"  >

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Banner_Title')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textArea($advertisementForm, 'BannerTitleForTextOnly', array('maxlength' => 200, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'BannerTitleForTextOnly'); ?>
                    </div>
                        
                </div>
                    
                </div>
                 <div class="row-fluid" id="onlyTextContent" style="display: none">
                    
                    <div class="span15 positionrelative"  >

                    <?php echo $form->labelEx($advertisementForm, Yii::t('translation', 'Banner_Content')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textArea($advertisementForm, 'BannerContentForTextOnly', array( 'class' => 'span15, stream_bundle_textarea')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'BannerContentForTextOnly'); ?>
                    </div>
                        
                </div>
                    
                </div>
                
                <div class="row-fluid" id="uplloadAdPreview" >
                    <div class="span6 positionrelative">
                        
                         <div style="display: none" class="preview previewhalf" id="previewicon">        
                
         <ul>

    <li class="alert"><i data-dismiss="alert" class="fa fa-times-circle deleteiconhalf mobiledeleteicon " style="display:none"></i>
        <i class="fa fa-search-plus zoomiconhalf" onclick='showPreviewNew()'></i><a href="" class="postimgclose mobilepostimgclose "> </a>
                <img id="groupIconPreviewId" name="AdvertisementForm[Url]"  src="" alt="" style="border:0;" /></li>
         </ul>
        
           
        </div>  <div>
                          <div id="GroupLogo" style="display:none" class="uploadicon"><img src="/images/system/spacer.png"></div>
                          <div class="control-group controlerror">
                        <?php echo $form->error($advertisementForm, 'Url'); ?>
                    </div>
                 </div>
        <i id="StreamAdDimension" style="display: none" class="fa fa-question helpmanagement helpicon top10  tooltiplink" style="font-weight: normal;z-index: 5" data-id="StreamAdDimension_DivId" data-placement="bottom" rel="tooltip"  data-original-title="Ad Dimentions" ></i>
                        </div>
                </div>


                  
 
                        <ul class="qq-upload-list" id="uploadlistSchedule"></ul>
 <div class="alert alert-error" id="GroupLogoError" style="display: none"></div>
 <?php echo $form->hiddenField($advertisementForm, 'Url',array('class'=>'')); ?>   
 <?php echo $form->hiddenField($advertisementForm, 'ExternalPartyUrl',array('class'=>'')); ?>
 <?php echo $form->hiddenField($advertisementForm, 'Type',array('class'=>'')); ?>   
 <?php echo $form->hiddenField($advertisementForm, 'DoesthisAdrotateHidden',array('class'=>'','id'=>"DoesthisAdrotateHidden")); ?>
 <?php echo $form->hiddenField($advertisementForm, 'BannerTitle',array('class'=>'','id'=>"BannerTitleHidden")); ?>
 <?php echo $form->hiddenField($advertisementForm, 'BannerContent',array('class'=>'','id'=>"BannerContentHidden")); ?>
 
 <div class="groupcreationbuttonstyle alignright">

                <?php
                echo CHtml::ajaxSubmitButton('Create', array('/advertisements/newAdvertisement'), array(
                    'type' => 'POST',
                    'dataType' => 'json',
                    'error' => 'function(error){
                                        }',
                    'beforeSend' => 'function(){  
                                scrollPleaseWait("advertisementSpinner","advertisement-form");setBannerTemplateData(); }',
                    'complete' => 'function(){
                                                    }',
                    'success' => 'function(data) { advertisementHandler(data);}'), array('type' => 'submit', 'id' => 'newGroupId', 'class' => 'btn')
                );
                ?>
            <?php echo CHtml::resetButton('Cancel', array("id" => 'NewAdReset', 'class' => 'btn btn_gray', 'onclick' => 'closeAdvertisement()')); ?>

            </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</div>
</div>
<div id="advertisementMgmt">
    
    
</div>
  



<script type="text/javascript">
    Custom.init();
    loadEvents();
    var g_filterValue = "";
var g_pageNumber = 1;
var g_searchText = "";
var g_startLimit = 0;
var g_pageLength = 10;
var g_page = 1;
   $("[rel=tooltip]").tooltip();
    loadAdvertisementsForAdmin(0,"","");
    var selectedBanner=null;
    $('#AdvertisementForm_BannerTemplate').live('click', function() { 
        var radios = document.getElementsByTagName('input');

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].type === 'radio' && radios[i].checked) {
              
              
               $("#templateBannerChangeClass").removeClass('addbannersection1');
               $("#templateBannerChangeClass").removeClass('addbannersection2');
               $("#templateBannerChangeClass").removeClass('addbannersection3');
               $("#templateBannerChangeClass").removeClass('addbannersection4');
               $("#templateBannerChangeClass").removeClass('addbannersection5');
               $("#templateBannerChangeClass").addClass('addbannersection'+radios[i].value);
               if($('#AdvertisementForm_Url').val()===""){
                 var g_adImage = '/images/system/ad_creation_defaultbanner'+radios[i].value+".jpg" ;  
                 $('#AdBannerPreviewImage').attr('src', g_adImage);   
               }
              
               selectedBanner=radios[i].value;
               $('#myBannerModal').off('hidden.bs.modal');
               $("#myBannerModal").modal('show');
               
           $('#myBannerModal').on('hidden.bs.modal', function() {
                var bTitle=$('#AdBannerTitle').clone().removeAttr("contentEditable"); 
                $('#BannerTitleHidden').val(bTitle.wrap('<p>').parent().html());
                var bcontent=$('#AdBannerContent').clone().removeAttr("contentEditable"); 
                $('#BannerContentHidden').val(bcontent.wrap('<p>').parent().html()); 
               $('#myBannerModal').off('hidden.bs.modal');
                    
         });

               
            }
        }
    });
    
    function setBannerTemplateData(){ 
    if($('#AdvertisementForm_Url').val()===""){
                 var g_adImage = '/images/system/ad_creation_defaultbanner'+selectedBanner+".jpg" ;  
                 $('#AdvertisementForm_Url').val(g_adImage);   
               }
    }
    
     $("#addGroup").bind( "click touchstart", 
        function(){
           $('#AutoModeDiv').hide(); 
           $('#adTitle').hide(); 
           $('#requestedFields').hide();
           $('#addNewAd').show();
           
        }
    );
     var extensions ='"jpg","jpeg","gif","png","tiff","swf","mov", "mp4"';
    initializeFileUploader('GroupLogo', '/advertisements/UploadAdvertisementImage', '10*1024*1024', extensions,1, 'GroupLogo' ,'',AdvertisementDLPreviewImage,displayErrorForBannerAndLogo,"uploadlistSchedule");
    initializeFileUploader('BannerImage', '/advertisements/UploadAdvertisementImage', '10*1024*1024', extensions,1, 'BannerImage' ,'',BannerDLPreviewImage,displayErrorForBannerAndLogo,"uploadlistSchedule");
    initializeFileUploader('ExternalPartyLogo', '/advertisements/UploadAdvertisementImage', '10*1024*1024', extensions,1, 'ExternalPartyLogo' ,'',ExternalPartyDLPreviewImage,displayErrorForBannerAndLogo,"uploadlistSchedule");
    function loadEvents() {
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);



        var checkin = $('#dpd2').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {

            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 0);
             checkout.setValue(newDate);

            checkin.hide();
            $('#dpd1')[0].focus();
        }).data('datepicker');


    var checkout = $('#dpd1').datepicker({
        onRender: function(date) {
            return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');

    }
    function ExternalPartyDLPreviewImage(id, fileName, responseJSON, type)
{
    var data = eval(responseJSON);    
    var  g_adImage = '/upload/advertisements/' + data.savedfilename;
    $('#ExternalPartyLogoPreview').attr('src', g_adImage);    
    $('#AdvertisementForm_ExternalPartyUrl').val('/upload/advertisements/' + data.savedfilename);
}
    function AdvertisementDLPreviewImage(id, fileName, responseJSON, type)
{
    var data = eval(responseJSON);    
    g_adImage = '/upload/advertisements/' + data.savedfilename;
    var preferences='';
    if(type=='GroupLogoInPreferences'){
        preferences = 'InPreferences';
    }
    $('#updateAndCancelGroupIconUploadButtons'+preferences).show();
    $('#groupIconPreviewId'+preferences).val('/upload/advertisements/' + data.savedfilename);    
    if(data.extension=="swf"){
          $('#groupIconPreviewId'+preferences).attr('src', '/images/system/swf.png');    
      }
      else if(data.extension=="mp4" || data.extension=="mov"){
     $('#groupIconPreviewId'+preferences).attr('src', '/images/system/video_img.png');    
    }
    else{
     $('#groupIconPreviewId'+preferences).attr('src', g_adImage);    
    }
    
    $('#AdvertisementForm_Url').val('/upload/advertisements/' + data.savedfilename);
    $('#AdvertisementForm_Type').val(data.extension);
    $('#previewicon').show();
    

}
function BannerDLPreviewImage(id, fileName, responseJSON, type)
{
    var data = eval(responseJSON);    
    var g_adImage = '/upload/advertisements/' + data.savedfilename;
    var preferences='';
   

    if(type=='GroupLogoInPreferences'){
        preferences = 'InPreferences';
    }
//    $('#updateAndCancelGroupIconUploadButtons'+preferences).show();
    $('#AdBannerPreviewImage'+preferences).val('/upload/advertisements/' + data.savedfilename);    
    if(data.extension=="swf"){
          $('#AdBannerPreviewImage'+preferences).attr('src', '/images/system/swf.png');    
      }
      else if(data.extension=="mp4" || data.extension=="mov"){
     $('#AdBannerPreviewImage'+preferences).attr('src', '/images/system/video_img.png');    
    }
    else{
       
     $('#AdBannerPreviewImage'+preferences).attr('src', g_adImage);    
    }
    
    $('#AdvertisementForm_Url').val('/upload/advertisements/' + data.savedfilename);
}
function displayErrorForBannerAndLogo(message,type){
    alert(type);
     if(type=='GroupLogo'){
        $('#GroupLogoError').html(message);
        $('#GroupLogoError').css("padding-top:20px;");
        $('#GroupLogoError').show();
        $('#GroupLogoError').fadeOut(6000)
     }else if(type=='ExternalPartyLogo'){
        $('#AdvertisementForm_ExternalPartyUrl_em_').html(message);
        $('#AdvertisementForm_ExternalPartyUrl_em_').show();
        $('#AdvertisementForm_ExternalPartyUrl_em_').fadeOut(6000)
        }
     
        else if(type=='GroupLogoInPreferences'){
         $('#GroupLogoErrorInPreferences').html(message);
        $('#GroupLogoErrorInPreferences').css("padding-top:20px;");
        $('#GroupLogoErrorInPreferences').show();
        $('#GroupLogoErrorInPreferences').fadeOut(6000)
     } else{
        $('#GroupBannerError').html(message);
        $('#GroupLogoError').css("padding-top:20px;");
        $('#GroupBannerError').show();
        $('#GroupBannerError').fadeOut(6000)
     }  
}
function advertisementHandler(data){ 
    scrollPleaseWaitClose("advertisementSpinner");
          var data=eval(data);   

        if(data.status =='success'){
            
            if(data.page=='edit'){
                var msg=data.data;
            $("#sucmsgForAd").html(msg);
            $("#sucmsgForAd").css("display", "block");
           $("#errmsgForAd").css("display", "none");
            $("#advertisement-form")[0].reset();
            $("#DoesthisAdrotateHidden").val(null);
            $("#Url").val('');
            $('#addServerAds1').hide();
            $('#addServerAds2').hide();
            $('#streamBundleAds').hide();
            $("#SourceType option[value='StreamBundleAds']").remove();
            $('#GroupLogo').hide();
            $('#StreamAdDimension').hide();
            $('#requestedParams').hide();
            $("#sucmsgForAd").fadeOut(3000).promise().done(function(){
            $("#myModal_bodyAd").html('');
            $("#myModalAd").modal('hide');
            $('#OutSideUrlDiv').hide();
            $('#GroupLogo').show();
            $('#redirectUrl').show();
            $('#timeInterval').hide();
            $('#bannerTemplateDiv1').hide();
            $('#bannerTemplateDiv2').hide();
            loadAdvertisementsForAdmin(0,'',''); 
            $('#uplloadAdPreview').hide();
            $('#onlyTextContent').hide();
            $('#onlyTextTitle').hide();
            $('#AdBannerTitle').text("Banner Title");
            $('#AdBannerContent').text("Banner Content");
            $(".addbannaertitle").css("color","#1e1d1b"); 
            $(".addbannerdescription").css("color","#1e1d1b"); 
            $('#externalPartyName').hide();
            $('#externalPartyLogo').hide();
            $('#isThisExternalParty').hide();
            $('#inlineTitle').html("Title");
            $('#isThisExternalPartyCB').attr('checked',false);
            
             });           
            
            }else{
              var msg=data.data;                               
            $("#sucmsgForAd").html(msg);
            $("#sucmsgForAd").css("display", "block");
            $("#errmsgForAd").css("display", "none");
            $("#advertisement-form")[0].reset(); 
            $("#DoesthisAdrotateHidden").val(null);
            $("#Url").val('');
            $('#addServerAds1').hide();
            $('#addServerAds2').hide();
            $('#streamBundleAds').hide();
            $('#GroupLogo').hide();
            $("#SourceType option[value='StreamBundleAds']").remove();
            $('#StreamAdDimension').hide();
            $('#requestedParams').hide();
            $('#DisplayPosition').prev().html('Please Select Position');  
            $('#DisplayPage').prev().html('Please Select Page');  
            $('#TimeInterval').prev().html('Please Select Interval');  
            $('#groupIconPreviewId').attr('src', '');  
            $("#sucmsgForAd").fadeOut(3000).promise().done(function(){
            $('#GroupsList').hide();
            $('#previewicon').hide();
            $('#addNewAd').hide();
            $('#redirectUrl').show();
            $('#timeInterval').hide();
            $('#bannerTemplateDiv1').hide();
            $('#bannerTemplateDiv2').hide();
            loadAdvertisementsForAdmin(0,'','');
            $('#uplloadAdPreview').hide();
            $('#onlyTextContent').hide();
            $('#onlyTextTitle').hide();
            $('#AdBannerTitle').text("Banner Title");
            $('#AdBannerContent').text("Banner Content");
            $(".addbannaertitle").css("color","#1e1d1b"); 
            $(".addbannerdescription").css("color","#1e1d1b"); 
            $('#externalPartyName').hide();
            $('#externalPartyLogo').hide();
            $('#isThisExternalParty').hide();
            $('#inlineTitle').html("Title");
            $('#isThisExternalPartyCB').attr('checked',false);
             });
            
            }
           
       
    } 
        else{
            var lengthvalue=data.error.length;            
            var msg=data.data;
            var error=[];
            if(msg!=""){                
                    $("#errmsgForAd").html(msg);
                    $("#errmsgForAd").css("display", "block");
                    $("#sucmsgForAd").css("display", "none");
                    $("#errmsgForAd").fadeOut(5000);
       
            }else{
                
                if(typeof(data.error)=='string'){
                
                var error=eval("("+data.error.toString()+")");
                
            }else{
                
                var error=eval(data.error);
            }
            
            
            $.each(error, function(key, val) {
                if(key=="popupMessage"){


          var modelType = 'info_modal';
        var title = 'Confirmation';
        var adpage=$("#AdvertisementForm_id").val()==undefined?"created":"updated";
        var content = "<div class='c_confirmad'><div class='c_header'>Your ad will be "+adpage+" but marked inactive for now.</div><div class='c_subheader1'> The reason is either:</div><ul class='c_list'><li>There is already another ad setup for the same position during the same time</li><li>There is a rotating adunit setup for the same position and time and your new ad is not setup to be part of the rotating adunit.You can make necessary adjustments later and make the ad active at a later point.</li></ul></div>";
        var closeButtonText = 'No';
        var okButtonText = 'Yes';
        var param = '';
        openModelBox(modelType, title, content, closeButtonText, okButtonText, function(){
            $("#DoesthisAdrotateHidden").val("ok");
            $("#newGroupId").click();
            closeModelBox();}, param);
            $("#newModal_btn_close").show();
            $('#newModal').css("z-index","1100");
            $('.info_modal').css("top","10%");

                }
                else{
                if($("#"+key+"_em_")){  
                    $("#"+key+"_em_").text(val);                                                    
                    $("#"+key+"_em_").show();   
                    $("#"+key+"_em_").fadeOut(5000);
                   // $("#"+key).parent().addClass('error');
                }
            }
                
            }); 
          }
        }
}
function closeAdvertisement(){
     
     $("#advertisement-form")[0].reset();
            
            $('#groupIconPreviewId').attr('src', '');                         
            $('#DisplayPosition').prev().html('Please Select Position');  
            $('#DisplayPage').prev().html('Please Select Page');  
            $('#TimeInterval').prev().html('Please Select Interval');
            $('#addNewAd').hide();
            $('#previewicon').hide(); 
            $('#OutSideUrlDiv').hide();
            $('#GroupLogo').show();
            $("#DoesthisAdrotateHidden").val(null);
            $("#Url").val('');
            $('#addServerAds1').hide();
            $('#addServerAds2').hide();
            $('#streamBundleAds').hide();
            $('#GroupLogo').hide();
            $("#SourceType option[value='StreamBundleAds']").remove();
            $('#StreamAdDimension').hide();
            $('#requestedParams').hide();
            $('#timeInterval').hide();
            $('#redirectUrl').show();
            $('#bannerTemplateDiv1').hide();
            $('#bannerTemplateDiv2').hide();
            $('#uplloadAdPreview').hide();
//            $('#uploadGroupLogo').hide();
            $('#onlyTextContent').hide();
            $('#onlyTextTitle').hide();
            $('#AdBannerTitle').text("Banner Title");
            $('#AdBannerContent').text("Banner Content");
            $(".addbannaertitle").css("color","#1e1d1b"); 
            $(".addbannerdescription").css("color","#1e1d1b"); 
            $("#myModal_bodyAd").html("");
            $('#externalPartyName').hide();
            $('#externalPartyLogo').hide();
            $('#isThisExternalParty').hide();
            $('#inlineTitle').html("Title");
            $('#isThisExternalPartyCB').attr('checked',false);
}

function checkToLoadGroups(){
  
    var selectedValue=$('#DisplayPage :selected').text();
    if(selectedValue=='Group'){
        $('#GroupsList').show();
//        $('#StatusSpan').removeAttr("style");
    }else{
        $('#GroupsList').hide();
//        $('#StatusSpan').css("margin-left","2px");
    }
  
}
function displayRequestedFields(){
     $('#requestedParams').hide();
     $('#requestedp1').hide();
     $('#requestedp2').hide(); 
    var selectedValue=$('#RequestedFields :selected').each(function(i, selected){
     $('#requestedParams').show();
     if($(selected).text()=="UserId"){
        $('#requestedp1').show(); 
     }
     if($(selected).text()=="Display Name"){
        $('#requestedp2').show(); 
     } 
});

}
function loadAdvertisementsForAdmin(startLimit,filterValue,searchText){ 
    
         var queryString = 'startLimit='+startLimit+'&filterValue=' + filterValue+'&searchText=' + searchText+ "&pageLength=" + g_pageLength;
        
         ajaxRequest("/advertisements/GetAllAdvertisementsForAdmin",queryString,loadAdvertisementsForAdminHandler);
    
}

 function loadAdvertisementsForAdminHandler(data){
     
     $('#advertisementMgmt').html(data.htmlData);
     
     var totalCount=data.totalCount;
//     if(g_searchText!=undefined || !empty(g_searchText)){
//         $("#searchAdId").val()=g_searchText;
//     }else if(g_searchText==undefined){
//         $("#searchAdId").val()='';
//     }
     if (g_pageNumber == undefined) {
        g_page = 1;
    } else {
        g_page = g_pageNumber;
    }    
    if (g_filterValue != undefined) {
        $("#filter").val(g_filterValue);
    } else {
        g_filterValue = "all";
    }    
    if (data.recordCount == 0) {
        $("#pagination").hide();
        $("#noRecordsTR").show();
    }
    $("#pagination").pagination({
        currentPage: g_page,
        items: totalCount,
        itemsOnPage: g_pageLength,
        cssStyle: 'light-theme',
        onPageClick: function(pageNumber, event) {            
            g_pageNumber = pageNumber;
            var startLimit = ((parseInt(pageNumber) - 1) * parseInt(g_pageLength));            
            loadAdvertisementsForAdmin(startLimit, g_filterValue, g_searchText);
        }

    });
    if($.trim(data.searchText) != undefined && $.trim(data.searchText) != "undefined" ){  
        
        $('#searchAdId').val(data.searchText);
    }
     
 }
 
 function searchAD(event) {
    
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        //scrollPleaseWait('spinner_admin');
        if ($.trim($("#searchAdId").val()) != "") {
            var searchText = $.trim($("#searchAdId").val());
            g_searchText = searchText;
            loadAdvertisementsForAdmin(0, '', g_searchText);            
        } else {
            g_searchText = "";
            loadAdvertisementsForAdmin(0,"","");
        }
        return false;

    }
}

function closeEditAdvertisement(){
      $("#advertisement-form")[0].reset();       
            $("#myModal_bodyAd").html('');
            $("#myModalAd").modal('hide');
}
$("#filter").live( "change", 
        function(){
    var value = $("#filter").val();
    var searchText = $("#searchAdId").val();
    g_searchText = searchText;
    g_filterValue = value;
    scrollPleaseWait('spinner_admin');
    loadAdvertisementsForAdmin(0, value, searchText);
    
        }
    );
    function showPreviewNew(){
    var displayPosition=$.trim($('#AdvertisementForm_DisplayPosition').val());
    var displayPage=$('#DisplayPage').val();
    var url=$('#AdvertisementForm_Url').val();
    var type=$('#AdvertisementForm_Type').val();
    
    if(displayPosition=="" || displayPage=="" || url==""){
        $("#errmsgForAd").html("please select position ,display page and artifact to check the preview");
        $("#errmsgForAd").css("display", "block");
        $("#sucmsgForAd").css("display", "none");
        $("#errmsgForAd").fadeOut(5000);
    }else {
        showPreview('',url,type,displayPosition,displayPage);
       
    }   
    }
    
   function loadOutSideUrlBox(){       
    var selectedValue=$('#SourceType :selected').text();
    $('#addServerAds1').hide();
    $('#addServerAds2').hide();
    $('#streamBundleAds').hide();
    $('#GroupLogo').hide();
    if(selectedValue=='Upload'){
     $('#GroupLogo').show();
     $('#redirectUrl').show();
    }else if(selectedValue=='Stream Bundle Ads'){
        $('#streamBundleAds').show();
         $('#previewicon').hide();
         $('#redirectUrl').hide();
        
    }else if(selectedValue=='Ad Server'){
        $('#addServerAds1').show();
        $('#addServerAds2').show();
        $('#previewicon').hide();
        $('#GroupLogo').show();
        $('#redirectUrl').show();
        
    }
   } 
   function loadAdType(){
        var selectedValue=$('#AdTypeId :selected').val();   
        $('#AutoModeDiv').hide(); 
         $('#adTitle').hide(); 
         $('#requestedFields').hide();
         $('#StreamAdDimension').hide();
         $('#addServerAds1').hide();
         $('#addServerAds2').hide();
         $('#streamBundleAds').hide();
         $('#requestedParams').hide();
         $('#timeInterval').hide();
         $('#AdunitGroup').hide();
         $('#isThisAdRotateCB').attr('checked',false);
         $('#redirectUrl').show();
         $("#SourceType option[value='StreamBundleAds']").remove();
         $('#bannerTemplateDiv1').hide();
         $('#bannerTemplateDiv2').hide();
         $('#uplloadAdPreview').hide();
         $('#SourceType option[value=Upload]').attr('selected','selected');
         $('#bannerOptions option[value=OnlyImage]').attr('selected','selected');
         $('#onlyTextContent').hide();
         $('#onlyTextTitle').hide();
         $('#externalPartyName').hide();
         $('#externalPartyLogo').hide();
         $('#isThisExternalParty').hide();
         $('#inlineTitle').html("Title");
         $('#isThisExternalPartyCB').attr('checked',false);
          

        if(selectedValue=='1'){ 
         $('#AdunitGroup').show();
         $('#GroupLogo').show();
         $('#AutoModeDiv').show(); 
         $('#SourceType').append($('<option value="StreamBundleAds">Stream Bundle Ads</option>'));
         $('#uplloadAdPreview').show();
        }
        else if(selectedValue=='2'){ 
            $('#adTitle').show();
            $('#GroupLogo').show();
            $('#StreamAdDimension').show();
            $('#bannerTemplateDiv1').show();
            $('#GroupLogo').show();
            $('#uplloadAdPreview').show();
            $('#isThisExternalParty').show();
        }
        else if(selectedValue=='3'){ 
            $('#adTitle').show();
            $('#GroupLogo').show();
             $('#requestedFields').show();
             $('#StreamAdDimension').show();
             $('#bannerTemplateDiv1').show();
             $('#GroupLogo').show();
             $('#uplloadAdPreview').show();
             $('#isThisExternalParty').show();
        }
        
   }
   
   function loadbannerTemplates(){
       var selectedValue=$('#bannerOptions :selected').val(); 
        $('#bannerTemplateDiv2').hide();
        $('#GroupLogo').hide();
        $('#uplloadAdPreview').hide();
        $('#onlyTextContent').hide();
        $('#onlyTextTitle').hide();
       if(selectedValue==="ImageWithText"){
           $('#bannerTemplateDiv2').show();
       
         }
       else if(selectedValue==="OnlyImage"){
           $('#GroupLogo').show();
           $('#uplloadAdPreview').show();
       }
       else{
           $('#onlyTextContent').show();
           $('#onlyTextTitle').show();
        }
     }
    $('#AutoModeDiv span.checkbox').bind("click",
     function(){
         $('#timeInterval').hide();
         if($('#isThisAdRotateCB').is(':checked')){
             $('#timeInterval').show();
         }
     }
    
     );
     $('#ExternalPartyDiv span.checkbox').bind("click",
     function(){
         $('#externalPartyName').hide();
         $('#externalPartyLogo').hide();
         $('#inlineTitle').html("Title");
         
         if($('#isThisExternalPartyCB').is(':checked')){
            $('#externalPartyName').show();
            $('#externalPartyLogo').show();
            $('#inlineTitle').html("External Party Context");
         }
     }
    
     );
  $('#titleBanner45').live('click', function() {
      $("#contentBanner45").removeClass('addbannerpadding_active');
      $("#titleBanner45").removeClass('addbannerpadding_active');
      $('.demo2').minicolors({
          hide: function() {}
});
          
  });
  $('#contentBanner45').live('click', function() {
      $("#titleBanner45").removeClass('addbannerpadding_active');
      $("#contentBanner45").removeClass('addbannerpadding_active');
      $('.demo1').minicolors({
          hide: function() {}
  });
});


$('.demo1').minicolors({
        change: function(hex, opacity) { 
                var log;
                try {
                        log = hex ? hex : 'transparent';
                        if( opacity ) log += ', ' + opacity;
                        $(".addbannaertitle").css("color",log); 
                } catch(e) {}
        },
       hide: function() {

            }
});

$('.demo2').minicolors({
        change: function(hex, opacity) { 
                var log;
                try {
                        log = hex ? hex : 'transparent';
                        if( opacity ) log += ', ' + opacity;
                        $(".addbannerdescription").css("color",log); 
                } catch(e) {}
        },
        hide: function() {

            }
});


		
</script>   