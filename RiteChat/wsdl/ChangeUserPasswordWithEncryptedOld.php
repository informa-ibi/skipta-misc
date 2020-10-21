<?php

class ChangeUserPasswordWithEncryptedOld
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $oldPassword
   * @access public
   */
  public $oldPassword;

  /**
   * 
   * @var string $newPassword
   * @access public
   */
  public $newPassword;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $oldPassword
   * @param string $newPassword
   * @access public
   */
  public function __construct($session, $oldPassword, $newPassword)
  {
    $this->session = $session;
    $this->oldPassword = $oldPassword;
    $this->newPassword = $newPassword;
  }

}
