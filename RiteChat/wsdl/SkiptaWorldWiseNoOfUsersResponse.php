<?php

class SkiptaWorldWiseNoOfUsersResponse
{

  /**
   * 
   * @var array $WorldCollection
   * @access public
   */
  public $WorldCollection;

  /**
   * 
   * @param array $WorldCollection
   * @access public
   */
  public function __construct($WorldCollection)
  {
    $this->WorldCollection = $WorldCollection;
  }

}
