<?php

class GetAllWorldsByUserIdResponse
{

  /**
   * 
   * @var SkiptaWorldCollectionResponse $GetAllWorldsByUserIdResult
   * @access public
   */
  public $GetAllWorldsByUserIdResult;

  /**
   * 
   * @param SkiptaWorldCollectionResponse $GetAllWorldsByUserIdResult
   * @access public
   */
  public function __construct($GetAllWorldsByUserIdResult)
  {
    $this->GetAllWorldsByUserIdResult = $GetAllWorldsByUserIdResult;
  }

}
