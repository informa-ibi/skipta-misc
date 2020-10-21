<?php if($totalCount<=0){ ?>
    <tr id="noRecordsTR" >
        <td colspan="2">
            <span class="text-error"> <b>No records found</b></span>
        </td>
    </tr>
<?php }else{
    if(is_object($abuseWords)){
        foreach($abuseWords as $abuseWord) {?>
            <tr class="odd">
                <td id="abuseWord_<?php echo $abuseWord->_id; ?>">
                            <?php echo $abuseWord->AbuseWord; ?>

                </td>  
                <td >  
                    <a id="editButton_<?php echo $abuseWord->_id; ?>" rel="tooltip" style="cursor: pointer;" onclick="openAbuseWordEditPopUp('<?php echo $abuseWord->_id; ?>','<?php echo $abuseWord->AbuseWord; ?>')" role="button"  data-toggle="tooltip" title="Update Block Word" > <i class="fa fa-pencil-square"></i></a> 
                </td>
            </tr>
<?php } }} ?>