<?php

class ClientSkiptaPreference
{

  /**
   * 
   * @var string $ColumnName
   * @access public
   */
  public $ColumnName;

  /**
   * 
   * @var boolean $Selected
   * @access public
   */
  public $Selected;

  /**
   * 
   * @var boolean $IsEmailAlert
   * @access public
   */
  public $IsEmailAlert;

  /**
   * 
   * @param string $ColumnName
   * @param boolean $Selected
   * @param boolean $IsEmailAlert
   * @access public
   */
  public function __construct($ColumnName, $Selected, $IsEmailAlert)
  {
    $this->ColumnName = $ColumnName;
    $this->Selected = $Selected;
    $this->IsEmailAlert = $IsEmailAlert;
  }

}
