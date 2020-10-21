<?php

class ClientSkiptaCalendarEventInvite
{

  /**
   * 
   * @var guid $EventInviteID
   * @access public
   */
  public $EventInviteID;

  /**
   * 
   * @var guid $EventID
   * @access public
   */
  public $EventID;

  /**
   * 
   * @var guid $SentByUserID
   * @access public
   */
  public $SentByUserID;

  /**
   * 
   * @var guid $ToUserID
   * @access public
   */
  public $ToUserID;

  /**
   * 
   * @var SkiptaEventRSVPStatus $EventRSVPStatus
   * @access public
   */
  public $EventRSVPStatus;

  /**
   * 
   * @var dateTime $SentDate
   * @access public
   */
  public $SentDate;

  /**
   * 
   * @var string $OptionalMessage
   * @access public
   */
  public $OptionalMessage;

  /**
   * 
   * @param guid $EventInviteID
   * @param guid $EventID
   * @param guid $SentByUserID
   * @param guid $ToUserID
   * @param SkiptaEventRSVPStatus $EventRSVPStatus
   * @param dateTime $SentDate
   * @param string $OptionalMessage
   * @access public
   */
  public function __construct($EventInviteID, $EventID, $SentByUserID, $ToUserID, $EventRSVPStatus, $SentDate, $OptionalMessage)
  {
    $this->EventInviteID = $EventInviteID;
    $this->EventID = $EventID;
    $this->SentByUserID = $SentByUserID;
    $this->ToUserID = $ToUserID;
    $this->EventRSVPStatus = $EventRSVPStatus;
    $this->SentDate = $SentDate;
    $this->OptionalMessage = $OptionalMessage;
  }

}
