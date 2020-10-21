<?php

class NewFriendBroadcast
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @var string $message
   * @access public
   */
  public $message;

  /**
   * 
   * @var string $url
   * @access public
   */
  public $url;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @param string $message
   * @param string $url
   * @access public
   */
  public function __construct($session, $world, $message, $url)
  {
    $this->session = $session;
    $this->world = $world;
    $this->message = $message;
    $this->url = $url;
  }

}
