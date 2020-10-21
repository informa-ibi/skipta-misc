<?php

class ClientSkiptaSession
{

  /**
   * 
   * @var guid $MobileDeviceId
   * @access public
   */
  public $MobileDeviceId;

  /**
   * 
   * @var string $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var string $SessionId
   * @access public
   */
  public $SessionId;

  /**
   * 
   * @var int $Timeout
   * @access public
   */
  public $Timeout;

  /**
   * 
   * @param guid $MobileDeviceId
   * @param string $UserId
   * @param string $SessionId
   * @param int $Timeout
   * @access public
   */
  public function __construct($MobileDeviceId, $UserId, $SessionId, $Timeout)
  {
    $this->MobileDeviceId = $MobileDeviceId;
    $this->UserId = $UserId;
    $this->SessionId = $SessionId;
    $this->Timeout = $Timeout;
  }

}
