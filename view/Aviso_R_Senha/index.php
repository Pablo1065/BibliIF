<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
    $cpf = $_GET['usercpf'];
    $hash = uniqid();
    $url = $_SERVER['DOCUMENT_ROOT'] . "Biliif/view/RecuperarSenha/?hash=$hash";
    $Con = start_connection();
    $Con->query("INSERT INTO recuperarsenha(Rhash, cpf) VALUES ('$hash', $cpf);");
    $results = mysqli_fetch_assoc($Con->query("SELECT email FROM usuario WHERE cpf = $cpf"));
    $Con->close();
    mail($results['email'], "Recuperar Senha", $url);
    echo("Verifique seu E-mail");
?>