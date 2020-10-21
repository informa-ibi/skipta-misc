<?php

class GetFriendPostsCountResponse
{

  /**
   * 
   * @var SkiptaFriendBroadcastCollection $GetFriendPostsCountResult
   * @access public
   */
  public $GetFriendPostsCountResult;

  /**
   * 
   * @param SkiptaFriendBroadcastCollection $GetFriendPostsCountResult
   * @access public
   */
  public function __construct($GetFriendPostsCountResult)
  {
    $this->GetFriendPostsCountResult = $GetFriendPostsCountResult;
  }

}
