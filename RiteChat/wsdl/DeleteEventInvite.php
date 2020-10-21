<?php

class DeleteEventInvite
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaCalendarEventInvite $invite
   * @access public
   */
  public $invite;

  /**
   * 
   * @var SkiptaEventRSVPStatus $newStatus
   * @access public
   */
  public $newStatus;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaCalendarEventInvite $invite
   * @param SkiptaEventRSVPStatus $newStatus
   * @access public
   */
  public function __construct($session, $invite, $newStatus)
  {
    $this->session = $session;
    $this->invite = $invite;
    $this->newStatus = $newStatus;
  }

}
