<?php

class GetUserByEmailResponse
{

  /**
   * 
   * @var SkiptaClientUserResponse $GetUserByEmailResult
   * @access public
   */
  public $GetUserByEmailResult;

  /**
   * 
   * @param SkiptaClientUserResponse $GetUserByEmailResult
   * @access public
   */
  public function __construct($GetUserByEmailResult)
  {
    $this->GetUserByEmailResult = $GetUserByEmailResult;
  }

}
