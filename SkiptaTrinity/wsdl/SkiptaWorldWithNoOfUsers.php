<?php

class SkiptaWorldWithNoOfUsers
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
   * @var boolean $Active
   * @access public
   */
  public $Active;

  /**
   * 
   * @var int $NoOfUsers
   * @access public
   */
  public $NoOfUsers;

  /**
   * 
   * @param string $HostName
   * @param guid $WorldId
   * @param string $WorldName
   * @param boolean $Active
   * @param int $NoOfUsers
   * @access public
   */
  public function __construct($HostName, $WorldId, $WorldName, $Active, $NoOfUsers)
  {
    $this->HostName = $HostName;
    $this->WorldId = $WorldId;
    $this->WorldName = $WorldName;
    $this->Active = $Active;
    $this->NoOfUsers = $NoOfUsers;
  }

}
