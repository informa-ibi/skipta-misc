<?php

class GetWidgetWorldLinks
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaWorld $world
   * @access public
   */
  public function __construct($session, $world)
  {
    $this->session = $session;
    $this->world = $world;
  }

}
