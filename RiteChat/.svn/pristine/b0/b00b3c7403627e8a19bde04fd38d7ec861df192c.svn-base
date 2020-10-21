<?php

class UpdateFriend
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $friendUserId
   * @access public
   */
  public $friendUserId;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @var SkiptaUserRelationshipStatus $newStatus
   * @access public
   */
  public $newStatus;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $friendUserId
   * @param ClientSkiptaWorld $world
   * @param SkiptaUserRelationshipStatus $newStatus
   * @access public
   */
  public function __construct($session, $friendUserId, $world, $newStatus)
  {
    $this->session = $session;
    $this->friendUserId = $friendUserId;
    $this->world = $world;
    $this->newStatus = $newStatus;
  }

}
