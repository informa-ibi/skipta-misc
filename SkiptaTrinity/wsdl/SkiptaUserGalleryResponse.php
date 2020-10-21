<?php

class SkiptaUserGalleryResponse
{

  /**
   * 
   * @var ClientSkiptaUserGallery $GalleryData
   * @access public
   */
  public $GalleryData;

  /**
   * 
   * @param ClientSkiptaUserGallery $GalleryData
   * @access public
   */
  public function __construct($GalleryData)
  {
    $this->GalleryData = $GalleryData;
  }

}
