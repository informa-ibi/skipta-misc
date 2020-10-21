<?php

class AddGallery
{

  /**
   * 
   * @var ClientSkiptaSession $session
   * @access public
   */
  public $session;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var ClientSkiptaUserGallery $gallery
   * @access public
   */
  public $gallery;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $UserId
   * @param ClientSkiptaUserGallery $gallery
   * @access public
   */
  public function __construct($session, $UserId, $gallery)
  {
    $this->session = $session;
    $this->UserId = $UserId;
    $this->gallery = $gallery;
  }

}
