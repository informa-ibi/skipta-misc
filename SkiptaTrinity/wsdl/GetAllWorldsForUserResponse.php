<?php

class GetAllWorldsForUserResponse
{

  /**
   * 
   * @var SkiptaWorldCollectionResponse $GetAllWorldsForUserResult
   * @access public
   */
  public $GetAllWorldsForUserResult;

  /**
   * 
   * @param SkiptaWorldCollectionResponse $GetAllWorldsForUserResult
   * @access public
   */
  public function __construct($GetAllWorldsForUserResult)
  {
    $this->GetAllWorldsForUserResult = $GetAllWorldsForUserResult;
  }

}
