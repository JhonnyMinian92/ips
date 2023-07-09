<?php

class Conectarmaria{

        //constantes para conexion
        private string $host;
        private string $usuario;
        private string $contrasena;
        private string $baseDatos;
    
        public function __construct() {}
    
        //Conexion a la base de datos
        final public function ConectaMaria() {
            //obtener datos del archivo .env
            $envData = parse_ini_file('jdbc.env');
            $this->host = $envData['HOSTMARIA'];
            $this->usuario = $envData['USERMARIA'];
            $this->contrasena = $envData['PASSMARIA'];
            $this->baseDatos = $envData['BDMARIA'];
            $conexion = mysqli_connect($this->host, $this->usuario, $this->contrasena, $this->baseDatos);
            return $conexion;
        }
    
        //Desconectar de la base de datos
        final public function DesconectaMaria($conexion) { mysqli_close($conexion); }

}

?>