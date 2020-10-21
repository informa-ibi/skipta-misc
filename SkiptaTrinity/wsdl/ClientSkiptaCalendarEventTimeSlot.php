<?php

class ClientSkiptaCalendarEventTimeSlot
{

  /**
   * 
   * @var guid $TimeSlotId
   * @access public
   */
  public $TimeSlotId;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var guid $CreatedGID
   * @access public
   */
  public $CreatedGID;

  /**
   * 
   * @var guid $UpdatedGID
   * @access public
   */
  public $UpdatedGID;

  /**
   * 
   * @var guid $EventGID
   * @access public
   */
  public $EventGID;

  /**
   * 
   * @var dateTime $StartTime
   * @access public
   */
  public $StartTime;

  /**
   * 
   * @var dateTime $EndTime
   * @access public
   */
  public $EndTime;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var dateTime $UpdatedDate
   * @access public
   */
  public $UpdatedDate;

  /**
   * 
   * @var string $Comment
   * @access public
   */
  public $Comment;

  /**
   * 
   * @var boolean $Active
   * @access public
   */
  public $Active;

  /**
   * 
   * @var boolean $Deleted
   * @access public
   */
  public $Deleted;

  /**
   * 
   * @param guid $TimeSlotId
   * @param guid $UserId
   * @param guid $CreatedGID
   * @param guid $UpdatedGID
   * @param guid $EventGID
   * @param dateTime $StartTime
   * @param dateTime $EndTime
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @param string $Comment
   * @param boolean $Active
   * @param boolean $Deleted
   * @access public
   */
  public function __construct($TimeSlotId, $UserId, $CreatedGID, $UpdatedGID, $EventGID, $StartTime, $EndTime, $CreatedDate, $UpdatedDate, $Comment, $Active, $Deleted)
  {
    $this->TimeSlotId = $TimeSlotId;
    $this->UserId = $UserId;
    $this->CreatedGID = $CreatedGID;
    $this->UpdatedGID = $UpdatedGID;
    $this->EventGID = $EventGID;
    $this->StartTime = $StartTime;
    $this->EndTime = $EndTime;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->Comment = $Comment;
    $this->Active = $Active;
    $this->Deleted = $Deleted;
  }

}
