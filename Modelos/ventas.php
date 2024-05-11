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
            $con = "SELECT v.*, cl.nombre AS cliente, emp.nombre AS empleado, pr.nombre AS producto FROM ventas v
            INNER JOIN cliente cl ON v.fo_cliente = id_cliente
            INNER JOIN empleado emp ON v.fo_empleado = id_empleado
            INNER JOIN producto pr ON v.fo_producto = id_producto
            ORDER BY v.fo_cliente, v.fo_empleado, v.fo_producto";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
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
            $ins = "INSERT INTO ventas(fecha,fo_cliente,fo_producto,precio_venta,cantidad,subtotal,IVA,retefuente,descuentos,total,fo_empleado) VALUES ('$params->fecha',$params->fo_cliente,$params->fo_producto,$params->precio_venta,$params->cantidad,$params->subtotal,$params->IVA,$params->retefuente,$params->descuentos,$params->total";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de venta ha sido guardada";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE venta SET fecha = '$params->fecha', fo_cliente = $params->fo_cliente, fo_producto = $params->fo_producto,precio_venta = $params->precio_venta, cantidad = $params->cantidad, subtotal = $params->subtotal, IVA = $params->IVA, retefuente = $params->retefuente, descuentos = $params->descuentos, total = $params->total, WHERE id_venta = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de venta ha sido editada";
            return $vec;
        }

        //método filtro
        public function filtro($valor) {
            $filtro = "SELECT v.*, cl.nombre AS cliente, pr.nombre AS producto FROM ventas v
            INNER JOIN cliente cl ON v.fo_proveedor = id_cliente
            INNER JOIN producto pr ON v.fo_producto = id_producto
            WHERE v.id_compra LIKE '%$valor%' OR v.proveedor LIKE %$valor% OR v.producto LIKE %$valor% OR v.fecha LIKE %$valor%";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [""] = $row;
            }

            return $vec;
        }
    }

?>