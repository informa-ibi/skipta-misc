<?php

class SkiptaFriendMessageResponse
{

  /**
   * 
   * @var SkiptaFriendMessage $MessageData
   * @access public
   */
  public $MessageData;

  /**
   * 
   * @param SkiptaFriendMessage $MessageData
   * @access public
   */
  public function __construct($MessageData)
  {
    $this->MessageData = $MessageData;
  }

}
