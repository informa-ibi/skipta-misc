<?php

class AddWidgetToUserResponse
{

  /**
   * 
   * @var SkiptaGuidResponse $AddWidgetToUserResult
   * @access public
   */
  public $AddWidgetToUserResult;

  /**
   * 
   * @param SkiptaGuidResponse $AddWidgetToUserResult
   * @access public
   */
  public function __construct($AddWidgetToUserResult)
  {
    $this->AddWidgetToUserResult = $AddWidgetToUserResult;
  }

}
