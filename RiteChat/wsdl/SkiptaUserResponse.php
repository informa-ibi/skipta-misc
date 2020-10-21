<?php

class SkiptaUserResponse
{

  /**
   * 
   * @var ClientSkiptaUser $m_user
   * @access public
   */
  public $m_user;

  /**
   * 
   * @var string $WidgetState
   * @access public
   */
  public $WidgetState;

  /**
   * 
   * @var ClientSkiptaUser $User
   * @access public
   */
  public $User;

  /**
   * 
   * @var SkiptaUserAddressResponse $Address
   * @access public
   */
  public $Address;

  /**
   * 
   * @var string $Firstname
   * @access public
   */
  public $Firstname;

  /**
   * 
   * @var string $Lastname
   * @access public
   */
  public $Lastname;

  /**
   * 
   * @var string $Nickname
   * @access public
   */
  public $Nickname;

  /**
   * 
   * @var string $Password
   * @access public
   */
  public $Password;

  /**
   * 
   * @var string $Email
   * @access public
   */
  public $Email;

  /**
   * 
   * @var string $Phone
   * @access public
   */
  public $Phone;

  /**
   * 
   * @var string $Active
   * @access public
   */
  public $Active;

  /**
   * 
   * @var string $ReferralCode
   * @access public
   */
  public $ReferralCode;

  /**
   * 
   * @var string $ConfirmationCode
   * @access public
   */
  public $ConfirmationCode;

  /**
   * 
   * @var string $UserCode
   * @access public
   */
  public $UserCode;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var dateTime $UpdatedDate
   * @access public
   */
  public $UpdatedDate;

  /**
   * 
   * @var dateTime $LastLoginDate
   * @access public
   */
  public $LastLoginDate;

  /**
   * 
   * @var dateTime $LastActivityDate
   * @access public
   */
  public $LastActivityDate;

  /**
   * 
   * @var int $RegistrationAccepted
   * @access public
   */
  public $RegistrationAccepted;

  /**
   * 
   * @var int $ChangePassword
   * @access public
   */
  public $ChangePassword;

  /**
   * 
   * @var boolean $IsSalted
   * @access public
   */
  public $IsSalted;

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
   * @param ClientSkiptaUser $m_user
   * @param string $WidgetState
   * @param ClientSkiptaUser $User
   * @param SkiptaUserAddressResponse $Address
   * @param string $Firstname
   * @param string $Lastname
   * @param string $Nickname
   * @param string $Password
   * @param string $Email
   * @param string $Phone
   * @param string $Active
   * @param string $ReferralCode
   * @param string $ConfirmationCode
   * @param string $UserCode
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @param dateTime $LastLoginDate
   * @param dateTime $LastActivityDate
   * @param int $RegistrationAccepted
   * @param int $ChangePassword
   * @param boolean $IsSalted
   * @param string $UserId
   * @param string $ReferralId
   * @access public
   */
  public function __construct($m_user, $WidgetState, $User, $Address, $Firstname, $Lastname, $Nickname, $Password, $Email, $Phone, $Active, $ReferralCode, $ConfirmationCode, $UserCode, $CreatedDate, $UpdatedDate, $LastLoginDate, $LastActivityDate, $RegistrationAccepted, $ChangePassword, $IsSalted, $UserId, $ReferralId)
  {
    $this->m_user = $m_user;
    $this->WidgetState = $WidgetState;
    $this->User = $User;
    $this->Address = $Address;
    $this->Firstname = $Firstname;
    $this->Lastname = $Lastname;
    $this->Nickname = $Nickname;
    $this->Password = $Password;
    $this->Email = $Email;
    $this->Phone = $Phone;
    $this->Active = $Active;
    $this->ReferralCode = $ReferralCode;
    $this->ConfirmationCode = $ConfirmationCode;
    $this->UserCode = $UserCode;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->LastLoginDate = $LastLoginDate;
    $this->LastActivityDate = $LastActivityDate;
    $this->RegistrationAccepted = $RegistrationAccepted;
    $this->ChangePassword = $ChangePassword;
    $this->IsSalted = $IsSalted;
    $this->UserId = $UserId;
    $this->ReferralId = $ReferralId;
  }

}
