<?php

class GetUserByIdResponse
{

  /**
   * 
   * @var SkiptaClientUserResponse $GetUserByIdResult
   * @access public
   */
  public $GetUserByIdResult;

  /**
   * 
   * @param SkiptaClientUserResponse $GetUserByIdResult
   * @access public
   */
  public function __construct($GetUserByIdResult)
  {
    $this->GetUserByIdResult = $GetUserByIdResult;
  }

}
