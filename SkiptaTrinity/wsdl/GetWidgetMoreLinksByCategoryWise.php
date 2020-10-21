<?php

class GetWidgetMoreLinksByCategoryWise
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
   * @var string $CategoryName
   * @access public
   */
  public $CategoryName;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaWorld $world
   * @param string $CategoryName
   * @access public
   */
  public function __construct($session, $world, $CategoryName)
  {
    $this->session = $session;
    $this->world = $world;
    $this->CategoryName = $CategoryName;
  }

}
