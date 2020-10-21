<?php

class GetFriendRecommendationsResponse
{

  /**
   * 
   * @var SkiptaFriendRecommendationResponse $GetFriendRecommendationsResult
   * @access public
   */
  public $GetFriendRecommendationsResult;

  /**
   * 
   * @param SkiptaFriendRecommendationResponse $GetFriendRecommendationsResult
   * @access public
   */
  public function __construct($GetFriendRecommendationsResult)
  {
    $this->GetFriendRecommendationsResult = $GetFriendRecommendationsResult;
  }

}
