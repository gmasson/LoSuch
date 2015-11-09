<?php
  include 'config.php';

  $data_rec = mysql_escape_string($_GET['q']);
	$data_rec = htmlentities($data_rec);
  $search = $data_rec;

  if(!$search) {
    $search_title = NULL;
    $search_input_value = NULL;
  } else {
    $search_title = "- ".$search;
    $search_input_value = $search;
  }

?>

<!-- Losen Such -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $project['title']." ".$search_title; ?></title>
    <link rel="stylesheet" href="css/style.css" media="screen">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>

    <header>
      <div>
        <a href="index.php"><div><div class="text"><?php echo $project['name']; ?></div></div></a>
        <form action="search.php" method="get">
          <input type="text" name="q" placeholder="<?php echo $LoSuch['input']; ?>" value="<?php echo $search_input_value; ?>">
          <button type="submit"><i class="fa fa-arrow-circle-o-right"></i></button>
        </form>
      </div>
    </header>

    <!-- :::::::::::::::::::::: RESULTS :::::::::::::::::::::: -->

    <section>
      <p class="showresults">251 <?php echo $LoSuch['number_results']; ?></p>

      <div class="results">

        <article>
          <div class="title"><a href="#" target="_blank">Teste de Titulo</a></div>
          <div class="descri">Lorem ipsum dolor sit amet, ludus sensibus ea vim, nonumes postulant intellegebat ne sea,
          sanctus voluptatibus reprehendunt ea sed</div>
          <div class="url"><a href="#" target="_blank">http://www.site.com.br</a></div>
        </article>

      </div>

    </section>


    <div class="pages">
      <a href="#" class="numb_select">1</a>
      <a href="#" class="numb">2</a>
      <a href="#" class="numb">3</a>
      <a href="#" class="numb">4</a>
      <a href="#" class="numb">5</a>
    </div>


    <footer>
      <div>
        <a href="#" target="_blank">Documentation</a>
        <a href="#" target="_blank">GitHub</a>
      </div>
      <div id="text">
        <?php echo $LoSuch['footer_text']; ?>
      </div>
    </footer>

  </body>
</html>
