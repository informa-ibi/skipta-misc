<?php

class GetUserInfoResponse
{

  /**
   * 
   * @var SkiptaUserInformationResponse $GetUserInfoResult
   * @access public
   */
  public $GetUserInfoResult;

  /**
   * 
   * @param SkiptaUserInformationResponse $GetUserInfoResult
   * @access public
   */
  public function __construct($GetUserInfoResult)
  {
    $this->GetUserInfoResult = $GetUserInfoResult;
  }

}
