<?php

class SkiptaUserSessionResponse
{

  /**
   * 
   * @var int $Timeout
   * @access public
   */
  public $Timeout;

  /**
   * 
   * @var guid $SessionID
   * @access public
   */
  public $SessionID;

  /**
   * 
   * @var guid $UserID
   * @access public
   */
  public $UserID;

  /**
   * 
   * @var dateTime $UpdatedDate
   * @access public
   */
  public $UpdatedDate;

  /**
   * 
   * @param int $Timeout
   * @param guid $SessionID
   * @param guid $UserID
   * @param dateTime $UpdatedDate
   * @access public
   */
  public function __construct($Timeout, $SessionID, $UserID, $UpdatedDate)
  {
    $this->Timeout = $Timeout;
    $this->SessionID = $SessionID;
    $this->UserID = $UserID;
    $this->UpdatedDate = $UpdatedDate;
  }

}
