<?php

class AddWorldLinkCategory
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaWorldLinkCategory $category
   * @access public
   */
  public $category;

  /**
   * 
   * @var SkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaWorldLinkCategory $category
   * @param SkiptaWorld $world
   * @access public
   */
  public function __construct($session, $category, $world)
  {
    $this->session = $session;
    $this->category = $category;
    $this->world = $world;
  }

}
