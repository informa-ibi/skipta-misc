<?php

class GetProfileLinksResponse
{

  /**
   * 
   * @var SkiptaProfileLinkResponse $GetProfileLinksResult
   * @access public
   */
  public $GetProfileLinksResult;

  /**
   * 
   * @param SkiptaProfileLinkResponse $GetProfileLinksResult
   * @access public
   */
  public function __construct($GetProfileLinksResult)
  {
    $this->GetProfileLinksResult = $GetProfileLinksResult;
  }

}
