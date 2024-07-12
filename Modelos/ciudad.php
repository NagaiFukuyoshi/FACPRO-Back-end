<?php
    class ciudad {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT c.*, d.nombre AS dpto FROM ciudad c
            INNER JOIN dpto d ON c.fo_departamento = id_dpto
            ORDER BY c.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM ciudad WHERE id_ciudad = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La ciudad ha sido eliminada";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO ciudad(nombre, fo_departamento) VALUES ('$params->nombre', $params->fo_departamento)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La ciudad ha sido guardada";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE ciudad SET nombre = '$params->nombre', fo_departamento = $params->fo_departamento WHERE id_ciudad = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La ciudad ha sido editada";
            return $vec;
        }

// Método filtro
public function filtro($valor) {
    $filtro = "SELECT c.*, d.nombre AS dpto FROM ciudad c
               INNER JOIN dpto d ON c.fo_departamento = id_dpto
               WHERE c.nombre LIKE '%$valor%'";

    $res = mysqli_query($this->conexion, $filtro);

    if (!$res) {
        die("Error en la consulta: " . mysqli_error($this->conexion));
    }

    $vec = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $vec[] = $row;
    }

    return $vec;
}
}

?>