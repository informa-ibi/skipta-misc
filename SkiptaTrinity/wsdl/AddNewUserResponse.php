<?php

class AddNewUserResponse
{

  /**
   * 
   * @var SkiptaNewUserResponse $AddNewUserResult
   * @access public
   */
  public $AddNewUserResult;

  /**
   * 
   * @param SkiptaNewUserResponse $AddNewUserResult
   * @access public
   */
  public function __construct($AddNewUserResult)
  {
    $this->AddNewUserResult = $AddNewUserResult;
  }

}
