<?php

class GetFriendBroadcastByIdResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcast $GetFriendBroadcastByIdResult
   * @access public
   */
  public $GetFriendBroadcastByIdResult;

  /**
   * 
   * @param SkiptaFriendBroadcast $GetFriendBroadcastByIdResult
   * @access public
   */
  public function __construct($GetFriendBroadcastByIdResult)
  {
    $this->GetFriendBroadcastByIdResult = $GetFriendBroadcastByIdResult;
  }

}
