<?php

  include 'from/db_php/connect.php';
  
  /* SELECT */
  $select = $connect_mysql->prepare("SELECT * FROM users WHERE name LIKE :search");
  $select->bindParam( ":search", "%test%" );
  $select->execute();

?>
