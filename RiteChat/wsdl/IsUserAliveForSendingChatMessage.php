<?php

class IsUserAliveForSendingChatMessage
{

  /**
   * 
   * @var guid $sessionId
   * @access public
   */
  public $sessionId;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var int $Timeout
   * @access public
   */
  public $Timeout;

  /**
   * 
   * @param guid $sessionId
   * @param guid $UserId
   * @param int $Timeout
   * @access public
   */
  public function __construct($sessionId, $UserId, $Timeout)
  {
    $this->sessionId = $sessionId;
    $this->UserId = $UserId;
    $this->Timeout = $Timeout;
  }

}
