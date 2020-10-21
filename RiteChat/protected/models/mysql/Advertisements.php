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

    

      public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Advertisements';
    }
     
     public function saveAdvertisements($adObj,$type){
         $returnValue="failure";
         try { 
             list($width, $height) = getimagesize(Yii::getPathOfAlias('webroot').$adObj->Url);
             if($type=="edit"){
             $advertisements = Advertisements::model()->findByAttributes(array('id' => $adObj->id));
             
             if($adObj->id==$advertisements->id){
             $advertisements->RequestedParams=$adObj->RequestedParams;
             $advertisements->Width=$width; 
             $advertisements->Height=$height; 
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
                 $advertisements->ImpressionTag=$adObj->ImpressionTag;
                 $advertisements->ClickTag=$adObj->ClickTag;
                 $advertisements->StreamBundle=$adObj->StreamBundle;
                
             }
             if($adObj->AdTypeId=="3"){
                $advertisements->RequestedFields=$adObj->RequestedFields;  
             }
                  if($advertisements->update()){
                 $returnValue="success";
             }
             }      
            
             }  else {
                 $adObj->Width=$width; 
                 $adObj->Height=$height;
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
    
   public function loadAds($position,$page,$groupId=''){
       $returnValue='failure';
       try {
           if($page=='Group'){
             $query="select * from Advertisements where AdTypeId=1 and DisplayPosition='".$position."' and DisplayPage='".$page."' and (GroupId like '%".$groupId."%' or GroupId='AllGroups')   and Status=1 and ExpiryDate>=CURDATE() and StartDate<=CURDATE() order by CreatedOn desc  ";  
           }else{
             $query="select * from Advertisements where AdTypeId=1 and DisplayPosition='".$position."' and DisplayPage='".$page."'  and ExpiryDate>=CURDATE() and StartDate<=CURDATE() and Status=1 order by CreatedOn desc ";    
           }           
           
           error_log($query);
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
      
  public function GetAllAdvertisementsForAdmin($searchText, $startLimit , $pageLength ,$filterValue){
      $returnValue='failure';
      try {
          if(!empty($searchText)){
              $query="select * from Advertisements where Name like '%".$searchText."%' or DisplayPage like '%".$searchText."%'  or DisplayPosition like '%".$searchText."%' order by CreatedOn desc limit $pageLength offset $startLimit ";
          }else if($filterValue=="active" || $filterValue=="inactive" || $filterValue=="expired"){
              $condition='';
              if($filterValue=="active"){
                  $condition='Status=1';
              }else if($filterValue=="inactive"){
                  $condition='Status=0';
              }else if($filterValue=="expired"){
                  $condition='ExpiryDate<CURDATE()';
              }
              $query="select * from Advertisements where $condition order by CreatedOn desc limit $pageLength offset $startLimit ";       
          }else{
           $query="select * from Advertisements order by CreatedOn desc limit $pageLength offset $startLimit ";       
          }           
          
          //error_log("-------------------".$query);
          $advertisements = Yii::app()->db->createCommand($query)->queryAll();
          if(count($advertisements)>0){
            $returnValue=$advertisements;
          }
          return $returnValue;  
      } catch (Exception $exc) {
          Yii::log($exc->getLine()."in Advertisements model".$exc->getMessage(),'error','application');
      }
    } 
    
  public function getTotalCountForAdvertisements() {
        try {
            $advertisementsCount = Advertisements::model()->count();
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
          $advertisements=0;
          if(Yii::app()->params['Advertisements']=='ON'){
          $query="select count(*) as AdCount from Advertisements where AdTypeId=1 and GroupId like '%".$groupId."%' or GroupId='AllGroups'  and Status=1 and ExpiryDate>=CURDATE() and StartDate<=CURDATE()";               
          $advertisements = Yii::app()->db->createCommand($query)->queryRow();
           }
          
          return $advertisements;
      } catch (Exception $exc) {
          error_log($exc->getLine() . "in Advertisements model" . $exc->getMessage());
         Yii::log($exc->getLine() . "in Advertisements model" . $exc->getMessage(), 'error', 'application');
      }
    }
   public function isAnyAdsConfiguredWithThisDisplayPosition($DisplayPosition, $adTypeId,$displayPage,$startDate,$exDate,$isThisAdRotate){
         $returnValue="failure";
        try {
            $startDate=date('Y-m-d H:i:s', strtotime($startDate));
            $exDate=date('Y-m-d H:i:s', strtotime($exDate));
            if($isThisAdRotate==0){
             $query="select * from Advertisements where Status=1 and (('$startDate' >= StartDate && '$startDate' <= ExpiryDate) or ('$exDate' >= StartDate && '$exDate' <= ExpiryDate) or ('$startDate' < StartDate && '$exDate' > ExpiryDate))  and AdTypeId=$adTypeId and DisplayPosition='$DisplayPosition' and DisplayPage='$displayPage'";
            }
            else{
             $query="select * from Advertisements where Status=1 and (('$startDate' >= StartDate && '$startDate' <= ExpiryDate) or ('$exDate' >= StartDate && '$exDate' <= ExpiryDate) or ('$startDate' < StartDate && '$exDate' > ExpiryDate))   and AdTypeId=$adTypeId and DisplayPosition='$DisplayPosition' and DisplayPage='$displayPage' and IsAdRotate=0";  
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
            error_log($query);
            $returnValue = Yii::app()->db->createCommand($query)->queryAll(); 

            return "success";
        } catch (Exception $exc) {
             Yii::log($exc->getTraceAsString(),'error','application');
             return $returnValue;
        } 
     }
}
