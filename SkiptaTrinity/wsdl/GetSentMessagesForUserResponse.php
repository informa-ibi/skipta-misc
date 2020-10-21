<?php

class GetSentMessagesForUserResponse
{

  /**
   * 
   * @var SkiptaSentMessagesResponse $GetSentMessagesForUserResult
   * @access public
   */
  public $GetSentMessagesForUserResult;

  /**
   * 
   * @param SkiptaSentMessagesResponse $GetSentMessagesForUserResult
   * @access public
   */
  public function __construct($GetSentMessagesForUserResult)
  {
    $this->GetSentMessagesForUserResult = $GetSentMessagesForUserResult;
  }

}
