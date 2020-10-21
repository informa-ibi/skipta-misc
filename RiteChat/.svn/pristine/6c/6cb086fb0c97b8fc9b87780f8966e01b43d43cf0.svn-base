<?php

class SkiptaAdService {
 public function saveNewAdService($adObj,$userId,$type){
    $returnValue='failure';
     try {
          $advertisementsObj=new Advertisements();
             $advertisementsObj->Name=$adObj->Name;
             $advertisementsObj->Type=$adObj->Type;
             $advertisementsObj->Url=$adObj->Url;
             $advertisementsObj->DisplayPage=$adObj->DisplayPage;
             if($adObj->AdTypeId=="1"){
                $advertisementsObj->DisplayPosition=$adObj->DisplayPosition;
                 
                if ($adObj->IsThisAdRotate == 1) {
                    $advertisementsObj->TimeInterval = $adObj->TimeInterval;
                } else {
                    $advertisementsObj->TimeInterval = null;
                }

                $advertisementsObj->IsAdRotate = $adObj->IsThisAdRotate;
               if($adObj->SourceType=="StreamBundleAds"){
                  $advertisementsObj->StreamBundle = $adObj->StreamBundleAds; 
               } 
               else{
                   $advertisementsObj->StreamBundle =null;
               }
               
                
                
            }
            if($adObj->SourceType=="AddServerAds"){
                  $advertisementsObj->ImpressionTag = $adObj->ImpressionTags;
                  $advertisementsObj->ClickTag = $adObj->ClickTag; 
               }else{
                  $advertisementsObj->ImpressionTag = null;
                  $advertisementsObj->ClickTag = null;  
               }
             
             $advertisementsObj->AdTypeId=$adObj->AdTypeId;
             $advertisementsObj->StartDate=date('Y-m-d H:i:s', strtotime($adObj->StartDate)); 
             if($adObj->AdTypeId!="1"){
   $advertisementsObj->Title=$adObj->Title;  
                $advertisementsObj->BannerTemplate=$adObj->BannerTemplate;
                $advertisementsObj->BannerOptions=$adObj->BannerOptions;
                $advertisementsObj->BannerContent=$adObj->BannerContent;
                $advertisementsObj->BannerTitle=$adObj->BannerTitle;
                if($adObj->Url==""){
                  if($adObj->BannerOptions=="ImageWithText"){
                     $advertisementsObj->Url='/images/system/ad_creation_defaultbanner'.$adObj->BannerTemplate.".jpg";
                     $adObj->Url='/images/system/ad_creation_defaultbanner'.$adObj->BannerTemplate.".jpg";  
                  }
                 
                }
                if($adObj->BannerOptions=="OnlyText"){
                       $advertisementsObj->BannerContent=$adObj->BannerContentForTextOnly;
                       $advertisementsObj->BannerTitle=$adObj->BannerTitleForTextOnly;
                       $advertisementsObj->Url=null;
                       $adObj->Url=null;  
                  }
                  if($adObj->IsThisExternalParty==1){
                      $advertisementsObj->ExternalPartyName=$adObj->ExternalPartyName;
                      $advertisementsObj->ExternalPartyUrl=$adObj->ExternalPartyUrl;
                      $advertisementsObj->IsThisExternalParty=1; 
                  }
                  else{
                      $advertisementsObj->ExternalPartyName=null;
                      $advertisementsObj->ExternalPartyUrl=null;
                      $advertisementsObj->IsThisExternalParty=0;  
                  }
             }
             else{
                $advertisementsObj->Title=null;  
                $advertisementsObj->BannerTemplate=null;
                $advertisementsObj->BannerOptions=null;
                $advertisementsObj->BannerContent=null;
                $advertisementsObj->BannerTitle=null; 
             }
             if($adObj->AdTypeId=="3"){
                $advertisementsObj->RequestedFields= implode(', ',$adObj->RequestedFields);
                $requestedParams=null;
                if(!empty($adObj->Requestedparam1) && stristr($advertisementsObj->RequestedFields,"UserId")!=""){
                  $requestedParams= "UserId:".$adObj->Requestedparam1; 
                }
                 
                if(!empty($adObj->Requestedparam2) && stristr($advertisementsObj->RequestedFields,"Display Name")!=""){
                    $requestedParams.=$requestedParams==null?null:',';
                  $requestedParams.= "Display Name:".$adObj->Requestedparam2; 
                }
                $advertisementsObj->RequestedParams=$requestedParams;
             }
             else{
                 $advertisementsObj->RequestedFields=null;
                 $advertisementsObj->RequestedParams=null;
             }
             if($type=="edit"){
                $advertisementsObj->Status= $adObj->Status;
             }else{
               $advertisementsObj->Status=$adObj->Status;    
             }
             
             $advertisementsObj->CreatedUserId=$userId;
             $advertisementsObj->SourceType=$adObj->SourceType;
               
             if($adObj->SourceType=='OutsideSource'){
                $advertisementsObj->Url=$adObj->OutsideUrl; 
                $advertisementsObj->OutsideUrl=$adObj->OutsideUrl; 
             }else{
                $advertisementsObj->OutsideUrl=null; 
             }
             
             
             if(!empty($adObj->RedirectUrl)){
              $advertisementsObj->RedirectUrl=$adObj->RedirectUrl;           
             }else{
                 if($adObj->SourceType=='OutsideSource'){
                     $advertisementsObj->RedirectUrl=null; 
                 }else{
                   $advertisementsObj->RedirectUrl=null;       
                 }
              
             }             
             $advertisementsObj->ExpiryDate=date('Y-m-d H:i:s', strtotime($adObj->ExpiryDate));     
             if($adObj->DisplayPage=='Group'){
                  $groupString='AllGroups';
                if($adObj->GroupId[0]!='AllGroups'){
                  $groupString=  implode(', ', $adObj->GroupId);  
                } 

              $advertisementsObj->GroupId=$groupString;    
             }else{
                 $advertisementsObj->GroupId=0;
             }
             
             $advertisementsObj->CreatedOn=date('Y-m-d H:i:s', time());
             if($type=='edit'){
               $advertisementsObj->id=  $adObj->id;
             }
             $adId=Advertisements::model()->saveAdvertisements($advertisementsObj,$type); 
             $categoryId = CommonUtility::getIndexBySystemCategoryType('Advertisement');
             if(is_int($adId)){
                 AdTrackingCollection::model()->createAdTrackDocument($adId);
                 if($advertisementsObj->AdTypeId==3 || $advertisementsObj->AdTypeId==2){
                    if($type!='edit'){
                       $advertisementsObj->id=$adId;
                      
                      $adId=AdvertisementCollection::model()->createAdvertisementDocument($advertisementsObj); 
                      
                      CommonUtility::prepareStreamObject((int)0,"Post",$adId,$categoryId,"","", "");   
                      $returnValue='success';
                    }

                 }
                 else{
                   $returnValue='success';  
                 }
                
             }  else {
                if ($adId = "success") {
                    if ($advertisementsObj->AdTypeId == 3 || $advertisementsObj->AdTypeId == 2) {
                        $postId=AdvertisementCollection::model()->updateAdvertisementDocument($advertisementsObj);
                          UserStreamCollection::model()->updateStreamForAdvertisement($categoryId,$postId,$advertisementsObj);
                         $returnValue='success';
                    }
                else{
                   $returnValue = 'success';
                    }
                }
               
            }
            return $returnValue;
     } catch (Exception $exc) {
       error_log("===========in ad service ===========".$exc->getMessage());
         Yii::log($exc->getMessage(),'error','application');
           return $returnValue;
     }
  }
  
public function loadAds($position,$page,$groupId=''){
    $returnValue='failure';
    try {
        if($page=='curbsidePost'){
            $page="Curbside";
        }else if($page=="post"){
            $page="Home";
        }
        else if($page=="group"){
            $page="Group";
        }
        $loadAds=Advertisements::model()->loadAds($position,$page,$groupId);
        return $loadAds;
    } catch (Exception $exc) {
        Yii::log($exc->getTraceAsString(),'error','application');
    }
}  

public function getAllAdvertisementsForAdmin($searchText='',$startLimit='',$pageLength='',$filterValue){
    $returnValue='failure';
    try {
        //$searchText='';
        $advertisements=Advertisements::model()->GetAllAdvertisementsForAdmin($searchText, $startLimit, $pageLength,$filterValue);
        return $advertisements;
    } catch (Exception $exc) {
        Yii::log($exc->getLine()."in ad service admin ads".$exc->getMessage(),'error','application');
        return 'failure';
        
    }
}
public function getTotalCountForAdvertisements(){
    $returnValue='failure';
    try {
        $totalCount=Advertisements::model()->getTotalCountForAdvertisements();
        return $totalCount;
    } catch (Exception $exc) {
        Yii::log($exc->getLine()."in ad service admin ads".$exc->getMessage(),'error','application');
        return 'failure';
    }
}

public function getAdvertisementByType($type,$value){
    try {
        $returnValue=Advertisements::model()->getAdvertisementsByType($type,$value);
        return $returnValue;
    } catch (Exception $exc) {
        Yii::log($exc->getLine()."in ad service getAdvertisementByType".$exc->getMessage(),'error','application');
        return 'failure';
    }
}

public function trackAdClick($adId,$userId){
    try {        
        AdTrackingCollection::model()->trackAdClick($adId,$userId);
    } catch (Exception $exc) {
       Yii::log($exc->getLine()."in ad service getAdvertisementByType".$exc->getMessage(),'error','application');
        return 'failure';
    }
}

public function getAdsCountForGroup($groupId){
    try {        
        $advertisementCount=Advertisements::model()->getGroupAdsCount($groupId);
        return $advertisementCount;
    } catch (Exception $exc) {
       Yii::log($exc->getLine()."in ad service getAdvertisementByType".$exc->getMessage(),'error','application');
    }
    
}

public function getAdTypes(){
    try {
        $AdTypesArray=array();
        $adTypes=AdType::model()->getAdTypes();
         if(is_object($adTypes) || is_array($adTypes)){               
               foreach($adTypes as $adType){                      
                   $id=$adType['id'];
                   $AdTypesArray[$id]=$adType['Type'];                
                   
                   
               }
             $returnValue=$AdTypesArray;  
           }
        return $AdTypesArray;
    } catch (Exception $exc) {
        Yii::log($exc->getMessage()."in ad service getAdTypes".$exc->getMessage(),'error','application');
    }
}

public function getAdRequestedFields(){
    try {
        $adRequestedFieldsArray=array();
        
        $adRequestedFields=AdRequestedFields::model()->getAdRequestedFields();
         if(is_object($adRequestedFields) || is_array($adRequestedFields)){               
               foreach($adRequestedFields as $adRequestedField){                      
                   $id=$adRequestedField['FieldName'];
                   $adRequestedFieldsArray[$id]=$adRequestedField['FieldName'];                
                   
                   
               }

           }
        return $adRequestedFieldsArray;
    } catch (Exception $exc) {
        Yii::log($exc->getMessage()."in ad service getAdRequestedFields".$exc->getMessage(),'error','application');
    }
}
public function saveUserAdTrack($userId, $postId) {
        try {
            $isExist = UserAdTrack::model()->isUserAdTrackExist($userId, $postId);
            $postObj = AdvertisementCollection::model()->getAdvertisementDetailsById($postId);
            if (!$isExist) {
                error_log(print_r($postObj, true));
                UserAdTrack::model()->saveUserAdTrack($postObj, $userId);
            }
            AdTrackingCollection::model()->trackAdClick($postObj->AdvertisementId, $userId);
        } catch (Exception $exc) {
            Yii::log($exc->getLine() . "in ad service getAdvertisementByType" . $exc->getMessage(), 'error', 'application');
            return 'failure';
        }
    }
    
public function getAdCollectionByAdvertisementId($adId) {
    $returnValue='failure';
        try {
            
            $returnValue = UserStreamCollection::model()->getStreamForAdvertisementByAdvertisementId($adId);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getLine() . "in ad service getAdvertisementByType" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
public function isAnyAdsConfiguredWithThisDisplayPosition($DisplayPosition, $adTypeId,$displayPage,$startDate,$exDate,$isThisAdRotate,$adId,$status) {
       $returnValue='failure';
        try {
            $result = Advertisements::model()->isAnyAdsConfiguredWithThisDisplayPosition($DisplayPosition, $adTypeId,$displayPage,$startDate,$exDate,$isThisAdRotate);
            if(sizeof($result)>0){
                if(empty($adId)){
                   $returnValue=true; 
                }
                else if($status==1){
                    $newList=array();
                  foreach($result as $obj){
                    if($adId!=$obj['id']){
                       array_push($newList,$obj); 
                    }
                  }
                  if(sizeof($newList)>0){
                      $returnValue=true; 
                  }
                  else{
                    $returnValue=false;  
                  }
                }
                else{
                  $returnValue=false;  
                }
            
            }
            else{
                $returnValue=false;
            }
             
          return $returnValue;  
        } catch (Exception $exc) {
            Yii::log($exc->getLine() . "in ad service isAnyAdsConfiguredWithThisDisplayPosition" . $exc->getMessage(), 'error', 'application');
            return 'failure';
        }
    }
    
public function inActivateWidgetAds($DisplayPosition, $adTypeId,$displayPage,$startDate,$exDate){
     $returnValue='failure';
        try {
            $result = Advertisements::model()->isAnyAdsConfiguredWithThisDisplayPosition($DisplayPosition, $adTypeId,$displayPage,$startDate,$exDate);
            $ids='';
            foreach($result as $obj){
               $ids.=($ids!=''?','.$obj['id']:$obj['id']);  

            }
           $returnValue = Advertisements::model()->inActivateWidgetAds($ids);
             
          return $returnValue;  
        } catch (Exception $exc) {
            Yii::log($exc->getLine() . "in ad service isAnyAdsConfiguredWithThisDisplayPosition" . $exc->getMessage(), 'error', 'application');
            return 'failure';
        }
}

}

