<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/rol.php");

    $control = $_GET['control'];

    $rol = new rol($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $rol->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $rol->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_rol'];
            $vec = $rol->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_rol'];
            $vec = $rol->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $rol->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>