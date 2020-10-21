<?php

class GetPreferencesForUserResponse
{

  /**
   * 
   * @var SkiptaUserPreferenceCollectionResponse $GetPreferencesForUserResult
   * @access public
   */
  public $GetPreferencesForUserResult;

  /**
   * 
   * @param SkiptaUserPreferenceCollectionResponse $GetPreferencesForUserResult
   * @access public
   */
  public function __construct($GetPreferencesForUserResult)
  {
    $this->GetPreferencesForUserResult = $GetPreferencesForUserResult;
  }

}
