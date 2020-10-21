<?php

class UpdateSkiptaUserStatus
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $newStatus
   * @access public
   */
  public $newStatus;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $newStatus
   * @access public
   */
  public function __construct($session, $newStatus)
  {
    $this->session = $session;
    $this->newStatus = $newStatus;
  }

}
