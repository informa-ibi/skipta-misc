<?php

class GetTopNewsResponse
{

  /**
   * 
   * @var SkiptaNewsFeedResponse $GetTopNewsResult
   * @access public
   */
  public $GetTopNewsResult;

  /**
   * 
   * @param SkiptaNewsFeedResponse $GetTopNewsResult
   * @access public
   */
  public function __construct($GetTopNewsResult)
  {
    $this->GetTopNewsResult = $GetTopNewsResult;
  }

}
