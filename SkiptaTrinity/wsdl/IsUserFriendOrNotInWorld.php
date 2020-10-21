<?php

class IsUserFriendOrNotInWorld
{

  /**
   * 
   * @var guid $myid
   * @access public
   */
  public $myid;

  /**
   * 
   * @var guid $userid
   * @access public
   */
  public $userid;

  /**
   * 
   * @var guid $worldId
   * @access public
   */
  public $worldId;

  /**
   * 
   * @param guid $myid
   * @param guid $userid
   * @param guid $worldId
   * @access public
   */
  public function __construct($myid, $userid, $worldId)
  {
    $this->myid = $myid;
    $this->userid = $userid;
    $this->worldId = $worldId;
  }

}
