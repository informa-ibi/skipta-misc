<?php

class GetEventById
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $eventId
   * @access public
   */
  public $eventId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $eventId
   * @access public
   */
  public function __construct($session, $eventId)
  {
    $this->session = $session;
    $this->eventId = $eventId;
  }

}
