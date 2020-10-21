<!-- Pop up  Content -->

 



<div class="networkcontnet padding0">
<div class="networklogos padding0">
<ul class="networkul">
<?php
try {
   
    $arrayyMore=array();
    $countValue=count($this->oAuthNetworksInfo);
$oAuthNetworksInfo=$this->oAuthNetworksInfo;
    for($i=0;$i<3;$i++) {
        $id=$oAuthNetworksInfo[$i]->NetworkName;
         $id=str_replace(" ",'',$id);
         $oauthLink="<a id= '".$id."' onclick='loginWithProvider(".'"'.$oAuthNetworksInfo[$i]->ProviderUrl."/oauth/access_token?client_id=".$oAuthNetworksInfo[$i]->ClientId."&response_type=token&redirect_uri=".Yii::app()->params['ServerURL']."/site/restLogin".'",'.'"'.$oAuthNetworksInfo[$i]->NetworkName.'",'.'"'.$oAuthNetworksInfo[$i]->ProviderUrl.'"'.")'> <img src='/images/network_logos/". $oAuthNetworksInfo[$i]->imageName.".png' /></a>";
        ?>
       
    
         <li><div class="networkpadding"><?php echo $oauthLink; ?></div></li>

  
     
        

    <?php  
}?>
  
</ul>
<?php if($countValue>3){?><div class=" pull-right more_networks_logos" ><a  id="networks" class="networks_arrow_down pull-right" onclick="showNetworks()">&nbsp;</a></div><?php }?>
</div>
</div> 

<div class="networklogos networklogos_more" id="network_logos" style=" display:none;">
<ul class="networkul more_networks ">
<?php for($i=3;$i<$countValue;$i++) {
         $id=$oAuthNetworksInfo[$i]->NetworkName;
         $id=str_replace(" ",'',$id);
         $oauthLink="<a id= '".$id."' onclick='loginWithProvider(".'"'.$oAuthNetworksInfo[$i]->ProviderUrl."/oauth/access_token?client_id=".$oAuthNetworksInfo[$i]->ClientId."&response_type=token&redirect_uri=".Yii::app()->params['ServerURL']."/site/restLogin".'",'.'"'.$oAuthNetworksInfo[$i]->NetworkName.'",'.'"'.$oAuthNetworksInfo[$i]->ProviderUrl.'"'.")'> <img src='/images/network_logos/". $oAuthNetworksInfo[$i]->imageName.".png' style='max-width:100%'/></a>";
            ?>
       
    
  <li><div class="networkpadding"><?php echo $oauthLink; ?></div></li>

  
     
        

    <?php  
              }?>
</ul>

</div>
<?php } catch (Exception $exc) {
    
}
?>

