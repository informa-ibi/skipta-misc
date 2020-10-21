<?php

class UpdateUserCountryResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserCountryResult
   * @access public
   */
  public $UpdateUserCountryResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserCountryResult
   * @access public
   */
  public function __construct($UpdateUserCountryResult)
  {
    $this->UpdateUserCountryResult = $UpdateUserCountryResult;
  }

}
