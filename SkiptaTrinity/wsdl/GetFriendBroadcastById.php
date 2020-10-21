<?php

class GetFriendBroadcastById
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $postId
   * @access public
   */
  public $postId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $postId
   * @access public
   */
  public function __construct($session, $postId)
  {
    $this->session = $session;
    $this->postId = $postId;
  }

}
