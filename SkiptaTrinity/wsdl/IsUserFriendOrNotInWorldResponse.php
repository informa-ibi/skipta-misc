<?php

class IsUserFriendOrNotInWorldResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsUserFriendOrNotInWorldResult
   * @access public
   */
  public $IsUserFriendOrNotInWorldResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsUserFriendOrNotInWorldResult
   * @access public
   */
  public function __construct($IsUserFriendOrNotInWorldResult)
  {
    $this->IsUserFriendOrNotInWorldResult = $IsUserFriendOrNotInWorldResult;
  }

}
