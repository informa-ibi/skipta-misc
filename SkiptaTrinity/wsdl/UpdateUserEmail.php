<?php

class UpdateUserEmail
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
   * @param ClientSkiptaSession $session
   * @param string $newEmail
   * @access public
   */
  public function __construct($session, $newEmail)
  {
    $this->session = $session;
    $this->newEmail = $newEmail;
  }

}
