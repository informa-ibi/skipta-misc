<?php

class SearchForUserWithParamsAndHideListResponse
{

  /**
   * 
   * @var SkiptaUserSearchResponse $SearchForUserWithParamsAndHideListResult
   * @access public
   */
  public $SearchForUserWithParamsAndHideListResult;

  /**
   * 
   * @param SkiptaUserSearchResponse $SearchForUserWithParamsAndHideListResult
   * @access public
   */
  public function __construct($SearchForUserWithParamsAndHideListResult)
  {
    $this->SearchForUserWithParamsAndHideListResult = $SearchForUserWithParamsAndHideListResult;
  }

}
