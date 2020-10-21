<?php

class GetMyCreatedEvents
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
   * @param ClientSkiptaSession $mySession
   * @param guid $userId
   * @param dateTime $startDate
   * @param dateTime $endDate
   * @access public
   */
  public function __construct($mySession, $userId, $startDate, $endDate)
  {
    $this->mySession = $mySession;
    $this->userId = $userId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
  }

}
