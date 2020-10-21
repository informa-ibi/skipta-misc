<?php

class GetUserImageAndVideoGalleryResponse
{

  /**
   * 
   * @var SkiptaUserGalleryCollectionResponse $GetUserImageAndVideoGalleryResult
   * @access public
   */
  public $GetUserImageAndVideoGalleryResult;

  /**
   * 
   * @param SkiptaUserGalleryCollectionResponse $GetUserImageAndVideoGalleryResult
   * @access public
   */
  public function __construct($GetUserImageAndVideoGalleryResult)
  {
    $this->GetUserImageAndVideoGalleryResult = $GetUserImageAndVideoGalleryResult;
  }

}
