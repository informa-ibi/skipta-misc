<?php

class UpdateUserAddressResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $UpdateUserAddressResult
   * @access public
   */
  public $UpdateUserAddressResult;

  /**
   * 
   * @param SkiptaBooleanResponse $UpdateUserAddressResult
   * @access public
   */
  public function __construct($UpdateUserAddressResult)
  {
    $this->UpdateUserAddressResult = $UpdateUserAddressResult;
  }

}
