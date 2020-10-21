<?php

class AddItemToGalleryResponse
{

  /**
   * 
   * @var SkiptaUserGalleryItemResponse $AddItemToGalleryResult
   * @access public
   */
  public $AddItemToGalleryResult;

  /**
   * 
   * @param SkiptaUserGalleryItemResponse $AddItemToGalleryResult
   * @access public
   */
  public function __construct($AddItemToGalleryResult)
  {
    $this->AddItemToGalleryResult = $AddItemToGalleryResult;
  }

}
