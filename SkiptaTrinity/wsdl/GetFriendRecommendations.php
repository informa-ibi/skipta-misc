<?php

class GetFriendRecommendations
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $Userid
   * @access public
   */
  public $Userid;

  /**
   * 
   * @var guid $SkiptaWorldId
   * @access public
   */
  public $SkiptaWorldId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $Userid
   * @param guid $SkiptaWorldId
   * @access public
   */
  public function __construct($session, $Userid, $SkiptaWorldId)
  {
    $this->session = $session;
    $this->Userid = $Userid;
    $this->SkiptaWorldId = $SkiptaWorldId;
  }

}
