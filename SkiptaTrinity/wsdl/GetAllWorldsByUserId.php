<?php

class GetAllWorldsByUserId
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $UserId
   * @access public
   */
  public function __construct($session, $UserId)
  {
    $this->session = $session;
    $this->UserId = $UserId;
  }

}
