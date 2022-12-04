<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/Validacao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/img.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/model/Usuario.php";

$con = start_connection();
$result_curso = $con->query("SELECT * FROM curso;");
$result_biblioteca = $con->query("SELECT * FROM biblioteca;");

if (isset($_POST['submit'])) {
    
    $u = new Usuario;
    $u->Usuario($con->real_escape_string($_POST['nome']),
    $con->real_escape_string($_POST['cpf']),
    $con->real_escape_string($_POST['email']),
    $con->real_escape_string($_POST['senha']),
    $con->real_escape_string($_POST['matricula']),
    $con->real_escape_string($_POST['curso']),
    $con->real_escape_string($_POST['Estudante']),
    $con->real_escape_string($_POST['afastado']),
    $con->real_escape_string($_POST['biblioteca']));
    
    $u->set_cpf(preg_replace( '/[^0-9]/is', '', $u->get_cpf()));

    if (!validar_cpf($u->get_cpf())) {
        die("CPF invalido");
    }
    if (!validar_email($u->get_email())) {
        die("E-mail invalido");
    }
    if (!validar_matricula($u->get_matricula())) {
        die("Matricula invalida");
    }
    if (!validar_senha($u->get_senha())) {
        die("A senha ter no minimo 8 caracteres com letras maiusculas, minusculas, numero e simbolos");
    }
    if (!validar_id($u->getID_curso(), "curso")) {
        die("Curso invalido");
    }
    if (!validar_id($u->getID_biblioteca(), "biblioteca")) {
        die("Biblioteca invalido");
    }
    if (!validar_bool($u->is_Estudante())) {
        die("Valor invalido");
    }
    if (!validar_bool($u->esta_Afastado())) {
        die("Valor invalido");
    }
    
    $u->set_perfilImg(img($_FILES['imagem'], "foto_perfil"));

    $u->set_senha(password_hash($u->get_senha(), PASSWORD_DEFAULT));

    $con->query($u->sql_create_query()) or die("Deu pau!");
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
                    echo ("<option value=\"" . $curso['IDcurso'] . "\">" . $curso['nomeCurso'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>Estudante: </label>
            <input type="radio" name="Estudante" value="1"> Estudante
            <input type="radio" name="Estudante" value="0"> Servidor
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