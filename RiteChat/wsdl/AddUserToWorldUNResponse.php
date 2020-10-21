<?php

class AddUserToWorldUNResponse
{

  /**
   * 
   * @var SkiptaNewUserResponse $AddUserToWorldUNResult
   * @access public
   */
  public $AddUserToWorldUNResult;

  /**
   * 
   * @param SkiptaNewUserResponse $AddUserToWorldUNResult
   * @access public
   */
  public function __construct($AddUserToWorldUNResult)
  {
    $this->AddUserToWorldUNResult = $AddUserToWorldUNResult;
  }

}
