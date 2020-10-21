<?php

class UpdateUserWidgetState
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @var string $newValue
   * @access public
   */
  public $newValue;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $userId
   * @param string $newValue
   * @access public
   */
  public function __construct($session, $userId, $newValue)
  {
    $this->session = $session;
    $this->userId = $userId;
    $this->newValue = $newValue;
  }

}
