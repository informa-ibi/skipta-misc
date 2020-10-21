<?php

class SendMessageToUserResponse
{

  /**
   * 
   * @var SkiptaGuidResponse $SendMessageToUserResult
   * @access public
   */
  public $SendMessageToUserResult;

  /**
   * 
   * @param SkiptaGuidResponse $SendMessageToUserResult
   * @access public
   */
  public function __construct($SendMessageToUserResult)
  {
    $this->SendMessageToUserResult = $SendMessageToUserResult;
  }

}
