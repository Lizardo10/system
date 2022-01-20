<?php
date_default_timezone_set("America/Guatemala");

$nit=substr($customer, strpos($customer, "-")+2);
$customer1=substr($customer,0, strpos($customer, "-")-1);
$URL = "https://felgttestaws.digifact.com.gt/felapiv2/api/sharedInfo?NIT=000044653948&DATA1=SHARED_GETINFONITcom&DATA2=NIT|00&USERNAME=La_Lechita";
$ch = curl_init($URL);
//curl_setopt($ch, CURLOPT_MUTE, 2);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($ch, CURLOPT_GET, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml','Authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IkdULjAwMDA0NDY1Mzk0OC5BUEVYX1RFU1QiLCJuYmYiOjE2MDY0NDIyMDQsImV4cCI6MTYzNzU0NjIwNCwiaWF0IjoxNjA2NDQyMjA0LCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjQ5MjIwIiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdDo0OTIyMCJ9.dp4NRMWq535-RnADr1AIf2IXbfKs2Ec305ZWcowebL4'));
//curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$response = json_decode($output, true);
print_r($response);

?>
	
	
	
