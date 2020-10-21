<?php

class GetUserBySessionResponse
{

  /**
   * 
   * @var SkiptaUserResponse $GetUserBySessionResult
   * @access public
   */
  public $GetUserBySessionResult;

  /**
   * 
   * @param SkiptaUserResponse $GetUserBySessionResult
   * @access public
   */
  public function __construct($GetUserBySessionResult)
  {
    $this->GetUserBySessionResult = $GetUserBySessionResult;
  }

}
