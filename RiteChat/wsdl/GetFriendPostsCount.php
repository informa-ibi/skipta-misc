<?php

class GetFriendPostsCount
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaFriendPost $skiptaFriendPost
   * @access public
   */
  public $skiptaFriendPost;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaFriendPost $skiptaFriendPost
   * @access public
   */
  public function __construct($session, $skiptaFriendPost)
  {
    $this->session = $session;
    $this->skiptaFriendPost = $skiptaFriendPost;
  }

}
