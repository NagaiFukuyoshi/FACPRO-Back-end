<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../Modelos/comprobantes.php");

$control = $_GET['control'];

$comprobantes = new Comprobantes($conexion);

switch ($control) {
    case 'consulta':
        $vec = $comprobantes->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $comprobantes->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id_comprobante'];
        $vec = $comprobantes->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id_comprobante'];
        $vec = $comprobantes->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $comprobantes->filtro($dato);
        break;
}

$datosjson = json_encode($vec);
echo $datosjson;
?>