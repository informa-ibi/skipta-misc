<?php

class ActivateUserResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $ActivateUserResult
   * @access public
   */
  public $ActivateUserResult;

  /**
   * 
   * @param SkiptaBooleanResponse $ActivateUserResult
   * @access public
   */
  public function __construct($ActivateUserResult)
  {
    $this->ActivateUserResult = $ActivateUserResult;
  }

}
