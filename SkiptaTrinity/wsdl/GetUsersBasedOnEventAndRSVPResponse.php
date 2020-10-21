<?php

class GetUsersBasedOnEventAndRSVPResponse
{

  /**
   * 
   * @var SkiptaUserCollectionResponse $GetUsersBasedOnEventAndRSVPResult
   * @access public
   */
  public $GetUsersBasedOnEventAndRSVPResult;

  /**
   * 
   * @param SkiptaUserCollectionResponse $GetUsersBasedOnEventAndRSVPResult
   * @access public
   */
  public function __construct($GetUsersBasedOnEventAndRSVPResult)
  {
    $this->GetUsersBasedOnEventAndRSVPResult = $GetUsersBasedOnEventAndRSVPResult;
  }

}
