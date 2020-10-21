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
            <li data-id="<?php echo $data->joyrideId ?>" data-text="<?php if($data->fromPage==$data->toPage) echo 'Next';else echo 'Done'; ?>"  <?php if ($i == 1) echo "data-class='custom so-awesome'" ?> <?php if ($i == 0) echo "data-prev-text='Prev'" ?>  
                data-options="<?
                if ($i == 0) {
                    echo 'tip_location: top; prev_button: false;modal:true';
                } else {
                    echo 'modal:true';
                }
                ?> ">
                <h4><?php $title=str_replace('[Network Name]',Yii::app()->params['NetworkName'], $data->title);echo $title;?></h4>
                <p><?php $text=str_replace('[Network Name]', Yii::app()->params['NetworkName'], $data->text);$text=str_replace('[network specialty]', Yii::app()->params['PrimaryUser'], $text);echo$text;?></p>
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
        $(document).foundation('joyride', 'start');
        $(document)
                .foundation({joyride: {post_ride_callback: function(obj) {
                        }
                        }})
                .foundation('joyride', 'start');


    });

</script>