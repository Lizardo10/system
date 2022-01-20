<?php
/*
 * getdatos.php
 * 
 * Copyright 2021 APEX <APEX@DESKTOP-HV914JN>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>sin título</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.36" />
</head>

<body>
	<?php
date_default_timezone_set("America/Guatemala");
$customer=htmlspecialchars($_POST["nit"]);
$URL = "https://felgttestaws.digifact.com.gt/felapiv2/api/sharedInfo?NIT=000044653948&DATA1=SHARED_GETINFONITcom&DATA2=NIT|".$customer."&USERNAME=La_Lechita";
$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml','Authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IkdULjAwMDA0NDY1Mzk0OC5BUEVYX1RFU1QiLCJuYmYiOjE2MDY0NDIyMDQsImV4cCI6MTYzNzU0NjIwNCwiaWF0IjoxNjA2NDQyMjA0LCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjQ5MjIwIiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdDo0OTIyMCJ9.dp4NRMWq535-RnADr1AIf2IXbfKs2Ec305ZWcowebL4'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$response = json_decode($output, true);
foreach($response[RESPONSE] as $response1){

}
$name=strval($response1[NOMBRE]);
$state=strval($response1[DEPARTAMENTO]);
$city=strval($response1[MUNICIPIO]);

?>

<form action="getdatos.php" method="post">
    NIT:<br>
<input type="text" id="nit" name="nit" value="<?php echo $customer?>" >
<input type="submit" value="comprobar"><br>
NOMBRE:<br>
<input type="text" id="name" name="name" size="50" value="<?php echo $name?>"><br>
DEPARTAMENTO:<br>
<input type="text" id="name" name="name" size="50" value="<?php echo $state?>"><br>
MUNICIPIO:<br>
<input type="text" id="name" name="name" size="50" value="<?php echo $city?>"><br>

</form>


</body>

</html>
