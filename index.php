<?php

$config = require 'config/app.php';
$db = require 'config/db.php';

require_once 'lib/db.php';
require_once 'lib/busca.php';

$conn = connect($db['type'], $db['host'], $db['port'], $db['name'], $db['user'], $db['pass']);

$expressao = expressaoBusca();
$pagina = paginaAtual();
$total = totalResultados($expressao, $conn);

if ($total == 0) {
    echo "<p>Ops, nada Encontrado! Tente sua busca novamente com outras palavras!</p>";
    exit;
}

# Quantidade de Resultados --------------------

echo "<p>{$total} resultado(s) para sua pesquisa. </p>";


# Busca --------------------

$resultado = buscar($expressao, $pagina, $config['resultadosPorPagina'], $conn);

$postUrl = $config['url'] . '?post=%1\$s';
$template = <<<HTML
    <div>
        <h4>%2\$s</h4>
        <p>%3\$s</p>
        <a href="{$postUrl}"> Link para Postagem </a>
    </div>
HTML;
exibeResultados($resultado, $template);


# Paginação --------------------


echo '<p>';

if ($pagina > 1) {
    $paginaAnterior = $pagina - 1;
    echo "<a href=\"{$config['url']}?q={$expressao}&p={$paginaAnterior}\">Anterior</a> ";
}

$totalPaginas = ceil($total / $config['resultadosPorPagina']);
if ($totalPaginas > $pagina) {
    $proximaPagina = $pagina + 1;
    echo " <a href=\"{$config['url']}?q={$expressao}&p={$proximaPagina}\">Proxima</a>";
}

echo '</p>';
