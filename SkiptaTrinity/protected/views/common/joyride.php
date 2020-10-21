<!-- Tip Content -->
<ol class="joyride-list " data-joyride>
    <?php
    try {
        $toPage = $data->toPage;

        //if (is_object($joyrideInfo)) {
        $i = 0;

        if(isset($joyrideInfo) & is_array($joyrideInfo)){
        foreach ($joyrideInfo as $data) {
            ?>
            <li data-id="<?php echo $data->joyrideId ?>" data-text="<?php if($data->fromPage==$data->toPage) echo Yii::t('joyrideinfo', 'Next');else echo Yii::t('joyrideinfo', 'Done'); ?>"  <?php if ($i == 1) echo "data-class='custom so-awesome'" ?> <?php if ($i != 0) echo "data-prev-text='".Yii::t('joyrideinfo', 'Prev')."'" ?>  
                data-options="<?php
                if ($i == 0) {
                    echo 'tip_location: top; prev_button: false;modal:true';
                } else {
                    echo 'modal:true';
                }
                ?> ">
                <h4><?php $title = Yii::t('joyrideinfo', 'title_'.$data->module.'_'.$data->joyrideId);
                $title = $title=='title_'.$data->module.'_'.$data->joyrideId?$data->title:$title;
                $title=str_replace('[Network Name]',Yii::app()->params['NetworkName'], $title);echo $title;?></h4>
                <p><?php $text = Yii::t('joyrideinfo', 'text_'.$data->module.'_'.$data->joyrideId);
                $text = $text=='text_'.$data->module.'_'.$data->joyrideId?$data->text:$text;
                $text=str_replace('[Network Name]', Yii::app()->params['NetworkName'], $text);
                $text=str_replace('[network specialty]', Yii::app()->params['PrimaryUser'], $text);echo $text;?></p>
            </li>
        

            <?php
            $i = $i + 1;
            $toPage = $data->toPage;
        }
        }
      
            ?> 
<!--            <li data-button="End" data-options="prev_button: false;" >
                <h4>Thank you</h4>
                <p>End of the demo</p>
            </li>-->
 <?php
       
       // $nextPage = $pageArray[$toPage];
        // }
        
    } catch (Exception $exc) {
        
    }
    ?>
</ol>

<script>



     $(document).ready(function() {
         
       
       // $(document).foundation('joyride', 'start');
        $(document)
                .foundation({joyride: {post_ride_callback: function(obj) {
                         //  alert('<?php echo  Yii::app()->session['UserStaticData']->userSessionsCount?>');
//                            if ('<?php echo $toPage ?>' == '')
//                                sessionStorage.disableJoyride = true;
//                            if (window.location.pathname != '/<?php echo $toPage ?>' && '<?php echo $toPage ?>' != '')
//                            {
//                                alert('<?php echo $toPage ?>');
//                                if ('<?php echo $toPage ?>' == 'agp')
//                                {
//
//                                    if ($('div#groupsFollowingId div#leftboxarea ul li').length > 0) {
//                                        var groupname = $('div#groupsFollowingId div#leftboxarea ul>li').attr('data-name');
//                                        sessionStorage.pageName = "agp";
//                                        window.location = "/" + groupname;
//
//                                    } else {
//                                        window.location = '<?php echo $nextPage ?>';
//                                        sessionStorage.pageName = false;
//                                       
//                                    }
//                                }
//                                else if ('<?php echo $toPage ?>' == 'userProfile')
//                                {
//                                    sessionStorage.pageName = "userProfile";
//                                    window.location = '<?php echo Yii::app()->session['TinyUserCollectionObj']['uniqueHandle'] . "/profile" ?>';
//                                }
//                                else
//                                {
//                                    sessionStorage.pageName = '<?php echo $toPage ?>';
//                                    window.location = '<?php echo $toPage ?>';
//                                }
//                            }
                        }
                        }})
                .foundation('joyride', 'start');


    });

</script>