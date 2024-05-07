<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $bd ="facpro";

    $conexion = mysqli_connect($servidor, $usuario, $clave) or die ("No se encontró el servidor");
    mysqli_select_db($conexion, $bd) or die ("No se encontró la base de datos");
    mysqli_set_charset($conexion,"utf8");
?>