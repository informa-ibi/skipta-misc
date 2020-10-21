<?php

class AddVideoItemToGallery
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
   * @var guid $UserGalleryID
   * @access public
   */
  public $UserGalleryID;

  /**
   * 
   * @var ClientSkiptaUserGalleryItem $item
   * @access public
   */
  public $item;

  /**
   * 
   * @param ClientSkiptaSession $session
   * @param guid $UserId
   * @param guid $UserGalleryID
   * @param ClientSkiptaUserGalleryItem $item
   * @access public
   */
  public function __construct($session, $UserId, $UserGalleryID, $item)
  {
    $this->session = $session;
    $this->UserId = $UserId;
    $this->UserGalleryID = $UserGalleryID;
    $this->item = $item;
  }

}
