<?php

class Venda {
    private $cliente;
    private $utilizador;
    private $valor;
    private $valor_desconto;
    private $valor_total;
    private $data_venda;
    private $estado;
    
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function getCliente() {
        return $this->cliente;
    }
    function setUtilizador($utilizador) {
        $this->utilizador = $utilizador;
    }
    function getUtilizador() {
        return $this->utilizador;
    }
    function setValor($valor) {
        $this->valor = $valor;
    }
    function getValor() {
        return $this->valor;
    }
    function setValorDesconto($valor_desconto) {
        $this->valor_desconto = $valor_desconto;
    }
    function getValorDesconto() {
        return $this->valor_desconto;
    }
    function setValorTotal($valor_total) {
        $this->valor_total= $valor_total;
    }
    function getValorTotal() {
        return $this->valor_total;
    }
    function setDataVenda($data_venda) {
        $this->data_venda = $data_venda;
    }
    function getDataVenda() {
        return $this->data_venda;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function getEstado() {
        return $this->estado;
    }
}