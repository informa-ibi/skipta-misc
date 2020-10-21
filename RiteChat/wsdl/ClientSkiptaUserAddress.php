<?php

class ClientSkiptaUserAddress
{

  /**
   * 
   * @var string $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var string $AddressId
   * @access public
   */
  public $AddressId;

  /**
   * 
   * @var string $AddressName
   * @access public
   */
  public $AddressName;

  /**
   * 
   * @var string $Address1
   * @access public
   */
  public $Address1;

  /**
   * 
   * @var string $Address2
   * @access public
   */
  public $Address2;

  /**
   * 
   * @var string $City
   * @access public
   */
  public $City;

  /**
   * 
   * @var string $State
   * @access public
   */
  public $State;

  /**
   * 
   * @var string $PostalCode
   * @access public
   */
  public $PostalCode;

  /**
   * 
   * @var string $Country
   * @access public
   */
  public $Country;

  /**
   * 
   * @var float $Latitude
   * @access public
   */
  public $Latitude;

  /**
   * 
   * @var float $Longitude
   * @access public
   */
  public $Longitude;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var dateTime $UpdatedDate
   * @access public
   */
  public $UpdatedDate;

  /**
   * 
   * @var string $CreatedUid
   * @access public
   */
  public $CreatedUid;

  /**
   * 
   * @var string $UpdatedUid
   * @access public
   */
  public $UpdatedUid;

  /**
   * 
   * @var boolean $IsCurrent
   * @access public
   */
  public $IsCurrent;

  /**
   * 
   * @param string $UserId
   * @param string $AddressId
   * @param string $AddressName
   * @param string $Address1
   * @param string $Address2
   * @param string $City
   * @param string $State
   * @param string $PostalCode
   * @param string $Country
   * @param float $Latitude
   * @param float $Longitude
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @param string $CreatedUid
   * @param string $UpdatedUid
   * @param boolean $IsCurrent
   * @access public
   */
  public function __construct($UserId, $AddressId, $AddressName, $Address1, $Address2, $City, $State, $PostalCode, $Country, $Latitude, $Longitude, $CreatedDate, $UpdatedDate, $CreatedUid, $UpdatedUid, $IsCurrent)
  {
    $this->UserId = $UserId;
    $this->AddressId = $AddressId;
    $this->AddressName = $AddressName;
    $this->Address1 = $Address1;
    $this->Address2 = $Address2;
    $this->City = $City;
    $this->State = $State;
    $this->PostalCode = $PostalCode;
    $this->Country = $Country;
    $this->Latitude = $Latitude;
    $this->Longitude = $Longitude;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->CreatedUid = $CreatedUid;
    $this->UpdatedUid = $UpdatedUid;
    $this->IsCurrent = $IsCurrent;
  }

}
