<?php

class AddProfileLinkToTheCurrentUser
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

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
   * @var guid $userId
   * @access public
   */
  public $userId;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param string $LinkUrl
   * @param string $LinkName
   * @param string $LinkDescription
   * @param guid $userId
   * @access public
   */
  public function __construct($session, $LinkUrl, $LinkName, $LinkDescription, $userId)
  {
    $this->session = $session;
    $this->LinkUrl = $LinkUrl;
    $this->LinkName = $LinkName;
    $this->LinkDescription = $LinkDescription;
    $this->userId = $userId;
  }

}
