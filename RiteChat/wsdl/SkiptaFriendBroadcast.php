<?php

class SkiptaFriendBroadcast
{

  /**
   * 
   * @var guid $BroadcasterPostId
   * @access public
   */
  public $BroadcasterPostId;

  /**
   * 
   * @var string $ResponseMessage
   * @access public
   */
  public $ResponseMessage;

  /**
   * 
   * @var SkiptaResponseCode $ResponseCode
   * @access public
   */
  public $ResponseCode;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var guid $WorldPosted
   * @access public
   */
  public $WorldPosted;

  /**
   * 
   * @var SkiptaFriendBroadcastCommentCollection $Comments
   * @access public
   */
  public $Comments;

  /**
   * 
   * @var string $Message
   * @access public
   */
  public $Message;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var string $Link
   * @access public
   */
  public $Link;

  /**
   * 
   * @var string $Firstname
   * @access public
   */
  public $Firstname;

  /**
   * 
   * @var string $Lastname
   * @access public
   */
  public $Lastname;

  /**
   * 
   * @var array $PostedFiles
   * @access public
   */
  public $PostedFiles;

  /**
   * 
   * @var int $Likes
   * @access public
   */
  public $Likes;

  /**
   * 
   * @var int $DisLikes
   * @access public
   */
  public $DisLikes;

  /**
   * 
   * @var string $UserRated
   * @access public
   */
  public $UserRated;

  /**
   * 
   * @var int $allowComments
   * @access public
   */
  public $allowComments;

  /**
   * 
   * @var boolean $EnableUserRating
   * @access public
   */
  public $EnableUserRating;

  /**
   * 
   * @var guid $OrganizationId
   * @access public
   */
  public $OrganizationId;

  /**
   * 
   * @var int $CommentCount
   * @access public
   */
  public $CommentCount;

  /**
   * 
   * @var int $Popularity
   * @access public
   */
  public $Popularity;

  /**
   * 
   * @var int $Following
   * @access public
   */
  public $Following;

  /**
   * 
   * @var int $Rank
   * @access public
   */
  public $Rank;

  /**
   * 
   * @var boolean $isAnonymous
   * @access public
   */
  public $isAnonymous;

  /**
   * 
   * @param guid $BroadcasterPostId
   * @param string $ResponseMessage
   * @param SkiptaResponseCode $ResponseCode
   * @param guid $UserId
   * @param guid $WorldPosted
   * @param SkiptaFriendBroadcastCommentCollection $Comments
   * @param string $Message
   * @param dateTime $CreatedDate
   * @param string $Link
   * @param string $Firstname
   * @param string $Lastname
   * @param array $PostedFiles
   * @param int $Likes
   * @param int $DisLikes
   * @param string $UserRated
   * @param int $allowComments
   * @param boolean $EnableUserRating
   * @param guid $OrganizationId
   * @param int $CommentCount
   * @param int $Popularity
   * @param int $Following
   * @param int $Rank
   * @param boolean $isAnonymous
   * @access public
   */
  public function __construct($BroadcasterPostId, $ResponseMessage, $ResponseCode, $UserId, $WorldPosted, $Comments, $Message, $CreatedDate, $Link, $Firstname, $Lastname, $PostedFiles, $Likes, $DisLikes, $UserRated, $allowComments, $EnableUserRating, $OrganizationId, $CommentCount, $Popularity, $Following, $Rank, $isAnonymous)
  {
    $this->BroadcasterPostId = $BroadcasterPostId;
    $this->ResponseMessage = $ResponseMessage;
    $this->ResponseCode = $ResponseCode;
    $this->UserId = $UserId;
    $this->WorldPosted = $WorldPosted;
    $this->Comments = $Comments;
    $this->Message = $Message;
    $this->CreatedDate = $CreatedDate;
    $this->Link = $Link;
    $this->Firstname = $Firstname;
    $this->Lastname = $Lastname;
    $this->PostedFiles = $PostedFiles;
    $this->Likes = $Likes;
    $this->DisLikes = $DisLikes;
    $this->UserRated = $UserRated;
    $this->allowComments = $allowComments;
    $this->EnableUserRating = $EnableUserRating;
    $this->OrganizationId = $OrganizationId;
    $this->CommentCount = $CommentCount;
    $this->Popularity = $Popularity;
    $this->Following = $Following;
    $this->Rank = $Rank;
    $this->isAnonymous = $isAnonymous;
  }

}
