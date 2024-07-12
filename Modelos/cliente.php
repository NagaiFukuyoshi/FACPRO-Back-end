<?php
    class cliente {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT cl.*, d.nombre AS documento, c.nombre AS ciudad FROM cliente cl
            INNER JOIN documento d ON cl.fo_documento = id_documento
            INNER JOIN ciudad c ON cl.fo_ciudad = id_ciudad
            ORDER BY cl.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM cliente WHERE id_cliente = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El cliente ha sido eliminado";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO cliente(fo_documento,fo_tipoTercero,num_documento,nombre,apellido,razon_social,fo_ciudad,direccion,telefono,email) VALUES ($params->fo_documento,$params->fo_tipoTercero,'$params->num_documento','$params->nombre','$params->apellido','$params->razon_social',$params->fo_ciudad,'$params->direccion','$params->telefono','$params->email')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El cliente ha sido guardado";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE cliente SET fo_documento = $params->fo_documento, num_documento = $params->num_documento, nombre = '$params->nombre', apellido = '$params->apellido', razon_social = '$params->razon_social', fo_ciudad = $params->fo_ciudad, direccion = '$params->direccion', telefono = '$params->telefono', email = '$params->email', WHERE id_cliente = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El cliente ha sido editado";
            return $vec;
        }

        //método filtro
        public function filtro($dato) {
            $dato = mysqli_real_escape_string($this->conexion, $dato);
            $filtro = "SELECT * FROM cliente WHERE nombre LIKE '%$dato%' OR apellido LIKE '%$dato%' ";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];
        
            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
        
            return $vec;
        }
    }

?>