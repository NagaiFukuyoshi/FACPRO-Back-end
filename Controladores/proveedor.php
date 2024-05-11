<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/proveedor.php");

    $control = $_GET['control'];

    $proveedor = new proveedor($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $proveedor->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $vec = $proveedor->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_proveedor'];
            $vec = $proveedor->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_proveedor'];
            $vec = $proveedor->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $proveedor->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>