<?php

class SearchForUserInWorldResponse
{

  /**
   * 
   * @var SkiptaUserSearchResponse $SearchForUserInWorldResult
   * @access public
   */
  public $SearchForUserInWorldResult;

  /**
   * 
   * @param SkiptaUserSearchResponse $SearchForUserInWorldResult
   * @access public
   */
  public function __construct($SearchForUserInWorldResult)
  {
    $this->SearchForUserInWorldResult = $SearchForUserInWorldResult;
  }

}
