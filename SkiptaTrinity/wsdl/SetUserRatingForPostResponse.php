<?php

class SetUserRatingForPostResponse
{

  /**
   * 
   * @var SkiptaUserRatingResponse $SetUserRatingForPostResult
   * @access public
   */
  public $SetUserRatingForPostResult;

  /**
   * 
   * @param SkiptaUserRatingResponse $SetUserRatingForPostResult
   * @access public
   */
  public function __construct($SetUserRatingForPostResult)
  {
    $this->SetUserRatingForPostResult = $SetUserRatingForPostResult;
  }

}
