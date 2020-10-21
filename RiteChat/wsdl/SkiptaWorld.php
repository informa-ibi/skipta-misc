<?php

class SkiptaWorld
{

  /**
   * 
   * @var string $DataHostName
   * @access public
   */
  public $DataHostName;

  /**
   * 
   * @var guid $WorldId
   * @access public
   */
  public $WorldId;

  /**
   * 
   * @param string $DataHostName
   * @param guid $WorldId
   * @access public
   */
  public function __construct($DataHostName, $WorldId)
  {
    $this->DataHostName = $DataHostName;
    $this->WorldId = $WorldId;
  }

}
