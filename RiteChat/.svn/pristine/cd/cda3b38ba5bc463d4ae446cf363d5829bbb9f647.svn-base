<?php

class AdvertisementForm extends CFormModel {
    public $id;    
    public $Name;    
    public $Type;    
    public $RedirectUrl;
    public $DisplayPage;
    public $Status;
    public $DisplayPosition;        
    public $TimeInterval;
    public $ExpiryDate;        
    public $GroupId;
    public $Url;
    public $OutsideUrl;
    public $SourceType;
    public $AdTypeId;
    public $StartDate;
    public $RequestedFields;
    public $Title;
    public $Requestedparam1;
    public $Requestedparam2;
    public $IsThisAdRotate;
    public $DoesthisAdrotateHidden;
    public $StreamBundleAds;
    public $ImpressionTags;
    public $ClickTag;
    public $BannerTemplate;
    public $BannerOptions;
    public $BannerContent;
    public $BannerTitle;
    public $BannerContentForTextOnly;
    public $BannerTitleForTextOnly;
    public $IsThisExternalParty;
    public $ExternalPartyName;
    public $ExternalPartyUrl;
   
    public function rules() {
        return array(
            


            array('id,Name,RedirectUrl,Url,DisplayPage,Status,DisplayPosition,TimeInterval,ExpiryDate,GroupId,Type,SourceType,OutsideUrl,AdTypeId,Title,RequestedFields,StartDate,Requestedparam1,Requestedparam2,IsThisAdRotate,DoesthisAdrotateHidden,StreamBundleAds,ImpressionTags,ClickTag,BannerTemplate,BannerOptions,BannerContent,BannerTitle,BannerContentForTextOnly,BannerTitleForTextOnly,IsThisExternalParty,ExternalPartyName,ExternalPartyUrl', 'safe'),


           
             array(
                                'RedirectUrl',
                                'match', 'pattern' => '/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/',
                                'message' => 'URL should start with http:// or https://',
                            ),
        
                 array('SourceType', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                  'if' => array(
                             array('SourceType', 'compare', 'compareValue'=>"Upload"),
                ),
                'then' => array(

                   array('Url','customRequiredForUpload'),

                            
                    ),
               
                
            ),
             array('SourceType', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                  'if' => array(
                             array('SourceType', 'compare', 'compareValue'=>"StreamBundleAds"),
                ),
                'then' => array(

                   array('StreamBundleAds','customRequiredForStreamBundilAd'),

                            
                    ),
               
                
            ),
             array('SourceType', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                  'if' => array(
                             array('SourceType', 'compare', 'compareValue'=>"AddServerAds"),
                ),
                'then' => array(
                   array('ImpressionTags,ClickTag,Url','customRequiredForAdserverAd'),
                            
                    ),
               
                
            ),
            array('DisplayPage', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('DisplayPage', 'compare', 'compareValue'=>"Group"),
                ),
                'then' => array(
                     array('GroupId', 'required'),    
                            
                    ),
                   
            ), 

            
             array('AdTypeId', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('AdTypeId', 'compare', 'compareValue'=>"1"),
                ),
                'then' => array(
                     array('DisplayPosition,IsThisAdRotate', 'customRequiredForWidget'),    
                            
            ),
            ),
            array('AdTypeId', 'ext.YiiConditionalValidator.YiiConditionalValidator',
               
                  'if' => array(
                             array('AdTypeId', 'compare', 'compareValue'=>"2"),
                ),
                'then' => array(

                     array('Title,SourceType,BannerTemplate,BannerTitle,BannerContent,Url,BannerTitleForTextOnly,BannerContentForTextOnly,ExternalPartyName,ExternalPartyUrl', 'customRequired'),    

                            
                    ),

                
            ),
            array('AdTypeId', 'ext.YiiConditionalValidator.YiiConditionalValidator',
               
                'if' => array(
                             array('AdTypeId', 'compare', 'compareValue'=>"3"),
                ),
                'then' => array(

                     array('Title,RequestedFields,BannerTemplate,BannerTitle,BannerContent,Url,BannerTitleForTextOnly,BannerContentForTextOnly,ExternalPartyName,ExternalPartyUrl', 'customRequiredR'),    

                            
                    ),    
            ),
            array('id', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('id', 'compare', 'compareValue'=>""),
                ),
                'then' => array(
                     array('AdTypeId', 'required'),    
                            
                    ),
                   
            ), 
           
            
                
          array('Name,DisplayPage,ExpiryDate,StartDate', 'required'),  
            
            
        );
}


public function customRequired($attribute_name,$params){       
       if($attribute_name == "Title" && $this->Title == ""){
            $title=$this->IsThisExternalParty==1?"External Party Context":"Title";
            $this->addError('Title',$title.' cannot be blank.');
        }
        if($this->BannerOptions=="OnlyImage" && $attribute_name == "Url" && $this->Url == ""){
            $this->addError('Url','Please upload ad image.');

        }
        if($this->BannerOptions=="ImageWithText" && $attribute_name == "BannerTemplate"&&$this->BannerTemplate==''){
            $this->addError('BannerTemplate','Please select banner template.');
        }
        if($this->BannerOptions=="OnlyText" && $attribute_name == "BannerTitleForTextOnly"&& $this->BannerTitleForTextOnly == ""){
            $this->addError('BannerTitleForTextOnly','Please select banner title.');
        }
        if($this->BannerOptions=="OnlyText" && $attribute_name == "BannerContentForTextOnly"&& $this->BannerContentForTextOnly == ""){
            $this->addError('BannerContentForTextOnly','Please select banner content.');
        }
        error_log($this->IsThisExternalParty."--------######");
        if($this->IsThisExternalParty==1 && $attribute_name == "ExternalPartyName"&& $this->ExternalPartyName == ""){
            $this->addError('ExternalPartyName','External Party Name cannot be blank.');
        }
        if($this->IsThisExternalParty==1 && $attribute_name == "ExternalPartyUrl"&& $this->ExternalPartyUrl == ""){
            $this->addError('ExternalPartyUrl','Please upload External Party Logo.');
        }

    }
    public function customRequiredR($attribute_name,$params){        

        if($attribute_name == "Title" && $this->Title == ""){
            $title=$this->IsThisExternalParty==1?"External Party Context":"Title";
            $this->addError('Title',$title.' cannot be blank.'); 
        }
        if($attribute_name == "RequestedFields" && $this->RequestedFields == ""){

            $this->addError('RequestedFields','Please select Requested Field.');
 }
        if($this->BannerOptions=="OnlyImage" && $attribute_name == "Url" && $this->Url == ""){
            $this->addError('Url','Please upload ad image.');
        }
        if($this->BannerOptions=="ImageWithText" && $attribute_name == "BannerTemplate"&&$this->BannerTemplate==''){
            $this->addError('BannerTemplate','Please select banner template.');
        }
        if($this->BannerOptions=="OnlyText" && $attribute_name == "BannerTitleForTextOnly"&& $this->BannerTitleForTextOnly == ""){
            $this->addError('BannerTitleForTextOnly','Please select banner title.');
        }
        if($this->BannerOptions=="OnlyText" && $attribute_name == "BannerContentForTextOnly"&& $this->BannerContentForTextOnly == ""){
            $this->addError('BannerContentForTextOnly','Please select banner content.');
        }
        if($this->IsThisExternalParty==1 && $attribute_name == "ExternalPartyName"&& $this->ExternalPartyName == ""){
            $this->addError('ExternalPartyName','External Party Name cannot be blank.');
        }
        if($this->IsThisExternalParty==1 && $attribute_name == "ExternalPartyUrl"&& $this->ExternalPartyUrl == ""){
            $this->addError('ExternalPartyUrl','Please upload External Party Logo.');
        }

    }
public function customRequiredForUrl($attribute_name,$params){       
        if($attribute_name == "OutsideUrl" && $this->OutsideUrl == "")
            $this->addError('OutsideUrl','Outside Url cannot be blank.');
    }
public function customRequiredForUpload($attribute_name,$params){   
        if($attribute_name == "Url" && $this->Url == "" && $this->AdTypeId==1)
            $this->addError('Url','Please upload ad image.');
    }
public function customRequiredForStreamBundilAd($attribute_name,$params){   
        if($attribute_name == "StreamBundleAds" && $this->StreamBundleAds == ""){
            $this->addError('StreamBundleAds','StreamBundleAds cannot be blank.');
        }
    }
public function customRequiredForAdserverAd($attribute_name,$params){   
        if($attribute_name == "ImpressionTags" && $this->ImpressionTags == "")
            $this->addError('ImpressionTags','ImpressionTags cannot be blank.');
        if($attribute_name == "ClickTag" && $this->ClickTag == "")
            $this->addError('ClickTag','ClickTag cannot be blank.');
        
//        if($attribute_name == "Url" && $this->Url == "")
//            $this->addError('Url','Please upload ad image.');
    }

 public function customRequiredForWidget($attribute_name,$params){ 
     if($attribute_name == "IsThisAdRotate" && $this->IsThisAdRotate==1 && $this->TimeInterval==""){
            $this->addError('TimeInterval','Please select TimeInterval.');
        }
        if($attribute_name == "DisplayPosition" && $this->DisplayPosition == ""){
            $this->addError('DisplayPosition','Please select DisplayPosition.');
        }
        
    }

}
