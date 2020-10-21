<?php

class GetAllFriendsByStatusResponse
{

  /**
   * 
   * @var SkiptaFriendListResponse $GetAllFriendsByStatusResult
   * @access public
   */
  public $GetAllFriendsByStatusResult;

  /**
   * 
   * @param SkiptaFriendListResponse $GetAllFriendsByStatusResult
   * @access public
   */
  public function __construct($GetAllFriendsByStatusResult)
  {
    $this->GetAllFriendsByStatusResult = $GetAllFriendsByStatusResult;
  }

}
