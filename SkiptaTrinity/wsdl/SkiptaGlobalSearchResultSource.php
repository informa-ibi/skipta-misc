<?php

class SkiptaGlobalSearchResultSource
{

  /**
   * 
   * @var string $Area
   * @access public
   */
  public $Area;

  /**
   * 
   * @var string $SubArea
   * @access public
   */
  public $SubArea;

  /**
   * 
   * @var string $ContentType
   * @access public
   */
  public $ContentType;

  /**
   * 
   * @var string $HyperLink
   * @access public
   */
  public $HyperLink;

  /**
   * 
   * @param string $Area
   * @param string $SubArea
   * @param string $ContentType
   * @param string $HyperLink
   * @access public
   */
  public function __construct($Area, $SubArea, $ContentType, $HyperLink)
  {
    $this->Area = $Area;
    $this->SubArea = $SubArea;
    $this->ContentType = $ContentType;
    $this->HyperLink = $HyperLink;
  }

}
