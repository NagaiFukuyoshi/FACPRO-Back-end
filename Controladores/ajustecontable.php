<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../Modelos/ajustecontable.php");

$control = $_GET['control'];

$ajustecontable = new Ajustecontable($conexion);

switch ($control) {
    case 'consulta':
        $vec = $ajustecontable->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $ajustecontable->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id_ajuste'];
        $vec = $ajustecontable->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id_ajuste'];
        $vec = $ajustecontable->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $ajustecontable->filtro($dato);
        break;
}

$datosjson = json_encode($vec);
echo $datosjson;
?>