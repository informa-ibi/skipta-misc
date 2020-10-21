<?php

class RegisterUserResponse
{

  /**
   * 
   * @var SkiptaNewUserResponse $RegisterUserResult
   * @access public
   */
  public $RegisterUserResult;

  /**
   * 
   * @param SkiptaNewUserResponse $RegisterUserResult
   * @access public
   */
  public function __construct($RegisterUserResult)
  {
    $this->RegisterUserResult = $RegisterUserResult;
  }

}
