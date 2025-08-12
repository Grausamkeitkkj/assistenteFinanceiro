<?php
namespace App\Classes;

use PDO;
use App\Classes\Usuario;

class UsuarioPesquisa {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public static function getUsuarioPorEmail(PDO $pdo, $email){
        $sql = "SELECT * FROM usuario WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Usuario(
                $row['id_usuario'],
                $row['email'],
                $row['nome'],
                $row['senha']
            );
        }
        return null;
    }

    public function setUsuario(Usuario $usuario){
        $sql = "INSERT INTO usuario
                (email, nome, senha)
                VALUES
                (:email, :nome, :senha)";
        
        $senhaHash = password_hash($usuario->getSenhaUsuario(), PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $usuario->getEmailUsuario());
        $stmt->bindValue(':nome', $usuario->getNomeUsuario());
        $stmt->bindValue(':senha', $senhaHash);

        $stmt->execute();
    }
}
