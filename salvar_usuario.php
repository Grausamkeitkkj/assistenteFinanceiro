<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\Conexao\Conexao;
use App\Classes\Usuario\Usuario;
use App\Classes\Usuario\UsuarioPesquisa;

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
    try{
        $usuarioPesquisa->setUsuario($usuario);
    }catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro: ' . $e->getMessage()
        ]);
    }
    

    header('Location: index.php');
    exit();
}
