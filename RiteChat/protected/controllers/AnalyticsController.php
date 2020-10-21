<?php

/**
 * Developer Name: Haribabu
 * Analytics Controller  class,  all Analytics module realted actions here 
 *
 */
class AnalyticsController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function init() {
       
        parent::init();
            if(isset(Yii::app()->session['TinyUserCollectionObj'])){
                 $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];
                $this->userPrivileges=Yii::app()->session['UserPrivileges'];
                $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
                $this->whichmenuactive=7;
             }else{
                  $this->redirect('/');
             }
        

    }
    
        /**
 * suresh reddy  for gloabl erro page
 */
     public function actionError()
{
 $cs = Yii::app()->getClientScript();
$baseUrl=Yii::app()->baseUrl; 
$cs->registerCssFile($baseUrl.'/css/error.css');
    if($error=Yii::app()->errorHandler->error)
        $this->render('error', $error);
}
    /**
     * This method is index file of curbside post
     *  @author Haribabu
     */
 public function actionIndex(){
     
 
    // $Topleaders = ServiceFactory::getSkiptaPostServiceInstance()->GetGoogleAnalyticsData();exit;
     // $Topleaders = ServiceFactory::getSkiptaPostServiceInstance()->SaveTopLeadersOfTheDay();exit;
     
        $Topleaders = ServiceFactory::getSkiptaPostServiceInstance()->GetTopLeadersOfTheDay();
        $Stats = ServiceFactory::getSkiptaUserServiceInstance()->getAnalyticsStats();
         $NewsAvailable=Yii::app()->params['News'];
        $this->render('index',array("stats"=>$Stats,"Topleaders"=>$Topleaders,"NewsAvailable"=>$NewsAvailable));
    }
    public function actiongetActivityDetails(){


      if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-7 days"));
        }
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
   $endDate = $endDate." 23:59:00";
        $GameAvailable=Yii::app()->params['Games'];
        $NewsAvailable=Yii::app()->params['News'];
        $NetworkId=$this->tinyObject['NetworkId'];
  $xyArray=array();
  
   if(Yii::app()->params['IsDSN']=='ON')
   {
        if($GameAvailable=='ON' && $NewsAvailable=='ON'){
           $xyArray = array('Year','Conversations','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations','News','Games'); 
        }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
            $xyArray = array('Year','Conversations','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations','Games'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='ON'){
            $xyArray = array('Year','Conversations','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations','News'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='OFF'){
             $xyArray = array('Year','Conversations','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations'); 
        }   

     $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'graph',$NetworkId,$GameAvailable,$NewsAvailable);
     
     foreach ($graphArray as $key => $value) {
       array_splice($graphArray[$key], 0, 1);
       
     }
   }
   else
   {
       
        if($GameAvailable=='ON' && $NewsAvailable=='ON'){
           $xyArray = array('Year', 'Posts', 'Curbside Consults','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations','News','Games'); 
        }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
            $xyArray = array('Year', 'Posts', 'Curbside Consults','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations','Games'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='ON'){
            $xyArray = array('Year', 'Posts', 'Curbside Consults','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations','News'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='OFF'){
             $xyArray = array('Year', 'Posts', 'Curbside Consults','Events','Surveys','Featured Items','Promoted Posts','Active Users','Comeback Users','Registrations'); 
        }   

     $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'graph',$NetworkId,$GameAvailable,$NewsAvailable);
   }
       $heighestValue = CommonUtility::get_highest($graphArray);
       
     $result = array("json"=>  json_encode($graphArray),"heighestValue"=>$heighestValue,'lablesArray'=>$xyArray);  
         

        
        echo $this->rendering($result); 
         
    }
    
     public function actiongetTrafficDetails(){

        if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-5 months"));
        }
        //$startDate = date("Y-m-d", strtotime("-5 months"));
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
        $endDate = $endDate." 23:59:00";
        if(isset ($_POST['groupId']) && $_POST['groupId']!='undefined'){
             $groupId = trim($_POST['groupId']);
              $IsGroup = 1;
             
        }else{
            $groupId = 0;
              $IsGroup = 0;
        }
     $type='graph';
     //$graphArray=ServiceFactory::getSkiptaPostServiceInstance()->GetAnalyticsReportsBasedonDateRange($startDate,$endDate,$groupId,$IsGroup,$type);
        //$heighestValue = CommonUtility::get_highest($graphArray);
        
    $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->GetUserLoginData($startDate,$endDate,$type);
        $heighestValue = CommonUtility::get_highest($graphArray);    
     $result = array("json"=>  json_encode($graphArray),"heighestValue"=>$heighestValue);  
         
        
        echo $this->rendering($result); 
         
    }

  public function actionGetEngagementDetails(){

    try{
      if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-7 days"));
        }
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
      $NetworkId=$this->tinyObject['NetworkId'];
      $GameAvailable=Yii::app()->params['Games'];
      $NewsAvailable=Yii::app()->params['News'];
      $endDate = $endDate." 23:59:00";
     
       
      $xyArray=array();
     if(Yii::app()->params['IsDSN']=='ON')
      {
          if($GameAvailable=='ON' && $NewsAvailable=='ON'){
           $xyArray = array('Year', 'Stream','Conversations','Events','Surveys','Groups','Hashtags','News','Games'); 
        }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
            $xyArray = array('Year', 'Stream','Conversations','Events','Surveys','Groups','Hashtags','Games'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='ON'){
            $xyArray = array('Year', 'Stream','Conversations','Events','Surveys','Groups','Hashtags','News'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='OFF'){
             $xyArray = array('Year', 'Stream','Conversations','Events','Surveys','Groups','Hashtags'); 
        }       
//       $startDate = CommonUtility::convert_time_zone(strtotime($startDate),  "PST",Yii::app()->session['timezone']);
//       $endDate =  CommonUtility::convert_time_zone(strtotime($endDate),"PST",Yii::app()->session['timezone']);
     $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->getEngagementAnalytics($startDate,$endDate,'graph',$NetworkId,$GameAvailable,$NewsAvailable);
        
     foreach ($graphArray as $key => $value) {
       array_splice($graphArray[$key], 0, 1);
       
     } 
      }
      else
      {
        if($GameAvailable=='ON' && $NewsAvailable=='ON'){
           $xyArray = array('Year', 'Stream','Posts','Curbside','Events','Surveys','Groups','Hashtags','News','Games'); 
        }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
            $xyArray = array('Year', 'Stream','Posts','Curbside','Events','Surveys','Groups','Hashtags','Games'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='ON'){
            $xyArray = array('Year', 'Stream','Posts','Curbside','Events','Surveys','Groups','Hashtags','News'); 
        }else if($GameAvailable=='OFF' && $NewsAvailable=='OFF'){
             $xyArray = array('Year', 'Stream','Posts','Curbside','Events','Surveys','Groups','Hashtags'); 
        }       
//       $startDate = CommonUtility::convert_time_zone(strtotime($startDate),  "PST",Yii::app()->session['timezone']);
//       $endDate =  CommonUtility::convert_time_zone(strtotime($endDate),"PST",Yii::app()->session['timezone']);
     $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->getEngagementAnalytics($startDate,$endDate,'graph',$NetworkId,$GameAvailable,$NewsAvailable);
      }
        $heighestValue = CommonUtility::get_highest($graphArray);
     $result = array("json"=>  json_encode($graphArray),"heighestValue"=>$heighestValue,'lablesArray'=>$xyArray);
        echo $this->rendering($result); 
    } catch (Exception $ex) {
        error_log("excpetion--------------".$exc->getMessage());
    }
     
      
     
    }
     
      public function actionGetGroupEngagementDetails(){

    try{
      if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-7 days"));
        }
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
         $endDate = $endDate." 23:59:00";
     $groupId = $_POST['groupId'];
     $NetworkId=$this->tinyObject['NetworkId'];
     $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->getGroupEngagementAnalytics($groupId,$startDate,$endDate,'graph',$NetworkId);
     $heighestValue = CommonUtility::get_highest($graphArray);
     $result = array("json"=>  json_encode($graphArray),"heighestValue"=>$heighestValue);
        echo $this->rendering($result); 
    } catch (Exception $ex) {

    }
     
      
     
    }

    
    public function actionPdf(){
    
        $date = $_REQUEST['date'];
        $analyticType = $_REQUEST['analyticType'];
        ob_start();
        $folder = $this->findUploadedPath();  
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->setDefaultFont("eotbold");
        $html2pdf->WriteHTML($this->renderPartial('htmlpage', array('date'=>$date,'analyticType'=>$analyticType,'configParams'=>Yii::app()->params), true));
        $certname="Reports ".date("Y-m-d").".pdf";
         ob_clean();
        $html2pdf->Output($certname,$folder);

    }
    
    public function actionAnalyticsSaveImageFromBase64(){
        try{        
            $data = $_REQUEST['imgData'];
            $img = str_replace('data:image/png;base64,', '', $data);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $userId = $this->tinyObject->UserId;
            $path = $this->findUploadedPath();
             $fileName = $path."/images/".$userId."_analyticsPDF.png";
            //save image from base64_string ...
            $success = file_put_contents($fileName, $data);
            $obj = array("data"=>"","status"=>$success);
        } catch (Exception $e) {
            error_log("############Exception rised in actionSaveImageFromBase64 ###############" . $e->getMessage());
        }           
        echo CJSON::encode($obj);
    }
    
     public function actionActivityGenerateXLS(){
        try{   
          //Some data
             $dateFormat = CommonUtility::getDateFormat();
             $startDate = trim($_REQUEST['startdate']);
             $endDate = trim($_REQUEST['enddate']);
             $GameAvailable=Yii::app()->params['Games'];
             $NewsAvailable=Yii::app()->params['News'];
               $startDate=DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
               $endDate=DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
                $endDate = $endDate." 23:59:00";
               $NetworkId=$this->tinyObject['NetworkId'];
               $featuredItems = ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'report',$NetworkId,$GameAvailable,$NewsAvailable);  

               $ActivityColumnsArray=array();
               
             if(Yii::app()->params['IsDSN']=='ON')
               {
                  //This code is changed for Disease Network      
               if ($GameAvailable == 'ON' && $NewsAvailable == 'ON') {
                                $ActivityColumnsArray = array('Date','Conversations', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations', 'News', 'Games');
                            } else if ($GameAvailable == 'ON' && $NewsAvailable == 'OFF') {
                                $ActivityColumnsArray = array('Date','Conversations', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations', 'Games');
                            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'ON') {
                                $ActivityColumnsArray = array('Date','Conversations', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations', 'News');
                            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'OFF') {
                                $ActivityColumnsArray = array('Date','Conversations', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations');
                            }
                        foreach ($featuredItems as $key => $value) {
                              array_splice($featuredItems[$key], 0, 1);

                            }

                         $data=array();
                          $i=0;
                        foreach ($featuredItems as $key => $value) {
                           $j=0;
                            //$data[$i][$j]=date($dateFormat,strtotime($key));
                            $data[$i][$j]=$key;
                            $data[$i][$j+1]=$value[$j];
                            $data[$i][$j+2]=$value[$j+1];
                            $data[$i][$j+3]=$value[$j+2];
                            $data[$i][$j+4]=$value[$j+3];
                            $data[$i][$j+5]=$value[$j+4];
                            $data[$i][$j+6]=$value[$j+5];
                            $data[$i][$j+7]=$value[$j+6];
                            $data[$i][$j+8]=$value[$j+7];
                            $data[$i][$j+9]=$value[$j+8];
                             if($NewsAvailable=='ON' ){
                                 $data[$i][$j+9]=$value[$j+8];
                            }
                            if($GameAvailable=='ON' && $NewsAvailable=='ON'){
                                $data[$i][$j+10]=$value[$j+9];
                            }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
                                 $data[$i][$j+9]=$value[$j+10];
                            }

                            $i++;
                        } 
               }
       else
       {
               if ($GameAvailable == 'ON' && $NewsAvailable == 'ON') {
                $ActivityColumnsArray = array('Date', 'Posts', 'Curbside Consults', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations', 'News', 'Games');
            } else if ($GameAvailable == 'ON' && $NewsAvailable == 'OFF') {
                $ActivityColumnsArray = array('Date', 'Posts', 'Curbside Consults', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations', 'Games');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'ON') {
                $ActivityColumnsArray = array('Date', 'Posts', 'Curbside Consults', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations', 'News');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'OFF') {
                $ActivityColumnsArray = array('Date', 'Posts', 'Curbside Consults', 'Events', 'Surveys', 'FeaturedItems', 'PromotedPosts', 'ActiveUsers', 'ComebackUsers', 'Registrations');
            }

          
         $data=array();
          $i=0;
        foreach ($featuredItems as $key => $value) {
           $j=0;
            //$data[$i][$j]=date($dateFormat,strtotime($key));
            $data[$i][$j]=$key;
            $data[$i][$j+1]=$value[$j];
            $data[$i][$j+2]=$value[$j+1];
            $data[$i][$j+3]=$value[$j+2];
            $data[$i][$j+4]=$value[$j+3];
            $data[$i][$j+5]=$value[$j+4];
            $data[$i][$j+6]=$value[$j+5];
            $data[$i][$j+7]=$value[$j+6];
            $data[$i][$j+8]=$value[$j+7];
            $data[$i][$j+9]=$value[$j+8];
             if($NewsAvailable=='ON' ){
                 $data[$i][$j+10]=$value[$j+9];
            }
            if($GameAvailable=='ON' && $NewsAvailable=='ON'){
                $data[$i][$j+11]=$value[$j+10];
            }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
                 $data[$i][$j+10]=$value[$j+9];
            }
            
            $i++;
          }
       }
        
        $r = new YiiReport(array('template'=> 'Activity.xls'));
$f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'Activity Report',
                         'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                         'footer' => str_replace('&copy;',"",$f),
                    )
                ),
            )
        );
        CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$ActivityColumnsArray, $data);
     $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'Activity');
        
        Yii::app()->end();
            
      } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        } 
    }
      public function actionEngagementGenerateXLS(){
        try{   
             
          //Some data
          $dateFormat = CommonUtility::getDateFormat();
            $startDate = trim($_REQUEST['startdate']);
            $endDate = trim($_REQUEST['enddate']);
            $NetworkId = $this->tinyObject['NetworkId'];
             $GameAvailable=Yii::app()->params['Games'];
             $NewsAvailable=Yii::app()->params['News'];
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
             $endDate = $endDate." 23:59:00";
            $graphArray = ServiceFactory::getSkiptaPostServiceInstance()->getEngagementAnalytics($startDate, $endDate, 'xls', $NetworkId,$GameAvailable,$NewsAvailable);

            // $featuredItems = ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'report',$NetworkId);  
              $EngagementColumnsArray=array();
              if(Yii::app()->params['IsDSN']=='ON')
              {
                if($GameAvailable=='ON'){
               $EngagementColumnsArray=array('Date','Stream','Conversations','EventPosts','SurveyPosts','Groups','Hashtags','News','Games');
            }else{
                 $EngagementColumnsArray=array('Date','Stream','Conversations','EventPosts','SurveyPosts','Groups','Hashtags','News');
            }
               if ($GameAvailable == 'ON' && $NewsAvailable == 'ON') {
                $EngagementColumnsArray = array('Date','Stream','Conversations','EventPosts','SurveyPosts','Groups','Hashtags','News','Games');
            } else if ($GameAvailable == 'ON' && $NewsAvailable == 'OFF') {
                $EngagementColumnsArray = array('Date','Stream','Conversations','EventPosts','SurveyPosts','Groups','Hashtags','Games');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'ON') {
                $EngagementColumnsArray = array('Date','Stream','Conversations','EventPosts','SurveyPosts','Groups','Hashtags','News');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'OFF') {
                $EngagementColumnsArray = array('Date','Stream','Conversations','EventPosts','SurveyPosts','Groups','Hashtags');
            }

            foreach ($graphArray as $key => $value) {
                array_splice($graphArray[$key], 0, 1);
            }

            $data=array();
          $i=0;
        foreach ($graphArray as $key => $value) {
           $j=0;
           // $data[$i][$j]=date($dateFormat,strtotime($key));
            $data[$i][$j]=$key;
            $data[$i][$j+1]=$value[$j];
            $data[$i][$j+2]=$value[$j+1];
            $data[$i][$j+3]=$value[$j+2];
            $data[$i][$j+4]=$value[$j+3];
            $data[$i][$j+5]=$value[$j+4];
            $data[$i][$j+6]=$value[$j+5];
            $data[$i][$j+7]=$value[$j+6];
           // $data[$i][$j+8]=$value[$j+7];
           
             if($NewsAvailable=='ON' ){
                 $data[$i][$j+7]=$value[$j+6];
            }
            if($GameAvailable=='ON' && $NewsAvailable=='ON'){
                $data[$i][$j+8]=$value[$j+7];
            }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
                 $data[$i][$j+7]=$value[$j+6];
            }
            $i++;
        }   
              }
              else
              {
               if($GameAvailable=='ON'){
               $EngagementColumnsArray=array('Date','Stream','Posts','CurbsidePosts','EventPosts','SurveyPosts','Groups','Hashtags','News','Games');
            }else{
                 $EngagementColumnsArray=array('Date','Stream','Posts','CurbsidePosts','EventPosts','SurveyPosts','Groups','Hashtags','News');
            }
               if ($GameAvailable == 'ON' && $NewsAvailable == 'ON') {
                $EngagementColumnsArray = array('Date','Stream','Posts','CurbsidePosts','EventPosts','SurveyPosts','Groups','Hashtags','News','Games');
            } else if ($GameAvailable == 'ON' && $NewsAvailable == 'OFF') {
                $EngagementColumnsArray = array('Date','Stream','Posts','CurbsidePosts','EventPosts','SurveyPosts','Groups','Hashtags','Games');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'ON') {
                $EngagementColumnsArray = array('Date','Stream','Posts','CurbsidePosts','EventPosts','SurveyPosts','Groups','Hashtags','News');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'OFF') {
                $EngagementColumnsArray = array('Date','Stream','Posts','CurbsidePosts','EventPosts','SurveyPosts','Groups','Hashtags');
            }

            
            
            
         $data=array();
          $i=0;
        foreach ($graphArray as $key => $value) {
           $j=0;
           // $data[$i][$j]=date($dateFormat,strtotime($key));
            $data[$i][$j]=$key;
             $data[$i][$j+1]=$value[$j];
            $data[$i][$j+2]=$value[$j+1];
            $data[$i][$j+3]=$value[$j+2];
            $data[$i][$j+4]=$value[$j+3];
            $data[$i][$j+5]=$value[$j+4];
            $data[$i][$j+6]=$value[$j+5];
            $data[$i][$j+7]=$value[$j+6];
            $data[$i][$j+8]=$value[$j+7];
           
             if($NewsAvailable=='ON' ){
                 $data[$i][$j+8]=$value[$j+7];
            }
            if($GameAvailable=='ON' && $NewsAvailable=='ON'){
                $data[$i][$j+9]=$value[$j+8];
            }else if($GameAvailable=='ON' && $NewsAvailable=='OFF'){
                 $data[$i][$j+8]=$value[$j+7];
            }
            $i++;
        }
              }
       
        $r = new YiiReport(array('template'=> 'Engagement.xls'));
$f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'Name' => 'Engagement Report',
                        'Date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                        'footer' => str_replace('&copy;',"",$f),
                    )
                ),
//                array(
//                    'id'=>'estu',
//                    'repeat'=>true,
//                    'data'=>$data,
//                    'minRows'=>2
//                )
            )
        );
        CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$EngagementColumnsArray, $data);
        $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'Engagement');
        Yii::app()->end();

      } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        } 
    }  
     public function actionGroupEngagementGenerateXLS(){
        try{   
          //Some data
              $dateFormat =  CommonUtility::getDateFormat();
                $startDate = trim($_REQUEST['startdate']);
               $endDate = trim($_REQUEST['enddate']);

        $startDate=DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
       $endDate=DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
        $endDate = $endDate." 23:59:00";
                $groupId = trim($_REQUEST['groupId']);
                 
                   $NetworkId=$this->tinyObject['NetworkId'];
           $graphArray=ServiceFactory::getSkiptaPostServiceInstance()->getGroupEngagementAnalytics($groupId,$startDate,$endDate,'xls',$NetworkId);
   
              // $featuredItems = ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'report',$NetworkId);  

         $data=array();
          $i=0;
        foreach ($graphArray as $key => $value) {
           $j=0;
           // $data[$i]['Date']=date($dateFormat,strtotime($key));
             $data[$i]['Date']=$key;
             $data[$i]['Stream']=$value[$j];
            $data[$i]['Posts']=$value[$j+1];
             $data[$i]['SubGroups']=$value[$j+2];
            $data[$i]['EventPosts']=$value[$j+3];
            $data[$i]['SurveyPosts']=$value[$j+4];
            $data[$i]['Search']=$value[$j+5];
            $data[$i]['Hashtags']=$value[$j+6];
           
            $i++;
        }
        
        $r = new YiiReport(array('template'=> 'GroupEngagement.xls'));
  $f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'Name' => 'Group Engagement Report',
                        'Date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                        'footer' => str_replace('&copy;',"",$f),
                    )
                ),
                array(
                    'id'=>'estu',
                    'repeat'=>true,
                    'data'=>$data,
                    'minRows'=>2
                )
            )
        );
        $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'GroupEngagement');
        Yii::app()->end();

      } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        } 
    } 
         function findUploadedPath() {
     
        try {
          $originalPath="";
            $path = dirname(__FILE__);
            $pathArray = explode('/', $path);
            $appendPath = "";
            for ($i = count($pathArray) - 3; $i > 0; $i--) {
                $appendPath = "/" . $pathArray[$i] . $appendPath;
            }
            
            $originalPath = $appendPath;
        } catch (Exception $ex) {
            error_log("#########Exception Occurred########$ex->getMessage()");
        }
        return $originalPath;
 } 
 

 
 public function actionTrafficGenerateXLS(){
        try{   
          //Some data
             $startDate = trim($_REQUEST['startdate']);
             $endDate = trim($_REQUEST['enddate']);

               $startDate=DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
                $endDate=DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
                 $endDate = $endDate." 23:59:00";
               $NetworkId=$this->tinyObject['NetworkId'];
               $groupId = 0;
               $IsGroup = 0;
               $type="report";
             //$featuredItems=ServiceFactory::getSkiptaPostServiceInstance()->GetAnalyticsReportsBasedonDateRange($startDate,$endDate,$groupId,$IsGroup,$type);  //Original 
            //$featuredItems = ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'report',$NetworkId);  
                $featuredItems=ServiceFactory::getSkiptaPostServiceInstance()->GetUserLoginData($startDate,$endDate,$type);
                //print_r($featuredItems);                die();
         $data=array();
          $i=0;
        foreach ($featuredItems as $key => $value) {
           $j=0;
            //$data[$i]['date']=date(Yii::app()->params['PHPDateFormat'],strtotime($key));
            $data[$i]['date']=$key;
            $data[$i]['Pageviews']=$value[$j];
            //$data[$i]['']=$value[$j+1];
            $i++;
        }
        

        $r = new YiiReport(array('template'=> 'Traffic.xls'));

        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'Traffic Report',
                         'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate']
                    )
                ),
                array(
                    'id'=>'estu',
                    'repeat'=>true,
                    'data'=>$data,
                    'minRows'=>2
                )
            )
        );
        $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'Traffic');
        Yii::app()->end();
            
      } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        } 
    }
    
     public function actiongetUsabilityDetails(){
         try {

                if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
                   $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
               } else {
                   $startDate = date('Y-m-d', strtotime("-7 days"));
               }
               if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
                   $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
               } else {
                   $endDate = date("Y-m-d", time());
               }
                $endDate = $endDate." 23:59:00";
               $NetworkId=$this->tinyObject['NetworkId'];


                if ($_POST['UsabilityType'] == 'Device') {
                       $usabilityType = 'Device';
                       $deviceGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetDeviceUsabilityBasedOnDateRangeAndType($startDate, $endDate, 'graph');

                       $heighestValue = CommonUtility::get_highest($deviceGraphArray);
                       $result = array("json" => json_encode($deviceGraphArray), "heighestValue" => $heighestValue);
                       echo $this->rendering($result);
                   }
                   if ($_POST['UsabilityType'] == 'Location') {
                       $usabilityType = 'Location';
                       $locationGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetLocationUsabilityBasedOnDateRangeAndType($startDate, $endDate, 'graph');
                       $heighestValue = CommonUtility::get_highest($locationGraphArray);
                       $result = array("json" => json_encode($locationGraphArray), "heighestValue" => $heighestValue);
                       echo $this->rendering($result);
                   }

                   if ($_POST['UsabilityType'] == 'Browser') {
                       $usabilityType = 'Browser';
                       $browserGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetBrowserUsabilityBasedOnDateRangeAndType($startDate, $endDate, 'graph');

                       $heighestValue = CommonUtility::get_highest($browserGraphArray);
                       $result = array("json" => json_encode($browserGraphArray), "heighestValue" => $heighestValue);
                       echo $this->rendering($result);
                   }
        } catch (Exception $ex) {
            error_log("############Exception occurred in actiongetUsabilityDetails ###############" . $ex->getMessage());
        }
    }

    public function actiongetUsabilityPieChartDetails(){
  if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-7 days"));
        }
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
         $endDate = $endDate." 23:59:00";
        if($_POST['UsabilityType']=='Device'){
            $usabilityType ='Device';
            $devicePieGraphArray=ServiceFactory::getSkiptaUserServiceInstance()->GetDeviceUsabilityPieChartBasedOnDateRangeAndType($startDate,$endDate);
            $result = array("json"=> CJSON::encode($devicePieGraphArray));
            echo $this->rendering($result);
        }
        if($_POST['UsabilityType']=='Location'){
            $usabilityType ='Location';
            $locationPieGraphArray=ServiceFactory::getSkiptaUserServiceInstance()->GetLocationPieChartBasedOnDateRangeAndType($startDate,$endDate,'graph');
   
         $result = array("json"=> CJSON::encode($locationPieGraphArray));
         echo $this->rendering($result);
        }
     
        if($_POST['UsabilityType']=='Browser'){
            $usabilityType ='Browser';
            $browserPieGraphArray=ServiceFactory::getSkiptaUserServiceInstance()->GetBrowserUsabilityPieChartBasedOnDateRangeAndType($startDate,$endDate,'graph');
   
            $result = array("json"=> CJSON::encode($browserPieGraphArray));
            echo $this->rendering($result);
        }
    }

    
     public function actionGetGroupActivityDetails() {

        try {
           
      if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-7 days"));
        }
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
 $endDate = $endDate." 23:59:00";

            $groupId = $_POST['groupId'];
            $NetworkId = $this->tinyObject['NetworkId'];
            $activityArray = ServiceFactory::getSkiptaPostServiceInstance()->GetGroupActivityPostsBasedonDateRangeAndType($groupId, $startDate, $endDate, $NetworkId, 'graph');
            $heighestValue = CommonUtility::get_highest($activityArray);
            $result = array("json" => json_encode($activityArray),"heighestValue"=>$heighestValue);
            echo $this->rendering($result);
        } catch (Exception $ex) {
            
        }
        
    }
    
     /**
     * @author: Praneeth
     * Method: To generate xls sheet for pie and line chart for Device Usability
     */
    public function actionDeviceUsabilityGenerateXLS(){
        try{   
          //Some data
             $startDate = trim($_REQUEST['startdate']);
            $endDate = trim($_REQUEST['enddate']);
            $chartType = trim($_REQUEST['chartType']);


            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
             $endDate = $endDate." 23:59:00";
            $NetworkId=$this->tinyObject['NetworkId'];
               if($chartType=='linechart')
               {
                     $deviceGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetDeviceUsabilityBasedOnDateRangeAndType($startDate, $endDate, 'xls');

                     $i = 0;

                     $deviceUsabilityColumnsArray = array();
                     $deviceUsabilityDataArray = array();

                     $z = -1;

                     $deviceUsabilityColumnsArray = $deviceGraphArray['Year'];
                     unset($deviceGraphArray['Year']); // $deviceGraphArray;
                     foreach ($deviceGraphArray as $key => $innerArray) {
                         for ($j = 0; $j < count($innerArray) + 1; $j++) {
                             if ($z != $i) {
                                 $deviceUsabilityDataArray[$i + 1][$j] = $key;
                             } else {
                                 $deviceUsabilityDataArray[$i + 1][$j] = $innerArray[$j - 1];
                             }

                             $z = $i;
                         }
                         $i++;
                     }

                     $insertAtBegining = array(0 => 'Date');
                     $deviceUsabilityColumnsArray = array_merge($insertAtBegining, $deviceUsabilityColumnsArray);
                     array_values($deviceUsabilityColumnsArray);
                     $deviceUsabilityColumnsArray = array_values($deviceUsabilityColumnsArray);
                     $deviceUsabilityDataArray = array_values($deviceUsabilityDataArray);

                     $f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
                     $r = new YiiReport(array('template'=> 'Usability.xls'));

                     $r->load(array(
                            array(
                                'id' => 'ong',
                                'data' => array(
                                    'name' => 'Usability Report',
                                     'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                                     'footer' => str_replace('&copy;',"",$f),
                                )
                            )
                        )
                     );

                    CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$deviceUsabilityColumnsArray, $deviceUsabilityDataArray);
                    $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                    CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);

                     echo $r->render('excel5', 'Device Usability');
                     Yii::app()->end();
            }
            if($chartType=='piechart')
            {
                $devicePieGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetDeviceUsabilityPieChartBasedOnDateRangeAndType($startDate, $endDate, 'graph');
                $data = array();
                $i = 0;
                foreach ($devicePieGraphArray as $key => $value) {
                    $data[$i]['device'] = $value['device'];
                        $data[$i]['count'] = $value['count'];
                        $i++;
                }

                $r = new YiiReport(array('template' => 'devicePieChartUsability.xls'));
                $r->load(array(
                    array(
                        'id' => 'ong',
                        'data' => array(
                            'Name' => 'Device Usability Pie chart Report',
                            'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                        )
                    ),
                    array(
                        'id' => 'estu',
                        'repeat' => true,
                        'data' => $data,
                        'minRows' => 2
                    )
                        )
                );
                $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                echo $r->render('excel5', 'devicePieChart');
                Yii::app()->end();
            }
        } catch (Exception $ex) {
            error_log("############Exception occurred in Device GenerateXLS ###############" . $ex->getMessage());
        }
    }

    public function actionGroupTrafficGenerateXLS(){
        try{   
          if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
        } else {
            $startDate = date('Y-m-d', strtotime("-7 days"));
        }
        if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
        } else {
            $endDate = date("Y-m-d", time());
        }
         $endDate = $endDate." 23:59:00";
            if(isset ($_REQUEST['groupId']) && $_REQUEST['groupId']!='undefined'){
                    $groupId = trim($_REQUEST['groupId']);
                    $IsGroup = 1;
                } else {
                    $groupId = 0;
                    $IsGroup = 0;
                }
            $type='report';
            $featuredItems=ServiceFactory::getSkiptaPostServiceInstance()->GetAnalyticsReportsBasedonDateRange($startDate,$endDate,$groupId,$IsGroup,$type);   
            //$featuredItems = ServiceFactory::getSkiptaPostServiceInstance()->GetPostsBasedonDateRangeAndType($startDate,$endDate,'report',$NetworkId);  

         $data=array();
          $i=0;
        foreach ($featuredItems as $key => $value) {
           $j=0;
           $data[$i]['date']=date('m/d/Y',strtotime($key));
            $data[$i]['Pageviews']=$value[$j];
            $data[$i]['Pagevisits']=$value[$j+1];
            $i++;
        }
        
        $r = new YiiReport(array('template'=> 'Traffic.xls'));

        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'Group Traffic Report',
                        'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate']
                    )
                ),
                array(
                    'id'=>'estu',
                    'repeat'=>true,
                    'data'=>$data,
                    'minRows'=>2
                )
            )
        );
        $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'Traffic');
        Yii::app()->end();
            
      } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        } 
    }
    
    public function actionGroupActivityGenerateXLS() {
        try {
            //Some data
            $startDate = trim($_REQUEST['startdate']);
            $endDate = trim($_REQUEST['enddate']);

            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
             $endDate = $endDate." 23:59:00";
            $groupId = trim($_REQUEST['groupId']);
            $NetworkId = $this->tinyObject['NetworkId'];
            $activityArray = ServiceFactory::getSkiptaPostServiceInstance()->GetGroupActivityPostsBasedonDateRangeAndType($groupId, $startDate, $endDate, $NetworkId, 'xls');

            $data = array();
            $i = 0;
            foreach ($activityArray as $key => $value) {
                $j = 0;
                $data[$i]['Date'] = $key;
                $data[$i]['Posts'] = $value[$j];
                $data[$i]['EventPosts'] = $value[$j + 1];
                $data[$i]['SurveyPosts'] = $value[$j + 2];
                $data[$i]['Follows'] = $value[$j + 3];
                $data[$i]['ActiveUsers'] = $value[$j + 4];
                $data[$i]['ComebackUsers'] = $value[$j + 5];
                $i++;
            }

            $r = new YiiReport(array('template' => 'GroupActivity.xls'));

            $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'Name' => 'Group Activity Report',
                        'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                    )
                ),
                array(
                    'id' => 'estu',
                    'repeat' => true,
                    'data' => $data,
                    'minRows' => 2
                )
                    )
            );
       $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
            echo $r->render('excel5', 'GroupActivity');
            Yii::app()->end();
        } catch (Exception $ex) {
            error_log("############Exception occurred in GenerateXLS ###############" . $ex->getMessage());
        }
    }
    
    /**
     * @author: Praneeth
     * Method: To generate xls sheet for pie and line chart for Location Usability
     */
    public function actionLocationUsabilityGenerateXLS(){
        try{   
          //Some data
             $startDate = trim($_REQUEST['startdate']);
             $endDate = trim($_REQUEST['enddate']);
             $chartType = trim($_REQUEST['chartType']);

           $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
              $endDate = $endDate." 23:59:00";
               $NetworkId=$this->tinyObject['NetworkId'];
               
               if($chartType=='linechart')
               {
                    $locationGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetLocationUsabilityBasedOnDateRangeAndType($startDate, $endDate, 'xls');

                    $i = 0;

                    $locationUsabilityColumnsArray = array();
                    $locationUsabilityDataArray = array();

                    $z = -1;

                    $locationUsabilityColumnsArray = $locationGraphArray['Year'];
                    unset($locationGraphArray['Year']); // $deviceGraphArray;
                    foreach ($locationGraphArray as $key => $innerArray) {
                        for ($j = 0; $j < count($innerArray) + 1; $j++) {
                            if ($z != $i) {
                                $locationUsabilityDataArray[$i + 1][$j] = $key;
                            } else {
                                $locationUsabilityDataArray[$i + 1][$j] = $innerArray[$j - 1];
                            }

                            $z = $i;
                        }

                        $i++;
                    }


                    $insertAtBegining = array(0 => 'Date');
                    $locationUsabilityColumnsArray = array_merge($insertAtBegining, $locationUsabilityColumnsArray);
                    array_values($locationUsabilityColumnsArray);
                    $locationUsabilityColumnsArray = array_values($locationUsabilityColumnsArray);
                    $locationUsabilityDataArray = array_values($locationUsabilityDataArray);

                    $f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
                    $r = new YiiReport(array('template'=> 'Usability.xls'));

                    $r->load(array(
                            array(
                                'id' => 'ong',
                                'data' => array(
                                    'name' => 'Usability Locations Report',
                                     'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                                     'footer' => str_replace('&copy;',"",$f),
                                )
                            )
                        )
                     );
                    $r->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                    CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$locationUsabilityColumnsArray, $locationUsabilityDataArray);
                    
                    $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                    CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                    echo $r->render('excel5', 'Location Usability');
                    Yii::app()->end();
            }
            
            if($chartType=='piechart')
            {
                $locationPieGraphArray=ServiceFactory::getSkiptaUserServiceInstance()->GetLocationPieChartBasedOnDateRangeAndType($startDate,$endDate,'graph');
                $data = array();
                $i = 0;
                foreach ($locationPieGraphArray as $key => $value) {
                    $data[$i]['locations'] = $value['locations'];
                        $data[$i]['count'] = $value['count'];
                        $i++;
                }

                $r = new YiiReport(array('template' => 'locationPieChartUsability.xls'));
                $r->load(array(
                    array(
                        'id' => 'ong',
                        'data' => array(
                            'Name' => 'Location Usability Pie chart Report',
                            'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                        )
                    ),
                    array(
                        'id' => 'estu',
                        'repeat' => true,
                        'data' => $data,
                        'minRows' => 2
                    )
                        )
                );
                $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                echo $r->render('excel5', 'locationPieChart');
                Yii::app()->end();
            }
               
        } catch (Exception $ex) {
            error_log("############Exception occurred in location usability GenerateXLS ###############" . $ex->getMessage());
        }
    }
    
    
    /**
     * @author: Praneeth
     * Method: To generate xls sheet for pie and line chart for Browser Usability
     */
    public function actionBrowserUsabilityGenerateXLS(){
        try{   
          //Some data
             $startDate = trim($_REQUEST['startdate']);
             $endDate = trim($_REQUEST['enddate']);
             $chartType = trim($_REQUEST['chartType']);

            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
              $endDate = $endDate." 23:59:00";
               $NetworkId=$this->tinyObject['NetworkId'];
               if($chartType=='linechart')
               {
                $browserGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetBrowserUsabilityBasedOnDateRangeAndType($startDate, $endDate, 'xls');
                
                $i = 0;

                $browserUsabilityColumnsArray = array();
                $browserUsabilityDataArray = array();

                $z = -1;

                $browserUsabilityColumnsArray = $browserGraphArray['Year'];
                unset($browserGraphArray['Year']); // $deviceGraphArray;
                foreach ($browserGraphArray as $key => $innerArray) {
                    for ($j = 0; $j < count($innerArray) + 1; $j++) {
                        if ($z != $i) {
                            $browserUsabilityDataArray[$i + 1][$j] = $key;
                        } else {
                            $browserUsabilityDataArray[$i + 1][$j] = $innerArray[$j - 1];
                        }
                        $z = $i;
                    }
                    $i++;
                }

                $insertAtBegining = array(0 => 'Date');
                $browserUsabilityColumnsArray = array_merge($insertAtBegining, $browserUsabilityColumnsArray);
                array_values($browserUsabilityColumnsArray);
                $browserUsabilityColumnsArray = array_values($browserUsabilityColumnsArray);
                $browserUsabilityDataArray = array_values($browserUsabilityDataArray);


                $f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
                    $r = new YiiReport(array('template'=> 'Usability.xls'));

                    $r->load(array(
                            array(
                                'id' => 'ong',
                                'data' => array(
                                    'name' => 'Browser Usability Report',
                                     'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                                     'footer' => str_replace('&copy;',"",$f),
                                )
                            )
                        )
                     );
                    //$r->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                    CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$browserUsabilityColumnsArray, $browserUsabilityDataArray);
                    
$logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                echo $r->render('excel5', 'Browser Usability');
                Yii::app()->end();
            }
            
            if($chartType=='piechart')
            {
                $browserPieGraphArray=ServiceFactory::getSkiptaUserServiceInstance()->GetBrowserUsabilityPieChartBasedOnDateRangeAndType($startDate,$endDate,'graph');
                $data = array();
                $i = 0;
                foreach ($browserPieGraphArray as $key => $value) {
                    $data[$i]['browser'] = $value['browser'];
                        $data[$i]['count'] = $value['count'];
                        $i++;
                }

                $r = new YiiReport(array('template' => 'browserPieChartUsability.xls'));
                $r->load(array(
                    array(
                        'id' => 'ong',
                        'data' => array(
                            'Name' => 'Browser Usability Pie chart Report',
                            'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                        )
                    ),
                    array(
                        'id' => 'estu',
                        'repeat' => true,
                        'data' => $data,
                        'minRows' => 2
                    )
                        )
                );
                $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                echo $r->render('excel5', 'browserPieChart');
                Yii::app()->end();
            }
               
              
        } catch (Exception $ex) {
            error_log("############Exception occurred in browser usability GenerateXLS ###############" . $ex->getMessage());
        }
    }
    
     /**
     * @author: Praneeth
     * Method: To display Line chart for group Usability
     */
    
    public function actiongetGroupUsabilityDetails(){
         try {

                if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
                   $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
               } else {
                   $startDate = date('Y-m-d', strtotime("-7 days"));
               }
               if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
                   $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
               } else {
                   $endDate = date("Y-m-d", time());
               }
            $endDate = $endDate." 23:59:00";
               $NetworkId=$this->tinyObject['NetworkId'];
               $groupId = $_POST['groupId'];

               $usabilityType = $_POST['UsabilityType'];
               $groupLineGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetGroupUsabilityLineChartBasedOnDateRangeAndType($groupId,$startDate, $endDate, $usabilityType,'graph');

               $heighestValue = CommonUtility::get_highest($groupLineGraphArray);
               $result = array("json" => json_encode($groupLineGraphArray), "heighestValue" => $heighestValue);
               echo $this->rendering($result);

        } catch (Exception $ex) {
            error_log("############Exception occurred in actiongetUsabilityDetails ###############" . $ex->getMessage());
        }
    }
    
     
    /**
     * @author: Praneeth
     * Method: To display pie chart for group Usability
     */
     public function actiongetGroupUsabilityPieChartDetails(){
         try {
            if (isset($_POST['startDate']) && $_POST['startDate'] != 'undefined') {
                $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['startDate'])->format("Y-m-d");
            } else {
                $startDate = date('Y-m-d', strtotime("-7 days"));
            }
            if (isset($_POST['endDate']) && $_POST['endDate'] != 'undefined') {
                $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $_POST['endDate'])->format("Y-m-d");
            } else {
                $endDate = date("Y-m-d", time());
            }
              $endDate = $endDate." 23:59:00";
            $groupId = $_POST['groupId'];
            $usabilityType = $_POST['UsabilityType'];
            $groupPieGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetGroupUsabilityPieChartBasedOnDateRangeAndType($groupId, $startDate, $endDate, $usabilityType);
            $result = array("json" => CJSON::encode($groupPieGraphArray));
            echo $this->rendering($result);
        } catch (Exception $ex) {
            error_log("############Exception occurred in actiongetGroupUsabilityPieChartDetails ###############" . $ex->getMessage());
        }
    }
    
    /**
     * @author: Praneeth
     * Method: To generate xls sheet for pie and line chart for group Usability
     */
    public function actionGroupUsabilityGenerateXLS(){
        try{   
          //Some data
            $startDate = trim($_REQUEST['startdate']);
            $endDate = trim($_REQUEST['enddate']);
            $chartType = trim($_REQUEST['chartType']);
            $groupId = trim($_REQUEST['groupId']);
            $usabilityType = trim($_REQUEST['analyticType']);


            $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $startDate)->format("Y-m-d");
            $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $endDate)->format("Y-m-d");
            $endDate = $endDate." 23:59:00";
            $NetworkId=$this->tinyObject['NetworkId'];
               if($chartType=='linechart')
               {
                     $groupLineGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetGroupUsabilityLineChartBasedOnDateRangeAndType($groupId,$startDate, $endDate, $usabilityType,'xls');

                     $i = 0;

                     $groupUsabilityColumnsArray = array();
                     $groupUsabilityDataArray = array();

                     $z = -1;

                     $groupUsabilityColumnsArray = $groupLineGraphArray['Year'];
                     unset($groupLineGraphArray['Year']); // $deviceGraphArray;
                     foreach ($groupLineGraphArray as $key => $innerArray) {
                         for ($j = 0; $j < count($innerArray) + 1; $j++) {
                             if ($z != $i) {
                                 $groupUsabilityDataArray[$i + 1][$j] = $key;
                             } else {
                                 $groupUsabilityDataArray[$i + 1][$j] = $innerArray[$j - 1];
                             }

                             $z = $i;
                         }
                         $i++;
                     }

                     $insertAtBegining = array(0 => 'Date');
                     $groupUsabilityColumnsArray = array_merge($insertAtBegining, $groupUsabilityColumnsArray);
                     array_values($groupUsabilityColumnsArray);
                     $groupUsabilityColumnsArray = array_values($groupUsabilityColumnsArray);
                     $groupUsabilityDataArray = array_values($groupUsabilityDataArray);

                     $reportName = 'Browser Usability Report';
                     if( $usabilityType=='GroupDeviceUsability'){
                        $reportName = 'Device Usability Report';
                     }elseif( $usabilityType=='GroupLocationUsability'){
                        $reportName = 'Location Usability Report';                         
                     }
                    $f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
                    $r = new YiiReport(array('template'=> 'Usability.xls'));

                    $r->load(array(
                            array(
                                'id' => 'ong',
                                'data' => array(
                                    'name' => $reportName,
                                     'date' => $_REQUEST['startdate'].' to '. $_REQUEST['enddate'],
                                     'footer' => str_replace('&copy;',"",$f),
                                )
                            )
                        )
                     );
                    //$r->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                    CommonUtility::insertDataDynamicallyInExcelSheet($r->objPHPExcel, 4,$groupUsabilityColumnsArray, $groupUsabilityDataArray);
   
$logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);

                   echo $r->render('excel5', 'Group Usability');
                     Yii::app()->end();
            }
            if($chartType=='piechart')
            {
                $groupPieGraphArray = ServiceFactory::getSkiptaUserServiceInstance()->GetGroupUsabilityPieChartBasedOnDateRangeAndType($groupId, $startDate, $endDate, $usabilityType);
                $data = array();
                $i = 0;
                 if( $usabilityType=='GroupDeviceUsability'){
                     foreach ($groupPieGraphArray as $key => $value) {
                    $data[$i]['device'] = $value['device'];
                        $data[$i]['count'] = $value['count'];
                        $i++;
                }

                $r = new YiiReport(array('template' => 'groupDevicePieChartUsability.xls'));
                $r->load(array(
                    array(
                        'id' => 'ong',
                        'data' => array(
                            'Name' => 'Group Device Usability Pie chart Report',
                            'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                        )
                    ),
                    array(
                        'id' => 'estu',
                        'repeat' => true,
                        'data' => $data,
                        'minRows' => 2
                    )
                        )
                );
                $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                echo $r->render('excel5', 'GroupDevicePieChart');
                 }
                 
                 if( $usabilityType=='GroupLocationUsability'){
                     
                     foreach ($groupPieGraphArray as $key => $value) {
                        $data[$i]['locations'] = $value['locations'];
                        $data[$i]['count'] = $value['count'];
                        $i++;
                    }

                    $r = new YiiReport(array('template' => 'groupLocationPieChartUsability.xls'));
                    $r->load(array(
                        array(
                            'id' => 'ong',
                            'data' => array(
                                'Name' => 'Group Location Usability Pie chart Report',
                                'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                            )
                        ),
                        array(
                            'id' => 'estu',
                            'repeat' => true,
                            'data' => $data,
                            'minRows' => 2
                        )
                            )
                    );
                    $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                    CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                    echo $r->render('excel5', 'GroupLocationPieChart');
                }
                 if( $usabilityType=='GroupBrowserUsability'){
                     
                     foreach ($groupPieGraphArray as $key => $value) {
                        $data[$i]['browser'] = $value['browser'];
                        $data[$i]['count'] = $value['count'];
                        $i++;
                    }

                    $r = new YiiReport(array('template' => 'groupBrowserPieChartUsability.xls'));
                    $r->load(array(
                        array(
                            'id' => 'ong',
                            'data' => array(
                                'Name' => 'Group Browser Usability Pie chart Report',
                                'Date' => $_REQUEST['startdate'] . ' to ' . $_REQUEST['enddate']
                            )
                        ),
                        array(
                            'id' => 'estu',
                            'repeat' => true,
                            'data' => $data,
                            'minRows' => 2
                        )
                            )
                    );
                    $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
                CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
                    echo $r->render('excel5', 'GroupBrowserPieChart');
                }
                
                Yii::app()->end();
            }
        } catch (Exception $ex) {
            error_log("############Exception occurred in Device GenerateXLS ###############" . $ex->getMessage());
        }
    }
    public function actionGameAnalyticsGenerateXLS(){
        try{   
            $currentDate = date(Yii::app()->params['PHPDateFormat']);
             $gameId = trim($_REQUEST['gameId']);
             $NetworkId=$this->tinyObject['NetworkId'];
             $gamesAnalyticsData = ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailAnalytics($gameId,'','','xls');
             $gamesAnalyticsData = $gamesAnalyticsData[0];
             $data=array();
            $i=0;
        foreach ($gamesAnalyticsData as $value) {
          
              $scheduleGame = $value[0];
              $gameBean = $value[1]; 
             $data[$i]['GameName']=$scheduleGame->GameName;
            $data[$i]['Schedules'] =  date(Yii::app()->params['PHPDateFormat'],CommonUtility::convert_date_zone($scheduleGame->StartDate->sec,Yii::app()->session['timezone'],  date_default_timezone_get()))." to ".date(Yii::app()->params['PHPDateFormat'],CommonUtility::convert_date_zone($scheduleGame->EndDate->sec,Yii::app()->session['timezone'],  date_default_timezone_get())); 
           // $data[$i]['Schedules']=date(Yii::app()->params['PHPDateFormat'],  strtotime($scheduleGame->StartDate))." to ". date(Yii::app()->params['PHPDateFormat'],  strtotime($scheduleGame->EndDate));
            $data[$i]['Players']=count($scheduleGame->Players)+count($scheduleGame->ResumePlayers);
            $data[$i]['CompletedPlayers']=count($scheduleGame->Players);
            $data[$i]['PausedPlayers']=count($scheduleGame->ResumePlayers);
            $data[$i]['AvgTime']=$gameBean->averageTime;
            $data[$i]['AvgPointsTotalPoints']= number_format($gameBean->avgPoints)."/".number_format($gameBean->gameTotalPoints);
          
          $i++; 
           
        }
        if($gameId == "AllGames"){
            $gameName = "All Games";
        }else{
            $gameName = $gamesAnalyticsData[0][0]->GameName;
        }
        $r = new YiiReport(array('template'=> 'GameAnalytics.xls'));
$f= preg_replace("/<\/?div[^>]*\>/i", "", Yii::app()->params['COPYRIGHTS']);
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'Name' => 'Game Analytics',
                         'GameName' => $gameName,
                        'Date' => $currentDate,
                        'footer' => str_replace('&copy;',"",$f),
                    )
                ),
                array(
                    'id'=>'estu',
                    'repeat'=>true,
                    'data'=>$data,
                    'minRows'=>2
                )
            )
        );
        $logo =  Yii::app()->params['WebrootPath']."images/system/logo.png";
        CommonUtility::insertImageInExcelSheet($r->objPHPExcel,0, $logo, 'A1', 10, 10);
        echo $r->render('excel5', 'GameAnalytics');
        Yii::app()->end();
        
           
        } catch (Exception $ex) {
            error_log("############Exception occurred in Device GenerateXLS ###############" . $ex->getMessage());
        }
    }
     public function actionGamePdf(){           
          $currentDate = date(Yii::app()->params['PHPDateFormat']);
          
             $gameId = trim($_REQUEST['gameId']);
              
             $NetworkId=$this->tinyObject['NetworkId'];
             $gamesAnalyticsData = ServiceFactory::getSkiptaGameServiceInstance()->getGameDetailAnalytics($gameId,'','','xls');
             $gameName = $gamesAnalyticsData[2];
             $gamesAnalyticsData = $gamesAnalyticsData[0];             
      
        ob_start();
    
      
        $folder = $this->findUploadedPath();  
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->setDefaultFont("eotbold");
        $html2pdf->WriteHTML($this->renderPartial('gameHtmlPdf', array('date'=>$currentDate,'analyticType'=>"Game Analytics",'gamesAnalyticsData'=>$gamesAnalyticsData,"gameName"=>$gameName,'configParams'=>Yii::app()->params), true));
        $certname="GameAnalytics".$currentDate.".pdf";
         ob_clean();
        $html2pdf->Output($certname,$folder);

    }

}
