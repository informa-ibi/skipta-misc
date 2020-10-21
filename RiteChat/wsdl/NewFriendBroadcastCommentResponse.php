<?php

class NewFriendBroadcastCommentResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $NewFriendBroadcastCommentResult
   * @access public
   */
  public $NewFriendBroadcastCommentResult;

  /**
   * 
   * @param SkiptaBooleanResponse $NewFriendBroadcastCommentResult
   * @access public
   */
  public function __construct($NewFriendBroadcastCommentResult)
  {
    $this->NewFriendBroadcastCommentResult = $NewFriendBroadcastCommentResult;
  }

}
