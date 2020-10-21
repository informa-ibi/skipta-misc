<?php

class Advertisements extends CActiveRecord{
    public $id;
    public $Name;
    public $Type;
    public $Url;
    public $RedirectUrl;
    public $DisplayPage;
    public $DisplayPosition;
    public $Status;
    public $CreatedUserId;
    public $TimeInterval;
    public $ExpiryDate;    
    public $Priority;
    public $GroupId;
    public $CreatedOn;
    public $OutsideUrl;
    public $SourceType;
    public $AdTypeId;
    public $Title;
    public $RequestedFields;
    public $StartDate;
    public $Height;
    public $Width;
    public $RequestedParams;
    public $Requestedparam1;
    public $Requestedparam2;
    public $IsAdRotate;
    public $ImpressionTag;
    public $ClickTag;
    public $StreamBundle;

    public $BannerTemplate;
    public $BannerOptions;
    public $BannerContent;
    public $BannerTitle;
    public $IsThisExternalParty;
    public $ExternalPartyUrl;
    public $ExternalPartyName;
    public $ExternalReferenceId;
    public $SegmentId=0;
    public $Language='en';
    public $Banners=array();
    public $Uploads=array();
    public $ScheduleId;

      public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Advertisements';
    }
     
     public function saveAdvertisements($adObj,$type){
         $returnValue="failure";
         try { 
             $filepath = Yii::getPathOfAlias('webroot').$adObj->Url;
             if(file_exists($filepath)){
                list($width, $height) = getimagesize(Yii::getPathOfAlias('webroot').$adObj->Url);  
             }
             if($type=="edit"){
             $advertisements = Advertisements::model()->findByAttributes(array('id' => $adObj->id));
             
             if($adObj->id==$advertisements->id){
             $advertisements->ScheduleId=$adObj->ScheduleId;
             $advertisements->RequestedParams=$adObj->RequestedParams;
             if(file_exists($filepath)){
                $advertisements->Width=$width; 
                $advertisements->Height=$height; 
             }
             $advertisements->Name=$adObj->Name;
             $advertisements->Type=$adObj->Type;
             $advertisements->Url=$adObj->Url;
             $advertisements->DisplayPage=$adObj->DisplayPage;
             $advertisements->RedirectUrl=$adObj->RedirectUrl;
             $advertisements->Status=$adObj->Status;             
             $advertisements->ExpiryDate=date('Y-m-d H:i:s', strtotime($adObj->ExpiryDate));  
             $advertisements->GroupId=$adObj->GroupId;
             $advertisements->SourceType=$adObj->SourceType;
             $advertisements->OutsideUrl=$adObj->OutsideUrl;
             $advertisements->SegmentId=isset($adObj->SegmentId)?(int)$adObj->SegmentId:0;
             $advertisements->ExternalReferenceId = $adObj->ExternalReferenceId;
             $advertisements->ImpressionTag=$adObj->ImpressionTag;
             $advertisements->ClickTag=$adObj->ClickTag;
             $advertisements->StreamBundle=$adObj->StreamBundle;
             
//             $advertisements->AdTypeId=$adObj->AdTypeId; 
             $advertisements->StartDate=date('Y-m-d H:i:s', strtotime($adObj->StartDate)); 
             if($adObj->AdTypeId!="1"){

                $advertisements->Title=$adObj->Title; 
                $advertisements->BannerTemplate=$adObj->BannerTemplate;
                $advertisements->BannerContent=$adObj->BannerContent;
                $advertisements->BannerTitle=$adObj->BannerTitle;
                $advertisements->BannerOptions=$adObj->BannerOptions;
                $advertisements->ExternalPartyName=$adObj->ExternalPartyName;
                $advertisements->ExternalPartyUrl=$adObj->ExternalPartyUrl;
                $advertisements->IsThisExternalParty=$adObj->IsThisExternalParty;
                

             }
             if($adObj->AdTypeId=="1"){
                 $advertisements->DisplayPosition=$adObj->DisplayPosition;
                 $advertisements->TimeInterval=$adObj->TimeInterval;                 
                 $advertisements->IsAdRotate=$adObj->IsAdRotate;

                                 
             }
             if($adObj->AdTypeId=="3"){
                $advertisements->RequestedFields=$adObj->RequestedFields;  
             }
                  if($advertisements->update()){
                 $returnValue="success";
             }
             }      
            
             }  else {
                 if(file_exists($filepath)){
                    $adObj->Width=$width; 
                    $adObj->Height=$height;
                 }
                if ($adObj->save()) {
                    $returnValue = (int) $adObj->id;
                }
            }
            return $returnValue; 
         } catch (Exception $exc) {
             error_log("====in model==================================".$exc->getMessage());
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue; 
         }
          }

     public function loadAdvertisements() {
         $returnValue='failure';
        try {
            $query="select * from Advertisements";
            $data = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($data)>0){
                $returnValue=$data;
            }
            
            return $returnValue;
        } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
        }
    }
    
   public function loadAds($position,$page,$groupId='', $segmentId=0){
       $returnValue=array();
       try {
           if($page=='Group'){
             $query="select * from Advertisements where  SegmentId in ($segmentId) and AdTypeId=1 and DisplayPosition='".$position."' and DisplayPage='".$page."' and (GroupId like '%".$groupId."%' or GroupId='AllGroups')   and Status=1 and ExpiryDate>=CURDATE() and StartDate<=CURDATE() order by CreatedOn desc  ";  
           }else{
             $query="select * from Advertisements where AdTypeId=1 and  SegmentId in ($segmentId)  and DisplayPosition='".$position."' and DisplayPage='".$page."'  and ExpiryDate>=CURDATE() and StartDate<=CURDATE() and Status=1 order by CreatedOn desc ";    
           }           
     
           $data = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($data)>0){
                $returnValue=$data;
            }
            else{
                  if($page=='Group'){
                    $query="select * from Advertisements where  SegmentId in (0) and AdTypeId=1 and DisplayPosition='".$position."' and DisplayPage='".$page."' and (GroupId like '%".$groupId."%' or GroupId='AllGroups')   and Status=1 and ExpiryDate>=CURDATE() and StartDate<=CURDATE() order by CreatedOn desc  ";  
                  }else{
                    $query="select * from Advertisements where AdTypeId=1 and  SegmentId in (0)  and DisplayPosition='".$position."' and DisplayPage='".$page."'  and ExpiryDate>=CURDATE() and StartDate<=CURDATE() and Status=1 order by CreatedOn desc ";    
                  }
                  $data = Yii::app()->db->createCommand($query)->queryAll();           
                    if(sizeof($data)>0){
                        $returnValue=$data;
                    }
            }
            
            return $returnValue;
       } catch (Exception $exc) {
           Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
       }
      } 
  public function loadPageAds($pageType){
       $returnValue='failure';
       try {

           $query="select * from Advertisements where AdTypeId=1 and DisplayPage='".$pageType."'  and Status=1 and ExpiryDate>=CURDATE() and StartDate<=CURDATE() order by CreatedOn desc ";  

        
                       $data = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($data)>0){
                $returnValue=$data;
            }
            
            return $returnValue;
       } catch (Exception $exc) {
           Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
       }
      }     
  public function GetAllAdvertisementsForAdmin($searchText, $startLimit , $pageLength ,$filterValue, $segmentId=0){
      $returnValue='failure';
      try {
          $segmentCondition = "";
          if($segmentId!=0){
              $segmentCondition = "SegmentId=$segmentId ";
          }
          if(!empty($searchText)){
              if($segmentCondition!=""){
                  $segmentCondition = " and $segmentCondition ";
              }
              $query="select * from Advertisements where Name like '%".$searchText."%' or DisplayPage like '%".$searchText."%'  or DisplayPosition like '%".$searchText."%' $segmentCondition order by CreatedOn desc limit $pageLength offset $startLimit ";
          }else if($filterValue=="active" || $filterValue=="inactive" || $filterValue=="expired"|| $filterValue=="currentactive"|| $filterValue=="future"){
              $condition='';
              if($filterValue=="active"){
                  $condition='Status=1';
              }else if($filterValue=="inactive"){
                  $condition='Status=0';
              }else if($filterValue=="expired"){
                  $condition='ExpiryDate<CURDATE()';
              }
              else if($filterValue=="future"){
                  $condition='StartDate>CURDATE()';
              }
               else if($filterValue=="currentactive"){
                  $condition='StartDate<=CURDATE() and CURDATE()<=ExpiryDate';
              }
              if($condition!="" && $segmentCondition!=""){
                  $segmentCondition = " and $segmentCondition";
              }
              $query="select * from Advertisements where $condition $segmentCondition order by CreatedOn desc limit $pageLength offset $startLimit ";       
          }else{
                $segmentCondition = $segmentCondition==""?"":"where $segmentCondition";
                $query="select * from Advertisements $segmentCondition order by CreatedOn desc limit $pageLength offset $startLimit ";       
          }           
          //select * from Advertisements where SegmentId=6 and  order by CreatedOn desc limit 10 offset 0
         
          $advertisements = Yii::app()->db->createCommand($query)->queryAll();
          if(count($advertisements)>0){
            $returnValue=$advertisements;
          }
          return $returnValue;  
      } catch (Exception $exc) {
          Yii::log($exc->getLine()."in Advertisements model".$exc->getMessage(),'error','application');
      }
    } 
    
  public function getTotalCountForAdvertisements($searchText,$filterValue, $segmentId=0) {
        try {
            $segmentCondition = "";
            if($segmentId!=0){
                $segmentCondition = "SegmentId=$segmentId and ";
            }
            $advertisementsCount=0;
          if(!empty($searchText)){
              $query="select count(*) as totalCount from Advertisements where $segmentCondition Name like '%".$searchText."%' or DisplayPage like '%".$searchText."%'  or DisplayPosition like '%".$searchText."%'";
          }else if($filterValue=="active" || $filterValue=="inactive" || $filterValue=="expired"|| $filterValue=="currentactive"|| $filterValue=="future"){
              $condition='';
              if($filterValue=="active"){
                  $condition='Status=1';
              }else if($filterValue=="inactive"){
                  $condition='Status=0';
              }else if($filterValue=="expired"){
                  $condition='ExpiryDate<CURDATE()';
              }
              else if($filterValue=="future"){
                  $condition='StartDate>CURDATE()';
              }
               else if($filterValue=="currentactive"){
                  $condition='StartDate<=CURDATE() and CURDATE()<=ExpiryDate';
              }
              $query="select count(*) as totalCount from Advertisements where $segmentCondition $condition ";       
           }else{
                $segmentCondition = $segmentCondition==""?"":"where $segmentCondition";
                $query="select count(*) as totalCount from Advertisements $segmentCondition";       
           } 
           $result=Yii::app()->db->createCommand($query)->queryAll();
           if(is_array($result)){
               $count=$result[0];
               $advertisementsCount=$count['totalCount'];
           }
            return $advertisementsCount;
        } catch (Exception $exc) {
            Yii::log($exc->getLine() . "in Advertisements model" . $exc->getMessage(), 'error', 'application');
        }
    }
    
  public function getAdvertisementsByType($type,$value){
      $returnValue='failure';
      try {          
             $advertisements = Advertisements::model()->findByAttributes(array($type => $value));         
             if(is_object($advertisements)){
                 $returnValue=$advertisements;
             }
             return $returnValue;
      } catch (Exception $exc) {
           Yii::log($exc->getLine() . "in Advertisements model" . $exc->getMessage(), 'error', 'application');
           return "failure";
      }
    }  
  public function getGroupAdsCount($groupId){
      try {          
          $query="select count(*) as AdCount from Advertisements where AdTypeId=1 and GroupId like '%".$groupId."%' or GroupId='AllGroups'  and Status=1 and ExpiryDate>=CURDATE() and StartDate<=CURDATE()";               
          $advertisements = Yii::app()->db->createCommand($query)->queryRow();          
          return $advertisements;
      } catch (Exception $exc) {
          error_log($exc->getLine() . "in Advertisements model" . $exc->getMessage());
         Yii::log($exc->getLine() . "in Advertisements model" . $exc->getMessage(), 'error', 'application');
      }
    }
   public function isAnyAdsConfiguredWithThisDisplayPosition($DisplayPosition, $adTypeId,$displayPage,$startDate,$exDate,$isThisAdRotate, $segmentId=0){
         $returnValue="failure";
        try {
            $startDate=date('Y-m-d H:i:s', strtotime($startDate));
            $exDate=date('Y-m-d H:i:s', strtotime($exDate));
            if($isThisAdRotate==0){
             $query="select * from Advertisements where Status=1 and (('$startDate' >= StartDate && '$startDate' <= ExpiryDate) or ('$exDate' >= StartDate && '$exDate' <= ExpiryDate) or ('$startDate' < StartDate && '$exDate' > ExpiryDate))  and AdTypeId=$adTypeId and DisplayPosition='$DisplayPosition' and DisplayPage='$displayPage' and SegmentId=$segmentId";
            }
            else{
             $query="select * from Advertisements where Status=1 and (('$startDate' >= StartDate && '$startDate' <= ExpiryDate) or ('$exDate' >= StartDate && '$exDate' <= ExpiryDate) or ('$startDate' < StartDate && '$exDate' > ExpiryDate))   and AdTypeId=$adTypeId and DisplayPosition='$DisplayPosition' and DisplayPage='$displayPage' and SegmentId=$segmentId and IsAdRotate=0";  
            }
            $returnValue = Yii::app()->db->createCommand($query)->queryAll();

            return $returnValue;
        } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
        }
     }
     
    public function inActivateWidgetAds($ids){
        $returnValue="failure";
        try {
            
            $query="update Advertisements set Status=0 where id in($ids)";
        
            $returnValue = Yii::app()->db->createCommand($query)->queryAll(); 

            return "success";
        } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
        } 
     }
     
     public function externalAddCloseByCurrentDate($referenceId,$scheduleId){
        $returnValue="failure";
        try {
            //error_log("===$referenceId==$scheduleId=");
            $currentDate = date('Y-m-d');
            $query="update Advertisements set Status=0 where ScheduleId= '$scheduleId'";
            //error_log("=0000000000==$query=");
//            if(Yii::app()->db->createCommand($query)->execute()) {
//                $query="select id from Advertisements where  ExternalReferenceId = '$referenceId' and ScheduleId= '$scheduleId'";
//                error_log("=1111111111111==$query=");
//                $returnValue =  Yii::app()->db->createCommand($query)->queryRow();
//               // $returnValue = "success";
//                }
                
                Yii::app()->db->createCommand($query)->execute();
                $query="select id from Advertisements where  ScheduleId= '$scheduleId'";
                $returnValue =  Yii::app()->db->createCommand($query)->queryRow();
               // $returnValue = "success";
                
            return $returnValue;
        } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
        } 
     }
     
      public function getAdvertisementsById($id){
      $returnValue='failure';
      try {          
             $advertisements = Advertisements::model()->findByAttributes(array("id" => $id));         
             if(is_object($advertisements)){
                 $returnValue=$advertisements;
             }
             return $returnValue;
      } catch (Exception $exc) {
           Yii::log($exc->getLine() . "in Advertisements model" . $exc->getMessage(), 'error', 'application');
           return "failure";
      }
    } 
    
     public function getSurveyAdvertisementByScheduleId($scheduleId){
      $returnValue='failure';
      try {          
             $advertisements = Advertisements::model()->findByAttributes(array("ScheduleId" => $scheduleId));         
             if(is_object($advertisements)){
                 $returnValue=$advertisements;
             }
             return $returnValue;
      } catch (Exception $exc) {
           Yii::log($exc->getLine() . "in Advertisements model" . $exc->getMessage(), 'error', 'application');
           return "failure";
      }
    } 
}
