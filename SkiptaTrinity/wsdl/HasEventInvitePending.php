<?php

class HasEventInvitePending
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $toUserId
   * @access public
   */
  public $toUserId;

  /**
   * 
   * @var guid $eventId
   * @access public
   */
  public $eventId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $toUserId
   * @param guid $eventId
   * @access public
   */
  public function __construct($session, $toUserId, $eventId)
  {
    $this->session = $session;
    $this->toUserId = $toUserId;
    $this->eventId = $eventId;
  }

}
