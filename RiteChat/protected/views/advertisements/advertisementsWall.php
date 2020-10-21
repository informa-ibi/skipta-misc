

<div style="position: relative">

    <div  class="block">
        <div class="tablehead pull-left" >                  

        </div>
        <div class="tablehead tableheadright pull-right">
            <div class="tabletopcorner">
                <input type="text" placeholder="search" class="textfield textfieldsearch" id="searchAdId" onkeypress="return searchAD(event)" />
            </div>
            <div class="tabletopcorner" >
                <select id="filter" class="styled textfield">
                    <option value="all">
                        All
                    </option>
                    <option value="active">
                        Active
                    </option>
                    <option value="inactive">
                        Inactive
                    </option> 
                    <option value="expired">
                        Expired
                    </option> 
                </select>
            </div>
            <div class="btn-group pagesize tabletopcorner tabletopcornerpaddingtop" >
                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" data-placement="top">Page size<span class="caret"></span></button>
                <ul class="dropdown-menu" style="min-width:70px">
                    <li><a  id="pagesize_5" onclick="setPageLength(5, 'advertisement')">5</a></li>
                    <li><a  id="pagesize_10" onclick="setPageLength(10, 'advertisement')">10</a></li>
                    <li><a  id="pagesize_15" onclick="setPageLength(15, 'advertisement')">15</a></li>                  
                </ul>
            </div>

            <div class="tabletopcorner tabletopcornerpaddingtop">
                <div class="label label-warning record_size " >+
                    <?php echo count($advertisements) ?>
                </div>
            </div>
        </div>  
        <span id="spinner_admin"></span>
        <a class="block-heading" data-toggle="collapse">&nbsp;</a>
        <div id="tablewidget"  style="margin: auto;">
            <table class="table table-hover">                     
                <thead><tr><th>Ad Name</th><th>Advertisement Type</th><th>Display Page</th><th>Display Position</th><th class="data_t_hide">Expiry Date</th><th>Time Interval</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    <tr id="noRecordsTR" style="display: none">
                        <td colspan="8">
                            <span class="text-error" style="text-align: center"> <b>No records found</b></span>
                        </td>
                    </tr>
                    <?php if (is_array($advertisements)) { ?>
                        <?php foreach ($advertisements as $ad) { ?>
                            <tr class="odd">
                                <td>
                                    <?php echo $ad['Name'] ?>



                                </td> 
                                <td>
                                    <?php echo $adTypes[$ad['AdTypeId']] ?>



                                </td>
                                <td>
                                    <?php echo $ad['DisplayPage'] ?>
                                </td>
                                <td>                                                
                                    <?php echo $ad['DisplayPosition'] ?>
                                </td>
                                <td class="data_t_hide">  
                                    
                                    <?php echo date("m/d/Y",strtotime($ad['ExpiryDate'] )); ?>
                                </td>

                                <td>                                                
                                    <?php if($ad['AdTypeId']==1 && $ad['IsAdRotate']==1){echo $ad['TimeInterval'] . " sec";} ?>

                                </td>

                                <td>

                                    <?php
                                    $expiryDate=strtotime($ad['ExpiryDate']);
                                    $currentDate=strtotime(date('Y-m-d'));
                                    
                                    
                                    if ($ad['Status'] == 1 && $currentDate<=$expiryDate) {

                                        echo 'Active';
                                    } else {
                                        echo 'InActive';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <?php if($currentDate<=$expiryDate){?>
                                    <a rel="tooltip" style="cursor: pointer;" onclick="editAdvertisement(<?php echo $ad['id']?>)" role="button"  data-toggle="tooltip" title="Edit" > <i class="fa fa-pencil-square"></i></a> 
                                    <?php }?>
                                     <?php if($ad['AdTypeId']==1){?>
                                    <a rel="tooltip" style="cursor: pointer;" onclick='showPreview("<?php echo $ad['id']?>","<?php echo $ad['Url']?>","<?php echo $ad['Type']?>","<?php echo $ad['DisplayPosition']?>","<?php echo $ad['DisplayPage']?>")' role="button"  data-toggle="tooltip" title="Preview" > <i class="icon-place-view"></i></a> 
                                     <?php }else{?>
                                     <a rel="tooltip" style="cursor: pointer;" onclick='showStreamAdPreview("<?php echo $ad['id']?>")' role="button"  data-toggle="tooltip" title="Preview" > <i class="icon-place-view"></i></a> 
                                     <?php }?>
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