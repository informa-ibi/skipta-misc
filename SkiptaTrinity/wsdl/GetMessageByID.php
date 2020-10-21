<?php

class GetMessageByID
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $messageId
   * @access public
   */
  public $messageId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $messageId
   * @access public
   */
  public function __construct($session, $messageId)
  {
    $this->session = $session;
    $this->messageId = $messageId;
  }

}
