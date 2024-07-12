<?php
    class Comprobantes {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta() {
            $con = "SELECT c.*, pro.nombre AS proveedor, u.nombres AS usuario, cod.codigo AS cuentas FROM comprobantes c
            INNER JOIN proveedor pro ON c.fo_proveedor = id_proveedor
            INNER JOIN usuario u ON c.fo_usuario = id_usuario
            INNER JOIN cuentas cod ON c.fo_codigo = id_cuenta
            ORDER BY c.id_comprobante";
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
            $del = "DELETE FROM comprobantes WHERE id_comprobante = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El comprobante ha sido eliminado";
            return $vec;
        }

    // Método insertar
    public function insertar($params) {
        $ins = "INSERT INTO comprobantes(fo_proveedor,fecha,fo_usuario,fo_codigo,fo_codigo2,fo_cuenta,fo_cuenta2,descripcion,descripcion2,debito,debito2,credito,credito2,total_debito,total_credito,diferencia) VALUES ($params->fo_proveedor,'$params->fecha',$params->fo_usuario,$params->fo_codigo,$params->fo_codigo2,$params->fo_cuenta,$params->fo_cuenta2,'$params->descripcion','$params->descripcion2',$params->debito,$params->debito2,$params->credito,$params->credito2,$params->total_debito,$params->total_credito,$params->diferencia)";

        if (mysqli_query($this->conexion, $ins)) {
            $vec = ["resultado" => "ok", "mensaje" => "El comprobante ha sido guardado"];
        } else {
            $vec = ["resultado" => "error", "mensaje" => "Error al guardar el comprobante: " . mysqli_error($this->conexion)];
        }

        return $vec;
    }

        //método editar
        public function editar($id,$params) {
            $editar = "UPDATE comprobantes SET fo_proveedor = $params->fo_proveedor, fecha = '$params->fecha', fo_usuario = $params->fo_usuario, fo_codigo = $params->fo_codigo, fo_codigo2 = $params->fo_codigo2, fo_cuenta = $params->fo_cuenta, fo_cuenta2 = $params->fo_cuenta2, descripcion = '$params->descripcion',descripcion2 = '$params->descripcion2', debito = $params->debito, debito2 = $params->debito2, credito = $params->credito, credito2 = $params->credito2, total_debito = $params->total_debito, total_credito = $params->total_credito, diferencia = $params->diferencia, WHERE id_comprobantes = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El comprobante ha sido editado";
            return $vec;
        }

       //método filtro
        public function filtro($valor) {
        $filtro = "SELECT c.*, prov.nombre AS proveedor, u.nombre AS usuario, cod.codigo AS cuentas FROM comprobantes c
            INNER JOIN proveedor prov ON c.fo_proveedor = id_proveedor
            INNER JOIN usuario u ON c.fo_usuario = id_usuario
            INNER JOIN cuentas cod ON c.fo_codigo = id_cuenta
        WHERE c.fo_proveedor LIKE %$valor% OR c.fecha LIKE %$valor%";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)) {
            $vec [""] = $row;
        }

        return $vec;
        }
    }

?>