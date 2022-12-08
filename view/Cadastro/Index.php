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
    $u->Usuario(
        $con->real_escape_string($_POST['nome']),
        $con->real_escape_string($_POST['cpf']),
        $con->real_escape_string($_POST['email']),
        $con->real_escape_string($_POST['senha']),
        $con->real_escape_string($_POST['matricula']),
        $con->real_escape_string($_POST['curso']),
        $con->real_escape_string($_POST['Estudante']),
        $con->real_escape_string($_POST['afastado']),
        $con->real_escape_string($_POST['biblioteca'])
    );

    $u->set_cpf(preg_replace('/[^0-9]/is', '', $u->get_cpf()));

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
    header("location: ../Login");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar</title>
    <link rel="stylesheet" href="../../css/styl.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Seja bem <br>vindo!</h2>
                <p class="description description-primary">Esse é o Sistema bibliotecário do IFFar-FW</p>
                <p class="description description-primary">Já possui Login?</p>
                <a href="loginone.php"><button id="signin" class="btn btn-primary">Login</button></a>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Crie sua conta!</h2>

                <p class="description description-second">Use seu email para se registrar:</p>
                <form class="form" action="" method="POST">
                    <!--php do site -->
                    <label class="label-input" for="nome">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="Nome Completo" name="nome" id="nome" class="inputUser" required>
                    </label>


                    <label class="label-input" for="matricula">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="Matricula" name="matricula" id="matricula" class="inputUser" required>
                    </label>

                    <label class="label-input" for="CPF">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="CPF" name="cpf" id="CPF" class="inputUser" required>
                    </label>

                    <label class="label-input" for="email">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="Email" name="email" id="email" class="inputUser" required>
                    </label>

                    <label class="label-input" for="senha">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha" id="senha" class="inputeUser" required>
                    </label>

                    <label class="label-input" for="matricula">
                        <i class="far fa-user icon-modify"></i>
                        <select name="curso" id="Curso" placeholder="Curso" class="inputeUser">
                            <?php
                            while ($curso = mysqli_fetch_assoc($result_curso)) {
                                echo ("<option value=\"" . $curso['IDcurso'] . "\">" . $curso['nomeCurso'] . "</option>");
                            }
                            ?>
                        </select>
                    </label>

                    <label class="label-input" for="Estudante">
                        <i class="far fa-user icon-modify"></i>
                        <input type="radio" width="10px" placeholder="Estudante" name="Estudante" id="Estudante" class="inputUser" required value="1">
                        Estudante
                        <input type="radio" name="Estudante" id="Servidor" placeholder="Servidor" class="inputUser" required value="0">
                        Servidor
                    </label>

                    <label class="label-input" for="Afastado">
                        <i class="far fa-user icon-modify"></i>
                        <input type="radio" width="10px" placeholder="afastado" name="afastado" id="afastado" class="inputUser" required value="1">
                        Afastado
                        <input type="radio" name="afastado" id="Normal" placeholder="Normal" class="inputUser" required value="0">
                        Normal
                    </label>

                    <label class="label-input" for="matricula">
                        <i class="far fa-user icon-modify"></i>
                        <select name="biblioteca" id="Biblioteca" placeholder="Biblioteca" class="inputeUser">
                            <?php
                            while ($biblioteca = mysqli_fetch_assoc($result_biblioteca)) {
                                echo ("<option value=\"" . $biblioteca['IDbiblioteca'] . "\">" . $biblioteca['campus'] . "</option>");
                            }
                            ?>
                        </select>
                    </label>

                    <label class="label-input" for="senha">
                        <i class="far fa-user icon-modify"></i>
                        <input type="file" name="imagem" id="Perfil" placeholder="Perfil" class="inputUser">
                    </label>

                    <button class="btn btn-second" type="submit" name="submit" id="submit">criar</button>
                </form>
            </div><!-- second column -->
        </div><!-- first content -->

    </div><!-- second column -->
    </div><!-- second-content -->
    </div>
    <!--<script src="app.js"></script>-->
</body>

</html>