<?php

class GetInfoForUsers
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var array $users
   * @access public
   */
  public $users;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param array $users
   * @access public
   */
  public function __construct($session, $users)
  {
    $this->session = $session;
    $this->users = $users;
  }

}
