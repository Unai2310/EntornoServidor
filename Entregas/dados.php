<html>
	<head>
	<title>Cinco Dados</title>
	<meta charset="utf-8">
	</head>
	<body>
	<h1>Cinco Dados</h1>
	<sub>Actualice la página para mostrar una nueva tirada</sub>
	<?php

	define('uno', '&#9856;');
	define('dos', '&#9857;');
	define('tres', '&#9858;');
	define('cuatro', '&#9859;');
	define('cinco', '&#9860;');
	define('seis', '&#9861;');

	$puntos1=0;
	$puntos2=0;

	$j1=[];
	tirarDados($j1);
	$j2=[];
	tirarDados($j2);
	
	echo "<p><b>Jugador 1: </b>";
	foreach ($j1 as $num) {
		echo "<span style=\"font-size: 3rem;\">".pintarDados($num)."</span>";
	}
	echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".obtenerResultado($j1, $puntos1)."</p>";

	echo "<p><b>Jugador 2: </b>";
	foreach ($j2 as $num) {
		echo "<span style=\"font-size: 3rem;\">".pintarDados($num)."</span>";
	}
	echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".obtenerResultado($j2, $puntos2)."</p>";
	
	echo "<p>".obtenerGanador($puntos1, $puntos2)."</p>";

	function tirarDados(&$jugada) {
		for ($i=0;$i<5;$i++) {
			$jugada[]=random_int(1,6);
		}
	}


	function obtenerResultado($jugada, &$puntos) {
		sort($jugada);
		$puntos= $jugada[1] + $jugada[2] + $jugada[3];
		return $puntos." puntos";
	}

	function obtenerGanador($p1, $p2) {
		if ($p1 == $p2) {
			return "<b>Resultado</b> Empate";
		} else if ($p1 > $p2) {
			return "<b>Resultado</b> Ha ganado el jugador 1";
		} else {
			return "<b>Resultado</b> Ha ganado el jugador 2";
		}
	}

	function pintarDados($dado) {
		if ($dado == 1) {
			return uno;
		} else if ($dado == 2) {
			return dos;
		} else if ($dado == 3) {
			return tres;
		} else if ($dado == 4) {
			return cuatro;
		} else if ($dado == 5) {
			return cinco;
		} else {
			return seis;
		}
	}
	?>

	</body>
</html>

