<?php

class AddEvent
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @var ClientSkiptaCalendarEvent $calendarEvent
   * @access public
   */
  public $calendarEvent;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $userId
   * @param ClientSkiptaCalendarEvent $calendarEvent
   * @access public
   */
  public function __construct($session, $userId, $calendarEvent)
  {
    $this->session = $session;
    $this->userId = $userId;
    $this->calendarEvent = $calendarEvent;
  }

}
