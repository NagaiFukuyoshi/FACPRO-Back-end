<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/metodo_pago.php");

    $control = $_GET['control'];

    $metodo_pago = new Metodo_pago($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $metodo_pago->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Ecuador"}'; //para probar el método insertar
            $params = json_decode($json);
            $vec = $metodo_pago->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_metodo_pago'];
            $vec = $metodo_pago->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Brasil"}'; //para probar el método editar
            $params = json_decode($json);
            $id = $_GET['id_metodo_pago'];
            $vec = $metodo_pago->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato']; //para probar el método filtro
            //$dato = 'Brasil';
            $vec = $metodo_pago->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>