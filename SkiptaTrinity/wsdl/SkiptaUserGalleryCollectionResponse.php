<?php

class SkiptaUserGalleryCollectionResponse
{

  /**
   * 
   * @var array $Galleries
   * @access public
   */
  public $Galleries;

  /**
   * 
   * @var array $GalleryItems
   * @access public
   */
  public $GalleryItems;

  /**
   * 
   * @param array $Galleries
   * @param array $GalleryItems
   * @access public
   */
  public function __construct($Galleries, $GalleryItems)
  {
    $this->Galleries = $Galleries;
    $this->GalleryItems = $GalleryItems;
  }

}
