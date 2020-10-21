<?php

class SkiptaNewsFeedSetting
{

  /**
   * 
   * @var guid $SkiptaWorldId
   * @access public
   */
  public $SkiptaWorldId;

  /**
   * 
   * @var guid $NewsFeedId
   * @access public
   */
  public $NewsFeedId;

  /**
   * 
   * @var boolean $SettingActive
   * @access public
   */
  public $SettingActive;

  /**
   * 
   * @var dateTime $LastUpdated
   * @access public
   */
  public $LastUpdated;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $FeedUrl
   * @access public
   */
  public $FeedUrl;

  /**
   * 
   * @param guid $SkiptaWorldId
   * @param guid $NewsFeedId
   * @param boolean $SettingActive
   * @param dateTime $LastUpdated
   * @param string $Title
   * @param string $FeedUrl
   * @access public
   */
  public function __construct($SkiptaWorldId, $NewsFeedId, $SettingActive, $LastUpdated, $Title, $FeedUrl)
  {
    $this->SkiptaWorldId = $SkiptaWorldId;
    $this->NewsFeedId = $NewsFeedId;
    $this->SettingActive = $SettingActive;
    $this->LastUpdated = $LastUpdated;
    $this->Title = $Title;
    $this->FeedUrl = $FeedUrl;
  }

}
