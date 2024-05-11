<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/cliente.php");

    $control = $_GET['control'];

    $cliente = new cliente($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $cliente->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $cliente->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_cliente'];
            $vec = $cliente->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_cliente'];
            $vec = $cliente->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $cliente->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>