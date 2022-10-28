<?php

require_once(__DIR__ . '/Zeus3Api.php');

use ZEUS3api\ZEUS3Api;

$zeus = new ZEUS3api("10.0.0.1","admin","@Admin01");

if (!$zeus->connect()) {
		echo "Problemas ao conectar no IP ou senha do roteador!";
}

//$ret = $zeus->Get_Token_Array("10.0.0.1","admin","@Admin01");

$myToken = $zeus->GetToken();
echo $myToken;

echo $zeus->getHost();

echo $zeus->getUsername();

echo "<br><br>";

//print_r($ret);

print_r($zeus->getInternetStatus());

echo "<br>";

print_r($zeus->getDeviceStatus());

echo "<br>";

print_r($zeus->getDeviceInfo());

echo "<br>";

print_r($zeus->getInterfaceWireless());

echo "<br><br>";

print_r($zeus->getSystemStatus());

echo "<br><br>";

print_r($zeus->getInterfaceWireless_0_Clients());

echo "<br><br>";

print_r($zeus->getServiceStatistics());

echo "<br><br>";

print_r($zeus->getServiceFirewall());

echo "<br><br>";

print_r($zeus->getInterfaceLan1());


?>