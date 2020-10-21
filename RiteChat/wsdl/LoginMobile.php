<?php

class LoginMobile
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
   * @param string $email
   * @param string $password
   * @access public
   */
  public function __construct($email, $password)
  {
    $this->email = $email;
    $this->password = $password;
  }

}
