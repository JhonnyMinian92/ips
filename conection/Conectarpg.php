<?php

class Conectarpg{

    //constantes para la conexion
    private string $host;
    private string $port;
    private string $database;
    private string $user;
    private string $password;

    public function __construct() {}

    //Conexion a postgres
    public function ConectaPostgres() {
        //obtener datos del archivo .env
        $envData = parse_ini_file('jdbc.env');
        $this->host = $envData['HOSTPOS'];
        $this->port = $envData['PORTPOS']; 
        $this->database = $envData['BDPOS'];
        $this->user = $envData['USERPOS'];
        $this->password = $envData['PASSPOS'];
        $conexion = pg_connect("host={$this->host} port={$this->port} dbname={$this->database} user={$this->user} password={$this->password}");
        return $conexion;
    }
    
    //Desconectar de postgres
    public function DesconectaPostgres($conexion) { pg_close($conexion); }

}

?>