<?php

class GetInfoForUsersByNameSorted
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var array $users
   * @access public
   */
  public $users;

  /**
   * 
   * @var string $searchQuery
   * @access public
   */
  public $searchQuery;

  /**
   * 
   * @var string $orderBy
   * @access public
   */
  public $orderBy;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param array $users
   * @param string $searchQuery
   * @param string $orderBy
   * @access public
   */
  public function __construct($session, $users, $searchQuery, $orderBy)
  {
    $this->session = $session;
    $this->users = $users;
    $this->searchQuery = $searchQuery;
    $this->orderBy = $orderBy;
  }

}
