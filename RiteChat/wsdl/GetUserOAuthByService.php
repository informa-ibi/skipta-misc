<?php

class GetUserOAuthByService
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $service
   * @access public
   */
  public $service;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $service
   * @access public
   */
  public function __construct($session, $service)
  {
    $this->session = $session;
    $this->service = $service;
  }

}
