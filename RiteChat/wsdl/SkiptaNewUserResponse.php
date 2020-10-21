<?php

class SkiptaNewUserResponse
{

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var guid $ConfirmationCode
   * @access public
   */
  public $ConfirmationCode;

  /**
   * 
   * @param guid $UserId
   * @param guid $ConfirmationCode
   * @access public
   */
  public function __construct($UserId, $ConfirmationCode)
  {
    $this->UserId = $UserId;
    $this->ConfirmationCode = $ConfirmationCode;
  }

}
