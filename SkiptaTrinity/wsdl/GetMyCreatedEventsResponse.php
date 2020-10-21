<?php

class GetMyCreatedEventsResponse
{

  /**
   * 
   * @var SkiptaUserCalendarResponse $GetMyCreatedEventsResult
   * @access public
   */
  public $GetMyCreatedEventsResult;

  /**
   * 
   * @param SkiptaUserCalendarResponse $GetMyCreatedEventsResult
   * @access public
   */
  public function __construct($GetMyCreatedEventsResult)
  {
    $this->GetMyCreatedEventsResult = $GetMyCreatedEventsResult;
  }

}
