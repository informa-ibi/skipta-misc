<?php

class GetAllPendingFriendRequestsResponse
{

  /**
   * 
   * @var SkiptaFriendListResponse $GetAllPendingFriendRequestsResult
   * @access public
   */
  public $GetAllPendingFriendRequestsResult;

  /**
   * 
   * @param SkiptaFriendListResponse $GetAllPendingFriendRequestsResult
   * @access public
   */
  public function __construct($GetAllPendingFriendRequestsResult)
  {
    $this->GetAllPendingFriendRequestsResult = $GetAllPendingFriendRequestsResult;
  }

}
