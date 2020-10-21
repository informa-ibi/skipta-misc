<?php

/*
 * ForgotForm class.
 * ForgotForm is the data structure for requesting a new password
 * It is used by the 'forgot' action of 'UserController'.
 */

class ScheduleSurveyForm extends CFormModel {

   public $SurveyTitle;
   public $StartDate;
   public $EndDate;
   public $ShowDisclaimer;
   public $ShowThankYou;
   public $ThankYouMessage;
   public $ThankYouArtifact;
   public $IsPromoted;
   public $SurveyId;
   public $QuestionView;
   public $RenewSchedules;
   public $ConvertInStreamAdd;
   public $SurveyRelatedGroupName;
   public $InstreamAdArtifact;
   public $SurveyDescription;
    public function rules() {
        return array(
            array('ShowThankYou', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                        'if' => array(
                             array('ShowThankYou', 'compare', 'compareValue'=>"1"),
                        ),
                        'then' => array(
                            array('ThankYouMessage', 'required'),
                        ),
                 ),
            array('StartDate,QuestionView', 'required'),           
            array('EndDate', 'required'),
            array('ConvertInStreamAdd','validateSOFields', 'fieldname' => 'ConvertInStreamAdd' ,'message' => 'Other Value '),
            array('SurveyDescription,InstreamAdArtifact,SurveyRelatedGroupName,ConvertInStreamAdd,SurveyId,SurveyTitle,RenewSchedules,StartDate,EndDate,ShowThankYou,ThankYouMessage,ThankYouArtifact', 'safe'),
            
        );
    }
    public function validateSOFields($attribute, $params){       
                if($this->ConvertInStreamAdd == "1"){                    
                    if($this->InstreamAdArtifact== ""){
                        $message=" Please upload Instream Ad Image.";                        
                        $this->addError('InstreamAdArtifact', $message);
                    }
                    
                }          
    }

}
