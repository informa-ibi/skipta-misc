<?php

class RemoveUserOAuthByServiceResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $RemoveUserOAuthByServiceResult
   * @access public
   */
  public $RemoveUserOAuthByServiceResult;

  /**
   * 
   * @param SkiptaBooleanResponse $RemoveUserOAuthByServiceResult
   * @access public
   */
  public function __construct($RemoveUserOAuthByServiceResult)
  {
    $this->RemoveUserOAuthByServiceResult = $RemoveUserOAuthByServiceResult;
  }

}
