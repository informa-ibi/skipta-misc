<?php

class GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld
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
   * @var array $exceptionList
   * @access public
   */
  public $exceptionList;

  /**
   * 
   * @var guid $worldId
   * @access public
   */
  public $worldId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $UserId
   * @param string $orderby
   * @param int $pagenum
   * @param int $pagesize
   * @param string $query
   * @param array $exceptionList
   * @param guid $worldId
   * @access public
   */
  public function __construct($session, $UserId, $orderby, $pagenum, $pagesize, $query, $exceptionList, $worldId)
  {
    $this->session = $session;
    $this->UserId = $UserId;
    $this->orderby = $orderby;
    $this->pagenum = $pagenum;
    $this->pagesize = $pagesize;
    $this->query = $query;
    $this->exceptionList = $exceptionList;
    $this->worldId = $worldId;
  }

}
