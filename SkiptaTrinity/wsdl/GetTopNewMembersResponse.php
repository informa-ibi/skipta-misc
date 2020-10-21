<?php

class GetTopNewMembersResponse
{

  /**
   * 
   * @var SkiptaNewMembersResponse $GetTopNewMembersResult
   * @access public
   */
  public $GetTopNewMembersResult;

  /**
   * 
   * @param SkiptaNewMembersResponse $GetTopNewMembersResult
   * @access public
   */
  public function __construct($GetTopNewMembersResult)
  {
    $this->GetTopNewMembersResult = $GetTopNewMembersResult;
  }

}
