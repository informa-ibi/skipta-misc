<?php

class DeleteFriendBroadcastResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $DeleteFriendBroadcastResult
   * @access public
   */
  public $DeleteFriendBroadcastResult;

  /**
   * 
   * @param SkiptaBooleanResponse $DeleteFriendBroadcastResult
   * @access public
   */
  public function __construct($DeleteFriendBroadcastResult)
  {
    $this->DeleteFriendBroadcastResult = $DeleteFriendBroadcastResult;
  }

}
