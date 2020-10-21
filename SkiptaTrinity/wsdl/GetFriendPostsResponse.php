<?php

class GetFriendPostsResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetFriendPostsResult
   * @access public
   */
  public $GetFriendPostsResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetFriendPostsResult
   * @access public
   */
  public function __construct($GetFriendPostsResult)
  {
    $this->GetFriendPostsResult = $GetFriendPostsResult;
  }

}
