<?php

class GetUserAddressCollectionResponse
{

  /**
   * 
   * @var SkiptaUserAddressCollectionResponse $GetUserAddressCollectionResult
   * @access public
   */
  public $GetUserAddressCollectionResult;

  /**
   * 
   * @param SkiptaUserAddressCollectionResponse $GetUserAddressCollectionResult
   * @access public
   */
  public function __construct($GetUserAddressCollectionResult)
  {
    $this->GetUserAddressCollectionResult = $GetUserAddressCollectionResult;
  }

}
