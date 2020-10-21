<?php

class IsPictureNameExistInGalleryResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsPictureNameExistInGalleryResult
   * @access public
   */
  public $IsPictureNameExistInGalleryResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsPictureNameExistInGalleryResult
   * @access public
   */
  public function __construct($IsPictureNameExistInGalleryResult)
  {
    $this->IsPictureNameExistInGalleryResult = $IsPictureNameExistInGalleryResult;
  }

}
