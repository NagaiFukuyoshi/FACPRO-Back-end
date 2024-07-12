<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/retenciones.php");

    $control = $_GET['control'];

    $retenciones = new Retenciones($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $retenciones->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $retenciones->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_retencion'];
            $vec = $retenciones->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_retencion'];
            $vec = $retenciones->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $retenciones->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>