<?php

class UpdateUserFileResponse
{

  /**
   * 
   * @var SkiptaUserFileResponse $UpdateUserFileResult
   * @access public
   */
  public $UpdateUserFileResult;

  /**
   * 
   * @param SkiptaUserFileResponse $UpdateUserFileResult
   * @access public
   */
  public function __construct($UpdateUserFileResult)
  {
    $this->UpdateUserFileResult = $UpdateUserFileResult;
  }

}
