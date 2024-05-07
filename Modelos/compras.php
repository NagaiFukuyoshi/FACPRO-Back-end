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
            $con = "SELECT co.*, p.nombre AS proveedor, pr.nombre AS producto FROM compras co
            INNER JOIN proveedor p ON co.fo_proveedor = id_proveedor
            INNER JOIN producto pr ON co.fo_producto = id_producto
            ORDER BY co.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE * FROM compras WHERE id_compra = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de compra ha sido eliminada";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO compra(fecha,fo_proveedor,fo_producto,precio_compra,cantidad,subtotal,IVA,retefuente,descuentos,total,fo_empleado) VALUES ('$params->fecha',$params->fo_proveedor,$params->fo_producto,$params->precio_compra,$params->cantidad,$params->subtotal,$params->IVA,$params->retefuente,$params->descuentos,$params->total";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de compra ha sido guardada";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE compra SET fecha = '$params->fecha', fo_proveedor = $params->fo_proveedor, fo_producto = $params->fo_producto,precio_compra = $params->precio_compra, cantidad = $params->cantidad, subtotal = $params->subtotal, IVA = $params->IVA, retefuente = $params->retefuente, descuentos = $params->descuentos, total = $params->total, WHERE id_compra = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La factura de compra ha sido editada";
            return $vec;
        }

        //método filtro
        public function filtro($valor) {
            $filtro = "SELECT co.*, p.nombre AS proveedor, pr.nombre AS producto FROM compras co
            INNER JOIN proveedor p ON co.fo_proveedor = id_proveedor
            INNER JOIN producto pr ON co.fo_producto = id_producto
            WHERE co.id_compra LIKE '%$valor%' OR co.proveedor LIKE %$valor% OR co.producto LIKE %$valor% OR co.fecha LIKE %$valor%";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [""] = $row;
            }

            return $vec;
        }
    }

?>