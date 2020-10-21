<?php

class GetUsersInRole
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $SkiptaWorldId
   * @access public
   */
  public $SkiptaWorldId;

  /**
   * 
   * @var SkiptaWorldRole $role
   * @access public
   */
  public $role;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $SkiptaWorldId
   * @param SkiptaWorldRole $role
   * @access public
   */
  public function __construct($session, $SkiptaWorldId, $role)
  {
    $this->session = $session;
    $this->SkiptaWorldId = $SkiptaWorldId;
    $this->role = $role;
  }

}
