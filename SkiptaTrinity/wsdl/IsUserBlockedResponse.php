<?php

class IsUserBlockedResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsUserBlockedResult
   * @access public
   */
  public $IsUserBlockedResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsUserBlockedResult
   * @access public
   */
  public function __construct($IsUserBlockedResult)
  {
    $this->IsUserBlockedResult = $IsUserBlockedResult;
  }

}
