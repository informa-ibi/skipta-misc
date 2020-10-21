<?php $count = count($abuseWords);
    $noDataStyle = $count>0?"none":"block";
    $dataExistStyle = $count>0?"block":"none";
?> 
<div class="alignright editlinks" >
    <i id="EditIcon"  class="fa fa-pencil-square-o editable_icons_big" style="display:<?php echo $dataExistStyle; ?>" onclick="showEditBlockwordDiv()"></i>
    <i id="AddIcon" class="fa fa-plus-square-o editable_icons_big"  style="display:<?php echo $noDataStyle; ?>" onclick="showAddBlockwordDiv()"></i>
</div>
<div class="nowordsfound" id="NoDataFound" style="display:<?php echo $noDataStyle; ?>">No Data Found</div>
<div class="abusedlist " id="DataFound" style="display:<?php echo $dataExistStyle; ?>">
    <?php
    $topictag = array();
    if (count($abuseWords) > 0) {
        foreach ($abuseWords as $key => $topic) {
            $topicinarray = array();
            $topicinarray['weight'] = $topic['Weightage'];
            $topicinarray['id'] = 2;
            $topicinarray['userid'] = 1;
            $topictag[$topic['AbuseWord']] = $topicinarray;
        }
    }
    $this->widget('application.extensions.YiiTagCloud.YiiTagCloud', array(
        'beginColor' => '00089A',
        'endColor' => 'A3AEFF',
        'minFontSize' => 8,
        'maxFontSize' => 20,
        'htmlOptions' => array('style' => 'width: 700px;color:#177D9E; margin-left: auto; margin-right: auto;'),
        'arrTags' => $topictag,
            )
    );
    ?>
</div>