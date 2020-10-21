<?php

class GetAllWorldsResponse
{

  /**
   * 
   * @var SkiptaWorldCollectionResponse $GetAllWorldsResult
   * @access public
   */
  public $GetAllWorldsResult;

  /**
   * 
   * @param SkiptaWorldCollectionResponse $GetAllWorldsResult
   * @access public
   */
  public function __construct($GetAllWorldsResult)
  {
    $this->GetAllWorldsResult = $GetAllWorldsResult;
  }

}
