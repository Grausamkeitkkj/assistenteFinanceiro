<?php
namespace App\Classes;

use PDO;

class Usuario{
    private $idUsuario;
    private $emailUsuario;
    private $nomeUsuario;
    private $senhaUsuario;

    function __construct($idUsuario, $emailUsuario, $nomeUsuario, $senhaUsuario){
        $this->idUsuario = $idUsuario;
        $this->emailUsuario = $emailUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->senhaUsuario = $senhaUsuario;

    }
     // Getters
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getEmailUsuario() {
        return $this->emailUsuario;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function getSenhaUsuario() {
        return $this->senhaUsuario;
    }

    // Setters
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setEmailUsuario($emailUsuario) {
        $this->emailUsuario = $emailUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function setSenhaUsuario($senhaUsuario) {
        $this->senhaUsuario = $senhaUsuario;
    }
}