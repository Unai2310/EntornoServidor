<html>
</style>
</head>
<body>
<?php
   $n1 =  random_int(1,9);
   $n2 = $n1 -1;
   ?>
   <code><?php
   for($i = 1; $i <= $n1;$i++){
       for($j = $n2; $j > 0;$j--){
           echo "&nbsp";
       }
       $n2--;
       for($k = 1; $k <=2*$i -1;$k++){
           echo "*";
       }
       echo "<br/>";
       
   }
?>
</code>
</body>
</html>
