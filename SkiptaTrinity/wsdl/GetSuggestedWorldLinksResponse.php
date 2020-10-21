<?php

class GetSuggestedWorldLinksResponse
{

  /**
   * 
   * @var array $GetSuggestedWorldLinksResult
   * @access public
   */
  public $GetSuggestedWorldLinksResult;

  /**
   * 
   * @param array $GetSuggestedWorldLinksResult
   * @access public
   */
  public function __construct($GetSuggestedWorldLinksResult)
  {
    $this->GetSuggestedWorldLinksResult = $GetSuggestedWorldLinksResult;
  }

}
