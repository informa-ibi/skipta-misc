<?php

class EditProfileLinkResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $EditProfileLinkResult
   * @access public
   */
  public $EditProfileLinkResult;

  /**
   * 
   * @param SkiptaBooleanResponse $EditProfileLinkResult
   * @access public
   */
  public function __construct($EditProfileLinkResult)
  {
    $this->EditProfileLinkResult = $EditProfileLinkResult;
  }

}
