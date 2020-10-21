<?php

class UpdateUserName
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $firstname
   * @access public
   */
  public $firstname;

  /**
   * 
   * @var string $lastname
   * @access public
   */
  public $lastname;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $firstname
   * @param string $lastname
   * @access public
   */
  public function __construct($session, $firstname, $lastname)
  {
    $this->session = $session;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

}
