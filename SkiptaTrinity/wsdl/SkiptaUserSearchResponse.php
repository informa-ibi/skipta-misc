<?php

class SkiptaUserSearchResponse
{

  /**
   * 
   * @var int $TotalCountWithoutPaging
   * @access public
   */
  public $TotalCountWithoutPaging;

  /**
   * 
   * @var array $Results
   * @access public
   */
  public $Results;

  /**
   * 
   * @param int $TotalCountWithoutPaging
   * @param array $Results
   * @access public
   */
  public function __construct($TotalCountWithoutPaging, $Results)
  {
    $this->TotalCountWithoutPaging = $TotalCountWithoutPaging;
    $this->Results = $Results;
  }

}
