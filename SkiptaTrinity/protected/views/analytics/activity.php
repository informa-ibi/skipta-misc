<?php
$dateFormat =  CommonUtility::getDateFormat();
    ?> 
<div class="row-fluid marginT10">
        <div class="sapn12">
            <div class="analytics_topleaders_box" style="border:0;box-shadow: 0 0 0 rgba(0, 0, 0, 0)" >
                 <div class="analytics_widgetheader">
                <div class="row-fluid">
                   
                    <div class="span12">
                        <div class="span4">
                            <div class="analytics_widgettitle">
                     <span class="">Activity <i class="cursor helpmanagement" data-id="ActivityHelpDescription_DivId" ><img src="/images/system/spacer.png" data-original-title="Activity Help" rel="tooltip" data-placement="bottom" /></i></span>
                    
                </div>
                        </div>
                         <div class="span8">
                        <div class="analytics_datepicker pull-right">
                            <ul class="anlt_datepic">
                                <li>
<!--                                    <div class="row-fluid">-->
                                        <div class="pull-right">

                                            <div data-date="" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" class="input-append date pull-left  " id="dpd1">

                                                <label>Start Date</label>
                                                <input type="text"  id="Activity_StartDate" readonly="readonly" class="textfield " maxlength="20" value="">    
                                                <span class="add-on">
                                                    <i class="fa fa-calendar"></i>
                                                </span>

                                            </div>

                                            <div data-date="" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" class="input-append date  pull-left" id="dpd2">

                                                <label>End Date</label>
                                                <input type="text"  id="Activity_EndDate"  readonly="readonly" class="textfield  " maxlength="20" value="">     
                                                <span class="add-on">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                               
                                            </div>

                                        </div>
<!--                                    </div>-->
                                </li>
                                <!-- -->
                                <li style="cursor:pointer; position: relative" class="dropdown analytics_export_opt">
                                    <a data-original-title="Advanced Options" rel="tooltip" data-placement="bottom" class="tooltiplink analytics_export " data-toggle="dropdown" id="drop2"><i><img src="/images/system/spacer.png" ><span class="fa fa-caret-down"></span></i></a>

                                    <div class="dropdown-menu analytics_export_div">

                                        <ul>

                                            <li class="" ><a href="/analytics/Pdf?date=1234"  target="_blank" onclick="openActivitypdf(this,'Activity')" id="ActivityPdf" name="ActivityPdf"><i><img src="/images/system/spacer.png"  class="pdf_doc"></i> Export as PDF</a></li>
                                            <li class="" ><a href="/analytics/GenerateXLS?startdate=1234&enddate=456"  onclick="openActivityXls(this,'Activity')" id="ActivityXls"  target="_blank"><i><img src="/images/system/spacer.png" class="excel_doc"></i> Export as Excel</a></li>

                                        </ul>

                                    </div>
                                  </li>
                            </ul>
                        </div>
                       
                        </div>
                        
                        
                        
                    </div>
                    
                   
                </div>
                 </div>
                <div id="activityimg_div" style="display: none;"></div>
                 <div id="Activity_Reports" style="position: relative;"></div>
                 <div style="padding:10px;background:#f4f4f4">
                 <div class="row-fluid">
                    <div class="sapn12 positionrelative">
                        
                             <div class=" dashboardboxgrey paddinglr6 paddingbottom6">
                        
                        <div class="row-fluid analyticsrow-fluid">
                             <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_chart_div" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Posts
                                                </div>
                                            </div>
                                        </div>
                                       <div id="chart_div"></div>  
                                    </div>
                                </div>    
                            
                            

                              
                                <div class="span4">
                                     <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_chart_div3" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                     Events
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chart_div3"></div>  
                                    </div>
                                </div> 
                            
                              <div class="span4">
                                     <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_chart_div4" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                   Quick Poll
                                                </div>
                                            </div>
                                        </div>
                                         <div id="chart_div4"></div> 
                                       
                                    </div>
                                </div>

                            </div>
                        
                        
                        <div class="row-fluid analyticsrow-fluid">
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                  <div id="loadingsmallinner_chart_div2" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Named Post
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chart_div2"></div>  
                                    </div>
                                </div>

                              
                                <div class="span4">
                                   <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                          <div id="loadingsmallinner_chart_div7" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                     News
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chart_div7"></div>  
                                    </div>
                                </div> 
                            
                              <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                       <div id="loadingsmallinner_chart_div8" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                    <?php echo Yii::t('translation','Games'); ?>
                                                </div>
                                            </div>
                                        </div>
                                         <div id="chart_div8"></div> 
                                       
                                    </div>
                                </div>

                            </div>
                        
                         <div class="row-fluid analyticsrow-fluid">
                               <div class="span4">
                                   <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                         <div id="loadingsmallinner_chart_div10" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                   Group Posts
                                                </div>
                                            </div>
                                        </div>
                                         <div id="chart_div10"></div> 
                                       
                                    </div>
                                </div>
<div class="span4">
                                   <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                                      <div id="loadingsmallinner_chart_div5" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Featured Items
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chart_div5"></div>  
                                    </div>
                                </div>
                           
                              
                                <div class="span4">
                                   <div class=" dashboardboxpadding6 padding-bottom dashboardboxgrey">
                                        <div class="row-fluid">
                                            <div class="span12">
                              <div id="loadingsmallinner_chart_div6" class="loaded"><span class="loadingsmallinner"></span> </div>

                                                <div class="dashboardbox_title paddinbbottom9">
                                                     Promoted Posts
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chart_div6"></div>  
                                    </div>
                                </div> 
                        

                            </div>
                    </div>
                       
                         
                     
                        
                        
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>

                
                