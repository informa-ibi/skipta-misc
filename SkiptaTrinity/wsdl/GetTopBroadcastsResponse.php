<?php

class GetTopBroadcastsResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetTopBroadcastsResult
   * @access public
   */
  public $GetTopBroadcastsResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetTopBroadcastsResult
   * @access public
   */
  public function __construct($GetTopBroadcastsResult)
  {
    $this->GetTopBroadcastsResult = $GetTopBroadcastsResult;
  }

}
