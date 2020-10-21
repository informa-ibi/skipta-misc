<?php

class ClientSkiptaUserGallery
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
   * @param string $Name
   * @param string $Description
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @param guid $CreatedUID
   * @param guid $UpdatedUID
   * @param guid $UserID
   * @param guid $UserGalleryID
   * @access public
   */
  public function __construct($Name, $Description, $CreatedDate, $UpdatedDate, $CreatedUID, $UpdatedUID, $UserID, $UserGalleryID)
  {
    $this->Name = $Name;
    $this->Description = $Description;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
    $this->CreatedUID = $CreatedUID;
    $this->UpdatedUID = $UpdatedUID;
    $this->UserID = $UserID;
    $this->UserGalleryID = $UserGalleryID;
  }

}
