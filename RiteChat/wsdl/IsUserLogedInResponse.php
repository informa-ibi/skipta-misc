<?php

class IsUserLogedInResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsUserLogedInResult
   * @access public
   */
  public $IsUserLogedInResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsUserLogedInResult
   * @access public
   */
  public function __construct($IsUserLogedInResult)
  {
    $this->IsUserLogedInResult = $IsUserLogedInResult;
  }

}
