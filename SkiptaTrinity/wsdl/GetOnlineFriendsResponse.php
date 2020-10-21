<?php

class GetOnlineFriendsResponse
{

  /**
   * 
   * @var SkiptaFriendListResponse $GetOnlineFriendsResult
   * @access public
   */
  public $GetOnlineFriendsResult;

  /**
   * 
   * @param SkiptaFriendListResponse $GetOnlineFriendsResult
   * @access public
   */
  public function __construct($GetOnlineFriendsResult)
  {
    $this->GetOnlineFriendsResult = $GetOnlineFriendsResult;
  }

}
