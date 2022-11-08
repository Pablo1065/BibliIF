<?php
    function start_connection(){
        
        $servername = "localhost";
        $username = "root";
        $password = "root1234";
        $database = "bibliif";

        $con = new mysqli($servername, $username, $password, $database);

        if($con->error){
            die("Falha ao conectar ao banco de dados: " . $con->error);
        } else {
            return($con);
        }
    }
?>