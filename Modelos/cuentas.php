<?php
    class cuentas {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT * FROM cuentas ORDER BY id_cuenta";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM cuentas WHERE id_cuenta = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La cuenta ha sido eliminado";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO cuentas(codigo,nombre) VALUES ($params->codigo,'$params->nombre')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La cuenta ha sido guardado";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE cuentas SET codigo = $params->codigo, nombre = '$params->nombre' WHERE id_cuenta = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La cuenta ha sido editado";
            return $vec;
        }

        //método filtro
        public function filtro($dato) {
            $con = "SELECT * FROM cuentas WHERE codigo LIKE '%$dato%'";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }

            return $vec;
        }
    }
?>