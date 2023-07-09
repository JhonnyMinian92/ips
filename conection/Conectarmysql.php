<?php

class Conectarmysql{

        //constantes para conexion
        private string $host;
        private string $usuario;
        private string $contrasena;
        private string $baseDatos;
    
        public function __construct() {}
    
        //Conexion a la base de datos
        final public function ConectaMysql() {
            //obtener datos del archivo .env
            $envData = parse_ini_file('jdbc.env');
            $this->host = $envData['HOSTMYSQL'];
            $this->usuario = $envData['USERMYSQL'];
            $this->contrasena = $envData['PASSMYSQL'];
            $this->baseDatos = $envData['BDMYSQL'];
            $conexion = mysqli_connect($this->host, $this->usuario, $this->contrasena, $this->baseDatos);
            return $conexion;
        }
    
        //Desconectar de la base de datos
        final public function DesconectaMysql($conexion) { mysqli_close($conexion); }

}

?>