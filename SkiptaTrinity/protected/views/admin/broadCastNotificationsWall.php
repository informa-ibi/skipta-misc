
<div style="position: relative">

    <div  class="block">
               <div class="tablehead pull-left" >
                  
                  <div rel="tooltip" style="cursor: pointer;" onclick="createBroadCastNotificationForm()" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Create_Help'); ?>">
                        <i class="fa fa-plus-circle"></i>
                        </div>
            </div>
        <div class="tablehead tableheadright pull-right">
            <div class="tabletopcorner">
                <!--<input type="text" placeholder="<?php// echo Yii::t('translation','Search'); ?>" class="textfield textfieldsearch" id="searchMsgId" onkeypress="return searchMsg(event)" />-->
            </div>
           
            <div class="btn-group pagesize tabletopcorner tabletopcornerpaddingtop" >
                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" data-placement="top"><?php echo Yii::t('translation','Page_size'); ?><span class="caret"></span></button>
                <ul class="dropdown-menu" style="min-width:70px">
                    <li><a  id="pagesize_5" onclick="setPageLength(5, 'broadcastnotifications')">5</a></li>
                    <li><a  id="pagesize_10" onclick="setPageLength(10, 'broadcastnotifications')">10</a></li>
                    <li><a  id="pagesize_15" onclick="setPageLength(15, 'broadcastnotifications')">15</a></li>                  
                </ul>
            </div>

            <div class="tabletopcorner tabletopcornerpaddingtop">
                <div class="label label-warning record_size " >+
                    <?php echo  $totlacount ?>
                </div>
            </div>
        </div>  
        <span id="spinner_admin"></span>
        <a class="block-heading" data-toggle="collapse">&nbsp;</a>
        <div id="tablewidget"  style="margin: auto;">
            <table class="table table-hover">                     
                <thead><tr><th><?php echo Yii::t('translation','BCastMessage'); ?></th><th class="data_t_hide"><?php echo Yii::t('translation','NoOfUsersRead'); ?></th><th><?php echo Yii::t('translation','BroadCastedDate'); ?></th><th class="data_t_hide"><?php echo Yii::t('translation','Expiry_Date'); ?></th><th><?php echo Yii::t('translation','RedirectUrl'); ?></th></tr></thead>

                <tbody>
                    <tr id="noRecordsTR" style="display: none">
                        <td colspan="10">
                            <span class="text-error" style="text-align: center"> <b><?php echo Yii::t('translation','No_records_found'); ?></b></span>
                        </td>
                    </tr>
                    <?php if (is_array($notifications)) {  ?>
                        <?php foreach ($notifications as $notification) {    ?>
                            <tr class="odd">
                                <td style="max-width: 200px;word-wrap: break-word">
                                    <?php echo $notification->NotificationNote ?>
                                </td> 
                                <td class="data_t_hide">
                                    <?php echo sizeof($notification->ReadUsers) ?>
                                 </td>
                                <td class="data_t_hide">  
                                    
                                    <?php $stdate=$notification->CreatedOn; echo date("m/d/Y",$stdate->sec);  ?>
                                </td>
                                <td class="data_t_hide">  
                                    
                                    <?php 
                                    $exdate=$notification->ExpiryDate;
                                    echo !empty($exdate)?date("m/d/Y",$exdate->sec):""; ?>
                                </td>

                                <td style="max-width: 200px;word-wrap: break-word">
                                    <?php echo $notification->RedirectUrl ?>
                                </td>

                            </tr>

                        <?php } ?>
<?php } ?>
                </tbody>

            </table>

            <div class="pagination pagination-right">
                <div id="pagination"></div>  

            </div>
        </div>    
    </div>
</div>
<script type="text/javascript">
    Custom.init();
 </script>   