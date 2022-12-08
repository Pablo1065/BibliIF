<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/Validacao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/login.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/model/Usuario.php";

$con = start_connection();
$result_curso = $con->query("SELECT * FROM curso");
$result_biblioteca = $con->query("SELECT * FROM biblioteca");
$u = new Usuario;
$u->query_db($_GET['usercpf']);
if (isset($_POST['submit'])) {
    if(isset($_POST['nome'])){
        $u->set_nome($con->real_escape_string($_POST['nome']));
    }
    if(isset($_POST['cpf'])){
        $cpf = (preg_replace( '/[^0-9]/is', '', $_POST['cpf']));
        if(validar_cpf($cpf)){
            $u->set_cpf($con->real_escape_string($cpf));
        }
    }
    if(isset($_POST['email'])){
        $u->set_email($con->real_escape_string($_POST['email']));
    }
    if(isset($_POST['matricula'])){
        $u->set_matricula($con->real_escape_string($_POST['matricula']));
    }
    $u->set_curso($_POST['curso']);
    $u->set_estudante($_POST['Estudante']);
    $u->set_afastado($_POST['afastado']);
    $u->set_biblioteca($_POST['biblioteca']);
    $u->set_permissao($_POST['permissao']);

    if (!validar_matricula($u->get_matricula())) {
        die("Matricula invalida");
    }
    if (!validar_id($u->getID_curso(), "curso")) {
        die("Curso invalido");
    }
    if (!validar_id($u->getID_biblioteca(), "biblioteca")) {
        die("Biblioteca invalida");
    }
    if (!validar_bool($u->is_Estudante())) {
        die("Valor invalido");
    }
    if (!validar_bool($u->esta_Afastado())) {
        die("Valor invalido");
    }
    $con->query($u->sql_update_query());
    $con->close();
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
                <img src="../../conexao/bd/img/foto_perfil/<?php echo ($u->get_perfilImg()) ?>" style="border-radius: 50%; width:150px; height:150px; object-fit:cover;">
                <h2 class="title title-primary">Olá, <?php echo ($u->get_nome()) ?>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Altere dados da sua Conta!</h2>
                <form class="form" action="" method="POST">
                    <!--php do site -->
                    <label class="label-input" for="nome">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="Nome Completo" name="nome" id="nome" class="inputUser" required value="<?php echo ($u->get_nome()) ?>">
                    </label>


                    <label class="label-input" for="matricula">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="Matricula" name="matricula" id="matricula" class="inputUser" required value="<?php echo ($u->get_matricula()) ?>">
                    </label>

                    <label class="label-input" for="CPF">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="CPF" name="cpf" id="CPF" class="inputUser" required value="<?php echo ($u->get_cpf()) ?>">
                    </label>

                    <label class="label-input" for="email">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="Email" name="email" id="email" class="inputUser" required value="<?php echo ($u->get_email()) ?>">
                    </label>

                    <label class="label-input" for="matricula">
                        <i class="far fa-user icon-modify"></i>
                        <select name="curso" id="Curso" placeholder="Curso" class="inputeUser">
                            <?php
                            while ($curso = mysqli_fetch_assoc($result_curso)) {
                                $select = null;
                                if ($u->getID_curso() == $curso['IDcurso']) {
                                    $select = "selected";
                                }
                                echo ("<option value=\"" . $curso['IDcurso'] . "\" $select>" . $curso['nomeCurso'] . "</option>");
                            }
                            ?>
                        </select>
                    </label>

                    <label class="label-input" for="Estudante">
                        <i class="far fa-user icon-modify"></i>
                        <input type="radio" width="10px" placeholder="Estudante" name="Estudante" id="Estudante" class="inputUser" required value="1" <?php if ($u->is_Estudante()) {
                                                                                                                                                            echo ("checked");
                                                                                                                                                        } ?>>
                        Estudante
                        <input type="radio" name="Estudante" id="Servidor" placeholder="Servidor" class="inputUser" required value="0" <?php if (!$u->is_Estudante()) {
                                                                                                                                            echo ("checked");
                                                                                                                                        } ?>>
                        Servidor
                    </label>

                    <label class="label-input" for="Afastado">
                        <i class="far fa-user icon-modify"></i>
                        <input type="radio" width="10px" placeholder="afastado" name="afastado" id="afastado" class="inputUser" required value="1" <?php if ($u->esta_afastado()) {
                                                                                                                                                        echo ("checked");
                                                                                                                                                    } ?>>
                        Afastado
                        <input type="radio" name="afastado" id="Normal" placeholder="Normal" class="inputUser" required value="0" <?php if (!$u->esta_afastado()) {
                                                                                                                                        echo ("checked");
                                                                                                                                    } ?>>
                        Normal
                    </label>

                    <label class="label-input" for="matricula">
                        <i class="far fa-user icon-modify"></i>
                        <select name="biblioteca" id="Biblioteca" placeholder="Biblioteca" class="inputeUser">
                            <?php
                            while ($biblioteca = mysqli_fetch_assoc($result_biblioteca)) {
                                $select = null;
                                if ($u->getID_biblioteca() == $biblioteca['IDbiblioteca']) {
                                    $select = "selected";
                                }
                                echo ("<option value=\"" . $biblioteca['IDbiblioteca'] . "\" $select>" . $biblioteca['campus'] . "</option>");
                            }
                            ?>
                        </select>
                    </label>
                    <label class="label-input" for="permissao">Permissão: 
                    <select name="permissao">
                        <option value="leitor" <?php if ($u->get_permissao() == "leitor") {
                                                    echo ("selected");
                                                } ?>>Leitor</option>
                        <option value="moderador" <?php if ($u->get_permissao() == "moderador") {
                                                        echo ("selected");
                                                    } ?>>Moderador</option>
                        <option value="funcionario" <?php if ($u->get_permissao() == "funcionario") {
                                                        echo ("selected");
                                                    } ?>>Funcionario</option>
                        <option value="adm" <?php if ($u->get_permissao() == "adm") {
                                                echo ("selected");
                                            } ?>>Administração</option>
                    </select>
                     </label>
                    <button class="btn btn-second" type="submit" name="submit" id="submit">Alterar</button>
                </form>
            </div><!-- second column -->
        </div><!-- first content -->

    </div><!-- second column -->
    </div><!-- second-content -->
    </div>
    <!--<script src="app.js"></script>-->
</body>

</html>