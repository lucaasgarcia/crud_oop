<?php
require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Vaga;

if(isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}
$obVaga = Vaga::getVaga($_GET['id']);
echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

//Validacao do post
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
    $obVaga = new Vaga;
    $obVaga->titulo     = $_POST['titulo'];
    $obVaga->descricao  = $_POST['descricao'];
    $obVaga->ativo      = $_POST['ativo'];
    $obVaga->cadastrar();

    header('location: index.php?status=sucess');
    exit;
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/formulario.php';
include __DIR__ .'/includes/footer.php';


?>