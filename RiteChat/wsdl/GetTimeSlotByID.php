<?php

class GetTimeSlotByID
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $timeSlotId
   * @access public
   */
  public $timeSlotId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $timeSlotId
   * @access public
   */
  public function __construct($session, $timeSlotId)
  {
    $this->session = $session;
    $this->timeSlotId = $timeSlotId;
  }

}
