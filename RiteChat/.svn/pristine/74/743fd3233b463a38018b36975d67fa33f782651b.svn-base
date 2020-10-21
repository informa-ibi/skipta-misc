<script type="text/javascript">
    var projectSearch;
    var search, projectOffset = 0, projectPageLength = 20;
    var callMade = false;
    var projectSearchEmit;
    var watchId;
    var startProjectSearch;

    var userSearch = true;
    var groupsSearch = true;
    var subGroupsSearch = true;
    var hastagsSearch = true;
    var postSearch = true;
    var hashtagId;
    var trackSearch = true;

    // connect to socket
    var projectSearchHostPort = '<?php echo Yii::app()->params['NodeURL']; ?>';
    if (typeof io !== "undefined") {
        var searchSocket = io.connect(projectSearchHostPort, {query: "timezoneName=" + timezoneName});

        var watchId;
        $('#SearchTextboxBt').live('keydown',function(e) {
            $("#search").width($(".container").width() - 150);
            $("#searchbox").addClass("open");
            //return;
            scrollPleaseWait("search_spinner", "search");
            if (watchId != undefined && watchId != null) {
                clearTimeout(watchId);
            }

            watchId = setTimeout(function() {
                trackSearch = true;
                startProjectSearch();

            }, 1000)
        });
        startProjectSearch = function() {
            projectOffset = 0;
            callMade = false;

            userSearch = true;
            groupsSearch = true;
            subGroupsSearch = true;
            hastagsSearch = true;
            postSearch = true;
            curbsideCategory = true;
            isDuringAjax = true;
            $("#searchContextId").html("");
            $("#searchContextId,#searchBackId").hide();
            projectSearch(projectOffset, projectPageLength);
        }
        projectSearch = function() {
            projectSearchEmit(projectSearchHandler);

        }
        var gHandler = "";
        projectSearchEmit = function(handler) {
            gHandler = handler;
            search = $.trim($('#SearchTextboxBt').val());
            if (search != '') {
                if (userSearch == true || groupsSearch == true || subGroupsSearch == true || hastagsSearch == true || postSearch == true || curbsideCategory === true) {
                    scrollPleaseWait("search_spinner", "search");
                    searchSocket.emit('projectSearch', search, projectOffset, projectPageLength, userSearch, groupsSearch, subGroupsSearch, hastagsSearch, postSearch, loginUserId,curbsideCategory);

                }

            } else {
                $("#projectSearchDiv").html("");
                scrollPleaseWaitClose("search_spinner");
            //    $("#searchbox").attr("class", "search");
            }
        }

        searchSocket.on('projectSearchResponse', function(data) {

                if ($.trim(data) != "") {
                    data = eval("(" + data + ")");
                    gHandler(data);
                }

        });

    }
    function loadProjectSearch() {
        projectSearchEmit(loadProjectSearchHandler);
    }
    function groupDetailHandler(data) {
        $("#contentDiv").html(data);
    }
    function projectSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        var jscroll = $('#projectSearchDiv').jScrollPane({});
        var api = jscroll.data('jsp');
        api.destroy();

        $("#projectSearchDiv").html($("#projectSearchTmpl").render());
        projectOffset = projectOffset + projectPageLength;
        $(document).bind("click touchstart", function() {
            $("#searchbox").removeClass("open");
            isDuringAjax = false;
        });
        $("#search").width($(".container").width() - 150);

        $('#SearchTextboxBt').unbind("click touchstart").bind('click touchstart', function(e) {
            trackSearch = true;
            $("#notificationsLi").removeClass("open");
            $("#projectSearchDiv").html("");
            $("#searchbox").addClass("open");
            startProjectSearch();

        });
        $('#searchbox').bind('click touchstart', function(e) {
            e.stopPropagation();
        });
        if (data.users.length > 0) {
            var item = {
                "users": data.users,
            };
            $("#userSearchSpan").show();
            $("#userSearchDiv").html($("#userSearchTmpl").render(item));
            bindProfile();

        } else {
            userSearch = false;

            $("#userSearchSpan").hide();
        }

        if (data.groups.length > 0) {
            var item = {
                "groups": data.groups,
            };
            $("#groupSearchSpan").show();
            $("#groupSearchDiv").html($("#groupSearchTmpl").render(item));
            bindGroup();

        } else {
            groupsSearch = false;

            $("#groupSearchSpan").hide();
        }

        if (data.subGroups.length > 0) {
            var item = {
                "subGroups": data.subGroups,
            };
            $("#groupSearchSpan").show();
            $("#groupSearchDiv").append($("#subGroupSearchTmpl").render(item));
            bindGroup();

        } else {
            subGroupsSearch = false;

            // $("#groupSearchSpan").hide();
        }
        if (data.postString[0].curbPostExist == "yes" || data.postString[0].postExist == "yes" || data.postString[0].newsExist == "yes") {
            var item = {
                "postString": data.postString,
            };
            $("#postSearchSpan").show();
            $("#postSearchDiv").html($("#postSearchTmpl").render(item));

        } else {

            postSearch = false;
            $("#postSearchSpan").hide();
        }
        if (data.hastagArray.length > 0) {
            var item = {
                "hashtagArray": data.hastagArray
            };
            $("#hashtagSearchSpan").show();
            $("#hashtagSearchDiv").html($("#hashtagSearchTmpl").render(item));
            bindHashtag();
        } else {
            hastagsSearch = false;
            $("#hashtagSearchSpan").hide();
        }
        if (data.categoryArray.length > 0) { 
            var item = {
                "categoryArray": data.categoryArray
            };
            $("#curbsideCategorySearchSpan").show();
            $("#curbsideCategorySearchDiv").html($("#curbsideCategorySearchTmpl").render(item));
            bindCategory();
        } else {
            curbsideCategory = false;
            $("#curbsideCategorySearchSpan").hide();
        }


        $("#projectSearchDiv").jScrollPane({autoReinitialise: true, autoReinitialiseDelay: 500});


        $('#projectSearchDiv').bind('jsp-scroll-y', function(event, scrollPositionY, isAtTop, isAtBottom)
        {
            if (isAtBottom && callMade == false) {
                callMade = true;
                loadProjectSearch();
            }


        }
        );
        if (userSearch == false && hastagsSearch == false && postSearch == false && groupsSearch == false && subGroupsSearch == false && curbsideCategory == false) {
            $("#search_nodata").show();
            $("#search_nodata").html("<div class='ndm ndf'>No results found</div>");

        } else {
            $("#search_nodata").hide();
        }
        $('#projectSearchDiv').height(function() {
            return $(window).height() * 0.7;
        });
        $("[rel=tooltip]").tooltip();
    }
    function loadProjectSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        projectOffset = projectOffset + projectPageLength;
        if (data.users.length > 0) {
            var item = {
                "users": data.users,
            };
            $("#userSearchDiv").append($("#userSearchTmpl").render(item));
            bindProfile();
        } else {
            userSearch = false;
        }
        if (data.groups.length > 0) {
            var item = {
                "groups": data.groups,
            };
            $("#groupSearchDiv").append($("#groupSearchTmpl").render(item));
            bindGroup();
        } else {
            groupsSearch = false;
        }
        if (data.subGroups.length > 0) {
            var item = {
                "subGroups": data.subGroups,
            };
            $("#groupSearchDiv").append($("#subGroupSearchTmpl").render(item));
            bindGroup();
        } else {
            subGroupsSearch = false;
        }
        postSearch = false;


        if (data.hastagArray.length > 0) {
            var item = {
                "hashtagArray": data.hastagArray
            };
            $("#hashtagSearchDiv").append($("#hashtagSearchTmpl").render(item));
            bindHashtag();
        } else {
            hastagsSearch = false;
        }
        
        if (data.categoryArray.length > 0) { 
            var item = {
                "categoryArray": data.categoryArray
            };
            $("#curbsideCategorySearchSpan").show();
            $("#curbsideCategorySearchDiv").html($("#curbsideCategorySearchTmpl").render(item));
            bindCategory();
        } else {
            curbsideCategory = false;
            $("#curbsideCategorySearchSpan").hide();
        }
        callMade = false;
        $("#projectSearchDiv").jScrollPane();
        $("[rel=tooltip]").tooltip();
        trackSearchCriteria("", "");
    }
    function getPostsForSearch() {
        scrollPleaseWait("search_spinner", "search");
        var jscroll = $('#projectSearchDiv').jScrollPane({});
        var api = jscroll.data('jsp');
        api.destroy();
        search = $.trim($('#SearchTextboxBt').val());
        projectOffset = 0;
        var query = "search=" + search + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/post/getPostsForSearch', query, getPostsForSearchHandler);
        trackSearchCriteria("", "");
    }
    function getPostsForSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        search = $.trim($('#SearchTextboxBt').val());
        $("#searchContextId").html('Posts with "' + search + '"');
        $("#searchContextId,#searchBackId").show();
        $("#projectSearchDiv").html("<ul id='postSearchUl' class='profilebox'></ul>");
        $("#postSearchUl").html(data);
        bindPost();
        $("#searchbox").addClass("open");
        applyProjectSearchLayout(loadGetPostsForSearch);
        projectOffset = projectOffset + projectPageLength;
        $("[rel=tooltip]").tooltip();
    }
    function getNewsForSearch() {
        scrollPleaseWait("search_spinner", "search");
        var jscroll = $('#projectSearchDiv').jScrollPane({});
        var api = jscroll.data('jsp');
        api.destroy();
        search = $.trim($('#SearchTextboxBt').val());
        projectOffset = 0;
        var query = "search=" + search + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/news/getNewsForSearch', query, getNewsForSearchHandler);
    }
    function getNewsForSearchHandler(data) {

        scrollPleaseWaitClose("search_spinner");
        search = $.trim($('#SearchTextboxBt').val());
        $("#searchContextId").html('News with "' + search + '"');
        $("#searchContextId,#searchBackId").show();
        $("#projectSearchDiv").html("<ul id='postSearchUl' class='profilebox'></ul>");
        $("#postSearchUl").html(data);
        bindNews();
        $("#searchbox").addClass("open");
        applyProjectSearchLayout(loadGetNewsForSearch);
        projectOffset = projectOffset + projectPageLength;
        $("[rel=tooltip]").tooltip();
    }
    var handler = null;
    // Prepare layout options.


    function applyProjectSearchLayout(callback) {
        var options = {
            itemWidth: '23%', // Optional min width of a grid item
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $('#postSearchUl'), // Optional, used for some extra CSS styling
            offset: 8, // Optional, the distance between grid items
            outerOffset: 10, // Optional the distance from grid to parent
            flexibleWidth: '50%', // Optional, the maximum width of a grid item
            align: 'left'
        };
        var ww = $("#projectSearchDiv").width();
        options.container.imagesLoaded(function() {
            // Create a new layout handler when images have loaded.
            handler = $('#postSearchUl li.woomarkLi');
            if (ww < 753) {

                options.itemWidth = '100%';
                options.flexibleWidth = '100%';

            }
            else if (ww > 753 && ww < 1000) {
                options.itemWidth = '23%';

            } else {
                options.itemWidth = '23%';
            }

            handler.wookmark(options);
            $("#projectSearchDiv").jScrollPane({autoReinitialise: true, autoReinitialiseDelay: 500});
            $('#projectSearchDiv').bind('jsp-scroll-y', function(event, scrollPositionY, isAtTop, isAtBottom)
            {
                
                if (isAtBottom && callMade == false) {
                    callMade = true;                    
                    callback();
                }


            }
            );
            $('#projectSearchDiv').height(function() {
                return $(window).height() * 0.7;
            });
        });
    }

    function loadGetPostsForSearch() {
        scrollPleaseWait("search_spinner", "search");
        search = $.trim($('#SearchTextboxBt').val());
        var query = "search=" + search + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/post/getPostsForSearch', query, loadGetPostsForSearchHandler);
    }
    function loadGetPostsForSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        if ($.trim(data) != "nodata") {
            $("#postSearchUl").append(data);
            bindPost();
            applyProjectSearchLayout(loadGetPostsForSearch);
            projectOffset = projectOffset + projectPageLength;
            callMade = false;
        } else {
            callMade = true;

        }
        $("[rel=tooltip]").tooltip();

    }
    function loadGetNewsForSearch() {
        scrollPleaseWait("search_spinner", "search");
        search = $.trim($('#SearchTextboxBt').val());
        var query = "search=" + search + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/news/getNewsForSearch', query, loadGetNewsForSearchHandler);
    }
    function loadGetNewsForSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        if ($.trim(data) != "nodata") {
            $("#postSearchUl").append(data);
            bindPost();
            applyProjectSearchLayout(loadGetNewsForSearch);
            projectOffset = projectOffset + projectPageLength;
            callMade = false;
        } else {
            callMade = true;

        }
        $("[rel=tooltip]").tooltip();

    }
    function htmlAjaxRequest(url, queryString, callback) {
        var data = queryString;
        ajaxRequest(url, data, callback, "html");
    }

    function getCurbPostsForSearch() {
        scrollPleaseWait("search_spinner", "search");
        var jscroll = $('#projectSearchDiv').jScrollPane({});
        var api = jscroll.data('jsp');
        api.destroy();
        search = $.trim($('#SearchTextboxBt').val());
        projectOffset = 0;
        var query = "search=" + search + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/post/getCurbPostsForSearch', query, getCurbPostsForSearchHandler);
        trackSearchCriteria("", "");
    }
    function getCurbPostsForSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        $("#searchContextId,#searchBackId").show();
        $("#searchContextId").html('Threaded Posts with "' + search + '"');
        $("#projectSearchDiv").html("<ul id='postSearchUl' class='profilebox'></ul>");
        $("#postSearchUl").html(data);
        bindPost();
        applyProjectSearchLayout(loadGetCurbPostsForSearch);
        projectOffset = projectOffset + projectPageLength;
        $("[rel=tooltip]").tooltip();
    }
    function loadGetCurbPostsForSearch() {
        scrollPleaseWait("search_spinner", "search");
        search = $.trim($('#SearchTextboxBt').val());
        var query = "search=" + search + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/post/getCurbPostsForSearch', query, loadGetCurbPostsForSearchHandler);
    }
    function loadGetCurbPostsForSearchHandler(data) {
        scrollPleaseWaitClose("search_spinner");
        if ($.trim(data) != "nodata") {
            $("#postSearchUl").append(data);
            bindPost();
            applyProjectSearchLayout(loadGetCurbPostsForSearch);
            projectOffset = projectOffset + projectPageLength;
            callMade = false;
        } else {
            callMade = true;

        }

        $("[rel=tooltip]").tooltip();
    }
    function bindPost() {
        $("[name=searchPostRecord]").click(function() {

            var postId = $(this).attr('data-postid');
            var categoryType = $(this).attr('data-categorytype');
            var postType = $(this).attr('data-posttype');
            $("#chatDiv").hide();
            renderPostDetailPage('admin_PostDetails', 'contentDiv', postId, categoryType, postType);
            //renderNewsDetailedPage('admin_PostDetails', 'contentDiv', postId, postId, categoryType, postType);
            //renderGameDetailedPage('admin_PostDetails','contentDiv',"",postId,categoryType,postType);
        });
    }
    function bindNews() {
        $("[name=searchPostRecord]").click(function() {

            var postId = $(this).attr('data-postid');
            var categoryType = $(this).attr('data-categorytype');
            var postType = $(this).attr('data-posttype');
            $("#chatDiv").hide();
            renderNewsDetailedPage('admin_PostDetails', 'contentDiv', postId, postId, categoryType, postType);
        });
    }
    function bindGroup() {
        $("div[name=searchGroupDetail]").click(function() {
            var groupName = $(this).attr('data-name');
            var groupId = $(this).attr('data-id');
            var groupType = $(this).attr('data-type');
            if (trackSearch == true) {
                trackSearch = false;
                var queryString = {"page": "ProjectSearch", "action": "ProjectSearch", "searchText": $.trim($('#SearchTextboxBt').val()), "searchType": groupType, "dataId": groupId};

                ajaxRequest("/post/trackSearchEngagementAction", queryString, function(data) {
                    trackSearch = false;
                    window.location = "/" + groupName;
                });
            }
        });
    }
    function bindProfile() {
        $("div[name=searchUserProfile]").click(function() {
            var displayName = $(this).attr('data-name');
            var dataId = $(this).attr('data-id');
            if (trackSearch == true) {
                trackSearch = false;
                var queryString = {"page": "ProjectSearch", "action": "ProjectSearch", "searchText": $.trim($('#SearchTextboxBt').val()), "searchType": "profile", "dataId": dataId};
                ajaxRequest("/post/trackSearchEngagementAction", queryString, function(data) {
                    trackSearch = false;
                    window.location = "/profile/"+displayName;
                });
            }
        });
    }


    function bindHashtag() {
        $("div[name=searchHashTag]").click(function() {
            
            hashtagId = $(this).attr('data-id');
            hashtagName = $(this).attr('data-name');
            trackSearchCriteria(hashtagId, "hashtag");
            projectOffset = 0;
            var query = "hashtagId=" + hashtagId + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
            htmlAjaxRequest('/post/getPostsForHashtagSearch', query, function(data) {
                var jscroll = $('#projectSearchDiv').jScrollPane({});
                var api = jscroll.data('jsp');
                api.destroy();
                $("#projectSearchDiv").html("<ul id='postSearchUl' class='profilebox'></ul>");
                if ($.trim(data) != "nodata") {
                    $("#postSearchUl").html(data);
                    bindPost();
                } else {

                    $("#projectSearchDiv").html('<div id="search_nodata"></div>');
                    $("#search_nodata").show();
                    $("#search_nodata").html("<div class='ndm ndf'>No results found</div>");
                }

                $("#searchContextId").html('Posts with hashtag "' + hashtagName + '"');
                $("#searchContextId,#searchBackId").show();
                applyProjectSearchLayout(loadGetPostsForHashtag);
                projectOffset = projectOffset + projectPageLength;
                $("[rel=tooltip]").tooltip();
            });

        });
    }
    
    function bindCategory() {
        $("div[name=searchCategory]").click(function() {

            categoryId = $(this).attr('data-id');
            categoryName = $(this).attr('data-name');
            trackSearchCriteria(categoryId, "category");
            projectOffset = 0;
            var query = "categoryId=" + categoryId + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
            htmlAjaxRequest('/post/getCurbsidePostsByCategory', query, function(data) {
                var jscroll = $('#projectSearchDiv').jScrollPane({});
                var api = jscroll.data('jsp');
                api.destroy();
                $("#projectSearchDiv").html("<ul id='postSearchUl' class='profilebox'></ul>");
                if ($.trim(data) != "nodata") {
                    $("#postSearchUl").html(data);
                    bindPost();
                } else {

                    $("#projectSearchDiv").html('<div id="search_nodata"></div>');
                    $("#search_nodata").show();
                    $("#search_nodata").html("<div class='ndm ndf'>No results found</div>");
                }

                $("#searchContextId").html('Posts with category "' + categoryName + '"');
                $("#searchContextId,#searchBackId").show();
                applyProjectSearchLayout(loadGetPostsForCategory);
                projectOffset = projectOffset + projectPageLength;
                $("[rel=tooltip]").tooltip();
            });

        });
    }

    
    function loadGetPostsForHashtag() {

        var query = "hashtagId=" + hashtagId + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/post/getPostsForHashtag', query, loadGetPostsForHashtagHandler);
    }
    function loadGetPostsForHashtagHandler(data) {
        if ($.trim(data) != "nodata") {
            $("#postSearchUl").append(data);
            bindPost();
            applyProjectSearchLayout(loadGetPostsForHashtag);
            projectOffset = projectOffset + projectPageLength;
            callMade = false;
        } else {
        }
        $("[rel=tooltip]").tooltip();

    }
    function searchBack() {
        trackSearch = false;
        $("#notificationsLi").removeClass("open");
        $("#projectSearchDiv").html("");
        $("#searchbox").addClass("open");
        startProjectSearch();
    }
    function trackSearchCriteria(dataId, searchType) {
        if (trackSearch == true) {
            trackSearch = false;
            var queryString = {"page": "ProjectSearch", "action": "ProjectSearch", "searchText": $.trim($('#SearchTextboxBt').val()), "searchType": searchType, "dataId": dataId};

            ajaxRequest("/post/trackSearchEngagementAction", queryString, function(data) {
                trackSearch = false;
            });
        }

    }
    function loadGetPostsForCategory() {

        var query = "categoryId=" + categoryId + "&offset=" + projectOffset + "&pageLength=" + projectPageLength;
        htmlAjaxRequest('/post/getCurbsidePostsByCategory', query, loadGetPostsForCategoryHandler);
    }
    function loadGetPostsForCategoryHandler(data) {
        if ($.trim(data) != "nodata") {
            $("#postSearchUl").append(data);
            bindPost();
            applyProjectSearchLayout(loadGetPostsForHashtag);
            projectOffset = projectOffset + projectPageLength;
            callMade = false;
        } else {
        }
        $("[rel=tooltip]").tooltip();

    }

</script>

