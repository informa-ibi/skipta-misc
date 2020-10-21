<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ExtendedSurveyForm extends CFormModel {

    public $UserId;
//    public $Education_Ids;
//    public $Education;
    public $RadioOption;
    public $CheckboxOption;
    public $Questions;
    public $Question;
//    public $Specialization;
//    public $YearOfPassing;
//    public $Experience;
//    public $UserExperience;
//    public $Interests;
//    public $UserInterests;
//    public $Achievements;
//    public $UserAchievements;
//    public $Publications;
//    public $PublicationName;
//    public $PublicationTitle;
//    public $PublicationAuthors;
//    public $PublicationDate;
//    public $PublicationLocation;
//    public $PublicationLink;
//    public $PublicationPdf;
//    public $UploadFileORLink;
//    public $RecentupdateSection;
//    public $Publicationfile;
//    public $PublicationFIleType;
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
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('SurveyTitle,SurveyDescription,SurveyLogo','required'),
            array('Question','validateDynamicFields', 'fieldname' => 'Question' ,'message' => 'Question '),
            array('RadioOption', 'validateDynamicFields', 'fieldname' => 'RadioOption' ,'message' => 'Option Name'),
            array('CheckboxOption', 'validateDynamicFields', 'fieldname' => 'CheckboxOption','message' => 'Option Name'),
            array('Other','validateOtherFields', 'fieldname' => 'Other' ,'message' => 'Other Value '),
           
            array('LabelName', 'validateDynamicFields', 'fieldname' => 'LabelName','message' => 'Label Name'),
            array('OptionName', 'validateDynamicFields', 'fieldname' => 'OptionName','message' => 'Option Name'),
            array('TotalValue', 'validateDynamicFields', 'fieldname' => 'TotalValue','message' => 'Total Value'),
            array('NoofOptions', 'validateDynamicFields', 'fieldname' => 'NoofOptions','message' => 'Please Select No. of Options'),
            array('NoofChars', 'validateDynamicFields', 'fieldname' => 'NoofChars','message' => 'Please Select No. of Characters'),
//            array('MatrixType', 'validateTypeFields', 'fieldname' => 'MatrixType','message' => 'No. of Ratings'),
            array('SurveyRelatedGroupName','validateSOFields', 'fieldname' => 'SurveyRelatedGroupName' ,'message' => 'Other Value '),
//            array('MatrixType', 'ext.YiiConditionalValidator.YiiConditionalValidator',
//                'if' => array(
//                             array('MatrixType', 'compare', 'compareValue'=>"2"),
//                ),
//                'then' => array(
//                             array('NoofRatings','validateDynamicFields', 'fieldname' => 'NoofRatings','message' => 'Please Select No. of Ratings'),
//                    ),
//            ),
            array('SurveyId,Question,SurveyTitle,SurveyDescription,SurveyLogo,SurveyRelatedGroupName,WidgetType,Questions,OtherValue,Status,QuestionId,UnitType','safe'),
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
                        $message=" Survey Other Value cannot be blank";                        
                        $this->addError('SurveyOtherValue', $message);
                    }
                    
                }          
    }

}
