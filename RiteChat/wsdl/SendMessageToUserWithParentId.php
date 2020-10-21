<?php

class SendMessageToUserWithParentId
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
   * @var guid $parentMessageId
   * @access public
   */
  public $parentMessageId;

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
   * @param guid $parentMessageId
   * @param string $subject
   * @param string $message
   * @access public
   */
  public function __construct($session, $toUser, $parentMessageId, $subject, $message)
  {
    $this->session = $session;
    $this->toUser = $toUser;
    $this->parentMessageId = $parentMessageId;
    $this->subject = $subject;
    $this->message = $message;
  }

}
