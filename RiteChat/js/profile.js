
function displayErrorForBannerAndLogo12(message) {

    $('#ProfileImageError').html(message);
    $('#ProfileImageError').css("padding-top:20px;");
    $('#ProfileImageError').show();
    $('#ProfileImageError').fadeOut(6000)

}

function editProfileHandler(data, txtstatus, xhr)
{
    if (data.status == 'success')
    {
        var msg = data.data;
        $("#sucmsgForProfile").html(msg);
        $("#errmsgForProfile").css("display", "none");
        $("#sucmsgForProfile").css("display", "block");
        $("#sucmsgForProfile").fadeOut(5000);
        $("#editButtonId").show();
        viewProfileDetails();
    }
    else
    {
        var msg = data.data;
        $("#errmsgForProfile").html(msg);
        $("#sucmsgForProfile").css("display", "none");
        $("#errmsgForProfile").css("display", "block");
        $("#errmsgForProfile").fadeOut(5000);
    }
}
function renderProfilePostDetailPage(showDivId, hideDivId, postId, categoryType, postType) {
    if(categoryType == 9  && postType == 12){
        window.location="/"+gameName+"/"+scheduleGameId+"/"+gameMode+"/"+"game";
    }
    var URL = "/post/renderPostDetailed?postId=" + postId + "&categoryType=" + categoryType + "&postType=" + postType+"&page=profile" ;
    var data = "";
    ajaxRequest(URL,data,function(data){renderProfilePostDetailPageHandler(data,showDivId, hideDivId)},"html");

}
function renderProfilePostDetailPageHandler(html,showDivId, hideDivId){   
      $('body, html').animate({scrollTop : 0}, 0);
            $("#" + showDivId).html(html).show();
            $("#" + hideDivId).hide();

            $('.PostdetailvideoThumnailDisplay').css({"padding-top":"85px","padding-left":"85px"});

          //  alert(html)
//

}
function profileInitializationEvents(){
    
    $("#ProfileInteractionDiv  a.userprofilename").live("click",
        function() {
            var userId = $(this).attr('data-id');
            getMiniProfile(userId);
             trackEngagementAction("ProfileMinPopup",userId);
        }
    );
    $("#ProfileInteractionDiv  a.smallprofileicon.profileImage").live("click",
        function() {
            var userId = $(this).attr('data-id');
            getMiniProfile(userId);
             trackEngagementAction("ProfileMinPopup",userId);
        }
    );
    
    //for mentions
    $("#ProfileInteractionDiv span.at_mention").live("click",
        function() {
            var userId = $(this).attr('data-user-id');
            getMiniProfile(userId);
             trackEngagementAction("MentionMinPopup",userId);
        }
    );
    $("#ProfileInteractionDiv  span.hashtag>b").live("click",
        function() {
            var hashTagName = $(this).text();
            var hashId = $(this).attr("data-id");
            getHashTagProfile(hashTagName,hashId);
        }
    );
    $("#ProfileInteractionDiv a.curbsideCategory").live("click",
        function() {
            var categoryId = $(this).attr('data-id');
            getMiniCurbsideCategoryProfile(categoryId);
            trackEngagementAction("CurbCategoryMinPopup",'',categoryId);
        }
    );
     $(".profileboxsection  span.hashtag>b").live("click",
        function() {
            var hashTagName = $(this).text();
            var hashId = $(this).attr("data-id");
            getHashTagProfile(hashTagName,hashId);
        }
    );
    $(".profileboxsection a.curbsideCategory").live("click",
        function() {
            var categoryId = $(this).attr('data-id');
            getMiniCurbsideCategoryProfile(categoryId);
            trackEngagementAction("CurbCategoryMinPopup",'',categoryId);
        }
    );
    $(".profileview").live("click",
        function(event) {
            //var userId = $(this).attr('data-id');
            viewProfileDetails();
        }
    );
    $("#ProfileInteractionDiv img.unlikes").live("click",
            function() {
                var postId = $(this).closest('div.social_bar').attr('data-postid');
                var postType = $(this).closest('div.social_bar').attr('data-postType');
                var categoryType = $(this).closest('div.social_bar').attr('data-categoryType');
                var loveCnt = Number($(this).parent('i').next('b').text());
                var streamId = $(this).closest('div.social_bar').attr('data-id');
                loveCnt++;
                $(this).parent('i').next('b').text(loveCnt);
                loveToPost(postType, postId, categoryType,streamId);
                $(this).attr({
                    "class": "likes"
                });
                 trackEngagementAction("Love",postId,categoryType,postType);
            }
    );
    $("#ProfileInteractionDiv .postdetail").live("click",
        function(event) { 
            if($(event.target).parent('span.at_mention').length || $(event.target).parent('span.hashtag').length  || $(event.target).parent('a.groupIntroDetails').length || $(event.target).parent('a.userprofilename').length){
                return false;
            }
            var streamId = $(this).attr('data-id');
            g_streamId = streamId;
            var postId = $(this).closest('div.post.item').attr('data-postid');
            var categoryType = $(this).closest('div.post.item').attr('data-categoryType');
            var postType = $(this).closest('div.post.item').attr('data-postType');
            var gameScheduleId = $(this).closest('div.post.item').attr('data-scheduleId');
            var gameName = $(this).closest('div.post.item').attr('data-gameName');
            g_pageType = "profilePage";
            if (postId != undefined && postId != "") {
                if(categoryType == 8){
                    renderNewsDetailedPage('admin_PostDetails','contentDiv',postId,postId,categoryType,postType);
                }
                else if(categoryType == 9 && postType == 12){
                    window.location="/"+gameName+"/"+gameScheduleId+"/details/game";
                }
                else{
                    renderProfilePostDetailPage('postDetailsDivInProfile', 'profileDetailsDiv', postId, categoryType, postType);
                }
         
               trackEngagementAction("PostDetailOpen",postId,categoryType,postType);
            }
             if(!detectDevices()){
                $("[rel=tooltip]").tooltip();
             }
        }
    );

    $("#ProfileInteractionDiv  img.follow").live("click",
        function() {
            var categoryType = $(this).closest('div.social_bar').attr('data-categoryType');            
            var postId = $(this).closest('div.social_bar').attr('data-postid');
            var postType = $(this).closest('div.social_bar').attr('data-postType');
            var streamId = $(this).closest('div.social_bar').attr('data-id');
            var followCnt = Number($(this).parent('i').parent('a').find('b').text());
            followCnt = Number(followCnt) - 1;
            $(this).parent('i').parent('a').find('b').text(followCnt);
            followOrUnfollowPost(postType, postId, "UnFollow", categoryType);
              $(this).attr('data-original-title','Follow');
            $(this).attr({
                "class": "unfollow"
                //"title": "Follow"
            });
             trackEngagementAction("UnFollow",postId,categoryType,postType); 
        }
    );
    $("#ProfileInteractionDiv img.unfollow").live("click",
        function() {
            var categoryType = $(this).closest('div.social_bar').attr('data-categoryType');
            var postId = $(this).closest('div.social_bar').attr('data-postid');
            var postType = $(this).closest('div.social_bar').attr('data-postType');
            var followCnt = Number($(this).parent('i').parent('a').find('b').text());
            followCnt = Number(followCnt) + 1;
            $(this).parent('i').parent('a').find('b').text(followCnt);
            followOrUnfollowPost(postType, postId, "Follow", categoryType);
              $(this).attr('data-original-title','Unfollow');
            $(this).attr({
                "class": "follow"
               // "title": "Unfollow"
            });
             trackEngagementAction("Follow",postId,categoryType,postType);
        }
    );
    $window.resize(function() {
        applyLayout();
    });    
}

function applyLayout() {

    //alert("df"+$window.width())
    options.container.imagesLoaded(function() {
        // Create a new layout handler when images have loaded.
        handler = $('#ProfileInteractionDiv li.woomarkLi');
        // alert($window.width())
        if ($window.width() < 753) {

            options.itemWidth = '100%';
            options.flexibleWidth = '100%';

        }
        else if ($window.width() > 753 && $window.width() < 1000) {
            //alert("df"+$window.width())
            options.itemWidth = '23%';
            //   options = { flexibleWidth: '100%' };


        } else {

            options.itemWidth = '23%';
        }
        //alert(options.toSource());
        handler.wookmark(options);

    });
}
function inlineEditProfileHandler(data, txtstatus, xhr)
{   
    scrollPleaseWaitClose('profileUpdateSpinLoader');
       var data=eval(data); 
    if (data.status == 'success')
    {
        var msg = data.data;
        $('#'+globalspace.currentDiv).hide();
        $('#'+globalspace.currentDiv).prev().show();
        $("#DisplayName").html($("#ProfileDetailsForm_DisplayName").val());       
        $(".myprofileicon").attr('data-original-title',$("#ProfileDetailsForm_DisplayName").val())
        $("#UserDisplayName").html($("#ProfileDetailsForm_DisplayName").val());        
        $("#Speciality").html($("#ProfileDetailsForm_Speciality").val());
        $("#Company").html($("#ProfileDetailsForm_Company").val());
        $("#Position").html($("#ProfileDetailsForm_Position").val());
        $("#School").html($("#ProfileDetailsForm_School").val());
        $("#Degree").html($("#ProfileDetailsForm_Degree").val());
        $("#Years_Experience").html($("#ProfileDetailsForm_Years_Experience").val());
        $("#Highest_Education").html($("#ProfileDetailsForm_Highest_Education").val());
    }
    else
    {
        $("#errmsgForProfile").html("Name cannot be blank");
                    $("#errmsgForProfile").css("display", "block");
                    $("#sucmsgForProfile").css("display", "none");
                    $("#errmsgForProfile").fadeOut(5000);
        
        
    }
}
var tpage=0;
var tFPopupAjax = false;
function getUserProfileFollowers(userId,displayName){
    if(tpage == 0){
        $("#userFollowersFollowings_body").empty();
    }
 scrollPleaseWait('userFollow_spinner'); 
    var queryString = "userId="+userId+"&page="+tpage;  
    ajaxRequest("/user/GetUserFollowers",queryString,function(data){getUserProfileFollowersHandler(data,displayName,userId);},"html");
  
}
function getUserProfileFollowersHandler(html,displayName,userId){
    scrollPleaseWaitClose('userFollow_spinner');
  
     var jscroll = $('#userFollowersFollowings_body').jScrollPane({});
        var api = jscroll.data('jsp');
        api.destroy();
    isDuringAjax=true;
    $(".NPF,.ndm").remove();
    $("#userFollowersFollowingsLabel").addClass("stream_title paddingt5lr10");
    $("#userFollowersFollowingsLabel").html(displayName+"'s" +"&nbsp followers");
    $("#userFollowersFollowings_footer").hide();
    $(".modal-content").attr({'style':'max-height:400px'});
    $("#userFollowersFollowings").modal('show');

    if(html != 0){
        $("#userFollowersFollowings_body").addClass("scroll").html(html).attr({'style':'max-height:230px;'});   
  
    }
    if($('#userFollowUnfollowid div.span4').length>=15){
     $("#userFollowersFollowings_body").jScrollPane({autoReinitialise: true, autoReinitialiseDelay: 200, stickToBottom: false});

        $("#userFollowersFollowings_body").bind('jsp-scroll-y', function(event, scrollPositionY, isAtTop, isAtBottom)
        {
            if (isAtBottom && tFPopupAjax == false) {      
                tpage++;
                tFPopupAjax=true;
               loadUserProfileFollowers(userId,displayName);
            }


        }
        );
    }
}
function loadUserProfileFollowers(userId,displayName){
     var queryString = "userId="+userId+"&page="+tpage;
    ajaxRequest("/user/GetUserFollowers",queryString,function(data){loadUserProfileFollowersHandler(data,displayName,userId);},"html");

}
function loadUserProfileFollowersHandler(html,displayName,userId){ //alert(html);
    scrollPleaseWaitClose('userFollow_spinner');
    isDuringAjax=true;
        if(html==0){  
           tFPopupAjax =true;
        }else{
         $(".jspPane").append(html); 
         tFPopupAjax =false;
        }

}
function getUserProfileFollowing(userId,displayName){

 if(tpage == 0){
        $("#userFollowersFollowings_body").empty();
    }
 scrollPleaseWait('userFollow_spinner');
    var queryString = "userId="+userId+"&page="+tpage;
    ajaxRequest("/user/GetUserFollowing",queryString,function(data){getUserProfileFollowingHandler(data,displayName,userId);},"html");
}

function getUserProfileFollowingHandler(html,displayName,userId){
    
    
     scrollPleaseWaitClose('userFollow_spinner');
      var jscroll = $('#userFollowersFollowings_body').jScrollPane({});
        var api = jscroll.data('jsp');
        api.destroy();
    isDuringAjax=true;
    $(".NPF,.ndm").remove();
    $("#userFollowersFollowingsLabel").addClass("stream_title paddingt5lr10");
    $("#userFollowersFollowingsLabel").html(displayName+"'s" +"&nbsp following");
    $("#userFollowersFollowings_footer").hide();
    $(".modal-content").attr({'style':'max-height:400px'});
    $("#userFollowersFollowings").modal('show');    
   if(html != 0){
        $("#userFollowersFollowings_body").addClass("scroll").html(html).attr({'style':'max-height:230px;'});   
  
    }else if(tpage > 1){
        if(html==0){  
            tFPopupAjax =true;
        }else{
         $(".jspPane").append(html);    
        }
        
    }
    if($('#userFollowUnfollowid div.span4').length>=15){
$("#userFollowersFollowings_body").jScrollPane({autoReinitialise: true, autoReinitialiseDelay: 200, stickToBottom: false});
        $("#userFollowersFollowings_body").bind('jsp-scroll-y', function(event, scrollPositionY, isAtTop, isAtBottom)
        {
            if (isAtBottom && tFPopupAjax == false) {      
                tpage++;
                 tFPopupAjax=true;
                loadUserProfileFollowing(userId,displayName);
            }


        }
        );
    }

}
function loadUserProfileFollowing(userId,displayName){
     var queryString = "userId="+userId+"&page="+tpage;
    ajaxRequest("/user/GetUserFollowing",queryString,function(data){loadUserProfileFollowingHandler(data,displayName,userId);},"html");

}
function loadUserProfileFollowingHandler(html,displayName,userId){ //alert(html);
    scrollPleaseWaitClose('userFollow_spinner');
    isDuringAjax=true;
        if(html==0){  
           tFPopupAjax =true;
        }else{
         $(".jspPane").append(html); 
         tFPopupAjax =false;
        }

}
function responseUserFollowers(data){
    scrollPleaseWaitClose('userFollow_spinner');
}

