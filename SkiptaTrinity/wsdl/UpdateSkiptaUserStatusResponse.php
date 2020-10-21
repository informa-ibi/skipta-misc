<?php

class UpdateSkiptaUserStatusResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateSkiptaUserStatusResult
   * @access public
   */
  public $UpdateSkiptaUserStatusResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateSkiptaUserStatusResult
   * @access public
   */
  public function __construct($UpdateSkiptaUserStatusResult)
  {
    $this->UpdateSkiptaUserStatusResult = $UpdateSkiptaUserStatusResult;
  }

}
