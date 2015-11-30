<?php

$config = require 'config/db.php';
require_once 'lib/db.php';
require_once 'lib/busca.php';

$conn = connect($config['type'], $config['host'], $config['port'], $config['name'], $config['user'], $config['pass']);

$expressao = expressaoBusca();
$total = totalResultados($expressao, $conn);

if ($total == 0) {
    echo "<p>Ops, nada Encontrado! Tente sua busca novamente com outras palavras!</p>";
    exit;
}

echo "<p>{$total} resultado(s) para sua pesquisa. </p>";

$resultado = buscar($expressao, $conn);

$template = <<<HTML
    <div>
        <h4>%2\$s</h4>
        <p>%3\$s</p>
        <a href="http://meublog.com.br/?post=%1\$s"> Link para Postagem </a>
    </div>
HTML;
exibeResultados($resultado, $template);
