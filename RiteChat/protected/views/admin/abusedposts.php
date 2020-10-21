<?php include 'miniProfileScript.php'; ?>
<div class="streamsectionarea  streamsectionarearightpanelno">
    <div class="padding10 ">
        <h2 class="pagetitle">Post Management</h2>

        <div id="abusedposts_div">
            <ul class="nav nav-tabs" id="AbusePostTabs">
                <li class="active" style="cursor: pointer"><a id="posts" >Posts</a></li>
                <li  style="cursor: pointer"><a id="curbsidePosts" >Curbside Posts</a></li>
                <li  style="cursor: pointer"><a id="groupPosts" >Group Posts</a></li>
            </ul>
            <div id="postsDisplayDiv" style="padding-bottom:10px"></div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function(){
        getCollectionData('/admin/getnormalabusedposts', 'AbusedPostDisplayBean', 'postsDisplayDiv', 'No Posts found.','That\'s all folks!');
        abusedOnReadyEvents();
    });
</script>