<?php

class SkiptaNewMembersResponse
{

  /**
   * 
   * @var guid $WorldID
   * @access public
   */
  public $WorldID;

  /**
   * 
   * @var newMembers $newMembers
   * @access public
   */
  public $newMembers;

  /**
   * 
   * @param guid $WorldID
   * @param newMembers $newMembers
   * @access public
   */
  public function __construct($WorldID, $newMembers)
  {
    $this->WorldID = $WorldID;
    $this->newMembers = $newMembers;
  }

}
