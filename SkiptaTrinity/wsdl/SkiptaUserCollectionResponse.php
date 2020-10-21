<?php

class SkiptaUserCollectionResponse
{

  /**
   * 
   * @var array $Users
   * @access public
   */
  public $Users;

  /**
   * 
   * @param array $Users
   * @access public
   */
  public function __construct($Users)
  {
    $this->Users = $Users;
  }

}
