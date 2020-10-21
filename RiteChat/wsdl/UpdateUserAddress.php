<?php

class UpdateUserAddress
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaUserAddress $address
   * @access public
   */
  public $address;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaUserAddress $address
   * @access public
   */
  public function __construct($session, $address)
  {
    $this->session = $session;
    $this->address = $address;
  }

}
