<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../Modelos/saldoinicial.php");

$control = $_GET['control'];

$saldoinicial = new Saldoinicial($conexion);

switch ($control) {
    case 'consulta':
        $vec = $saldoinicial->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $saldoinicial->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id_saldoinicial'];
        $vec = $saldoinicial->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id_saldoinicial'];
        $vec = $saldoinicial->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $saldoinicial->filtro($dato);
        break;
}

$datosjson = json_encode($vec);
echo $datosjson;
?>