<?php

class SkiptaUserInformationResponse
{

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var userinformation $userinformation
   * @access public
   */
  public $userinformation;

  /**
   * 
   * @param guid $UserId
   * @param userinformation $userinformation
   * @access public
   */
  public function __construct($UserId, $userinformation)
  {
    $this->UserId = $UserId;
    $this->userinformation = $userinformation;
  }

}
