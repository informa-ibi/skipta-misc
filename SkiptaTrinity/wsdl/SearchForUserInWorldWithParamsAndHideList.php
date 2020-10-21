<?php

class SearchForUserInWorldWithParamsAndHideList
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @var string $query
   * @access public
   */
  public $query;

  /**
   * 
   * @var string $orderby
   * @access public
   */
  public $orderby;

  /**
   * 
   * @var int $pagenum
   * @access public
   */
  public $pagenum;

  /**
   * 
   * @var int $pagesize
   * @access public
   */
  public $pagesize;

  /**
   * 
   * @var array $usersToHide
   * @access public
   */
  public $usersToHide;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @param string $query
   * @param string $orderby
   * @param int $pagenum
   * @param int $pagesize
   * @param array $usersToHide
   * @access public
   */
  public function __construct($session, $world, $query, $orderby, $pagenum, $pagesize, $usersToHide)
  {
    $this->session = $session;
    $this->world = $world;
    $this->query = $query;
    $this->orderby = $orderby;
    $this->pagenum = $pagenum;
    $this->pagesize = $pagesize;
    $this->usersToHide = $usersToHide;
  }

}
