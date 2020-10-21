<?php

class SaveUserOAuth
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaUserOAuth $oauth
   * @access public
   */
  public $oauth;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaUserOAuth $oauth
   * @access public
   */
  public function __construct($session, $oauth)
  {
    $this->session = $session;
    $this->oauth = $oauth;
  }

}
