<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/documento.php");

    $control = $_GET['control'];

    $documento = new documento($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $documento->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $documento->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_documento'];
            $vec = $documento->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_documento'];
            $vec = $documento->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $documento->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>