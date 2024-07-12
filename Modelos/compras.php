<?php
    class compras {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT com.*, prov.nombre AS proveedor, prod.nombre AS producto, usu.nombre AS usuario, re.nombre AS retenciones, , met.nombre AS metodo_pago FROM compras com
                    INNER JOIN proveedor prov ON com.fo_proveedor = prov.id_proveedor
                    INNER JOIN producto prod ON com.fo_producto = prod.id_producto
                    INNER JOIN usuario usu ON com.fo_usuario = usu.id_usuario
                    INNER JOIN metodo_pago met ON com.fo_metodo_pago = met.id_metodo_pago
                    INNER JOIN retenciones re ON com.fo_retencion = re.id_retencion
                    ORDER BY com.fo_proveedor, com.fo_producto, com.fo_usuario, com.fo_metodo_pago, com.fo_retencion";
        
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
            $del = "DELETE FROM compras WHERE id_compras = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de compra ha sido eliminada";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO compras(fecha, fo_proveedor, fo_producto, precio_compra, cantidad, subtotal, IVA, retefuente, total_factura, total, fo_usuario, fo_codigo, fo_descripcion, fo_retencion, fo_metodo_pago, descripcion) 
                    VALUES ('$params->fecha', $params->fo_proveedor, $params->fo_producto, $params->precio_compra, $params->cantidad, $params->subtotal, $params->IVA, $params->retefuente, $params->total_factura, $params->total, $params->fo_usuario, $params->fo_codigo, '$params->fo_descripcion', $params->fo_retencion, $params->fo_metodo_pago, '$params->descripcion')";
        
            $result = mysqli_query($this->conexion, $ins);
        
            if (!$result) {
                die('Error en la consulta SQL: ' . mysqli_error($this->conexion));
            }
        
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "La factura de compra ha sido guardada";
            return $vec;
        }
        

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE compras SET fecha = '$params->fecha', fo_proveedor = $params->fo_proveedor, fo_producto = $params->fo_producto,precio_compra = $params->precio_compra, cantidad = $params->cantidad, subtotal = $params->subtotal, IVA = $params->IVA, retefuente = $params->retefuente, total_factura = $params->total_factura, total = $params->total, fo_usuario = $params->fo_usuario, fo_codigo = $params->fo_codigo, fo_descripcion = $params->fo_descripcion, fo_retencion = $params->fo_retencion, fo_metodo_pago = $params->fo_metodo_pago, descripcion = $params->descripcion WHERE id_compra = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de compra ha sido editada";
            return $vec;
        }

        //método filtro
        public function filtro($valor) {
            $filtro = "SELECT com.*, prov.nombre AS proveedor, prod.nombre AS producto, usu.nombre AS usuario, re.nombre AS retenciones, , met.nombre AS metodo_pago FROM compras com
                    INNER JOIN proveedor prov ON com.fo_proveedor = prov.id_proveedor
                    INNER JOIN producto prod ON com.fo_producto = prod.id_producto
                    INNER JOIN usuario usu ON com.fo_usuario = usu.id_usuario
                    INNER JOIN metodo_pago met ON com.fo_metodo_pago = met.id_metodo_pago
                    INNER JOIN retenciones re ON com.fo_retencion = re.id_retencion
                WHERE com.id_fo_proveedor LIKE '%$valor%' OR co.fecha LIKE %$valor%";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [""] = $row;
            }

            return $vec;
        }
    }

?>