<?php

class AddWorldLinkCategoryResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $AddWorldLinkCategoryResult
   * @access public
   */
  public $AddWorldLinkCategoryResult;

  /**
   * 
   * @param SkiptaBooleanResponse $AddWorldLinkCategoryResult
   * @access public
   */
  public function __construct($AddWorldLinkCategoryResult)
  {
    $this->AddWorldLinkCategoryResult = $AddWorldLinkCategoryResult;
  }

}
