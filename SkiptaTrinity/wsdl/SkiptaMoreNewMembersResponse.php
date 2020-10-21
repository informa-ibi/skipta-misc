<?php

class SkiptaMoreNewMembersResponse
{

  /**
   * 
   * @var guid $WorldID
   * @access public
   */
  public $WorldID;

  /**
   * 
   * @var moreNewMembers $moreNewMembers
   * @access public
   */
  public $moreNewMembers;

  /**
   * 
   * @param guid $WorldID
   * @param moreNewMembers $moreNewMembers
   * @access public
   */
  public function __construct($WorldID, $moreNewMembers)
  {
    $this->WorldID = $WorldID;
    $this->moreNewMembers = $moreNewMembers;
  }

}
