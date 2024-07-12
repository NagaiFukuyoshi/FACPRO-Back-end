<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../Modelos/recibos.php");

$control = $_GET['control'];

$recibos = new Recibos($conexion);

switch ($control) {
    case 'consulta':
        $vec = $recibos->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $recibos->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id_recibo'];
        $vec = $recibos->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id_recibo'];
        $vec = $recibos->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $recibos->filtro($dato);
        break;
}

$datosjson = json_encode($vec);
echo $datosjson;
?>