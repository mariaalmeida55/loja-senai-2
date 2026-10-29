
<?php

date_default_timezone_set('America/Sao_Paulo');

function e($texto) {
    if (is_null($texto)) {
        return '';
    }

    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function dinheiro($valor) {
    return 'R$ ' . number_format((float) $valor, 2, ',', '.');
}

function data_br($data) {
    if (empty($data)) {
        return '';
    }

    $data = substr(trim((string) $data), 0, 10);

    $partes = explode('-', $data);

    if (count($partes) !== 3) {
        return $data;
    }

    return $partes[2] . '/' . $partes[1] . '/' . $partes[0];
}