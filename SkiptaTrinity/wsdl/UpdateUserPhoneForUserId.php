<?php

class UpdateUserPhoneForUserId
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $phone
   * @access public
   */
  public $phone;

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $phone
   * @param guid $userId
   * @access public
   */
  public function __construct($session, $phone, $userId)
  {
    $this->session = $session;
    $this->phone = $phone;
    $this->userId = $userId;
  }

}
