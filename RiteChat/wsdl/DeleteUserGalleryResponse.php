<?php

class DeleteUserGalleryResponse
{

  /**
   * 
   * @var SkiptaUserGalleryResponse $DeleteUserGalleryResult
   * @access public
   */
  public $DeleteUserGalleryResult;

  /**
   * 
   * @param SkiptaUserGalleryResponse $DeleteUserGalleryResult
   * @access public
   */
  public function __construct($DeleteUserGalleryResult)
  {
    $this->DeleteUserGalleryResult = $DeleteUserGalleryResult;
  }

}
