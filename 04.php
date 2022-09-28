<?php

$max=0;
$min=100;
$media=0;

const cien=100;
const cincuenta=50;

for($i=0;$i<cincuenta;$i++){
$random=random_int(1,cien);

if($random>$max){
$max=$random;
}

if($random<$min){
$min=$random;
}

$media=$media+$random;
}

$media=$media/cincuenta;

echo "<table style=\"border:1px solid black\",\"cellspacing:0\"
<tr border=1px solid black><th colspan=2>Generación de 50 valores aleatorios</th></tr>
<tr><th>Maximo</th><th>".$max."</th></tr></table>";
echo "Maximo: ".$max."<br>";
echo "Minimo: ".$min."<br>";
echo "Media: ".$media;
?>