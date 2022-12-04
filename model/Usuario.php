<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/Conexao.php";
$Con = start_connection();
class Usuario{
    private $IDusuario;
    private $nome;
    private $cpf;
    private $email;
    private $senha;
    private $matricula;
    private $curso;
    private $estudante;
    private $afastado;
    private $biblioteca;
    private $perfilImg;
    private $permissao;
    private $nomeCurso;
    private $campus;

    function Usuario($nome, $cpf, $email, $senha, $matricula, $curso, $estudante, $afastado, $biblioteca){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = $senha;
        $this->matricula = $matricula;
        $this->curso = $curso;
        $this->estudante = $estudante;
        $this->afastado = $afastado;
        $this->biblioteca = $biblioteca;
    }
    function sql_create_query(){
        return ("INSERT INTO usuario(nome, cpf, email, senha, matricula, curso, Estudante, Afastado, biblioteca, perfilImg) VALUES ('$this->nome', '$this->cpf', '$this->email', '$this->senha', '$this->matricula', $this->curso, $this->estudante, $this->afastado, $this->biblioteca, '$this->perfilImg');");
    }
    function query_db($cpf){
        global $Con;
        $results = mysqli_fetch_assoc($Con->query("SELECT IDusuario, nome, cpf, email, senha, matricula, curso, estudante, afastado, biblioteca, perfilImg, permissao, nomeCurso, campus FROM usuario INNER JOIN curso  ON usuario.curso = curso.Idcurso INNER JOIN biblioteca ON usuario.biblioteca = biblioteca.Idbiblioteca WHERE cpf = $cpf;"));
        $this->IDusuario = $results['IDusuario'];
        $this->nome = $results['nome'];
        $this->cpf = $results['cpf'];
        $this->email = $results['email'];
        $this->matricula = $results['matricula'];
        $this->senha = $results['senha'];
        $this->curso = $results['curso'];
        $this->estudante = $results['estudante'];
        $this->afastado = $results['afastado'];
        $this->biblioteca = $results['biblioteca'];
        $this->perfilImg = $results['perfilImg'];
        $this->permissao = $results['permissao'];
        $this->nomeCurso = $results['nomeCurso'];
        $this->campus = $results['campus'];
    }
    function sql_update_query(){
        return ("UPDATE usuario SET nome = '$this->nome', cpf = '$this->cpf', email = '$this->email', matricula = '$this->matricula', curso = '$this->curso', estudante = '$this->estudante', afastado = '$this->afastado', biblioteca = '$this->biblioteca', permissao = '$this->permissao' WHERE IDusuario = $this->IDusuario");
    }
    function getID_usuario()
    {
        return $this->IDusuario;
    }
    function set_nome($nome){
        $this->nome = $nome;
    }
    function get_nome(){
        return $this->nome;
    }
    function set_cpf($cpf){
        $this->cpf = $cpf;
    }
    function get_cpf(){
        return $this->cpf;
    }
    function set_email($email){
        $this->email = $email;
    }
    function get_email(){
        return $this->email;
    }
    function set_senha($senha){
        $this->senha = $senha;
    }
    function get_senha(){
        return $this->senha;
    }
    function set_matricula($matricula){
        $this->matricula = $matricula;
    }
    function get_matricula(){
        return $this->matricula;
    }
    function set_curso($curso){
        $this->curso = $curso;
    }
    function get_curso(){
        return $this->nomeCurso;
    }
    function getID_curso(){
        return $this->curso;
    }
    function set_estudante($estudante){
        $this->estudante = $estudante;
    }
    function is_Estudante(){
        return $this->estudante;
    }
    function set_afastado($afastado){
        $this->afastado = $afastado;
    }
    function esta_afastado(){
        return $this->afastado;
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
    function set_perfilImg($perfilImg){
        $this->perfilImg = $perfilImg;
    }
    function get_perfilImg(){
        return $this->perfilImg;
    }
    function set_permissao($permissao){
        $this->permissao = $permissao;
    }
    function get_permissao(){
        return $this->permissao;
    }
}
?>