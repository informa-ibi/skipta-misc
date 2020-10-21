<?php

class GetEventsForUserByRSVPResponse
{

  /**
   * 
   * @var SkiptaUserCalendarResponse $GetEventsForUserByRSVPResult
   * @access public
   */
  public $GetEventsForUserByRSVPResult;

  /**
   * 
   * @param SkiptaUserCalendarResponse $GetEventsForUserByRSVPResult
   * @access public
   */
  public function __construct($GetEventsForUserByRSVPResult)
  {
    $this->GetEventsForUserByRSVPResult = $GetEventsForUserByRSVPResult;
  }

}
