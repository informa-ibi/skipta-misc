<?php

class RegisterUser
{

  /**
   * 
   * @var ClientSkiptaUser $user
   * @access public
   */
  public $user;

  /**
   * 
   * @var ClientSkiptaUserAddress $address
   * @access public
   */
  public $address;

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
   * @var array $worldRegInfo
   * @access public
   */
  public $worldRegInfo;

  /**
   * 
   * @param ClientSkiptaUser $user
   * @param ClientSkiptaUserAddress $address
   * @param guid $currentWorldId
   * @param SkiptaWorldRole $role
   * @param array $worldRegInfo
   * @access public
   */
  public function __construct($user, $address, $currentWorldId, $role, $worldRegInfo)
  {
    $this->user = $user;
    $this->address = $address;
    $this->currentWorldId = $currentWorldId;
    $this->role = $role;
    $this->worldRegInfo = $worldRegInfo;
  }

}
