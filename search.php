<?php

// ============================================
// Dados da Pesquisa
// ============================================

# Resultados por página
$results_for_page = 8;

# Busca
$search_user = '';
if (isset($_GET['search'])) { $search_user =  $_GET['search']); }

# Página atual da busca
$current_page = (int) $_GET['pg'];


// ============================================
// Conexão MySQL
// ============================================

include 'config/db.php';

// ============================================
// Exibição dos resultados
// ============================================

# Verifica se foi feita alguma busca
if (!$search_user) {

  echo "<h3>Faça sua pesquisa</h3>";

} else {

  // Contagem
  // ============================================

  # Contagem de resultados para a busca
  $select_db_count = $connect->prepare("SELECT COUNT(*) FROM records WHERE title LIKE :search OR description LIKE :search OR url LIKE :search");
  $select_db_count->bindValue(':search', "%{$search_user}%");
  $select_db_count->execute();
  $count_results = $select_db_count->fetchColumn();

  # Quantidade de Resultados
  $found_message = "Nenhum resultado encontrado!"; 
  if ($count_results == 1) {    
    $found_message = "1 resultado encontrado!";
  } elseif ($count_results > 1) {
    $found_message = "{$count_results} resultados encontrados!";
  }
  echo $found_message;

  // Resultados
  // ============================================

  # Calculo para exibição dos resultados conforme a página atual
  $number_result_page = $current_page * $results_for_page;

  # Busca no Banco de Dados
  $select_db = $connect->prepare("SELECT * FROM records WHERE title LIKE :search OR description LIKE :search OR url LIKE :search ORDER BY id LIMIT {$number_result_page}, {$results_for_page}");
  $select_db->bindValue(':search', "%{$search_user}%");
  $select_db->execute();

  # Exibe os Resultados
  while ($result = $select_db->fetch(PDO::FETCH_ASSOC)) {
      $description = substr($result['description'], 0, 42) . "...";
      echo "<article>
        <a href=\"{$result['url']}\">{$result['title']}</a>
        <p><small>{$result['date']} - </small> {$description}</p>
      </article>";
  }

  // Paginação
  // ============================================

  if ($current_page > 1) {
    $back_page = $current_page - 1;
    echo "<a href=\"?q={$search_user}&pg={$back_page}\"> << Anterior </a>";
  }

  echo "<a href=\"?q={$search_user}&pg={$current_page}\"> {$current_page} </a>";

  $all_pages = $count_results / $results_for_page;
  if ($current_page < $all_pages) {
    $next_page = $current_page + 1;
    echo "<a href=\"?q={$search_user}&pg={$next_page}\"> Próxima >> </a>";
  }

}