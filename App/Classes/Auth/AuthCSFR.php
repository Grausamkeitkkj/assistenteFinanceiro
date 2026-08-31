<?php 
Auth::requireLogin();

class AuthCSFR{

    public static function autenticacaoCSFR(){
        $headers = getallheaders();

        $tokenHeader = $headers['X-CSRF-TOKEN'] ?? '';
        $tokenSession = $_SESSION['csrf_token'] ?? '';

        if(!$tokenHeader || !$tokenSession || !hash_equals($tokenHeader, $tokenSession)){
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'Falha de validação de segurança (CSRF).'
            ]);
            exit();
        }
    return true;
    }
}