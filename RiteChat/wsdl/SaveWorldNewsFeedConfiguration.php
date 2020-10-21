<?php

class SaveWorldNewsFeedConfiguration
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaNewsRating $skiptaNewsRating
   * @access public
   */
  public $skiptaNewsRating;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaNewsRating $skiptaNewsRating
   * @access public
   */
  public function __construct($session, $skiptaNewsRating)
  {
    $this->session = $session;
    $this->skiptaNewsRating = $skiptaNewsRating;
  }

}
