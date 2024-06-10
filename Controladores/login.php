<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/login.php");

    $correo = $_GET['correo'];
    $password = $_GET['password'];

    $login = new login($conexion);

    $vec = $login->consulta($correo, $password);

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>