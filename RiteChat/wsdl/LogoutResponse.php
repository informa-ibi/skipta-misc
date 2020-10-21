<?php

class LogoutResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $LogoutResult
   * @access public
   */
  public $LogoutResult;

  /**
   * 
   * @param SkiptaBooleanResponse $LogoutResult
   * @access public
   */
  public function __construct($LogoutResult)
  {
    $this->LogoutResult = $LogoutResult;
  }

}
