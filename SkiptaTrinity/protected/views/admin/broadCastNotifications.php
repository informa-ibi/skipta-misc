 <h2 class="pagetitle"><?php echo Yii::t('translation','Broadcast_Notifications'); ?></h2> 
<div class="searchgroups" >  
<div id="addNewNotificatons" class="dropdown dropdown-menu actionmorediv actionmoredivtop newgrouppopup newgrouppopupdivtop"  >
    
</div>
</div>
<div id="broadCastNotificatons">
    
    
</div>
<script type="text/javascript">
    
    loadBroadCastNotificatonsForAdmin(1,"","");
    function loadBroadCastNotificatonsForAdmin(startLimit,filterValue,searchText){ 
    var queryString = 'startLimit='+startLimit+'&filterValue=' + filterValue+'&searchText=' + searchText+ "&pageLength=" + g_pageLength;

    ajaxRequest("/admin/GetAllBroadCastNotificatons",queryString,loadBroadCastNotificatonsForAdminHandler);

    }

    function loadBroadCastNotificatonsForAdminHandler(data){
    $('#broadCastNotificatons').html(data.htmlData);

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
    loadBroadCastNotificatonsForAdmin(g_pageNumber, g_filterValue, g_searchText);
    }

    });
    if($.trim(data.searchText) != undefined && $.trim(data.searchText) != "undefined" ){  

    $('#searchAdId').val(data.searchText);
    }

    }
    
     function searchMsg(event) {
    
    var keycode = (event.keyCode ? event.keyCode : event.which);
//    alert(keycode+"----1");
    if (keycode == '13') {
        //scrollPleaseWait('spinner_admin');
        g_pageNumber=1;
        if ($.trim($("#searchMsgId").val()) != "") {
            var searchText = $.trim($("#searchMsgId").val());
//            alert(searchText);
            g_searchText = searchText;
            loadBroadCastNotificatonsForAdmin(1, '', g_searchText);            
        } else {
//            alert("else");
            g_searchText = "";
            loadBroadCastNotificatonsForAdmin(1,"","");
        }
        return false;

    }
}


</script>
