<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Content-Type: application/json'); // Mueve esto aquí, antes de cualquier salida

    require_once("../conexion.php");
    require_once("../Modelos/producto.php");

    $control = $_GET['control'];

    $producto = new producto($conexion);

    $vec = array(); // Asegúrate de que $vec esté siempre inicializado

    switch ($control) {
        case 'consulta':
            $vec = $producto->consulta();
        break;

        case 'insertar':
            //$json = file_get_contents('php://input');
            $json = '{"nombre":"Borrador","descripcion":"Borrador blanco marca norma", "precio_compra":400, "precio_venta":600, "cantidad":4}'; //para probar el método insertar
            $params = json_decode($json);
            $vec = $producto->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id_producto'];
            $vec = $producto->eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id_producto'];
            $vec = $producto->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            //$dato = 'borrador';
            $vec = $producto->filtro($dato);
        break;

    }

    $datosjson = json_encode($vec);
    echo $datosjson;
    //header('Content-Type: application/json');
?>
