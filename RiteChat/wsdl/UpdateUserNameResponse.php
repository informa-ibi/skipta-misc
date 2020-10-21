<?php

class UpdateUserNameResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserNameResult
   * @access public
   */
  public $UpdateUserNameResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserNameResult
   * @access public
   */
  public function __construct($UpdateUserNameResult)
  {
    $this->UpdateUserNameResult = $UpdateUserNameResult;
  }

}
