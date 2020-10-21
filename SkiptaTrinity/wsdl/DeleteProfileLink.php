<?php

class DeleteProfileLink
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $ProfileLinkId
   * @access public
   */
  public $ProfileLinkId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $ProfileLinkId
   * @access public
   */
  public function __construct($session, $ProfileLinkId)
  {
    $this->session = $session;
    $this->ProfileLinkId = $ProfileLinkId;
  }

}
