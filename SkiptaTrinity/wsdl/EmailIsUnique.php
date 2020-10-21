<?php

class EmailIsUnique
{

  /**
   * 
   * @var string $email
   * @access public
   */
  public $email;

  /**
   * 
   * @param string $email
   * @access public
   */
  public function __construct($email)
  {
    $this->email = $email;
  }

}
