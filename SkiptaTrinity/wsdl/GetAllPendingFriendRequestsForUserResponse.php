<?php

class GetAllPendingFriendRequestsForUserResponse
{

  /**
   * 
   * @var SkiptaFriendListResponse $GetAllPendingFriendRequestsForUserResult
   * @access public
   */
  public $GetAllPendingFriendRequestsForUserResult;

  /**
   * 
   * @param SkiptaFriendListResponse $GetAllPendingFriendRequestsForUserResult
   * @access public
   */
  public function __construct($GetAllPendingFriendRequestsForUserResult)
  {
    $this->GetAllPendingFriendRequestsForUserResult = $GetAllPendingFriendRequestsForUserResult;
  }

}
