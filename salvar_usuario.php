<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\Conexao;
use App\Classes\Usuario;
use App\Classes\UsuarioPesquisa;

$conexao = new Conexao();
$pdo = $conexao->getPdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $senhaConfirmacao = $_POST['senhaConfirmacao'] ?? '';

    if ($senha !== $senhaConfirmacao) {
        echo "Senhas não conferem.";
        exit;
    }

    $usuario = new Usuario(null, $email, $nome, $senha);
    $usuarioPesquisa = new UsuarioPesquisa($pdo);
    $usuarioPesquisa->setUsuario($usuario);

    header('Location: index.php');
    exit();
}
