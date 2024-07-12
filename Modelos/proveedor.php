<?php
    class proveedor {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT pr.*, d.nombre AS documento, c.nombre AS ciudad FROM proveedor pr
            INNER JOIN documento d ON pr.fo_documento = id_documento
            INNER JOIN ciudad c ON pr.fo_ciudad = id_ciudad
            ORDER BY pr.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM proveedor WHERE id_proveedor = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El proveedor ha sido eliminado";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO proveedor(fo_documento,fo_tipoTercero,num_documento,nombre,apellido,razon_social,fo_ciudad,direccion,telefono,email) VALUES ($params->fo_documento,$params->fo_tipoTercero,'$params->num_documento','$params->nombre','$params->apellido','$params->razon_social',$params->fo_ciudad,'$params->direccion','$params->telefono','$params->email')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El proveedor ha sido guardado";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE proveedor SET fo_documento = $params->fo_documento, fo_tipoTercero = $params->fo_tipoTercero, num_documento = $params->num_documento, nombre = '$params->nombre', apellido = '$params->apellido', razon_social = '$params->razon_social', fo_ciudad = $params->fo_ciudad, direccion = '$params->direccion', telefono = '$params->telefono', email = '$params->email' WHERE id_proveedor = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El proveedor ha sido editado";
            return $vec;
        }

        //método filtro
        public function filtro($dato) {
            $dato = mysqli_real_escape_string($this->conexion, $dato);
            $filtro =  "SELECT * FROM proveedor WHERE nombre LIKE '%$dato%' OR apellido LIKE '%$dato%' OR num_documento LIKE '%$dato%' OR razon_social LIKE '%$dato%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            if (!$res) {
                die('Query Error: ' . mysqli_error($this->conexion));
            }
    
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }

            return $vec;
        }
    }

?>