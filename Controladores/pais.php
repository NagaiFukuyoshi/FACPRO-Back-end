<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../Modelos/pais.php");

    $control = $_GET['control'];

    $pais = new pais($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $pais->consulta();
        break;

        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Colombia"}';
            $params = json_decode($json);
            $vec = $pais->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_pais'];
            $vec = $pais->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Canada"}';
            $params = json_decode($json);
            $id = $_GET['id_pais'];
            $vec = $pais->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            //$dato = 'Colombia';
            $vec = $pais->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    header('Content-Type: application/json');
?>