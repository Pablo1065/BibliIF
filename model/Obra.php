<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
$Con = start_connection();
class Obra{
    private $IDobra;
    private $isbn;
    private $titulo;
    private $tipoObra;
    private $autor;
    private $tradutor;
    private $subtitulo;
    private $edicao;
    private $ano;
    private $lugar;
    private $editora;
    private $biblioteca;
    private $descObra;
    private $etiqueta;
    private $tags;
    private $pathCapa;
    private $link;
    private $cl;
    private $tipoAcervo;
    private $descAcervo;
    private $campus;

    function Obra($isbn, $titulo, $tipoObra, $autor, $tradutor, $subtitulo, $edicao, $ano, $lugar, $editora, $biblioteca, $descObra, $etiqueta, $tags, $pathCapa, $link, $cl){
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->tipoObra = $tipoObra;
        $this->autor = $autor;
        $this->tradutor =$tradutor;
        $this->subtitulo = $subtitulo;
        $this->edicao = $edicao;
        $this->ano = $ano;
        $this->lugar = $lugar;
        $this->editora = $editora;
        $this->biblioteca = $biblioteca;
        $this->descObra = $descObra;
        $this->etiqueta = $etiqueta;
        $this->tags = $tags;
        $this->pathCapa = $pathCapa;
        $this->link = $link;
        $this->cl = $cl;
    }
    function sql_create_query(){
        return ("INSERT INTO obra(tipoObra, isbn, titulo, autor, tradutor, subtitulo, edicao, ano, lugar, editora, biblioteca, descObra, etiqueta, tags, capa, link, cl) VALUES ($this->tipoObra, '$this->isbn', '$this->titulo', '$this->autor', '$this->tradutor', '$this->subtitulo', '$this->edicao', '$this->ano', '$this->lugar', '$this->editora', $this->biblioteca, '$this->descObra', '$this->etiqueta', '$this->tags', '$this->pathCapa', '$this->link', '$this->cl');");
    }
    function query_db($IDobra){
        global $Con;
        $results = $Con->query("SELECT isbn, tipoObra, titulo, subtitulo, autor, tradutor, edicao, ano, lugar, editora, biblioteca, descObra, etiqueta, tags, capa, link, cl, tipoAcervo, descAcervo, campus from obra inner join acervo on obra.tipoObra = acervo.IDacervo inner join biblioteca on obra.biblioteca = biblioteca.idbiblioteca where idobra = $IDobra;");
        $results = mysqli_fetch_assoc($results);
        if ($results == null){
            return false;
        }
        $this->IDobra = $IDobra;
        $this->isbn = $results['isbn'];
        $this->tipoObra = $results['tipoObra'];
        $this->titulo = $results['titulo'];
        $this->autor = $results['autor'];
        $this->tradutor =$results['tradutor'];
        $this->subtitulo = $results['subtitulo'];
        $this->edicao = $results['edicao'];
        $this->ano = $results['ano'];
        $this->lugar = $results['lugar'];
        $this->editora = $results['editora'];
        $this->biblioteca = $results['biblioteca'];
        $this->descObra = $results['descObra'];
        $this->etiqueta = $results['etiqueta'];
        $this->tags = $results['tags'];
        $this->pathCapa = $results['capa'];
        $this->link = $results['link'];
        $this->cl = $results['cl'];
        $this->tipoAcervo = $results['tipoAcervo'];
        $this->descAcervo = $results['descAcervo'];
        $this->campus = $results ['campus'];
        return true;
    }
    function sql_update_query(){
        return "UPDATE obra SET tipoObra = $this->tipoObra, isbn = '$this->isbn', titulo = '$this->titulo', autor =  '$this->autor', tradutor =  '$this->tradutor', subtitulo = '$this->subtitulo', edicao = '$this->edicao', biblioteca = $this->biblioteca, descObra = '$this->descObra', etiqueta = '$this->etiqueta', tags = '$this->tags', link = '$this->link', cl = '$this->cl' WHERE IDobra = $this->IDobra;";
    }
    function getID_Obra(){
        return $this->IDobra;
    }
    function set_isbn($isbn){
        $this->isbn = $isbn;
    }
    function get_isbn(){
        return $this->isbn;
    }
    function set_titulo($titulo){
        $this->titulo = $titulo;
    }
    function get_titulo(){
        return $this->titulo;
    }
    function set_tipoObra($tipoObra){
        $this->tipoObra = $tipoObra;
    }
    function get_tipoObra(){
        return $this->tipoAcervo;
    }
    function getDesc_tipoObra(){
        return $this->descAcervo;
    }
    function getID_tipoObra(){
        return $this->tipoObra;
    }
    function set_autor($autor){
        $this->autor = $autor;
    }
    function get_autor(){
        return $this->autor;
    }
    function set_tradutor($tradutor){
        $this->tradutor = $tradutor;
    }
    function get_tradutor(){
        return $this->tradutor;
    }
    function set_subtitulo($subtitulo){
        $this->subtitulo = $subtitulo;
    }
    function get_subtitulo(){
        return $this->subtitulo;
    }
    function set_edicao($edicao){
        $this->edicao = $edicao;
    }
    function get_edicao(){
        return $this->edicao;
    }
    function set_ano($ano){
        $this->ano = $ano;
    }
    function get_ano(){
        return $this->ano;
    }
    function set_lugar($lugar){
        $this->lugar = $lugar;
    }
    function get_lugar(){
        return $this->lugar;
    }
    function set_editora($editora){
        $this->editora = $editora;
    }
    function get_editora(){
        return $this->editora;
    }
    function set_biblioteca($biblioteca){
        $this->biblioteca = $biblioteca;
    }
    function get_biblioteca(){
        return $this->campus;
    }
    function getID_biblioteca(){
        return $this->biblioteca;
    }
    function set_descObra($descObra){
        $this->descObra = $descObra;
    }
    function get_descObra(){
        return $this->descObra;
    }
    function set_etiqueta($etiqueta){
        $this->etiqueta = $etiqueta;
    }
    function get_etiqueta(){
        return $this->etiqueta;
    }
    function set_tags($tags){
        $this->tags = $tags;
    }
    function get_tags(){
        return $this->tags;
    }
    function set_pathCapa($pathCapa){
        $this->pathCapa = $pathCapa;
    }
    function get_pathCapa(){
        return $this->pathCapa;
    }
    function set_link($link){
        $this->link = $link;
    }
    function get_link(){
        return $this->link;
    }
    function set_cl($cl){
        $this->cl = $cl;
    }
    function get_cl(){
        return $this->cl;
    }
}
?>