<?php

class Cliente {
    private $id;
    private $primeiro_nome;
    private $ultimo_nome;
    private $email;
    private $password;
    private $token;
    private $data_criacao;
    private $data_alteracao;
    private $estado;
    
    function setId($id) {
        $this->id = $id;
    }
    function getId() {
        return $this->id;
    }
    function setPrimeiroNome($primeiro_nome) {
        $this->primeiro_nome = $primeiro_nome;
    }
    function getPrimeiroNome() {
        return $this->primeiro_nome;
    }
    function setUltimoNome($ultimo_nome) {
        $this->ultimo_nome = $ultimo_nome;
    }
    function getUltimoNome() {
        return $this->ultimo_nome;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function getEmail() {
        return $this->email;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    function getPassword() {
        return $this->password;
    }
    function setToken($token) {
        $this->token = $token;
    }
    function getToken() {
        return $this->token;
    }
    function setDataCriacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
    function getDataCriacao() {
        return $this->data_criacao;
    }
    function setDataAlteracao($data_alteracao) {
        $this->data_alteracao = $data_alteracao;
    }
    function getDataAlteracao() {
        return $this->data_alteracao;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function getEstado() {
        return $this->estado;
    }
    
}