<?php

class GetJobsForAWorld
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var string $World
   * @access public
   */
  public $World;

  /**
   * 
   * @var string $DateTime
   * @access public
   */
  public $DateTime;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $World
   * @param string $DateTime
   * @access public
   */
  public function __construct($session, $World, $DateTime)
  {
    $this->session = $session;
    $this->World = $World;
    $this->DateTime = $DateTime;
  }

}
