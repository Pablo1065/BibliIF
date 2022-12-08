<?php

use LDAP\Result;

   require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/funcoes_aux/login.php";
   require_once $_SERVER['DOCUMENT_ROOT'] . "/BibliIF/model/Obra.php";
   if(isset($_POST['submit'])){
      //papapapa
   }
   $o = new Obra;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema</title>
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="../../css/eestilo.css">
    <link rel="stylesheet" href="../../css/css-livros-disponiveis.css">
    <link rel="stylesheet" href="../../css/css-do-boto.css">
    <script src="sscript.js" defer></script>
</head>
<body>

<header>
    <nav><!--MENU DO SITE-->    
       <a id="logo" href="/"><img class="oi" width="180px" src="biblif.png" alt=""></a>
        <ul class="nav-list">
          <li><a href="#"><h4>Início</h4></a></li>
          <li><a href="#">Sobre</a></li>
          <li><a href="#">Projetos</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
    
    <main></main>
          
       
   <script src="mobile-navbar.js"></script>
      </nav>
    </header>
    <!--FIM DO MENU / HEADER-->

    <div class="searche-box"><!--bOTAO DE PESQUISAR-->
                    <form action="POST">
                     <input type="text" class="search-txt" placeholder="Pesquisar" >
					<a href="#" class="search-btn">
						<img src="searche.svg" alt="Lupa">
					</a></form>
        </div>

    <script src="nod.js"></script>
<!--BOTAO DE PESQUISSAR / FIM-->

<br> <br><br>


<br><br> <br><br> <br>
<!--INICIO DO CONTAINER-->
<div class="containere">

   <h3 class="title"> Livros Disponiveis </h3>
<!--PRATELEIRA DE LIVROS-->
   <div class="products-containere">

      <!--<div class="product" data-name="p-1">
         <img src="1.png" alt="">
         <h3>Harry potter 1</h3>
         <div class="price">Disponivel</div>
      </div>-->
      <?php
      $i = 1;
      echo($o->get_pathCapa());
         while($o->query_db($i)){
            echo("<div class=\"product\" data-name=\"p-$i\">
            <img src=\"../../conexao/bd/img/foto_livro/".$o->get_pathCapa()."\" alt=\"\">
            <h3>".$o->get_titulo()."</h3>
            <div class=\"price\">Disponivel</div>
         </div>");
         $i++;
         }
      ?>
   </div>

</div>
<!--FIM DA PATRELEIRA-->

<!--RESUMO DOS LIVROS-->
<div class="products-preview">

   <!--<div class="preview" data-target="p-1">
      <i class="fas fa-times"></i>
      <img src="1.png" alt="">
      <h3>Harry Potter 1</h3>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
         <span>( 250 )</span>
      </div>
      <p>Essse livro é bom, recomendo</p>
      <div class="price">Disponivel</div>
      <div class="buttons">
         <a href="livro/livro.php" class="buy">Ver Livro</a>
      </div>
   </div>-->
<?php
      $i = 1;
      echo($o->get_pathCapa());
         while($o->query_db($i)){
            echo("<div class=\"preview\" data-target=\"p-$i\">
            <i class=\"fas fa-times\"></i>
            <img src=\"../../conexao/bd/img/foto_livro/".$o->get_pathCapa()."\" alt=\"\">
            <h3>".$o->get_titulo()."</h3>
            <div class=\"stars\">
               <i class=\"fas fa-star\"></i>
               <i class=\"fas fa-star\"></i>
               <i class=\"fas fa-star\"></i>
               <i class=\"fas fa-star\"></i>
               <i class=\"fas fa-star-half-alt\"></i>
               <span>( 250 )</span>
            </div>
            <p>".$o->get_descObra()."</p>
            <div class=\"price\">Disponivel</div>
            <div class=\"buttons\">
               <a href=\"../Livro/Index.php?IDlivro=".$o->getID_Obra()."\" class=\"buy\">Ver Livro</a>
            </div>
         </div>");
         $i++;
         }
?>
  
</div>

</body>
</html>