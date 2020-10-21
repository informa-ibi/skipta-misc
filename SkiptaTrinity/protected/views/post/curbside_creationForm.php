  <div id="curbsidePostCreationdiv" style="display:none">
             
     <div class="alert alert-error" id="errmsgForStream" style='padding-top: 5px;display: none'>  </div>
    <div class="alert alert-success" id="sucmsgForStream" style='padding-top: 5px;display: none'></div>      
     <?php
         try {
              $formCurbside = $this->beginWidget('CActiveForm', array(
        'id' => 'curbsidePost-form',
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
      
    <div  class="crubsidenew">
    <div class="row-fluid curbsidediv  padding-bottom10">
     <div class="span12">
     <div class="span7"><!-- This id numero1 is used for Joyride help -->
        
        <?php echo $formCurbside->textField($CurbsidePostModel, 'Subject', array("id" => "CurbsidePostForm_Subject", 'maxlength' => '50', 'class' => 'textfield span12', 'placeholder' =>Yii::t('translation','Curbside_Post_Subject'))); ?>    
        <div class="control-group controlerror"> 
 <?php echo $formCurbside->error($CurbsidePostModel, 'Subject'); ?>
    </div>
     </div>
     <div class="span5 positionrelative" id="curbsidedropdown">
          <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
         <select name="CurbsidePostForm[Category]"  id="CurbsidePostForm_Category" class="selectpicker remove-example styled span12 textfield tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $name?> Category">
              <option   value=""> <?php echo Yii::t('translation','Curbside_Post_Select_Category'); ?> </option>
                    <?php 
                        foreach ($categories as $key => $value) {
                                   echo '<option   value="'.$value['Id'].'">'.$value['CurbsideCategory'].'</option>';      
                                    }
                    ?>
                   </select>
          <div class="control-group controlerror">  
                <?php echo $formCurbside->error($CurbsidePostModel, 'Category'); ?>   
          </div> 
     </div>     
     </div>
     
     </div>
    
    <div id="curbsidepostSpinLoader"></div>
    <div id="ArtifactSpinLoader_uploadfile"></div>
    <div class="poststreamwidget ">
    	
    <div class="row-fluid">
    <div class="span12">
        
      <div id="editableC"  name="curbsideEditablediv"  placeholder="New Post" class="placeholder inputor" contentEditable="true" onkeyup="getsnipet(event,this);" onblur="validateDescription(this)"> </div>
  <div class="control-group controlerror">  
    
   <?php echo $formCurbside->error($CurbsidePostModel, 'Description'); ?>
    </div>
    
    <?php echo $formCurbside->hiddenField($CurbsidePostModel, 'Description', array('value' => '')); ?>
    <?php echo $formCurbside->hiddenField($CurbsidePostModel, 'Type', array('value' => '')); ?>
    <?php echo $formCurbside->hiddenField($CurbsidePostModel, 'HashTags', array('value' => '')); ?>
    <?php echo $formCurbside->hiddenField($CurbsidePostModel, 'Mentions', array('value' => '')); ?>
     <div  id="snippet_mainC" style="display:none; padding-top: 10px;padding-bottom:10px;" >
           
      </div> 
      <div id="preview_CurbsidePostForm" class="preview" style="display:none">
         <ul id="previewul_CurbsidePostForm">

    </ul>
    </div>
 <div class="postattachmentarea" id="button_blockC" style="display:none;">
        <div class="pull-left whitespace">
        	<div class="advance_enhancement">
            <ul><li class="dropdown pull-left ">
                    <div id="uploadfileC" data-placement="bottom" rel="tooltip"  data-original-title="Upload"></div>
                    </li>
                     <?php if($canFeatured==1){?>
                  <li class="pull-left">
                       <?php echo $formCurbside->hiddenField($CurbsidePostModel, 'IsFeatured',array('class'=>'iisfeatured')); ?>  
                       <?php echo $formCurbside->hiddenField($CurbsidePostModel, 'FeaturedTitle',array('id'=>'FeaturedTitleHidden')); ?>    
                      <i id="isfeaturedI" class="tooltiplink featureditemdisable isdfeatured"  data-placement="bottom" rel="tooltip" data-original-title="Mark as Featured."><img src="/images/system/spacer.png" /> </i>
                    </li>
                       <?php } ?>
                     <li><a><i><img class=" p_anonimous" src="/images/system/spacer.png"></i></a></li>
                    </ul>
            <?php echo $formCurbside->hiddenField($CurbsidePostModel,'Artifacts',array('value'=>'')); ?>
             <?php echo $formCurbside->hiddenField($CurbsidePostModel,'IsWebSnippetExist',array('value'=>'')); ?>
             <?php echo $formCurbside->hiddenField($CurbsidePostModel,'WebUrls',array('value'=>'')); ?>       
            <a></a> <a><i><img src="/images/system/spacer.png" class="actionmore" ></i></a></div>
        </div>
     <div class="control-group controlerror">  
    
   <?php echo $formCurbside->error($CurbsidePostModel, 'Artifacts'); ?>
    </div>
    <div class="pull-right">
         <?php echo CHtml::Button('Post',array('class' => 'btn','onclick'=>'CurbsidePostsend();')); ?> 
        <?php echo CHtml::resetButton('Cancel', array("id" => 'forgotReset','class' => 'btn btn_gray','onclick'=>'ClearPostForm();')); ?>
        </div></div>
      <div id="appendlist"><ul class="qq-upload-list" id="uploadlistC"></ul></div>
    </div>
       
    </div>
    </div>
    </div>
    
     <?php $this->endWidget();
         } catch (Exception $exc) {
             error_log("-----------------------------message---------------------------------".$exc->getMessage());
         }

         ?>
    
    
    </div>