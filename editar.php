<?php
require __DIR__ .'/vendor/autoload.php';

Define('TITLE', 'Editar');

use \App\Entity\Vaga;

//Validacao do ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//Consulta a vaga
$obVaga = Vaga::getVaga($_GET['id']);

//Validacao da vaga
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

//Validacao do post
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){

    $obVaga->titulo     = $_POST['titulo'];
    $obVaga->descricao  = $_POST['descricao'];
    $obVaga->ativo      = $_POST['ativo'];
    $obVaga->atualizar();

    header('location: index.php?status=sucess');
    exit;
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/formulario.php';
include __DIR__ .'/includes/footer.php';


?>