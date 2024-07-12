<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once("../conexion.php");
require_once("../Modelos/notacontable.php");

$control = $_GET['control'];

$notacontable = new Notacontable($conexion);

switch ($control) {
    case 'consulta':
        $vec = $notacontable->consulta();
        break;

    case 'insertar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $notacontable->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id_nota'];
        $vec = $notacontable->eliminar($id);
        break;

    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id_nota'];
        $vec = $notacontable->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $notacontable->filtro($dato);
        break;
}

$datosjson = json_encode($vec);
echo $datosjson;
?>