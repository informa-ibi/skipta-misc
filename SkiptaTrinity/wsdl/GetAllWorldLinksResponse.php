<?php

class GetAllWorldLinksResponse
{

  /**
   * 
   * @var array $GetAllWorldLinksResult
   * @access public
   */
  public $GetAllWorldLinksResult;

  /**
   * 
   * @param array $GetAllWorldLinksResult
   * @access public
   */
  public function __construct($GetAllWorldLinksResult)
  {
    $this->GetAllWorldLinksResult = $GetAllWorldLinksResult;
  }

}
