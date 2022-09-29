<?php

$ultima="";

for ($i=0;$i<2;$i++) {
	for ($j=0;$j<$_REQUEST["almenas"];$j++) {
		echo "**** ";
	}
	echo "<br>";
}

for ($i=0;$i<$_REQUEST["almenas"];$i++) {
	$ultima.="*****";
}
echo substr($ultima, 0, -1)

?>
