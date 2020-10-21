<?php

class UpdateThemeResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateThemeResult
   * @access public
   */
  public $UpdateThemeResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateThemeResult
   * @access public
   */
  public function __construct($UpdateThemeResult)
  {
    $this->UpdateThemeResult = $UpdateThemeResult;
  }

}
