<?php

class GetMessagesForUserResponse
{

  /**
   * 
   * @var SkiptaInboxMessagesResponse $GetMessagesForUserResult
   * @access public
   */
  public $GetMessagesForUserResult;

  /**
   * 
   * @param SkiptaInboxMessagesResponse $GetMessagesForUserResult
   * @access public
   */
  public function __construct($GetMessagesForUserResult)
  {
    $this->GetMessagesForUserResult = $GetMessagesForUserResult;
  }

}
