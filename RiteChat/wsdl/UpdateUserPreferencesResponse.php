<?php

class UpdateUserPreferencesResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserPreferencesResult
   * @access public
   */
  public $UpdateUserPreferencesResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserPreferencesResult
   * @access public
   */
  public function __construct($UpdateUserPreferencesResult)
  {
    $this->UpdateUserPreferencesResult = $UpdateUserPreferencesResult;
  }

}
