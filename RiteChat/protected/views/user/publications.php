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
<?php echo $form->hiddenField($UserCVForm, 'Interests'); ?>
<?php echo $form->hiddenField($UserCVForm, 'Publications'); ?>
    <?php echo $form->hiddenField($UserCVForm, 'Experience'); ?> 
<?php //echo $form->hiddenField($UserCVForm, 'Interests['.$InterestId.']'); ?>
 <?php //echo $form->hiddenField($UserCVForm, 'UserInterests['.$InterestId.']'); ?> 
 <?php echo $form->hiddenField($UserCVForm, 'Achievements'); ?>
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
                    <div class="addsection " id="E_dropdown-sec"><span id="E_dropdown-toggle" class="dropdown-toggle dropdownsection"  role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection" id="E_dropdown-menu">
                          <div id="E_dropdown" >
                            <ul aria-labelledby="drop2" role="menu">
                            <?php    foreach ($data['education'] as $key => $value) { ?>
                                <li role="presentation"><a  onclick="addNewEducation('<?php echo $value['Id'] ; ?>','<?php echo $value['Categoryname'] ; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Categoryname'] ; ?> </a></li>

                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner education">
                        <div class="accordion" id="accordion1">
                            <div id="education_div" class="draggable cvaction" name="education" >
                              <div id="Graduation_<?php echo $EducationId; ?>" data-id='0' class="educationchild">
                            <div class="accordion-group">
                                <div class="accordion-heading ">
                                    <a class="accordion-toggle EducationClass" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                                        Graduate
                                    </a>
<!--                                    <div class="sectionremove"  data-placement="bottom" rel="tooltip"  data-original-title="Remove section" ><i class="fa fa-times"></i>
                                    </div>-->
                                </div>
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                       
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Name'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'CollegeName['.$EducationId.']', array("id" => "UserCVForm_CollegeName_$EducationId", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                                                            <?php echo $form->error($UserCVForm, 'CollegeName_' . $EducationId); ?>

                                                        </div>
                                                    </div>
                                                    <div class="span4">

                                                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Specialization'); ?></label>
                                                        <div class="control-group controlerror marginbottom10">
                                                            <?php echo $form->textField($UserCVForm, 'Specialization['.$EducationId.']', array("id" => "UserCVForm_Specialization_$EducationId", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                                                            <?php echo $form->error($UserCVForm, 'Specialization_' . $EducationId); ?>
                                                        </div>
                                                    </div>
                                                    <div class="span4 divrelative">

                                                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Year'); ?></label>
                                                        <div id="Education_Year_<?php echo $EducationId; ?>" class="input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">
                                                            <?php echo $form->textField($UserCVForm, 'YearOfPassing['.$EducationId.']', array("id" => "UserCVForm_YearOfPassing_$EducationId", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                                                            <div class="control-group controlerror"> 
                                                                <?php echo $form->error($UserCVForm, 'YearOfPassing_' . $EducationId); ?>
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
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<!----------------------------------------Experience -------------------------------------------------------->
<div id="experiencedragdiv" class="subdivdragClassffff" >
<div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Experience</div>
                    <div class="addsection "><span id="EX_dropdown-toggle" class="dropdown-toggle dropdownsection"  role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                             <div id="EX_dropdown" >
                            <ul aria-labelledby="drop2" role="menu">
                             <?php    foreach ($data['experience'] as $key => $value) { ?>
                                <li role="presentation"><a  onclick="addNewExperience('<?php echo $value['Id'] ; ?>','<?php echo $value['Experience'] ; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Experience'] ; ?> </a></li>

                            <?php } ?>
                                
                            </ul> 
                        </div>
                        </div>
                    </div>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion2">
                             <div id="experience_div" class="experienceDraggable cvaction" name="experience">
                        
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
                    <div class="addsection "><span id="In_dropdown-toggle" class="dropdown-toggle dropdownsection"  role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                           <div id="In_dropdown" >
                            <ul aria-labelledby="drop2" role="menu">
                             <?php    foreach ($data['interests'] as $key => $value) { ?>
                                <li role="presentation"><a   onclick="addNewInterest('<?php echo $value['Id'] ; ?>','<?php echo $value['Interests'] ; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Interests'] ; ?> </a></li>

                            <?php } ?>
                                
                            </ul> 
                         </div>

                        </div>
                    </div>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion3">
                            <div id="interests_div" class="interestsDraggable cvaction" name="interests">
                              
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

            
            <div>
                
            </div>    
<!--------------------------------------------------------------Publications ----------------------------------------------------------------------------------------->
<div id="publicationsdragdiv" class="subdivdragClass" style="cursor: pointer">    
    <div class="row-fluid">
 <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Publications</div>
                     <div class="addsection "><span class="dropdown-toggle dropdownsection"  onclick="addOneMorePublication()" role="button" >Add Section</span>
                        
                    </div>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion5">
                            <div id="publication_div" class="publicationDraggable cvaction" name="publications">
                               
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
<div id="Achievementsdragdiv" class="subdivdragClassfffh"  >      
<div class="row-fluid">
    <div class="span9 customaccordian">
        <div class="cvaccordian">
            <div class="cvoutergroup">
                <div class="cvaccordian-heading">
                    <div class="cvaccordion-toggle">Achievements</div>
                    <div class="addsection "><span id="Am_dropdown-toggle" class="dropdown-toggle dropdownsection" role="button" data-toggle="dropdown" data-target="#">Add Section</span>
                        <div class="dropdown-menu dropdown-menuaddsection">
                            <div id="Am_dropdown" >
                                <ul aria-labelledby="drop2" role="menu">
                                    <?php foreach ($data['achievements'] as $key => $value) { ?>
                                        <li role="presentation"><a   onclick="addNewAchievement('<?php echo $value['Id']; ?>','<?php echo $value['Achievement']; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Achievement']; ?> </a></li>

                                    <?php } ?>

                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cvaccordion-body">
                    <div class="cvaccordion-inner">
                        <div class="accordion" id="accordion4">
                             <div id="achievements_div" class="achievementDraggable cvaction" name="achievements">  
                                
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
    <input id="userregistration" class="btn" type="button" onclick="saveCV()" value="Save" >   
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
</script>
<script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>


<script type="text/javascript">
$("[rel=tooltip]").tooltip();

    Custom.init();


    globalspace["userInterests_"+<?php echo $ExperienceId; ?>]=new Array();
  globalspace["PublicationsAuthors_0"]=new Array();
  globalspace["RecentupdateSection"]=new Array();
  //$('#UserCVForm_UserExperience_0').val("hhhhhhhhhh");   
 var Experienceid='<?php echo $ExperienceId; ?>';
 $(".inputor").live('click',function()
    {
      removeEditor();
       initializeEditorNew($(this).attr('id'));
    });



   var EducationId="Education_Year_"+<?php echo $EducationId;?>;
  // var EducationId="Education_Year_0";
 
  // initializeCalender(EducationId);
    initializeCalender('publication_Date_0');

var AchievementId='<?php echo $AchievementId; ?>';


var g_publication=1;
var g_publicationsArray=new Array();
var g_RecentupdateSection=new Array();

var   g_Educations = new Array();
var g_Experience=new Array();
// g_Educations.push(1);
 g_Experience.push(Experienceid);
 g_Interests=new Array();
 var InterestId='<?php echo $InterestId; ?>';
 g_Interests.push(InterestId);

 g_Achievements=new Array();
  g_Achievements.push(AchievementId);
  g_publicationsArray.push(0);

 var Publicationextensions='"txt","doc","docx","pptx","pdf","ppt","xls","xlsx"';
 // var Publicationextensions='"txt","doc","docx","pptx","pdf","ppt"';
 // initializeFileUploader('PublicationImage_0', '/user/UploadPublicationImage', '10*1024*1024', Publicationextensions,1,'PublicationImage_0','',PublicationPreviewImage,displayErrorForPublication,"uploadlist_0");
   $(document).ready(function() {
       initializationAtMentionsForCV("#UserCVForm_PublicationAuthors_0");
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
  
  

function publicationscallback(data, txtstatus, xhr) {
   
        scrollPleaseWaitClose('registrationSpinLoader');
        var data = eval(data);
        
        if (data.status == 'success') {
            $("#UserCV-form")[0].reset();
            var msg = data.data;
            
           if(data.message!=""){
                $("#sucmsg").css("display", "block");
               $("#sucmsg").html(data.message);
                $("#sucmsg").focus();

            }
            
            $("#errmsg").css("display", "none");
            $("#sucmsg").fadeOut(5000);
            $('.checkbox').css('background-position', '0px 0px');
            $('.radio').css('background-position', '0px 0px');
             var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    sessionStorage.userProfile = urlArr[1];
    window.location.href = "/userCVView/"+urlArr[1];

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

                $('.experience').css('height','130px');
                $('.achievements').css('height','130px');
                $('.interests').css('height','130px');
                $('.education').css('padding','20px');
                
                
                $.each(error, function(key, val) {

                    if ($("#" + key + "_em_")) {

                      
                        $("#" + key + "_em_").text(val);
                        $("#" + key + "_em_").show();
                        $("#" + key + "_em_").fadeOut(8000);
                        $("#" + key).parent().addClass('error');
                    }

                });
                setTimeout(function() { // waiting for 1 sec ... because it is very fast, so that's why we have to forcely wait for a sec.
          $('.experience').css('height','');
           $('.achievements').css('height','');
             $('.interests').css('height','');
              $('.education').css('padding','');
//            socketPost.emit('getLatestPostRequest4All', loginUserId, userTypeId, postAsNetwork,sessionStorage.old_key,gPage);

        }, 8000);
            }
        }

    }
    
 

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
       
    $("#UserCVForm_PublicationPdf_"+PublicationId).val(data.filename);

    $('#PublicationPreview_'+PublicationId).attr('src', image);
    $('#PublicationPreview_'+PublicationId).attr('name', data.filename);
    $('#UserCVForm_PublicationPdf_'+PublicationId).val(data.filename);

}
function displayErrorForPublication(message,type){
    
      $('#'+type+'_error').html(message);
     $('#'+type+'_error').css("padding-top:20px;");
     $('#'+type+'_error').show();
     $('#'+type+'_error').fadeOut(6000);
}
    
function addNewEducation(id,name){    
     g_Educations.push(id);     
     $('#UserCVForm_Education').val(g_Educations);
      var data="";
      var educationId=g_Educations.length;
      var URL = "/user/AddNewEducation?Id="+id+'&name='+name+'&educationId='+educationId;
     ajaxRequest(URL,data,function(data){renderNewEducationPageHandler(data,g_Educations,"E_dropdown",name,id,'Education')},"html");
}  

function renderNewEducationPageHandler(html,id,div,name,educationId,category){
    $("#education_div").append(html);
   var calenderId="Education_Year_"+educationId;
   initializeCalender(calenderId);
   globalspace["RecentupdateSection"].push('education');
UpdateEducationDropdown(id,div,category);
//Custom.clear();

}
function UpdateEducationDropdown(id,div,category){
    var data="";
      var URL = "/user/UpdateDropdown?Id="+id+'&category='+category;           
     ajaxRequest(URL,data,function(data){renderDropdownHandler(data,div)},"html");
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

function removeSection(id,name,div,category,orgId){
    var removediv=name+"_"+id;
  
    if(category=='Education'){
        var removediv=name+"_"+orgId;
        globalspace["RecentupdateSection"].push('education');
         g_Educations = $.grep(g_Educations, function(value) {
             return value != id;
        });
        $('#UserCVForm_Education').val(g_Educations);
        UpdateEducationDropdown(g_Educations,div,category);

    }else if(category=='Experience'){
        globalspace["RecentupdateSection"].push('experience');
        
        
         g_Experience = $.grep(g_Experience, function(value) {
             return value != id;
        });
        
         $('#UserCVForm_Experience').val(g_Experience);
        UpdateEducationDropdown(g_Experience,div,category);
        
    }else if(category=='Interests'){
        globalspace["RecentupdateSection"].push('interests');
       
          g_Interests = $.grep(g_Interests, function(value) {
             return value != id;
        });
        $('#UserCVForm_Interests').val(g_Interests);
       
        if(typeof  globalspace["cv_custom_mention_UserCVForm_UserInterests_"+id]!="undefined"){
           
             globalspace["cv_custom_mention_UserCVForm_UserInterests_"+id].length=0;
        }
      
        UpdateEducationDropdown(g_Interests,div,category);
    }else if(category=='Achievements'){
        globalspace["RecentupdateSection"].push('achievements');
        g_Achievements = $.grep(g_Achievements, function(value) {
             return value != id;
        });
          $('#UserCVForm_Achievements').val(g_Achievements);
        UpdateEducationDropdown(g_Achievements,div,category);
    }

  $("#"+removediv).remove();

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
globalspace["RecentupdateSection"].push('experience');
    UpdateEducationDropdown(id,div,category);
     Custom.init();
//Custom.clear();

}
function addNewInterest(id,name){
globalspace["userInterests_"+id]=new Array();
     g_Interests.push(id);
      $('#UserCVForm_Interests').val(g_Interests);
      var data="";
      var URL = "/user/AddNewInterest?Id="+id+'&name='+name;
     ajaxRequest(URL,data,function(data){renderNewInterestsPageHandler(data,g_Interests,"In_dropdown",name,id,'Interests')},"html");
}  

function renderNewInterestsPageHandler(html,id,div,name,experienceId,category){

    $("#interests_div").append(html);
globalspace["RecentupdateSection"].push('interests');
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
globalspace["RecentupdateSection"].push('achievements');
UpdateEducationDropdown(id,div,category);
//Custom.clear();

}



function addOneMorePublication(){

     var data="";
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
   globalspace["RecentupdateSection"].push('publication');
   var calenderId="publication_Date_"+g_publication;
   //initializeCalender(calenderId);
   
    initializationAtMentionsForCV("#UserCVForm_PublicationAuthors_"+g_publication);
  $('#PublicationImage_').attr("id", 'PublicationImage_'+g_publication);
   $('#uploadlist_').attr("id", 'uploadlist_'+g_publication);
   initializeFileUploader('PublicationImage_'+g_publication, '/game/UploadGameBannerImage', '10*1024*1024', Publicationextensions,1, 'PublicationImage_'+g_publication ,g_publication,PublicationPreviewImage,displayErrorForPublication,"uploadlist_"+g_publication);
   $('#PublicationPreviewdiv_').attr("id", 'PublicationPreviewdiv_'+g_publication);
   $('#PublicationPreview_').attr("id", 'PublicationPreview_'+g_publication);
Custom.clear();
      g_publication=g_publication+1;
      
    Custom.init();

$("[rel=tooltip]").tooltip();
}  
function removePublication(publicationId){ 
    
    $("#publicationdiv_"+publicationId).remove();
    g_publicationsArray = $.grep(g_publicationsArray, function(value) {
  return value != publicationId;
});
    
    $('#UserCVForm_Publications').val(g_publicationsArray);
globalspace["RecentupdateSection"].push('publication');
$("[rel=tooltip]").tooltip();
} 
  
function bindDataToExperience(id){

   // var divid=
  //  $('#UserCVForm_UserExperience_'+id).val($('#experience_'+id).html());   
    
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
      if(g_Experience[i]!=undefined && g_Experience[i]!='undefined'){
        $('#UserCVForm_UserExperience_'+g_Experience[i]).val($.trim($('#experience_'+g_Experience[i]).html()));
    
      }
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
             //alert( $('#UserCVForm_Publicationfile_'+g_publicationsArray[i]).val());
     }
     
     for (var i = 0; i <=g_Achievements.length; i++) {  
         if(g_Achievements[i]!=undefined && g_Achievements[i]!='undefined')
         $('#UserCVForm_UserAchievements_'+g_Achievements[i]).val($.trim($('#achievements_'+g_Achievements[i]).html())); 
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
            var    current_value= radios[i].value;  
            
           id=id.split('_');
          
            var divId="";
           if(id.length>1){
               divId=id[(id.length)-2];
            }else{
                
           divId=id;  
            }
           
         
                if (current_value == "1"){
                    $('#publication_link_div_'+divId).show();
                      $('#publication_pdf_div_'+divId).hide();
                 } else {
                      $('#publication_pdf_div_'+divId).show();
                      $('#publication_link_div_'+divId).hide();
                 }
            }
        }
    });
        

$('.cvaction').click(function(){
    
 var action = $(this).attr('name');
  if(globalspace["RecentupdateSection"].length < 1){
    
    globalspace["RecentupdateSection"].push(action);
}

});

</script>
