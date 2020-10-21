<?php

class LoadRecommendedFriendsForWorldResponse
{

  /**
   * 
   * @var SkiptaUserCollectionResponse $LoadRecommendedFriendsForWorldResult
   * @access public
   */
  public $LoadRecommendedFriendsForWorldResult;

  /**
   * 
   * @param SkiptaUserCollectionResponse $LoadRecommendedFriendsForWorldResult
   * @access public
   */
  public function __construct($LoadRecommendedFriendsForWorldResult)
  {
    $this->LoadRecommendedFriendsForWorldResult = $LoadRecommendedFriendsForWorldResult;
  }

}
