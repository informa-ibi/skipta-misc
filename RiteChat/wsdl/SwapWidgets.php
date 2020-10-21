<?php

class SwapWidgets
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $thisWidgetId
   * @access public
   */
  public $thisWidgetId;

  /**
   * 
   * @var guid $thatWidgetId
   * @access public
   */
  public $thatWidgetId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $thisWidgetId
   * @param guid $thatWidgetId
   * @access public
   */
  public function __construct($session, $thisWidgetId, $thatWidgetId)
  {
    $this->session = $session;
    $this->thisWidgetId = $thisWidgetId;
    $this->thatWidgetId = $thatWidgetId;
  }

}
