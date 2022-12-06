<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/img.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/model/Obra.php";

$con = start_connection();
$result_acervo = $con->query("SELECT IDacervo, tipoAcervo FROM acervo;");
$result_biblioteca = $con->query("SELECT * FROM biblioteca;");

if (isset($_POST['submit'])) {
    
    $o = new Obra;
    $o->Obra($_POST['isbn'],$_POST['titulo'],$_POST['acervo'],$_POST['autor'], $_POST['tradutor'] ,$_POST['subtitulo'],$_POST['edicao'],$_POST['ano'],$_POST['lugar'],$_POST['editora'],$_POST['biblioteca'],$_POST['descObra'],$_POST['etiqueta'],$_POST['tags'],img($_FILES['imgCapa'], "foto_livro"),$_POST['link'],$_POST['cl']);
    $con->query($o->sql_create_query()) or die("Deu pau!");
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
        <h2>Cadastrar livro</h2>
        <p>
            <label>Isbn: </label>
            <input type="text" name="isbn">
        </p>
        <p>
            <label>Titulo: </label>
            <input type="text" name="titulo">
        </p>
        <p>
            <label>Acervo: </label>
            <select name="acervo">
                <?php
                while ($acervo = mysqli_fetch_assoc($result_acervo)) {
                    echo ("<option value=\"" . $acervo['IDacervo'] . "\">" . $acervo['tipoAcervo'] . "</option>");
                }
                ?>
            </select>
        </p>
        <p>
            <label>autor: </label>
            <input type="text" name="autor">
        </p>
        <p>
            <label>tradutor: </label>
            <input type="text" name="tradutor">
        </p>
        <p>
            <label>subtitulo: </label>
            <input type="text" name="subtitulo">
        </p>
        <p>
            <label>edição: </label>
            <input type="text" name="edicao">
        </p>
        <p>
            <label>ano: </label>
            <input type="text" name="ano">
        </p>
        <p>
            <label>lugar: </label>
            <input type="text" name="lugar">
        </p>
        <p>
            <label>editora: </label>
            <input type="text" name="editora">
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
            <label>descrição da Obra: </label>
            <textarea name="descObra"></textarea>
        </p>
        <p>
            <label>etiqueta: </label>
            <input type="text" name="etiqueta">
        </p>
        <p>
            <label>tags: </label>
            <input type="text" name="tags">
        </p>
        <p>
            <label>Capa: </label>
            <input type="file" name="imgCapa">
        </p>
        <p>
            <label>link: </label>
            <input type="text" name="link">
        </p>
        <p>
            <label>cl: </label>
            <input type="text" name="cl">
        </p>
        <button type="submit" name="submit">Enviar</button>
    </form>
</body>

</html>