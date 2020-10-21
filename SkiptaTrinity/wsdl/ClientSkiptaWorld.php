<?php

class ClientSkiptaWorld
{

  /**
   * 
   * @var string $HostName
   * @access public
   */
  public $HostName;

  /**
   * 
   * @var guid $WorldId
   * @access public
   */
  public $WorldId;

  /**
   * 
   * @var string $WorldName
   * @access public
   */
  public $WorldName;

  /**
   * 
   * @var boolean $IsSkipta
   * @access public
   */
  public $IsSkipta;

  /**
   * 
   * @var string $PhysicalDataPath
   * @access public
   */
  public $PhysicalDataPath;

  /**
   * 
   * @var dateTime $LastUpdatedDate
   * @access public
   */
  public $LastUpdatedDate;

  /**
   * 
   * @var string $DataHostName
   * @access public
   */
  public $DataHostName;

  /**
   * 
   * @param string $HostName
   * @param guid $WorldId
   * @param string $WorldName
   * @param boolean $IsSkipta
   * @param string $PhysicalDataPath
   * @param dateTime $LastUpdatedDate
   * @param string $DataHostName
   * @access public
   */
  public function __construct($HostName, $WorldId, $WorldName, $IsSkipta, $PhysicalDataPath, $LastUpdatedDate, $DataHostName)
  {
    $this->HostName = $HostName;
    $this->WorldId = $WorldId;
    $this->WorldName = $WorldName;
    $this->IsSkipta = $IsSkipta;
    $this->PhysicalDataPath = $PhysicalDataPath;
    $this->LastUpdatedDate = $LastUpdatedDate;
    $this->DataHostName = $DataHostName;
  }

}
