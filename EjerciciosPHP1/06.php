<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
      <h1>TABLA DE MULTIPLICAR</h1>
      <div id="content">
        
        <table>
         <?php
         $num = random_int(1,10);
         ?>
         <tr><th>Tabla del <?=$num ?> </th><th></th></tr>
        <?php   
        
        for ($i=1; $i <= 10; $i++){
          echo "<tr><td> $num x $i =  </td><td style=\"text-align:right\">". ($i*$num). "</td>";         
        }
        ?>
        </table>        
    	</div>
</body>
</html>
