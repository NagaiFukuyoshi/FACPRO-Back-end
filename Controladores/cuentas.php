<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/cuentas.php");

    $control = $_GET['control'];

    $cuentas = new cuentas($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $cuentas->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Ecuador"}'; //para probar el método insertar
            $params = json_decode($json);
            $vec = $cuentas->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_cuenta'];
            $vec = $cuentas->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Brasil"}'; //para probar el método editar
            $params = json_decode($json);
            $id = $_GET['id_cuenta'];
            $vec = $cuentas->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato']; //para probar el método filtro
            //$dato = 'Brasil';
            $vec = $cuentas->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>