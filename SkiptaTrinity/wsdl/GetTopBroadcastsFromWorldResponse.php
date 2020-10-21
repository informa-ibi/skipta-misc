<?php

class GetTopBroadcastsFromWorldResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetTopBroadcastsFromWorldResult
   * @access public
   */
  public $GetTopBroadcastsFromWorldResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetTopBroadcastsFromWorldResult
   * @access public
   */
  public function __construct($GetTopBroadcastsFromWorldResult)
  {
    $this->GetTopBroadcastsFromWorldResult = $GetTopBroadcastsFromWorldResult;
  }

}
