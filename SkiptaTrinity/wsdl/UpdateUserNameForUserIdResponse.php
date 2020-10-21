<?php

class UpdateUserNameForUserIdResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserNameForUserIdResult
   * @access public
   */
  public $UpdateUserNameForUserIdResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserNameForUserIdResult
   * @access public
   */
  public function __construct($UpdateUserNameForUserIdResult)
  {
    $this->UpdateUserNameForUserIdResult = $UpdateUserNameForUserIdResult;
  }

}
