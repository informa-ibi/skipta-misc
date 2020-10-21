<?php

class UpdateEventInviteResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateEventInviteResult
   * @access public
   */
  public $UpdateEventInviteResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateEventInviteResult
   * @access public
   */
  public function __construct($UpdateEventInviteResult)
  {
    $this->UpdateEventInviteResult = $UpdateEventInviteResult;
  }

}
