<?php

class SkiptaFriendBroadcastCollection
{

  /**
   * 
   * @var array $Broadcasts
   * @access public
   */
  public $Broadcasts;

  /**
   * 
   * @var SkiptaResponseCode $ResponseCode
   * @access public
   */
  public $ResponseCode;

  /**
   * 
   * @var string $ResponseMessage
   * @access public
   */
  public $ResponseMessage;

  /**
   * 
   * @var int $Count
   * @access public
   */
  public $Count;

  /**
   * 
   * @param array $Broadcasts
   * @param SkiptaResponseCode $ResponseCode
   * @param string $ResponseMessage
   * @param int $Count
   * @access public
   */
  public function __construct($Broadcasts, $ResponseCode, $ResponseMessage, $Count)
  {
    $this->Broadcasts = $Broadcasts;
    $this->ResponseCode = $ResponseCode;
    $this->ResponseMessage = $ResponseMessage;
    $this->Count = $Count;
  }

}
