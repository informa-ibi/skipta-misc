<?php

class AddUserFileResponse
{

  /**
   * 
   * @var SkiptaUserFileResponse $AddUserFileResult
   * @access public
   */
  public $AddUserFileResult;

  /**
   * 
   * @param SkiptaUserFileResponse $AddUserFileResult
   * @access public
   */
  public function __construct($AddUserFileResult)
  {
    $this->AddUserFileResult = $AddUserFileResult;
  }

}
