<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserSettingsForm extends CFormModel
{
        public $userId;
	public $username;
        public $firstName;
        public $lastName;
        public $salutation;
        public $displayName;
        public $country;
        public $state;
        public $city;
        public $zip;
        public $companyName;
        public $aboutMe;
        public $interests;
	public $profilePicture;
        public $password;
        public $oldPassword;
        public $confirmpassword;
        public $status;
	public $email;
        public $contactNumber;
        public $network;
        public $termsandconditions;
        public $referenceUserId;
        public $referralLinkId;
        public $referralUserEmail;
        
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            error_log("===inside formdddddddddd====");
		return array(
			
                    array('email', 'email','checkMX'=>true),
                   
                      array('firstName,lastName,country,zip,city,state,companyName,email,password,oldPassword                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ', 'safe'),
                      array('firstName,lastName,email,country,zip,city,companyName', 'required'),
                    
                     array('zip', 'match', 'pattern'=>'/^[0-9]{5}(-[0-9]{4})?$/i'),

                     array(
                            'firstName',
                            'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/',
                            'message' => 'Invalid characters in firstName.',
                      ),
                    array(
                            'lastName',
                            'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/',
                            'message' => 'Invalid characters in lastName.',
                      )
                    
                    
		);
           
	}

	
}
