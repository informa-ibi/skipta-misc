<?php

class AddWorldLinkToCategory
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaWorldLink $link
   * @access public
   */
  public $link;

  /**
   * 
   * @var SkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaWorldLink $link
   * @param SkiptaWorld $world
   * @access public
   */
  public function __construct($session, $link, $world)
  {
    $this->session = $session;
    $this->link = $link;
    $this->world = $world;
  }

}
