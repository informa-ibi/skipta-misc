<?php

class SkiptaMenusByGroupMenuResponse
{

  /**
   * 
   * @var guid $WorldID
   * @access public
   */
  public $WorldID;

  /**
   * 
   * @var menuLabels $menuLabels
   * @access public
   */
  public $menuLabels;

  /**
   * 
   * @param guid $WorldID
   * @param menuLabels $menuLabels
   * @access public
   */
  public function __construct($WorldID, $menuLabels)
  {
    $this->WorldID = $WorldID;
    $this->menuLabels = $menuLabels;
  }

}
