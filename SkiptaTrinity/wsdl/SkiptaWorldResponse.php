<?php

class SkiptaWorldResponse
{

  /**
   * 
   * @var guid $WorldID
   * @access public
   */
  public $WorldID;

  /**
   * 
   * @var string $Domain
   * @access public
   */
  public $Domain;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var string $PhysicalDataPath
   * @access public
   */
  public $PhysicalDataPath;

  /**
   * 
   * @var dateTime $LastUpdated
   * @access public
   */
  public $LastUpdated;

  /**
   * 
   * @param guid $WorldID
   * @param string $Domain
   * @param string $Name
   * @param string $PhysicalDataPath
   * @param dateTime $LastUpdated
   * @access public
   */
  public function __construct($WorldID, $Domain, $Name, $PhysicalDataPath, $LastUpdated)
  {
    $this->WorldID = $WorldID;
    $this->Domain = $Domain;
    $this->Name = $Name;
    $this->PhysicalDataPath = $PhysicalDataPath;
    $this->LastUpdated = $LastUpdated;
  }

}
