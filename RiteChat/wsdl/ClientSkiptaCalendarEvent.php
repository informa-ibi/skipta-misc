<?php

class ClientSkiptaCalendarEvent
{

  /**
   * 
   * @var guid $EventGID
   * @access public
   */
  public $EventGID;

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
   * @var guid $orgId
   * @access public
   */
  public $orgId;

  /**
   * 
   * @var int $LegacyEventID
   * @access public
   */
  public $LegacyEventID;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $Details
   * @access public
   */
  public $Details;

  /**
   * 
   * @var string $Location
   * @access public
   */
  public $Location;

  /**
   * 
   * @var string $eventClassName
   * @access public
   */
  public $eventClassName;

  /**
   * 
   * @var string $eventType
   * @access public
   */
  public $eventType;

  /**
   * 
   * @var string $orgName
   * @access public
   */
  public $orgName;

  /**
   * 
   * @var dateTime $EventDate
   * @access public
   */
  public $EventDate;

  /**
   * 
   * @var dateTime $EventEndDate
   * @access public
   */
  public $EventEndDate;

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
   * @var boolean $AllowTimeSlots
   * @access public
   */
  public $AllowTimeSlots;

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
   * @var array $TimeSlots
   * @access public
   */
  public $TimeSlots;

  /**
   * 
   * @param guid $EventGID
   * @param guid $CreatedGID
   * @param guid $UpdatedGID
   * @param guid $orgId
   * @param int $LegacyEventID
   * @param string $Title
   * @param string $Details
   * @param string $Location
   * @param string $eventClassName
   * @param string $eventType
   * @param string $orgName
   * @param dateTime $EventDate
   * @param dateTime $EventEndDate
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @param boolean $AllowTimeSlots
   * @param boolean $Active
   * @param boolean $Deleted
   * @param array $TimeSlots
   * @access public
   */
  public function __construct($EventGID, $CreatedGID, $UpdatedGID, $orgId, $LegacyEventID, $Title, $Details, $Location, $eventClassName, $eventType, $orgName, $EventDate, $EventEndDate, $CreatedDate, $UpdatedDate, $AllowTimeSlots, $Active, $Deleted, $TimeSlots)
  {
    $this->EventGID = $EventGID;
    $this->CreatedGID = $CreatedGID;
    $this->UpdatedGID = $UpdatedGID;
    $this->orgId = $orgId;
    $this->LegacyEventID = $LegacyEventID;
    $this->Title = $Title;
    $this->Details = $Details;
    $this->Location = $Location;
    $this->eventClassName = $eventClassName;
    $this->eventType = $eventType;
    $this->orgName = $orgName;
    $this->EventDate = $EventDate;
    $this->EventEndDate = $EventEndDate;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->AllowTimeSlots = $AllowTimeSlots;
    $this->Active = $Active;
    $this->Deleted = $Deleted;
    $this->TimeSlots = $TimeSlots;
  }

}
