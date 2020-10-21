<?php


 /**
   * @author Swathi
   * This class is used to assign badges for the existing user in the app
   */
class NetworkInviteCommand extends CConsoleCommand {

    public function run($args) {
        echo "NetworkInvite Command started";
        $this->inviteUsersToNetworks();
    }
    
    public function inviteUsersToNetworks()
    {
        $networkInvites = NetworkInvites::model()->getNetworkInvites(); 
        if($networkInvites!="failure" && count($networkInvites)>0 )
        foreach($networkInvites as $networkInvite)
        {
            $this->inviteNetworkToUsers($networkInvite);
        }
    }

   /**
     * @author Swathi
     * This is used to invite to network for each user
     */
    public function inviteNetworkToUsers($networkInvite) {
        try {


            $users = User::model()->getAllActiveUsers();
            foreach ($users as $user) {
                echo '---UserId is  ' . $user['UserId'];
              
                $this->inviteUserToNetwork($user['UserId'],$networkInvite);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }
    
    
    /**
     * @author Swathi
     * This is used to invite user to join the network.
     */

    public function inviteUserToNetwork($userId,$networkInvite) {
        try {

         $Oauth2Client=Oauth2Clients::model()->getOauth2ClientDetailsByCriteria("client_id",$networkInvite->ClientId);
         $isRegisterd=  $this->checkIfUserRegisertedWithNetwork($Oauth2Client,$userId);
         $postType = CommonUtility::sendPostType('NetworkInvite');
         $categoryId = CommonUtility::getIndexBySystemCategoryType('NetworkInvite');
         if($isRegisterd=="false")
         {
            //If user is not registered , then prepare the stream object with NetworkInvite category for this user.
             //Check if the stream has already this type of object, then just update the record
            $userStreamObj= UserStreamCollection::model()->getUserStreamObjByCriteria($categoryId,$userId,$networkInvite->id);
            if(count($userStreamObj)>0)
            {
                //Update the created date of the stream obj
                  $networkInviteCollectionObjSave=UserNetworkInviteCollection::model()->getUserNetworkInviteByCriteria($userId,$networkInvite->id);
                
                  UserStreamCollection::model()->updateStreamForNetworkInvite($userId,$categoryId,$networkInvite->id);
            }
            else
            {
                $networkInviteCollectionObj=array("UserId"=>$userId,"NetworkInviteId"=>$networkInvite->id,"NetworkName"=>$networkInvite->NetworkName,'NetworkClientId'=>$Oauth2Client->client_id);
                $networkInviteCollectionObjSave=UserNetworkInviteCollection::model()->saveUserNetworkInviteCollection($networkInviteCollectionObj);
                //prepare stream object for the post
                if($networkInviteCollectionObjSave!="error" )
                {
                if (!CommonUtility::prepareStreamObject($userId, "Post", $networkInviteCollectionObjSave, $categoryId, '', '',''))
                return "failure";
                }
            }
         }
        
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }
    
    /**
     * @author Swathi
     * This is used to assign badge to user based on the context
     * @param Object  $badge Badges object
     * @param int  $userId userId 
     */

    public function checkIfUserRegisertedWithNetwork($Oauth2Client, $userId) {
        try {
            $returnValue="true";
            
           if($Oauth2Client!="failure")
           {
            
           $Oauth2TokenInfo= Oauth2Tokens::model()->getOauth2TokenDetailsByCriteria($Oauth2Client->client_id,$userId);
        
            if($Oauth2TokenInfo!="failure" && count($Oauth2TokenInfo)>0)
            {
               
                $returnValue= "true";
            }
            else
            {
                
                $returnValue= "false"; 
            }
           
           }
           else
           {
                $returnValue= "true";
           }

           return $returnValue; 
         
            
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }


}
