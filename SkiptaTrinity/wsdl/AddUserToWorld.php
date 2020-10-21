<?php

class AddUserToWorld
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @var SkiptaWorldRole $role
   * @access public
   */
  public $role;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @param SkiptaWorldRole $role
   * @access public
   */
  public function __construct($session, $world, $role)
  {
    $this->session = $session;
    $this->world = $world;
    $this->role = $role;
  }

}
