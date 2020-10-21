<?php

class RemoveWidgetFromUserResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $RemoveWidgetFromUserResult
   * @access public
   */
  public $RemoveWidgetFromUserResult;

  /**
   * 
   * @param SkiptaBooleanResponse $RemoveWidgetFromUserResult
   * @access public
   */
  public function __construct($RemoveWidgetFromUserResult)
  {
    $this->RemoveWidgetFromUserResult = $RemoveWidgetFromUserResult;
  }

}
