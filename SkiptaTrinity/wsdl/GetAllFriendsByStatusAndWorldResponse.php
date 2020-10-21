<?php

class GetAllFriendsByStatusAndWorldResponse
{

  /**
   * 
   * @var SkiptaFriendListResponse $GetAllFriendsByStatusAndWorldResult
   * @access public
   */
  public $GetAllFriendsByStatusAndWorldResult;

  /**
   * 
   * @param SkiptaFriendListResponse $GetAllFriendsByStatusAndWorldResult
   * @access public
   */
  public function __construct($GetAllFriendsByStatusAndWorldResult)
  {
    $this->GetAllFriendsByStatusAndWorldResult = $GetAllFriendsByStatusAndWorldResult;
  }

}
