<?php
    class retenciones {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT * FROM retenciones ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM retenciones WHERE id_retencion = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La retención ha sido eliminada";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO retenciones(nombre) VALUES ('$params->nombre')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La retención ha sido guardado";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE retenciones SET nombre = '$params->nombre' WHERE id_retencion = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La retención ha sido editado";
            return $vec;
        }

        //método filtro
        public function filtro($valor) {
            $filtro = "SELECT * FROM retenciones WHERE nombre LIKE = '%$valor%";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [""] = $row;
            }

            return $vec;
        }
    }

?>