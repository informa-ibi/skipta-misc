<?php

class DeleteEvent
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaCalendarEvent $calendarEvent
   * @access public
   */
  public $calendarEvent;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaCalendarEvent $calendarEvent
   * @access public
   */
  public function __construct($session, $calendarEvent)
  {
    $this->session = $session;
    $this->calendarEvent = $calendarEvent;
  }

}
