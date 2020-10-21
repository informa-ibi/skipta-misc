<?php

class UnFollowABroadcast
{

  /**
   * 
   * @var guid $userguid
   * @access public
   */
  public $userguid;

  /**
   * 
   * @var guid $broadcastguid
   * @access public
   */
  public $broadcastguid;

  /**
   * 
   * @param guid $userguid
   * @param guid $broadcastguid
   * @access public
   */
  public function __construct($userguid, $broadcastguid)
  {
    $this->userguid = $userguid;
    $this->broadcastguid = $broadcastguid;
  }

}
