<?php

class UpdateUserEmailResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserEmailResult
   * @access public
   */
  public $UpdateUserEmailResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserEmailResult
   * @access public
   */
  public function __construct($UpdateUserEmailResult)
  {
    $this->UpdateUserEmailResult = $UpdateUserEmailResult;
  }

}
