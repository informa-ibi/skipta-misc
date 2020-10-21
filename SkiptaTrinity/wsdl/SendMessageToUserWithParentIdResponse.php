<?php

class SendMessageToUserWithParentIdResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $SendMessageToUserWithParentIdResult
   * @access public
   */
  public $SendMessageToUserWithParentIdResult;

  /**
   * 
   * @param SkiptaBooleanResponse $SendMessageToUserWithParentIdResult
   * @access public
   */
  public function __construct($SendMessageToUserWithParentIdResult)
  {
    $this->SendMessageToUserWithParentIdResult = $SendMessageToUserWithParentIdResult;
  }

}
