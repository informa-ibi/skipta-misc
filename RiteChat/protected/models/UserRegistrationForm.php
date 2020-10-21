<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserRegistrationForm extends CustomForm
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
        public $pass;
        public $confirmpass;
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
		return array(
			
                    array('email', 'email','checkMX'=>true),
                     array('termsandconditions', 'compare', 'compareValue' => 1, 'message' => 'You should accept term to use our service'),
                   // array('password', 'ext.SPasswordValidator.SPasswordValidator', 'strength'=>'strong'),
                      array('firstName,lastName,salutation,displayName,country,zip,city,state,companyName,profilePicture,email,pass,isPharmacist,aboutMe,contactNumber,interests,referenceUserId,referralLinkId,referralUserEmail', 'safe'),
                      array('firstName,lastName,email,country,zip,city,state,companyName', 'required'),
                    // array('firstName,lastName,address1,address2,zip,city,state,gender,email,password,contactNumber', 'required'),
                     array('zip', 'match', 'pattern'=>'/^[0-9]{5}(-[0-9]{4})?$/i'),
                    array('confirmpass','compare','compareAttribute'=>'pass','message'=>'Confirm pass must be repeated exactly'),
                   array('pass','required', 'message'=>'Password cannot be blank'),
                    array('confirmpass','required', 'message'=>'Confirm password cannot be blank'),
                   // array('contactNumber','numerical','integerOnly'=>true,'min'=>12)
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

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
                  //  'firstName'=>'User Name',
			//'rememberMe'=>'Remember me next time',
                 //    'dob'=>'Date of Birth'
		);
	}

        
}