<?php

class SkiptaClientUserResponse
{

  /**
   * 
   * @var int $ChangePassword
   * @access public
   */
  public $ChangePassword;

  /**
   * 
   * @var int $RegistrationAccepted
   * @access public
   */
  public $RegistrationAccepted;

  /**
   * 
   * @var int $IsSalted
   * @access public
   */
  public $IsSalted;

  /**
   * 
   * @var dateTime $LastActivityDate
   * @access public
   */
  public $LastActivityDate;

  /**
   * 
   * @var dateTime $LastLoginDate
   * @access public
   */
  public $LastLoginDate;

  /**
   * 
   * @var dateTime $UpdatedDate
   * @access public
   */
  public $UpdatedDate;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var boolean $isFriend
   * @access public
   */
  public $isFriend;

  /**
   * 
   * @var string $UserCode
   * @access public
   */
  public $UserCode;

  /**
   * 
   * @var string $ConfirmationCode
   * @access public
   */
  public $ConfirmationCode;

  /**
   * 
   * @var string $ReferralCode
   * @access public
   */
  public $ReferralCode;

  /**
   * 
   * @var string $Active
   * @access public
   */
  public $Active;

  /**
   * 
   * @var string $Phone
   * @access public
   */
  public $Phone;

  /**
   * 
   * @var string $Email
   * @access public
   */
  public $Email;

  /**
   * 
   * @var string $Password
   * @access public
   */
  public $Password;

  /**
   * 
   * @var string $Nickname
   * @access public
   */
  public $Nickname;

  /**
   * 
   * @var string $Lastname
   * @access public
   */
  public $Lastname;

  /**
   * 
   * @var string $Firstname
   * @access public
   */
  public $Firstname;

  /**
   * 
   * @var string $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var ClientSkiptaUserAddress $Address
   * @access public
   */
  public $Address;

  /**
   * 
   * @var string $AboutMe
   * @access public
   */
  public $AboutMe;

  /**
   * 
   * @var string $Interest
   * @access public
   */
  public $Interest;

  /**
   * 
   * @var string $Activities
   * @access public
   */
  public $Activities;

  /**
   * 
   * @var string $Sex
   * @access public
   */
  public $Sex;

  /**
   * 
   * @var string $Quotes
   * @access public
   */
  public $Quotes;

  /**
   * 
   * @var dateTime $DateOfBirth
   * @access public
   */
  public $DateOfBirth;

  /**
   * 
   * @var boolean $IsReady
   * @access public
   */
  public $IsReady;

  /**
   * 
   * @var string $WidgetState
   * @access public
   */
  public $WidgetState;

  /**
   * 
   * @var string $CurrentStatus
   * @access public
   */
  public $CurrentStatus;

  /**
   * 
   * @param int $ChangePassword
   * @param int $RegistrationAccepted
   * @param int $IsSalted
   * @param dateTime $LastActivityDate
   * @param dateTime $LastLoginDate
   * @param dateTime $UpdatedDate
   * @param dateTime $CreatedDate
   * @param boolean $isFriend
   * @param string $UserCode
   * @param string $ConfirmationCode
   * @param string $ReferralCode
   * @param string $Active
   * @param string $Phone
   * @param string $Email
   * @param string $Password
   * @param string $Nickname
   * @param string $Lastname
   * @param string $Firstname
   * @param string $UserId
   * @param ClientSkiptaUserAddress $Address
   * @param string $AboutMe
   * @param string $Interest
   * @param string $Activities
   * @param string $Sex
   * @param string $Quotes
   * @param dateTime $DateOfBirth
   * @param boolean $IsReady
   * @param string $WidgetState
   * @param string $CurrentStatus
   * @access public
   */
  public function __construct($ChangePassword, $RegistrationAccepted, $IsSalted, $LastActivityDate, $LastLoginDate, $UpdatedDate, $CreatedDate, $isFriend, $UserCode, $ConfirmationCode, $ReferralCode, $Active, $Phone, $Email, $Password, $Nickname, $Lastname, $Firstname, $UserId, $Address, $AboutMe, $Interest, $Activities, $Sex, $Quotes, $DateOfBirth, $IsReady, $WidgetState, $CurrentStatus)
  {
    $this->ChangePassword = $ChangePassword;
    $this->RegistrationAccepted = $RegistrationAccepted;
    $this->IsSalted = $IsSalted;
    $this->LastActivityDate = $LastActivityDate;
    $this->LastLoginDate = $LastLoginDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->CreatedDate = $CreatedDate;
    $this->isFriend = $isFriend;
    $this->UserCode = $UserCode;
    $this->ConfirmationCode = $ConfirmationCode;
    $this->ReferralCode = $ReferralCode;
    $this->Active = $Active;
    $this->Phone = $Phone;
    $this->Email = $Email;
    $this->Password = $Password;
    $this->Nickname = $Nickname;
    $this->Lastname = $Lastname;
    $this->Firstname = $Firstname;
    $this->UserId = $UserId;
    $this->Address = $Address;
    $this->AboutMe = $AboutMe;
    $this->Interest = $Interest;
    $this->Activities = $Activities;
    $this->Sex = $Sex;
    $this->Quotes = $Quotes;
    $this->DateOfBirth = $DateOfBirth;
    $this->IsReady = $IsReady;
    $this->WidgetState = $WidgetState;
    $this->CurrentStatus = $CurrentStatus;
  }

}
