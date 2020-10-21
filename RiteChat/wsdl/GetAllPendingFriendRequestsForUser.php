<?php

class GetAllPendingFriendRequestsForUser
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @param guid $UserId
   * @access public
   */
  public function __construct($session, $world, $UserId)
  {
    $this->session = $session;
    $this->world = $world;
    $this->UserId = $UserId;
  }

}
