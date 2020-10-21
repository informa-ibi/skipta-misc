<?php

class GetUsersInRoleResponse
{

  /**
   * 
   * @var SkiptaWorldSecurityResponse $GetUsersInRoleResult
   * @access public
   */
  public $GetUsersInRoleResult;

  /**
   * 
   * @param SkiptaWorldSecurityResponse $GetUsersInRoleResult
   * @access public
   */
  public function __construct($GetUsersInRoleResult)
  {
    $this->GetUsersInRoleResult = $GetUsersInRoleResult;
  }

}
