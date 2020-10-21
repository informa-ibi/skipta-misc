<?php

class GetAllBroadcastsResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetAllBroadcastsResult
   * @access public
   */
  public $GetAllBroadcastsResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetAllBroadcastsResult
   * @access public
   */
  public function __construct($GetAllBroadcastsResult)
  {
    $this->GetAllBroadcastsResult = $GetAllBroadcastsResult;
  }

}
