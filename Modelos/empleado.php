<?php
    class Empleado {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT e.*, d.nombre AS documento, c.nombre AS ciudad FROM empleado e
            INNER JOIN documento d ON e.fo_documento = id_documento
            INNER JOIN ciudad c ON e.fo_ciudad = id_ciudad
            ORDER BY e.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
        }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE * FROM empleado WHERE id_empleado = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El empleado ha sido eliminado";
            return $vec;
        }

        //método insertar
        public function insertar($params) {
            $ins = "INSERT INTO empleado(fo_documento,num_documento,nombre,apellido,fo_ciudad,direccion,telefono,email) VALUES ($params->fo_documento,'$params->num_documento','$params->nombre','$params->apellido', $params->fo_ciudad,'$params->direccion','$params->telefono','$params->email')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El empleado ha sido guardado";
            return $vec;
        }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE empleado SET fo_documento = $params->fo_documento, num_documento = $params->num_documento, nombre = '$params->nombre', apellido = '$params->apellido', fo_ciudad = $params->fo_ciudad, direccion = '$params->direccion', telefono = '$params->telefono', email = '$params->email', WHERE id_empleado = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El empleado ha sido editado";
            return $vec;
        }

       //método filtro
        public function filtro($valor) {
        $filtro = "SELECT e.*, d.nombre AS documento, c.nombre AS ciudad FROM empleado e
        INNER JOIN documento d ON e.fo_documento = id_documento
        INNER JOIN ciudad c ON e.fo_ciudad = id_ciudad
        WHERE e.nombre LIKE '%$valor%' OR e.apellido LIKE %$valor% OR e.num_documento LIKE %$valor%";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)) {
            $vec [""] = $row;
        }

        return $vec;
        }
    }

?>