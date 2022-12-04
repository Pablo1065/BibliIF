<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['IDusuario'])||!isset($_SESSION['permissao'])){
        die("Acesso negado");
    }
?>