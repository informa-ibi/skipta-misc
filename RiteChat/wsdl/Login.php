<?php

class Login
{

  /**
   * 
   * @var string $email
   * @access public
   */
  public $email;

  /**
   * 
   * @var string $password
   * @access public
   */
  public $password;

  /**
   * 
   * @var int $timeout
   * @access public
   */
  public $timeout;

  /**
   * 
   * @param string $email
   * @param string $password
   * @param int $timeout
   * @access public
   */
  public function __construct($email, $password, $timeout)
  {
    $this->email = $email;
    $this->password = $password;
    $this->timeout = $timeout;
  }

}
