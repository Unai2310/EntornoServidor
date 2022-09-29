<html>
	<head>
	<title>Cuadrados de colores</title>
	<style>
	body {
		background: silver;
		text-align: justify;
		font-family: Tahoma, Geneva, sans-serif;
		font-size: 14px;
		color: #757E82;
	}

	table, th, td {
	  border: 1px solid black;
	} 
	</style>
	</head>
	<body>
	<h1>Tablero de colores</h1>
		<table>
			<?php
		
			function dameColor(){
				$color = "rgb(".random_int(1,255).",".random_int(1,255).",".random_int(1,255).")"; 
				return $color;
			}
			for ($i =1; $i<=10; $i++){
				echo "<tr>";
				for ($j = 1; $j<=10; $j++){
				    $color = dameColor();
				    echo "<td style=\"background-color:$color; height:40px; width:40px\"></td>";
				}
				echo "</tr>";
			}
		    ?>
        </table>
	</body>
</html>
