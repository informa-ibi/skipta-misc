<?php

class GetTopBroadcastsFromWorldByHashtag
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaWorld $world
   * @access public
   */
  public $world;

  /**
   * 
   * @var string $hashtag
   * @access public
   */
  public $hashtag;

  /**
   * 
   * @var int $maxresults
   * @access public
   */
  public $maxresults;

  /**
   * 
   * @var string $sortBy
   * @access public
   */
  public $sortBy;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @param string $hashtag
   * @param int $maxresults
   * @param string $sortBy
   * @access public
   */
  public function __construct($session, $world, $hashtag, $maxresults, $sortBy)
  {
    $this->session = $session;
    $this->world = $world;
    $this->hashtag = $hashtag;
    $this->maxresults = $maxresults;
    $this->sortBy = $sortBy;
  }

}
