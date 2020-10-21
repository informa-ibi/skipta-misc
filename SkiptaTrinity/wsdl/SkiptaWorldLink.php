<?php

class SkiptaWorldLink
{

  /**
   * 
   * @var guid $CategoryLinkId
   * @access public
   */
  public $CategoryLinkId;

  /**
   * 
   * @var string $CategoryName
   * @access public
   */
  public $CategoryName;

  /**
   * 
   * @var guid $SkiptaWorldLinkCategoryId
   * @access public
   */
  public $SkiptaWorldLinkCategoryId;

  /**
   * 
   * @var string $Title
   * @access public
   */
  public $Title;

  /**
   * 
   * @var string $Description
   * @access public
   */
  public $Description;

  /**
   * 
   * @var string $Link
   * @access public
   */
  public $Link;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @param guid $CategoryLinkId
   * @param string $CategoryName
   * @param guid $SkiptaWorldLinkCategoryId
   * @param string $Title
   * @param string $Description
   * @param string $Link
   * @param dateTime $CreatedDate
   * @access public
   */
  public function __construct($CategoryLinkId, $CategoryName, $SkiptaWorldLinkCategoryId, $Title, $Description, $Link, $CreatedDate)
  {
    $this->CategoryLinkId = $CategoryLinkId;
    $this->CategoryName = $CategoryName;
    $this->SkiptaWorldLinkCategoryId = $SkiptaWorldLinkCategoryId;
    $this->Title = $Title;
    $this->Description = $Description;
    $this->Link = $Link;
    $this->CreatedDate = $CreatedDate;
  }

}
