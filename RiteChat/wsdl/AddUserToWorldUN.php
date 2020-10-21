<?php

class AddUserToWorldUN
{

  /**
   * 
   * @var ClientSkiptaUser $user
   * @access public
   */
  public $user;

  /**
   * 
   * @var guid $currentWorldId
   * @access public
   */
  public $currentWorldId;

  /**
   * 
   * @var SkiptaWorldRole $role
   * @access public
   */
  public $role;

  /**
   * 
   * @param ClientSkiptaUser $user
   * @param guid $currentWorldId
   * @param SkiptaWorldRole $role
   * @access public
   */
  public function __construct($user, $currentWorldId, $role)
  {
    $this->user = $user;
    $this->currentWorldId = $currentWorldId;
    $this->role = $role;
  }

}
