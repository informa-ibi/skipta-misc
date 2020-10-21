<?php

class SkiptaCalendarEventResponse
{

  /**
   * 
   * @var ClientSkiptaCalendarEvent $EventData
   * @access public
   */
  public $EventData;

  /**
   * 
   * @param ClientSkiptaCalendarEvent $EventData
   * @access public
   */
  public function __construct($EventData)
  {
    $this->EventData = $EventData;
  }

}
