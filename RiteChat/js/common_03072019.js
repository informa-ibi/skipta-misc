// common ajaxRequest function is used in the whole application...
var g_userid = ""; // used in miniprofile popup..
var g_type = ""; // used in miniprofile popup..
var g_postType = ""; //used in social action bar
var g_postId = ""; //used in social action bar
var g_groupId=""; //used in social action bar
var g_profileImage="";//used in profile image upload
var g_profileImageName = "";//used to profile image name
var inviteMentionArray=new Array();
var globalspace = new Object();
var intervalIdNewpost=0;
var intervalIdCurbpost=0;
var g_curbside_categoryID="";
var g_curbside_hashtagID="";
var notificationHistory = 0;
var startLimit=0;
var notificationAjax = false;
var checkNotificationStatus = false;
var postSocialStatsInterval = 0;
var curbSocialStatsInterval = 0;
var Global_ScrollHeight=0;
var gPage="";
var referenceUserId = 0;
var g_divId;
var g_maxFiles = 10*1024*1024;
 var timezoneName = jstz.determine_timezone().name();
  //var timezoneName = "Europe/Vienna";
  //var timezoneName = "EST";
var g_postIds = 0;
/** Please don't delete the below parameters **/
var pF1 = pF2 = pF3 = pF4 = pF5 = 0;
var socialActionIntervalTime,
    postIntervalTime,
    notificationTime;
    var hostName = location.hostname;
    var ObjectA;
    var clientRequestInterval= [];
var remoteAddress;
var jsonObject,use4storiesinsertedid=0,isThereReady = false;

var referralLinkId=0;
var referralUserEmail=0;
var topicPageDisaplay=0;
var leftMenuOriginalHeight =  '';
var s_page=0;
function ajaxRequest(url, queryString,callback,dataType,beforeSendCallback) { 
   
    checkSession();   //alert(isUserSessionValid)
    if(isUserSessionValid=="yes")
    {
    var data = queryString;
    //alert(queryString);
    if(dataType==null || dataType==undefined){
        dataType = "json";
    }
   
    if(typeof(data)=="object"){
        data.timezone = timezoneName;
    }else{
        if($.trim(queryString)==""){
          data = "timezone="+timezoneName;   
        }else{
         data = queryString +"&timezone="+timezoneName; 
        }
    }
 
    $.ajax({
        dataType: dataType,
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function(data) {  
       
             if(dataType == "json"){ 
            try{
                
                if(data != ""){                    
                    if(typeof data.code != "undefined" && data.code == 440){
                        showSessonTimeoutPopup();
                         return;
                    }
                }else{                    
                    return;
                }
                }catch(err){
                  //console.log("ajax request--"+err);
                }  
            }else if(dataType == "html"){ 
                try{
                    var jsonHtmlObj = JSON.parse(data);                        
                    if(jsonHtmlObj.code == 440){ 
                showSessonTimeoutPopup();
                return;
              }  
                    }catch(err){
            }
            }
          
            
            callback(data);
        },
        error: function(data) {     
         // console.log("in error Common method--"+data.toSource());
//alert("in error Common method--"+data.toSource());
        },
         beforeSend: function() {
             if(beforeSendCallback!=null && beforeSendCallback!=undefined){
                   beforeSendCallback();
             }
             
            }
        
    });
}else{
     showSessonTimeoutPopup();
}
}
function  showSessonTimeoutPopup(){
     document.cookie = "r_u" + "=" + location.pathname+";path=/";
     $("#sessionTimeoutLabel").html("Your Session timed out");
     $("#sessionTimeout_body").html("Please login to continue");
     $("#sessionTimeoutModal").modal('show');
     $("#login_btn").live("click",function(){
        window.location="/";
     });
}
function setPageLength(pageLength, pageType) {
    scrollPleaseWait('spinner_admin');
    if (pageType == "usermanagement") {
        g_pageLength = pageLength;
        getUsermanagementDetails(0, $("#searchTextId").val());
    }
    if (pageType == "newCurbsideCategory") {
        g_pageLength = pageLength;
        getCurbsideCategorymanagementDetails(0, $("#searchTextId").val());
    }
    if (pageType == "newHelpDescription") {
        g_pageLength = pageLength;
        getHelpIconListmanagementDetails(0, $("#searchTextId").val());
    }
     if (pageType == "advertisement") {
        g_pageLength = pageLength;
        loadAdvertisementsForAdmin(0,$("#searchTextId").val());
    }else if (pageType == "surveyanalytics") {
        g_pageLength = pageLength;
        getSurveyAnalyticsDetails(0,$("#filterSurvey").val(), $("#searchTextId").val());
    }

}
//author: karteek.v
function getMiniProfile(userid,streamId) {
    scrollPleaseWait('stream_view_spinner_'+streamId);
    var queryString = "userid=" + userid;
    ajaxRequest("/user/getMiniProfile", queryString, function(data){getMiniProfileHandler(data,streamId)})
    
    //ajaxRequest("/user/trackMinMentionWindowOpen",queryString,function(data){});
}
//author: karteek.v
function getMiniProfileHandler(data,streamId) {
    scrollPleaseWaitClose('stream_view_spinner_'+streamId);
    var item = {
        'data': data
       
    };
    $("#myModal_body").html($("#miniProfileTmpl_render").render(item));
    $("#profile_aboutme").html($("#profile_aboutme").text());
    $("#myModalLabel").addClass("stream_title paddingt5lr10");
    $("#myModalLabel").html("Profile summary");
    $("#myModal_footer").hide();
    $("#myModal").modal('show');
    if(!detectDevices()){
      $("[rel=tooltip]").tooltip();
   }
}

/**
 * @author: karteek.v
 * @param {type} userid
 * @param {type} type
 * @returns {object} json
 */
function userFollowUnfollowActions(userid, type,page) {    
    var queryString = "userid=" + userid + "&type=" + type;
    g_userid = userid;
    g_type = type;
   scrollPleaseWait('miniprofile_spinner_modal');
    ajaxRequest("/user/userFollowUnfollowActions", queryString,function(data){userFollowUnfollowActionsHandler(data,page)} )
}
//author: karteek.v
function userFollowUnfollowActionsHandler(data,page) {    
  scrollPleaseWaitClose('miniprofile_spinner_modal');
    var followingCnt = Number($("#followerscntb_" + g_userid).html());
    if (g_type == "follow") {
       
        if(page=='profile'){
             $("#userFollowunfollowa_" + g_userid).attr({
            "onclick": "userFollowUnfollowActions(" + g_userid + ",'unfollow','profile'"+ ")",
            "data-original-title": "Unfollow"
        });
          $("#userFollowunfollowa_" + g_userid).attr({
            "class": "follow p_follow"
        });   
        }else{
             $("#userFollowunfollowa_" + g_userid).attr({
            "onclick": "userFollowUnfollowActions(" + g_userid + ",'unfollow'" + ")",
            "data-original-title": "Unfollow"
        });
         $("#userFollowunfollowa_" + g_userid).attr({
            "class": "followbig p_followbig"
        });    
        }
        

        followingCnt = followingCnt + 1;
        $("#followerscntb_" + g_userid).html(followingCnt);
          $("#userFollowunfollowa_" + g_userid).closest('i').attr("data-original-title","Unfollow");
    } else if (g_type == "unfollow") { 
        
         if(page=='profile'){
             $("#userFollowunfollowa_" + g_userid).attr({
            "onclick": "userFollowUnfollowActions(" + g_userid + ",'follow','profile'"+ ")",
            "data-original-title": "Follow"
        });
              $("#userFollowunfollowa_" + g_userid).attr({
            "class": "unfollow p_unfollow"
        });
         }else{
             $("#userFollowunfollowa_" + g_userid).attr({
            "onclick": "userFollowUnfollowActions(" + g_userid + ",'follow'" + ")",
            "data-original-title": "Follow"
        });
             $("#userFollowunfollowa_" + g_userid).attr({
            "class": "unfollowbig p_unfollowbig"
        }); 
         }
      
        if (followingCnt > 0)
            followingCnt = followingCnt - 1;
        $("#followerscntb_" + g_userid).html(followingCnt);
          $("#userFollowunfollowa_" + g_userid).closest('i').attr("data-original-title","Follow");
    }
}

/**
 * @author karteek.v
 * @param {type} postType
 * @param {type} postId
 * @param {type} userId
 * @param {type} actionType
 * @returns {object} json 
 */
function followOrUnfollowPost(postType, postId,actionType, categoryType,obj) { 
    g_postType = postType;
    g_postId = postId;
    scrollPleaseWait("detailed_followUnfollowSpinLoader_"+g_postId);
    scrollPleaseWait("followUnfollowSpinLoader_"+g_postId);
    var queryString = "postType=" + postType + "&postId=" + postId+"&actionType="+actionType+"&categoryType="+categoryType; 
    ajaxRequest("/post/userFollowPost", queryString, function(data){followOrUnfollowPostHandler(actionType,data,obj)});
}

/**
 * @author karteek.v
 * @param {type} data
 * @returns empty
 */
function followOrUnfollowPostHandler(actionType,data,obj) {  
    scrollPleaseWaitClose("detailed_followUnfollowSpinLoader_"+g_postId);
   scrollPleaseWaitClose("followUnfollowSpinLoader_"+g_postId);
     if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
}
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);

            }
        });
            if(actionType=="Follow"){
                
                 var followCnt = Number(obj.parent('i').parent('a').find('b').text());
                followCnt = Number(followCnt)-1;
                obj.parent('i').parent('a').find('b').text(followCnt);
                
        
           obj.attr({
                    "class": "unfollow",
                    "data-original-title": "Follow"
                });
    }else{
         var followCnt = Number(obj.parent('i').parent('a').find('b').text());
                followCnt = Number(followCnt)+1;
                obj.parent('i').parent('a').find('b').text(followCnt);
                   obj.attr({
                    "class": "follow",
                    "data-original-title": "UnFollow"
                });
    }
      return;
    }

}

/**
 * @author karteek.v
 * @param {type} postType
 * @param {type} postId
 * @param {type} userId
 * @returns {undefined}
 */
function loveToPost(postType, postId, categoryType,streamId,obj){       
    g_postType = postType;
    if(typeof streamId != undefined)
        g_postId = streamId;
    else
        g_postId = postId;
    scrollPleaseWait('stream_view_spinner_'+streamId);
    var queryString = "postType=" + postType + "&postId=" + postId+"&categoryType="+categoryType;
    ajaxRequest("/post/userLoveToPost", queryString, function(data){loveToPostHandler(data,obj)});
    
}
function loveToPostHandler(data,obj){ 
    scrollPleaseWaitClose('stream_view_spinner_'+g_postId);
   // alert(data.toSource());
     if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
}
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);

            }
        });
         obj.attr({
                    "class": "unlikes"
                });
    var loveCnt = Number(obj.parent('i').next('b').text());
                loveCnt--;
               
               
                 obj.parent('i').next('b').text(loveCnt);
      return;
    }
    
   
}

/**
 * @author Sagar Pathapelli
 */
function getHashTagProfile(hashTagName,streamId){
    scrollPleaseWait('stream_view_spinner_'+streamId);
    hashTagName=hashTagName.substr(1);
    var queryString = "hashTagName="+hashTagName;
   
   // ajaxRequest("/post/trackMinHashTagWindowOpen",queryString,function(data){});
   if($("#followGroupInDetail").length>0){
     var groupId =  $("#followGroupInDetail").attr("data-groupid"); 
     if($("#followGroupInDetail").attr("data-subgroupid")!="undefined" && $("#followGroupInDetail").attr("data-subgroupid")!=null){
       groupId =  $("#followGroupInDetail").attr("data-subgroupid");    
     }
     
   }
  
    trackEngagementAction("HashTagMinPopup",hashTagName,'','',groupId);
    ajaxRequest("/post/getHashTagProfile",queryString,function(data){getHashTagProfileHandler(data,streamId);});
}
/**
 * @author Sagar Pathapelli
 */
function getHashTagProfileHandler(data,streamId){
    scrollPleaseWaitClose('stream_view_spinner_'+streamId);
    var item = {
      'data':data  
    };
    $("#myModal_body").html($("#hashTagProfileTmpl_render").render(item));
    $("#myModalLabel").addClass("stream_title paddingt5lr10");
    $("#myModalLabel").html("Hashtag summary");   
    $("#myModal_footer").hide();
    $("#myModal").modal('show');
    $(".hashtagSearchText").click(function(){ //alert('1');
         $(document).bind("click", function(e) { 
            $("#searchbox").addClass("open");
        });
         $("#myModal").modal('hide');
         var hashTagSearchText = $(this).attr('data-name');
       
        $('#SearchTextboxBt').val(hashTagSearchText);
          $("#searchbox").addClass("open");
          scrollPleaseWait("search_spinner","search");
        startProjectSearch();
        var queryString ={"page":"HashTag","action":"HashTagSearch","dataId":hashTagSearchText,"categoryType":"","postType":""};
   ajaxRequest("post/trackEngagementAction",queryString,function(data){});
    }
    );
    if(!detectDevices()){
      $("[rel=tooltip]").tooltip();
   } 
}
/**
 * @author Sagar Pathapelli
 */
function followUnfollowHashTag(hashTagId){
    scrollPleaseWait('hashtag_spinner');
    var actionType = $('#hashTagFollowUnFollowImg').attr("data-action");
    var queryString = "hashTagId="+hashTagId+"&actionType="+actionType;
    ajaxRequest("/post/followOrUnfollowHashTag",queryString,followUnfollowHashTagHandler)
}
/**
 * @author Sagar Pathapelli
 */
function followUnfollowHashTagHandler(json){
    scrollPleaseWaitClose('hashtag_spinner');
    if(json.status=="success"){
        var hashCount = Number($("#hashtagfollowersCount").text());  
        if($('#hashTagFollowUnFollowImg').attr("class")=="unfollowbig"){
           $('#hashTagFollowUnFollowImg').attr("class","followbig" ).attr("data-action","unfollow");
           $('#hashTagFollowUnFollowImg').attr("data-original-title","Unfollow");                    
           $("#hashtagfollowersCount").text(++hashCount);
        }else{
            $('#hashTagFollowUnFollowImg').attr("class","unfollowbig" ).attr("data-action","follow");
            $('#hashTagFollowUnFollowImg').attr("data-original-title","Follow");
            $("#hashtagfollowersCount").text(--hashCount);
        }
    }
}

/*
 * replaceString() is used to check for @mention not available in follower/following users list and replace the @mention with errored atmention
 * @author Sagar
 */
function replaceString(strVal, search,displaymention, type){
    var count=0;
    var index=strVal.indexOf(search);
    while(index!=-1){
        count++;
        var charBeforeString = strVal.substr(index-3,3);
        if(charBeforeString!='<b>' || index==0){
            strVal = strVal.substr(0, index) + '<span class="atmention_error dd-tags" contenteditable="false"><span style="position:relative;" onmouseover="getNetworkUsers(this,\''+displaymention+'\',\''+type+'\')"><b>'+search+'</b></span><i style="color:#B94A48" onclick="removeAtMentionError(this)">X</i></span>' + strVal.substr(index+search.length);
        }
        index=strVal.indexOf(search,index+1);
        
    }
    return strVal;
}

function validateAtMentions(editorData){
    var isValidate=false;
    var atmentionErrorCount = editorData.clone().find("span.atmention_error").length;
    var mentionString = editorData.clone().find("span").remove().end().html();
    if(mentionString.indexOf("@")>=0){
        var myString = mentionString.substr(mentionString.indexOf("@")+ 1);           
        var type = 'at_mention_'+editorData.attr('id');
        var myArray = myString.split('@');
        for(var i=0;i<myArray.length;i++){
            var atMentionData = "";
            if(myArray[i].indexOf(' ')>=0){
                atMentionData = myArray[i].substr(0, myArray[i].indexOf(' ')); 
                if(atMentionData.indexOf('<')>0){
                    atMentionData = atMentionData.substr(0, atMentionData.indexOf('<')); 
                }
                var resultString = replaceString(editorData.html(), '@'+atMentionData,atMentionData, type);
                editorData.html(resultString); 
            }else{
                if(myArray[i].indexOf('<')>0){
                    atMentionData = myArray[i].substr(0, myArray[i].indexOf('<')); 
                }else{
                    atMentionData = myArray[i];//alert(atMentionData);
                }
                var resultString = replaceString(editorData.html(), '@'+atMentionData,atMentionData, type);
                editorData.html(resultString); 
            }

        }
    }else if(atmentionErrorCount>0){
        isValidate=false;
    }else{
        isValidate=true;
    }
    return isValidate;
}
/*
 * getNetworkUsers() is used to get the users list from current network by searchKey
 * It will be called when mouse over the errored atmention and display the matched user list with the searchkey
 * @author Sagar
 */
function getNetworkUsers(obj, displaymention, type){
    var searchKey = $(obj).find('b').text();
    var data = {searchKey:searchKey.substr(1),existingUsers:JSON.stringify(globalspace[type])};
   
    var URL = '/post/getnetworkusers';
  ajaxRequest(URL,data,function(data){getNetworkUsersHandler(data,obj,displaymention,type)});

}
function getNetworkUsersHandler(data,obj,displaymention,type){ 
              var ulString=" <ul class='dropdown-menu atwho-view-ul' style='display:block;position:relative;z-index: 9999'>";
            var i=0;
            $.each(data, function( index, dataobj ) {i++;
                var DisplayText=displaymention==false?dataobj.DisplayName:"@"+dataobj.DisplayName;
                ulString+="<li class='cur' data-user-id='"+dataobj.UserId+"'><a href='javascript:replaceAtMentionErrors("+dataobj.UserId+",\""+DisplayText+"\",\""+type+"\");removeErrorMessage(\"NormalPostForm_Description\");'>"+dataobj.DisplayName+"  <img width='40' height='40' src='"+dataobj.ProfilePicture+"'></a></li>";
            });
            ulString+="</ul>";
            if(i>0){
                $('.atmention_popup').html(ulString);
                var position = $(obj).offset();
                $('.atmention_popup').css('left',position.left);
                $('.atmention_popup').css('top',position.top+$(obj).height());
                $('.atmention_popup').show();
                $(obj).addClass('mouse_over_atmention_popup');
                $(document).mouseup(function (e)
                {
                    var container = $(".atmention_popup");
                    if (!container.is(e.target) // if the target of the click isn't the container...
                        && container.has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        container.hide();
                        $(obj).removeClass('mouse_over_atmention_popup');
                    }
                });
            }  
}

/*
 * displayErrorMessage() is used to display the error message
 * It will be called in validating the post (or) if any error will get on posting
 * @author Sagar
 */
function displayErrorMessage(key,val){
    $("#"+key+"_em_").text(val);                                                   
    $("#"+key+"_em_").show(); 
    $("#"+key+"_em_").fadeOut(7000);
    $("#"+key).parent().addClass('error');
}
function displayError(key,val){
    $("#"+key).text(val);                                                   
    $("#"+key).show(); 
    $("#"+key).fadeOut(7000);
   // $("#"+key).parent().addClass('error');
}
/*
 * removeErrorMessage() is used to remove the error message
 * It will be called after success of posting
 * @author Sagar
 */
function removeErrorMessage(key){
    $("#"+key+"_em_").text("");
    $("#"+key).parent().removeClass('error');
    $("#"+key+"_em_").hide();
}    
/*
 * replaceAtMentionErrors() is used to replace the atmention error span
 * It will be called after selecting on item of over data
 * @author Sagar
 */
function replaceAtMentionErrors(UserId, DisplayText, type){
    var atmention = '<span contenteditable="false" class="atwho-view-flag atwho-view-flag-@"><span data-user-id="'+UserId+'" class="at_mention dd-tags"><b>'+DisplayText+'</b><i onclick="removeAtMention(this,\''+type+'\')">X</i></span><span contenteditable="false">&nbsp;<span></span></span></span>';
    var divId = $(".mouse_over_atmention_popup").closest("div.inputor").attr('id');
    $('#'+divId).focus();
    $(".mouse_over_atmention_popup").closest("span.atmention_error").replaceWith(atmention);
    $(".atmention_popup").hide();
    globalspace[type].push(Number(UserId));
}

function removeHashTag(obj, type){
    $(obj).closest("span.atwho-view-flag").remove();
    var hashtag = $(obj).closest("span.atwho-view-flag").find("span.hashtag>b").text();
    array_pop(globalspace[type], hashtag.substr(1));
} 
function removeAtMentionError(obj){
    $(obj).closest("span.atmention_error").remove();
} 
/*
* This function loads in stream page document ready state
* @author Sagar
*/
function initializationForHashtagsAtMentions(inputor){
    var inputorId = $(inputor).attr('id');
    if(!globalspace['hashtag_'+inputorId]){
        globalspace['hashtag_'+inputorId]=new Array();
        
    }
    if(!globalspace['at_mention_'+inputorId]){
        globalspace['at_mention_'+inputorId]=new Array();
    }
    /*
    * at_mention_config is used to initialize the atmentions
    * @author Sagar
    */
      var at_mention_config = {
           at: "@",
           callbacks: {
                 remote_filter: function (query, callback) {
                     if(typeof globalspace['at_mention_'+inputorId] == 'undefined'){
                        globalspace['at_mention_'+inputorId]=new Array();
                     }
        var data = {searchkey:query,existingUsers:JSON.stringify(globalspace['at_mention_'+inputorId])};
         ajaxRequest("/post/getuserfollowingandfollowers",data,callback);
                  
                 },
                 before_insert: function(value, $li){
                     globalspace['at_mention_'+inputorId].push(Number($(value).attr('data-user-id')));
                    return value;
                 }
             },
           tpl:"<li data-value='@${DisplayName}'><div class='d_name'>${DisplayName}</div> <i class='d_n_border'><img src='${profile45x45}'  /></i></li>",      
           insert_tpl: "<span class='at_mention dd-tags' data-user-id=${UserId}><b>@${DisplayName}</b><i onclick='removeAtMention(this,"+'"'+"at_mention_"+inputorId+'"'+")'>X</i></span>",
           search_key: "DisplayName",
           show_the_at: true,
           limit: 50
       }
      
   /*
    * hashtag_config is used to initialize the hashtags
    * @author Sagar
    */
   var hashtag_config = {
        at: "#", 
        callbacks: {
              remote_filter: function (query, callback) {
                  if(typeof globalspace['hashtag_'+inputorId] == 'undefined'){
                    globalspace['hashtag_'+inputorId]=new Array();
                 }
        var data = {searchkey:query,existingHashtags:JSON.stringify(globalspace['hashtag_'+inputorId])};
        ajaxRequest("/post/gethashtagsbysearchkey",data,callback);
                  
              },
                before_insert: function(value, $li){
                    globalspace['hashtag_'+inputorId].push(($(value).find("b").text()).substr(1));
                   return value;
                }
          },
        tpl: '<li data-value="#${HashTagName}">#${HashTagName}</li>',
        insert_tpl: "<span class=\"dd-tags hashtag\"><b>#${HashTagName}</b><i onclick='removeHashTag(this,"+'"'+"hashtag_"+inputorId+'"'+")'>X</i></span>",
        search_key: "HashTagName",
	limit: 50
    }
    $(inputor).atwho(at_mention_config).atwho(hashtag_config);
}

function getHashTags(editorObject){
    var editorClone = editorObject.clone();
    $(editorClone).find('span.dd-tags i').remove();
    var hashtagString = $(editorClone).find("span.dd-tags i").remove().end().text(); 
    return hashtagString;
}

function clearerrormessage(obj)
{    
    
$('#'+obj.id).siblings('div').fadeOut(2000);
$('#'+obj.id).parent('div').addClass('success');
$('#'+obj.id).parent('div').removeClass('error');

}

function getAtMentions(editorObject){
    var editorClone = editorObject.clone();
    $(editorClone).find('span.dd-tags i').remove();
    var atMentions = "";
    editorObject.children().find("span.at_mention" ).each(function() {
        atMentions+=","+$( this ).attr('data-user-id');
    });    
    return atMentions;
}

function getEditorText(editorObject){
    findAndReplaceHashtagsNotInSystem(editorObject);
    var parent = editorObject.clone();
    $(parent).find('span.dd-tags i').remove();
    $(parent).find('#eventdetails').remove();
    var comment=$(parent).html(); 
    return comment;
}

function getAtMentionErrorMessage(editorObject){
    var atmentionError = editorObject.clone().find("span.atmention_error b");
    var errorMentions="";

    $.each(atmentionError, function(key, err){
        errorMentions = errorMentions+","+$(err).text();
    });
    errorMentions=errorMentions.substr(1);
    var errorMessageText="";
    if(atmentionError.length==1){
        errorMessageText=errorMentions+" is unknown user in the system.";
    }else{
        errorMessageText=errorMentions+" are unknown user's in the system.";
    }
    return errorMessageText;
}

/**
 * @author Sagar
 */
function attendEvent(postId,actionType,categoryType, streamId) {
    scrollPleaseWait('stream_view_spinner_'+streamId);
    var queryString = "postId=" + postId+"&actionType="+actionType+"&categoryType="+categoryType;
    ajaxRequest("/post/attendEvent", queryString, function(data){attendEventHandler(data, streamId)});
   trackEngagementAction("EventAttend",postId,categoryType);
}
/**
 * @author Sagar
 */
function attendEventHandler(data,streamId) {
    scrollPleaseWaitClose('stream_view_spinner_'+streamId);
    if(data.status=="success"){
        $("#eventAttendDetailed").hide();
        $('div#postitem_'+streamId+' button.eventAttend').hide();
    }

}
function bindGroupsForStream(){  
    
        $(".stream_content img.follow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"UnFollow");
             groupsFollowing();
             
             $("#groupId_"+groupId).remove()
             applyLayout();
            // getCollectionData('/group/getJoinMoreGroups', 'GroupCollection', 'MoreGroupsDiv', 'No groups found','No more groups');
           $(this).attr({
               "class":"unfollow" 
            });
        }
    );
    $(".stream_content img.unfollow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"Follow");
             groupsFollowing();
             //getCollectionData('/group/getJoinMoreGroups', 'GroupCollection', 'MoreGroupsDiv', 'No groups found','No more groups');
            $(this).attr({
               "class":"follow" 
            });
        }
    );   
     $(".streamMainDiv img.follow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"UnFollow");
           $(this).attr({
               "class":"unfollow" 
            });
        }
    );
    $("#streamMainDiv img.unfollow").live( "click", 
        function(){
            var groupId = $(this).closest('div.social_bar').attr('data-groupid');
            followOrUnfollowGroup(groupId,"Follow");
            $(this).attr({
               "class":"follow" 
            });
        }
    );
   }

/**
 * @author Praneeth
 * @param {type} groupId
 * @param {type} userId
 * @param {type} actionType
 * @returns {object} json 
 */
function followOrUnfollowGroup(groupId,actionType,obj,countObj) {
    g_groupId = groupId;
     scrollPleaseWait("groupfollowSpinLoader");
    var queryString = "groupId=" + groupId+"&actionType="+actionType;   
    ajaxRequest("/group/userFollowGroup", queryString, function(data){followOrUnfollowGroupHandler(data,actionType,obj,countObj)});
}

/**
 * @author Praneeth
 * @param {type} data
 * @returns empty
 */
function followOrUnfollowGroupHandler(data,actionType,obj,countObj) {
    scrollPleaseWaitClose("groupfollowSpinLoader");
      if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
        }
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);
   
}
        });
           if(actionType=="Follow"){
          var groupFollowersCount = Number(countObj.text());
                    groupFollowersCount--;
                   countObj.text(groupFollowersCount);
    obj.attr({
                    "class": "unfollow",
                   // "title": "Unfollow"
                   "data-original-title": "Follow"
                });
    }else{
         var groupFollowersCount = Number(countObj.text());
                    groupFollowersCount++;
                   countObj.text(groupFollowersCount);
                   obj.attr({
                    "class": "follow",
                    "data-original-title": "UnFollow"
                });
    }
      return;
    }
    if(data.status=="success"){
        if($('#GroupAdminMenu').length>0){
            if(actionType=="Follow"){               
                if(data.IsGroupAdmin==1){
                 $('#GroupAdminMenu').show();    
                }
                
            }else{
                $('#GroupAdminMenu').hide();
            }
        }
    }
//    if(actionType=="Follow"){
//          var groupFollowersCount = Number(countObj.text());
//                    groupFollowersCount++;
//                   countObj.text(groupFollowersCount);
//    obj.attr({
//                    "class": "follow",
//                   // "title": "Unfollow"
//                   "data-original-title": "Unfollow"
//                });
//    }else{
//         var groupFollowersCount = Number(countObj.text());
//                    groupFollowersCount--;
//                   countObj.text(groupFollowersCount);
//                   obj.attr({
//                    "class": "unfollow",
//                    "data-original-title": "Follow"
//                });
//    }
}

/**
* @author Sagar
*/
function initializeAtMentions(inputor, PostId, CategoryType){
    /*
    * at_mention_config is used to initialize the atmentions
    * @author Sagar
    */

    var inputorId = $(inputor).attr('id');
    globalspace['invite_at_mention_'+inputorId]=new Array();
    
      var invite_at_mention_config = {
           at: "@",
           callbacks: {
                 remote_filter: function (query, callback) {//alert('called');
                     scrollPleaseWait('stream_view_spinner_'+PostId);
                     if(typeof globalspace['invite_at_mention_'+inputorId] == 'undefined'){
                        globalspace['invite_at_mention_'+inputorId]=new Array();
                     }

          var data = {searchkey:query,existingUsers:JSON.stringify(globalspace['invite_at_mention_'+inputorId]),postId:PostId,categoryType:CategoryType};
        ajaxRequest("/post/getuserfollowingandfollowersforinvite",data,function(data){
            scrollPleaseWaitClose('stream_view_spinner_'+PostId);
             callback(data);
        });     
                 

                 },
                 before_insert: function(value, $li){
                     var InvitedUserId = Number($li.attr('data-user-id'));
                     globalspace['invite_at_mention_'+inputorId].push(InvitedUserId);
                     $('#'+inputorId+'_currentMentions').append("<span class='at_mention dd-tags dd-tags-close' data-user-id="+InvitedUserId+"><b>"+$li.attr('data-value')+"</b><i onclick='deleteInvitedAtMention(this, \"invite_at_mention_"+inputorId+"\", "+InvitedUserId+")'>X</i></span>")
                     $('#'+inputorId).val('');
                     return "";
                 },
                 matcher: function(flag, subtex) {
                    flag = '@';
                    subtex = flag+$.trim(subtex);
                    var match, regexp;
                    flag = flag.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                    
                    regexp = new RegExp(flag + '([A-Za-z0-9_\+\-]*)$|' + flag + '([^\\x00-\\xff]*)$', 'gi');
                    match = regexp.exec(subtex);
                    if (match) {
                      return match[1].length>=3?match[1]:null;
                    } else {
                      return null;
                    }
                  }
             },
           tpl:"<li data-value='${DisplayName}' data-user-id=${UserId}><div class='d_name'>${DisplayName}</div> <i class='d_n_border'><img src='${profile45x45}'   /></i></li>",      
           //insert_tpl: "<span class='at_mention dd-tags' data-user-id=${UserId}><b>${DisplayName}</b><i onclick='removeAtMention(this,"+'"'+"invite_at_mention_"+inputorId+'"'+")'>X</i></span>",
           search_key: "DisplayName",
           show_the_at: true,
           limit: 50
       }
    $(inputor).atwho(invite_at_mention_config);
}

function getAtMentionUsers(editorObject){
    var atmentions = editorObject.clone().find("span.at_mention b");
    var mentionString="";
    $.each(atmentions, function(key, err){
        mentionString = mentionString+","+$(err).text();
    });
    mentionString=mentionString.substr(1);
    var mentions = new Array();
    mentions[0] = atmentions.length;
    mentions[1] = mentionString;
    return mentions;
}

function array_pop(arr,elm){
    var index = $.inArray(elm,arr);
    if (index > -1) {
        arr.splice(index, 1);
    }
    return arr;
}
function removeMention(obj, type){
    var id = $(obj).closest("span.atwho-view-flag").find("span.at_mention").attr('data-user-id');
    array_pop(inviteMentionArray, id);
    $(obj).closest("span.atwho-view-flag").remove();
}

function drawSurveyChart(divId, OptionOneCount, OptionTwoCount, OptionThreeCount, OptionFourCount, height, width,optionDExist) {
    var dataTable = new google.visualization.DataTable();
    dataTable.addColumn('string', 'Options');
    dataTable.addColumn('number', 'Options');
    // A column for custom tooltip content
    dataTable.addColumn({type: 'number', role: 'tooltip'});
    var totalSurveyCount = OptionOneCount + OptionTwoCount + OptionThreeCount + OptionFourCount;    
    if(optionDExist != -1){
        dataTable.addRows([
            ['A', parseInt((OptionOneCount / totalSurveyCount) * 100), OptionOneCount],
            ['B', parseInt((OptionTwoCount / totalSurveyCount) * 100), OptionTwoCount],
            ['C', parseInt((OptionThreeCount / totalSurveyCount) * 100), OptionThreeCount],
            ['D', parseInt((OptionFourCount / totalSurveyCount) * 100), OptionFourCount]
        ]);
    }else{
        dataTable.addRows([
            ['A', parseInt((OptionOneCount / totalSurveyCount) * 100), OptionOneCount],
            ['B', parseInt((OptionTwoCount / totalSurveyCount) * 100), OptionTwoCount],
            ['C', parseInt((OptionThreeCount / totalSurveyCount) * 100), OptionThreeCount]            
        ]);
    }

    var options = {
        height: height, width: width, legend: 'none',
        vAxis: {minValue: 0, maxValue: 100, format: "#'%'"}
    };
    scrollPleaseWaitClose('stream_view_spinner');
    var chart = new google.visualization.ColumnChart(document.getElementById(divId));
    chart.draw(dataTable, options);

}

 function menuactive (obj){

        $(".sidebar-nav ul li ").removeClass('active');
        $("#"+obj.id).addClass('active');

        
    }
    function loadGroupDetailPage(groupId){
    var queryString = "groupId=" + groupId;
    ajaxRequest("/group/userFollowGroup", queryString, loadGroupDetailPageHandler);
}
function loadGroupDetailPageHandler(){
    
}

function bindGroupsFollowUnFollow(pageId){      
     $("#followGroupInDetail img.followbig").live( "click",
        function(){ 
            var content="If you unfollow Group all the subgroups under this Group will be unfollowed.";
            var groupId = $(this).closest('span.noborder').attr('data-groupid');        
            var param ={groupId:groupId,type:"UnFollow",obj:this};
            openModelBox("error_modal", "Group", content, "NO", "Yes", followOrUnfollowGroupFromDetail, param);
          
        }
    );
   $("#followGroupInDetail img.unfollowbig").live( "click",
        function(){            
            var groupId = $(this).closest('span.noborder').attr('data-groupid');
            var category = $(this).closest('span.noborder').attr('data-category');
            followOrUnfollowGroup(groupId,"Follow");
            $("#GroupFollowers").attr("onclick","getUserFollowers('"+groupId+"','"+category+"');");
            $("#GroupImages").attr("onclick","getGroupImagesAndVideos('"+groupId+"','"+category+"');");
             $("#GroupDocs").attr("onclick","getGetGroupDocs('"+groupId+"','"+category+"');");
            $("#conversations").attr("onclick","loadGroupConversations('"+groupId+"','"+category+"');");           
            $("#groupFormDiv").show();
            $("#groupstreamMainDiv").show();
            $('#groupFollowersCount').html(Number($('#groupFollowersCount').text())+1)
             $("#UPF").show('');
                $(this).attr('data-original-title','Unfollow');
            $(this).attr({
               "class":"followbig"
            });
        }
    );
   }

/**
 * Description: To show the spinner before data in loaded
 * @author Praneeth
 * @returns shows spinner
 */
function scrollPleaseWait(spinnerId, divId){
    var loaderScript = '<div id="loader_'+spinnerId+'" style="z-index: 99999; left:0;right:0; text-align: center; top: 0;bottom:0; position: absolute;display: none" ><div id="cl_spiral_'+spinnerId+'" class="loader" ><div id="SpinLoader"><img src="/images/icons/loading_spinner.gif"></div></div></div>';
    $("#"+spinnerId).html(loaderScript);
    $("#loader_"+spinnerId).show();
    setSpinnerPosition(spinnerId, divId);
}
/**
 * Description: To hide the spinner after data in loaded
 * @author Praneeth
 * @returns hides spinner
 */
function scrollPleaseWaitClose(spinnerId){
    $("#loader_"+spinnerId).hide();
}

/**
 * Description: To set the position of the spinner
 * @author Praneeth
 * @returns position of spinner
 */
function setSpinnerPosition(spinnerId, divId){
     var formHeight = $("#"+divId).height();
     var spinnerHeight = $("#canvasLoader_"+spinnerId).height();
     var totalHeight = $("#"+divId).height()+$("#canvasLoader_"+spinnerId).height();
     var spinnerPos=totalHeight/2;
     $("#cl_spiral_"+spinnerId).css("padding-top", spinnerPos-spinnerHeight);
}

//author: surehs reddy

function getMiniCurbsideCategoryProfile(categoryId,streamId) {
    scrollPleaseWait('curbside_spinner_'+streamId);
    var queryString = "categoryId=" + categoryId;
    ajaxRequest("/curbsidePost/getCurbsideMiniProfile", queryString, function(data){getMiniCurbsideCategoryProfileHandler(data,categoryId,streamId);})
}
//author suresh reddy
function getMiniCurbsideCategoryProfileHandler(data,categoryId,streamId) {
    scrollPleaseWaitClose('curbside_spinner_'+streamId);
    var item = {
        'data': data
    };
    $("#myModal_body").html($("#miniCurbsideCategoryProfileTmpl_render").render(item));
    $("#myModalLabel").addClass("stream_title paddingt5lr10");
    $("#myModalLabel").html(consultname + " Category Summary");
    $("#myModal_footer").hide();
    $("#myModal").modal('show');
     $(".CurbsideCategorySearch").click(function(){ //alert('1');
         $(document).bind("click", function(e) { 
            $("#searchbox").addClass("open");
        });
         $("#myModal").modal('hide');
         var CurbsidecategorySearchText = $(this).attr('data-name');
       
        $('#SearchTextboxBt').val(CurbsidecategorySearchText);
          $("#searchbox").addClass("open");
          scrollPleaseWait("search_spinner","search");
        startProjectSearch();
        var queryString ={"page":"Curbsidecategory","action":"Curbsidecategory","dataId":CurbsidecategorySearchText,"categoryType":"","postType":""};
   ajaxRequest("post/trackEngagementAction",queryString,function(data){});
    }
    );
    if(!detectDevices()){
      $("[rel=tooltip]").tooltip();
   }
}

/**
 * @author suresh
 * @param {type} CategoryId
 * @param {type} action Tpe
 * @returns {object} json 
 */
function followUnfollowCategory(categoryId,actionType) {
    //g_groupId = groupId;    
    scrollPleaseWait('miniCurbsideCategory_spinner_modal');
     var actionType = $('#curbsideCategoryIdFollowUnFollowImg').attr("data-action");
    var queryString = "categoryId=" + categoryId+"&actionType="+actionType;
    ajaxRequest("/curbsidePost/followOrUnfollowCurbsideCategory", queryString, followUnfollowCategoryHandler);
}

function followUnfollowCategoryHandler(data) {    
    scrollPleaseWaitClose('miniCurbsideCategory_spinner_modal');
        if (data.status == "success") {
            var hashCount = Number($("#curbsidecategoryFollowresCount").text());
            if ($('#curbsideCategoryIdFollowUnFollowImg').attr("class") == "unfollowbig") {
                $('#curbsideCategoryIdFollowUnFollowImg').attr("class", "followbig").attr("data-action", "unfollow");
                $('#curbsideCategoryIdFollowUnFollowImg').attr("data-original-title", "Unfollow")
                $("#curbsidecategoryFollowresCount").text(++hashCount);
            } else {
                $('#curbsideCategoryIdFollowUnFollowImg').attr("class", "unfollowbig").attr("data-action", "follow");
                $('#curbsideCategoryIdFollowUnFollowImg').attr("data-original-title", "Follow")
                $("#curbsidecategoryFollowresCount").text(--hashCount);
            }
        }
    }
var page=1;
var isDuringAjax=false;
function getInfiniteScrollLoader(divId){
    return '<div id="'+divId+'_loading" class="infscr-loading" style="display: none;"><img src="/images/icons/loading_spinner.gif" ></div>';
} 
/**
 * @author Sagar Pathapelli
 * @param {type} URL
 * @param {type} CollectionName
 * @param {type} MainDiv
 * @param {type} NoDataMessage
 * @param {type} NoMoreDataMessage
 * @returns 
 */

function getCollectionData(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id){
    if(typeof globalspace.previousStreamIds == "undefined" || page==1){
        globalspace.previousStreamIds = "";
    }
    var newURL = URL+"?"+CollectionName+"_page="+page; 
    var data = {previousStreamIds:globalspace.previousStreamIds};
    ajaxRequest(newURL,data,function(data){getCollectionDataHandler(data,URL,CollectionName,MainDiv,NoDataMessage,NoMoreDataMessage,id)},"html");
}
function getCollectionDataHandler(html,URL,CollectionName,MainDiv,NoDataMessage,NoMoreDataMessage,id){
           scrollPleaseWaitClose('spinner_admin');
           scrollPleaseWaitClose('categories_spinner');
            scrollPleaseWaitClose('postSpinLoader');
            scrollPleaseWaitClose("groupfollowSpinLoader");   
            var dataArray = html.split('[[{{BREAK}}]]');
            html = dataArray[0];
            globalspace.previousStreamIds = dataArray[1];
            
            if(MainDiv == "surveyDashboardWall"){
                $('#surveyDashboardWallDiv,#dashboardtop').show();
                $("#surveyChart1,#surveyChart2,#surveyChart3").hide();
                 applyLayout();
            }
            if(html==0){//No data found
                
                 $("#"+MainDiv).addClass('NPF');
                 $("#"+MainDiv).html('<center class="ndm">'+NoDataMessage+'</center>');
                 if(!detectDevices()){  
                    $("[rel=tooltip]").tooltip();
                }
                 $("#"+MainDiv).css("height",'');
            }
            else if(html==-1){//No more data                
                if(MainDiv=="ProfileInteractionDiv"){
                    $("#"+MainDiv).append(getInfiniteScrollLoader(MainDiv));
                    applyLayout();
                    initializeScrolling(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id);
                }
                 if(MainDiv=="ProfileInteractionDivContent"){
                    $("#"+MainDiv).append(getInfiniteScrollLoader(MainDiv));
                    applyLayoutContent();                      
                     initializeScrolling(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id);
                }
                 if(MainDiv=="ProfileInteractionDiv"){
                     if($('#ProfileInteractionDiv li').length<=0){
                        $("#"+MainDiv).html('<div class="NPF"><center class="ndm">'+NoDataMessage+'</center></div>');
                     }else{
                        $("#"+MainDiv+"_loading").html(NoMoreDataMessage);
                        $("#"+MainDiv+"_loading").fadeOut(2000);
                     }
                 } 
                 if(MainDiv=="jobsListIndex")
                 {
                      if($('#jobsListIndex li').length<=0){
                        $("#"+MainDiv).html('<div class="NPF"><center class="ndm">'+NoDataMessage+'</center></div>');
                     }else{
                        $("#"+MainDiv+"_loading").html(NoMoreDataMessage);
                        $("#"+MainDiv+"_loading").fadeOut(2000);
                     }
                 }
                 else{
                        $("#"+MainDiv+"_loading").html(NoMoreDataMessage);
                        $("#"+MainDiv+"_loading").fadeOut(2000);
                     }

                
                if(!detectDevices()){  
                    $("[rel=tooltip]").tooltip();
                }
            }
            else
            { 
                
                 if(isDuringAjax==false){
                    $("#"+MainDiv).removeClass('NPF');
                    $("#"+MainDiv).append(getInfiniteScrollLoader(MainDiv));
                    if(MainDiv=='MoreGroupsDiv' || MainDiv=="ProfileInteractionDiv"){
                      applyLayout();  
                    }
                    if(MainDiv=='ProfileInteractionDivContent'){
                      applyLayoutContent();  
                    }
                    initializeScrolling(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id);
                }else{
                    if(MainDiv!="UPFS"){
                     isDuringAjax=false;    
                    }
                    
                    $("#"+MainDiv+"_loading").hide();
                }
                   page++; 
                   try{
                    var status = true;
                    var sessionstatus = JSON.parse(html);
                    if(typeof sessionstatus.code != "undefined" && sessionstatus.code == 440){
                        status = false;
                    }
                    }catch(err){
                       ;
                    }                    
                    if(status == true)
                        $("#"+MainDiv).append(html);
                   
                   if(MainDiv=='MoreGroupsDiv' || MainDiv=="ProfileInteractionDiv" || MainDiv=="newsDiv" ||  MainDiv=="gameprofilebox" ||  MainDiv=="jobsListIndex" || MainDiv=="diseaseTopicsbox" || MainDiv=="WebLinkWD" ){
                      applyLayout();  
                    }
                   if(MainDiv=='ProfileInteractionDivContent'){
                      applyLayoutContent(); 
                    $('span.seemore,span.postdetail').each(function(){
                        $(this).html('');
                        $(this).removeAttr('onclick class');
                        editorialCoverageC=$(this).parent('.cust_content').html();
                        editorialCoverageC=editorialCoverageC+'<a data-placement="bottom" rel="tooltip"  data-original-title="show more" class="showmoreC" data-id="'+$(this).parent('.cust_content').data('id')+'">...</a>';
                        $(this).parent('.cust_content').html(editorialCoverageC);
                    });
                     }
                    if(MainDiv=='streamMainDiv')
                    {
                        $('span.seemore,span.postdetail').each(function(){
                        if($(this).parent().data('news')=='yes')
                        {
                            var ref = $(this).closest("li.media").find('a.NOBJ');
                            $(this).html('');
                            $(this).removeAttr('onclick class');
                            editorialCoverageC= $(this).parent().html();
                            editorialCoverageC=editorialCoverageC+"<span class='NDESC' data-postid='"+ref.data("postid")+"' data-categoryType='"+ref.data("categorytype")+"' data-postType='"+ref.data("posttype")+"' data-id='"+ref.data("id")+"' data-original-title='See More' rel='tooltip' data-placement='bottom' class='seemore tooltiplink'> <i class='fa fa-ellipsis-h moreicon moreiconcolor'></i></span>";
                            $(this).parent().html(editorialCoverageC);
                        }
                    });
                    }
                  $("div.item").fadeIn(500);
                  if(!detectDevices()){  
                    $("[rel=tooltip]").tooltip();
                }
            }
            
/** Please don't delete the below code **/            
        jsonObject = getJsonObjectForNode();
        
        if(typeof io !== "undefined"){
            if(MainDiv=='streamMainDiv'){       
                 socketPost.emit('clientRequest', g_postIds, g_postDT,pF1,jsonObject);
                 socketPost.emit('getNewPostsRequest', g_postDT, loginUserId,userTypeId,postAsNetwork,jsonObject);    

             }else if(MainDiv=='curbsidePostsDiv'){
                 socketCurbside.emit('clientRequest4CurbsidePosts', g_postIds,jsonObject);
                 socketCurbside.emit('getNewCurbsidePostsRequest', g_postDT, loginUserId,userTypeId,jsonObject);

             }else if(MainDiv == "groupstreamMainDiv"){              
                 socketGroup.emit('clientRequest4GroupPost', g_postIds, jsonObject);
                 socketGroup.emit('GetNewGroupPostsRequest', g_postDT, loginUserId, userTypeId,gType,groupId,jsonObject);
             }else if(MainDiv == "ProfileInteractionDivContent"){
                 socketNewsPost.emit('clientRequest4news', g_postIds,jsonObject);
             }else if(MainDiv == "gameprofilebox"){
                 socket4Game.emit('clientRequest4Game', g_postIds,jsonObject);
             }
             var badgeObj = {userId:loginUserId,isMobile:0};
              socketNotifications.emit('getBadgesUnlocked', badgeObj,jsonObject);
         }
         

}
/**
 * @author Sagar Pathapelli
 * @param {type} URL
 * @param {type} CollectionName
 * @param {type} MainDiv
 * @param {type} NoDataMessage
 * @param {type} NoMoreDataMessage
 * @returns {undefined}
 */
function initializeScrolling(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id){

    $(window).bind("scroll", function()
  
    {
        if($(window).scrollTop() >= $(document).height() - $(window).height()-20)
        {
            if(!isDuringAjax)
            {
                isDuringAjax=true;
                $("#"+MainDiv+"_loading").show();
             
                getCollectionData(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id);
                if(URL=="/post/stream"){
                      trackEngagementAction("Scroll"); 
                }
                else if(URL == "/curbsidePost/getcurbsideposts"){
                      trackEngagementAction("Scroll"); 
                }
                else if(URL == "/group/groupStream"){
                                 
                   trackEngagementAction("Scroll",id); 
                }else if(URL == "/group/getJoinMoreGroups"){
                     trackEngagementAction("Scroll"); 
                }else if(URL == "/user/getprofileintractions"){
                     trackEngagementAction("Scroll",id); 
                }else if(URL=="/game/loadGameWall"){
                    trackEngagementAction("Scroll"); 
                }
            }
        }
    });
}


function getUserFollowers(groupId,category){    
     scrollPleaseWait("groupfollowSpinLoader");
     $('#UPF').html("").show();
     Global_ScrollHeight=$('#UPF').offset().top;
     $("html,body").scrollTop(Global_ScrollHeight);
     $(".poststreamwidget,#groupstreamMainDiv,#groupPostDetailedDiv").hide();
     $(".followersprofile").live( "click", 
        function(){                
            var userId = $(this).attr('data-id');
            getMiniProfile(userId,userId);
        });
      $('#groupSideBar').hide();
        page=1;
        isDuringAjax=false;
        $(window).unbind("scroll");
        if(category=='Group'){
            $('#createSubGroup').hide();
      }
     getCollectionData('/group/getGroupFollowers', 'groupId='+groupId+'&category='+category+'&GroupCollection', 'UPF', 'No data found','No more users');
 
      
}
function getUserFollowersHandler(data){
 
}

 /**
 * @author Sagar Pathapelli
 * @param {type} divId 
 * @param {type} URL
 * @param {type} sizeLimit
 * @param {type} extensions
 * @param {type} previewImage (this is the callback method after completing the image upload)
 * @param {type} postId  (postId='' for posts and should give the PostId for comments)
 * @returns 
 */
function initializeFileUploader(divId, URL, sizeLimit, extensions,maxFiles, postType, postId,callback,errorcallback,listE,multiple){
   multiple = (typeof multiple == 'undefined')?true:false;
  
    new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element:document.getElementById(divId),
        action: URL,
        sizeLimit:30* 1024 * 1024,// maximum file size in bytes
        allowedExtensions:JSON.parse("[" + extensions + "]"),        
        debug: false,
        multiple: multiple,
        maxConnections: maxFiles,
        listElement:document.getElementById(listE),
        // events         
        // you can return false to abort submit
        onSubmit: function(id, fileName){ if($.browser.msie){    scrollPleaseWait("ArtifactSpinLoader_"+divId, postId);$("#appendlist").hide();}g_postId = postId; g_divId = divId; g_maxFiles = maxFiles; g_postType = postType; },
        onProgress: function(id, fileName, loaded, total){   //scrollPleaseWait("ArtifactSpinLoader_"+divId, postId);
},
        onComplete: function(id, fileName, responseJSON){
            //$("#p_bar").attr("style","width:0%");
           // $("#progress_stripped").hide();
               if(responseJSON['success']==true){
                   
            var type=postId==''?postType:postType+'_'+postId;
            callback(id, fileName, responseJSON, type);
            
        }else if(responseJSON['success']!=false){
            errorcallback("File is too large, max file upload size is 10M.", postType, postId);            
        }
            scrollPleaseWaitClose("ArtifactSpinLoader_"+divId);
        },
        onCancel: function(id, fileName){},
        messages: {          
             typeError: "{file} has invalid extension.",
                    sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
                    minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
                    maxFileSizeError: "you can upload maximum of {maxFileSizeLimit} files",
                    emptyError: "{file} is empty, please select files again without it.",
                    onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
        },
        showMessage: function(message){ 
            errorcallback(message, postType, postId);
             scrollPleaseWaitClose("ArtifactSpinLoader_"+divId);
        
        }
     });  
}
/**
 * @author Sagar Pathapelli
 * @param {type} file
 * @param {type} response
 * @param {type} responseJSON
 * @param {type} postType
 * @returns {undefined}
 */
function previewImage(file, response, responseJSON, postType){
   $('#preview_'+postType).show();
    $('#previewul_'+postType).show();
    if(typeof globalspace[postType+"_UploadedFiles"] == 'undefined'){
        globalspace[postType+"_UploadedFiles"]=new Array();
        globalspace[postType+"_Artifacts"]=new Array();
    }
    $(".bar").each(function(key,value){        
//        if($(this).attr("style") == "width:100%"){
//            $(this).closest('li.qq-upload-success').hide();
//            
//        }
    })
    if(globalspace[postType+"_UploadedFiles"].length < 4){
        
          if($.inArray(response,globalspace[postType+"_Artifacts"]) < 0){ // doesn't exist
          
            //$('.qq-upload-list').hide(); 
           var data=responseJSON;
           var filetype=responseJSON['extension'];
           var imageid=responseJSON['savedfilename'];
           var image="";
           image = getImageIconByType(filetype);
           if(image==""){
                image=responseJSON['filepath'];
           }
           globalspace[postType+"_UploadedFiles"].push(responseJSON['filename']);
           globalspace[postType+"_Artifacts"].push(responseJSON['filename']);
           $('#previewul_'+postType).append('<li class="alert" ><i  id="'+imageid+'" ontouchstart="closeimages(this,'+"'"+responseJSON['savedfilename']+"'"+","+"'"+responseJSON['fileremovedpath']+"'"+","+"'"+responseJSON['filename']+"'"+","+"'"+postType+"'"+');"  onclick="closeimages(this,'+"'"+responseJSON['savedfilename']+"'"+","+"'"+responseJSON['fileremovedpath']+"'"+","+"'"+responseJSON['filename']+"'"+","+"'"+postType+"'"+');"  class="fa fa-times-circle deleteicon mobiledeleteicon "  data-dismiss="alert" ></i><i style="display:none" class="fa fa-search-plus zoomicon" ></i><a  class="postimgclose mobilepostimgclose "   href=""> </a>\n\
                <img src="'+image+'"></li>');
       }
        else { // does exist
             var message=response+ " Already uploaded please upload another file";
             displayFileErrorMessage(postType, message);
        }
    }else{
         var message=" already you have uploaded 4 files uploaded file size limit is 4";
         displayFileErrorMessage(postType, message);
     }
 }
 /*
 * This method is used for remove the  uploaded artifact.
 */
 function closeimages(obj,filename,filepath,image, type){
     var file=filepath;
     var queryString = "image="+image+"&file="+image+"&filepath="+file;
     ajaxRequest("/post/removeartifacts", queryString, function(data){removeArtifactHandler(data, type);}); 
 }
 function removeArtifactHandler(data, type){
    if(data.status=='success'){
      var filename=data.file;      
      var vindex = $.inArray(data.filename,globalspace[type+"_UploadedFiles"]);
        if(vindex != -1) {
                globalspace[type+"_UploadedFiles"].splice(vindex, 1);
        }
        var vindex = $.inArray(data.image,globalspace[type+"_Artifacts"]);
        if(vindex != -1) {
                globalspace[type+"_Artifacts"].splice(vindex, 1);
        }
    }
}
/**
 * @author Sagar Pathapelli
 * @param {type} filetype
 * @returns {String}
 */
function getImageIconByType(filetype) {
    var image="";
    if (filetype == 'ppt'||filetype=='pptx') {
        image = "/images/system/PPT-File-icon.png";
    } else if (filetype == 'pdf') {
        image = "/images/system/pdf.png";
    }  else if (filetype == 'mp3') {
        image = "/images/system/audio_img.png";
    } else if (filetype == 'mp4' || filetype == 'flv' || filetype == 'mov') {
        image = "/images/system/video_img.png";
    } else if (filetype == 'doc' || filetype == 'docx') {
        image = "/images/system/MS-Word-2-icon.png";
    } else if (filetype == 'txt') {
        image = "/images/system/notepad-icon.png";
    } else if (filetype == 'exe' || filetype == 'xls' || filetype == 'ini' || filetype == 'xlsx') {
        image = "/images/system/Excel-icon.png";
    } 
    return image;
}
function displayFileErrorMessage(postType, message){
    $('#'+postType+'_Artifacts_em_').show();
    $('#'+postType+'_Artifacts_em_').css("padding-top:20px;");
    $('#'+postType+'_Artifacts_em_').html(message);
    $('#'+postType+'_Artifacts_em_').fadeOut(4000);
}

function clearFileUpload(type){
    if(typeof globalspace[type+"_UploadedFiles"] != 'undefined'){
        if ((globalspace[type+"_UploadedFiles"]).length > 0) {
            globalspace[type+"_UploadedFiles"] = new Array();
        }
    }
    if(typeof globalspace[type+"_Artifacts"] != 'undefined'){
        if ((globalspace[type+"_Artifacts"]).length > 0) {
            globalspace[type+"_Artifacts"] = new Array();
        }
    }    
}

$(".helpmanagement").live("click", function() {
    var helpIconId = $(this).attr('data-id');
    var queryString = "helpIconId=" + helpIconId;
    ajaxRequest("/user/getHelpDescription", queryString, getHelpDescriptionHandler);
}
);

function getHelpDescriptionHandler(data) {
    var item = {
        'data': data.data
    };
    
    if (data.data.Status == 1)
    {
        $("#myModal_body").html("<code>"+data.data.Description+"</code>");        
        $("#myModalLabel").addClass("stream_title paddingt5lr10");
        $("#myModalLabel").html(data.data.Name);
        $("#myModal_footer").hide();
        $("#myModal_body").append("<div class='playerH'/>");
        data.data.VideoPath=$.trim(data.data.VideoPath);
        if (data.data.VideoPath != null && data.data.VideoPath != ''){
             var options = '';
             loadDocumentViewer('playerH', data.data.VideoPath, options,"",360,550);
          }
          $("#myModal").modal('show');
            
        
       
    }
}
function blockOrReleaseCallback(param){
    var paramArray = param.split(',');
    var postId = paramArray[0];
    var categoryType = paramArray[1];
    var networkId = paramArray[2];
    var actionType = paramArray[3];
    var isBlockedPost = paramArray[4];
    blockOrReleasePost(postId, actionType, categoryType, networkId, isBlockedPost);
}
function blockOrReleasePost(postId, actionType, categoryType, networkId, isBlockedPost){
    var queryString = "postId="+postId+"&actionType="+actionType+"&categoryType="+categoryType+"&networkId="+networkId+"&isBlockedPost="+isBlockedPost;
    ajaxRequest("/post/abusePost",queryString,function(data){blockOrReleasePostHandler(data,postId, isBlockedPost);});
}
function abusePost(streamId, postId, actionType, categoryType, networkId){
    var queryString = "postId="+postId+"&actionType="+actionType+"&categoryType="+categoryType+"&networkId="+networkId;
    ajaxRequest("/post/abusePost",queryString,function(data){abusePostHandler(data,streamId);});
}
function suspendGame(streamId, postId, actionType, categoryType, networkId){
    var queryString = "postId="+postId+"&actionType="+actionType+"&categoryType="+categoryType+"&networkId="+networkId;
    ajaxRequest("/game/suspendGame",queryString,function(data){suspendGameHandler(data,streamId);});
}

function cancelScheduleGame(streamId, postId, actionType, categoryType, scheduleId){
    var queryString = "postId="+postId+"&actionType="+actionType+"&categoryType="+categoryType+"&scheduleId="+scheduleId;
    ajaxRequest("/game/cancelSchedule",queryString,function(data){cancelScheduleGameHandler(data,scheduleId);});
}


function blockOrReleasePostHandler(json, id, isBlockedPost){
    if(json.status=="success"){
        closeModelBox();
        $("#postitem_"+id).animate({
        opacity: 0,
        }, 1500, function() {
            $("#postitem_"+id).remove();
            
            $('#postsDisplayDiv').removeClass('NPF');
            
            if($('#postsDisplayDiv div.post.item').length<=0){
                $('#postsDisplayDiv').addClass('NPF');
                $('#postsDisplayDiv').html('<center>No posts found</center>');
            }
            if(Number(isBlockedPost)==1){
                abusedTagCloud();
            }
        });
    }
}
function abusePostHandler(json, id){
    if(json.status=="success"){
        closeModelBox();
        $("#postitem_"+id).animate({
        opacity: 0,
        }, 1500, function() {
            $("#postitem_"+id).remove();
        });
    }
}
function suspendGameHandler(json, id){
    if(json.status=="success"){
        closeModelBox();
        $("#postitem_"+id).animate({
        opacity: 0,
        }, 1500, function() {
            $("#postitem_"+id).remove();
            applyLayout();
        });
    }
}
function cancelScheduleGameHandler(json, id){
    if(json.status=="success"){
        closeModelBox();
      $("#scheduleId_"+id).remove();
    }
}
function promotePost(streamId, postId, promoteDate, categoryType, networkId){
    var queryString = "streamId="+streamId+"&postId="+postId+"&promoteDate="+promoteDate+"&categoryType="+categoryType+"&networkId="+networkId;
    ajaxRequest("/post/promotePost",queryString,function(data){promotePostHandler(data, streamId);});
}

function promotePostHandler(json, streamId){
    if(json.status=="success"){
        closeModelBox();        
        $('#postitem_'+streamId).addClass('promoted');
        //$('#postitem_'+streamId+' ul.PostManagementActions li a.promote').parent().remove()
    }
}
function deletePost(streamId, postId, categoryType, networkId){
    var queryString = "postId="+postId+"&categoryType="+categoryType+"&networkId="+networkId;
    ajaxRequest("/post/deletePost",queryString,function(data){deletePostHandler(data,streamId);})
}

function deletePostHandler(json,streamId){
    if(json.status=="success"){
        closeModelBox();
        $("#postitem_"+streamId).animate({
        opacity: 0,
        }, 1500, function() {
            $("#postitem_"+streamId).remove();
        });
    }
}
/**
 * @author Sagar Pathapelli
 * @param {type} modelType
 * @param {type} title
 * @param {type} content
 * @param {type} closeButtonText
 * @param {type} okButtonText
 * @param {type} okCallback
 * @param {type} param (info_modal / alert_modal / error_modal)
 * @returns {undefined}
 */
function openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param){ 
    $("#newModal .modal-dialog").removeClass('info_modal');
    $("#newModal .modal-dialog").removeClass('alert_modal');
    $("#newModal .modal-dialog").removeClass('error_modal');
    $("#newModal .modal-dialog").addClass(modelType);
    $("#newModalLabel").html(title);
    $("#newModal_body").html(content);
    $("#newModal_footer").show();
    $("#newModal_btn_close").html(closeButtonText);
    $("#newModal_btn_primary").show();
   if(okButtonText=='Nodisplay'){
        $("#newModal_btn_primary").html(okButtonText);
        $("#newModal_btn_primary").hide();
   } else{
        $("#newModal_btn_primary").html(okButtonText);
   }
   
    $("#newModal").modal('show');
    $("#newModal_btn_primary").removeAttr("disabled");
    $("#newModal_btn_primary").removeClass("disabled");
    if(typeof okCallback != 'undefined' && okCallback!=""){
        $("#newModal_btn_primary").unbind("click");
        $("#newModal_btn_primary").bind("click", function(){
            if(param instanceof Object){
                //
            }else{
                var paramArray = param.split(","); 
                 if(title == "Delete"){
             
                  trackEngagementAction("PostDelete",paramArray[1],paramArray[2]);
                  
            }
            else if(title == "Promote"){
                 trackEngagementAction("PostPromote",paramArray[1],paramArray[2]);
            }
            else if(title == "Flag as abuse"){
                 trackEngagementAction("PostFlagAbuse",paramArray[1],paramArray[2]);
            }
            else if(title == "Post Featured Item"){
                 trackEngagementAction("PostFeatured",paramArray[1],paramArray[2]);
            }    
            }
              
           
           
            okCallback(param);
        });
    }
}
function closeModelBox(){ 
    $("#newModal").modal('hide');
}
function getGroupImagesAndVideos(groupId,category){
    $('.followersprofile').die('click');
    //scrollPleaseWait("groupfollowSpinLoader");
   Global_ScrollHeight=$('#UPF').offset().top;
      $("html,body").scrollTop(Global_ScrollHeight);
      $("#UPF").html('');
       $(".poststreamwidget,#groupstreamMainDiv,#groupPostDetailedDiv").hide();
      //$(".poststreamwidget").hide();
      $("#UPF").show();
      $('#groupSideBar').hide();
      page=1;
      isDuringAjax=false;
     $(window).unbind("scroll");
     if(category=='Group'){
            $('#createSubGroup').hide();
      }
     getCollectionData('/group/GetGroupImages', 'groupId='+groupId+'&category='+category+'&ResourceCollection', 'UPF', 'No data found','No More Data');
}
 function getGetGroupDocs(groupId,category){
      $('.followersprofile').die('click');
      //scrollPleaseWait("groupfollowSpinLoader");
       Global_ScrollHeight=$('#UPF').offset().top;
      $("html,body").scrollTop(Global_ScrollHeight);
      $("#UPF").html('');
       $(".poststreamwidget,#groupstreamMainDiv,#groupPostDetailedDiv").hide();
      $("#UPF").show();
      $(".poststreamwidget").hide();
      $('#groupSideBar').hide();
      page=1;
      isDuringAjax=false;
      $(window).unbind("scroll");
      if(category=='Group'){
            $('#createSubGroup').hide();
      }
     getCollectionData('/group/GetGroupDocs', 'groupId='+groupId+'&category='+category+'&ResourceCollection', 'UPF', 'No data found','No More Data');
 

}
function openOverlay(url,image,div,height,width,atStart){ 
    if(height == undefined || height == "" || height == 0){
        height = 230;
    }
    if(width == undefined || width == "" || width == 0){
        width = 230;
    }
    jwplayer(div).setup({
        file:url,
        image:image,
        width:width,
        height:height,  
        aspectratio:'16:9',
        autostart:atStart
    });
}

$(window).scroll(function () {
/*  if($.isArray(navigator.userAgent)){
    if ($(this).scrollTop() > 260 && ($.inArray("iPhone",navigator.userAgent) == -1 && $.inArray("iPad",navigator.userAgent) == -1 && $.inArray("Blackberry",navigator.userAgent) == -1 && $.inArray("Android",navigator.userAgent) == -1) ) {
    $('#menu_bar').addClass("fixed");
    } else {
    $('#menu_bar').removeClass("fixed");
   }
   }
*/
       if ($(this).scrollTop() > 260) {
            leftMenuOriginalHeight = Number(leftMenuOriginalHeight)<800?800:leftMenuOriginalHeight;
            $('#menu_bar').addClass("fixed");
            var windowHeight = $(window.top).height();
           // alert(leftMenuOriginalHeight+"==="+windowHeight);
            var footerHeight = Number($("#footer").height());
            var visibleContentHeight = windowHeight - footerHeight;
            var leftMenuTop = leftMenuOriginalHeight - visibleContentHeight+20;
            $('#menu_bar').css("top","-"+leftMenuTop+"px");
        }
        else{
            $('#menu_bar').removeAttr("style");
            $('#menu_bar').removeClass("fixed");
        }
});
function appendErrorMessages(message, formId ,id){
    if(typeof id != 'undefined' && id!=""){
        id="_"+id;
    }
    $('#'+formId+id+'_Artifacts_em_').show();
    $('#'+formId+id+'_Artifacts_em_').css("padding-top:20px;");
    $('#'+formId+id+'_Artifacts_em_').html(message).fadeOut(3000);
}

function removeAtMention(obj, type){
    if($(obj).closest("span.atwho-view-flag").parent().is("span")){
        $(obj).closest("span.atwho-view-flag").unwrap();
    }
    $(obj).closest("span.atwho-view-flag").remove();
    var id = $(obj).closest("span.atwho-view-flag").find("span.at_mention").attr('data-user-id');
    array_pop(globalspace[type], Number(id));
}

function findAndReplaceHashtagsNotInSystem(editorData){
    var isValidate=false;
    var mentionString = editorData.clone().find("span").remove().end().html();
    if(mentionString.indexOf("#")>=0){
        var myString = mentionString.substr(mentionString.indexOf("#")+ 1);           
        var type = 'hashtag_'+editorData.attr('id');
        var myArray = myString.split('#');
        for(var i=0;i<myArray.length;i++){
            if(myArray[i].length>1){
                var hashtagData = "";
                if(myArray[i].indexOf(' ')>=0){
                    hashtagData = myArray[i].substr(0, myArray[i].indexOf(' ')); 
                    hashtagData = $.trim(hashtagData);
                    if(hashtagData.length >1){
                      
                        if(hashtagData.indexOf('<')>0){
                            hashtagData = hashtagData.substr(0, hashtagData.indexOf('<')); 
                        }
                       var resultString = replaceHashtagString(editorData.html(), '#'+hashtagData,hashtagData, type);
                    editorData.html(resultString);  
                    }
                   
                    
                }else{
                    if(myArray[i].indexOf('<')>0){
                        hashtagData = myArray[i].substr(0, myArray[i].indexOf('<')); 
                    }else{
                        hashtagData = myArray[i];//alert(hashtagData);
                    }
                    var resultString = replaceHashtagString(editorData.html(), '#'+hashtagData,hashtagData, type);
                    editorData.html(resultString); 
                }
            }
       // }
        }
    }
    return isValidate;
}
/*
 * @author Sagar
 */
function replaceHashtagString(strVal, search,displayhashtag, type){
    var count=0;
    var index=strVal.indexOf(search);
    while(index!=-1){
        count++;
        var charBeforeString = strVal.substr(index-3,3);
        if(charBeforeString!='<b>' || index==0){
            strVal = strVal.substr(0, index) + '<span contenteditable="false" class="atwho-view-flag atwho-view-flag-#"><span class="dd-tags hashtag"><b>#'+displayhashtag+'</b><i onclick="removeHashTag(this,\'hashtag_editable\')">X</i></span><span contenteditable="false">&nbsp;<span></span></span></span>' + strVal.substr(index+search.length);
        }
        index=strVal.indexOf(search,index+1);
    }
    return strVal;
}



function editProfileFirstNameDetails() { 
    $("#editProfileFirstName").show();
    $("#updateAndCancelFirstNameIconUploadButtons").show();
    $("#editProfileFirstNameDescriptionText").show();  
    $("#profileFirstName").hide();
}
function closeEditProfileFirstNameDescription(){
    
    $('body, html').animate({scrollTop : 0}, 0);
    //$("#editProfileFirstNameDescriptionText").html(''); 
    $("#editProfileFirstName").hide();
    $("#updateAndCancelFirstNameIconUploadButtons").hide();
    $("#editProfileFirstNameDescriptionText").html($("#profileFirstName").text()).show();  
    $("#profileFirstName").show();
}
function closeEditProfileLastNameDescription(){
    //$("#editProfileLastNameDescriptionText").html('');
    $("#editProfileLastName").hide();
    $("#updateAndCancelLastNameIconUploadButtons").hide();
    $("#editProfileLastNameDescriptionText").hide(); 
    $("#profileLastName").show();
}
function closeEditProfileAboutMeDescription()
{
    $("#editProfileAboutMe").hide();
    $("#closeEditGroupDescription").hide();
    $("#editProfileAboutMeDescriptionText").hide();  
    $("#updateAndCancelAboutMeUploadButtons1").css("display","none"); 
    $("#profile_AboutMe").show();
}
   

function editProfileLastNameDetails() {    
    $("#editProfileLastName").show();
    $("#updateAndCancelLastNameIconUploadButtons").show();
    $("#editProfileLastNameDescriptionText").html($("#profileLastName").text()).show();  
    $("#profileLastName").hide();
}
function saveEditProfileFirstName(userId,valueType) {
      
    var profileFirstName = $.trim($("#editProfileFirstNameDescriptionText").text());
   
    if (profileFirstName != '') {
        if (!profileFirstName.match(/^[a-zA-Z_-]+$/) && profileFirstName!="")
               {
                   
                $('#ProfileUpdateError').html("Invalid characters in First Name.");
                $("#ProfileUpdateError").css("display", "block");
                $("#ProfileUpdateError").fadeOut(5000);
               }
        else {
            var queryString = "profileFirstName=" + profileFirstName + "&UserId=" + userId + "&type=" + valueType;
            ajaxRequest("/user/editprofilenamedetails", queryString, editProfileFirstNameDetailsHandler);
        }
    }

    else
    {
        $('#ProfileUpdateError').html("First name cannot be blank");
        $("#ProfileUpdateError").css("display", "block");
        $("#ProfileUpdateError").fadeOut(5000);
    }
    
}
function saveEditProfileLastName(userId,valueType) {
      
    var profileLastName = $.trim($("#editProfileLastNameDescriptionText").html());      
    if(profileLastName != '' && profileLastName != 0)
    {    
         if (!profileLastName.match(/^[a-zA-Z_-]+$/) && profileLastName!="")
               {
                   
                $('#ProfileUpdateError').html("Invalid characters in Last Name.");
                $("#ProfileUpdateError").css("display", "block");
                $("#ProfileUpdateError").fadeOut(5000);
               }
               else
               {
                 var queryString ="&profileLastName=" + profileLastName+ "&UserId=" + userId+"&type="+valueType;
                 ajaxRequest("/user/editprofilenamedetails", queryString, editProfileLastNameDetailsHandler);  
               }
        
    }
    else
    {
            $('#ProfileUpdateError').html("Last name cannot be blank");
            $("#ProfileUpdateError").css("display", "block");
            $("#ProfileUpdateError").fadeOut(5000);
    }
    
}
function editProfileFirstNameDetailsHandler()
    {
        $("#profileFirstName").html($("#editProfileFirstNameDescriptionText").html());   
    $("#editProfileFirstName").hide();
    $("#updateAndCancelFirstNameIconUploadButtons").hide();
    $("#editProfileFirstNameDescriptionText").hide(); 
    $("#profileFirstName").show();
        }
function editProfileLastNameDetailsHandler()
    {
    $("#profileLastName").html($("#editProfileLastNameDescriptionText").html());   
    $("#editProfileLastName").hide();
    $("#updateAndCancelLastNameIconUploadButtons").hide();
    $("#editProfileLastNameDescriptionText").hide(); 
    $("#profileLastName").show();

        }
        

    
    function editProfileAboutMeDetails() {    
    $("#editProfileAboutMe").show();
    $("#closeEditGroupDescription").show();
    $("#editProfileAboutMeDescriptionText").show();  
    $('#editProfileAboutMeDescriptionText').focus();
    $("#updateAndCancelAboutMeUploadButtons1").show();  
    $("#profile_AboutMe").hide();    
}

function saveEditProfileAboutMe(userId,valueType) {
      
    var profileAboutMe =$("#editProfileAboutMeDescriptionText").val();    
    var queryString = "profileAboutMe=" + profileAboutMe + "&UserId=" + userId+"&type="+valueType;
    ajaxRequest("/user/editprofileaboutmedetails", queryString, editProfileAboutMeDetailsHandler);
}

function editProfileAboutMeDetailsHandler()
        {   
     $("#profile_AboutMe").html($("#editProfileAboutMeDescriptionText").val()); 
     var descLength=$.trim($("#editProfileAboutMeDescriptionText").val()).length;
     if(descLength>200){
         var decToShow=$("#editProfileAboutMeDescriptionText").val().substring(0, 200);
        $("#profile_AboutMe").html(decToShow); 
        $("#displayTotalAboutMe").show();
     }
      if(descLength!=0){
      $('#profile_AboutMe').removeClass('Descriptionplaceholder');
     }else{
      $('#profile_AboutMe').addClass('Descriptionplaceholder');   
     }
     $("#editProfileAboutMe").hide();
     $("#closeEditGroupDescription").hide();
     $("#editProfileAboutMeDescriptionText").hide();
     $("#updateAndCancelAboutMeUploadButtons1").hide();
     $("#profile_AboutMe").show();
        }
        
     
function ProfilePreviewImage(id, fileName, responseJSON, type)
{
    var data = eval(responseJSON);     
    g_profileImageName = data.savedfilename;
    g_profileImage = '/upload/profile/' + data.savedfilename;
    $('#updateAndCancelProfileImageUploadButtons').show();
    $('#profileImagePreviewId').val('/upload/profile/' + data.savedfilename);
    $('#profileImagePreviewDisplay').val('/upload/profile/' + data.savedfilename);
    $('#profileImagePreviewDisplay').attr('src', g_profileImage);
    
    $('#profileImagePreviewId').attr('src', g_profileImage);
    $('#previewDiv').show();

}
function cancelProfileImageUpload(oldImage,type){
    
  
     $('#profileImagePreviewId').val(oldImage); 
     $('#profileImagePreviewId').attr('src',oldImage);  
     $('#updateAndCancelProfileImageUploadButtons').hide();
     $('#profileImagePreviewDisplay').attr('src', '');
         $('#previewDiv').hide();
     bindMouseEvents();
      g_profileImage='';
     
}

function saveUserProfileImage(userId, type){
    var queryString='';
    
       queryString = "profileImage=" + g_profileImage +"&profileImageName="+g_profileImageName+ "&UserId=" + userId+"&type="+type;   
    ajaxRequest("/user/saveProfileImage", queryString, saveProfileImageHandler);
    
}

function saveProfileImageHandler(responseJSON){
    var data = eval(responseJSON);
    var imageSrc70 = data.imagePath70+data.imageName;
    var imageSrc250 = data.imagePath250+data.imageName;
        $('#updateAndCancelProfileImageUploadButtons').hide();
        $('#profileImagePreviewId').attr('src',imageSrc250);
        $("#profileImage_header").attr('src',imageSrc70);
        $("#businessProfileImage").attr('src',imageSrc70);
        $('#profileImagePreviewDisplay').attr('src', '');
         $('#previewDiv').hide();
        g_profileImage='';
}



    function  viewProfileDetails()
    {
        $('#viewPersonalInfoId').show();
        $("#editableProfileDiv").hide();
        $("#profileViewDiv").show();
        
    }
        function editInformation()
    {
        $("#editableProfileDiv").show();
        $("#profileViewDiv").hide();
        globalspace.inlineEdit = true;
        $('#editableProfileDiv input.textfield').on('blur', function(event){
            globalspace.currentDiv = $(event.target).attr('id');
                $('#editProfileSave').click();
        });
    }
    $("#CancelEdit").unbind( "click");
    $("#CancelEdit").bind( "click", 
        function(){            
            $("#editButtonId").show();
            //var userId = $(this).attr('data-id');
            viewProfileDetails();
        }
    );
    
function bindEditForProfile(){
    $("#CancelEdit").unbind( "click");
     $("#CancelEdit").bind( "click", 
        function(){       
             $('body, html').animate({scrollTop : 0}, 0);
            //var userId = $(this).attr('data-id');
            viewProfileDetails();
        }
    );
   $("#profile_AboutMe").unbind( "click");
     $("#profile_AboutMe").bind( "click", 
        function(){      
            //var userId = $(this).attr('data-id');
            editProfileAboutMeDetails();
        }
    );
    $(".editProfileLastName").unbind( "click");
    $(".editProfileLastName").bind( "click", 
        function(){            
            //var userId = $(this).attr('data-id');
            editProfileLastNameDetails();
        }
    );
    $(".editProfileFirstName").unbind( "click");
    $(".editProfileFirstName").bind( "click", 
        function(){            
            //var userId = $(this).attr('data-id');
            editProfileFirstNameDetails();
        }
    );
    
       $(".editProfileSpeciality").unbind( "click");
    $(".editProfileSpeciality").bind( "click", 
        function(){   
            //var userId = $(this).attr('data-id');
            editPersonalInformationDiv('Speciality');
        }
    );
     $(".editProfilePosition").unbind( "click");
    $(".editProfilePosition").bind( "click", 
        function(){
            editPersonalInformationDiv('Position');
        }
    );
     $(".editProfileCompany").unbind( "click");
    $(".editProfileCompany").bind( "click", 
        function(){    
            editPersonalInformationDiv('Company');
        }
    );
     $(".editProfileDisplayName").unbind( "click");
    $(".editProfileDisplayName").bind( "click", 
        function(){    
            editPersonalInformationDiv('DisplayName');
        }
    );
}

function profileErrorMessage(){

           $('#ProfileUpdateError').html("Cannot be blank");
            $("#ProfileUpdateError").css("display", "block");
            $("#ProfileUpdateError").fadeOut(5000);

    }
    
/*
 * to redirect to profile page when a user click on Name in miniprofile popup
 * author: Praneeth
 */    
$("div.profilesummary div.profileDetails,a.profileDetails").live( "click", 
        function(){            
            var displayName = $(this).attr('data-name');
            window.location.href ="/profile/"+displayName;
        }
 );
 
 /*
 * to redirect to group page when a user click on rightside widget in group activity
 * author: Praneeth
 */ 
// $(".rightWidgetGroupDetailPage").live( "click", 
//        function(){            
//             window.location.href = '/group/index';
//        }
// );
 
   $("div[name=GroupDetailInRightWidget]").live( "click", function(){
            var groupName=$(this).attr('data-name');           
            window.location="/"+groupName;
          // loadGroupDetailPage($(this).attr('data-id'));
        } );
 $('.d_img_outer_video_play').live( "click",function(){     
     $('#showoriginalpicture').hide();
     $("#showoriginalpicture").removeAttr("src");
     var uri = $(this).find('>img').data('uri');
     var id = 'player';
     var videoImage = $(this).find('>img').attr('src');
     var options = {height:400,
        width:500,
        autoplay:true,
        callback:function(){
            //alert('document loaded');
    }
    };
     loadDocumentViewer(id, uri, options,videoImage,400,500);
     $("#myModal_old").modal('show');
 });
 $('.disablecomment').live( "click", 
        function(){        
             if($('.idisablecomments').val()==0)
             {
             $('.idisablecomments').val(1);
             $(this).removeClass('disablecomments').addClass('enablecomments');
             $(this).attr('data-original-title','Enable Comments');
         }else{
             $('.idisablecomments').val(0);
             $(this).removeClass('enablecomments').addClass('disablecomments');
             $(this).attr('data-original-title','Disable Comments');
         }
        }
 );
 
  $('.isdfeatured').live( "click", 
        function(){ 
             if($('.iisfeatured').val()==0)
             {
             $('.iisfeatured').val(1);
             $(this).removeClass('featureditemdisable').addClass('featureditemenable');
            $(this).attr('data-original-title','Remove Featured');
         }else{
             $('.iisfeatured').val(0);
             $(this).removeClass('featureditemenable').addClass('featureditemdisable');
             $(this).attr('data-original-title','Mark as Featured');
         }
        }
 );
 
 /**
  * @author Karteek V
  * This method is used to get user stream settings
  * @returns html
  */
 function getUserSettings() {
    var URL = "/user/getUserStreamSettings?UserId=" + loginUserId;
    var data = "";
   ajaxRequest(URL,data,getUserSettingsHandler,"html");
}
function getUserSettingsHandler(html){             
            $("#settings").html(html).show();
            $("#renderNotification,#scrollDiv").hide();
            $("#notification_settings").text("Notifications");
}
function saveSettings() {
    var settingIds = 0;
    $("input[name='settings']:checked").each(function() {
        if (settingIds == 0) {
            settingIds = $(this).val();
        } else {
            settingIds = settingIds + "," + $(this).val();
        }
    });
    scrollPleaseWait("streamSettingsLoader");
    var queryString = "UserId=" + loginUserId + "&settingIds=" + settingIds;
    ajaxRequest("/user/saveStreamSettings", queryString, saveSettingsHandler);
}
function saveSettingsHandler(data) {
    scrollPleaseWaitClose("streamSettingsLoader");
    if (data.status == "success") {
        $("#streamSettingsMessage").show();
        $("#streamSettingsMessage").html("Settings updated successfully").removeClass().addClass("alert alert-success").fadeOut(4000, "");
    }else{
     $("#streamSettingsMessage").show();
        $("#streamSettingsMessage").html("Settings not saved").removeClass().addClass("alert alert-error").fadeOut(4000, "");
    }
}
/**
 * @author Karteek V
 * @returns {undefined}
 */
function getAllNotificationByUserId(type){    
    if(type == undefined){
        socketNotifications.emit('getUnreadNotifications', loginUserId,"");
    }else{
        socketNotifications.emit("getAllNotificationByUserId",loginUserId,startLimit);
    }
    
    
}


/**
 * @author suresh
 * @param {type} CategoryId
 * @param {type} action Tpe
 * @returns {object} json 
 */
function followUnfollowCategoryStream(categoryId,actionType,obj,countObj) {
    scrollPleaseWait('stream_view_spinner');
    var queryString = "categoryId=" + categoryId+"&actionType="+actionType;
   // alert("followUnfollowCategoryStream");
    ajaxRequest("/curbsidePost/followOrUnfollowCurbsideCategory", queryString, function(data){followUnfollowStreamCategoryHandler(data,obj,countObj,actionType)});
}

function followUnfollowStreamCategoryHandler(data,obj,countObj,actionType) {
        scrollPleaseWaitClose('stream_view_spinner');
         if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
    }
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);
    
            }
        });
          if(actionType=="Follow"){
          var curbsideFollowersCount = Number(countObj.text());
                    curbsideFollowersCount--;
                   countObj.text(curbsideFollowersCount);
    obj.attr({
                    "class": "unfollow",
                   // "title": "Unfollow"
                   "data-original-title": "Follow"
                });
    }else{
         var curbsideFollowersCount = Number(countObj.text());
                    curbsideFollowersCount++;
                   countObj.text(curbsideFollowersCount);
                   obj.attr({
                    "class": "follow",
                    "data-original-title": "UnFollow"
                });
    }
      return;
    }
       
    }
    
    
    /**
 * @author Sagar Pathapelli
 */
function followUnfollowHashTagStream(hashTagId,actionType,obj,countObj){
    var queryString = "hashTagId="+hashTagId+"&actionType="+actionType;
    //alert('hash');
    ajaxRequest("/post/followOrUnfollowHashTag",queryString,function(data){followUnfollowHashTagHandlerStream(data,obj,actionType,countObj)})
}
/**
 * @author Sagar Pathapelli
 */
function followUnfollowHashTagHandlerStream(data,obj,actionType,countObj){
    //alert(actionType);
    //alert(data.toSource());
        if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
        }
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);
  
}
        });
         if(actionType=="Follow"){
          var hashtagFollowersCount = Number(countObj.text());
                    hashtagFollowersCount--;
                   countObj.text(hashtagFollowersCount);
    obj.attr({
                    "class": "unfollow",
                   // "title": "Unfollow"
                   "data-original-title": "Follow"
                });
    }else{
       var hashtagFollowersCount = Number(countObj.text());
                    hashtagFollowersCount++;
                   countObj.text(hashtagFollowersCount);
                   obj.attr({
                    "class": "follow",
                    "data-original-title": "UnFollow"
                });
    }
      return;
    }
       
}

function displayTextBox(obj){
    $(obj).hide();
    $('#editableProfileDiv div.profilefield.editicondiv').each(function(key, val){
        var divId = $(val).attr('id');
        $("#ProfileDetailsForm_"+divId).val($("#"+divId).html());
    });
    var id = $(obj).attr('id');
    $('#ProfileDetailsForm_'+id).show().focus();
    $('#ProfileDetailsForm_'+id).removeClass('hiddenprofile');
}


 function getFeaturedItems(){
     ajaxRequest("/post/getFeaturedItemsToDisplay","",getFeaturedItemsHandler,"html");
            
  }
function getFeaturedItemsHandler(html){
    $("#FeaturedItemsDisplay").html(html);
      $("#FeaturedItemsDisplay").show();
}
function featuredItemsHandler(data){    
    
        $("#FeaturedItemsDisplay").html(data);
        $("#FeaturedItemsDisplay").show();
     
}
function deleteInvitedAtMention(obj, arrayId, userId){
    $(obj).parent('span.dd-tags-close').remove();
    array_pop(globalspace[arrayId], userId);
}
$('.detailed_image_close').live('click',function(){
  if($('.jPlayer-container').length>0){
    $('.jPlayer-container').jPlayer("destroy");
  }
  $('#player').empty();
  $('#player').hide();
});
function strip_tags(str, allow) {
  // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
  allow = (((allow || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
  var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
  });
}

$(function(){
$("#editable").bind('paste', function (event) {
 var $this = $(this); //save reference to element for use laster
 setTimeout(function(){ //break the callstack to let the event finish
   //  var strippedText = strip_tags($this.html(),'<p><pre><span><i><b><li></li><ul></ul>');
   var posttype=$this.attr('data-type');
   var snippethtml=$this.html()+" &nbsp;";
   snippethtml=snippethtml.replace(/<br>/g, "&nbsp;");
if ($this.attr('name') == 'curbsideEditablediv') {
    var strippedText = strip_tags(snippethtml, '<p><pre><span><i><b><li></li><ul></ul><u></u><strike></strike><ol></ol>');
} else {
    var strippedText = strip_tags(snippethtml, '<p><pre><span><i><b><br><br/>');
}
 var urlPattern = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[&nbsp;{};:'".,<>?«»“”‘’]|\]|\?))/ig

    var text = strippedText;
    var results = text.match(new RegExp(urlPattern));
 if(results!=null){
      if($this.attr('isWebPreview')!=1){
     
var separators = ['&nbsp;',' ','</br>','<br>'];
var Weburl = results[0].split(new RegExp(separators.join('|'), 'g'));
       var weburl=$.trim( Weburl[0] );
       var queryString = {data:weburl,Type:"post"}; 
          // var queryString = {data:Weburl[0],Type:"post"}; 
          var div="";
       
          if(posttype=='group'){
               div='Groupsnippet_main';
          }else{
              div='snippet_main';
          }
          
        ajaxRequest("/post/SnippetpriviewPage", queryString, function(data){rendersnipetdetailsHandler(data,div);});
      } }
   
    
 strippedText=strippedText.replace(/\s+/g, ' ');
 $this.html(strippedText) ;
 $this.find('*').removeAttr('style');
 var result = $('#editable');
    result.focus();
    placeCaretAtEnd( document.getElementById("editable") );

},0); 
    });
    

//    $('#editable').bind('paste', function() {
//        var self = $(this);
//        var orig = self.html();//existing text in textarea
//        setTimeout(function() {
//            var selfhtml = $(self).html();//existing text with copied text in textarea
//            var pasted = text_diff(orig, selfhtml);//this will return clipboard data
//            var replaceText = $(pasted).text();//get only text from clipboard data
//            if($.trim(replaceText)==""){//if clipboard data is plain text 
//                replaceText = pasted;
//            }
//            var text = selfhtml.replace(pasted, replaceText);//replace clipboard html with clipboard text
//            self.html('');
//            self.html(text);
//            var result = $('#editable');
//            result.focus();
//            placeCaretAtEnd( document.getElementById("editable") );
//        });
//    });   
    
});

/*
 * WebSnippet preview handler.
 */
function rendersnipetdetailsHandler(data,div) {

    if (data.status == 'success') {
        $('#'+div).show();
        var item = {
            'data': data
        };
       
        $("#"+div).html(
                $("#snippetDetailTmpl").render(item)
                );
        var sap=data.snippetdata;
        if(typeof globalspace['IsWebSnippetExistForPost'] == 'undefined' ||  globalspace['IsWebSnippetExistForPost']=='0' ){
            globalspace['IsWebSnippetExistForPost']=1;
        }
        if(typeof globalspace['weburls'] == 'undefined' ||  globalspace['weburls']=='' ||  globalspace['weburls']!='' ){
            globalspace['weburls']=data.snippetdata['Weburl'];
        }
    }

} 
function text_diff(first, second) {
        var start = 0;
        while (start < first.length && first[start] == second[start]) {
            ++start;
        }
        var end = 0;
        while (first.length - end > start && first[first.length - end - 1] == second[second.length - end - 1]) {
            ++end;
        }
        end = second.length - end;
        return second.substr(start, end - start);
}
/**
 * @author: Haribau
 * This method is used to place the cursor at end position when past the content in the post text area.
 */
function placeCaretAtEnd(el) {
    el.focus();
    if (typeof window.getSelection != "undefined"
            && typeof document.createRange != "undefined") {
        var range = document.createRange();
        range.selectNodeContents(el);
        range.collapse(false);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (typeof document.body.createTextRange != "undefined") {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(false);
        textRange.select();
    }
}
/**
 * @author: Vamsi krishna 
 * @param {type} userid
 * @param {type} type
 * @returns {object} json
 */
function userFollowUnfollowActionsFromProfile(userid, type) {    
    var queryString = "userid=" + userid + "&type=" + type;
    g_userid = userid;
    g_type = type;  
    scrollPleaseWait('popup_userFollow_spinner');
    ajaxRequest("/user/userFollowUnfollowActions", queryString, userFollowUnfollowActionsFromProfileHandler)
}
//author: vamsi krishna
function userFollowUnfollowActionsFromProfileHandler(data) {
 scrollPleaseWaitClose('popup_userFollow_spinner');
    var followingCnt = Number($("#followerscntb_" + g_userid).html());

    if (g_type == "follow") {
//        $("#userFollowunfollowa_" + g_userid).attr({
//            "class": "unfollow"
//        }); 
        $('#userFollowunfollowa_'+ g_userid).closest('i').attr("data-original-title","Unfollow");
    } else if (g_type == "unfollow") { 
//         $("#userFollowunfollowa_" + g_userid).attr({
//            "class": "follow"
//        }); 
        $('#userFollowunfollowa_'+ g_userid).closest('i').attr("data-original-title","Follow");
    }
}
/**
 * @author Karteek.V
 * @returns {Boolean}
 */
function detectDevices() {
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    if (isMobile.any()) {
        return true;
    } else {
        return false;
    }
}
/**
 * @Author Sateesh
 */
function filtericonchange(id){
    if(id =="c_filteractive"){
        $("#c_filteractive").hide();
        $("#c_filterinactive").show();
                
    }else{
                
        $("#c_filteractive").show();
        $("#c_filterinactive").hide();
    }
            
            
}
/**
 * @author Karteek.V
 */
function jScrollPaneInitialize(){
    
$('.scroll').jScrollPane(
    {
            showArrows: false,
            animateScroll: true,
            animateDuration: 500,
            mouseWheelSpeed: 200,
            keyboardSpeed: 120,
            /* This next parameter is new to jScrollpane-custom */
            animateSteps: true
    });
}
 /**
   * Vamsi Krishna
   * This function to get group Intro Pop up 
   */
 function getGroupIntroPopUp(groupId){  
    $("#myModal_body").load("/group/getGroupIntroPopUp",{groupId:groupId},groupIntroHandler);    
    $("#myModalLabel").addClass("stream_title paddingt5lr10");
    $("#myModalLabel").html("Group Profile");
    $("#myModal_footer").hide();
    $("#myModal").modal('show');
  }
  
 function groupIntroHandler(){
     if(!detectDevices())
      $("[rel=tooltip]").tooltip();
          
 } 
 function bingGroupsIntroPopUp(){
     
        $(".followGroup img.followbig").live( "click", 
        function(){
            var groupId = $(this).closest('span.followGroup').attr('data-groupid');              
          followOrUnfollowGroup(groupId,"UnFollow");    
                  $(".followGroup img").removeClass("followbig");
                  $(".followGroup img").addClass("unfollowbig");
                   $(".followGroup img").attr("data-original-title","Follow");
                 $('#followingcntb_').html(Number($('#followingcntb_').text())-1);  
        }
    );
    $(".followGroup img.unfollowbig").live( "click", 
        function(){
             var groupId = $(this).closest('span.followGroup').attr('data-groupid'); 
            followOrUnfollowGroup(groupId,"Follow");
           $(".followGroup img").removeClass("unfollowbig");
                  $(".followGroup img").addClass("followbig");
                   $(".followGroup img").attr("data-original-title","Unfollow");
                   $('#followingcntb_').html(Number($('#followingcntb_').text())+1)  
        }
    );
    $("#groupDescription").live( "click", 
        function(){
             var groupName =$("#groupDescription").attr('data-groupName');    
             
            window.location="/"+groupName;
         
        }
    );
 }
 
 function setNiceScrollToDiv(divId,height,color,isZoom,innerDivId){
        $("#"+divId).attr("style","overflow:auto;height:"+height+"px;");
	$("#"+divId).niceScroll();
        if(typeof color != undefined && color != ""){
            $("#"+divId).niceScroll("#"+innerDivId,{cursorcolor:""+color});
        }
        if(typeof isZoom != undefined && isZoom != ""){
            $("#"+divId).niceScroll("#"+innerDivId,{boxzoom:""+isZoom});
        }
        
 }
 /**
  * @author Karteek.V
  * @param {type} divId
  * @param {type} uri
  * @param {type} postId
  * @returns {undefined}
  */
 function playAVideoAudio(divId,uri,postId){
     scrollPleaseWaitClose('stream_view_detailed_spinner_'+postId);
     
     jwplayer(divId).setup({
               file: uri,
                height: 200,
                width: 200,
                autostart:true
            }); 
 }
 
 function closeVideo(id){
      if(typeof id != undefined && id != ""){
         jwplayer('streamVideoDiv'+id).stop();
         $("#imgsingle_"+id).addClass("img_single");
         $("#imageVideomp3_"+id).show();
         $('#img_streamVideoDiv'+id).removeClass('videoThumnailNotDisplay');
         $('#img_streamVideoDiv'+id).addClass('videoThumnailDisplay');
         $("#playerClose_"+id).hide();
         //jwplayer("streamVideoDiv"+id).stop(); 
         if($('.jPlayer-container').length>0){
            $('.jPlayer-container').jPlayer("destroy");
          if (('#img_streamVideoDiv'+id).length > 0 ){
            $('#img_streamVideoDiv'+id).removeClass('videoThumnailNotDisplay');
            $('#img_streamVideoDiv'+id).addClass('videoThumnailDisplay');
        }
     }
 }
 }
$(document).ready(function() {
    /**
     * funtion to strip the script tags in a text field throughout the application on cut copy paste
     */
    $('input').bind("cut copy paste", function(e) {
     
            var $this = $(this); //save reference to element for use laster
            setTimeout(function() { //break the callstack to let the event finish
            var strippedText = strip_tags($this.val(), '');
            $this.val($.trim(strippedText));
            $this.focus();
            placeCaretAtEnd($this.get(0));

        }, 10); 
       });
    $('input').keypress(function(e) {
        if ((e.which == 3 || e.which == 22 || e.which == 60 || e.which == 62)) {
            return false;
        }
    });

    $("#myModal").on("hidden", function() {
        if($.trim($('#myElement').html()).length>0){        
            jwplayer("myElement").stop();  
        }        
    });
    $("span.sharesection>i").live("click",function(){
        var $socialBar = $(this).closest('div.social_bar');
        var postId = $socialBar.attr('data-postId');
        var categoryType = $socialBar.attr('data-categoryType');
        var postType = $socialBar.attr('data-postType');
        var uri=sharePostUrl+"?postId="+postId+"&categoryType="+categoryType+"&postType="+postType+"&trfid="+loginUserId;
        bit_url(uri);
    });
    //*******This is used to share a post to FB*******start*****/
     window.fbAsyncInit = function() {
        FB.init({appId: fb_api_key, status: true, cookie: true, xfbml: true});
    };
    /*if($('#fb-root').length>0){
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
        
        twttr.events.bind('tweet', function( event ) {
            var queryString = {postId:globalspace.postId,
                categoryType:globalspace.categoryType,
                shareType : 'TwitterShare'
            };
            ajaxRequest("/post/savesharedlist", queryString,twitterSharedListCallback);
        });
    }*/
    
});

function CommentEditableText(commentId) {
    $("#commentTextArea_" + commentId).unbind('paste');
    $("#commentTextArea_" + commentId).bind('paste', function(event) {
        var self = $(this);
        var orig = self.html();//existing text in textarea

        var $this = $(this); //save reference to element for use laster
        setTimeout(function() { //break the callstack to let the event finish
            //  var strippedText = strip_tags($this.html(),'<p><pre><span><i><b><li></li><ul></ul>');

            var strippedText = strip_tags($this.html(), '<p><pre><span><i><b>');
            strippedText=strippedText.replace(/\s+/g, ' ');
            $this.html(strippedText);
            $this.find('*').removeAttr('style');
            var result = $("#commentTextArea_" + commentId);
            result.focus();
            //applyLayoutContent();
            
            var urlPattern = "(((https?)\:\/\/)|(www\.))[A-Za-z0-9][A-Za-z0-9.-]+(:\d+)?(\/[^ ]*)?";
    var text = strippedText;
    var results = text.match(new RegExp(urlPattern));
    if(results!=null){
   
         var Weburl = results[0].split("&nbsp");
         var weburl=$.trim( Weburl[0] );
        var queryString = 'data=' + weburl+'&CommentId=' + commentId+"&Type=comment";
          //var queryString = {data:Weburl[0],Type:"comment"}; 
        ajaxRequest("/post/SnippetpriviewPage", queryString, function(data){rendersnipetForCommentsHandler(data,commentId);});
   
   }  
            
            
            placeCaretAtEnd(document.getElementById("commentTextArea_" + commentId));
        }, 0); 
    });
}
function rendersnipetForCommentsHandler(data,commentId) {
 
    if (data.status == 'success') {
        $('#snippet_main_'+commentId).show();
        var item = {
            'data': data
        };
        $("#snippet_main_"+commentId).html(
                $("#snippetDetailTmpl").render(item)
                );
        if(typeof globalspace['IsWebSnippetExistForComment_'+commentId] == 'undefined' || globalspace['IsWebSnippetExistForComment_'+commentId]=='0' ){
        globalspace['IsWebSnippetExistForComment_'+commentId]=1;
    }
    
    if(typeof globalspace['CommentWeburls_'+commentId] == 'undefined' ||  globalspace['CommentWeburls_'+commentId]=='' ||  globalspace['CommentWeburls_'+commentId]=='' ){
            globalspace['CommentWeburls_'+commentId]=data.snippetdata['Weburl'];
        }
    
    }

}
function loadDocumentViewer(id, uri, options,videoImage,height,width){ 
    $('.'+id).empty();
    var format = (/[.]/.exec(uri)) ? /[^.]+$/.exec(uri) : undefined;
    format = format.toString().toLowerCase();
     uri=location.protocol+"//"+window.location.host+uri;
     var style="style='width:1000px; height:480px;'";
      if(detectDevices()){ 
      style="style='width:300px; height:480px;'";
      }
    if(format == "pdf" || format == "ppt" || format == "txt" || format == "doc" || format == "docx" || format == "xls" || format == "xlsx"){ 
        var url = '<iframe src="https://docs.google.com/gview?url='+uri+'&embedded=true" '+style+' frameborder="0"></iframe>';
        $('.'+id).html(url);
     }else{
         if(videoImage != undefined && videoImage != ""){
                 videoImage = videoImage;
             }else{
                 videoImage = "";
             }
             var autostart = 'false';
         if(detectDevices()){ 
             if(format == "jpg" || format == "JPG" || format == "png" || format == "PNG" || format == "gif" || format == "GIF" || format == "jpeg"){
                uri  = uri.replace('/upload/public/thumbnails/','/upload/public/images/'); 
                uri  = uri.replace('/upload/group/thumbnails/','/upload/group/images/');
                $('.'+id).html('<img id="showoriginalpicture" src="'+uri+'"  style="max-width:100%;border: 12px solid #FFFFFF;">');
                 }else{
                  $('.'+id).html('<div id="player"></div>');
                 openOverlay(uri,videoImage,id,350,450,autostart);
             }
        }else{

            if(format == "jpg" || format == "JPG" || format == "png" || format == "PNG" || format == "gif" || format == "GIF" || format == "jpeg"){
          
           uri  = uri.replace('/upload/public/thumbnails/','/upload/public/images/'); 
           uri  = uri.replace('/upload/group/thumbnails/','/upload/group/images/');
           $('.'+id).html('<img id="showoriginalpicture" src="'+uri+'"  style="max-width:100%;border: 12px solid #FFFFFF;">');
            }else{
                autostart = 'true';
                $('.'+id).html('<div id="'+id+'"></div>');
                openOverlay(uri,videoImage,id,height,width,autostart);
            }
            
        }
     }
} 


     /**
   * Praneeth
   * This function to get subgroup Intro Pop up 
   */
 function getSubGroupIntroPopUp(subgroupId){  
    $("#myModal_body").load("/group/getSubGroupIntroPopUp",{subgroupId:subgroupId},subgroupIntroHandler);    
    $("#myModalLabel").addClass("stream_title paddingt5lr10");
    $("#myModalLabel").html("SubGroup Profile");
    $("#myModal_footer").hide();
    $("#myModal").modal('show');
  }
  
 function subgroupIntroHandler(){
     if(!detectDevices())
      $("[rel=tooltip]").tooltip();
          
 } 
 
 
 function bingSubGroupsIntroPopUp(){
     
        $(".followSubGroup img.followbig").live( "click", 
        function(){
            var maingroupId = $(this).closest('span.followSubGroup').attr('data-maingroupid'); 
            var subgroupId = $(this).closest('span.followSubGroup').attr('data-subgroupid'); 
             followOrUnfollowSubGroup(maingroupId,"UnFollow",'','',subgroupId); 
                  $(".followSubGroup img").removeClass("followbig");
                  $(".followSubGroup img").addClass("unfollowbig");
                   $(".followSubGroup img").attr("data-original-title","Follow");                  
                 $('#Subfollowingcntb_').html(Number($('#Subfollowingcntb_').text())-1);  
        }
    );
    $(".followSubGroup img.unfollowbig").live( "click", 
        function(){
             var maingroupId = $(this).closest('span.followSubGroup').attr('data-maingroupid'); 
            var subgroupId = $(this).closest('span.followSubGroup').attr('data-subgroupid'); 
            followOrUnfollowSubGroup(maingroupId,"Follow",'','',subgroupId);
           $(".followSubGroup img").removeClass("unfollowbig");
                  $(".followSubGroup img").addClass("followbig");
                   $(".followSubGroup img").attr("data-original-title","Unfollow");                   
                   $('#Subfollowingcntb_').html(Number($('#Subfollowingcntb_').text())+1)  
        }
    );
    $("#subgroupDescription").live( "click", 
        function(){
             var maingroupName =$("#subgroupDescription").attr('data-maingroupName'); 
             var subgroupName =$("#subgroupDescription").attr('data-groupName'); 
             window.location="/"+maingroupName+"/sg/"+subgroupName;
         
        }
    );
 }
    
/**
 * Author Sagar
 * This is used to share the post to facebook
 * @returns {undefined}
 */

function prepareWallPostData(postId, categoryType, postType, streamId, page){
    streamId = streamId==""?postId:streamId;
    var uri=sharePostUrl+"?postId="+postId+"&categoryType="+categoryType+"&postType="+postType+"&trfid="+loginUserId;
    globalspace.categoryType = categoryType;
    globalspace.postId = postId;
    globalspace.streamId = streamId;
    globalspace.sharePage = page;
    publishWallPost(globalspace.currentBitLyURL);
        }
   
function publishWallPost(res_bit_url) {
    var streamId = globalspace.streamId;
     var description = "";
     var picture = "";
    if(globalspace.sharePage=="postDetail"){
        description = $.trim($('#postDetailPage>p:first-child').text());
        if($('#postDetailedwidget .post_widget[data-postid="'+streamId+'"] div.d_img_outer_video_play:first>img').length>0){
            picture = $('#postDetailedwidget .post_widget[data-postid="'+streamId+'"] div.d_img_outer_video_play:first>img').attr("src")
        }
    }else{
        description = $.trim($('#post_content_total_'+streamId).text());
         if($('#imgsingle_'+streamId).length>0){
            picture = $('#imgsingle_'+streamId+'>img').attr('src');
        }else if($('a.img_more.postdetail[data-id='+streamId+']').length>0){
            picture = $('a.img_more.postdetail[data-id='+streamId+']>img').attr('src');
        }
    }
   
    
   
    var uri=location.protocol+"//"+window.location.host;
    if($.trim(picture)!=""){
        picture = uri+picture;
    }
    FB.ui(
      {
       method: 'feed',
       name: projectName,
       caption: ' ',
       description:  description+res_bit_url,
       link: res_bit_url,
       picture: picture
      },
      function(response) {
        if (response && response.post_id) {
            var queryString = {postId:globalspace.postId,
                categoryType:globalspace.categoryType,
                shareType : 'FbShare'
            };
          ajaxRequest("/post/savesharedlist", queryString,facebookSharedListCallback);
          //SaveSharedList
        }
      }
    );
}
function facebookSharedListCallback(data){
    if(data.status=='success'){
        var count = Number($('#streamShareCount_'+globalspace.streamId).text());
        $('#streamShareCount_'+globalspace.streamId).text(++count);
        $('ul#share_'+globalspace.streamId).closest('span.sharesection').find('img.share').attr('class','sharedisable');
        if($('ul#share_'+globalspace.streamId+'>li').length>1){
            $('ul#share_'+globalspace.streamId+'>li.shareFacebook').remove();
        }else{
            $('ul#share_'+globalspace.streamId).closest('div.dropdown-menu.actionmorediv').remove();
        }
    }
}
function twitterSharedListCallback(data){
    if(data.status=='success'){
        var count = Number($('#streamShareCount_'+globalspace.streamId).text());
        $('#streamShareCount_'+globalspace.streamId).text(++count);
        $('ul#share_'+globalspace.streamId).closest('span.sharesection').find('img.share').attr('class','sharedisable');
        if($('ul#share_'+globalspace.streamId+'>li').length>1){
            $('ul#share_'+globalspace.streamId+'>li.shareTwitter').remove();
        }else{
            $('ul#share_'+globalspace.streamId).closest('div.dropdown-menu.actionmorediv').remove();
        }
    }
}
//bit_url function
function bit_url(url)
{
    var urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
    var urltest = urlRegex.test(url);
    if (urltest)
    {
        var queryString = {longUrl: url, apiKey: bitLyAPIKey, login: bitLyUsername};
        //ajaxRequest("http://api.bit.ly/v3/shorten", queryString,function(data){bit_url_callback(data);},"jsonp");
        ajaxRequest("https://api-ssl.bitly.com/v3/shorten", queryString,function(data){bit_url_callback(data);},"json");
    }
}
function bit_url_callback(data){
    globalspace.currentBitLyURL = data.data.url;
}

function getTweetLink(postId, categoryType, postType, streamId,page){
    streamId = streamId==""?postId:streamId;
    var twtUrl = sharePostUrl+"?postId="+postId+"&categoryType="+categoryType+"&postType="+postType+"&trfid="+loginUserId;
    globalspace.postId = postId;
    globalspace.categoryType = categoryType;
    globalspace.streamId = streamId;
    globalspace.sharePage = page;
    tweetPost(globalspace.currentBitLyURL);
    }
    
function tweetPost(res_bit_url){
    var streamId = globalspace.streamId;
    var twtTitle  = "";
    if(globalspace.sharePage=="postDetail"){
        twtTitle = $.trim($('#postDetailPage>p:first-child').text());
    }else{
        twtTitle = $.trim($('#post_content_total_'+streamId).text());
    }
    
    var maxLength = 140 - (res_bit_url.length + 3);
    if (twtTitle.length > maxLength) {
        twtTitle = twtTitle.substr(0, (maxLength - 3))+'...';
    }
    var twtLink = 'https://twitter.com/intent/tweet?text='+encodeURIComponent(twtTitle)+"&url="+encodeURIComponent(res_bit_url);
    var anker = "<a id='tweet_"+streamId+"' href='"+twtLink+"' style='display:none'>tweet</a>";
    if($("#tweet_"+streamId).length<=0){
       if(globalspace.sharePage=='postDetail'){
            $('#postDetailedwidget').append(anker);
        }else{
            $('#postitem_'+streamId).append(anker);
        }
    }
    setTimeout(document.getElementById('tweet_'+streamId).click(),2000);
    //window.open(twtLink, "", "toolbar=0, status=0, width=650, height=360");

}
function trackActivities(URL,queryString){
      ajaxRequest(URL,queryString,function(data){});
}

function followOrUnfollowSubGroup(groupId,actionType,obj,countObj,subGroupId) {
    g_groupId = groupId;
     scrollPleaseWait("groupfollowSpinLoader");
    var queryString = "groupId=" + groupId+"&actionType="+actionType+"&subGroupId="+subGroupId;
   
    ajaxRequest("/group/UserFollowSubGroup", queryString, function(data){followOrUnfollowSubGroupHandler(data,actionType,obj,countObj)});
}
function bindSubGroupsFollowUnFollow(pageId){       
     $("#followGroupInDetail img.followbig").live( "click",
        function(){ 
            var groupId = $(this).closest('span.noborder').attr('data-groupid');  
            var subgroupId = $(this).closest('span.noborder').attr('data-subgroupid');  
            followOrUnfollowSubGroup(groupId,"UnFollow",'','',subgroupId);                     
            $("#GroupFollowers").removeAttr("onclick");
            $("#GroupImages").removeAttr("onclick");
            $("#GroupDocs").removeAttr("onclick");
            $('#conversations').removeAttr("onclick");
            $("#groupFormDiv").hide();
            $("#groupstreamMainDiv").hide();
            $('#groupFollowersCount').html(Number($('#groupFollowersCount').text())-1)
            $("#UPF").html('');
            $("#UPF").hide('');
              $(this).attr('data-original-title','Follow');
           $(this).attr({
               "class":"unfollowbig"
            });
        }
    );
   $("#followGroupInDetail img.unfollowbig").live( "click",
        function(){
            var groupId = $(this).closest('span.noborder').attr('data-groupid');
            var category = $(this).closest('span.noborder').attr('data-category');            
            var subgroupId = $(this).closest('span.noborder').attr('data-subgroupid');  
            followOrUnfollowSubGroup(groupId,"Follow",'','',subgroupId);
            $("#GroupFollowers").attr("onclick","getUserFollowers('"+subgroupId+"','"+category+"');");
            $("#GroupImages").attr("onclick","getGroupImagesAndVideos('"+subgroupId+"','"+category+"');");
            $("#GroupDocs").attr("onclick","getGetGroupDocs('"+subgroupId+"','"+category+"');");
            $("#conversations").attr("onclick","loadGroupConversations('"+subgroupId+"','"+category+"');");           
            $("#groupFormDiv").show();
            $("#groupstreamMainDiv").show();
            $('#groupFollowersCount').html(Number($('#groupFollowersCount').text())+1)
             $("#UPF").show('');
                $(this).attr('data-original-title','Unfollow');
            $(this).attr({
               "class":"followbig"
            });
        }
    );
   }
   
   function showLoginPopup(){
     sessionStorage.sharedURL = document.URL;
    // alert(sessionStorage.sharedURL);
     $("#sessionTimeoutLabel").html("Login");
     $("#sessionTimeout_body").html("Please login to continue");
     $("#sessionTimeoutModal").modal('show');     
}

function followOrUnfollowGroupFromDetail(param){
            
            followOrUnfollowGroup(param.groupId,param.type);      
            closeModelBox();
           if(param.type=='UnFollow'){
              $("#GroupFollowers").removeAttr("onclick");
            $("#GroupImages").removeAttr("onclick");
            $("#GroupDocs").removeAttr("onclick");
            $('#conversations').removeAttr("onclick");
            $("#groupFormDiv").hide();
            $("#groupstreamMainDiv").hide();
            $('#groupFollowersCount').html(Number($('#groupFollowersCount').text())-1)
            $("#UPF").html('');
            $("#UPF").hide('');
              $(param.obj).attr('data-original-title','Follow');
           $(param.obj).attr({
               "class":"unfollowbig"
            });  
           } 
}   

/**
 * @author karteek.v
 * @param {type} postType
 * @param {type} postId
 * @param {type} userId
 * @param {type} actionType
 * @returns {object} json 
 */
function followOrUnfollowNews(postType, postId,actionType, categoryType,obj) { 
    g_postType = postType;
    g_postId = postId;
    scrollPleaseWait("detailed_followUnfollowSpinLoader_"+g_postId);
    scrollPleaseWait("followUnfollowSpinLoader_"+g_postId);
    var queryString = "postType=" + postType + "&postId=" + postId+"&actionType="+actionType+"&categoryType="+categoryType; 
    ajaxRequest("/news/userFollowNewsPost", queryString, function(data){followOrUnfollowNewsHandler(actionType,data,obj)});
}

/**
 * @author karteek.v
 * @param {type} data
 * @returns empty
 */
function followOrUnfollowNewsHandler(actionType,data,obj) {  
    scrollPleaseWaitClose("detailed_followUnfollowSpinLoader_"+g_postId);
   scrollPleaseWaitClose("followUnfollowSpinLoader_"+g_postId);
     if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
}
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);

            }
        });
            if(actionType=="Follow"){
                
                 var followCnt = Number(obj.parent('i').parent('a').find('b').text());
                followCnt = Number(followCnt)-1;
                obj.parent('i').parent('a').find('b').text(followCnt);
                
        
           obj.attr({
                    "class": "unfollow",
                    "data-original-title": "Follow"
                });
    }else{
         var followCnt = Number(obj.parent('i').parent('a').find('b').text());
                followCnt = Number(followCnt)+1;
                obj.parent('i').parent('a').find('b').text(followCnt);
                   obj.attr({
                    "class": "follow",
                    "data-original-title": "UnFollow"
                });
    }
      return;
    }

}

/**
 * @author karteek.v
 * @param {type} postType
 * @param {type} postId
 * @param {type} userId
 * @returns {undefined}
 */
function loveToNewsPost(postType, postId, categoryType,streamId,obj){       
    g_postType = postType;
    if(typeof streamId != undefined)
        g_postId = streamId;
    else
        g_postId = postId;
    scrollPleaseWait('stream_view_spinner_'+streamId);
    var queryString = "postType=" + postType + "&postId=" + postId+"&categoryType="+categoryType;
    ajaxRequest("/news/userLoveToCuratedPost", queryString, function(data){loveToNewsPostHandler(data,obj)});
}
function loveToNewsPostHandler(data,obj){ 
    scrollPleaseWaitClose('stream_view_spinner_'+g_postId);
   // alert(data.toSource());
     if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
}
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);

            }
        });
         obj.attr({
                    "class": "unlikes"
                });
    var loveCnt = Number(obj.parent('i').next('b').text());
                loveCnt--;
               
               
                 obj.parent('i').next('b').text(loveCnt);
      return;
    }
    
   
}
/* Author Rahul
 * start Handling News Object 
 * */

function showMoreEditorial(postId) {
    var queryString = {postId:postId};
    ajaxRequest("/news/geteditorial", queryString, function(data){showMoreEditorialHandler(data)});
}
function showMoreEditorialHandler(data)
{
    $('.EDCRO'+data.data._id.$id).html(data.data.Editorial+'<a data-placement="bottom" rel="tooltip"  data-original-title="show less" class="minimize" data-id="'+data.data._id.$id+'">[-]</a>')
    applyLayoutContent();
   
}
function showMoreEditorialC(postId) {
    var queryString = {postId:postId};
    ajaxRequest("/news/geteditorial", queryString, function(data){showMoreEditorialCHandler(data)});
}
function showMoreEditorialCHandler(data)
{
    $('.HTMLC'+data.data._id.$id).html(data.data.Description+'<a data-placement="bottom" rel="tooltip"  data-original-title="show less" class="minimizeC" data-id="'+data.data._id.$id+'">[-]</a>')
    applyLayoutContent();
   
}
function minimizeEditorial(postId,editorialCoverage)
{
    editorialCoverage=editorialCoverage.substr(0,240);
    editorialCoverage=editorialCoverage+'<a data-placement="bottom" rel="tooltip"  data-original-title="show more" class="showmore" data-id="'+postId+'">...</a>';
    $('.EDCRO'+postId).html(editorialCoverage)
    applyLayoutContent();
   
}
function minimizeEditorialC(postId,editorialCoverage)
{
    editorialCoverage=editorialCoverage.substr(0,260);
    editorialCoverage=editorialCoverage+'<a data-placement="bottom" rel="tooltip"  data-original-title="show more" class="showmoreC" data-id="'+postId+'">...</a>';
    $('.HTMLC'+postId).html(editorialCoverage)
    applyLayoutContent();
   
}
/* Author Rahul
 * End Handling News Object 
 * */

function previewImageNews(file, response, responseJSON, postType){
   $('#preview_'+postType).show();
    $('#previewul_'+postType).show();
    if(typeof globalspace[postType+"_UploadedFiles"] == 'undefined'){
        globalspace[postType+"_UploadedFiles"]=new Array();
        globalspace[postType+"_Artifacts"]=new Array();
    }
    if(globalspace[postType+"_UploadedFiles"].length < 4){
        
          if($.inArray(response,globalspace[postType+"_Artifacts"]) < 0){ // doesn't exist
             $('.btn').prop('disabled', false);
           // $('.qq-upload-list').hide();
           var data=responseJSON;
           var filetype=responseJSON['extension'];
           var imageid=responseJSON['savedfilename'];
           var image="";
           image = getImageIconByType(filetype);
           if(image==""){
                image=responseJSON['filepath'];
           }
           globalspace[postType+"_UploadedFiles"].push(responseJSON['filename']);
           globalspace[postType+"_Artifacts"].push(responseJSON['filename']);
           $('#previewul_'+postType).append(' <li class="alert" ><i  id="'+imageid+'" ontouchstart="closeimages(this,'+"'"+responseJSON['savedfilename']+"'"+","+"'"+responseJSON['fileremovedpath']+"'"+","+"'"+responseJSON['filename']+"'"+","+"'"+postType+"'"+');"  onclick="closeimages(this,'+"'"+responseJSON['savedfilename']+"'"+","+"'"+responseJSON['fileremovedpath']+"'"+","+"'"+responseJSON['filename']+"'"+","+"'"+postType+"'"+');"  class="fa fa-times-circle deleteicon mobiledeleteicon "  data-dismiss="alert" ></i><i style="display:none" class="fa fa-search-plus zoomicon" ></i><a  class="postimgclose mobilepostimgclose "   href=""> </a>\n\
                <img src="'+image+'"></li>');
       }
        else { // does exist
             var message=response+ " Already uploaded please upload another file";
             displayFileErrorMessage(postType, message);
        }
    }else{
         var message=" already you have uploaded 4 files uploaded file size limit is 4";
         displayFileErrorMessage(postType, message);
     }
     applyLayoutContent();
 }
 
 function showEditorial(postId) {
    var queryString = {postId:postId};
    ajaxRequest("/news/geteditorial", queryString, function(data){showEditorialHandler(data)});
}
function showEditorialHandler(data)
{
    $('.EDCRO'+data.data._id.$id).hide();
    $('.EDC'+data.data._id.$id).val(data.data.Editorial);
    $('.EC'+data.data._id.$id).show();
    applyLayoutContent();
}
/*
* This function loads in stream page document ready state
* @author Vamsi 
*/
function initializationForHashtagsAtMentionsForPrivateGroups(inputor,groupId){
    var inputorId = $(inputor).attr('id');
    globalspace['hashtag_'+inputorId]=new Array();
    globalspace['at_mention_'+inputorId]=new Array();
    /*
    * at_mention_config is used to initialize the atmentions
    * @author Vamsi
    */
   
      var at_mention_config = {
           at: "@",
           callbacks: {
                 remote_filter: function (query, callback) {
                     if(typeof globalspace['at_mention_'+inputorId] == 'undefined'){
                        globalspace['at_mention_'+inputorId]=new Array();
                     }
        var data = {searchkey:query,existingUsers:JSON.stringify(globalspace['at_mention_'+inputorId]),groupId:groupId};
         ajaxRequest("/post/getGroupMembersForPrivateGroups",data,callback);
                  
                 },
                 before_insert: function(value, $li){
                     globalspace['at_mention_'+inputorId].push(Number($(value).attr('data-user-id')));
                    return value;
                 }
             },
           tpl:"<li data-value='@${DisplayName}'><div class='d_name'>${DisplayName}</div> <i class='d_n_border'><img src='${profile45x45}'  /></i></li>",      
           insert_tpl: "<span class='at_mention dd-tags' data-user-id=${UserId}><b>@${DisplayName}</b><i onclick='removeAtMention(this,"+'"'+"at_mention_"+inputorId+'"'+")'>X</i></span>",
           search_key: "DisplayName",
           show_the_at: true,
           limit: 50
       }
      
 
    $(inputor).atwho(at_mention_config);
}
function validateAtMentionsForPrivateGroup(editorData){
    var isValidate=false;
    var atmentionErrorCount = editorData.clone().find("span.atmention_error").length;
    var mentionString = editorData.clone().find("span").remove().end().html();
    if(mentionString.indexOf("@")>=0){
        var myString = mentionString.substr(mentionString.indexOf("@")+ 1);           
        var type = 'at_mention_'+editorData.attr('id');
        var myArray = myString.split('@');
        for(var i=0;i<myArray.length;i++){
            var atMentionData = "";
            if(myArray[i].indexOf(' ')>=0){
                atMentionData = myArray[i].substr(0, myArray[i].indexOf(' ')); 
                if(atMentionData.indexOf('<')>0){
                    atMentionData = atMentionData.substr(0, atMentionData.indexOf('<')); 
                }
                var resultString = replaceStringForPrivateGroups(editorData.html(), '@'+atMentionData,atMentionData, type);
                editorData.html(resultString); 
            }else{
                if(myArray[i].indexOf('<')>0){
                    atMentionData = myArray[i].substr(0, myArray[i].indexOf('<')); 
                }else{
                    atMentionData = myArray[i];//alert(atMentionData);
                }
                var resultString = replaceStringForPrivateGroups(editorData.html(), '@'+atMentionData,atMentionData, type);
                editorData.html(resultString); 
            }

        }
    }else if(atmentionErrorCount>0){
        isValidate=false;
    }else{
        isValidate=true;
    }
    return isValidate;
}
/*
 * replaceString() is used to check for @mention not available in follower/following users list and replace the @mention with errored atmention
 * @author Sagar
 */
function replaceStringForPrivateGroups(strVal, search,displaymention, type){
    var count=0;
    var index=strVal.indexOf(search);
    while(index!=-1){
        count++;
        var charBeforeString = strVal.substr(index-3,3);
        if(charBeforeString!='<b>' || index==0){
            strVal = strVal.substr(0, index) + '<span class="atmention_error dd-tags" contenteditable="false"><span style="position:relative" ><b>'+search+'</b></span><i style="color:#B94A48" onclick="removeAtMentionError(this)">X</i></span>' + strVal.substr(index+search.length);
        }
        index=strVal.indexOf(search,index+1);
        
    }
    return strVal;

}

function loadPlaceholders(adddiv,removediv){
    $("#"+adddiv).on('click',function(){
        $(this).css("background-color","#fff");
    });
    $("#"+removediv).on('blur',function(){
        if($(this).text() == ""){
            $("#"+adddiv).css("background-color","");
        }
    });
    

}
/**
* @author Sagar
*/
function initializeAtMentionsForPrivateGroup(inputor, PostId, CategoryType,groupId){
    /*
    * at_mention_config is used to initialize the atmentions
    * @author Sagar
    */
   
    var inputorId = $(inputor).attr('id');
    globalspace['invite_at_mention_'+inputorId]=new Array();
    
      var invite_at_mention_config = {
           at: "@",
           callbacks: {
                 remote_filter: function (query, callback) {//alert('called');
                     scrollPleaseWait('stream_view_spinner_'+PostId);
                     if(typeof globalspace['invite_at_mention_'+inputorId] == 'undefined'){
                        globalspace['invite_at_mention_'+inputorId]=new Array();
                     }

          var data = {searchkey:query,existingUsers:JSON.stringify(globalspace['invite_at_mention_'+inputorId]),postId:PostId,categoryType:CategoryType,groupId:groupId};
        ajaxRequest("/post/getroupMembersForPrivateGroupsForInvite",data,function(data){
            scrollPleaseWaitClose('stream_view_spinner_'+PostId);
             callback(data);
        });     
                 

                 },
                 before_insert: function(value, $li){
                     var InvitedUserId = Number($li.attr('data-user-id'));
                     globalspace['invite_at_mention_'+inputorId].push(InvitedUserId);
                     $('#'+inputorId+'_currentMentions').append("<span class='at_mention dd-tags dd-tags-close' data-user-id="+InvitedUserId+"><b>"+$li.attr('data-value')+"</b><i onclick='deleteInvitedAtMention(this, \"invite_at_mention_"+inputorId+"\", "+InvitedUserId+")'>X</i></span>")
                     $('#'+inputorId).val('');
                     return "";
                 },
                 matcher: function(flag, subtex) {
                    flag = '@';
                    subtex = flag+$.trim(subtex);
                    var match, regexp;
                    flag = flag.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                    
                    regexp = new RegExp(flag + '([A-Za-z0-9_\+\-]*)$|' + flag + '([^\\x00-\\xff]*)$', 'gi');
                    match = regexp.exec(subtex);
                    if (match) {
                      return match[1].length>=3?match[1]:null;
                    } else {
                      return null;
                    }
                  }
             },
           tpl:"<li data-value='${DisplayName}' data-user-id=${UserId}><div class='d_name'>${DisplayName}</div> <i class='d_n_border'><img src='${profile45x45}'   /></i></li>",      
           //insert_tpl: "<span class='at_mention dd-tags' data-user-id=${UserId}><b>${DisplayName}</b><i onclick='removeAtMention(this,"+'"'+"invite_at_mention_"+inputorId+'"'+")'>X</i></span>",
           search_key: "DisplayName",
           show_the_at: true,
           limit: 50
       }
    $(inputor).atwho(invite_at_mention_config);
}

function followOrUnfollowSubGroupHandler(data,actionType,obj,countObj) {
    scrollPleaseWaitClose("groupfollowSpinLoader");
      if(data.status=="error"){
        var error = [];
        if (typeof (data.error) == 'string') {
            var error = eval("(" + data.error.toString() + ")");
        } else {
            var error = eval(data.error);
        }
        $.each(error, function(key, val) { 
            if ($("#" + key)) {
                displayError(key, val);
   
}
        });
           if(actionType=="Follow"){
          var groupFollowersCount = Number(countObj.text());
                    groupFollowersCount--;
                   countObj.text(groupFollowersCount);
    obj.attr({
                    "class": "unfollow",
                   // "title": "Unfollow"
                   "data-original-title": "Follow"
                });
    }else{
         var groupFollowersCount = Number(countObj.text());
                    groupFollowersCount++;
                   countObj.text(groupFollowersCount);
                   obj.attr({
                    "class": "follow",
                    "data-original-title": "UnFollow"
                });
    }
      return;
    }
    if(data.status=="success"){
        if($('#GroupAdminMenu').length>0){
            if(actionType=="Follow"){                   
                if(data.isSubGroupAdmin==1){
                 $('#GroupAdminMenu').show();    
                }
                
            }else{
                $('#GroupAdminMenu').hide();
            }
        }
    }
//    if(actionType=="Follow"){
//          var groupFollowersCount = Number(countObj.text());
//                    groupFollowersCount++;
//                   countObj.text(groupFollowersCount);
//    obj.attr({
//                    "class": "follow",
//                   // "title": "Unfollow"
//                   "data-original-title": "Unfollow"
//                });
//    }else{
//         var groupFollowersCount = Number(countObj.text());
//                    groupFollowersCount--;
//                   countObj.text(groupFollowersCount);
//                   obj.attr({
//                    "class": "unfollow",
//                    "data-original-title": "Follow"
//                });
//    }
}



function formatDates(year,month,date, formatString) {

	//if(formatDate instanceof Date) {

		var months = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		var yyyy = year;
		var yy = yyyy.toString().substring(2);
		var m = month;
		var mm = m < 10 ? "0" + m : m;
		var mmm = months[m];
		var d = date;
		var dd = d < 10 ? "0" + d : d;
		
//		var h = formatDate.getHours();
//		var hh = h < 10 ? "0" + h : h;
//		var n = formatDate.getMinutes();
//		var nn = n < 10 ? "0" + n : n;
//		var s = formatDate.getSeconds();
//		var ss = s < 10 ? "0" + s : s;

		formatString = formatString.replace(/yyyy/i, yyyy);
		formatString = formatString.replace(/yy/i, yy);
		formatString = formatString.replace(/mmm/i, mmm);
		formatString = formatString.replace(/mm/i, mm);
		formatString = formatString.replace(/m/i, m);
		formatString = formatString.replace(/dd/i, dd);
		formatString = formatString.replace(/d/i, d);
//		formatString = formatString.replace(/hh/i, hh);
//		formatString = formatString.replace(/h/i, h);
//		formatString = formatString.replace(/nn/i, nn);
//		formatString = formatString.replace(/n/i, n);
//		formatString = formatString.replace(/ss/i, ss);
//		formatString = formatString.replace(/s/i, s);
		return formatString;

}
function manageNetworkAdmin(PostAsNetwork){
    var queryString = {isAdmin:PostAsNetwork};
    ajaxRequest('/user/manageNetworkAdmin', queryString,manageNetworkAdminHandler);
}    
function manageNetworkAdminHandler(data){
    if(data.status=="success"){
        loginUserId = Number(data.loginUserId);
        postAsNetwork = Number(data.postAsNetwork);
        //alert(loginUserId+"==="+postAsNetwork);
    }
    //window.location.reload();
}
function renderPostDetailForCareer(id){
    var queryString = {id:id};
     ajaxRequest('/career/renderPostDetailForCareer', queryString,function(data){renderPostDetailForCareerHandler(data)},"html");
    
}

function renderPostDetailForCareerHandler(data){      
    $('#main').hide();
    $('#postDetailedTitle').hide();    
    $('body, html').animate({scrollTop : 0}, 800,function(){});
    $('#careerDetail').html(data).show();
    
}

 function getJoyrideDetails()
   {   
       var pageName=window.location.pathname;
           pageName=pageName.substring(1,pageName.length);
          if( sessionStorage.pageName=='group/groupdetail' ||sessionStorage.pageName=='userProfile' )
          { pageName=sessionStorage.pageName;
         sessionStorage.pageName=false;
          }
       var queryString ={moduleName:pageName};
       $('#header').css('position','static');
       $('#streamsection').css('padding-top','47px');
       ajaxRequest("/common/GetJoyrideDetails",queryString,getJoyrideDetailsHandler, 'html');
   }
   
   function getJoyrideDetailsHandler(data)
   {
       $(".filtericondiv").css("width","40");
       $("#joyRideTipContent").html(data);
   }
   
   //Badging
   
   
 function getBadgingDetails()
   {  
      
       ajaxRequest("/user/GetBadgesNotShownToUser","",getBadginDetailsHandler, 'html');
   }
   
   function getBadginDetailsHandler(data)
   {
     //  var dat=eval(data);
       // var error = eval(data.status);
       
       if(data!=0)
       {
     
       $("#badging_body").html(data);
    $("#badgingLabel").html("Congratulations");
   
    $("#badging").bind("click", function(event){
       if($(event.target).closest('#badging-model-content').length<=0){
        var badgeCollectionId=$("#BadgeShownToUser").val();
        updateBadesShown(badgeCollectionId);
    }
       
    });
    $("#badging_header .close").bind("click", function(){
        var badgeCollectionId=$("#BadgeShownToUser").val();
        updateBadesShown(badgeCollectionId);
       
    });
   
    $("#badging_footer").hide();
    $("#badging_message").hide();
    $("#badging").modal('show');
       }
   }
   
   
   function updateBadesShown(badgeCollectionId)
   {
         var queryString ={badgeCollectionId:badgeCollectionId};
         ajaxRequest("/user/UpdateBadgeShownToUser",queryString,function(data){
               $("#badging").modal('hide');
              $("#badging_body").html("");
              
              
                  
         },"html"); 
   }
   
   
   function enableOrDisableJoyRide(value)
   {

         var queryString ={action:value};
       ajaxRequest("/common/EnableOrDisableJoyRide",queryString,enableOrDisableJoyRideHandler); 
      
   }
   
   function enableOrDisableJoyRideHandler(data)
   {
      window.location.reload();
   }
   
// Start referral js   
 function Referral(){ 

    var queryString = "";
    ajaxRequest("/user/referral",queryString,function(data){ReferraleHandler(data);},"html");
    }

    function ReferraleHandler(data){

        $("#myModal_body").html(data);
        $("#myModalLabel").html("Refer a Colleague");
        $("#myModal_saveButton").html("Save");
        $("#myModal_footer").hide();
        $("#myModal_message").hide();
        $("#myModal").modal('show');
        $(".modal-dialog").addClass('refer_modal-dialog');
        $("[rel=tooltip]").tooltip();
       //  #confinedSpace textarea { resize:vertical; max-height:300px; min-height:200px; }
        $("#userreferralSubmit").bind("click", function(){
             saveUserReferrals();
        });
         $("#userreferralCancel").bind("click", function(){
             CancelUserReferrals();
        });

    }

  function saveUserReferrals(){

        var email=$('#userReferral_email').val();
      //  var message=$('#userReferral_message').val();
          var message= $.trim($('#userReferral_message').text())
        

        var emails = email.split(',');
       emails= CleanArray(emails);
     
        var invaliemailMessage="";
        var duplicateEmailMessage="";
        var invalidmails=0;
        var errormessage="";
        var errMsg="";
        if($.trim($('#userReferral_email').val()).length>0 && ($('#userReferral_message').text() != "")){

          for(var i=0;i<emails.length;i++){
            if (!IsValidEmail($.trim(emails[i]))) {
             // alert("Invalid email address.");
              invalidmails++;
              if(i!=0 && invaliemailMessage!=""){
                    invaliemailMessage=invaliemailMessage+",";
              }
              invaliemailMessage=invaliemailMessage+emails[i];
          }
         }
        var  duplicateEmail=checkDuplicate(emails);
                 if(duplicateEmail){

                      duplicateEmailMessage="Emails cannot be duplicate";
                }
         }else{               
            if($.trim($('#userReferral_email').val()).length == 0 && ($('#userReferral_message').text() == "")){
                errormessage="Please Enter Email <br/> Please Enter Message";
            }else if($.trim($('#userReferral_email').val()).length == 0 ){
                errormessage="Please Enter Email";
            }else if($('#userReferral_message').text() == "" ){
                errormessage="Please Enter Message";
            }
            
            
         }

         if(invalidmails >1 && invaliemailMessage!=""){
           invaliemailMessage=invaliemailMessage+ " are invalid emails";
           }else if(invalidmails==1 && invaliemailMessage!="" ){
           invaliemailMessage=invaliemailMessage+ " is invalid email"
           }
          
//            if (emails.length > 0) {
////                if (OriginalEmails.length != emails.length) {
////                 errormessage = "Please enter valid Email";
////                }
//            } else {
//
//                 errormessage = "Please enter Email";
//            }

        if(errormessage=="" && invaliemailMessage=="" && duplicateEmailMessage=="" ){
            $('#Referral_errmsg').html("");
            $('#Referral_errmsg').hide();
            var queryString = "Emails=" +emails+"&Message=" + message;
          
             scrollPleaseWait("referral_user_spinner");
            ajaxRequest("/user/sendreferralEmail", queryString, function(data) {
             sendreferralEmailHandler(data);
            });
        }else{

            if(errormessage!=""){

                errMsg=errormessage;

            }else if(invaliemailMessage!=""){

                errMsg=invaliemailMessage;
            }else if(duplicateEmailMessage!=""){

                errMsg=duplicateEmailMessage;
            }


            $('#Referral_errmsg').html(errMsg);
            $('#Referral_errmsg').show();
             $("#Referral_errmsg").fadeOut(3000, "");
        }
    }
    function IsValidEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }

   function sendreferralEmailHandler(data){
     scrollPleaseWaitClose("referral_user_spinner");
     if(data.status="success"){
         
            $('#Referral_sucmsg').html(data.sucmsg);
            $('#Referral_sucmsg').show();
            $('#Referral_errmsg').html("");
            $('#Referral_errmsg').hide();
            $('#userReferral_email').val("");
            // $('#userReferral_message').val("");
            if(data.errmsg!=""){
                $("#Referral_errmsg").html(data.errmsg);
                $('#Referral_errmsg').show();
                $("#Referral_errmsg").fadeOut(5000, "");
            }else{
                $("#userReferral_message").html(" ");
                $("#userReferral_message").addClass("referrerplaceholder");
                $("#Referral_sucmsg").fadeOut(3000, "");
            }
            
             setTimeout(function(){
                    $("#myModal").modal('hide');
                },6000)
      
     }else{
         if(data.sucmsg!=""){
                $("#Referral_sucmsg").html(data.errmsg);
                $('#Referral_sucmsg').show();
                $("#Referral_sucmsg").fadeOut(3000, "");
            }
            $('#Referral_sucmsg').html("");
            $('#Referral_sucmsg').hide();
            $('#Referral_errmsg').html(data.errmsg);
            $('#Referral_errmsg').show();
            $("#Referral_errmsg").fadeOut(5000, "");
     }
   }
   
   function CancelUserReferrals(){
      $('#userReferral_email').val("");
      //$('#userReferral_message').val("");
      $("#userReferral_message").html(" ");
      $("#userReferral_message").addClass("referrerplaceholder");
      $("#myModal").modal('hide');
        $(".modal-dialog").removeClass('refer_modal-dialog');
   }
   
   
    function checkDuplicate (reportRecipients) {
        var recipientsArray = reportRecipients,
            textHash = {};
        for(var i=0; i<recipientsArray.length;i++){
            var key = $.trim(recipientsArray[i].toLowerCase());
          //  console.log("lower:" + key);
            if(textHash[key]){
                //alert("duplicated:" + key);
                return true;
            }else{
                textHash[key] = true;
            }
        }
       // alert("no duplicate");
        return false;
    }
function CleanArray(actual)
{
    var newArray = new Array();
    for(var i = 0; i<actual.length; i++)
    {
        if ($.trim(actual[i]))
        {
            newArray.push($.trim(actual[i]));
        }
    }
    return newArray;
}
function expanddiv(id){
   // alert(id
    var message= $.trim($('#userReferral_message').text())
    if(message.length>0){
        $("#"+id).animate({"min-height": "70px", "max-height": "200px"}, "fast");
       // $("#button_block").slideDown("fast");
        $("#"+id).removeClass("referrerplaceholder");
    }else{
         $("#"+id).addClass("referrerplaceholder");
    }
    
        return false;

}
//end referral js

//DSN -related start
function  getTopics(){//alert("hello");
    var queryString = {topics:true};
    ajaxRequest("/disease/categoriesdetails", queryString, TopicsResultHandler,"html");   
}
function TopicsResultHandler(data){//alert(data);
    $( "#topicsListDiv" ).html(
   data
); 

}

function  getGroups(startLimit)
{
    var queryString = {startLimit:startLimit};
    ajaxRequest("/disease/GetUserGroupsLeftMenu", queryString, groupsLeftResultHandler,"html");   
}

function groupsLeftResultHandler(data){
    $( "#groupsListDiv" ).append(
   data
); 

}
function activateMenu(obj)
{

sessionStorage.objclicked=obj;
//alert('activate'+obj);
//var objclicked=getLocalStorage('objclicked');obj=objclicked;
//alert(localStorageObj);
    $(".topicsClassAdmin").removeClass("disease_topicssectiondiv_active");
    //$(".topicsClass").removeClass("disease_topicssectiondiv_active");
     //$(this).removeClass("disease_topicssectiondiv");
   if(obj!='undefined')
    $("#"+obj).addClass("disease_topicssectiondiv_active"); 
    //sessionStorage.objclicked='';
}

function getTopicPosts(categoryId,categoryName){
   $("#curbsideStreamDetailedDiv").hide();
   $("#curbsidePostCreationdiv").show();
     globalspace.previousStreamIds = "";
  //  alert(categoryId);
     scrollPleaseWait('categories_spinner');
    $(window).unbind("scroll");
    page = 1;
    isDuringAjax = false;
    g_curbside_categoryID = categoryId;
    $('#curbsidePostsDiv').empty();
    $('#CategoryPostsDiv').empty();
    $('li.curbside_category').removeClass('active');
    $('li.curbside_category b').hide();
     $('li.curbside_hashtag').removeClass('active');
    $('li.curbside_hastag b').hide();
     $('#curside_category_'+categoryId).css('display', '');
     $('#curside_category_list_'+categoryId).addClass('active');
    getCollectionData('/disease/getcurbsideposts', 'CategoryId='+g_curbside_categoryID+'&CategoryName='+categoryName+'&StreamPostDisplayBean', 'CategoryPostsDiv', 'No Posts found.', 'That\'s all folks!');
    $("#curbsidePostsDiv").hide();
    $("#CategoryPostsDiv").show();
     var queryString = "categoryId="+categoryId;
      $("#CurbsidePostForm_Category").val(categoryId);;
      $("#CurbsidePostForm_Category").prev().html(categoryName);

     var href="";
    
     if(sessionStorage.topicPageDisaplay==1){
         href="href=/disease/topics";
         var ondata="";
     }else{
          href="";
          var ondata="CloseFilterData('curside_category_list_"+categoryId+"','curside_category_"+categoryId+"')";
     }

     if($("#categoryClickedDiv")!=null && categoryName!=null && categoryName!="undefined" && categoryName!="")
     {
         $("#categoryClickedDiv").show();
       $("#categoryClickedDiv").html( "<a "+href+">"+categoryName+ "<i onclick="+ondata+" >X</i></a>");
      }
        sessionStorage.topicPageDisaplay = 0;
   ajaxRequest("/curbsidePost/trackFilterByCategory",queryString,function(data){});
 
 }
 
 function loginWithProvider(url,fromNetwork,providerLink)
 {
     document.cookie="fromNetwork="+fromNetwork;
     document.cookie="providerLink="+providerLink;
   //  localStorage.fromNetwork=fromNetwork;
     //localStorage.providerLink=providerLink;
     var queryString={fromNetwork:fromNetwork,providerLink:providerLink};
     window.location = url+"&fromNetwork="+fromNetwork+"&providerLink="+providerLink;
     //ajaxRequest(url,queryString,function(data){});
 }
 
 function followUnfollowTopic(categoryId,imgId,isTopic) {
    //g_groupId = groupId;    
    scrollPleaseWait('miniCurbsideCategory_spinner_modal');
    var actionType =$("#"+imgId).attr("data-action");
    var queryString = "categoryId=" + categoryId + "&actionType=" + actionType;
    ajaxRequest("/curbsidePost/followOrUnfollowCurbsideCategory",
            queryString,
            function(data) {
                followUnfollowTopicHandler(data, categoryId,imgId,isTopic)
            });
};


function followUnfollowTopicHandler(data,categoryId,imgId,isTopic) { 
  
    scrollPleaseWaitClose('miniCurbsideCategory_spinner_modal');
   
    if (data.status == "success") {
       
       var hashCountObj=null;
       if(isTopic==0)
           hashCountObj=$("#curbsidecategoryFollowresCount_" + categoryId);
       else
           hashCountObj=$("#leftmenuFollowersCount_" + categoryId);
    
        var hashCount = Number(hashCountObj.text());
        
        
        if ($("#"+imgId).attr("class") == "unfollow") {
             $("#"+imgId).attr("data-original-title", "Unfollow")
           $("#"+imgId).attr("class", "follow").attr("data-action", "unfollow");
         
           hashCountObj.text(++hashCount);
        } else {
              $("#"+imgId).attr("data-original-title", "Follow")
             $("#"+imgId).attr("class", "unfollow").attr("data-action", "follow");
          
            if(hashCount>0)
           hashCountObj.text(--hashCount);
        }
         
    }
    }
 
 
 function getOauthNetworks()
 {
    ajaxRequest("/common/GetOauthNetworks", "", getOauthNetworksHandler,"html");    
 }
 
 function getOauthNetworksHandler(data)
 {
   
     if(data!=0)
     {
         $("#oauthNetworksUL").html(data);
     }
 }
 
 function showNetworks(){
     // $("#networks").removeClass("networks_arrow_down").addClass("networks_arrow_up");

    $("#networks").toggleClass("networks_arrow_up");
    $("#network_logos").toggle();
  }
  
  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function loginOauthOnProvider(fromNetwork,providerLink,redirectUrl,streamId)
 {
    var queryString='streamId='+streamId;
          
    ajaxRequest("/disease/DeleteNeteworkInvite",queryString,function(data){
     
   },'');
    var split=redirectUrl.split("/site");
   window.open(split[0]+"?fromNetwork="+fromNetwork+"&providerLink="+providerLink,'_blank');
   
   //   window.open( url+"&fromNetwork="+fromNetwork+"&providerLink="+providerLink,'_blank');
     //localStorage.providerLink=providerLink;
   //  var queryString={fromNetwork:fromNetwork,providerLink:providerLink};
    
     //ajaxRequest(url,queryString,function(data){});
         }



 function setLocalStorage(k,v){

 var win = document.getElementById('localStorageIFrame').contentWindow;
    var obj = {
       key: k,
       value:v
    };
    // save obj in subdomain localStorage

    win.postMessage(JSON.stringify({key: k, method: "set", data: obj}), "*");

}

function getLocalStorage(k){

 var win = document.getElementById('localStorageIFrame').contentWindow;
    win.postMessage(JSON.stringify({key: k, method: "get"}), "*");
 
    window.onmessage = function(e) {
	
      if(e && e.data)
	{
            if(IsJsonString(e.data) && typeof (JSON.parse(e.data).name))
            {
               var key =JSON.parse(e.data).key;
    var value =JSON.parse(e.data).value;
   
    localStorage.setItem(key,value);
    if(key=='categoryName')
    {
      loadTopicsFromLocalStorage();  
    }   
    else if(key!='categoryId' && key!='categoryName' )
    {
      //  alert('before'+value);
     $("#"+value).addClass("disease_topicssectiondiv_active"); 
     activateMenu(value);
    }
		// sessionStorage.k=JSON.parse(e.data);
		 
		
            }
	}
	    };
           
            return localStorage.getItem(k);



}
function removeLocalStorage(k)
{ localStorage.k=''; 
 var win = document.getElementById('localStorageIFrame').contentWindow;
    win.postMessage(JSON.stringify({key:k, method: "remove"}), "*");


}


  

function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


function loadTopicsFromLocalStorage(categoryId,categoryName)
{
//     var categoryId= localStorage.getItem('categoryId');
//        localStorage.categoryId=categoryId;
//	if(localStorage.categoryId!='' && localStorage.categoryId!=undefined &&  localStorage.categoryId!='undefined' &&localStorage.categoryId!='null')		
//	{categoryId=JSON.parse(localStorage.categoryId).value;	
//            
         if(categoryId!="" && categoryId!='undefined' && categoryId!=undefined)
         {  
                 
		   	
//                var categoryName= localStorage.getItem('categoryName'); 
//                  categoryName=JSON.parse(localStorage.categoryName).value;	
                 //  categoryName=JSON.parse(localStorage.categoryName).name;
                    getTopicPosts(categoryId,categoryName);
                    
		removeLocalStorage(categoryId);
		removeLocalStorage(categoryName);	
		$(".topicsClassAdmin").removeClass("disease_topicssectiondiv_active");
              // $(".category_"+categoryId).attr("class","disease_topicssectiondiv disease_topicssectiondiv_active topicsClass category_"+categoryId);
                
                
         
          
         }
	//}
}
  
  //DSN related end
    
    function loadTopAds(position,page){
           var data ="";           
         var queryString = 'position=' + position+'&page=' + page;
         ajaxRequest("/advertisements/loadAds",queryString,function(data){loadAdsHandler(data,position,page)});
       } 
       function loadAdsHandler(data,position,page){
            if(data.htmlData!=0){
                 if(position=="top"){
               $("#loadTopAds").html(data.htmlData).show(); 
                  loadAds(0,data.loadAds,data.position);

           }
           if(position=="middle"){
               $("#loadMiddleAds").html(data.htmlData).show(); 
                loadMiddleAds(0,data.loadAds,data.position);
           }
            if(position=="bottom"){                
               $("#loadBottomAds").html(data.htmlData).show(); 
                loadBottomAds(0,data.loadAds,data.position);
              }  
            }
            }
    function loadAds(id, ads,position){
        
      var extension =ads[id].Type;
      var sourceType =ads[id].SourceType;
      var src='';
      var reDirectUrl='';
      var timeInterval='';
       var totalSize=ads.length;
       var AdId=0;  
       var currentHost=window.location.hostname;

       var axel = Math.random() + "";
       var num = axel * 1000000000000000000;
       $('#StreamBundleAds_' + position).hide();
       $('#AddServerAds_' + position).hide();
       $('#rightSideSectionSeperation3_' + position).hide();
    if (sourceType == "Upload") {
        $('#rightSideSectionSeperation3_' + position).show();
        if(extension=="swf"){          
           src=ads[id].Url;          
          reDirectUrl=ads[id].RedirectUrl;    
         
          
          timeInterval=ads[id].TimeInterval * 1000;          
          $('#aIdSwf_'+position).attr('data-adId', ads[id].id);
          $('#imgDiv_'+position).hide();
          $('#vd_id_'+position).hide();
          $('#swfId_'+position).attr('data', src);
          $('#swfTopDiv_'+position).show();
          if(ads[id].RedirectUrl!=null){
           //var domainurl = new URL(reDirectUrl).hostname;
           var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("aIdSwf_").removeAttr("target");    
              }else{
                  $("aIdSwf_").attr("target","_blank"); 
              }
           $('#aIdSwf_'+position).attr('href',reDirectUrl);   
           }else{
           $("aIdSwf_").removeAttr("href");
           $("aIdSwf_").removeAttr("target");    
           }
           var contentHeight = Number(ads[id].Height)+Number($('#contentDiv').height());
           $('#contentDiv').css('min-height', contentHeight);
           if(id >= (totalSize-1)){
            id=0; 
           }else{
          id++;              
           }
          } else if(extension=='mp4' || extension=='mov' ) {
              
               src=ads[id].Url;          
               timeInterval=ads[id].TimeInterval * 1000; 
               $('#vd_id_'+position).attr('data-adId', ads[id].id);
               $('#imgDiv_'+position).hide();
               $('#swfTopDiv_'+position).hide();
               if(ads[id].RedirectUrl!=null){
                     reDirectUrl=ads[id].RedirectUrl;                   
           var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#vd_id"+position).removeAttr("target");    
              }else{
                  $("#vd_id_").attr("target","_blank"); 
              }
              
           $('#vd_id_'+position).attr('href',reDirectUrl);   
           }else{
           $("#vd_id_"+position).removeAttr("href");
           $("#vd_id_"+position).removeAttr("target");    
           }
           
           if(id >= (totalSize-1)){
            id=0; 
           }else{
          id++;              
           }
               
              $("#vd_id_"+position).attr('data-adId', ads[id].id);              
             openOverlay(src,'videoPlay_'+position,'videoPlay_'+position,'','300','250');  
             $("#vd_id_"+position).show();
          }else{        
           src=ads[id].Url;          
           reDirectUrl=ads[id].RedirectUrl; 
           timeInterval=ads[id].TimeInterval * 1000;           
           $('#aId_'+position).attr('data-adId', ads[id].id);
          $('#swfTopDiv_'+position).hide();
          $('#vd_id_'+position).hide();
          $('#vd_id_'+position).hide();
          $('#imgDiv_'+position).attr('src',src);
          $('#imgDiv_'+position).show(); 
          $('#imgDiv_'+position).load(function(){
              if( this.complete ) {
                 setFooterPosition(); 
              }
          });
          
          
          if(ads[id].RedirectUrl!=null){
                   
          var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          
         // var domainurl = new URL(reDirectUrl).hostname;
          var parts=domain.split("www.")             
              if(parts==currentHost){
                    $('#aId_'+position).removeAttr("target");    
              }else{
                  $('#aId_'+position).attr("target","_blank"); 
              }
           $('#aId_'+position).attr('href',reDirectUrl);   
           }else{
           $('#aId_'+position).removeAttr("href");
           $('#aId_'+position).removeAttr("target");    
           }
           if (id >= (totalSize - 1)) {
                    id = 0;
            } else {
                id++;
            }


        }
    }else if(sourceType == "StreamBundleAds") {
      timeInterval = ads[id].TimeInterval * 1000;
      $('#StreamBundleAds_' + position).show();
      var htm=ads[id].StreamBundle;
       htm=htm.replace("<%RandomNumber%>", num);
      $('#StreamBundleAds_' + position).html(htm); 
       if (id >= (totalSize - 1)) {
                id = 0;
            } else {
                id++;
            }
    } 
     else if(sourceType == "AddServerAds") {
        timeInterval = ads[id].TimeInterval * 1000;
        reDirectUrl = ads[id].RedirectUrl;
        var clickTag = ads[id].ClickTag;
        var impressionTag = ads[id].ImpressionTag;
         impressionTag=impressionTag.replace("<%RandomNumber%>", num);
      $('#StreamBundleAds_' + position).html(htm);
        src = ads[id].Url;
        $('#AddServerAds_' + position).show();
        $('#InpressionImage_' + position).attr('src', impressionTag);
        $('#clickTagA_' + position).attr('href', reDirectUrl);
        var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
                var domain = matches && matches[1];
                var parts = domain.split("www.")
                if (parts == currentHost) {
                    $('#clickTagA_' + position).removeAttr("target");
                } else {
                    $('#clickTagA_' + position).attr("target", "_blank");
                }
        $('#clickTagImage_' + position).attr('src', src);
        $('#clickTagImage_' + position).attr('onclick', "GenzymeSquareClickTag('"+clickTag+"');");
         if (id >= (totalSize - 1)) {
                id = 0;
            } else {
                id++;
            }
    }
      
            if(totalSize>1){
                 setTimeout(function() {
                    loadAds(id, ads, position)
                }, timeInterval);
            }
           
        }
        
function GenzymeSquareClickTag(clicktag) {
   window.open(clicktag);
}
        
  function loadMiddleAds(id, ads,position){
        
     var extension =ads[id].Type;
      var src='';
      var reDirectUrl='';
      var timeInterval='';
       var totalSize=ads.length;
       var currentHost=window.location.hostname;
       var sourceType =ads[id].SourceType;
       $('#StreamBundleAds_' + position).hide();
       $('#AddServerAds_' + position).hide();
       $('#rightSideSectionSeperation3_' + position).hide();
    if (sourceType == "Upload") {
        
        $('#rightSideSectionSeperation3_' + position).show();
      if(extension=="swf"){
         
           src=ads[id].Url;          
           reDirectUrl=ads[id].RedirectUrl;    
           timeInterval=ads[id].TimeInterval * 1000;
          $('#aIdSwf_'+position).attr('data-adId', ads[id].id);
          $('#MimgDiv_'+position).hide();
          $('#vd_id_'+position).hide();
          $('#swfId_'+position).attr('data', src);
          $('#EMDswfTopDiv_'+position).attr('src', src);
          
          $('#swfTopDiv_'+position).show();
          if(ads[id].RedirectUrl!=null){
          var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#aIdSwf_"+position).removeAttr("target");    
              }else{
                  $('#aIdSwf_'+position).attr("target","_blank"); 
              }
           $('#aIdSwf_'+position).attr('href',reDirectUrl);   
           }else{
           $("aIdSwf_").removeAttr("href");
           $("aIdSwf_").removeAttr("target");    
           }
           var contentHeight = Number(ads[id].Height)+Number($('#contentDiv').height());
           $('#contentDiv').css('min-height', contentHeight);
           if(id >= (totalSize-1)){
            id=0; 
           }else{
          id++;              
           }
          }
      else if(extension=='mp4' || extension=='mov' ) {
              
               src=ads[id].Url;          
               timeInterval=ads[id].TimeInterval * 1000; 
               $('#vd_id_'+position).attr('data-adId', ads[id].id);
               $('#imgDiv_'+position).hide();
               $('#swfTopDiv_'+position).hide();
               if(ads[id].RedirectUrl!=null){
                     reDirectUrl=ads[id].RedirectUrl;                   
            var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#vd_id"+position).removeAttr("target");    
              }else{
                  $("#vd_id_").attr("target","_blank"); 
              }
              
           $('#vd_id_'+position).attr('href',reDirectUrl);   
           }else{
           $("#vd_id_"+position).removeAttr("href");
           $("#vd_id_"+position).removeAttr("target");    
           }
           
           if(id >= (totalSize-1)){
            id=0; 
           }else{
          id++;              
           }
               
              $("#vd_id_"+position).attr('data-adId', ads[id].id);              
             openOverlay(src,'videoPlay_'+position,'videoPlay_'+position,'','300','250');  
             $("#vd_id_"+position).show();
          }    
      else{
        
           src=ads[id].Url;          
           reDirectUrl=ads[id].RedirectUrl;    
           timeInterval=ads[id].TimeInterval * 1000;
           
            $('#MaId_'+position).attr('data-adId', ads[id].id);
            $('#swfTopDiv_'+position).hide();
            $('#vd_id_'+position).hide();
          $('#MimgDiv_'+position).attr('src',src);
          $('#MimgDiv_'+position).show();
          $('#MimgDiv_'+position).load(function(){
              if( this.complete ) {
                 setFooterPosition();
              }
          });
          if(ads[id].RedirectUrl!=null){
                var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#MaId_").removeAttr("target");    
              }else{
                  $('#MaId_'+position).attr("target","_blank"); 
              }
              
           $('#MaId_'+position).attr('href',reDirectUrl);   
           }else{
           $('#MaId_'+position).removeAttr("href");
           $('#MaId_'+position).removeAttr("target");    
           }
           if (id >= (totalSize - 1)) {
                    id = 0;
                } else {
                    id++;
                }
         
      }
    }
      else if(sourceType == "StreamBundleAds") {
       timeInterval = ads[id].TimeInterval * 1000;
      $('#StreamBundleAds_' + position).show();
      $('#StreamBundleAds_' + position).html(ads[id].StreamBundle);  
       if (id >= (totalSize - 1)) {
                id = 0;
            } else {
                id++;
            }
    } 
     else if(sourceType == "AddServerAds") {
        timeInterval = ads[id].TimeInterval * 1000;
        reDirectUrl = ads[id].RedirectUrl;
        var clickTag = ads[id].ClickTag;
        var impressionTag = ads[id].ImpressionTag;
        src = ads[id].Url;
        $('#AddServerAds_' + position).show();
        $('#InpressionImage_' + position).attr('src', impressionTag);
        $('#clickTagA_' + position).attr('href', reDirectUrl);
        var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
                var domain = matches && matches[1];
                var parts = domain.split("www.")
                if (parts == currentHost) {
                    $('#clickTagA_' + position).removeAttr("target");
                } else {
                    $('#clickTagA_' + position).attr("target", "_blank");
                }
        $('#clickTagImage_' + position).attr('src', src);
        $('#clickTagImage_' + position).attr('onclick', "GenzymeSquareClickTag('"+clickTag+"');");
         if (id >= (totalSize - 1)) {
                id = 0;
            } else {
                id++;
            }
    }
      
        if(totalSize>1){
         setTimeout(function(){loadMiddleAds(id,ads,position)},timeInterval);
     }
      
  } 
  function loadBottomAds(id, ads,position){
        
      var extension =ads[id].Type;
      var src='';
      var reDirectUrl='';
      var timeInterval='';
      var totalSize=ads.length;
      var currentHost=window.location.hostname;
    var sourceType =ads[id].SourceType;
    $('#StreamBundleAds_' + position).hide();
    $('#AddServerAds_' + position).hide();
    $('#rightSideSectionSeperation3_' + position).hide();
    if (sourceType == "Upload") {
        $('#rightSideSectionSeperation3_' + position).show();
      if(extension=="swf"){
         
           src=ads[id].Url;          
           reDirectUrl=ads[id].RedirectUrl;    
           timeInterval=ads[id].TimeInterval * 1000;
           $('#aIdSwf_'+position).attr('data-adId', ads[id].id);
          $('#BimgDiv_'+position).hide();
          $('#vd_id_'+position).hide();
          $('#swfId_'+position).attr('data', src);
          $('#swfTopDiv_'+position).show();
          if(ads[id].RedirectUrl!=null){
           var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#aIdSwf_").removeAttr("target");    
              }else{
                     $('#aIdSwf_'+position).attr("target","_blank"); 
              }
           $('#aIdSwf_'+position).attr('href',reDirectUrl);   
           }else{
           $("aIdSwf_").removeAttr("href");
           $("aIdSwf_").removeAttr("target");    
           }
           var contentHeight = Number(ads[id].Height)+Number($('#contentDiv').height());
           $('#contentDiv').css('min-height', contentHeight);
           if(id >= (totalSize-1)){
            id=0; 
           }else{
          id++;              
           }
          }
          
      else if(extension=='mp4' || extension=='mov' ) {
              
               src=ads[id].Url;          
               timeInterval=ads[id].TimeInterval * 1000; 
               $('#vd_id_'+position).attr('data-adId', ads[id].id);
               $('#imgDiv_'+position).hide();
               $('#swfTopDiv_'+position).hide();
               if(ads[id].RedirectUrl!=null){
                     reDirectUrl=ads[id].RedirectUrl;                   
           var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#vd_id"+position).removeAttr("target");    
              }else{
                  $("#vd_id_").attr("target","_blank"); 
              }
              
           $('#vd_id_'+position).attr('href',reDirectUrl);   
           }else{
           $("#vd_id_"+position).removeAttr("href");
           $("#vd_id_"+position).removeAttr("target");    
           }
           
           if(id >= (totalSize-1)){
            id=0; 
           }else{
          id++;              
           }
               
              $("#vd_id_"+position).attr('data-adId', ads[id].id);              
             openOverlay(src,'videoPlay_'+position,'videoPlay_'+position,'','300','250');  
             $("#vd_id_"+position).show();
          }
         
      else{
       
           src=ads[id].Url;          
           reDirectUrl=ads[id].RedirectUrl;    
           timeInterval=ads[id].TimeInterval * 1000;
           $('#BaId_'+position).attr('data-adId', ads[id].id);
             $('#swfTopDiv_'+position).hide();
             $('#vd_id_'+position).hide();
          $('#BimgDiv_'+position).attr('src',src);
          $('#BimgDiv_'+position).show();
          $('#BimgDiv_'+position).load(function(){
              if( this.complete ) {
                 setFooterPosition();
              }
          });
          if(ads[id].RedirectUrl!=null){
          var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
          var domain = matches && matches[1];
          var parts=domain.split("www.")
              if(parts==currentHost){
                    $("#BaId_").removeAttr("target");    
              }
              else{
                  $('#BaId_'+position).attr("target","_blank"); 
              }
           $('#BaId_'+position).attr('href',reDirectUrl);   
           }else{
           $('#BaId_'+position).removeAttr("href");
           $('#BaId_'+position).removeAttr("target");  
           }
           if (id >= (totalSize - 1)) {
                    id = 0;
                } else {
                    id++;
                }
      }
      
  }
  else if(sourceType == "StreamBundleAds") {
      timeInterval = ads[id].TimeInterval * 1000;
      $('#StreamBundleAds_' + position).show();
      $('#StreamBundleAds_' + position).html(ads[id].StreamBundle);  
       if (id >= (totalSize - 1)) {
                id = 0;
            } else {
                id++;
            }
    } 
     else if(sourceType == "AddServerAds") {
        timeInterval = ads[id].TimeInterval * 1000;
        reDirectUrl = ads[id].RedirectUrl;
        var clickTag = ads[id].ClickTag;
        var impressionTag = ads[id].ImpressionTag;
        src = ads[id].Url;
        $('#AddServerAds_' + position).show();
        
        $('#InpressionImage_' + position).attr('src', impressionTag);
        $('#clickTagA_' + position).attr('href', reDirectUrl);
        var matches = reDirectUrl.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
                var domain = matches && matches[1];
                var parts = domain.split("www.")
                if (parts == currentHost) {
                    $('#clickTagA_' + position).removeAttr("target");
                } else {
                    $('#clickTagA_' + position).attr("target", "_blank");
                }
        $('#clickTagImage_' + position).attr('src', src);
        $('#clickTagImage_' + position).attr('onclick', "GenzymeSquareClickTag('"+clickTag+"');");
         if (id >= (totalSize - 1)) {
                id = 0;
            } else {
                id++;
            }
    }
      if(totalSize>1){
       setTimeout(function(){loadBottomAds(id,ads,position)},timeInterval);    
      }
      
  } 
  
 function editAdvertisement(id){  
    var queryString = 'id='+id;  
   // $("#myModal_body").load("/advertisements/editAdvertisement",{id:id},editAdvertisementHandler);    
        ajaxRequest("/advertisements/editAdvertisement",queryString,editAdvertisementHandler);
}  
function editAdvertisementHandler(data){
 $("#myModal_bodyAd").html(data.htmlData);
 $("#myModalLabelAd").html("Edit Advertisement");
 $('#myModelDialogAd').css("width","640px");
 
    if ($('#bannerOptions :selected').val() != undefined && $('#bannerOptions :selected').val() == "ImageWithText") {
         $("#AdBannerTitle").remove();
         $("#AdBannerContent").remove();
        $("#titleBanner45").append($("#BannerTitleHidden").val());
        $("#contentBanner45").append($("#BannerContentHidden").val());
        $("#AdBannerTitle").attr("contentEditable", "true");
        $("#AdBannerContent").attr("contentEditable", "true");
  $('#AdBannerPreviewImage').attr('src', $("#AdvertisementForm_Url").val());
    }
 
  $("#myModalAd").modal('show');
   $('#myModalAd').on('hidden.bs.modal', function() {
               closeAdvertisement();
               $('#myModalAd').off('hidden.bs.modal');
                         
         });
  $("#myModal_footerAd").hide();
}

    function editAndSaveAdvertisementHandler(){        
        var data=eval(data);  
         if(data.status =='success'){   
              var msg=data.data;
            $("#sucmsgForAd").html(msg);
            $("#sucmsgForAd").css("display", "block");
           $("#errmsgForAd").css("display", "none");
            $("#advertisement-form")[0].reset();
           $("#sucmsgForAd").fadeOut(3000);
            $("#myModal_body").html('');
            $("#myModal").modal('hide');
         }
    }
    
  function showPreview(id,url,type,position,displayPage){
     var queryString = 'id='+id+'&url='+url+'&type='+type+'&position='+position+'&displayPage='+displayPage;        
         ajaxRequest("/advertisements/showPreview",queryString,showPreviewHandler);
  } 
  
  function showPreviewHandler(data){ 
      var type=data.type;
      var position =data.position;      
      $("#myModal_body").html(data.htmlData);          
      if(type=="swf"){
          $('#swfTopDiv').show(); 
          $('#imgDiv_'+position).hide(); 
      }
      if(type=="mp4" || type=="mov"){
          $('#swfTopDiv').hide(); 
          $('#imgDiv_'+position).hide();
           openOverlay(data.url,'videoPlay_'+position,'videoPlay_'+position,'','','');  
           $('#videoPlay_'+position).show(); 
      }
      $("#myModalLabel").html("Advertisement Preview")
      $('#myModelDialog').css("width","auto");
     $("#myModal").modal('show');
     
      $("#myModal_footer").hide();
  }
  

  function showStreamAdPreview(id){
     var queryString = '&id='+id; 
         ajaxRequest("/advertisements/getaddview",queryString,showStreamAdPreviewHandler);
  } 
  
  function showStreamAdPreviewHandler(data){ 
      $("#myModal_body").html(data.htmlData);          
//      if(type=="swf"){
//          $('#swfTopDiv').show(); 
//          $('#imgDiv_'+position).hide(); 
//      }
//      if(type=="mp4" || type=="mov"){
//          $('#swfTopDiv').hide(); 
//          $('#imgDiv_'+position).hide();
//           openOverlay(data.url,'videoPlay_'+position,'videoPlay_'+position,'','','');  
//           $('#videoPlay_'+position).show(); 
//      }
      $("#myModalLabel").html("Advertisement Preview")
      $('#myModelDialog').css("width","auto");
     $("#myModal").modal('show');
     
      $("#myModal_footer").hide();
  }
  

  function showStreamAdPreview(id){
     var queryString = '&id='+id; 
         ajaxRequest("/advertisements/getaddview",queryString,showStreamAdPreviewHandler);
  } 
  
  function showStreamAdPreviewHandler(data){ 
      $("#myModal_body").html(data.htmlData);          
//      if(type=="swf"){
//          $('#swfTopDiv').show(); 
//          $('#imgDiv_'+position).hide(); 
//      }
//      if(type=="mp4" || type=="mov"){
//          $('#swfTopDiv').hide(); 
//          $('#imgDiv_'+position).hide();
//           openOverlay(data.url,'videoPlay_'+position,'videoPlay_'+position,'','','');  
//           $('#videoPlay_'+position).show(); 
//      }
      $("#myModalLabel").html("Advertisement Preview")
      $('#myModelDialog').css("width","auto");
     $("#myModal").modal('show');
     
      $("#myModal_footer").hide();
  }
  
  function trackAd(obj){      //alert("---");     
      var adId=$(obj).data('adid');          
      var queryString = 'adId='+adId;  
      var href=$(obj).attr('href');  
      var type=$(obj).data('type');
      var target=$(obj).attr('target');        
      if(type=="swf"){
      // window.open(href,target);      
      }
    
         ajaxRequest("/advertisements/trackAdvertisement",queryString,showPreviewHandler);
      
  }




  function editPersonalInformationDiv(type){      
     $('.editProfile'+type).hide();   
     $('#editProfile'+type).show();   
     $('#editProfile'+type+'Text').focus();
  }
 function saveEditPersonalInformation(field){         
   var value= $.trim($("#editProfile"+field+"Text").val());          
   var queryString = "value=" + value +  "&field=" + field;
   ajaxRequest("/user/updatePersonalInformationByType", queryString, saveEditPersonalInformationHandler);
 } 
 
 function saveEditPersonalInformationHandler(data){
     var type=data.type;
     var value=data.value;
     $('.editProfile'+type).html(value);
     $('.editProfile'+type).show();       
     $('#editProfile'+type).hide();
     if(value!=''){
      $('.editProfile'+type).removeClass(type+'placeholder');
     }else{
      $('.editProfile'+type).addClass(type+'placeholder');   
     }
     if(type=='DisplayName'){         
         $('.cvtitle').html(value+"'s CV");
         $('#ProfileInteractionsDisplayName').html(value+"'s Recent Interactions");
         
     }
 }
 
 function closeEditPersonalInformation(type){
     $('.editProfile'+type).show();   
     $('.editProfile'+type).html($('.editProfile'+type).text());
     $("#editProfile"+type+"Text").val($('.editProfile'+type).text());
     $('#editProfile'+type).hide();   
 }
 
function initializationAtMentionsForCV(inputor){
    var inputorId = $(inputor).attr('id');
    
    if(!globalspace['cv_mention_'+inputorId]){
        globalspace['cv_mention_'+inputorId]=new Array();
         globalspace['cv_mention_Username_'+inputorId]=new Array();
    }
    var cv_at_mention_config = {
         at: "@",
         callbacks: {
               remote_filter: function (query, callback) {
                    if(typeof globalspace['cv_mention_'+inputorId] == 'undefined'){
                        
                        globalspace['cv_mention_'+inputorId]=new Array();
                         globalspace['cv_mention_Username_'+inputorId]=new Array();
                     }
                  var data = {searchKey:query,existingUsers:JSON.stringify(globalspace['cv_mention_'+inputorId])};
                  ajaxRequest("/post/getnetworkusers",data,callback);
               },
                 before_insert: function(value, $li){
                     
                     
                     var InvitedUserId = Number($li.attr('data-user-id'));
                     var authorsCount = $("#"+inputorId+"_currentMentions>span.dd-tags").length;
                if(authorsCount<5){
                     globalspace['cv_mention_'+inputorId].push(InvitedUserId);
                     var name=$li.attr('data-value').split(',');
                   //  var UserName=name[0].substring(1);
                  
                       globalspace['cv_mention_Username_'+inputorId].push(name[0]);
                     $(inputor+'_currentMentions').append("<span class='dd-tags hashtag' data-user-id="+InvitedUserId+"><b>"+$li.attr('data-value')+"</b><i data-name='"+name[0]+"' onclick='deleteInvitedAtMentionForCV(this, \"cv_mention_Username_"+inputorId+"\", "+InvitedUserId+")'>X</i></span>")
                 }else{
           
                    $('.interests').css('height','130px');
                   $("#"+inputorId+"_error").html("You can enter maximum of 5 Authors.").show().fadeOut(10000);
                    setTimeout(function() { // waiting for 1 sec ... because it is very fast, so that's why we have to forcely wait for a sec.
                               $('.interests').css('height', '');

                           }, 8000);
               }                
                     return "";
                 },
                  matcher: function(flag, subtex) {
                    flag = '@';
                    subtex = flag+$.trim(subtex);
                    var match, regexp;
                    flag = flag.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                    
                    regexp = new RegExp(flag + '([A-Za-z0-9_\+\-]*)$|' + flag + '([^\\x00-\\xff]*)$', 'gi');
                    match = regexp.exec(subtex);
                    if (match) {
                      return match[1].length>=3?match[1]:null;
                    } else {
                      return null;
                    }
                  }
             
           },
           
         tpl:"<li data-value='${DisplayName}' data-user-id=${UserId}><div class='d_name'>${DisplayName}</div> <i class='d_n_border'><img src='${profile45x45}'  /></i></li>",      
         //insert_tpl: "<span class='at_mention dd-tags' data-user-id=${UserId}><b>@${DisplayName}</b><i onclick='removeAtMentionForCV(this)'>X</i></span>",
         search_key: "DisplayName",
         show_the_at: true,
         limit: 50
     }
    $(inputor).atwho(cv_at_mention_config);
    
}
function deleteInvitedAtMentionForCV(obj, arrayId, userId){

  $(obj).parent('span.dd-tags').remove();
//    var i =  globalspace[arrayId].indexOf($(obj).attr('data-name'));
//
//        if(i > -1) {
//                globalspace[arrayId].splice(i, 1);
//                 
//        }
        
       globalspace[arrayId] = $.grep(globalspace[arrayId], function(value) {
  return value != $(obj).attr('data-name');
});   
    
}
  function loadExternalDocumentViewer(id, uri, options,videoImage,height,width){ 
    $('.'+id).empty();
    var format = (/[.]/.exec(uri)) ? /[^.]+$/.exec(uri) : undefined;
    format = format.toString().toLowerCase();
     uri=uri;
     var style="style='width:1000px; height:480px;'";
      if(detectDevices()){ 
      style="style='width:300px; height:480px;'";
      }
    if(format == "pdf" || format == "ppt" || format == "txt" || format == "doc" || format == "docx" || format == "xls" || format == "xlsx"){ 
        var url = '<iframe src="https://docs.google.com/gview?url='+uri+'&embedded=true" '+style+' frameborder="0"></iframe>';
        $('.'+id).html(url);
     }
     }


function setFooterPosition(){
    if (Number($('#sidebarnavrightId').height()) > 800) {
        $('#contentDiv').css('min-height', Number($('#sidebarnavrightId').height()) + 100);
    }else if(Number($('#menu_bar>ul#menu').height()) > 800){
        $('#contentDiv').css('min-height', Number($('#menu_bar>ul#menu').height()) + 100);
    }
}
function getAdPreview(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id){
    if(typeof globalspace.previousStreamIds == "undefined" ){
        globalspace.previousStreamIds = "";
    }
    var newURL = URL+"?"+CollectionName+"_page="+page; 
    var data = {previousStreamIds:globalspace.previousStreamIds};
    ajaxRequest(newURL,data,function(data){getCollectionDataHandler(data,URL,CollectionName,MainDiv,NoDataMessage,NoMoreDataMessage,id)},"html");
}

function getAdPreview(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id){
    if(typeof globalspace.previousStreamIds == "undefined" ){
        globalspace.previousStreamIds = "";
    }
    var newURL = URL+"?"+CollectionName+"_page="+page; 
    var data = {previousStreamIds:globalspace.previousStreamIds};
    ajaxRequest(newURL,data,function(data){getCollectionDataHandler(data,URL,CollectionName,MainDiv,NoDataMessage,NoMoreDataMessage,id)},"html");
}




function getJsonObjectForNode(){    
    ObjectA = {PF1:pF1,PF2:pF2,PF3:pF3,PF4:pF4,PF5:pF5,sCountTime:socialActionIntervalTime,storiesTime:postIntervalTime,uniquekey:sessionStorage.old_key,pageName:gPage,notTime:notificationTime};
    return JSON.stringify(ObjectA); 
}



function getFeacturedItemTitle(){
    var modelType = 'info_modal';
        var title = 'Post Featured Item';
        var content = "<label>Featured Item Title<label> \
                       <input class='textfield span3' type='text' id='featured_Item_title' maxlength='100' />\n\
                       <div class='control-group controlerror'> <div style='display: none;' id='featured_item_error' class='errorMessage'>Featured Item Title cannot be blank</div> </div>";
        var closeButtonText = 'Close';
        var okButtonText = 'Submit';
        var okCallback = setFeacturedItemTitle;
          $('#newModal').on('hidden.bs.modal', function() {
            $('.iisfeatured').val(0);
            $("#isfeaturedI").removeClass('featureditemenable').addClass('featureditemdisable');
            $("#isfeaturedI").attr('data-original-title','Mark as Featured');
            $('#newModal').off('hidden.bs.modal');
         });
         openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, '');
}

function setFeacturedItemTitle(){
     if($("#featured_Item_title").val()==""){
        
        $("#featured_item_error").show();
        $("#featured_item_error").fadeOut(5000);
    }
    else{
       $("#FeaturedTitleHidden").val($("#featured_Item_title").val());
       $('#newModal').off('hidden.bs.modal');
       closeModelBox();
    }
   
}
function checkSession()
{  
    $.ajax({
        dataType: 'json',    
        type: "POST",
        url: "/user/checkSession",   
        async: false,
        success: function(data) {       
        checksessioncallback(data);
     
          
        }});
 
}
function checksessioncallback(data){
     if(data.code==440){
         isUserSessionValid= "no";  
       }         
       else{
           isUserSessionValid= "yes";
       } 
}
