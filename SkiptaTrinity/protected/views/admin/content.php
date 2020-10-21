<?php include 'inviteScript.php'; ?>
<?php include 'hashTagProfileScript.php'; ?>
<div id="newdetaildiv" style="display:none"></div>
<div id="newscontentdiv">
<div>
                 <h2 class="pagetitle positionrelative">Curated Content <div class="filtericondiv">
            <div class="btn_toggle positionrelative collapsed" data-toggle="collapse" data-target="#crubsidefilter"><i onclick="filtericonchange(this.id);" id="c_filteractive" class="fa fa-chevron-down" style="display: block;"></i><i onclick="filtericonchange(this.id);" id="c_filterinactive" class=" fa fa-chevron-up" style="display: none;"></i></div>
        </div></h2>
    </div>
<div id="crubsidefilter" class="collapse" style="position: absolute;z-index: 9;right:0">
    <div id="dfilters" class="borderouter" >
        <div class="bordergrey" style="background:#fff">
    <div class="row-fluid">
        <div class="span12">
            <div class="pull-right">
                <div class="positionrelative pull-left" style="padding-right:10px">
                    <label>Topic</label>
                    <div class="positionrelative">
                        <select name="filters" id="filters" >
    <option value="All">All</option>
    <?php foreach ($topics as $data) { ?>
        <?php if ($data['Status'] == 1) { ?>
    <option value="<?php echo $data['TopicId'] ?>"><?php echo $data['TopicName'] ?> </option>
        <?php } ?>
    <?php } ?>
</select>
                    </div>
                    
                </div>
                <div class="positionrelative pull-left">
                    <label>Status</label>
                    <div class="positionrelative">
                        <select name="status" id="status">
    <option value="All">All</option>
    <option value="WFR">Waiting</option>
    <option value="R">Published</option>
    <option value="PB">Pulled Back</option>
    <option value="D">Deleted</option>
</select>
                        
                    </div>
                    
                </div>
            </div>
        </div>
         </div>
</div>
</div>
</div>

    <input type="hidden" id="FeaturedTitleHidden"/>
    <input type="hidden" id="FeaturedTitleHidden_id"/>
<div >
<div id='ProfileInteractionDivContent'></div>
</div>
</div>
<script type="text/javascript">
    var handler = null;
    var filter="Topic=All&Status=All";
    var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#CuratedProfileInteractionDiv'), // Optional, used for some extra CSS styling
        offset: 8, // Optional, the distance between grid items
        outerOffset: 10, // Optional, the distance to the containers border
        //itemWidth: '10%', // Optional, the width of a grid item
        align: 'left'
    };
    var $window = $(window);

    function applyLayoutTopic() {
        options.container.imagesLoaded(function() {
            // Create a new layout handler when images have loaded.
            handler = $('#CuratedProfileInteractionDiv li');
            handler.wookmark(options);
        });
    }
    applyLayoutTopic();

    $(document).ready(function() {
        getCollectionData('/admin/stream',filter+'&CuratedNewsCollection', 'ProfileInteractionDivContent', 'No News available at this point.', 'No more News available.');
        $('.save').live('click', function() {
            var postId=$(this).attr("data-id");
            var editorObject = $(this).closest('.EC' + $(this).data('id')).find("#editable"+postId);              


            if ($.trim(editorObject.text()).length > 0) {
                var text =getEditorText(editorObject);                                 
                        var hashtagString=getHashTags(editorObject);
                        var mentions=getAtMentions(editorObject);
                        saveEditorial($(this).data('id'), text,hashtagString,mentions);
            }else{
                        $('#EDCE' + $(this).data('id')).fadeIn();
                        $('#EDCE' + $(this).data('id')).fadeOut(3000);
            }
        })

        $('.cancel').live('click', function() {
            $('.EDC' + $(this).data('id')).val('');
            $('.EC' + $(this).data('id')).hide();
            $('.EDCRO' + $(this).data('id')).show();
            applyLayoutContent();
        })
    });
    var handler = null;
    var optionsC = {
        itemWidth: '100%', // Optional min width of a grid item
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#ProfileInteractionDivContent'), // Optional, used for some extra CSS styling
        offset: 20, // Optional, the distance between grid items
        outerOffset: 20, // Optional the distance from grid to parent
        flexibleWidth: '100%', // Optional, the maximum width of a grid item
        align: 'left'
    };
    var $window = $(window);

    function applyLayoutContent() {
        optionsC.container.imagesLoaded(function() {
            optionsC.container.imagesLoaded(function() {
                // Create a new layout handler when images have loaded.
                handler = $('#ProfileInteractionDivContent li');

                if ($window.width() < 753) {
                    optionsC.itemWidth = '100%';
                    optionsC.flexibleWidth = '100%';

                }
                else if ($window.width() > 753 && $window.width() < 1000) {
                    optionsC.itemWidth = '80%';
                } else {

                    optionsC.itemWidth = '40%';
                }

                handler.wookmark(optionsC);

            });
        });
    }

    $('.cursor').live('click', function()    { 
        var data_p = $(this).data('id').split('_');

        if (data_p[0] == 'D')
        {
            var modelType = 'error_modal';
            var content = "Are you sure you want to delete this Curated Post ?";
            var closeButtonText = 'No';
            var okButtonText = 'Yes';
            var title = 'Delete Curated Post';
            var okCallback = manageCuratedPost;
            var param = $(this).data('id');
            openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param);

        }
        else if (data_p[0] == 'E')
        {
            if ($('.EC' + data_p[1]).css('display') == 'block')
            {
                $('.EC' + data_p[1]).hide();
                $('.EDCRO' + data_p[1]).show();
            }
            else
            {   
                if($('.EDCRO' + data_p[1]).text()!='')
                {initializationForHashtagsAtMentions('div#editable'+data_p[1]);
                    showEditorial(data_p[1]); 
                    $('.EDCROT' + data_p[1]).hide();
                }
                else
                { 
                $('.EDC' + data_p[1]).val();
                $('.EC' + data_p[1]).show();
                $('.EDCRO' + data_p[1]).hide();
                }
            }
            applyLayoutContent();

        }
        else if(data_p[0] == 'PB')
        {
            var modelType = 'error_modal';
            var content = "Are you sure you want to pullback this Curated Post ?";
            var closeButtonText = 'No';
            var okButtonText = 'Yes';
            var title = 'Pullback Curated Post';
            var okCallback = manageCuratedPost;
            var param = $(this).data('id');
            openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param);

        }
     else {
      var data_p = $(this).data('id').split('_');
    if(data_p[0]!="MASFI"){
            manageCuratedPost($(this).data('id'));
        }
        else{

            $("#FeaturedTitleHidden").val($("#"+data_p[1]+" .customwidget_outer .customwidget .pagetitle").text());
         
            $("#FeaturedTitleHidden_id").val($(this).data('id'));
             manageCuratedPost($("#FeaturedTitleHidden_id").val()+"_"+$("#FeaturedTitleHidden").val());
        }
        }

    });
    $('.showmore').live('click', function()  {
        showMoreEditorial($(this).data('id'));
    });
    $('.minimize').live('click', function()  {
        minimizeEditorial($(this).data('id'), $('.EDCRO' + $(this).data('id')).html());
    });
    $('.showmoreC').live('click', function() {
        showMoreEditorialC($(this).data('id'));
    });
    $('.minimizeC').live('click', function() {
        minimizeEditorialC($(this).data('id'), $('.HTMLC' + $(this).data('id')).html());
    });
    $('#filters').live('change', function() {
       filter="Topic="+$(this).val()+"&Status=All&CuratedNewsCollection";
       page=1;
       isDuringAjax=false;
       $(window).unbind("scroll");
       $('#ProfileInteractionDivContent').css('height','20px').html('');
       getCollectionData('/admin/stream',filter, 'ProfileInteractionDivContent', 'No News available at this point.', 'No more News available.');

    });
    $('#status').live('change', function() {
       filter="Topic="+$('#filters').val()+"&Status="+$(this).val()+"&CuratedNewsCollection";
       page=1;
       isDuringAjax=false;
       $(window).unbind("scroll");
       $('#ProfileInteractionDivContent').css('height','20px').html('');
       getCollectionData('/admin/stream',filter, 'ProfileInteractionDivContent', 'No News available at this point.', 'No more News available.');

    });
    
</script>
