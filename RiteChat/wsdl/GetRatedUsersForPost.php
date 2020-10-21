<?php

class GetRatedUsersForPost
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var SkiptaPostRating $skiptaPostRating
   * @access public
   */
  public $skiptaPostRating;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param SkiptaPostRating $skiptaPostRating
   * @access public
   */
  public function __construct($session, $skiptaPostRating)
  {
    $this->session = $session;
    $this->skiptaPostRating = $skiptaPostRating;
  }

}
