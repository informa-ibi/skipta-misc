<?php

class GetUsersBasedOnEventAndRSVP
{

  /**
   * 
   * @var ClientSkiptaSession $mySession
   * @access public
   */
  public $mySession;

  /**
   * 
   * @var guid $eventId
   * @access public
   */
  public $eventId;

  /**
   * 
   * @var SkiptaEventRSVPStatus $rsvpStatus
   * @access public
   */
  public $rsvpStatus;

  /**
   * 
   * @param ClientSkiptaSession $mySession
   * @param guid $eventId
   * @param SkiptaEventRSVPStatus $rsvpStatus
   * @access public
   */
  public function __construct($mySession, $eventId, $rsvpStatus)
  {
    $this->mySession = $mySession;
    $this->eventId = $eventId;
    $this->rsvpStatus = $rsvpStatus;
  }

}
