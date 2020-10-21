<?php

class LoadRecommendedFriendsForWorld
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
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @access public
   */
  public function __construct($session, $world)
  {
    $this->session = $session;
    $this->world = $world;
  }

}
