<?php

class GetWorldLinksByCategoryResponse
{

  /**
   * 
   * @var SkiptaWorldLinkCategory $GetWorldLinksByCategoryResult
   * @access public
   */
  public $GetWorldLinksByCategoryResult;

  /**
   * 
   * @param SkiptaWorldLinkCategory $GetWorldLinksByCategoryResult
   * @access public
   */
  public function __construct($GetWorldLinksByCategoryResult)
  {
    $this->GetWorldLinksByCategoryResult = $GetWorldLinksByCategoryResult;
  }

}
