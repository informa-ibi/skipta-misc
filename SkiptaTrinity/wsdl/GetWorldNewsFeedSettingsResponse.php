<?php

class GetWorldNewsFeedSettingsResponse
{

  /**
   * 
   * @var SkiptaNewsFeedResponse $GetWorldNewsFeedSettingsResult
   * @access public
   */
  public $GetWorldNewsFeedSettingsResult;

  /**
   * 
   * @param SkiptaNewsFeedResponse $GetWorldNewsFeedSettingsResult
   * @access public
   */
  public function __construct($GetWorldNewsFeedSettingsResult)
  {
    $this->GetWorldNewsFeedSettingsResult = $GetWorldNewsFeedSettingsResult;
  }

}
