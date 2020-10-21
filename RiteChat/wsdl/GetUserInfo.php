<?php

class GetUserInfo
{

  /**
   * 
   * @var guid $Userid
   * @access public
   */
  public $Userid;

  /**
   * 
   * @param guid $Userid
   * @access public
   */
  public function __construct($Userid)
  {
    $this->Userid = $Userid;
  }

}
