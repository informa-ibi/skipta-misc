<?php

class SkiptaNewsFeedResponse
{

  /**
   * 
   * @var array $WorldList
   * @access public
   */
  public $WorldList;

  /**
   * 
   * @var array $NewsItems
   * @access public
   */
  public $NewsItems;

  /**
   * 
   * @var array $Settings
   * @access public
   */
  public $Settings;

  /**
   * 
   * @var array $FeedAggregates
   * @access public
   */
  public $FeedAggregates;

  /**
   * 
   * @param array $WorldList
   * @param array $NewsItems
   * @param array $Settings
   * @param array $FeedAggregates
   * @access public
   */
  public function __construct($WorldList, $NewsItems, $Settings, $FeedAggregates)
  {
    $this->WorldList = $WorldList;
    $this->NewsItems = $NewsItems;
    $this->Settings = $Settings;
    $this->FeedAggregates = $FeedAggregates;
  }

}
