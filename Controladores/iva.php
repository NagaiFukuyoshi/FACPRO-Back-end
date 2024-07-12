<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/iva.php");

    $control = $_GET['control'];

    $iva = new iva($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $iva->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $iva->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_iva'];
            $vec = $iva->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_iva'];
            $vec = $iva->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $iva->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>