<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\UsuarioPesquisa;
use App\Classes\Conexao;    

$conexao = new Conexao();
$pdo = $conexao->getPdo();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = ($_POST['emailnome'] ?? '') !== '' ? $_POST['emailnome'] : null;
    $senha = ($_POST['senha'] ?? '') !== '' ? $_POST['senha'] : null;

    $usuarioNaoLogado = UsuarioPesquisa::getUsuarioPorEmail($pdo, $email);
    if ($usuarioNaoLogado !== null && password_verify($senha, $usuarioNaoLogado->getSenhaUsuario())) {

    }else{
        
    }
}