<?php

class GetMenusByGroupMenu
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $worldid
   * @access public
   */
  public $worldid;

  /**
   * 
   * @var string $menuGroup
   * @access public
   */
  public $menuGroup;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $worldid
   * @param string $menuGroup
   * @access public
   */
  public function __construct($session, $worldid, $menuGroup)
  {
    $this->session = $session;
    $this->worldid = $worldid;
    $this->menuGroup = $menuGroup;
  }

}
