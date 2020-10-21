<?php

class GetEventsForUserByRSVP
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
   * @var SkiptaEventRSVPStatus $rsvpStatus
   * @access public
   */
  public $rsvpStatus;

  /**
   * 
   * @param ClientSkiptaSession $mySession
   * @param guid $userId
   * @param dateTime $startDate
   * @param dateTime $endDate
   * @param SkiptaEventRSVPStatus $rsvpStatus
   * @access public
   */
  public function __construct($mySession, $userId, $startDate, $endDate, $rsvpStatus)
  {
    $this->mySession = $mySession;
    $this->userId = $userId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->rsvpStatus = $rsvpStatus;
  }

}
