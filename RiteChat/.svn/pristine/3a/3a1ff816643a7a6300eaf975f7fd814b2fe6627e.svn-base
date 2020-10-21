<?php if($type == "getGames"){?> 
<div class="row-fluid">
    <div class="span3 pull-right marginT10 padding-bottom10" style="position: relative">
       <div >
     
              <select id="gameAnalyticId"  class="styled textfield span12"  onclick="loadGameAnalytics()" > 
               <?php if(count($games)>0){ ?>          
                  <option   value="AllGames" > All Games </option>    
            <?php foreach ($games as $game) { ?>                                                         
                  <option style="background-color:<?php if($game['IsDeleted']==1) echo '#FF0033';else if($game['IsCurrentSchedule']==1) echo "#00FF00";else echo "";?>"  value="<?php echo $game['_id'] ?>" > <?php echo $game['GameName'] ?> </option>    
              <?php } }else {?>
                <option   value='0' > No Games</option>    
              <?php }?>   
             
        </select> 
          
 </div> 
    </div>
</div>
  
<?php }else if($type == "getCumilative"){
    $playersCount = $gameCumulativeAnalytics["playersCount"];
    $averageTime = $gameCumulativeAnalytics["averageTime"];
    $gameTotalPoints = $gameCumulativeAnalytics["gameTotalPoints"];
    $avgPoints = $gameCumulativeAnalytics["avgPoints"];
    
    
    ?> 
	<div class="row-fluid">
       <div class="span12">
       <div class="span4">
            <div class=" stats_div ">
            	<div class=" players">
                <label><?php echo  number_format($playersCount); ?></label>
                Players
                </div>
       		</div>
            </div>
       <div class="span4">
       	 <div class=" stats_div ">
            	<div class=" avg_time">
                <label><?php echo $averageTime; ?></label>
                Average Time
                </div>
            </div>
       </div>
       <div class="span4">
       	 <div class="stats_div">
            	<div class="avg_points">
                <label><?php echo number_format($avgPoints); ?>/<?php echo number_format($gameTotalPoints); ?></label>
               Avg Points/Total Points
                </div>
            </div>
       </div>
        </div>
     </div>
<?php }else{

?> 
<div style="position: relative">
        <div  class="block">
            <div class="block-heading" data-toggle="collapse"><div class="pull-left"></div><?php echo $gameName;?></div>
            <div class="pull-right" style="white-space:nowrap;cursor:pointer; position: relative;margin-top: -36px" class="dropdown pull-left">
                                    <a data-original-title="Advanced Options" rel="tooltip" data-placement="bottom" class="tooltiplink analytics_export " data-toggle="dropdown" id="drop2"><i><img src="/images/system/spacer.png" ><span class="fa fa-caret-down"></span></i></a>

                                    <div class="dropdown-menu analytics_export_div">

                                        <ul>
                                            
                                            <li class="" ><a href="#"  target="_blank" onclick="openGameAnalyticsPDF(this,'<?php echo $gameId;?>')" id="gameEngagmentPdf" name="engagmentPdf"><i><img src="/images/system/spacer.png"  class="pdf_doc"></i> Export as PDF</a></li>
                                            <li class="" ><a href="#"  onclick="openGameAnalyticsXls(this,'<?php echo $gameId;?>')" id="gameEngagementXls"  target="_blank"><i><img src="/images/system/spacer.png" class="excel_doc" onclick="openActivityXls()"></i> Export as Excel</a></li>
                                        </ul>

                                    </div>
                                  </div>
            
            
                
            <div id="tablewidget" style="margin: auto;">
                <span id="spinner_admin"></span>
                <table class="table table-hover">
                    <thead><tr><th>Game Name</th><th class="data_t_hide">Schedules</th><th>Players</th><th>Completed Players</th><th>Paused Players</th><th class="data_t_hide">Average Time</th><th>Avg Points/Total Points</th></tr></thead>
                    <tbody>
                        <?php if(count($gameDetailAnalytics)==0){?>
                        <tr id="noRecordsTR" >
                            <td colspan="8">
                                <span class="text-error"> <b>No records found</b></span>
                            </td>
                        </tr>
                        <?php }else{
                            $c=1;
                     foreach ($gameDetailAnalytics as $value) {
                            $scheduleGame = $value[0];
                            $gameBean = $value[1];
                        ?>   
                        <tr class="<?php if($c%2==0) echo "even";else echo "odd";?>">
                            <td>
                           <?php echo $scheduleGame->GameName;?>
                            </td>  
                            <td  class="data_t_hide">
                                <?php echo date(Yii::app()->params['PHPDateFormat'],CommonUtility::convert_date_zone($scheduleGame->StartDate->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));  ?>
                                 to   <?php echo date(Yii::app()->params['PHPDateFormat'],CommonUtility::convert_date_zone($scheduleGame->EndDate->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));  ?>
                                   
                            </td>
                            <td class="aligncenter">
                             <?php echo count($scheduleGame->Players)+count($scheduleGame->ResumePlayers);?>
                            </td>
                            <td class="aligncenter">
                             <?php echo count($scheduleGame->Players);?>
                            </td>
                            <td class="aligncenter">
                                                
                              
                                
                                  <?php echo count($scheduleGame->ResumePlayers);?>

                        
                            </td>
                           
                            <td class="aligncenter">                          
                                <?php echo $gameBean->averageTime;?>
                            </td>
                    <td>     
                          <?php echo number_format($gameBean->avgPoints);?>/<?php echo number_format($gameBean->gameTotalPoints);?>
                    </td>
                </tr>
                        <?php $c++;}}?>
            </tbody>
        </table>
        <div class="pagination pagination-right">
            <div id="pagination"></div>  
        </div>
    </div>        
</div>
</div>
<?php echo "**-numberOfRecords**". $totalCount; }?> 
