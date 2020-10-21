<?php

class IsUserLogedIn
{

  /**
   * 
   * @var guid $userid
   * @access public
   */
  public $userid;

  /**
   * 
   * @param guid $userid
   * @access public
   */
  public function __construct($userid)
  {
    $this->userid = $userid;
  }

}
