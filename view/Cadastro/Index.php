<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/Validacao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/img.php";

$con = start_connection();
$result_curso = $con->query("SELECT * FROM curso;");
$result_biblioteca = $con->query("SELECT * FROM biblioteca;");

if (isset($_POST['submit'])) {

    $nome = $con->real_escape_string($_POST['nome']);
    $cpf = $con->real_escape_string($_POST['cpf']);
    $email = $con->real_escape_string($_POST['email']);
    $senha = $con->real_escape_string($_POST['senha']);
    $matricula = $con->real_escape_string($_POST['matricula']);
    $curso = $con->real_escape_string($_POST['curso']);
    $isEstudante = $con->real_escape_string($_POST['isEstudante']);
    $estaAfastado = $con->real_escape_string($_POST['afastado']);
    $biblioteca = $con->real_escape_string($_POST['biblioteca']);

    if (!validar_cpf($cpf)) {
        die("CPF invalido");
    }
    if (!validar_email($email)) {
        die("E-mail invalido");
    }
    if (!validar_matricula($matricula)) {
        die("Matricula invalida");
    }
    if (!validar_senha($senha)) {
        die("A senha ter no minimo 8 caracteres com letras maiusculas, minusculas, numero e simbolos");
    }
    if (!validar_id($curso, "curso")) {
        die("Curso invalido");
    }
    if (!validar_id($biblioteca, "biblioteca")) {
        die("Biblioteca invalido");
    }
    if (!validar_bool($isEstudante)) {
        die("Valor invalido");
    }
    if (!validar_bool($estaAfastado)) {
        die("Valor invalido");
    }
    if(!$path_img_perfil = img($_FILES['imagem'], "foto_perfil")){
        die("Arquivo Invalido");
    }

    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario(nome, cpf, email, senha, matricula, curso, isEstudante, estaAfastado, biblioteca, perfilImg) VALUES ('$nome', '$cpf', '$email', '$senha', '$matricula', $curso, $isEstudante, $estaAfastado, $biblioteca, '$path_img_perfil')";
    $con->query($sql) or die("Deu pau!");
    $con->close();
    echo ("deu certo");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>

<body>
    <form action="" enctype="multipart/form-data" method="POST">
        <h2>Crie sua conta</h2>
        <p>
            <label>Nome: </label>
            <input type="text" name="nome">
        </p>
        <p>
            <label>CPF: </label>
            <input type="text" name="cpf">
        </p>
        <p>
            <label>E-mail: </label>
            <input type="email" name="email">
        </p>
        <p>
            <label>Senha: </label>
            <input type="password" name="senha">
        </p>
        <p>
            <label>Matricula: </label>
            <input type="text" name="matricula">
        </p>
        <p>
            <label>Curso: </label>
            <select name="curso">
                <?php
                while ($curso = mysqli_fetch_assoc($result_curso)) {
                    echo ("<option value=\"" . $curso['IDcurso'] . "\">" . $curso['nome'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>Estudante: </label>
            <input type="radio" name="isEstudante" value="1"> Estudante
            <input type="radio" name="isEstudante" value="0"> Servidor
        </p>
        <p>
            <label>Afastado: </label>
            <input type="radio" name="afastado" value="1"> Afastado
            <input type="radio" name="afastado" value="0"> Normal
        </p>
        <p>
            <label>Biblioteca: </label>
            <select name="biblioteca">
                <?php
                while ($biblioteca = mysqli_fetch_assoc($result_biblioteca)) {
                    echo ("<option value=\"" . $biblioteca['IDbiblioteca'] . "\">" . $biblioteca['campus'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>Foto de Perfil: </label>
            <input type="file" name="imagem">
        </p>
        <button type="submit" name="submit">Enviar</button>
    </form>
</body>

</html>