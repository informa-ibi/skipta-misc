<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ExtendedSurveyForm extends CFormModel {

    public $UserId;
    public $RadioOption;
    public $CheckboxOption;
    public $Questions;
    public $Question;
    public $QuestionId;
    public $SurveyId;
    public $SurveyTitle;
    public $SurveyDescription;
    public $Other;
    public $OtherValue;
    public $WidgetType;
    public $CreatedBy;
    public $QuestionsCount;
    public $SurveyLogo;
    public $NoofOptions;
    public $NoofRatings;
    public $LabelName;
    public $OptionName;
    public $MatrixType;
    public $TotalValue;
    public $NoofChars;
    public $SurveyOtherValue;
    public $SurveyRelatedGroupName;
    public $Status;
    public $UnitType;
    public $IsBannerVisible;
    public $TextOptions;
    public $TextMaxlength;
    public $IsMadatory;
    public $IsAnalyticsShown;
    public $AnyOther;
    public $BooleanRadioOption;
    public $BooleanValues;
    public $IsAcceptUserInfo;
    public $IsEnableNotification=0;
    public $ShowDerivative=1;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('SurveyTitle','required','message' => Yii::t("translation","Ex_Title_Err")),
            array('SurveyDescription','required','message' => Yii::t("translation","Ex_Description_Err")),
            //array('SurveyLogo','required','message'=>"Logo cannot be blank"),
//            array('TextMaxlength','required','message'=>'Max value cannot be blank'),
            array('Question','validateDynamicFields', 'fieldname' => 'Question' ,'message' => 'Question '),
            array('RadioOption', 'validateDynamicFields', 'fieldname' => 'RadioOption' ,'message' => 'Option Name'),
            array('CheckboxOption', 'validateDynamicFields', 'fieldname' => 'CheckboxOption','message' => 'Option Name'),
            array('Other','validateOtherFields', 'fieldname' => 'Other' ,'message' => 'Other Value '),
           
            array('LabelName', 'validateDynamicFields', 'fieldname' => 'LabelName','message' => 'Label Name'),
            array('OptionName', 'validateDynamicFields', 'fieldname' => 'OptionName','message' => 'Option Name'),
            array('TotalValue', 'validateDynamicFields', 'fieldname' => 'TotalValue','message' => 'Total Value'),
            array('NoofOptions', 'validateDynamicFields', 'fieldname' => 'NoofOptions','message' => 'Please Select No. of Options'),
            array('NoofChars', 'validateDynamicFields', 'fieldname' => 'NoofChars','message' => 'Please Select No. of Characters'),
            array('SurveyRelatedGroupName','validateSOFields', 'fieldname' => 'SurveyRelatedGroupName' ,'message' => 'Other Value '),
            //array('MatrixType','validateQuestionsType', 'fieldname' => 'MatrixType' ,'message' => ' '),
            
            array('BooleanRadioOption', 'validateDynamicFields', 'fieldname' => 'BooleanRadioOption','message' => 'Option Name'),
            


            array('IsBannerVisible,SurveyId,Question,SurveyTitle,SurveyDescription,SurveyLogo,SurveyRelatedGroupName,WidgetType,Questions,OtherValue,Status,QuestionId,UnitType,TextOptions,TextMaxlength,IsMadatory,IsAnalyticsShown,AnyOther,BooleanRadioOption,BooleanValues,IsAcceptUserInfo,IsEnableNotification,ShowDerivative','safe'),

        );
    }

    public function validateDynamicFields($attribute, $params) {        
        if(sizeof($this->$params['fieldname'])>0){
           foreach ($this->$params['fieldname'] as $key => $order) {

            if (empty($order)) {
                if(isset($params['message']) && $params['message']!=""){
                    $message=$params['message'];
                }else{
                    $message=$params['fieldname'];
                }                
                if($params['fieldname'] != "NoofOptions" && $params['fieldname'] != "NoofChars"){
                    $this->addError($params['fieldname'] . '_' . $key, $message . ' cannot be blank');
                }else {
                    $this->addError($params['fieldname'] . '_' . $key, $message);
                }
                // break;
            }
        }  
        }
       
    }
    
    public function validateOtherFields($attribute, $params){
        if(sizeof($this->$params['fieldname'])>0){
            foreach ($this->$params['fieldname'] as $key => $order) { 
                if($order == 1){
                    if($this->OtherValue[$key]== "" && $this->MatrixType == "" && $this->NoofOptions == ""){
                        $message=" Other Value  cannot be blank";
                        $this->addError('OtherValue_' . $key, $message);
                    }
                    
                }
            }
        }
        
    }
    
    public function validateTypeFields($attribute, $params){
         if(sizeof($this->$params['fieldname'])>0){
            foreach ($this->$params['fieldname'] as $key => $order) { 
                if($order == 2){                          
                    if($this->NoofRatings[$key] == ""){
                        $message="Please Select No of Ratings";
                        $this->addError('NoofRatings_' . $key, $message);
                    }
                    
                }
            }
        }
    }
    
    public function validateSOFields($attribute, $params){       
                if($this->SurveyRelatedGroupName == "other"){                    
                    if($this->SurveyOtherValue== ""){
                        $message="Other's cannot be blank";                        
                        $this->addError('SurveyOtherValue', $message);
                    }
                    
                }          
    }
    
    public function validateQuestionsType($attribute, $params){
         if(sizeof($this->$params['fieldname'])>0){
            foreach ($this->$params['fieldname'] as $key => $order) { 
                error_log("===Type of Question====".$order);
                if($order == 2){    
                    
                    if($this->NoofOptions[$key] == ""){
                        $message="Please choose no. of Options";
                        $this->addError('NoofOptions_' . $key, $message);
                    }
//                    if($this->NoofRatings[$key] == ""){
//                        $message="Please choose no. of Ratings";
//                        $this->addError('NoofRatings_' . $key, $message);
//                    }
                    
                }else if($order == 1){
                    if($this->NoofOptions[$key] == ""){
                        $message="Please choose no. of Options";
                        $this->addError('NoofOptions_' . $key, $message);
                    }
                }else if($order == 3){
                    if($this->NoofOptions[$key] == ""){
                        $message="Please choose no. of Rows";
                        $this->addError('NoofRows_' . $key, $message);
                    }
//                    if($this->NoofRatings[$key] == ""){
//                        $message="Please choose no. of Columns";
//                        $this->addError('NoofCols_' . $key, $message);
//                    }
                }
            }
        }
    }
}