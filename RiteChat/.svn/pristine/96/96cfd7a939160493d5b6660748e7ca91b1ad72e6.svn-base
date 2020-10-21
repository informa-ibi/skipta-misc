<?php

/**
 * ResetForm class.
 * ResetForm is the data structure for resetting
 * user password data. It is used by the 'reset' action of 'UserController'.
 */
class ResetForm extends CFormModel
{
    public $md5UserId;
    public $email;
    public $resetPass;
    public $resetConfirmPass;

    /**
	 * Declares the validation rules.
	 * The rules state that password and retype-password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
        return array(
            
            array('resetPass', 'required','message'=>'Password cannot be blank.'),
            array('resetConfirmPass', 'required','message'=>'Confirm Password cannot be blank.'),
            array('resetPass,resetConfirmPass,email,md5UserId','safe'),
            array('resetPass, resetConfirmPass', 'length', 'min' => 8, 'max' => 25),
            array('resetConfirmPass', 'compare', 'compareAttribute' => 'resetPass','message'=>'Password and Confirm Password did not match.'),
        );
    }


 
}
