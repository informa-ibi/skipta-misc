<?php

class IsValidUserResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsValidUserResult
   * @access public
   */
  public $IsValidUserResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsValidUserResult
   * @access public
   */
  public function __construct($IsValidUserResult)
  {
    $this->IsValidUserResult = $IsValidUserResult;
  }

}
