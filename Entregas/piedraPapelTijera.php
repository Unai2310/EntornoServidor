<html>
	<head>
	<title>Piedra Papel Tijeras</title>
	<meta charset="utf-8">
	</head>
	<body>
	<h1>¡Piedra, papel, tijera!</h1>
	<sub>Actualice la página para mostrar otra partida</sub>
	<?php

	define('PIEDRA1', '&#x1F91C;');
	define('PIEDRA2', '&#x1F91B;');
	define('TIJERAS', '&#x1F596;');
	define('PAPEL', '&#x1F91A;');

	$j1 = random_int(1,3);
	$j2 = random_int(1,3);

	echo "<p><b>Jugador 1&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspJugador 2</b></p>";
	echo "<span style=\"font-size: 7em;\">".pintarP1($j1)."</span>";
	echo "<span style=\"font-size: 7em;\">".pintarP2($j2)."</span>";
	echo "<p align center><b>".obtenerResultado($j1, $j2)."</b></p>";

	function obtenerResultado($p1, $p2) {
		if ($p1 == $p2) {
			return "!Empate!";
		}else if ($p1 == 1 && $p2 == 2) {
			return "Ha ganado el jugador 2";
		}else if ($p1 == 1 && $p2 == 3) {
			return "Ha ganado el jugador 1";
		}else if ($p1 == 2 && $p2 == 1) {
			return "Ha ganado el juagdor 1";
		}else if ($p1 == 2 && $p2 == 3) {
			return "Ha ganado el jugador 2";
		}else if ($p1 == 3 && $p2 == 1) {
			return "Ha ganado el jugador 2";
		}else {
			return "Ha ganado el jugador 1";
		}
	}

	function pintarP1($jugada) {
		if ($jugada == 1) {
			return PIEDRA1;
		}else if ($jugada == 2) {
			return PAPEL;
		}else {
			return TIJERAS;
		}
	}

	function pintarP2($jugada) {
		if ($jugada == 1) {
			return PIEDRA2;
		}else if ($jugada == 2) {
			return PAPEL;
		}else {
			return TIJERAS;
		}
	}
	?>

	</body>
</html>

