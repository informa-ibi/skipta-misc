<?php

class GetAllFriendsByStatusAndWorld
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaUserRelationshipStatus $status
   * @access public
   */
  public $status;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaUserRelationshipStatus $status
   * @param ClientSkiptaWorld $world
   * @access public
   */
  public function __construct($session, $status, $world)
  {
    $this->session = $session;
    $this->status = $status;
    $this->world = $world;
  }

}
