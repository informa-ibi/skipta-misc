<?php

class IsUserAliveForSendingChatMessageResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsUserAliveForSendingChatMessageResult
   * @access public
   */
  public $IsUserAliveForSendingChatMessageResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsUserAliveForSendingChatMessageResult
   * @access public
   */
  public function __construct($IsUserAliveForSendingChatMessageResult)
  {
    $this->IsUserAliveForSendingChatMessageResult = $IsUserAliveForSendingChatMessageResult;
  }

}
