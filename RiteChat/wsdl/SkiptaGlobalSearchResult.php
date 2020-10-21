<?php

class SkiptaGlobalSearchResult
{

  /**
   * 
   * @var string $title
   * @access public
   */
  public $title;

  /**
   * 
   * @var string $downloadLink
   * @access public
   */
  public $downloadLink;

  /**
   * 
   * @var string $content
   * @access public
   */
  public $content;

  /**
   * 
   * @var string $navigationLink
   * @access public
   */
  public $navigationLink;

  /**
   * 
   * @var string $thumbnail
   * @access public
   */
  public $thumbnail;

  /**
   * 
   * @var boolean $openInNewTab
   * @access public
   */
  public $openInNewTab;

  /**
   * 
   * @var SkiptaGlobalSearchResultSource $skiptaGlobalSearchResultSource
   * @access public
   */
  public $skiptaGlobalSearchResultSource;

  /**
   * 
   * @param string $title
   * @param string $downloadLink
   * @param string $content
   * @param string $navigationLink
   * @param string $thumbnail
   * @param boolean $openInNewTab
   * @param SkiptaGlobalSearchResultSource $skiptaGlobalSearchResultSource
   * @access public
   */
  public function __construct($title, $downloadLink, $content, $navigationLink, $thumbnail, $openInNewTab, $skiptaGlobalSearchResultSource)
  {
    $this->title = $title;
    $this->downloadLink = $downloadLink;
    $this->content = $content;
    $this->navigationLink = $navigationLink;
    $this->thumbnail = $thumbnail;
    $this->openInNewTab = $openInNewTab;
    $this->skiptaGlobalSearchResultSource = $skiptaGlobalSearchResultSource;
  }

}
