<?php

class RegisterUserForUNResponse
{

  /**
   * 
   * @var SkiptaNewUserResponse $RegisterUserForUNResult
   * @access public
   */
  public $RegisterUserForUNResult;

  /**
   * 
   * @param SkiptaNewUserResponse $RegisterUserForUNResult
   * @access public
   */
  public function __construct($RegisterUserForUNResult)
  {
    $this->RegisterUserForUNResult = $RegisterUserForUNResult;
  }

}
