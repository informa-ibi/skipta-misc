<?php

class SkiptaMoreFriendRecommendationResponse
{

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var guid $WorldID
   * @access public
   */
  public $WorldID;

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
   * @var friendmorerecommendation $friendmorerecommendation
   * @access public
   */
  public $friendmorerecommendation;

  /**
   * 
   * @param guid $UserId
   * @param guid $WorldID
   * @param int $Start
   * @param int $End
   * @param friendmorerecommendation $friendmorerecommendation
   * @access public
   */
  public function __construct($UserId, $WorldID, $Start, $End, $friendmorerecommendation)
  {
    $this->UserId = $UserId;
    $this->WorldID = $WorldID;
    $this->Start = $Start;
    $this->End = $End;
    $this->friendmorerecommendation = $friendmorerecommendation;
  }

}
