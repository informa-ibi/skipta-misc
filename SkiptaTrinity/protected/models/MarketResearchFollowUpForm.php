<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MarketResearchFollowUpForm extends CFormModel {

    public $Id;
    public $UserId;
    public $FirstName;
    public $LastName;
    public $State;
    public $City;
    public $Zip;
    public $Credential;
    public $MedicalSpecialty;
    public $Address1;
    public $Address2;
    public $Phone;
    public $NPINumber;
    public $LicensedState;
    public $LicensedStates;
    public $LicensedNumber;
    public $LicensedNumbers;
    public $NPIStatus;
    public $FederalTaxIdOrSSN;
    public $SurveyId;
    public $ScheduleId;
    public $CreatedDate;
    public $NPIState;

    public function rules() {
        return array(
            array('NPIStatus', 'validateOtherFields', 'fieldname' => 'NPIStatus', 'message' => 'Other Value '),
            array('FirstName,LastName,State,City,Zip,Credential,MedicalSpecialty,Address1,Phone,FederalTaxIdOrSSN', 'required'),            
            array('FederalTaxIdOrSSN','length','min'=>'9'),
            array('FederalTaxIdOrSSN','length','max'=>'9'),
            array('NPIState,LicensedNumbers,LicensedStates,NPINumber,LicensedState,LicensedNumber,FirstName,LastName,State,City,Zip,Credential,MedicalSpecialty,Address1,Address2,Phone,FederalTaxIdOrSSN,NPIStatus,SurveyId,ScheduleId', 'safe'),
        );
    }

    public function validateOtherFields($attribute, $params) {
        if ($attribute == "NPIStatus" && $this->NPIStatus == "1") {
            if ($this->LicensedState == "") {
                $message = Yii::t("translation", "Err_LicensedState");
                $this->addError('LicensedStates_1', $message);
            }
            if ($this->LicensedNumber == "") {
                $message = Yii::t("translation", "Err_LicensedNumber");
                $this->addError('LicensedNumber_1', $message);
            }
            if (is_array($this->LicensedState)) {
                foreach ($this->LicensedState as $key => $value) {
                    if ($value == "") {

                        $message = Yii::t("translation", "Err_LicensedState");
                        $this->addError('LicensedStates_' . $key, $message);
                    }
                }
                foreach ($this->LicensedNumber as $key => $value) {
                    if ($value == "") {

                        $message = Yii::t("translation", "Err_LicensedNumber");
                        $this->addError('LicensedNumbers_' . $key, $message);
                    }
                }
                if ($this->LicensedStates == "") {
                    $message = Yii::t("translation", "Err_LicensedState");
                    $this->addError('LicensedStates_1', $message);
                }
                if ($this->LicensedNumbers == "") {
                    $message = Yii::t("translation", "Err_LicensedNumber");
                    $this->addError('LicensedNumber_1', $message);
                }
            }
        } else if ($attribute == "NPIStatus" && $this->NPIStatus == 0) {
            if ($this->NPINumber == "") {
                $message = Yii::t("translation", "Err_NPINumber");
                $this->addError('NPINumber', $message);
            }
            if ($this->NPIState == "") {
                $message = Yii::t("translation", "Err_NPIState");
                $this->addError('NPIState', $message);
            }
        }
    }

}
