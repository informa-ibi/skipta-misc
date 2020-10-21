<?php

class SkiptaGlobalSearchResponse
{

  /**
   * 
   * @var SkiptaUserGlobalSearchResponse $SkiptaGlobalSearchResult
   * @access public
   */
  public $SkiptaGlobalSearchResult;

  /**
   * 
   * @param SkiptaUserGlobalSearchResponse $SkiptaGlobalSearchResult
   * @access public
   */
  public function __construct($SkiptaGlobalSearchResult)
  {
    $this->SkiptaGlobalSearchResult = $SkiptaGlobalSearchResult;
  }

}
