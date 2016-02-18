<?php

# Dados do MySQL
$db = array(
  'type' => 'mysql',
  'host' => 'localhost:3306',
  'port' => 3306,
  'name' => 'losuch',
  'user' => 'root',
  'pass' => 'root',
);

# Conexão MySQL
$connect = new PDO("{$db['type']}:host={$db['host']};port={$db['port']};dbname={$db['name']}", "{$db['user']}", "{$db['pass']}");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);