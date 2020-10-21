<?php

class AddEventResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $AddEventResult
   * @access public
   */
  public $AddEventResult;

  /**
   * 
   * @param SkiptaBooleanResponse $AddEventResult
   * @access public
   */
  public function __construct($AddEventResult)
  {
    $this->AddEventResult = $AddEventResult;
  }

}
