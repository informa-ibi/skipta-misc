<?php

class UpdateUserWidgetStateResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserWidgetStateResult
   * @access public
   */
  public $UpdateUserWidgetStateResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserWidgetStateResult
   * @access public
   */
  public function __construct($UpdateUserWidgetStateResult)
  {
    $this->UpdateUserWidgetStateResult = $UpdateUserWidgetStateResult;
  }

}
