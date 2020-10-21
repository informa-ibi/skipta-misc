<?php

class GetMyCurrentWorldResponse
{

  /**
   * 
   * @var SkiptaWorldResponse $GetMyCurrentWorldResult
   * @access public
   */
  public $GetMyCurrentWorldResult;

  /**
   * 
   * @param SkiptaWorldResponse $GetMyCurrentWorldResult
   * @access public
   */
  public function __construct($GetMyCurrentWorldResult)
  {
    $this->GetMyCurrentWorldResult = $GetMyCurrentWorldResult;
  }

}
