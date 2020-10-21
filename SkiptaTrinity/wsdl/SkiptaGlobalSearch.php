<?php

class SkiptaGlobalSearch
{

  /**
   * 
   * @var string $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var string $Search
   * @access public
   */
  public $Search;

  /**
   * 
   * @var string $SearchCategory
   * @access public
   */
  public $SearchCategory;

  /**
   * 
   * @var string $SearchSubCategory
   * @access public
   */
  public $SearchSubCategory;

  /**
   * 
   * @var string $applicationKey
   * @access public
   */
  public $applicationKey;

  /**
   * 
   * @var SkiptaWorld $SkiptaWorld
   * @access public
   */
  public $SkiptaWorld;

  /**
   * 
   * @var SkiptaWorld $WorldDatabase
   * @access public
   */
  public $WorldDatabase;

  /**
   * 
   * @var guid $WorldId
   * @access public
   */
  public $WorldId;

  /**
   * 
   * @var array $MyFriendsList
   * @access public
   */
  public $MyFriendsList;

  /**
   * 
   * @var array $MyGroupsList
   * @access public
   */
  public $MyGroupsList;

  /**
   * 
   * @param string $UserId
   * @param string $Search
   * @param string $SearchCategory
   * @param string $SearchSubCategory
   * @param string $applicationKey
   * @param SkiptaWorld $SkiptaWorld
   * @param SkiptaWorld $WorldDatabase
   * @param guid $WorldId
   * @param array $MyFriendsList
   * @param array $MyGroupsList
   * @access public
   */
  public function __construct($UserId, $Search, $SearchCategory, $SearchSubCategory, $applicationKey, $SkiptaWorld, $WorldDatabase, $WorldId, $MyFriendsList, $MyGroupsList)
  {
    $this->UserId = $UserId;
    $this->Search = $Search;
    $this->SearchCategory = $SearchCategory;
    $this->SearchSubCategory = $SearchSubCategory;
    $this->applicationKey = $applicationKey;
    $this->SkiptaWorld = $SkiptaWorld;
    $this->WorldDatabase = $WorldDatabase;
    $this->WorldId = $WorldId;
    $this->MyFriendsList = $MyFriendsList;
    $this->MyGroupsList = $MyGroupsList;
  }

}
