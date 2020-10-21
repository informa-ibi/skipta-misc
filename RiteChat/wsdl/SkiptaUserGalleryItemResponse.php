<?php

class SkiptaUserGalleryItemResponse
{

  /**
   * 
   * @var ClientSkiptaUserGalleryItem $ItemData
   * @access public
   */
  public $ItemData;

  /**
   * 
   * @param ClientSkiptaUserGalleryItem $ItemData
   * @access public
   */
  public function __construct($ItemData)
  {
    $this->ItemData = $ItemData;
  }

}
