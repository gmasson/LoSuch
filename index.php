<?php

  include 'from/db_php/connect.php';
  
  // Busca via GET
  $busca = $_GET['q'];

  // Resultados por página
  $max_resultados_pagina = "10";

  // SELECT para Busca
  $select = $connect_mysql->prepare("SELECT * FROM postagens WHERE titulo LIKE :search or post LIKE :search");
  $select->bindParam( ":search", "%$busca%" );
  $select->execute();
  

  // ...


  // Calcula quantos resultados retornou a busca
  $contagem_resultados = mysql_num_rows($select); 

  // Adiciona o plural na palavra Resultado(s)
  if ($contagem_resultados <= 1) { 
    $contagem_resultados_palavra = "resultado"; 
  } else { 
    $contagem_resultados_palavra = "resultados"; 
  }

  // Quantidade de Resultados
  echo "<p> <?php echo $contagem_resultados." ".$contagem_resultados_palavra;?> para sua pesquisa. </p>";


  if ($contagem_resultados == 0) {
   
    echo "<p>Ops, nada Encontrado! Tente sua busca novamente com outras palavras!</p>";
  
  } else {

    while ($resultado_busca = mysql_fetch_assoc($select)) { 

      // Dados para exibição
      $resultado_id = $resultado_busca['id'];
      $resultado_titulo = $resultado_busca['titulo'];
      $resultado_post = $resultado_busca['post'];

      // Se a quantidade de caracteres for maior que 42, reduza e insira '...' no final
      if (strlen($resultado_post) >= 42) { $resultado_post = substr($resultado_post, 0, 51)."..."; }

      // Exibição dos resultados da pesquisa
      echo "<!-- RESULTADO -->
        <div>
          <h4>{$resultado_titulo}</h4>
          <p>{$resultado_titulo}</p>
          <a href='http://meublog.com.br/?post={$resultado_id}'> Link para Postagem </a>
        </div>";

    } /* Fim while */

  } /* Fim if-else */


  // Paginação

  // ...

?>
