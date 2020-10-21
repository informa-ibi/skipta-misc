<?php

class UpdateFriendResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateFriendResult
   * @access public
   */
  public $UpdateFriendResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateFriendResult
   * @access public
   */
  public function __construct($UpdateFriendResult)
  {
    $this->UpdateFriendResult = $UpdateFriendResult;
  }

}
