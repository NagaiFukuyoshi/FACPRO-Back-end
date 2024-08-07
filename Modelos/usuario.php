<?php
    class usuario {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT * FROM usuario ORDER BY nombres";
            $res = mysqli_query($this->conexion, $con);

            // Verificar si hay un error en la consulta
            if (!$res) {
                die('Error en la consulta SQL: ' . mysqli_error($this->conexion));
            }

            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM usuario WHERE id_usuario = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido eliminado";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO usuario(nombres, apellidos, correo, usuario, password, fo_rol) VALUES ('$params->nombres', '$params->apellidos', '$params->correo','$params->usuario','$params->password',$params->fo_rol)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido guardado";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE usuario SET nombres = '$params->nombres', apellidos = '$params->apellidos', correo = '$params->correo', usuario = '$params->usuario', password = '$params->password', fo_rol = $params->fo_rol WHERE id_usuario = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido editado";
            return $vec;
        }

        //método filtro
        public function filtro($valor) {
            $filtro = "SELECT u.*, e.nombre AS empleado FROM usuario u
            INNER JOIN empleado e ON u.fo_empleado = id_empleado
            WHERE u.nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [""] = $row;
            }

            return $vec;
        }
    }

?>