<?php

class SendMessageToUser
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $toUser
   * @access public
   */
  public $toUser;

  /**
   * 
   * @var string $subject
   * @access public
   */
  public $subject;

  /**
   * 
   * @var string $message
   * @access public
   */
  public $message;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $toUser
   * @param string $subject
   * @param string $message
   * @access public
   */
  public function __construct($session, $toUser, $subject, $message)
  {
    $this->session = $session;
    $this->toUser = $toUser;
    $this->subject = $subject;
    $this->message = $message;
  }

}
