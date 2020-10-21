<?php

class UpdateEventResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateEventResult
   * @access public
   */
  public $UpdateEventResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateEventResult
   * @access public
   */
  public function __construct($UpdateEventResult)
  {
    $this->UpdateEventResult = $UpdateEventResult;
  }

}
