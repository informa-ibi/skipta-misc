<?php

class UpdateUserPhoneForUserIdResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserPhoneForUserIdResult
   * @access public
   */
  public $UpdateUserPhoneForUserIdResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserPhoneForUserIdResult
   * @access public
   */
  public function __construct($UpdateUserPhoneForUserIdResult)
  {
    $this->UpdateUserPhoneForUserIdResult = $UpdateUserPhoneForUserIdResult;
  }

}
