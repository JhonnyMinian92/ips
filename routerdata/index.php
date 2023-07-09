<?php 

if (empty($_SERVER['HTTP_USER_AGENT'])) {
    echo json_encode(array("estado"=>false,"error"=>"Acceso incorrecto"));
    exit;
} else {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(array("estado"=>false,"error"=>"Acceso no permitido"));
        exit;
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
        if(isset($data['iduser'])){
            $result = ObtenerRouter($data['iduser'],"postgres");
            echo json_encode(array("estado"=>true,"data"=>$result));
        } else {
            echo json_encode(array("estado"=>false,"error"=>"Informacion incorrecta"));
            exit;
        }
    }
}

function ObtenerRouter($iduser, $nombd){

    $sql = "SELECT usuario, clave FROM router WHERE iduser = '$iduser' LIMIT 1";

    if($nombd == "mysql" OR $nombd == "maria"){

        if($nombd == "mysql"){
            require_once(dirname(__FILE__)."/../conection/Conectarmysql.php");
            $mysql = new Conectarmysql();
            $con = $mysql->ConectaMysql();
        } else {
            require_once(dirname(__FILE__)."/../conection/Conectarmaria.php");
            $mysql = new Conectarmaria();
            $con = $mysql->ConectaMaria();
        }

        $data = mysqli_query($con,$sql);
        $fila = mysqli_fetch_assoc($data);
        $arrayResultado = $fila ? $fila : array();
        $mysql->DesconectaMysql($con);

    } else if($nombd == "postgres"){

        require_once(dirname(__FILE__)."/../conection/Conectarpg.php");
        $postgres = new Conectarpg();
        $con = $postgres->ConectaPostgres();
        $data = pg_query($con,$sql);
        $fila = pg_fetch_assoc($data);
        $arrayResultado = $fila ? $fila : array();
        $postgres->DesconectaPostgres($con);

    }
    return $arrayResultado;
}