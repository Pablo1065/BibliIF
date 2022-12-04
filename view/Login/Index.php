<?php
require_once $_SERVER['DOCUMENT_ROOT']."/BibliIF/conexao/Conexao.php";

if (isset($_POST['submit'])) {
    if(strlen($_POST['cpf']) > 0){
        $con = start_connection();
        $cpf = $con->real_escape_string($_POST['cpf']);
        $result = mysqli_fetch_assoc($con->query("SELECT senha, IDusuario, permissao FROM usuario WHERE cpf = '$cpf'"));
        $con->close();
        if(!is_null($result)){
            if(password_verify($_POST['senha'], $result['senha'])){
                session_start();
                $_SESSION['IDusuario'] = $result['IDusuario'];
                $_SESSION['permissao'] = $result['permissao'];
                header("../");
            }
            die("Senha incorreta");
        } 
        die("Cpf Invalido");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <form action="" method="POST">
        <h2>Acesse sua Conta</h2>
        <p>
            <labe>CPF</labe>
            <input type="text" name="cpf">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <button type="submit" name="submit">Enviar</button>
    </form>
</body>

</html>
