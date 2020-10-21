<?php

class SkiptaUserGlobalSearchResponse
{

  /**
   * 
   * @var SkiptaWorld $MasterWorld
   * @access public
   */
  public $MasterWorld;

  /**
   * 
   * @var SkiptaWorld $CurrentWorld
   * @access public
   */
  public $CurrentWorld;

  /**
   * 
   * @var array $Inbox
   * @access public
   */
  public $Inbox;

  /**
   * 
   * @var array $UserLinks
   * @access public
   */
  public $UserLinks;

  /**
   * 
   * @var array $MyFriends
   * @access public
   */
  public $MyFriends;

  /**
   * 
   * @var array $MyGroups
   * @access public
   */
  public $MyGroups;

  /**
   * 
   * @var array $Broadcast
   * @access public
   */
  public $Broadcast;

  /**
   * 
   * @var array $Watercooler
   * @access public
   */
  public $Watercooler;

  /**
   * 
   * @var array $ForumGeneral
   * @access public
   */
  public $ForumGeneral;

  /**
   * 
   * @var array $ForumItem
   * @access public
   */
  public $ForumItem;

  /**
   * 
   * @var array $MessageBoard
   * @access public
   */
  public $MessageBoard;

  /**
   * 
   * @var array $ProductInfo
   * @access public
   */
  public $ProductInfo;

  /**
   * 
   * @var array $MyGallery
   * @access public
   */
  public $MyGallery;

  /**
   * 
   * @var array $GroupGallery
   * @access public
   */
  public $GroupGallery;

  /**
   * 
   * @var array $PublicFiles
   * @access public
   */
  public $PublicFiles;

  /**
   * 
   * @var array $MyBriefcase
   * @access public
   */
  public $MyBriefcase;

  /**
   * 
   * @var array $Library
   * @access public
   */
  public $Library;

  /**
   * 
   * @var array $MyCalendar
   * @access public
   */
  public $MyCalendar;

  /**
   * 
   * @var array $GroupEvents
   * @access public
   */
  public $GroupEvents;

  /**
   * 
   * @var array $SubgroupEvents
   * @access public
   */
  public $SubgroupEvents;

  /**
   * 
   * @var array $Job
   * @access public
   */
  public $Job;

  /**
   * 
   * @var array $NewsMain
   * @access public
   */
  public $NewsMain;

  /**
   * 
   * @var array $NewsGroup
   * @access public
   */
  public $NewsGroup;

  /**
   * 
   * @var array $NewsComment
   * @access public
   */
  public $NewsComment;

  /**
   * 
   * @var array $People
   * @access public
   */
  public $People;

  /**
   * 
   * @var array $Groups
   * @access public
   */
  public $Groups;

  /**
   * 
   * @var string $SearchKey
   * @access public
   */
  public $SearchKey;

  /**
   * 
   * @var boolean $InboxSearchComplete
   * @access public
   */
  public $InboxSearchComplete;

  /**
   * 
   * @var boolean $UserLinksSearchComplete
   * @access public
   */
  public $UserLinksSearchComplete;

  /**
   * 
   * @var boolean $MyFriendsSearchComplete
   * @access public
   */
  public $MyFriendsSearchComplete;

  /**
   * 
   * @var boolean $MyGroupsSearchComplete
   * @access public
   */
  public $MyGroupsSearchComplete;

  /**
   * 
   * @var boolean $BroadcastSearchComplete
   * @access public
   */
  public $BroadcastSearchComplete;

  /**
   * 
   * @var boolean $WatercoolerSearchComplete
   * @access public
   */
  public $WatercoolerSearchComplete;

  /**
   * 
   * @var boolean $ForumGeneralSearchComplete
   * @access public
   */
  public $ForumGeneralSearchComplete;

  /**
   * 
   * @var boolean $ForumItemSearchComplete
   * @access public
   */
  public $ForumItemSearchComplete;

  /**
   * 
   * @var boolean $MessageBoardSearchComplete
   * @access public
   */
  public $MessageBoardSearchComplete;

  /**
   * 
   * @var boolean $ProductInfoSearchComplete
   * @access public
   */
  public $ProductInfoSearchComplete;

  /**
   * 
   * @var boolean $MyGallerySearchComplete
   * @access public
   */
  public $MyGallerySearchComplete;

  /**
   * 
   * @var boolean $GroupGallerySearchComplete
   * @access public
   */
  public $GroupGallerySearchComplete;

  /**
   * 
   * @var boolean $PublicFilesSearchComplete
   * @access public
   */
  public $PublicFilesSearchComplete;

  /**
   * 
   * @var boolean $MyBriefcaseSearchComplete
   * @access public
   */
  public $MyBriefcaseSearchComplete;

  /**
   * 
   * @var boolean $LibrarySearchComplete
   * @access public
   */
  public $LibrarySearchComplete;

  /**
   * 
   * @var boolean $MyCalendarSearchComplete
   * @access public
   */
  public $MyCalendarSearchComplete;

  /**
   * 
   * @var boolean $GroupEventsSearchComplete
   * @access public
   */
  public $GroupEventsSearchComplete;

  /**
   * 
   * @var boolean $SubgroupEventsSearchComplete
   * @access public
   */
  public $SubgroupEventsSearchComplete;

  /**
   * 
   * @var boolean $JobSearchComplete
   * @access public
   */
  public $JobSearchComplete;

  /**
   * 
   * @var boolean $NewsMainSearchComplete
   * @access public
   */
  public $NewsMainSearchComplete;

  /**
   * 
   * @var boolean $NewsGroupSearchComplete
   * @access public
   */
  public $NewsGroupSearchComplete;

  /**
   * 
   * @var boolean $NewsCommentSearchComplete
   * @access public
   */
  public $NewsCommentSearchComplete;

  /**
   * 
   * @var boolean $PeopleSearchComplete
   * @access public
   */
  public $PeopleSearchComplete;

  /**
   * 
   * @var boolean $GroupsSearchComplete
   * @access public
   */
  public $GroupsSearchComplete;

  /**
   * 
   * @param SkiptaWorld $MasterWorld
   * @param SkiptaWorld $CurrentWorld
   * @param array $Inbox
   * @param array $UserLinks
   * @param array $MyFriends
   * @param array $MyGroups
   * @param array $Broadcast
   * @param array $Watercooler
   * @param array $ForumGeneral
   * @param array $ForumItem
   * @param array $MessageBoard
   * @param array $ProductInfo
   * @param array $MyGallery
   * @param array $GroupGallery
   * @param array $PublicFiles
   * @param array $MyBriefcase
   * @param array $Library
   * @param array $MyCalendar
   * @param array $GroupEvents
   * @param array $SubgroupEvents
   * @param array $Job
   * @param array $NewsMain
   * @param array $NewsGroup
   * @param array $NewsComment
   * @param array $People
   * @param array $Groups
   * @param string $SearchKey
   * @param boolean $InboxSearchComplete
   * @param boolean $UserLinksSearchComplete
   * @param boolean $MyFriendsSearchComplete
   * @param boolean $MyGroupsSearchComplete
   * @param boolean $BroadcastSearchComplete
   * @param boolean $WatercoolerSearchComplete
   * @param boolean $ForumGeneralSearchComplete
   * @param boolean $ForumItemSearchComplete
   * @param boolean $MessageBoardSearchComplete
   * @param boolean $ProductInfoSearchComplete
   * @param boolean $MyGallerySearchComplete
   * @param boolean $GroupGallerySearchComplete
   * @param boolean $PublicFilesSearchComplete
   * @param boolean $MyBriefcaseSearchComplete
   * @param boolean $LibrarySearchComplete
   * @param boolean $MyCalendarSearchComplete
   * @param boolean $GroupEventsSearchComplete
   * @param boolean $SubgroupEventsSearchComplete
   * @param boolean $JobSearchComplete
   * @param boolean $NewsMainSearchComplete
   * @param boolean $NewsGroupSearchComplete
   * @param boolean $NewsCommentSearchComplete
   * @param boolean $PeopleSearchComplete
   * @param boolean $GroupsSearchComplete
   * @access public
   */
  public function __construct($MasterWorld, $CurrentWorld, $Inbox, $UserLinks, $MyFriends, $MyGroups, $Broadcast, $Watercooler, $ForumGeneral, $ForumItem, $MessageBoard, $ProductInfo, $MyGallery, $GroupGallery, $PublicFiles, $MyBriefcase, $Library, $MyCalendar, $GroupEvents, $SubgroupEvents, $Job, $NewsMain, $NewsGroup, $NewsComment, $People, $Groups, $SearchKey, $InboxSearchComplete, $UserLinksSearchComplete, $MyFriendsSearchComplete, $MyGroupsSearchComplete, $BroadcastSearchComplete, $WatercoolerSearchComplete, $ForumGeneralSearchComplete, $ForumItemSearchComplete, $MessageBoardSearchComplete, $ProductInfoSearchComplete, $MyGallerySearchComplete, $GroupGallerySearchComplete, $PublicFilesSearchComplete, $MyBriefcaseSearchComplete, $LibrarySearchComplete, $MyCalendarSearchComplete, $GroupEventsSearchComplete, $SubgroupEventsSearchComplete, $JobSearchComplete, $NewsMainSearchComplete, $NewsGroupSearchComplete, $NewsCommentSearchComplete, $PeopleSearchComplete, $GroupsSearchComplete)
  {
    $this->MasterWorld = $MasterWorld;
    $this->CurrentWorld = $CurrentWorld;
    $this->Inbox = $Inbox;
    $this->UserLinks = $UserLinks;
    $this->MyFriends = $MyFriends;
    $this->MyGroups = $MyGroups;
    $this->Broadcast = $Broadcast;
    $this->Watercooler = $Watercooler;
    $this->ForumGeneral = $ForumGeneral;
    $this->ForumItem = $ForumItem;
    $this->MessageBoard = $MessageBoard;
    $this->ProductInfo = $ProductInfo;
    $this->MyGallery = $MyGallery;
    $this->GroupGallery = $GroupGallery;
    $this->PublicFiles = $PublicFiles;
    $this->MyBriefcase = $MyBriefcase;
    $this->Library = $Library;
    $this->MyCalendar = $MyCalendar;
    $this->GroupEvents = $GroupEvents;
    $this->SubgroupEvents = $SubgroupEvents;
    $this->Job = $Job;
    $this->NewsMain = $NewsMain;
    $this->NewsGroup = $NewsGroup;
    $this->NewsComment = $NewsComment;
    $this->People = $People;
    $this->Groups = $Groups;
    $this->SearchKey = $SearchKey;
    $this->InboxSearchComplete = $InboxSearchComplete;
    $this->UserLinksSearchComplete = $UserLinksSearchComplete;
    $this->MyFriendsSearchComplete = $MyFriendsSearchComplete;
    $this->MyGroupsSearchComplete = $MyGroupsSearchComplete;
    $this->BroadcastSearchComplete = $BroadcastSearchComplete;
    $this->WatercoolerSearchComplete = $WatercoolerSearchComplete;
    $this->ForumGeneralSearchComplete = $ForumGeneralSearchComplete;
    $this->ForumItemSearchComplete = $ForumItemSearchComplete;
    $this->MessageBoardSearchComplete = $MessageBoardSearchComplete;
    $this->ProductInfoSearchComplete = $ProductInfoSearchComplete;
    $this->MyGallerySearchComplete = $MyGallerySearchComplete;
    $this->GroupGallerySearchComplete = $GroupGallerySearchComplete;
    $this->PublicFilesSearchComplete = $PublicFilesSearchComplete;
    $this->MyBriefcaseSearchComplete = $MyBriefcaseSearchComplete;
    $this->LibrarySearchComplete = $LibrarySearchComplete;
    $this->MyCalendarSearchComplete = $MyCalendarSearchComplete;
    $this->GroupEventsSearchComplete = $GroupEventsSearchComplete;
    $this->SubgroupEventsSearchComplete = $SubgroupEventsSearchComplete;
    $this->JobSearchComplete = $JobSearchComplete;
    $this->NewsMainSearchComplete = $NewsMainSearchComplete;
    $this->NewsGroupSearchComplete = $NewsGroupSearchComplete;
    $this->NewsCommentSearchComplete = $NewsCommentSearchComplete;
    $this->PeopleSearchComplete = $PeopleSearchComplete;
    $this->GroupsSearchComplete = $GroupsSearchComplete;
  }

}
