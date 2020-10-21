<?php

class AddEventInvite
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
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaCalendarEventInvite $invite
   * @access public
   */
  public function __construct($session, $invite)
  {
    $this->session = $session;
    $this->invite = $invite;
  }

}
