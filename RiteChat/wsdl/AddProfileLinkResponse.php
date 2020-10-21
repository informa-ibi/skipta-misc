<?php

class AddProfileLinkResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $AddProfileLinkResult
   * @access public
   */
  public $AddProfileLinkResult;

  /**
   * 
   * @param SkiptaBooleanResponse $AddProfileLinkResult
   * @access public
   */
  public function __construct($AddProfileLinkResult)
  {
    $this->AddProfileLinkResult = $AddProfileLinkResult;
  }

}
