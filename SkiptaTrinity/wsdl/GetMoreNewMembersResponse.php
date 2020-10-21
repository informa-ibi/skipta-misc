<?php

class GetMoreNewMembersResponse
{

  /**
   * 
   * @var SkiptaMoreNewMembersResponse $GetMoreNewMembersResult
   * @access public
   */
  public $GetMoreNewMembersResult;

  /**
   * 
   * @param SkiptaMoreNewMembersResponse $GetMoreNewMembersResult
   * @access public
   */
  public function __construct($GetMoreNewMembersResult)
  {
    $this->GetMoreNewMembersResult = $GetMoreNewMembersResult;
  }

}
