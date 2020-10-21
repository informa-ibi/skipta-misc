<?php

class GetTopBroadcastsFromWorldByHashtagResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetTopBroadcastsFromWorldByHashtagResult
   * @access public
   */
  public $GetTopBroadcastsFromWorldByHashtagResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetTopBroadcastsFromWorldByHashtagResult
   * @access public
   */
  public function __construct($GetTopBroadcastsFromWorldByHashtagResult)
  {
    $this->GetTopBroadcastsFromWorldByHashtagResult = $GetTopBroadcastsFromWorldByHashtagResult;
  }

}
