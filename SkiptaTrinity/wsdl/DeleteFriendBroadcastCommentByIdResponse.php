<?php

class DeleteFriendBroadcastCommentByIdResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $DeleteFriendBroadcastCommentByIdResult
   * @access public
   */
  public $DeleteFriendBroadcastCommentByIdResult;

  /**
   * 
   * @param SkiptaBooleanResponse $DeleteFriendBroadcastCommentByIdResult
   * @access public
   */
  public function __construct($DeleteFriendBroadcastCommentByIdResult)
  {
    $this->DeleteFriendBroadcastCommentByIdResult = $DeleteFriendBroadcastCommentByIdResult;
  }

}
