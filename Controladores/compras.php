<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/compras.php");

    $control = $_GET['control'];

    $compras = new compras($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $compras->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $compras->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_compras'];
            $vec = $compras->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_compras'];
            $vec = $compras->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $compras->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>