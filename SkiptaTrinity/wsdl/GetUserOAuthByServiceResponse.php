<?php

class GetUserOAuthByServiceResponse
{

  /**
   * 
   * @var SkiptaUserOAuth $GetUserOAuthByServiceResult
   * @access public
   */
  public $GetUserOAuthByServiceResult;

  /**
   * 
   * @param SkiptaUserOAuth $GetUserOAuthByServiceResult
   * @access public
   */
  public function __construct($GetUserOAuthByServiceResult)
  {
    $this->GetUserOAuthByServiceResult = $GetUserOAuthByServiceResult;
  }

}
