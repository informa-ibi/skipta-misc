<?php

class UpdateFriendBroadcastCommentById
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $commentId
   * @access public
   */
  public $commentId;

  /**
   * 
   * @var SkiptaFriendBroadcastComment $comment
   * @access public
   */
  public $comment;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $commentId
   * @param SkiptaFriendBroadcastComment $comment
   * @access public
   */
  public function __construct($session, $commentId, $comment)
  {
    $this->session = $session;
    $this->commentId = $commentId;
    $this->comment = $comment;
  }

}
