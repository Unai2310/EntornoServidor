<html>
<body>
	<h1>Ejercicio 4</h1>
	<code>
		<?php
$contadorintentos = 0;
$contador6 = 0;
$tiempoantes = microtime(true);
$numAnterior = 0;
do {
    $numero = random_int(1, 10);
    $contadorintentos ++;
    if ($numero == 6) {
            // Hay un seis
            $contador6++;
    }
    else {
        // No hay seis
        $contador6 = 0;
    }
    $numAnterior = $numero;
} while ($contador6 < 3);
$tiempoInvertido = microtime(true)-$tiempoantes;
echo "Han salido tres 6 seguidos tras generar ".$contadorintentos." números en ".
        ($tiempoInvertido * 1000) . " milisegundos.";
?>
</code>
</body>
</html>
