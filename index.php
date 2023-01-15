<?php

require __DIR__ .'/vendor/autoload.php';

use App\Entity\Vaga;

//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

//Filtro de status
$filtroStatus = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';

//Condicoes SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%'.str_replace(' ', '%',$busca).'"%' : null
];

//Clausulas WHERE
$where = implode(' AND ',$condicoes);

//Obtem as vagas
$vagas = Vaga::getVagas();

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/listagem.php';
include __DIR__ .'/includes/footer.php';


?>