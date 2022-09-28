<?php


$a=random_int(1,100);
$b=random_int(1,100);
$c=0;


elMayor($a,$b,$c);

function elMayor($a,$b,&$c){

if($a>$b){
    $c=$a;
}else if($b>$a){
    $c=$b;
}

echo "el valor de a es ". $a."<br>";
echo "el valor de b es ". $b."<br>";
echo $c;

}


?>