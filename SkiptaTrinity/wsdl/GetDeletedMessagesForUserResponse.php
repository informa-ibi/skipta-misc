<?php

class GetDeletedMessagesForUserResponse
{

  /**
   * 
   * @var SkiptaDeletedMessagesResponse $GetDeletedMessagesForUserResult
   * @access public
   */
  public $GetDeletedMessagesForUserResult;

  /**
   * 
   * @param SkiptaDeletedMessagesResponse $GetDeletedMessagesForUserResult
   * @access public
   */
  public function __construct($GetDeletedMessagesForUserResult)
  {
    $this->GetDeletedMessagesForUserResult = $GetDeletedMessagesForUserResult;
  }

}
