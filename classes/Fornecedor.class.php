<?php


class Fornecedor {
    private $nome_empresa;
    private $nome_contacto;
    private $telefone;
    private $fax;
    private $email;
    private $cidade;
    private $pais;
    private $data_criacao;
    private $data_actualizacao;
    private $estado;
    
    function setNomeEmpresa($nome_empresa) {
        $this->nome_empresa = $nome_empresa;
    }
    function getNomeEmpresa() {
        return $this->nome_empresa;
    }
    function setNomeContacto($nome_contacto) {
        $this->nome_contacto = $nome_contacto;
    }
    function getNomeContacto() {
        return $this->nome_contacto;
    }
    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    function getTelefone() {
        return $this->telefone;
    }
    function setFax($fax) {
        $this->fax = $fax;
    }
    function getFax() {
        return $this->fax;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function getEmail() {
        return $this->email;
    }
    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    function getCidade() {
        return $this->cidade;
    }
    function setPais($pais) {
        $this->pais = $pais;
    }
    function getPais() {
        return $this->pais;
    }
    function setDataCriacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
    function getDataCriacao() {
        return $this->data_criacao;
    }
    function setDataActualizacao($data_actualizacao) {
        $this->data_actualizacao = $data_actualizacao;
    }
    function getDataActualizacao() {
        return $this->data_actualizacao;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function getEstado() {
        return $this->estado;
    }
}