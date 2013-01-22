<?php

class Detalhes_venda {
    private $venda;
    private $produto;
    private $quantidade;
    private $preco_unitario;
    private $preco_total;
    private $data_criacao;
    private $estado;
    
    function setVenda($venda) {
        $this->venda = $venda;
    }
    function getVenda() {
        return $this->venda;
    }
    function setProduto($produto) {
        $this->produto = $produto;
    }
    function getProduto() {
        return $this->produto;
    }
    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    function getQuantidade() {
        return $this->quantidade;
    }
    function setPrecoUnitario($preco_unitario) {
        $this->preco_unitario = $preco_unitario;
    }
    function getPrecoUnitario() {
        return $this->preco_unitario;
    }
    function setPrecoTotal($preco_total) {
        $this->preco_total = $preco_total;
    }
    function getPrecoTotal() {
        return $this->preco_total;
    }
    function setDataCriacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
    function getDataCriacao() {
        return $this->data_criacao;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function getEstado() {
        return $this->estado;
    }
 
}