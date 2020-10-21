<?php

class NewSkiptaUserProfileResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $NewSkiptaUserProfileResult
   * @access public
   */
  public $NewSkiptaUserProfileResult;

  /**
   * 
   * @param SkiptaBooleanResponse $NewSkiptaUserProfileResult
   * @access public
   */
  public function __construct($NewSkiptaUserProfileResult)
  {
    $this->NewSkiptaUserProfileResult = $NewSkiptaUserProfileResult;
  }

}
