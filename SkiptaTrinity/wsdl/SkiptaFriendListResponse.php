<?php

class SkiptaFriendListResponse
{

  /**
   * 
   * @var int $TotalFriends
   * @access public
   */
  public $TotalFriends;

  /**
   * 
   * @var array $Friends
   * @access public
   */
  public $Friends;

  /**
   * 
   * @param int $TotalFriends
   * @param array $Friends
   * @access public
   */
  public function __construct($TotalFriends, $Friends)
  {
    $this->TotalFriends = $TotalFriends;
    $this->Friends = $Friends;
  }

}
