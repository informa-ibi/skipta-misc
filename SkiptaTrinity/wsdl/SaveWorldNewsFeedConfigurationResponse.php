<?php

class SaveWorldNewsFeedConfigurationResponse
{

  /**
   * 
   * @var SkiptaNewsFeedResponse $SaveWorldNewsFeedConfigurationResult
   * @access public
   */
  public $SaveWorldNewsFeedConfigurationResult;

  /**
   * 
   * @param SkiptaNewsFeedResponse $SaveWorldNewsFeedConfigurationResult
   * @access public
   */
  public function __construct($SaveWorldNewsFeedConfigurationResult)
  {
    $this->SaveWorldNewsFeedConfigurationResult = $SaveWorldNewsFeedConfigurationResult;
  }

}
