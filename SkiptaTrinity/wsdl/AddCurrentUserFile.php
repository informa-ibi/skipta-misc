<?php

class AddCurrentUserFile
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var ClientSkiptaUserFile $file
   * @access public
   */
  public $file;

  /**
   * 
   * @var guid $UserGID
   * @access public
   */
  public $UserGID;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param ClientSkiptaUserFile $file
   * @param guid $UserGID
   * @access public
   */
  public function __construct($session, $file, $UserGID)
  {
    $this->session = $session;
    $this->file = $file;
    $this->UserGID = $UserGID;
  }

}
