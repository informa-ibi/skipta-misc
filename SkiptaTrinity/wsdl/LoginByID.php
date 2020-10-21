<?php

class LoginByID
{

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @var string $password
   * @access public
   */
  public $password;

  /**
   * 
   * @param guid $userId
   * @param string $password
   * @access public
   */
  public function __construct($userId, $password)
  {
    $this->userId = $userId;
    $this->password = $password;
  }

}
