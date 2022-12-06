<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/img.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/model/Obra.php";

$con = start_connection();
$result_acervo = $con->query("SELECT IDacervo, tipoAcervo FROM acervo;");
$result_biblioteca = $con->query("SELECT * FROM biblioteca;");
$id = 1;
$o = new Obra;
$o->query_db($id);

if (isset($_POST['submit'])) {
    $o->set_titulo($_POST['titulo']);
    $o->set_subtitulo($_POST['subtitulo']);
    $o->set_autor($_POST['autor']);
    $o->set_tradutor($_POST['tradutor']);
    $o->set_isbn($_POST['isbn']);
    $o->set_tipoObra($_POST['acervo']);
    $o->set_edicao($_POST['edicao']);
    $o->set_ano($_POST['ano']);
    $o->set_lugar($_POST['lugar']);
    $o->set_editora($_POST['editora']);
    $o->set_biblioteca($_POST['biblioteca']);
    $o->set_descObra($_POST['descObra']);
    $o->set_etiqueta($_POST['etiqueta']);
    $o->set_tags($_POST['tags']);
    $o->set_link($_POST['link']);
    $o->set_cl($_POST['cl']);

    $con->query($o->sql_update_query());
    $con->close();
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
        <h2>Alterar Cadastro livro</h2>
        <p>
            <label>Titulo: </label>
            <input type="text" name="titulo" value="<?php echo($o->get_titulo())?>">
        </p>
        <p>
            <label>subtitulo: </label>
            <input type="text" name="subtitulo"value="<?php echo($o->get_subtitulo())?>">
        </p>
        <p>
            <label>autor: </label>
            <input type="text" name="autor" value="<?php echo($o->get_autor())?>">
        </p>
        <p>
            <label>tradutor: </label>
            <input type="text" name="tradutor" value="<?php echo($o->get_tradutor())?>">
        </p>
        <p>
            <label>Isbn: </label>
            <input type="text" name="isbn" value="<?php echo($o->get_isbn())?>">
        </p>
        <p>
            <label>Acervo: </label>
            <select name="acervo">
                <?php
                while ($acervo = mysqli_fetch_assoc($result_acervo)) {
                    $select = "";
                    if ($o->getID_tipoObra() == $acervo['IDacervo']){
                        $select = "selected";
                    }
                    echo ("<option value=\"" . $acervo['IDacervo'] . "\" $select>" . $acervo['tipoAcervo'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>edição: </label>
            <input type="text" name="edicao" value="<?php echo($o->get_edicao())?>">
        </p>
        <p>
            <label>ano: </label>
            <input type="text" name="ano" value="<?php echo($o->get_ano())?>">
        </p>
        <p>
            <label>lugar: </label>
            <input type="text" name="lugar" value="<?php echo($o->get_lugar())?>">
        </p>
        <p>
            <label>editora: </label>
            <input type="text" name="editora" value="<?php echo($o->get_editora())?>">
        </p>
        <p>
            <label>Biblioteca: </label>
            <select name="biblioteca">
                <?php
                while ($biblioteca = mysqli_fetch_assoc($result_biblioteca)) {
                    $select = null;
                    if($o->getID_biblioteca() == $biblioteca['IDbiblioteca']){ $select = "selected";}
                    echo ("<option value=\"" . $biblioteca['IDbiblioteca'] . "\" $select >" . $biblioteca['campus'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>descrição da Obra: </label>
            <textarea name="descObra"><?php echo($o->get_descObra())?></textarea>
        </p>
        <p>
            <label>etiqueta: </label>
            <input type="text" name="etiqueta" value="<?php echo($o->get_etiqueta())?>">
        </p>
        <p>
            <label>tags: </label>
            <input type="text" name="tags" value="<?php echo($o->get_tags())?>">
        </p>
        <p>
            <label>link: </label>
            <input type="text" name="link" value="<?php echo($o->get_link())?>">
        </p>
        <p>
            <label>cl: </label>
            <input type="text" name="cl" value="<?php echo($o->get_cl())?>">
        </p>
        <button type="submit" name="submit">Enviar</button>
    </form>
</body>

</html>