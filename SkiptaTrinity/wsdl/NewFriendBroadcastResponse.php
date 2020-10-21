<?php

class NewFriendBroadcastResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $NewFriendBroadcastResult
   * @access public
   */
  public $NewFriendBroadcastResult;

  /**
   * 
   * @param SkiptaBooleanResponse $NewFriendBroadcastResult
   * @access public
   */
  public function __construct($NewFriendBroadcastResult)
  {
    $this->NewFriendBroadcastResult = $NewFriendBroadcastResult;
  }

}
