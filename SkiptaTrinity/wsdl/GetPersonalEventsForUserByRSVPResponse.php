<?php

class GetPersonalEventsForUserByRSVPResponse
{

  /**
   * 
   * @var SkiptaUserCalendarResponse $GetPersonalEventsForUserByRSVPResult
   * @access public
   */
  public $GetPersonalEventsForUserByRSVPResult;

  /**
   * 
   * @param SkiptaUserCalendarResponse $GetPersonalEventsForUserByRSVPResult
   * @access public
   */
  public function __construct($GetPersonalEventsForUserByRSVPResult)
  {
    $this->GetPersonalEventsForUserByRSVPResult = $GetPersonalEventsForUserByRSVPResult;
  }

}
