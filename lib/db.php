<?php

function connect($type, $host, $port, $name, $user, $pass) {
    $dsn = "{$type}:host={$host};port={$port};dbname={$name}";
    return new PDO($dsn, $user, $pass);
}
