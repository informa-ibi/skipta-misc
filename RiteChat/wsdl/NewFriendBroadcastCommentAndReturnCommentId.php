<?php

class NewFriendBroadcastCommentAndReturnCommentId
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaFriendBroadcastComment $comment
   * @access public
   */
  public $comment;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaFriendBroadcastComment $comment
   * @access public
   */
  public function __construct($session, $comment)
  {
    $this->session = $session;
    $this->comment = $comment;
  }

}
