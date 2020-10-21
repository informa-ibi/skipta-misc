<?php

class GetFilesForUserResponse
{

  /**
   * 
   * @var SkiptaUserFileResponse $GetFilesForUserResult
   * @access public
   */
  public $GetFilesForUserResult;

  /**
   * 
   * @param SkiptaUserFileResponse $GetFilesForUserResult
   * @access public
   */
  public function __construct($GetFilesForUserResult)
  {
    $this->GetFilesForUserResult = $GetFilesForUserResult;
  }

}
