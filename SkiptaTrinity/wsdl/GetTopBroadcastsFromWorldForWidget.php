<?php

class GetTopBroadcastsFromWorldForWidget
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
   * @var int $maxresults
   * @access public
   */
  public $maxresults;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaWorld $world
   * @param int $maxresults
   * @access public
   */
  public function __construct($session, $world, $maxresults)
  {
    $this->session = $session;
    $this->world = $world;
    $this->maxresults = $maxresults;
  }

}
