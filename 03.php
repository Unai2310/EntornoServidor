<?php

use LDAP\Result;

include_once('variablesref.php'); 
$num1 = random_int(1,10);
$num2 = random_int(1,10);

$resultado = 0;

calSuma($num1, $num2, $resultado);
echo $num1 ." + ". $num2 ." = ". $resultado ."<br>";

calResta($num1, $num2, $resultado);
echo $num1 ." - ". $num2 ." = ". $resultado ."<br>";

calMulti($num1, $num2, $resultado);
echo $num1 ." * ". $num2 ." = ". $resultado ."<br>";

calDivision($num1, $num2, $resultado);
echo $num1 ." / ". $num2 ." = ". $resultado ."<br>";

calMod($num1, $num2, $resultado);
echo $num1 ." % ". $num2 ." = ". $resultado ."<br>";

calPot($num1, $num2, $resultado);
echo $num1 ." ^ ". $num2 ." = ". $resultado ."<br>";

?>