<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/tipoTercero.php");

    $control = $_GET['control'];

    $tipoTercero = new tipoTercero($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $tipoTercero->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $tipoTercero->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_tipoTercero'];
            $vec = $tipoTercero->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_tipoTercero'];
            $vec = $tipoTercero->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $tipoTercero->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>