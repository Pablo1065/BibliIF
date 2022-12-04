<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/login.php";
    $con = start_connection();
    $result = $con->query("SELECT nome, cpf, email, matricula FROM usuario");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        table *{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Matricula</th>
        </tr>
        <?php
            while($users = mysqli_fetch_assoc($result)){
                echo("<tr>
                        <td><a href=\" ../Alter_User?usercpf=" . $users['cpf']. "\">". $users['nome'] . "</a></td>
                        <td>". $users['cpf'] ."</td>
                        <td>". $users['email'] ."</td>
                        <td>". $users['matricula'] ."</td>
                    </tr>");
            }
        ?>
    </table>
</body>
</html>