<?php

class SwapWidgetsResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $SwapWidgetsResult
   * @access public
   */
  public $SwapWidgetsResult;

  /**
   * 
   * @param SkiptaBooleanResponse $SwapWidgetsResult
   * @access public
   */
  public function __construct($SwapWidgetsResult)
  {
    $this->SwapWidgetsResult = $SwapWidgetsResult;
  }

}
