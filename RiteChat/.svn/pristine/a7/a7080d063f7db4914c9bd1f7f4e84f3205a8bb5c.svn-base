<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class QuestionsSurveyForm extends CFormModel {

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
    public $ScheduleId;
    public $OptionsSelected;
    public $UserAnswers;
    public $DistValue;
    public $UsergeneratedRanking;
    public $UserAnswer;
    public $TotalCalValue;
    public $OptionValue;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('SurveyTitle,SurveyDescription,SurveyLogo,SurveyRelatedGroupName','required'),
//            array('Question','validateDynamicFields', 'fieldname' => 'Question' ,'message' => 'Question '),
//            array('RadioOption', 'validateDynamicFields', 'fieldname' => 'RadioOption' ,'message' => 'Option Name'),
            array('OptionsSelected', 'validateDynamicFields', 'fieldname' => 'OptionsSelected','message' => 'Please fill this question'),
            array('UserAnswer', 'validateDynamicFields', 'fieldname' => 'UserAnswer','message' => 'Please fill this question'),
            array('TotalCalValue', 'validateTotalValues', 'fieldname' => 'TotalCalValue','message' => 'Sorry, Distributed values are not matched with the total.'),
            array('Other','validateOtherFields', 'fieldname' => 'Other' ,'message' => 'Other Value '),
           
            array('OptionValue', 'validateDynamicFields', 'fieldname' => 'OptionValue','message' => 'Please fill this question'),
//            array('OptionValue', 'validateDynamicFields', 'fieldname' => 'OptionValue','message' => 'Label Name'),
//            array('OptionName', 'validateDynamicFields', 'fieldname' => 'OptionName','message' => 'Option Name'),
//            array('TotalValue', 'validateDynamicFields', 'fieldname' => 'TotalValue','message' => 'Total Value'),
//            array('NoofOptions', 'validateDynamicFields', 'fieldname' => 'NoofOptions','message' => 'Please Select No. of Options'),
//            array('NoofChars', 'validateDynamicFields', 'fieldname' => 'NoofChars','message' => 'Please Select No. of Characters'),
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
            array('UserId,UsergeneratedRanking,DistValue,UserAnswers,ScheduleId,SurveyId,Question,SurveyTitle,SurveyDescription,SurveyLogo,SurveyRelatedGroupName,WidgetType,Questions,OtherValue,Status,QuestionId,UnitType,OptionsSelected','safe'),
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
                if($this->Other[$key] != 1){
                    $this->addError($params['fieldname'] . '_' . $key, "Please answer the question $key");
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
                error_log("==========other====$order");
                if($order == 1){
                    if($this->OtherValue[$key]== "" ){
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
    
    public function validateTotalValues($attribute, $params){
         if(sizeof($this->$params['fieldname'])>0){
            foreach ($this->$params['fieldname'] as $key => $order) { 
                if (empty($order)) {
                if(isset($params['message']) && $params['message']!=""){
                    $message=$params['message'];
                }else{
                    $message=$params['fieldname'];
                }
                if($this->OptionsSelected[$key] != "")
                    $this->addError($params['fieldname'] . '_' . $key, $message);
                else{
                    $this->addError($params['fieldname'] . '_' . $key, "Please answer the question $key");
                }
                // break;
            }
            }
        }
    }

}
