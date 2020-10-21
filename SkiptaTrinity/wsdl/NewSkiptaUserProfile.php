<?php

class NewSkiptaUserProfile
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaUserProfileResponse $newValues
   * @access public
   */
  public $newValues;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaUserProfileResponse $newValues
   * @access public
   */
  public function __construct($session, $newValues)
  {
    $this->session = $session;
    $this->newValues = $newValues;
  }

}
