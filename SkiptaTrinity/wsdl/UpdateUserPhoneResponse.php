<?php

class UpdateUserPhoneResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserPhoneResult
   * @access public
   */
  public $UpdateUserPhoneResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserPhoneResult
   * @access public
   */
  public function __construct($UpdateUserPhoneResult)
  {
    $this->UpdateUserPhoneResult = $UpdateUserPhoneResult;
  }

}
