<?php
    header('Content-Type: image/jpg');
    readfile(__DIR__."/../uploads/".$_GET["id"]);
?>
