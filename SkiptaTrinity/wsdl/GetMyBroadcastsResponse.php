<?php

class GetMyBroadcastsResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetMyBroadcastsResult
   * @access public
   */
  public $GetMyBroadcastsResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetMyBroadcastsResult
   * @access public
   */
  public function __construct($GetMyBroadcastsResult)
  {
    $this->GetMyBroadcastsResult = $GetMyBroadcastsResult;
  }

}
