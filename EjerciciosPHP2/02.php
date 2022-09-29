<?php

use LDAP\Result;

require_once('funcionesvariables.php'); 
$num1 = random_int(1,10);
$num2 = random_int(1,10);

$resultado = calSuma($num1, $num2);
echo $num1 ." + ". $num2 ." = ". $resultado ."<br>";

$resultado = calResta($num1, $num2);
echo $num1 ." - ". $num2 ." = ". $resultado ."<br>";

$resultado = calMulti($num1, $num2);
echo $num1 ." * ". $num2 ." = ". $resultado ."<br>";

$resultado = calDivision($num1, $num2);
echo $num1 ." / ". $num2 ." = ". $resultado ."<br>";

$resultado = calMod($num1, $num2);
echo $num1 ." % ". $num2 ." = ". $resultado ."<br>";

$resultado = calPot($num1, $num2);
echo $num1 ." ^ ". $num2 ." = ". $resultado ."<br>";

?>