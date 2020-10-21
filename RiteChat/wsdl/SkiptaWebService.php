<?php

include_once('GetOnlineFriends.php');
include_once('ClientSkiptaSession.php');
include_once('GetOnlineFriendsResponse.php');
include_once('SkiptaFriendListResponse.php');
include_once('SkiptaResponse.php');
include_once('SkiptaWorld.php');
include_once('SkiptaResponseCode.php');
include_once('SkiptaFriend.php');
include_once('IsGalleryNameExist.php');
include_once('IsGalleryNameExistResponse.php');
include_once('SkiptaBooleanResponse.php');
include_once('IsPictureNameExistInGallery.php');
include_once('IsPictureNameExistInGalleryResponse.php');
include_once('AddProfileLinkToTheCurrentUser.php');
include_once('AddProfileLinkToTheCurrentUserResponse.php');
include_once('AddCurrentUserFile.php');
include_once('ClientSkiptaUserFile.php');
include_once('AddCurrentUserFileResponse.php');
include_once('SkiptaUserFileResponse.php');
include_once('IsUserFriendOrNotInWorld.php');
include_once('IsUserFriendOrNotInWorldResponse.php');
include_once('ActivateAllUsers.php');
include_once('ActivateAllUsersResponse.php');
include_once('UpdateTheme.php');
include_once('UpdateThemeResponse.php');
include_once('GetAllWorldsByUserId.php');
include_once('GetAllWorldsByUserIdResponse.php');
include_once('SkiptaWorldCollectionResponse.php');
include_once('ClientSkiptaWorld.php');
include_once('UpdateMenuItemDisplayName.php');
include_once('UpdateMenuItemDisplayNameResponse.php');
include_once('UpdateToolsMenuItemDisplayName.php');
include_once('UpdateToolsMenuItemDisplayNameResponse.php');
include_once('UpdateResourceMenuItemDisplayName.php');
include_once('UpdateResourceMenuItemDisplayNameResponse.php');
include_once('GetMenusByGroupMenu.php');
include_once('GetMenusByGroupMenuResponse.php');
include_once('SkiptaMenusByGroupMenuResponse.php');
include_once('menuLabels.php');
include_once('FollowABroadcast.php');
include_once('FollowABroadcastResponse.php');
include_once('UnFollowABroadcast.php');
include_once('UnFollowABroadcastResponse.php');
include_once('GetTopBroadcastsFromWorldByHashtag.php');
include_once('GetTopBroadcastsFromWorldByHashtagResponse.php');
include_once('SkiptaFriendBroadcastCollection.php');
include_once('SkiptaFriendBroadcast.php');
include_once('SkiptaFriendBroadcastCommentCollection.php');
include_once('SkiptaFriendBroadcastComment.php');
include_once('SkiptaPostFileInfomation.php');
include_once('GetActionWeightageByNameAndWorld.php');
include_once('GetActionWeightageByNameAndWorldResponse.php');
include_once('GetMyFriendTopBroadcastsFromWorld.php');
include_once('GetMyFriendTopBroadcastsFromWorldResponse.php');
include_once('RegisterUser.php');
include_once('ClientSkiptaUser.php');
include_once('ClientSkiptaUserAddress.php');
include_once('SkiptaWorldRole.php');
include_once('KeyValue.php');
include_once('RegisterUserResponse.php');
include_once('SkiptaNewUserResponse.php');
include_once('GetWorldWiseNoOfUsers.php');
include_once('GetWorldWiseNoOfUsersResponse.php');
include_once('SkiptaWorldWiseNoOfUsersResponse.php');
include_once('SkiptaWorldWithNoOfUsers.php');
include_once('RegisterUserForUN.php');
include_once('RegisterUserForUNResponse.php');
include_once('AddUserToWorldUN.php');
include_once('AddUserToWorldUNResponse.php');
include_once('UpdateUserCountry.php');
include_once('UpdateUserCountryResponse.php');
include_once('IsUserAliveForSendingChatMessage.php');
include_once('IsUserAliveForSendingChatMessageResponse.php');
include_once('GetJobsForAWorld.php');
include_once('GetJobsForAWorldResponse.php');
include_once('AddTimeSlotToEvent.php');
include_once('ClientSkiptaCalendarEventTimeSlot.php');
include_once('AddTimeSlotToEventResponse.php');
include_once('UpdateTimeSlot.php');
include_once('UpdateTimeSlotResponse.php');
include_once('DeleteTimeSlot.php');
include_once('DeleteTimeSlotResponse.php');
include_once('AddEvent.php');
include_once('ClientSkiptaCalendarEvent.php');
include_once('AddEventResponse.php');
include_once('UpdateEvent.php');
include_once('UpdateEventResponse.php');
include_once('DeleteEvent.php');
include_once('DeleteEventResponse.php');
include_once('AddEventInvite.php');
include_once('ClientSkiptaCalendarEventInvite.php');
include_once('SkiptaEventRSVPStatus.php');
include_once('AddEventInviteResponse.php');
include_once('HasEventInvitePending.php');
include_once('HasEventInvitePendingResponse.php');
include_once('UpdateEventInvite.php');
include_once('UpdateEventInviteResponse.php');
include_once('DeleteEventInvite.php');
include_once('DeleteEventInviteResponse.php');
include_once('GetMyCreatedEvents.php');
include_once('GetMyCreatedEventsResponse.php');
include_once('SkiptaUserCalendarResponse.php');
include_once('GetEventsForUserByRSVP.php');
include_once('GetEventsForUserByRSVPResponse.php');
include_once('GetPersonalEventsForUserByRSVP.php');
include_once('GetPersonalEventsForUserByRSVPResponse.php');
include_once('AddUserFile.php');
include_once('AddUserFileResponse.php');
include_once('GetFilesForUser.php');
include_once('GetFilesForUserResponse.php');
include_once('UpdateUserFile.php');
include_once('UpdateUserFileResponse.php');
include_once('DeleteUserFile.php');
include_once('DeleteUserFileResponse.php');
include_once('SwapWidgets.php');
include_once('SwapWidgetsResponse.php');
include_once('AddWidgetToUser.php');
include_once('AddWidgetToUserResponse.php');
include_once('SkiptaGuidResponse.php');
include_once('RemoveWidgetFromUser.php');
include_once('RemoveWidgetFromUserResponse.php');
include_once('AddGallery.php');
include_once('ClientSkiptaUserGallery.php');
include_once('AddGalleryResponse.php');
include_once('SkiptaUserGalleryResponse.php');
include_once('AddItemToGallery.php');
include_once('ClientSkiptaUserGalleryItem.php');
include_once('AddItemToGalleryResponse.php');
include_once('SkiptaUserGalleryItemResponse.php');
include_once('AddVideoItemToGallery.php');
include_once('AddVideoItemToGalleryResponse.php');
include_once('EditItemInGallery.php');
include_once('EditItemInGalleryResponse.php');
include_once('DeleteItemInGallery.php');
include_once('DeleteItemInGalleryResponse.php');
include_once('GetUserGallery.php');
include_once('GetUserGalleryResponse.php');
include_once('SkiptaUserGalleryCollectionResponse.php');
include_once('GetUserVideoGallery.php');
include_once('GetUserVideoGalleryResponse.php');
include_once('GetUserImageAndVideoGallery.php');
include_once('GetUserImageAndVideoGalleryResponse.php');
include_once('UpdateUserGallery.php');
include_once('UpdateUserGalleryResponse.php');
include_once('DeleteUserGallery.php');
include_once('DeleteUserGalleryResponse.php');
include_once('GetFriendBroadcastById.php');
include_once('GetFriendBroadcastByIdResponse.php');
include_once('GetFriendBroadcasts.php');
include_once('GetFriendBroadcastsResponse.php');
include_once('GetBroadcastsForUser.php');
include_once('GetBroadcastsForUserResponse.php');
include_once('GetMyBroadcasts.php');
include_once('GetMyBroadcastsResponse.php');
include_once('GetTopBroadcastsFromWorld.php');
include_once('GetTopBroadcastsFromWorldResponse.php');
include_once('GetTopBroadcasts.php');
include_once('GetTopBroadcastsResponse.php');
include_once('GetAllBroadcasts.php');
include_once('GetAllBroadcastsResponse.php');
include_once('NewFriendBroadcast.php');
include_once('NewFriendBroadcastResponse.php');
include_once('DeleteFriendBroadcast.php');
include_once('DeleteFriendBroadcastResponse.php');
include_once('NewFriendBroadcastComment.php');
include_once('NewFriendBroadcastCommentResponse.php');
include_once('NewFriendBroadcastCommentAndReturnCommentId.php');
include_once('NewFriendBroadcastCommentAndReturnCommentIdResponse.php');
include_once('DeleteFriendBroadcastCommentById.php');
include_once('DeleteFriendBroadcastCommentByIdResponse.php');
include_once('UpdateFriendBroadcastCommentById.php');
include_once('UpdateFriendBroadcastCommentByIdResponse.php');
include_once('LoadRecommendedFriendsForWorld.php');
include_once('LoadRecommendedFriendsForWorldResponse.php');
include_once('SkiptaUserCollectionResponse.php');
include_once('LoadSkiptaRecommendedFriends.php');
include_once('LoadSkiptaRecommendedFriendsResponse.php');
include_once('RemoveUserOAuthByService.php');
include_once('RemoveUserOAuthByServiceResponse.php');
include_once('GetUserOAuthByService.php');
include_once('GetUserOAuthByServiceResponse.php');
include_once('SkiptaUserOAuth.php');
include_once('SaveUserOAuth.php');
include_once('SaveUserOAuthResponse.php');
include_once('AddWorldLinkToCategory.php');
include_once('SkiptaWorldLink.php');
include_once('AddWorldLinkToCategoryResponse.php');
include_once('AddWorldLinkCategory.php');
include_once('SkiptaWorldLinkCategory.php');
include_once('AddWorldLinkCategoryResponse.php');
include_once('GetWorldLinksByCategory.php');
include_once('GetWorldLinksByCategoryResponse.php');
include_once('GetWorldLinkCategories.php');
include_once('GetWorldLinkCategoriesResponse.php');
include_once('GetAllWorldLinks.php');
include_once('GetAllWorldLinksResponse.php');
include_once('GetPopularWorldLinks.php');
include_once('GetPopularWorldLinksResponse.php');
include_once('GetSuggestedWorldLinks.php');
include_once('GetSuggestedWorldLinksResponse.php');
include_once('GetWidgetWorldLinks.php');
include_once('GetWidgetWorldLinksResponse.php');
include_once('GetCategoryWorldLinks.php');
include_once('GetCategoryWorldLinksResponse.php');
include_once('SkiptaGlobalSearch.php');
include_once('SkiptaGlobalSearchResponse.php');
include_once('SkiptaUserGlobalSearchResponse.php');
include_once('SkiptaGlobalSearchResult.php');
include_once('SkiptaGlobalSearchResultSource.php');
include_once('GetRatedUsersForPost.php');
include_once('SkiptaPostRating.php');
include_once('SkiptaPostRatingOption.php');
include_once('GetRatedUsersForPostResponse.php');
include_once('SkiptaUserRatingResponse.php');
include_once('SkiptaNewsFeedComment.php');
include_once('SetUserRatingForPost.php');
include_once('SetUserRatingForPostResponse.php');
include_once('GetSkiptaWorlds.php');
include_once('SkiptaNewsRating.php');
include_once('SkiptaNewsFeedOption.php');
include_once('SkiptaNewsFeedSetting.php');
include_once('SkiptaNewsFeedItem.php');
include_once('GetSkiptaWorldsResponse.php');
include_once('SkiptaNewsFeedResponse.php');
include_once('SkiptaOption.php');
include_once('SkiptaNewsFeedAggregate.php');
include_once('GetWorldNewsFeedSettings.php');
include_once('GetWorldNewsFeedSettingsResponse.php');
include_once('SaveWorldNewsFeedConfiguration.php');
include_once('SaveWorldNewsFeedConfigurationResponse.php');
include_once('GetWorldNews.php');
include_once('GetWorldNewsResponse.php');
include_once('GetTopNews.php');
include_once('GetTopNewsResponse.php');
include_once('GetWorldFeedAggregate.php');
include_once('GetWorldFeedAggregateResponse.php');
include_once('SetCommentForNews.php');
include_once('SetCommentForNewsResponse.php');
include_once('fetchCommentForNews.php');
include_once('fetchCommentForNewsResponse.php');
include_once('SetUserRatingForNews.php');
include_once('SetUserRatingForNewsResponse.php');
include_once('GetRatedUsersForNews.php');
include_once('GetRatedUsersForNewsResponse.php');
include_once('GetFriendPostsCount.php');
include_once('SkiptaFriendPost.php');
include_once('SkiptaPostQueryOption.php');
include_once('GetFriendPostsCountResponse.php');
include_once('GetFriendPosts.php');
include_once('GetFriendPostsResponse.php');
include_once('GetWorldMenus.php');
include_once('GetWorldMenusResponse.php');
include_once('SkiptaWorldMenusResponse.php');
include_once('menus.php');
include_once('GetTopBroadcastsFromWorldForWidget.php');
include_once('GetTopBroadcastsFromWorldForWidgetResponse.php');
include_once('GetAllLinksByCategoryWise.php');
include_once('GetAllLinksByCategoryWiseResponse.php');
include_once('GetTopNewMembers.php');
include_once('GetTopNewMembersResponse.php');
include_once('SkiptaNewMembersResponse.php');
include_once('newMembers.php');
include_once('GetMoreNewMembers.php');
include_once('GetMoreNewMembersResponse.php');
include_once('SkiptaMoreNewMembersResponse.php');
include_once('moreNewMembers.php');
include_once('GetUserInfo.php');
include_once('GetUserInfoResponse.php');
include_once('SkiptaUserInformationResponse.php');
include_once('userinformation.php');
include_once('GetWidgetLinksByCategoryWise.php');
include_once('GetWidgetLinksByCategoryWiseResponse.php');
include_once('GetWidgetMoreLinksByCategoryWise.php');
include_once('GetWidgetMoreLinksByCategoryWiseResponse.php');
include_once('GetFriendRecommendations.php');
include_once('GetFriendRecommendationsResponse.php');
include_once('SkiptaFriendRecommendationResponse.php');
include_once('friendrecommendation.php');
include_once('GetMoreFriendRecommendations.php');
include_once('GetMoreFriendRecommendationsResponse.php');
include_once('SkiptaMoreFriendRecommendationResponse.php');
include_once('friendmorerecommendation.php');
include_once('UpdateUserPhoneForUserId.php');
include_once('UpdateUserPhoneForUserIdResponse.php');
include_once('UpdateUserPhone.php');
include_once('UpdateUserPhoneResponse.php');
include_once('UpdateUserNameForUserId.php');
include_once('UpdateUserNameForUserIdResponse.php');
include_once('UpdateUserName.php');
include_once('UpdateUserNameResponse.php');
include_once('UpdateUserEmailForUserId.php');
include_once('UpdateUserEmailForUserIdResponse.php');
include_once('UpdateUserEmail.php');
include_once('UpdateUserEmailResponse.php');
include_once('UpdateUserAddress.php');
include_once('UpdateUserAddressResponse.php');
include_once('GetUserAddressCollection.php');
include_once('GetUserAddressCollectionResponse.php');
include_once('SkiptaUserAddressCollectionResponse.php');
include_once('UpdateUserWidgetState.php');
include_once('UpdateUserWidgetStateResponse.php');
include_once('EmailIsUnique.php');
include_once('EmailIsUniqueResponse.php');
include_once('AddNewUser.php');
include_once('AddNewUserResponse.php');
include_once('ChangeUserPassword.php');
include_once('ChangeUserPasswordResponse.php');
include_once('ChangeUserPasswordWithEncryptedOld.php');
include_once('ChangeUserPasswordWithEncryptedOldResponse.php');
include_once('ActivateUser.php');
include_once('ActivateUserResponse.php');
include_once('IsValidUser.php');
include_once('IsValidUserResponse.php');
include_once('GetUserId.php');
include_once('GetUserIdResponse.php');
include_once('UpdateUserSession.php');
include_once('UpdateUserSessionResponse.php');
include_once('SkiptaUserSessionResponse.php');
include_once('IsUserAlive.php');
include_once('IsUserAliveResponse.php');
include_once('IsUserLogedIn.php');
include_once('IsUserLogedInResponse.php');
include_once('GetUserSessionExpiration.php');
include_once('GetUserSessionExpirationResponse.php');
include_once('SkiptaDateTimeResponse.php');
include_once('GetUserById.php');
include_once('GetUserByIdResponse.php');
include_once('SkiptaClientUserResponse.php');
include_once('GetUserBySession.php');
include_once('GetUserBySessionResponse.php');
include_once('SkiptaUserResponse.php');
include_once('SkiptaUserAddressResponse.php');
include_once('Logout.php');
include_once('LogoutResponse.php');
include_once('GetUserByEmail.php');
include_once('GetUserByEmailResponse.php');
include_once('LoginWithAuthCode.php');
include_once('LoginWithAuthCodeResponse.php');
include_once('Login.php');
include_once('LoginResponse.php');
include_once('LoginByID.php');
include_once('LoginByIDResponse.php');
include_once('LoginMobile.php');
include_once('LoginMobileResponse.php');
include_once('GetProfileLinks.php');
include_once('GetProfileLinksResponse.php');
include_once('SkiptaProfileLinkResponse.php');
include_once('SkiptaProfileLink.php');
include_once('AddProfileLink.php');
include_once('AddProfileLinkResponse.php');
include_once('EditProfileLink.php');
include_once('EditProfileLinkResponse.php');
include_once('DeleteProfileLink.php');
include_once('DeleteProfileLinkResponse.php');
include_once('GetSkiptaProfileForUser.php');
include_once('GetSkiptaProfileForUserResponse.php');
include_once('SkiptaUserProfileResponse.php');
include_once('UpdateSkiptaUserStatus.php');
include_once('UpdateSkiptaUserStatusResponse.php');
include_once('UpdateSkiptaUserProfile.php');
include_once('UpdateSkiptaUserProfileResponse.php');
include_once('NewSkiptaUserProfile.php');
include_once('NewSkiptaUserProfileResponse.php');
include_once('GetPreferencesForUser.php');
include_once('GetPreferencesForUserResponse.php');
include_once('SkiptaUserPreferenceCollectionResponse.php');
include_once('ClientSkiptaPreference.php');
include_once('GetPreferencesForUserByID.php');
include_once('GetPreferencesForUserByIDResponse.php');
include_once('UpdateUserPreferences.php');
include_once('ClientSkiptaUserPreferenceCollection.php');
include_once('UpdateUserPreferencesResponse.php');
include_once('GetMyCurrentWorld.php');
include_once('GetMyCurrentWorldResponse.php');
include_once('SkiptaWorldResponse.php');
include_once('GetAllWorlds.php');
include_once('GetAllWorldsResponse.php');
include_once('GetAllWorldsForUser.php');
include_once('GetAllWorldsForUserResponse.php');
include_once('AddUserToWorld.php');
include_once('AddUserToWorldResponse.php');
include_once('GetMessagesForUser.php');
include_once('GetMessagesForUserResponse.php');
include_once('SkiptaInboxMessagesResponse.php');
include_once('SkiptaFriendMessage.php');
include_once('FriendMessageStatus.php');
include_once('GetSentMessagesForUser.php');
include_once('GetSentMessagesForUserResponse.php');
include_once('SkiptaSentMessagesResponse.php');
include_once('GetDeletedMessagesForUser.php');
include_once('GetDeletedMessagesForUserResponse.php');
include_once('SkiptaDeletedMessagesResponse.php');
include_once('UpdateMessageStatusForUser.php');
include_once('UpdateMessageStatusForUserResponse.php');
include_once('GetMessageByID.php');
include_once('GetMessageByIDResponse.php');
include_once('SkiptaFriendMessageResponse.php');
include_once('SendMessageToUser.php');
include_once('SendMessageToUserResponse.php');
include_once('SendMessageToUserWithParentId.php');
include_once('SendMessageToUserWithParentIdResponse.php');
include_once('SendMessageToUserWithParentIdAndReturnId.php');
include_once('SendMessageToUserWithParentIdAndReturnIdResponse.php');
include_once('GetAllFriends.php');
include_once('GetAllFriendsResponse.php');
include_once('GetAllFriendsForUser.php');
include_once('GetAllFriendsForUserResponse.php');
include_once('GetAllFriendsForUserWithParams.php');
include_once('GetAllFriendsForUserWithParamsResponse.php');
include_once('GetAllFriendsForUserWithParamsAndQueryAndWorld.php');
include_once('GetAllFriendsForUserWithParamsAndQueryAndWorldResponse.php');
include_once('GetAllFriendsForUserWithParamsAndQuery.php');
include_once('GetAllFriendsForUserWithParamsAndQueryResponse.php');
include_once('GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld.php');
include_once('GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorldResponse.php');
include_once('GetAllFriendsForUserWithParamsAndQueryWithExceptionList.php');
include_once('GetAllFriendsForUserWithParamsAndQueryWithExceptionListResponse.php');
include_once('GetAllFriendsByStatus.php');
include_once('SkiptaUserRelationshipStatus.php');
include_once('GetAllFriendsByStatusResponse.php');
include_once('GetAllFriendsByStatusAndWorld.php');
include_once('GetAllFriendsByStatusAndWorldResponse.php');
include_once('GetAllPendingFriendRequests.php');
include_once('GetAllPendingFriendRequestsResponse.php');
include_once('GetAllPendingFriendRequestsForUser.php');
include_once('GetAllPendingFriendRequestsForUserResponse.php');
include_once('GetAllFriendsByStatusAndWorldWithParams.php');
include_once('GetAllFriendsByStatusAndWorldWithParamsResponse.php');
include_once('IsUserBlocked.php');
include_once('IsUserBlockedResponse.php');
include_once('CreateFriend.php');
include_once('CreateFriendResponse.php');
include_once('UpdateFriend.php');
include_once('UpdateFriendResponse.php');
include_once('UnblockFriend.php');
include_once('UnblockFriendResponse.php');
include_once('SearchForUserInWorld.php');
include_once('SearchForUserInWorldResponse.php');
include_once('SkiptaUserSearchResponse.php');
include_once('SearchForUserInWorldWithParams.php');
include_once('SearchForUserInWorldWithParamsResponse.php');
include_once('SearchForUserWithParamsAndHideList.php');
include_once('SearchForUserWithParamsAndHideListResponse.php');
include_once('SearchForUserInWorldWithParamsAndHideList.php');
include_once('SearchForUserInWorldWithParamsAndHideListResponse.php');
include_once('GetInfoForUsers.php');
include_once('GetInfoForUsersResponse.php');
include_once('GetInfoForUsersByName.php');
include_once('GetInfoForUsersByNameResponse.php');
include_once('GetInfoForUsersByNameSorted.php');
include_once('GetInfoForUsersByNameSortedResponse.php');
include_once('GetNewKey.php');
include_once('GetNewKeyResponse.php');
include_once('GetUsersInRole.php');
include_once('GetUsersInRoleResponse.php');
include_once('SkiptaWorldSecurityResponse.php');
include_once('GetTimeSlotByID.php');
include_once('GetTimeSlotByIDResponse.php');
include_once('SkiptaTimeSlotResponse.php');
include_once('GetUsersBasedOnEventAndRSVP.php');
include_once('GetUsersBasedOnEventAndRSVPResponse.php');
include_once('GetEventById.php');
include_once('GetEventByIdResponse.php');
include_once('SkiptaCalendarEventResponse.php');


/**
 * 
 */
class SkiptaWebService extends SoapClient
{

  /**
   * 
   * @var array $classmap The defined classes
   * @access private
   */
  private static $classmap = array(
    'GetOnlineFriends' => 'GetOnlineFriends',
    'ClientSkiptaSession' => 'ClientSkiptaSession',
    'GetOnlineFriendsResponse' => 'GetOnlineFriendsResponse',
    'SkiptaFriendListResponse' => 'SkiptaFriendListResponse',
    'SkiptaResponse' => 'SkiptaResponse',
    'SkiptaWorld' => 'SkiptaWorld',
    'SkiptaFriend' => 'SkiptaFriend',
    'IsGalleryNameExist' => 'IsGalleryNameExist',
    'IsGalleryNameExistResponse' => 'IsGalleryNameExistResponse',
    'SkiptaBooleanResponse' => 'SkiptaBooleanResponse',
    'IsPictureNameExistInGallery' => 'IsPictureNameExistInGallery',
    'IsPictureNameExistInGalleryResponse' => 'IsPictureNameExistInGalleryResponse',
    'AddProfileLinkToTheCurrentUser' => 'AddProfileLinkToTheCurrentUser',
    'AddProfileLinkToTheCurrentUserResponse' => 'AddProfileLinkToTheCurrentUserResponse',
    'AddCurrentUserFile' => 'AddCurrentUserFile',
    'ClientSkiptaUserFile' => 'ClientSkiptaUserFile',
    'AddCurrentUserFileResponse' => 'AddCurrentUserFileResponse',
    'SkiptaUserFileResponse' => 'SkiptaUserFileResponse',
    'IsUserFriendOrNotInWorld' => 'IsUserFriendOrNotInWorld',
    'IsUserFriendOrNotInWorldResponse' => 'IsUserFriendOrNotInWorldResponse',
    'ActivateAllUsers' => 'ActivateAllUsers',
    'ActivateAllUsersResponse' => 'ActivateAllUsersResponse',
    'UpdateTheme' => 'UpdateTheme',
    'UpdateThemeResponse' => 'UpdateThemeResponse',
    'GetAllWorldsByUserId' => 'GetAllWorldsByUserId',
    'GetAllWorldsByUserIdResponse' => 'GetAllWorldsByUserIdResponse',
    'SkiptaWorldCollectionResponse' => 'SkiptaWorldCollectionResponse',
    'ClientSkiptaWorld' => 'ClientSkiptaWorld',
    'UpdateMenuItemDisplayName' => 'UpdateMenuItemDisplayName',
    'UpdateMenuItemDisplayNameResponse' => 'UpdateMenuItemDisplayNameResponse',
    'UpdateToolsMenuItemDisplayName' => 'UpdateToolsMenuItemDisplayName',
    'UpdateToolsMenuItemDisplayNameResponse' => 'UpdateToolsMenuItemDisplayNameResponse',
    'UpdateResourceMenuItemDisplayName' => 'UpdateResourceMenuItemDisplayName',
    'UpdateResourceMenuItemDisplayNameResponse' => 'UpdateResourceMenuItemDisplayNameResponse',
    'GetMenusByGroupMenu' => 'GetMenusByGroupMenu',
    'GetMenusByGroupMenuResponse' => 'GetMenusByGroupMenuResponse',
    'SkiptaMenusByGroupMenuResponse' => 'SkiptaMenusByGroupMenuResponse',
    'menuLabels' => 'menuLabels',
    'FollowABroadcast' => 'FollowABroadcast',
    'FollowABroadcastResponse' => 'FollowABroadcastResponse',
    'UnFollowABroadcast' => 'UnFollowABroadcast',
    'UnFollowABroadcastResponse' => 'UnFollowABroadcastResponse',
    'GetTopBroadcastsFromWorldByHashtag' => 'GetTopBroadcastsFromWorldByHashtag',
    'GetTopBroadcastsFromWorldByHashtagResponse' => 'GetTopBroadcastsFromWorldByHashtagResponse',
    'SkiptaFriendBroadcastCollection' => 'SkiptaFriendBroadcastCollection',
    'SkiptaFriendBroadcast' => 'SkiptaFriendBroadcast',
    'SkiptaFriendBroadcastCommentCollection' => 'SkiptaFriendBroadcastCommentCollection',
    'SkiptaFriendBroadcastComment' => 'SkiptaFriendBroadcastComment',
    'SkiptaPostFileInfomation' => 'SkiptaPostFileInfomation',
    'GetActionWeightageByNameAndWorld' => 'GetActionWeightageByNameAndWorld',
    'GetActionWeightageByNameAndWorldResponse' => 'GetActionWeightageByNameAndWorldResponse',
    'GetMyFriendTopBroadcastsFromWorld' => 'GetMyFriendTopBroadcastsFromWorld',
    'GetMyFriendTopBroadcastsFromWorldResponse' => 'GetMyFriendTopBroadcastsFromWorldResponse',
    'RegisterUser' => 'RegisterUser',
    'ClientSkiptaUser' => 'ClientSkiptaUser',
    'ClientSkiptaUserAddress' => 'ClientSkiptaUserAddress',
    'KeyValue' => 'KeyValue',
    'RegisterUserResponse' => 'RegisterUserResponse',
    'SkiptaNewUserResponse' => 'SkiptaNewUserResponse',
    'GetWorldWiseNoOfUsers' => 'GetWorldWiseNoOfUsers',
    'GetWorldWiseNoOfUsersResponse' => 'GetWorldWiseNoOfUsersResponse',
    'SkiptaWorldWiseNoOfUsersResponse' => 'SkiptaWorldWiseNoOfUsersResponse',
    'SkiptaWorldWithNoOfUsers' => 'SkiptaWorldWithNoOfUsers',
    'RegisterUserForUN' => 'RegisterUserForUN',
    'RegisterUserForUNResponse' => 'RegisterUserForUNResponse',
    'AddUserToWorldUN' => 'AddUserToWorldUN',
    'AddUserToWorldUNResponse' => 'AddUserToWorldUNResponse',
    'UpdateUserCountry' => 'UpdateUserCountry',
    'UpdateUserCountryResponse' => 'UpdateUserCountryResponse',
    'IsUserAliveForSendingChatMessage' => 'IsUserAliveForSendingChatMessage',
    'IsUserAliveForSendingChatMessageResponse' => 'IsUserAliveForSendingChatMessageResponse',
    'GetJobsForAWorld' => 'GetJobsForAWorld',
    'GetJobsForAWorldResponse' => 'GetJobsForAWorldResponse',
    'AddTimeSlotToEvent' => 'AddTimeSlotToEvent',
    'ClientSkiptaCalendarEventTimeSlot' => 'ClientSkiptaCalendarEventTimeSlot',
    'AddTimeSlotToEventResponse' => 'AddTimeSlotToEventResponse',
    'UpdateTimeSlot' => 'UpdateTimeSlot',
    'UpdateTimeSlotResponse' => 'UpdateTimeSlotResponse',
    'DeleteTimeSlot' => 'DeleteTimeSlot',
    'DeleteTimeSlotResponse' => 'DeleteTimeSlotResponse',
    'AddEvent' => 'AddEvent',
    'ClientSkiptaCalendarEvent' => 'ClientSkiptaCalendarEvent',
    'AddEventResponse' => 'AddEventResponse',
    'UpdateEvent' => 'UpdateEvent',
    'UpdateEventResponse' => 'UpdateEventResponse',
    'DeleteEvent' => 'DeleteEvent',
    'DeleteEventResponse' => 'DeleteEventResponse',
    'AddEventInvite' => 'AddEventInvite',
    'ClientSkiptaCalendarEventInvite' => 'ClientSkiptaCalendarEventInvite',
    'AddEventInviteResponse' => 'AddEventInviteResponse',
    'HasEventInvitePending' => 'HasEventInvitePending',
    'HasEventInvitePendingResponse' => 'HasEventInvitePendingResponse',
    'UpdateEventInvite' => 'UpdateEventInvite',
    'UpdateEventInviteResponse' => 'UpdateEventInviteResponse',
    'DeleteEventInvite' => 'DeleteEventInvite',
    'DeleteEventInviteResponse' => 'DeleteEventInviteResponse',
    'GetMyCreatedEvents' => 'GetMyCreatedEvents',
    'GetMyCreatedEventsResponse' => 'GetMyCreatedEventsResponse',
    'SkiptaUserCalendarResponse' => 'SkiptaUserCalendarResponse',
    'GetEventsForUserByRSVP' => 'GetEventsForUserByRSVP',
    'GetEventsForUserByRSVPResponse' => 'GetEventsForUserByRSVPResponse',
    'GetPersonalEventsForUserByRSVP' => 'GetPersonalEventsForUserByRSVP',
    'GetPersonalEventsForUserByRSVPResponse' => 'GetPersonalEventsForUserByRSVPResponse',
    'AddUserFile' => 'AddUserFile',
    'AddUserFileResponse' => 'AddUserFileResponse',
    'GetFilesForUser' => 'GetFilesForUser',
    'GetFilesForUserResponse' => 'GetFilesForUserResponse',
    'UpdateUserFile' => 'UpdateUserFile',
    'UpdateUserFileResponse' => 'UpdateUserFileResponse',
    'DeleteUserFile' => 'DeleteUserFile',
    'DeleteUserFileResponse' => 'DeleteUserFileResponse',
    'SwapWidgets' => 'SwapWidgets',
    'SwapWidgetsResponse' => 'SwapWidgetsResponse',
    'AddWidgetToUser' => 'AddWidgetToUser',
    'AddWidgetToUserResponse' => 'AddWidgetToUserResponse',
    'SkiptaGuidResponse' => 'SkiptaGuidResponse',
    'RemoveWidgetFromUser' => 'RemoveWidgetFromUser',
    'RemoveWidgetFromUserResponse' => 'RemoveWidgetFromUserResponse',
    'AddGallery' => 'AddGallery',
    'ClientSkiptaUserGallery' => 'ClientSkiptaUserGallery',
    'AddGalleryResponse' => 'AddGalleryResponse',
    'SkiptaUserGalleryResponse' => 'SkiptaUserGalleryResponse',
    'AddItemToGallery' => 'AddItemToGallery',
    'ClientSkiptaUserGalleryItem' => 'ClientSkiptaUserGalleryItem',
    'AddItemToGalleryResponse' => 'AddItemToGalleryResponse',
    'SkiptaUserGalleryItemResponse' => 'SkiptaUserGalleryItemResponse',
    'AddVideoItemToGallery' => 'AddVideoItemToGallery',
    'AddVideoItemToGalleryResponse' => 'AddVideoItemToGalleryResponse',
    'EditItemInGallery' => 'EditItemInGallery',
    'EditItemInGalleryResponse' => 'EditItemInGalleryResponse',
    'DeleteItemInGallery' => 'DeleteItemInGallery',
    'DeleteItemInGalleryResponse' => 'DeleteItemInGalleryResponse',
    'GetUserGallery' => 'GetUserGallery',
    'GetUserGalleryResponse' => 'GetUserGalleryResponse',
    'SkiptaUserGalleryCollectionResponse' => 'SkiptaUserGalleryCollectionResponse',
    'GetUserVideoGallery' => 'GetUserVideoGallery',
    'GetUserVideoGalleryResponse' => 'GetUserVideoGalleryResponse',
    'GetUserImageAndVideoGallery' => 'GetUserImageAndVideoGallery',
    'GetUserImageAndVideoGalleryResponse' => 'GetUserImageAndVideoGalleryResponse',
    'UpdateUserGallery' => 'UpdateUserGallery',
    'UpdateUserGalleryResponse' => 'UpdateUserGalleryResponse',
    'DeleteUserGallery' => 'DeleteUserGallery',
    'DeleteUserGalleryResponse' => 'DeleteUserGalleryResponse',
    'GetFriendBroadcastById' => 'GetFriendBroadcastById',
    'GetFriendBroadcastByIdResponse' => 'GetFriendBroadcastByIdResponse',
    'GetFriendBroadcasts' => 'GetFriendBroadcasts',
    'GetFriendBroadcastsResponse' => 'GetFriendBroadcastsResponse',
    'GetBroadcastsForUser' => 'GetBroadcastsForUser',
    'GetBroadcastsForUserResponse' => 'GetBroadcastsForUserResponse',
    'GetMyBroadcasts' => 'GetMyBroadcasts',
    'GetMyBroadcastsResponse' => 'GetMyBroadcastsResponse',
    'GetTopBroadcastsFromWorld' => 'GetTopBroadcastsFromWorld',
    'GetTopBroadcastsFromWorldResponse' => 'GetTopBroadcastsFromWorldResponse',
    'GetTopBroadcasts' => 'GetTopBroadcasts',
    'GetTopBroadcastsResponse' => 'GetTopBroadcastsResponse',
    'GetAllBroadcasts' => 'GetAllBroadcasts',
    'GetAllBroadcastsResponse' => 'GetAllBroadcastsResponse',
    'NewFriendBroadcast' => 'NewFriendBroadcast',
    'NewFriendBroadcastResponse' => 'NewFriendBroadcastResponse',
    'DeleteFriendBroadcast' => 'DeleteFriendBroadcast',
    'DeleteFriendBroadcastResponse' => 'DeleteFriendBroadcastResponse',
    'NewFriendBroadcastComment' => 'NewFriendBroadcastComment',
    'NewFriendBroadcastCommentResponse' => 'NewFriendBroadcastCommentResponse',
    'NewFriendBroadcastCommentAndReturnCommentId' => 'NewFriendBroadcastCommentAndReturnCommentId',
    'NewFriendBroadcastCommentAndReturnCommentIdResponse' => 'NewFriendBroadcastCommentAndReturnCommentIdResponse',
    'DeleteFriendBroadcastCommentById' => 'DeleteFriendBroadcastCommentById',
    'DeleteFriendBroadcastCommentByIdResponse' => 'DeleteFriendBroadcastCommentByIdResponse',
    'UpdateFriendBroadcastCommentById' => 'UpdateFriendBroadcastCommentById',
    'UpdateFriendBroadcastCommentByIdResponse' => 'UpdateFriendBroadcastCommentByIdResponse',
    'LoadRecommendedFriendsForWorld' => 'LoadRecommendedFriendsForWorld',
    'LoadRecommendedFriendsForWorldResponse' => 'LoadRecommendedFriendsForWorldResponse',
    'SkiptaUserCollectionResponse' => 'SkiptaUserCollectionResponse',
    'LoadSkiptaRecommendedFriends' => 'LoadSkiptaRecommendedFriends',
    'LoadSkiptaRecommendedFriendsResponse' => 'LoadSkiptaRecommendedFriendsResponse',
    'RemoveUserOAuthByService' => 'RemoveUserOAuthByService',
    'RemoveUserOAuthByServiceResponse' => 'RemoveUserOAuthByServiceResponse',
    'GetUserOAuthByService' => 'GetUserOAuthByService',
    'GetUserOAuthByServiceResponse' => 'GetUserOAuthByServiceResponse',
    'SkiptaUserOAuth' => 'SkiptaUserOAuth',
    'SaveUserOAuth' => 'SaveUserOAuth',
    'SaveUserOAuthResponse' => 'SaveUserOAuthResponse',
    'AddWorldLinkToCategory' => 'AddWorldLinkToCategory',
    'SkiptaWorldLink' => 'SkiptaWorldLink',
    'AddWorldLinkToCategoryResponse' => 'AddWorldLinkToCategoryResponse',
    'AddWorldLinkCategory' => 'AddWorldLinkCategory',
    'SkiptaWorldLinkCategory' => 'SkiptaWorldLinkCategory',
    'AddWorldLinkCategoryResponse' => 'AddWorldLinkCategoryResponse',
    'GetWorldLinksByCategory' => 'GetWorldLinksByCategory',
    'GetWorldLinksByCategoryResponse' => 'GetWorldLinksByCategoryResponse',
    'GetWorldLinkCategories' => 'GetWorldLinkCategories',
    'GetWorldLinkCategoriesResponse' => 'GetWorldLinkCategoriesResponse',
    'GetAllWorldLinks' => 'GetAllWorldLinks',
    'GetAllWorldLinksResponse' => 'GetAllWorldLinksResponse',
    'GetPopularWorldLinks' => 'GetPopularWorldLinks',
    'GetPopularWorldLinksResponse' => 'GetPopularWorldLinksResponse',
    'GetSuggestedWorldLinks' => 'GetSuggestedWorldLinks',
    'GetSuggestedWorldLinksResponse' => 'GetSuggestedWorldLinksResponse',
    'GetWidgetWorldLinks' => 'GetWidgetWorldLinks',
    'GetWidgetWorldLinksResponse' => 'GetWidgetWorldLinksResponse',
    'GetCategoryWorldLinks' => 'GetCategoryWorldLinks',
    'GetCategoryWorldLinksResponse' => 'GetCategoryWorldLinksResponse',
    'SkiptaGlobalSearch' => 'SkiptaGlobalSearch',
    'SkiptaGlobalSearch' => 'SkiptaGlobalSearch',
    'SkiptaGlobalSearchResponse' => 'SkiptaGlobalSearchResponse',
    'SkiptaUserGlobalSearchResponse' => 'SkiptaUserGlobalSearchResponse',
    'SkiptaGlobalSearchResult' => 'SkiptaGlobalSearchResult',
    'SkiptaGlobalSearchResultSource' => 'SkiptaGlobalSearchResultSource',
    'GetRatedUsersForPost' => 'GetRatedUsersForPost',
    'SkiptaPostRating' => 'SkiptaPostRating',
    'GetRatedUsersForPostResponse' => 'GetRatedUsersForPostResponse',
    'SkiptaUserRatingResponse' => 'SkiptaUserRatingResponse',
    'SkiptaNewsFeedComment' => 'SkiptaNewsFeedComment',
    'SetUserRatingForPost' => 'SetUserRatingForPost',
    'SetUserRatingForPostResponse' => 'SetUserRatingForPostResponse',
    'GetSkiptaWorlds' => 'GetSkiptaWorlds',
    'SkiptaNewsRating' => 'SkiptaNewsRating',
    'SkiptaNewsFeedSetting' => 'SkiptaNewsFeedSetting',
    'SkiptaNewsFeedItem' => 'SkiptaNewsFeedItem',
    'GetSkiptaWorldsResponse' => 'GetSkiptaWorldsResponse',
    'SkiptaNewsFeedResponse' => 'SkiptaNewsFeedResponse',
    'SkiptaOption' => 'SkiptaOption',
    'SkiptaNewsFeedAggregate' => 'SkiptaNewsFeedAggregate',
    'GetWorldNewsFeedSettings' => 'GetWorldNewsFeedSettings',
    'GetWorldNewsFeedSettingsResponse' => 'GetWorldNewsFeedSettingsResponse',
    'SaveWorldNewsFeedConfiguration' => 'SaveWorldNewsFeedConfiguration',
    'SaveWorldNewsFeedConfigurationResponse' => 'SaveWorldNewsFeedConfigurationResponse',
    'GetWorldNews' => 'GetWorldNews',
    'GetWorldNewsResponse' => 'GetWorldNewsResponse',
    'GetTopNews' => 'GetTopNews',
    'GetTopNewsResponse' => 'GetTopNewsResponse',
    'GetWorldFeedAggregate' => 'GetWorldFeedAggregate',
    'GetWorldFeedAggregateResponse' => 'GetWorldFeedAggregateResponse',
    'SetCommentForNews' => 'SetCommentForNews',
    'SetCommentForNewsResponse' => 'SetCommentForNewsResponse',
    'fetchCommentForNews' => 'fetchCommentForNews',
    'fetchCommentForNewsResponse' => 'fetchCommentForNewsResponse',
    'SetUserRatingForNews' => 'SetUserRatingForNews',
    'SetUserRatingForNewsResponse' => 'SetUserRatingForNewsResponse',
    'GetRatedUsersForNews' => 'GetRatedUsersForNews',
    'GetRatedUsersForNewsResponse' => 'GetRatedUsersForNewsResponse',
    'GetFriendPostsCount' => 'GetFriendPostsCount',
    'SkiptaFriendPost' => 'SkiptaFriendPost',
    'GetFriendPostsCountResponse' => 'GetFriendPostsCountResponse',
    'GetFriendPosts' => 'GetFriendPosts',
    'GetFriendPostsResponse' => 'GetFriendPostsResponse',
    'GetWorldMenus' => 'GetWorldMenus',
    'GetWorldMenusResponse' => 'GetWorldMenusResponse',
    'SkiptaWorldMenusResponse' => 'SkiptaWorldMenusResponse',
    'menus' => 'menus',
    'GetTopBroadcastsFromWorldForWidget' => 'GetTopBroadcastsFromWorldForWidget',
    'GetTopBroadcastsFromWorldForWidgetResponse' => 'GetTopBroadcastsFromWorldForWidgetResponse',
    'GetAllLinksByCategoryWise' => 'GetAllLinksByCategoryWise',
    'GetAllLinksByCategoryWiseResponse' => 'GetAllLinksByCategoryWiseResponse',
    'GetTopNewMembers' => 'GetTopNewMembers',
    'GetTopNewMembersResponse' => 'GetTopNewMembersResponse',
    'SkiptaNewMembersResponse' => 'SkiptaNewMembersResponse',
    'newMembers' => 'newMembers',
    'GetMoreNewMembers' => 'GetMoreNewMembers',
    'GetMoreNewMembersResponse' => 'GetMoreNewMembersResponse',
    'SkiptaMoreNewMembersResponse' => 'SkiptaMoreNewMembersResponse',
    'moreNewMembers' => 'moreNewMembers',
    'GetUserInfo' => 'GetUserInfo',
    'GetUserInfoResponse' => 'GetUserInfoResponse',
    'SkiptaUserInformationResponse' => 'SkiptaUserInformationResponse',
    'userinformation' => 'userinformation',
    'GetWidgetLinksByCategoryWise' => 'GetWidgetLinksByCategoryWise',
    'GetWidgetLinksByCategoryWiseResponse' => 'GetWidgetLinksByCategoryWiseResponse',
    'GetWidgetMoreLinksByCategoryWise' => 'GetWidgetMoreLinksByCategoryWise',
    'GetWidgetMoreLinksByCategoryWiseResponse' => 'GetWidgetMoreLinksByCategoryWiseResponse',
    'GetFriendRecommendations' => 'GetFriendRecommendations',
    'GetFriendRecommendationsResponse' => 'GetFriendRecommendationsResponse',
    'SkiptaFriendRecommendationResponse' => 'SkiptaFriendRecommendationResponse',
    'friendrecommendation' => 'friendrecommendation',
    'GetMoreFriendRecommendations' => 'GetMoreFriendRecommendations',
    'GetMoreFriendRecommendationsResponse' => 'GetMoreFriendRecommendationsResponse',
    'SkiptaMoreFriendRecommendationResponse' => 'SkiptaMoreFriendRecommendationResponse',
    'friendmorerecommendation' => 'friendmorerecommendation',
    'UpdateUserPhoneForUserId' => 'UpdateUserPhoneForUserId',
    'UpdateUserPhoneForUserIdResponse' => 'UpdateUserPhoneForUserIdResponse',
    'UpdateUserPhone' => 'UpdateUserPhone',
    'UpdateUserPhoneResponse' => 'UpdateUserPhoneResponse',
    'UpdateUserNameForUserId' => 'UpdateUserNameForUserId',
    'UpdateUserNameForUserIdResponse' => 'UpdateUserNameForUserIdResponse',
    'UpdateUserName' => 'UpdateUserName',
    'UpdateUserNameResponse' => 'UpdateUserNameResponse',
    'UpdateUserEmailForUserId' => 'UpdateUserEmailForUserId',
    'UpdateUserEmailForUserIdResponse' => 'UpdateUserEmailForUserIdResponse',
    'UpdateUserEmail' => 'UpdateUserEmail',
    'UpdateUserEmailResponse' => 'UpdateUserEmailResponse',
    'UpdateUserAddress' => 'UpdateUserAddress',
    'UpdateUserAddressResponse' => 'UpdateUserAddressResponse',
    'GetUserAddressCollection' => 'GetUserAddressCollection',
    'GetUserAddressCollectionResponse' => 'GetUserAddressCollectionResponse',
    'SkiptaUserAddressCollectionResponse' => 'SkiptaUserAddressCollectionResponse',
    'UpdateUserWidgetState' => 'UpdateUserWidgetState',
    'UpdateUserWidgetStateResponse' => 'UpdateUserWidgetStateResponse',
    'EmailIsUnique' => 'EmailIsUnique',
    'EmailIsUniqueResponse' => 'EmailIsUniqueResponse',
    'AddNewUser' => 'AddNewUser',
    'AddNewUserResponse' => 'AddNewUserResponse',
    'ChangeUserPassword' => 'ChangeUserPassword',
    'ChangeUserPasswordResponse' => 'ChangeUserPasswordResponse',
    'ChangeUserPasswordWithEncryptedOld' => 'ChangeUserPasswordWithEncryptedOld',
    'ChangeUserPasswordWithEncryptedOldResponse' => 'ChangeUserPasswordWithEncryptedOldResponse',
    'ActivateUser' => 'ActivateUser',
    'ActivateUserResponse' => 'ActivateUserResponse',
    'IsValidUser' => 'IsValidUser',
    'IsValidUserResponse' => 'IsValidUserResponse',
    'GetUserId' => 'GetUserId',
    'GetUserIdResponse' => 'GetUserIdResponse',
    'UpdateUserSession' => 'UpdateUserSession',
    'UpdateUserSessionResponse' => 'UpdateUserSessionResponse',
    'SkiptaUserSessionResponse' => 'SkiptaUserSessionResponse',
    'IsUserAlive' => 'IsUserAlive',
    'IsUserAliveResponse' => 'IsUserAliveResponse',
    'IsUserLogedIn' => 'IsUserLogedIn',
    'IsUserLogedInResponse' => 'IsUserLogedInResponse',
    'GetUserSessionExpiration' => 'GetUserSessionExpiration',
    'GetUserSessionExpirationResponse' => 'GetUserSessionExpirationResponse',
    'SkiptaDateTimeResponse' => 'SkiptaDateTimeResponse',
    'GetUserById' => 'GetUserById',
    'GetUserByIdResponse' => 'GetUserByIdResponse',
    'SkiptaClientUserResponse' => 'SkiptaClientUserResponse',
    'GetUserBySession' => 'GetUserBySession',
    'GetUserBySessionResponse' => 'GetUserBySessionResponse',
    'SkiptaUserResponse' => 'SkiptaUserResponse',
    'SkiptaUserAddressResponse' => 'SkiptaUserAddressResponse',
    'Logout' => 'Logout',
    'LogoutResponse' => 'LogoutResponse',
    'GetUserByEmail' => 'GetUserByEmail',
    'GetUserByEmailResponse' => 'GetUserByEmailResponse',
    'LoginWithAuthCode' => 'LoginWithAuthCode',
    'LoginWithAuthCodeResponse' => 'LoginWithAuthCodeResponse',
    'Login' => 'Login',
    'LoginResponse' => 'LoginResponse',
    'LoginByID' => 'LoginByID',
    'LoginByIDResponse' => 'LoginByIDResponse',
    'LoginMobile' => 'LoginMobile',
    'LoginMobileResponse' => 'LoginMobileResponse',
    'GetProfileLinks' => 'GetProfileLinks',
    'GetProfileLinksResponse' => 'GetProfileLinksResponse',
    'SkiptaProfileLinkResponse' => 'SkiptaProfileLinkResponse',
    'SkiptaProfileLink' => 'SkiptaProfileLink',
    'AddProfileLink' => 'AddProfileLink',
    'AddProfileLinkResponse' => 'AddProfileLinkResponse',
    'EditProfileLink' => 'EditProfileLink',
    'EditProfileLinkResponse' => 'EditProfileLinkResponse',
    'DeleteProfileLink' => 'DeleteProfileLink',
    'DeleteProfileLinkResponse' => 'DeleteProfileLinkResponse',
    'GetSkiptaProfileForUser' => 'GetSkiptaProfileForUser',
    'GetSkiptaProfileForUserResponse' => 'GetSkiptaProfileForUserResponse',
    'SkiptaUserProfileResponse' => 'SkiptaUserProfileResponse',
    'UpdateSkiptaUserStatus' => 'UpdateSkiptaUserStatus',
    'UpdateSkiptaUserStatusResponse' => 'UpdateSkiptaUserStatusResponse',
    'UpdateSkiptaUserProfile' => 'UpdateSkiptaUserProfile',
    'UpdateSkiptaUserProfileResponse' => 'UpdateSkiptaUserProfileResponse',
    'NewSkiptaUserProfile' => 'NewSkiptaUserProfile',
    'NewSkiptaUserProfileResponse' => 'NewSkiptaUserProfileResponse',
    'GetPreferencesForUser' => 'GetPreferencesForUser',
    'GetPreferencesForUserResponse' => 'GetPreferencesForUserResponse',
    'SkiptaUserPreferenceCollectionResponse' => 'SkiptaUserPreferenceCollectionResponse',
    'ClientSkiptaPreference' => 'ClientSkiptaPreference',
    'GetPreferencesForUserByID' => 'GetPreferencesForUserByID',
    'GetPreferencesForUserByIDResponse' => 'GetPreferencesForUserByIDResponse',
    'UpdateUserPreferences' => 'UpdateUserPreferences',
    'ClientSkiptaUserPreferenceCollection' => 'ClientSkiptaUserPreferenceCollection',
    'UpdateUserPreferencesResponse' => 'UpdateUserPreferencesResponse',
    'GetMyCurrentWorld' => 'GetMyCurrentWorld',
    'GetMyCurrentWorldResponse' => 'GetMyCurrentWorldResponse',
    'SkiptaWorldResponse' => 'SkiptaWorldResponse',
    'GetAllWorlds' => 'GetAllWorlds',
    'GetAllWorldsResponse' => 'GetAllWorldsResponse',
    'GetAllWorldsForUser' => 'GetAllWorldsForUser',
    'GetAllWorldsForUserResponse' => 'GetAllWorldsForUserResponse',
    'AddUserToWorld' => 'AddUserToWorld',
    'AddUserToWorldResponse' => 'AddUserToWorldResponse',
    'GetMessagesForUser' => 'GetMessagesForUser',
    'GetMessagesForUserResponse' => 'GetMessagesForUserResponse',
    'SkiptaInboxMessagesResponse' => 'SkiptaInboxMessagesResponse',
    'SkiptaFriendMessage' => 'SkiptaFriendMessage',
    'GetSentMessagesForUser' => 'GetSentMessagesForUser',
    'GetSentMessagesForUserResponse' => 'GetSentMessagesForUserResponse',
    'SkiptaSentMessagesResponse' => 'SkiptaSentMessagesResponse',
    'GetDeletedMessagesForUser' => 'GetDeletedMessagesForUser',
    'GetDeletedMessagesForUserResponse' => 'GetDeletedMessagesForUserResponse',
    'SkiptaDeletedMessagesResponse' => 'SkiptaDeletedMessagesResponse',
    'UpdateMessageStatusForUser' => 'UpdateMessageStatusForUser',
    'UpdateMessageStatusForUserResponse' => 'UpdateMessageStatusForUserResponse',
    'GetMessageByID' => 'GetMessageByID',
    'GetMessageByIDResponse' => 'GetMessageByIDResponse',
    'SkiptaFriendMessageResponse' => 'SkiptaFriendMessageResponse',
    'SendMessageToUser' => 'SendMessageToUser',
    'SendMessageToUserResponse' => 'SendMessageToUserResponse',
    'SendMessageToUserWithParentId' => 'SendMessageToUserWithParentId',
    'SendMessageToUserWithParentIdResponse' => 'SendMessageToUserWithParentIdResponse',
    'SendMessageToUserWithParentIdAndReturnId' => 'SendMessageToUserWithParentIdAndReturnId',
    'SendMessageToUserWithParentIdAndReturnIdResponse' => 'SendMessageToUserWithParentIdAndReturnIdResponse',
    'GetAllFriends' => 'GetAllFriends',
    'GetAllFriendsResponse' => 'GetAllFriendsResponse',
    'GetAllFriendsForUser' => 'GetAllFriendsForUser',
    'GetAllFriendsForUserResponse' => 'GetAllFriendsForUserResponse',
    'GetAllFriendsForUserWithParams' => 'GetAllFriendsForUserWithParams',
    'GetAllFriendsForUserWithParamsResponse' => 'GetAllFriendsForUserWithParamsResponse',
    'GetAllFriendsForUserWithParamsAndQueryAndWorld' => 'GetAllFriendsForUserWithParamsAndQueryAndWorld',
    'GetAllFriendsForUserWithParamsAndQueryAndWorldResponse' => 'GetAllFriendsForUserWithParamsAndQueryAndWorldResponse',
    'GetAllFriendsForUserWithParamsAndQuery' => 'GetAllFriendsForUserWithParamsAndQuery',
    'GetAllFriendsForUserWithParamsAndQueryResponse' => 'GetAllFriendsForUserWithParamsAndQueryResponse',
    'GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld' => 'GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld',
    'GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorldResponse' => 'GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorldResponse',
    'GetAllFriendsForUserWithParamsAndQueryWithExceptionList' => 'GetAllFriendsForUserWithParamsAndQueryWithExceptionList',
    'GetAllFriendsForUserWithParamsAndQueryWithExceptionListResponse' => 'GetAllFriendsForUserWithParamsAndQueryWithExceptionListResponse',
    'GetAllFriendsByStatus' => 'GetAllFriendsByStatus',
    'GetAllFriendsByStatusResponse' => 'GetAllFriendsByStatusResponse',
    'GetAllFriendsByStatusAndWorld' => 'GetAllFriendsByStatusAndWorld',
    'GetAllFriendsByStatusAndWorldResponse' => 'GetAllFriendsByStatusAndWorldResponse',
    'GetAllPendingFriendRequests' => 'GetAllPendingFriendRequests',
    'GetAllPendingFriendRequestsResponse' => 'GetAllPendingFriendRequestsResponse',
    'GetAllPendingFriendRequestsForUser' => 'GetAllPendingFriendRequestsForUser',
    'GetAllPendingFriendRequestsForUserResponse' => 'GetAllPendingFriendRequestsForUserResponse',
    'GetAllFriendsByStatusAndWorldWithParams' => 'GetAllFriendsByStatusAndWorldWithParams',
    'GetAllFriendsByStatusAndWorldWithParamsResponse' => 'GetAllFriendsByStatusAndWorldWithParamsResponse',
    'IsUserBlocked' => 'IsUserBlocked',
    'IsUserBlockedResponse' => 'IsUserBlockedResponse',
    'CreateFriend' => 'CreateFriend',
    'CreateFriendResponse' => 'CreateFriendResponse',
    'UpdateFriend' => 'UpdateFriend',
    'UpdateFriendResponse' => 'UpdateFriendResponse',
    'UnblockFriend' => 'UnblockFriend',
    'UnblockFriendResponse' => 'UnblockFriendResponse',
    'SearchForUserInWorld' => 'SearchForUserInWorld',
    'SearchForUserInWorldResponse' => 'SearchForUserInWorldResponse',
    'SkiptaUserSearchResponse' => 'SkiptaUserSearchResponse',
    'SearchForUserInWorldWithParams' => 'SearchForUserInWorldWithParams',
    'SearchForUserInWorldWithParamsResponse' => 'SearchForUserInWorldWithParamsResponse',
    'SearchForUserWithParamsAndHideList' => 'SearchForUserWithParamsAndHideList',
    'SearchForUserWithParamsAndHideListResponse' => 'SearchForUserWithParamsAndHideListResponse',
    'SearchForUserInWorldWithParamsAndHideList' => 'SearchForUserInWorldWithParamsAndHideList',
    'SearchForUserInWorldWithParamsAndHideListResponse' => 'SearchForUserInWorldWithParamsAndHideListResponse',
    'GetInfoForUsers' => 'GetInfoForUsers',
    'GetInfoForUsersResponse' => 'GetInfoForUsersResponse',
    'GetInfoForUsersByName' => 'GetInfoForUsersByName',
    'GetInfoForUsersByNameResponse' => 'GetInfoForUsersByNameResponse',
    'GetInfoForUsersByNameSorted' => 'GetInfoForUsersByNameSorted',
    'GetInfoForUsersByNameSortedResponse' => 'GetInfoForUsersByNameSortedResponse',
    'GetNewKey' => 'GetNewKey',
    'GetNewKeyResponse' => 'GetNewKeyResponse',
    'GetUsersInRole' => 'GetUsersInRole',
    'GetUsersInRoleResponse' => 'GetUsersInRoleResponse',
    'SkiptaWorldSecurityResponse' => 'SkiptaWorldSecurityResponse',
    'GetTimeSlotByID' => 'GetTimeSlotByID',
    'GetTimeSlotByIDResponse' => 'GetTimeSlotByIDResponse',
    'SkiptaTimeSlotResponse' => 'SkiptaTimeSlotResponse',
    'GetUsersBasedOnEventAndRSVP' => 'GetUsersBasedOnEventAndRSVP',
    'GetUsersBasedOnEventAndRSVPResponse' => 'GetUsersBasedOnEventAndRSVPResponse',
    'GetEventById' => 'GetEventById',
    'GetEventByIdResponse' => 'GetEventByIdResponse',
    'SkiptaCalendarEventResponse' => 'SkiptaCalendarEventResponse');

  /**
   * 
   * @param array $config A array of config values
   * @param string $wsdl The wsdl file to use
   * @access public
   */
  public function __construct(array $options = array(), $wsdl = 'http://skiptaengine.skipta.com/SkiptaWebService.asmx?WSDL')
  {
    foreach(self::$classmap as $key => $value)
    {
      if(!isset($options['classmap'][$key]))
      {
        $options['classmap'][$key] = $value;
      }
    }
    
    parent::__construct($wsdl, $options);
  }

  /**
   * 
   * @param GetOnlineFriends $parameters
   * @access public
   */
  public function GetOnlineFriends(GetOnlineFriends $parameters)
  {
    return $this->__soapCall('GetOnlineFriends', array($parameters));
  }

  /**
   * 
   * @param IsGalleryNameExist $parameters
   * @access public
   */
  public function IsGalleryNameExist(IsGalleryNameExist $parameters)
  {
    return $this->__soapCall('IsGalleryNameExist', array($parameters));
  }

  /**
   * 
   * @param IsPictureNameExistInGallery $parameters
   * @access public
   */
  public function IsPictureNameExistInGallery(IsPictureNameExistInGallery $parameters)
  {
    return $this->__soapCall('IsPictureNameExistInGallery', array($parameters));
  }

  /**
   * 
   * @param AddProfileLinkToTheCurrentUser $parameters
   * @access public
   */
  public function AddProfileLinkToTheCurrentUser(AddProfileLinkToTheCurrentUser $parameters)
  {
    return $this->__soapCall('AddProfileLinkToTheCurrentUser', array($parameters));
  }

  /**
   * 
   * @param AddCurrentUserFile $parameters
   * @access public
   */
  public function AddCurrentUserFile(AddCurrentUserFile $parameters)
  {
    return $this->__soapCall('AddCurrentUserFile', array($parameters));
  }

  /**
   * 
   * @param IsUserFriendOrNotInWorld $parameters
   * @access public
   */
  public function IsUserFriendOrNotInWorld(IsUserFriendOrNotInWorld $parameters)
  {
    return $this->__soapCall('IsUserFriendOrNotInWorld', array($parameters));
  }

  /**
   * 
   * @param ActivateAllUsers $parameters
   * @access public
   */
  public function ActivateAllUsers(ActivateAllUsers $parameters)
  {
    return $this->__soapCall('ActivateAllUsers', array($parameters));
  }

  /**
   * 
   * @param UpdateTheme $parameters
   * @access public
   */
  public function UpdateTheme(UpdateTheme $parameters)
  {
    return $this->__soapCall('UpdateTheme', array($parameters));
  }

  /**
   * 
   * @param GetAllWorldsByUserId $parameters
   * @access public
   */
  public function GetAllWorldsByUserId(GetAllWorldsByUserId $parameters)
  {
    return $this->__soapCall('GetAllWorldsByUserId', array($parameters));
  }

  /**
   * 
   * @param UpdateMenuItemDisplayName $parameters
   * @access public
   */
  public function UpdateMenuItemDisplayName(UpdateMenuItemDisplayName $parameters)
  {
    return $this->__soapCall('UpdateMenuItemDisplayName', array($parameters));
  }

  /**
   * 
   * @param UpdateToolsMenuItemDisplayName $parameters
   * @access public
   */
  public function UpdateToolsMenuItemDisplayName(UpdateToolsMenuItemDisplayName $parameters)
  {
    return $this->__soapCall('UpdateToolsMenuItemDisplayName', array($parameters));
  }

  /**
   * 
   * @param UpdateResourceMenuItemDisplayName $parameters
   * @access public
   */
  public function UpdateResourceMenuItemDisplayName(UpdateResourceMenuItemDisplayName $parameters)
  {
    return $this->__soapCall('UpdateResourceMenuItemDisplayName', array($parameters));
  }

  /**
   * 
   * @param GetMenusByGroupMenu $parameters
   * @access public
   */
  public function GetMenusByGroupMenu(GetMenusByGroupMenu $parameters)
  {
    return $this->__soapCall('GetMenusByGroupMenu', array($parameters));
  }

  /**
   * 
   * @param FollowABroadcast $parameters
   * @access public
   */
  public function FollowABroadcast(FollowABroadcast $parameters)
  {
    return $this->__soapCall('FollowABroadcast', array($parameters));
  }

  /**
   * 
   * @param UnFollowABroadcast $parameters
   * @access public
   */
  public function UnFollowABroadcast(UnFollowABroadcast $parameters)
  {
    return $this->__soapCall('UnFollowABroadcast', array($parameters));
  }

  /**
   * 
   * @param GetTopBroadcastsFromWorldByHashtag $parameters
   * @access public
   */
  public function GetTopBroadcastsFromWorldByHashtag(GetTopBroadcastsFromWorldByHashtag $parameters)
  {
    return $this->__soapCall('GetTopBroadcastsFromWorldByHashtag', array($parameters));
  }

  /**
   * 
   * @param GetActionWeightageByNameAndWorld $parameters
   * @access public
   */
  public function GetActionWeightageByNameAndWorld(GetActionWeightageByNameAndWorld $parameters)
  {
    return $this->__soapCall('GetActionWeightageByNameAndWorld', array($parameters));
  }

  /**
   * 
   * @param GetMyFriendTopBroadcastsFromWorld $parameters
   * @access public
   */
  public function GetMyFriendTopBroadcastsFromWorld(GetMyFriendTopBroadcastsFromWorld $parameters)
  {
    return $this->__soapCall('GetMyFriendTopBroadcastsFromWorld', array($parameters));
  }

  /**
   * 
   * @param RegisterUser $parameters
   * @access public
   */
  public function RegisterUser(RegisterUser $parameters)
  {
    return $this->__soapCall('RegisterUser', array($parameters));
  }

  /**
   * 
   * @param GetWorldWiseNoOfUsers $parameters
   * @access public
   */
  public function GetWorldWiseNoOfUsers(GetWorldWiseNoOfUsers $parameters)
  {
    return $this->__soapCall('GetWorldWiseNoOfUsers', array($parameters));
  }

  /**
   * 
   * @param RegisterUserForUN $parameters
   * @access public
   */
  public function RegisterUserForUN(RegisterUserForUN $parameters)
  {
    return $this->__soapCall('RegisterUserForUN', array($parameters));
  }

  /**
   * 
   * @param AddUserToWorldUN $parameters
   * @access public
   */
  public function AddUserToWorldUN(AddUserToWorldUN $parameters)
  {
    return $this->__soapCall('AddUserToWorldUN', array($parameters));
  }

  /**
   * 
   * @param UpdateUserCountry $parameters
   * @access public
   */
  public function UpdateUserCountry(UpdateUserCountry $parameters)
  {
    return $this->__soapCall('UpdateUserCountry', array($parameters));
  }

  /**
   * 
   * @param IsUserAliveForSendingChatMessage $parameters
   * @access public
   */
  public function IsUserAliveForSendingChatMessage(IsUserAliveForSendingChatMessage $parameters)
  {
    return $this->__soapCall('IsUserAliveForSendingChatMessage', array($parameters));
  }

  /**
   * 
   * @param GetJobsForAWorld $parameters
   * @access public
   */
  public function GetJobsForAWorld(GetJobsForAWorld $parameters)
  {
    return $this->__soapCall('GetJobsForAWorld', array($parameters));
  }

  /**
   * 
   * @param AddTimeSlotToEvent $parameters
   * @access public
   */
  public function AddTimeSlotToEvent(AddTimeSlotToEvent $parameters)
  {
    return $this->__soapCall('AddTimeSlotToEvent', array($parameters));
  }

  /**
   * 
   * @param UpdateTimeSlot $parameters
   * @access public
   */
  public function UpdateTimeSlot(UpdateTimeSlot $parameters)
  {
    return $this->__soapCall('UpdateTimeSlot', array($parameters));
  }

  /**
   * 
   * @param DeleteTimeSlot $parameters
   * @access public
   */
  public function DeleteTimeSlot(DeleteTimeSlot $parameters)
  {
    return $this->__soapCall('DeleteTimeSlot', array($parameters));
  }

  /**
   * 
   * @param AddEvent $parameters
   * @access public
   */
  public function AddEvent(AddEvent $parameters)
  {
    return $this->__soapCall('AddEvent', array($parameters));
  }

  /**
   * 
   * @param UpdateEvent $parameters
   * @access public
   */
  public function UpdateEvent(UpdateEvent $parameters)
  {
    return $this->__soapCall('UpdateEvent', array($parameters));
  }

  /**
   * 
   * @param DeleteEvent $parameters
   * @access public
   */
  public function DeleteEvent(DeleteEvent $parameters)
  {
    return $this->__soapCall('DeleteEvent', array($parameters));
  }

  /**
   * 
   * @param AddEventInvite $parameters
   * @access public
   */
  public function AddEventInvite(AddEventInvite $parameters)
  {
    return $this->__soapCall('AddEventInvite', array($parameters));
  }

  /**
   * 
   * @param HasEventInvitePending $parameters
   * @access public
   */
  public function HasEventInvitePending(HasEventInvitePending $parameters)
  {
    return $this->__soapCall('HasEventInvitePending', array($parameters));
  }

  /**
   * 
   * @param UpdateEventInvite $parameters
   * @access public
   */
  public function UpdateEventInvite(UpdateEventInvite $parameters)
  {
    return $this->__soapCall('UpdateEventInvite', array($parameters));
  }

  /**
   * 
   * @param DeleteEventInvite $parameters
   * @access public
   */
  public function DeleteEventInvite(DeleteEventInvite $parameters)
  {
    return $this->__soapCall('DeleteEventInvite', array($parameters));
  }

  /**
   * 
   * @param GetMyCreatedEvents $parameters
   * @access public
   */
  public function GetMyCreatedEvents(GetMyCreatedEvents $parameters)
  {
    return $this->__soapCall('GetMyCreatedEvents', array($parameters));
  }

  /**
   * 
   * @param GetEventsForUserByRSVP $parameters
   * @access public
   */
  public function GetEventsForUserByRSVP(GetEventsForUserByRSVP $parameters)
  {
    return $this->__soapCall('GetEventsForUserByRSVP', array($parameters));
  }

  /**
   * 
   * @param GetPersonalEventsForUserByRSVP $parameters
   * @access public
   */
  public function GetPersonalEventsForUserByRSVP(GetPersonalEventsForUserByRSVP $parameters)
  {
    return $this->__soapCall('GetPersonalEventsForUserByRSVP', array($parameters));
  }

  /**
   * 
   * @param AddUserFile $parameters
   * @access public
   */
  public function AddUserFile(AddUserFile $parameters)
  {
    return $this->__soapCall('AddUserFile', array($parameters));
  }

  /**
   * 
   * @param GetFilesForUser $parameters
   * @access public
   */
  public function GetFilesForUser(GetFilesForUser $parameters)
  {
    return $this->__soapCall('GetFilesForUser', array($parameters));
  }

  /**
   * 
   * @param UpdateUserFile $parameters
   * @access public
   */
  public function UpdateUserFile(UpdateUserFile $parameters)
  {
    return $this->__soapCall('UpdateUserFile', array($parameters));
  }

  /**
   * 
   * @param DeleteUserFile $parameters
   * @access public
   */
  public function DeleteUserFile(DeleteUserFile $parameters)
  {
    return $this->__soapCall('DeleteUserFile', array($parameters));
  }

  /**
   * 
   * @param SwapWidgets $parameters
   * @access public
   */
  public function SwapWidgets(SwapWidgets $parameters)
  {
    return $this->__soapCall('SwapWidgets', array($parameters));
  }

  /**
   * 
   * @param AddWidgetToUser $parameters
   * @access public
   */
  public function AddWidgetToUser(AddWidgetToUser $parameters)
  {
    return $this->__soapCall('AddWidgetToUser', array($parameters));
  }

  /**
   * 
   * @param RemoveWidgetFromUser $parameters
   * @access public
   */
  public function RemoveWidgetFromUser(RemoveWidgetFromUser $parameters)
  {
    return $this->__soapCall('RemoveWidgetFromUser', array($parameters));
  }

  /**
   * 
   * @param AddGallery $parameters
   * @access public
   */
  public function AddGallery(AddGallery $parameters)
  {
    return $this->__soapCall('AddGallery', array($parameters));
  }

  /**
   * 
   * @param AddItemToGallery $parameters
   * @access public
   */
  public function AddItemToGallery(AddItemToGallery $parameters)
  {
    return $this->__soapCall('AddItemToGallery', array($parameters));
  }

  /**
   * 
   * @param AddVideoItemToGallery $parameters
   * @access public
   */
  public function AddVideoItemToGallery(AddVideoItemToGallery $parameters)
  {
    return $this->__soapCall('AddVideoItemToGallery', array($parameters));
  }

  /**
   * 
   * @param EditItemInGallery $parameters
   * @access public
   */
  public function EditItemInGallery(EditItemInGallery $parameters)
  {
    return $this->__soapCall('EditItemInGallery', array($parameters));
  }

  /**
   * 
   * @param DeleteItemInGallery $parameters
   * @access public
   */
  public function DeleteItemInGallery(DeleteItemInGallery $parameters)
  {
    return $this->__soapCall('DeleteItemInGallery', array($parameters));
  }

  /**
   * 
   * @param GetUserGallery $parameters
   * @access public
   */
  public function GetUserGallery(GetUserGallery $parameters)
  {
    return $this->__soapCall('GetUserGallery', array($parameters));
  }

  /**
   * 
   * @param GetUserVideoGallery $parameters
   * @access public
   */
  public function GetUserVideoGallery(GetUserVideoGallery $parameters)
  {
    return $this->__soapCall('GetUserVideoGallery', array($parameters));
  }

  /**
   * 
   * @param GetUserImageAndVideoGallery $parameters
   * @access public
   */
  public function GetUserImageAndVideoGallery(GetUserImageAndVideoGallery $parameters)
  {
    return $this->__soapCall('GetUserImageAndVideoGallery', array($parameters));
  }

  /**
   * 
   * @param UpdateUserGallery $parameters
   * @access public
   */
  public function UpdateUserGallery(UpdateUserGallery $parameters)
  {
    return $this->__soapCall('UpdateUserGallery', array($parameters));
  }

  /**
   * 
   * @param DeleteUserGallery $parameters
   * @access public
   */
  public function DeleteUserGallery(DeleteUserGallery $parameters)
  {
    return $this->__soapCall('DeleteUserGallery', array($parameters));
  }

  /**
   * 
   * @param GetFriendBroadcastById $parameters
   * @access public
   */
  public function GetFriendBroadcastById(GetFriendBroadcastById $parameters)
  {
    return $this->__soapCall('GetFriendBroadcastById', array($parameters));
  }

  /**
   * 
   * @param GetFriendBroadcasts $parameters
   * @access public
   */
  public function GetFriendBroadcasts(GetFriendBroadcasts $parameters)
  {
    return $this->__soapCall('GetFriendBroadcasts', array($parameters));
  }

  /**
   * 
   * @param GetBroadcastsForUser $parameters
   * @access public
   */
  public function GetBroadcastsForUser(GetBroadcastsForUser $parameters)
  {
    return $this->__soapCall('GetBroadcastsForUser', array($parameters));
  }

  /**
   * 
   * @param GetMyBroadcasts $parameters
   * @access public
   */
  public function GetMyBroadcasts(GetMyBroadcasts $parameters)
  {
    return $this->__soapCall('GetMyBroadcasts', array($parameters));
  }

  /**
   * 
   * @param GetTopBroadcastsFromWorld $parameters
   * @access public
   */
  public function GetTopBroadcastsFromWorld(GetTopBroadcastsFromWorld $parameters)
  {
    return $this->__soapCall('GetTopBroadcastsFromWorld', array($parameters));
  }

  /**
   * 
   * @param GetTopBroadcasts $parameters
   * @access public
   */
  public function GetTopBroadcasts(GetTopBroadcasts $parameters)
  {
    return $this->__soapCall('GetTopBroadcasts', array($parameters));
  }

  /**
   * 
   * @param GetAllBroadcasts $parameters
   * @access public
   */
  public function GetAllBroadcasts(GetAllBroadcasts $parameters)
  {
    return $this->__soapCall('GetAllBroadcasts', array($parameters));
  }

  /**
   * 
   * @param NewFriendBroadcast $parameters
   * @access public
   */
  public function NewFriendBroadcast(NewFriendBroadcast $parameters)
  {
    return $this->__soapCall('NewFriendBroadcast', array($parameters));
  }

  /**
   * 
   * @param DeleteFriendBroadcast $parameters
   * @access public
   */
  public function DeleteFriendBroadcast(DeleteFriendBroadcast $parameters)
  {
    return $this->__soapCall('DeleteFriendBroadcast', array($parameters));
  }

  /**
   * 
   * @param NewFriendBroadcastComment $parameters
   * @access public
   */
  public function NewFriendBroadcastComment(NewFriendBroadcastComment $parameters)
  {
    return $this->__soapCall('NewFriendBroadcastComment', array($parameters));
  }

  /**
   * 
   * @param NewFriendBroadcastCommentAndReturnCommentId $parameters
   * @access public
   */
  public function NewFriendBroadcastCommentAndReturnCommentId(NewFriendBroadcastCommentAndReturnCommentId $parameters)
  {
    return $this->__soapCall('NewFriendBroadcastCommentAndReturnCommentId', array($parameters));
  }

  /**
   * 
   * @param DeleteFriendBroadcastCommentById $parameters
   * @access public
   */
  public function DeleteFriendBroadcastCommentById(DeleteFriendBroadcastCommentById $parameters)
  {
    return $this->__soapCall('DeleteFriendBroadcastCommentById', array($parameters));
  }

  /**
   * 
   * @param UpdateFriendBroadcastCommentById $parameters
   * @access public
   */
  public function UpdateFriendBroadcastCommentById(UpdateFriendBroadcastCommentById $parameters)
  {
    return $this->__soapCall('UpdateFriendBroadcastCommentById', array($parameters));
  }

  /**
   * 
   * @param LoadRecommendedFriendsForWorld $parameters
   * @access public
   */
  public function LoadRecommendedFriendsForWorld(LoadRecommendedFriendsForWorld $parameters)
  {
    return $this->__soapCall('LoadRecommendedFriendsForWorld', array($parameters));
  }

  /**
   * 
   * @param LoadSkiptaRecommendedFriends $parameters
   * @access public
   */
  public function LoadSkiptaRecommendedFriends(LoadSkiptaRecommendedFriends $parameters)
  {
    return $this->__soapCall('LoadSkiptaRecommendedFriends', array($parameters));
  }

  /**
   * 
   * @param RemoveUserOAuthByService $parameters
   * @access public
   */
  public function RemoveUserOAuthByService(RemoveUserOAuthByService $parameters)
  {
    return $this->__soapCall('RemoveUserOAuthByService', array($parameters));
  }

  /**
   * 
   * @param GetUserOAuthByService $parameters
   * @access public
   */
  public function GetUserOAuthByService(GetUserOAuthByService $parameters)
  {
    return $this->__soapCall('GetUserOAuthByService', array($parameters));
  }

  /**
   * 
   * @param SaveUserOAuth $parameters
   * @access public
   */
  public function SaveUserOAuth(SaveUserOAuth $parameters)
  {
    return $this->__soapCall('SaveUserOAuth', array($parameters));
  }

  /**
   * 
   * @param AddWorldLinkToCategory $parameters
   * @access public
   */
  public function AddWorldLinkToCategory(AddWorldLinkToCategory $parameters)
  {
    return $this->__soapCall('AddWorldLinkToCategory', array($parameters));
  }

  /**
   * 
   * @param AddWorldLinkCategory $parameters
   * @access public
   */
  public function AddWorldLinkCategory(AddWorldLinkCategory $parameters)
  {
    return $this->__soapCall('AddWorldLinkCategory', array($parameters));
  }

  /**
   * 
   * @param GetWorldLinksByCategory $parameters
   * @access public
   */
  public function GetWorldLinksByCategory(GetWorldLinksByCategory $parameters)
  {
    return $this->__soapCall('GetWorldLinksByCategory', array($parameters));
  }

  /**
   * 
   * @param GetWorldLinkCategories $parameters
   * @access public
   */
  public function GetWorldLinkCategories(GetWorldLinkCategories $parameters)
  {
    return $this->__soapCall('GetWorldLinkCategories', array($parameters));
  }

  /**
   * 
   * @param GetAllWorldLinks $parameters
   * @access public
   */
  public function GetAllWorldLinks(GetAllWorldLinks $parameters)
  {
    return $this->__soapCall('GetAllWorldLinks', array($parameters));
  }

  /**
   * 
   * @param GetPopularWorldLinks $parameters
   * @access public
   */
  public function GetPopularWorldLinks(GetPopularWorldLinks $parameters)
  {
    return $this->__soapCall('GetPopularWorldLinks', array($parameters));
  }

  /**
   * 
   * @param GetSuggestedWorldLinks $parameters
   * @access public
   */
  public function GetSuggestedWorldLinks(GetSuggestedWorldLinks $parameters)
  {
    return $this->__soapCall('GetSuggestedWorldLinks', array($parameters));
  }

  /**
   * 
   * @param GetWidgetWorldLinks $parameters
   * @access public
   */
  public function GetWidgetWorldLinks(GetWidgetWorldLinks $parameters)
  {
    return $this->__soapCall('GetWidgetWorldLinks', array($parameters));
  }

  /**
   * 
   * @param GetCategoryWorldLinks $parameters
   * @access public
   */
  public function GetCategoryWorldLinks(GetCategoryWorldLinks $parameters)
  {
    return $this->__soapCall('GetCategoryWorldLinks', array($parameters));
  }

  /**
   * 
   * @param SkiptaGlobalSearch $parameters
   * @access public
   */
  public function SkiptaGlobalSearch(SkiptaGlobalSearch $parameters)
  {
    return $this->__soapCall('SkiptaGlobalSearch', array($parameters));
  }

  /**
   * 
   * @param GetRatedUsersForPost $parameters
   * @access public
   */
  public function GetRatedUsersForPost(GetRatedUsersForPost $parameters)
  {
    return $this->__soapCall('GetRatedUsersForPost', array($parameters));
  }

  /**
   * 
   * @param SetUserRatingForPost $parameters
   * @access public
   */
  public function SetUserRatingForPost(SetUserRatingForPost $parameters)
  {
    return $this->__soapCall('SetUserRatingForPost', array($parameters));
  }

  /**
   * 
   * @param GetSkiptaWorlds $parameters
   * @access public
   */
  public function GetSkiptaWorlds(GetSkiptaWorlds $parameters)
  {
    return $this->__soapCall('GetSkiptaWorlds', array($parameters));
  }

  /**
   * 
   * @param GetWorldNewsFeedSettings $parameters
   * @access public
   */
  public function GetWorldNewsFeedSettings(GetWorldNewsFeedSettings $parameters)
  {
    return $this->__soapCall('GetWorldNewsFeedSettings', array($parameters));
  }

  /**
   * 
   * @param SaveWorldNewsFeedConfiguration $parameters
   * @access public
   */
  public function SaveWorldNewsFeedConfiguration(SaveWorldNewsFeedConfiguration $parameters)
  {
    return $this->__soapCall('SaveWorldNewsFeedConfiguration', array($parameters));
  }

  /**
   * 
   * @param GetWorldNews $parameters
   * @access public
   */
  public function GetWorldNews(GetWorldNews $parameters)
  {
    return $this->__soapCall('GetWorldNews', array($parameters));
  }

  /**
   * 
   * @param GetTopNews $parameters
   * @access public
   */
  public function GetTopNews(GetTopNews $parameters)
  {
    return $this->__soapCall('GetTopNews', array($parameters));
  }

  /**
   * 
   * @param GetWorldFeedAggregate $parameters
   * @access public
   */
  public function GetWorldFeedAggregate(GetWorldFeedAggregate $parameters)
  {
    return $this->__soapCall('GetWorldFeedAggregate', array($parameters));
  }

  /**
   * 
   * @param SetCommentForNews $parameters
   * @access public
   */
  public function SetCommentForNews(SetCommentForNews $parameters)
  {
    return $this->__soapCall('SetCommentForNews', array($parameters));
  }

  /**
   * 
   * @param fetchCommentForNews $parameters
   * @access public
   */
  public function fetchCommentForNews(fetchCommentForNews $parameters)
  {
    return $this->__soapCall('fetchCommentForNews', array($parameters));
  }

  /**
   * 
   * @param SetUserRatingForNews $parameters
   * @access public
   */
  public function SetUserRatingForNews(SetUserRatingForNews $parameters)
  {
    return $this->__soapCall('SetUserRatingForNews', array($parameters));
  }

  /**
   * 
   * @param GetRatedUsersForNews $parameters
   * @access public
   */
  public function GetRatedUsersForNews(GetRatedUsersForNews $parameters)
  {
    return $this->__soapCall('GetRatedUsersForNews', array($parameters));
  }

  /**
   * 
   * @param GetFriendPostsCount $parameters
   * @access public
   */
  public function GetFriendPostsCount(GetFriendPostsCount $parameters)
  {
    return $this->__soapCall('GetFriendPostsCount', array($parameters));
  }

  /**
   * 
   * @param GetFriendPosts $parameters
   * @access public
   */
  public function GetFriendPosts(GetFriendPosts $parameters)
  {
    return $this->__soapCall('GetFriendPosts', array($parameters));
  }

  /**
   * 
   * @param GetWorldMenus $parameters
   * @access public
   */
  public function GetWorldMenus(GetWorldMenus $parameters)
  {
    return $this->__soapCall('GetWorldMenus', array($parameters));
  }

  /**
   * 
   * @param GetTopBroadcastsFromWorldForWidget $parameters
   * @access public
   */
  public function GetTopBroadcastsFromWorldForWidget(GetTopBroadcastsFromWorldForWidget $parameters)
  {
    return $this->__soapCall('GetTopBroadcastsFromWorldForWidget', array($parameters));
  }

  /**
   * 
   * @param GetAllLinksByCategoryWise $parameters
   * @access public
   */
  public function GetAllLinksByCategoryWise(GetAllLinksByCategoryWise $parameters)
  {
    return $this->__soapCall('GetAllLinksByCategoryWise', array($parameters));
  }

  /**
   * 
   * @param GetTopNewMembers $parameters
   * @access public
   */
  public function GetTopNewMembers(GetTopNewMembers $parameters)
  {
    return $this->__soapCall('GetTopNewMembers', array($parameters));
  }

  /**
   * 
   * @param GetMoreNewMembers $parameters
   * @access public
   */
  public function GetMoreNewMembers(GetMoreNewMembers $parameters)
  {
    return $this->__soapCall('GetMoreNewMembers', array($parameters));
  }

  /**
   * 
   * @param GetUserInfo $parameters
   * @access public
   */
  public function GetUserInfo(GetUserInfo $parameters)
  {
    return $this->__soapCall('GetUserInfo', array($parameters));
  }

  /**
   * 
   * @param GetWidgetLinksByCategoryWise $parameters
   * @access public
   */
  public function GetWidgetLinksByCategoryWise(GetWidgetLinksByCategoryWise $parameters)
  {
    return $this->__soapCall('GetWidgetLinksByCategoryWise', array($parameters));
  }

  /**
   * 
   * @param GetWidgetMoreLinksByCategoryWise $parameters
   * @access public
   */
  public function GetWidgetMoreLinksByCategoryWise(GetWidgetMoreLinksByCategoryWise $parameters)
  {
    return $this->__soapCall('GetWidgetMoreLinksByCategoryWise', array($parameters));
  }

  /**
   * 
   * @param GetFriendRecommendations $parameters
   * @access public
   */
  public function GetFriendRecommendations(GetFriendRecommendations $parameters)
  {
    return $this->__soapCall('GetFriendRecommendations', array($parameters));
  }

  /**
   * 
   * @param GetMoreFriendRecommendations $parameters
   * @access public
   */
  public function GetMoreFriendRecommendations(GetMoreFriendRecommendations $parameters)
  {
    return $this->__soapCall('GetMoreFriendRecommendations', array($parameters));
  }

  /**
   * 
   * @param UpdateUserPhoneForUserId $parameters
   * @access public
   */
  public function UpdateUserPhoneForUserId(UpdateUserPhoneForUserId $parameters)
  {
    return $this->__soapCall('UpdateUserPhoneForUserId', array($parameters));
  }

  /**
   * 
   * @param UpdateUserPhone $parameters
   * @access public
   */
  public function UpdateUserPhone(UpdateUserPhone $parameters)
  {
    return $this->__soapCall('UpdateUserPhone', array($parameters));
  }

  /**
   * 
   * @param UpdateUserNameForUserId $parameters
   * @access public
   */
  public function UpdateUserNameForUserId(UpdateUserNameForUserId $parameters)
  {
    return $this->__soapCall('UpdateUserNameForUserId', array($parameters));
  }

  /**
   * 
   * @param UpdateUserName $parameters
   * @access public
   */
  public function UpdateUserName(UpdateUserName $parameters)
  {
    return $this->__soapCall('UpdateUserName', array($parameters));
  }

  /**
   * 
   * @param UpdateUserEmailForUserId $parameters
   * @access public
   */
  public function UpdateUserEmailForUserId(UpdateUserEmailForUserId $parameters)
  {
    return $this->__soapCall('UpdateUserEmailForUserId', array($parameters));
  }

  /**
   * 
   * @param UpdateUserEmail $parameters
   * @access public
   */
  public function UpdateUserEmail(UpdateUserEmail $parameters)
  {
    return $this->__soapCall('UpdateUserEmail', array($parameters));
  }

  /**
   * 
   * @param UpdateUserAddress $parameters
   * @access public
   */
  public function UpdateUserAddress(UpdateUserAddress $parameters)
  {
    return $this->__soapCall('UpdateUserAddress', array($parameters));
  }

  /**
   * 
   * @param GetUserAddressCollection $parameters
   * @access public
   */
  public function GetUserAddressCollection(GetUserAddressCollection $parameters)
  {
    return $this->__soapCall('GetUserAddressCollection', array($parameters));
  }

  /**
   * 
   * @param UpdateUserWidgetState $parameters
   * @access public
   */
  public function UpdateUserWidgetState(UpdateUserWidgetState $parameters)
  {
    return $this->__soapCall('UpdateUserWidgetState', array($parameters));
  }

  /**
   * 
   * @param EmailIsUnique $parameters
   * @access public
   */
  public function EmailIsUnique(EmailIsUnique $parameters)
  {
    return $this->__soapCall('EmailIsUnique', array($parameters));
  }

  /**
   * 
   * @param AddNewUser $parameters
   * @access public
   */
  public function AddNewUser(AddNewUser $parameters)
  {
    return $this->__soapCall('AddNewUser', array($parameters));
  }

  /**
   * 
   * @param ChangeUserPassword $parameters
   * @access public
   */
  public function ChangeUserPassword(ChangeUserPassword $parameters)
  {
    return $this->__soapCall('ChangeUserPassword', array($parameters));
  }

  /**
   * 
   * @param ChangeUserPasswordWithEncryptedOld $parameters
   * @access public
   */
  public function ChangeUserPasswordWithEncryptedOld(ChangeUserPasswordWithEncryptedOld $parameters)
  {
    return $this->__soapCall('ChangeUserPasswordWithEncryptedOld', array($parameters));
  }

  /**
   * 
   * @param ActivateUser $parameters
   * @access public
   */
  public function ActivateUser(ActivateUser $parameters)
  {
    return $this->__soapCall('ActivateUser', array($parameters));
  }

  /**
   * 
   * @param IsValidUser $parameters
   * @access public
   */
  public function IsValidUser(IsValidUser $parameters)
  {
    return $this->__soapCall('IsValidUser', array($parameters));
  }

  /**
   * 
   * @param GetUserId $parameters
   * @access public
   */
  public function GetUserId(GetUserId $parameters)
  {
    return $this->__soapCall('GetUserId', array($parameters));
  }

  /**
   * 
   * @param UpdateUserSession $parameters
   * @access public
   */
  public function UpdateUserSession(UpdateUserSession $parameters)
  {
    return $this->__soapCall('UpdateUserSession', array($parameters));
  }

  /**
   * 
   * @param IsUserAlive $parameters
   * @access public
   */
  public function IsUserAlive(IsUserAlive $parameters)
  {
    return $this->__soapCall('IsUserAlive', array($parameters));
  }

  /**
   * 
   * @param IsUserLogedIn $parameters
   * @access public
   */
  public function IsUserLogedIn(IsUserLogedIn $parameters)
  {
    return $this->__soapCall('IsUserLogedIn', array($parameters));
  }

  /**
   * 
   * @param GetUserSessionExpiration $parameters
   * @access public
   */
  public function GetUserSessionExpiration(GetUserSessionExpiration $parameters)
  {
    return $this->__soapCall('GetUserSessionExpiration', array($parameters));
  }

  /**
   * 
   * @param GetUserById $parameters
   * @access public
   */
  public function GetUserById(GetUserById $parameters)
  {
    return $this->__soapCall('GetUserById', array($parameters));
  }

  /**
   * 
   * @param GetUserBySession $parameters
   * @access public
   */
  public function GetUserBySession(GetUserBySession $parameters)
  {
    return $this->__soapCall('GetUserBySession', array($parameters));
  }

  /**
   * 
   * @param Logout $parameters
   * @access public
   */
  public function Logout(Logout $parameters)
  {
    return $this->__soapCall('Logout', array($parameters));
  }

  /**
   * 
   * @param GetUserByEmail $parameters
   * @access public
   */
  public function GetUserByEmail(GetUserByEmail $parameters)
  {
    return $this->__soapCall('GetUserByEmail', array($parameters));
  }

  /**
   * 
   * @param LoginWithAuthCode $parameters
   * @access public
   */
  public function LoginWithAuthCode(LoginWithAuthCode $parameters)
  {
    return $this->__soapCall('LoginWithAuthCode', array($parameters));
  }

  /**
   * 
   * @param Login $parameters
   * @access public
   */
  public function Login(Login $parameters)
  {
    return $this->__soapCall('Login', array($parameters));
  }

  /**
   * 
   * @param LoginByID $parameters
   * @access public
   */
  public function LoginByID(LoginByID $parameters)
  {
    return $this->__soapCall('LoginByID', array($parameters));
  }

  /**
   * 
   * @param LoginMobile $parameters
   * @access public
   */
  public function LoginMobile(LoginMobile $parameters)
  {
    return $this->__soapCall('LoginMobile', array($parameters));
  }

  /**
   * 
   * @param GetProfileLinks $parameters
   * @access public
   */
  public function GetProfileLinks(GetProfileLinks $parameters)
  {
    return $this->__soapCall('GetProfileLinks', array($parameters));
  }

  /**
   * 
   * @param AddProfileLink $parameters
   * @access public
   */
  public function AddProfileLink(AddProfileLink $parameters)
  {
    return $this->__soapCall('AddProfileLink', array($parameters));
  }

  /**
   * 
   * @param EditProfileLink $parameters
   * @access public
   */
  public function EditProfileLink(EditProfileLink $parameters)
  {
    return $this->__soapCall('EditProfileLink', array($parameters));
  }

  /**
   * 
   * @param DeleteProfileLink $parameters
   * @access public
   */
  public function DeleteProfileLink(DeleteProfileLink $parameters)
  {
    return $this->__soapCall('DeleteProfileLink', array($parameters));
  }

  /**
   * 
   * @param GetSkiptaProfileForUser $parameters
   * @access public
   */
  public function GetSkiptaProfileForUser(GetSkiptaProfileForUser $parameters)
  {
    return $this->__soapCall('GetSkiptaProfileForUser', array($parameters));
  }

  /**
   * 
   * @param UpdateSkiptaUserStatus $parameters
   * @access public
   */
  public function UpdateSkiptaUserStatus(UpdateSkiptaUserStatus $parameters)
  {
    return $this->__soapCall('UpdateSkiptaUserStatus', array($parameters));
  }

  /**
   * 
   * @param UpdateSkiptaUserProfile $parameters
   * @access public
   */
  public function UpdateSkiptaUserProfile(UpdateSkiptaUserProfile $parameters)
  {
    return $this->__soapCall('UpdateSkiptaUserProfile', array($parameters));
  }

  /**
   * 
   * @param NewSkiptaUserProfile $parameters
   * @access public
   */
  public function NewSkiptaUserProfile(NewSkiptaUserProfile $parameters)
  {
    return $this->__soapCall('NewSkiptaUserProfile', array($parameters));
  }

  /**
   * 
   * @param GetPreferencesForUser $parameters
   * @access public
   */
  public function GetPreferencesForUser(GetPreferencesForUser $parameters)
  {
    return $this->__soapCall('GetPreferencesForUser', array($parameters));
  }

  /**
   * 
   * @param GetPreferencesForUserByID $parameters
   * @access public
   */
  public function GetPreferencesForUserByID(GetPreferencesForUserByID $parameters)
  {
    return $this->__soapCall('GetPreferencesForUserByID', array($parameters));
  }

  /**
   * 
   * @param UpdateUserPreferences $parameters
   * @access public
   */
  public function UpdateUserPreferences(UpdateUserPreferences $parameters)
  {
    return $this->__soapCall('UpdateUserPreferences', array($parameters));
  }

  /**
   * 
   * @param GetMyCurrentWorld $parameters
   * @access public
   */
  public function GetMyCurrentWorld(GetMyCurrentWorld $parameters)
  {
    return $this->__soapCall('GetMyCurrentWorld', array($parameters));
  }

  /**
   * 
   * @param GetAllWorlds $parameters
   * @access public
   */
  public function GetAllWorlds(GetAllWorlds $parameters)
  {
    return $this->__soapCall('GetAllWorlds', array($parameters));
  }

  /**
   * 
   * @param GetAllWorldsForUser $parameters
   * @access public
   */
  public function GetAllWorldsForUser(GetAllWorldsForUser $parameters)
  {
    return $this->__soapCall('GetAllWorldsForUser', array($parameters));
  }

  /**
   * 
   * @param AddUserToWorld $parameters
   * @access public
   */
  public function AddUserToWorld(AddUserToWorld $parameters)
  {
    return $this->__soapCall('AddUserToWorld', array($parameters));
  }

  /**
   * 
   * @param GetMessagesForUser $parameters
   * @access public
   */
  public function GetMessagesForUser(GetMessagesForUser $parameters)
  {
    return $this->__soapCall('GetMessagesForUser', array($parameters));
  }

  /**
   * 
   * @param GetSentMessagesForUser $parameters
   * @access public
   */
  public function GetSentMessagesForUser(GetSentMessagesForUser $parameters)
  {
    return $this->__soapCall('GetSentMessagesForUser', array($parameters));
  }

  /**
   * 
   * @param GetDeletedMessagesForUser $parameters
   * @access public
   */
  public function GetDeletedMessagesForUser(GetDeletedMessagesForUser $parameters)
  {
    return $this->__soapCall('GetDeletedMessagesForUser', array($parameters));
  }

  /**
   * 
   * @param UpdateMessageStatusForUser $parameters
   * @access public
   */
  public function UpdateMessageStatusForUser(UpdateMessageStatusForUser $parameters)
  {
    return $this->__soapCall('UpdateMessageStatusForUser', array($parameters));
  }

  /**
   * 
   * @param GetMessageByID $parameters
   * @access public
   */
  public function GetMessageByID(GetMessageByID $parameters)
  {
    return $this->__soapCall('GetMessageByID', array($parameters));
  }

  /**
   * 
   * @param SendMessageToUser $parameters
   * @access public
   */
  public function SendMessageToUser(SendMessageToUser $parameters)
  {
    return $this->__soapCall('SendMessageToUser', array($parameters));
  }

  /**
   * 
   * @param SendMessageToUserWithParentId $parameters
   * @access public
   */
  public function SendMessageToUserWithParentId(SendMessageToUserWithParentId $parameters)
  {
    return $this->__soapCall('SendMessageToUserWithParentId', array($parameters));
  }

  /**
   * 
   * @param SendMessageToUserWithParentIdAndReturnId $parameters
   * @access public
   */
  public function SendMessageToUserWithParentIdAndReturnId(SendMessageToUserWithParentIdAndReturnId $parameters)
  {
    return $this->__soapCall('SendMessageToUserWithParentIdAndReturnId', array($parameters));
  }

  /**
   * 
   * @param GetAllFriends $parameters
   * @access public
   */
  public function GetAllFriends(GetAllFriends $parameters)
  {
    return $this->__soapCall('GetAllFriends', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsForUser $parameters
   * @access public
   */
  public function GetAllFriendsForUser(GetAllFriendsForUser $parameters)
  {
    return $this->__soapCall('GetAllFriendsForUser', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsForUserWithParams $parameters
   * @access public
   */
  public function GetAllFriendsForUserWithParams(GetAllFriendsForUserWithParams $parameters)
  {
    return $this->__soapCall('GetAllFriendsForUserWithParams', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsForUserWithParamsAndQueryAndWorld $parameters
   * @access public
   */
  public function GetAllFriendsForUserWithParamsAndQueryAndWorld(GetAllFriendsForUserWithParamsAndQueryAndWorld $parameters)
  {
    return $this->__soapCall('GetAllFriendsForUserWithParamsAndQueryAndWorld', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsForUserWithParamsAndQuery $parameters
   * @access public
   */
  public function GetAllFriendsForUserWithParamsAndQuery(GetAllFriendsForUserWithParamsAndQuery $parameters)
  {
    return $this->__soapCall('GetAllFriendsForUserWithParamsAndQuery', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld $parameters
   * @access public
   */
  public function GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld(GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld $parameters)
  {
    return $this->__soapCall('GetAllFriendsForUserWithParamsAndQueryWithExceptionListInWorld', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsForUserWithParamsAndQueryWithExceptionList $parameters
   * @access public
   */
  public function GetAllFriendsForUserWithParamsAndQueryWithExceptionList(GetAllFriendsForUserWithParamsAndQueryWithExceptionList $parameters)
  {
    return $this->__soapCall('GetAllFriendsForUserWithParamsAndQueryWithExceptionList', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsByStatus $parameters
   * @access public
   */
  public function GetAllFriendsByStatus(GetAllFriendsByStatus $parameters)
  {
    return $this->__soapCall('GetAllFriendsByStatus', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsByStatusAndWorld $parameters
   * @access public
   */
  public function GetAllFriendsByStatusAndWorld(GetAllFriendsByStatusAndWorld $parameters)
  {
    return $this->__soapCall('GetAllFriendsByStatusAndWorld', array($parameters));
  }

  /**
   * 
   * @param GetAllPendingFriendRequests $parameters
   * @access public
   */
  public function GetAllPendingFriendRequests(GetAllPendingFriendRequests $parameters)
  {
    return $this->__soapCall('GetAllPendingFriendRequests', array($parameters));
  }

  /**
   * 
   * @param GetAllPendingFriendRequestsForUser $parameters
   * @access public
   */
  public function GetAllPendingFriendRequestsForUser(GetAllPendingFriendRequestsForUser $parameters)
  {
    return $this->__soapCall('GetAllPendingFriendRequestsForUser', array($parameters));
  }

  /**
   * 
   * @param GetAllFriendsByStatusAndWorldWithParams $parameters
   * @access public
   */
  public function GetAllFriendsByStatusAndWorldWithParams(GetAllFriendsByStatusAndWorldWithParams $parameters)
  {
    return $this->__soapCall('GetAllFriendsByStatusAndWorldWithParams', array($parameters));
  }

  /**
   * 
   * @param IsUserBlocked $parameters
   * @access public
   */
  public function IsUserBlocked(IsUserBlocked $parameters)
  {
    return $this->__soapCall('IsUserBlocked', array($parameters));
  }

  /**
   * 
   * @param CreateFriend $parameters
   * @access public
   */
  public function CreateFriend(CreateFriend $parameters)
  {
    return $this->__soapCall('CreateFriend', array($parameters));
  }

  /**
   * 
   * @param UpdateFriend $parameters
   * @access public
   */
  public function UpdateFriend(UpdateFriend $parameters)
  {
    return $this->__soapCall('UpdateFriend', array($parameters));
  }

  /**
   * 
   * @param UnblockFriend $parameters
   * @access public
   */
  public function UnblockFriend(UnblockFriend $parameters)
  {
    return $this->__soapCall('UnblockFriend', array($parameters));
  }

  /**
   * 
   * @param SearchForUserInWorld $parameters
   * @access public
   */
  public function SearchForUserInWorld(SearchForUserInWorld $parameters)
  {
    return $this->__soapCall('SearchForUserInWorld', array($parameters));
  }

  /**
   * 
   * @param SearchForUserInWorldWithParams $parameters
   * @access public
   */
  public function SearchForUserInWorldWithParams(SearchForUserInWorldWithParams $parameters)
  {
    return $this->__soapCall('SearchForUserInWorldWithParams', array($parameters));
  }

  /**
   * 
   * @param SearchForUserWithParamsAndHideList $parameters
   * @access public
   */
  public function SearchForUserWithParamsAndHideList(SearchForUserWithParamsAndHideList $parameters)
  {
    return $this->__soapCall('SearchForUserWithParamsAndHideList', array($parameters));
  }

  /**
   * 
   * @param SearchForUserInWorldWithParamsAndHideList $parameters
   * @access public
   */
  public function SearchForUserInWorldWithParamsAndHideList(SearchForUserInWorldWithParamsAndHideList $parameters)
  {
    return $this->__soapCall('SearchForUserInWorldWithParamsAndHideList', array($parameters));
  }

  /**
   * 
   * @param GetInfoForUsers $parameters
   * @access public
   */
  public function GetInfoForUsers(GetInfoForUsers $parameters)
  {
    return $this->__soapCall('GetInfoForUsers', array($parameters));
  }

  /**
   * 
   * @param GetInfoForUsersByName $parameters
   * @access public
   */
  public function GetInfoForUsersByName(GetInfoForUsersByName $parameters)
  {
    return $this->__soapCall('GetInfoForUsersByName', array($parameters));
  }

  /**
   * 
   * @param GetInfoForUsersByNameSorted $parameters
   * @access public
   */
  public function GetInfoForUsersByNameSorted(GetInfoForUsersByNameSorted $parameters)
  {
    return $this->__soapCall('GetInfoForUsersByNameSorted', array($parameters));
  }

  /**
   * 
   * @param GetNewKey $parameters
   * @access public
   */
  public function GetNewKey(GetNewKey $parameters)
  {
    return $this->__soapCall('GetNewKey', array($parameters));
  }

  /**
   * 
   * @param GetUsersInRole $parameters
   * @access public
   */
  public function GetUsersInRole(GetUsersInRole $parameters)
  {
    return $this->__soapCall('GetUsersInRole', array($parameters));
  }

  /**
   * 
   * @param GetTimeSlotByID $parameters
   * @access public
   */
  public function GetTimeSlotByID(GetTimeSlotByID $parameters)
  {
    return $this->__soapCall('GetTimeSlotByID', array($parameters));
  }

  /**
   * 
   * @param GetUsersBasedOnEventAndRSVP $parameters
   * @access public
   */
  public function GetUsersBasedOnEventAndRSVP(GetUsersBasedOnEventAndRSVP $parameters)
  {
    return $this->__soapCall('GetUsersBasedOnEventAndRSVP', array($parameters));
  }

  /**
   * 
   * @param GetEventById $parameters
   * @access public
   */
  public function GetEventById(GetEventById $parameters)
  {
    return $this->__soapCall('GetEventById', array($parameters));
  }

}
