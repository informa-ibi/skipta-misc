<?php

class DeleteItemInGalleryResponse
{

  /**
   * 
   * @var SkiptaBooleanResponse $DeleteItemInGalleryResult
   * @access public
   */
  public $DeleteItemInGalleryResult;

  /**
   * 
   * @param SkiptaBooleanResponse $DeleteItemInGalleryResult
   * @access public
   */
  public function __construct($DeleteItemInGalleryResult)
  {
    $this->DeleteItemInGalleryResult = $DeleteItemInGalleryResult;
  }

}
