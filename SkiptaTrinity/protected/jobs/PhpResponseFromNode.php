<?php

class PhpResponseFromNode {

    public function htmlResponse($arg1) {
        try {
            if (isset($arg1)) {
                $htmlsub = "";
                $i = 0;
                $createdDate = "";
                $arraysize = sizeof($arg1);
                foreach ($arg1 as $rw) {
                    if ($i == 0) {
                        $createdOn = $rw['CreatedOn'];
//                        echo "====createdON===$createdOn->sec";
                        $createdDate = $createdOn->sec;
                    }
                    $postType = CommonUtility::postTypebyIndex($rw['PostType']);
                    $totalPostTyp5 = "";
                    $time = '<i>' . $rw['PostOn'] . '</i>';
                    if ($rw['PostType'] == 5) {
                        $curbTitle = $rw['CurbsideConsultTitle'];

                        $span = '<span class="pull-right">' . $rw['CurbsideConsultCategory'] . '</span>';
                        $totalPostTyp5 = $curbTitle . $time . $span;
                    } else {
                        $totalPostTyp5 = $time;
                    }
                    $textWithOutHtml = strip_tags($rw['PostText']);

                    if (strlen($textWithOutHtml) <= 240) {
                        $text = $rw['PostText'];
                    } else {
                        $stringArray = str_split($textWithOutHtml, 240);
                        $text = $stringArray[0] . '  ...';
                    }
                    $htmlsub .= '<div class="stream_widget marginT10">
   	 <div class="profile_icon"><img src="' . $rw['FirstUserProfilePic'] . '"/></div>
             <div class="post_widget" data-postid="' . $rw['PostId'] . '" data-postType="' . $rw['PostType'] . '">'
                            . '<div class="stream_msg_box">';
                    $imagePath = "";
                    if ($rw['IsMultiPleResources'] > 0) {
                        $imagePath = $rw['ArtifactIcon'];
                    }
                    $imgDiv = "";

                    if (!empty($imagePath) && $rw['IsMultiPleResources'] == 1) {
                        $imgDiv = '<a  class="pull-left img_single"><img src="' . $imagePath . '"  ></a>';
                    } else if (!empty($imagePath) && $rw['IsMultiPleResources'] > 1) {
                        $imgDiv = '<a  class="pull-left img_more"><img src="' . $imagePath . '"  ></a>';
                    }
                    if ($rw['PostType'] != 3) {
                        $htmlsub .= '<div class="stream_title paddingt5lr10"> <a class="userprofilename" data-id="' . $rw['FirstUserId'] . '" style="cursor:pointer"><b>' . $rw['FirstUserDisplayName'] . '</b></a>' . $rw['SecondUserData'] . ' ' . $rw['StreamNote'] . ' ' . $rw['PostBy'] . ' ' . $postType . $totalPostTyp5 . '</div>'
                                . '<div class=" stream_content">'
                                . '<ul>'
                                . '<li class="media">'
                                . $imgDiv
                                . '<div class="media-body">'
                        ;

                        if ($rw['PostType'] == 2) {


                            $timeclass = $rw['StartDate'] == $rw['EndDate'] ? "" : "doubleul";
                            $elsetime = $rw['StartDate'] != $rw['EndDate'] ? "<br/>" : "-";
                            $htmlsub .= '<p>' . $text . '</p>'
                                    . '<div class="timeshow"><ul>
                                <li class="clearboth">
                            <ul class=' . $timeclass . '>
                                <li class="doubledate">
                                <time class="icon" datetime="' . $rw['StartDate'] . '">
                                        <strong>' . $rw['EventStartMonth'] . $elsetime . $rw['EventStartYear'] . '</strong>
                                        <span>' . $rw['EventStartDay'] . '</span>
                                        <em>' . $rw['EventStartDayString'] . '</em>                                        
                                    </time>
                                    </li>';
                            if ($rw['StartDate'] != $rw['EndDate']) {
                                $htmlsub .= '<li style="width:80px;float:left">
                                <time class="icon" datetime="' . $rw['EndDate'] . '">
                                        <strong>' . $rw['EventEndMonth'] . $elsetime . $rw['EventEndYear'] . '</strong>
                                        <span>' . $rw['EventEndDay'] . '</span>
                                        <em>' . $rw['EventEndDayString'] . '</em>                                        
                                    </time>
                                    </li>';
                            }
                            $htmlsub .= '</ul>
                                      </li>
                                      <li class="clearboth e_datelist"><div class="e_date">' . $rw['StartTime'] . ' - ' . $rw['EndTime'] . '</div></li>
                            </ul>';

                            $htmlsub .= '<div class="et_location clearboth"><span><i class="fa fa-map-marker"></i>' . $rw['Location'] . '</span> </div>';
                            $htmlsub .= ' </div>';
                            $htmlsub .= ' <div class="alignright paddingtb clearboth">';
                            if (!$rw['IsEventAttend']) {
                                $htmlsub .= '<button class="eventAttend btn btn-small editable_buttons" '
                                        . 'name="Attend" '
                                        . 'data-postid="' . $rw['PostId'] . '" '
                                        . 'data-postType="' . $rw['PostType'] . '" '
                                        . 'data-categoryType="' . $rw['CategoryType'] . '">'
                                        . '<i class="fa fa-check-square-o "></i> Attend'
                                        . '</button> ';
                            }

                            $htmlsub .= '</div></div>';
                        } else { // other post type != 2
                            $htmlsub .= '<!-- Nested media object -->
                                <div>' . $text . '</div>'
                                    . '<div class="media">
                                <a href="#" class="pull-left marginzero smallprofileicon">
                                    <img src="' . $rw['OriginalUserProfilePic'] . '">
                                </a>';
                            $htmlsub .= '<div class="media-body">
                                    <span class="m_day">' . $rw['PostOn'] . '</span>
                                    <div class="m_title"><a class="userprofilename" data-id="' . $rw['OriginalUserId'] . '"  style="cursor:pointer">' . $rw['OriginalUserDisplayName'] . '</a></div>
                                </div>
                            </div>';
                        }
                    } else {
                        
                    }

                    if ($rw['IsFollowingPost']) {
                        $fclass = "follow";
                    } else {
                        $fclass = "unfollow";
                    }
                    $lclass = $rw['IsLoved'] == 1 ? "likes" : "unlikes";
                    $htmlsub .= '<div class="social_bar" data-postid="' . $rw['PostId'] . '" data-postType="' . $rw['PostType'] . '" data-categoryType="' . $rw['CategoryType'] . '">	
                           
                            <a href="#"><i><img src="/images/system/spacer.png" class="' . $fclass . '" ></i></a>';
                    if ($rw['PostType'] != 5) {
                        $htmlsub .= '<a ><i><img src="/images/system/spacer.png" class=" invite_frds" ></i></a>
                            <a href="#"><i><img src="/images/system/spacer.png" style="display: none;" class=" share" ></i></a>
                            <span><i><img title="Likes" class="' . $lclass . '" src="/images/system/spacer.png"></i><b id="streamLoveCount_' . $rw['PostId'] . '">' . $rw['LoveCount'] . '</b></span>';
                    }
                    $htmlsub .= '<span><i><img src="/images/system/spacer.png" class="comments" title="Comments "></i><b id="commentCount_' . $rw['PostId'] . '">' . $rw['CommentCount'] . '</b></span></div>
                              </li></ul>
            </div>
        ';

                    $htmlsub .='<div class="alert-success" id="inviteTextAreaSuccess_' . $rw['PostId'] . '" style="padding-top: 5px;display: none"></div> ';
                    if ($rw['PostType'] != 5) {
                        $htmlsub .= '<div class="commentbox" id="inviteBox_' . $rw['PostId'] . '"  style="display:none">
            <div id="invite_' . $rw['PostId'] . '" class="paddinglrtp5" >
                <div id="inviteTextArea_' . $rw['PostId'] . '" class="invite_inputor" contentEditable="true"></div>
                <div id="inviteTextAreaError_' . $rw['PostId'] . '" style="display: none;"></div>
                <div class="postattachmentarea alignright">
                    <button id="saveInviteButton_' . $rw['PostId'] . '" onclick="saveInvites(\'' . $rw['PostId'] . '\',' . $rw['NetworkId'] . $rw['CategoryType'] . ');" class="btn" >Submit</button>
                </div> 
            </div>
        </div>';
                    }
                    $commentbox2Class = "";
                    if ($rw['PostType'] == 5) {
                        $commentbox2Class = "commentbox2";
                    }
                    $display = count($rw['Comments']) > 0 ? "" : "none";
                    $htmlsub .= '<div class="commentbox' . $commentbox2Class . ' " id="cId_' . $rw['PostId'] . '"  style="display:' . $display . '">';
                    $htmlsub .= '<div id="commentSpinLoader_' . $rw['PostId'] . '"></div>
            <div id="newComment_' . $rw['PostId'] . '" style="display:none" class="paddinglrtp5">
        <div id="commentTextArea_' . $rw['PostId'] . '" class="inputor" contentEditable="true"></div>
            <div id="commentTextAreaError_' . $rw['PostId'] . '" style="display: none;"></div>
            <input type="hidden" id="artifacts_' . $rw['PostId'] . '" value=""/>
            <div id="commentArtifactsPreview_' . $rw['PostId'] . '" class="preview" style="display:none">
                     <ul id="previewul_' . $rw['PostId'] . '" class="imgpreview">
                    </ul>
                 </div>';
                    $htmlsub .= '<div class="postattachmentarea" id="commentartifactsarea_<?php echo $data->PostId; ?>">
        <div class="pull-left whitespace">
<div class="advance_enhancement">
<ul>
                <li class="dropdown pull-left "><div class="postupload" id="postupload_' . $rw['PostId'] . '"></div>';
                    $htmlsub .= '<script type="text/javascript">
                        $(function(){
                   new qq.FileUploader({
    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element:document.getElementById("postupload_<?php echo $data->PostId?>"),
    action: "/post/upload/",'
                            . 'sizeLimit:"1000*1024*1024",// maximum file size in bytes'
                            . 'allowedExtensions:["jpg","jpeg","gif","exe","mov","mp4","mp3","txt","doc","pdf","ppt","xls","3gp","php","ini","avi","rar","zip","png"],
    // set to true to output server response to console
    debug: false,
    max_file_number :3,
    // events         
    // you can return false to abort submit
    onSubmit: function(id, fileName){},
    onProgress: function(id, fileName, loaded, total){},
    onComplete: function(id, fileName, responseJSON){
    previewCommentImage(id, fileName, responseJSON,\'' . $rw['PostId'] . '\');
},
onCancel: function(id, fileName){},

messages: {
     typeError: "{file} has invalid extension. Only {extensions} are allowed.",
            sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
            minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
            emptyError: "{file} is empty, please select files again without it.",
            onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
},
showMessage: function(message){appendErrorMessages(message); }
    
}); 
});                 </script>
                    </li>
                    </ul>';
                    $htmlsub .= '<div  id="snippet_main_' . $rw['PostId'] . '" class="snippetdiv" style="" >
           
      </div> 
    <a href="#" ></a> <a href="#" ><i><img src="/images/system/spacer.png" class="actionmore" ></i></a></div>
     </div>';
                    $htmlsub .= '    <div class="pull-right">
       
        <button id="savePostCommentButton_' . $rw['PostId'] . '" onclick="savePostCommentByUserId(\'' . $rw['_id'] . '\',\'' . $rw['PostId'] . '\',' . $rw['PostType'] . ',' . $rw['CategoryType'] . ',' . $rw['NetworkId'] . ');" class="btn" data-loading-text="Loading...">Comment</button>
        <button id="cancelPostCommentButton_' . $rw['PostId'] . '" onclick="cancelPostCommentByUserId(' . $rw['PostId'] . ')" class="btn btn_gray"> Cancel</button>

    </div></div>';
                    $htmlsub .= '<div style="display:' . $display . '" class="postattachmentareaWithComments"> <img src="/images/system/spacer.png" />
                </div>
</div>
           
       
        </div></div>';
//                    $secondUser = $rw['SecondUserData'];
//                    if ($secondUser != "") {
//                        if (trim($rw['StreamNote']) == "is following") {
//                            $rw['StreamNote'] = " are following";
//                        }
//                        if (trim($rw['StreamNote']) == "has Commented on") {
//                            $rw['StreamNote'] = "  Commented on";
//                        }
//                    }
                }
            }
            if (!empty($htmlsub))
                return $htmlsub . "((***&&***))" . $createdDate . "454___454" . $arraysize;
            else
                return 0;
        } catch (Exception $ex) {
            error_log("=====Exception====" . $ex->getMessage());
        }
    }

}
?>


