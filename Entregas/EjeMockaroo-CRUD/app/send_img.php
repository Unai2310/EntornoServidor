<?php
    header('Content-Type: image/jpg');
    readfile("uploads/".$_GET["id"]);
?>
