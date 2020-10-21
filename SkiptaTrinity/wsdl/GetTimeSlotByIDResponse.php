<?php

class GetTimeSlotByIDResponse
{

  /**
   * 
   * @var SkiptaTimeSlotResponse $GetTimeSlotByIDResult
   * @access public
   */
  public $GetTimeSlotByIDResult;

  /**
   * 
   * @param SkiptaTimeSlotResponse $GetTimeSlotByIDResult
   * @access public
   */
  public function __construct($GetTimeSlotByIDResult)
  {
    $this->GetTimeSlotByIDResult = $GetTimeSlotByIDResult;
  }

}
