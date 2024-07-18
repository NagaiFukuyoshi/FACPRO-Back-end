<?php
    class ventas {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT ven.*, cli.nombre AS cliente, prod.nombre AS producto, usu.nombre AS usuario, re.nombre AS retenciones, met.nombre AS metodo_pago FROM ventas ven
                    INNER JOIN cliente cli ON ven.fo_cliente = cli.id_cliente
                    INNER JOIN producto prod ON ven.fo_producto = prod.id_producto
                    INNER JOIN usuario usu ON ven.fo_usuario = usu.id_usuario
                    INNER JOIN metodo_pago met ON ven.fo_metodo_pago = met.id_metodo_pago
                    INNER JOIN retenciones re ON ven.fo_retencion = re.id_retencion
                    ORDER BY ven.fo_cliente, ven.fo_producto, ven.fo_usuario, ven.fo_metodo_pago, ven.fo_retencion";
        
            $res = mysqli_query($this->conexion, $con);
        
            // Verificar si hay un error en la consulta
            if (!$res) {
                die('Error en la consulta SQL: ' . mysqli_error($this->conexion));
            }
        
            $vec = [];
        
            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
        
            return $vec;
        }
        
        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM ventas WHERE id_venta = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de venta ha sido eliminada";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO ventas(fecha, fo_cliente, fo_producto, precio_venta, cantidad, subtotal, IVA, retefuente, total_factura, total, fo_usuario, fo_codigo, fo_descripcion, fo_retencion, fo_metodo_pago, descripcion) 
                    VALUES ('$params->fecha', $params->fo_cliente, $params->fo_producto, $params->precio_venta, $params->cantidad, $params->subtotal, $params->IVA, $params->retefuente, $params->total_factura, $params->total, $params->fo_usuario, $params->fo_codigo, '$params->fo_descripcion', $params->fo_retencion, $params->fo_metodo_pago, '$params->descripcion')";
        
            $result = mysqli_query($this->conexion, $ins);
        
            if (!$result) {
                die('Error en la consulta SQL: ' . mysqli_error($this->conexion));
            }
        
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "La factura de venta ha sido guardada";
            return $vec;
        }
        
        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE ventas SET fecha = '$params->fecha', fo_cliente = $params->fo_cliente, fo_producto = $params->fo_producto,precio_venta = $params->precio_venta, cantidad = $params->cantidad, subtotal = $params->subtotal, IVA = $params->IVA, retefuente = $params->retefuente, total_factura = $params->total_factura, total = $params->total, fo_usuario = $params->fo_usuario, fo_codigo = $params->fo_codigo, fo_descripcion = $params->fo_descripcion, fo_retencion = $params->fo_retencion, fo_metodo_pago = $params->fo_metodo_pago, descripcion = $params->descripcion WHERE id_venta = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de compra ha sido editada";
            return $vec;
        }

        //método filtro
        public function filtro($valor) {
            $filtro = "SELECT ven.*, prov.nombre AS cliente, prod.nombre AS producto, usu.nombre AS usuario, re.nombre AS retenciones, , met.nombre AS metodo_pago FROM ventas ven
                    INNER JOIN cliente prov ON ven.fo_cliente = prov.id_cliente
                    INNER JOIN producto prod ON ven.fo_producto = prod.id_producto
                    INNER JOIN usuario usu ON ven.fo_usuario = usu.id_usuario
                    INNER JOIN metodo_pago met ON ven.fo_metodo_pago = met.id_metodo_pago
                    INNER JOIN retenciones re ON ven.fo_retencion = re.id_retencion
                WHERE ven.id_fo_cliente LIKE '%$valor%' OR ven.fecha LIKE %$valor%";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [""] = $row;
            }

            return $vec;
        }
    }

?>