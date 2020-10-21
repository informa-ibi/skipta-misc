<?php

class GetAllFriendsForUserResponse
{

  /**
   * 
   * @var SkiptaFriendListResponse $GetAllFriendsForUserResult
   * @access public
   */
  public $GetAllFriendsForUserResult;

  /**
   * 
   * @param SkiptaFriendListResponse $GetAllFriendsForUserResult
   * @access public
   */
  public function __construct($GetAllFriendsForUserResult)
  {
    $this->GetAllFriendsForUserResult = $GetAllFriendsForUserResult;
  }

}
