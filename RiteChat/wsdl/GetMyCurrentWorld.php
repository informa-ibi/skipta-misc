<?php

class GetMyCurrentWorld
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $hostname
   * @access public
   */
  public $hostname;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $hostname
   * @access public
   */
  public function __construct($session, $hostname)
  {
    $this->session = $session;
    $this->hostname = $hostname;
  }

}
