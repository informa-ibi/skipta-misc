<?php include 'profileinteractionbuttongroupwidget.php'; ?>
<div style="padding-top:10px;">

<?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'UserCV-form',
                            'method'=>'post',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                                'validateOnChange' => true,
                            ),
                            'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>'marginzero'),
                                ));
                        ?>
          
             


<?php echo $form->hiddenField($UserCVForm, 'Education'); ?> 
<?php echo $form->hiddenField($UserCVForm, 'Education_Ids'); ?> 
<?php echo $form->hiddenField($UserCVForm, 'Experience'); ?> 
<?php echo $form->hiddenField($UserCVForm, 'Interests'); ?>
<?php echo $form->hiddenField($UserCVForm, 'Achievements'); ?>
<?php echo $form->hiddenField($UserCVForm, 'Publications'); ?>

<?php echo $form->hiddenField($UserCVForm, 'RecentupdateSection'); ?> 



            <div id="registrationSpinLoader"></div>
            <div class="alert-error" id="errmsg" style='padding-top: 5px;text-align:center;display:none;'> 

            </div>
           
       
<div id="maindiv" class="maindivDraggable" >  
    <div class="row-fluid">
    <div class="span9">
     <div class="alert-success" id="sucmsg" style='text-align:center;display:none;'></div>
    </div>
    </div>
<!-------------------------------------------------------------Education---------------------------------------------------------->           
<div id="educationdragdiv" class="subdivdragClass" style="cursor: pointer;">
<div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Education</div>
                    <?php   if($data['education']!="failure" ){ ?>
                    <div class="addsection "><span id="E_dropdown-toggle" style="display:<?php echo  sizeof($data['education'])>0?'block':'none'; ?>" class="dropdown-toggle dropdownsection" role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                          <div id="E_dropdown" >
                            <ul aria-labelledby="drop2" role="menu">
                            <?php    foreach ($data['education'] as $key => $value) {
                                
                               ?>
                                <li role="presentation"  ><a   onclick="addNewEducation('<?php echo $value['Id'] ; ?>','<?php echo $value['Categoryname'] ; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Categoryname'] ; ?> </a></li>

                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
                
                
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner education">
                        <div class="accordion" id="accordion1">
                          <div id="education_div" class="draggable cvaction" name="education">
       <!--------------------------------Start------------------------------------------------------------>
       <?php if($UsercvDetails['education'] != "failure"){ 
           $NGraducations=0;
           foreach ($UsercvDetails['education'] as $key => $value) {
           
        ?>
         <div id="<?php echo str_replace(" ","",$value['Education']); ?>_<?php echo $value['Id']; ?>" data-id='<?php echo $value['Id']; ?>' >
             <div id="<?php echo str_replace(" ","",$value['Education']); ?>_<?php echo $value['EducationId']; ?>" data-id='<?php echo $value['Id']; ?>' class="educationchild">
                            <div class="accordion-group">
                                <div class="accordion-heading ">
                                    <a class="accordion-toggle EducationClass" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                                        <?php echo  $value['Education'] ;?>
                                    </a>
                                    
                                    <?php if($value['Education']=="Graduation" && $NGraducations==1 && $value['EducationId']!=0) {  ?>
                                    <div  class="sectionremove"  data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removeSection('<?php echo $value['EducationId']; ?>','<?php echo str_replace(" ","",$value['Education']); ?>','E_dropdown','Education','<?php echo $value['Id']; ?>')"><i class="fa fa-times"></i>
                                    </div>
                                    <?php } elseif ($value['Education']!="Graduation") {
                                        ?><div  class="sectionremove"  data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removeSection('<?php echo $value['EducationId']; ?>','<?php echo str_replace(" ","",$value['Education']); ?>','E_dropdown','Education','<?php echo $value['Id']; ?>')"><i class="fa fa-times"></i>
                                    </div>         
                                          <?php  }
                                     if($value['Education']=="Graduation") { $NGraducations++; }?>
                                   
                                </div>
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                       
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Name'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'CollegeName['.$value['Id'].']', array("id" => 'UserCVForm_CollegeName_'.$value['Id'], value=>$value['CollegeName'],'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                                                            <?php echo $form->error($UserCVForm, 'CollegeName_' . $value['Id']); ?>

                                                        </div>
                                                    </div>
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Specialization'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'Specialization['.$value['Id'].']', array("id" => 'UserCVForm_Specialization_'.$value['Id'], value=>$value['Specialization'],'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                                                            <?php echo $form->error($UserCVForm, 'Specialization_' . $value['Id']); ?>
                                                        </div>
                                                    </div>
                                                    <div class="span4 divrelative">

                                                        <label><?php echo str_replace(" ","",$value['Education']); ?> <?php echo Yii::t('translation', 'User_Cv_Education_Year'); ?></label>
                                                        <div id="Education_Year_<?php echo $value['Id']; ?>" class="input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">
                                                            <?php echo $form->textField($UserCVForm, 'YearOfPassing['.$value['Id'].']', array("id" => 'UserCVForm_YearOfPassing_'.$value['Id'], value=>$value['YearOfPassing'],'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                                                            <div class="control-group controlerror"> 
                                                                <?php echo $form->error($UserCVForm, 'YearOfPassing_' . $value['Id']); ?>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        


                                    </div>
                                </div>
                            </div>
                          </div>
                       </div>
       <?php  } }  ?>
                  <!-----------------------------endddd----------------------------------------->            
                              
                              

                        </div>
                        </div>
                        
                        
                    </div>
                </div>
                
                
                
                
                
            </div>
        </div>

    </div>
</div>
</div>
   
<!----------------------------------------Experience -------------------------------------------------------->
<div id="experiencedragdiv" class="subdivdragClass" style="cursor: pointer;">
<div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Experience</div>
                     <?php  if($data['experience']!="failure" ){ ?>
                    <div class="addsection "><span id="EX_dropdown-toggle"  style="display:<?php echo  sizeof($data['experience'])>0?'block':'none'; ?>" class="dropdown-toggle dropdownsection" role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                             <div id="EX_dropdown" >
                            <ul aria-labelledby="drop2" role="menu">
                             <?php 
                             foreach ($data['experience'] as $key => $value) { ?>
                                <li role="presentation"><a   onclick="addNewExperience('<?php echo $value['Id'] ; ?>','<?php echo $value['Experience'] ; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Experience'] ; ?> </a></li>

                             <?php } ?>
                                
                            </ul> 
                        </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion2">
                             <div id="experience_div" class="experienceDraggable cvaction" name="experience">
                                 <!----------------------------------------------------Start---------------------------------------->
                                 <?php if($UsercvDetails['experience']  != "failure"){ foreach ($UsercvDetails['experience'] as $key => $value) { 
                                    
                          
                                     
                                     ?>
                                  <div id="<?php echo str_replace(" ","",$value['Experience']); ?>_<?php echo $value['ExperienceId']; ?>" class="experiencechild">
                            <?php   echo $form->hiddenField($UserCVForm, 'UserExperience['.$value['ExperienceId'].']'); ?>
                                      <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle ExperienceClass" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                        <?php  echo str_replace("Experience"," Experience",$value['Experience']); ?> 
                                    </a>
                                    <div class="sectionremove" data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removeSection('<?php echo $value['ExperienceId']; ?>','<?php echo str_replace(" ","",$value['Experience']); ?>','EX_dropdown','Experience','<?php echo $value['Id']; ?>')"><i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="accordion-body collapse in experience">
                                    <div class="accordion-inner">
                                       
                                            <div class="row-fluid">
                                               <div class="span12">
<!--                                               <label >Research Experience</label>-->
                                               <div class="control-group controlerror">
                                                   <div id="experience_<?php echo $value['ExperienceId']; ?>" name="UserCVForm[UserExperience][<?php echo $value['ExperienceId']; ?>]" class=" inputor editablediv" style="cursor: auto;" contentEditable="true"  ><?php echo $value['Description']?> </div>   

                                               <?php echo $form->error($UserCVForm, 'UserExperience_'.$value['ExperienceId']); ?>
                                               </div>
                                           </div>  
                                           </div>
                                           
                                    </div>
                                </div>
                            </div>
                             </div>
                                 <?php } }?>
<!--------------end-------------------------------------------------------------------------------->
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<!------------------------------------------------------------- Interests ------------------------------------------------------->
<div id="interestsdragdiv" class="subdivdragClass" >

<div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Interests</div>
                    <?php  if($data['interests']!="failure"){ ?>
                    <div class="addsection "><span id="In_dropdown-toggle"  style="display:<?php echo  sizeof($data['interests'])>0?'block':'none'; ?>" class="dropdown-toggle dropdownsection"  role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                           <div id="In_dropdown" >
                            <ul aria-labelledby="drop2" role="menu">
                             <?php    foreach ($data['interests'] as $key => $value) { ?>
                                <li role="presentation"><a  onclick="addNewInterest('<?php echo $value['Id'] ; ?>','<?php echo $value['Interests'] ; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Interests'] ; ?> </a></li>

                            <?php } ?>
                                
                            </ul> 
                         </div>

                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion3">
                            <div id="interests_div" class="interestsDraggable cvaction" name="interests">
     <!---------------------------------------------------------Start-------------------------------------------->
     <?php if($UsercvDetails['interests'] != "failure"){ foreach ($UsercvDetails['interests'] as $key => $value) { 
         
         ?>
     <div id="<?php echo str_replace(" ","",$value['Interests']); ?>_<?php echo $value['InterestId']; ?>" class="interestschild">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a  class="accordion-toggle InterestsClass" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">
                                     <?php echo str_replace("Interests"," Interests",$value['Interests']);  ?> <i data-original-title="Type a word then press enter key" rel="tooltip" data-placement="bottom" data-id="id" style="font-weight: normal;top:7px;right:auto;float:left;margin-left:5px;" class="fa fa-question helpmanagement helpicon top10  tooltiplink"></i>
                                    </a>
                                    <div class="sectionremove"  data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removeSection('<?php echo $value['InterestId']; ?>','<?php echo str_replace(" ","",$value['Interests']); ?>', 'In_dropdown', 'Interests','<?php echo $value['Id']; ?>')"><i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div id="collapseThree" class="accordion-body collapse in interests">
                                    <div class="accordion-inner">
                                        
                                        <div class="row-fluid">
                                           <div class="span12">
<!--                                           <label >PersonalINterests</label>-->
                                            <div class="padding-bottom5">
                                                  <span id="UserCVForm_UserInterests_<?php echo $value['InterestId'];?>_currentMentions" > </span>
                                            </div>
                                               <div class="control-group controlerror marginbottom10">
                                                   <?php echo $form->textField($UserCVForm, 'UserInterests['.$value['InterestId'].']', array("id" => "UserCVForm_UserInterests_".$value['InterestId'], 'maxlength' => '50', 'onkeyup' => 'PublicationAuthors(event,this,"Interests")','value'=> $value['Tags'],'class' => 'span12 textfield',"rel"=>"tooltip","data-placement"=>"bottom","data-original-title"=>"Type a word then press Enter button to add")); ?>

                                                   <?php echo $form->error($UserCVForm, 'UserInterests_' .$value['InterestId']); ?>
                                                   <div id="UserCVForm_UserInterests_<?php  echo $value['InterestId'];?>_error" class="errorMessage" style="display:none;"></div>
                                               </div>




                                       </div>  
                                       </div>
                                       
                                    </div>
                                </div>
                            </div>
                            </div>
     <?php } } ?>
<!-------------------------------------End------------------------------------------------------------------------------->
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div
</div>
</div>
 <!-----------------------------------------------------------------------Publications--------------------------------------------------------------->            
<div id="publicationsdragdiv" class="subdivdragClass" style="cursor: pointer;">          

<div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Publications</div>
                     <div class="addsection " data-placement="bottom" rel="tooltip"  data-original-title="Add a section to Publications"><span class="dropdown-toggle dropdownsection"  onclick="addOneMorePublication()" role="button" >Add Section</span>
                        
                    </div>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion5">
                            <div id="publication_div" class="publicationDraggable cvaction" name="publications">
 <!-------------------------------------------------Strattttttttttttttttttttt--------------------------------------->
 <?php if($UsercvDetails['publications'] != "failure"){ foreach ($UsercvDetails['publications'] as $key => $value) { 
     


         ?> <div id="publicationdiv_<?php echo $value['Id']; ?>" class="publicationschild">
              <?php echo $form->hiddenField($UserCVForm, 'Publicationfile['.$value['Id'].']'); ?> 
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle PublicationClass" data-toggle="collapse" data-parent="#accordion5_<?php echo $value['Id']; ?>" href="#collapse5_<?php echo $value['Id']; ?>">
                                        Publications
                                    </a>
                                    <div class="sectionremove" data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removePublication('<?php echo $value['Id']; ?>')"><i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div id="collapse5_<?php echo $value['Id']; ?>" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                        
                                            <div class="row-fluid padding8top">
                                                <div class="span12">
                                                    <div class="span4">
                                                        <label><?php echo Yii::t('translation', 'User_Publication_Name'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">

                                                            <?php echo $form->textField($UserCVForm, 'PublicationName['.$value['Id'].']', array("id" => 'UserCVForm_PublicationName_'.$value['Id'], 'maxlength' => '30', 'value'=>$value['Name'],'class' => 'tooltiplink span12 textfield')); ?>
                                                            <?php echo $form->error($UserCVForm, 'PublicationName_'. $value['Id']); ?>

                                                        </div>
                                                    </div>
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Publication_Title'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'PublicationTitle['.$value['Id'].']', array("id" => 'UserCVForm_PublicationTitle_'.$value['Id'], 'maxlength' => '30', 'value'=>$value['Title'],'class' => 'tooltiplink span12 textfield')); ?>
                                                            <?php echo $form->error($UserCVForm, 'PublicationTitle_'.$value['Id']); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Publication_Date'); ?></label>
                                                        
                                                         <div id="publication_Date_0" class="input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">
                                                           
                                                             <?php echo $form->textField($UserCVForm, 'PublicationDate['.$value['Id'].']', array("id" => 'UserCVForm_PublicationDate_'.$value['Id'], 'maxlength' => '30', 'value'=>$value['PublicationDate'], 'class' => 'tooltiplink span12 textfield')); ?>
                                                        
                                                             <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->error($UserCVForm, 'PublicationDate_'.$value['Id']); ?>
                                                            
                                                            
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row-fluid padding8top">
                                                <div class="span12">
                                                    <div class="padding-bottom5">
                                                        <span class="authortext"><?php echo Yii::t('translation', 'User_Publication_Authors'); ?> <i data-original-title="Type a word then press enter key" rel="tooltip" data-placement="right" data-id="id" style="font-weight: normal;top:95px;right:auto;float:left;margin-left:5px;" class="fa fa-question helpmanagement helpicon top10  tooltiplink"></i></span>
                                                       <span id="UserCVForm_PublicationAuthors_<?php  echo $value['Id'];?>_currentMentions"></span>
                                                    </div>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'PublicationAuthors['.$value['Id'].']', array("id" => 'UserCVForm_PublicationAuthors_'.$value['Id'], 'maxlength' => '30',  'onkeyup'=>'PublicationAuthors(event,this,"Authors")','value'=>'',  'value'=>$value['Authors'], 'class' => 'tooltiplink span12 textfield')); ?>
                                                            <?php echo $form->error($UserCVForm, 'PublicationAuthors_'.$value['Id']); ?>
                                                             <div id="UserCVForm_PublicationAuthors_<?php  echo $value['Id'];?>_error" class="errorMessage" style="display:none;"></div>
                                                        </div>
                                                </div>
                                            </div>
                                        <div class="row-fluid padding8top">
                                                <div class="span12">
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Publication_Location'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'PublicationLocation['.$value['Id'].']', array("id" => 'UserCVForm_PublicationLocation_'.$value['Id'], 'maxlength' => '50', 'value'=>$value['Location'], 'class' => 'tooltiplink span12 textfield')); ?>
                                                            <?php echo $form->error($UserCVForm, 'PublicationLocation_'.$value['Id']); ?>

                                                        </div>
                                                    </div>                                                    
                                                    
                                                    <div class="span3">
                                                        <label><?php echo Yii::t('translation', 'User_Cv_FileorLink'); ?></label>
                                                        <div class="lineheight25 pull-left radiobutton ">
                                                            <div class="control-group controlerror marginbottom20 " >
                                                                <?php 
                                                                $checkedL="";
                                                                $checkedF="";
                                                                if(trim($value['Link'])!= "" && $value['Link'] != "null")
                                                                { 
                                                                    $checkedL='checked=checked'; 
                                                                }
                                                                else if(trim($value['Files'])!="" && $value['Files'] != "null") 
                                                                    {
                                                                     $checkedF='checked=checked'; 
                                                                    }
                                                                ?>
                                                                <input type="radio" id="<?php echo $value['Id']; ?>" <?php echo $checkedL?> name="UserCVForm[UploadFileORLink][<?php echo $value['Id']; ?>]"  value="1" class="styled" onClick="setPublicationFile(this.value,'<?php echo $value['Id']; ?>')">
                                                                <label for="UserCVForm_UploadFileORLink_<?php echo $value['Id']; ?>">Link</label>
                                                                <input type="radio"  id="<?php echo $value['Id']; ?>" <?php echo $checkedF?> name="UserCVForm[UploadFileORLink][<?php echo $value['Id']; ?>]"  value="0" class="styled"  onClick="setPublicationFile(this.value,'<?php echo $value['Id']; ?>')" >
                                                                <label for="UserCVForm_UploadFileORLink_<?php echo $value['Id']; ?>">File</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="span5">
                                                        <input id="UserCVForm_PublicationFIleType_<?php echo $value['Id']; ?>" type="hidden" name="UserCVForm[PublicationFIleType][<?php echo $value['Id']; ?>]">
                                                        <div id='publication_link_div_<?php echo $value['Id']; ?>' style="display:<?php if($value['Link']!=""){ echo 'block';}else{ echo 'none';} ?>">
                                                        <label><?php echo Yii::t('translation', 'User_Publication_Link'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'PublicationLink['.$value['Id'].']', array("id" => 'UserCVForm_PublicationLink_'.$value['Id'], 'maxlength' => '250','value'=>$value['Link'], 'class' => 'tooltiplink span12 textfield')); ?>
                                                            <?php echo $form->error($UserCVForm, 'PublicationLink_'.$value['Id']); ?>

                                                        </div>
                                                        </div>
                                                        <div id='publication_pdf_div_<?php echo $value['Id']; ?>' style="display:<?php if($value['Files']!=""){ echo 'block';}else{ echo 'none';} ?>">
                                                        <input id="UserCVForm_PublicationPdf_<?php echo $value['Id']; ?>" type="hidden" name="UserCVForm[PublicationPdf][<?php echo $value['Id']; ?>]" value="<?php echo $value['Files'];?>">
                                                            <div >
                                                                <label>Upload PDF/DOC</label>
                                                                <div id='PublicationImage_<?php echo $value['Id'];?>' ></div>
                                                            </div>
                                                            <div>
                                                                <?php   
                                                                if($value['Files']!=""){
                                                                    $previewstyle='display:block';
                                                                   $imgArr=explode(".", $value['Files']);
                                                                         
                                                                    $extension = strtolower(end($imgArr));
                                                                    if ($extension == 'ppt' || $extension == 'pptx') {
                                                                        $Image = "/images/system/PPT-File-icon.png";
                                                                    } else if ($extension == 'pdf') {
                                                                        $Image = "/images/system/pdf.png";
                                                                    } else if ($extension == 'doc' || $extension == 'docx' || $extension == 'avi') {
                                                                        $Image = "/images/system/MS-Word-2-icon.png";
                                                                    } else if ($extension == 'exe' || $extension == 'xls' || $extension == 'ini' || $extension == 'xlsx') {
                                                                        $Image = "/images/system/Excel-icon.png";
                                                                    }
                                                                }else{
                                                                     $previewstyle='display:none';
                                                                }
                                                                
                                                                
                                                                
                                                                ?>
                                                                <div id="PublicationPreviewdiv_<?php echo $value['Id'];?>" class="preview span4" style=<?php echo $previewstyle;?> >

                                                                    <img class="qpreview" id="PublicationPreview_<?php echo $value['Id'];?>" name=""  src="<?php echo $Image;?> "/>
                                                                </div>
                                                            </div>
                                                            <div ><ul class="qq-upload-list" id="uploadlist_<?php echo $value['Id'];?>"></ul></div>
                                                            <div class="control-group controlerror " style="padding-bottom:30px;" >
                                                                <div id="PublicationImage_<?php echo $value['Id'];?>_error"  class="errorMessage marginbottom10 error"  style="display:none"></div>

                                                            </div>
                                                        
                                                        </div>
                                                        <div class="control-group controlerror "  style="padding-bottom:30px;" >
                                                                <div id="UserCVForm_Publicationfile_<?php echo $value['Id'];?>_em_"  class="errorMessage marginbottom10 error"  style="display:none"> </div>

                                                      </div>
                                                    </div>

                                                </div>
                                            </div>
                                            



                                       
                                    </div>
                                </div>
                            </div>
                            </div>
 <?php } } ?>
 

<!---------------------------------------------endPublicationss--------------------------------------------------------------->
                        </div>
                        
                         </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>        
<!--------------------------------------------------------------Achievements ----------------------------------------------------------------------------------------->
 <div id="Achievementsdragdiv" class="subdivdragClass" >
     
     <div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Achievements</div>
                      <?php  
                      if($data['achievements']!="failure" ){ ?>
                    <div class="addsection "><span id="Am_dropdown-toggle" style="display:<?php echo  sizeof($data['achievements'])>0?'block':'none'; ?>" class="dropdown-toggle dropdownsection" role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                            <div id="Am_dropdown" >
                                <ul aria-labelledby="drop2" role="menu">
                                    <?php foreach ($data['achievements'] as $key => $value) { ?>
                                        <li role="presentation"><a  onclick="addNewAchievement('<?php echo $value['Id']; ?>','<?php echo $value['Achievement']; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Achievement']; ?> </a></li>

                                    <?php } ?>

                                </ul> 
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion4">
                             <div id="achievements_div" class="achievementDraggable cvaction" name="achievements">  
  <!----------------------------------------------_Start------------------------------------------------------------------------->
                            
  <?php if($UsercvDetails['achievements'] != "failure"){ foreach ($UsercvDetails['achievements'] as $key => $value) { 

         ?>
    <div id="<?php echo $value['Achievement']; ?>_<?php echo $value['AchievementId']; ?>" class="achievementschild">
        <?php echo $form->hiddenField($UserCVForm, 'UserAchievements['.$value['AchievementId'].']');  ?> 
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_<?php echo $value['AchievementId']; ?>" href="#accordion_<?php echo $value['AchievementId']; ?>">
                                       <?php echo $value['Achievement']; ?>
                                    </a>
                                    <div class="sectionremove" data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removeSection('<?php echo $value['AchievementId']; ?>','<?php echo $value['Achievement']; ?>', 'Am_dropdown', 'Achievements','<?php echo $value['Id']; ?>')"><i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div id="accordion_<?php echo $value['AchievementId']; ?>" class="accordion-body collapse in achievements">
                                    <div class="accordion-inner">
                                       
                                        <div class="row-fluid">
                                            <div class="span12">
                                            
                                            <div class="control-group controlerror">
                                                  <div id="achievements_<?php echo $value['AchievementId']; ?>"  class=" inputor editableAchievementdiv"  contentEditable="true" > <?php echo $value['Description']; ?> </div>   

                                            <?php echo $form->error($UserCVForm, 'UserAchievements_'.$value['AchievementId']); ?>
                                            </div>
                                        </div>  
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                             </div>
  
  <?php } } ?>
<!-----------------------------------------------------End----------------------------------------------------------------->
                        </div>
                         </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
     
     
</div>
                     
</div>                         
<div class="row-fluid">   
<div class="span12">
<div class="headerbuttonpopup span9 " style="padding-top: 10px">
    <input id="userregistration" class="btn " type="button" onclick="saveCV()" value="Update">
    <input id="userregistration" class="btn btn_gray " type="reset" onclick="cancel()" value="Cancel" >   
     
    
</div>
</div>
</div>

                
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">    
 $("#tiltefor").html("<?php  echo $profileDetails->DisplayName; ?>'s"+" <?php echo Yii::t('translation', 'User_CV_Heading'); ?>");
 $("#profileBtn,#profileIntBtn").removeClass("active");
     $("#profileCVBtn").addClass("active");
     $(document).ready(function(){
        bindActionsForUserProfilePage();
          Custom.init();
     });
     <?php  if($IsUser == 1){?>
         $("#userFollowunfollowa_<?php  echo $profileDetails->UserId;?>").hide();
     <?php } ?>
</script>
<script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>


<script type="text/javascript">

    $('input[type=text]').focus(function(){
   clearerrormessage(this);
});
$("[rel=tooltip]").tooltip();




        $('#UserCVForm_UploadFileORLink').live('click', function() { 


        var radios = document.getElementsByTagName('input');

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].type === 'radio' && radios[i].checked) {
                // get value, set checked flag or do whatever you need to
                current_value= radios[i].value;  
                if (current_value == "1"){
                     $('#publication_link_div_0').show();
                        $('#publication_pdf_div_0').hide();
                 } else {
                     $('#publication_link_div_0').hide();
                      $('#publication_pdf_div_0').show();
                 }
            }
        }
    });


   var EducationId="Education_Year_"+<?php echo $EducationId;?>;
  // var EducationId="Education_Year_0";
 
   initializeCalender(EducationId);
    initializeCalender('publication_Date_0');






var g_publicationsArray=new Array();
globalspace["RecentupdateSection"]=new Array();

var   g_Educations = new Array();
var g_Experience=new Array();
 //g_Educations.push(0);

 g_Educations = <?php echo json_encode($CvIdDetails['education']); ?>;
 g_Experience = <?php echo json_encode($CvIdDetails['experience']); ?>;

 g_Interests=new Array();
g_Interests=<?php echo json_encode($CvIdDetails['interests']);?>;
 
 g_Achievements=new Array();
 g_Achievements=<?php echo json_encode($CvIdDetails['achievements']); ?>;
 
 g_publicationsArray=<?php echo json_encode($CvIdDetails['publications']); ?>;

 if(g_publicationsArray==null){
      g_publicationsArray=new Array();
 }
 if(g_Educations==null){
      g_Educations=new Array();
 }
 if(g_Experience==null){
      g_Experience=new Array();
 }
 if(g_Achievements==null){
      g_Achievements=new Array();
 }
  if(g_Interests==null){
      g_Interests=new Array();
 }

  var g_publication=g_publicationsArray.length;
 $('.cvaction').click(function(){
    
 var action = $(this).attr('name');
  if(globalspace["RecentupdateSection"].length < 1){
    
    globalspace["RecentupdateSection"].push(action);
}

});
 
for (var i = 0; i < g_Interests.length; i++) {
    
    globalspace["cv_custom_mention_UserCVForm_UserInterests_"+g_Interests[i]]=new Array();
  
    var globalInterestsArray=$('#UserCVForm_UserInterests_'+g_Interests[i]).val().split(',');
    for (var j = 0; j < globalInterestsArray.length; j++) {
         
        globalspace['cv_custom_mention_UserCVForm_UserInterests_'+g_Interests[i]].push(globalInterestsArray[j]);
        var stringdata = "<span class='dd-tags hashtag'><b>"+globalInterestsArray[j]+"</b><i id='cv_custom_mention_UserCVForm_UserInterests_"+g_Interests[i]+"' data-name='"+globalInterestsArray[j]+"'  class='cv_custom_mention_UserCVForm_UserInterests_"+g_Interests[i]+"' >X</i></span></span>";
        $("#UserCVForm_UserInterests_"+g_Interests[i]+'_currentMentions').append(stringdata);
        $("#UserCVForm_UserInterests_"+g_Interests[i]+'_currentMentions .cv_custom_mention_UserCVForm_UserInterests_'+g_Interests[i]).die("click");
        $("#UserCVForm_UserInterests_"+g_Interests[i]+'_currentMentions .cv_custom_mention_UserCVForm_UserInterests_'+g_Interests[i]).live("click", function(){
               deleteInvitedAtMentionForCV_Custom(this,$(this).attr('data-name'),'cv_custom_mention_UserCVForm_UserInterests_'+this.id);
           });
              
       
    }

    $('#UserCVForm_UserInterests_'+g_Interests[i]).val("");
}

$(".inputor").live('click',function()
    {
      removeEditor();
       initializeEditorNew($(this).attr('id'));
    });
        
 var Publicationextensions='"txt","doc","docx","pptx","pdf","ppt","xls","xlsx"';
 // var Publicationextensions='"txt","doc","docx","pptx","pdf","ppt"';

  for (var i = 0; i < g_publicationsArray.length; i++) {

    initializeFileUploader('PublicationImage_'+g_publicationsArray[i], '/user/UploadPublicationImage', '10*1024*1024', Publicationextensions,1,'PublicationImage_'+g_publicationsArray[i],'',PublicationPreviewImage,displayErrorForPublication,"uploadlist_"+g_publicationsArray[i]);
    
initializationAtMentionsForCV("#UserCVForm_PublicationAuthors_"+g_publicationsArray[i]);
  }


   $(document).ready(function() {
       $(".scroll").jScrollPane({autoReinitialise: true, autoReinitialiseDelay: 200, stickToBottom: false,mouseWheelSpeed:50});
        $('#UserCVForm_isPharmacist').live('click', function() { 


        var radios = document.getElementsByTagName('input');

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].type === 'radio' && radios[i].checked) {
                // get value, set checked flag or do whatever you need to
                current_value= radios[i].value;  
                if (current_value == "1"){
                     $('#customfields').show();
                        $('#statelicensenumber').show();
                    } else {
                        $('#statelicensenumber').hide();
                    }
            }
        }
    });
  })
  
  

function setAuthorsStyle(id){
     var editorObject = $("#"+id+'.inputor');
    var data=getEditorText(editorObject);
   
}

function initializeCalender(id){
    
    
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var surveycheckin = $('#'+id).datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {


        $('.datepicker').hide();

    });
    
    
}

function PublicationPreviewImage(id, fileName, responseJSON, type)
{

    var data = eval(responseJSON);
    var publicationdiv = type.split("_");
    var PublicationId=publicationdiv[publicationdiv.length-1];
 
    $('#PublicationPreviewdiv_'+PublicationId).show();
    var filetype=responseJSON['extension'];
    var image = getImageIconByType(filetype);
    if(image==""){
            image=responseJSON['filepath'];
       }
    

    $('#PublicationPreview_'+PublicationId).attr('src', image);
    $('#PublicationPreview_'+PublicationId).attr('name', data.filename);
     $('#UserCVForm_PublicationPdf_'+PublicationId).val(data.filename);
    //  $('#UserCVForm_PublicationLink_'+PublicationId).val('');
     

}
   
function addNewEducation(id,name){

     g_Educations.push(id);
     $('#UserCVForm_Education').val(g_Educations);
      var data="";
      g_Educations[g_Educations.length-1];
      var eduID= g_Educations[g_Educations.length-1];
      var educationId= eduID+1;
      var URL = "/user/AddNewEducation?Id="+id+'&name='+name+'&educationId='+educationId;
     ajaxRequest(URL,data,function(data){renderNewEducationPageHandler(data,g_Educations,"E_dropdown",name,id,'Education')},"html");
}  

function renderNewEducationPageHandler(html,id,div,name,educationId,category){
    $("#education_div").append(html);
   var calenderId="Education_Year_"+educationId;
   initializeCalender(calenderId);
UpdateEducationDropdown(id,div,category);
//Custom.clear();

}
function UpdateEducationDropdown(id,div,category){
    var data="";
      var URL = "/user/UpdateDropdown?Id="+id+'&category='+category;
     ajaxRequest(URL,data,function(data){renderDropdownHandler(data,div)},"html");
}

function removeSectionFromCV(param){
    closeModelBox();
    var paramArray = param.split(',');
    var id = paramArray[0];
    var div = paramArray[1];
    var category = paramArray[2];
    var name = paramArray[3];
      var orgId = paramArray[4];
    var data="";
      var URL = "/user/RemoveSectionFromCV?Id="+id+'&category='+category+'&orgId='+orgId;
        ajaxRequest(URL,data,function(data){},"html");
     
     
     var removediv=name+"_"+id;

    if(category=='Education'){
         var removediv=name+"_"+orgId;
       
         g_Educations = $.grep(g_Educations, function(value) {
             return value != id;
        });
        $('#UserCVForm_Education').val(g_Educations);
    
        UpdateEducationDropdown(g_Educations,div,category);

    }else if(category=='Experience'){
        
        
         g_Experience = $.grep(g_Experience, function(value) {
             return value != id;
        });
      
         $('#UserCVForm_Experience').val(g_Experience);
        UpdateEducationDropdown(g_Experience,div,category);
        
    }else if(category=='Interests'){
        
        g_Interests = $.grep(g_Interests, function(value) {
             return value != id;
        });
        $('#UserCVForm_Interests').val(g_Interests);
        UpdateEducationDropdown(g_Interests,div,category);
    }else if(category=='Achievements'){
        
       g_Achievements = $.grep(g_Achievements, function(value) {
             return value != id;
        });
          $('#UserCVForm_Achievements').val(g_Achievements);
        UpdateEducationDropdown(g_Achievements,div,category);
    }
   
$("#"+removediv).remove();
     
     
}



function renderDropdownHandler(html,div){
    
    if($.trim(html) == ""){ 
            $("#"+div+"-toggle").hide();
        }else{
            $("#"+div+"-toggle").show();
            $("#"+div).html(html);
        }
    
//Custom.clear();

}
function confirmRemoveSectionFromCV(id,div,category,name,orgId){
    var modelType = 'error_modal';
    var title = 'Delete Section';
    var content = "Are you sure you want to delete this section?";
    var closeButtonText = 'No';
    var okButtonText = 'Yes';
    var okCallback = removeSectionFromCV;
    var param = '' + id + ',' + div + ',' + category+',' + name+',' + orgId;
    openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param);
    $("#newModal_btn_close").show();
}
function removeSection(id,name,div,category,orgId){
    confirmRemoveSectionFromCV(id,div,category,name,orgId);
    



}

 
function addNewExperience(id,name){
      Custom.clear();
    //  Custom.init();
     g_Experience.push(id);
      $('#UserCVForm_Experience').val(g_Experience);
      var data="";
      var URL = "/user/AddNewExperience?Id="+id+'&name='+name;
     ajaxRequest(URL,data,function(data){renderNewExperiencePageHandler(data,g_Experience,"EX_dropdown",name,id,'Experience')},"html");
}  

function renderNewExperiencePageHandler(html,id,div,name,experienceId,category){

    $("#experience_div").append(html);

    UpdateEducationDropdown(id,div,category);
     Custom.init();
//Custom.clear();

}
function addNewInterest(id,name){

     g_Interests.push(id);
      $('#UserCVForm_Interests').val(g_Interests);
      var data="";
      var URL = "/user/AddNewInterest?Id="+id+'&name='+name;
     ajaxRequest(URL,data,function(data){renderNewInterestsPageHandler(data,g_Interests,"In_dropdown",name,id,'Interests')},"html");
}  

function renderNewInterestsPageHandler(html,id,div,name,experienceId,category){

    $("#interests_div").append(html);

UpdateEducationDropdown(id,div,category);
//Custom.clear();

}


function addNewAchievement(id,name){

     g_Achievements.push(id);
      $('#UserCVForm_Achievements').val(g_Achievements);
      var data="";
      var URL = "/user/AddNewAchievement?Id="+id+'&name='+name;
     ajaxRequest(URL,data,function(data){renderNewAchievementPageHandler(data,g_Achievements,"Am_dropdown",name,id,'Achievements')},"html");
}  

function renderNewAchievementPageHandler(html,id,div,name,experienceId,category){

    $("#achievements_div").append(html);

UpdateEducationDropdown(id,div,category);
//Custom.clear();

}



function addOneMorePublication(){

     var data="";
     g_publication++;
      var URL = "/user/AddNewPublication?Id=" + g_publication;
      g_publicationsArray.push(g_publication);
      $('#UserCVForm_Publications').val(g_publicationsArray);
//      $( ".panel-collapse" ).each(function(key,index) {
//          
//       $( this ).removeClass('in') });
     ajaxRequest(URL,data,function(data){renderNewPublicationPageHandler(data)},"html");

    }

function renderNewPublicationPageHandler(html){ 

   $("#publication_div").append(html);
   var calenderId="publication_Date_"+g_publication;
  // initializeCalender(calenderId);
    initializationAtMentionsForCV("#UserCVForm_PublicationAuthors_"+g_publication);
  $('#PublicationImage_').attr("id", 'PublicationImage_'+g_publication);
   $('#uploadlist_').attr("id", 'uploadlist_'+g_publication);
   initializeFileUploader('PublicationImage_'+g_publication, '/game/UploadGameBannerImage', '10*1024*1024', Publicationextensions,1, 'PublicationImage_'+g_publication ,g_publication,PublicationPreviewImage,displayErrorForPublication,"uploadlist_"+g_publication);
   $('#PublicationPreviewdiv_').attr("id", 'PublicationPreviewdiv_'+g_publication);
   $('#PublicationPreview_').attr("id", 'PublicationPreview_'+g_publication);
Custom.clear();
    //  g_publication=g_publication+1;
      
    Custom.init();

$("[rel=tooltip]").tooltip();
}  
function removePublication(publicationId){ 
   confirmRemovePublicationFromCV(publicationId); 
   
} 
function confirmRemovePublicationFromCV(id){
    var modelType = 'error_modal';
    var title = 'Delete Publication';
    var content = "Are you sure you want to delete this publication?";
    var closeButtonText = 'No';
    var okButtonText = 'Yes';
    var okCallback = removePublicationConfirmHandler;
    var param = '' + id + ',' ;
    openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param);
    $("#newModal_btn_close").show();
}

function removePublicationConfirmHandler(param){
   
   
   closeModelBox();
    var paramArray = param.split(',');
    var publicationId = paramArray[0];
   
    var data="";
     
     var URL = "/user/RemoveSectionFromCV?Id="+publicationId+'&category=Publications&orgId='+publicationId;
     ajaxRequest(URL,data,function(data){},"html");
   
    $("#publicationdiv_"+publicationId).remove();
 
         g_publicationsArray = $.grep(g_publicationsArray, function(value) {
  return value != publicationId;
});  
        
    $('#UserCVForm_Publications').val(g_publicationsArray);

$("[rel=tooltip]").tooltip();
    }
  
function bindDataToExperience(id){
    var divid=
    $('#UserCVForm_UserExperience_'+id).val($('#experience_'+id).html());   
    
}

function saveCV(){
 


var educationIDsArray=new Array();
$('#education_div .educationchild').each( function(){
    var id=this.id;
    var educationid=id.split("_");
   educationIDsArray.push(educationid['1']);
   
});
var EditeducationIDsArray=new Array();
$('#education_div .educationchild').each( function(){
    var education_id=$(this).attr('data-id');
    
   EditeducationIDsArray.push(education_id);
   
});
var experienceIDsArray=new Array();
$('#experience_div .experiencechild').each( function(){
    var id=this.id;
    var experienceid=id.split("_");
   experienceIDsArray.push(experienceid['1']);
   
});

var InterestsIDsArray=new Array();
$('#interests_div .interestschild').each( function(){
    var id=this.id;
    var interestsid=id.split("_");
   InterestsIDsArray.push(interestsid['1']);
   
});

var AchievementIDsArray=new Array();
$('#achievements_div .achievementschild').each( function(){
    var id=this.id;
    var achievementsid=id.split("_");
   AchievementIDsArray.push(achievementsid['1']);
   
});

var PublicationsIDsArray=new Array();
$('#publication_div .publicationschild').each( function(){
    var id=this.id;
    var publicationsid=id.split("_");
   PublicationsIDsArray.push(publicationsid['1']);
   
});

$('#UserCVForm_Education').val(educationIDsArray);
$('#UserCVForm_Education_Ids').val(EditeducationIDsArray);

$('#UserCVForm_Experience').val(experienceIDsArray);
$('#UserCVForm_Interests').val(InterestsIDsArray);  
$('#UserCVForm_Achievements').val(AchievementIDsArray);  
$('#UserCVForm_Publications').val(PublicationsIDsArray); 

     for (var i = 0; i <=g_Experience.length; i++) {  
        if(g_Experience[i]!=undefined && g_Experience[i]!='undefined')
        $('#UserCVForm_UserExperience_'+g_Experience[i]).val($('#experience_'+g_Experience[i]).html());
        //alert($('#UserCVForm_UserExperience_'+g_Experience[i]).val());
     }
      
     for (var i = 0; i < g_Interests.length; i++){  
          if(g_Interests[i]!=undefined && g_Interests[i]!='undefined')
         $('#UserCVForm_UserInterests_'+g_Interests[i]).val(globalspace["cv_custom_mention_UserCVForm_UserInterests_"+g_Interests[i]]);
     }

 for (var i = 0; i < g_publicationsArray.length; i++){
  
          if(g_publicationsArray[i]!=undefined && g_publicationsArray[i]!='undefined'){
          var Authors=new Array();
        
          if(typeof globalspace["cv_mention_Username_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]]!='undefined'){
                if(globalspace["cv_mention_Username_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]].length >0){
                  
                      Authors.push(globalspace["cv_mention_Username_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]]);
                }
      }
          Authors.push(globalspace["cv_custom_mention_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]]);
         $('#UserCVForm_PublicationAuthors_'+g_publicationsArray[i]).val(Authors);
         
      } 
      
     
      
   
      var g_uploadfile = document.getElementsByName('UserCVForm[UploadFileORLink]['+g_publicationsArray[i]+']');
   
     var uploadFilevalue="";
      for(var k=0;k<g_uploadfile.length;k++){
          
            if (g_uploadfile.item(k).checked==true) {
            uploadFilevalue=g_uploadfile.item(k).value;     
            
        }
      }

            if(uploadFilevalue==1){
               
                if(($('#UserCVForm_PublicationLink_'+g_publicationsArray[i]).val()!="")){

                     $('#UserCVForm_Publicationfile_'+g_publicationsArray[i]).val($('#UserCVForm_PublicationLink_'+g_publicationsArray[i]).val());
                }
              $('#UserCVForm_PublicationPdf_'+g_publicationsArray[i]).val('');
               $('#UserCVForm_PublicationFIleType_'+g_publicationsArray[i]).val('1');
             }else{
                 if($('#UserCVForm_PublicationPdf_'+g_publicationsArray[i]).val()!=""){

                       $('#UserCVForm_Publicationfile_'+g_publicationsArray[i]).val($('#UserCVForm_PublicationPdf_'+g_publicationsArray[i]).val());
                }
                 $('#UserCVForm_PublicationLink_'+g_publicationsArray[i]).val('');
                  $('#UserCVForm_PublicationFIleType_'+g_publicationsArray[i]).val('0');
             }

  }
     for (var i = 0; i <=g_Achievements.length; i++) {  
       
       if(g_Achievements[i]!='undefined' && g_Achievements[i]!=undefined)
       {
           $('#UserCVForm_UserAchievements_'+g_Achievements[i]).val($('#achievements_'+g_Achievements[i]).html()); 
       }
       
       
      
     }
     
$('#UserCVForm_RecentupdateSection').val(globalspace["RecentupdateSection"]);
    
     var data=$("#UserCV-form").serialize();
     
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->createAbsoluteUrl("user/publicationsSave"); ?>',
                    data:data,
                    success:publicationscallback,
                    error: function(data) { 
                       // publicationscallback(data, txtstatus, xhr)
                        //// if error occured
                       // alert("Error occured.please try again==="+data.toSource());
                        // alert(data.toSource());
                    },

                    dataType:'json'
                }); 
    
    
}

function setPublicationFile(value,id){
 
            if (value == "1"){
                     $('#publication_link_div_'+id).show();
                      $('#publication_pdf_div_'+id).hide();
                 } else {
                      $('#publication_pdf_div_'+id).show();
                      $('#publication_link_div_'+id).hide();
                 }
}


  $('.draggable').sortable({
            connectWith: '.EducationClass',
            handle: 'a',
            cursor: 'move',
//            placeholder: 'placeholder',
//            forcePlaceholderSize: true,
            opacity: 1.8,

        });
        
//        
    $('.experienceDraggable').sortable({
            connectWith: '.ExperienceClass',
            handle: 'a',
            cursor: 'move',
//            placeholder: 'placeholder',
//            forcePlaceholderSize: true,
            opacity: 1.8,

        });
//        
        $('.interestsDraggable').sortable({
            connectWith: '.InterestsClass',
            handle: 'a',
            cursor: 'move',
//            placeholder: 'placeholder',
//            forcePlaceholderSize: true,
            opacity: 1.8,

        });
        $('.achievementDraggable').sortable({
            connectWith: '.AchievementClass',
            handle: 'a',
            cursor: 'move',
//            placeholder: 'placeholder',
//            forcePlaceholderSize: true,
            opacity: 1.8,

        });
         $('.publicationDraggable').sortable({
            connectWith: '.PublicationClass',
            handle: 'a',
            cursor: 'move',
//            placeholder: 'placeholder',
//            forcePlaceholderSize: true,
            opacity: 1.8,

        });
////        
//         $('.maindivDraggable').sortable({
//            connectWith: '.subdivdragClass',
//            handle: 'div',
//            cursor: 'move',
////            placeholder: 'placeholder',
////            forcePlaceholderSize: true,
//            opacity: 1.8,
//
//        });
//        
        
        
        
    
        

     $('.radio').live('click', function() { 


        var radios = document.getElementsByTagName('input');
        

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].type === 'radio' && radios[i].checked) {
                // get value, set checked flag or do whatever you need to
               var id=radios[i].id;
               
              var  current_value= radios[i].value;  
                if (current_value == "1"){
                    $('#publication_link_div_'+id).show();
                      $('#publication_pdf_div_'+id).hide();
                 } else {
                      $('#publication_pdf_div_'+id).show();
                      $('#publication_link_div_'+id).hide();
                 }
            }
        }
    });
     

function displayErrorForPublication(message,type){
    
      $('#'+type+'_error').html(message);
     $('#'+type+'_error').css("padding-top:20px;");
     $('#'+type+'_error').show();
     $('#'+type+'_error').fadeOut(6000);
}
 
 //setTimeout(function() { // waiting for 1 sec ... because it is very fast, so that's why we have to forcely wait for a sec.
 
 
 for (var i = 0; i < g_publicationsArray.length; i++) {
    
    globalspace["cv_custom_mention_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]]=new Array();
   
    var globalAuthorsArray=$('#UserCVForm_PublicationAuthors_'+g_publicationsArray[i]).val().split(',');
     
  
    for (var j = 0; j < globalAuthorsArray.length; j++) {
         if(globalAuthorsArray[j]!=""){
        globalspace['cv_custom_mention_UserCVForm_PublicationAuthors_'+g_publicationsArray[i]].push(globalAuthorsArray[j]);
       //var stringdata="<span data-user-id='' class='at_mention dd-tags  dd-tags-close'><b>"++"</b><i id='cv_custom_mention_UserCVForm_UserInterests_"+g_publicationsArray[i]+"' >X</i></span>";
       var stringdata = "<span class='dd-tags hashtag'><b>"+globalAuthorsArray[j]+"</b><i  id='cv_custom_mention_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]+"' data-name='"+globalAuthorsArray[j]+"' onclick='deleteInvitedAtMentionForCV_Custom( this,"+g_publicationsArray[i]+",cv_custom_mention_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]+")' class='cv_custom_mention_UserCVForm_PublicationAuthors_"+g_publicationsArray[i]+"' >X</i></span></span>";
       $("#UserCVForm_PublicationAuthors_"+g_publicationsArray[i]+'_currentMentions').append(stringdata);
    $("#UserCVForm_PublicationAuthors_"+g_publicationsArray[i]+'_currentMentions .cv_custom_mention_UserCVForm_PublicationAuthors_'+g_publicationsArray[i]).die("click");    
    $("#UserCVForm_PublicationAuthors_"+g_publicationsArray[i]+'_currentMentions .cv_custom_mention_UserCVForm_PublicationAuthors_'+g_publicationsArray[i]).live("click", function(){
            
        deleteInvitedAtMentionForCV_Custom(this,$(this).attr('data-name'),'cv_custom_mention_UserCVForm_PublicationAuthors_'+this.id);
           });
       } 
    }

    $('#UserCVForm_PublicationAuthors_'+g_publicationsArray[i]).val("");
}
 //       }, 500);
  
function bindActionsForUserProfilePage(){
     if(<?php echo $profileDetails->UserFollowersCount ?> > 0){
      $('.p_followers').live("click",function(){
                 tpage=0;                
                 tFPopupAjax = false; 
                 $("#userFollowersFollowings_body").empty();
                  getUserProfileFollowers('<?php  echo $profileDetails->UserId ?>','<?php echo $profileDetails->DisplayName ?>');
                  
              });    
         }           
          
          if(<?php echo $profileDetails->UserFollowingCount ?> > 0){
              $('.p_following').live("click",function(){
                  tpage=0;
                  tFPopupAjax = false; 
                  $("#userFollowersFollowings_body").empty();
                  getUserProfileFollowing('<?php  echo $profileDetails->UserId ?>','<?php echo $profileDetails->DisplayName ?>');
                  
              });
              
          }  
            $('.groupId').live("click",function(){
            var groupId=$(this).attr('data-value');
            var showIntroPopup=$(this).attr('data-showIntroPopUp');
            if(showIntroPopup==1){
              getGroupIntroPopUp(groupId);        
            }else{
                
               var param='';
               var content='you are not authorized to access this group';
                openModelBox("alert_modal", "Group", content, "Ok", 'Nodisplay', '', param);
            }
            
           
       
         trackEngagementAction("GroupMinPopup",groupId);
              });
              $('.subgroupId').live("click",function(){
            var subgroupId=$(this).attr('data-value');
            
           var showSubIntroPopup=$(this).attr('data-showSubIntroPopUp');
            if(showSubIntroPopup==1){
               getSubGroupIntroPopUp(subgroupId);     
            }else{
                
               var param='';
               var content='you are not authorized to access this group';
                openModelBox("alert_modal", "SubGroup", content, "Ok", 'Nodisplay', '', param);
            }
                      
         
          trackEngagementAction("SubGroupMinPopup",subgroupId);
              });
           $('#ProfilePopupFollowersAndFollowing').live("click",function(){ 
             //      $(".scroll").bind('jsp-scroll-y');
                 isDuringAjax=false;
                 
               
                });
              
                
}
    
</script>
