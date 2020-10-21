<?php

class AddGalleryResponse
{

  /**
   * 
   * @var SkiptaUserGalleryResponse $AddGalleryResult
   * @access public
   */
  public $AddGalleryResult;

  /**
   * 
   * @param SkiptaUserGalleryResponse $AddGalleryResult
   * @access public
   */
  public function __construct($AddGalleryResult)
  {
    $this->AddGalleryResult = $AddGalleryResult;
  }

}
