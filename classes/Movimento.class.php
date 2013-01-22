<?php

class Movimento {
    private $tipo_movimento;
    private $descricao;
    private $produto;
    private $cliente;
    private $fornecedor;
    private $utilizador;
    private $data_movimento;
    private $data_criacao;
    private $data_actualizacao;
    private $estado;
    
    function setTipoMovimento($tipo_movimento) {
        $this->tipo_movimento = $tipo_movimento;
    }
    function getTipoMovimento() {
        return $this->tipo_movimento;
    }
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    function getDescricao() {
        return $this->descricao;
    }
    function setProduto($produto) {
        $this->produto = $produto;
    }
    function getProduto() {
        return $this->produto;
    }
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function getCliente() {
        return $this->cliente;
    }
    function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }
    function getFornecedor() {
        return $this->fornecedor;
    }
    function setUtilizador($utilizador) {
        $this->utilizador = $utilizador;
    }
    function getUtilizador() {
        return $this->utilizador;
    }
    function setDataMovimento($data_movimento) {
        $this->data_movimento = $data_movimento;
    }
    function getDataMovimento() {
        return $this->data_movimento;
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