<?php

class ClientSkiptaUserGalleryItem
{

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var string $Description
   * @access public
   */
  public $Description;

  /**
   * 
   * @var string $Thumb
   * @access public
   */
  public $Thumb;

  /**
   * 
   * @var string $Display
   * @access public
   */
  public $Display;

  /**
   * 
   * @var string $Actual
   * @access public
   */
  public $Actual;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var dateTime $UpdatedDate
   * @access public
   */
  public $UpdatedDate;

  /**
   * 
   * @var guid $CreatedUID
   * @access public
   */
  public $CreatedUID;

  /**
   * 
   * @var guid $UpdatedUID
   * @access public
   */
  public $UpdatedUID;

  /**
   * 
   * @var guid $UserID
   * @access public
   */
  public $UserID;

  /**
   * 
   * @var guid $UserGalleryID
   * @access public
   */
  public $UserGalleryID;

  /**
   * 
   * @var guid $UserGalleryPictureID
   * @access public
   */
  public $UserGalleryPictureID;

  /**
   * 
   * @param string $Name
   * @param string $Description
   * @param string $Thumb
   * @param string $Display
   * @param string $Actual
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @param guid $CreatedUID
   * @param guid $UpdatedUID
   * @param guid $UserID
   * @param guid $UserGalleryID
   * @param guid $UserGalleryPictureID
   * @access public
   */
  public function __construct($Name, $Description, $Thumb, $Display, $Actual, $CreatedDate, $UpdatedDate, $CreatedUID, $UpdatedUID, $UserID, $UserGalleryID, $UserGalleryPictureID)
  {
    $this->Name = $Name;
    $this->Description = $Description;
    $this->Thumb = $Thumb;
    $this->Display = $Display;
    $this->Actual = $Actual;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->CreatedUID = $CreatedUID;
    $this->UpdatedUID = $UpdatedUID;
    $this->UserID = $UserID;
    $this->UserGalleryID = $UserGalleryID;
    $this->UserGalleryPictureID = $UserGalleryPictureID;
  }

}
