<?php

class ActivateAllUsersResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $ActivateAllUsersResult
   * @access public
   */
  public $ActivateAllUsersResult;

  /**
   * 
   * @param SkiptaBooleanResponse $ActivateAllUsersResult
   * @access public
   */
  public function __construct($ActivateAllUsersResult)
  {
    $this->ActivateAllUsersResult = $ActivateAllUsersResult;
  }

}
