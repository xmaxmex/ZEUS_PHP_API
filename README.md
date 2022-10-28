# ZEUS_PHP_API
API PHP para integração com o projeto ZEUS da Intelbras

Precisa da lib CURL
Testado com PHP 5.6 e 7.2

Uso da Class:

<?php

require_once(__DIR__ . '/Zeus3Api.php');

use ZEUS3api\ZEUS3Api;

// IP do seu Intelbras AP 1350, AP 1750, AP 1250 e etc
// e sua senha modificado já no primeiro acesso aos Acess Point
$zeus = new ZEUS3api("10.0.0.1","admin","@Admin01");

if (!$zeus->connect()) {
		echo "Problemas ao conectar no IP ou senha do roteador!";
}

$myToken = $zeus->GetToken();
echo $myToken;

echo $zeus->getHost();

echo $zeus->getUsername();

echo "<br><br>";

print_r($zeus->getInternetStatus());

echo "<br>";

print_r($zeus->getDeviceStatus());

echo "<br>";

print_r($zeus->getDeviceInfo());

?>
