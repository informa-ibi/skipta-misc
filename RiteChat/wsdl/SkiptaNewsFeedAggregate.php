<?php

class SkiptaNewsFeedAggregate
{

  /**
   * 
   * @var guid $NewsFeedId
   * @access public
   */
  public $NewsFeedId;

  /**
   * 
   * @var string $FeedTitle
   * @access public
   */
  public $FeedTitle;

  /**
   * 
   * @var int $NewsItems
   * @access public
   */
  public $NewsItems;

  /**
   * 
   * @param guid $NewsFeedId
   * @param string $FeedTitle
   * @param int $NewsItems
   * @access public
   */
  public function __construct($NewsFeedId, $FeedTitle, $NewsItems)
  {
    $this->NewsFeedId = $NewsFeedId;
    $this->FeedTitle = $FeedTitle;
    $this->NewsItems = $NewsItems;
  }

}
