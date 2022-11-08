<?php
require_once $_SERVER['DOCUMENT_ROOT']."/BibliIF/conexao/Conexao.php";

function validar_email($email){
    if(preg_match("/[a-z0-9.\-\_]+@(aluno.iffar.edu.br|iffarroupilha.com)/", $email)){
        return true;
    } else {
        return false;
    }
}
function validar_senha($senha){
    if(preg_match_all("/[A-Z]/", $senha) >= 1 && preg_match_all("/[0-9]/", $senha) >= 1 && preg_match_all("/\W|_/", $senha) >= 1 && strlen($senha) > 7){
        return true;
    } else {
        return false;
    }
}
function validar_matricula($matricula){
    if(strlen($matricula) == 7 || strlen($matricula) == 10){
        if(preg_match_all("/[0-9]/", $matricula) == 7||preg_match_all("/[0-9]/", $matricula)){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function validar_id($id, $table){
    $conn = start_connection();
    $result = $conn->query("SELECT ID$table FROM $table");
    $conn->close();
    while($idtable = mysqli_fetch_assoc($result)){
        if($idtable["ID$table"] == $id){
            return true;
        }
    }
    return false;
}
function validar_bool($bool){
    if($bool == true|| $bool == false){
        return true;
    }
    return false;
}
function validar_cpf($cpf) {
    // Código Para Validar CPF - Fonte:https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    $con = start_connection();
    return is_null(mysqli_fetch_assoc($con->query("SELECT cpf FROM usuario WHERE cpf = $cpf")));
}
?>