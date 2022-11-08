create database bibliif;
use bibliif;
create table curso(
	IDcurso int auto_increment not null,
    nome varchar(300),
    primary key (IDcurso)
);
create table biblioteca(
	IDbiblioteca int auto_increment not null,
    campus varchar(50),
    primary key (IDbiblioteca)
);
create table Usuario(
	IDusuario int auto_increment not null,
    nome varchar(300) not null,
    cpf varchar(11) not null,
    email varchar(400) not null,
    senha varchar(250) not null,
    matricula varchar(20) not null,
    curso int,
    isEstudante boolean not null,
    estaAfastado boolean not null,
    biblioteca int not null,
    perfilImg varchar(200) default 'C:/xampp/htdocs/BibliIF/conexao/bd/img/foto_perfil/user.png',
    permissao enum('leitor', 'moderador', 'funcionario', 'adm') default 'leitor',
    primary key (IDusuario),
    foreign key (curso) references curso(IDcurso),
    foreign key (biblioteca) references biblioteca(IDbiblioteca)
    );
/*create table acervo(
	IDacervo int auto_increment not null,
    tipoAcervo varchar(100),
    descAcervo varchar(250)
);
create table obra(
	IDobra int auto_increment not null,
    isbn varchar(250) not null,
    titulo varchar(250) not null,
    subTitulo varchar(250),
    edição int not null, 
    ano int not null,
    lugar varchar(200),
    
    
);*/