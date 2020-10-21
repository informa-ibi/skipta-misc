<?php

class GetMoreFriendRecommendations
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
   * @var int $Start
   * @access public
   */
  public $Start;

  /**
   * 
   * @var int $End
   * @access public
   */
  public $End;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $Userid
   * @param guid $SkiptaWorldId
   * @param int $Start
   * @param int $End
   * @access public
   */
  public function __construct($session, $Userid, $SkiptaWorldId, $Start, $End)
  {
    $this->session = $session;
    $this->Userid = $Userid;
    $this->SkiptaWorldId = $SkiptaWorldId;
    $this->Start = $Start;
    $this->End = $End;
  }

}
