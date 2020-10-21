<?php

class AddProfileLinkToTheCurrentUserResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $AddProfileLinkToTheCurrentUserResult
   * @access public
   */
  public $AddProfileLinkToTheCurrentUserResult;

  /**
   * 
   * @param SkiptaBooleanResponse $AddProfileLinkToTheCurrentUserResult
   * @access public
   */
  public function __construct($AddProfileLinkToTheCurrentUserResult)
  {
    $this->AddProfileLinkToTheCurrentUserResult = $AddProfileLinkToTheCurrentUserResult;
  }

}
