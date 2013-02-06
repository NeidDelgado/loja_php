<?php

class Utilizador {
    private $id;
    private $primeiro_nome;
    private $ultimo_nome;
    private $email;
    private $password;
    private $nivel_acesso;
    private $token;
    private $estado;
    private $url_imagem;
    private $data_criacao;
    private $data_alteracao;
    
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
    function setNivelAcesso($nivel_acesso) {
        $this->nivel_acesso = $nivel_acesso;
    }
    function getNivelAcesso() {
        return $this->nivel_acesso;
    }
    function setToken($token) {
        $this->token = $token;
    }
    function getToken() {
        return $this->token;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function getEstado() {
        return $this->estado;
    }
    function setUrlImagem($url_imagem) {
        $this->url_imagem = $url_imagem;
    }
    function getUrlImagem() {
        return $this->url_imagem;
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
  
}