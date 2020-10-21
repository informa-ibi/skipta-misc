<?php

class SkiptaUserAddressCollectionResponse
{

  /**
   * 
   * @var array $Addresses
   * @access public
   */
  public $Addresses;

  /**
   * 
   * @param array $Addresses
   * @access public
   */
  public function __construct($Addresses)
  {
    $this->Addresses = $Addresses;
  }

}
