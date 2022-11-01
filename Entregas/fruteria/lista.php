<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=+, initial-scale=1.0">
    <title>Fruteria XXI</title>
</head>
<body>
    <h3>Este es su pedido: </h3>
    <table style="border: 1px solid black">
        <?php
        if (isset($_SESSION['pedido'])) {
            foreach ($_SESSION['pedido'] as $key => $value) {
                echo "<tr>";
                echo "<td> $key  $value </td>";
                echo "</tr>";
            }
        } 
        ?>
    </table>
</body>
</html>