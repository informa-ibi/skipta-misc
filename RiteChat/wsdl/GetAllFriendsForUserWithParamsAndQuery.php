<?php

class GetAllFriendsForUserWithParamsAndQuery
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

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
   * @var string $query
   * @access public
   */
  public $query;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $UserId
   * @param string $orderby
   * @param int $pagenum
   * @param int $pagesize
   * @param string $query
   * @access public
   */
  public function __construct($session, $UserId, $orderby, $pagenum, $pagesize, $query)
  {
    $this->session = $session;
    $this->UserId = $UserId;
    $this->orderby = $orderby;
    $this->pagenum = $pagenum;
    $this->pagesize = $pagesize;
    $this->query = $query;
  }

}
