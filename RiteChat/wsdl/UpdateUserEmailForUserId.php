<?php

class UpdateUserEmailForUserId
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $newEmail
   * @access public
   */
  public $newEmail;

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $newEmail
   * @param guid $userId
   * @access public
   */
  public function __construct($session, $newEmail, $userId)
  {
    $this->session = $session;
    $this->newEmail = $newEmail;
    $this->userId = $userId;
  }

}
