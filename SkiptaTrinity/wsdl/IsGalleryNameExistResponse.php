<?php

class IsGalleryNameExistResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $IsGalleryNameExistResult
   * @access public
   */
  public $IsGalleryNameExistResult;

  /**
   * 
   * @param SkiptaBooleanResponse $IsGalleryNameExistResult
   * @access public
   */
  public function __construct($IsGalleryNameExistResult)
  {
    $this->IsGalleryNameExistResult = $IsGalleryNameExistResult;
  }

}
