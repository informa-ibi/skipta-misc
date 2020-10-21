<?php

class UpdateTimeSlotResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateTimeSlotResult
   * @access public
   */
  public $UpdateTimeSlotResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateTimeSlotResult
   * @access public
   */
  public function __construct($UpdateTimeSlotResult)
  {
    $this->UpdateTimeSlotResult = $UpdateTimeSlotResult;
  }

}
