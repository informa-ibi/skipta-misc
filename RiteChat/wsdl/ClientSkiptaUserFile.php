<?php

class ClientSkiptaUserFile
{

  /**
   * 
   * @var guid $UserFileID
   * @access public
   */
  public $UserFileID;

  /**
   * 
   * @var guid $UserID
   * @access public
   */
  public $UserID;

  /**
   * 
   * @var guid $CreatedUID
   * @access public
   */
  public $CreatedUID;

  /**
   * 
   * @var string $FileName
   * @access public
   */
  public $FileName;

  /**
   * 
   * @var string $FileDescription
   * @access public
   */
  public $FileDescription;

  /**
   * 
   * @var string $FilePath
   * @access public
   */
  public $FilePath;

  /**
   * 
   * @var int $FileSize
   * @access public
   */
  public $FileSize;

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
   * @param guid $UserFileID
   * @param guid $UserID
   * @param guid $CreatedUID
   * @param string $FileName
   * @param string $FileDescription
   * @param string $FilePath
   * @param int $FileSize
   * @param dateTime $CreatedDate
   * @param dateTime $UpdatedDate
   * @access public
   */
  public function __construct($UserFileID, $UserID, $CreatedUID, $FileName, $FileDescription, $FilePath, $FileSize, $CreatedDate, $UpdatedDate)
  {
    $this->UserFileID = $UserFileID;
    $this->UserID = $UserID;
    $this->CreatedUID = $CreatedUID;
    $this->FileName = $FileName;
    $this->FileDescription = $FileDescription;
    $this->FilePath = $FilePath;
    $this->FileSize = $FileSize;
    $this->CreatedDate = $CreatedDate;
    $this->UpdatedDate = $UpdatedDate;
  }

}
