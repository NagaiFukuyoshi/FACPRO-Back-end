<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/tipo_factura.php");

    $control = $_GET['control'];

    $tipo_factura = new Tipo_factura($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $tipo_factura->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $tipo_factura->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_tipo_factura'];
            $vec = $tipo_factura->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_tipo_factura'];
            $vec = $tipo_factura->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $tipo_factura->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>