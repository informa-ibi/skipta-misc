<?php

class GetInfoForUsersByName
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
   * @param ClientSkiptaSession $session
   * @param array $users
   * @param string $searchQuery
   * @access public
   */
  public function __construct($session, $users, $searchQuery)
  {
    $this->session = $session;
    $this->users = $users;
    $this->searchQuery = $searchQuery;
  }

}
