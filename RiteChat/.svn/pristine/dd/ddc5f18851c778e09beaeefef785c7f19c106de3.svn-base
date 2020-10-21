<?php

class GetAllFriendsByStatusAndWorldWithParams
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaUserRelationshipStatus $status
   * @access public
   */
  public $status;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

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
   * @param ClientSkiptaSession $session
   * @param SkiptaUserRelationshipStatus $status
   * @param ClientSkiptaWorld $world
   * @param string $orderby
   * @param int $pagenum
   * @param int $pagesize
   * @access public
   */
  public function __construct($session, $status, $world, $orderby, $pagenum, $pagesize)
  {
    $this->session = $session;
    $this->status = $status;
    $this->world = $world;
    $this->orderby = $orderby;
    $this->pagenum = $pagenum;
    $this->pagesize = $pagesize;
  }

}
