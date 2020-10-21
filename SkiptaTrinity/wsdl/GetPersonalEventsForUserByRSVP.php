<?php

class GetPersonalEventsForUserByRSVP
{

  /**
   * 
   * @var ClientSkiptaSession $mySession
   * @access public
   */
  public $mySession;

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @var SkiptaEventRSVPStatus $rsvpStatus
   * @access public
   */
  public $rsvpStatus;

  /**
   * 
   * @var dateTime $startDate
   * @access public
   */
  public $startDate;

  /**
   * 
   * @var dateTime $endDate
   * @access public
   */
  public $endDate;

  /**
   * 
   * @param ClientSkiptaSession $mySession
   * @param guid $userId
   * @param SkiptaEventRSVPStatus $rsvpStatus
   * @param dateTime $startDate
   * @param dateTime $endDate
   * @access public
   */
  public function __construct($mySession, $userId, $rsvpStatus, $startDate, $endDate)
  {
    $this->mySession = $mySession;
    $this->userId = $userId;
    $this->rsvpStatus = $rsvpStatus;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
  }

}
