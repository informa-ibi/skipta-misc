<?php

class SkiptaPostFileInfomation
{

  /**
   * 
   * @var guid $FileId
   * @access public
   */
  public $FileId;

  /**
   * 
   * @var guid $PostId
   * @access public
   */
  public $PostId;

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
   * @param guid $FileId
   * @param guid $PostId
   * @param string $FileName
   * @param string $FileDescription
   * @param string $FilePath
   * @param int $FileSize
   * @access public
   */
  public function __construct($FileId, $PostId, $FileName, $FileDescription, $FilePath, $FileSize)
  {
    $this->FileId = $FileId;
    $this->PostId = $PostId;
    $this->FileName = $FileName;
    $this->FileDescription = $FileDescription;
    $this->FilePath = $FilePath;
    $this->FileSize = $FileSize;
  }

}
