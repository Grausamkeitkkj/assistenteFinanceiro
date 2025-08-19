<?php
namespace App\Classes;

class Auth {
    public static function login($usuario){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_regenerate_id(true);

        $_SESSION['idUsuario'] = $usuario->getIdUsuario();
    }

    public static function isLoggedIn(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['idUsuario']);
    }

    public static function requireLogin(){
        if (!self::isLoggedIn()) {
            header("Location: index.php");
            exit();
        }
    }

    public static function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
}
