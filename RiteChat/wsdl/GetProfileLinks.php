<?php

class GetProfileLinks
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $userId
   * @access public
   */
  public function __construct($session, $userId)
  {
    $this->session = $session;
    $this->userId = $userId;
  }

}
