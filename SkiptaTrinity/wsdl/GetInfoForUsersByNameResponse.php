<?php

class GetInfoForUsersByNameResponse
{

  /**
   * 
   * @var SkiptaUserCollectionResponse $GetInfoForUsersByNameResult
   * @access public
   */
  public $GetInfoForUsersByNameResult;

  /**
   * 
   * @param SkiptaUserCollectionResponse $GetInfoForUsersByNameResult
   * @access public
   */
  public function __construct($GetInfoForUsersByNameResult)
  {
    $this->GetInfoForUsersByNameResult = $GetInfoForUsersByNameResult;
  }

}
