<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/empleado.php");

    $control = $_GET['control'];

    $empleado = new empleado($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $empleado->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $empleado->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $empleado->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $empleado->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $empleado->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>