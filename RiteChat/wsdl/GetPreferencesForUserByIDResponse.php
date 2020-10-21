<?php

class GetPreferencesForUserByIDResponse
{

  /**
   * 
   * @var SkiptaUserPreferenceCollectionResponse $GetPreferencesForUserByIDResult
   * @access public
   */
  public $GetPreferencesForUserByIDResult;

  /**
   * 
   * @param SkiptaUserPreferenceCollectionResponse $GetPreferencesForUserByIDResult
   * @access public
   */
  public function __construct($GetPreferencesForUserByIDResult)
  {
    $this->GetPreferencesForUserByIDResult = $GetPreferencesForUserByIDResult;
  }

}
