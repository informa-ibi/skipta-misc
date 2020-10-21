<?php

class SearchForUserWithParamsAndHideList
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

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
   * @param string $query
   * @param string $orderby
   * @param int $pagenum
   * @param int $pagesize
   * @param array $usersToHide
   * @access public
   */
  public function __construct($session, $query, $orderby, $pagenum, $pagesize, $usersToHide)
  {
    $this->session = $session;
    $this->query = $query;
    $this->orderby = $orderby;
    $this->pagenum = $pagenum;
    $this->pagesize = $pagesize;
    $this->usersToHide = $usersToHide;
  }

}
