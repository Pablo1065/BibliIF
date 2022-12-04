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
    $u->set_estudante($_POST['estudante']);
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
    <title>Document</title>
</head>

<body>
    <h2>Alterar Usuario: </h2>
    <form method="POST">
        <p>
            <label>Nome: </label>
            <input type="text" name="nome" value="<?php echo ($u->get_nome()) ?>">
        </p>
        <p>
            <label>CPF: </label>
            <input type="text" name="cpf" value="<?php echo ($u->get_cpf()) ?>">
        </p>
        <p>
            <label>E-mail: </label>
            <input type="text" name="email" value="<?php echo ($u->get_email()) ?>">
        </p>
        <p>
            <label>Matricula: </label>
            <input type="text" name="matricula" value="<?php echo ($u->get_matricula()) ?>">
        </p>
        <p>
            <label>Curso: </label>
            <select name="curso">
                <?php
                while ($curso = mysqli_fetch_assoc($result_curso)) {
                    $select = null;
                    if ($u->getID_curso() == $curso['IDcurso']){$select = "selected";}
                    echo ("<option value=\"" . $curso['IDcurso'] . "\" $select>" . $curso['nomeCurso'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>Estudante: </label>
            <input type="radio" name="estudante" value="1"<?php if($u->is_Estudante()){echo("checked");}?>> Estudante
            <input type="radio" name="estudante" value="0"<?php if(!$u->is_Estudante()){echo("checked");}?>> Servidor
        </p>
        <p>
            <label>Afastado: </label>
            <input type="radio" name="afastado" value="1"<?php if($u->esta_afastado()){echo("checked");}?>> Afastado
            <input type="radio" name="afastado" value="0"<?php if(!$u->esta_afastado()){echo("checked");}?>> Normal
        </p>
        <p>
            <label>Biblioteca: </label>
            <select name="biblioteca">
                <?php
                while ($biblioteca = mysqli_fetch_assoc($result_biblioteca)) {
                    $select = null;
                    if ($u->getID_biblioteca() == $biblioteca['IDbiblioteca']){$select = "selected";}
                    echo ("<option value=\"" . $biblioteca['IDbiblioteca'] . "\" $select>" . $biblioteca['campus'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>Permissão: </label>
            <select name="permissao">
                <option value="leitor" <?php if($u->get_permissao() == "leitor"){echo ("selected");}?>>Leitor</option>
                <option value="moderador" <?php if($u->get_permissao() == "moderador"){echo ("selected");}?>>Moderador</option>
                <option value="funcionario" <?php if($u->get_permissao() == "funcionario"){echo ("selected");}?>>Funcionario</option>
                <option value="adm" <?php if($u->get_permissao() == "adm"){echo ("selected");}?>>Administração</option>
            </select>
        </p>
        <p>

        </p>
        <p>
            <button type="submit" name="submit">Alterar</button>
        </p>
    </form>
    <a href="../Aviso_R_Senha/?usercpf='<?php echo($_GET['usercpf'])?>'">Clique Aqui para trocar a Senha!</a>
</body>

</html>