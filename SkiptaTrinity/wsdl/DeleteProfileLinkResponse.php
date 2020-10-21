<?php

class DeleteProfileLinkResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $DeleteProfileLinkResult
   * @access public
   */
  public $DeleteProfileLinkResult;

  /**
   * 
   * @param SkiptaBooleanResponse $DeleteProfileLinkResult
   * @access public
   */
  public function __construct($DeleteProfileLinkResult)
  {
    $this->DeleteProfileLinkResult = $DeleteProfileLinkResult;
  }

}
