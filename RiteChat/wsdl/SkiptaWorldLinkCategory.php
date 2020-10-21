<?php

class SkiptaWorldLinkCategory
{

  /**
   * 
   * @var array $m_Links
   * @access public
   */
  public $m_Links;

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
   * @var guid $SkiptaWorldId
   * @access public
   */
  public $SkiptaWorldId;

  /**
   * 
   * @var int $Position
   * @access public
   */
  public $Position;

  /**
   * 
   * @var int $CategoryType
   * @access public
   */
  public $CategoryType;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var array $Links
   * @access public
   */
  public $Links;

  /**
   * 
   * @param array $m_Links
   * @param string $CategoryName
   * @param guid $SkiptaWorldLinkCategoryId
   * @param guid $SkiptaWorldId
   * @param int $Position
   * @param int $CategoryType
   * @param dateTime $CreatedDate
   * @param array $Links
   * @access public
   */
  public function __construct($m_Links, $CategoryName, $SkiptaWorldLinkCategoryId, $SkiptaWorldId, $Position, $CategoryType, $CreatedDate, $Links)
  {
    $this->m_Links = $m_Links;
    $this->CategoryName = $CategoryName;
    $this->SkiptaWorldLinkCategoryId = $SkiptaWorldLinkCategoryId;
    $this->SkiptaWorldId = $SkiptaWorldId;
    $this->Position = $Position;
    $this->CategoryType = $CategoryType;
    $this->CreatedDate = $CreatedDate;
    $this->Links = $Links;
  }

}
