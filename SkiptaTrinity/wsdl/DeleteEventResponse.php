<?php

class DeleteEventResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $DeleteEventResult
   * @access public
   */
  public $DeleteEventResult;

  /**
   * 
   * @param SkiptaBooleanResponse $DeleteEventResult
   * @access public
   */
  public function __construct($DeleteEventResult)
  {
    $this->DeleteEventResult = $DeleteEventResult;
  }

}
