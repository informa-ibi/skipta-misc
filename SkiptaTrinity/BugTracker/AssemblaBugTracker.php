
<?php 

define('ASSEMBLA_KEY', '06a8de0f65872e91365d');
define('ASSEMBLA_SECRET', 'dc2744a50180061f4f424bd1ecd59d56578cc5b9');
define('ASSEMBLA_SPACE', 'skipta-neo');

require_once('assembla.class');


try{

// Connecting, selecting database
$link = mysql_connect('localhost', 'root', 'SkiptaNeo2013!')
        or die('Could not connect: ' . mysql_error());
//echo 'Connected successfully';
mysql_select_db('Trinity') or die('Could not select database');

// Performing SQL query

$query = 'SELECT * FROM YIIAssemblaConf where Id=1';

$res = mysql_query($query);
$LogId = mysql_fetch_object($res)->YiiLogId;
//echo $LogId;

$query = 'SELECT * FROM YiiLog where id > ' . $LogId;
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$data = array();
while ($line1 = mysql_fetch_array($result)) {
    array_push($data, $line1);
}


foreach ($data as $line) {


    $message = stripslashes($line['message']);
    $selectQuery1 = "select * from YiiAssemblaTicket where message like '%$message%' order by Id desc limit 1 ";
    $selQueryres = mysql_query($selectQuery1); //"select * from YiiAssemblaTicket where message like '%testtttreddytttttttttttt in /opt/lampp/htdocs/CoActive/protected/components/Controller.php (47)%' order by Id desc limit 1") or die('88888888888888888888888');

    $S_Obj = mysql_fetch_object($selQueryres);

    if (isset($S_Obj->message)) {
        try{
echo "ticket updated -------------------------";
        /* To get ticket#68 details */
        $ticket_number = $S_Obj->TicketNumber;
//$custom_fields	= array('xxxx'=>'00000');
        $D = new Assembla();
        $response = $D->getTicket($ticket_number);
        $jsonDecodeObject = json_decode($response);
        $status = $jsonDecodeObject->status;
        if ($status == "Fixed" || $status == "Deployed" || $status == "Invalid") {
            /* To update the status of the ticket */

            $status = 'Re-opened';
           //$custom_fields	= array('xxxx'=>'00000');
            $B = new Assembla();
            $response = $B->statusUpdate($ticket_number, $status);
           
        }
        
         $query3 = "update YiiAssemblaTicket  set NoOfOccurance=NoOfOccurance+1   where  where message like '%$message%'";
         $result3 = mysql_query($query) or die('Query failed: ' . mysql_error());
        
        }catch(Exception $e){
    
            error_log(" excepiton occured while update  ticket into assembla");
    
}
    } else {
        
echo "ticket created -------------------------";
try{
        $title = $line['message'];
        $descritpion = $line['message'];
        $priority = 'normal';
        $estimate = 'none';
        //$custom_fields	= array('xxxx'=>'00000');
        $milestone_id = '7833283';
        $A = new Assembla();
        $response = $A->createTicket($title, $descritpion, $priority, $estimate, $milestone_id);
      //  print_r('Ticket Created: ' . $response);

        $jsonDecodeObject = json_decode($response);
       //echo json_decode($response)->id;
        $message = trim(preg_replace('/\s+/', ' ', $line['message']));
        $insertQuery = "insert into YiiAssemblaTicket (level,category,logtime,IP_User,user_name,request_URL,message,TicketId,TicketType,TicketNumber,NoOfOccurance) values('" . $line['level'] . "','" . $line['category'] . "','" . $line['logtime'] . "','" . $line['IP_User'] . "','" . $line['user_name'] . "','" . $line['request_URL'] . "','" . $message . "',$jsonDecodeObject->id,'NEW',$jsonDecodeObject->number,1)";
        mysql_query($insertQuery);
        }catch(Exception $e){
    
            error_log(" excepiton occured while inserted  or created ticket into assembla");
    
}

    }
    
    
    $query = "update YIIAssemblaConf  set YiiLogId=".$line['id']."   where Id=1";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}


// Free resultset
//mysql_free_result($result);

// Closing connection
mysql_close($link);
}catch(Exception $e){
    
  error_log(" excepiton occured while process automation  error log system");  
}


?>
