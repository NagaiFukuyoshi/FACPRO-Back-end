<?php
    class producto {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT * FROM producto ORDER BY id_producto ASC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM producto WHERE id_producto = $id";
            if(mysqli_query($this->conexion, $del)) {
                $vec = ["resultado" => "ok", "mensaje" => "El producto ha sido eliminado"];
            } else {
                $vec = ["resultado" => "error", "mensaje" => "Error al eliminar el producto: " . mysqli_error($this->conexion)];
            }
            return $vec;
        }
        

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO producto(nombre, descripcion, precio_compra, precio_venta, precio_venta2, precio_venta3, cantidad, codigo, fo_iva, marca) 
                    VALUES ('$params->nombre', '$params->descripcion', $params->precio_compra, $params->precio_venta, $params->precio_venta2, $params->precio_venta3, $params->cantidad, '$params->codigo', $params->fo_iva, '$params->marca')";

            $result = mysqli_query($this->conexion, $ins);
        
            if (!$result) {
                die('Error en la consulta SQL: ' . mysqli_error($this->conexion));
            }
        
            $vec = [];
            $vec["resultado"] = "ok";
            $vec["mensaje"] = "El producto ha sido guardado";
            return $vec;
        }


        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE producto SET nombre = '$params->nombre', marca = '$params->marca', descripcion = '$params->descripcion', precio_compra= $params->precio_compra, precio_venta = $params->precio_venta, precio_venta2 = $params->precio_venta2, precio_venta3 = $params->precio_venta3, fo_iva = $params->fo_iva, cantidad = $params->cantidad, codigo = $params->codigo WHERE id_producto = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido editado";
            return $vec;
        }

        //método filtro
        public function filtro($dato) {
            $dato = mysqli_real_escape_string($this->conexion, $dato);
            $filtro = "SELECT * FROM producto WHERE nombre LIKE '%$dato%' OR codigo LIKE '%$dato%' ";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
        
            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
        
            return $vec;
        }
    }
?>