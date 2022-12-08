<?php
     require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/login.php";
     require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/model/Obra.php";

     $o = new Obra;
     $o->query_db($_GET['IDlivro']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro - <?php echo($o->get_titulo())?></title>
 <!-- Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
 <!-- CSS -->
 <link href="stylem.css" rel="stylesheet">
 <meta name="robots" content="noindex,follow" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/stylem.css">
    <link rel="stylesheet" href="../../css/producte.css">
</head>
  <body>

    <!-- INICIO DO HEADER - PARTE VERDE-->

<header class="header">

  <div class="header-2">
      <nav class="navbar">
          <a href="./index.html"></a>
          <a href="#featured"></a>
          <a href="./category.html"></a>
          <a href="#reviews"></a>
          <a href="#blogs"></a>
      </nav>
  </div>      <a id="logo" href="../Tela_Inicial/"><img class="oi" src="logo.png" alt=""></a>

<style>
  .active{
    max-width: 300px;
    max-height: 700px;
    padding: 5px;
  }
</style>
</header>

<!-- FIM HEADER -->

<!-- bottom navbar  -->

<nav class="bottom-navbar">
  </nav>
    <main class="container">

      <!-- coluna da esquerda - do livro -->
      <div class="left-column">
        <img data-image="red" class="active" src="../../conexao/bd/img/foto_livro/<?php echo($o->get_pathCapa());?>" alt="">
      </div>


      <!-- outra coluna-->
      <div class="right-column">

        <!-- descrição dos livros -->
        <div class="product-description">
          <span><?php echo($o->get_tipoObra());?></span>
          <h1><?php echo($o->get_titulo());?></h1>
          <h2>~<?php echo($o->get_autor());?></h2>
          <p><?php echo($o->get_descObra())?></p>
        </div>

        <!-- classificação -->
        <div class="product-price">
          <span>Classificação</span>
          <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
        </div>
      </div>
    </main>

    <!-- footer section starts  -->

<section class="footer">

  <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="" class="fab fa-twitter"></a>
      <a href="" class="fab fa-instagram"></a>
      <a href="" class="fab fa-linkedin"></a>
  </div>

  <div class="credit"> created by <span>Eduardo, Julia, Maria e Pablo</span>copyright &copy;2022 all rights reserved! </div>

</section>

  </body>
</html>
