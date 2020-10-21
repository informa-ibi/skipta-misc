<?php

class SkiptaSentMessagesResponse
{

  /**
   * 
   * @var int $MessageCount
   * @access public
   */
  public $MessageCount;

  /**
   * 
   * @var array $Messages
   * @access public
   */
  public $Messages;

  /**
   * 
   * @param int $MessageCount
   * @param array $Messages
   * @access public
   */
  public function __construct($MessageCount, $Messages)
  {
    $this->MessageCount = $MessageCount;
    $this->Messages = $Messages;
  }

}
