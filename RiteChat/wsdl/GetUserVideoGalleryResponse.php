<?php

class GetUserVideoGalleryResponse
{

  /**
   * 
   * @var SkiptaUserGalleryCollectionResponse $GetUserVideoGalleryResult
   * @access public
   */
  public $GetUserVideoGalleryResult;

  /**
   * 
   * @param SkiptaUserGalleryCollectionResponse $GetUserVideoGalleryResult
   * @access public
   */
  public function __construct($GetUserVideoGalleryResult)
  {
    $this->GetUserVideoGalleryResult = $GetUserVideoGalleryResult;
  }

}
