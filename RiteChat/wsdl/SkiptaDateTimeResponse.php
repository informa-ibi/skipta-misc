<?php

class SkiptaDateTimeResponse
{

  /**
   * 
   * @var dateTime $Value
   * @access public
   */
  public $Value;

  /**
   * 
   * @param dateTime $Value
   * @access public
   */
  public function __construct($Value)
  {
    $this->Value = $Value;
  }

}
