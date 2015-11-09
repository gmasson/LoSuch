<?php
  include 'config.php';
?>

<!-- Losen Such -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $project['title']; ?></title>
    <link rel="stylesheet" href="css/style.css" media="screen">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>

    <div class="index_logo">
      <?php echo $project['name']; ?>
    </div>

    <div class="index_search">
      <form action="search.php" method="get">
        <input type="text" name="q" placeholder="<?php echo $LoSuch['input']; ?>">
        <button type="submit"><i class="fa fa-arrow-circle-o-right"></i></button>
      </form>
    </div>

    <div class="index_footer">
      <a href="#" target="_blank">Documentation</a>
      <a href="#" target="_blank">GitHub</a>
    </div>

  </body>
</html>
