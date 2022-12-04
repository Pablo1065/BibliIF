<?php
    function img($img, $pasta){
        $path = $_SERVER['DOCUMENT_ROOT']."BibliIF/conexao/bd/img/$pasta/default.png";
        if(isset($img)){
            $extension =  pathinfo($img['full_path'], PATHINFO_EXTENSION);

            if($img['size'] > 2097152){
                return $path;
            }
            if(preg_match("/(png|jpg|jpeg)/", $extension) == 0){
                return $path;
            }
            $path = $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/conexao/bd/img/" . $pasta . "/" . uniqid() . ".$extension";
            move_uploaded_file($img['tmp_name'], $path);
            return($path);
        }
    }
?>