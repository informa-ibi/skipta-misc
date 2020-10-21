<?php

class EditProfileLink
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
   * @var string $LinkUrl
   * @access public
   */
  public $LinkUrl;

  /**
   * 
   * @var string $LinkName
   * @access public
   */
  public $LinkName;

  /**
   * 
   * @var string $LinkDescription
   * @access public
   */
  public $LinkDescription;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $ProfileLinkId
   * @param string $LinkUrl
   * @param string $LinkName
   * @param string $LinkDescription
   * @access public
   */
  public function __construct($session, $ProfileLinkId, $LinkUrl, $LinkName, $LinkDescription)
  {
    $this->session = $session;
    $this->ProfileLinkId = $ProfileLinkId;
    $this->LinkUrl = $LinkUrl;
    $this->LinkName = $LinkName;
    $this->LinkDescription = $LinkDescription;
  }

}
