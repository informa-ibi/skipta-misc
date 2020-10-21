<?php

class ClientSkiptaUser
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
   * @var boolean $isFriend
   * @access public
   */
  public $isFriend;

  /**
   * 
   * @var boolean $isFriendRequestFrom
   * @access public
   */
  public $isFriendRequestFrom;

  /**
   * 
   * @var boolean $isFriendRequestSent
   * @access public
   */
  public $isFriendRequestSent;

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
   * @var string $ReferralId
   * @access public
   */
  public $ReferralId;

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
   * @var string $Quotes
   * @access public
   */
  public $Quotes;

  /**
   * 
   * @var string $Sex
   * @access public
   */
  public $Sex;

  /**
   * 
   * @var dateTime $DateOfBirth
   * @access public
   */
  public $DateOfBirth;

  /**
   * 
   * @var ClientSkiptaUserAddress $Address
   * @access public
   */
  public $Address;

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
   * @var boolean $IsReady
   * @access public
   */
  public $IsReady;

  /**
   * 
   * @param int $ChangePassword
   * @param int $RegistrationAccepted
   * @param int $IsSalted
   * @param boolean $isFriend
   * @param boolean $isFriendRequestFrom
   * @param boolean $isFriendRequestSent
   * @param dateTime $LastActivityDate
   * @param dateTime $LastLoginDate
   * @param dateTime $UpdatedDate
   * @param dateTime $CreatedDate
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
   * @param string $ReferralId
   * @param string $AboutMe
   * @param string $Interest
   * @param string $Activities
   * @param string $Quotes
   * @param string $Sex
   * @param dateTime $DateOfBirth
   * @param ClientSkiptaUserAddress $Address
   * @param string $WidgetState
   * @param string $CurrentStatus
   * @param boolean $IsReady
   * @access public
   */
  public function __construct($ChangePassword, $RegistrationAccepted, $IsSalted, $isFriend, $isFriendRequestFrom, $isFriendRequestSent, $LastActivityDate, $LastLoginDate, $UpdatedDate, $CreatedDate, $UserCode, $ConfirmationCode, $ReferralCode, $Active, $Phone, $Email, $Password, $Nickname, $Lastname, $Firstname, $UserId, $ReferralId, $AboutMe, $Interest, $Activities, $Quotes, $Sex, $DateOfBirth, $Address, $WidgetState, $CurrentStatus, $IsReady)
  {
    $this->ChangePassword = $ChangePassword;
    $this->RegistrationAccepted = $RegistrationAccepted;
    $this->IsSalted = $IsSalted;
    $this->isFriend = $isFriend;
    $this->isFriendRequestFrom = $isFriendRequestFrom;
    $this->isFriendRequestSent = $isFriendRequestSent;
    $this->LastActivityDate = $LastActivityDate;
    $this->LastLoginDate = $LastLoginDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->CreatedDate = $CreatedDate;
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
    $this->ReferralId = $ReferralId;
    $this->AboutMe = $AboutMe;
    $this->Interest = $Interest;
    $this->Activities = $Activities;
    $this->Quotes = $Quotes;
    $this->Sex = $Sex;
    $this->DateOfBirth = $DateOfBirth;
    $this->Address = $Address;
    $this->WidgetState = $WidgetState;
    $this->CurrentStatus = $CurrentStatus;
    $this->IsReady = $IsReady;
  }

}
