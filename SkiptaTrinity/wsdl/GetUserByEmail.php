<?php

class GetUserByEmail
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $email
   * @access public
   */
  public $email;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $email
   * @access public
   */
  public function __construct($session, $email)
  {
    $this->session = $session;
    $this->email = $email;
  }

}
