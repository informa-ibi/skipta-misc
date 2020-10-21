<?php

class UpdateUserNameForUserId
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
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $firstname
   * @param string $lastname
   * @param guid $userId
   * @access public
   */
  public function __construct($session, $firstname, $lastname, $userId)
  {
    $this->session = $session;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->userId = $userId;
  }

}
