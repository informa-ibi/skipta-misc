<?php
    
    $mesagge = "my name is moin .!";
    $badge = 2 ;
    $sound = "default";
    $isDevelopment = false;
    $passphrase = 'techo2';
    
    $payload = array();
    $payload['aps'] = array(
        'alert' => $mesagge,
        'badge' => intval($badge),
        'sound' => $sound
       
    );
     $payload['livewellSocialId']=0;
     $payload['notificationType']=2;
    $payload = json_encode($payload);    
    
    $apns_url = NULL;
    $apns_cert = NULL;
    $apns_port = 2195;
    $isDevelopment=true;
    if($isDevelopment){
        $apns_url = "gateway.sandbox.push.apple.com";
        $apns_cert = "SkiptaNeo_Dev.pem";
        
    } else{
        $apns_url = "gateway.push.apple.com";
        $apns_cert = "Livewell_Prod.pem";
    }
    
    $stream_context = stream_context_create();
    stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);   
    stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
    $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
    
    if(!$apns){
        print "Failed To Connect : $error $error_string\n";
        return;
    } else{
        print 'Connection Successful..!\n';
    }
    
    $device_tokens = array(    
          "a0786dd38a678b6f139e12e864d0c59256c884c114f32126a0f2ea621869c0a8", /*distri i-Phone*/
        "6b41832f90a7702b2fc47828ec3c0448c48d24e06beeb485b4a3ef54ae624ab5"
    );
    
    foreach ($device_tokens as $device_token) {
        $apns_message = chr(0) . chr(0) . chr(32);
        $apns_message .= pack('H*', str_replace(' ', '', $device_token));
        $apns_message .= chr(0) . chr(strlen($payload)) . $payload; 
        
        fwrite($apns, $apns_message);
        
        //print "Notification Delivered : " . $payload ."\n";
    }
    
    print "Notification Delivered Successfully..!";
    
    //@socket_close($apns);
    @fclose($apns);
?>