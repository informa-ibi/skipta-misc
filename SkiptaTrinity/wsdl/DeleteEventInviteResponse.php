<?php

class DeleteEventInviteResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $DeleteEventInviteResult
   * @access public
   */
  public $DeleteEventInviteResult;

  /**
   * 
   * @param SkiptaBooleanResponse $DeleteEventInviteResult
   * @access public
   */
  public function __construct($DeleteEventInviteResult)
  {
    $this->DeleteEventInviteResult = $DeleteEventInviteResult;
  }

}
