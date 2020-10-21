<?php

class SkiptaFriendRecommendationResponse
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
   * @var friendrecommendation $friendrecommendation
   * @access public
   */
  public $friendrecommendation;

  /**
   * 
   * @param guid $UserId
   * @param guid $WorldID
   * @param friendrecommendation $friendrecommendation
   * @access public
   */
  public function __construct($UserId, $WorldID, $friendrecommendation)
  {
    $this->UserId = $UserId;
    $this->WorldID = $WorldID;
    $this->friendrecommendation = $friendrecommendation;
  }

}
