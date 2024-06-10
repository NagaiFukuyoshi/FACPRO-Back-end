<?php
    class login {
        //atributos
        public $conexion;

        //método de constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //método consulta
        public function consulta($correo, $password) {
            $con = "SELECT * FROM usuario WHERE correo='$correo' && password='$password'";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }

            if($vec==[]){
                $vec[0] = array("validar" => "no validar");
            }else{
                $vec[0]['validar']="valida";
            }

            return $vec;
        }
    }

?>