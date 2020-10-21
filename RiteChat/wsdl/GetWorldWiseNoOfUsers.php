<?php

class GetWorldWiseNoOfUsers
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @access public
   */
  public function __construct($session)
  {
    $this->session = $session;
  }

}
