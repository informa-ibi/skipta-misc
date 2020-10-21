<?php

class AddWorldLinkToCategoryResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $AddWorldLinkToCategoryResult
   * @access public
   */
  public $AddWorldLinkToCategoryResult;

  /**
   * 
   * @param SkiptaBooleanResponse $AddWorldLinkToCategoryResult
   * @access public
   */
  public function __construct($AddWorldLinkToCategoryResult)
  {
    $this->AddWorldLinkToCategoryResult = $AddWorldLinkToCategoryResult;
  }

}
