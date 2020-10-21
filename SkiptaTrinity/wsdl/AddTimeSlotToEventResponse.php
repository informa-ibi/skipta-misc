<?php

class AddTimeSlotToEventResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $AddTimeSlotToEventResult
   * @access public
   */
  public $AddTimeSlotToEventResult;

  /**
   * 
   * @param SkiptaBooleanResponse $AddTimeSlotToEventResult
   * @access public
   */
  public function __construct($AddTimeSlotToEventResult)
  {
    $this->AddTimeSlotToEventResult = $AddTimeSlotToEventResult;
  }

}
