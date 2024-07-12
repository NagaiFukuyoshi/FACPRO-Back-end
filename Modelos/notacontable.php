<?php
    class Notacontable {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT n.*, pro.nombre AS proveedor, u.nombres AS usuario, cod.codigo AS cuentas FROM notacontable n
            INNER JOIN proveedor pro ON n.fo_proveedor = id_proveedor
            INNER JOIN usuario u ON n.fo_usuario = id_usuario
            INNER JOIN cuentas cod ON n.fo_codigo = id_cuenta
            ORDER BY n.id_notacontable";
            $res = mysqli_query($this->conexion, $con);

            if (!$res) {
                // Si la consulta falló, imprime el mensaje de error y termina
                die("Consulta fallida: " . mysqli_error($this->conexion));
            }
    
            $vec = [];
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $vec[] = $row;
            }

            return $vec;
        }

        //método eliminar
        public function eliminar($id) {
            $del = "DELETE FROM notacontable WHERE id_nota = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La nota contable ha sido eliminado";
            return $vec;
        }

    // Método insertar
    public function insertar($params) {
        $ins = "INSERT INTO notacontable(fo_proveedor,fo_proveedor2,fecha,fo_usuario,fo_codigo,fo_codigo2,fo_cuenta,fo_cuenta2,descripcion,descripcion2,debito,debito2,credito,credito2,total_debito,total_credito,diferencia) VALUES ($params->fo_proveedor,$params->fo_proveedor2,'$params->fecha',$params->fo_usuario,$params->fo_codigo,$params->fo_codigo2,$params->fo_cuenta,$params->fo_cuenta2,'$params->descripcion','$params->descripcion2',$params->debito,$params->debito2,$params->credito,$params->credito2,$params->total_debito,$params->total_credito,$params->diferencia)";

        if (mysqli_query($this->conexion, $ins)) {
            $vec = ["resultado" => "ok", "mensaje" => "La nota contable ha sido guardado"];
        } else {
            $vec = ["resultado" => "error", "mensaje" => "Error al guardar la nota contable: " . mysqli_error($this->conexion)];
        }

        return $vec;
    }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE notacontable SET fo_proveedor = $params->fo_proveedor,fo_proveedor2 = $params->fo_proveedor2, fecha = '$params->fecha', fo_usuario = $params->fo_usuario, fo_codigo = $params->fo_codigo, fo_codigo2 = $params->fo_codigo2, fo_cuenta = $params->fo_cuenta, fo_cuenta2 = $params->fo_cuenta2, descripcion = '$params->descripcion',descripcion2 = '$params->descripcion2', debito = $params->debito, debito2 = $params->debito2, credito = $params->credito, credito2 = $params->credito2, total_debito = $params->total_debito, total_credito = $params->total_credito, diferencia = $params->diferencia, WHERE id_nota = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La nota contable ha sido editado";
            return $vec;
        }

       //método filtro
        public function filtro($valor) {
        $filtro = "SELECT n.*, prov.nombre AS proveedor, u.nombre AS usuario, cod.codigo AS cuentas FROM notacontable n
            INNER JOIN proveedor prov ON n.fo_proveedor = id_proveedor
            INNER JOIN usuario u ON n.fo_usuario = id_usuario
            INNER JOIN cuentas cod ON n.fo_codigo = id_cuenta
        WHERE n.fo_proveedor LIKE %$valor% OR n.fo_proveedor2 LIKE %$valor% OR n.fecha LIKE %$valor%";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)) {
            $vec [""] = $row;
        }

        return $vec;
        }
    }

?>