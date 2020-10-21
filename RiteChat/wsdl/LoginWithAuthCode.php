<?php

class LoginWithAuthCode
{

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @var string $code
   * @access public
   */
  public $code;

  /**
   * 
   * @var string $email
   * @access public
   */
  public $email;

  /**
   * 
   * @param guid $userId
   * @param string $code
   * @param string $email
   * @access public
   */
  public function __construct($userId, $code, $email)
  {
    $this->userId = $userId;
    $this->code = $code;
    $this->email = $email;
  }

}
