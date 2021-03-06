<?php

function paginaAtual() {
    return (int) $_GET['pag'] ?: 1;
}

function expressaoBusca() {
    return filter_var($_GET['q'], FILTER_SANITIZE_STRING);
}

function buscar($expressao, $pagina, $resultadosPorPagina, $conn) {
    if ($pagina > 0) {
        $pagina--;
    }

    $inicio = $pagina * $resultadosPorPagina;

    $stm = $conn->prepare("SELECT *
                             FROM postagens
                            WHERE titulo LIKE :search
                               OR post LIKE :search
                         ORDER BY id
                            LIMIT {$inicio}, {$resultadosPorPagina}");

    $stm->bindValue(':search', "%{$expressao}%");
    $stm->execute();

    return $stm;
}

function totalResultados($expressao, $conn) {
    $stm = $conn->prepare("SELECT COUNT(*)
                             FROM postagens
                            WHERE titulo LIKE :search
                               OR post LIKE :search");

    $stm->bindValue(':search', "%{$expressao}%");
    $stm->execute();

    return $stm->fetchColumn();
}

function exibeResultados($resultado, $template) {
    while ($row = $resultado->fetchObject()) {
        $row->post = previewPost($row->post);

        printf($template, $row->id, $row->titulo, $row->post);
    }
}

function previewPost($post) {
    if (strlen($post) >= 42) {
        $post = substr($post, 0, 42) . "...";
    }

    return $post;
}
