<div class="padding8top"> 
    <div id="changesegmentSpinLoader"></div>
    <div class="signdiv">
        <div style="display: none" id="errmsgForChangesegment" class="alert-error"></div>
        <div style="display: none" id="sucmsgForChangesegment" class="alert-success"></div>          
        <div class="row-fluid">
            <div class="span6 error">
                <label><?php echo Yii::t('translation', 'User_Segment_Country'); ?></label>
                <select id="SegmentId">
                    <?php foreach ($segments as $segment) {?>
                    <option value="<?php echo $segment["SegmentId"]; ?>" <?php echo (int)$userSegmentId==(int)$segment["SegmentId"]?"selected":""; ?> > <?php echo $segment["SegmentName"]; ?> </option>         
                    <?php  } ?>
                </select>

            </div>
        </div>
    </div>                         
</div>