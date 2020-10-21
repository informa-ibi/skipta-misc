 <?php
               // Replace with real server API key from Google APIs  
                $apiKey = "AIzaSyA31FQPuRwaVK7E3Te_ON49WeVeBR4OpfA";    

                  // Replace with real client registration IDs
               $registrationIDs = array("APA91bFyeVYjVbDquyNEF-UalQ-lLZYUtcsZRZS2StXQpzBdP-rEP31PqA9YNIgvClxzvqtdI8KqxRQQWManMJyW6A5mq2FN-ffyApqh944Flo0ZW0q9N1aiOiFt9MCSCUQTusV3CmqLRyf-dE1zVaY_CeChlV3XaA","APA91bFVoj_ajtXUYCTgWTiKUA1gqZoptxKD7r-4jmwabF9aA66ydgy3Kn1lz0RmlsW7gwAGIEZmuOABrbinhazsBI6_APjokGWh9B-lhZfjjmhQfr5iFckML_dCIBulsY9FR8QUZERhI8nGv2P5xBsS4X67UlNsvA,APA91bGuL8X0e7Yiehl0M6IprTdLF9Azo7HDYsGjuLKm1jjtcR4osolNkMhlDBgXV9dRt7UWGamGWRxF3-1Vfuo4oxxTJMlMG2Akhd0xXVN-Z5SZw0pHDXIK79jDfap5k-7fB5x52lAQoOwEDYk_A61zQr3HXGwtrg");

              // Message to be sent
             $message = "hi this is moin ";

             // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';

           $fields = array(
           'registration_ids' => $registrationIDs,
             'data' => array("title"=>'Skipta', "message" => $message,"msgcnt" =>25,"livewellSocialId"=>17,"notificationType"=>6 ),
            );
         $headers = array(
          'Authorization: key=' . $apiKey,
         'Content-Type: application/json'
          );

         // Open connection
              $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         //     curl_setopt($ch, CURLOPT_POST, true);
           //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields ));

                // Execute post
             $result = curl_exec($ch);

            // Close connection
               curl_close($ch);
             echo $result;
              //print_r($result);
               //var_dump($result);
           ?>
