<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$val = getLntFromZip('17522');
 echo "Latitude: ".$val['lat']."<br>";
 echo "Longitude: ".$val['lng']."<br>";
 
 $city = 'Philadelphia';
 $state = 'PA';
  $address  = $city." ".$state; 
 $val = getLntFromAddress($address);
 echo "<br>Latitude: ".$val['lat']."<br>";
 echo "<br>Longitude: ".$val['lng']."<br>";
 
 
 function getLntFromZip($zip){
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=
".urlencode($zip)."&sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
$result1[]=$result['results'][0];
$result2[]=$result1[0]['geometry'];
$result3[]=$result2[0]['location'];
return $result3[0];
}

 function getLntFromAddress($address){
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=
".urlencode($address)."&sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
$result1[]=$result['results'][0];
$result2[]=$result1[0]['geometry'];
$result3[]=$result2[0]['location'];
return $result3[0];
}