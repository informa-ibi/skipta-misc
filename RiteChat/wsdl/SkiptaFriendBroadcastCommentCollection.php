<?php

class SkiptaFriendBroadcastCommentCollection
{

  /**
   * 
   * @var array $Comments
   * @access public
   */
  public $Comments;

  /**
   * 
   * @var SkiptaResponseCode $ResponseCode
   * @access public
   */
  public $ResponseCode;

  /**
   * 
   * @var string $ResponseMessage
   * @access public
   */
  public $ResponseMessage;

  /**
   * 
   * @param array $Comments
   * @param SkiptaResponseCode $ResponseCode
   * @param string $ResponseMessage
   * @access public
   */
  public function __construct($Comments, $ResponseCode, $ResponseMessage)
  {
    $this->Comments = $Comments;
    $this->ResponseCode = $ResponseCode;
    $this->ResponseMessage = $ResponseMessage;
  }

}
