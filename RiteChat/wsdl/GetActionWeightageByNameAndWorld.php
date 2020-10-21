<?php

class GetActionWeightageByNameAndWorld
{

  /**
   * 
   * @var guid $worldId
   * @access public
   */
  public $worldId;

  /**
   * 
   * @var string $actionName
   * @access public
   */
  public $actionName;

  /**
   * 
   * @param guid $worldId
   * @param string $actionName
   * @access public
   */
  public function __construct($worldId, $actionName)
  {
    $this->worldId = $worldId;
    $this->actionName = $actionName;
  }

}
