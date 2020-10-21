<?php

class UpdateMessageStatusForUser
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
   * @var FriendMessageStatus $newStatus
   * @access public
   */
  public $newStatus;

  /**
   * 
   * @var boolean $isRecieverStatusUpdate
   * @access public
   */
  public $isRecieverStatusUpdate;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $messageId
   * @param FriendMessageStatus $newStatus
   * @param boolean $isRecieverStatusUpdate
   * @access public
   */
  public function __construct($session, $messageId, $newStatus, $isRecieverStatusUpdate)
  {
    $this->session = $session;
    $this->messageId = $messageId;
    $this->newStatus = $newStatus;
    $this->isRecieverStatusUpdate = $isRecieverStatusUpdate;
  }

}
